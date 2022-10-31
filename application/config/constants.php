<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If setss to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


// Used for phpass_helper
define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', FALSE);
// Admin url
define('ADMIN_URL', 'admin');
// CRM server update url
define('UPDATE_URL','https://www.perfexcrm.com/perfex_updates/index.php');
// Get latest version info
define('UPDATE_INFO_URL','https://www.perfexcrm.com/perfex_updates/update_info.php');

// Do not send sms to data eq. invoices, estimates older then X days.
if(!defined('DO_NOT_SEND_SMS_ON_DATA_OLDER_THEN')){
    define('DO_NOT_SEND_SMS_ON_DATA_OLDER_THEN', 45);
}

if(!defined('CUSTOM_FIELD_TRANSFER_SIMILARITY')){
    define('CUSTOM_FIELD_TRANSFER_SIMILARITY', 85);
}

// START Master india API Credentials 
if (ENVIRONMENT == 'production'){
    
    define('E_INVOICE_URL', 'https://pro.mastersindia.co/oauth/access_token');
    define('E_INVOICE_USERNAME', 'admin@schachengineers.com');
    define('E_INVOICE_PASSWORD', 'Admin@123');
    define('E_INVOICE_CLIENTID', 'VeedYPmyztskMdXKEA');
    define('E_INVOICE_CLIENT_SECRET', '9j6LSTBtpXOmB8CFqi8hawFj');

    define('E_INVOICE_ACCESS_TOKEN', '496b29b8fd8b299f2e59ef0d478181b61c05749f');

    define('E_INVOICE_GENERATE_EINVOICE', 'https://pro.mastersindia.co/generateEinvoice');
    define('E_INVOICE_CANCEL_URL', 'https://pro.mastersindia.co/cancelEinvoice');
    define('E_INVOICE_DISTANCE', 'http://pro.mastersindia.co/distance');
    define('E_INVOICE_GENERATE_EWAYBILL', 'https://pro.mastersindia.co/generateEwaybillByIrn');
}else{
    
    define('E_INVOICE_URL', 'https://clientbasic.mastersindia.co/oauth/access_token');
    define('E_INVOICE_USERNAME', 'testeway@mastersindia.co');
    define('E_INVOICE_PASSWORD', '!@#Demo!@#123');
    define('E_INVOICE_CLIENTID', 'fIXefFyxGNfDWOcCWnj');
    define('E_INVOICE_CLIENT_SECRET', 'QFd6dZvCGqckabKxTapfZgJc');

    define('E_INVOICE_ACCESS_TOKEN', '67118f6bfaa1efedba09c90f9b2bc578e70f8468');

    define('E_INVOICE_GENERATE_EINVOICE', 'https://clientbasic.mastersindia.co/generateEinvoice');
    define('E_INVOICE_CANCEL_URL', 'https://clientbasic.mastersindia.co/cancelEinvoice');
    define('E_INVOICE_DISTANCE', 'http://clientbasic.mastersindia.co/distance');
    define('E_INVOICE_GENERATE_EWAYBILL', 'https://clientbasic.mastersindia.co/generateEwaybillByIrn');
}
/* END Master india API Credentials */



// Defined folders
// CRM temporary path
define('TEMP_FOLDER',FCPATH .'temp' . '/');
// Database backups folder
define('BACKUPS_FOLDER',FCPATH.'backups'.'/');
// Customer attachments folder from profile
define('CLIENT_ATTACHMENTS_FOLDER',FCPATH.'uploads/clients'.'/');
// All tickets attachments
define('TICKET_ATTACHMENTS_FOLDER',FCPATH .'uploads/ticket_attachments' . '/');
// Company attachemnts, favicon,logo etc..
define('COMPANY_FILES_FOLDER',FCPATH .'uploads/company' . '/');
// Staff profile images
define('STAFF_PROFILE_IMAGES_FOLDER',FCPATH .'uploads/staff_profile_images' . '/');
// Staff profile images
define('STAFF_DOCUMENT_FOLDER',FCPATH .'uploads/staff_profile_images/document' . '/');
// Contact profile images
define('CONTACT_PROFILE_IMAGES_FOLDER',FCPATH .'uploads/client_profile_images' . '/');
// Newsfeed attachments
define('NEWSFEED_FOLDER',FCPATH . 'uploads/newsfeed' . '/');
// Contracts attachments
define('CONTRACTS_UPLOADS_FOLDER',FCPATH . 'uploads/contracts' . '/');
// Tasks attachments
define('TASKS_ATTACHMENTS_FOLDER',FCPATH . 'uploads/tasks' . '/');
// Invoice attachments
define('INVOICE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/invoices' . '/');
// Estimate attachments
define('ESTIMATE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/estimates' . '/');
// Proposal attachments
define('PROPOSAL_ATTACHMENTS_FOLDER',FCPATH . 'uploads/proposals' . '/');
// Expenses receipts
define('EXPENSE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/expenses' . '/');
// Lead attachments
define('LEAD_ATTACHMENTS_FOLDER',FCPATH . 'uploads/leads' . '/');
// Project files attachments
define('PROJECT_ATTACHMENTS_FOLDER',FCPATH . 'uploads/projects' . '/');
// Project discussions attachments
define('PROJECT_DISCUSSION_ATTACHMENT_FOLDER',FCPATH . 'uploads/discussions' . '/');
// Credit notes attachment folder
define('CREDIT_NOTES_ATTACHMENTS_FOLDER',FCPATH.'uploads/credit_notes' . '/');
// Component attachment folder
define('COMPONENT_ATTACHMENTS_FOLDER',FCPATH.'uploads/component' . '/');
// Product attachment folder
define('PRODUCT_ATTACHMENTS_FOLDER',FCPATH.'uploads/product' . '/');

