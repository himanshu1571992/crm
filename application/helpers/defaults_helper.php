<?php

function get_sql_select_client_company()
{
    return 'CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END as company';
}

function get_sql_select_client_branch_company()
{
    return 'CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclientbranch.userid and is_primary = 1) ELSE company END as company';
}

function get_sql_select_vendor_branch_company()
{
    return 'CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblvendorbranch.userid and is_primary = 1) ELSE company END as company';
}

function get_sql_calc_task_logged_time($task_id)
{
    /**
    * Do not remove where task_id=
    * Used in tasks detailed_overview to overwrite the taskid
    */
    return 'SELECT SUM(CASE
            WHEN end_time is NULL THEN ' . time() . '-start_time
            ELSE end_time-start_time
            END) as total_logged_time FROM tbltaskstimers WHERE task_id =' . $task_id;
}

function get_sql_select_task_assignees_ids()
{
    return '(SELECT GROUP_CONCAT(staffid SEPARATOR ",") FROM tblstafftaskassignees WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid)';
}

function get_sql_select_task_asignees_full_names()
{
    //return '(SELECT GROUP_CONCAT(CONCAT(firstname, \' \', lastname) SEPARATOR ",") FROM tblstafftaskassignees JOIN tblstaff ON tblstaff.staffid = tblstafftaskassignees.staffid WHERE taskid=tblstafftasks.id ORDER BY tblstafftaskassignees.staffid)';
}

function get_sql_select_task_total_checklist_items()
{
    return '(SELECT COUNT(id) FROM tbltaskchecklists WHERE taskid=tblstafftasks.id) as total_checklist_items';
}

function get_sql_select_task_total_finished_checklist_items()
{
    return '(SELECT COUNT(id) FROM tbltaskchecklists WHERE taskid=tblstafftasks.id AND finished=1) as total_finished_checklist_items';
}

/**
 * This text is used in WHERE statements for tasks if the staff member don't have permission for tasks VIEW
 * This query will shown only tasks that are created from current user, public tasks or where this user is added is task follower.
 * Other statement will be included the tasks to be visible for this user only if Show All Tasks For Project Members is set to YES
 * @return [type] [description]
 */
function get_tasks_where_string($table = true)
{
    $_tasks_where = '(tblstafftasks.id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = ' . get_staff_user_id() . ') OR tblstafftasks.id IN (SELECT taskid FROM tblstafftasksfollowers WHERE staffid = ' . get_staff_user_id() . ') OR (addedfrom=' . get_staff_user_id() . ' AND is_added_from_contact=0)';
    if (get_option('show_all_tasks_for_project_member') == 1) {
        $_tasks_where .= ' OR (rel_type="project" AND rel_id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=' . get_staff_user_id() . '))';
    }
    $_tasks_where .= ' OR is_public = 1)';
    if ($table == true) {
        $_tasks_where = 'AND ' . $_tasks_where;
    }

    return $_tasks_where;
}
function get_tasks_where_string_app($table = true,$user_id)
{
    $_tasks_where = '(tblstafftasks.id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = ' . $user_id . ') OR tblstafftasks.id IN (SELECT taskid FROM tblstafftasksfollowers WHERE staffid = ' . $user_id . ') OR (addedfrom=' . $user_id . ' AND is_added_from_contact=0)';
    if (get_option('show_all_tasks_for_project_member') == 1) {
        $_tasks_where .= ' OR (rel_type="project" AND rel_id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=' . $user_id . '))';
    }
    $_tasks_where .= ' OR is_public = 1)';
    if ($table == true) {
        $_tasks_where = 'AND ' . $_tasks_where;
    }

    return $_tasks_where;
}

function terms_url(){
    return do_action('terms_and_condition_url', site_url('terms-and-conditions'));
}

function privacy_policy_url(){
    return do_action('privacy_policy_url', site_url('privacy-policy'));
}

