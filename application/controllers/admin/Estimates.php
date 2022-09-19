<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Estimates extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('estimates_model');
        $this->load->model('home_model');
    }

    /* Get all estimates in case user go on index page */

    public function update_tax_amt()
    {
        $quotation_info = $this->db->query("SELECT id from `tblestimates`  ")->result();
        if(!empty($quotation_info)){
            foreach ($quotation_info as $value) {
                update_pi_final_amount($value->id);
            }
        }
    }

    public function update_service_type()
    {
        $p_id = array();
        $quotation_info = $this->db->query("SELECT id from `tblestimates`  ")->result();
        if(!empty($quotation_info)){
            foreach ($quotation_info as $key => $value) {
                $service_type = 1;
                $check_estimate_rent_item=check_estimate_item($value->id,0);
                $check_estimate_sale_item=check_estimate_item($value->id,1);

                if($check_estimate_rent_item>=1){
                  $service_type = 1;
                }elseif($check_estimate_sale_item>=1){
                  $service_type = 2;
                }

               $number = format_estimate_number($value->id);
               $this->home_model->update('tblestimates', array('service_type'=>$service_type,'number'=>$number),array('id'=>$value->id));
            }
        }

    }

    public function index($id = '') {

        $this->list_estimates($id);
    }

    /* List all estimates datatables */

    public function list_estimates($id = '') {
        check_permission(6,'view');

        $isPipeline = $this->session->userdata('estimate_pipeline') == 'true';
        
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        if ($isPipeline && !$this->input->get('status') && !$this->input->get('filter')) {
            $data['title'] = _l('estimates_pipeline');
            $data['bodyclass'] = 'estimates-pipeline estimates-total-manual';
            $data['switch_pipeline'] = false;

            if (is_numeric($id)) {
                $data['estimateid'] = $id;
            } else {
                $data['estimateid'] = $this->session->flashdata('estimateid');
            }

            $this->load->view('admin/estimates/pipeline/manage', $data);
        } else {
            
            // Pipeline was initiated but user click from home page and need to show table only to filter
            if ($this->input->get('status') || $this->input->get('filter') && $isPipeline) {
                $this->pipeline(0, true);
            }

            $data['estimateid'] = $id;
            $data['switch_pipeline'] = true;
            $data['title'] = _l('estimates');
            $data['bodyclass'] = 'estimates-total-manual';
            $data['estimates_years'] = $this->estimates_model->get_estimates_years();
            $data['estimates_sale_agents'] = $this->estimates_model->get_sale_agents();
            $this->load->view('admin/estimates/manage', $data);
        }
    }