define('PRODUCT_MULTIPLE_ATTACHMENTS_FOLDER',FCPATH.'uploads/product/product_multiple' . '/');

define('PRODUCT_DRAWING_ATTACHMENTS_FOLDER',FCPATH.'uploads/product/product_drawing' . '/');

// Stock pdf attachment folder
define('STOCK_ATTACHMENTS_FOLDER',FCPATH.'uploads/stock' . '/');
// pancard attachment folder
define('PANCARD_ATTACHMENTS_FOLDER',FCPATH.'uploads/document/pancard' . '/');
// cancel cheque attachment folder
define('CANCEL_CHEQUE_ATTACHMENTS_FOLDER',FCPATH.'uploads/document/cancel_cheque' . '/');
// GST Regestration Doc attachment folder
define('GST_REGESTRATION_DOCUMENT_ATTACHMENTS_FOLDER',FCPATH.'uploads/document/gst_doc' . '/');
//leave recepits
define('LEAVE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/leave' . '/');
//Request  receipts
define('REQUEST_ATTACHMENTS_FOLDER',FCPATH . 'uploads/request' . '/');
//leave categories
define('LEAVES_CATEGORY_IMAGES_FOLDER',FCPATH . 'uploads/leaves_category' . '/');
//leave recepits
define('LEAVES_REQUEST_IMAGES_FOLDER',FCPATH . 'uploads/leaves_request' . '/');
//leave recepits
define('REMINDER_IMAGES_FOLDER',FCPATH . 'uploads/reminder' . '/');
//leave recepits
define('MR_IMAGES_FOLDER',FCPATH . 'uploads/material_receipt' . '/');
//PAYMENT
define('PAYMENT_ATTACHMENTS_FOLDER',FCPATH . 'uploads/payment' . '/');
//PURCHASE PAYMENT
define('PURCHASE_PAYMENT_ATTACHMENTS_FOLDER',FCPATH . 'uploads/purchase_payment' . '/');

//PAYMENT
define('DOCUMENT_ATTACHMENTS_FOLDER',FCPATH . 'uploads/office_document' . '/');

//APP Lead
define('APPLEAD_ATTACHMENTS_FOLDER',FCPATH . 'uploads/app_leads' . '/');

//Requirment Product
define('REQUIREMENT_ATTACHMENTS_FOLDER',FCPATH . 'uploads/requirement_product' . '/');

//Delivery vehicle_rc
define('DELIVERY_RC_ATTACHMENTS_FOLDER',FCPATH . 'uploads/challan_delivery/vehicle_rc' . '/');

//Delivery driving_licence
define('DELIVERY_DL_ATTACHMENTS_FOLDER',FCPATH . 'uploads/challan_delivery/driving_licence' . '/');

//Delivery insurance
define('DELIVERY_INSURANCE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/challan_delivery/insurance' . '/');

//Delivery vehicle_pic
define('DELIVERY_VEHICLE_PIC_ATTACHMENTS_FOLDER',FCPATH . 'uploads/challan_delivery/vehicle_pic' . '/');

//Challan
define('CHALLAN_ATTACHMENTS_FOLDER',FCPATH . 'uploads/challan_delivery' . '/');

//handover
define('HANDOVER_ATTACHMENTS_FOLDER',FCPATH . 'uploads/handover' . '/');

//handover_master
define('HANDOVER_MASTER_ATTACHMENTS_FOLDER',FCPATH . 'uploads/handover_master' . '/');

//challan final upload
define('CHALLAN_FINAL_ATTACHMENTS_FOLDER',FCPATH . 'uploads/challan' . '/');

//challan purchase order
define('PURCHASE_ORDER_ATTACHMENTS_FOLDER',FCPATH . 'uploads/purchase_order' . '/');

// purchase order proforma invoice 
define('POPROFORMA_INVOICE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/purchase_order/proforma_invoice' . '/');

//challan material receipt
define('MATERIAL_RECEIPT_ATTACHMENTS_FOLDER',FCPATH . 'uploads/material_receipt' . '/');

//challan material receipt
define('TEMPO_ATTACHMENTS_FOLDER',FCPATH . 'uploads/tempo' . '/');

//Purchase Invoice
define('PURCHASE_INVOICE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/purchase_invoice' . '/');

//Staff relive document
define('STAFF_RELIVE_ATTACHMENTS_FOLDER',FCPATH . 'uploads/staff_profile_images/relive_document' . '/');

