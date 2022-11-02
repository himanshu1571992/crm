<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Purchase extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_model');
        $this->load->model('home_model');
    }

    /* Get all estimates in case user go on index page */

    public function index() {

        check_permission(40,'view');

    	//$where = " staff_id = '".get_staff_user_id()."' ";
        if(is_admin() == 1){
            $where = " po.show_list  = '1' ";
            $where1 = " po.show_list  = '1' ";
        }else{
            $where = " po.show_list  = '1' and (po.staff_id = '".get_staff_user_id()."' OR FIND_IN_SET('".get_staff_user_id()."', `assignid`) OR `billing_branch_id` = '".  get_login_branch()."' )";
            $where1 = " po.show_list  = '1' and (po.staff_id = '".get_staff_user_id()."' OR FIND_IN_SET('".get_staff_user_id()."', `assignid`) OR `billing_branch_id` = '".  get_login_branch()."' )";
        }

        $data["section"] = "purchase_order";
    	if(!empty($_POST)){
       		extract($this->input->post());

                if (isset($section)){
                    $data["section"] = $section;
                }

                if($vendor_id != ''){
                    $data['vendor_id'] = $vendor_id;
                    if ($section == "purchase_order") {
                        $where .= " and po.vendor_id = '".$vendor_id."'";
                    }else{
                        $where1 .= " and po.vendor_id = '".$vendor_id."'";
                    }
                }
                if($po_for != ''){
                    $data['po_for'] = $po_for;
                    if ($section == "purchase_order") {
                        $where .= " and po.po_for = '".$po_for."'";
                    }else{
                        $where1 .= " and po.po_for = '".$po_for."'";
                    }
                }

                if ($status != '') {
                    $data['s_status'] = $status;
                    if ($status == 3) {

                        if ($section == "purchase_order") {
                            $where .= " and po.cancel = 1";
                        }else{
                            $where1 .= " and po.cancel = 1";
                        }
                    } else {

                        if ($section == "purchase_order") {
                            $where .= " and po.status = '" . $status . "' and po.cancel = 0";
                        }else{
                            $where1 .= " and po.status = '" . $status . "' and po.cancel = 0";
                        }
                    }
                }
                if($mr_status != '' && strlen($mr_status) > 0){
                    $data['mtr_status'] = $mr_status;
                    if ($section == "purchase_order") {
                        $where .= " and po.complete = '".$mr_status."'";
                    }else{
                        $where1 .= " and po.complete = '".$mr_status."'";
                    }
                }

                if($invoice_status != ''){
                    $data['invoice_status'] = $invoice_status;
                    if ($section == "purchase_order") {
                        $where .= " and po.invoice_status = '".$invoice_status."'";
                    }else{
                        $where1 .= " and po.invoice_status = '".$invoice_status."'";
                    }
                }

                if($product_id != ''){
                    $data['product_id'] = $product_id;
                    if ($section == "purchase_order") {
                        $where .= " and pp.product_id = '".$product_id."'";
                    }else{
                        $where1 .= " and pp.product_id = '".$product_id."'";
                    }
                }

       		if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));


                if ($section == "purchase_order") {
                    $where .= " and po.date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
                }else{
                    $where1 .= " and po.date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
                }
           }

           if(!empty($payment_percent)){
                $data['payment_percent'] = $payment_percent;
           }

    	}else{
            $where .= " and po.year_id = '".financial_year()."'";
            $where .= " and (po.status = 0 || po.status = 1 || po.status = 4 || po.status = 5) and po.cancel = 0";
            $where1 .= " and po.year_id = '".financial_year()."'";
            $where1 .= " and (po.status = 0 || po.status = 1 || po.status = 4 || po.status = 5) and po.cancel = 0";
        }
