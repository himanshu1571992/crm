<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Proposals extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');
        $this->load->model('home_model');
    }

    public function proposal_export()
    {

        $data['quote_list'] = $this->db->query("SELECT p.number,p.proposal_to,l.client_person_name,p.email,p.phone,p.total,p.product_type,c.name as city,p.rel_id  FROM `tblproposals` as p LEFT JOIN tblleads as l ON p.rel_id = l.id LEFT JOIN tblcities as c ON p.city = c.id  WHERE p.year_id = 7")->result();
        $data['title'] = 'Proposal List';
        $this->load->view('admin/proposals/proposal_export', $data);

    }

    public function update_service_type()
    {
        $p_id = array();
        $quotation_info = $this->db->query("SELECT id from `tblproposals`  ")->result();
        if(!empty($quotation_info)){
            foreach ($quotation_info as $key => $value) {

               $check_proposal_rent_item = check_proposal_item($value->id,0,'proposal');
               $check_proposal_sale_item = check_proposal_item($value->id,1,'proposal');

                $service_type = 1;
                if($check_proposal_rent_item>=1){
                    $service_type = 1;
                }elseif($check_proposal_sale_item>=1){
                    $service_type = 2;
                }
                $number = format_proposal_number($value->id);
               $this->home_model->update('tblproposals', array('service_type'=>$service_type,'number'=>$number),array('id'=>$value->id));
            }
        }

    }

    public function index($proposal_id = '') {
        check_permission(5,'view');
        $this->list_proposals($proposal_id);
    }

    public function list_proposals($proposal_id = '') {
        close_setup_menu();

        /*if (!has_permission('proposals', '', 'view') && !has_permission('proposals', '', 'view_own') && get_option('allow_staff_view_proposals_assigned') == 0) {
            access_denied('proposals');
        }*/

        $isPipeline = $this->session->userdata('proposals_pipeline') == 'true';

        if ($isPipeline && !$this->input->get('status')) {
            $data['title'] = _l('proposals_pipeline');
            $data['bodyclass'] = 'proposals-pipeline';
            $data['switch_pipeline'] = false;
            // Direct access
            if (is_numeric($proposal_id)) {
                $data['proposalid'] = $proposal_id;
            } else {
                $data['proposalid'] = $this->session->flashdata('proposalid');
            }

            $this->load->view('admin/proposals/pipeline/manage', $data);
        } else {

            // Pipeline was initiated but user click from home page and need to show table only to filter
            if ($this->input->get('status') && $isPipeline) {
                $this->pipeline(0, true);
            }

            $data['proposal_id'] = $proposal_id;
            $data['switch_pipeline'] = true;
            $data['title'] = _l('proposals');
            $data['statuses'] = $this->proposals_model->get_statuses();
            $data['proposals_sale_agents'] = $this->proposals_model->get_sale_agents();
            $data['years'] = $this->proposals_model->get_proposals_years();
            $this->load->view('admin/proposals/manage', $data);
        }
    }

    /*public function list()
    {
        check_permission(5,'view');


        $where = "year_id = '".financial_year()."'";

        $where_amt_desc = '0';

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('proposal_where');
                $this->session->unset_userdata('proposal_search');
                $this->session->unset_userdata('proposal_where_amt_desc');
            }else{
                if(!empty($source) || !empty($f_date) || !empty($t_date) || !empty($customer_company) || !empty($quotation_no) || !empty($amt_desc)){
                    $this->session->unset_userdata('proposal_where');
                    $this->session->unset_userdata('proposal_search');
                    $this->session->unset_userdata('proposal_where_amt_desc');
                    $sreach_arr = array();

                    if(!empty($source)){
                        $sreach_arr['source'] = $source;
                        $where .= " and source = '".$source."'";
                    }

                    if(!empty($customer_company)){
                        $sreach_arr['customer_company'] = $customer_company;
                        $where .= " and proposal_to LIKE '%".$customer_company."%'";
                    }

                    if(!empty($quotation_no)){
                        $sreach_arr['quotation_no'] = $quotation_no;
                        $where .= " and (number LIKE '%".$quotation_no."%')";
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

                    $this->session->set_userdata('proposal_where',$where);
                    $this->session->set_userdata('proposal_search',$sreach_arr);
                    $this->session->set_userdata('proposal_where_amt_desc',$where_amt_desc);

                }

            }
        }else{
            if(!empty($this->session->userdata('proposal_where'))){
                $where = $this->session->userdata('proposal_where');
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 25;

        // Get record count
        $totalRec = $this->proposals_model->get_proposal_count($where);

        // Pagination configuration
        $config['base_url']    = admin_url().'proposals/list/';
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
        $data['proposal_list'] = $this->proposals_model->get_proposal($where,$offset,$perPage);



        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ")->result();

        $data['title'] = 'Proposal List';
        $this->load->view('admin/proposals/list', $data);

    }*/


    /*public function list()
    {
        check_permission(5,'view');

        if(is_admin() == 1){
            $where = "id > 0 ";
        }else{
            $where = "addedfrom = '".get_staff_user_id()."' ";
        }

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($source) || !empty($f_date) || !empty($t_date) || !empty($customer_company) || !empty($quotation_no) || !empty($amt_desc)){

                    if(!empty($source)){
                        $data['source'] = $source;
                        $where .= " and FIND_IN_SET('".$source."', source) ";
                    }

                    if(!empty($customer_company)){
                        $sreach_arr['customer_company'] = $customer_company;
                        $where .= " and proposal_to LIKE '%".$customer_company."%'";
                    }

                    if(!empty($quotation_no)){
                        $data['quotation_no'] = $quotation_no;
                        $where .= " and (number LIKE '%".$quotation_no."%')";
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
        $data['proposal_list'] = $this->db->query("SELECT * from `tblproposals` where ".$where." order by id desc ")->result();
        $data['proposal_amount'] = $this->db->query("SELECT SUM(total) as ttl_amt from `tblproposals` where ".$where." ")->row()->ttl_amt;
        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ")->result();

        $data['title'] = 'Proposal List';
        $this->load->view('admin/proposals/list', $data);

    }*/


    public function list()
    {
        check_permission(5,'view');

        if(is_admin() == 1){
            $where = "t1.id > 0 ";
        }else{
            $where = "t1.addedfrom = '".get_staff_user_id()."' ";
            $where .= "|| t2.staff_id = '".get_staff_user_id()."' ";

        }

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
            if(!empty($source) || !empty($f_date) || !empty($t_date) || !empty($customer_company) || !empty($quotation_no) || !empty($amt_desc)){

                    if(!empty($source)){
                        $where .= " and FIND_IN_SET('".$source."', t1.source) ";
                        $data['source'] = $source;

                    }

                    if(!empty($customer_company)){
                        $where .= " and t1.proposal_to LIKE '%".$customer_company."%'";
                        $sreach_arr['customer_company'] = $customer_company;

                    }

                    if(!empty($quotation_no)){
                        $where .= " and (t1.number LIKE '%".$quotation_no."%')";
                        $data['quotation_no'] = $quotation_no;

                    }

                    if(!empty($f_date) && !empty($t_date)){
                        $data['f_date'] = $f_date;
                        $data['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and t1.date between '".$f_date."' and '".$t_date."' ";
                    }

            }
        }else{
            $where .= " and t1.year_id = '".financial_year()."'";

        }
        // Get records
        if(is_admin() == 1){
            $data['proposal_list'] = $this->db->query("SELECT * from `tblproposals` as t1 where ".$where." order by t1.id desc ")->result();
            $data['proposal_amount'] = $this->db->query("SELECT SUM(t1.total) as ttl_amt from `tblproposals` as t1 where ".$where." ")->row()->ttl_amt;
            $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ORDER BY name ASC ")->result();
        }

        else
        {
        $data['proposal_list'] = $this->db->query("SELECT t1.* from tblproposals as t1 JOIN tblproposalassignstaff  as t2 ON t1.id = t2.lead_id where ".$where." group by t1.id  ORDER by t1.id desc")->result();
        $data['proposal_amount'] = $this->db->query("SELECT  SUM(t1.total) as ttl_amt FROM tblproposals as t1 JOIN tblproposalassignstaff as t2 ON t1.id = t2.lead_id where ".$where." ")->row()->ttl_amt;
        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ORDER BY name ASC ")->result();
        }

        $data['title'] = 'Proposal List (SEPL/SLS/03)';
        $this->load->view('admin/proposals/list', $data);

    }

    public function table() {
        /*if (!has_permission('proposals', '', 'view') && !has_permission('proposals', '', 'view_own') && get_option('allow_staff_view_proposals_assigned') == 0) {
            ajax_access_denied();
        }*/

        $this->app->get_table_data('proposals');
    }

    public function proposal_relations($rel_id, $rel_type) {
        $this->app->get_table_data('proposals_relations', [
            'rel_id' => $rel_id,
            'rel_type' => $rel_type,
        ]);
    }

    public function delete_attachment($id) {
        $file = $this->misc_model->get_file($id);
        if ($file->staffid == get_staff_user_id() || is_admin()) {
            echo $this->proposals_model->delete_attachment($id);
        } else {
            ajax_access_denied();
        }
    }

    public function clear_signature($id) {
        if (has_permission('proposals', '', 'delete')) {
            $this->proposals_model->clear_signature($id);
        }

        redirect(admin_url('proposals/list_proposals/' . $id));
    }

    public function sync_data() {
        if (has_permission('proposals', '', 'create') || has_permission('proposals', '', 'edit')) {
            $has_permission_view = has_permission('proposals', '', 'view');

            $this->db->where('rel_id', $this->input->post('rel_id'));
            $this->db->where('rel_type', $this->input->post('rel_type'));

            if (!$has_permission_view) {
                $this->db->where('addedfrom', get_staff_user_id());
            }

            $address = trim($this->input->post('address'));
            $address = nl2br($address);
            $this->db->update('tblproposals', [
                'phone' => $this->input->post('phone'),
                'zip' => $this->input->post('zip'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'address' => $address,
                'city' => $this->input->post('city'),
            ]);

            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'message' => _l('all_data_synced_successfully'),
                ]);
            } else {
                echo json_encode([
                    'message' => _l('sync_proposals_up_to_date'),
                ]);
            }
        }
    }

    public function proposals($id = '') {
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            if ($id == '') {
                /*if (!has_permission('proposals', '', 'create')) {
                    access_denied('proposals');
                }*/
                $id = $this->proposals_model->add($proposal_data);
                if ($id) {

                    set_alert('success', _l('added_successfully', _l('proposal')));
                    if ($this->set_proposal_pipeline_autoload($id)) {
                        redirect(admin_url('proposals'));
                    } else {
                        redirect(admin_url('proposals/list_proposals/' . $id));
                    }
                }
            } else {
                /*if (!has_permission('proposals', '', 'edit')) {
                    access_denied('proposals');
                }*/
                $success = $this->proposals_model->update($proposal_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('proposal')));
                }
                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('proposals'));
                } else {
                    redirect(admin_url('proposals/list_proposals/' . $id));
                }
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('proposal_lowercase'));
        } else {
            $data['proposal'] = $this->proposals_model->get($id);

            if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }

            $data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
        }
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');
        $data['ajaxItems'] = false;
        if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items'] = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();
        $data['statuses'] = $this->proposals_model->get_statuses();
        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        $data['currencies'] = $this->currencies_model->get();
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $data['title'] = $title;
        $this->load->view('admin/proposals/proposal', $data);
    }

    public function proposal($id = '') {

		check_permission(5,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            $termsconditiondata = $proposal_data["terms"];
            unset($proposal_data["terms"]);

             /*echo '<pre>';
            print_r($proposal_data);
            die;*/ 
            if ($id == '') {

                $id = $this->proposals_model->add($proposal_data);
                if ($id) {
                    //Updating Final Amt
                    update_proposal_final_amount($id);

                    //Updating service type
                    $check_proposal_rent_item = check_proposal_item($id,0,'proposal');
                    $check_proposal_sale_item = check_proposal_item($id,1,'proposal');

                    $service_type = 1;
                    if($check_proposal_rent_item>=1){
                        $service_type = 1;
                    }elseif($check_proposal_sale_item>=1){
                        $service_type = 2;
                    }
                    $this->home_model->update('tblproposals', array('service_type'=>$service_type),array('id'=>$id));


                    //Update Lead Status
                    if(!empty($proposal_data['rel_id'])){
                        $this->home_model->update('tblleads', array('process_id'=>2),array('id'=>$proposal_data['rel_id']));
                    }
                    /* this is use for add custom terms and condition */
                    $this->proposals_model->addCustomTermsAndCondition($id, "proposal", $termsconditiondata, 'tblproposals');

                    set_alert('success', _l('added_successfully', _l('proposal')));
                    if ($this->set_proposal_pipeline_autoload($id)) {
                       redirect(admin_url('proposals/list/'));
                    } else {
                        redirect(admin_url('proposals/list/'));
                    }
                }
            } else {
                /* this is use for add custom terms and condition */
                $this->proposals_model->addCustomTermsAndCondition($id, "proposal", $termsconditiondata, 'tblproposals');

                check_permission(5,'edit');
                $success = $this->proposals_model->update($proposal_data, $id);
                if ($success) {
                    //Updating Final Amt
                    update_proposal_final_amount($id);

                    //Updating service type
                    $check_proposal_rent_item = check_proposal_item($id,0,'proposal');
                    $check_proposal_sale_item = check_proposal_item($id,1,'proposal');

                    $service_type = 1;
                    if($check_proposal_rent_item>=1){
                        $service_type = 1;
                    }elseif($check_proposal_sale_item>=1){
                        $service_type = 2;
                    }
                    $this->home_model->update('tblproposals', array('service_type'=>$service_type),array('id'=>$id));

                    set_alert('success', _l('updated_successfully', _l('proposal')));
                }

                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('proposals'));
                } else {
                    //redirect(admin_url('proposals#' . $id));
                    redirect(admin_url('proposals/list/'));
                }
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('proposal_lowercase'));
        } else {
            $data['proposal'] = $this->proposals_model->get($id);

            /*$this->db->where('rel_id', $id);
            $this->db->where('is_sale', '0');
            $this->db->where('rel_type', 'proposal');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();*/
            $rentalprolist = $this->db->query("SELECT * FROM `tblitems_in` where is_sale = '0' and rel_type = 'proposal' and rel_id = '".$id."' order by id asc ")->result_array();

            /*$this->db->where('rel_id', $id);
            $this->db->where('is_sale', '1');
            $this->db->where('rel_type', 'proposal');
            $saleprolist = $this->db->get('tblitems_in')->result_array();*/
            $saleprolist = $this->db->query("SELECT * FROM `tblitems_in` where is_sale = '1' and rel_type = 'proposal' and rel_id = '".$id."' order by id asc ")->result_array();

			/*$this->db->where('proposalid', $id);
            $this->db->where('is_sale', '0');
            $otherchargesforrent = $this->db->get('tblproposalothercharges')->result_array();  */

            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblproposalproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'field_id');

            /*$this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblproposalothercharges')->result_array();*/

            $data['sale_othercharges'] = $this->db->query("SELECT * FROM `tblproposalothercharges` where is_sale = 1 and category_name > 0 and proposalid = '".$id."' order by id asc ")->result_array();
            $data['rent_othercharges'] = $this->db->query("SELECT * FROM `tblproposalothercharges` where is_sale = 0 and category_name > 0 and proposalid = '".$id."' order by id asc ")->result_array();
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;
            /*if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }*/

            $data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
			$this->db->where('lead_id', $id);
			$staffassigndata= $this->db->get('tblproposalassignstaff')->result_array();
			$staffassigndata=array_column($staffassigndata,'staff_id');
			$data['staffassigndata']=$staffassigndata;
        }
		$default_settings=$this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id WHERE dsc.id=1")->result_array();
		$data['default_setting_field']=array_column($default_settings,'default_setting_field');
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
       // $leaddetails=$this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='".$_GET['rel_id']."'")->row_array();

        if(!empty($data['proposal'])){
            $rel_id = $data['proposal']->rel_id;
        }else{
            $rel_id = $_GET['rel_id'];
        }

        //$leaddetails=$this->db->query("SELECT cb.`company`,cb.`userid` FROM `tblleads` l LEFT JOIN `tblclients` cb ON l.`client_id`=cb.userid WHERE l.`id`='".$rel_id."'")->row_array();
        $leaddetails=$this->db->query("SELECT cb.`client_branch_name`,cb.`userid` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_branch_id`=cb.userid WHERE l.`id`='".$rel_id."' ORDER BY cb.`client_branch_name` ASC")->row_array();

        if(!empty($leaddetails['client_branch_name'])){
            $data['client_branch_name'] = $leaddetails['client_branch_name'];
            $data['client_id'] = $leaddetails['userid'];

        }else{
            $lead_info=$this->db->query("SELECT * FROM `tblleads` where `id`='".$rel_id."'")->row();
            $data['client_branch_name'] = $lead_info->company;
            $data['client_id'] = 0;

        }
				/*$lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();*/

        $lead_prod_rent_det = $this->db->query("SELECT p.*,pe.product_remarks,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.id='1' OR ef.id='3') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,pe.product_remarks,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.id='2' OR ef.id='3')")->result_array();

        $lead_prod_rent_det = $this->db->query("SELECT * FROM `tblproductinquiry` WHERE enquiry_id ='" . $rel_id . "' AND (enquiry_for_id='1' OR enquiry_for_id='3') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT * FROM `tblproductinquiry` WHERE enquiry_id ='" . $rel_id . "' AND (enquiry_for_id='2' OR enquiry_for_id='3') ")->result_array();

        $leads_info = $this->db->query("SELECT * FROM `tblleads` WHERE id ='" . $rel_id . "' ")->result_array();

        $clientsate = array_column($leads_info, 'state');
        $data['clientsate'] = $clientsate[0];
        $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        $data['lead_prod_sale_det'] = $lead_prod_sale_det;