function default_aside_menu_active()
{
    return '{"aside_menu_active":[{"name":"als_dashboard","url":"\/","permission":"","icon":"fa fa-tachometer","id":"dashboard"},{"name":"als_clients","url":"clients","permission":"customers","icon":"fa fa-user-o","id":"customers"},{"name":"als_sales","url":"#","permission":"","icon":"fa fa-balance-scale","id":"sales","children":[{"name":"proposals","url":"proposals","permission":"proposals","icon":"","id":"child-proposals"},{"name":"estimates","url":"estimates\/list_estimates","permission":"estimates","icon":"","id":"child-estimates"},{"name":"invoices","url":"invoices\/list_invoices","permission":"invoices","icon":"","id":"child-invoices"},{"name":"payments","url":"payments","permission":"payments","icon":"","id":"child-payments"},{"name":"credit_notes","url":"credit_notes","permission":"credit_notes","icon":"","id":"credit_notes"},{"name":"items","url":"invoice_items","permission":"items","icon":"","id":"child-items"}]},{"name":"subscriptions","permission":"subscriptions","icon":"fa fa-repeat","url":"subscriptions","id":"subscriptions"},{"name":"als_expenses","url":"expenses\/list_expenses","permission":"expenses","icon":"fa fa-file-text-o","id":"expenses"},{"id":"contracts","name":"als_contracts","url":"contracts","permission":"contracts","icon":"fa fa-file"},{"id":"projects","name":"projects","url":"projects","permission":"","icon":"fa fa-bars"},{"name":"als_tasks","url":"tasks\/list_tasks","permission":"","icon":"fa fa-tasks","id":"tasks"},{"name":"support","url":"tickets","permission":"","icon":"fa fa-ticket","id":"tickets"},{"name":"als_leads","url":"leads","permission":"is_staff_member","icon":"fa fa-tty","id":"leads"},{"name":"als_kb","url":"knowledge_base","permission":"knowledge_base","icon":"fa fa-folder-open-o","id":"knowledge-base"},{"name":"als_utilities","url":"#","permission":"","icon":"fa fa-cogs","id":"utilities","children":[{"name":"als_media","url":"utilities\/media","permission":"","icon":"","id":"child-media"},{"name":"bulk_pdf_exporter","url":"utilities\/bulk_pdf_exporter","permission":"bulk_pdf_exporter","icon":"","id":"child-bulk-pdf-exporter"},{"name":"als_calendar_submenu","url":"utilities\/calendar","permission":"","icon":"","id":"child-calendar"},{"name":"als_goals_tracking","url":"goals","permission":"goals","icon":"","id":"child-goals-tracking"},{"name":"als_surveys","url":"surveys","permission":"surveys","icon":"","id":"child-surveys"},{"name":"als_announcements_submenu","url":"announcements","permission":"is_admin","icon":"","id":"child-announcements"},{"name":"utility_backup","url":"utilities\/backup","permission":"is_admin","icon":"","id":"child-database-backup"},{"name":"als_activity_log_submenu","url":"utilities\/activity_log","permission":"is_admin","icon":"","id":"child-activity-log"},{"name":"ticket_pipe_log","url":"utilities\/pipe_log","permission":"is_admin","icon":"","id":"ticket-pipe-log"}]},{"name":"als_reports","url":"#","permission":"reports","icon":"fa fa-area-chart","id":"reports","children":[{"name":"als_reports_sales_submenu","url":"reports\/sales","permission":"","icon":"","id":"child-sales"},{"name":"als_reports_expenses","url":"reports\/expenses","permission":"","icon":"","id":"child-expenses"},{"name":"als_expenses_vs_income","url":"reports\/expenses_vs_income","permission":"","icon":"","id":"child-expenses-vs-income"},{"name":"als_reports_leads_submenu","url":"reports\/leads","permission":"","icon":"","id":"child-leads"},{"name":"timesheets_overview","url":"staff\/timesheets?view=all","permission":"is_admin","icon":"","id":"reports_timesheets_overview"},{"name":"als_kb_articles_submenu","url":"reports\/knowledge_base_articles","permission":"","icon":"","id":"child-kb-articles"}]}]}';
}

