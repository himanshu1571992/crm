<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Purchase_entry extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('home_model');
    }

    /* this function list purchase entry */
    public function index(){
        check_permission(353,'create');
        $data['title'] = 'Purchase Entry';
        $where = "id > 0";
        if ($this->input->post()) {
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and invoice_date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            if (!empty($branch_id)){
                $data['branch_id'] = $branch_id;
                $where .= " and branch_id =".$branch_id."";
            }
        }else{
            $where .= " and year_id ='".  financial_year() ."' ";
        }
        $data['invoicelist'] = $this->db->query("SELECT * FROM `tblpurchaseentry` WHERE ".$where." ORDER BY id DESC ")->result();
        $data["companybranch_list"] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
        $this->load->view('admin/purchase_entry/list', $data);
    }

    /* this function use for add purchase entry */
    public function add_purchase_entry($id = ''){
        
        if ($this->input->post()) {
            extract($this->input->post());

            $data = array(
                    "name" => $name,
                    "staff_id" => get_staff_user_id(),
                    "branch_id" => $branch_id,
                    "gst_number" => $gst_number,
                    "invoice_number" => $invoice_number,
                    "invoice_date" => db_date($invoice_date),
                    "tax_type" => $tax_type,
                    "year_id" => financial_year(),
                    "basic_amount" => $basic_amount,
                    "totalamount" => $totalamount,
                    "total_tax" => $total_tax,
                    "status" => 1,
                    "remark" => (!empty($remark)) ? $remark : "",
                    "created_on" => date("Y-m-d H:i:s"),
                    "updated_on" => date("Y-m-d H:i:s")
                );
            if ($id == '') {
                $insert_id = $this->home_model->insert("tblpurchaseentry", $data);
                if ($insert_id) {
                    set_alert('success', "Purchase Entry add successfully");
                }else{
                    set_alert('warning', "Something went wrong");
                }
            } else {
                unset($data["status"]);
                unset($data["staff_id"]);
                unset($data["created_on"]);
                $success = $this->home_model->update("tblpurchaseentry", $data, array("id" => $id));
                if ($success) {
                    set_alert('success', "Purchase Entry update successfully");
                }
            }
            redirect(admin_url('purchase_entry'));
        }

        if ($id == '') {
            check_permission(353,'create');
            $data['title'] = 'Add Purchase Entry';
        } else {
            check_permission(353,'edit');
            $data['title'] = 'Edit Purchase Entry';
            $data['purchaseentry_info'] = $this->db->query("SELECT * FROM `tblpurchaseentry` WHERE id = ".$id." ORDER BY id DESC ")->row();
        }
        $data["companybranch_list"] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '', array('comp_branch_name', 'ASC'));
        $this->load->view('admin/purchase_entry/add', $data);
    }

    /* this function use for delete purchase entry*/
    public function delete_purchase_entry($id){
        check_permission(353,'delete');
        $response = $this->home_model->delete('tblpurchaseentry', array('id'=>$id));
        if ($response == true) {
            set_alert('success', "Purchase Entry deleted successfully");
        }
        redirect(admin_url('purchase_entry'));
    }

    /* this function use for purchase entry tax report */
    public function purchasetax_report(){
        check_permission(354,'view');
        $data["title"] = "Purchase Tax Report";
        $types = ["PI", "PE", "PDN"];
        $where = $iwhere = $dwhere = "in.id > 0";
        if (!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
               $data['fdate'] = $f_date;
               $data['tdate'] = $t_date;

               $where .= " and in.date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
               $iwhere .= " and in.invoice_date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
               $dwhere .= " and in.date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            if(!empty($type)){
                $data['type'] = $type;
                $types = $type;
            }

            if (!empty($branch_state)){
                $data['branch_state'] = $branch_state;
                $where .= " and cb.state IN (".implode(',', $branch_state).") ";
                $iwhere .= " and cb.state IN (".implode(',', $branch_state).") ";
                $dwhere .= " and cb.state IN (".implode(',', $branch_state).") ";
            }

//            if (!empty($client)){
//                $data['clientid'] = $client;
//                $where .= " and in.clientid IN (".implode(',', $client).") ";
//                $iwhere .= " and in.clientid IN (".implode(',', $client).") ";
//                $dwhere .= " and in.clientid IN (".implode(',', $client).") ";
//                $dpwhere .= " and in.clientid IN (".implode(',', $client).") ";
//            }

            if (!empty($gstr2b_month) && (!empty($year))){
                $data["gstr2b_month"] = $gstr2b_month;
                $data["year"] = $year;
            }
            if (!empty($gstr3b_month) && (!empty($year))){
                $data["gstr3b_month"] = $gstr3b_month;
                $data["year"] = $year;
            }
            if (!empty($tally_month) && (!empty($year))){
                $data["tally_month"] = $tally_month;
                $data["year"] = $year;
            }
        }
        else{
            $where .= " and YEAR(date) = '".date('Y')."' AND MONTH(date) = '".date('m')."' ";
            $iwhere .= " and YEAR(in.invoice_date) = '".date('Y')."' AND MONTH(in.invoice_date) = '".date('m')."' ";
            $dwhere .= " and YEAR(date) = '".date('Y')."' AND MONTH(date) = '".date('m')."' ";
        }

        $data['purchasetax_report'] = array();

        $data["total_taxable_value"] = $data["totalsgst"] = $data["totalcgst"] = $data["totaligst"] = $data["total_amt"] = 0;
        /* this is for get invoice data */
        $invoice_data = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchaseinvoice` as `in` LEFT JOIN `tblcompanybranch` as `cb` ON `in`.`billing_branch_id` = `cb`.`id` WHERE ".$where." ORDER BY in.id DESC ")->result();
        if (!empty($invoice_data)){
            foreach ($invoice_data as $value) {

                $vendor_info = $this->db->query("SELECT `name`,`gst_no` from `tblvendor` where id = '".$value->vendor_id."'  ")->row();
                $taxable_value = ($value->totalamount-$value->total_tax);

                $tax = ($value->total_tax/2);
                $sgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst = ($value->tax_type == 1) ? 0.00 : $value->total_tax;

                $tally = $gstr2b = $gstr3b = "--";
                $vtally = $vgstr2b = $vgstr3b = "--";
                $clienttaxstatus = $this->db->query("SELECT `year`,`month`,`gst_typ`,`approve_status` FROM `tblclienttaxstatus` as ct JOIN `tblclienttaxstatusdetails` as ctd ON `ct`.`id` = `ctd`.`main_id` WHERE `ct`.`type` = 2 AND `ctd`.`tabel_type` = 5 AND `ctd`.`document_id` = ".$value->id."")->result();
                if (!empty($clienttaxstatus)){
                    foreach ($clienttaxstatus as $val) {

                        $status = ($val->approve_status == 1) ? "text-success" : "text-warning";
                        $gsttyp_arr = explode(",", $val->gst_typ);
                        if (in_array(3, $gsttyp_arr)){
                            $vtally = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $tally = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(1, $gsttyp_arr)){
                            $vgstr2b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr2b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(2, $gsttyp_arr)){
                            $vgstr3b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr3b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                    }
                }

                $purchasetax_report = array(
                    "id" => $value->id,
                    "branch_state_id" => $value->branch_state,
                    "branch_gst_no" => $value->branch_gst_no,
                    "type" => "Purchase Invoice",
                    "rtype" => 5,
                    "vendor_id" => $value->vendor_id,
                    "vendor_name" => $vendor_info->name,
                    "vendor_gst_number" => $vendor_info->gst_no,
                    "invoice_number" => "Inv-".str_pad($value->id, 4, '0', STR_PAD_LEFT),
                    "invoice_date" => _d($value->date),
                    "total_invoice_value" => $value->totalamount,
                    "total_taxable_value" => $taxable_value,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "igst" => $igst,
                    "crm" => date("M-Y", strtotime($value->date)),
                    "gstr2b" => $gstr2b,
                    "gstr3b" => $gstr3b,
                    "tally" => $tally,
                );


                $see = (in_array("PI", $types)) ? "Yes": "No";

                /* this function use for filter record according to gst */
                $view = $this->gstReportFilter($see, $vgstr2b, $vgstr3b, $vtally);
                if ($view === "Yes"){
                    $data["total_taxable_value"] += $taxable_value;
                    $data["totalsgst"] += $sgst;
                    $data["totalcgst"] += $cgst;
                    $data["totaligst"] += $igst;
                    $data["total_amt"] += $value->totalamount;
                    $data['purchasetax_report'][] = $purchasetax_report;
                }
            }
        }

        /* this is for get purchaseentry data */
        $purchaseentry_data = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchaseentry` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE ".$iwhere." ORDER BY in.id DESC ")->result();
        if (!empty($purchaseentry_data)){
            foreach ($purchaseentry_data as $value) {

                $taxable_value = ($value->totalamount-$value->total_tax);
                $tax_type = $value->tax_type;

                $tax = ($value->total_tax/2);
                $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst = ($tax_type == 1) ? 0.00 : $value->total_tax;

                $tally = $gstr2b = $gstr3b = "--";
                $vtally = $vgstr2b = $vgstr3b = "--";
                $clienttaxstatus = $this->db->query("SELECT `year`,`month`,`gst_typ`,`approve_status` FROM `tblclienttaxstatus` as ct JOIN `tblclienttaxstatusdetails` as ctd ON `ct`.`id` = `ctd`.`main_id` WHERE `ct`.`type` = 2 AND `ctd`.`tabel_type` = 6 AND `ctd`.`document_id` = ".$value->id."")->result();

                if (!empty($clienttaxstatus)){
                    foreach ($clienttaxstatus as $val) {
                        $status = ($val->approve_status == 1) ? "text-success" : "text-warning";
                        $gsttyp_arr = explode(",", $val->gst_typ);
                        if (in_array(3, $gsttyp_arr)){
                            $vtally = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $tally = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(1, $gsttyp_arr)){
                            $vgstr2b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr2b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(2, $gsttyp_arr)){
                            $vgstr3b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr3b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                    }
                }

                $purchasetax_report = array(
                    "id" => $value->id,
                    "branch_state_id" => $value->branch_state,
                    "branch_gst_no" => $value->branch_gst_no,
                    "type" => "Purchase Entry",
                    "rtype" => 6,
                    "vendor_id" => 0,
                    "vendor_name" => $value->name,
                    "vendor_gst_number" => $value->gst_number,
                    "invoice_number" => $value->invoice_number,
                    "invoice_date" => _d($value->invoice_date),
                    "total_invoice_value" => $value->totalamount,
                    "total_taxable_value" => $taxable_value,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "igst" => $igst,
                    "crm" => date("M-Y", strtotime($value->invoice_date)),
                    "gstr2b" => $gstr2b,
                    "gstr3b" => $gstr3b,
                    "tally" => $tally,
                );

                $see = (in_array("PE", $types)) ? "Yes": "No";

                /* this function use for filter record according to gst */
                $view = $this->gstReportFilter($see, $vgstr2b, $vgstr3b, $vtally);
                if ($view == "Yes"){
                    $data["total_taxable_value"] += $taxable_value;
                    $data["totalsgst"] += $sgst;
                    $data["totalcgst"] += $cgst;
                    $data["totaligst"] += $igst;
                    $data["total_amt"] += $value->totalamount;
                    $data['purchasetax_report'][] = $purchasetax_report;
                }
            }
        }

        /* this is for get purchase dabit note data */
        $purchasedabitnote_data = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchasedabitnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE ".$dwhere." ORDER BY in.id DESC ")->result();
        if (!empty($purchasedabitnote_data)){
            foreach ($purchasedabitnote_data as $value) {
                $vendor_info = $this->db->query("SELECT `name`,`gst_no` from `tblvendor` where id = '".$value->vender_id."'  ")->row();
                $taxable_value = ($value->totalamount-$value->total_tax);
//                $tax_type = get_client_gst_type($value->clientid);
                $tax_type = $value->tax_type;
                $tax = ($value->total_tax/2);
                $sgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst = ($value->tax_type == 1) ? 0.00 : $value->total_tax;

                $tally = $gstr2b = $gstr3b = "--";
                $vtally = $vgstr2b = $vgstr3b = "--";
                $clienttaxstatus = $this->db->query("SELECT `year`,`month`,`gst_typ`,`approve_status` FROM `tblclienttaxstatus` as ct JOIN `tblclienttaxstatusdetails` as ctd ON `ct`.`id` = `ctd`.`main_id` WHERE `ct`.`type` = 2 AND `ctd`.`tabel_type` = 7 AND `ctd`.`document_id` = ".$value->id."")->result();

                if (!empty($clienttaxstatus)){
                    foreach ($clienttaxstatus as $val) {
                        $status = ($val->approve_status == 1) ? "text-success" : "text-warning";
                        $gsttyp_arr = explode(",", $val->gst_typ);
                        if (in_array(3, $gsttyp_arr)){
                            $vtally = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $tally = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(1, $gsttyp_arr)){
                            $vgstr2b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr2b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(2, $gsttyp_arr)){
                            $vgstr3b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr3b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                    }
                }

                $purchasetax_report = array(
                    "id" => $value->id,
                    "branch_state_id" => $value->branch_state,
                    "branch_gst_no" => $value->branch_gst_no,
                    "type" => "Purchase Debit Note",
                    "rtype" => 7,
                    "vendor_id" => $value->vender_id,
                    "vendor_name" => $vendor_info->name,
                    "vendor_gst_number" => $vendor_info->gst_no,
                    "invoice_number" => "PDN-".str_pad($value->id, 4, '0', STR_PAD_LEFT),
                    "invoice_date" => _d($value->date),
                    "total_invoice_value" => $value->totalamount,
                    "total_taxable_value" => $taxable_value,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "igst" => $igst,
                    "crm" => date("M-Y", strtotime($value->date)),
                    "gstr2b" => $gstr2b,
                    "gstr3b" => $gstr3b,
                    "tally" => $tally,
                );

                $see = (in_array("PDN", $types)) ? "Yes": "No";
                /* this function use for filter record according to gst */
                $view = $this->gstReportFilter($see, $vgstr2b, $vgstr3b, $vtally);

                if ($view == "Yes"){
                    $data["total_taxable_value"] -= $taxable_value;
                    $data["totalsgst"] -= $sgst;
                    $data["totalcgst"] -= $cgst;
                    $data["totaligst"] -= $igst;
                    $data["total_amt"] -= $value->totalamount;
                    $data['purchasetax_report'][] = $purchasetax_report;
                }
            }
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
                $i++;
                $stafff[$i]['id']=$singlestaff['id'];
                $stafff[$i]['name']=$singlestaff['name'];
                $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
                $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        $state_data = $this->db->query("SELECT GROUP_CONCAT(state) as stateids FROM  tblcompanybranch WHERE status = 1")->row();
        $state_ids = (!empty($state_data) && !empty($state_data->stateids)) ? $state_data->stateids : 0;
        $data["state_list"] = $this->db->query("SELECT * FROM tblstates WHERE id IN (".$state_ids.") and status = 1 ORDER BY name ASC")->result();
//        $data["client_list"] = $this->home_model->get_result('tblclientbranch', array('active'=>1), '');
        $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        $this->load->view('admin/purchase_entry/purchasetax_report', $data);
    }

    public function gstReportFilter($see, $vgstr2b, $vgstr3b, $vtally){
        extract($this->input->post());
        $view = $see;
        $gstr2b_date = $gstr3b_date = $tally_date = array();
        if ($see == "Yes" && (!empty($year)) && (!empty($gstr2b_month) OR !empty($gstr3b_month) OR !empty($tally_month))){

            if (!empty($gstr2b_month)){
                foreach ($gstr2b_month as $gstr2bd) {
                    $dmonth = date("M-Y", strtotime($year."-".$gstr2bd."-01"));
                    array_push($gstr2b_date, $dmonth);
                }
            }
            if (!empty($gstr3b_month)){
                foreach ($gstr3b_month as $gstr3bd) {
                    $dmonth = date("M-Y", strtotime($year."-".$gstr3bd."-01"));
                    array_push($gstr3b_date, $dmonth);
                }
            }
            if (!empty($tally_month)){
                foreach ($tally_month as $tallyd) {
                    $dmonth = date("M-Y", strtotime($year."-".$tallyd."-01"));
                    array_push($tally_date, $dmonth);
                }
            }

            if (!empty($gstr2b_month) && !empty($gstr3b_month) && !empty($tally_month)){
                if(in_array("notset", $gstr2b_month) && in_array("notset", $gstr3b_month) && in_array("notset", $tally_month)){
                    $view = ($vgstr2b == "--" && $vgstr3b == "--" && $vtally == "--") ? "Yes" : "No";
                }elseif (!empty($gstr2b_month) && !empty($gstr3b_month) && !empty($tally_month)) {
                    if ($vgstr2b != "--" && $vgstr3b != "--" && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr2b, $gstr2b_date) && in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }elseif ($vgstr2b != "--" && in_array("notset", $gstr3b_month) && $vtally != "--"){
                        $view = (in_array($vgstr2b, $gstr2b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr2b_month) && $vgstr3b != "--" && $vtally != "--"){
                        $view = (in_array($vgstr3b, $gstr3b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr2b_month) && $vgstr3b != "--" && $vtally != "--"){
                        $view = (in_array($vgstr3b, $gstr3b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif($vgstr2b != "--" && in_array("notset", $gstr3b_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr2b, $gstr2b_date) && $vgstr3b == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif($vgstr3b != "--" && in_array("notset", $gstr2b_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr3b, $gstr3b_date) && $vgstr2b == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif(in_array("notset", $gstr2b_month) && in_array("notset", $gstr3b_month) && $vtally != "--"){
                        $view = (in_array($vtally, $tally_date) && $vgstr2b == "--" && $vgstr3b == "--") ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }
            }else{
                if (!empty($gstr2b_month) && empty($gstr3b_month) && empty($tally_month)) {
                    if (in_array("notset", $gstr2b_month)){
                        $view = ($vgstr2b == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr2b_month) && $vgstr2b != "--"){
                        $view = (in_array($vgstr2b, $gstr2b_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (!empty($gstr3b_month) && empty($gstr2b_month) && empty($tally_month)) {
                    if (in_array("notset", $gstr3b_month)){
                        $view = ($vgstr3b == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr3b_month) && $vgstr3b != "--"){
                        $view = (in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (empty($gstr3b_month) && empty($gstr2b_month) && !empty($tally_month)) {
                    if (in_array("notset", $tally_month)){
                        $view = ($vtally == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $tally_month) && $vtally != "--"){
                        $view = (in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (!empty($gstr2b_month) && !empty($gstr3b_month) && empty($tally_month)) {
                    echo "po";
                    if (in_array("notset", $gstr2b_month) && in_array("notset", $gstr3b_month)){
                        $view = ($vgstr2b == "--" && $vgstr3b == "--") ? "Yes" : "No";
                    }elseif (!empty($gstr2b_month) && in_array("notset", $gstr3b_month)){
                        $view = (in_array($vgstr2b, $gstr2b_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr2b_month) && !empty($gstr3b_month)){
                        $view = ($vgstr2b == "--" && in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr2b_month) && in_array("notset", $gstr3b_month)){
                        $view = ($vgstr2b == "--" && $vgstr3b == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr2b_month) && !in_array("notset", $gstr3b_month)){
                        $view = (in_array($vgstr2b, $gstr2b_date) && in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (!empty($gstr2b_month) && empty($gstr3b_month) && !empty($tally_month)) {
                    if (in_array("notset", $gstr2b_month) && in_array("notset", $tally_month)){
                        $view = ($vgstr2b == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif (!empty($gstr2b_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr2b, $gstr2b_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr2b_month) && !empty($tally_month)){
                        $view = (in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr2b_month) && !in_array("notset", $tally_month)){
                        $view = (in_array($vgstr2b, $gstr2b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (empty($gstr2b_month) && !empty($gstr3b_month) && !empty($tally_month)) {
                    if (in_array("notset", $gstr3b_month) && in_array("notset", $tally_month)){
                        $view = ($vgstr3b == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif (!empty($gstr3b_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr3b_month) && !empty($tally_month)){
                        $view = (in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr3b_month) && !in_array("notset", $tally_month)){
                        $view = (in_array($vgstr3b, $gstr3b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }
            }
        }
        return $view;
    }

    public function addVendortax(){
        if (!empty($_POST)){

            extract($this->input->post());
            $document_ids = explode(",", $document_id);
            $document_types = explode(",", $document_type);
            if (!empty($document_ids)){
                foreach ($gsttype as $gsttype_id) {
                    foreach ($document_ids as $key => $doc_id) {
                        $dtype = $document_types[$key];
                        $cdetails = $this->db->query("SELECT cd.main_id, ct.id, ct.gst_typ FROM `tblclienttaxstatusdetails` as cd LEFT JOIN `tblclienttaxstatus` as ct ON cd.main_id = ct.id WHERE ct.gst_typ IN (" . $gsttype_id . ") AND cd.tabel_type = '" . $dtype . "' AND cd.document_id = " . $doc_id . "")->row();

                        if (!empty($cdetails)) {
                            $gst_arr = explode(",", $cdetails->gst_typ);
                            if (count($gst_arr) == 1){
                                $this->home_model->delete("tblclienttaxstatusdetails", array("main_id" => $cdetails->main_id));
                                $this->home_model->delete("tblclienttaxstatusapproval", array("clienttax_id" => $cdetails->main_id));
                                $this->home_model->delete("tblmasterapproval", array("module_id" => 28, "table_id" => $cdetails->main_id));
//                                $this->home_model->delete("tblclienttaxstatus", array("id" => $cdetails->main_id, "gst_typ IN" => "(".$gsttype_id.")"));
                                $this->db->where_in("gst_typ", array($gsttype_id));
                                $this->db->delete("tblclienttaxstatus");
                            }else{
                                $gsttype_val = array_values(array_diff($gst_arr, array($gsttype_id)));
                                $this->home_model->update("tblclienttaxstatus", array("gst_typ" => implode(",", $gsttype_val)), array("id" => $cdetails->main_id));
                            }

                        }
                    }
                }

            }

            $staff_id = array();
            foreach ($assignid as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
                if (strpos($single_staff, 'group') !== false) {
                    $single_staff = str_replace("group", "", $single_staff);
                    $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                    foreach ($staffgroup as $singlestaff) {
                        $staff_id[] = $singlestaff['staff_id'];
                    }
                }
            }
            $staff_id = array_unique($staff_id);
            $gsttype = implode(",", $gsttype);

            $insertdata["gst_typ"] = $gsttype;
            $insertdata["year"] = $year;
            $insertdata["month"] = $month;
            $insertdata["type"] = 2;
            $insertdata["approve_status"] = 0;
            $insertdata["created_at"] = date("Y-m-d H:i:s");

            $insert_id = $this->home_model->insert("tblclienttaxstatus", $insertdata);
            if ($insert_id){
                $document_ids = explode(",", $document_id);
                $document_types = explode(",", $document_type);
                if (!empty($document_ids)){
                    foreach ($document_ids as $key => $doc_id) {
                        $dtype = $document_types[$key];

                        $details = array(
                            "main_id" => $insert_id,
                            "tabel_type" => $dtype,
                            "document_id" => $doc_id,
                        );

                        $this->home_model->insert("tblclienttaxstatusdetails", $details);
                    }
                }

                if(!empty($staff_id)){

                    foreach ($staff_id as $staffid) {
                        $sdata['staffid'] = $staffid;
                        $sdata['clienttax_id'] = $insert_id;
                        $sdata['status'] = '1';
                        $sdata['created_at'] = date("Y-m-d H:i:s");
                        $sdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblclienttaxstatusapproval', $sdata);

                        $adata = array(
                            'staff_id' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'module_id' => 28,
                            'table_id' => $insert_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description' => 'Purchase Tax Status approval assign you',
                            'link' => 'purchase_entry/purchasetaxstatus_approval/'.$insert_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);
                    }
                }

                set_alert('success', 'Purchase tax status add successfully');
                redirect(admin_url('purchase_entry/purchasetax_report'));
            }else{
                set_alert('warning', 'Somthing went wrong');
                redirect(admin_url('purchase_entry/purchasetax_report'));
            }
        }
    }

    /* this function use for purchase tax status approval */
    public function purchasetaxstatus_approval($id){

        if (!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),28,$id,1);
            update_masterapproval_all(28,$id,1);

            $ad_data = array(
                'approvereason' => $approval_remark,
                'approve_status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $update = $this->home_model->update('tblclienttaxstatusapproval', $ad_data,array('clienttax_id'=>$id,'staffid'=>get_staff_user_id()));
            if($update){

                $udata = array(
                    'approve_status' => 1,
                );
                $this->home_model->update('tblclienttaxstatus', $udata,array('id'=>$id));

                /* this is for delete old data */
                $this->home_model->delete("tblclienttaxstatusdetails", array("main_id" => $id));
                if ($details) {
                    foreach ($details as $value) {
                        if (isset($value["checked"])) {
                            $details = array(
                                "main_id" => $id,
                                "tabel_type" => $value['document_type'],
                                "document_id" => $value['document_id'],
                            );

                            $this->home_model->insert("tblclienttaxstatusdetails", $details);
                        }
                    }
                }
                set_alert('success', 'Purchase tax status approved succcessfully');
                redirect(admin_url('approval/notifications'));
            }else{
                set_alert('warning', 'Somthing went wrong');
                redirect(admin_url('approval/notifications'));
            }
        }
        $data["title"] = "Purchase Tax Status Approval";
        $data["purchasetax_info"] = $this->db->query("SELECT * FROM `tblclienttaxstatus` WHERE `id` = ".$id."")->row();
        $data["purchasetax_details"] = $this->db->query("SELECT * FROM `tblclienttaxstatusdetails` WHERE `main_id` = ".$id."")->result();
        $this->load->view('admin/purchase_entry/purchasetax_approval', $data);
    }

    /* this function use for GST Output Reconciliation */
    public function gst_output_reconciliation(){
        check_permission(355,'view');
        $data["title"] = "Purchase GST Output Reconciliation ";

        if ($_POST){
            extract($this->input->post());
            $data["from"] = $from;
            $data["to"] = $to;
        }
        $data["gst_output"] = array();
        $month_arr = array(4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3);
        foreach ($month_arr as $key => $month) {
            $year_id = financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $year = ($month < 4) ? date("Y", strtotime($from_date))+1 : date("Y", strtotime($from_date));

            $gstr2b = $this->gatClientTax(1, $year_id, $year, $month);
            $gstr3b = $this->gatClientTax(2, $year_id, $year, $month);
            $tally = $this->gatClientTax(3, $year_id, $year, $month);
            $crm = $this->getCRMTax($year_id, $year, $month);
            $data["gst_output"][] = array(
                "month" => $year."-".$month,
                "gstr2b" => $gstr2b,
                "gstr3b" => $gstr3b,
                "tally" => $tally,
                "crm" => $crm
            );
        }

        $this->load->view('admin/purchase_entry/gstoutput_report', $data);
    }

    public function gatClientTax($gst_type, $year_id, $year, $month){
        $cgst = $igst = $sgst = 0.00;
        $clienttax = $this->db->query("SELECT `id` FROM `tblclienttaxstatus` WHERE `type` = 2 AND `gst_typ` = ".$gst_type." AND `year` = ".$year." AND month = ".$month." AND `approve_status` = 1")->result();
        if (!empty($clienttax)){
            foreach ($clienttax as $val) {
                $clienttaxdetails = $this->db->query("SELECT `document_id`,`tabel_type` FROM `tblclienttaxstatusdetails` WHERE `main_id` = ".$val->id."")->result();

                if(!empty($clienttaxdetails)){
                    foreach ($clienttaxdetails as $cval) {
                        switch ($cval->tabel_type) {
                            case 5:
                                $invoice = $this->getInvoicetax("tblpurchaseinvoice",$cval->document_id, $year_id, $year, $month);
                                $cgst += $invoice["cgst"];
                                $igst += $invoice["igst"];
                                $sgst += $invoice["sgst"];
                                break;
                            case 6:
                                $invoice = $this->getInvoicetax("tblpurchaseentry",$cval->document_id, $year_id, $year, $month);
                                $cgst += $invoice["cgst"];
                                $igst += $invoice["igst"];
                                $sgst += $invoice["sgst"];
                                break;
                            case 7:
                                $invoice = $this->getInvoicetax("tblpurchasedabitnote",$cval->document_id, $year_id, $year, $month);
                                $cgst -= $invoice["cgst"];
                                $igst -= $invoice["igst"];
                                $sgst -= $invoice["sgst"];
                        }
                    }
                }
            }
        }
        return array("cgst" => number_format(round($cgst), 2, '.', ''), "igst" => number_format(round($igst), 2, '.', ''), "sgst" => number_format(round($sgst), 2, '.', ''));
    }

    public function getCRMTax($year_id, $year, $month){
        $cgst = $igst = $sgst = 0.00;
        $invoice = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE `year_id`=" . $year_id . " AND YEAR(date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
        if($invoice){
            foreach ($invoice as $value) {
                $tax_type = $value->tax_type;

                $tax = ($value->total_tax/2);
                $sgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst += ($tax_type == 1) ? 0.00 : $value->total_tax;

            }
        }

        $purchaseentry = $this->db->query("SELECT * FROM `tblpurchaseentry` WHERE `year_id`=" . $year_id . " AND YEAR(invoice_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(invoice_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
        if($purchaseentry){
            foreach ($purchaseentry as $value) {
                $tax_type = $value->tax_type;

                $tax = ($value->total_tax/2);
                $sgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst += ($tax_type == 1) ? 0.00 : $value->total_tax;

            }
        }
        $debitnote = $this->db->query("SELECT * FROM `tblpurchasedabitnote` WHERE `year_id`=" . $year_id . " AND YEAR(date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
        if($debitnote){
            foreach ($debitnote as $value) {
                $tax_type = $value->tax_type;

                $tax = ($value->total_tax/2);
                $sgst -= ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst -= ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst -= ($tax_type == 1) ? 0.00 : $value->total_tax;

            }
        }
        return array("cgst" => number_format(round($cgst), 2, '.', ''), "igst" => number_format(round($igst), 2, '.', ''), "sgst" => number_format(round($sgst), 2, '.', ''));
    }

    public function getInvoicetax($table_name, $document_id, $year_id, $year, $month){
        $result = $this->db->query("SELECT * FROM `".$table_name."` WHERE `id`=" . $document_id . " ")->row();
        if ($result){
            $tax_type = $result->tax_type;

            $tax = ($result->total_tax/2);
            $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $igst = ($tax_type == 1) ? 0.00 : $result->total_tax;
            return array("cgst" => $cgst, "igst" => $igst, "sgst" => $sgst);
        }
    }

    /* this function use for get tax details */
    public function gsttaxdetails(){

        $data["title"] = "Purchase GST Tax Details";
        $data["invoice_data"] = $data['purchaseentry_data'] = $data['purchasedebitnote_data'] = array();
        if (!empty($_GET)){
            extract($this->input->get());

            if($gsttype !="" && $month != ""){
                $month_year = explode("-", $month);
                $year = $month_year[0];
                $month = $month_year[1];

                if ($gsttype != 4){
                    $clienttax = $this->db->query("SELECT `id` FROM `tblclienttaxstatus` WHERE type = 2 AND `gst_typ` = ".$gsttype." AND `year` = ".$year." AND month = ".$month." AND `approve_status` = 1")->result();
                    if ($clienttax){
                        foreach ($clienttax as $val) {
                            $clienttaxdetails = $this->db->query("SELECT `document_id`,`tabel_type` FROM `tblclienttaxstatusdetails` WHERE `main_id` = ".$val->id."")->result();
                            if (!empty($clienttaxdetails)){
                                foreach ($clienttaxdetails as $details){
                                    switch ($details->tabel_type) {
                                        case 5:
                                            $data['invoice_data'][] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchaseinvoice` as `in` LEFT JOIN `tblcompanybranch` as `cb` ON `in`.`billing_branch_id` = `cb`.`id` WHERE in.id = ".$details->document_id." ORDER BY in.id DESC ")->row();
                                            break;
                                        case 6:
                                            $data['purchaseentry_data'][] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchaseentry` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE in.id = ".$details->document_id." ORDER BY in.id DESC ")->row();
                                            break;
                                        case 7:
                                            $data['purchasedebitnote_data'][] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchasedabitnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE in.id = ".$details->document_id." ORDER BY in.id DESC ")->row();
                                            break;
                                    }
                                }
                            }
                        }
                    }

                }else{
                    $data['invoice_data'] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchaseinvoice` as `in` LEFT JOIN `tblcompanybranch` as `cb` ON `in`.`billing_branch_id` = `cb`.`id` WHERE  YEAR(in.date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(in.date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "' ORDER BY in.id DESC ")->result();
                    $data['purchaseentry_data'] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchaseentry` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE YEAR(in.invoice_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(in.invoice_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "' ORDER BY in.id DESC ")->result();
                    $data['purchasedebitnote_data'] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblpurchasedabitnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE YEAR(in.date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(in.date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "' ORDER BY in.id DESC ")->result();
                }

            }
        }

        $this->load->view('admin/purchase_entry/gsttax_details', $data);

    }
}
