<?php

defined('BASEPATH') or exit('No direct script access allowed');


class E_invoicing extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }


    public function get_invoice_gst_data($invoice_id, $assess_token = ""){
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
        /* get invoice item data */
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


                    //$is_service = ($isOtherCharge == 0) ? 'N' : 'Y';
                    $is_service = ($isOtherCharge > 0 || $invoiceinfo->service_type == 1) ? 'Y' : 'N';


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


                   // "BAG", "BAL", "BDL", "BKL", "BOU", "BOX", "BTL", "BUN", "CAN", "CBM", "CCM", "CMS", "CTN", "DOZ", "DRM", "GGK", "GMS", "GRS", "GYD", "KGS", "KLR", "KME", "LTR", "MTR", "MLT", "MTS", "NOS", "OTH", "PAC", "PCS", "PRS", "QTL", "ROL", "SET", "SQF", "SQM", "SQY", "TBS", "TGM", "THD", "TON", "TUB", "UGS", "UNT", "YDS"

                    $unitname = "NOS";
                    if ($unit_id == 5){
                        $unitname = "SET";
                    }elseif ($unit_id == 8){
                        $unitname = "KGS";
                    }elseif ($unit_id == 22){
                        $unitname = "SQM";
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
                        //$hsn_code = '996791';
                        $sec_info = $this->db->query("SELECT `field_value` FROM `tblproductsfield` WHERE `product_id` = ".$value->pro_id." AND `field_id` = '2' ")->row();
                        if(!empty($sec_info)){
                            $hsn_code = $sec_info->field_value;
                        }
                    }else{
                        $hsn_info = $this->db->query("SELECT `field_value` FROM `tblproductsfield` WHERE `product_id` = ".$value->pro_id." AND `field_id` = '1' ")->row();
                        if(!empty($hsn_info)){
                            $hsn_code = $hsn_info->field_value;
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
                        "total_amount" => number_format($total_amount, 2, '.', ''),
                        "assessable_value" => number_format($total_amount, 2, '.', ''),
                        "gst_rate" => $prodtax,
                        "igst_amount" => number_format(round($igst_amount), 2, '.', ''),
                        /*"cgst_amount" => $cgst_amount,
                        "sgst_amount" => $sgst_amount,*/
                        "cgst_amount" => number_format($cgst_amount, 2, '.', ''),
                        "sgst_amount" => number_format($sgst_amount, 2, '.', ''),
                        "total_item_value" => number_format(round($final_price), 2, '.', ''),
                    );
                }
            }
            $output_data["value_details"] = array(
                "total_assessable_value" => number_format($total_assessable_value, 2, '.', ''),
                "total_igst_value"=> number_format(round($total_igst_amount), 2, '.', ''),
                "total_cgst_value"=> number_format($total_cgst_amount, 2, '.', ''),
                "total_sgst_value"=> number_format($total_sgst_amount, 2, '.', ''),
                "total_invoice_value" => number_format(round($total_item_value), 2, '.', '')
            );

            // header('Content-type: application/json');
            /*echo '<pre/>';
            print_r($output_data);
            die;*/
            return $output_data;
        }else{
            return FALSE;
        }
    }


    /* this function use for client legal name */
    public function get_client_legal_name($client_id){
        $client_gst_no = trim(client_info($client_id)->vat);
        $url = "https://appyflow.in/api/verifyGST?gstNo=".$client_gst_no."&key_secret=YQOSFee71jS4lmNc3AKVGztVmQx2";
        $response = send_curl_request($url);
        if (!empty($response)){
            $resultdecode = json_decode($response, TRUE);
            if (isset($resultdecode["taxpayerInfo"])){
                $legal_name = $resultdecode["taxpayerInfo"]["lgnm"];
                $trade_name = $resultdecode["taxpayerInfo"]["tradeNam"];

                /* update legal name and trade name in the system */
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

    /* this function use for generate e invoice */
    public function generate_einvoice($invoice_id){

        $access_token = $this->generate_access_token();
        if (isset($access_token["error"]) && !empty($access_token["error"])){
            echo $access_token["error"];
            exit;
        }
        $url = E_INVOICE_GENERATE_EINVOICE;
        $invoice_reqdata = $this->get_invoice_gst_data($invoice_id, $access_token);
        /* call invoice request for generate E invoice */
        $invoiceresponse = send_curl_request($url, $invoice_reqdata, "POST");
        if (!empty($invoiceresponse)){
            $resdecode = json_decode($invoiceresponse, TRUE);
            if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Success"){
                $einvoice_ack_number = $resdecode["results"]["message"]["AckNo"];
                $einvoice_ack_date = $resdecode["results"]["message"]["AckDt"];
                $einvoice_irn = $resdecode["results"]["message"]["Irn"];
                $einvoice_pdf = $resdecode["results"]["message"]["EinvoicePdf"];

                /* this code use for store qrcode */
                $qrcode_url = $resdecode["results"]["message"]["QRCodeUrl"];
                $folderpath = INVOICE_ATTACHMENTS_FOLDER.'qr_images/'.$invoice_id;
                _maybe_create_upload_path($folderpath);
                $qrcodepath = $folderpath.'/qrcode.jpg';
                $this->storeInvoiceQRcodeImage($qrcode_url, $qrcodepath);
                /* this code use for store qrcode */

                /* update legal name and trade name in the system */
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

    
    /* this function use for generate ewaybill */
    public function generate_ewaybill(){
        if (!empty($_POST)){
            extract($this->input->post());
            $invoiceinfo = $this->db->query("SELECT * FROM `tblinvoices` WHERE `id` = ".$invoice_id." ")->row();

            $transporter_name = (!empty($transporter_name)) ? $transporter_name : NULL;
            $transporter_id = (!empty($transporter_id)) ? $transporter_id : NULL;
            $transporter_doc_no = (!empty($transporter_doc_no)) ? $transporter_doc_no : NULL;
            $transporter_doc_date = (!empty($transporter_doc_date)) ? db_date($transporter_doc_date) : NULL;
            $insert_data = array(
                "invoice_id" => $invoice_id,
                "vehicle_number" => $vehicle_number,
                "transporter_name" => $transporter_name,
                "vehicle_type" => $vehicle_type,
                "transportation_mode" => $transportation_mode,
                "transporter_id" => $transporter_id,
                "transporter_document_number" => $transporter_doc_no,
                "transporter_document_date" => $transporter_doc_date
            );

            $inserted_id = $this->home_model->insert("tblwaybill", $insert_data);
            if ($inserted_id){

               
                /* call this function for generate token */
                $access_token = $this->generate_access_token();
                if (isset($access_token["error"]) && !empty($access_token["error"])){
                    set_alert('warning', $access_token["error"]);
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $billing_branch_id = value_by_id_empty("tblinvoices", $invoice_id, "billing_branch_id");
                /* Dispatch Details */     
                $warehouse_info = $this->db->query("SELECT * FROM `tblwarehouse` where `branch_id` = '".$billing_branch_id."' ")->row();
                $dispatch_address = $warehouse_info->address;
                $dispatch_pincode = $warehouse_info->pincode;
                $company_info = get_company_details();
                $dispatch_city_name = $dispatch_state_name = '';
                if($warehouse_info->city > 0){
                    $dispatch_city_name = value_by_id('tblcities',$warehouse_info->city,'name');
                }
                if($warehouse_info->state > 0){
                    $dispatch_state_name = strtoupper(value_by_id('tblstates',$warehouse_info->state,'name'));
                }

                /* Ship Details */
                $to_info = get_ship_to_array($invoiceinfo->site_id);
                //$to_info = get_invoice_to_array($invoice_id);
                $ship_adderss = str_replace('<br>', '', $to_info['address']);
                $ship_pincode = str_replace(' ', '', $to_info['zip']);


                $ship_address_arr = explode('-', $ship_adderss);


                $einvoice_irn = value_by_id_empty("tblinvoices", $invoice_id, "einvoice_irn");
                $billing_info = get_branch_details($billing_branch_id);

                $get_distance = $this->get_distance_by_pincode($dispatch_pincode,$ship_pincode);
                if ($get_distance["status"] == 2){
                    set_alert('warning', "Distance can't be occarred");
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $request_data = array(
                    "access_token" => $access_token,
                    "user_gstin" => $billing_info['gst'],
                    "irn" => $einvoice_irn,
                    "transporter_id" => $transporter_id,
                    "transportation_mode" => $transportation_mode,
                    "transporter_document_number" => $transporter_doc_no,
                    "transporter_document_date" => _d($transporter_doc_date),
                    "vehicle_number" => $vehicle_number,
                    "distance" => $get_distance["distance"],
                    "vehicle_type" => $vehicle_type,
                    "transporter_name" => $transporter_name,
                    "data_source" => "erp",
                    "ship_details" => array(
                        "address1" => (!empty($ship_address_arr[0])) ? $ship_address_arr[0] : "",
                        "address2" => (!empty($ship_address_arr[1])) ? $ship_address_arr[1] : "",
                        "location" => $to_info['city'],
                        "pincode" => trim($ship_pincode),
                        "state_code" => strtoupper($to_info['state'])
                    ),
                    "dispatch_details" => array(
                        "company_name" => $company_info['company_name'],
                        "address1" => $dispatch_address,
                        "address2" => "",
                        "location" => $dispatch_city_name,
                        "pincode" => $dispatch_pincode,
                        "state_code" => $dispatch_state_name,
                    )
                );
                $requestUrl = E_INVOICE_GENERATE_EWAYBILL;
                $invoiceresponse = send_curl_request($requestUrl, $request_data, "POST");
                $this->home_model->update("tblwaybill",  array("response" => $invoiceresponse), array("id" => $inserted_id));
                if (!empty($invoiceresponse)){
                    $resdecode = json_decode($invoiceresponse, TRUE);

                    if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Success"){

                        /* This function use for update ewaybill id in the invoice system */
                        $up_waybill_arr = array("ewayBiIl_id" => $inserted_id);
                        $this->home_model->update("tblinvoices", $up_waybill_arr, array("id" => $invoice_id));

                        $ewaybill_number = $resdecode["results"]["message"]["EwbNo"];
                        $ewaybill_date = $resdecode["results"]["message"]["EwbDt"];
                        $ewaybill_validtill = $resdecode["results"]["message"]["EwbValidTill"];
                        $ewaybill_pdf = $resdecode["results"]["message"]["EwaybillPdf"];
                        $up_data = array(
                            "ewaybill_number" => $ewaybill_number,
                            "ewaybill_date" => $ewaybill_date,
                            "ewaybill_validtill" => $ewaybill_validtill,
                            "ewaybill_pdf" => $ewaybill_pdf,
                        );
                        $this->home_model->update("tblwaybill", $up_data, array("id" => $inserted_id));
                        set_alert('success', "Generate ewaybill successfully");
                        redirect($_SERVER['HTTP_REFERER']);
                    }else if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Failed"){

                        $this->home_model->delete("tblwaybill", array("id" => $inserted_id));
                        set_alert('warning', $resdecode["results"]["errorMessage"]);
                        redirect($_SERVER['HTTP_REFERER']);
                    }else if (isset($resdecode["results"]) && $resdecode["results"]["code"] == "204"){

                        $this->home_model->delete("tblwaybill", array("id" => $inserted_id));
                        set_alert('warning', $resdecode["results"]["message"]);
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
                
            }else{
                set_alert('warning', "Somthing went wrong");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }    
        
    }

    // function send_curl_request($url, $data = array(), $method = "GET", $apiFor = 'gstAPI'){
        
    //     $headerData = array('Content-Type: application/json');
    //     if($apiFor == 'gridlines'){
    //         $headerData[] = 'X-API-Key: BWBcjGP2IXhQnjYjSRaa1OJX9FHGXF1B';
    //         $headerData[] = 'X-Auth-Type: API-Key';
    //     }


    //     $postdata = (is_array($data)) ? json_encode($data) : $data;
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
    //     if ($method == "POST"){
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    //     }
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response  = curl_exec($ch);
    //     return $response;
    //     curl_close($ch);
    // }

    /* this function use for store invoice qr code images */
    public function storeInvoiceQRcodeImage($url, $folderpath){
        $ch = curl_init($url);
        $fp = fopen($folderpath, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

    /* this function use for cancel e-invoice */
    public function cancel_einvoice(){

        if(!empty($_POST)){
            extract($this->input->post());
            
            if (!empty($invoice_id) && $cancel_remarks != ''){

                /* call this function for generate token */
                $access_token = $this->generate_access_token();
                if (isset($access_token["error"]) && !empty($access_token["error"])){
                    set_alert('warning', $access_token["error"]);
                    redirect($_SERVER['HTTP_REFERER']);
                }
                
                $billing_branch_id = value_by_id_empty("tblinvoices", $invoice_id, "billing_branch_id");
                
                $billing_info = get_branch_details($billing_branch_id);
                $einvoice_irn = value_by_id_empty("tblinvoices", $invoice_id, "einvoice_irn");
                
                $request_data = array(
                    "access_token" => $access_token,
                    "user_gstin" => $billing_info['gst'],
                    "irn" => $einvoice_irn,
                    "cancel_reason" => "1",
                    "cancel_remarks" => $cancel_remarks
                );
                if ($type == "ewaybill"){
                    $request_data["ewaybill_cancel"] = "1";
                }

                $invoiceresponse = send_curl_request(E_INVOICE_CANCEL_URL, $request_data, "POST");
                if (!empty($invoiceresponse)){
                    $resdecode = json_decode($invoiceresponse, TRUE);
                    if (isset($resdecode["results"]) && $resdecode["results"]["status"] == "Success"){
                        $einvoice_irn = $resdecode["results"]["message"]["Irn"];
                        $cancel_date = $resdecode["results"]["message"]["CancelDate"];

                        if ($type == "einvoice"){
                            /* this code use for remove upload qrcode */
                            $folderpath = INVOICE_ATTACHMENTS_FOLDER.'qr_images/'.$invoice_id;
                            remove_all_uploaded_files($folderpath);

                            /* update API response in the system */
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
                        }else{
                            /* update API response in the system */
                            $up_data = array(
                                "status" => 2,
                                "ewaybill_cancel_by" => get_staff_user_id(),
                                "ewaybill_cancel_irn" => $einvoice_irn,
                                "ewaybill_cancel_date" => $cancel_date,
                                "ewaybill_cancel_remark" => $cancel_remarks
                            );
                            $ewayBiIl_id = value_by_id_empty("tblinvoices", $invoice_id, "ewayBiIl_id");

                            /* update waybill details in system */
                            $this->home_model->update("tblwaybill", $up_data, array("id" => $ewayBiIl_id));

                            /* update details in invoice */
                            $invoicedata = array(
                                "ewayBiIl_id" => 0,
                                "ewaybill_cancel_by" => get_staff_user_id()
                            );
                            $this->home_model->update("tblinvoices", $invoicedata, array("id" => $invoice_id));
                        }    
                        
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


    /* this function use for finde distance between pincodes */
    public function get_distance_by_pincode($pincode_1,$pincode_2){

        if (!empty($pincode_1) && !empty($pincode_2)){

            /* call this function for generate token */
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

    /* this function use for generate token */
    public function generate_access_token(){
        return E_INVOICE_ACCESS_TOKEN;
        /*$response = $this->callAPI();
        
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
        }*/    
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
    }
}