function default_setup_menu_active()
{
    return '{"setup_menu_active":[{"name":"als_staff","url":"staff","permission":"staff","icon":"","id":"staff"},{"name":"clients","url":"#","permission":"is_admin","icon":"","id":"customers","children":[{"name":"customer_groups","url":"clients\/groups","permission":"","icon":"","id":"groups"}]},{"name":"support","url":"#","permission":"","icon":"","id":"tickets","children":[{"name":"acs_departments","url":"departments","permission":"is_admin","icon":"","id":"departments"},{"name":"acs_ticket_predefined_replies_submenu","url":"tickets\/predefined_replies","permission":"is_admin","icon":"","id":"predefined-replies"},{"name":"acs_ticket_priority_submenu","url":"tickets\/priorities","permission":"is_admin","icon":"","id":"ticket-priority"},{"name":"acs_ticket_statuses_submenu","url":"tickets\/statuses","permission":"is_admin","icon":"","id":"ticket-statuses"},{"name":"acs_ticket_services_submenu","url":"tickets\/services","permission":"is_admin","icon":"","id":"services"},{"name":"spam_filters","url":"tickets\/spam_filters","permission":"is_admin","icon":"","id":"spam-filters"}]},{"name":"acs_leads","url":"#","permission":"is_admin","icon":"","id":"leads","children":[{"name":"acs_leads_sources_submenu","url":"leads\/sources","permission":"","icon":"","id":"sources"},{"name":"acs_leads_statuses_submenu","url":"leads\/statuses","permission":"","icon":"","id":"statuses"},{"name":"leads_email_integration","url":"leads\/email_integration","permission":"","icon":"","id":"email-integration"},{"name":"web_to_lead","url":"leads\/forms","permission":"is_admin","icon":"","id":"web-to-lead"}]},{"name":"acs_finance","url":"#","permission":"is_admin","icon":"","id":"finance","children":[{"name":"acs_sales_taxes_submenu","url":"taxes","permission":"","icon":"","id":"taxes"},{"name":"acs_sales_currencies_submenu","url":"currencies","permission":"","icon":"","id":"currencies"},{"name":"acs_sales_payment_modes_submenu","url":"paymentmodes","permission":"","icon":"","id":"payment-modes"},{"name":"acs_expense_categories","url":"expenses\/categories","permission":"","icon":"","id":"expenses-categories"}]},{"name":"acs_contracts","url":"#","permission":"is_admin","icon":"","id":"contracts","children":[{"name":"acs_contract_types","url":"contracts\/types","permission":"","icon":"","id":"contract-types"}]},{"name":"acs_email_templates","url":"emails","permission":"email_templates","icon":"","id":"email-templates"},{"name":"asc_custom_fields","url":"custom_fields","permission":"is_admin","icon":"","id":"custom-fields"},{"name":"gdpr_short","url":"gdpr","permission":"is_admin","icon":"","id":"gdpr"},{"name":"acs_roles","url":"roles","permission":"roles","icon":"","id":"roles"},{"name":"menu_builder","url":"#","permission":"is_admin","icon":"","id":"menu-builder","children":[{"name":"main_menu","url":"utilities\/main_menu","permission":"is_admin","icon":"","id":"organize-sidebar"},{"name":"setup_menu","url":"utilities\/setup_menu","permission":"is_admin","icon":"","id":"setup-menu"}]},{"name":"theme_style","url":"utilities\/theme_style","permission":"is_admin","icon":"","id":"theme-style"},{"name":"acs_settings","url":"settings","permission":"settings","icon":"","id":"settings"}]}';
}

/* get product weight */
function get_product_weight($product_id){
    $CI =& get_instance();

    $product_weight = 0;
    $product_info = $CI->db->query("SELECT * FROM `tblproducts` WHERE id=".$product_id."")->row();
    if (!empty($product_info)){
        if($product_info->unit_id == 8 && $product_info->size > 0){
            $product_weight = $product_info->size;
        }else if($product_info->unit_1 == 8 && $product_info->conversion_1 > 0){
            $product_weight = $product_info->conversion_1;
        }else if($product_info->unit_2 == 8 && $product_info->conversion_2 > 0){
            $product_weight = $product_info->conversion_2;
        }
    }
    return $product_weight;
}

