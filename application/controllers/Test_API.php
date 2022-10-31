<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Test_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function test_cron(){

        $return_arr = array();

        $ad_data = array(
            'date' => date('Y-m-d H:i:s')
        );

        $this->home_model->insert('test',$ad_data);
        
        //schachengineers.com/schacrm/test_api/test_cron
    }

    public function test_intimation(){
       
        $token = 'fQvYYemW2-Y:APA91bFf821oEsnglHLNAWwmSdOyLhGSabOfYDK5Ybq3F2tmlZkXMGvymQ1hPXNBZdDgwGw0QuHoP0FoWjEdtqGpS8OFTPvpJDepJH58-VASv_qPIGlSg7IOJKiFoMwaJTxKa5BBLbPD';
        $message = 'Just For Test';
        $title = 'Schach';
        $send_intimation = sendFCM($message, $title, $token, $page = 2);
    }

    // Call Details API
    /*public function checkResponse(){

        $return_arr = array();

        //$calling_info = json_decode(file_get_contents("php://input"));
        $calling_info = $this->input->get();
        $CallSid = $calling_info['CallSid'];


        $url="https://4cf4540d6d5ab70f33aefc05ca05528fa400b8790d22af8e:06a1b3fc089f4b9f714448d7de03eb409f7979d83bbd5c1f@api.exotel.com/v1/Accounts/schachengineers1/Calls/".$CallSid.".json";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch); 


        //$data = json_encode($curl_scraped_page);
        $ad_data = array(
            'data' => $curl_scraped_page,
        );

        if($this->home_model->insert('test',$ad_data)){
            $return_arr['status'] = true;   
            $return_arr['message'] = "Success";
            $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;   
            $return_arr['message'] = "Error occurred!";
            $return_arr['data'] = []; 
        }

        

        header('Content-type: application/json');
        echo json_encode($return_arr);
        
        //schachengineers.com/schacrm/test_API/checkResponse
    }*/


    public function checkResponse(){
       
        $return_arr = array();

        $calling_info = $this->input->get();
        $calling_info = json_encode($calling_info);
        //$calling_info = json_decode($calling_info);


        $ad_data = array(
            'data' => $calling_info,
        );

        if($this->home_model->insert('test',$ad_data)){
            $return_arr['status'] = true;   
            $return_arr['message'] = "Success";
            $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;   
            $return_arr['message'] = "Error occurred!";
            $return_arr['data'] = []; 
        }   

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        
        //schachengineers.com/schacrm_test/test_API/checkResponse
    }

    public function get_outgoing(){

        $return_arr = array();

        $calling_info = $this->input->post();
        $calling_info = json_encode($calling_info);
        $calling_info = json_decode($calling_info);

        $RecordingUrl = '';
        $Status = '';
        $OnCallDuration = '0';
        if(isset($calling_info->Status)){
            $Status = $calling_info->Status;
        }
        if(isset($calling_info->RecordingUrl)){
            $RecordingUrl = str_replace("\\","",$calling_info->RecordingUrl);
        }
        if(isset($calling_info->Legs[0]->OnCallDuration)){
            $OnCallDuration = $calling_info->Legs[0]->OnCallDuration;
        }

        $ad_data = array(
            'call_id' => $calling_info->CallSid,
            'vagent_number' => $calling_info->PhoneNumberSid,
            'customer_number' => $calling_info->To,
            'agent_number' => $calling_info->From,
            'start_time' => $calling_info->StartTime,
            'end_time' => $calling_info->EndTime,
            'total_duration' => $OnCallDuration,
            'recording_url' => $RecordingUrl,
            'call_status' => $Status,
            'date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        );

        if($this->home_model->insert('tblcalloutgoing',$ad_data)){
            $return_arr['status'] = true;   
            $return_arr['message'] = "Success";
            $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;   
            $return_arr['message'] = "Error occurred!";
            $return_arr['data'] = []; 
        }   

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        
        //schachengineers.com/schacrm/vagent/get_incoming
    }

    public function make_call(){
       
        $StatusCallback = base_url().'test_API/get_outgoing';
        $data = [
           'From' => '9907327030',
           'To' => '8269607253',
           'CallerId' => '07314855570',
           'StatusCallback' => $StatusCallback,
           'StatusCallbackEvents[0]' => 'terminal',
        ];


        $makeCall = makeCall($data);
        echo '<pre/>';
        print_r($makeCall); 
        die;
    }

    /* this function use for remove duplicate contacts */
    function delete_duplicate_contacts(){
        $this->load->model("home_model");
        $get_user = $this->db->query("SELECT userid, COUNT(*) FROM `tblcontacts` GROUP BY userid HAVING COUNT(userid) > 1")->result();
        if (!empty($get_user)){
            foreach ($get_user as $user) {
                
                $getcontact = $this->db->query("SELECT `id`,`userid`,`phonenumber`,`contact_type` FROM `tblcontacts` WHERE `userid` = ".$user->userid." ")->result();
                if (!empty($getcontact)){
                    foreach ($getcontact as $key => $value) {
                        $chkcontact = $this->db->query("SELECT `id` FROM `tblcontacts` WHERE `userid` = ".$value->userid." AND `phonenumber` = ".$value->phonenumber." AND `contact_type` = ".$value->contact_type." ORDER BY id DESC")->row();
                        if (!empty($chkcontact)){
                            $this->home_model->delete("tblcontacts", array("id !="=> $chkcontact->id,"userid" => $value->userid, "phonenumber" => $value->phonenumber, "contact_type" => $value->contact_type));
                        }
                    }
                }
            }
        }
        echo "ok";
    }


    function remove_profile_image($user_id,$fileName){
        $path = get_upload_path_by_type('staff') . $user_id. '/'.$fileName;
        if(unlink($path)){
            echo 'success';
        }else{
            echo 'failed';
        }   
    }

    function remove_image($path){
        echo $path;
        die;
       $locaton = FCPATH.'uploads/'.$path;
       if(unlink($locaton)){
            echo 'success';
        }else{
            echo 'failed';
        }
    }






    /* E-Invoicing Functions Start From Here */



    /*public function get_invoice_gst_data($invoice_id, $assess_token = ""){
        $invoiceinfo = $this->db->query("SELECT * FROM `tblinvoices` WHERE `id` = ".$invoice_id." ")->row();
        
        $billing_info = get_branch_details($invoiceinfo->billing_branch_id);
        $seller_details = $this->db->query("SELECT * FROM `tblcompanybranch` where id = '".$invoiceinfo->billing_branch_id."' ")->row();
        $number = format_invoice_number($invoiceinfo->id);
        $to_info = get_invoice_to_array($invoiceinfo->id);
        $company_info = get_company_details();
        $city_name = '';
        if($seller_details->city > 0){
			$city_name = value_by_id('tblcities',$seller_details->city,'name');
		}
        if($seller_details->state > 0){
			$state_name = strtoupper(value_by_id('tblstates',$seller_details->state,'name'));
		}
        $buyer_email = client_info($invoiceinfo->clientid)->email_id;
        $buyer_state_id = client_info($invoiceinfo->clientid)->state;
        $buyer_legal_name = client_info($invoiceinfo->clientid)->legal_name;
        $buyer_trade_name = client_info($invoiceinfo->clientid)->trade_name;
        $place_of_supply = "";
        if($seller_details->state > 0){
			$place_of_supply = strtoupper(value_by_id('tblstates',$buyer_state_id,'place_of_supply_code'));
		}
        $seller_adderss = str_replace('<br>', '', $seller_details->address);
        $buyer_adderss = str_replace('<br>', '', $to_info['address']);
        $buyer_pincode = str_replace(' ', '', $to_info['zip']);
        
        $is_sale = ($invoiceinfo->service_type == 2) ? 1 : 0;
        $item_list = $this->db->query("SELECT * FROM `tblitems_in` WHERE `rel_id` = ".$invoice_id." AND `rel_type` = 'invoice' AND `is_sale` = ".$is_sale." ")->result();
        if ($assess_token != ""){
            $output_data = array(
                "access_token"=> $assess_token,
                "user_gstin" => trim($seller_details->gst_no),
                "transaction_details" => array(
                    "supply_type" => "B2B"
                ),
                "document_details" => array(
                    "document_type" => "INV",
                    "document_number" => ltrim($number, '0'),
                    "document_date"=> _d($invoiceinfo->invoice_date)
                ),
                "seller_details" => array(
                    "gstin" => trim($seller_details->gst_no),
                    "legal_name"=> $company_info['company_name'],
                    "address1"=> $seller_adderss,
                    "location"=> $city_name,
                    "pincode"=> $seller_details->pincode,
                    "state_code"=> $state_name,
                ),
                "buyer_details" => array(
                    "gstin" => trim($to_info['gst']),
                    "legal_name" => $buyer_legal_name,
                    "trade_name" => $buyer_trade_name,
                    "address1" => $buyer_adderss,
                    "location" => $to_info['city'],
                    "pincode" => trim($buyer_pincode),
                    "state_code" => strtoupper($to_info['state']),
                    "place_of_supply" => $place_of_supply,
                ),
                
            );
            if ($to_info['phone'] != ""){
                $output_data["buyer_details"]["phone_number"] = $to_info['phone'];
            }
            if (!empty($buyer_email) && $buyer_email != ""){
                $output_data["buyer_details"]["email"] = $buyer_email;
            }

            $total_assessable_value = $total_igst_amount = $total_cgst_amount = $total_sgst_amount = $total_item_value = 0;
            if (!empty($item_list)){
                foreach ($item_list as $key => $value) {
                    $isOtherCharge = value_by_id('tblproducts',$value->pro_id,'isOtherCharge');
                    $is_service = ($isOtherCharge == 0) ? 'N' : 'Y';
                    $unit_id = value_by_id_empty('tblproducts',$value->pro_id,'unit_2');

                    $prodtax = ($invoiceinfo->invoice_for == 1) ? round($value->prodtax) : 0.1;
                    $qty = $value->qty;
                    $rate = $value->rate;
                    $weight = $value->weight;
                    $dis = $value->discount;
                    $totalmonths = 1;
                    if($value->is_sale == 0){
                        $totalmonths = ($value->months + ($value->days / 30));
                        $price = ($rate * $qty * $totalmonths * $weight);
                    }else{
                        $price = ($rate * $qty * $weight);
                    }
                    $dis_price = ($price*$dis/100);
                    $final_price = ($price - $dis_price);
                    $tax_amt = ($final_price*$prodtax/100);
                    $final_price = ($final_price+$tax_amt);
                    $unitname = "NOS";
                    if ($unit_id == 5){
                        $unitname = "SET";
                    }elseif ($unit_id == 8){
                        $unitname = "KGS";
                    }
                    if($value->rate_view > 0){
                      $show_rate = $value->rate_view;
                    }else{
                      $show_rate = $value->rate;
                    }
                    $total_amount = ($value->qty * $show_rate * $weight);
                    $igst_amount = $cgst_amount = $sgst_amount = 0;
                    if($invoiceinfo->tax_type == 1 && $invoiceinfo->invoice_for == 1){
                        $tax = ($tax_amt/2);
                        $cgst_amount = $tax;
                        $sgst_amount = $tax;
                    }else{
                        $igst_amount = $tax_amt;
                    }
                    $total_assessable_value += $total_amount;
                    $total_igst_amount += $igst_amount;
                    $total_cgst_amount += $cgst_amount;
                    $total_sgst_amount += $sgst_amount;
                    $total_item_value += $final_price;
                    
                    //$hsn_code = ($is_service == "Y") ? "995457" : $value->hsn_code;


                    $hsn_code = '';
                    if($is_service == 'Y'){
                        $hsn_code = '996791';
                    }else{
                       if($is_sale == 1){
                            $hsn_sec_info = $this->db->query("SELECT `field_value` FROM `tblproductsfield` WHERE `product_id` = ".$value->pro_id." AND `field_id` = '1' ")->row();
                            if(!empty($hsn_sec_info)){
                                $hsn_code = $hsn_sec_info->field_value;
                            }
                        }else{
                           //$hsn_sec_info = $this->db->query("SELECT `field_value` FROM `tblproductsfield` WHERE `product_id` = ".$value->pro_id." AND `field_id` = '2' ")->row();
                           $hsn_sec_info = $this->db->query("SELECT `field_value` FROM `tblproductsfield` WHERE `product_id` = ".$value->pro_id." AND `field_id` = '1' ")->row();
                            if(!empty($hsn_sec_info)){
                                $hsn_code = $hsn_sec_info->field_value;
                            } 
                        } 
                    }
                    
                    $f_qty = $value->qty * $weight;
                    $output_data["item_list"][] = array(
                        "item_serial_number" => $value->pro_id,
                        "product_description" => $value->description,
                        "is_service" => $is_service,
                        "hsn_code" => $hsn_code,
                        "quantity" => number_format(($f_qty), 2, '.', ''),
                        "unit" => $unitname,
                        "unit_price" => floatval($show_rate),
                        "total_amount" => $total_amount,
                        "assessable_value" => $total_amount,
                        "gst_rate" => $prodtax,
                        "igst_amount" => number_format(round($igst_amount), 2, '.', ''),
                        "cgst_amount" => $cgst_amount,
                        "sgst_amount" => $sgst_amount,
                        "total_item_value" => number_format(round($final_price), 2, '.', ''),
                    );
                }
            }
            $output_data["value_details"] = array(
                "total_assessable_value" => $total_assessable_value,
                "total_igst_value"=> number_format(round($total_igst_amount), 2, '.', ''),
                "total_cgst_value"=> $total_cgst_amount,
                "total_sgst_value"=> $total_sgst_amount,
                "total_invoice_value" => number_format(round($total_item_value), 2, '.', '')
            );

            return $output_data;
        }else{
            return FALSE;
        }
    }


    public function get_client_legal_name($client_id){
        $client_gst_no = trim(client_info($client_id)->vat);
        $url = "https://appyflow.in/api/verifyGST?gstNo=".$client_gst_no."&key_secret=YQOSFee71jS4lmNc3AKVGztVmQx2";
        $response = send_curl_request($url);
        if (!empty($response)){
            $resultdecode = json_decode($response, TRUE);
            if (isset($resultdecode["taxpayerInfo"])){
                $legal_name = $resultdecode["taxpayerInfo"]["lgnm"];
                $trade_name = $resultdecode["taxpayerInfo"]["tradeNam"];

                $up_data = array("legal_name" => $legal_name, "trade_name" => $trade_name);
                $this->home_model->update("tblclientbranch", $up_data, array("userid" => $client_id));
                echo "Client legal name added successfully";
                exit;
            }elseif(isset($resultdecode["message"])){
                echo $resultdecode["message"];
                exit;
            }
        }
    }

    public function generate_einvoice($invoice_id){

        $access_token = $this->generate_access_token();
        if (isset($access_token["error"]) && !empty($access_token["error"])){
            echo $access_token["error"];
            exit;
        }
        $url = E_INVOICE_GENERATE_EINVOICE;
        $invoice_reqdata = $this->get_invoice_gst_data($invoice_id, $access_token);
        $invoiceresponse = send_curl_request($url, $invoice_reqdata, "POST");
        if (!empty($invoiceresponse)){
            $resdecode = json_decode($invoiceresponse, TRUE);
            if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Success"){
                $einvoice_ack_number = $resdecode["results"]["message"]["AckNo"];
                $einvoice_ack_date = $resdecode["results"]["message"]["AckDt"];
                $einvoice_irn = $resdecode["results"]["message"]["Irn"];
                $einvoice_pdf = $resdecode["results"]["message"]["EinvoicePdf"];
                $qrcode_url = $resdecode["results"]["message"]["QRCodeUrl"];
                $folderpath = INVOICE_ATTACHMENTS_FOLDER.'qr_images/'.$invoice_id;
                _maybe_create_upload_path($folderpath);
                $qrcodepath = $folderpath.'/qrcode.jpg';
                $this->storeInvoiceQRcodeImage($qrcode_url, $qrcodepath);
                $up_data = array(
                    "einvoice_irn" => $einvoice_irn,
                    "einvoice_ack_date" => $einvoice_ack_date,
                    "einvoice_ack_number" => $einvoice_ack_number,
                    "einvoice_pdf" => $einvoice_pdf,
                );
                $this->home_model->update("tblinvoices", $up_data, array("id" => $invoice_id));
                echo "E invoice generated successfully";
            }else if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Failed"){
                echo $resdecode["results"]["errorMessage"];
                exit;
            }else if (isset($resdecode["results"]) && $resdecode["results"]["code"] == "204"){
                echo $resdecode["results"]["message"];
                exit;
            }
        }    
    }


    public function storeInvoiceQRcodeImage($url, $folderpath){
        $ch = curl_init($url);
        $fp = fopen($folderpath, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

    public function cancel_einvoice(){

        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($invoice_id) && $cancel_remarks != ''){

                $access_token = $this->generate_access_token();
                if (isset($access_token["error"]) && !empty($access_token["error"])){
                    set_alert('warning', $access_token["error"]);
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $billing_branch_id = value_by_id_empty("tblinvoices", $invoice_id, "billing_branch_id");
                $einvoice_irn = value_by_id_empty("tblinvoices", $invoice_id, "einvoice_irn");
                $billing_info = get_branch_details($billing_branch_id);
                
                $request_data = array(
                    "access_token" => $access_token,
                    "user_gstin" => $billing_info['gst'],
                    "irn" => $einvoice_irn,
                    "cancel_reason" => "1",
                    "cancel_remarks" => $cancel_remarks
                );
                $invoiceresponse = send_curl_request(E_INVOICE_CANCEL_URL, $request_data, "POST");
                if (!empty($invoiceresponse)){
                    $resdecode = json_decode($invoiceresponse, TRUE);
                    if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Success"){
                        $einvoice_irn = $resdecode["results"]["message"]["Irn"];
                        $cancel_date = $resdecode["results"]["message"]["CancelDate"];

                        $folderpath = INVOICE_ATTACHMENTS_FOLDER.'qr_images/'.$invoice_id;
                        remove_all_uploaded_files($folderpath);

                        $up_data = array(
                            "einvoice_irn" => NULL,
                            "einvoice_ack_date" => NULL,
                            "einvoice_ack_number" => NULL,
                            "einvoice_pdf" => NULL,
                            "einvoice_cancel_by" => get_staff_user_id(),
                            "einvoice_cancel_irn" => $einvoice_irn,
                            "einvoice_cancel_date" => $cancel_date,
                            "einvoice_cancel_remark" => $cancel_remarks
                        );
                        $this->home_model->update("tblinvoices", $up_data, array("id" => $invoice_id));
                        set_alert('success', "E invoice cancel successfully");
                        redirect($_SERVER['HTTP_REFERER']);
                    }else if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Failed"){
                        set_alert('warning', $resdecode["results"]["errorMessage"]);
                        redirect($_SERVER['HTTP_REFERER']);
                    }else if (isset($resdecode["results"]) && $resdecode["results"]["code"] == "204"){
                        set_alert('warning', $resdecode["results"]["message"]);
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }         
            }else{
                set_alert('warning', "Cancel Remark can't be empty");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }        
        
    }


    public function get_distance_by_pincode($pincode_1,$pincode_2){


            if (!empty($pincode_1) && !empty($pincode_2)){

                $access_token = $this->generate_access_token();
                if (isset($access_token["error"]) && !empty($access_token["error"])){
                    set_alert('warning', $access_token["error"]);
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $url = E_INVOICE_DISTANCE.'?access_token='.$access_token.'&fromPincode='.$pincode_1.'&toPincode='.$pincode_2;
                $distanceresponse = file_get_contents($url);
                
                if (!empty($distanceresponse)){
                    $resdecode = json_decode($distanceresponse, TRUE);
                    if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Success"){
                        $distance = $resdecode["results"]["distance"];


                        $responseData = array(
                            "status" => 1,
                            "distance" => $distance
                        );
                    }else if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Failed"){
                        $responseData = array(
                            "status" => 2,
                            "distance" => 0
                        );
                    }else if (isset($resdecode["results"]) && $resdecode["results"]["code"] == "204"){
                        $responseData = array(
                            "status" => 2,
                            "distance" => 0
                        );
                    }
                } 
                return $responseData;         
            }
        
    }

    public function generate_access_token(){
        $response = $this->callAPI();
        
        if (!empty($response)){
            $resultdecode = json_decode($response, TRUE);
            if (isset($resultdecode["access_token"])){
                return $resultdecode["access_token"];
            }else if (isset($resultdecode["error"])){
                return array("error"=> $resultdecode["error"]);
            }else{
                return array("error"=> 'Can\'t grant access to E-invoicing!');
            }
        }else{
            return array("error"=> 'Can\'t grant access to E-invoicing!');
        }    
    }

    public function callAPI(){
        
        $data = array(
            'username'=> E_INVOICE_USERNAME,
            'password'=> E_INVOICE_PASSWORD,
            'client_id'=> E_INVOICE_CLIENTID,
            'client_secret'=> E_INVOICE_CLIENT_SECRET,
            'grant_type'=>'password',
        );
        $data_json = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, E_INVOICE_URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        return $response;
        curl_close($ch);
    }*/


    public function get_client_legal_name($client_id){
        $client_gst_no = trim(client_info($client_id)->vat);
     
        $response = gstDetails($client_gst_no); 
        if (!empty($response)){
             $legal_name = $response["legal_name"];
            $trade_name = $response["trade_name"];
            $up_data = array("legal_name" => $legal_name, "trade_name" => $trade_name);
            $this->home_model->update("tblclientbranch", $up_data, array("userid" => $client_id));
            echo "Client legal name added successfully";
            exit;
        }elseif(isset($resultdecode["message"])){
            echo $resultdecode["message"];
            exit;
        }
    }
}