define('REGISTERED_VENDOR_PAN_FOLDER',FCPATH . 'uploads/registered_vendor/pan_attach' . '/');

define('REGISTERED_VENDOR_GST_FOLDER',FCPATH . 'uploads/registered_vendor/gst_attach' . '/');

define('REGISTERED_VENDOR_MSME_FOLDER',FCPATH . 'uploads/registered_vendor/msme_attach' . '/');

define('REGISTERED_VENDOR_IEC_FOLDER',FCPATH . 'uploads/registered_vendor/iec_attach' . '/');

define('REGISTERED_VENDOR_CIN_FOLDER',FCPATH . 'uploads/registered_vendor/cin_attach' . '/');

define('REGISTERED_VENDOR_FINANCIAL_FOLDER',FCPATH . 'uploads/registered_vendor/financial_attach' . '/');

define('REGISTERED_VENDOR_BANK_FOLDER',FCPATH . 'uploads/registered_vendor/bank_attach' . '/');

define('CLIENT_DOCUMENT_FOLDER',FCPATH . 'uploads/client_document' . '/');

define('VENDOR_DOCUMENT_FOLDER',FCPATH . 'uploads/vendor_document' . '/');

define('STAFF_ALLOT_DOCUMENT_FOLDER',FCPATH . 'uploads/staff_iteams' . '/');

//gopal birla  

define('REGISTERED_STAFF_FOLDER',FCPATH . 'uploads/registered_staff/photo_attach' . '/');

define('REGISTERED_PAN_FOLDER',FCPATH . 'uploads/registered_staff/pan_attach' . '/');

define('REGISTERED_ADHAR_FOLDER',FCPATH . 'uploads/registered_staff/adhar_attach' . '/');

define('REGISTERED_QUALIFICATION_FOLDER',FCPATH . 'uploads/registered_staff/qualification_attach' . '/');

define('REGISTERED_RELIEVING_FOLDER',FCPATH . 'uploads/registered_staff/relieving_attach' . '/');

define('REGISTERED_SAL_FOLDER',FCPATH . 'uploads/registered_staff/sal_attach' . '/');

define('CLIENT_SECURITY_CHEQUE_FOLDER',FCPATH.'uploads/client_security_cheque' . '/');

define('COURIER_RETURN_FOLDER',FCPATH.'uploads/client_security_cheque/courier_return' . '/');

define('TEMPERORY_PRODUCT',FCPATH.'uploads/temperory_product' . '/');

define('STAFF_SALES_REPORT_FOLDER',FCPATH.'uploads/sales_report' . '/');

define('EMAIL_TEMPLATE_MASTER_FOLDER',FCPATH.'uploads/email_template_master' . '/');

define('CLIENT_DEPOSIT_FOLDER',FCPATH.'uploads/client_deposits' . '/');

define('COMPLAIN_ACTION_PLAN_FOLDER',FCPATH.'uploads/complaints' . '/');

define('ENQUIRYCALL_PRODUCTION_FOLDER',FCPATH.'uploads/enquirycall_drawing' . '/');

define('PURCHASE_CHALLAN_RETURN_FOLDER',FCPATH.'uploads/purchallan_return' . '/');

define('INTERVIEW_RESUME_FOLDER',FCPATH.'uploads/interview_resume' . '/');

define('STAFF_ASSIGN_CTC_FOLDER',FCPATH.'uploads/interview_resume/assign_ctc' . '/');

define('STAFF_SIGNED_CTC_FOLDER',FCPATH.'uploads/interview_resume/signed_ctc' . '/');

define('DESIGN_REQUISITION_ATTACHMENTS_FOLDER',FCPATH.'uploads/design_requisition' . '/');

define('TRIP_READING_FOLDER',FCPATH.'uploads/trip_reading' . '/');

define('COURIER_FILE_FOLDER',FCPATH.'uploads/courier_files' . '/');

define('PAYMENT_REQUEST_FOLDER',FCPATH.'uploads/payment_request' . '/');

define('SOFTWARE_TASK_FOLDER',FCPATH.'uploads/software_task' . '/');

define('QUALITY_REQUEST_FOLDER',FCPATH.'uploads/inspection/quality_report' . '/');

define('EMPLOYEE_COMPLAIN_FOLDER',FCPATH.'uploads/employee_complains' . '/');

define('TEST_CERTIFICATE_REQUEST_FOLDER',FCPATH.'uploads/inspection/test_certificate' . '/');
define('ESTIMATE_PURCHASE_ORDER_FOLDER',FCPATH.'uploads/estimates/purchase_order' . '/');
define('LEDGER_RECO_FOLDER',FCPATH.'uploads/ledger_reco' . '/');

//Calling API Settings
define('CALL_API_KEY', '4cf4540d6d5ab70f33aefc05ca05528fa400b8790d22af8e');
define('CALL_API_TOKEN', '06a1b3fc089f4b9f714448d7de03eb409f7979d83bbd5c1f');

//From Wallet Date
define('FROM_WALLET_DATE', '2021-04-01');