function send_curl_request($url, $data = array(), $method = "GET", $apiFor = 'gstAPI'){
        
    $headerData = array('Content-Type: application/json');
    if($apiFor == 'gridlines'){
        //$headerData[] = 'X-API-Key: BWBcjGP2IXhQnjYjSRaa1OJX9FHGXF1B';
        $headerData[] = 'X-API-Key: nYxjm02mGmjaqTc0htfwf1B90uBjJJdO';
        $headerData[] = 'X-Auth-Type: API-Key';
    }


    $postdata = (is_array($data)) ? json_encode($data) : $data;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
    if ($method == "POST"){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    return $response;
    curl_close($ch);
}

function aadhaar_verification($aadhaar_number){
    $url = 'https://api.gridlines.io/aadhaar-api/verify';
    $data = array(
        "aadhaar_number" => $aadhaar_number,
        "consent" => 'Y',
    );
    $response = send_curl_request($url,$data,'POST','gridlines');
    $response = json_decode($response);
    //$response = json_decode('{"request_id":"58e46d4c-c926-4564-a33c-8f94e5233dc1","status":200,"data":{"code":"1018","message":"Aadhaar number exists","aadhaar_data":{"document_type":"AADHAAR","gender":"MALE","age_band":"20-30","mobile":"xxxxxxx253","state":"Madhya Pradesh"}},"timestamp":1664261984123,"path":"/verify"}');
    // $response = json_decode('{"request_id":"2df008ab-6dba-44a3-affb-530a8ec82c88","status":400,"error":{"code":"INVALID_AADHAAR","message":"Invalid Aadhaar Number.","type":"https://docs.gridlines.io/docs/gridlines-api-docs/b3A6MTY2NjcwNjE-generate-otp#:~:text=5-,400,-INVALID_AADHAAR"},"timestamp":1664262006439,"path":"/verify"}');
    if($response->status == 200){
        $responseData = array(
            "status" => 1,
            "message" => $response->data->message,
        );
    }else{
        $responseData = array(
            "status" => 2,
            "message" => $response->error->message,
        );
    }

    return $responseData;
}
function pan_verification($number){
    $url = 'https://api.gridlines.io/pan-api/fetch-detailed';
    $data = array(
        "pan_number" => $number,
        "consent" => 'Y',
    );
    $response = send_curl_request($url,$data,'POST','gridlines');
    
    $response = json_decode($response);
    
    //$response = json_decode('{"request_id":"7c754ddf-7935-491c-a7e8-34899d8e7e34","status":200,"data":{"code":"1000","message":"Valid PAN.","pan_data":{"document_type":"PAN","document_id":"CWUPB8240F","name":"MUSTAFA BOHRA","first_name":"MUSTAFA","last_name":"BOHRA","category":"P","date_of_birth":"1993-06-15","masked_aadhaar_number":"XXXXXXXX6379","address_data":{"line_1":"106 MOHAMMEDI MASKAN","street":"BADRI BAGH COLONY","city":"INDORE","state":"MADHYA PRADESH","pincode":"452009"},"phone":"7223864233","gender":"MALE","aadhaar_linked":true}},"timestamp":1664264171686,"path":"/fetch-detailed"}');
   // $response = json_decode('{"request_id":"96dcb98a-9030-42c5-806e-3421f217ff1c","status":400,"error":{"code":"INVALID_PAN","message":"Invalid PAN number.","type":"https://docs.gridlines.io/docs/gridlines-api-docs/b3A6MjEzNzA5NTU-verify-pan-details#:~:text=5-,400,-INVALID_PAN"},"timestamp":1664264231884,"path":"/fetch-detailed"}');

    if($response->status == 200){
        $responseData = array(
            "status" => 1,
            "message" => $response->data->message,
            "document_id" => $response->data->pan_data->document_id,
            "name" => $response->data->pan_data->name,
            "phone" => $response->data->pan_data->phone,
            "gender" => $response->data->pan_data->gender,
            "date_of_birth" => _d($response->data->pan_data->date_of_birth),
            "address" => $response->data->pan_data->address_data->line_1.' '.$response->data->pan_data->address_data->street,
            "city" => $response->data->pan_data->address_data->city,
            "state" => $response->data->pan_data->address_data->state,
            "pincode" => $response->data->pan_data->address_data->pincode,
        );
    }else{
        $responseData = array(
            "status" => 2,
            "message" => $response->error->message,
        );
    }

    return $responseData;
}

function drivingLicenseDetails($number,$dob){
    $url = 'https://api.gridlines.io/dl-api/fetch';
    $data = array(
        "driving_license_number" => $number,
        "date_of_birth" => db_date($dob),
        "consent" => 'Y',
    );
    $response = send_curl_request($url,$data,'POST','gridlines');
    
     $response = json_decode($response);
    
    
   //$response = json_decode('{"request_id":"eaab5e38-293c-4ea6-bc13-54d87d014905","status":200,"data":{"code":"1000","message":"Extracted driving license details","driving_license_data":{"document_type":"DRIVING_LICENSE","document_id":"MP10N-2011-0119589","name":"MUSTUFA ALI","date_of_birth":"1993-06-15","dependent_name":"ASGAR ALI","address":"MPEB OFFICE","validity":{"non_transport":{"expiry_date":"2031-09-25"}},"rto_details":{"state":"Madhya Pradesh","authority":"KHARGONE"},"vehicle_class_details":[{"category":"M/C with Gear","authority":"KHARGONE"},{"category":"Light Motor Vehicle-NT","authority":"KHARGONE"}],"photo_base64":"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"}},"timestamp":1664265874653,"path":"/fetch"}');

   //$response = json_decode('{"request_id":"954c04fa-8cdd-4115-be0d-5a2a4afcd250","status":200,"data":{"code":"1001","message":"Driving license does not exist"},"timestamp":1664265803281,"path":"/fetch"}');
   
    if($response->status == 200 && $response->data->code == 1000){

        $vehicle_category = '--';
        if(!empty($response->data->driving_license_data->vehicle_class_details)){
            foreach ($response->data->driving_license_data->vehicle_class_details as $key => $value) {
                if($key == 0){
                    $vehicle_category = $value->category;
                }else{
                    $vehicle_category .= ', '.$value->category;
                }
                
            }
        }
        $responseData = array(
            "status" => 1,
            "message" => $response->data->message,
            "name" => $response->data->driving_license_data->name,
            "document_id" => $response->data->driving_license_data->document_id,
            "dependent_name" => $response->data->driving_license_data->dependent_name,
            "address" => $response->data->driving_license_data->address,
            "date_of_birth" => _d($response->data->driving_license_data->date_of_birth),
            "expiry_date" => _d($response->data->driving_license_data->validity->non_transport->expiry_date),
            "rto_state" => $response->data->driving_license_data->rto_details->state,
            "rto_authority" => $response->data->driving_license_data->rto_details->authority,
            "vehicle_category" => $vehicle_category,
            "photo_base64" => $response->data->driving_license_data->photo_base64,
        );
    }elseif($response->status == 200 && $response->data->code == 1001){
        $responseData = array(
            "status" => 2,
            "message" => $response->data->message,
        );
    }else{
        $responseData = array(
            "status" => 2,
            "message" => $response->error->message,
        );
    }
    return $responseData;
}


function voterId_verification($number){
    $url = 'https://api.gridlines.io/voter-api/boson/fetch';
    $data = array(
        "voter_id" => $number,
        "consent" => 'Y',
    );
    $response = send_curl_request($url,$data,'POST','gridlines');
    
    $response = json_decode($response);
    
    //$response = json_decode('{"request_id":"96e725e0-8953-45f5-a97f-f2b12b129e9f","status":200,"data":{"code":"1000","message":"Details Fetched","voter_data":{"document_type":"VOTER","name":"KAPIL PATIDAR ","father_name":"SOHAN PATIDAR ","gender":"MALE","age":"31","district":"INDORE","state":"Madhya Pradesh","assembly_constituency_number":"205","assembly_constituency_name":"INDORE-2","parliamentary_constituency_name":"INDORE","part_number":"101","part_name":"NIRANJANPUR","serial_number":"662","polling_station":"New Marthoma School Sc. N0. 114 Part 01 R.N. 1 - 101"}},"timestamp":1664270997593,"path":"/boson/fetch"}');
   // $response = json_decode('{"request_id":"afbb14b4-acdb-4da3-b2df-db45a4956ef2","status":200,"data":{"code":"1007","message":"Voter id does not exist."},"timestamp":1664271067451,"path":"/boson/fetch"}');
    
    if($response->status == 200 && $response->data->code == 1000){

        $responseData = array(
            "status" => 1,
            "message" => $response->data->message,
            "name" => $response->data->voter_data->name,
            "father_name" => $response->data->voter_data->father_name,
            "gender" => $response->data->voter_data->gender,
            "age" => $response->data->voter_data->age,
            "assembly_name" => $response->data->voter_data->assembly_constituency_name,
            "polling_station" => $response->data->voter_data->polling_station,
            "district" => $response->data->voter_data->district,
            "state" => $response->data->voter_data->state,
        );
    }elseif($response->status == 200 && $response->data->code == 1007){
        $responseData = array(
            "status" => 2,
            "message" => $response->data->message,
        );
    }else{
        $responseData = array(
            "status" => 2,
            "message" => $response->error->message,
        );
    }

    return $responseData;
}

function account_verification($number,$ifsc_code){
    $url = 'https://api.gridlines.io/bank-api/verify';
    $data = array(
        "account_number" => $number,
        "ifsc" => $ifsc_code,
        "consent" => 'Y',
    );
    $response = send_curl_request($url,$data,'POST','gridlines');
    $response = json_decode($response);
   //$response = json_decode('{"request_id":"2d1dcedb-60a0-4278-a035-88adf3a60d13","status":200,"data":{"code":"1000","message":"Bank Account details verified successfully.","bank_account_data":{"reference_id":"358243624","name":"MUSTAFASOASGARALIBOH","bank_name":"BANK OF BARODA","utr":"227015618728","city":"INDORE","branch":"TRANSPORT BRANCH","micr":"0"}},"timestamp":1664273300682,"path":"/verify"}');
    //$response = json_decode('{"request_id":"79d64c45-befe-4447-addb-485174e90493","status":200,"data":{"code":"1007","message":"IMPS mode failed. Cannot validate."},"timestamp":1664273926117,"path":"/verify"}');
   
    if($response->status == 200 && $response->data->code == 1000){

        $responseData = array(
            "status" => 1,
            "message" => $response->data->message,
            "name" => $response->data->bank_account_data->name,
            "bank_name" => $response->data->bank_account_data->bank_name,
            "branch" => $response->data->bank_account_data->branch,
            "city" => $response->data->bank_account_data->city,
        );
    }elseif($response->status == 200){
        $responseData = array(
            "status" => 2,
            "message" => $response->data->message,
        );
    }else{
        $responseData = array(
            "status" => 2,
            "message" => $response->error->message,
        );
    } 

    return $responseData;
}

function rcDetails($number){
    /*$url = 'https://api.gridlines.io/rc-api/fetch-detailed';
    $data = array(
        "rc_number" => $number,
        "consent" => 'Y',
    );
   $response = send_curl_request($url,$data,'POST','gridlines');               
    $response = json_decode($response);*/

   $response = json_decode('{"request_id":"c2657397-eb1c-4d1b-8a6d-09966013cb49","status":200,"data":{"code":"1000","message":"Extracted details.","rc_data":{"document_type":"RC","owner_data":{"serial":"4","name":"MUSTFA BOHRA","father_name":"ASGAR ALIBOHRA","present_address":"LOKMANYA NAGAR KE SAMNA, B-106 BADRI BAG COLONY INDORE, INDORE, -","permanent_address":"LOKMANYA NAGAR KE SAMNA, B-106 BADRI BAG COLONY INDORE, INDORE, -"},"issue_date":"2008-11-04","registered_at":"INDORE RTO, MADHYA PRADESH","status":"ACTIVE","insurance_data":{"policy_number":"36140031216701773902","company":"National Insurance Co. Ltd.","expiry_date":"2022-08-13"},"vehicle_data":{"manufactured_date":"2008-01","category":"LMV","category_description":"L.M.V. (CAR)(LMV)","chassis_number":"MA6MF481P8TK05504","engine_number":"B10S1050552KC2","maker_description":"GEN.MOTORS","maker_model":"CHEVROLET SPARK LT","fuel_type":"PETROL","color":"FAIRY RED","cubic_capacity":"995.00","gross_weight":"1270","number_of_cylinders":"4","seating_capacity":"4","wheelbase":"2500","unladen_weight":"840"}}},"timestamp":1664274639012,"path":"/fetch-detailed"}');
    //$response = json_decode('{"request_id":"0cbbe24b-e2b9-42ae-870d-5da66f6a156c","status":500,"error":{"code":"UPSTREAM_INTERNAL_SERVER_ERROR","message":"Upstream source/Government source internal server error. Please start the process again.","type":"https://docs.gridlines.io/#:~:text=rate%20limit%20exceeded.-,500,-INTERNAL_SERVER_ERROR"},"timestamp":1664274679948,"path":"/fetch-detailed"}');
   
    if($response->status == 200 && $response->data->code == 1000){

        $responseData = array(
            "status" => 1,
            "message" => $response->data->message,
            "name" => $response->data->rc_data->owner_data->name,
            "father_name" => $response->data->rc_data->owner_data->father_name,
            "address" => $response->data->rc_data->owner_data->present_address,
            "issue_date" => _d($response->data->rc_data->issue_date),
            "registered_at" => $response->data->rc_data->registered_at,
            "insurance_policy_number" => (!empty($response->data->rc_data->insurance_data->policy_number)) ? $response->data->rc_data->insurance_data->policy_number : '--',
            "insurance_company" => (!empty($response->data->rc_data->insurance_data->company)) ? $response->data->rc_data->insurance_data->company : '--',
            "insurance_expiry_date" => (!empty($response->data->rc_data->insurance_data->expiry_date)) ? _d($response->data->rc_data->insurance_data->expiry_date) : '--',
            "vehicle_manufactured_date" => $response->data->rc_data->vehicle_data->manufactured_date,
            "vehicle_category" => $response->data->rc_data->vehicle_data->category_description,
            "chassis_number" => $response->data->rc_data->vehicle_data->chassis_number,
            "engine_number" => $response->data->rc_data->vehicle_data->engine_number,
            "model" => $response->data->rc_data->vehicle_data->maker_model,
            "fuel_type" => $response->data->rc_data->vehicle_data->fuel_type,
            "color" => $response->data->rc_data->vehicle_data->color,
            "seating_capacity" => $response->data->rc_data->vehicle_data->seating_capacity,

        );
    }elseif($response->status == 200){
        $responseData = array(
            "status" => 2,
            "message" => $response->data->message,
        );
    }else{
        $responseData = array(
            "status" => 2,
            "message" => $response->error->message,
        );
    }

    return $responseData;
}

function uanDetails($number){
    $url = 'https://api.gridlines.io/epfo-api/fetch-uan';
    $data = array(
        "mobile_number" => $number,
        "consent" => 'Y',
    );
   $response = send_curl_request($url,$data,'POST','gridlines');  
                
    $response = json_decode($response);

   //$response = json_decode('{"request_id":"1b3b7c3d-7198-494a-8441-49661e256fae","status":200,"data":{"code":"1016","message":"UAN fetched from mobile.","uan_list":["101378622860"]},"timestamp":1664283609941,"path":"/fetch-uan"}');
    //$response = json_decode('{"request_id":"4363953b-8eaa-499e-a464-c25afea21a1b","status":200,"data":{"code":"1007","message":"Provided mobile number doesn\'t have any UAN"},"timestamp":1664283669504,"path":"/fetch-uan"}');
   
   
    if($response->status == 200 && $response->data->code == 1016){

        $uan_number = '--';
        if(!empty($response->data->uan_list)){
            foreach ($response->data->uan_list as $key => $value) {
                if($key == 0){
                    $uan_number = $value;
                }else{
                    $uan_number .= ', '.$value;
                }
                
            }
        }

        $responseData = array(
            "status" => 1,
            "message" => $response->data->message,
            "uan_numbers" => $uan_number,

        );
    }elseif($response->status == 200){
        $responseData = array(
            "status" => 2,
            "message" => $response->data->message,
        );
    }else{
        $responseData = array(
            "status" => 2,
            "message" => $response->error->message,
        );
    }

    return $responseData;
}

function gstDetails($number){

    $url = 'https://api.gridlines.io/gstin-api/fetch-detailed';
    $data = array(
        "gstin" => $number,
        "include_filing_data" => 'true',
        "consent" => 'Y',
    );
     $response = send_curl_request($url,$data,'POST','gridlines');                                          
        $response = json_decode($response);

       //$response = json_decode('{"request_id":"f7713926-91f5-4b79-a7b6-48c90b6768aa","status":200,"data":{"code":"1000","message":"Valid GSTIN","gstin_data":{"document_type":"GSTIN","document_id":"27AAVCS4630C1Z7","status":"Active","pan":"AAVCS4630C","legal_name":"SCHACH ENGINEERS PRIVATE LIMITED","trade_name":"SCHACH ENGINEERS PRIVATE LIMITED","center_jurisdiction":"Commissionerate - THANE,Division - DIVISION V,Range - RANGE-V (Jurisdictional Office)","state_jurisdiction":"State - Maharashtra,Zone - Thane,Division - ThaneRural,Charge - BHAYANDER-WEST_701","constitution_of_business":"Private Limited Company","taxpayer_type":"Regular","aadhaar_verified":true,"field_visit_conducted":false,"date_of_registration":"2017-11-01","directors":["abhishek singh ","Jignesh Popatlal Panchal "],"annual_aggregate_turnover":"Slab: Rs. 5 Cr. to 25 Cr.","annual_aggregate_turnover_year":"2021-2022","principal_address":{"address":"C-1204, , Avirahi Chs Ltd, Prem Nagar, Mira Road East, Thane, Maharashtra, 401107","email":"abhishek@schachengineers.com","mobile":"9930697444","nature_of_business_activity":"Office / Sale Office"},"additional_addresses":[{"address":"Gala No. 6 and 7, Ground Floor, Rashid Compound, Pelhar Road, Vasai Road, Thane, Maharashtra, 401208","email":"abhishek@schachengineers.com","mobile":"9930697444","nature_of_business_activity":"Factory / Manufacturing, Warehouse / Depot"}],"filing_data":[{"return_type":"GSTR1","financial_year":"2022-2023","tax_period":"August","date_of_filing":"2022-09-13","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2022-2023","tax_period":"July","date_of_filing":"2022-08-11","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2022-2023","tax_period":"June","date_of_filing":"2022-07-12","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2022-2023","tax_period":"May","date_of_filing":"2022-06-11","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2022-2023","tax_period":"April","date_of_filing":"2022-05-11","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2021-2022","tax_period":"March","date_of_filing":"2022-04-18","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2021-2022","tax_period":"February","date_of_filing":"2022-03-11","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2021-2022","tax_period":"January","date_of_filing":"2022-02-11","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2021-2022","tax_period":"December","date_of_filing":"2022-01-10","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR1","financial_year":"2021-2022","tax_period":"November","date_of_filing":"2021-12-11","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2022-2023","tax_period":"August","date_of_filing":"2022-09-20","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2022-2023","tax_period":"July","date_of_filing":"2022-08-20","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2022-2023","tax_period":"June","date_of_filing":"2022-07-28","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2022-2023","tax_period":"May","date_of_filing":"2022-06-20","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2022-2023","tax_period":"April","date_of_filing":"2022-05-24","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2021-2022","tax_period":"March","date_of_filing":"2022-05-02","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2021-2022","tax_period":"February","date_of_filing":"2022-03-20","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2021-2022","tax_period":"January","date_of_filing":"2022-02-18","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2021-2022","tax_period":"December","date_of_filing":"2022-01-21","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR3B","financial_year":"2021-2022","tax_period":"November","date_of_filing":"2021-12-20","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR9","financial_year":"2019-2020","tax_period":"Annual","date_of_filing":"2021-03-31","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR9","financial_year":"2018-2019","tax_period":"Annual","date_of_filing":"2021-03-31","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR9","financial_year":"2017-2018","tax_period":"Annual","date_of_filing":"2020-02-03","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR9C","financial_year":"2019-2020","tax_period":"Annual","date_of_filing":"2021-03-31","mode_of_filing":"ONLINE","status":"Filed"},{"return_type":"GSTR9C","financial_year":"2017-2018","tax_period":"Annual","date_of_filing":"2020-02-03","mode_of_filing":"ONLINE","status":"Filed"}]}},"timestamp":1664438786643,"path":"/fetch-detailed"}');
        //$response = json_decode('{"request_id":"9e7198bb-db0e-46ac-bbad-3d4d824ce11d","status":200,"data":{"code":"1005","message":"GSTIN does not exist"},"timestamp":1664437932972,"path":"/fetch-detailed"}');

        if($response->status == 200 && $response->data->code == 1000){

            $responseData = array(
                "status" => 1,
                "message" => $response->data->message,
                "gst_number" => $response->data->gstin_data->document_id,
                "pan_number" => $response->data->gstin_data->pan,
                "directors" => $response->data->gstin_data->directors[0],
                "legal_name" => $response->data->gstin_data->legal_name,
                "trade_name" => $response->data->gstin_data->trade_name,
                "center_jurisdiction" => $response->data->gstin_data->center_jurisdiction,
                "state_jurisdiction" => $response->data->gstin_data->state_jurisdiction,
                "registration_date" => _d($response->data->gstin_data->date_of_registration),
                "address" => $response->data->gstin_data->principal_address->address,
                "email" => $response->data->gstin_data->principal_address->email,
                "mobile" => $response->data->gstin_data->principal_address->mobile,
                "nature_of_business" => $response->data->gstin_data->principal_address->nature_of_business_activity,
                "filing_data" => $response->data->gstin_data->filing_data,

            );

        }elseif($response->status == 200){
            $responseData = array(
                "status" => 2,
                "message" => $response->data->message,
            );
        }else{
            $responseData = array(
                "status" => 2,
                "message" => "Invalid GSTIN",
            );
        } 

    return $responseData;
}