//		$data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1")->result_array();
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 ORDER BY product_name ASC ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=>cc($r['sub_name']),'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>cc($r1['product_name']),'is_temp'=>1);
            }
        }
        $this->load->model('Staffgroup_model');
    		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
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
    		$data['title'] = $title;
    		$compbranchid=$this->session->userdata('staff_user_id');//exit;
    		$compnybranch_warehouse=$this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='".$compbranchid."' ORDER BY comp_branch_name ASC")->row_array();
    		$warehouseid=explode(',',$compnybranch_warehouse['warehouse_id']);
    		foreach($warehouseid as $singlewarehouseid)
    		{
    			$warehousedata[]=$this->db->query("SELECT * FROM `tblwarehouse` where id='".$singlewarehouseid."'")->row_array();
    		}
    		$data['all_warehouse'] = $warehousedata;
    		$this->load->model('Enquiryfor_model');
        //$data['service_type'] = $this->Enquiryfor_model->get();

        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result_array();
        $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by field_for desc")->result();
        $data['service_type'] = get_service_type();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
       $this->load->view('admin/proposals/proposals', $data);
    }

    public function revice_quotation($id = '') {

        check_permission(5,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            $termsconditiondata = $proposal_data["terms"];
            unset($proposal_data["terms"]);
            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/
            $id = $this->proposals_model->add($proposal_data);

            if ($id) {
                //Updating Final Amt
                update_proposal_final_amount($id);

                //Updating service type
                $check_proposal_rent_item = check_proposal_item($id,0,'proposal');
                $check_proposal_sale_item = check_proposal_item($id,1,'proposal');

                $service_type = 1;
                if($check_proposal_rent_item>=1){
                    $service_type = 1;
                }elseif($check_proposal_sale_item>=1){
                    $service_type = 2;
                }
                $this->home_model->update('tblproposals', array('service_type'=>$service_type,'proposal_number'=>0),array('id'=>$id));

                //Update Lead Status
                if(!empty($proposal_data['rel_id'])){
                    $this->home_model->update('tblleads', array('process_id'=>3),array('id'=>$proposal_data['rel_id']));
                }

                if (!empty($proposal_data['revice_id'])){
                    $this->home_model->update('tblestimates', array('status'=>7, 'cancel_remark' => "PI Cancelled by system due to quote revise"),array('proposal_id'=>$proposal_data['revice_id']));
                }
                /* this is use for add custom terms and condition */
                $this->proposals_model->addCustomTermsAndCondition($id, "proposal", $termsconditiondata, 'tblproposals');

                set_alert('success', _l('added_successfully', _l('proposal')));
                redirect(admin_url('proposals/list/'));
                /*if ($this->set_proposal_pipeline_autoload($id)) {
                   redirect(admin_url('proposals/index/'. $id));
                } else {
                    redirect(admin_url('proposals/index/'. $id));
                }*/
            }
        }
        $data['proposal'] = $this->proposals_model->get($id);

        $this->db->where('rel_id', $id);
        $this->db->where('is_sale', '0');
        $this->db->where('rel_type', 'proposal');
        $this->db->order_by('id', 'ASC');
        $rentalprolist = $this->db->get('tblitems_in')->result_array();

        $this->db->where('rel_id', $id);
        $this->db->where('is_sale', '1');
        $this->db->where('rel_type', 'proposal');
        $this->db->order_by('id', 'ASC');
        $saleprolist = $this->db->get('tblitems_in')->result_array();

        $this->db->where('proposalid', $id);
        $this->db->where('is_sale', '0');
        $otherchargesforrent = $this->db->get('tblproposalothercharges')->result_array();

        $this->db->where('proposalid', $id);
        $proposalfields = $this->db->get('tblproposalproductfields')->result_array();
        $proposalfieldname = array_column($proposalfields, 'field_id');

        $this->db->where('proposalid', $id);
        $this->db->where('is_sale', '1');
        $otherchargesforsale = $this->db->get('tblproposalothercharges')->result_array();

        $data['sale_othercharges'] = $otherchargesforsale;
        $data['rent_othercharges'] = $otherchargesforrent;
        $data['rent_prolist'] = $rentalprolist;
        $data['sale_prolist'] = $saleprolist;
        $data['proposalfields'] = $proposalfieldname;


        $data['estimate'] = $data['proposal'];
        $data['is_proposal'] = true;
        $title = _l('edit', _l('proposal_lowercase'));
        $this->db->where('lead_id', $id);
        $staffassigndata= $this->db->get('tblproposalassignstaff')->result_array();
        $staffassigndata=array_column($staffassigndata,'staff_id');
        $data['staffassigndata']=$staffassigndata;

        $default_settings=$this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id WHERE dsc.id=1")->result_array();
        $data['default_setting_field']=array_column($default_settings,'default_setting_field');
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
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities`")->result_array();
        $this->load->model('Leads_model');
        $data['all_source'] = $this->Leads_model->get_source();
        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();

        if(!empty($data['proposal'])){
            $rel_id = $data['proposal']->rel_id;
        }else{
            $rel_id = $_GET['rel_id'];
        }

        $leaddetails=$this->db->query("SELECT cb.`client_branch_name`,cb.`userid` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_branch_id`=cb.userid WHERE l.`id`='".$rel_id."' ORDER BY cb.`client_branch_name` ASC")->row_array();

        if(!empty($leaddetails['client_branch_name'])){
            $data['client_branch_name'] = $leaddetails['client_branch_name'];
            $data['client_id'] = $leaddetails['userid'];

        }else{
            $lead_info=$this->db->query("SELECT * FROM `tblleads` where `id`='".$rel_id."'")->row();
            $data['client_branch_name'] = $lead_info->company;
            $data['client_id'] = 0;

        }

        $lead_prod_rent_det = $this->db->query("SELECT p.*,pe.product_remarks,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.id='1' OR ef.id='3') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,pe.product_remarks,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.id='2' OR ef.id='3')")->result_array();

        $clientsate = array_column($lead_prod_rent_det, 'state');
        $data['clientsate'] = (in_array(0,$clientsate)) ? $clientsate[0] : '';
        $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        $data['lead_prod_sale_det'] = $lead_prod_sale_det;
//        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1")->result_array();
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY `name` ASC")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 ORDER BY `product_name` ASC")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=> cc($r['sub_name']),'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }
        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
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
        $data['title'] = $title;
        $compbranchid=$this->session->userdata('staff_user_id');//exit;
        $compnybranch_warehouse=$this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='".$compbranchid."'")->row_array();
        $warehouseid=explode(',',$compnybranch_warehouse['warehouse_id']);
        foreach($warehouseid as $singlewarehouseid)
        {
            $warehousedata[]=$this->db->query("SELECT * FROM `tblwarehouse` where id='".$singlewarehouseid."'")->row_array();
        }
        $data['all_warehouse'] = $warehousedata;
        $this->load->model('Enquiryfor_model');
        $data['service_type'] = get_service_type();
        $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by field_for desc")->result();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ")->result_array();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        
       $this->load->view('admin/proposals/revice_quotation', $data);
    }

	public function chalan($id = '') {


        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            if ($id == '') {
                /*if (!has_permission('proposals', '', 'create')) {
                    access_denied('proposals');
                }*/
                $id = $this->proposals_model->add($proposal_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('proposal')));
                    if ($this->set_proposal_pipeline_autoload($id)) {
                       redirect(admin_url('proposals/index/'. $id));
                    } else {
                        redirect(admin_url('proposals/index/'. $id));
                    }
                }
            } else {
                /*if (!has_permission('proposals', '', 'edit')) {
                    access_denied('proposals');
                }*/
                $success = $this->proposals_model->update($proposal_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('proposal')));
                }
                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('proposals'));
                } else {
                    redirect(admin_url('proposals#' . $id));
                }
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('proposal_lowercase'));
        } else {
            $data['proposal'] = $this->proposals_model->get($id);

            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '0');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();

            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '1');
            $saleprolist = $this->db->get('tblitems_in')->result_array();

			$this->db->where('proposalid', $id);
            $this->db->where('is_sale', '0');
            $otherchargesforrent = $this->db->get('tblproposalothercharges')->result_array();

            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblproposalproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'fieldname');

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblproposalothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['productdata'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;

            if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }
            $data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
			$this->db->where('lead_id', $id);
			$staffassigndata= $this->db->get('tblproposalassignstaff')->result_array();
			$staffassigndata=array_column($staffassigndata,'staff_id');
			$data['staffassigndata']=$staffassigndata;
        }
		$default_settings=$this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id WHERE dsc.id=1")->result_array();
		$data['default_setting_field']=array_column($default_settings,'default_setting_field');
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');
        $data['ajaxItems'] = false;
        if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items'] = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();

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
        $leaddetails=$this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='".$_GET['rel_id']."' ORDER BY cb.`client_branch_name` ASC")->row_array();
		$data['client_branch_name'] = $leaddetails['client_branch_name'];
		$lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();
        $clientsate = array_column($lead_prod_rent_det, 'state');
        $data['clientsate'] = $clientsate[0];
        $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        $data['lead_prod_sale_det'] = $lead_prod_sale_det;
		$data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1")->result_array();

        $this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
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
		$data['title'] = $title;
        $this->load->view('admin/proposals/generate_chalan', $data);
    }


	public function performerinvoice($id = '') {

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
            $lead_id = value_by_id('tblproposals',$id,'rel_id');
            $proposal_data['proposal_id'] = $id;
            $proposal_data['lead_id'] = $lead_id;

            //checking if there is any temprory product
            if(!empty($proposal_data['rentproposal'])){
                foreach ($proposal_data['rentproposal'] as $r) {
                    if(!empty($r['temp_product'])){

                        set_alert('warning', 'There is a Product which is temporary, Please Make Permanent Product!');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            }
            if(!empty($proposal_data['saleproposal'])){
                foreach ($proposal_data['saleproposal'] as $r) {
                    if(!empty($r['temp_product'])){
                        set_alert('warning', 'There is a Product which is temporary, Please Make Permanent Product!');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            }

            /*if (!has_permission('proposals', '', 'create')) {
                access_denied('proposals');
            }*/

            //Update Lead Status
            if(!empty($id)){
                $lead_id = value_by_id_empty('tblproposals',$id,'rel_id');
                if(!empty($lead_id)){
                    $this->home_model->update('tblleads', array('process_id'=>4),array('id'=>$lead_id));
                }

            }

            $id = $this->Estimates_model->add($proposal_data);

            if ($id) {
                //Update Final Amt
                update_pi_final_amount($id);

                /* this function use for add custom terms and condition */
                $this->proposals_model->addCustomTermsAndCondition($id, 'estimate', $termsdata, "tblestimates");

                set_alert('success', _l('added_successfully', _l('estimate')));
                //redirect(admin_url('estimates/list_estimates/' . $id));
                redirect(admin_url('estimates/list/'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('proposal_lowercase'));
        } else {
            $this->load->model('estimates_model');
            $this->load->model('proposals_model');
            $data['proposal'] = $this->proposals_model->get($id);


            $this->db->where('id', $id);
            $proposalll = $this->db->get('tblestimates')->row_array();

            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '0');
            $this->db->where('rel_type', 'proposal');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();
            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '1');
            $this->db->where('rel_type', 'proposal');
            $saleprolist = $this->db->get('tblitems_in')->result_array();

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '0');
            $otherchargesforrent = $this->db->get('tblproposalothercharges')->result_array();

            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblestimateproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'fieldname');

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblproposalothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
           // $data['proposalfields'] = $proposalfieldname;

            /*if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }*/

            if(!empty($rentalprolist)){
                $data['s_type'] = '1';
            }else{
                $data['s_type'] = '2';
            }

            //$data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
            $this->db->where('lead_id', $id);
            $staffassigndata = $this->db->get('tblestimateassignstaff')->result_array();
            $staffassigndata = array_column($staffassigndata, 'staff_id');
            $data['staffassigndata'] = $staffassigndata;
            $data['contactdata'] = $this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='" . $id . "' AND `type`='estimate'")->result_array();
            $data['shipcontactdata'] = $this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='" . $id . "' AND `type`='shipestimate'")->result_array();
            $data['staff_data'] = $this->db->query("SELECT * FROM `tblcontacts` WHERE `userid`='" . $proposalll['clientid'] . "' ORDER BY firstname ASC")->result_array();
        }

        $title = _l('add_new', _l('proposal_lowercase'));

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
       // $data['all_warehouse'] = $warehousedata;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status ='1' ORDER BY name ASC ")->result_array();
        $this->load->model('Enquiryfor_model');
        //$data['service_type'] = $this->Enquiryfor_model->get();
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
        //$data['staff_data'] = $this->Staff_model->get();
        $data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE `active`=1 and `client_branch_name` !='' ORDER BY client_branch_name ASC ")->result();

        //getting client
        $lead_id = value_by_id('tblproposals',$id,'rel_id');
        $data['client_info'] = $this->db->query(" SELECT c.userid FROM `tblclientbranch` as c INNER JOIN tblleads as l ON l.client_branch_id = c.userid where l.id = '".$lead_id."'  ")->row();
        $data['type_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC")->result();

        $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by field_for desc")->result();

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' AND id != 1  order by name ASC ")->result();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ")->result_array();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        $this->load->view('admin/proposals/perfoma_invoice', $data);
    }

	public function invoices($id = '')
    {
        if ($this->input->post()) {
            $invoice_data = $this->input->post();
            if ($id != '') {
                /*if (!has_permission('invoices', '', 'create')) {
                    access_denied('invoices');
                }*/
				$this->load->model('invoices_model');
                $id = $this->invoices_model->add_invoice($invoice_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('invoice')));
                    redirect(admin_url('invoices/list_invoices/' . $id));
                }
            }
        }
        if ($id == '') {
            $title                  = _l('create_new_invoice');
            $data['billable_tasks'] = [];
        } else {

            $data['proposal'] = $this->proposals_model->get($id);
            $proposal = $this->proposals_model->get($id);

            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '0');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();

            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '1');
            $saleprolist = $this->db->get('tblitems_in')->result_array();

			$this->db->where('proposalid', $id);
            $this->db->where('is_sale', '0');
            $otherchargesforrent = $this->db->get('tblproposalothercharges')->result_array();

            $this->db->where('proposalid', $id);
            //$proposalfields = $this->db->get('tblproposalproductfields')->result_array();

            //$proposalfieldname = array_column($proposalfields, 'fieldname');

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblproposalothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            //$data['proposalfields'] = $proposalfieldname;

            if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
			if($proposal->rel_type=='proposal')
			{
				$rel_id=$proposal->rel_id;
				$get_lead_details=$this->db->query("SELECT * FROM `tblleads` WHERE `id`='".$rel_id."'")->row_array();
				$customer_id=$get_lead_details['client_id'];
				$data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblenquiryclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `enquiry_id`='".$rel_id."'")->result_array();
			}
			else
			{
				$data['contactdata']=array();
			}
        }

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
        if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items']     = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();

        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        $data['base_currency'] = $this->currencies_model->get_base_currency();
		$this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();
		$data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 ORDER BY name ASC")->result_array();

        $data['staff']     = $this->staff_model->get('', ['active' => 1]);
        $data['title']     = $title;
        $data['bodyclass'] = 'invoice';
		$this->load->model('Site_manager_model');
		$data['all_site'] = $this->Site_manager_model->get();
		$this->load->model('Contact_type_model');
		$data['contact_type_data'] = $this->Contact_type_model->get();

		$this->load->model('Designation_model');
		$data['designation_data'] = $this->Designation_model->get();
        $this->load->view('admin/proposals/invoices', $data);
    }


    public function get_template() {
        $name = $this->input->get('name');
        echo $this->load->view('admin/proposals/templates/' . $name, [], true);
    }

    public function send_expiry_reminder($id) {
        $canView = user_can_view_proposal($id);
        if (!$canView) {
            access_denied('proposals');
        } else {
            /*if (!has_permission('proposals', '', 'view') && !has_permission('proposals', '', 'view_own') && $canView == false) {
                access_denied('proposals');
            }*/
        }

        $success = $this->proposals_model->send_expiry_reminder($id);
        if ($success) {
            set_alert('success', _l('sent_expiry_reminder_success'));
        } else {
            set_alert('danger', _l('sent_expiry_reminder_fail'));
        }
        if ($this->set_proposal_pipeline_autoload($id)) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('proposals/list_proposals/' . $id));
        }
    }

    public function clear_acceptance_info($id) {
        if (is_admin()) {
            $this->db->where('id', $id);
            $this->db->update('tblproposals', get_acceptance_info_array(true));
        }

        redirect(admin_url('proposals/list_proposals/' . $id));
    }


    public function pdf($id) {
        if (!$id) {
            redirect(admin_url('proposals'));
        }

        $canView = user_can_view_proposal($id);
        if (!$canView) {
            access_denied('proposals');
        } else {
            /*if (!has_permission('proposals', '', 'view') && !has_permission('proposals', '', 'view_own') && $canView == false) {
                access_denied('proposals');
            }*/
        }

        $proposal = $this->proposals_model->get($id);
        try {
            $pdf = proposal_pdf($proposal,'',$this->input->get('type'));
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

        $proposal_number = format_proposal_number($id);
        $pdf->Output($proposal_number . '.pdf', $type);
    }

    public function get_proposal_data_ajax($id, $to_return = false) {
        /*if (!has_permission('proposals', '', 'view') && !has_permission('proposals', '', 'view_own') && get_option('allow_staff_view_proposals_assigned') == 0) {
            echo _l('access_denied');
            die;
        }*/

        $proposal = $this->proposals_model->get($id, [], true);

        if (!$proposal || !user_can_view_proposal($id)) {
           // echo _l('proposal_not_found');
           // die;
        }

        $template_name = 'proposal-send-to-customer';
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

        define('EMAIL_TEMPLATE_PROPOSAL_ID_HELP', $proposal->id);

        $data['template'] = get_email_template_for_sending($template_name, $proposal->email);

        $proposal_merge_fields = get_available_merge_fields();

        $_proposal_merge_fields = [];
        array_push($_proposal_merge_fields, [
            [
                'name' => 'Items Table',
                'key' => '{proposal_items}',
            ],
        ]);
        foreach ($proposal_merge_fields as $key => $val) {
            foreach ($val as $type => $f) {
                if ($type == 'proposals') {
                    foreach ($f as $available) {
                        foreach ($available['available'] as $av) {
                            if ($av == 'proposals') {
                                array_push($_proposal_merge_fields, $f);

                                break;
                            }
                        }

                        break;
                    }
                } elseif ($type == 'other') {
                    array_push($_proposal_merge_fields, $f);
                }
            }
        }
        //echo"<pre>";print_r($proposal);exit;
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();
        $data['members'] = $this->staff_model->get('', ['active' => 1]);
        $data['proposal_merge_fields'] = $_proposal_merge_fields;
        $data['proposal'] = $proposal;
		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->Staffgroup_model->get();
		//$Staffgroup = $this->Staffgroup_model->get_employee_group(get_staff_user_id());
        $Staffgroup =  get_staff_group(8,get_staff_user_id());
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
		$data['proposalid'] = $id;
        if ($to_return == false) {
            $this->load->view('admin/proposals/proposals_preview_template', $data);
        } else {
            return $this->load->view('admin/proposals/proposals_preview_template', $data, true);
        }
    }
	public function sendapproval()
    {
		$staffid=$this->input->post('staffid');
		$proposalid=$this->input->post('proposalid');
		foreach($staffid as $singlelead)
		{
			if($singlelead!=0)
			{
			$prdata['staff_id']=$singlelead;
			$prdata['lead_id']=$proposalid;
			$prdata['status']=1;
			$prdata['created_at'] = date("Y-m-d H:i:s");
			$prdata['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert('tblproposalstaffapproval',$prdata);

			 $notified = add_notification([
                        'description'     => 'Proposal Send to you for Approval',
                        'touserid'        => $singlelead,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'proposals/list_proposals/' . $proposalid,
                        'additional_data' => serialize([
                            $proposal->subject,
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$singlelead]);
                    }
			}
		}
		$prddata['proposal_send']=1;
		$this->db->where('id', $proposalid);
		$this->db->update('tblproposals', $prddata);
		exit;
	}

	public function approvalaccept()
    {
		$approve_status=$this->input->post('approve_status');
		$leadid=$this->input->post('leadid');
		$approvereason=$this->input->post('approvereason');
		$leadcreatorid=$this->input->post('leadcreatorid');
		$ldata['approve_status']=$approve_status;
		$ldata['approvereason']=$approvereason;
		$this->db->where('staff_id', get_staff_user_id());
		$this->db->where('lead_id', $leadid);
		$this->db->update('tblproposalstaffapproval', $ldata);
		$this->load->model('Leads_model');
		if($approve_status==1)
		{
		  $notified = add_notification([
                        'description'     => 'Proposal approve Successfully',
                        'touserid'        => $leadcreatorid,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'proposals/index/' . $leadid,
                        'additional_data' => serialize([
                            $proposal->subject,
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$leadcreatorid]);
                    }
		}
		else
		{
			 $notified = add_notification([
                        'description'     => 'Proposal Decline Successfully',
                        'touserid'        => $leadcreatorid,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'proposals/index/' . $leadid,
                        'additional_data' => serialize([
                            $proposal->subject,
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$leadcreatorid]);
                    }

			//$this->Leads_model->lead_decline_member_notification($leadid, $leadcreatorid);
		}
		exit;
	}

    public function convert_to_estimate($id) {
        /*if (!has_permission('estimates', '', 'create')) {
            access_denied('estimates');
        }*/
        if ($this->input->post()) {
            $this->load->model('estimates_model');
            $estimate_id = $this->estimates_model->add($this->input->post());
            if ($estimate_id) {
                set_alert('success', _l('proposal_converted_to_estimate_success'));
                $this->db->where('id', $id);
                $this->db->update('tblproposals', [
                    'estimate_id' => $estimate_id,
                    'status' => 3,
                ]);
                logActivity('Proposal Converted to Estimate [EstimateID: ' . $estimate_id . ', ProposalID: ' . $id . ']');

                do_action('proposal_converted_to_estimate', ['proposal_id' => $id, 'estimate_id' => $estimate_id]);

                redirect(admin_url('estimates/estimate/' . $estimate_id));
            } else {
                set_alert('danger', _l('proposal_converted_to_estimate_fail'));
            }
            if ($this->set_proposal_pipeline_autoload($id)) {
                redirect(admin_url('proposals'));
            } else {
                redirect(admin_url('proposals/list_proposals/' . $id));
            }
        }
    }

    public function convert_to_invoice($id) {
        /*if (!has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }*/
        if ($this->input->post()) {
            $this->load->model('invoices_model');
            $invoice_id = $this->invoices_model->add($this->input->post());
            if ($invoice_id) {
                set_alert('success', _l('proposal_converted_to_invoice_success'));
                $this->db->where('id', $id);
                $this->db->update('tblproposals', [
                    'invoice_id' => $invoice_id,
                    'status' => 3,
                ]);
                logActivity('Proposal Converted to Invoice [InvoiceID: ' . $invoice_id . ', ProposalID: ' . $id . ']');
                do_action('proposal_converted_to_invoice', ['proposal_id' => $id, 'invoice_id' => $invoice_id]);
                redirect(admin_url('invoices/invoice/' . $invoice_id));
            } else {
                set_alert('danger', _l('proposal_converted_to_invoice_fail'));
            }
            if ($this->set_proposal_pipeline_autoload($id)) {
                redirect(admin_url('proposals'));
            } else {
                redirect(admin_url('proposals/list_proposals/' . $id));
            }
        }
    }

    public function get_invoice_convert_data($id) {
        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'expenses_only !=' => 1,
        ]);
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
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
        $data['proposal'] = $this->proposals_model->get($id);
        $data['billable_tasks'] = [];
        $data['add_items'] = $this->_parse_items($data['proposal']);

        if ($data['proposal']->rel_type == 'proposal') {
            $this->db->where('leadid', $data['proposal']->rel_id);
            $data['customer_id'] = $this->db->get('tblclients')->row()->userid;
        } else {
            $data['customer_id'] = $data['proposal']->rel_id;
        }
        $data['custom_fields_rel_transfer'] = [
            'belongs_to' => 'proposal',
            'rel_id' => $id,
        ];
        $this->load->view('admin/proposals/invoice_convert_template', $data);
    }

    public function get_estimate_convert_data($id) {
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
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
        $data['proposal'] = $this->proposals_model->get($id);
        $data['add_items'] = $this->_parse_items($data['proposal']);

        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        if ($data['proposal']->rel_type == 'proposal') {
            $this->db->where('leadid', $data['proposal']->rel_id);
            $data['customer_id'] = $this->db->get('tblclients')->row()->userid;
        } else {
            $data['customer_id'] = $data['proposal']->rel_id;
        }

        $data['custom_fields_rel_transfer'] = [
            'belongs_to' => 'proposal',
            'rel_id' => $id,
        ];

        $this->load->view('admin/proposals/estimate_convert_template', $data);
    }

    private function _parse_items($proposal) {
        $items = [];
        foreach ($proposal->items as $item) {
            $taxnames = [];
            $taxes = get_proposal_item_taxes($item['id']);
            foreach ($taxes as $tax) {
                array_push($taxnames, $tax['taxname']);
            }
            $item['taxname'] = $taxnames;
            $item['parent_item_id'] = $item['id'];
            $item['id'] = 0;
            $items[] = $item;
        }

        return $items;
    }

    /* Send proposal to email */

    public function send_to_email($id) {
        $canView = user_can_view_proposal($id);
        if (!$canView) {
            access_denied('proposals');
        } else {
            if (!has_permission('proposals', '', 'view') && !has_permission('proposals', '', 'view_own') && $canView == false) {
                access_denied('proposals');
            }
        }

        if ($this->input->post()) {
            try {
                 $success = $this->proposals_model->send_proposal_to_email($id, 'proposal-send-to-customer', $this->input->post('attach_pdf'), $this->input->post('cc'));

            } catch (Exception $e) {
                $message = $e->getMessage();
                echo $message;
                if (strpos($message, 'Unable to get the size of the image') !== false) {
                    show_pdf_unable_to_get_image_size_error();
                }
                die;
            }


            if ($success) {
                set_alert('success', _l('proposal_sent_to_email_success'));
            } else {
                set_alert('danger', _l('proposal_sent_to_email_fail'));
            }

            if ($this->set_proposal_pipeline_autoload($id)) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('proposals/list_proposals/' . $id));
            }
        }
    }

    public function copy($id) {
        /*if (!has_permission('proposals', '', 'create')) {
            access_denied('proposals');
        }*/
        $new_id = $this->proposals_model->copy($id);
        if ($new_id) {
            set_alert('success', _l('proposal_copy_success'));
            $this->set_proposal_pipeline_autoload($new_id);
            redirect(admin_url('proposals/proposal/' . $new_id));
        } else {
            set_alert('success', _l('proposal_copy_fail'));
        }
        if ($this->set_proposal_pipeline_autoload($id)) {
            redirect(admin_url('proposals'));
        } else {
            redirect(admin_url('proposals/list_proposals/' . $id));
        }
    }

    public function mark_action_status($status, $id) {
        /*if (!has_permission('proposals', '', 'edit')) {
            access_denied('proposals');
        }*/
        $success = $this->proposals_model->mark_action_status($status, $id);
        if ($success) {
            if($status == 5){
                $this->db->query("Update tblproposals set date = '".date('Y-m-d')."' where id = '".$id."' ");
            }
            set_alert('success', _l('proposal_status_changed_success'));
        } else {
            set_alert('danger', _l('proposal_status_changed_fail'));
        }
        if ($this->set_proposal_pipeline_autoload($id)) {
            redirect(admin_url('proposals'));
        } else {
            redirect(admin_url('proposals/list_proposals/' . $id));
        }
    }

    public function delete($id) {
        check_permission(5,'delete');
        $response = $this->proposals_model->delete($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('proposal')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('proposal_lowercase')));
        }
        redirect(admin_url('proposals'));
    }

    public function get_relation_data_values($rel_id, $rel_type) {
        echo json_encode($this->proposals_model->get_relation_data_values($rel_id, $rel_type));
    }

    public function add_proposal_comment() {
        if ($this->input->post()) {
            echo json_encode([
                'success' => $this->proposals_model->add_comment($this->input->post()),
            ]);
        }
    }

    public function edit_comment($id) {
        if ($this->input->post()) {
            echo json_encode([
                'success' => $this->proposals_model->edit_comment($this->input->post(), $id),
                'message' => _l('comment_updated_successfully'),
            ]);
        }
    }

    public function get_proposal_comments($id) {
        $data['comments'] = $this->proposals_model->get_comments($id);
        $this->load->view('admin/proposals/comments_template', $data);
    }

    public function remove_comment($id) {
        $this->db->where('id', $id);
        $comment = $this->db->get('tblproposalcomments')->row();
        if ($comment) {
            if ($comment->staffid != get_staff_user_id() && !is_admin()) {
                echo json_encode([
                    'success' => false,
                ]);
                die;
            }
            echo json_encode([
                'success' => $this->proposals_model->remove_comment($id),
            ]);
        } else {
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function save_proposal_data() {
        if (!has_permission('proposals', '', 'edit') && !has_permission('proposals', '', 'create')) {
            header('HTTP/1.0 400 Bad error');
            echo json_encode([
                'success' => false,
                'message' => _l('access_denied'),
            ]);
            die;
        }
        $success = false;
        $message = '';

        $this->db->where('id', $this->input->post('proposal_id'));
        $this->db->update('tblproposals', [
            'content' => $this->input->post('content', false),
        ]);

        $success = $this->db->affected_rows() > 0;
        $message = _l('updated_successfully', _l('proposal'));

        echo json_encode([
            'success' => $success,
            'message' => $message,
        ]);
    }

    // Pipeline
    public function pipeline($set = 0, $manual = false) {
        if ($set == 1) {
            $set = 'true';
        } else {
            $set = 'false';
        }
        $this->session->set_userdata([
            'proposals_pipeline' => $set,
        ]);
        if ($manual == false) {
            redirect(admin_url('proposals'));
        }
    }

    public function pipeline_open($id) {
        if (has_permission('proposals', '', 'view') || has_permission('proposals', '', 'view_own') || get_option('allow_staff_view_proposals_assigned') == 1) {
            $data['proposal'] = $this->get_proposal_data_ajax($id, true);
            $data['proposal_data'] = $this->proposals_model->get($id);
            $this->load->view('admin/proposals/pipeline/proposal', $data);
        }
    }

    public function update_pipeline() {
        if (has_permission('proposals', '', 'edit')) {
            $this->proposals_model->update_pipeline($this->input->post());
        }
    }

    public function get_pipeline() {
        if (has_permission('proposals', '', 'view') || has_permission('proposals', '', 'view_own') || get_option('allow_staff_view_proposals_assigned') == 1) {
            $data['statuses'] = $this->proposals_model->get_statuses();
            $this->load->view('admin/proposals/pipeline/pipeline', $data);
        }
    }

    public function pipeline_load_more() {
        $status = $this->input->get('status');
        $page = $this->input->get('page');

        $proposals = $this->proposals_model->do_kanban_query($status, $this->input->get('search'), $page, [
            'sort_by' => $this->input->get('sort_by'),
            'sort' => $this->input->get('sort'),
        ]);

        foreach ($proposals as $proposal) {
            $this->load->view('admin/proposals/pipeline/_kanban_card', [
                'proposal' => $proposal,
                'status' => $status,
            ]);
        }
    }

    public function set_proposal_pipeline_autoload($id) {
        if ($id == '') {
            return false;
        }

        if ($this->session->has_userdata('proposals_pipeline') && $this->session->userdata('proposals_pipeline') == 'true') {
            $this->session->set_flashdata('proposalid', $id);

            return true;
        }

        return false;
    }

    public function getotherchargesdata() {
        $othercharges = $this->input->post('othercharges');
        $isgst = $this->input->post('isgst');
        $this->db->where('id', $othercharges);
        $otherchargesdata = $this->db->get('tblotherchargemaster')->row();
        $otherchargesdata = (array) $otherchargesdata;
        if ($isgst == 1) {
            $tax = $otherchargesdata['gst'] + $otherchargesdata['sgst'];
        } else {
            $tax = $otherchargesdata['igst'];
        }
        $taxamt = ($otherchargesdata['amount'] * $tax) / 100;
        $subtotal = $otherchargesdata['amount'] + $taxamt;
        echo json_encode(array('sac_code' => $otherchargesdata['sac_code'], 'gst' => $otherchargesdata['gst'], 'amount' => $otherchargesdata['amount'], 'taxamt' => $taxamt, 'subtotal' => $subtotal, 'sgst' => $otherchargesdata['sgst'], 'igst' => $otherchargesdata['igst']));
    }

	public function get_rel_list()
	{
		$rel_type=$this->input->post('rel_type');
		if($rel_type=='proposal')
		{
			$rel_arr = $this->db->get('tblleads')->result_array();
		}
		else
		{
			$rel_arr= $rel_arr = $this->db->get('tblclientbranch')->result_array();
		}
		//echo"<pre>";print_r($rel_arr);die();
		if(count($rel_arr) == 0) {
            echo "";
           // exit;
        }

        echo json_encode($rel_arr);
        exit;
	}


    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('proposals'));
        }
        $proposal = $this->proposals_model->get($id);
        $file_name = format_proposal_number($id);

        /*echo $html = proposals_pdf($proposal);
        die;*/
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            $html = nturm_proposals_pdf($proposal);
        }else{
            $html = proposals_pdf($proposal);
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

    public function download_test($id)
    {
        require_once APPPATH.'third_party/email_config.php';
        /*unlink("export/quotation/filename.pdf");
        die;*/
        /*require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('proposals'));
        }
        $proposal = $this->proposals_model->get($id);
        $file_name = format_proposal_number($id);

        $html = proposals_pdf($proposal);
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

        $output = $dompdf->output();
       file_put_contents('export/quotation/filename.pdf', $output);*/


        $this->email->to('webking52@gmail.com');
        $this->email->subject('Login Details Created');
        $this->email->message('This is message');
        $this->email->attach('export/quotation/filename.pdf');
        $this->email->send();
        unlink("export/quotation/filename.pdf");


    }

    public function update_subject(){

        $quote_info = $this->db->query("SELECT * FROM `tblproposals` ")->result();

        if(!empty($quote_info)){
            foreach ($quote_info as $key => $value) {
                $rel_id = $value->rel_id;

                $leaddetails=$this->db->query("SELECT cb.`client_branch_name`,cb.`userid` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_branch_id`=cb.userid WHERE l.`id`='".$rel_id."'")->row_array();

                if(!empty($leaddetails['client_branch_name'])){
                    $subject = 'Quotation for '.$leaddetails['client_branch_name'];

                }else{
                    $lead_info=$this->db->query("SELECT * FROM `tblleads` where `id`='".$rel_id."'")->row();
                    $subject = 'Quotation for '.$lead_info->company;

                }


                $update=$this->db->query("Update tblproposals set subject = '".$subject."' where id = '".$value->id."' ");


            }
        }

    }

    public function gettaxtype(){
        $state = $_POST['state'];
        echo get_gst_type_by_state($state);
    }


	public function new_pdf()
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $file_name = 'Dummy';

        /*echo $html = new_pdf($proposal);
        die;*/

        $html = new_pdf();
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

    public function test_pdf()
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $file_name = 'Dummy';

        /*echo $html = test_pdf($proposal);
        die;*/

        $html = test_pdf();
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

    public function get_client_list(){
        $relid = $this->input->post("relid");
        $contacts = $this->db->query("SELECT c.firstname, c.email, c.id FROM `tblcontacts` as c LEFT JOIN tblenquiryclientperson lc ON c.id = lc.contact_id where lc.enquiry_id = ".$relid." and c.email != '' GROUP by c.email")->result_array();
        echo render_select('sent_to[]',$contacts,array('email','email','firstname'),'invoice_estimate_sent_to_email', array(),array('multiple'=>true,"required" => true),array(),'','',false);
    }

    /* this function use for send mail of lead */
    public function send_proposalto_email(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            $proposal_data = $this->db->query("SELECT * FROM tblproposals WHERE id = ".$proposal_id."")->row();
            if (!empty($proposal_data)){
                $response = $this->emails_model->send_mail($proposal_id, "proposals", $module_template_id, $proposal_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Quote mail send successfully");
                    redirect(admin_url('proposals/list/'));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url('proposals/list'));
                }
            }
            else{
                set_alert('danger', "Proposal not found");
                redirect(admin_url('proposals/list'));
            }
        }
        else{
            redirect(admin_url('proposals/list'));
        }
    }

    public function getTransportChargesRequest(){
        if ($this->input->post()) {
            extract($this->input->post());

            if (isset($request_id) && $request_id > 0){
                $request_info = $this->db->query("SELECT * FROM `tbltransportchargesrequest` WHERE `id` = '".$request_id."'")->row();
            }
            echo form_open_multipart(admin_url("proposals/addTransportChargesRequest"), array('id' => 'sub_form_product'));
    ?>
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Transport Charges Request </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" app-field-wrapper="name">
                        <label for="module_id" class="control-label">Select Challan Manager</label>
                        <select class="form-control selectpicker" required="" data-live-search="true" id="challan_manage_id" name="challan_manage_id">
                            <option value=""></option>
                            <?php 
                                $managerlist = $this->db->query("SELECT `challan_manage_id`,`comp_branch_name` FROM `tblcompanybranch` WHERE `status` = 1")->result();
                                if ($managerlist){
                                    foreach ($managerlist as $key => $value) {
                                        $selectedcls = (isset($request_info) && $request_info->challan_manage_id == $value->challan_manage_id) ? 'selected="selected"':'';
                                        echo '<option value="'.$value->challan_manage_id.'" '.$selectedcls.'>'.get_employee_fullname($value->challan_manage_id).' ('.$value->comp_branch_name.')'.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" app-field-wrapper="name">
                        <label for="module_id" class="control-label">Remark</label>
                        <textarea name="sender_remark" class="form-control" id="sender_remark" cols="5" rows="5"><?php echo (isset($request_info) && !empty($request_info->sender_remark)) ? $request_info->sender_remark : ''; ?></textarea>
                    </div>    
                </div>
            </div>

            <input type="hidden" name="request_id" class="request_id" value="<?php echo (isset($request_id) && $request_id > 0) ? $request_id : '0'; ?>">
            <input type="hidden" name="rel_id" class="rel_id" value="<?php echo $rel_id; ?>">
            <input type="hidden" name="rel_type" class="rel_type" value="<?php echo $rel_type; ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            <button type="submit" autocomplete="off"  class="btn btn-info"><?php echo (isset($request_id) && $request_id > 0) ? 'Update' : 'Send'; ?></button>
        </div>        
    </div>        
    <?php     
            echo form_close();   
        }
    }

    public function addTransportChargesRequest(){
        if ($this->input->post()) {
            extract($this->input->post());

            if (isset($request_id) && $request_id > 0){
                $updatedata['sender_remark'] = $sender_remark;
                $updatedata['updated_at'] = date("Y-m-d H:i:s");
                $this->home_model->update("tbltransportchargesrequest", $updatedata, array('id' => $request_id));
                set_alert('success', "Transport charges remark updated.");
            }else{
                $insertdata['added_by'] = get_staff_user_id();
                $insertdata['ref_type'] = $rel_type;
                $insertdata['ref_id'] = $rel_id;
                $insertdata['challan_manage_id'] = $challan_manage_id;
                $insertdata['sender_remark'] = $sender_remark;
                $insertdata['created_at'] = date("Y-m-d H:i:s");
                $insertdata['updated_at'] = date("Y-m-d H:i:s");
                $insert_id = $this->home_model->insert("tbltransportchargesrequest", $insertdata);
                if ($insert_id){
                    $adata = array(
                        'staff_id' => $challan_manage_id,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 52,
                        'description' => 'Transport Charges Request Send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'proposals/transport_charges_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                  //Sending Mobile Intimation
                    $token = get_staff_token($challan_manage_id);
                    $message = 'Transport Charges Request Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    set_alert('success', "Transport charges request send successfully.");
                }
                else{
                    set_alert('danger', "Something went wrong.");
                }
            }
            $redirecturl = ($rel_type == 'proposals') ? 'proposals/list' : 'estimates/list';
            redirect(admin_url($redirecturl));
        }    
    }

    public function transport_charges_approval($request_id){

        if ($this->input->post()) {
            extract($this->input->post());

            $updatedata['manager_remark'] = $manager_remark;
            $updatedata['transport_charges'] = $transport_charges;
            $updatedata['status'] = 1;
            $updatedata['updated_at'] = date("Y-m-d H:i:s");
            $this->home_model->update("tbltransportchargesrequest", $updatedata, array('id' => $request_id));
            update_masterapproval_all(52,$request_id,1);

            /* THIS CODE USE FOR REVERT NOTIFICATION */
            $chk_sender_details = $this->db->query("SELECT `fromuserid` FROM `tblmasterapproval` WHERE `status` = 1 and `table_id` = '".$request_id."' and `staff_id` = '".get_staff_user_id()."' and `module_id` = 52 ORDER BY id DESC")->row();
            if (!empty($chk_sender_details)){

                $transcharges_request = $this->db->query("SELECT `ref_type`,`ref_id` FROM tbltransportchargesrequest WHERE `id`=".$request_id." ")->row();
                $link = "";
                $description = "";
                if ($transcharges_request->ref_type == 'proposals'){
                    $link = "proposals/list?charges_request=".$request_id;
                    $doc_number = value_by_id("tblproposals", $transcharges_request->ref_id,"number");
                    $description = 'The Transportation Charges for the Quote ['.$doc_number.'] is '.$transport_charges;
                }else if ($transcharges_request->ref_type == 'estimates'){
                    $link = "estimates/list?charges_request=".$request_id;
                    $doc_number = value_by_id(" tblestimates", $transcharges_request->ref_id,"number");
                    $description = 'The Transportation Charges for the PI ['.$doc_number.'] is '.$transport_charges;
                }

                if ($description != ""){
                    $staff_id = $chk_sender_details->fromuserid;
                    $n_data = array(
                        'description' => $description,
                        'staff_id' => $staff_id,
                        'fromuserid' => get_staff_user_id(),
                        'table_id' => $request_id,
                        'isread' => 0,
                        'module_id' => 52,
                        'link'  => $link,
                        'date' => date('Y-m-d H:i:s'),
                        'date_time' => date('Y-m-d H:i:s')
                    );

                    $this->home_model->insert('tblmasterapproval', $n_data);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staff_id);
                    $title = 'Schach';
                    sendFCM($description, $title, $token, $page = 2);
                }
                
            }

            set_alert('success', "Transport charges remark updated.");
            redirect(admin_url('approval/notifications'));
        }

        $data['title'] = "Transport Charges Approval";
        $data["request_info"] = $this->db->query("SELECT * FROM `tbltransportchargesrequest` WHERE id='".$request_id."' ")->row();
        $this->load->view("admin/proposals/transport_charges_approval",$data); 
    }

}