//        echo"<pre>";
//                print_r($data);exit;

    	$data['purchaseorder_list'] = $this->db->query("SELECT po.* from tblpurchaseorder as po LEFT JOIN tblpurchaseorderproduct as pp ON po.id = pp.po_id where order_type = '1' and ".$where." GROUP by po.id order by po.id desc ")->result();
    	$data['workorder_list'] = $this->db->query("SELECT po.* from tblpurchaseorder as po LEFT JOIN tblpurchaseorderproduct as pp ON po.id = pp.po_id where order_type = '2' and ".$where1." GROUP by po.id order by po.id desc ")->result();

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ORDER BY name ASC ")->result_array();
        $data['product_info'] = $this->db->query("SELECT * from tblproducts where status = 1 ORDER BY name ASC")->result_array();
        $data['branch_info'] = $this->db->query("SELECT `id`,`comp_branch_name` from `tblcompanybranch` where status = 1 ORDER BY comp_branch_name ASC ")->result();

    	$data['title'] = 'Purchase Order List (SEPL/PUR/06)';
        $this->load->view('admin/purchase/view', $data);
    }



    public function pending_purchaseorder() {
        check_permission(41,'view');
    	$where = " pa.staff_id = '".get_staff_user_id()."' and pa.approve_status = 0 and ma.module_id = 3 and ma.status = 0";

    	if(!empty($_POST)){
       		extract($this->input->post());

       		if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

                $where .= " and p.date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
    	}

    	//$data['purchaseorder_list'] = $this->db->query("SELECT p.* from tblpurchaseorder as p LEFT JOIN tblpurchaseorderapproval as pa ON p.id = pa.po_id where ".$where." group by p.id ORDER BY p.id desc  ")->result();
        $data['purchaseorder_list'] = $this->db->query("SELECT p.* from tblpurchaseorder as p LEFT JOIN tblpurchaseorderapproval as pa ON p.id = pa.po_id LEFT JOIN tblmasterapproval as ma ON p.id = ma.table_id  where ".$where." group by p.id ORDER BY p.id desc  ")->result();


    	$data['title'] = 'Pending Purchase order';
        $this->load->view('admin/purchase/pending', $data);
    }



    public function purchase_order($id = '') {
        check_permission(40,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            $termsconditiondata = $proposal_data["terms"];
            unset($proposal_data["terms"]);
           /* echo '<pre/>';
            print_r($proposal_data);
            die;*/
            if ($id == '') {
                $proposal_data['number'] = po_next_number();
                $id = $this->Purchase_model->add($proposal_data);

                if ($id) {

                    $this->home_model->update('tblpurchaseorder', array('parent_ids'=>$id),array('id'=>$id));

                    //Update final Amt
                    update_po_final_amount($id);

                    /* this is use for add custom terms and condition */
                    $this->load->model('proposals_model');
                    $this->proposals_model->addCustomTermsAndCondition($id, "purchase_order", $termsconditiondata, 'tblpurchaseorder');

                    /* this is for multi attachments upload */
                    handle_multi_handover_attachments($id,'purchase_order');

                    set_alert('success', _l('added_successfully', 'purchase order'));
                    
                    if (isset($proposal_data['req_id']) && !empty($proposal_data['req_id'])){
                        redirect(admin_url('requirement/requirement_details/'.$proposal_data['req_id']));
                    }else{
                        redirect(admin_url('purchase/'));
                    }
                }
            } else {
                check_permission(40,'edit');
                $success = $this->Purchase_model->update($proposal_data, $id);
                // exit;
                if ($success) {
                    //Update final Amt
                    update_po_final_amount($id);

                    /* this is use for add custom terms and condition */
                    $this->load->model('proposals_model');
                    
                    $this->proposals_model->addCustomTermsAndCondition($id, "purchase_order", $termsconditiondata, 'tblpurchaseorder');

                    /* this is for multi attachments upload */
                    $files_list = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_id`='".$id."' AND `rel_type`='purchase_order' ")->result();
                    if (!empty($files_list)){
                        foreach ($files_list as $key => $file) {
                            $response = $this->home_model->delete('tblfiles', array('id' => $file->id, 'rel_type' => 'purchase_order'));
                            if ($response){
                                $upath = get_upload_path_by_type('purchase_order') . $id . '/'.$file->file_name;
                                unlink($upath);
                            }
                        }
                    }
                    handle_multi_handover_attachments($id,'purchase_order');

                    set_alert('success', _l('updated_successfully', 'purchase order'));
                    redirect(admin_url('purchase/'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Purchase Order';
        } else {
        	 $title = 'Edit Purchase Order';
            $data['purchase_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$id."' ")->row_array();
            $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where po_id = '".$id."' ")->result_array();
            $data['purchase_othercharges'] = $this->db->query("SELECT * from tblpurchaseothercharges where proposalid = '".$id."' ")->result_array();

            $data['staffassigndata'] = explode(',', $data['purchase_info']['assignid']);
        }

        $default_settings = $this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
        $data['default_setting_field'] = array_column($default_settings, 'default_setting_field');
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        /*$this->load->model('invoice_items_model');
        $data['ajaxItems'] = false;
        if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items'] = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();*/

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        /*$data['currencies'] = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();*/
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();

        //$data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
//        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1")->result_array();
        // Getting Main products and Temp Products In Single Array
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 ORDER BY product_name ASC ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=>$r['sub_name'],'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }

        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = $title;
        /*$compbranchid = $this->session->userdata('staff_user_id'); //exit;
        $compnybranch_warehouse = $this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='" . $compbranchid . "'")->row_array();
        $warehouseid = explode(',', $compnybranch_warehouse['warehouse_id']);
        foreach ($warehouseid as $singlewarehouseid) {
            $warehousedata[] = $this->db->query("SELECT * FROM `tblwarehouse` where id='" . $singlewarehouseid . "'")->row_array();
        }*/
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status= '1' ORDER BY name ASC ")->result_array();

        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();
        $this->load->model('Staffgroup_model');

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();

        $data['billing_branches'] = $this->db->query("SELECT * from tblcompanybranch where status = '1' ORDER BY id ASC")->result();
        $data['unit_list'] = $this->db->query("SELECT * from tblunitmaster where status = '1' ORDER BY name ASC")->result();
        $data['divisionmaster_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        

        $this->load->view('admin/purchase/purchase_order', $data);
    }



    public function purchaseorder_renewal($revised_id) {
        check_permission(40,'create');
        if ($this->input->post()) {
            extract($this->input->post());
            $proposal_data = $this->input->post();
            $termsconditiondata = $proposal_data["terms"];
            unset($proposal_data["terms"]);
            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/
            $id = $this->Purchase_model->add($proposal_data);
            if ($id) {
                
                /* this is use for add custom terms and condition */
                $this->load->model('proposals_model');
                $this->proposals_model->addCustomTermsAndCondition($id, "purchase_order", $termsconditiondata, 'tblpurchaseorder');

                $revised_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$revised_id."' ")->row();
                $last_parent = $revised_info->parent_ids;
                $new_parent = $last_parent.','.$id;
                $this->home_model->update('tblpurchaseorder', array('parent_ids'=>$new_parent,'revised_remark'=>$revised_remark,'complete'=>$revised_info->complete,'po_number'=>0),array('id'=>$id));
                $this->home_model->update('tblpurchaseorderpayments', array('po_id'=>$id),array('po_id'=>$revised_id));
                $this->home_model->update('tblmaterialreceipt', array('po_id'=>$id),array('po_id'=>$revised_id));
                $this->home_model->update('tblpurchaseinvoice', array('po_id'=>$id),array('po_id'=>$revised_id));
                $this->home_model->update('tblpurchaseorder', array('revised'=>1,'show_list'=>0),array('id'=>$revised_id));
                
                /* this is for purchase order file upload */
                handle_multi_handover_attachments($id,'purchase_order');

                set_alert('success', _l('added_successfully', 'purchase order'));
                redirect(admin_url('purchase/'));
            }
        }
        $title = 'Purchase Order Renewal';
        $data['purchase_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$revised_id."' ")->row_array();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where po_id = '".$revised_id."' ")->result_array();
        $data['purchase_othercharges'] = $this->db->query("SELECT * from tblpurchaseothercharges where proposalid = '".$revised_id."' ")->result_array();
        $data['revised_id'] = $revised_id;
        $data['staffassigndata'] = explode(',', $data['purchase_info']['assignid']);


        $default_settings = $this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
        $data['default_setting_field'] = array_column($default_settings, 'default_setting_field');
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');
        /*$data['ajaxItems'] = false;
        if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items'] = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();*/

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        /*$data['currencies'] = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();*/
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();

        //$data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();
        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = $title;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status= '1' ORDER BY name ASC ")->result_array();

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ORDER BY name ASC")->result_array();
        $this->load->model('Staffgroup_model');

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();

        $data['billing_branches'] = $this->db->query("SELECT * from tblcompanybranch where status = '1' ORDER BY comp_branch_name ASC ")->result();
        $data['unit_list'] = $this->db->query("SELECT * from tblunitmaster where status = '1' ORDER BY name ASC ")->result();
        $data['divisionmaster_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        $this->load->view('admin/purchase/purchaseorder_renewal', $data);
    }



     public function purchaseorder_details($id) {


    	if(!empty($_POST)){
       		extract($this->input->post());

            //    echo"<pre>";
            //    print_r($_POST);
            //    exit;
                if($submit == 2)
                {
                  $revised_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$id."' ")->row();
                if(!empty($revised_info->revised_id))
                {
                   $this->home_model->update('tblpurchaseorderpayments', array('po_id'=>$revised_info->revised_id),array('po_id'=>$id));
                   $this->home_model->update('tblmaterialreceipt', array('po_id'=>$revised_info->revised_id),array('po_id'=>$id));
                   $this->home_model->update('tblpurchaseinvoice', array('po_id'=>$revised_info->revised_id),array('po_id'=>$id));
                   $this->home_model->update('tblpurchaseorder', array('show_list'=>1),array('id'=>$revised_info->revised_id));
                }
                }

                if($submit == 4)
                {
                   $rec_data = array(
                        'show_list' => 1,
                        'status' => 4
                    );
                   $this->home_model->update('tblpurchaseorder', $rec_data,array('id'=>$id));
                }

                if($submit == 5)
                {
                   $po_status = array(
                       'show_list' => 1,
                        'status' => 5
                    );
                   $this->home_model->update('tblpurchaseorder', $po_status,array('id'=>$id));
                }


       		 $ad_data = array(
                        'approve_status' => $submit,
                        'remark' => $remark,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

            $update = $this->home_model->update('tblpurchaseorderapproval', $ad_data,array('po_id'=>$id,'staff_id'=>get_staff_user_id()));

            //Update master approval
             update_masterapproval_single(get_staff_user_id(),3,$id,$submit);

            //Getting Reject Info
             $approve_status = 0;
            $reject_info = $this->db->query("SELECT * FROM `tblpurchaseorderapproval` where po_id='".$id."' and approve_status = 2 ")->row_array();
            if(!empty($reject_info)){
                $approve_status = 2;
                $this->home_model->update('tblpurchaseorder', array('status'=>2),array('id'=>$id));
            }else{
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblpurchaseorderapproval` where po_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 2){
                    $approve_status = 1;
                    $this->home_model->update('tblpurchaseorder', array('status'=>1,'approval_date'=>date('Y-m-d')),array('id'=>$id));
                }
            }

            $approval_info = $this->db->query("SELECT * FROM `tblpurchaseorderapproval` where po_id='".$id."' and ( approve_status = 0 || approve_status = 2 ||  approve_status = 4 ||  approve_status = 5) ")->row_array();
            if(empty($approval_info)){
                $approve_status = 1;
            	$this->home_model->update('tblpurchaseorder', array('status'=>1,'approval_date'=>date('Y-m-d')),array('id'=>$id));
            }

            $reconciliation_info = $this->db->query("SELECT * FROM `tblpurchaseorderapproval` where po_id='".$id."' and approve_status = 4 ")->row_array();
            if(!empty($reconciliation_info)){
                $approve_status = 4;
            }

            $hold_info = $this->db->query("SELECT * FROM `tblpurchaseorderapproval` where po_id='".$id."' and approve_status = 5 ")->row_array();
            if(!empty($hold_info)){
                $approve_status = 5;
            }
            /*if($approve_status == 2){
                $purchaseorder_info = $this->db->query("SELECT * FROM `tblpurchaseorder` where id='".$id."' ")->row();
                if($purchaseorder_info->revised_id > 0){
                    $this->home_model->update('tblpurchaseorder', array('show_list'=>0),array('id'=>$id));
                    $this->home_model->update('tblpurchaseorder', array('show_list'=>1),array('id'=>$purchaseorder_info->revised_id));
                }
            }*/

            //Update master approval
            update_masterapproval_all(3,$id,$approve_status);

            if($update){
            	 set_alert('success', 'Purchase Order updated succesfully');
                 redirect(admin_url('purchase/pending_purchaseorder'));
            }
    	}

    	$data['id'] = $id;

        $data['purchase_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$id."' ")->row_array();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where po_id = '".$id."' ")->result_array();

        $data['staffassigndata'] = explode(',', $data['purchase_info']['assignid']);

         $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = 'Purchase Order Details';

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status='1'")->result_array();


        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ")->result_array();

         $data['appvoal_info'] = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();

        $data['divisionmaster_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        $data['ttlpaidamount'] = $this->db->query("SELECT SUM(approved_amount) as ttlamount from tblpurchaseorderpayments where po_id = '".$id."' and status = 1 ")->row()->ttlamount;
        $data['billing_branches'] = $this->db->query("SELECT * from tblcompanybranch where status = '1' ORDER BY id ASC")->result();
    	$data['title'] = 'Purchase Order Details';
        $this->load->view('admin/purchase/details', $data);
    }

    public function purchaseorder_view($id) {


    	$data['id'] = $id;

        $data['purchase_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$id."' ")->row_array();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where po_id = '".$id."' ")->result_array();

        $data['staffassigndata'] = explode(',', $data['purchase_info']['assignid']);

         $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = 'Purchase Order Details';

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status='1'")->result_array();


        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ")->result_array();

         $data['appvoal_info'] = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();


    	$data['title'] = 'Purchase Order Details';
        $this->load->view('admin/purchase/purchaseorder_view', $data);
    }


    public function getvendordtails() {
		$vendor_id=$this->input->post('vendor_id');
		$this->db->where('id', $vendor_id);
	    $clientdata= $this->db->get('tblvendor')->row();
		$clientdata= (array) $clientdata;

		$get_state_details=$this->db->query("SELECT * FROM `tblstates` WHERE `id`='".$clientdata['state_id']."'")->row_array();
		$get_city_details=$this->db->query("SELECT * FROM `tblcities` WHERE `id`='".$clientdata['city_id']."'")->row_array();
		echo json_encode(array('location'=>$clientdata['location'],'address'=>$clientdata['address'],'city_name'=>$get_city_details['name'],'pincode'=>$clientdata['pincode'],'state_name'=>$get_state_details['name'], 'product_term_condition'=> $clientdata['product_term_condition'], 'contact_number' => $clientdata['contact_number'], 'contact_person' => $clientdata['vendor_contact_person']));
    }

    public function getcompanydtails() {
		$branch_id=$this->input->post('branch_id');

		$branchdata=$this->db->query("SELECT * FROM `tblcompanybranch` WHERE `id`='".$branch_id."'")->row_array();
		echo json_encode(array('contact_person'=>$branchdata['contact_person'],'contact_number'=>$branchdata['phone_no_1'],'email_id'=>$branchdata['email_id']));
    }

    public function getwarehousedtails() {
		$warehouse_id=$this->input->post('warehouse_id');
		$this->db->where('id', $warehouse_id);
	    $clientdata= $this->db->get('tblwarehouse')->row();
		$clientdata= (array) $clientdata;

		$get_state_details=$this->db->query("SELECT * FROM `tblstates` WHERE `id`='".$clientdata['state']."'")->row_array();
		$get_city_details=$this->db->query("SELECT * FROM `tblcities` WHERE `id`='".$clientdata['city']."'")->row_array();
		echo json_encode(array('location'=>$clientdata['landmark'],'address'=>$clientdata['address'],'city_name'=>$get_city_details['name'],'pincode'=>$clientdata['pincode'],'state_name'=>$get_state_details['name']));
    }


    public function get_purchase_number() {

    	extract($this->input->post());

		//$po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `vendor_id`='".$vendor_id."' and status = 1 and complete = 0 and revised = 0")->result();
        $po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `vendor_id`='".$vendor_id."' and status = 1 and complete = 0 and show_list = 1")->result();
		$html = '<option value=""></option>';
		if(!empty($po_info)){

                    foreach ($po_info as $key => $value) {
                        $html .= '<option value="'.$value->id.'">'.$value->prefix.$value->number.' - '._d($value->date).'</option>';
                    }
		}
		echo $html;

    }


    public function getbillandshipping() {
		$po_id=$this->input->post('po_id');

		$po_info=$this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$po_id."'")->row_array();
		$vendor_id = $po_info['vendor_id'];
		$warehouse_id = $po_info['warehouse_id'];



		$vendor_info=$this->db->query("SELECT * FROM `tblvendor` WHERE `id`='".$vendor_id."'")->row_array();
		$warehouse_info=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$vendor_id."'")->row_array();

		$billing_state = value_by_id('tblstates',$vendor_info['state_id'],'name');
		$billing_city = value_by_id('tblcities',$vendor_info['city_id'],'name');

		$shipping_state = value_by_id('tblstates',$warehouse_info['state'],'name');
		$shipping_city = value_by_id('tblcities',$warehouse_info['city'],'name');

		echo json_encode(array('billing_name'=>$vendor_info['name'],'billing_street'=>$vendor_info['address'],'billing_state'=>$billing_state,'billing_city'=>$billing_city,'billing_zip'=>$vendor_info['pincode'],'shipping_name'=>$warehouse_info['name'],'shipping_street'=>$warehouse_info['address'],'shipping_state'=>$shipping_state,'shipping_city'=>$shipping_city,'shipping_zip'=>$warehouse_info['pincode']));

    }


    public function material_receipt() {

        check_permission(43,'create');

        $po_id = $this->uri->segment(4);
        if(!empty($po_id)){
            $data['po_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$po_id."'")->row();
            $data['vendor_id'] = $data['po_info']->vendor_id;
        }

    	if(!empty($_POST)){
            extract($this->input->post());
    		$post_data = $this->input->post();

    		/*echo '<pre/>';
    		print_r($post_data);
    		die;*/

            //Make PO as complete if quantity is match
            if(!empty($po_number)){
               if(!empty($product)){
                    $complete = 1;
                    foreach ($product as $p_id) {
                        $quantity = $_POST['product_'.$p_id];
                        $last_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` WHERE `po_id`='".$po_number."' and `product_id` = '".$p_id."'")->row()->ttl_qty;
                        $mr_qty = ($quantity + $last_qty);

                        $po_qty = $this->db->query("SELECT `qty` FROM `tblpurchaseorderproduct` WHERE `po_id`='".$po_number."' and `product_id` = '".$p_id."'")->row()->qty;

                        if($po_qty > $mr_qty){
                            $complete = 0;
                        }
                        $this->home_model->update('tblpurchaseorder', array('complete'=>$complete),array('id'=>$po_number));
                    }
                }
            }


            $id = $this->Purchase_model->add_mr($post_data);


            if(!empty($post_data['complete'])){
                $this->home_model->update('tblpurchaseorder', array('complete'=>1),array('id'=>$post_data['po_number']));
            }

            // If file upload form submitted
            $this->upload_mr_receipts($id);

            if ($id) {
                set_alert('success', _l('added_successfully', 'purchase order'));
                redirect(admin_url('purchase/receipt_list/'));
            }

    	}


        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='21'")->result_array();
        $i = 0;
        $stafff = [];
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

    	$data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();
        $data['unitlist'] = $this->db->query("SELECT * FROM tblunitmaster WHERE `status`='1' ORDER BY name ASC ")->result();
    	$data['title'] = 'Material Receipt';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/purchase/material_receipt', $data);
    }


    public function material_receipt_cash() {

        check_permission(43,'create');

        if(!empty($_POST)){
            extract($this->input->post());
            $post_data = $this->input->post();

            /*echo '<pre/>';
            print_r($post_data);
            die; */


           $id = $this->Purchase_model->add_mr_cash($post_data);


            // If file upload form submitted
            $this->upload_mr_receipts($id);

            if ($id) {
                set_alert('success', _l('added_successfully', 'purchase order'));
                redirect(admin_url('purchase/receipt_list/'));
            }

        }


        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='21'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();
        $data['product_data'] = $this->db->query("SELECT `id`,`name`,`sub_name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 ORDER BY name ASC ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status= '1' order by name asc ")->result_array();
        $data["staff_list"] = get_staff_list();

        $data['title'] = 'Material Receipt (Cash)';
        $this->load->view('admin/purchase/material_receipt_cash', $data);
    }


    public function material_receipt_gas() {

        check_permission(43,'create');

        if(!empty($_POST)){
            extract($this->input->post());
            $post_data = $this->input->post();

            /*echo '<pre/>';
            print_r($post_data);
            die;*/


           $id = $this->Purchase_model->add_mr_gas($post_data);


            // If file upload form submitted

            if(!empty($_FILES['files']['name'])){

                $filesCount = count($_FILES['files']['name']);
                for($i = 0; $i < $filesCount; $i++){
                    $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                    // File upload configuration

                    $config['upload_path'] = MR_IMAGES_FOLDER;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['encrypt_name'] = TRUE;

                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // Upload file to server
                    if($this->upload->do_upload('file')){
                        // Uploaded file data
                        $fileData = $this->upload->data();


                        $ad_data_1 = array(
                                    'mr_id' => $id,
                                    'file' => $fileData['file_name'],
                                    'created_at' => date('Y-m-d H:i:s')
                                );

                        $this->home_model->insert('tblmaterialreceiptfiles',$ad_data_1);
                    }
                }

            }

            if ($id) {
                set_alert('success', _l('added_successfully', 'purchase order'));
                redirect(admin_url('purchase/receipt_list/'));
            }

        }


        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='21'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc")->result_array();
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`sub_name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 order by name asc ")->result_array();
        $data['staff_list'] = get_staff_list();
        $data['title'] = 'Material Receipt (Gas)';
        $this->load->view('admin/purchase/material_receipt_gas', $data);
    }


    public function get_product_table() {
    	extract($this->input->post());


		$product_info=$this->db->query("SELECT * FROM `tblpurchaseorderproduct` WHERE `po_id`='".$po_id."'")->result();
		$purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$po_id."' ")->row();
        $unitlist = $this->db->query("SELECT * FROM tblunitmaster WHERE `status`='1' ")->result();
		/*echo '<pre/>';
		print_r($product_info);
		die;*/
    	?>
    	 <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">

<!--                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Purchase Order Products</h4>
                        </div>

						<hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" id="docAttachDivVideo" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Pro Name</td>
                                                <td >Pro ID</td>
                                                <td >Balance Qty</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($product_info)){
                                        	$i = 1;
                                        	foreach ($product_info as $key => $value) {

                                        		$qty_info = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` WHERE `po_id`='".$po_id."' and `product_id` = '".$value->product_id."'")->row();

                                        		$bal_qty = ($value->qty-$qty_info->ttl_qty);


                                                $vendorproduct_info = $this->db->query("SELECT * from tblvendorproductsname where vendor_id = '".$purchase_info->vendor_id."' and product_id = '".$value->product_id."' ")->row();

                                                $vendor_product_name = '--';
                                                if(!empty($vendorproduct_info)){
                                                    $vendor_product_name = $vendorproduct_info->product_name;
                                                }
                                                $product_name = value_by_id("tblproducts", $value->product_id, "sub_name");
                                        		?>
                                        		<tr>
	                                                <td><?php echo $i++;?></td>
	                                                <td><?php echo $product_name.' ('.$vendor_product_name.')';?></td>
	                                                <td><?php echo $value->pro_id;?></td>
	                                                <td><input class="form-control" type="text" id="product_<?php echo $value->product_id; ?>" readonly="" value="<?php echo $bal_qty; ?>"></td>
	                                            </tr>
                                        		<?php
                                        	}
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <!--<hr>-->
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Material Receipt</h4>
                        </div>
						<hr/>
                        <div class="col-md-12">
                            <div >
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Pro Name</td>
                                                <td>Pro ID</td>
                                                <td >Balance Qty</td>
                                                <td>Unit as per PO</td>
                                                <td>Qty Received as per PO <br><small>(Including Reject Qty)</small></td>
                                                <td>Qty Received in Nos</td>
                                                <td>Reject Qty</td>
                                                <td>Rejection Remark</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($product_info)){
                                        	$i = 1;
                                        	foreach ($product_info as $key => $value) {

                                        		$qty_info = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` WHERE `po_id`='".$po_id."' and `product_id` = '".$value->product_id."'")->row();

                                        		$bal_qty = ($value->qty-$qty_info->ttl_qty);

                                                $vendorproduct_info = $this->db->query("SELECT * from tblvendorproductsname where vendor_id = '".$purchase_info->vendor_id."' and product_id = '".$value->product_id."' ")->row();
                                                $vendor_product_name = '--';
                                                if(!empty($vendorproduct_info)){
                                                    $vendor_product_name = $vendorproduct_info->product_name;
                                                }
                                                $nosqty = ($value->unit_id == '9') ? $value->qty : '';
                                                $product_name = value_by_id("tblproducts", $value->product_id, "sub_name");
                                        		?>
                                        		<tr>
	                                                <td><?php echo $i;?></td>
	                                                <td><?php echo $product_name.' ('.$vendor_product_name.')';?></td>
	                                                <td><?php echo $value->pro_id;?></td>
                                                    <td><input class="form-control" type="text" id="product_<?php echo $i; ?>" readonly="" value="<?php echo $bal_qty; ?>"></td>
                                                    <td>
                                                        <select class="form-control selectpicker unitidcls unitid<?php echo $i; ?>" onchange="get_product_received_qty(this.value,<?php echo $i; ?>)" data-proid="<?php echo $value->product_id; ?>" style="display: inline-block !important;" data-live-search="true" id="unit_id_<?php echo $i; ?>" name="mr_products[<?php echo $i; ?>][unit_id]">
                                                            <option value=""></option>
                                                            <?php
                                                                if (isset($unitlist) && count($unitlist) > 0) {
                                                                    foreach ($unitlist as $uvalue) {
                                                                        $selected = ($value->unit_id == $uvalue->id) ? "selected" : "";
                                                                        echo '<option value="' . $uvalue->id . '" '.$selected.'>' . $uvalue->name . '</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
	                                                	<input type="text" class="form-control p_id proReceivedQty" rid="<?php echo $i; ?>" id="proqty<?php echo $i; ?>" value="" val="<?php echo $value->product_id; ?>" name="mr_products[<?php echo $i; ?>][received_qty]">
	                                                	<input type="hidden" value="<?php echo $value->product_id; ?>" name="product[]">
	                                                	<input type="hidden" value="<?php echo $value->product_id; ?>" name="mr_products[<?php echo $i; ?>][product_id]">
	                                                </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="qtyinnos<?php echo $i; ?>"  val="<?php echo $value->product_id; ?>" value="" name="mr_products[<?php echo $i; ?>][nosqty]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control p_id" val="<?php echo $value->product_id; ?>" name="mr_products[<?php echo $i; ?>][reject_qty]">
                                                    </td>
	                                                <td><input type="text" name="mr_products[<?php echo $i; ?>][remark]"></td>
	                                            </tr>
                                        		<?php
                                                $i++;
                                        	}
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    	<?php

	}



	public function receipt_list() {

        check_permission(43,'view');

    	//$where = " staff_id = '".get_staff_user_id()."' ";
        $where = " id > '0' ";

    	if(!empty($_POST)){
       		extract($this->input->post());

            if($vendor_id != ''){
                $data['vendor_id'] = $vendor_id;
                $where .= " and vendor_id = '".$vendor_id."'";
            }

       		if($status != ''){
       		    $data['s_status'] = $status;
       		    $where .= " and status = '".$status."'";
       		}

            if($type != ''){
                $data['s_type'] = $type;
                $where .= " and mr_for = '".$type."'";
            }

       		if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

                $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
    	}else{
            $where .= " and year_id = '".financial_year()."'";

        }

    	$data['materialreceipt_list'] = $this->db->query("SELECT * from tblmaterialreceipt where  ".$where." order by id desc ")->result();
        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ORDER BY name ASC ")->result_array();

    	$data['title'] = 'Material Receipt List (SEPL/ST/03)';
        $this->load->view('admin/purchase/mr_views', $data);
    }



    public function mr_details($id) {


    	if(!empty($id)){
	    	$data['mr_info'] = $this->db->query("SELECT * from tblmaterialreceipt where id = '".$id."'")->row();
	    	$data['purchaseorder_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$data['mr_info']->po_id."'")->row();
	    	$data['product_info'] = $this->db->query("SELECT * from tblmaterialreceiptproduct where mr_id = '".$id."'")->result();
	    	$data['file_info'] = $this->db->query("SELECT * from tblmaterialreceiptfiles where mr_id = '".$id."'")->result();


	    	$data['title'] = 'Material Receipt Details';
	        $this->load->view('admin/purchase/mr_details', $data);
    	}


    }


     public function pending_mr() {

        check_permission(44,'view');

    	$where = " ma.staff_id = '".get_staff_user_id()."' and ma.approve_status = 0 ";

    	if(!empty($_POST)){
       		extract($this->input->post());

            if($type != ''){
                $data['s_type'] = $type;
                $where .= " and mr_for = '".$type."'";
            }

       		if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

                $where .= " and m.date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
    	}

    	$data['mr_list'] = $this->db->query("SELECT m.* from tblmaterialreceipt as m LEFT JOIN tblmaterialreceiptapproval as ma ON m.id = ma.mr_id where ".$where." group by m.id ORDER BY m.id desc  ")->result();


    	$data['title'] = 'Pending Material Receipt';
        $this->load->view('admin/purchase/pending_mr', $data);
    }


     public function mr_approval($id) {


    	if(!empty($_POST)){
       		extract($this->input->post());

       		/*echo '<pre/>';
       		print_r($_POST);
       		die;*/

       		$ad_data = array(
                        'approve_status' => $submit,
                        'remark' => $remark,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

            $update = $this->home_model->update('tblmaterialreceiptapproval', $ad_data,array('mr_id'=>$id,'staff_id'=>get_staff_user_id()));

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),4,$id,$submit);

            //Getting Reject Info
            $reject_info = $this->db->query("SELECT * FROM `tblmaterialreceiptapproval` where mr_id='".$id."' and approve_status = 2 ")->row_array();
            if(!empty($reject_info)){
                update_masterapproval_all(4,$id,2);
                $this->home_model->update('tblmaterialreceipt', array('status'=>2),array('id'=>$id));
            }
            /* this for recanciliation */
            $reconciliation_info = $this->db->query("SELECT * FROM `tblmaterialreceiptapproval` where mr_id='".$id."' and approve_status = 4 ")->row_array();
            if(!empty($reconciliation_info)){
                update_masterapproval_all(4,$id,4);
                $this->home_model->update('tblmaterialreceipt', array('status'=>4),array('id'=>$id));
                /* all pending approval also did reconcillation */
                $this->home_model->update('tblmaterialreceiptapproval', array('approve_status'=> 4),array('mr_id'=>$id, 'approve_status'=> '0'));
            }
            /* this for hold material receipt */
            $hold_info = $this->db->query("SELECT * FROM `tblmaterialreceiptapproval` where mr_id='".$id."' and approve_status = 5 ")->row_array();
            if(!empty($hold_info)){
                update_masterapproval_all(4,$id,5);
                $this->home_model->update('tblmaterialreceipt', array('status'=>5),array('id'=>$id));
            }

            $approval_info = $this->db->query("SELECT * FROM `tblmaterialreceiptapproval` where mr_id='".$id."' and ( approve_status = 0 || approve_status = 2 || approve_status = 4 || approve_status = 5 ) ")->row_array();
            if(empty($approval_info)){

                /* this condition check 3 approval person */
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblmaterialreceiptapproval` where mr_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 3){
                    update_masterapproval_all(4,$id,1);

                    $this->home_model->update('tblmaterialreceipt', array('status'=>1),array('id'=>$id));

                    //Updating Products on stock
            	    $mr_info = $this->db->query("SELECT * from tblmaterialreceipt where id = '".$id."'")->row();
                    //if($mr_info->extrusion == 0 ){

                        $product_info = $this->db->query("SELECT * from tblmaterialreceiptproduct where mr_id = '".$id."'")->result();

                        if(!empty($product_info)){
    
                            /* this is for purchase challan return if approve MR */
                            if ($submit == 1){
                                $check_rejectinfo = $this->db->query("SELECT `id`,`reject_qty` FROM tblmaterialreceiptproduct WHERE mr_id = '".$id."' AND reject_qty > 0.00")->row();
                                if (!empty($check_rejectinfo)){
                                    $branch_id = get_login_branch();
                                    $po_id = value_by_id_empty("tblmaterialreceipt", $id, "po_id");
                                    $vendor_id = value_by_id_empty("tblmaterialreceipt", $id, "vendor_id");
                                    $add_data = array(
                                        "mr_id" => $id,
                                        "po_id" => $po_id,
                                        "vendor_id" => $vendor_id,
                                        "branch_id" => $branch_id,
                                        'year_id' => financial_year(),
                                        "date" => date("Y-m-d"),
                                        "created_at" => date("Y-m-d H:i:s"),
                                        );
                                    $this->home_model->insert("tblpurchasechallanreturn", $add_data);
                                }
    
                                // code...
                                /* this is for store product store log */
                                foreach ($product_info as $key => $value) {
    
                                    $prod_info = $this->db->query("SELECT * FROM `tblproducts` where `id`= '".$value->product_id."' ")->row();
    
                                    if($prod_info->isOtherCharge == 0){
                                        $length_mm = 0;
                                        if($prod_info->unit_id == 7){
                                            $length_mm = $prod_info->size;
                                        }elseif($prod_info->unit_1 == 7){
                                            $length_mm = $prod_info->conversion_1;
                                        }elseif($prod_info->unit_2 == 7){
                                            $length_mm = $prod_info->conversion_2;
                                        }
                                        $mainrejectedqty = $value->reject_qty; 
                                        
                                        $mr_qty = (!empty($value->qty_in_nos) && $value->qty_in_nos > 0) ? $value->qty_in_nos : $value->qty;
    
                                        $final_qty = ($mr_qty-$mainrejectedqty);
                                        $productlog = array(
                                            "parent_id" => 0,
                                            "pro_id" => $value->product_id,
                                            "warehouse_id" => $mr_info->warehouse_id,
                                            "service_type" => 2,
                                            "total_qty" => $final_qty,
                                            "qty" => $final_qty,
                                            "size" => $length_mm,
                                            "width" => $prod_info->width_mm,
                                            "main_store" => 1,
                                            "main_store_rejected_qty" => $mainrejectedqty,
                                            "ref_type" => "material_receipt",
                                            "ref_id" => $id,
                                            "material_status" => 1,
                                            "date" => date("Y-m-d"),
                                            "updated_at" => date("Y-m-d H:i:s")
                                        );
                                        
                                        $this->home_model->insert("tblproduct_store_log", $productlog);
    
                                        /* this is for update live stock requirement added in stock */
                                        $this->home_model->update("tblrequirement_products", array("is_stock_added" => 1), array("product_id" => $value->product_id));
                                    }
    
                                    /* START PRODUCTION INSPECTION CODE */
                                    if ($mr_info->mr_for == 1 && $prod_info->inspection_required == 1){
                                        $inspectionData['warehouse_id'] = $mr_info->warehouse_id;
                                        $inspectionData['added_by'] = $mr_info->staff_id;
                                        $inspectionData['product_id'] = $value->product_id;
                                        $inspectionData['type'] = 1;
                                        $inspectionData['quantity'] = $value->qty;
                                        $inspectionData['rel_type'] = "material_receipt";
                                        $inspectionData['rel_id'] = $id;
                                        $inspectionData['created_at'] = date("Y-m-d H:i:s");
                                        $inspectionData['status'] = 0;
                                        $this->home_model->insert("tblproductinspection", $inspectionData);
                                    }
                                    /* END PRODUCTION INSPECTION CODE */
                                }
                            }
    
                            /*foreach ($product_info as $key => $value) {
                                $checkprostock = $this->db->query("SELECT * FROM `tblprostock` WHERE  `pro_id`='".$value->product_id."' AND `service_type`='".$mr_info->service_type."' AND `warehouse_id`='".$mr_info->warehouse_id."' and store = 1 and stock_type = 1 and status = 1")->row();
    
    
                                if(!empty($checkprostock)){
                                    $s_id = $checkprostock->id;
    
                                    $final_qty = ($value->qty-$value->reject_qty);
                                    $new_qty = ($checkprostock->qty+$final_qty);
                                    $up_data = array(
                                                'qty' => $new_qty,
                                                'updated_at' => date('Y-m-d H:i:s')
                                            );
    
                                    $this->home_model->update('tblprostock', $up_data,array('id'=>$s_id));
                                }else{
                                    $final_qty = ($value->qty-$value->reject_qty);
                                    $ad_data_1 = array(
                                                'pro_id' => $value->product_id,
                                                'warehouse_id' => $mr_info->warehouse_id,
                                                'service_type' => $mr_info->service_type,
                                                'qty' => $final_qty,
                                                'store' => 1,
                                                'stock_type' => 1,
                                                'status' => 1,
                                                'created_at' => date('Y-m-d H:i:s'),
                                                'updated_at' => date('Y-m-d H:i:s')
                                            );
    
                                    $insert = $this->home_model->insert('tblprostock',$ad_data_1);
                                }
                            }*/
                        }
                   // }

                   /* this is for update stock according to delivery challan return */
                    if ($mr_info->mr_for == 4) {
                        $product_info = $this->db->query("SELECT * from tblmaterialreceiptproduct where mr_id = '".$id."'")->result();
                        if(!empty($product_info)){
                            if ($submit == 1){
                                /*foreach ($product_info as $key => $value) {
                                    $checkprostock = $this->db->query("SELECT * FROM `tblprostock` WHERE  `pro_id`='" . $value->product_id . "' AND `service_type`='" . $mr_info->service_type . "' AND `warehouse_id`='" . $mr_info->warehouse_id . "' and store = 1 and stock_type = 1 and status = 1")->row();

                                    $new_qty = ($checkprostock->qty + $value->qty);
                                    if (!empty($checkprostock)) {
                                        $s_id = $checkprostock->id;
                                        $up_data = array(
                                            'qty' => $new_qty,
                                            'updated_at' => date('Y-m-d H:i:s')
                                        );

                                        $this->home_model->update('tblprostock', $up_data, array('id' => $s_id));
                                    } else {

                                        $ad_data_1 = array(
                                            'pro_id' => $value->product_id,
                                            'warehouse_id' => $mr_info->warehouse_id,
                                            'service_type' => $mr_info->service_type,
                                            'qty' => $new_qty,
                                            'store' => 1,
                                            'stock_type' => 1,
                                            'status' => 1,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s')
                                        );

                                        $insert = $this->home_model->insert('tblprostock', $ad_data_1);
                                    }
                                }*/
                            }
                        }
                    }
                }
            }

            if($update){
            	 set_alert('success', 'Material Receipt updated succesfully');
                 redirect(admin_url('purchase/pending_mr'));
            }
    	}

    	$data['id'] = $id;
    	$data['mr_info'] = $this->db->query("SELECT * from tblmaterialreceipt where id = '".$id."'")->row();
        if($data['mr_info']->mr_for == 1){
          $data['purchaseorder_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$data['mr_info']->po_id."'")->row();
        }
    	$data['product_info'] = $this->db->query("SELECT * from tblmaterialreceiptproduct where mr_id = '".$id."'")->result();
    	$data['file_info'] = $this->db->query("SELECT * from tblmaterialreceiptfiles where mr_id = '".$id."'")->result();


        $data['appvoal_info'] = $this->db->query("SELECT * from tblmaterialreceiptapproval where mr_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();

    	$data['title'] = 'Purchase Order Details';
        $this->load->view('admin/purchase/mr_approval', $data);
    }


    public function last_productprice() {


    	if(!empty($_POST)){
       		extract($this->input->post());

       		$last_info = $this->db->query("SELECT p.id,p.tax_type,p.prefix,p.number,p.date,p.vendor_id, pp.product_id, pp.product_name, pp.price, pp.prodtax from tblpurchaseorder as p LEFT JOIN tblpurchaseorderproduct as pp ON p.id = pp.po_id where pp.product_id = '".$prodcut_id."' order by pp.id desc LIMIT 5  ")->result();


       		?>
       		<div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Last Product Rate</h4>
                            </div>
                             <hr/>
                             <div class="col-md-9"></div>
                             <?php
                             if(!empty($last_info)){
                             	?>
                             	<div class="col-md-3"><a target="_blank" href="<?php  echo admin_url('purchase/last_product_details/'.$prodcut_id); ?>" class="form-control btn-info text-center">View More</a></div>
                             	<?php
                             }
                             ?>

                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Pro Name</td>
                                                <td>Vendor Name</td>
                                                <td>Po No.</td>
                                                <td>PO Date</td>
                                                <td>Tax Type</td>
                                                <td>Tax Rate</td>
                                                <td >Price</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($last_info)){
                                        	$i = 1;
                                        	foreach ($last_info as $key => $value) {
                                        		?>
                                        		<tr>
	                                                <td><?php echo $i++;?></td>
	                                                <td><?php echo $value->product_name;?></td>
	                                                <td><?php echo value_by_id('tblvendor',$value->vendor_id,'name');?></td>
                                                    <td><a target="_blank" href="<?php echo base_url('admin/purchase/last_product_details/'.$value->product_id); ?>"><?php echo $value->prefix.'-'.$value->number;?></a></td>
	                                               	<td><?php echo date('d-m-Y',strtotime($value->date));?></td>
	                                                <td><?php echo ($value->tax_type == 1) ?  'Including' : 'Excluding';  ?></td>
	                                                <td><?php echo $value->prodtax; ?></td>
	                                                <td><?php echo $value->price; ?></td>
	                                            </tr>
                                        		<?php
                                        	}
                                        }else{
                                        	echo '<tr><td class="text-center" colspan="8"><h5>Last Purchase Price Not Found!</h5></td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
       		<?php

		}
    }


    public function get_approval_info() {


    	if(!empty($_POST)){
       		extract($this->input->post());
       		$assign_info = $this->db->query("SELECT * from tblpurchaseorderapproval  where po_id = '".$po_id."'  ")->result();
       		?>
       		            <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Action</td>
                                                <td>Remark</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                        	$i = 1;
                                        	foreach ($assign_info as $key => $value) {

                                        		if($value->approve_status == 0){
                                                                $status = 'Pending';
                                                                $color = 'Darkorange';
                                                        }elseif($value->approve_status == 1){
                                                                $status = 'Approved';
                                                                $color = 'green';
                                                        }elseif($value->approve_status == 2){
                                                                $status = 'Reject';
                                                                $color = 'red';
                                                        }elseif($value->approve_status == 4){
                                                            $status = 'Reconciliation';
                                                            $color = 'brown';
                                                        }elseif($value->approve_status == 5){
                                                            $status = 'On Hold';
                                                            $color = '#e8bb0b;';
                                                        }
                                        		?>
                                        		<tr>
	                                                <td><?php echo $i++;?></td>
	                                                <td><?php echo get_employee_name($value->staff_id); ?></td>
	                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
	                                                <td><?php echo ($value->remark != '') ?  $value->remark : '--';  ?></td>
	                                            </tr>
                                        		<?php
                                        	}
                                        }else{
                                        	echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>

       		<?php

       	}


    }

    public function get_mr_status() {

        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblmaterialreceiptapproval  where mr_id = '".$id."'  ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Assign Detail List</h4>
                </div>
                <hr/>
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                            <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Type</td>
                                        <td>Action</td>
                                        <td>Remark</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($assign_info)){
                                    $i = 1;
                                    foreach ($assign_info as $key => $value) {

                                            if($value->approve_status == 0){
                                                $status = 'Pending';
                                                $color = 'Darkorange';
                                            }elseif($value->approve_status == 1){
                                                $status = 'Approved';
                                                $color = 'green';
                                            }elseif($value->approve_status == 2){
                                                $status = 'Reject';
                                                $color = 'red';
                                            }elseif ($value->approve_status == 4) {
                                                $status = 'Reconciliation';
                                                $color = 'brown';
                                            }elseif ($value->approve_status == 5) {
                                                $status = 'On Hold';
                                                $color = '#e8bb0b;';
                                            }
                                            $persontype = '--';
                                            if ($value->type == 1){
                                                $persontype = '<span class="badge badge-defult">Quality Person</span>';
                                            }else if ($value->type == 2){
                                                $persontype = '<span class="badge badge-defult">Stock Person</span>';
                                            }else if ($value->type == 3){
                                                $persontype = '<span class="badge badge-defult">Purchase Person</span>';
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo get_employee_name($value->staff_id); ?></td>
                                            <td><?php echo $persontype; ?></td>
                                            <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                            <td><?php echo ($value->remark != '') ?  $value->remark : '--';  ?></td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php

        }


    }


    public function last_product_details($id) {


    	$data['last_info'] = $this->db->query("SELECT p.id,p.prefix,p.number,p.date,p.vendor_id,p.tax_type,p.parent_ids, pp.product_id, pp.product_name, pp.price, pp.prodtax from tblpurchaseorder as p LEFT JOIN tblpurchaseorderproduct as pp ON p.id = pp.po_id where pp.product_id = '".$id."' and p.show_list = '1' and p.status = '1' order by pp.id desc LIMIT 5  ")->result();


    	$data['title'] = 'Last Product Details';
        $this->load->view('admin/purchase/last_product_details', $data);
    }


    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('purchase'));
        }

        $purchase = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();

        $po_number = (is_numeric($purchase->number)) ? 'PO-'.$purchase->number : $purchase->number;
        $po_number = str_replace("/", "-", $po_number);

        $file_name = $po_number;

         /*echo $html = purchase_order_pdf($purchase);
         die;*/
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            $html = nturm_purchase_order_pdf($purchase);
        }else{
            $html = purchase_order_pdf($purchase);
        }
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
        $size       = 8;
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );

        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));


    }


    public function deletepo($id) {
        check_permission(41,'delete');

        $po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$id."' ")->row();

        if($po_info->revised_id > 0){
            $this->home_model->update('tblpurchaseorderpayments', array('po_id'=>$po_info->revised_id),array('po_id'=>$id));
            $this->home_model->update('tblmaterialreceipt', array('po_id'=>$po_info->revised_id),array('po_id'=>$id));
            $this->home_model->update('tblpurchaseinvoice', array('po_id'=>$po_info->revised_id),array('po_id'=>$id));
        }else{
           $this->home_model->delete('tblpurchaseorderpayments',array('po_id'=>$id));
        }

        $this->home_model->update('tblpurchaseorder', array('show_list'=>1),array('id'=>$po_info->revised_id));

        $delete = $this->home_model->delete('tblpurchaseorder',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblpurchaseorderapproval',array('po_id'=>$id));
            $this->home_model->delete('tblnotifications',array('module_id'=>6,'table_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('module_id'=>3,'table_id'=>$id));
            set_alert('success', 'Purchase Order deleted successfully');
            redirect(admin_url('purchase'));
        }

    }


    public function cancelpo($id) {

        $po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$id."' ")->row();
        $cancel = $this->home_model->update('tblpurchaseorder', array('cancel'=>1,'show_list'=>0),array('id'=>$id));

        if($cancel == true){

            if($po_info->revised_id > 0){
                $this->home_model->update('tblpurchaseorderpayments', array('po_id'=>$po_info->revised_id),array('po_id'=>$id));
                $this->home_model->update('tblmaterialreceipt', array('po_id'=>$po_info->revised_id),array('po_id'=>$id));
                $this->home_model->update('tblpurchaseinvoice', array('po_id'=>$po_info->revised_id),array('po_id'=>$id));
            }else{
               $this->home_model->delete('tblpurchaseorderpayments',array('po_id'=>$id));
            }



            $this->home_model->update('tblpurchaseorder', array('show_list'=>1),array('id'=>$po_info->revised_id));

            $this->home_model->delete('tblpurchaseorderapproval',array('po_id'=>$id));
            $this->home_model->delete('tblnotifications',array('module_id'=>6,'table_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('module_id'=>3,'table_id'=>$id));
            set_alert('success', 'Purchase Order cancel successfully');
            redirect(admin_url('purchase'));
        }

    }


    public function po_upload() {
        if(!empty($_POST)){
            extract($this->input->post());

            handle_multi_attachments($po_id,'purchase_order');

            set_alert('success', 'File Uploaded successfully');
            redirect(admin_url('purchase'));
        }

    }


    public function get_po_uploads_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'purchase_order' and rel_id = '".$id."' ")->result();

            echo '<h4>No. : PO-'.value_by_id('tblpurchaseorder',$id,'number').' </h4>';
            if(!empty($file_info)){
            ?>


            <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Uploads File</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($file_info as $key => $file) {
                        ?>
                         <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><a target="_blank" href="<?php echo base_url('uploads/purchase_order/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></td>
                            <td><?php echo _d($file->dateadded); ?></td>
                         </tr>

                    <?php
                    }
                    ?>
                     </tbody>
                </table>
            </div>
            <?php
            }

        }
    }



    public function mr_upload($section="mr") {
        if(!empty($_POST)){
            extract($this->input->post());

//            handle_multi_attachments($mr_id,'material_receipt');
            $this->upload_mr_receipts($mr_id);

            set_alert('success', 'File Uploaded successfully');
            $redirect_url = ($section=="invoice") ? "purchase/invoice_list":"purchase/receipt_list";
            redirect(admin_url($redirect_url));
        }

    }


    public function get_mr_uploads_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $file_info = $this->db->query("SELECT * FROM tblmaterialreceiptfiles WHERE `mr_id` = '".$id."' ")->result();

            echo '<h4>No. : MR-'.$id.' </h4>';
            if(!empty($file_info)){
            ?>


            <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Uploads File</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($file_info as $key => $file) {
                        ?>
                         <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><a target="_blank" href="<?php echo base_url("uploads/material_receipt/".$file->file); ?>"><?php echo $file->file; ?></a>&nbsp;&nbsp;<image class="pull-right" src="<?php echo base_url("uploads/material_receipt/".$file->file); ?>" width="50px" height="50px"></td>
                            <td><a class="btn btn-danger _delete" href="<?php echo admin_url("purchase/delete_mr_receipts/".$file->id); ?>"><i class="fa fa-trash"></i></a></td>
                         </tr>

                    <?php
                    }
                    ?>
                     </tbody>
                </table>
            </div>
            <?php
            }

        }
    }

    public function against_pending_po() {

        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` WHERE status = 1 order by name asc")->result();

        $data['branch_id'] = get_login_branch();
        $data['financialyear_id'] = financial_year();
        $where = "status = 1 and complete = 0 and show_list = 1 and po_type = 1 ";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($vendor_id)){
                 $where .= " and vendor_id = '".$vendor_id."' ";
            }
            if(!empty($branch_id)){
                 $where .= "  and billing_branch_id = '".$branch_id."' ";
            }
            if(!empty($financialyear_id)){
                 $where .= " and year_id = '".$financialyear_id."'";
            }
           
            $data['s_vendor'] = $vendor_id;
            $data['branch_id'] = $branch_id;
            $data['financialyear_id'] = $financialyear_id;
        }else{
            $where .= " and billing_branch_id = '".get_login_branch()."' and year_id = '".financial_year()."'";
        }

        $data['purchaseorder_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE ".$where." order by id desc")->result();
        $data['financialyear_list'] = $this->db->query("SELECT * FROM `tblfinancialyear` WHERE `status`='1' order by id desc")->result();
        $data['branch_list'] = $this->db->query("SELECT * FROM `tblcompanybranch` WHERE `status`='1' order by id desc")->result();

        $data['title'] = 'Pending Against PO';
        $this->load->view('admin/purchase/against_pending_po', $data);
    }


    public function invoice_list()
    {
        check_permission(45,'view');


        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($vendor_id) || !empty($f_date) || !empty($t_date) || !empty($po_for)){
                $where = "status = 1 ";
                if(!empty($vendor_id)){
                    $data['vendor_id'] = $vendor_id;
                    $where .= " and vendor_id = '".$vendor_id."'";
                }
                if(!empty($po_for)){
                    $data['po_for'] = $po_for;
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= " and date between '".$f_date."' and '".$t_date."' ";
                }

            }
        }else{
            $where = "status = 1 and year_id = '".financial_year()."' ";
        }

        // Get records
        $data['invoice_list'] = $this->db->query("SELECT * FROM `tblpurchaseinvoice` where ".$where." ORDER BY id desc ")->result();



        $data['vendor_data'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ORDER BY name ASC")->result();

        $data['title'] = 'Purchase Invoice List';
        $this->load->view('admin/purchase/invoice_list', $data);

    }


    public function payment_invoice($id = '') {
        check_permission(45,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/
            if ($id == '') {

                $id = $this->Purchase_model->add_paymentinvoice($proposal_data);

                if ($id) {
                    handle_multi_attachments($id,'purchase_invoice');
                    update_purchase_invoice_final_amount($id);
                   // update_purchaseinvoice_final_amount($id);
                    set_alert('success', _l('added_successfully', 'Purchase Invoice'));
                    redirect(admin_url('purchase/invoice_list'));
                }
            } else {
                check_permission(45,'edit');
                $success = $this->Purchase_model->update_paymentinvoice($proposal_data, $id);

                // exit;
                if ($success) {
                    handle_multi_attachments($id,'purchase_invoice');
                    update_purchase_invoice_final_amount($id);
                   // update_purchaseinvoice_final_amount($id);
                    set_alert('success', _l('updated_successfully', 'Purchase Invoice'));
                    redirect(admin_url('purchase/invoice_list'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Payment Invoice';
        } else {
            $title = 'Edit Payment Invoice';
            $data['invoice_info'] = $this->db->query("SELECT * from tblpurchaseinvoice where id = '".$id."' ")->row();
            $data['product_info'] = $this->db->query("SELECT * from tblpurchaseinvoiceproduct where invoice_id = '".$id."' ")->result_array();
            $data['invoice_othercharges'] = $this->db->query("SELECT * from tblpurchaseinvoiceothercharges where proposalid = '".$id."' ")->result_array();
            $data['po_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$data['invoice_info']->po_id."' ")->result();
            $data['mr_info'] = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `id` IN (".$data['invoice_info']->mr_id.") ")->result();
        }

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 order by name asc")->result_array();
        $data['vendor_data'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 order by name asc")->result_array();

        $data['title']     = $title;



        $this->load->view('admin/purchase/payment_invoice', $data);
    }


    public function get_po_mr_list() {

        extract($this->input->post());
        $mr_html = '';
        $po_html = '';

        if($type == 1){
            $po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `vendor_id`='".$vendor_id."' and `order_type`='".$invoice_for."' and status = 1 and invoice_status = 0 and show_list = 1")->result();
            if(!empty($po_info)){
                    $po_html .= '<option value=""></option>';
                foreach ($po_info as $key => $value) {
                     $po_html .= '<option value="'.$value->id.'">'.$value->prefix.$value->number.' - '._d($value->date).'</option>';
                }
            }
        }

        $mr_info = $this->db->query("SELECT mr.* FROM `tblmaterialreceipt` as mr LEFT JOIN `tblpurchaseorder` as po ON po.id=mr.po_id where mr.vendor_id='".$vendor_id."' and po.order_type='".$invoice_for."' and mr.status = 1 and mr.invoice_status = 0")->result();
        if(!empty($mr_info)){
                $mr_html .= '<option value=""></option>';
            foreach ($mr_info as $key => $value) {
                 $mr_html .= '<option value="'.$value->id.'">'.'MR-'.$value->id.' - '._d($value->date).'</option>';
            }
        }

        $data = array('po_html' => $po_html,'mr_html' => $mr_html);
        echo json_encode($data);

    }

    public function get_mr_list() {

        extract($this->input->post());
        $mr_html = '';

        $po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` where id='".$po_id."' ")->row();
        if(!empty($po_info->mr_ids))
        {
          $exp = explode(',',$po_info->mr_ids);
          foreach($exp as $mr_exp)
            {
              $mr_info=$this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `id`='".$mr_exp."'")->row();

              if(!empty($mr_info)){
                $mr_html .= '<option selected value="'.$mr_info->id.'">'.'MR-'.$mr_info->id.' - '._d($mr_info->date).'</option>';
              }
            }
        }

        else
        {
              $mr_info = $this->db->query("SELECT * FROM `tblmaterialreceipt` where po_id='".$po_id."' and status = 1 and invoice_status = 0")->result();


              if(!empty($mr_info)){
               $mr_html .= '<option value=""></option>';
               foreach ($mr_info as $key => $value) {
                $mr_html .= '<option value="'.$value->id.'">'.'MR-'.$value->id.' - '._d($value->date).'</option>';
                }
          }
        }
        echo $mr_html;

    }


    public function get_mr_items() {

        extract($this->input->post());
        $result_array = array();

        $mr_ids = implode(',', $mr_id);

        $mr_info = $this->db->query("SELECT * FROM `tblmaterialreceiptproduct` where mr_id IN (".$mr_ids.") ")->result_array();

        /*if(!empty($mr_info)){
            foreach ($mr_info as $key => $value) {

                $ttl_qty = $this->db->query("SELECT COALESCE(sum(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` where mr_id IN (".$mr_ids.") and product_id = '".$value->product_id."' ")->row()->ttl_qty;

                $result_array[] = array('product_id' => $value->product_id, 'qty' => $ttl_qty );
            }

        }*/

        if(!empty($mr_info)){
            $i = 1;
            foreach ($mr_info as $row) {
                $tax_rate = getProductTax($row['product_id']);
                ?>
                <tr class="trsalepro<?php echo $i; ?>">
                    <td>
                        <a target="_blank" href="../product/product/<?php echo $row['product_id']; ?>">
                            <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo value_by_id('tblproducts',$row['product_id'],'sub_name'); ?>">
                        </a>
                        <input value="<?php echo $row['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $row['qty']; ?>">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="" name="saleproposal[<?php echo $i; ?>][price]">
                    </td>
                    <td>
                        <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][ttl_price]" value="" >
                    </td>

                    <td>
                        <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saleprod_tax_<?php echo $i; ?>" value="<?php echo $tax_rate; ?>">
                    </td>
                    <td>
                        <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][tax_amt]" value="">
                    </td>
                    <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">0</td>
                </tr>
                <?php
                $i++;
            }
        }


    }

    public function purchase_invoice_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('debit_note'));
        }

        $invoice_info = $this->db->query("SELECT * FROM `tblpurchaseinvoice` where id =  '".$id."' ")->row();
        $file_name = 'Purchase Invoice - '.$id;

         /*echo $html = purchase_order_pdf($purchase);
         die;*/

        $html = purchase_invoice_pdf($invoice_info);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
        $size       = 8;
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );

        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));


    }


    public function delete_invoice($id) {
        check_permission(45,'delete');

        update_purchase_invoice_status_when_delete_edit($id);

        $delete = $this->home_model->delete('tblpurchaseinvoice',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblpurchaseinvoiceproduct',array('invoice_id'=>$id));
            $this->home_model->delete('tblpurchaseinvoiceothercharges',array('proposalid'=>$id));
            set_alert('success', 'Purchase Invoice deleted successfully');
            redirect(admin_url('purchase/invoice_list'));
        }

    }


    public function purchaseorder_sub_po($id) {


        $data['purchaseorder_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();


        //$data['purchaseorder_list'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id IN (".$data['purchaseorder_info']->parent_ids.") and id != '".$id."' ")->result();
        $data['purchaseorder_list'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id IN (".$data['purchaseorder_info']->parent_ids.") order by id desc ")->result();



        $data['title']     = 'Purchase Order Sub (PO-'.$data['purchaseorder_info']->number.')';
        $this->load->view('admin/purchase/purchaseorder_sub_po', $data);
    }

    public function purchaseorder_payments($id) {

        $data['purchaseorder_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();

        $data['payment_list'] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` where po_id =  '".$id."' ORDER BY id DESC")->result();
        $data['refundpayment_list'] = $this->db->query("SELECT * FROM `tblpurchaseorderrefundpayment` where po_id =  '".$id."' ORDER BY id DESC")->result();

        $vendor_id = $data['purchaseorder_info']->vendor_id;
        $data['chk_pending_debitnote']  = $this->db->query("SELECT count(pdn.id) as ttl_recd FROM `tblpurchasedabitnote` as pdn LEFT JOIN `tblpurchasechallanreturn` as pcr ON pcr.id = pdn.parchasechallanreturn_id WHERE pdn.vender_id = '".$vendor_id."' AND pdn.complete = 0")->row();

        $data['chk_refund_payment'] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` where po_id =  '".$id."' ORDER BY id DESC")->result();
        $data['title']     = 'Purchase Order Payments (PO-'.$data['purchaseorder_info']->number.')';
        $this->load->view('admin/purchase/purchaseorder_payments', $data);

    }

    public function purchaseorder_payment_add($id) {


        $data['purchaseorder_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();

        if(!empty($_POST)){
            $proposal_data = $this->input->post();
            $insert = $this->Purchase_model->add_po_payment($proposal_data);

            if ($insert) {
                set_alert('success', _l('added_successfully', 'purchase order Payment'));
                redirect(admin_url('purchase/purchaseorder_payments/'.$id));
            }
        }


        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;


        $data['title']     = 'Add Purchase Order Payments (PO-'.$data['purchaseorder_info']->number.')';
        $this->load->view('admin/purchase/purchaseorder_payment_add', $data);

    }


    public function get_purchasePayment_approval_info() {


        if(!empty($_POST)){
            extract($this->input->post());
            if ($section == "po_refund"){
              $assign_info = $this->db->query("SELECT * FROM `tblpurchaserefundpaymentapproval` WHERE `refund_id` = '".$pay_id."'  ")->result();
            }
            else{
              $assign_info = $this->db->query("SELECT * FROM `tblpurchaseorderpaymentapproval` WHERE `pay_id` = '".$pay_id."'  ")->result();
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Assign Detail List</h4>
                </div>
                 <hr/>
                <div class="col-md-12">
                <div style="overflow-x:auto !important;">
                    <div class="form-group" >
                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                            <thead>
                                <tr>
                                    <td>S.No</td>
                                    <td>Name</td>
                                    <td>Action</td>
                                    <td>Remark</td>
                                    <td>Approved Date</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($assign_info)){
                                $i = 1;
                                foreach ($assign_info as $key => $value) {
                                    $staff_id = ($section == "po_refund") ? $value->staffid: $value->staff_id;
                                    $remark = ($section == "po_refund") ? $value->approvereason: $value->remark;
                                        if($value->approve_status == 0){
                                            $status = 'Pending';
                                            $color = 'Darkorange';
                                        }elseif($value->approve_status == 1){
                                            $status = 'Approved';
                                            $color = 'green';
                                        }elseif($value->approve_status == 2){
                                            $status = 'Reject';
                                            $color = 'red';
                                        }elseif($value->approve_status == 5){
                                            $status = 'ON Hold';
                                            $color = '#e8bb0b';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo get_employee_name($staff_id); ?></td>
                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                        <td><?php echo ($remark != '') ?  $remark : '--';  ?></td>
                                        <td><?php echo ($value->approve_status == 1) ?  _d($value->updated_at) : '--';  ?></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>

            <?php

        }


    }


public function delete_purchasepayment($id) {
        check_permission(41,'delete');
        $chk_payment = $this->db->query("SELECT `adjusment_details`,`payment_by` FROM `tblpurchaseorderpayments` WHERE `id` ='".$id."' ")->row();
        if (!empty($chk_payment)){
            $delete = $this->home_model->delete('tblpurchaseorderpayments',array('id'=>$id));
            if($delete){

                if ($chk_payment->payment_by == "4" && !empty($chk_payment->adjusment_details)){
                    $adjustment_details = json_decode($chk_payment->adjusment_details);
                    foreach ($adjustment_details as $key => $value) {
                        if ($value->amount > 0){
                            $chk_refund_payment = $this->db->query("SELECT `balance_amount` FROM `tblpurchaseorderrefundpayment` WHERE `id` ='".$value->refund_payemnt_id."' ")->row();
                            if (!empty($chk_refund_payment)){
                              $updata["balance_amount"] = $chk_refund_payment->balance_amount+$value->amount;
                              $this->home_model->update("tblpurchaseorderrefundpayment", $updata, array("id" => $value->refund_payemnt_id));
                            }
                        }
                    }
                }
                $this->home_model->delete('tblpurchaseorderpaymentapproval',array('pay_id'=>$id));
                $this->home_model->delete('tblmasterapproval',array('module_id'=>9,'table_id'=>$id));
                $this->home_model->delete('tbltdsdeduction',array('rel_type'=>1,'rel_id'=>$id));
                set_alert('success', 'Purchase Order Payment deleted successfully');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            set_alert('warning', 'Payment not found');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function purchaseorder_payment_details($id) {


        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            $chk_payment = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `id` ='".$id."' ")->row();
            if (empty($chk_payment)){
              set_alert('warning', 'Invalid Record');
              redirect(admin_url('approval/notifications'));
            }
            
            $ad_data = array(
                'approve_status' => $submit,
                'remark' => $remark,
                'approved_amount' => $approved_amount, // by safiya
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->home_model->update('tblpurchaseorderpaymentapproval', $ad_data,array('pay_id'=>$id,'staff_id'=>get_staff_user_id()));

            // by safiya
            $tdsamount = (isset($tdsamount) && !empty($tdsamount)) ? $tdsamount : "0.00";
            $tcsamount = (isset($tcsamount) && !empty($tcsamount)) ? $tcsamount : "0.00";
            $ad_data1 = array('approved_amount' => $approved_amount, "tdsamount" => $tdsamount, "tcsamount" => $tcsamount);
            $this->home_model->update('tblpurchaseorderpayments', $ad_data1,array('id'=>$id));

            /* this function use for adjustment in the case of reject */
            if ($submit == 2 && $chk_payment->payment_by == "4"){
                if (!empty($chk_payment->adjusment_details)){
                    $decodedata = json_decode($chk_payment->adjusment_details);
                    foreach ($decodedata as $value) {
                        $refund_payemnt_id = $value->refund_payemnt_id;
                        $chk_refund_payment = $this->db->query("SELECT `balance_amount` FROM `tblpurchaseorderrefundpayment` WHERE `id` ='".$refund_payemnt_id."' ")->row();
                        if (!empty($chk_refund_payment)){
                          $updata["balance_amount"] = $chk_refund_payment->balance_amount+$value->amount;
                          $this->home_model->update("tblpurchaseorderrefundpayment", $updata, array("id" => $refund_payemnt_id));
                        }
                    }
                }
            }

            //Update master approval
             update_masterapproval_single(get_staff_user_id(),9,$id,$submit);

            //Getting Reject Info
            $approve_status = 0;
            $reject_info = $this->db->query("SELECT * FROM `tblpurchaseorderpaymentapproval` where pay_id='".$id."' and approve_status = 2 ")->row_array();
            if(!empty($reject_info)){
                $approve_status = 2;
                $this->home_model->update('tblpurchaseorderpayments', array('status'=>2),array('id'=>$id));
            }else{
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblpurchaseorderpaymentapproval` where pay_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 2){
                    $approve_status = 1;
                    $this->home_model->update('tblpurchaseorderpayments', array('status'=>1),array('id'=>$id));
                }
            }

            $approval_info = $this->db->query("SELECT * FROM `tblpurchaseorderpaymentapproval` where pay_id='".$id."' and ( approve_status = 0 || approve_status = 2 || approve_status = 5) ")->row_array();
            if(empty($approval_info)){
                $approve_status = 1;
                $this->home_model->update('tblpurchaseorderpayments', array('status'=>1),array('id'=>$id));
            }
            
            $hold_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblpurchaseorderpaymentapproval` where pay_id='".$id."' and approve_status = 5 ")->row()->ttl_count;
            if($hold_count > 0){
                $approve_status = 5;
                $this->home_model->update('tblpurchaseorderpayments', array('status'=>5),array('id'=>$id));
            }
            //Update master approval
            update_masterapproval_all(9,$id,$approve_status);

            /* this function use for complete debit note if total amount equal or grater then to debit note amount */
            if ($approve_status == 1){
                $payement_info = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE id = ".$id." AND status=1 AND payment_by = 3")->row();
                if (!empty($payement_info)){
                    $po_ttl_amt = value_by_id_empty("tblpurchaseorder", $payement_info->po_id, "totalamount");
                    $total_amt = (!empty($po_ttl_amt)) ? $po_ttl_amt : 0.00;
                    $debitnote_ids = explode(",", $payement_info->debitnote_ids);

                    $paid_amt = 0;
                    if ($debitnote_ids){
                        foreach ($debitnote_ids as $debit_id) {
                            $dn_info = $this->db->query("SELECT `totalamount` FROM `tblpurchasedabitnote` WHERE id = ".$debit_id." AND status=1")->row();
                            $dn_log_info = $this->db->query("SELECT `id` FROM `tblpurchasedebitnoteregistered` WHERE `payment_id` = ".$id." AND debitnote_id = ".$debit_id." AND status=1 AND is_clear = 1")->row();

                            if (!empty($dn_log_info)){
                                $this->home_model->update('tblpurchasedabitnote', array('complete'=>1),array('id'=>$debit_id));
                            }else{
                                $paid_amt = $this->db->query("SELECT COALESCE(sum(pdr.amount),0) as ttl_amt FROM `tblpurchasedebitnoteregistered` as pdr LEFT JOIN `tblpurchaseorderpayments` as pop ON pdr.payment_id = pop.id WHERE pdr.`debitnote_id` = ".$debit_id." AND pdr.status = 1 AND pop.status = 1")->row()->ttl_amt;
                                if ($paid_amt >= $dn_info->totalamount){
                                    $this->home_model->update('tblpurchasedabitnote', array('complete'=>1),array('id'=>$debit_id));
                                }
                            }
                        }
                    }
                }

                /* this section for tds deduction */
                $tds_amt = value_by_id('tblpurchaseorderpayments', $id, "tdsamount");
                if (($chk_payment->payment_by == "1" OR $chk_payment->payment_by == "2") && $tds_amt > 0){
                    $paid_amount = get_po_paid_amount($chk_payment->po_id);
                
                    $po_paid_amount = $paid_amount - ($chk_payment->approved_amount + $chk_payment->tdsamount + $chk_payment->tcsamount);
                    $totalamount = value_by_id('tblpurchaseorder', $chk_payment->po_id, "totalamount");
                    $beforepayamt = ($totalamount - $po_paid_amount);
                    $taxamt = ($beforepayamt > 0) ? ($beforepayamt * 18)/100 : 0;
                    $tdspaid_amount = round($beforepayamt - $taxamt);

                    $po_product = $this->db->query("SELECT SUM(ttl_price) as ttl_price FROM `tblpurchaseorderproduct` WHERE `po_id` ='".$chk_payment->po_id."' ")->row();
                    $taxable_amount = (!empty($po_product) && !empty($po_product->ttl_price)) ? $po_product->ttl_price : 0;
                    if ($tdspaid_amount > 0){
                        
                        $vendor_id = value_by_id('tblpurchaseorder', $chk_payment->po_id, "vendor_id");
                        $vendor_name = value_by_id('tblvendor', $vendor_id, "name");
                        $vendor_pan_no = value_by_id('tblvendor', $vendor_id, "pan_no");
                        $tds_data["addedby"] = get_staff_user_id();
                        $tds_data["party_id"] = $vendor_id;
                        $tds_data["party_name"] = $vendor_name;
                        $tds_data["rel_type"] = 1;
                        $tds_data["rel_id"] = $id;
                        $tds_data["taxable_amount"] = $taxable_amount;
                        $tds_data["paid_amount"] = $tdspaid_amount;
                        $tds_data["tds_amount"] = $tds_amt;
                        $tds_data["pan_no"] = $vendor_pan_no;
                        $tds_data["date"] = db_date($chk_payment->created_at);
                        $tds_data["created_at"] = date("Y-m-d h:i:s");
                        $this->home_model->insert("tbltdsdeduction", $tds_data);
                    }
                }
            }

            if($update){
                 set_alert('success', 'Action taken succesfully');
                 redirect(admin_url('approval/notifications'));
            }
        }

        $data['id'] = $id;

        $data['payment_info'] = $this->db->query("SELECT * from tblpurchaseorderpayments where id = '".$id."' ")->row_array();

        $data['staffassigndata'] = explode(',', $data['payment_info']['assignid']);

        $this->load->model('Staffgroup_model');
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = 'Purchase Order Payment Details';
        $data['appvoal_info'] = $this->db->query("SELECT * from tblpurchaseorderpaymentapproval where pay_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();

        // By Safiya
        $data['approval_amount'] = $this->db->query("SELECT * from tblpurchaseorderpaymentapproval where pay_id = '".$id."' and approve_status != 0 ")->result();
        $data['title'] = 'Purchase Order Details';
        $this->load->view('admin/purchase/purchaseorder_payment_details', $data);
    }


    public function update_utr_html()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $payment_info  = $this->db->query("SELECT * from tblpurchaseorderpayments where id = '".$id."' ")->row();

            $bank_payment_info  = $this->db->query("SELECT * from tblbankpaymentdetails where pay_type = 'po_payment' and  pay_type_id = '".$id."' ")->row();

            $payment_date = '';
            if(!empty($payment_info->payment_date)){
                $payment_date = $payment_info->payment_date;
            }elseif(!empty($bank_payment_info->utr_date)){                
                $payment_date = $bank_payment_info->utr_date;
            }
            ?>
             <div class="col-md-12">
              <form action="<?php echo admin_url('purchase/update_utr'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>UTR No.</th>
                        <th>Payment Date.</th>
                      </tr>
                    </thead>
                    <tbody>

                   <tr>
                        <td><input class="form-control" type="text" name="utr_no" value="<?php echo $payment_info->utr_no; ?>"></td>
                        <td><input type="text" name="utr_date" class="form-control date_picker" value="<?php if(!empty($payment_date)){ echo date('d/m/Y',strtotime($payment_date)); } ?>"></td>
                    </tr>


                    </tbody>
                  </table>

                  <input type="hidden" value="<?php echo $id; ?>" name="id">

                   <div class="col-md-12">
                        <button  type="submit" class="btn btn-info">Update</button>
                    </div>
                  </form>
            </div>
            <?php
        }
    }

    public function update_utr()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $payment_info  = $this->db->query("SELECT * from tblpurchaseorderpayments where id = '".$id."' ")->row();
            if(empty($utr_date)){
                $date = '0000-00-00';
            }else{
                $date = db_date($utr_date);
            }
            $update = $this->home_model->update('tblpurchaseorderpayments', array('utr_no'=>$utr_no,'payment_date'=>$date),array('id'=>$id));


            if(!empty($update)){
                set_alert('success', 'Reference No. Updated Successfully');
                redirect(admin_url('purchase/purchaseorder_payments/'.$payment_info->po_id));
            }else{
                set_alert('warning', 'Something went wrong!');
                redirect(admin_url('purchase/purchaseorder_payments/'.$payment_info->po_id));
            }

        }

    }


    public function deletemr($id) {
       // check_permission(41,'delete');
        $mr_info = $this->db->query("SELECT * FROM tblmaterialreceipt where id = '".$id."' ")->row();

        $delete = $this->home_model->delete('tblmaterialreceipt',array('id'=>$id));

        if($delete == true){
            if($mr_info->po_id > 0){
                $this->home_model->update('tblpurchaseorder', array('complete'=>0),array('id'=>$mr_info->po_id));
            }
            if($mr_info->deliverychallan_id > 0){
                $this->home_model->update('tbljobdelivarychallan', array('complete'=>0),array('id'=>$mr_info->deliverychallan_id));
            }
            $this->home_model->delete('tblmaterialreceiptapproval',array('mr_id'=>$id));
            $this->home_model->delete('tblmaterialreceiptproduct',array('mr_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('module_id'=>4,'table_id'=>$id));
            $this->home_model->delete('tblproduct_store_log',array('ref_id'=>$id,'ref_type'=>"material_receipt"));
            $this->home_model->delete('tblproductinspection',array('rel_id'=>$id,'rel_type'=>"material_receipt"));
            set_alert('success', 'MR deleted successfully');
            redirect(admin_url('purchase/receipt_list'));
        }

    }


    public function get_payment_percent() {

        if(!empty($_POST)){
            extract($this->input->post());
            $payment_info = $this->db->query("SELECT * from tblpurchaseorderpayments  where po_id = '".$po_id."' and status = '1'  ")->result();
            $refundpayment_list = $this->db->query("SELECT * FROM `tblpurchaseorderrefundpayment` where po_id =  '".$po_id."' AND status = '1' ORDER BY id DESC")->result();
            $chk_refund_effect = 0;    
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Purchase Order Payments List</h4>
                </div>
                <hr/>
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                          <div class="table-responsive">
                              <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Added By</th>
                                        <th>Date</th>
                                        <th>Utr No</th>
                                        <th>Amount</th>
                                        <th>Approve Amount</th>
                                        <th>Payment By</th>
                                        <th>TDS Amount</th>
                                        <th>TCS Amount</th>
                                        <th>Final Amount <br><small>( Amount + TDS Amount + TCS Amount ) </small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total_bal = 0;
                                if(!empty($payment_info)){
                                    $i = 1;
                                    foreach ($payment_info as $key => $value) {

                                        if($value->utr_no == ''){
                                        $status = 'Pending';
                                        $cls = 'btn-warning';
                                        }else{
                                            $status = $value->utr_no;
                                            $cls = 'btn-success';
                                        }

                                        $utr_no = "--";
                                        if ($value->payment_by == 1){
                                            $utr_no = '<button type="button" class="'.$cls.' btn-sm status"  >'.$status.'</button>';
                                        }elseif ($value->payment_by == 2) {
                                            $utr_no = 'By Patty Cash';
                                        }elseif ($value->payment_by == 3) {
                                            $utr_no = 'By Debit Note <br>';
                                            if (!empty($value->debitnote_ids)){
                                                $dn_ids = explode(",", $value->debitnote_ids);
                                                foreach ($dn_ids as $d_id) {
                                                    $utr_no .= '<a  href="'. base_url("admin/purchasechallanreturn/download_debitnotepdf/" . $d_id).'" target="_blank">PDN-'.str_pad($d_id, 4, "0", STR_PAD_LEFT).'</a><br>';
                                                }
                                            }
                                        }
                                        $total_bal += $value->approved_amount;
                                        $total_bal += $value->tdsamount;
                                        $total_bal += $value->tcsamount;
                                        ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo get_employee_name($value->staff_id); ?></td>
                                            <td><?php echo _d($value->created_at); ?></td>
                                            <td><?php echo $utr_no; ?></td>
                                            <td><?php echo $value->amount; ?></td>
                                            <td><?php echo $value->approved_amount; ?></td>
                                            <td>
                                              <?php
                                                  if ($value->payment_by == 1){
                                                      echo "<span class='label label-primary'>Direct Payment</span>";
                                                  }elseif($value->payment_by == 2){
                                                      echo "<span class='label label-info'>Petty Cash</span>";
                                                  }elseif($value->payment_by == 3){
                                                      echo "<span class='label label-success'>Debit Note</span>";
                                                  }elseif($value->payment_by == 4){
                                                      echo "<span class='label label-warning'>Payment Adjustment</span>";
                                                  }
                                              ?>
                                            </td>
                                            <td><?php echo $value->tdsamount; ?></td>
                                            <td><?php echo $value->tcsamount; ?></td>
                                            <td><?php echo '<span style="color:green;"><i class="fa fa-plus"></i> '.number_format($value->approved_amount + $value->tdsamount + $value->tcsamount, 2).'</span>'; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    echo '<tr><td class="text-center" colspan="10"><h5>Record Not Found!</h5></td></tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
              <?php if (!empty($refundpayment_list)) { ?>
                  <div class="row refundpaymentdiv">
                    <div class="col-md-12">
                      <h4>Purchase Order Refund Request</h4>
                      <hr>
                    </div>
                  </div>
                  <div class="row refundpaymentdiv">
                  <div class="col-md-12 table-responsive">
                      <table class="table" id="refundtable">
                          <thead>
                              <tr>
                                  <th>S.No.</th>
                                  <th>Added By</th>
                                  <th>Date</th>
                                  <th>Refund Type</th>
                                  <th>Amount</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php

                                  $z1 = 1;
                                  foreach ($refundpayment_list as $row) {
                                    $chk_refund_effect = 0;
                                    if($row->type == 2){
                                        $chk_refund_effect = 1;
                                    }elseif ($row->refund_to == 1 && $row->account_confirmation == 1){
                                        $chk_refund_effect = 1;
                                    }else{
                                        $pettycash_info = $this->db->query("SELECT `confirmed_by_user`,`receive_status` FROM `tblpettycashrequest` WHERE `refund_id` ='".$row->id."' ")->row();
                                        if (!empty($pettycash_info) && $pettycash_info->confirmed_by_user == 1 && $pettycash_info->receive_status == 1){
                                            $chk_refund_effect = 1;
                                        }
                                    }

                                    if ($chk_refund_effect == 1){
                                        if ($row->status == 0) {
                                            $status = 'Pending';
                                            $cls = 'btn-warning';
                                        } elseif ($row->status == 1) {
                                            $status = 'Approved';
                                            $cls = 'btn-success';
                                        } elseif ($row->status == 2) {
                                            $status = 'Rejected';
                                            $cls = 'btn-danger';
                                        }
                                        $payment_by = "";
                                        if ($row->type == 1){
                                            $payment_by = "<span class='label label-primary'>Refund Payment</span>";
                                        }elseif($row->type == 2){
                                            $payment_by = "<span class='label label-info'>Adjust Payment In Next PO</span>";
                                        }
                                        $total_bal -= $row->amount;
                                        ?>
                                        <tr>
                                            <td><?php echo $z1++; ?></td>
                                            <td><?php echo get_employee_name($row->added_by); ?></td>
                                            <td><?php echo _d($row->payment_date); ?></td>
                                            <td><?php echo $payment_by; ?></td>
                                            <td><?php echo '<span style="color:red;"><i class="fa fa-minus"></i> '.$row->amount.'</span>'; ?></td>
                                        </tr>
                                        <?php
                                    }
                                  }
                              ?>


                          </tbody>
                      </table>
                  </div>
              </div>
              <?php } ?>
              <div class="row finalpaymentamtdiv">
                  <div class="col-md-12">
                    <hr>
                      <div class="col-md-8"></div>
                      <div class="col-md-4">
                          Final Payment Amount : <span class="btn btn-success"><?php echo number_format($total_bal, 2);?></span>
                      </div>
                  </div>
              </div>
              <script>
                  var chkrefund = "<?php echo $chk_refund_effect; ?>";
                  if (chkrefund == 0){
                      $(".refundpaymentdiv").hide();
                  }
              </script>
            <?php

        }


    }

    /* this function use for get vender list */
    public function get_vender_list(){
        $vender_id = $this->input->post("vid");
        $vendor_info = $this->db->query("SELECT * FROM `tblvendor` where id = '".$vender_id."' ")->result_array();
        echo render_select('sent_to[]',$vendor_info,array('email','email','name'),'invoice_estimate_sent_to_email', $vendor_info[0]["email"],array('multiple'=>true, 'required'=>true, 'readonly'=>""),array(),'','',false);
    }

    /* this function use for send mail of lead */
    public function send_to_mail(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            $po_data = $this->db->query("SELECT * FROM tblpurchaseorder WHERE id = ".$po_id."")->row();
            if (!empty($po_data)){
                $response = $this->emails_model->send_mail($po_id, "purchase_order", $module_template_id, $po_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Purchase order send on mail successfully");
                    redirect(admin_url("purchase"));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url("purchase"));
                }
            }
            else{
                set_alert('danger', "Purchase order not found");
                redirect(admin_url("purchase"));
            }
        }
        else{
            redirect(admin_url("purchase"));
        }
    }

    public function get_po_mr()
    {
        if ($this->input->post()) {
            extract($this->input->post());

            $mr_info = $this->db->query("SELECT * FROM tblmaterialreceipt where vendor_id = '".$vendor_id."' and status = 1 and mr_for = 3 and gas_po_status = 0 ")->result();
            if(!empty($mr_info)){
                foreach ($mr_info as $key => $value) {

                    $mr_number = (!empty($value->numer)) ? $value->numer : 'MR-' . $value->id;
                    $html .= '<option value="'.$value->id.'">'.$mr_number.' - '._d($value->date).'</option>';
                }
            }

            echo $html;
        }
    }

    public function mr_product_table()
    {
        if ($this->input->post()) {
            extract($this->input->post());

            ?>

                <?php
                 if(!empty($mr_id)){
                    $i = 1;
                    foreach ($mr_id as $key => $value) {
                    $mr_info = $this->db->query("SELECT * FROM tblmaterialreceipt where id = '".$value."' ")->row();
                    $mr_number = (!empty($mr_info->numer)) ? $mr_info->numer : 'MR-' . $mr_info->id;
                     ?>
                <div class="row">
                <div class="col-md-10">
                    <h4><?php echo $mr_number.' - '._d($mr_info->date); ?></h4>
                </div>
                <div class="col-md-12">

                    <div style="overflow-x:auto !important;">

                        <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">

                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">

                                <thead>

                                    <tr>

                                        <td style="width: 5px !important;"><i class="fa fa-cog"></i></td>

                                        <td style="width: 130px !important;"><?php echo _l('prop_pro_name'); ?></td>

                                        <td style="width: 70px !important;"><?php echo _l('prop_pro_id'); ?></td>

                                        <td style="width: 70px !important;">Unit</td>

                                        <td style="width: 70px !important;">HSN/SAC Code</td>

                                        <td style="width: 70px !important;">Remark</td>

                                        <td style="width: 70px  !important;"><?php echo _l('prop_pro_qty'); ?></td>

                                        <td style="width: 70px !important;"><?php echo _l('prop_pro_price'); ?></td>

                                        <td style="width: 70px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>


                                        <td style="width: 70px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>
                                        <td style="width: 70px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>
                                        <td style="width: 70px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>



                                        <td style="width: 70px !important;">Tax %</td>

                                        <td style="width: 70px !important;">Tax Amt</td>

                                        <td style="width: 70px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    $totsaleprod = 0;
                                    $unit_list = $this->db->query("SELECT * from tblunitmaster where status = '1' ")->result();
                                    $product_info = $this->db->query("SELECT * FROM tblmaterialreceiptproduct where mr_id = '".$value."' ")->result_array();
                                    foreach ($product_info as $single_prod_sale_det) {
                                    $pro_info = $this->db->query("SELECT * FROM tblproducts where id = '".$single_prod_sale_det['product_id']."' ")->row_array();


                                    if (isset($pro_info)) {

                                        $totsaleprod = count($pro_info);

                                        ?>

                                    <input type="hidden" id="totalsalepro" value="<?php echo count($product_info); ?>">

                                    <?php

                                        $totproamt = ($single_prod_sale_det['ttl_price'] + $single_prod_sale_det['tax_amt']);
                                        ?>

                                        <tr class="trsalepro<?php echo $i; ?>">

                                            <td>

                                                <button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                            </td>

                                            <td>

                                                <a target="_blank" href="../product/product/<?php echo $pro_info['sub_name']; ?>">

                                                    <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $pro_info['sub_name']; ?>">

                                                </a>

                                                <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                <input value="0" name="saleproposal[<?php echo $i; ?>][is_temp]" type="hidden">

                                            </td>

                                            <td>

                                                <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo 'PRO-ID'.$single_prod_sale_det['product_id']; ?>">

                                            </td>

                                            <td>
                                                <select class="form-control selectpicker" required="" style="display:block !important;" data-live-search="true" name="saleproposal[<?php echo $i; ?>][unit_id]">
                                                    <option value=""></option>
                                                    <?php
                                                        if (isset($unit_list) && count($unit_list) > 0) {
                                                            foreach ($unit_list as $uvalue) {
                                                                $selected = ($single_prod_sale_det['unit_id'] == $uvalue->id) ? "selected" : "";
                                                                echo '<option value="' . $uvalue->id . '" '.$selected.'>' . $uvalue->name . '</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </td>

                                            <td>
                                                <select class="form-control selectpicker" style="display:block !important;"  name="saleproposal[<?php echo $i; ?>][hsn_code]">
                                                    <option value="1" <?php echo (isset($single_prod_sale_det['hsn_code']) && $single_prod_sale_det['hsn_code'] == 1) ? "selected" : ""; ?>>HSN</option>
                                                    <option value="2" <?php echo (isset($single_prod_sale_det['hsn_code']) && $single_prod_sale_det['hsn_code'] == 2) ? "selected" : ""; ?>>SAC</option>
                                                </select>

                                                <!-- <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>"> -->

                                            </td>

                                            <td>

                                                <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_sale_det['remark']; ?>">

                                            </td>

                                            <td>

                                                <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">

                                            </td>

                                            <td>

                                                <input type="number" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['price']; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">

                                            </td>

                                            <td>

                                                <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][ttl_price]" value="<?php echo $single_prod_sale_det['ttl_price']; ?>" id="total_price1">

                                            </td>


                                            <td>
                                                <input type="number" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)"  value="0" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                            </td>
                                            <td>
                                                <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="">
                                            </td>
                                            <td>
                                                <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="">
                                            </td>



                                            <td>

                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">

                                                <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saleprod_tax_<?php echo $i; ?>" value="<?php echo getProductTax($single_prod_sale_det['product_id']); ?>">

                                            </td>



                                            <td>

                                                <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][tax_amt]" value="<?php echo $single_prod_sale_det['tax_amt']; ?>" id="total_price1">

                                            </td>

                                            <!-- <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">

                                                <?php echo round($totproamt, 0); ?>

                                            </td> -->
                                            <td class="" style="font-size: 17px;text-align: center;padding: 10px;">
                                                <input readonly="" type="text" class="form-control grandtotal totalsaleamt" id="grand_total_sale<?php echo $i; ?>" value="<?php echo round($totproamt, 0); ?>">
                                            </td>            
                                        </tr>

                                        <?php

                                        $i++;

                                    }

                                }

                                ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                    </div>

                </div>
            <?php } }

                  }
                }

    /* this function use for view pdf */
    public function view_pdf($id) {

        $data["title"] = "Purchase Order";
        $data["purchase"] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();
        $this->load->view('admin/purchase/view_pdf', $data);
    }


    public function supplier_rating() {

       $where = " p.show_list = '1' and p.status = '1' and p.cancel = '0' and  p.complete = 1 ";

        if(!empty($_POST)){
            extract($this->input->post());



            if($vendor_id != ''){
                $data['vendor_id'] = $vendor_id;
                $where .= " and p.vendor_id = '".$vendor_id."'";
            }


            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

                $where .= " and p.date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }


        }
        $data['po_item_list'] = $this->db->query("SELECT p.number,p.date,p.vendor_id,pp.* from tblpurchaseorderproduct as pp LEFT JOIN tblpurchaseorder as p ON pp.po_id = p.id where  ".$where." order by p.id desc ")->result();


        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ORDER BY name ASC ")->result_array();

        $data['title'] = 'Supplier Rating (SEPL/PUR/04)';
        $this->load->view('admin/purchase/supplier_rating', $data);
    }


    public function delivery_performance() {

       $where = " order_confirm = '1' ";

        if(!empty($_POST)){
            extract($this->input->post());

            if($cient_id != ''){
                $data['cient_id'] = $cient_id;
                $where .= " and clientid = '".$cient_id."'";
            }


            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

                $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }


        }
        $data['estimate_list'] = $this->db->query("SELECT * from tblestimates where  ".$where." order by id desc ")->result();


        $data['client_info'] = $this->db->query("SELECT * from tblclientbranch where active = 1 AND client_branch_name !='' ORDER BY client_branch_name ASC ")->result_array();

        $data['title'] = 'Delivery Performance (SEPL/SLS/04)';
        $this->load->view('admin/purchase/delivery_performance', $data);
    }


    public function itc_invoice_list()
    {
        //check_permission(45,'view');


        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($vendor_id) || !empty($f_date) || !empty($t_date) || !empty($itc_status)){
                $where = "status = 1 ";
                if(!empty($vendor_id)){
                    $data['vendor_id'] = $vendor_id;
                    $where .= " and vendor_id = '".$vendor_id."'";
                }

                if(!empty($itc_status)){
                    $data['itc_status'] = $itc_status;
                    if($itc_status == 3){
                        $itc_status = 0;
                    }
                    $where .= " and itc_status = '".$itc_status."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= " and date between '".$f_date."' and '".$t_date."' ";
                }

            }
        }else{
            $where = "status = 1 and itc_status =  0 ";
        }

        // Get records
        $data['invoice_list'] = $this->db->query("SELECT * FROM `tblpurchaseinvoice` where ".$where." ORDER BY id desc ")->result();



        $data['vendor_data'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ORDER BY name ASC")->result();

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }
        $data['allStaffdata'] = $stafff;

        $data['title'] = 'Purchase ITC Invoice List';
        $this->load->view('admin/purchase/itc_invoice_list', $data);

    }


    public function itc_invoice_action()
    {

        if(!empty($_POST)){
            extract($this->input->post());
            $assignstaff = $assignid;
            if(!empty($assignstaff)){
                foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                        $staff_id[] = str_replace("staff", "", $single_staff);
                    }
                }
                $staff_id = array_unique($staff_id);
           }

           if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['invoice_id'] = $invoice_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseinvoiceitcpproval', $sdata);


                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 24,
                        'description' => 'Purchase ITC Send to you for Approval',
                        'table_id' => $invoice_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/payment_invoice_details/' . $invoice_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Purchase ITC Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }

            set_alert('success', 'Approval request send succesfully');
            redirect(admin_url('purchase/itc_invoice_list'));

        }

    }


    public function payment_invoice_details($id) {


        if(!empty($_POST)){
            extract($this->input->post());
             $ad_data = array(
                        'approve_status' => $submit,
                        'remark' => $remark,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

            $update = $this->home_model->update('tblpurchaseinvoiceitcpproval', $ad_data,array('invoice_id'=>$id,'staff_id'=>get_staff_user_id()));

            //Update master approval
             update_masterapproval_single(get_staff_user_id(),24,$id,$submit);

            //Getting Reject Info
            $approve_status = 0;
            $reject_info = $this->db->query("SELECT * FROM `tblpurchaseinvoiceitcpproval` where invoice_id='".$id."' and approve_status = 2 ")->row_array();
            if(!empty($reject_info)){
                $approve_status = 2;
                $this->home_model->update('tblpurchaseinvoice', array('itc_status'=>2),array('id'=>$id));
            }else{
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblpurchaseinvoiceitcpproval` where invoice_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 2){
                    $approve_status = 1;
                    $this->home_model->update('tblpurchaseinvoice', array('itc_status'=>1),array('id'=>$id));
                }
            }

            $approval_info = $this->db->query("SELECT * FROM `tblpurchaseinvoiceitcpproval` where invoice_id='".$id."' and ( approve_status = 0 || approve_status = 2) ")->row_array();
            if(empty($approval_info)){
                $approve_status = 1;
                $this->home_model->update('tblpurchaseinvoice', array('itc_status'=>1),array('id'=>$id));
            }


            //Update master approval
            update_masterapproval_all(24,$id,$approve_status);

            if($update){
                 set_alert('success', 'Purchase ITC updated succesfully');
                 redirect(admin_url('approval/notifications'));
            }
        }

        $data['id'] = $id;
        $data['invoice_info'] = $this->db->query("SELECT * from tblpurchaseinvoice where id = '".$id."' ")->row();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseinvoiceproduct where invoice_id = '".$id."' ")->result_array();
        $data['invoice_othercharges'] = $this->db->query("SELECT * from tblpurchaseinvoiceothercharges where proposalid = '".$id."' ")->result_array();
        $data['po_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$data['invoice_info']->po_id."' ")->result();
        $data['mr_info'] = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `id` IN (".$data['invoice_info']->mr_id.") ")->result();
        $data['vendor_data'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1")->result_array();
        $document_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$id."' and rel_type = 'purchase_invoice'")->result_array();

        $data['file_data'] = '';
        if(!empty($document_info)){
            foreach ($document_info as $doc) {
                $data['file_data'] .= '<a download href="'.site_url('uploads/purchase_invoice/'.$value->id.'/'.$doc['file_name']).'">'.$doc['file_name'].'</a><br>';
            }
        }


        $data['title'] = 'Purchase Invoice Details';
        $this->load->view('admin/purchase/payment_invoice_details', $data);
    }


    public function get_itc_approval_info() {


        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblpurchaseinvoiceitcpproval  where invoice_id = '".$id."'  ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Assign Detail List</h4>
                </div>
                 <hr/>
                <div class="col-md-12">
                <div style="overflow-x:auto !important;">
                    <div class="form-group" >
                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                            <thead>
                                <tr>
                                    <td>S.No</td>
                                    <td>Name</td>
                                    <td>Action</td>
                                    <td>Remark</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($assign_info)){
                                $i = 1;
                                foreach ($assign_info as $key => $value) {

                                        if($value->approve_status == 0){
                                            $status = 'Pending';
                                            $color = 'Darkorange';
                                        }elseif($value->approve_status == 1){
                                            $status = 'Approved';
                                            $color = 'green';
                                        }elseif($value->approve_status == 2){
                                            $status = 'Reject';
                                            $color = 'red';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo get_employee_name($value->staff_id); ?></td>
                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                        <td><?php echo ($value->remark != '') ?  $value->remark : '--';  ?></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>

            <?php

        }
    }

    /* this function use for mr edit */
    public function mr_cash_edit($mr_id){

        if(!empty($_POST)){
            extract($this->input->post());
            $post_data = $this->input->post();

            /*echo '<pre/>';
            print_r($post_data);
            die;*/

           $id = $this->Purchase_model->edit_mr_cash($mr_id, $post_data);

            // If file upload form submitted
            $this->upload_mr_receipts($id);

            if ($id) {
                set_alert('success', "Material Receipt update successfully");
                redirect(admin_url('purchase/receipt_list/'));
            }
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='21'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ")->result_array();
        $data['product_data'] = $this->db->query("SELECT `id`,`name`,`sub_name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status= '1' ")->result_array();
        $data['materialreceipt_info'] = $this->db->query("SELECT * from tblmaterialreceipt where id = ".$mr_id." ")->row();
        $data['mr_product_list'] = $this->db->query("SELECT * from  tblmaterialreceiptproduct where mr_id = ".$mr_id." ")->result_array();
        $data['quality_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 1")->row();
        $data['stock_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 2")->row();
        $data['purchase_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 3")->row();
        $data['file_info'] = $this->db->query("SELECT * from tblmaterialreceiptfiles where mr_id = '".$mr_id."'")->result();
        $data["staff_list"] = get_staff_list();
        $data['title'] = 'Material Receipt (Cash)';
        $this->load->view('admin/purchase/material_receipt_cash', $data);
    }

    /* this function use for material receipt edit */
    public function material_receipt_edit($mr_id) {

    	if(!empty($_POST)){
            extract($this->input->post());
    		$post_data = $this->input->post();

    		/* echo '<pre/>';
    		print_r($post_data);
    		die;*/

                //Make PO as complete if quantity is match
                if(!empty($po_number)){
                   if(!empty($product)){
                        $complete = 1;
                        foreach ($product as $p_id) {
                            $quantity = $_POST['product_'.$p_id];
                            $last_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` WHERE `po_id`='".$po_number."' and `product_id` = '".$p_id."'")->row()->ttl_qty;
                            $mr_qty = ($quantity + $last_qty);

                            $po_qty = $this->db->query("SELECT `qty` FROM `tblpurchaseorderproduct` WHERE `po_id`='".$po_number."' and `product_id` = '".$p_id."'")->row()->qty;

                            if($po_qty > $mr_qty){
                                $complete = 0;
                            }
                            $this->home_model->update('tblpurchaseorder', array('complete'=>$complete),array('id'=>$po_number));
                        }
                    }
                }

                $id = $this->Purchase_model->edit_mr($mr_id, $post_data);
           	if(!empty($post_data['complete'])){
           	    $this->home_model->update('tblpurchaseorder', array('complete'=>1),array('id'=>$post_data['po_number']));
           	}

	        // If file upload form submitted
                $this->upload_mr_receipts($id);

            if ($id) {
                set_alert('success', "Material Receipt update successfully");
                redirect(admin_url('purchase/receipt_list/'));
            }
    	}

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='21'")->result_array();
        $i = 0;
        $stafff = [];
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

    	$data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();
    	$data['materialreceipt_info'] = $this->db->query("SELECT * from tblmaterialreceipt where id = ".$mr_id." ")->row();
        if (!empty($data['materialreceipt_info'])){
            $po_id = $data['materialreceipt_info']->po_id;
            $data["po_info"] = $this->db->query("SELECT * from tblpurchaseorder where id = ".$po_id."")->row();
        }
        $data['file_info'] = $this->db->query("SELECT * from tblmaterialreceiptfiles where mr_id = '".$mr_id."'")->result();
        $data['quality_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 1")->row();
        $data['stock_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 2")->row();
        $data['purchase_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 3")->row();
        $data['unitlist'] = $this->db->query("SELECT * FROM tblunitmaster WHERE `status`='1' ORDER BY name ASC ")->result();
    	$data['title'] = 'Material Receipt';
        $data["staff_list"] = get_staff_list();
        $this->load->view('admin/purchase/material_receipt', $data);
    }

    /* this function use for mr gas edit*/
    public function mr_gas_edit($mr_id){

        if(!empty($_POST)){
            extract($this->input->post());
            $post_data = $this->input->post();

            /*echo '<pre/>';
            print_r($post_data);
            die;*/
           $id = $this->Purchase_model->edit_mr_gas($mr_id, $post_data);

            // If file upload form submitted
            $this->upload_mr_receipts($id);
            if ($id) {
                set_alert('success', "Material Receipt update successfully");
                redirect(admin_url('purchase/receipt_list/'));
            }

        }


        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='21'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ")->result_array();
        $data['item_data'] = $this->db->query("SELECT `id`,`name`, `sub_name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 ")->result_array();
        $data['materialreceipt_info'] = $this->db->query("SELECT * from tblmaterialreceipt where id = ".$mr_id." ")->row();
        $data['mr_product_list'] = $this->db->query("SELECT * from  tblmaterialreceiptproduct where mr_id = ".$mr_id." ")->result_array();

        $data['quality_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 1")->row();
        $data['stock_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 2")->row();
        $data['purchase_assign_person'] = $this->db->query("SELECT * FROM tblmaterialreceiptapproval WHERE `mr_id` = '".$mr_id."' AND `type` = 3")->row();
        $data['file_info'] = $this->db->query("SELECT * from tblmaterialreceiptfiles where mr_id = '".$mr_id."'")->result();
        $data['title'] = 'Material Receipt (Gas)';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/purchase/material_receipt_gas', $data);
    }

    /* this function use for add purchase debit note reqgistered */
    public function po_debitnote_registered_add($id) {
        $data['purchaseorder_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();

        if(!empty($_POST)){
            $proposal_data = $this->input->post();
//            echo '<pre>';
//            print_r($proposal_data);
//            exit;
            $insert = $this->Purchase_model->add_po_debitnote_payment($proposal_data);

            if ($insert) {
                set_alert('success', _l('added_successfully', 'purchase order Debitnote Payment'));
                redirect(admin_url('purchase/purchaseorder_payments/'.$id));
            }
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data["ttl_debit_amount"] = 0.00;
        $data["paid_amount"] = 0.00;
        $po_debitnote = $this->db->query("SELECT id, totalamount FROM `tblpurchasedabitnote`  WHERE vender_id = '".$data['purchaseorder_info']->vendor_id."' AND complete = 0")->result();
        if (!empty($po_debitnote)){
            foreach ($po_debitnote as $value) {
                $paid_amt = $this->db->query("SELECT COALESCE(sum(pdr.amount),0) as ttl_amt FROM `tblpurchasedebitnoteregistered` as pdr LEFT JOIN `tblpurchaseorderpayments` as pop ON pdr.payment_id = pop.id WHERE pdr.`debitnote_id` = " . $value->id . " AND pdr.status = 1 AND pop.status in (0,1)")->row()->ttl_amt;
                $data["ttl_debit_amount"] += $value->totalamount;
                $data["paid_amount"] += $paid_amt;
            }
        }

        $data['title']     = 'Add Purchase Debitnote Registered (PO-'.$data['purchaseorder_info']->number.')';
        $this->load->view('admin/purchase/purchaseorder_debitnote_registered', $data);

    }

    /* this function use get purchase debitnote details */
    public function get_purchasedebitnote_table()
    {
    	if ($this->input->post()) {
            extract($this->input->post());
            $po_debitnote = $this->db->query("SELECT * FROM `tblpurchasedabitnote` as pdn LEFT JOIN `tblpurchasechallanreturn` as pcr ON pcr.id = pdn.parchasechallanreturn_id WHERE pcr.po_id = '".$po_id."' AND pdn.complete = 0")->result();

            if(!empty($po_debitnote)){
	?>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body">
                            <div style="padding:5px;margin-bottom:5%;">
                                <h4 class="modal-title pull-left">Add Debit Note Detials</h4>
                            </div>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th width="10%" align="center">S.No.</th>
                                        <th width="20%" align="center">Debit No.</th>
                                        <th width="20%" align="center">Balance Amt</th>
                                        <th width="20%" align="center">Payble Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                <?php
                                    foreach ($po_debitnote as $key => $row) {

                                        $paid_amt = $this->db->query("SELECT COALESCE(sum(pdr.amount),0) as ttl_amt FROM `tblpurchasedebitnoteregistered` as pdr LEFT JOIN `tblpurchaseorderpayments` as pop ON pdr.payment_id = pop.id WHERE pdr.`debitnote_id` = ".$row->id." AND pdr.status = 1 AND pop.status in (0,1)")->row()->ttl_amt;
                                        $balance_amt = ($row->totalamount - $paid_amt);
                                ?>
                                    <input type="hidden" value="<?php echo $row->id; ?>" name="debitnote_id[]">
                                    <input type="hidden" value="<?php echo $po_id; ?>" name="po_id">
                                    <tr class="main">
                                        <td width="10%" align="center"><?php echo ++$key; ?></td>
                                        <td width="20%" align="center"><a href="<?php echo base_url("admin/purchasechallanreturn/download_debitnotepdf/" . $row->id); ?>" target="_blank"><?php echo 'PDN-' . str_pad($row->id, 4, '0', STR_PAD_LEFT) . ' - (' . _d($row->date) . ')'; ?></a></td>
                                        <td width="20%" align="center"><?php echo number_format($balance_amt, 2); ?></td>
                                        <td width="20%" align="center">
                                            <input class="form-control debitnote_amt" type="text" name="<?php echo 'amount_' . $row->id; ?>" value="0">
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
	<?php
            }
	}
    }

    /* this function use for delivery challan return */
    public function deliverychallan_return($challanid=0) {

        if(!empty($_POST)){
            extract($this->input->post());
            $post_data = $this->input->post();

            /*echo '<pre/>';
            print_r($post_data);
            die; */

           $id = $this->Purchase_model->addDeliveryChallanReturn($post_data);

           //Make delivery challan as complete if quantity is match

            if(!empty($post_data['complete'])){
                $this->home_model->update('tbljobdelivarychallan', array('complete'=>1),array('id'=>$post_data['challan_number']));
            }

            // If file upload form submitted
            $this->upload_mr_receipts($id);


            if ($id) {
                set_alert('success', _l('added_successfully', 'purchase order'));
                redirect(admin_url('purchase/receipt_list/'));
            }

        }


        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='21'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();

        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 order by name asc")->result_array();
        $data['dchallan_info'] = $this->db->query("SELECT * from tbljobdelivarychallan where id = '".$challanid."' ")->row_array();

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status= '1' order by name asc ")->result_array();
        $data['unit_list'] = $this->db->query("SELECT * from tblunitmaster where status = '1' order by name asc")->result();
        $data['title'] = 'Delivery Challan';
        $this->load->view('admin/purchase/deliverychallan_return', $data);
    }

    public function get_deliverychallan_number() {

    	extract($this->input->post());

        $challan_info = $this->db->query("SELECT * FROM `tbljobdelivarychallan` WHERE `vendor_id`='".$vendor_id."' and status = 1 and complete = 0")->result();
        $html = '';
        if(!empty($challan_info)){
            $html .= '<option value=""></option>';
            foreach ($challan_info as $key => $value) {
                $html .= '<option value="'.$value->id.'">'.'JDC-'.$value->id.' - '._d($value->date).'</option>';
            }
        }
        echo $html;
    }

    /* this function use for upload images */
    public function upload_mr_receipts($id){

        if(!empty($_FILES['files']['name'])){

            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                // File upload configuration
                $config['upload_path'] = MR_IMAGES_FOLDER;
                //$config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['allowed_types'] = '*';
                $config['encrypt_name'] = TRUE;

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $ad_data_1 = array(
                                'mr_id' => $id,
                                'file' => $fileData['file_name'],
                                'created_at' => date('Y-m-d H:i:s')
                            );
                    $this->home_model->insert('tblmaterialreceiptfiles',$ad_data_1);
                }else{
                    /*$error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die;*/
                }
            }
        }
    }

    /* this function use for delete mr receipts */
    public function delete_mr_receipts($id, $section="mr"){
        $mr_receipts_info = $this->db->query("SELECT * FROM `tblmaterialreceiptfiles` WHERE `id`='".$id."'")->row();
        if($mr_receipts_info){
            $response = $this->home_model->delete("tblmaterialreceiptfiles", array("id" => $id));
            if($response){
                $receiptpath = MR_IMAGES_FOLDER.$mr_receipts_info->file;
                unlink($receiptpath);
                set_alert('success', "Successfully removed receipts");
            }
        }
        $redirect_url = ($section=="invoice") ? "purchase/invoice_list":"purchase/receipt_list";
        redirect(admin_url($redirect_url));
    }

    /* this function use for delete purchase invoice receipts */
    public function delete_purchase_invoice($id){
        $invoice_info = $this->db->query("SELECT * FROM `tblfiles` WHERE `id`='".$id."'")->row();
        if($invoice_info){
            $response = $this->home_model->delete("tblfiles", array("id" => $id));
            if($response){
                $path = get_upload_path_by_type("purchase_invoice") . $id . '/';
                $receiptpath = $path.$invoice_info->file_name;
                unlink($receiptpath);
                set_alert('success', "Successfully removed invoice");
            }
        }

        redirect(admin_url("purchase/invoice_list"));
    }

    /* this is function use for invoice upload */
    public function invoice_uploads(){
        if(!empty($_POST)){

            extract($this->input->post());
            if ($invoice_id) {

                handle_multi_attachments($invoice_id,'purchase_invoice');
                set_alert('success', "Successfully Invoice Uploaded");
            }
        }
        redirect(admin_url("purchase/invoice_list"));
    }

    /* this function use for mr upload data */
    public function get_invoice_mr_uploads_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($mr_ids)){
                $mr_ids = explode(",", $mr_ids);
                foreach ($mr_ids as $mr_id) {
                    echo '<div class="panel_s"><div class="panel-body">';
                    echo '<h4>No. : MR-'.$mr_id.' </h4>';
                    $file_info = $this->db->query("SELECT * FROM tblmaterialreceiptfiles WHERE `mr_id` = ".$mr_id." ")->result();
                    if(!empty($file_info)){
            ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table ui-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Uploads File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($file_info as $key => $file) {
                                        ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><a target="_blank" href="<?php echo base_url("uploads/material_receipt/" . $file->file); ?>"><?php echo $file->file; ?></a>&nbsp;&nbsp;<image class="pull-right" src="<?php echo base_url("uploads/material_receipt/" . $file->file); ?>" width="50px" height="50px"></td>
                                            <td><a class="btn btn-danger _delete" href="<?php echo admin_url("purchase/delete_mr_receipts/" . $file->id."/invoice"); ?>"><i class="fa fa-trash"></i></a></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

            <?php
                    }
            ?>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo admin_url('purchase/mr_upload/invoice'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                                        <input type="file" id="file" multiple="" name="files[]" style="width: 100%;height: auto;padding: 10px 15px;">
                                    </div>
                                    <input type="hidden" id="mr_id" name="mr_id" value="<?php echo $mr_id; ?>">
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-info" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                    echo '</div></div>';
                }
            }
        }
    }

    /* this function use get invoice uploads data */
    public function get_invoice_uploads_data(){
        if(!empty($_POST)){
            extract($this->input->post());

                echo '<h4>Invoice No. : Inv-'.str_pad($id, 4, "0", STR_PAD_LEFT)."</h4>";
                $document_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$id."' and rel_type = 'purchase_invoice'")->result();
                if(!empty($document_info)){
            ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table ui-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Uploads File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($document_info as $key => $file) {
                                        ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><a download target="_blank" href="<?php echo base_url("uploads/purchase_invoice/".$id."/".$file->file_name); ?>"><?php echo $file->file_name; ?></a>&nbsp;&nbsp;<image class="pull-right" src="<?php echo base_url("uploads/purchase_invoice/".$id."/".$file->file_name); ?>" width="50px" height="50px"></td>
                                            <td><a class="btn btn-danger _delete" href="<?php echo admin_url("purchase/delete_purchase_invoice/" . $file->id); ?>"><i class="fa fa-trash"></i></a></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <?php
                    }
        }
    }

    /* this function use for add po refund request */
    public function po_refund_request($id) {
        $data['purchaseorder_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();

        if(!empty($_POST)){
            $proposal_data = $this->input->post();
            $insert = $this->Purchase_model->addPORefundPayment($proposal_data);
            if ($insert) {
                set_alert('success', 'Purchase order refund request add successfully');
                redirect(admin_url('purchase/purchaseorder_payments/'.$id));
            }
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $pettycashStaffgroup =  get_staff_group(18,get_staff_user_id());
        
        $i=0;
        $pettycashstafff = array();
        foreach($pettycashStaffgroup as $singlestaff)
        {
            $pettycashstafff[$i]['id']=$singlestaff['id'];

            $pettycashstafff[$i]['name']=$singlestaff['name'];

            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='".get_staff_user_id()."'")->result_array();

            $pettycashstafff[$i]['staffs']=$query;
            $i++;
        }

        $data['allStaffdata'] = $stafff;
        $data['pettycashassign'] = $pettycashstafff;

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' ")->result();
        $data['paytype_info'] = $this->db->query("SELECT * FROM  tblpaymenttypes")->result();
        $data['pettycash_list'] = $this->db->query("SELECT * FROM tblpettycashmaster WHERE `status` = 1 and `staff_confirmed` = 1")->result();
        $data['title']     = 'Add Purchase Order Refund Request (PO-'.$data['purchaseorder_info']->number.')';
        $this->load->view('admin/purchase/purchaseorder_refund_add', $data);
    }

    /* this function use for po refund payment request */
    public function po_refund_request_approval($id){
        if(!empty($_POST)){
            extract($this->input->post());
            // echo "<pre>";
            // print_r($_POST);
            // exit;
            $ad_data = array(
                'approve_status' => $submit,
                'approvereason' => $remark,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->home_model->update('tblpurchaserefundpaymentapproval', $ad_data,array('refund_id'=>$id,'staffid'=>get_staff_user_id()));

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),40,$id,$submit);
            update_masterapproval_all(40,$id,$submit);

            /* this code use for approve the payment */
            if ($submit == 1){
               $this->home_model->update('tblpurchaseorderrefundpayment', array("status" => 1),array('id'=>$id));
               $refund_info = $this->db->query("SELECT * from tblpurchaseorderrefundpayment where id = '".$id."' ")->row();

               //managing pettycash log and sending notification for pettycash approval
               if($refund_info->refund_to == 2 && $refund_info->pettycash_id > 0 && !empty($refund_info->pettycash_assigned_ids)){

                    $add_req = array( 
                            'amount' => $refund_info->amount,
                            'reason' => 'Po Payment Refund',
                            'description' => 'Generated By System',
                            'group_ids' => $refund_info->pettycash_assigned_ids,
                            'refund_id' => $refund_info->id,
                            'cash_received' => 1,
                            'date' => date('Y-m-d'),
                            'dateadded' => date('Y-m-d H:i:s'),
                            'addedfrom' => value_by_id("tblpettycashmaster", $refund_info->pettycash_id, "staff_id")
                        );


                    $insert = $this->db->insert('tblpettycashrequest',$add_req);

                    $staffid = explode(',',$refund_info->pettycash_assigned_ids);

                    if(!empty($staffid) && ($insert == true)){

                        $pettycash_request_id = $this->db->insert_id();   


                        foreach($staffid as $singlelead)
                        {
                            if($singlelead!=0)
                            {
                            $prdata['staff_id']=$singlelead;
                            $prdata['pettycash_id']=$pettycash_request_id;
                            $prdata['status']=1;
                            $prdata['created_at'] = date("Y-m-d H:i:s");
                            $prdata['updated_at'] = date("Y-m-d H:i:s");
                            $this->db->insert('tblpettycashrequestapproval',$prdata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($singlelead);
                            $message = 'Petty Cash Request Send to you for Approval';
                            $title = 'Schach';

                                sendFCM($message, $title, $token);
                            
                                $full_name = get_employee_fullname($refund_info->added_by);       
                                $notified_data = array(
                                            'description'     => 'Petty Cash Request Send to you for Approval',
                                            'touserid'        => $singlelead,
                                            'fromuserid'      => $refund_info->added_by,
                                            'module_id'        => 9,
                                            'type'            => 1,
                                            'table_id'        => $pettycash_request_id,
                                            'from_fullname'    => $full_name,
                                            'date'             => date('Y-m-d H:i:s'),


                                );  
                                $this->home_model->insert('tblnotifications', $notified_data);

                            }
                        }
                    }

               }
            }else{
                $this->home_model->update('tblpurchaseorderrefundpayment', array("status" => $submit),array('id'=>$id));
            }
            if($update){
                 set_alert('success', 'Action taken succesfully');
                 redirect(admin_url('approval/notifications'));
            }
        }

        $data['id'] = $id;
        $data['payment_info'] = $this->db->query("SELECT * from tblpurchaseorderrefundpayment where id = '".$id."' ")->row_array();
        $data['title'] = 'Purchase Order Refund Payment Request';

        $data['appvoal_info'] = $this->db->query("SELECT * from tblpurchaserefundpaymentapproval where refund_id = '".$id."' and staffid = '".get_staff_user_id()."' and approve_status != 0 ")->row();
        $this->load->view('admin/purchase/purchaseorder_refundrequest', $data);
    }

    /* this function use for delete purchase refund payment */
    public function delete_purchaserefundpayment($id) {
        $delete = $this->home_model->delete('tblpurchaseorderrefundpayment',array('id'=>$id));
        if($delete == true){
            $this->home_model->delete('tblpurchaserefundpaymentapproval',array('refund_id'=>$id));
            $this->home_model->delete('tblmasterapproval',array('module_id'=>40,'table_id'=>$id));
            set_alert('success', 'Purchase Order Refund Request deleted successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /* this function use for po payment Adjustment */
    public function po_payment_adjustment($id){
        $data['purchaseorder_info'] = $this->db->query("SELECT * FROM `tblpurchaseorder` where `id` =  '".$id."' ")->row();
        if(!empty($_POST)){
            $proposal_data = $this->input->post();
            if ($proposal_data["amount"] > 0){
                $insert = $this->Purchase_model->add_po_payment($proposal_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'purchase order Payment'));
                    redirect(admin_url('purchase/purchaseorder_payments/'.$id));
                }
            }else{
                set_alert('warning', "Amount Should be grather then zero.");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = 'Add Purchase Order Payments (PO-'.$data['purchaseorder_info']->number.')';
        $this->load->view('admin/purchase/purchaseorder_payment_adjustment', $data);
    }

    /* this function use for get refund payment info */
    public function getRefundPaymentInfo(){
       if(!empty($_POST)){
          extract($this->input->post());
          $refundinfo = $this->db->query("SELECT * FROM `tblpurchaseorderrefundpayment` WHERE `id` = '".$id."'")->row();
          if (!empty($refundinfo)){ ?>
             <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <?php if (!empty($refundinfo->payment_date)) { ?>  
                            <tr>
                              <th>Payment Date</th>
                              <td><?php echo $refundinfo->payment_date; ?></td>
                            </tr>
                            <?php } 
                            if (!empty($refundinfo->reference_no)) { ?>    
                            <tr>
                              <th>Reference No</th>
                              <td><?php echo $refundinfo->reference_no; ?></td>
                            </tr>
                            <?php }
                            if ($refundinfo->payment_type_id > 0){ ?>
                            <tr>
                              <th>Payment Types</th>
                              <td><?php echo value_by_id("tblpaymenttypes", $refundinfo->payment_type_id, "name"); ?></td>
                            </tr>
                            <?php } 
                                if ($refundinfo->bank_id > 0){   
                            ?>
                            <tr>
                              <th>Bank</th>
                              <td><?php echo value_by_id("tblbankmaster", $refundinfo->bank_id, "name"); ?></td>
                            </tr>
                            <?php }
                                if ($refundinfo->payment_mode > 0){
                            ?>
                            <tr>
                              <th>Payment Mode</th>
                              <td><?php
                                if (!empty($refundinfo)){
                                    switch ($refundinfo->payment_mode) {
                                      case '1':
                                        echo 'Cheque';
                                        break;
                                      case '2':
                                        echo 'NEFT';
                                        break;
                                      case '3':
                                        echo 'Cash';
                                        break;
                                    }
                                }
                              ?></td>
                            </tr>
                            <?php } ?>
                            <?php if (isset($refundinfo) && $refundinfo->payment_mode == 1) { ?>
                            <tr>
                              <th>Cheque For</th>
                              <td>
                                <?php
                                    if (!empty($refundinfo)){
                                        echo ($refundinfo->chaque_for == "1") ? "Post Date" : "Current Date";
                                    }else{
                                        echo "--";
                                    }
                                 ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Cheque No</th>
                              <td>
                                <?php echo (!empty($refundinfo) && !empty($refundinfo->cheque_no)) ? $refundinfo->cheque_no : "--"; ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Cheque Date</th>
                              <td>
                                <?php echo (!empty($refundinfo) && !empty($refundinfo->cheque_date)) ? _d($refundinfo->cheque_date) : "--"; ?>
                              </td>
                            </tr>
                            <?php } ?>
                            <?php 
                                if ($refundinfo->pettycash_id > 0){
                                    $staff_id = value_by_id("tblpettycashmaster", $refundinfo->pettycash_id, "staff_id");
                                    $employee_name = get_employee_name($staff_id);
                            ?>
                                <tr>
                                    <th>Petty Cash</th>
                                    <td>
                                        <?php echo value_by_id("tblpettycashmaster", $refundinfo->pettycash_id, "department_name")." - ".$employee_name; ?>
                                    </td>
                                </tr>
                            <?php        
                                }
                            ?>
                            <tr>
                              <th>Remark</th>
                              <td>
                                <?php echo (!empty($refundinfo) && !empty($refundinfo->remark)) ? cc($refundinfo->remark) : "--"; ?>
                              </td>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>
             </div>
          <?php }
       }
    }

    /* this function use for get material upload and purchase invoice data */
    public function get_mr_uploaded_files(){
      if(!empty($_POST)){
         extract($this->input->post());
          if ($type == "material_receipt"){
              $filesdata = $this->db->query("SELECT `f`.* FROM `tblmaterialreceipt` as `mr` JOIN `tblmaterialreceiptfiles` as `f` ON `mr`.`id` = `f`.`mr_id` WHERE `po_id` = '".$po_id."'")->result();
      ?>
                  <div class="row">
                      <div class="col-md-12">
                          <h4>Material Receipts Uploaded Files </h4>
                          <hr>
                      </div>
                      <div class="col-md-12">
                      <?php
                          if (!empty($filesdata)){
                              foreach ($filesdata as $key => $value) {
                      ?>
                                <div class="col-md-3" style="border: 2px solid;margin:10px;">
                                    <a href="<?php echo base_url('uploads/material_receipt/'.$value->file); ?>" target="_blank" >
                                        <img src="<?php echo base_url('uploads/material_receipt/'.$value->file); ?>" alt="<?php echo $value->file; ?>" style="padding:10px;" width="100" height="100">
                                    </a>
                                </div>
                      <?php
                              }
                          }else{
                              echo "<p style='text-align:center;'>Record Not Found</p>";
                          }
                     ?>
                      </div>
                  </div>
      <?php
          }else{
            $filesdata = $this->db->query("SELECT `f`.`id`,`f`.`file_name`, `pi`.`id` as `pi_id` FROM `tblpurchaseinvoice` as `pi` JOIN `tblfiles` as `f` ON `pi`.`id` = `f`.`rel_id` AND `rel_type`= 'purchase_invoice' WHERE `po_id` ='".$po_id."'")->result();
    ?>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Purchase Invoice Uploaded Files </h4>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <?php
                        if (!empty($filesdata)){
                            foreach ($filesdata as $key => $value) {
                        ?>
                              <div class="col-md-3" style="border: 2px solid;margin:10px;">
                                  <a href="<?php echo base_url('uploads/purchase_invoice/'.$value->pi_id.'/'.$value->file_name); ?>" target="_blank" >
                                      <img src="<?php echo base_url('uploads/purchase_invoice/'.$value->pi_id.'/'.$value->file_name); ?>" alt="<?php echo $value->file_name; ?>" style="padding:10px;" width="100" height="100">
                                  </a>
                              </div>
                        <?php
                            }
                        }else{
                            echo "<p style='text-align:center;'>Record Not Found</p>";
                        }
                      ?>
                    </div>
                </div>
    <?php

          }
       }
    }

    public function get_handover_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $process_info = $this->db->query("SELECT * from tblchallanprocess where `type`=2 and `po_id` = '".$po_id."' and `for` = '".$type."' and complete = 1 ")->row();

            if(!empty($process_info)){
                $handoverlog_info = $this->db->query("SELECT * from tblhandoverlog where handover_id = '".$process_info->handover_id."' order by id asc ")->result();
                $handover_info = $this->db->query("SELECT * from tblhandover where id = '".$process_info->handover_id."' ")->row();
            }
            if(!empty($handover_info) && ($handover_info->final_receive == 1)){
                echo '<h5 class="text-success">Document Reached to Final Receiver ('.get_employee_name($handover_info->receiver_id).')</h5>';
            }
            ?>
            <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Sender Remark</th>
                        <th>Receiver Remark</th>
                        <th>Status</th>
                        <th>Receive Date</th>
                        <th>Attachments</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($handoverlog_info)){
                        foreach ($handoverlog_info as $key => $value) {
                            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'handover' and rel_id = '".$value->id."' ")->result();
                            ?>
                         <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><?php echo get_employee_name($value->sender_staff_id);?></td>
                            <td><?php echo get_employee_name($value->receiver_id);?></td>
                            <td><?php echo (!empty($value->sender_remark)) ? $value->sender_remark : '--'; ?></td>
                            <td><?php echo (!empty($value->receiver_remark)) ? $value->receiver_remark : '--'; ?></td>
                            <td><?php echo ($value->received_status == 1) ? 'Received' : 'Not Received'; ?></td>
                            <td><?php echo ($value->receive_date > 0) ? _d($value->receive_date) : '--'; ?></td>
                            <td><?php
                                if(!empty($file_info)){
                                    foreach ($file_info as $file) {
                                        ?>
                                        <a target="_blank" href="<?php echo base_url('uploads/handover/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
                                        <?php
                                    }
                                }else{
                                    echo '--';
                                }
                                ?>
                            </td>
                         </tr>
                         <?php
                        }
                    }else{
                        echo '<tr><td colspan="8" class="text-center">Record Not Found!</td></tr>';
                    }
                    ?>
                     </tbody>
                </table>
            </div>
            <?php

        }
      }

      public function make_complete($id) {
          $update = $this->home_model->update('tblchallanprocess', array('final_complete'=>1), array('id'=>$id));

          set_alert('success', 'Pickup Challan completed successfully');
          redirect(admin_url('purchase'));
      }

      public function make_delivery() {
            if(!empty($_POST)){
                extract($this->input->post());

                $challan_manage_id = $this->db->query("SELECT `challan_manage_id` FROM `tblcompanybranch` WHERE `id` = '".$branch_id."' ")->row()->challan_manage_id;
                if(empty($challan_manage_id)){
                    set_alert('warning', 'Responsible person is not allotted to handle this request!');
                    redirect(admin_url('purchase'));
                    die;
                }

                $delivery_date = str_replace("/","-",$delivery_date);
                $delivery_date = date("Y-m-d",strtotime($delivery_date));

                $insert_data = array(
                            'staff_id' => get_staff_user_id(),
                            'po_id' => $po_id,
                            'type' => 2,
                            'for' => $for,
                            'priority' => $priority,
                            'date' => $delivery_date,
                            'description' => $description,
                            'status' => 1,
                            'status_id' => 1,
                            'text_status' => 'Pickup challan assign',
                            'created_at' => date('Y-m-d')
                        );

                $insert = $this->home_model->insert('tblchallanprocess', $insert_data);
                if($insert == true){

                    $challanprocess_id = $this->db->insert_id();

                    $this->home_model->update('tblpurchaseorder', array('under_process'=>1), array('id'=>$po_id));

                    /*if(!empty($staff_info)){
                        foreach($staff_info as $row)
                        {*/
                            $staffid = $challan_manage_id;

                            $prdata['staff_id']=$staffid;
                            $prdata['challanprocess_id']=$challanprocess_id;
                            $prdata['status']=1;
                            $this->db->insert('tblchallanallotperson',$prdata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'SSAFE';
                            $send_intimation = sendFCM($message, $title, $token);

                            $notified = add_notification([
                                        'description'     => 'Pickup challan allotted to you assign',
                                        'touserid'        => $staffid,
                                        'fromuserid'      => get_staff_user_id(),
                                        'module_id'        => 10,
                                        'type'            => 0,
                                        'table_id'        => $challanprocess_id,
                                        'category_id'        => $for,
                                        'link'            => '#',

                                    ]);
                                    if ($notified) {
                                        pusher_trigger_notification([$staffid]);
                                    }
                        /*}
                    }*/
                    set_alert('success', 'Pickup Challan allotted successfully to manager');
                    redirect(admin_url('purchase'));
                }
            }
      }

    /* this is for dashboard of PO, MR, Invoices, Payment of PO*/

    public function po_dashboard(){
        $data["title"] = "Purchase Order Dashboard";
        
        $data["month_arr"] = "";
        $data["ttlpoamount"] = "";
        $data["ttlpaymentamount"] = "";
        $year_id = financial_year();
        $data["financial_year_id"] = $year_id;
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($financial_year_id)){
                $data["financial_year_id"] = $financial_year_id;
                $year_id = $financial_year_id;
            }
        }
        $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
        $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");

        /* this is for get financial date year */
        $dt1 = new DateTime("$from_date");
        $dt2 = new DateTime("$to_date");
        $dp = new DatePeriod($dt1, new DateInterval('P1M'), $dt2);
        foreach ($dp as $k => $d) {
            $prefix = ($k > 0) ? ', ' : '';
            $data["month_arr"] .= $prefix.'"'.$d->format('M-Y').'"';
            $data["ttlpoamount"] .= $prefix.$this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt FROM `tblpurchaseorder` WHERE YEAR(`date`) = '".$d->format('Y')."' AND MONTH(`date`) = '".$d->format('m')."' AND `show_list` = 1 AND `status` = 1 ")->row()->ttlamt;
            $data["ttlpaymentamount"] .= $prefix.$this->db->query("SELECT COALESCE(SUM(approved_amount),0) as ttlamt FROM `tblpurchaseorderpayments` WHERE YEAR(`created_at`) = '".$d->format('Y')."' AND MONTH(`created_at`) = '".$d->format('m')."' AND payfile_done = 1 AND utr_no != '' AND status = 1 ")->row()->ttlamt;
        }

        /* this is for purchase order section */
        $data["current_week_po"] = $this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseorder` WHERE YEARWEEK(`date`) = YEARWEEK(CURDATE()) AND `show_list` = 1 AND `status` = 1 ")->row();
        $data["current_month_po"] = $this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseorder` WHERE YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `show_list` = 1 AND `status` = 1 ")->row();
        $data["current_year_po"] = $this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseorder` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `show_list` = 1 AND `status` = 1 ")->row();

        /* this is for payment section */
        $data["current_week_payment"] = $this->db->query("SELECT COALESCE(SUM(approved_amount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseorderpayments` WHERE YEARWEEK(`created_at`) = YEARWEEK(CURDATE()) AND `payfile_done` = 1 AND `utr_no` != '' AND `status` = 1 ")->row();
        $data["current_month_payment"] = $this->db->query("SELECT COALESCE(SUM(approved_amount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseorderpayments` WHERE YEAR(`created_at`) = '".date('Y')."' AND MONTH(`created_at`) = '".date('m')."' AND `payfile_done` = 1 AND `utr_no` != '' AND `status` = 1 ")->row();
        $data["current_year_payment"] = $this->db->query("SELECT COALESCE(SUM(approved_amount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseorderpayments` WHERE `created_at` BETWEEN '".$from_date."' AND '".$to_date."' AND `payfile_done` = 1 AND `utr_no` != '' AND `status` = 1 ")->row();
        
        /* this is for material receipt section */
        $data["current_week_mr"] = $this->db->query("SELECT COUNT(id) as ttlcount FROM `tblmaterialreceipt` WHERE `po_id` != '' AND `status` = 1 AND YEARWEEK(`date`) = YEARWEEK(CURDATE())")->row();
        $data["current_month_mr"] = $this->db->query("SELECT COUNT(id) as ttlcount  FROM `tblmaterialreceipt` WHERE YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `po_id` != '' AND `status` = 1 ")->row();
        $data["current_year_mr"] = $this->db->query("SELECT COUNT(id) as ttlcount  FROM `tblmaterialreceipt` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `po_id` != '' AND `status` = 1 ")->row();
        $overduemrcount = 0;
        $getpo = $this->db->query("SELECT `id`,`expected_mr_date` FROM `tblpurchaseorder` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `expected_mr_date` != '' AND `show_list` = 1 AND `status` = 1")->result();
        
        if (!empty($getpo)){
            foreach ($getpo as $value) {
                if ($value->expected_mr_date < date('Y-m-d')){
                    $mrdata = $this->db->query("SELECT id FROM `tblmaterialreceipt` WHERE `po_id`= '".$value->id."' ")->row();
                    if (empty($mrdata)){
                        $overduemrcount += 1;
                    }
                }
            }
        }
        
        $data["overdue_mr"] = $overduemrcount;

        /* this is for invoice section */
        $data["current_week_invoice"] = $this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseinvoice` WHERE YEARWEEK(`date`) = YEARWEEK(CURDATE()) AND `status` = 1 ")->row();
        $data["current_month_invoice"] = $this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseinvoice` WHERE YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `status` = 1 ")->row();
        $data["current_year_invoice"] = $this->db->query("SELECT COALESCE(SUM(totalamount),0) as ttlamt, COUNT(id) as ttlcount  FROM `tblpurchaseinvoice` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `status` = 1 ")->row();
        $overdueinvoicecount = 0;
        $getmr = $this->db->query("SELECT `id`,`date` FROM `tblmaterialreceipt` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `invoice_status` = 0 AND `status` = 1")->result();
        if (!empty($getmr)){
            foreach ($getmr as $value) {
                $overduedate = date('Y-m-d', strtotime('+1 day', strtotime($value->date)));
                $day = date("D", strtotime($overduedate));
                /* Check day have sunday or not */
                if ($day == 'Sun'){
                    $overduedate = date('Y-m-d', strtotime('+1 day', strtotime($overduedate)));
                }
                /* Check day have holiday or not */
                if (is_holiday($overduedate)){
                    $overduedate = date('Y-m-d', strtotime('+1 day', strtotime($overduedate)));
                }
                if ($overduedate <= date('Y-m-d')){
                    $overdueinvoicecount += 1;
                }
            }
        }
        
        $data["overdue_invoice"] = $overdueinvoicecount;
        $data["financial_year_list"] = $this->db->query("SELECT `id`,`name` FROM `tblfinancialyear` WHERE `status`='1' ORDER BY `name` DESC")->result();
        $this->load->view('admin/purchase/po_dashboard', $data);
    }

    /* this function use for purchase order list */
    public function purchaseorder_list($type, $year_id = '0'){
        $data["title"] = "Purchase Order List";

        if ($type == "week"){
            $data["title"] = "Purchase Order Weekly List";
            $data["po_data"] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE YEARWEEK(`date`) = YEARWEEK(CURDATE()) AND `show_list` = 1 AND `status` = 1 ")->result();
        }else if ($type == "month"){
            $data["title"] = "Purchase Order Monthly List";
            $data["po_data"] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `show_list` = 1 AND `status` = 1 ")->result();
        }else if ($type == "year"){
            $year_id = ($year_id > 0) ? $year_id : financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");
            $data["title"] = "Purchase Order Yearly List";
            $data["po_data"] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `show_list` = 1 AND `status` = 1 ")->result();
        }else if ($type == 'division' && !empty($_GET["division_id"])) {
            $divisionid = $_GET["division_id"];
            $where = "`division_id`='".$divisionid."' AND YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."'";
            if (!empty($_GET["fromdate"]) && !empty($_GET["todate"])){
                $fromdate = $_GET["fromdate"];
                $todate = $_GET["todate"];
                $where = "`division_id`='".$divisionid."' AND `date` BETWEEN '".$fromdate."' AND '".$todate."'";
            }
            $data["po_data"] = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE $where AND `show_list` = 1 AND `status` = 1 ")->result();
        }else if ($type == "overdue"){
            $year_id = ($year_id > 0) ? $year_id : financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");
            $data["title"] = "Purchase Order Overdue List";
            $data["po_data"] = array();
            $getpo = $this->db->query("SELECT `id`,`expected_mr_date`,`number`,`date`,`vendor_id`,`totalamount` FROM `tblpurchaseorder` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `expected_mr_date` != '' AND `show_list` = 1 AND `status` = 1")->result();
            if (!empty($getpo)){
                foreach ($getpo as $value) {
                    if ($value->expected_mr_date < date('Y-m-d')){
                        $mrdata = $this->db->query("SELECT id FROM `tblmaterialreceipt` WHERE `po_id`= '".$value->id."' ")->row();
                        if (empty($mrdata)){
                            $data["po_data"][] = $value;
                        }
                    }
                }
            }
        }

        $this->load->view('admin/purchase/po_list', $data);
    }

    /* this function use for purchase order show more details */
    public function po_more_details(){
        $data["title"] = "Purchase Order More Details";

        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
            $data['fromdate'] = $date_range['from_date'];
            $data['todate'] = $date_range['to_date'];
        }
        
        $data["ttlclosedpo"] = $this->db->query("SELECT COUNT(id) as ttlclosed  FROM `tblpurchaseorder` WHERE `complete` = 1 AND YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `show_list` = 1 AND `status` = 1 ")->row()->ttlclosed;
        $data["ttlopenpo"] = $this->db->query("SELECT COUNT(id) as ttlopen  FROM `tblpurchaseorder` WHERE `complete` = 0 AND YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `show_list` = 1 AND `status` = 1 ")->row()->ttlopen;
        $data['divisionmaster_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        $this->load->view('admin/purchase/po_more_details', $data);
    }

    /* this function use for purchase order Payment list */
    public function popayment_list($type, $year_id = 0){
        $data["title"] = "Payment List";

        if ($type == "week"){
            $data["title"] = "Payment Weekly List";
            $data["po_data"] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE YEARWEEK(`created_at`) = YEARWEEK(CURDATE()) AND `payfile_done` = 1 AND `utr_no` != '' AND `status` = 1 ")->result();
        }else if ($type == "month"){
            $data["title"] = "Payment Monthly List";
            $data["po_data"] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE YEAR(`created_at`) = '".date('Y')."' AND MONTH(`created_at`) = '".date('m')."' AND `payfile_done` = 1 AND `utr_no` != '' AND `status` = 1 ")->result();
        }else if ($type == "year"){
            $year_id = ($year_id > 0) ? $year_id : financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");
            $data["title"] = "Purchase Order Yearly List";
            $data["po_data"] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `created_at` BETWEEN '".$from_date."' AND '".$to_date."' AND `payfile_done` = 1 AND `utr_no` != '' AND `status` = 1 ")->result();
        }
        $this->load->view('admin/purchase/popayment_list', $data);
    }

    /* this function use for payment show more details */
    public function payment_more_details(){
        $data["title"] = "Payment More Details";
        $where = "id > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $where .= " and created_at between '".$date_range['from_date']."' and '".$date_range['to_date']."' AND ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
        }else{            
            $where .= " and YEAR(`created_at`) = '".date('Y')."' AND MONTH(`created_at`) = '".date('m')."' AND ";
        }
        $data["payment_data"] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE $where `payfile_done` = 1 AND `utr_no` != '' AND `status` = 1  ")->result();
        $data["payment_pendingdata"] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE $where `status` = 0")->result();
        $data["payment_approvaldata"] = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE $where `status` = 1 and `payfile_done` = 0")->result();
        $this->load->view('admin/purchase/popayment_more_details', $data);
    }

    /* this function use for Material Receipt list */
    public function mr_list($type, $year_id = 0){
        $data["title"] = "Material Receipt List";

        if ($type == "week"){
            $data["title"] = "Material Receipt Weekly List";
            $data["mr_data"] = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `po_id` != '' AND `status` = 1 AND YEARWEEK(`date`) = YEARWEEK(CURDATE())")->result();
        }else if ($type == "month"){
            $data["title"] = "Material Receipt Monthly List";
            $data["mr_data"] = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `po_id` != '' AND `status` = 1")->result();
        }else if ($type == "year"){
            $year_id = ($year_id > 0) ? $year_id : financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");
            $data["title"] = "Material Receipt Yearly List";
            $data["mr_data"] = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `po_id` != '' AND `status` = 1")->result();
        }else if ($type == "overdue"){
            $year_id = ($year_id > 0) ? $year_id : financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");
            $data["title"] = "Material Receipt Overdue List";
            $data["mr_data"] = array();
            $getmr = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `invoice_status` = 0 AND `status` = 1")->result();
            if (!empty($getmr)){
                foreach ($getmr as $value) {
                    $overduedate = date('Y-m-d', strtotime('+1 day', strtotime($value->date)));
                    $day = date("D", strtotime($overduedate));
                    /* Check day have sunday or not */
                    if ($day == 'Sun'){
                        $overduedate = date('Y-m-d', strtotime('+1 day', strtotime($overduedate)));
                    }
                    /* Check day have holiday or not */
                    if (is_holiday($overduedate)){
                        $overduedate = date('Y-m-d', strtotime('+1 day', strtotime($overduedate)));
                    }
                    if ($overduedate <= date('Y-m-d')){
                        $data["mr_data"][] = $value;
                    }
                }
            }
        }
        $this->load->view('admin/purchase/mr_list', $data);
    }

    /* this function use for purchase invoice list */
    public function purchaseinvoice_list($type, $year_id = 0){
        $data["title"] = "Purchase Invoice List";

        if ($type == "week"){
            $data["title"] = "Purchase Invoice Weekly List";
            $data["purchaseinvoice_data"] = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE `status` = 1 AND YEARWEEK(`date`) = YEARWEEK(CURDATE())")->result();
        }else if ($type == "month"){
            $data["title"] = "Purchase Invoice Monthly List";
            $data["purchaseinvoice_data"] = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE YEAR(`date`) = '".date('Y')."' AND MONTH(`date`) = '".date('m')."' AND `status` = 1")->result();
        }else if ($type == "year"){
            $year_id = ($year_id > 0) ? $year_id : financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");
            $data["title"] = "Purchase Invoice Yearly List";
            $data["purchaseinvoice_data"] = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE `date` BETWEEN '".$from_date."' AND '".$to_date."' AND `status` = 1")->result();
        }
        $this->load->view('admin/purchase/purchaseinvoice_list', $data);
    }

    /* this function use for get refund payment info */
    public function getAdjustmentPoDetails(){
        if(!empty($_POST)){
           extract($this->input->post());
           $refundinfo = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `id` = '".$id."'")->row();
           if (!empty($refundinfo)){ ?>
              <div class="row">
                 <div class="col-md-12">
                     <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Purchase Order</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if (!empty($refundinfo->adjusment_details)){
                                        $adjustmentdata = json_decode($refundinfo->adjusment_details, TRUE);
                                        foreach ($adjustmentdata as $key => $value) {
                                            
                                            $refundpaymentinfo = $this->db->query("SELECT `po_id`,`amount` FROM `tblpurchaseorderrefundpayment` WHERE id ='".$value["refund_payemnt_id"]."' ")->row();
                                            if (!empty($refundpaymentinfo)){
                                                $po_number = value_by_id("tblpurchaseorder", $refundpaymentinfo->po_id, "number");
                                                $po_number = (is_numeric($po_number)) ? 'PO-'.$po_number : $po_number;
                                                $url = admin_url('purchase/download_pdf/'.$refundpaymentinfo->po_id);
                                                echo "<tr>
                                                    <td>".++$key."</td>
                                                    <td><a href='".$url."' target='_blank'>".$po_number."</a></td>
                                                    <td>".number_format($refundpaymentinfo->amount, 2)."</td>
                                                </tr>";
                                            }
                                            
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                     </div>
                 </div>
              </div>
           <?php }
        }
     }

    /* this function use for purchase order refund confirmation */
    public function refund_confirmation_list(){

        $where = "id > 0 and status = 1 and type = 1 ";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($confirmation_id)){
                $where .= " and account_confirmation ='".$confirmation_id."'";
                $data['confirmation_id'] = $confirmation_id;
            }
            if (!empty($vendor_id)){
                $where .= " and vendor_id ='".$vendor_id."'";
                $data['vendor_id'] = $vendor_id;
            }
        }
        $data["title"] = "Purchase Refund Confirmation";
        $data['refund_payment_list'] = $this->db->query("SELECT * FROM tblpurchaseorderrefundpayment WHERE ".$where." ORDER BY id DESC ")->result();
        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result();
        $this->load->view("admin/purchase/purchase_refund_confirmation", $data);
    } 

    public function refund_confirmation(){
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($account_confirmation)){
                $data["account_confirmation"] = $account_confirmation;
                $data["account_confirmation_by"] = get_staff_user_id();
                if ($account_confirmation == 1){
                    if (!empty($reference_no)){
                        $data['reference_no'] = $reference_no;
                    }
                    if (!empty($payment_mode)){
                        $data['payment_mode'] = $payment_mode;
                    }
                    if (!empty($paymenttype)){
                        $data['payment_type_id'] = $paymenttype;
                    }
                    if (!empty($bank_id)){
                        $data['bank_id'] = $bank_id;
                    }
                    $chaque_for = 0;
                    $cheque_no = $cheque_date = "";
                    if (!empty($payment_mode) && $payment_mode == 1){
                        $chaque_for = (!empty($chaque_for)) ? $chaque_for : 0;
                        $cheque_no = (!empty($cheque_no)) ? $cheque_no : "";
                        $cheque_date = (!empty($cheque_date)) ? db_date($cheque_date) : "";
                    }
                    $data['chaque_for'] = $chaque_for;
                    $data['cheque_no'] = $cheque_no;
                    $data['cheque_date'] = $cheque_date;
                }
                $this->home_model->update('tblpurchaseorderrefundpayment', $data, array('id'=>$refund_id));

                set_alert('success', 'Purchase order refund confirmation successfully');
                redirect(admin_url('purchase/refund_confirmation_list'));
            }

            $refund_info = $this->db->query("SELECT * FROM tblpurchaseorderrefundpayment WHERE `id`= '".$refund_id."'")->row();
            $bank_info = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' ")->result();
            $paytype_info = $this->db->query("SELECT * FROM  tblpaymenttypes")->result();
    ?>
            <div class="row">
                <?php echo form_open(admin_url("purchase/refund_confirmation"), array('id' => 'refund_confirmation', 'class' => 'refund-confirmation')); ?>
                    <div class="col-md-12">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Refund Confirmation </h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        <label for="reference_no" class="control-label">Reference No  <small class="req text-danger">* </small></label>
                                        <input type="text" id="reference_no" name="reference_no" class="form-control" value="<?php echo (!empty($refund_info->reference_no)) ? $refund_info->reference_no : ""; ?>">
                                    </div>
                                    <div class="form-group col-md-2 select-placeholder payment_mode_div">
                                        <label for="payment_mode" class="control-label"><small class="req text-danger">* </small> Payment Mode </label>
                                        <select class="form-control selectpicker" id="payment_mode"  name="payment_mode" >
                                            <option value="">--Select One--</option>
                                            <option value="1" <?php echo (!empty($refund_info->payment_mode) && $refund_info->payment_mode == 1) ? 'selected': ''; ?>>Cheque</option>
                                            <option value="2" <?php echo (!empty($refund_info->payment_mode) && $refund_info->payment_mode == 2) ? 'selected': ''; ?>>NEFT</option>
                                            <option value="3" <?php echo (!empty($refund_info->payment_mode) && $refund_info->payment_mode == 2) ? 'selected': ''; ?>>Cash</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="paymenttype" class="control-label">Payment Types</label>
                                        <select class="form-control selectpicker" id="paymenttype"  name="paymenttype" data-live-search="true">
                                            <option value="">--Select One--</option>
                                            <?php
                                            if (!empty($paytype_info)) {
                                                foreach ($paytype_info as $pay_key => $pay_value) {
                                                    ?>
                                                    <option value="<?php echo $pay_value->id; ?>" <?php echo (isset($refund_info) && $refund_info->payment_type_id == $pay_value->id) ? "selected":"";?>><?php echo cc($pay_value->name); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="bank" class="control-label">Bank</label>
                                        <select class="form-control bank_id selectpicker" id="bank_id"  name="bank_id" data-live-search="true">
                                            <option value="">--Select One--</option>
                                            <?php
                                            if (!empty($bank_info)) {
                                                foreach ($bank_info as $bank_key => $bank_value) {
                                                    ?>
                                                    <option value="<?php echo $bank_value->id; ?>"<?php echo (isset($refund_info) && $refund_info->bank_id == $bank_value->id) ? "selected":"";?> ><?php echo cc($bank_value->name); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" id="cheque_div" <?php echo ($refund_info->payment_mode != 1) ? 'hidden' : ''; ?>>
                                    <br>
                                    <div class="form-group col-md-4 select-placeholder">
                                        <label for="chaque_for" class="control-label"><small class="req text-danger">* </small> Cheque For </label>
                                        <select class="form-control selectpicker" id="chaque_for"  name="chaque_for" >
                                            <option value="">--Select One--</option>
                                            <option value="1" <?php echo (isset($refund_info) && $refund_info->chaque_for == 1) ? "selected":"";?>>Post Date</option>
                                            <option value="2" <?php echo (isset($refund_info) && $refund_info->chaque_for == 2) ? "selected":"";?>>Current Date</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Cheque No.</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                            <span id="prefix">CHQ-</span>
                                            </span>
                                            <input type="text" id="cheque_no" onkeyup="nospaces(this)" name="cheque_no" class="form-control onlynumbers1" value="<?php echo (isset($refund_info)) ? $refund_info->cheque_no:"";?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php $cheque_date = (isset($refund_info) && $refund_info->cheque_date != '' || $refund_info->cheque_date != '0000-00-00') ? $refund_info->cheque_date : date('Y-m-d'); ?>
                                        <?php echo render_date_input('cheque_date', 'Cheque Date', _d($cheque_date)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="refund_id" value="<?php echo $refund_id; ?>">
                            <button type="submit" class="btn btn-success" name="account_confirmation" value="1" >Received</button>
                            <button type="submit" class="btn btn-danger" name="account_confirmation" value="2" >Not Received</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>   
            </div>
    <?php        
        }    
    }

    /* this is function use for show refund confirmation details */
    public function refund_confirmation_details(){
        if(!empty($_POST)){
            extract($this->input->post());
            $refund_info = $this->db->query("SELECT * FROM tblpurchaseorderrefundpayment WHERE `id`= '".$refund_id."'")->row();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Refund Confirmation Details </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label for="reference_no" class="text-danger"><u> Reference No </u></label>
                                    <div class="form-group">
                                        <?php echo (!empty($refund_info->reference_no)) ? $refund_info->reference_no : ""; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 payment_mode_div">
                                    <label for="payment_mode" class="text-danger"><u> Payment Mode </u></label>
                                    <div class="form-group">
                                        <?php 
                                            $payment_mode = '--';
                                            if (!empty($refund_info->payment_mode)){
                                                if ($refund_info->payment_mode == 1){
                                                    $payment_mode = 'Cheque';
                                                }else if ($refund_info->payment_mode == 2){
                                                    $payment_mode = 'NEFT';
                                                }else{
                                                    $payment_mode = 'Cash';
                                                }
                                            }
                                            echo $payment_mode;
                                        ?>
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <label for="paymenttype" class="text-danger"><u> Payment Types</u></label>
                                    <div class="form-group">
                                        <?php
                                            $payment_type = '--';
                                            if ($refund_info->payment_type_id > 0){
                                                $payment_type = value_by_id('tblpaymenttypes', $refund_info->payment_type_id, 'name');
                                            }
                                            echo $payment_type;
                                        ?>   
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <label for="bank" class="text-danger"><u>Bank</u> </label>
                                    <div class="form-group">
                                        <?php
                                            $bank_name = '--';
                                            if ($refund_info->bank_id > 0){
                                                $bank_name = value_by_id('tblbankmaster', $refund_info->bank_id, 'name');
                                            }
                                            echo $bank_name;
                                        ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="cheque_div" <?php echo ($refund_info->payment_mode != 1) ? 'hidden' : ''; ?>>
                                <br>
                                <div class=" col-md-3">
                                    <label for="chaque_for" class="text-danger"><u>Cheque For</u></label>
                                    <div class="form-group">
                                        <?php 
                                            $chaque_for = '--';
                                            if (isset($refund_info) && $refund_info->chaque_for == 1){
                                                $chaque_for = 'Post Date';
                                            }else if (isset($refund_info) && $refund_info->chaque_for == 2){
                                                $chaque_for = 'Current Date';
                                            }
                                            echo $chaque_for;
                                        ?>   
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <label for="cheque_no" class="text-danger"><u>Cheque No.</u></label>
                                    <div class="form-group">
                                        <?php echo (isset($refund_info)) ? $refund_info->cheque_no:"";?>  
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <label for="cheque_date" class="text-danger"><u> Cheque Date.</u></label>        
                                    <div class="form-group">
                                        <?php echo (isset($refund_info) && $refund_info->cheque_date != '' || $refund_info->cheque_date != '0000-00-00') ? _d($refund_info->cheque_date) : '--'; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" col-md-3">
                                    <label for="cheque_no" class="text-danger"><u>Added By</u></label>
                                    <div class="form-group">
                                        <?php echo (isset($refund_info)) ? get_employee_fullname($refund_info->added_by) :"";?>  
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <label for="cheque_no" class="text-danger"><u>Account Confirmation By</u></label>
                                    <div class="form-group">
                                        <?php echo (isset($refund_info)) ? get_employee_fullname($refund_info->account_confirmation_by) :"";?>  
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <label for="cheque_no" class="text-danger"><u>Created By</u></label>
                                    <div class="form-group">
                                        <?php echo (isset($refund_info)) ? _d($refund_info->created_date) :"";?>  
                                    </div>
                                </div>
                                <div class=" col-md-3">
                                    <label for="cheque_no" class="text-danger"><u>Account Confirmation</u></label>
                                    <div class="form-group">
                                        <?php
                                            if ($refund_info->account_confirmation > 0){
                                                if ($refund_info->account_confirmation == 1){
                                                    echo '<span class="btn-sm btn-success">Received</span>';
                                                }else{
                                                    echo '<span class="btn-sm btn-danger">Not Received</span>';
                                                }
                                            }else{
                                                echo '--';
                                            }
                                        
                                        ?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
    <?php        
        }    
    }

    /* this is use for show purchase order acceptace pending record */
    public function pending_payment_request(){
        $where = "`p`.`year_id`= '".financial_year()."' AND `p`.`cancel`=0 AND `pt`.`acceptance`='0' AND (`pt`.`status`='1' OR `pt`.`status`='0') AND `pt`.`payment_by`= '1'";
        $pwhere = "`transport_against` = 2 and `acceptance` = 0 and `approved_status` IN (1,0) ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $where .= " and p.date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
                $pwhere .= " and DATE(created_at)  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }
        }
        $data['title'] = 'Pending Payment Request';

        $data['paymentrequest_list'] = $this->db->query("SELECT * FROM `tblpaymentrequest` WHERE ".$pwhere." ")->result();
        $data['paymentrequest_report'] = $this->db->query("SELECT p.*,pt.id as payemnt_request_id, pt.amount as requested_amount, pt.urgency_type, pt.priority_number FROM `tblpurchaseorderpayments` as pt RIGHT JOIN `tblpurchaseorder` as p ON `pt`.`po_id`= `p`.`id` WHERE ".$where." ORDER BY pt.priority_number ASC")->result();
        $this->load->view("admin/purchase/pending_payment_request", $data);
    }

    /* this function use for set urgency type of payment */
    public function updateUrgencyType($requestid = 0, $request_type="payrequest"){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $tablename = ($request_type == 'transportation') ? "tblpaymentrequest": "tblpurchaseorderpayments";
            $response = $this->home_model->update($tablename, array("urgency_type" => $urgency_type, "priority_number" => $priority_number), array('id' => $prequest_id));
            if (!empty($response)){
                set_alert('success', 'Urgency set successfully');
                redirect(admin_url('purchase/pending_payment_request'));
            }
        }    
        $tablename = ($request_type == 'transportation') ? "`tblpaymentrequest`": "`tblpurchaseorderpayments`";
        $requestdata = $this->db->query("SELECT `urgency_type`,`priority_number` FROM ".$tablename." WHERE id='".$requestid."'")->row();
        ?>
            <div class="row">
                <div class="col-md-6">
                    <label for="file" class="control-label">Urgency Type</label>
                    <select class="form-control selectpicker" id="urgency_type"  name="urgency_type" required>
                        <option value="">--Select One--</option>
                        <option value="1" <?php echo (isset($requestdata) && $requestdata->urgency_type == 1) ? "selected":""; ?>>Very Urgent</option>
                        <option value="2" <?php echo (isset($requestdata) && $requestdata->urgency_type == 2) ? "selected":""; ?>>Urgent</option>
                        <option value="3" <?php echo (isset($requestdata) && $requestdata->urgency_type == 3) ? "selected":""; ?>>Less Urgent</option>
                        <option value="4" <?php echo (isset($requestdata) && $requestdata->urgency_type == 4) ? "selected":""; ?>>Average</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-group" app-field-wrapper="date">
                        <label for="priority" class="control-label">Priority</label>
                        <input type="number" class="form-control" name="priority_number" id="priority_number" value="<?php echo $requestdata->priority_number; ?>">
                    </div>
                </div>  
            </div>
        <?php   
    }

    /* this function use for convert to proforma invoice */
    public function convert_proforma_invoice($id){
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
         
            // echo '<pre/>';
            // print_r($proposal_data);
            // die;
            $insert_id = $this->Purchase_model->addPurchaseProformaInvoice($id, $proposal_data);
            if ($insert_id) {

                /* this code use for update proforma invoice id in purchase order */
                $this->home_model->update('tblpurchaseorder', array('proforma_invoice_id'=>$insert_id),array('id'=>$id));

                /* this is for multi attachments upload */
                handle_multi_handover_attachments($insert_id,'poproforma_invoice');

                set_alert('success', 'Proforma Invoice converted successfully');
                
                redirect(admin_url('purchase/proforma_invoice_list'));
            }
        }

        $title = 'Convert PO TO PI';
        $data["section"] = "add";
        $data['purchase_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$id."' ")->row_array();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where po_id = '".$id."' ")->result_array();
        $data['purchase_othercharges'] = $this->db->query("SELECT * from tblpurchaseothercharges where proposalid = '".$id."' ")->result_array();

        $default_settings = $this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
        $data['default_setting_field'] = array_column($default_settings, 'default_setting_field');

        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();

        // Getting Main products and Temp Products In Single Array
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 ORDER BY product_name ASC ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=>$r['sub_name'],'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }

        $data['title'] = $title;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status= '1' ORDER BY name ASC ")->result_array();

        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();

        $data['unit_list'] = $this->db->query("SELECT * from tblunitmaster where status = '1' ORDER BY name ASC")->result();

        $this->load->view('admin/purchase/convert_proforma_invoice', $data);
    }

    /* this function use for edit proforma invoice */
    public function proforma_invoice_edit($id){
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
         
            // echo '<pre/>';
            // print_r($proposal_data);
            // die;
            $insert_id = $this->Purchase_model->editPurchaseProformaInvoice($id, $proposal_data);
            if ($insert_id) {

                /* this code use for update proforma invoice id in purchase order */
                $this->home_model->update('tblpurchaseorder', array('proforma_invoice_id'=>$insert_id),array('id'=>$id));
                
                if (!empty($_FILES["file"]["name"][0])){
                    /* this is for multi attachments upload */
                    $files_list = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_id`='".$id."' AND `rel_type`='poproforma_invoice' ")->result();
                    if (!empty($files_list)){
                        foreach ($files_list as $key => $file) {
                            $response = $this->home_model->delete('tblfiles', array('id' => $file->id, 'rel_type' => 'poproforma_invoice'));
                            if ($response){
                                $upath = get_upload_path_by_type('poproforma_invoice') . $id . '/'.$file->file_name;
                                unlink($upath);
                            }
                        }
                    }
                }
                
                /* this is for multi attachments upload */
                handle_multi_handover_attachments($insert_id,'poproforma_invoice');
                set_alert('success', 'Proforma Invoice updated successfully');
                redirect(admin_url('purchase/proforma_invoice_list'));
            }
        }

        $title = 'Edit Proforma Invoice';
        $data['purchase_info'] = $this->db->query("SELECT * from tblpurchaseproformainvoice where id = '".$id."' ")->row_array();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where proforma_invoice_id = '".$id."' ")->result_array();
        $data['purchase_othercharges'] = $this->db->query("SELECT * from tblpurchaseothercharges where proposalid = '".$id."' ")->result_array();

        $default_settings = $this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
        $data['default_setting_field'] = array_column($default_settings, 'default_setting_field');

        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();

        // Getting Main products and Temp Products In Single Array
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 ORDER BY product_name ASC ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=>$r['sub_name'],'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }

        $data['title'] = $title;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status= '1' ORDER BY name ASC ")->result_array();

        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();

        $data['unit_list'] = $this->db->query("SELECT * from tblunitmaster where status = '1' ORDER BY name ASC")->result();
        $data["section"] = "edit";
        $this->load->view('admin/purchase/convert_proforma_invoice', $data);
    }

    /* this is use for show proforma invoice list */
    public function proforma_invoice_list(){
        $where = "`year_id`= '".financial_year()."'";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($vendor_id)){
                $where .= " and vendor_id ='".$vendor_id."'";
                $data['vendor_id'] = $vendor_id;
            }

            if(!empty($f_date) && !empty($t_date)){

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }
        }
        $data['title'] = 'Proforma Invoice List';
        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result();
        $data['proforma_invoice_list'] = $this->db->query("SELECT * FROM `tblpurchaseproformainvoice` WHERE ".$where." ORDER BY id DESC")->result();
        $this->load->view("admin/purchase/proforma_invoice_list", $data);
    }

    /* this function use for proforma invoice view */
    public function proforma_invoice_view($id){
        $data['title'] = 'Proforma Invoice View';
        $data['proforma_invoice_info'] = $this->db->query("SELECT * FROM `tblpurchaseproformainvoice` WHERE id = ".$id." ")->row();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where proforma_invoice_id = '".$id."' ")->result();
        $this->load->view("admin/purchase/proforma_invoice_view", $data);
    }

    public function pi_upload() {
        if(!empty($_POST)){
            extract($this->input->post());

            handle_multi_attachments($pi_id,'poproforma_invoice');

            set_alert('success', 'File Uploaded successfully');
            redirect(admin_url('purchase/proforma_invoice_list'));
        }
    }

    public function get_pi_uploads_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'poproforma_invoice' and rel_id = '".$id."' ")->result();

            if(!empty($file_info)){
            ?>


            <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Uploads File</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($file_info as $key => $file) {
                        ?>
                         <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><a target="_blank" href="<?php echo base_url('uploads/purchase_order/proforma_invoice/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></td>
                            <td><?php echo _d($file->dateadded); ?></td>
                            <td><a href="<?php echo admin_url("purchase/delete_popraforma_attachment/".$file->id); ?>" class="btn-sm btn-danger _delete"><i class="fa fa-trash"></i></a></td>
                         </tr>

                    <?php
                    }
                    ?>
                     </tbody>
                </table>
            </div>
            <?php
            }

        }
    }

    /* this function use for delete proforma attachment receipts */
    public function delete_popraforma_attachment($id){
        $files_list = $this->db->query("SELECT * FROM `tblfiles` WHERE `id`='".$id."' AND `rel_type`='poproforma_invoice' ")->row();
        if (!empty($files_list)){
            $response = $this->home_model->delete('tblfiles', array('id' => $files_list->id, 'rel_type' => 'poproforma_invoice'));
            if ($response){
                $upath = get_upload_path_by_type('poproforma_invoice') . $id . '/'.$files_list->file_name;
                unlink($upath);
                set_alert('success', "Successfully removed");
            }
        }

        redirect(admin_url("purchase/proforma_invoice_list"));
    }

    /* this function use for update accounted status in purchase invoice */
    public function update_accounted_status($purchaseinvoice_id){
        
        $status = value_by_id_empty('tblpurchaseinvoice', $purchaseinvoice_id, "accounted_status");
        $updata["accounted_status"] = 0;
        if ($status == 0){
            $updata["accounted_status"] = 1;
            $updata["accounted_by"] = get_staff_user_id();
            $updata["accounted_date"] = date("Y-m-d H:i:s");
        }
        
        $this->home_model->update('tblpurchaseinvoice', $updata,array('id'=>$purchaseinvoice_id));
        redirect(admin_url('purchase/invoice_list'));
    }

    /* this function use for get renewalapproval */
    public function get_renewalapproval_data($po_id = ''){
        if(!empty($_POST)){
            extract($this->input->post());

            // echo "<pre>";
            // print_r($_POST);
            // exit;    

            /* THIS CODE FOR ASSIGN STAFF FOR TAKE APPROVAL */
            $staff_id = array();
            if(!empty($assignid)){
                foreach ($assignid as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                        $staff_id[] = str_replace("staff", "", $single_staff);
                    }
                }
                $staff_id = array_unique($staff_id);
            }

            if(!empty($staff_id)){

                $up_data = array("renewal_remark" => $renewal_remark, "approval_for_renewal" => 6);
                $this->home_model->update("tblpurchaseorder", $up_data, array("id" => $po_id));

                $this->home_model->delete('tblmasterapproval',array('table_id'=>$po_id,'module_id'=>62));
                foreach ($staff_id as $staffid) {

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 62,
                        'description' => 'Purchase Order Send to you for renewal Approval',
                        'table_id' => $po_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/renewal_approval/' . $po_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Purchase Order Send to you for renewal Approval';
                    $title = 'Schach';
                    sendFCM($message, $title, $token, $page = 2);
                }
            }
            set_alert('success', 'Purchase order renewal approval send successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } 

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        $allStaffdata = array();
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $allStaffdata[$i]['id'] = $singlestaff['id'];
            $allStaffdata[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' ORDER BY s.firstname ASC")->result_array();
            $allStaffdata[$i]['staffs'] = $query;
        }
        
        $po_status = value_by_id_empty("tblpurchaseorder", $po_id, 'approval_for_renewal');
        $assign_info = $this->db->query("SELECT * from `tblmasterapproval` where `module_id` = '62' and `table_id` = '".$po_id."' ")->result();
    ?>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if (!empty($assign_info) && ($po_status == 0 OR $po_status == 6)){
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" >
                                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                            <thead>
                                                <tr>
                                                    <td>S.No</td>
                                                    <td>Name</td>
                                                    <td>Action</td>
                                                    <td>Remark</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                foreach ($assign_info as $key => $value) {

                                                        if($value->approve_status == 0){
                                                            $status = 'Pending';
                                                            $color = 'Darkorange';
                                                        }elseif($value->approve_status == 1){
                                                            $status = 'Approved';
                                                            $color = 'green';
                                                        }elseif($value->approve_status == 2){
                                                            $status = 'Reject';
                                                            $color = 'red';
                                                        }elseif ($value->approve_status == 5) {
                                                            $status = 'On Hold';
                                                            $color = '#e8bb0b;';
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i++;?></td>
                                                        <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                        <td><?php echo ($value->approval_remark != '') ?  $value->approval_remark : '--';  ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php      
                        }else{
                        
                        echo form_open($this->uri->uri_string(), array('id' => 'renewal-form', 'class' => 'renewalapproval', 'enctype' => 'multipart/form-data')); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6" style="margin-bottom:2%;">
                                    <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                    <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required='' name="assignid[]">
                                        <?php
                                        if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                            foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                        ?>
                                                <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                    <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                    <?php
                                                    foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                        ?>
                                                        <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                        if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                            echo'selected';
                                                        }
                                                        ?>><?php echo $singstaff['firstname'] ?></option>
                                                            <?php }
                                                            ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6" app-field-wrapper="renewal_remark">
                                    <label for="remark" class="control-label">Renewal Remark</label>
                                    <textarea id="renewal_remark" name="renewal_remark" class="form-control" rows="4" required=""></textarea>
                                </div>
                                <button type="submit" class="btn btn-info pull-right">Send</button>
                            </div>    
                        </div>   
                    <?php 
                        echo form_close();         
                        }
                    ?>
                </div>
            </div>
        <?php 
    }

    public function renewal_approval($id) {

    	if(!empty($_POST)){
       		extract($this->input->post());

            // echo "<pre>";
            // print_r($_POST);
            // exit;

            $ad_data = array(
                'approval_for_renewal' => $submit
            );
            $update = $this->home_model->update('tblpurchaseorder', $ad_data,array("id" => $id));
            if ($update){
                update_masterapproval_single(get_staff_user_id(),62,$id,$submit);
                update_masterapproval_all(62,$id,$submit);

                $up_data = array("approval_remark" => $approval_remark);
                $this->home_model->update('tblmasterapproval', $up_data,array('table_id'=> $id, 'module_id'=> '62','staff_id'=>get_staff_user_id()));
                // if ($submit == 1){
                //     $this->home_model->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>62));
                // }
                set_alert('success', 'Purchase order renewal approval updated succesfully');
                redirect(admin_url('approval/notifications'));
            }
    	}

    	$data['id'] = $id;
        $data['purchase_info'] = $this->db->query("SELECT * from tblpurchaseorder where id = '".$id."' ")->row_array();
        $data['product_info'] = $this->db->query("SELECT * from tblpurchaseorderproduct where po_id = '".$id."' ")->result_array();
        $data['staffassigndata'] = explode(',', $data['purchase_info']['assignid']);
        $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status='1'")->result_array();
        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ")->result_array();
        $data['appvoal_info'] = $this->db->query("SELECT * from `tblmasterapproval` where `module_id` = '62' and `table_id` = '".$id."' and staff_id = '".get_staff_user_id()."' and status != 0 ")->row();
        $data['ttlpaidamount'] = $this->db->query("SELECT SUM(approved_amount) as ttlamount from tblpurchaseorderpayments where po_id = '".$id."' and status = 1 ")->row()->ttlamount;
         
        $data['title'] = 'Purchase Order Renewal Approval';
        if ($data['purchase_info']['order_type'] == 2){
            $data['title'] = 'Work Order Renewal Approval';
        }
    	
        $this->load->view('admin/purchase/porenewal_approval', $data);
    }
}