/*    public function list()
    {
        check_permission(6,'view');


        $where = "year_id = '".financial_year()."'";

        $where_amt_desc = '0';

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('estimate_where');
                $this->session->unset_userdata('estimate_search');
                $this->session->unset_userdata('estimate_where_amt_desc');
            }else{
                if(!empty($type) || !empty($f_date) || !empty($t_date) || !empty($clientid) || !empty($estimate_no) || !empty($amt_desc)){
                    $this->session->unset_userdata('estimate_where');
                    $this->session->unset_userdata('estimate_search');
                    $this->session->unset_userdata('estimate_where_amt_desc');
                    $sreach_arr = array();

                    if(!empty($type)){
                        $sreach_arr['type'] = $type;
                        $where .= " and proforma_type = '".$type."'";
                    }

                    if(!empty($clientid)){
                        $sreach_arr['clientid'] = $clientid;
                        $where .= " and clientid = '".$clientid."'";
                    }

                    if(!empty($estimate_no)){
                        $sreach_arr['estimate_no'] = $estimate_no;
                        $where .= " and (number LIKE '%".$estimate_no."%')";
                    }


                    if(!empty($f_date) && !empty($t_date)){
                        $sreach_arr['f_date'] = $f_date;
                        $sreach_arr['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and date between '".$f_date."' and '".$t_date."' ";
                    }


                    if(!empty($amt_desc)){
                        $where_amt_desc = $amt_desc;
                    }

                    $this->session->set_userdata('estimate_where',$where);
                    $this->session->set_userdata('estimate_search',$sreach_arr);
                    $this->session->set_userdata('estimate_where_amt_desc',$where_amt_desc);

                }

            }
        }else{
            if(!empty($this->session->userdata('estimate_where'))){
                $where = $this->session->userdata('estimate_where');
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 25;

        // Get record count
        $totalRec = $this->estimates_model->get_estimates_count($where);

        // Pagination configuration
        $config['base_url']    = admin_url().'estimates/list/';
        $config['uri_segment'] = $uriSegment;
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $perPage;

        // For pagination link
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        // Initialize pagination library
        $this->pagination->initialize($config);

        // Define offset
        $page = $this->uri->segment($uriSegment);
        $offset = !$page?0:$page;


        // Get records
        $data['estimate_list'] = $this->estimates_model->get_estimates($where,$offset,$perPage);



        $data['type_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1")->result();
        $data['client_branch_data'] = $this->db->query("SELECT * from `tblclientbranch` ")->result();

        $data['title'] = 'Perfoma Invoice List';
        $this->load->view('admin/estimates/list', $data);

    }*/

    public function list()
    {
        check_permission(6,'view');
        $where = "id > 0 ";
        /*if(is_admin() == 1){
            $where = "id > 0 ";
        }else{
            $where = "addedfrom = '".get_staff_user_id()."' ";
        }*/

        /* This code use for revert notification */
        $charges_request = $this->input->get("charges_request");
        if (!empty($charges_request)){

            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$charges_request."' and staff_id = '".get_staff_user_id()."' and module_id = 52")->row();
            if (!empty($chk_notification)){
                $this->home_model->delete("tblmasterapproval", array("id" => $chk_notification->id));
            }
        }
        
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($type) || !empty($f_date) || !empty($t_date) || !empty($clientid) || !empty($amt_desc) || !empty($order_status_id) || !empty($check_order_withoutinvoice)){
                if(!empty($type)){
                    $data['type'] = $type;
                    $where .= " and proforma_type = '".$type."'";
                }

                if(!empty($clientid)){
                    $data['clientid'] = $clientid;
                    $where .= " and clientid = '".$clientid."'";
                }

                if (!empty($order_status_id)){
                    $data["order_status_id"] = $order_status_id;
                    $estimatedata = $this->db->query("SELECT GROUP_CONCAT(estimate_id) as estimateids FROM tblconfirmorder WHERE `order_status_id`= '".$order_status_id."'")->row();
                    if (!empty($estimatedata) && !empty($estimatedata->estimateids)){
                        $where .= " and id IN (".$estimatedata->estimateids.")";
                    }else{
                        $where .= " and id = 0";
                    }
                }

                if (!empty($check_order_withoutinvoice)){
                    $data['check_order_withoutinvoice'] = $check_order_withoutinvoice;
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
            $where .= " and year_id = '".financial_year()."'";
        }

        // Get records
        $data['estimate_list'] = $this->db->query("SELECT * from `tblestimates` where ".$where." order by id desc")->result();
        // $data['estimate_amount'] = $this->db->query("SELECT sum(total) as ttl_amt from `tblestimates` where ".$where." ")->row()->ttl_amt;

        $data['type_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['order_status_list'] = $this->db->query("SELECT * from `tblconfirmorderstatus` ORDER BY title ASC")->result();
        $data['client_branch_data'] = $this->db->query("SELECT * from `tblclientbranch` WHERE `active`=1 and `client_branch_name` != '' ORDER BY client_branch_name ASC ")->result();

        $data['title'] = 'Proforma Invoice List';
        $this->load->view('admin/estimates/list', $data);
    }

    public function table($clientid = '') {
        /*if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && get_option('allow_staff_view_estimates_assigned') == '0') {
            ajax_access_denied();
        }*/

        $this->app->get_table_data('estimates', [
            'clientid' => $clientid,
        ]);
    }

    /* Add new estimate or update existing */

    public function estimate($id = '') {
        if ($this->input->post()) {
            $estimate_data = $this->input->post();
            if ($id == '') {
                /*if (!has_permission('estimates', '', 'create')) {
                    access_denied('estimates');
                }*/
                $id = $this->estimates_model->add($estimate_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('estimate')));
                    if ($this->set_estimate_pipeline_autoload($id)) {
                        redirect(admin_url('estimates/list_estimates/'));
                    } else {
                        redirect(admin_url('estimates/list_estimates/' . $id));
                    }
                }
            } else {
                /*if (!has_permission('estimates', '', 'edit')) {
                    access_denied('estimates');
                }*/
                $success = $this->estimates_model->update($estimate_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('estimate')));
                }
                if ($this->set_estimate_pipeline_autoload($id)) {
                    redirect(admin_url('estimates/list_estimates/'));
                } else {
                    redirect(admin_url('estimates/list_estimates/' . $id));
                }
            }
        }
        if ($this->input->get('proposalid')) {
            $this->load->model('proposals_model');
            $proposalid = $this->input->get('proposalid');
            $data['proposal'] = $this->proposals_model->get($proposalid);
            $this->load->model('Other_charges_model');
            $data['othercharges'] = $this->Other_charges_model->get();
            $this->db->where('rel_id', $proposalid);
            $this->db->where('is_sale', '0');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();

            $this->db->where('rel_id', $proposalid);
            $this->db->where('is_sale', '1');
            $saleprolist = $this->db->get('tblitems_in')->result_array();

            $this->db->where('proposalid', $proposalid);
            $this->db->where('is_sale', '0');
            $otherchargesforrent = $this->db->get('tblproposalothercharges')->result_array();

            $this->db->where('proposalid', $proposalid);
            $proposalfields = $this->db->get('tblproposalproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'fieldname');

            $this->db->where('proposalid', $proposalid);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblproposalothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;
        } else if ($id == '') {
            $title = _l('create_new_estimate');
        } else {

            $estimate = $this->estimates_model->get($id);

            /*if (!$estimate || !user_can_view_estimate($id)) {
                blank_page(_l('estimate_not_found'));
            }*/

            $data['estimate'] = $estimate;
            $data['edit'] = true;
            $title = _l('edit', _l('estimate_lowercase'));
        }
        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        $data['base_currency'] = $this->currencies_model->get_base_currency();

        $this->load->model('invoice_items_model');

        $data['ajaxItems'] = false;
        if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items'] = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        $data['title'] = $title;
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 ORDER BY name ASC")->result_array();

        $this->load->view('admin/estimates/estimate', $data);
    }

    public function add_cont($id = '') {
        $data = $this->input->post();
        //echo 'pp'.$data['clientid'];exit;
        //print_r($data);exit;
        $cust_id = $data['cust_id'];
        unset($data['cust_id']);
        unset($data['contactid']);
        $this->load->model('clients_model');
        $id = $this->clients_model->add_contact($data, $cust_id);
    }

    public function performerinvoice($id = '') {

       // check_permission(6,'create');

        $this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            $termsdata = $proposal_data["terms"];
            unset($proposal_data["terms"]);
            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/

            if ($id == '') {

                $id = $this->Estimates_model->add($proposal_data);
                if ($id) {
                    //Update Final Amt
                    update_pi_final_amount($id);

                    //update service type
                    $service_type = 1;
                    $check_estimate_rent_item=check_estimate_item($id,0);
                    $check_estimate_sale_item=check_estimate_item($id,1);

                    if($check_estimate_rent_item>=1){
                      $service_type = 1;
                    }elseif($check_estimate_sale_item>=1){
                      $service_type = 2;
                    }
                    $this->home_model->update('tblestimates', array('service_type'=>$service_type),array('id'=>$id));

                    /* this function use for add custom terms and condition */
                    $this->proposals_model->addCustomTermsAndCondition($id, 'estimate', $termsdata, "tblestimates");
                    set_alert('success', _l('added_successfully', _l('estimate')));
                   // redirect(admin_url('estimates/list_estimates/' . $id));
                    redirect(admin_url('estimates/list/'));
                }
            } else {
                check_permission(6,'edit');
                $success = $this->Estimates_model->update_pi($proposal_data, $id);

                // exit;
                if ($success) {
                    //Update Final Amt
                    update_pi_final_amount($id);

                    //update service type
                    $service_type = 1;
                    $check_estimate_rent_item=check_estimate_item($id,0);
                    $check_estimate_sale_item=check_estimate_item($id,1);

                    if($check_estimate_rent_item>=1){
                      $service_type = 1;
                    }elseif($check_estimate_sale_item>=1){
                      $service_type = 2;
                    }
                    $this->home_model->update('tblestimates', array('service_type'=>$service_type),array('id'=>$id));

                    /* this function use for add custom terms and condition */
                    $this->proposals_model->addCustomTermsAndCondition($id, 'estimate', $termsdata, "tblestimates");
                    set_alert('success', _l('updated_successfully', _l('estimate')));
                    //redirect(admin_url('estimates/list_estimates/' . $id));
                    redirect(admin_url('estimates/list/'));
                }
                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('estimate'));
                } else {
                   // redirect(admin_url('estimates/list_estimates/' . $success));
                    redirect(admin_url('estimates/list/'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Proforma Invoice';
        } else {
            $this->load->model('estimates_model');
            $data['proposal'] = $this->estimates_model->get($id);
            $this->db->where('id', $id);
            $proposalll = $this->db->get('tblestimates')->row_array();

            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '0');
            $this->db->where('rel_type', 'estimate');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();
            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '1');
            $this->db->where('rel_type', 'estimate');
            $saleprolist = $this->db->get('tblitems_in')->result_array();

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '0');
            $this->db->order_by("id", "asc");
            $otherchargesforrent = $this->db->get('tblestimateothercharges')->result_array();

            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblestimateproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'field_id');

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $this->db->order_by("id", "asc");
            $otherchargesforsale = $this->db->get('tblestimateothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;

            /*if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }*/

            $data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = 'Edit Proforma Invoice';
            $this->db->where('lead_id', $id);
            $staffassigndata = $this->db->get('tblestimateassignstaff')->result_array();
            $staffassigndata = array_column($staffassigndata, 'staff_id');
            $data['staffassigndata'] = $staffassigndata;
            $data['contactdata'] = $this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='" . $id . "' AND `type`='estimate'")->result_array();
            $data['shipcontactdata'] = $this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='" . $id . "' AND `type`='shipestimate'")->result_array();
            $data['staff_data'] = $this->db->query("SELECT * FROM `tblcontacts` WHERE `userid`='" . $proposalll['clientid'] . "'")->result_array();
        }

        $default_settings = $this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
        $data['default_setting_field'] = array_column($default_settings, 'default_setting_field');
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');
        $data['ajaxItems'] = false;
        /*if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items'] = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();*/

        $data['statuses'] = $this->proposals_model->get_statuses();
        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        $data['currencies'] = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();
        $this->load->model('Leads_model');
        $data['all_source'] = $this->Leads_model->get_source();
        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();

        $rel_id = 0;
        if (!empty($data['estimate'])){
            $rel_id = $data['estimate']->lead_id;
        }else if(isset($_GET['rel_id'])){
            $rel_id = $_GET['rel_id'];
        }

        $leaddetails = $this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='" . $rel_id . "' ORDER BY cb.`client_branch_name` ASC")->row_array();
        $data['client_branch_name'] = $leaddetails['client_branch_name'];
        $lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();
        $clientsate = array_column($lead_prod_rent_det, 'state');
        $data['clientsate'] = (!empty($clientsate)) ? $clientsate[0] : "";
        $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        $data['lead_prod_sale_det'] = $lead_prod_sale_det;
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();

        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = $title;
        $compbranchid = $this->session->userdata('staff_user_id'); //exit;
        $compnybranch_warehouse = $this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='" . $compbranchid . "'")->row_array();
        $warehouseid = explode(',', $compnybranch_warehouse['warehouse_id']);
        foreach ($warehouseid as $singlewarehouseid) {
            $warehousedata[] = $this->db->query("SELECT * FROM `tblwarehouse` where id='" . $singlewarehouseid . "' ORDER BY name ASC ")->row_array();
        }
        //$data['all_warehouse'] = $warehousedata;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status ='1' ORDER BY name ASC ")->result_array();
        $this->load->model('Enquiryfor_model');
        // $data['service_type'] = $this->Enquiryfor_model->get();
        $data['service_type'] = get_service_type();
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();
        $this->load->model('Staff_model');

        $data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE `active`='1' AND `client_branch_name` != '' ORDER BY client_branch_name ASC")->result_array();
        $data['type_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC ")->result();
        $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by name ASC")->result();
        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' AND id != 1 order by name ASC ")->result();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ")->result_array();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        //$data['staff_data'] = $this->Staff_model->get();
        $this->load->view('admin/estimates/perfoma_invoice', $data);
    }

    public function invoices($id = '')
    {
        $this->load->model('invoices_model');
        $this->load->model('proposals_model');
        $this->load->model('estimates_model');

        if ($this->input->post()) {
            $invoice_data = $this->input->post();
            // echo "<pre>";
            // print_r($invoice_data);
            // exit;
            $termsdata = $invoice_data["terms"];
            $convert_type = $invoice_data["convert_type"];
            unset($invoice_data["terms"]);
            unset($invoice_data["convert_type"]);

            $lead_id = value_by_id('tblestimates',$id,'lead_id');
            $invoice_data['estimate_id'] = $id;
            $invoice_data['lead_id'] = $lead_id;
            
            if(($invoice_data['rentproposal']['totalamount'] == 0) && ($invoice_data['saleproposal']['totalamount'] == 0)){
                set_alert('danger', 'Bill amount cannot be empty!');
                redirect($_SERVER['HTTP_REFERER']);
            }

            /*if (!has_permission('invoices', '', 'create')) {
                access_denied('invoices');
            }*/
            $id = $this->invoices_model->add_invoice($invoice_data);
            if ($id) {

                //Move client if he is in other collection
                $client_id = value_by_id('tblinvoices',$id,'clientid');
                $this->home_model->update('tblclientbranch',array('other_collection'=>'0'),array('client_id'=>$client_id));

                if(!empty($lead_id)){
                    $this->home_model->update('tblleads', array('process_id'=>5),array('id'=>$lead_id));
                }

                /* THIS CODE USE FOR UPDATE CONVERT TYPE */
                if (isset($convert_type) && $convert_type > 0){
                    $this->home_model->update('tblestimates', array('converted_type'=>$convert_type),array('id'=>$invoice_data['estimate_id']));
                }
                
                /* this function use for add custom terms and condition */
                $this->proposals_model->addCustomTermsAndCondition($id, 'invoice', $termsdata, "tblinvoices");

                update_invoice_final_amount($id);
                set_alert('success', _l('added_successfully', _l('invoice')));

                $redirect_url = ($invoice_data['service_type'] == 1) ? 'invoices/rent_list':'invoices/list';
                redirect(admin_url($redirect_url));
            }
        }
        if ($id == '') {
            $title                  = _l('create_new_invoice');
            $data['billable_tasks'] = [];
        } else {

            $invoice = $this->estimates_model->get($id);
            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '0');
            $this->db->where('rel_type', 'estimate');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();
            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '1');
            $this->db->where('rel_type', 'estimate');
            $saleprolist = $this->db->get('tblitems_in')->result_array();
            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '0');
            $otherchargesforrent = $this->db->get('tblestimateothercharges')->result_array();
            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblinvoiceproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'fieldname');
            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblestimateothercharges')->result_array();
            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            if(!empty($rentalprolist)){
                $data['s_type'] = '1';
            }else{
                $data['s_type'] = '2';
            }
            //$data['proposalfields'] = $proposalfieldname;
            if (!$invoice) {
                blank_page(_l('invoice_not_found'));
            }
            $data['invoice'] = $invoice;
            $data['is_proposal'] = true;
            $title = _l('edit', _l('invoice_lowercase'));
            $data['invoices_to_merge'] = $this->invoices_model->check_for_merge_invoice($invoice->clientid, $invoice->id);

            $data['expenses_to_bill']  = $this->invoices_model->get_expenses_to_bill($invoice->clientid);

            $data['invoice']        = $invoice;
            $data['edit']           = true;
            $data['billable_tasks'] = $this->tasks_model->get_billable_tasks($invoice->clientid, !empty($invoice->project_id) ? $invoice->project_id : '');

            $title = _l('edit', _l('invoice_lowercase')) . ' - ' . format_invoice_number($invoice->id);
            //$data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='".$id."' AND `type`='invoice'")->result_array();
        }

         $title   = _l('create_new_invoice');

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'expenses_only !=' => 1,
        ]);

        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');

        $data['ajaxItems'] = false;
        $data['items']     = [];
        /*if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items']     = [];
            $data['ajaxItems'] = true;
        }*/
        //$data['items_groups'] = $this->invoice_items_model->get_groups();
        $data['items_groups'] = [];

        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();

        $data['staff']     = $this->staff_model->get('', ['active' => 1]);
        $data['title']     = $title;
        $data['bodyclass'] = 'invoice';
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
         $data['city_data'] = array();
         if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }

        $this->load->model('Enquiryfor_model');
        //$data['service_type'] = $this->Enquiryfor_model->get();
        $data['service_type'] = get_service_type();
        $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by field_for desc")->result();

        //getting client
        $data['client_info'] = $this->db->query(" SELECT c.userid FROM `tblclientbranch` as c INNER JOIN tblestimates as est ON est.clientid = c.userid where est.id = '".$id."' ORDER BY c.client_branch_name ASC  ")->row();
        $data['client_branch_data'] = $this->db->query("SELECT * from `tblclientbranch` WHERE `active` = 1 AND `client_branch_name` != '' ORDER BY client_branch_name ASC ")->result();

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' AND id != 1  order by name ASC")->result();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        $this->load->view('admin/estimates/invoices_new', $data);
    }


    public function getstaffdet() {
        $staff_id = $this->input->post('staff_id');
        $this->db->where('id', $staff_id);
        $staffdata = $this->db->get('tblcontacts')->row();
        $staffdata = (array) $staffdata;
        echo json_encode(array('staff_email' => $staffdata['email'], 'staff_number' => $staffdata['phonenumber'], 'staff_designation' => $staffdata['designation_id']));
    }

    public function getcompnycontact($clintid) {
        $contactarr = $this->db->query("SELECT * FROM `tblcontacts` WHERE `userid`='" . $clintid . "'")->result_array();
        echo json_encode($contactarr);
    }

    public function clear_signature($id) {
        if (has_permission('estimates', '', 'delete')) {
            $this->estimates_model->clear_signature($id);
        }

        redirect(admin_url('estimates/list_estimates/' . $id));
    }

    public function update_number_settings($id) {
        $response = [
            'success' => false,
            'message' => '',
        ];
        if (has_permission('estimates', '', 'edit')) {
            $this->db->where('id', $id);
            $this->db->update('tblestimates', [
                'prefix' => $this->input->post('prefix'),
            ]);
            if ($this->db->affected_rows() > 0) {
                $response['success'] = true;
                $response['message'] = _l('updated_successfully', _l('estimate'));
            }
        }

        echo json_encode($response);
        die;
    }

    public function validate_estimate_number() {
        $isedit = $this->input->post('isedit');
        $number = $this->input->post('number');
        $date = $this->input->post('date');
        $original_number = $this->input->post('original_number');
        $number = trim($number);
        $number = ltrim($number, '0');

        if ($isedit == 'true') {
            if ($number == $original_number) {
                echo json_encode(true);
                die;
            }
        }

        if (total_rows('tblestimates', [
                    'YEAR(date)' => date('Y', strtotime(to_sql_date($date))),
                    'number' => $number,
                ]) > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    public function delete_attachment($id) {
        $file = $this->misc_model->get_file($id);
        if ($file->staffid == get_staff_user_id() || is_admin()) {
            echo $this->estimates_model->delete_attachment($id);
        } else {
            header('HTTP/1.0 400 Bad error');
            echo _l('access_denied');
            die;
        }
    }

    /* Get all estimate data used when user click on estimate number in a datatable left side */

    public function get_estimate_data_ajax($id, $to_return = false) {
        /*if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && get_option('allow_staff_view_estimates_assigned') == '0') {
            echo _l('access_denied');
            die;
        }*/

        if (!$id) {
            die('No estimate found');
        }

        $estimate = $this->estimates_model->get($id);

        /*if (!$estimate || !user_can_view_estimate($id)) {
            echo _l('estimate_not_found');
            die;
        }*/

        $estimate->date = _d($estimate->date);
        $estimate->expirydate = _d($estimate->expirydate);
        if ($estimate->invoiceid !== null) {
            $this->load->model('invoices_model');
            $estimate->invoice = $this->invoices_model->get($estimate->invoiceid);
        }

        if ($estimate->sent == 0) {
            $template_name = 'estimate-send-to-client';
        } else {
            $template_name = 'estimate-already-send';
        }

        $contact = $this->clients_model->get_contact(get_primary_contact_user_id($estimate->clientid));
        $email = '';
        if ($contact) {
            $email = $contact->email;
        }

        $data['template'] = get_email_template_for_sending($template_name, $email);
        $data['template_name'] = $template_name;

        $this->db->where('slug', $template_name);
        $this->db->where('language', 'english');
        $template_result = $this->db->get('tblemailtemplates')->row();

        $data['template_system_name'] = $template_result->name;
        $data['template_id'] = $template_result->emailtemplateid;

        $data['template_disabled'] = false;
        if (total_rows('tblemailtemplates', ['slug' => $data['template_name'], 'active' => 0]) > 0) {
            $data['template_disabled'] = true;
        }

        $data['activity'] = $this->estimates_model->get_estimate_activity($id);
        $data['estimate'] = $estimate;
        $data['members'] = $this->staff_model->get('', ['active' => 1]);
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        $data['totalNotes'] = total_rows('tblnotes', ['rel_id' => $id, 'rel_type' => 'estimate']);
        if ($to_return == false) {
            $this->load->view('admin/estimates/estimate_preview_template', $data);
        } else {
            return $this->load->view('admin/estimates/estimate_preview_template', $data, true);
        }
    }

    public function get_estimates_total() {
        if ($this->input->post()) {
            $data['totals'] = $this->estimates_model->get_estimates_total($this->input->post());

            $this->load->model('currencies_model');

            if (!$this->input->post('customer_id')) {
                $multiple_currencies = call_user_func('is_using_multiple_currencies', 'tblestimates');
            } else {
                $multiple_currencies = call_user_func('is_client_using_multiple_currencies', $this->input->post('customer_id'), 'tblestimates');
            }

            if ($multiple_currencies) {
                $data['currencies'] = $this->currencies_model->get();
            }

            $data['estimates_years'] = $this->estimates_model->get_estimates_years();

            if (count($data['estimates_years']) >= 1 && $data['estimates_years'][0]['year'] != date('Y')) {
                array_unshift($data['estimates_years'], ['year' => date('Y')]);
            }

            $data['_currency'] = $data['totals']['currencyid'];
            unset($data['totals']['currencyid']);
            $this->load->view('admin/estimates/estimates_total_template', $data);
        }
    }

    public function add_note($rel_id) {
        if ($this->input->post() && user_can_view_estimate($rel_id)) {
            $this->misc_model->add_note($this->input->post(), 'estimate', $rel_id);
            echo $rel_id;
        }
    }

    public function get_notes($id) {
        if (user_can_view_estimate($id)) {
            $data['notes'] = $this->misc_model->get_notes($id, 'estimate');
            $this->load->view('admin/includes/sales_notes_template', $data);
        }
    }

    public function mark_action_status($status, $id) {
        /*if (!has_permission('estimates', '', 'edit')) {
            access_denied('estimates');
        }*/
        $success = $this->estimates_model->mark_action_status($status, $id);
        if ($success) {
            set_alert('success', _l('estimate_status_changed_success'));
        } else {
            set_alert('danger', _l('estimate_status_changed_fail'));
        }
        if ($this->set_estimate_pipeline_autoload($id)) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/list_estimates/' . $id));
        }
    }

    public function send_expiry_reminder($id) {
        $canView = user_can_view_estimate($id);
        if (!$canView) {
            access_denied('Estimates');
        } else {
            /*if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('Estimates');
            }*/
        }

        $success = $this->estimates_model->send_expiry_reminder($id);
        if ($success) {
            set_alert('success', _l('sent_expiry_reminder_success'));
        } else {
            set_alert('danger', _l('sent_expiry_reminder_fail'));
        }
        if ($this->set_estimate_pipeline_autoload($id)) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/list_estimates/' . $id));
        }
    }

    /* Send estimate to email */

    public function send_to_email($id) {
        $canView = user_can_view_estimate($id);
        if (!$canView) {
            access_denied('estimates');
        } else {
           /* if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('estimates');
            }*/
        }

        try {
            $success = $this->estimates_model->send_estimate_to_client($id, '', $this->input->post('attach_pdf'), $this->input->post('cc'));
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        // In case client use another language
        load_admin_language();
        if ($success) {
            set_alert('success', _l('estimate_sent_to_client_success'));
        } else {
            set_alert('danger', _l('estimate_sent_to_client_fail'));
        }
        if ($this->set_estimate_pipeline_autoload($id)) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/list_estimates/' . $id));
        }
    }

    /* Convert estimate to invoice */

    public function convert_to_invoice($id) {
        /*if (!has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }*/
        if (!$id) {
            die('No estimate found');
        }
        $draft_invoice = false;
        if ($this->input->get('save_as_draft')) {
            $draft_invoice = true;
        }
        $invoiceid = $this->estimates_model->convert_to_invoice($id, false, $draft_invoice);
        if ($invoiceid) {
            set_alert('success', _l('estimate_convert_to_invoice_successfully'));
            redirect(admin_url('invoices/list_invoices/' . $invoiceid));
        } else {
            if ($this->session->has_userdata('estimate_pipeline') && $this->session->userdata('estimate_pipeline') == 'true') {
                $this->session->set_flashdata('estimateid', $id);
            }
            if ($this->set_estimate_pipeline_autoload($id)) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('estimates/list_estimates/' . $id));
            }
        }
    }

    public function copy($id) {
        /*if (!has_permission('estimates', '', 'create')) {
            access_denied('estimates');
        }*/
        if (!$id) {
            die('No estimate found');
        }
        $new_id = $this->estimates_model->copy($id);
        if ($new_id) {
            set_alert('success', _l('estimate_copied_successfully'));
            if ($this->set_estimate_pipeline_autoload($new_id)) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('estimates/estimate/' . $new_id));
            }
        }
        set_alert('danger', _l('estimate_copied_fail'));
        if ($this->set_estimate_pipeline_autoload($id)) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/estimate/' . $id));
        }
    }

    /* Delete estimate */

    public function delete($id) {
        check_permission(6,'delete');
        if (!$id) {
            redirect(admin_url('estimates/list_estimates'));
        }
        $success = $this->estimates_model->delete($id);
        if (is_array($success)) {
            set_alert('warning', _l('is_invoiced_estimate_delete_error'));
        } elseif ($success == true) {
            set_alert('success', _l('deleted', _l('estimate')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('estimate_lowercase')));
        }
        redirect(admin_url('estimates/list_estimates'));
    }

    public function clear_acceptance_info($id) {
        if (is_admin()) {
            $this->db->where('id', $id);
            $this->db->update('tblestimates', get_acceptance_info_array(true));
        }

        redirect(admin_url('estimates/list_estimates/' . $id));
    }

    /* Generates estimate PDF and senting to email  */

    public function pdf($id) {
        $canView = user_can_view_estimate($id);
        if (!$canView) {
            access_denied('Estimates');
        } else {
            /*if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('Estimates');
            }*/
        }
        if (!$id) {
            redirect(admin_url('estimates/list_estimates'));
        }
        $estimate = $this->estimates_model->get($id);
        $estimate_number = format_estimate_number($estimate->id);

        try {
            $pdf = estimate_pdf($estimate);
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';

        if ($this->input->get('output_type')) {
            $type = $this->input->get('output_type');
        }

        if ($this->input->get('print')) {
            $type = 'I';
        }

        $pdf->Output(mb_strtoupper(slug_it($estimate_number)) . '.pdf', $type);
    }

    // Pipeline
    public function get_pipeline() {
        if (has_permission('estimates', '', 'view') || has_permission('estimates', '', 'view_own') || get_option('allow_staff_view_estimates_assigned') == '1') {
            $data['estimate_statuses'] = $this->estimates_model->get_statuses();
            $this->load->view('admin/estimates/pipeline/pipeline', $data);
        }
    }

    public function pipeline_open($id) {
        $canView = user_can_view_estimate($id);
        if (!$canView) {
            access_denied('Estimates');
        } else {
            /*if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('Estimates');
            }*/
        }

        $data['id'] = $id;
        $data['estimate'] = $this->get_estimate_data_ajax($id, true);
        $this->load->view('admin/estimates/pipeline/estimate', $data);
    }

    public function update_pipeline() {
        if (has_permission('estimates', '', 'edit')) {
            $this->estimates_model->update_pipeline($this->input->post());
        }
    }

    public function pipeline($set = 0, $manual = false) {
        if ($set == 1) {
            $set = 'true';
        } else {
            $set = 'false';
        }
        $this->session->set_userdata([
            'estimate_pipeline' => $set,
        ]);
        if ($manual == false) {
            redirect(admin_url('estimates/list_estimates'));
        }
    }

    public function pipeline_load_more() {
        $status = $this->input->get('status');
        $page = $this->input->get('page');

        $estimates = $this->estimates_model->do_kanban_query($status, $this->input->get('search'), $page, [
            'sort_by' => $this->input->get('sort_by'),
            'sort' => $this->input->get('sort'),
        ]);

        foreach ($estimates as $estimate) {
            $this->load->view('admin/estimates/pipeline/_kanban_card', [
                'estimate' => $estimate,
                'status' => $status,
            ]);
        }
    }

    public function set_estimate_pipeline_autoload($id) {
        if ($id == '') {
            return false;
        }
        if ($this->session->has_userdata('estimate_pipeline') && $this->session->userdata('estimate_pipeline') == 'true') {
            $this->session->set_flashdata('estimateid', $id);

            return true;
        }

        return false;
    }

    public function get_due_date() {
        if ($this->input->post()) {
            $date = $this->input->post('date');
            $duedate = '';
            if (get_option('estimate_due_after') != 0) {
                $date = to_sql_date($date);
                $d = date('Y-m-d', strtotime('+' . get_option('estimate_due_after') . ' DAY', strtotime($date)));
                $duedate = _d($d);
                echo $duedate;
            }
        }
    }

    public function approvalaccept() {
        $approve_status = $this->input->post('approve_status');
        $leadid = $this->input->post('leadid');
        $approvereason = $this->input->post('approvereason');
        $leadcreatorid = $this->input->post('leadcreatorid');
        $ldata['approve_status'] = $approve_status;
        $ldata['approvereason'] = $approvereason;
        $this->db->where('staff_id', get_staff_user_id());
        $this->db->where('lead_id', $leadid);
        $this->db->update('tblestimatestaffapproval', $ldata);
        if ($approve_status == 1) {


            $notified = add_notification([
                'description' => 'not_estimate_customer_accepted',
                'touserid' => $leadcreatorid,
                'fromuserid' => get_staff_user_id(),
                'link' => 'estimates/list_estimates/' . $leadid,
                'additional_data' => serialize([
                    format_estimate_number($leadid),
                ]),
            ]);
            if ($notified) {
                pusher_trigger_notification([$leadcreatorid]);
            }
        } else {
            $notified = add_notification([
                'description' => 'not_estimate_customer_declined',
                'touserid' => $leadcreatorid,
                'fromuserid' => get_staff_user_id(),
                'link' => 'estimates/list_estimates/' . $leadid,
                'additional_data' => serialize([
                    format_estimate_number($leadid),
                ]),
            ]);
            if ($notified) {
                pusher_trigger_notification([$leadcreatorid]);
            }

            //$this->Leads_model->lead_decline_member_notification($leadid, $leadcreatorid);
        }
        exit;
    }



    public function gettaxinfo($clintid) {
       echo get_gst_type($clintid);
    }




    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $estimate = $this->estimates_model->get($id);
        $estimate_number = format_estimate_number($estimate->id);
       /* echo $html = perfoma_infoice_pdf($estimate);
        die;*/



            $file_name = $estimate_number;


            if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                $html = nturm_perfoma_infoice_pdf($estimate);
            }else{
                $html = perfoma_infoice_pdf($estimate);
            }
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

        if ($estimate->status == 7){
            // Instantiate canvas instance 
            $canvas = $dompdf->getCanvas(); 

            // Get height and width of page 
            $w = $canvas->get_width(); 
            $h = $canvas->get_height(); 
            
            // Specify watermark image 
            $imageURL = 'assets/images/cancelled-img.jpg'; 
            $imgWidth = 500; 
            $imgHeight = 250; 
            
            // Set image opacity 
            $canvas->set_opacity(.2); 
            
            // Specify horizontal and vertical position 
            $x = (($w-$imgWidth)/2); 
            $y = (($h-$imgHeight)/2); 
            
            // Add an image to the pdf 
            $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight); 
        }

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



           // $dompdf->stream($file_name);
            $dompdf->stream($file_name, array("Attachment" => false));



    }


    public function gettaxtype(){
        $clientid = $_POST['clientid'];
        $client_info  = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$clientid."'")->row();

        $state = $client_info->state;
        echo get_gst_type_by_state($state);
    }


    public function get_pi_number()
    {
        extract($this->input->post());
        echo get_pi_number($service_type);

    }

    public function change_source()
    {
        extract($this->input->post());

       echo $update = $this->home_model->update('tblestimates', array('proforma_type'=>$source),array('id'=>$id));

    }

    /* this function use for get client list */
    public function get_client_list(){
        $client_id = $this->input->post("cid");
        $contacts = $this->db->query("SELECT c.firstname, c.email, c.id FROM `tblcontacts` as c where c.userid = ".$client_id." and c.email != '' GROUP by c.email")->result_array();
        $client_info = $this->db->query("SELECT client_branch_name as firstname, email_id as email, userid as id FROM `tblclientbranch` where `userid`= '".$client_id."' ORDER BY client_branch_name ASC ")->result_array();
        if (!empty($client_info)){
            $contacts = array_merge($contacts, $client_info);
        }
        echo render_select('sent_to[]',$contacts,array('email','email','firstname'),'invoice_estimate_sent_to_email', array(),array('multiple'=>true, 'required'=>true),array(),'','',false);
    }

    /* this function use for send mail of lead */
    public function estimate_send_to_mail(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            $estimate_data = $this->db->query("SELECT * FROM tblestimates WHERE id = ".$estimate_id."")->row();
            if (!empty($estimate_data)){
                $response = $this->emails_model->send_mail($estimate_id, "estimates", $module_template_id, $estimate_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Estimate mail send successfully");
                    redirect(admin_url('estimates/list'));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url('estimates/list'));
                }
            }
            else{
                set_alert('danger', "Estimate not found");
                redirect(admin_url('estimates/list'));
            }
        }
        else{
            redirect(admin_url('estimates/list'));
        }
    }

    public function order_confirm() {

        if ($_POST){
            extract($this->input->post());
            // echo "<pre>";
            // print_r($this->input->post());
            // exit;
            $ud_data["order_confirm"] = 1;
            $ud_data["expected_date_of_delivery"] = db_date($date_of_delivery);
            $update = $this->home_model->update('tblestimates', $ud_data,array('id'=>$estimate_id));
            if ($update){

                $add_field["estimate_id"] = $estimate_id;
                $add_field["delivery_date"] = db_date($date_of_delivery);
                $add_field["staff_id"] = get_staff_user_id();
                $add_field["branch_id"] = $branch_id;
                $add_field["updated_at"] = date("Y-m-d H:i:s");
                if ($orderconfirmtype == 1){
                    $add_field["created_at"] = date("Y-m-d H:i:s");
                    $insert_id = $this->home_model->insert("tblconfirmorder", $add_field);
                    $order_id = $insert_id;
                }else{
                    $insert_id = $this->home_model->update("tblconfirmorder", $add_field, array('id' => $confirm_order_id, 'estimate_id'=>$estimate_id));
                    $order_id = $confirm_order_id;
                }
                
                if ($insert_id){

                    if (!empty($orderprocesspro)) {
                        foreach($orderprocesspro as $k => $value){
                            if (!empty($value["name"])){
                                $ad["estimate_id"] = $estimate_id;
                                $ad["type"] = 1;
                                $ad["process_name"] = $value["name"];
                                if (isset($value["orderprocess_id"])){
                                    $this->home_model->update("tblconfirmorderprocess", $ad, array('id'=>$value["orderprocess_id"]));
                                }else{
                                    $ad["confirm_order_id"] = $order_id;
                                    $ad["staff_id"] = get_staff_user_id();
                                    $this->home_model->insert("tblconfirmorderprocess", $ad);
                                }
                            }
                        }
                    }
                    if (!empty($orderprocessdelivery)) {
                        foreach($orderprocessdelivery as $k => $value){
                            if (!empty($value["name"])){
                                $ad["estimate_id"] = $estimate_id;
                                $ad["type"] = 2;
                                $ad["process_name"] = $value["name"];
                                if (isset($value["orderprocess_id"])){
                                    $this->home_model->update("tblconfirmorderprocess", $ad, array('id'=>$value["orderprocess_id"]));
                                }else{
                                    $ad["confirm_order_id"] = $order_id;
                                    $ad["staff_id"] = get_staff_user_id();
                                    $this->home_model->insert("tblconfirmorderprocess", $ad);
                                }
                            }
                        }
                    }
                }

                set_alert('success', "Order Confirmed successfully");
                redirect(admin_url('estimates/list'));
            }else{
                set_alert('warning', "Something went wrong");
                redirect(admin_url('estimates/list'));
            }
        }
        else{
            redirect(admin_url('estimates/list'));
        }
    }

    /* this function use for list of order confirmed */
    public function confirm_order_list(){
        check_permission(397,'view');
        // $where = "order_confirm = 1";
        // $where = "c.branch_id=".get_login_branch();
        // $where = "c.branch_id=".get_login_branch();
        $data['section'] = (!empty($_GET['section'])) ? $_GET['section'] : 1;
        $where1 = "c.id > 0";
        $where2 = "c.id > 0";
        $where3 = "c.id > 0";
        if(!empty($_POST)){
            extract($this->input->post());
            $data['section'] = $section;
           
            if(!empty($type)){
                $data['type'] = $type;
                if ($section == 1){
                    $where1 .= " and e.proforma_type = '".$type."'";
                }else if ($section == 2){
                    $where2 .= " and e.proforma_type = '".$type."'";
                }else if ($section == 3){
                    $where3 .= " and e.proforma_type = '".$type."'";
                }
            }
            if(!empty($product_type)){
                $data['product_type'] = $product_type;
                if ($section == 1){
                    $where1 .= " and e.product_type = '".$product_type."'";
                }else if ($section == 2){
                    $where2 .= " and e.product_type = '".$product_type."'";
                }else if ($section == 3){
                    $where3 .= " and e.product_type = '".$product_type."'";
                }
            }

            if(!empty($clientid)){
                $data['clientid'] = $clientid;
                if ($section == 1){
                    $where1 .= " and e.clientid = '".$clientid."'";
                }else if ($section == 2){
                    $where2 .= " and e.clientid = '".$clientid."'";
                }else if ($section == 3){
                    $where3 .= " and e.clientid = '".$clientid."'";
                }
            }

            if (isset($status) && strlen($status) > 0){
                $data['status'] = $status;
                if ($section == 1){
                    $where1 .= " and c.complete_status = '".$status."'";
                    $where2 .= " and c.complete_status = 0";
                    $where3 .= " and c.complete_status = 0";
                }else if ($section == 2){
                    $where1 .= " and c.complete_status = 0";
                    $where3 .= " and c.complete_status = 0";
                    $where2 .= " and c.complete_status = '".$status."'";
                }else if ($section == 3){
                    $where1 .= " and c.complete_status = 0";
                    $where2 .= " and c.complete_status = 0";
                    $where3 .= " and c.complete_status = '".$status."'";
                }
                
            }else{
                $where1 .= " and c.complete_status = 0";
                $where2 .= " and c.complete_status = 0";
                $where3 .= " and c.complete_status = 0";
            }

            if (!empty($branch_id)){
                $data['branch_id'] = $branch_id;
                if ($section == 1){
                    $where1 .= " and c.branch_id=".$branch_id;
                    $where2 .= " and c.branch_id=".get_login_branch();
                    $where3 .= " and c.branch_id=".get_login_branch();
                }else if ($section == 2){
                    $where2 .= " and c.branch_id=".$branch_id;
                    $where1 .= " and c.branch_id=".get_login_branch();
                    $where3 .= " and c.branch_id=".get_login_branch();
                }else if ($section == 3){
                    $where3 .= " and c.branch_id=".$branch_id;
                    $where1 .= " and c.branch_id=".get_login_branch();
                    $where2 .= " and c.branch_id=".get_login_branch();
                }
            }else{
                $data['branch_id'] = get_login_branch();
                $where1 .= " and c.branch_id=".get_login_branch();
                $where2 .= " and c.branch_id=".get_login_branch();
                $where3 .= " and c.branch_id=".get_login_branch();
            }
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                if ($section == 1){
                    $where1 .= " and e.date between '".$f_date."' and '".$t_date."' ";
                }else if ($section == 2){
                    $where2 .= " and e.date between '".$f_date."' and '".$t_date."' ";
                }else if ($section == 3){
                    $where3 .= " and e.date between '".$f_date."' and '".$t_date."' ";
                }
            }
        }else{
            $data['branch_id'] = get_login_branch();
            //$where .= " and c.complete_status = 0 and e.year_id = '".financial_year()."'";
            $where1 .= " and c.complete_status = 0 AND c.branch_id='".get_login_branch()."'";
            $where2 .= " and c.complete_status = 0 AND c.branch_id='".get_login_branch()."'";
            $where3 .= " and c.complete_status = 0 AND c.branch_id='".get_login_branch()."'";
        }

        $aluminium_list = $this->db->query("SELECT e.*, c.id as confirm_order_id, c.complete_status, c.delivery_date, c.order_status_id, c.expected_completed_date, c.compilation_days, c.priority, c.proformachallan_id, c.created_at FROM `tblconfirmorder` as c LEFT JOIN `tblestimates` as e  ON e.id = c.estimate_id WHERE ".$where1." AND e.product_type = '1' ORDER BY c.id DESC")->result();
        $fomwork_list = $this->db->query("SELECT e.*, c.id as confirm_order_id, c.complete_status, c.delivery_date, c.order_status_id, c.expected_completed_date, c.compilation_days, c.priority, c.proformachallan_id, c.created_at FROM `tblconfirmorder` as c LEFT JOIN `tblestimates` as e  ON e.id = c.estimate_id WHERE ".$where2." AND e.product_type = '4' ORDER BY c.id DESC")->result();
        $scaffolding_list = $this->db->query("SELECT e.*, c.id as confirm_order_id, c.complete_status, c.delivery_date, c.order_status_id, c.expected_completed_date, c.compilation_days, c.priority, c.proformachallan_id, c.created_at FROM `tblconfirmorder` as c LEFT JOIN `tblestimates` as e  ON e.id = c.estimate_id WHERE ".$where3." AND e.product_type = '3' ORDER BY c.id DESC")->result();
        // Get records
        /*$order_confirm_list = array();

        if ($estimate_list){
            foreach ($estimate_list as $value) {
                $check_chalan = $this->db->query("SELECT `id`,`process`,`under_process` FROM `tblchalanmst` WHERE `rel_type`='estimate' AND `rel_id` = '".$value->id."' ORDER BY id DESC")->row();
                $view = 1;
                if(!empty($check_chalan)){
                    $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$check_chalan->id."' and `for` = 1 ")->row();
                    if(!empty($delivery_ho)){
                        $view = 0;
                        $this->home_model->update("tblconfirmorder", array("complete_status" => 1), array("estimate_id" => $value->id));
                    }
                }
                if ($view === 1){
                    $order_confirm_list[] = $value;
                }
            }
        }
        $data["order_confirm_list"] = $order_confirm_list;*/

        //Removing duplicate Entries
        $duplicate_data = $this->db->query("SELECT estimate_id, COUNT(estimate_id) FROM tblconfirmorder GROUP BY estimate_id HAVING COUNT(estimate_id) > 1")->result();
        if(!empty($duplicate_data)){
            foreach ($duplicate_data as $row) {
                $order_info = $this->db->query("SELECT * FROM tblconfirmorder where estimate_id = '".$row->estimate_id."' ")->result();
                if(!empty($order_info)){
                    foreach ($order_info as $key => $c_order) {
                        if($key > 0){
                            if($c_order->proformachallan_id == 0 && $c_order->delivery_complete_status == 0){
                               // echo $c_order->id.' - '.$c_order->estimate_id.' <br>';
                                $this->home_model->delete("tblconfirmorder", array("id" => $c_order->id));
                            }
                            
                        }
                    }
                }
            }
        }

        
        $data["order_confirm_list"] = $aluminium_list;
        $data["fomwork_list"] = $fomwork_list;
        $data["scaffolding_order_list"] = $scaffolding_list;

        $data['client_branch_data'] = $this->db->query("SELECT * from `tblclientbranch` WHERE client_branch_name != '' ORDER BY client_branch_name ASC")->result();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE status=1 ORDER BY name ASC")->result();
        $data['title'] = 'Confirm Order List of Production (SEPL/PRD/07)';
        $data['branch_info'] = $this->db->query("SELECT `id`,`comp_branch_name` from `tblcompanybranch` where status = 1 ORDER BY comp_branch_name ASC ")->result();
        $this->load->view('admin/estimates/confirm_order_list', $data);
    }

    /* this function use for confirm order status */
    public function confirm_order_status(){
        $where = "id != 11";
        check_permission(368,'view');
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) || !empty($t_date)){
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
        }

        $data["order_status_list"] = $this->db->query("SELECT * FROM `tblconfirmorderstatus` WHERE ".$where." ORDER BY id DESC")->result();

        $data['title'] = 'Confirm Order Status';
        $this->load->view('admin/estimates/confirm_order_status_list', $data);
    }

    /* this function use for add Confirm Order Status */
    public function addConfirmOrderStatus($id = ""){
        
        if(!empty($_POST)){
            extract($this->input->post());

            $fieldData["title"] = $title;
            $fieldData["updated_at"] = date("Y-m-d H:i:s");
            if ($id != ""){

                $this->home_model->update("tblconfirmorderstatus", $fieldData, array("id" => $id));
                set_alert('success', "Order status edit successfully");
            }else{
                $fieldData["added_by"] = get_staff_user_id();
                $fieldData["date"] = date("Y-m-d");
                $fieldData["created_at"] = date("Y-m-d H:i:s");
                $this->home_model->insert("tblconfirmorderstatus", $fieldData);
                set_alert('success', "Order status add successfully");
            }

            redirect(admin_url('estimates/confirm_order_status'));
        }

        if ($id != ""){
            check_permission(368,'create');
            $data['title'] = 'Update Confirm Order Status';
            $data["order_status"] = $this->db->query("SELECT * FROM `tblconfirmorderstatus` WHERE `id`=".$id."")->row();
        }else{
            check_permission(368,'edit');
            $data['title'] = 'Add Confirm Order Status';
        }

        $this->load->view('admin/estimates/confirm_order_status_add', $data);
    }

    /* this function use for delete confirm order status */
    public function deleteConfirmOrderStatus($id){

        $chk_record = $this->db->query("SELECT * FROM `tblconfirmorder` WHERE order_status_id =".$id." ")->row();
        if(!empty($chk_record)){
            set_alert('success', "Con't be deleted, this status used anywhere.");
        }else{

            $success = $this->home_model->delete("tblconfirmorderstatus", array("id" => $id));
            if ($success) {
                set_alert('success', "Order status deleted successfully");
            } else {
                set_alert('warning', "Something went wrong");
            }
        }
        redirect(admin_url('estimates/confirm_order_status'));
    }

    /* this function use for get Order Process */
    public function getOrderProcess(){
        if(!empty($_POST)){
            extract($this->input->post());

            $order_info = $this->db->query("SELECT * FROM `tblconfirmorder` WHERE `estimate_id` = ".$estimate_id." ORDER BY id ASC LIMIT 1")->row();
            $corder_id = (!empty($order_info)) ? $order_info->id : 0;
            $orderlist = $this->db->query("SELECT * FROM `tblconfirmorderprocess` WHERE `confirm_order_id` = ".$corder_id." AND `estimate_id` = ".$estimate_id." AND `show_list`= 1 ORDER BY `type` ASC")->result();
            $chkprocess = $this->db->query("SELECT COUNT(*) as ttl_row FROM `tblconfirmorderprocess` WHERE `confirm_order_id` = ".$corder_id." AND `estimate_id` = ".$estimate_id." AND `complete_status` = 1")->row()->ttl_row;
            $count = (!empty($orderlist)) ? count($orderlist) : 0;
            if ($count > 0){
                $percentage = round(($chkprocess / $count) * 100); // 20
            }else{
                $percentage = 0;
            }
                $html = "";
                if (!empty($orderlist)){
                    

                    $pro_status = value_by_id("tblconfirmorderstatus", $order_info->order_status_id, "title");
                    $pro_status = (!empty($pro_status)) ? $pro_status : "--";
                    $complete_date = (!empty($order_info->expected_completed_date)) ? _d($order_info->expected_completed_date) : "--";
                    $remark = (!empty($order_info->remark)) ? $order_info->remark : "--";
                    $html .= '<div class="form-group col-md-12"><strong class="text-center" style="color:orange; font-size:20px;">Track Order </strong></div>';
                    $html .= '<div class="col-md-12">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">
                                            <span class="process-per">'.$percentage.'</span>%
                                        </div>
                                    </div>
                                    <div class="panel panel-danger">
                                        <div class="panel-body">
                                            <div class="row form-group">
                                                <div class="col-md-4">Production Status : </div>
                                                <div class="col-md-8"><div class="label label-info">'.$pro_status.'</div></div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">Production Expected Complete Date : </div>
                                                <div class="col-md-8"><div class="label label-info">'.$complete_date.'</div></div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">Production Remark : </div>
                                                <div class="col-md-8">'.cc($remark).'</div>
                                                <input type="hidden" name="confirm_order_id" value="'.$order_info->id.'">
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                }

                $html .=  '<div class="col-md-12 form-group"></div>
                    <div class="col-md-12">';
//                            if (!empty($orderlist)){
//                                $i = 0;
//                                $html .= '<div class="row">';
//                                foreach ($orderlist as $key => $value) {
//                                    $html .= '<div class="col-md-12"><div class="panel_s"><div class="panel-body">';
//                                    if ($value->complete_status == 1){
//                                        $html .= '<div class="row'.$i.'">
//                                                    <div class="col-md-8 form-group">'.++$key. ") ".$value->process_name.'</div>
//                                                    <div class="col-md-4" style="color: yellowgreen;"><i class="fa-2x fa fa-check-circle"></i> Delivered</div>
//                                                </div>';
//                                    }else{
//                                        $html .= '<div class="row'.$i.'">
//                                                    <div class="col-md-8 form-group">'.++$key. ") ".$value->process_name.'</div>
//                                                    <div class="col-md-4" style="color: orange;"><i class="fa-2x fa fa-clock-o"></i> Pending</div>
//                                                </div>';
//                                    }
//                                    $html .= '</div></div></div>';
//                                    $i++;
//                                }
//                                $html .= '</div>';
//                            }else{
//
//                            }

                            $colfield =  (!empty($orderlist)) ? '<th scope="col">Type</th><th scope="col">Added By</th><th scope="col">Status</th>' : '';
                            $html .=  (empty($orderlist)) ? '<h4 class="text-danger">For Production</h4><hr>' : "";
                            $html .=  '<table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><i class="fa fa-cog"></i></th>
                                                    <th scope="col">Special Remark</th>'.$colfield.'
                                                </tr>
                                            </thead>
                                            <tbody class="input_fields_wrap">';
                                            if (!empty($orderlist)){
                                                $i = 0;
                                                foreach ($orderlist as $key => $value) {

                                                      $type = ($value->type == 1) ? "For Production" : "For Delivery";
                                                      $added_by = get_employee_name($value->staff_id);
                                                      $colfieldval =  ($value->complete_status == 1) ? '<td style="color: yellowgreen;"><i class="fa-2x fa fa-check-circle"></i> Completed</td>' : '<td style="color: orange;"><i class="fa-2x fa fa-clock-o"></i> Pending</td>';
                                                      $revisedorder =  ($value->parent_id > 0) ? ' <a href="javascript:void(0);" onclick="get_revised_processlist('.$value->parent_id.');" class="label label-info"> Revised</a>':'';
                                                      $html .=  '<tr class="row'.$i.'">
                                                                      <td width="5%">'.++$key.'</td>';
                                                        if ($value->type == 1){
                                                            $html .=  '<td>
                                                                          <input type="hidden" name="orderprocesspro['.$i.'][orderprocess_id]" class="form-control" value="'.$value->id.'">
                                                                          <input type="hidden" name="orderprocesspro['.$i.'][type]" class="form-control" value="'.$value->type.'">
                                                                          <input type="text" name="orderprocesspro['.$i.'][name]" class="form-control" value="'.$value->process_name.'">
                                                                      </td>';
                                                        }else{
                                                            $html .=  '<td>
                                                                          <input type="hidden" name="orderprocessdelivery['.$i.'][orderprocess_id]" class="form-control" value="'.$value->id.'">
                                                                          <input type="hidden" name="orderprocessdelivery['.$i.'][type]" class="form-control" value="'.$value->type.'">
                                                                          <input type="text" name="orderprocessdelivery['.$i.'][name]" class="form-control" value="'.$value->process_name.'">
                                                                      </td>';
                                                        }              
                                                           $html .=  '<td>'.$type.$revisedorder.'</td>
                                                                      <td>'.$added_by.'</td>
                                                                      '.$colfieldval.'
                                                                  </tr>';
                                                      $i++;
                                                }

                                            }else{
                                                $html .=  '<tr class="row'.$count.'">
                                                                <td width="5%"></td>
                                                                <td>
                                                                    <input type="hidden" name="orderprocesspro['.$count.'][type]" class="form-control" value="1">
                                                                    <input type="text" required="" name="orderprocesspro['.$count.'][name]" class="form-control" >
                                                                </td>

                                                            </tr>';
                                            }
                            $html .=  '     </tbody>'
                                    . '</table>';
                            if (empty($orderlist)){
                                $html .=  '<div class="form-group col-md-12"><a href="javascript:void(0);" class="add_field_button btn-sm btn-success pull-right" value="'.$count.'"><i class="fa fa-plus-circle"></i> Add More Remark</a></div>';
                            }
                            if (empty($orderlist)){
                                $html .=  '<h4 class="text-danger">For Delivery</h4><hr>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><i class="fa fa-cog"></i></th>
                                                        <th scope="col">Special Remark</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="input_fields_wrap2">';
                                        $html .=  '<tr class="row'.$count.'">
                                                        <td width="5%"></td>
                                                        <td>
                                                            <input type="hidden" name="orderprocessdelivery['.$count.'][type]" class="form-control" value="2">
                                                            <input type="text" required="" name="orderprocessdelivery['.$count.'][name]" class="form-control" >
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>';
                            }
                            if (empty($orderlist)){
                                $html .=  '<div class="form-group col-md-12"><a href="javascript:void(0);" class="add_field_button2 btn-sm btn-success pull-right" value="'.$count.'"><i class="fa fa-plus-circle"></i> Add More Remark</a></div>';
                            }

                $html .= '
                    </div>
                </div>';
//                $html .=  '<div class="row">
//                    <div class="input_fields_wrap">';
//                        if (!empty($orderlist)){
//                            $i = 0;
//                            foreach ($orderlist as $key => $value) {
//                                $html .= '<div class="col-md-12"><div class="panel_s"><div class="panel-body">';
//                                if ($value->complete_status == 1){
//                                    $html .= '<div class="row'.$i.'">
//                                                <div class="col-md-8 form-group">'.++$key. ") ".$value->process_name.'</div>
//                                                <div class="col-md-4" style="color: yellowgreen;"><i class="fa-2x fa fa-check-circle"></i> Delivered</div>
//                                            </div>';
//                                }else{
//                                    $html .= '<div class="row'.$i.'">
//                                                <div class="col-md-8 form-group">'.++$key. ") ".$value->process_name.'</div>
//                                                <div class="col-md-4" style="color: orange;"><i class="fa-2x fa fa-clock-o"></i> Pending</div>
//                                            </div>';
//                                }
//                                $html .= '</div></div></div>';
//                                $i++;
//                            }
//
//                        }else{
//                            $html .= '<div class="row'.$count.'">
//                                        <div class="col-md-10 form-group"><input type="text" name="orderprocessname[]" class="form-control"></div>
//                                    </div>';
//                        }
//                $html .= '</div>
//                    </div>
//                </div>';

            echo $html;
        }
    }

    public function getConfirmOrder(){
        if(!empty($_POST)){
            extract($this->input->post());

            $orderlist = $this->db->query("SELECT * FROM `tblconfirmorder` WHERE `estimate_id` = ".$estimate_id." AND `id`= ".$confirm_order_id."")->row();
            if ($orderlist){
                $expected_date = ($orderlist->expected_completed_date != "0000-00-00") ? $orderlist->expected_completed_date : "";
                $output = array("expected_completed_date" => $expected_date, "order_status_id" => $orderlist->order_status_id, "remark" => $orderlist->remark);
                echo json_encode($output);
            }
        }
    }

    public function order_confirm_status(){

        if(!empty($_POST)){
            extract($this->input->post());
            if ($section == "cdate"){
                
                $expected_compalete_date = (!empty($expected_compalete_date)) ? db_date($expected_compalete_date) : "";
                $ad["expected_completed_date"] = $expected_compalete_date;
                $this->home_model->update("tblconfirmorder", $ad, array("estimate_id" => $estimate_id, "id" => $confirm_order_id));
                set_alert('success', "Expected date updated successfully");
            }else{

                $ad["order_status_id"] = $order_status_id;
                $ad["remark"] = $remark;
                if ($order_status_id == '11'){
                    $ad["complete_status"] = 1;
                }
                /* this function use for check for delivery or not */
                $is_delivery = value_by_id_empty("tblconfirmorderstatus", $order_status_id, "for_delivery");
                if ($is_delivery == 1){
                    $ad["complete_status"] = 1;
                    /* this code commented because manage delivary status from confirm order table */
                    // $production_data = $this->db->query("SELECT * FROM `tblconfirmorder` WHERE `estimate_id`=".$estimate_id." ")->row();
                    // if (!empty($production_data)){
                    //     /* this is for store for delivery record */
                    //     $add_field["estimate_id"] = $estimate_id;
                    //     $add_field["confirmordertable_id"] = $production_data->id;
                    //     $add_field["delivery_date"] = db_date($production_data->delivery_date);
                    //     $add_field["expected_completed_date"] = $production_data->expected_completed_date;
                    //     $add_field["staff_id"] = get_staff_user_id();
                    //     $add_field["branch_id"] = $production_data->branch_id;
                    //     $add_field["created_at"] = date("Y-m-d H:i:s");
                    //     $add_field["updated_at"] = date("Y-m-d H:i:s");
                    //     $this->home_model->insert("tblconfirmorder_delivery", $add_field);
                    // }]
                    /* this code for check priority */
                    $chk_priority = $this->db->query("SELECT `priority` FROM tblconfirmorder WHERE `estimate_id` = '".$estimate_id."' AND `id` = '".$confirm_order_id."' ")->row();
                    if (!empty($chk_priority) && $chk_priority->priority > 0){
                        $get_order_priority = $this->db->query("SELECT `id`,`priority` FROM tblconfirmorder WHERE `priority` > '".$chk_priority->priority."' ORDER BY priority ASC ")->result();
                        if (!empty($get_order_priority)){
                            foreach ($get_order_priority as $key => $value) {
                                $this->home_model->update("tblconfirmorder", array("priority" => $value->priority-1), array("id" => $value->id));
                            }
                        }
                        $ad["priority"] = 0;
                    }
                }
                $this->home_model->update("tblconfirmorder", $ad, array("estimate_id" => $estimate_id, "id" => $confirm_order_id));
                set_alert('success', "Order status updated successfully");
            }
        }
        redirect(admin_url('estimates/confirm_order_list?section='.$section_id));
    }

    public function confirm_order_process(){
        $stype = 1;
        if(!empty($_POST)){
            extract($this->input->post());
            $stype = ($order_type == "delivery") ? 2 : 1;
            if (!empty($trackprocess)){
                foreach ($trackprocess as $rid => $value) {
                    $ad["complete_status"] = 1;
                    $this->home_model->update("tblconfirmorderprocess", $ad, array("id" => $rid, "estimate_id" => $estimate_id));
                }
            }
            set_alert('success', "Order process status updated successfully");
        }
        $page = ($stype == 1) ? 'estimates/confirm_order_list' : 'estimates/delivery_order_list';
        redirect(admin_url($page));
    }

    public function add_new_process_name(){
      $stype = 1;
      if(!empty($_POST)){
          extract($this->input->post());
          
            if(isset($orderprocess) && !empty($orderprocess)){
                foreach($orderprocess as $k => $value){
                    $stype = $value["type"];
                    if (!empty($value["name"])){
                        $order_id = (isset($confirm_order_id)) ? $confirm_order_id : 0;    

                        $ad["confirm_order_id"] = $order_id;
                        $ad["estimate_id"] = $estimate_id;
                        $ad["type"] = $value["type"];
                        $ad["process_name"] = $value["name"];
                        $ad["staff_id"] = get_staff_user_id();
                        $this->home_model->insert("tblconfirmorderprocess", $ad);
                    }
                }
            }
          set_alert('success', "Remark add successfully");
      }
      $page = ($stype == 1) ? 'estimates/confirm_order_list' : 'estimates/delivery_order_list';
      redirect(admin_url($page));
    }

    public function getOrderDeliveryProcess(){
        if(!empty($_POST)){
            extract($this->input->post());

            $orderlist = $this->db->query("SELECT * FROM `tblconfirmorderprocess` WHERE `estimate_id` = ".$estimate_id." AND `confirm_order_id` = ".$confirm_order_id." AND `type` = 1 AND `show_list`= 1")->result();
            $chkprocess = $this->db->query("SELECT COUNT(*) as ttl_row FROM `tblconfirmorderprocess` WHERE `estimate_id` = ".$estimate_id." AND `confirm_order_id` = ".$confirm_order_id." AND `type` = 1 AND `show_list`= 1 AND `complete_status` = 1")->row()->ttl_row;
            $count = (!empty($orderlist)) ? count($orderlist) : 0;
            if ($count > 0){
                $percentage = round(($chkprocess / $count) * 100); // 20
            }else{
                $percentage = 0;
            }

                $html = '<div class="col-md-12">
                            <div class="col-md-3 mb-3"> <small> Track Order <span><i class=" ml-2 fa fa-refresh" aria-hidden="true"></i></span></small></div>
                            <div class="col mt-auto">
                                <div class="progress">
                                    <input type="hidden" class="totalcomplete" value="'.$chkprocess.'">
                                    <input type="hidden" class="totalstep" value="'.$count.'">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">
                                        <span class="process-per">'.$percentage.'</span>%
                                    </div>
                                </div>
                            </div>
                        </div>';

            if ($orderlist){
                $html .= '<div class="col-md-12">';
                $chk_op = 0;
                foreach ($orderlist as $key => $value) {
                    $checked = ($value->complete_status == 1) ? "checked":"";
                    if ($value->complete_status == 1){
                        $chk_op = $key+1;
                    }
                    $employee_name = get_employee_fullname($value->staff_id);
                    $disable_cls = ($chk_op < $key) ? "disabled": "";
                    $disable_cls = ($value->complete_status == 1) ? "disabled": $disable_cls;
                    $revisedorder =  ($value->parent_id > 0) ? ' <a href="javascript:void(0);" onclick="get_revised_processlist('.$value->parent_id.');" class="btn-sm btn-info"> Revised</a>':'';
                    $html .= '<div class="panel_s"><div class="panel-body"><div class="row">';
                    if ($value->complete_status == 0){
                        $html .= '<div class="col-md-12 "><div class="pull-right"><a class="btn-sm btn-success" href="javascript:void(0);" data-pname="'.$value->process_name.'" onclick="addmodification('.$value->id.');">Modify</a></div><hr></div>';
                    }
                    $html .= '<div class="col-md-8">'.++$key.') '.cc($value->process_name).'</div>';
                    $html .= '<div class="col-md-4"><input type="checkbox" name="trackprocess['.$value->id.']" class="processcheck pull-right" '.$checked.' '.$disable_cls.'></div>';
                    $html .= '<div class="col-md-12"><span class="text-danger">Added By:</span> '.$employee_name.' '.$revisedorder.'</div>';
                    $html .= '<input type="hidden" name="order_type" value="production">';
                    $html .= '</div></div></div>';
                }
                $html .= '</div>';
            }
            echo $html;
        }
    }

    public function estimate_cancel(){
        if(!empty($_POST)){
            extract($this->input->post());

             $this->home_model->update("tblestimates", array("status" => 7, "cancel_remark" => $remark), array("id" => $estimate_id));
             set_alert('success', "Estimate Canceled successfully");
             redirect(admin_url('estimates/list'));
        }
    }
    public function revised_orderprocess(){
      $sectiontype = 1;
      $section_id = 1;
      if(!empty($_POST)){
          extract($this->input->post());

            $getdata = $this->db->query("SELECT * FROM `tblconfirmorderprocess` WHERE `id` = ".$orderprocess_id." ")->row();
            if(!empty($getdata)){
                if (!empty($processname)){
                    $sectiontype = $getdata->type;
                    $ad["parent_id"] = $orderprocess_id;
                    $ad["confirm_order_id"] = $getdata->confirm_order_id;
                    $ad["estimate_id"] = $getdata->estimate_id;
                    $ad["type"] = $getdata->type;
                    $ad["process_name"] = $processname;
                    $ad["staff_id"] = get_staff_user_id();
                    $this->home_model->insert("tblconfirmorderprocess", $ad);

                    $this->home_model->update("tblconfirmorderprocess", array("show_list" => 0), array("id" => $orderprocess_id));
                }
               set_alert('success', "Order Process Name Add Succesfully");
            }
            $page = ($sectiontype == 1) ? 'estimates/confirm_order_list?section='.$section_id : 'estimates/delivery_order_list';
           redirect(admin_url($page));
      }
    }
    public function get_revised_processlist(){
      if(!empty($_POST)){
          extract($this->input->post());
          $data = $this->getRevisedData($id);
          if ($data != ""){
            echo '<div class="panel_s"><div class="panel-body">
                    <a href="javascript:void(0);" class="btn-sm btn-danger close-revised"><i class="fa fa-close"></i></a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fa fa-cog"></i></th>
                                <th scope="col">Special Remark</th>
                                <th scope="col">Added By</th>
                            </tr>
                        </thead>
                        <tbody>'.$data.'</tbody>
                    </table></div></div>';
          }
      }
    }
    public function getRevisedData($id, $html = "", $i=1){
        $getdata = $this->db->query("SELECT `parent_id`,`process_name`,`staff_id` FROM `tblconfirmorderprocess` WHERE `id` = ".$id." ")->row();
        if (!empty($getdata)){
            $employee_name = get_employee_fullname($getdata->staff_id);
            $orderhtml = '<tr>
                          <td>'.$i.'</td>
                          <td>'.cc($getdata->process_name).'</td>
                          <td>'.$employee_name.'</td>
                      </tr>';
            if ($getdata->parent_id > 0){
                $html .= $this->getRevisedData($getdata->parent_id, $orderhtml, $i+1);
            }else{
                $html .= $orderhtml;
            }
        }
        return $html;
    }

    /* this function use for list of delivery order confirmed */
    public function delivery_order_list(){
        check_permission(389,'view');
//        $where = "order_confirm = 1";
        $where = "ch.approve_status = 1";

        if(!empty($_POST)){
            extract($this->input->post());
            
            if(!empty($clientid)){
                $data['clientid'] = $clientid;
                $where .= " and ch.clientid = '".$clientid."'";
            }
            if (isset($status) && strlen($status) > 0){
                $data['status'] = $status;
                $where .= " and c.delivery_complete_status = '".$status."'";
            }else{
                $where .= " and (c.complete_status = 0 OR c.delivery_complete_status = 0)";
            }

            if (!empty($branch_id)){
                $data['branch_id'] = $branch_id;
                $where .= " and c.branch_id=".$branch_id;
            }else{
                $data['branch_id'] = get_login_branch();
                $where .= " and c.branch_id=".get_login_branch();
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                $where .= " and ch.challandate between '".$f_date."' and '".$t_date."' ";
            }
        }else{
            $data['branch_id'] = get_login_branch();
            //$where .= " and c.complete_status = 0 and ch.year_id = '".financial_year()."'";
            $where .= " and (c.complete_status = 0 OR c.delivery_complete_status = 0) and c.branch_id='".get_login_branch()."'";
        }
        
        // $delivery_order_list = $this->db->query("SELECT ch.*, c.complete_status, c.delivery_date, c.expected_completed_date FROM `tblconfirmorder_delivery` as c LEFT JOIN `tblchalanmst` as ch  ON `ch`.`rel_id` = `c`.`estimate_id` AND `ch`.`rel_type` = 'estimate' WHERE ".$where." ORDER BY ch.id DESC")->result();
        $delivery_order_list = $this->db->query("SELECT ch.*, c.id as confirm_order_id, c.id as confirmorder_id, c.order_status_id, c.complete_status, c.delivery_date, c.expected_completed_date, c.delivery_complete_status, c.proformachallan_id,c.estimate_id FROM `tblconfirmorder` as c LEFT JOIN `tblchalanmst` as ch  ON (`ch`.`rel_id` = `c`.`estimate_id` AND `ch`.`rel_type` = 'estimate') OR (`ch`.`rel_id` = `c`.`proformachallan_id` AND `ch`.`rel_type` = 'proforma_challan') WHERE ".$where." ORDER BY ch.id DESC")->result();
        // echo $this->db->last_query();
        // exit;
        $data["delivery_order_list"] = $delivery_order_list;

        $data['client_branch_data'] = $this->db->query("SELECT * from `tblclientbranch` ORDER BY client_branch_name ASC ")->result();
        $data['branch_info'] = $this->db->query("SELECT `id`,`comp_branch_name` from `tblcompanybranch` where status = 1 ORDER BY comp_branch_name ASC ")->result();
        $data['title'] = 'Confirm Order List of Delivery (SEPL/PRD/07)';
        $this->load->view('admin/estimates/delivery_order_list', $data);
    }

    public function delivery_order_status(){

        if(!empty($_POST)){
            extract($this->input->post());
            $expected_compalete_date = (!empty($expected_compalete_date)) ? db_date($expected_compalete_date) : "";
            $ad["expected_completed_date"] = $expected_compalete_date;
            $this->home_model->update("tblconfirmorder_delivery", $ad, array("estimate_id" => $estimate_id));
            set_alert('success', "Expected date updated successfully");
        }
        redirect(admin_url('estimates/delivery_order_list'));
    }

    public function getDeliveryProcess(){
        if(!empty($_POST)){
            extract($this->input->post());

            $orderlist = $this->db->query("SELECT * FROM `tblconfirmorderprocess` WHERE `confirm_order_id`= ".$confirm_order_id." AND `estimate_id` = ".$estimate_id." AND `type` = 2 AND `show_list`= 1")->result();
            $chkprocess = $this->db->query("SELECT COUNT(*) as ttl_row FROM `tblconfirmorderprocess` WHERE `estimate_id` = ".$estimate_id." AND  `type` = 2 AND `show_list`= 1 AND `complete_status` = 1")->row()->ttl_row;
            $count = (!empty($orderlist)) ? count($orderlist) : 0;
            if ($count > 0){
                $percentage = round(($chkprocess / $count) * 100); // 20
            }else{
                $percentage = 0;
            }

                $html = '<div class="col-md-12">
                            <div class="col-md-3 mb-3"> <small> Track Order <span><i class=" ml-2 fa fa-refresh" aria-hidden="true"></i></span></small></div>
                            <div class="col mt-auto">
                                <div class="progress">
                                    <input type="hidden" class="totalcomplete" value="'.$chkprocess.'">
                                    <input type="hidden" class="totalstep" value="'.$count.'">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">
                                        <span class="process-per">'.$percentage.'</span>%
                                    </div>
                                </div>
                            </div>
                        </div>';

            if ($orderlist){
                $html .= '<div class="col-md-12">';
                $chk_op = 0;
                foreach ($orderlist as $key => $value) {
                    $checked = ($value->complete_status == 1) ? "checked":"";
                    if ($value->complete_status == 1){
                        $chk_op = $key+1;
                    }
                    $employee_name = get_employee_fullname($value->staff_id);
                    $disable_cls = ($chk_op < $key) ? "disabled": "";
                    $disable_cls = ($value->complete_status == 1) ? "disabled": $disable_cls;
                    $revisedorder =  ($value->parent_id > 0) ? ' <a href="javascript:void(0);" onclick="get_revised_processlist('.$value->parent_id.');" class="btn-sm btn-info"> Revised</a>':'';
                    $html .= '<div class="panel_s"><div class="panel-body"><div class="row">';
                    if ($value->complete_status == 0){
                        $html .= '<div class="col-md-12 "><div class="pull-right"><a class="btn-sm btn-success" href="javascript:void(0);" data-pname="'.$value->process_name.'" onclick="addmodification('.$value->id.');">Modify</a></div><hr></div>';
                    }
                    $html .= '<div class="col-md-8">'.++$key.') '.cc($value->process_name).'</div>';
                    $html .= '<div class="col-md-4"><input type="checkbox" name="trackprocess['.$value->id.']" class="processcheck pull-right" '.$checked.' '.$disable_cls.'></div>';
                    $html .= '<div class="col-md-12"><span class="text-danger">Added By:</span> '.$employee_name.' '.$revisedorder.'</div>';
                    $html .= '<input type="hidden" name="order_type" value="delivery">';
                    $html .= '</div></div></div>';
                }
                $html .= '</div>';
            }
            echo $html;
        }
    }

    /* this function use for set order compilation days */
    public function setOrderCompilationDays(){
        $section = 1;
        if(!empty($_POST)){
            extract($this->input->post());
            
            $compilation_days = (!empty($compilation_days)) ? $compilation_days : "0";
            $section = (!empty($section)) ? $section : "1";
            $ad["compilation_days"] = $compilation_days;
            $this->home_model->update("tblconfirmorder", $ad, array("estimate_id" => $estimate_id, 'id' => $confirm_order_id));
            set_alert('success', "Order compilation days updated successfully");
        }
        redirect(admin_url('estimates/confirm_order_list?section='.$section));
    }
    /* this function use for set order priority */
    public function setOrderPriority(){
        $section = 1;
        if(!empty($_POST)){
            extract($this->input->post());
            
            $priority = (!empty($priority)) ? $priority : "0";
            $section = (!empty($section)) ? $section : "1";
            // $check_order = $this->db->query("SELECT `id`,`priority` FROM tblconfirmorder WHERE `estimate_id`= '".$estimate_id."'")->row();
            $check_order = $this->db->query("SELECT `id`,`priority` FROM tblconfirmorder WHERE `id`= '".$confirm_order_id."'")->row();
            if (!empty($check_order) && $check_order->priority > 0){
                if ($check_order->priority != $priority){
                    
                    $staff_id = array();
                    $staff_str = '';
                    if(!empty($assignid)){
                        foreach ($assignid as $single_staff) {
                            if (strpos($single_staff, 'staff') !== false) {
                                $staff_id[] = str_replace("staff", "", $single_staff);
                            }
                        }
                        $staff_id = array_unique($staff_id);
                        $staff_str = implode(",",$staff_id);
                    }
                    
                    if (!empty($staff_id)){
                        $setprioritydata['requested_priority'] = $priority;
                        $setprioritydata['priority_request_remark'] = $remark;
                        $setprioritydata['priority_request_person'] = $staff_str;
                        $setprioritydata['priority_approve_status'] = 3;
                        $this->home_model->update("tblconfirmorder", $setprioritydata, array("estimate_id" => $estimate_id, "id" => $confirm_order_id));

                        $this->home_model->delete("tblmasterapproval", array('table_id' => $check_order->id, 'module_id' => 54));
                        foreach ($staff_id as $staffid) {

                            //adding on master log
                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 54,
                                'description' => 'Order Priority Change Send to you for Approval',
                                'table_id' => $check_order->id,
                                'approve_status' => 0,
                                'status' => 0,
                                'link' => 'estimates/priority_order_approval/' . $check_order->id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $message = 'Order Priority Change Send to you for Approval';
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }
                    set_alert('success', "Order priority send to approval successfully");
                }
            }else{
                $ad["priority"] = $priority;
                $this->home_model->update("tblconfirmorder", $ad, array("estimate_id" => $estimate_id, "id" => $confirm_order_id));
                set_alert('success', "Order priority updated successfully");
            }
            
        }
        redirect(admin_url('estimates/confirm_order_list?section='.$section));
    }

    /* this function use for get order priority */
    public function getOrderPriority(){
        if(!empty($_GET)){
            extract($this->input->get());

            $check_order = $this->db->query("SELECT * FROM tblconfirmorder WHERE `estimate_id`= '".$estimate_id."'")->row();
            if ($check_order->priority_approve_status == 3){
                echo "<div class='col-md-12'><h5 class='text-danger'> Aleady send for approval with requested priority ".$check_order->requested_priority."</h5></div>";
            }
            echo '<div class="col-md-12">
                        <div class="form-group ">
                        <label for="source" class="control-label"> Priority </label>
                        <input type="number" id="order_priority" name="priority" required="" class="form-control" value="'.$priority.'" aria-invalid="false">
                        </div>
                    </div>';
            if ($priority > 0){
                $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='12'")->result_array();
                $i=0;
                $allStaffdata = array();
                foreach($Staffgroup as $singlestaff)
                {
                    $i++;
                    $allStaffdata[$i]['id']=$singlestaff['id'];
                    $allStaffdata[$i]['name']=$singlestaff['name'];
                    $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' order by s.firstname asc")->result_array();
                    $allStaffdata[$i]['staffs']=$query;
                }
        ?>
                <div class="col-md-12" style="margin-bottom:2%;">
                    <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                    <select onchange="staffdropdown()" required="" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">
                        <?php
                        if (isset($allStaffdata) && count($allStaffdata) > 0) {
                            foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                        ?>
                                <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                    <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                    <?php 
                                        foreach ($Staffgroup_value['staffs'] as $singstaff) { 
                                            $staffid = array();
                                            if (!empty($check_order->priority_request_person)){
                                                $staffid = explode(',', $check_order->priority_request_person);
                                            }
                                    ?>
                                        <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php echo (in_array($singstaff['staffid'], $staffid) && $check_order->priority_approve_status == 3) ? 'selected':''; ?>><?php echo $singstaff['firstname'] ?></option>
                                    <?php } ?>
                                </optgroup>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="source" class="control-label">Remark</label>
                        <textarea class="form-control selectpicker" required="" name="remark" id="remark" rows="5"><?php echo (!empty($check_order->priority_request_remark) && $check_order->priority_approve_status == 3) ? $check_order->priority_request_remark : '';?></textarea>
                    </div>
                </div>
        <?php        
            }
        }
    }

    /* this function use for priority order approval */
    public function priority_order_approval($order_id){

        if(!empty($_POST)){
            extract($this->input->post());
            
            $chk_priority = $this->db->query("SELECT * FROM tblconfirmorder WHERE id = '".$order_id."'")->row();
            $ad_data = array(
                'priority_approval_remark' => $remark,
                'priority_approve_status' => $submit,
                'priority_approval_date' => date('Y-m-d H:i:s')
            );
            $response = $this->home_model->update('tblconfirmorder', $ad_data,array('id'=>$order_id));
            if ($response){

                update_masterapproval_single(get_staff_user_id(),54,$order_id,$submit);
                update_masterapproval_all(54,$order_id,$submit);

                if ($submit == 1){
                    if ($chk_priority->priority > $chk_priority->requested_priority){
                        $get_order_priority = $this->db->query("SELECT `id`,`estimate_id`,`priority` FROM tblconfirmorder WHERE `priority` < '".$chk_priority->priority."' and `priority` >= '".$chk_priority->requested_priority."' ORDER BY priority ASC ")->result();
                        if (!empty($get_order_priority)){
                            foreach ($get_order_priority as $key => $value) {
                                $this->home_model->update("tblconfirmorder", array("priority" => $value->priority+1), array("id" => $value->id));
                            }
                        }
                        $this->home_model->update('tblconfirmorder', array('priority' => $chk_priority->requested_priority),array('id'=>$order_id));
                    
                    }else if ($chk_priority->priority < $chk_priority->requested_priority){
                        $get_order_priority = $this->db->query("SELECT `id`,`priority` FROM tblconfirmorder WHERE `priority` > '".$chk_priority->priority."' and `priority` <= '".$chk_priority->requested_priority."' ORDER BY priority ASC ")->result();
                        if (!empty($get_order_priority)){
                            foreach ($get_order_priority as $key => $value) {
                                $this->home_model->update("tblconfirmorder", array("priority" => $value->priority-1), array("id" => $value->id));
                            }
                        }
                        $this->home_model->update('tblconfirmorder', array('priority' => $chk_priority->requested_priority),array('id'=>$order_id));
                    }
                    set_alert('success', "Order priority approvad successfully");
                }else{
                    set_alert('danger', "Order priority rejected successfully");
                }
                redirect(admin_url('approval/notifications'));
            }
        }    

        $data["title"] = "Order Priority Approval";
        $data["appvoal_info"] = $this->db->query("SELECT * FROM tblmasterapproval WHERE `table_id` = '".$order_id."' AND `status`='1' AND `module_id` = '54'")->row();
        $data["priority_order_info"] = $this->db->query("SELECT e.*, c.complete_status, c.delivery_date, c.order_status_id, c.expected_completed_date, c.compilation_days, c.priority, c.requested_priority, c.priority_request_remark FROM `tblconfirmorder` as c LEFT JOIN `tblestimates` as e  ON e.id = c.estimate_id WHERE c.id = '".$order_id."'")->row();
        $this->load->view('admin/estimates/priority_order_approval', $data);
    }

    /* this function use for proforma chalan agaist to proforma invoice */
    public function proformachalan_list($id){
        $data["title"] = "Proforma Challans";
        $data["proforma_invoice_id"] = $id;
        $data["proformachalan_list"] = $this->db->query("SELECT * FROM tblproformachalan WHERE `rel_id`='".$id."' ORDER BY id DESC ")->result();
        $this->load->view('admin/estimates/proforma_challans', $data);
    }
    /* this function use for generate proforma chalan */
    public function generateproformachalan(){
        if ($this->input->post()) {
            extract($this->input->post());
            
            redirect(admin_url('estimates/proforma_chalan_add?rel_id='.$estimate_id.'&warehouse_id='.$warehouse_id.'&service_type='.$service_type));
        }
    }

    /* this function use for add proforma challan */
    public function proforma_chalan_add($id = '') {

        $this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');

        if ($this->input->post()) {
            extract($this->input->post());
            $proforma_data = $this->input->post();
            // echo '<pre/>';
            // print_r($proforma_data);
            // die;
            $id = $this->Estimates_model->addProformaChalan($proforma_data);
            if ($id) {
                set_alert('success', "Proforma Challan generate successfully");
                redirect(admin_url('estimates/proformachalan_list/' . $proforma_data["rel_id"]));
            }
        }

        $rel_id = 0;
        if (isset($_GET['rel_id'])){
            $rel_id = $_GET['rel_id'];
        }
        $warehouse_id = 0;
        if (isset($_GET['warehouse_id'])){
            $warehouse_id = $_GET['warehouse_id'];
        }
        $service_type = 0;
        if (isset($_GET['service_type'])){
            $service_type = $_GET['service_type'];
        }

        $data['ajaxItems'] = false;
        

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();
        $this->load->model('Leads_model');
        $data['all_source'] = $this->Leads_model->get_source();
        
        $leaddetails = $this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='" . $rel_id . "' ORDER BY cb.`client_branch_name` ASC")->row_array();
        $data['client_branch_name'] = $leaddetails['client_branch_name'];
        // $lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        // $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();
        // $clientsate = array_column($lead_prod_rent_det, 'state');
        // $data['clientsate'] = (!empty($clientsate)) ? $clientsate[0] : '';
        // $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        // $data['lead_prod_sale_det'] = $lead_prod_sale_det;
        $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal' ORDER BY p.name ASC")->result_array();

        $data['title'] = 'Create New Proforma challan';
        $compbranchid = $this->session->userdata('staff_user_id'); //exit;
        // $compnybranch_warehouse = $this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='" . $compbranchid . "'")->row_array();
        // $warehouseid = explode(',', $compnybranch_warehouse['warehouse_id']);
        // foreach ($warehouseid as $singlewarehouseid) {
        //     $warehousedata[] = $this->db->query("SELECT * FROM `tblwarehouse` where id='" . $singlewarehouseid . "'")->row_array();
        // }
        // $data['all_warehouse'] = $warehousedata;
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();

        $this->load->model('estimates_model');
        $data['estimate'] = $this->estimates_model->get($rel_id);

        $data['rel_id'] = $rel_id;
        $data['warehouse'] = value_by_id("tblwarehouse", $warehouse_id, "name");
        if ($service_type == 1) {
            $is_sale = 0;
            $servicetype = 'Challan For Rent';
        } else {
            $is_sale = 1;
            $servicetype = 'Challan For Sale';
        }

        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['warehouse_id'] = $warehouse_id;
        $data['service_type'] = $service_type;
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        $this->db->where('rel_id', $rel_id);
        $this->db->where('is_sale', $is_sale);
        $this->db->where('rel_type', 'estimate');
        $data['productdata'] = $this->db->get('tblitems_in')->result_array();
        $data['servicetype'] = $servicetype;
        
        $data['rely_type'] = 'estimate';
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`sub_name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC ")->result_array();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result_array();
        $this->load->view('admin/estimates/generate_proforma_chalan', $data);
    }

    /* this function use for proformachallan download pdf*/
    public function proformachallan_download_pdf($id){
        require_once APPPATH.'third_party/pdfcrowd.php';

        $proformachallan_info = $this->db->query("SELECT * FROM tblproformachalan WHERE id = '".$id."'")->row();
        $proformachallan_number = "PC-".sprintf("%'.05d\n", $id);

        $file_name = $proformachallan_number;

        $html = proformachallan_pdf($proformachallan_info);
        // echo $html;
        // exit;
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        /* WATER MARK ADD CODE START */
            // Instantiate canvas instance 
            $canvas = $dompdf->getCanvas(); 

            // Get height and width of page 
            $w = $canvas->get_width(); 
            $h = $canvas->get_height(); 
            
            // Specify watermark image 
            $imageURL = 'assets/images/proforma-challan-img.png'; 
            // $imageURL = 'assets/images/PC-img.png'; 
            $imgWidth = 500; 
            $imgHeight = 250; 
            
            // Set image opacity 
            $canvas->set_opacity(.2); 
            
            // Specify horizontal and vertical position 
            $x = (($w-$imgWidth)/2); 
            $y = (($h-$imgHeight)/2); 
            
            // Add an image to the pdf 
            $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight); 
        /* WATER MARK ADD CODE END */


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

        $dompdf->stream($file_name, array("Attachment" => false));
    }

    public function edit_proformachallan($id = '') {
        $this->load->model('Estimates_model');

        $data['challan_info'] = $this->db->query("SELECT * FROM tblproformachalan WHERE id = '".$id."' ")->row();

        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            $response = $this->Estimates_model->editProformaChallan($id, $proposal_data);
            if ($response){
                set_alert('success', "Proforma Challan update successfully");
                redirect(admin_url('estimates/proformachalan_list/' . $data['challan_info']->rel_id));
            }
        }
        
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['components_info'] = $this->db->query("SELECT * FROM tblproformachalandetails WHERE proformachalan_id = '".$id."' and type = '2' ")->result_array();
        $data['product_info'] = $this->db->query("SELECT * FROM tblproformachalandetails WHERE proformachalan_id = '".$id."' and type = '1' ")->result_array();
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`sub_name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 ORDER BY name ASC ")->result_array();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result_array();
        $data['title'] = 'Edit Proforma Challan';
        $this->load->view('admin/estimates/edit_proforma_challan', $data);
    }

    /* this function use for delete proforma challan */
    public function delete_proformachallan($id){
        $chalandata = $this->db->query("SELECT * FROM tblproformachalan WHERE id = '".$id."' ")->row();
        if (!empty($chalandata)){
            $response = $this->home_model->delete("tblproformachalan", array("id" => $id));
            if ($response){
                $this->home_model->delete("tblproformachalandetails", array("proformachalan_id" => $id));
                set_alert('success', "Proforma Challan delete successfully");
            }else{
                set_alert('delete', "Something went wrong");
            }
        }
        redirect(admin_url('estimates/proformachalan_list/' . $chalandata->rel_id));
    }

    /* this function use for get approval info of proforma challan */
    public function get_approval_info() {

    	if(!empty($_POST)){
        extract($this->input->post());
        $assign_info = $this->db->query("SELECT * FROM tblproformachalanapproval WHERE proformachallan_id = '".$rid."'  ")->result();
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
                                        <td><?php echo ($value->approvereason != '') ?  $value->approvereason : '--';  ?></td>
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

    /* this function use for proforma chalan approval */
    public function proforma_chalan_approval($proformchallan_id){
        $approval_info = $this->db->query("SELECT * FROM tblproformachalanapproval WHERE `proformachallan_id`= '".$proformchallan_id."' AND `approve_status` = '0' ")->row();
        if (empty($approval_info)){
            set_alert('warning', "Proforma Chalan approved successfully");
            redirect(admin_url('approval/notifications'));
        }

        if(!empty($_POST)){
            extract($this->input->post());
            
            $ad_data = array(
                'approvereason' => $remark,
                'approve_status' => $submit,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $response = $this->home_model->update('tblproformachalanapproval', $ad_data,array('proformachallan_id'=> $proformchallan_id, 'staff_id' => get_staff_user_id()));
            if ($response){

                update_masterapproval_single(get_staff_user_id(),55,$proformchallan_id,$submit);
                update_masterapproval_all(55,$proformchallan_id,$submit);

                if ($submit == 1){

                    /* THIS CODE USE FOR GENERATE CONFIRM ORDER ON PRODUCTION */
                        $estimate_id = value_by_id("tblproformachalan", $proformchallan_id, "rel_id");
                        $billing_branch_id = value_by_id("tblproformachalan", $proformchallan_id, "billing_branch_id");

                        $chk_confirmorder = $this->db->query("SELECT count(*) as ttlcount FROM `tblconfirmorder` WHERE `estimate_id`= '".$estimate_id."' ")->row();
                        if ($chk_confirmorder->ttlcount > 0){
                            $confirmorder = $this->db->query("SELECT * FROM `tblconfirmorder` WHERE `estimate_id`= '".$estimate_id."' AND `proformachallan_id`='0' ")->row();
                            if (!empty($confirmorder)){
                                /* this is for update proforma challan id on existing confirm order */
                                $upOrderData['proformachallan_id'] = $proformchallan_id;
                                $upOrderData['updated_at'] = date("Y-m-d H:i:s");
                                $this->home_model->update('tblconfirmorder', $upOrderData, array('id' => $confirmorder->id));

                                /* this is for update proforma challan id in existing confirm order process */
                                $this->home_model->update('tblconfirmorderprocess', array('confirm_order_id' => $confirmorder->id), array('estimate_id' => $estimate_id));
                            }else{
                                /* store new confirm order against to proforma challan */
                                $lastconfirmorder = $this->db->query("SELECT * FROM `tblconfirmorder` WHERE `estimate_id`= '".$estimate_id."' AND `proformachallan_id`!='0' ORDER BY id DESC ")->row();
                                if (!empty($lastconfirmorder)){

                                    $addOrderData["estimate_id"] = $estimate_id;
                                    $addOrderData["proformachallan_id"] = $proformchallan_id;
                                    $addOrderData["delivery_date"] = $lastconfirmorder->delivery_date;
                                    $addOrderData["staff_id"] = get_staff_user_id();
                                    $addOrderData["branch_id"] = $billing_branch_id;
                                    $addOrderData["created_at"] = date("Y-m-d H:i:s");
                                    $addOrderData["updated_at"] = date("Y-m-d H:i:s");
                                    $insert_id = $this->home_model->insert("tblconfirmorder", $addOrderData);

                                    $orderprocesslist = $this->db->query("SELECT * FROM `tblconfirmorderprocess` WHERE `confirm_order_id`= ".$lastconfirmorder->id." AND `estimate_id`= '".$estimate_id."' ")->result();
                                    if (!empty($orderprocesslist)){
                                        foreach ($orderprocesslist as $processdata) {
                                            $insertProcessData["confirm_order_id"] = $insert_id; 
                                            $insertProcessData["estimate_id"] = $estimate_id;
                                            $insertProcessData["type"] = $processdata->type;
                                            $insertProcessData["process_name"] = $processdata->process_name;
                                            $insertProcessData["staff_id"] = get_staff_user_id();
                                            $this->home_model->insert("tblconfirmorderprocess", $insertProcessData);
                                        }
                                    }
                                }

                                
                            }
                            
                        }

                    /* THIS CODE USE FOR GENERATE CONFIRM ORDER ON PRODUCTION */

                    set_alert('success', "Proforma Challan approvad successfully");
                }else{
                    set_alert('danger', "Proforma Challan rejected successfully");
                }
                $this->home_model->update('tblproformachalan', array("approve_status" => $submit),array('id'=>$proformchallan_id));
                redirect(admin_url('approval/notifications'));
            }
        }    

        $data["title"] = "Proforma Chalan Approval";
        $data["appvoal_info"] = $this->db->query("SELECT * FROM tblmasterapproval WHERE `table_id` = '".$proformchallan_id."' AND `status`='1' AND `module_id` = '55'")->row();
        $data["proformachallan_info"] = $this->db->query("SELECT * FROM tblproformachalan WHERE `id`= '".$proformchallan_id."' AND `approve_status` = '0' ")->row();
        $data["proformachallan_details"] = $this->db->query("SELECT * FROM tblproformachalandetails WHERE `proformachalan_id`= '".$proformchallan_id."' ")->result();
        $this->load->view('admin/estimates/proforma_chalan_approval', $data);
    }

    /* this function use for convert to delivery challan */
    public function convert_delivery_challan($proformachallan_id){
        $this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');

        if ($this->input->post()) {
            extract($this->input->post());
            $proposal_data = $this->input->post();

            /* echo '<pre/>';
            print_r($proposal_data);
            die; */

            $id = $this->Estimates_model->addchalan($proposal_data);
            if ($id) {

                set_alert('success', _l('added_successfully', _l('challan')));
                redirect(admin_url('chalan/created'));
            }
        }

        $rel_id = $proformachallan_id;
        // if (isset($_GET['rel_id'])){
        //     $rel_id = $_GET['rel_id'];
        // }
        $warehouse_id = 0;
        if (isset($_GET['warehouse_id'])){
            $warehouse_id = $_GET['warehouse_id'];
        }
        $service_type = 0;
        if (isset($_GET['service_type'])){
            $service_type = $_GET['service_type'];
        }

        $data['ajaxItems'] = false;
        

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();
        $this->load->model('Leads_model');
        $data['all_source'] = $this->Leads_model->get_source();
        
        $leaddetails = $this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='" . $rel_id . "' ORDER BY cb.`client_branch_name` ASC")->row_array();
        $data['client_branch_name'] = $leaddetails['client_branch_name'];
        // $lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        // $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();
        // $clientsate = array_column($lead_prod_rent_det, 'state');
        // $data['clientsate'] = (!empty($clientsate)) ? $clientsate[0] : '';
        // $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        // $data['lead_prod_sale_det'] = $lead_prod_sale_det;
        $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal' ORDER BY p.name ASC")->result_array();

        $data['title'] = 'Create New Delivery Challan';
        $compbranchid = $this->session->userdata('staff_user_id'); //exit;
        // $compnybranch_warehouse = $this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='" . $compbranchid . "'")->row_array();
        // $warehouseid = explode(',', $compnybranch_warehouse['warehouse_id']);
        // foreach ($warehouseid as $singlewarehouseid) {
        //     $warehousedata[] = $this->db->query("SELECT * FROM `tblwarehouse` where id='" . $singlewarehouseid . "'")->row_array();
        // }
        // $data['all_warehouse'] = $warehousedata;
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();

        // $this->load->model('estimates_model');
        // $data['estimate'] = $this->estimates_model->get($rel_id);

        $data['proformachallan_info'] = $this->db->query("SELECT * FROM `tblproformachalan` WHERE `id`='".$proformachallan_id."' ")->row();    
        $data['rel_id'] = $rel_id;
        $data['warehouse'] = value_by_id("tblwarehouse", $warehouse_id, "name");
        if ($service_type == 1) {
            $is_sale = 0;
            $servicetype = 'Challan For Rent';
        } else {
            $is_sale = 1;
            $servicetype = 'Challan For Sale';
        }

        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['warehouse_id'] = $warehouse_id;
        $data['service_type'] = $service_type;
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->db->where('proformachalan_id', $proformachallan_id);
        $this->db->where('type', '1');
        $data['productdata'] = $this->db->get('tblproformachalandetails')->result_array();
        
        $this->db->where('proformachalan_id', $proformachallan_id);
        $this->db->where('type', '2');
        $data['componentdata'] = $this->db->get('tblproformachalandetails')->result_array();

        $data['servicetype'] = $servicetype;
        
        $data['rely_type'] = 'proforma_challan';
        $data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE `active`='1' AND `client_branch_name` != '' ORDER BY client_branch_name ASC")->result_array();
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC ")->result_array();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result_array();
        $this->load->view('admin/estimates/convert_delivery_chalan', $data);
    }

    /* this function use for manually update confirm order id on confirm order process table */
    public function manually_update_order_id(){
        $confirmorderlist = $this->db->query("SELECT * FROM `tblconfirmorder` WHERE `proformachallan_id` = '0' ")->result();
        if (!empty($confirmorderlist)){
            foreach ($confirmorderlist as $value) {
                $this->home_model->update("tblconfirmorderprocess", array("confirm_order_id"=> $value->id),array("estimate_id" => $value->estimate_id));
            }
        }
        echo "Done";
    }

    /* this function use for manually update client id in production plan */
    public function update_production_plan_client_id(){
        $productionplanlist = $this->db->query("SELECT * FROM `tblchalanproductionplan` WHERE `clientid` = '0' ")->result();
        if (!empty($productionplanlist)){
            foreach ($productionplanlist as $value) {
                $client_id = 0;
                if ($value->ref_type == '2'){
                    $client_id = value_by_id("tblproformachalan", $value->chalan_id, "clientid");
                }else{
                    $client_id = value_by_id("tblchalanmst", $value->chalan_id, "clientid");
                }
                $this->home_model->update("tblchalanproductionplan", array("clientid"=> $client_id),array("id" => $value->id));
            }
        }
        echo "Done";
    }

    /* THIS FUNCTION USE FOR GET UPLOADED DATA OF ESTIMATE PURCHASE ORDER */
    public function get_estimate_po_files(){
        if(!empty($_POST)){
            extract($this->input->post());

            $file_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_type = 'estimate_po' AND rel_id = '".$id."' ORDER BY id DESC")->result();

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
                            <td><a target="_blank" href="<?php echo base_url('uploads/estimates/purchase_order/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></td>
                            <td><?php echo _d($file->dateadded); ?></td>
                            <td>
                                <a href="<?php echo admin_url('estimates/delete_estimate_po_file/'.$file->id);?>" style="color:red;" class="text-danger _delete"><i class="fa fa-trash"></i></a>
                            </td>    
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
    /* THIS FUNCTION USE FOR UPLOAD PURCHASE ORDER AGAINST TO ESTIMATE */
    public function estimate_po_upload() {
        if(!empty($_POST)){
            extract($this->input->post());

            handle_multi_attachments($estimate_id,'estimate_po');

            set_alert('success', 'File Uploaded successfully');
            redirect(admin_url('estimates/list'));
        }

    }

    public function delete_estimate_po_file($file_id){
        $files_info = $this->db->query("SELECT * FROM tblfiles WHERE `rel_type`='estimate_po' AND `id`=".$file_id." ")->row();
        if (!empty($files_info)){
            $path = get_upload_path_by_type('estimate_po') . $files_info->rel_id . '/'.$files_info->file_name;
            unlink($path);
            $this->home_model->delete('tblfiles',array("id" => $file_id));
            set_alert('success', 'File remove successfully');
        }
        redirect(admin_url('estimates/list'));
    }

    public function po_verification($estimate_id){
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($estimatedata)){
                foreach ($estimatedata as $key => $value) {
                    $itemdata_up["check_status"] = $value['check_status'];
                    if (!empty($value['remark'])){
                        $itemdata_up["not_ok_remark"] = $value['remark'];
                    }else{
                        $itemdata_up["not_ok_remark"] = '';
                    }
                    $this->home_model->update("tblitems_in", $itemdata_up, array("id" => $value['item_id']));
                }
            }
            $varificationdata["t_c_check_status"] = $check_status;
            $varificationdata["final_check_status"] = $final_check_status;
            $varificationdata["t_c_notok_remark"] = '';
            if (!empty($t_c_notok_remark)){
                $varificationdata["t_c_notok_remark"] = $t_c_notok_remark;
            }
            $varificationdata["final_notok_remark"] = '';
            if (!empty($final_notok_remark)){
                $varificationdata["final_notok_remark"] = $final_notok_remark;
            }
            $this->home_model->update("tblestimates", $varificationdata, array("id" => $estimate_id));

            set_alert('success', 'Purchase Verification Successfully');
            redirect(admin_url('estimates/list'));
        }    
        $data["title"] = "Purchase Order Verification";
        $data["estimate_info"] = $this->estimates_model->get($estimate_id);
        $this->load->view('admin/estimates/po_verification', $data);
    }
}
