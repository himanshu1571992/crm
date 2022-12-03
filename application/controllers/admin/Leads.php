<?php

header('Content-Type: text/html; charset=utf-8');
defined('BASEPATH') or exit('No direct script access allowed');
class Leads extends Admin_controller
{
    private $not_importable_leads_fields;

    public function __construct()
    {
        parent::__construct();
        $this->not_importable_leads_fields = do_action('not_importable_leads_fields', ['id', 'source', 'assigned', 'status', 'dateadded', 'last_status_change', 'addedfrom', 'leadorder', 'date_converted', 'lost', 'junk', 'is_imported_from_email_integration', 'email_integration_uid', 'is_public', 'dateassigned', 'client_id', 'lastcontact', 'last_lead_status', 'from_form_id', 'default_language']);
        $this->load->model('leads_model');
        $this->load->model('home_model');
    }


   /* public function update_lead_main_status_new($id = '')
    {
        $lead_info = $this->db->query("SELECT * from `tblleads` where enquiry_type_id > 0 ")->result();
        //$lead_info = $this->db->query("SELECT * from `tblleads` where id = 6095 ")->result();
        if(!empty($lead_info)){
            foreach ($lead_info as $value) {
                $enquiry_type_main_id = value_by_id('tblenquirytypemaster',$value->enquiry_type_id,'enquiry_type_main_id');
                $update_data = array(
                    'enquiry_type_main_id' => $enquiry_type_main_id
                );

                $this->home_model->update('tblleads',$update_data,array('id'=>$value->id));
            }
        }

    }*/

    /* List all leads */
    public function index($id = '')
    {
        check_permission(3,'view');

        //get_staff_state();
		close_setup_menu();
        /*if (!is_staff_member()) {
            access_denied('Leads');
        }*/

        $data['switch_kanban'] = true;

        if ($this->session->userdata('leads_kanban_view') == 'true') {
            $data['switch_kanban'] = false;
            $data['bodyclass']     = 'kan-ban-body';
        }

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        if (is_gdpr() && get_option('gdpr_enable_consent_for_leads') == '1') {
            $this->load->model('gdpr_model');
            $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
        }
        $data['summary']  = get_leads_summary();
        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();
        $data['title']    = _l('leads');
        // in case accesed the url leads/index/ directly with id - used in search
        $data['leadid'] = $id;
        //$this->load->view('admin/enquiry/manage', $data);
		$this->load->view('admin/leads/manage_leads', $data);
    }


    public function list()
    {
        check_permission(3,'view');


        $where = "id > 0";
        $status_where = "id > 0";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('lead_where');
                $this->session->unset_userdata('lead_where_status');
                $this->session->unset_userdata('lead_search');
            }else{
                if(!empty($client_id) || !empty($lead_type) || !empty($lead_source) || !empty($state) || !empty($city) || !empty($f_date) || !empty($t_date) || !empty($customer_company) || !empty($lead_no) || !empty($status)){
                    $this->session->unset_userdata('lead_where');
                    $this->session->unset_userdata('lead_where_status');
                    $this->session->unset_userdata('lead_search');
                    $sreach_arr = array();

                    if(!empty($lead_type)){
                        $sreach_arr['lead_type'] = $lead_type;
                        $where .= " and enquiry_type_id = '".$lead_type."'";
                        $status_where .= " and enquiry_type_id = '".$lead_type."'";
                    }

                    if(!empty($lead_source)){
                        $sreach_arr['lead_source'] = $lead_source;
                        $where .= " and source = '".$lead_source."'";
                        $status_where .= " and source = '".$lead_source."'";
                    }

                    if(!empty($status)){
                        $sreach_arr['status'] = $status;
                        $where .= " and status = '".$status."'";
                    }

                    if(!empty($state)){
                        $sreach_arr['state'] = $state;
                        $where .= " and site_state_id = '".$state."'";
                        $status_where .= " and site_state_id = '".$state."'";
                    }

                    if(!empty($city)){
                        $sreach_arr['city'] = $city;
                        $where .= " and site_city_id = '".$city."'";
                        $status_where .= " and site_city_id = '".$city."'";
                    }

                    if(!empty($customer_company)){
                        $sreach_arr['customer_company'] = $customer_company;
                        $where .= " and (company LIKE '%".$customer_company."%' || client_person_name LIKE '%".$customer_company."%')";
                        $status_where .= " and (company LIKE '%".$customer_company."%' || client_person_name LIKE '%".$customer_company."%')";
                    }

                    if(!empty($lead_no)){
                        $sreach_arr['lead_no'] = $lead_no;
                        $where .= " and (leadno LIKE '%".$lead_no."%')";
                        $status_where .= " and (leadno LIKE '%".$lead_no."%')";
                    }

                    if(!empty($client_id)){
                        $sreach_arr['client_id'] = $client_id;
                        $where .= " and client_id = '".$client_id."'";
                        $status_where .= " and client_id = '".$client_id."'";
                    }

                    if(!empty($f_date) && !empty($t_date)){
                        $sreach_arr['f_date'] = $f_date;
                        $sreach_arr['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and enquiry_date between '".$f_date."' and '".$t_date."' ";
                        $status_where .= " and enquiry_date between '".$f_date."' and '".$t_date."' ";
                    }

                    if(!empty($process)){
                        $sreach_arr['process'] = $process;
                        $i = 0;
                        $count = count($process);
                        foreach ($process as $p_id) {
                            if($count == 1){
                                 $where .= " and FIND_IN_SET('".$p_id."', process)";
                            }else{
                              $i++;
                                if($i == 1){
                                    $where .= " and ( FIND_IN_SET('".$p_id."', process)";
                                }elseif($i == $count){
                                    $where .= " || FIND_IN_SET('".$p_id."', process) )";
                                }else{
                                   $where .= " || FIND_IN_SET('".$p_id."', process)";
                                }
                            }


                        }
                    }
                    $this->session->set_userdata('lead_where',$where);
                    $this->session->set_userdata('lead_where_status',$status_where);
                    $this->session->set_userdata('lead_search',$sreach_arr);

                }

            }
        }else{
            if(!empty($this->session->userdata('lead_where'))){
                $where = $this->session->userdata('lead_where');
            }
            if(!empty($this->session->userdata('lead_where_status'))){
                $status_where = $this->session->userdata('lead_where_status');
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 25;
        $amount_filter = '';
        // Get record count
        $totalRec = $this->leads_model->get_lead_count($where, $amount_filter);

        // Pagination configuration
        $config['base_url']    = admin_url().'leads/list/';
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
        $data['lead_list'] = $this->leads_model->get_lead($where,$offset,$perPage,$amount_filter);
        //$data['lead_data'] = $this->leads_model->get_lead_search_details($where,$status_where);

        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` where status = 1 ORDER BY name ASC ")->result();
        $data['leadtype_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['state_info'] = $this->db->query("SELECT * from `tblstates` where status = 1 ORDER BY name ASC")->result();
        $data['city_info'] = $this->db->query("SELECT * from `tblcities` where status = 1 ORDER BY name ASC")->result();
        $data['status_info'] = $this->db->query("SELECT * from `tblleadsstatus` ORDER BY name ASC ")->result_array();
        $data['client_list'] = $this->db->query("SELECT * from `tblclientbranch` WHERE active = 1 ORDER BY client_branch_name ASC")->result();
        //$data['leadprocess'] = $this->db->query("SELECT * from tblleadprocess where status = '1' order by orders asc ")->result();

        $data['title'] = 'Leads List';
        $this->load->view('admin/leads/list', $data);

    }

    public function new_list()
    {
        check_permission(3,'view');

        $where = "l.id > 0 and l.created_at > '2021-03-31 23:59:59' ";
        $status_where = "l.id > 0 and l.created_at > '2021-03-31 23:59:59' ";
        $amount_filter = '';
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('lead_where');
                $this->session->unset_userdata('lead_where_status');
                $this->session->unset_userdata('lead_search');
                $this->session->unset_userdata('amount_filter');
            }else{

                if(!empty($client_id) || !empty($lead_type) || !empty($lead_source) || !empty($state) || !empty($city) || !empty($f_date) || !empty($t_date) || !empty($customer_company) || !empty($lead_no) || !empty($status) || !empty($enquiry_type_id) || !empty($f_amount) || !empty($t_amount)){
                    $this->session->unset_userdata('lead_where');
                    $this->session->unset_userdata('lead_where_status');
                    $this->session->unset_userdata('lead_search');
                    $this->session->unset_userdata('amount_filter');
                    $sreach_arr = array();

                    if(!empty($lead_type)){
                        $sreach_arr['lead_type'] = $lead_type;
                        $where .= " and l.enquiry_type_id = '".$lead_type."'";
                        $status_where .= " and l.enquiry_type_id = '".$lead_type."'";
                    }

                    if(!empty($lead_source)){
                        $sreach_arr['lead_source'] = $lead_source;
                        $where .= " and l.source = '".$lead_source."'";
                        $status_where .= " and l.source = '".$lead_source."'";
                    }

                    if(!empty($status)){
                        $sreach_arr['status'] = $status;
                        $where .= " and l.status = '".$status."'";
                    }

                    if(!empty($state)){
                        $sreach_arr['state'] = $state;
                        $where .= " and l.site_state_id = '".$state."'";
                        $status_where .= " and l.site_state_id = '".$state."'";
                    }

                    if(!empty($city)){
                        $sreach_arr['city'] = $city;
                        $where .= " and l.site_city_id = '".$city."'";
                        $status_where .= " and l.site_city_id = '".$city."'";
                    }

                    if(!empty($customer_company)){
                        $sreach_arr['customer_company'] = $customer_company;
                        $where .= " and (l.company LIKE '%".$customer_company."%' || l.client_person_name LIKE '%".$customer_company."%')";
                        $status_where .= " and (l.company LIKE '%".$customer_company."%' || l.client_person_name LIKE '%".$customer_company."%')";
                    }

                    if(!empty($lead_no)){
                        $sreach_arr['lead_no'] = $lead_no;
                        $where .= " and (l.leadno LIKE '%".$lead_no."%')";
                        $status_where .= " and (l.leadno LIKE '%".$lead_no."%')";
                    }

                    if(!empty($client_id)){
                        $sreach_arr['client_id'] = $client_id;
                        /*$where .= " and client_id = '".$client_id."'";
                        $status_where .= " and client_id = '".$client_id."'";*/
                        $where .= " and l.client_branch_id = '".$client_id."'";
                        $status_where .= " and l.client_branch_id = '".$client_id."'";
                    }

                    if(!empty($enquiry_type_id)){
                        $sreach_arr['enquiry_type_id'] = $enquiry_type_id;
                        $where .= " and l.enquiry_type_main_id = '".$enquiry_type_id."'";
                        $status_where .= " and l.enquiry_type_main_id = '".$enquiry_type_id."'";
                    }


                    if(!empty($f_date) && !empty($t_date)){
                        $sreach_arr['f_date'] = $f_date;
                        $sreach_arr['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and l.enquiry_date between '".$f_date."' and '".$t_date."' ";
                        $status_where .= " and l.enquiry_date between '".$f_date."' and '".$t_date."' ";
                    }

                    if (!empty($f_amount) && !empty($t_amount)){
                        $sreach_arr['f_amount'] = $f_amount;
                        $sreach_arr['t_amount'] = $t_amount;

                        $amount_filter .= " and p.total between '".$f_amount."' and '".$t_amount."' ";
                    }

                    if(!empty($process)){
                        $sreach_arr['process'] = $process;
                        $i = 0;
                        $count = count($process);
                        foreach ($process as $p_id) {
                            if($count == 1){
                                 $where .= " and FIND_IN_SET('".$p_id."', l.process)";
                            }else{
                              $i++;
                                if($i == 1){
                                    $where .= " and ( FIND_IN_SET('".$p_id."', l.process)";
                                }elseif($i == $count){
                                    $where .= " || FIND_IN_SET('".$p_id."', l.process) )";
                                }else{
                                   $where .= " || FIND_IN_SET('".$p_id."', l.process)";
                                }
                            }


                        }
                    }
                    $this->session->set_userdata('lead_where',$where);
                    $this->session->set_userdata('lead_where_status',$status_where);
                    $this->session->set_userdata('lead_search',$sreach_arr);
                    $this->session->set_userdata('amount_filter',$amount_filter);

                }

            }
        }else{
            if(!empty($this->session->userdata('lead_where'))){
                $where = $this->session->userdata('lead_where');
            }
            if(!empty($this->session->userdata('lead_where_status'))){
                $status_where = $this->session->userdata('lead_where_status');
            }
            if(!empty($this->session->userdata('amount_filter'))){
                $amount_filter = $this->session->userdata('amount_filter');
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 25;

        // Get record count
        $totalRec = $this->leads_model->get_lead_count($where, $amount_filter);
        
        // Pagination configuration
        $config['base_url']    = admin_url().'leads/new_list/';
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
        $data['lead_list'] = $this->leads_model->get_lead($where,$offset,$perPage, $amount_filter);
        // $data['lead_data'] = $this->leads_model->get_lead_search_details($where,$status_where);

        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` where status = 1 ORDER BY name ASC")->result();
        $data['mainleadtype_info'] = $this->db->query("SELECT * from `tblmainenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['leadtype_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['state_info'] = $this->db->query("SELECT * from `tblstates` where status = 1 ORDER BY name ASC")->result();
        $data['city_info'] = $this->db->query("SELECT * from `tblcities` where status = 1 ORDER BY name ASC")->result();
        $data['status_info'] = $this->db->query("SELECT * from `tblleadsstatus` ORDER BY name ASC")->result_array();
        $data['client_list'] = $this->db->query("SELECT * from `tblclientbranch` WHERE client_branch_name != '' and active = 1 ORDER BY client_branch_name ASC")->result();
        //$data['leadprocess'] = $this->db->query("SELECT * from tblleadprocess where status = '1' order by orders asc ")->result();

        $data['title'] = 'Leads List (SEPL/SLS/02)';
        $this->load->view('admin/leads/new_list', $data);
    }

    /* THIS IS FOR NEW LEAD LIST OF SERVER SIDE DATABASE */
    // public function new_list(){

    //     $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` where status = 1 ORDER BY name ASC")->result();
    //     $data['mainleadtype_info'] = $this->db->query("SELECT * from `tblmainenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
    //     $data['leadtype_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
    //     $data['state_info'] = $this->db->query("SELECT * from `tblstates` where status = 1 ORDER BY name ASC")->result();
    //     $data['city_info'] = $this->db->query("SELECT * from `tblcities` where status = 1 ORDER BY name ASC")->result();
    //     $data['status_info'] = $this->db->query("SELECT * from `tblleadsstatus` ORDER BY name ASC")->result_array();
    //     $data['client_list'] = $this->db->query("SELECT * from `tblclientbranch` WHERE client_branch_name != '' and active = 1 ORDER BY client_branch_name ASC")->result();
    //     $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result();
        
    //     $data['title'] = 'Leads List (SEPL/SLS/02)';
    //     $this->load->view('admin/leads/leads_data_list', $data);
    // }

    /* THIS IS FOR GET LEAD DATA THOUGH THE AJAX */
    public function lead_ajax_list()
    {
        $output = $this->leads_model->get_lead_list();

        //output to json format
        echo json_encode($output);
    }

    /*public function list()
    {
        check_permission(96,'view');

        $where = "id > 0";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($lead_type) || !empty($lead_source) || !empty($state) || !empty($city) || !empty($f_date) || !empty($t_date) || !empty($customer_company) ){

                if(!empty($lead_type)){
                    $data['lead_type'] = $lead_type;
                    $where .= " and enquiry_type_id = '".$lead_type."'";
                }

                if(!empty($lead_source)){
                    $data['lead_source'] = $lead_source;
                    $where .= " and source = '".$lead_source."'";
                }

                if(!empty($state)){
                    $data['state'] = $state;
                    $where .= " and site_state_id = '".$state."'";
                }

                if(!empty($city)){
                    $data['city'] = $city;
                    $where .= " and site_city_id = '".$city."'";
                }

                if(!empty($customer_company)){
                    $data['customer_company'] = $customer_company;
                    $where .= " and (company LIKE '%".$customer_company."%' || client_person_name LIKE '%".$customer_company."%')";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= " and enquiry_date between '".$f_date."' and '".$t_date."' ";
                }

            }
        }


        // Get records
        $data['lead_list'] = $this->db->query("SELECT * from `tblleads` where ".$where." order by id desc")->result();


        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ")->result();
        $data['leadtype_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ")->result();
        $data['state_info'] = $this->db->query("SELECT * from `tblstates` where status = 1 ")->result();
        $data['city_info'] = $this->db->query("SELECT * from `tblcities` where status = 1 ")->result();

        $data['title'] = 'Leads List';
        $this->load->view('admin/leads/list', $data);

    }*/

    public function export_lead()
    {
        $where = "id > 0";
        if(!empty($this->session->userdata('lead_where'))){
            $where = $this->session->userdata('lead_where');
        }
        $lead_list = $this->db->query("SELECT * from `tblleads` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/lead.xlsx';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Lead Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Lead');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Quotation');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Enq date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Source');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Contact Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Contact Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Contact Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Created');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($lead_list as $value)
        {
            $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

              if($value->client_branch_id > 0){
                  $company = $client_info->client_branch_name;
              }else{
                  $company = $value->company;
              }

              if(check_quotation($value->id) == 1){
                  $quotation = 'Yes';
              }else{
                  $quotation = 'No';
              }

            //getting last quotation amount
            $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
            if(!empty($quotation_info)){
                $amount = $quotation_info->total;
            }else{
                $amount = '0.00';
            }

            $contact_person_info = $this->db->query("SELECT c.firstname,c.email,c.phonenumber FROM `tblcontacts` as c LEFT JOIN tblenquiryclientperson as lc ON lc.contact_id = c.id where lc.enquiry_id = '".$value->id."' ")->row();

            $contact_name = '--';
            $contact_number = '--';
            $contact_email = '--';
            if(!empty($contact_person_info)){
                $contact_name = $contact_person_info->firstname;
                $contact_number = $contact_person_info->phonenumber;
                $contact_email = $contact_person_info->email;
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, number_series($value->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $company);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $quotation);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->enquiry_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, value_by_id('tblleadssources',$value->source,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, value_by_id('tblenquirytypemaster',$value->enquiry_type_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $amount);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $contact_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $contact_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $contact_email);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, _d($value->dateadded));

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function new_export_lead()
    {
        $where = "id > 0 and created_at > '2021-03-31 23:59:59' ";
        if(!empty($this->session->userdata('lead_where'))){
            $where = $this->session->userdata('lead_where');
        }
        $lead_list = $this->db->query("SELECT * from `tblleads` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/lead.xlsx';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Lead Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Lead');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Quotation');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Enq date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Source');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Contact Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Contact Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Contact Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Created');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Last Activity');
        $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'Last Activity On');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($lead_list as $value)
        {
            $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

              if($value->client_branch_id > 0){
                  $company = $client_info->client_branch_name;
              }else{
                  $company = $value->company;
              }

              if(check_quotation($value->id) == 1){
                  $quotation = 'Yes';
              }else{
                  $quotation = 'No';
              }

            //getting last quotation amount
            $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
            if(!empty($quotation_info)){
                $amount = $quotation_info->total;
            }else{
                $amount = '0.00';
            }

            $contact_person_info = $this->db->query("SELECT c.firstname,c.email,c.phonenumber FROM `tblcontacts` as c LEFT JOIN tblenquiryclientperson as lc ON lc.contact_id = c.id where lc.enquiry_id = '".$value->id."' ")->row();

            $contact_name = '--';
            $contact_number = '--';
            $contact_email = '--';
            if(!empty($contact_person_info)){
                $contact_name = $contact_person_info->firstname;
                $contact_number = $contact_person_info->phonenumber;
                $contact_email = $contact_person_info->email;
            }

            /* Lead Activity data */
            $lead_activity = $this->db->query("SELECT * FROM `tblfollowupleadactivity` WHERE lead_id= '".$value->id."' ORDER BY id DESC LIMIT 1")->row();
            $last_activity = (!empty($lead_activity)) ? cc($lead_activity->message) : '--';
            $last_activity_on = (!empty($lead_activity)) ? _d($lead_activity->date) : '--';

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, number_series($value->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $company);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $quotation);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->enquiry_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, value_by_id('tblleadssources',$value->source,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, value_by_id('tblenquirytypemaster',$value->enquiry_type_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $amount);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $contact_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $contact_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $contact_email);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, _d($value->dateadded));
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $last_activity);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $last_activity_on);

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

	/* public function leads($id = '') {

        if ($this->input->post()) {
            $unit_data = $this->input->post();

            if ($id == '') {
				$this->load->model('Leads_model');

                $id = $this->Leads_model->add($unit_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('enquiry')));
					if(isset($unit_data['send']))
					{
						redirect(admin_url('leads/index/'.$id.'#lead_approval'));
					}
					else
					{
						 redirect(admin_url('leads'));
					}
                }
            } else {
				$this->load->model('Leads_model');
                $success = $this->Leads_model->update($unit_data,$id);
                set_alert('success', _l('updated_successfully', _l('enquiry')));

				redirect(admin_url('leads'));

            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('enquiry_lowercase'));
        } else {
            $data['lead'] = $this->db->query('SELECT * FROM `tblleads` WHERE `id`="'.$id.'"')->row_array();
            $lead = $this->db->query('SELECT * FROM `tblleads` WHERE `id`="'.$id.'"')->row_array();
			$this->db->where('userid', $lead['client_id']);
			$clientbranchdata= $this->db->get('tblclientbranch')->row();
			$this->db->where('userid', $lead['client_id']);
			$data['contactall']= $this->db->get('tblcontacts')->result_array();

			$this->db->where('enquiry_id', $id);
			$data['productqnq']= $this->db->get('tblproductinquiry')->result_array();

			$this->db->where('lead_id', $id);
			$assignlist= $this->db->get('tblleadassignstaff')->result_array();

			$assignlist = array_column($assignlist, 'staff_id');
			$data['assignlist']= $assignlist;
			$this->db->where('id', $lead['site_id']);
			$sitedata= $this->db->get('tblsitemanager')->row();
			$this->db->where('enquiry_id', $id);
			$contactpersondata= $this->db->get('tblenquiryclientperson')->result_array();
			$contactpersondata=(array) $contactpersondata;
			$contactpersondata = array_column((array)$contactpersondata, 'contact_id');

			foreach($contactpersondata as $singleperson)
			{
				$this->db->where('id', $singleperson);
				$contactdata[]= $this->db->get('tblcontacts')->row_array();
				$contactdata= (array) $contactdata;
			}
			$data['contactdata']=$contactdata;
			$this->db->where('lead_id', $id);
			$staffassigndata= $this->db->get('tblleadassignstaff')->result_array();
			$staffassigndata=array_column($staffassigndata,'staff_id');
			$data['staffassigndata']=$staffassigndata;
			$data['lead_id']=$lead['id'];
			$data['lead']['clientbranch']=(array) $clientbranchdata;
			$data['lead']['sitedata']=(array) $sitedata;
            $title = _l('edit', _l('enquiry_lowercase'));
        }
        $data['title'] = $title;

		$this->load->model('Enquirytype_model');
		$data['enquiry_type'] = $this->Enquirytype_model->get();

		$this->load->model('Leads_model');
		$data['all_source'] = $this->Leads_model->get_source();

		$this->load->model('Enquiryfor_model');
		$data['enquiry_for'] = $this->Enquiryfor_model->get();

		$this->load->model('Site_manager_model');
		$data['all_site'] = $this->Site_manager_model->get();

		$this->load->model('Contact_type_model');
		$data['contact_type_data'] = $this->Contact_type_model->get();

		$this->load->model('Designation_model');
		$data['designation_data'] = $this->Designation_model->get();

		$this->load->model('Client_category_model');
		$data['client_category_data'] = $this->Client_category_model->get();

		$this->load->model('Site_manager_model');
		$data['state_data'] = $this->Site_manager_model->get_state();

		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
		$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
		$i=0;
		foreach($Staffgroup as $singlestaff)
		{
			$i++;
			$stafff[$i]['id']=$singlestaff['id'];
			$stafff[$i]['name']=$singlestaff['name'];
			$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
			$stafff[$i]['staffs']=$query;
		}
		$this->load->model('Staff_model');
		$data['allStaff'] = $this->Staff_model->get();
		$data['allStaffdata'] = $stafff;

		$this->load->model('Client_model');
		$data['client_data'] = $this->Client_model->get();
		$client_data = $this->Client_model->get();

		$i=0;
		foreach($client_data as $singleclient)
		{

			$query= $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `client_id`='".$singleclient['userid']."'")->result_array();
			if(count($query)>0)
			{
				$i++;
				$clientd[$i]['id']=$singleclient['userid'];
				$clientd[$i]['companyname']=$singleclient['company'];
				$clientd[$i]['compnybranch']=$query;
			}
		}
		//echo"<pre>";print_r($clientd);exit;
		$data['client_branch_data'] =$clientd;
		//$data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch`")->result_array();
		$client_branch_data = $this->db->query("SELECT * FROM `tblclientbranch`")->result_array();
		$data['lead_status'] = $this->Leads_model->get_status();
		$this->load->model('Designation_model');
		$data['designation_data'] = $this->Designation_model->get();
		$data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='Lead' group by p.id")->result_array();
		$data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
		 if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
		$data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities`")->result_array();
        $this->load->view('admin/enquiry/lead', $data);
    }*/

    public function table()
    {
        /*if (!is_staff_member()) {
            ajax_access_denied();
        }*/
        $this->app->get_table_data('leads');
    }

    public function kanban()
    {
        /*if (!is_staff_member()) {
            ajax_access_denied();
        }*/
        $data['statuses'] = $this->leads_model->get_status();
        echo $this->load->view('admin/leads/kan-ban', $data, true);
    }

    /* Add or update lead */
    public function lead($id = '')
    {
        /*if (!is_staff_member() || ($id != '' && !$this->leads_model->staff_can_access_lead($id))) {
            $this->access_denied_ajax();
        }*/



        if ($this->input->post()) {
            if ($id == '') {
                $id      = $this->leads_model->add($this->input->post());
                $message = $id ? _l('added_successfully', _l('lead')) : '';

                echo json_encode([
                    'success'  => $id ? true : false,
                    'id'       => $id,
                    'message'  => $message,
                    'leadView' => $id ? $this->_get_lead_data($id) : [],
                ]);
            } else {
                $emailOriginal   = $this->db->select('email')->where('id', $id)->get('tblleads')->row()->email;
                $proposalWarning = false;
                $message         = '';
                $success         = $this->leads_model->update($this->input->post(), $id);

                if ($success) {
                    $emailNow = $this->db->select('email')->where('id', $id)->get('tblleads')->row()->email;

                    $proposalWarning = (total_rows('tblproposals', [
                        'rel_type' => 'proposal',
                        'rel_id'   => $id, ]) > 0 && ($emailOriginal != $emailNow) && $emailNow != '') ? true : false;

                    $message = _l('updated_successfully', _l('lead'));
                }
                echo json_encode([
                    'success'          => $success,
                    'message'          => $message,
                    'id'               => $id,
                    'proposal_warning' => $proposalWarning,
                    'leadView'         => $this->_get_lead_data($id),
                ]);
            }
            die;
        }

        echo json_encode([
            'leadView' => $this->_get_lead_data($id),
        ]);
    }

    private function _get_lead_data($id = '')
    {
        $reminder_data       = '';
        $data['lead_locked'] = false;
        $data['lead_lock'] = false;
        $data['openEdit']        = $this->input->get('edit') ? true : false;
        $data['members']     = $this->staff_model->get('', ['is_not_staff' => 0, 'active' => 1]);
        $data['status_id']   = $this->input->get('status_id') ? $this->input->get('status_id') : get_option('leads_default_status');
		//$leaddata=$this->db->query("SELECT * FROM `tblleads` WHERE `id`='".$id."' AND `addedfrom`='".get_staff_user_id()."'")->row_array();
        $leaddata=$this->db->query("SELECT * FROM `tblleads` WHERE `id`='".$id."' ")->row_array();

		if(count($leaddata)==0)
		{
			$data['lead_lock'] =true;
		}
        if (is_numeric($id)) {

           // $leadWhere = (has_permission('leads', '', 'view') ? [] : '(`tblleadassignstaff`.`staff_id` =  ' . get_staff_user_id() . ' OR addedfrom=' . get_staff_user_id() . ' OR is_public=1)');
            $leadWhere = [];

            $lead = $this->leads_model->get($id, $leadWhere);

            if (!$lead) {
                header('HTTP/1.0 404 Not Found');
                echo _l('lead_not_found');
                die;
            }

            if (total_rows('tblclients', ['leadid' => $id ]) > 0) {
                $data['lead_locked'] = ((!is_admin() && get_option('lead_lock_after_convert_to_customer') == 1) ? true : false);
            }

            $reminder_data = $this->load->view('admin/includes/modals/reminder', [
                    'id'             => $lead->id,
                    'name'           => 'lead',
                    'members'        => $data['members'],
                    'reminder_title' => _l('lead_set_reminder_title'),
                ], true);

            $data['lead']          = $lead;
            $data['lead_data']     = $this->db->query("SELECT cb.client_branch_name,cb.email_id,cb.phone_no_1,cb.address,cb.state,cb.city,cb.zip,l.`source`,l.`status`,l.`created_at`,l.`site_id`,s.name as site_name,l.`reference`,l.`remark`,l.`product_remark`,l.enquiry_type_id,lt.name as lead_type,st.name as state_name,ct.name as city_name,ls.name as source,lst.name as statusname FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid  LEFT JOIN `tblsitemanager` s ON s.`id`=l.`site_id` LEFT JOIN `tblenquirytypemaster` lt ON lt.`id`=l.`enquiry_type_id` LEFT JOIN `tblstates` st ON st.id=cb.`state` LEFT JOIN `tblcities` ct ON ct.id=cb.`city`  LEFT JOIN `tblleadssources` ls ON ls.id=l.`source` LEFT JOIN `tblleadsstatus` lst ON lst.id=l.`status` WHERE l.`id`='".$id."'")->row();
            $data['lead_assign_data']= $this->db->query("SELECT s.firstname,s.email FROM `tblleadassignstaff` ast LEFT JOIN `tblstaff` s ON s.staffid=ast.`staff_id` WHERE `lead_id`='".$id."'")->result_array();
            $data['mail_activity'] = $this->leads_model->get_mail_activity($id);
            $data['notes']         = $this->misc_model->get_notes($id, 'lead');
            $data['activity_log']  = $this->leads_model->get_lead_activity_log($id);

            if (is_gdpr() && get_option('gdpr_enable_consent_for_leads') == '1') {
                $this->load->model('gdpr_model');
                $data['purposes'] = $this->gdpr_model->get_consent_purposes($lead->id, 'lead');
                $data['consents'] = $this->gdpr_model->get_consents(['lead_id' => $lead->id]);
            }
        }
        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();

		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->Staffgroup_model->get();

        //$Staffgroup = $this->Staffgroup_model->get_employee_group(get_staff_user_id());
        $Staffgroup =  get_staff_group(7,get_staff_user_id());
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
	    $data['assignlist']  = $this->db->query("SELECT s.* FROM `tblleadstaffapproval` ls LEFT JOIN `tblstaff` s oN ls.`staff_id`=s.staffid WHERE ls.`lead_id`='".$id."' GROUP BY s.`staffid`")->result_array();
		$data['leadid']= $id;
        $data = do_action('lead_view_data', $data);

        return [
            'data'          => $this->load->view('admin/leads/lead', $data, true),
            'reminder_data' => $reminder_data,
        ];
    }

    public function leads_kanban_load_more()
    {
        /*if (!is_staff_member()) {
            $this->access_denied_ajax();
        }*/

        $status = $this->input->get('status');
        $page   = $this->input->get('page');

        $this->db->where('id', $status);
        $status = $this->db->get('tblleadsstatus')->row_array();

        $leads = $this->leads_model->do_kanban_query($status['id'], $this->input->get('search'), $page, [
            'sort_by' => $this->input->get('sort_by'),
            'sort'    => $this->input->get('sort'),
        ]);

        foreach ($leads as $lead) {
            $this->load->view('admin/leads/_kan_ban_card', [
                'lead'   => $lead,
                'status' => $status,
            ]);
        }
    }

    public function switch_kanban($set = 0)
    {
        if ($set == 1) {
            $set = 'true';
        } else {
            $set = 'false';
        }
        $this->session->set_userdata([
            'leads_kanban_view' => $set,
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function export($id)
    {
        if (is_admin()) {
            export_lead_data($id);
        }
    }

    /* Delete lead from database */
    public function delete($id)
    {
        check_permission(3,'delete');
        if (!$id) {
            redirect(admin_url('leads'));
        }

        /*if (!is_lead_creator($id) && !has_permission('leads', '', 'delete')) {
            access_denied('Delte Lead');
        }*/

        $response = $this->leads_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('lead_lowercase')));
        } elseif ($response === true) {
            set_alert('success', _l('deleted', _l('lead')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('lead_lowercase')));
        }
        $ref = $_SERVER['HTTP_REFERER'];

        // if user access leads/inded/ID to prevent redirecting on the same url because will throw 404
        if (!$ref || strpos($ref, 'index/' . $id) !== false) {
            redirect(admin_url('leads'));
        }

        redirect($ref);
    }

    public function mark_as_lost($id)
    {
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }*/
        $message = '';
        $success = $this->leads_model->mark_as_lost($id);
        if ($success) {
            $message = _l('lead_marked_as_lost');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function unmark_as_lost($id)
    {
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }*/
        $message = '';
        $success = $this->leads_model->unmark_as_lost($id);
        if ($success) {
            $message = _l('lead_unmarked_as_lost');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function mark_as_junk($id)
    {
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }*/
        $message = '';
        $success = $this->leads_model->mark_as_junk($id);
        if ($success) {
            $message = _l('lead_marked_as_junk');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function unmark_as_junk($id)
    {
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }*/
        $message = '';
        $success = $this->leads_model->unmark_as_junk($id);
        if ($success) {
            $message = _l('lead_unmarked_as_junk');
        }
        echo json_encode([
            'success'  => $success,
            'message'  => $message,
            'leadView' => $this->_get_lead_data($id),
            'id'       => $id,
        ]);
    }

    public function add_activity()
    {
        $leadid = $this->input->post('leadid');
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($leadid)) {
            $this->access_denied_ajax();
        }*/
        if ($this->input->post()) {
            $message = $this->input->post('activity');
            $aId     = $this->leads_model->log_lead_activity($leadid, $message);
            if ($aId) {
                $this->db->where('id', $aId);
                $this->db->update('tblleadactivitylog', ['custom_activity' => 1]);
            }
            echo json_encode(['leadView' => $this->_get_lead_data($leadid), 'id' => $leadid]);
        }
    }

    public function add_activity_new()
    {
        $leadid = $this->input->post('leadid');
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($leadid)) {
            $this->access_denied_ajax();
        }*/
        if ($this->input->post()) {
            $message = $this->input->post('activity');
            $aId     = $this->leads_model->log_lead_activity($leadid, $message);
            if ($aId) {
                $this->db->where('id', $aId);
                $this->db->update('tblleadactivitylog', ['custom_activity' => 1]);
            }
            //echo json_encode(['leadView' => $this->_get_lead_data($leadid), 'id' => $leadid]);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function get_convert_data($id)
    {
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }*/
        if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1') {
            $this->load->model('gdpr_model');
            $data['purposes'] = $this->gdpr_model->get_consent_purposes($id, 'lead');
        }
        $data['lead'] = $this->leads_model->get($id);
        $this->load->view('admin/leads/convert_to_customer', $data);
    }

    /**
     * Convert lead to client
     * @since  version 1.0.1
     * @return mixed
     */
    public function convert_to_customer()
    {
        if (!is_staff_member()) {
            access_denied('Lead Convert to Customer');
        }

        if ($this->input->post()) {
            $default_country  = get_option('customer_default_country');
            $data             = $this->input->post();
            $data['password'] = $this->input->post('password', false);

            $original_lead_email = $data['original_lead_email'];
            unset($data['original_lead_email']);

            if (isset($data['transfer_notes'])) {
                $notes = $this->misc_model->get_notes($data['leadid'], 'lead');
                unset($data['transfer_notes']);
            }

            if (isset($data['transfer_consent'])) {
                $this->load->model('gdpr_model');
                $consents = $this->gdpr_model->get_consents(['lead_id' => $data['leadid']]);
                unset($data['transfer_consent']);
            }

            if (isset($data['merge_db_fields'])) {
                $merge_db_fields = $data['merge_db_fields'];
                unset($data['merge_db_fields']);
            }

            if (isset($data['merge_db_contact_fields'])) {
                $merge_db_contact_fields = $data['merge_db_contact_fields'];
                unset($data['merge_db_contact_fields']);
            }

            if (isset($data['include_leads_custom_fields'])) {
                $include_leads_custom_fields = $data['include_leads_custom_fields'];
                unset($data['include_leads_custom_fields']);
            }

            if ($data['country'] == '' && $default_country != '') {
                $data['country'] = $default_country;
            }

            $data['billing_street']  = $data['address'];
            $data['billing_city']    = $data['city'];
            $data['billing_state']   = $data['state'];
            $data['billing_zip']     = $data['zip'];
            $data['billing_country'] = $data['country'];

            $data['is_primary'] = 1;
            $id                 = $this->clients_model->add($data, true);
            if ($id) {
                $primary_contact_id = get_primary_contact_user_id($id);

                if (isset($notes)) {
                    foreach ($notes as $note) {
                        $this->db->insert('tblnotes', [
                            'rel_id'         => $id,
                            'rel_type'       => 'customer',
                            'dateadded'      => $note['dateadded'],
                            'addedfrom'      => $note['addedfrom'],
                            'description'    => $note['description'],
                            'date_contacted' => $note['date_contacted'],
                            ]);
                    }
                }
                if (isset($consents)) {
                    foreach ($consents as $consent) {
                        unset($consent['id']);
                        unset($consent['purpose_name']);
                        $consent['lead_id']    = 0;
                        $consent['contact_id'] = $primary_contact_id;
                        $this->gdpr_model->add_consent($consent);
                    }
                }
                if (!has_permission('customers', '', 'view') && get_option('auto_assign_customer_admin_after_lead_convert') == 1) {
                    $this->db->insert('tblcustomeradmins', [
                        'date_assigned' => date('Y-m-d H:i:s'),
                        'customer_id'   => $id,
                        'staff_id'      => get_staff_user_id(),
                    ]);
                }
                $this->leads_model->log_lead_activity($data['leadid'], 'not_lead_activity_converted', false, serialize([
                    get_staff_full_name(),
                ]));
                $default_status = $this->leads_model->get_status('', [
                    'isdefault' => 1,
                ]);
                $this->db->where('id', $data['leadid']);
                $this->db->update('tblleads', [
                    'date_converted' => date('Y-m-d H:i:s'),
                    'status'         => $default_status[0]['id'],
                    'junk'           => 0,
                    'lost'           => 0,
                ]);
                // Check if lead email is different then client email
                $contact = $this->clients_model->get_contact(get_primary_contact_user_id($id));
                if ($contact->email != $original_lead_email) {
                    if ($original_lead_email != '') {
                        $this->leads_model->log_lead_activity($data['leadid'], 'not_lead_activity_converted_email', false, serialize([
                            $original_lead_email,
                            $contact->email,
                        ]));
                    }
                }
                if (isset($include_leads_custom_fields)) {
                    foreach ($include_leads_custom_fields as $fieldid => $value) {
                        // checked don't merge
                        if ($value == 5) {
                            continue;
                        }
                        // get the value of this leads custom fiel
                        $this->db->where('relid', $data['leadid']);
                        $this->db->where('fieldto', 'leads');
                        $this->db->where('fieldid', $fieldid);
                        $lead_custom_field_value = $this->db->get('tblcustomfieldsvalues')->row()->value;
                        // Is custom field for contact ot customer
                        if ($value == 1 || $value == 4) {
                            if ($value == 4) {
                                $field_to = 'contacts';
                            } else {
                                $field_to = 'customers';
                            }
                            $this->db->where('id', $fieldid);
                            $field = $this->db->get('tblcustomfields')->row();
                            // check if this field exists for custom fields
                            $this->db->where('fieldto', $field_to);
                            $this->db->where('name', $field->name);
                            $exists               = $this->db->get('tblcustomfields')->row();
                            $copy_custom_field_id = null;
                            if ($exists) {
                                $copy_custom_field_id = $exists->id;
                            } else {
                                // there is no name with the same custom field for leads at the custom side create the custom field now
                                $this->db->insert('tblcustomfields', [
                                    'fieldto'        => $field_to,
                                    'name'           => $field->name,
                                    'required'       => $field->required,
                                    'type'           => $field->type,
                                    'options'        => $field->options,
                                    'display_inline' => $field->display_inline,
                                    'field_order'    => $field->field_order,
                                    'slug'           => slug_it($field_to . '_' . $field->name, [
                                        'separator' => '_',
                                    ]),
                                    'active'        => $field->active,
                                    'only_admin'    => $field->only_admin,
                                    'show_on_table' => $field->show_on_table,
                                    'bs_column'     => $field->bs_column,
                                ]);
                                $new_customer_field_id = $this->db->insert_id();
                                if ($new_customer_field_id) {
                                    $copy_custom_field_id = $new_customer_field_id;
                                }
                            }
                            if ($copy_custom_field_id != null) {
                                $insert_to_custom_field_id = $id;
                                if ($value == 4) {
                                    $insert_to_custom_field_id = get_primary_contact_user_id($id);
                                }
                                $this->db->insert('tblcustomfieldsvalues', [
                                    'relid'   => $insert_to_custom_field_id,
                                    'fieldid' => $copy_custom_field_id,
                                    'fieldto' => $field_to,
                                    'value'   => $lead_custom_field_value,
                                ]);
                            }
                        } elseif ($value == 2) {
                            if (isset($merge_db_fields)) {
                                $db_field = $merge_db_fields[$fieldid];
                                // in case user don't select anything from the db fields
                                if ($db_field == '') {
                                    continue;
                                }
                                if ($db_field == 'country' || $db_field == 'shipping_country' || $db_field == 'billing_country') {
                                    $this->db->where('iso2', $lead_custom_field_value);
                                    $this->db->or_where('short_name', $lead_custom_field_value);
                                    $this->db->or_like('long_name', $lead_custom_field_value);
                                    $country = $this->db->get('tblcountries')->row();
                                    if ($country) {
                                        $lead_custom_field_value = $country->country_id;
                                    } else {
                                        $lead_custom_field_value = 0;
                                    }
                                }
                                $this->db->where('userid', $id);
                                $this->db->update('tblclients', [
                                    $db_field => $lead_custom_field_value,
                                ]);
                            }
                        } elseif ($value == 3) {
                            if (isset($merge_db_contact_fields)) {
                                $db_field = $merge_db_contact_fields[$fieldid];
                                if ($db_field == '') {
                                    continue;
                                }
                                $this->db->where('id', $primary_contact_id);
                                $this->db->update('tblcontacts', [
                                    $db_field => $lead_custom_field_value,
                                ]);
                            }
                        }
                    }
                }
                // set the lead to status client in case is not status client
                $this->db->where('isdefault', 1);
                $status_client_id = $this->db->get('tblleadsstatus')->row()->id;
                $this->db->where('id', $data['leadid']);
                $this->db->update('tblleads', [
                    'status' => $status_client_id,
                ]);

                set_alert('success', _l('lead_to_client_base_converted_success'));

                if (is_gdpr() && get_option('gdpr_after_lead_converted_delete') == '1') {
                    $this->leads_model->delete($data['leadid']);

                    $this->db->where('userid', $id);
                    $this->db->update('tblclients', ['leadid' => null]);
                }

                logActivity('Created Lead Client Profile [LeadID: ' . $data['leadid'] . ', ClientID: ' . $id . ']');
                do_action('lead_converted_to_customer', ['lead_id' => $data['leadid'], 'customer_id' => $id]);
                redirect(admin_url('clients/client/' . $id));
            }
        }
    }

    /* Used in kanban when dragging and mark as */
    public function update_lead_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $this->leads_model->update_lead_status($this->input->post());
        }
    }

    public function update_lead_type()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());

            $enquirytypeid = value_by_id("tblleads", $leadid, "enquiry_type_id");
            $update_data = array(
                'enquiry_type_id' => $type
            );

            $this->home_model->update('tblleads',$update_data,array('id'=>$leadid));

            $enquiry_type = $this->db->query("SELECT * from `tblenquirytypemaster` where id = '".$type."' ")->row();

            /* THIS IS START ADD FOR ACTIVITY LOG */

                $old_status = value_by_id("tblenquirytypemaster", $enquirytypeid, "name");
                $message = 'Lead status changed from '.$old_status.' to '.$enquiry_type->name.' dated on '.date('d/m/Y H:i A');
                $ad_data = array(
                            'lead_id' => $leadid,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $this->home_model->insert('tblfollowupleadactivity',$ad_data);
            /* THIS IS END ADD FOR ACTIVITY LOG */

            $outputType = '<span class="inline-block label label-' . (empty($enquiry_type->color) ? 'default': '') . '" style="color:' . $enquiry_type->color . ';border:1px solid ' . $enquiry_type->color . '">' . cc($enquiry_type->name);
            $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
            $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $leadid . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
            $outputType .= '</a>';

            $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $leadid . '">';
            $enquiry_type_main_id = value_by_id("tblleads", $leadid, "enquiry_type_main_id");
            if ($enquiry_type_main_id > 0){
                $leadtype_info = $this->db->query("SELECT * from `tblenquirytypemaster` where enquiry_type_main_id = ".$enquiry_type_main_id." AND status = 1 ")->result();
            }else{
                $leadtype_info = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ")->result();
            }
            foreach ($leadtype_info as $leadChangeType) {
                if ($enquiry_type_id != $leadChangeType->id) {
                    $outputType .= '<li>
                  <a href="#" onclick="change_lead_type(' . $enquiry_type_id . ',' . $leadChangeType->id . ',' . $leadid . '); return false;">
                     ' . cc($leadChangeType->name) . '
                  </a>
               </li>';
                }
            }
            $outputType .= '</ul>';
            $outputType .= '</div>';
            $outputType .= '</span>';
            echo $outputType;
        }
    }

    public function update_lead_main_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());

            $enquirytypeid = value_by_id("tblleads", $leadid, "enquiry_type_main_id");
            $update_data = array(
                'enquiry_type_main_id' => $type
            );

            $this->home_model->update('tblleads',$update_data,array('id'=>$leadid));

            $main_enquiry_type = $this->db->query("SELECT * from `tblmainenquirytypemaster` where id = '".$type."' ")->row();

            /* THIS IS START ADD FOR ACTIVITY LOG */

                $old_status = value_by_id("tblenquirytypemaster", $enquirytypeid, "name");
                $message = 'Lead Main status changed from '.$old_status.' to '.$main_enquiry_type->name.' dated on '.date('d/m/Y H:i A');
                $ad_data = array(
                            'lead_id' => $leadid,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $this->home_model->insert('tblfollowupleadactivity',$ad_data);
            /* THIS IS END ADD FOR ACTIVITY LOG */

            $outputType = '<span class="inline-block label label-' . (empty($main_enquiry_type->color) ? 'default': '') . '" style="color:' . $main_enquiry_type->color . ';border:1px solid ' . $main_enquiry_type->color . '">' . $main_enquiry_type->name;
            $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
            $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tablemainLeadsStatus-' . $leadid . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
            $outputType .= '</a>';

            $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tablemainLeadsStatus-' . $leadid . '">';
            $mainleadtype_info = $this->db->query("SELECT * from `tblmainenquirytypemaster` where status = 1")->result();
            foreach ($mainleadtype_info as $mainleadChangeType) {
                if ($enquiry_type_id != $mainleadChangeType->id) {
                    $outputType .= '<li>
                  <a href="#" onclick="change_lead_main_status(' . $enquirytypeid . ',' . $mainleadChangeType->id . ',' . $leadid . '); return false;">
                     ' . cc($mainleadChangeType->name) . '
                  </a>
               </li>';
                }
            }
            $outputType .= '</ul>';
            $outputType .= '</div>';
            $outputType .= '</span>';

            $suboutputType = '<span class="inline-block label label-' . (empty($main_enquiry_type->color) ? 'default': '') . '" style="color: #fff;border:1px solid Black">';
            $suboutputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
            $suboutputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $leadid . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $suboutputType .= '<span data-toggle="tooltip" title="Change Lead Sub Status"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
            $suboutputType .= '</a>';
            $subtypeid = value_by_id("tblleads", $leadid, "enquiry_type_id");
            $suboutputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $leadid . '">';
            $leadtype_info = $this->db->query("SELECT * from `tblenquirytypemaster` where enquiry_type_main_id = ".$type." AND status = 1")->result();
            foreach ($leadtype_info as $leadChangeType) {
                    $suboutputType .= '<li>
                  <a href="#" onclick="change_lead_type('.$subtypeid.',' . $leadChangeType->id . ',' . $leadid . '); return false;">
                     ' . cc($leadChangeType->name) . '
                  </a>
               </li>';
            }
            $suboutputType .= '</ul>';
            $suboutputType .= '</div>';
            $suboutputType .= '</span>';
//            echo $outputType;
            echo json_encode(array("main_status" => $outputType, "sub_status" => $suboutputType));
        }
    }

    public function update_status_order()
    {
        if ($post_data = $this->input->post()) {
            $this->leads_model->update_status_order($post_data);
        }
    }

    public function add_lead_attachment()
    {
        $id       = $this->input->post('id');
        $lastFile = $this->input->post('last_file');

        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }*/

        handle_lead_attachments($id);
        echo json_encode(['leadView' => $lastFile ? $this->_get_lead_data($id) : [], 'id' => $id]);
    }

    public function add_external_attachment()
    {
        if ($this->input->post()) {
            $this->leads_model->add_attachment_to_database($this->input->post('lead_id'), $this->input->post('files'), $this->input->post('external'));
        }
    }

    public function delete_attachment($id)
    {
        /*if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }*/
        echo json_encode([
            'success' => $this->leads_model->delete_lead_attachment($id),
        ]);
    }

    public function delete_note($id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($id)) {
            $this->access_denied_ajax();
        }
        echo json_encode([
            'success' => $this->misc_model->delete_note($id),
        ]);
    }

    public function update_all_proposal_emails_linked_to_lead($id)
    {
        $success = false;
        $email   = '';
        if ($this->input->post('update')) {
            $this->load->model('proposals_model');

            $this->db->select('email');
            $this->db->where('id', $id);
            $email = $this->db->get('tblleads')->row()->email;

            $proposals = $this->proposals_model->get('', [
                'rel_type' => 'proposal',
                'rel_id'   => $id,
            ]);
            $affected_rows = 0;

            foreach ($proposals as $proposal) {
                $this->db->where('id', $proposal['id']);
                $this->db->update('tblproposals', [
                    'email' => $email,
                ]);
                if ($this->db->affected_rows() > 0) {
                    $affected_rows++;
                }
            }

            if ($affected_rows > 0) {
                $success = true;
            }
        }

        echo json_encode([
            'success' => $success,
            'message' => _l('proposals_emails_updated', [
                _l('lead_lowercase'),
                $email,
            ]),
        ]);
    }

    public function save_form_data()
    {
        $data = $this->input->post();

        // form data should be always sent to the request and never should be empty
        // this code is added to prevent losing the old form in case any errors
        if (!isset($data['formData']) || isset($data['formData']) && !$data['formData']) {
            echo json_encode([
                'success' => false,
            ]);
            die;
        }
        $this->db->where('id', $data['id']);
        $this->db->update('tblwebtolead', [
            'form_data' => $data['formData'],
        ]);
        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'success' => true,
                'message' => _l('updated_successfully', _l('web_to_lead_form')),
            ]);
        } else {
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function form($id = '')
    {
        if (!is_admin()) {
            access_denied('Web To Lead Access');
        }
        if ($this->input->post()) {
            if ($id == '') {
                $data = $this->input->post();
                $id   = $this->leads_model->add_form($data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('web_to_lead_form')));
                    redirect(admin_url('leads/form/' . $id));
                }
            } else {
                $success = $this->leads_model->update_form($id, $this->input->post());
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('web_to_lead_form')));
                }
                redirect(admin_url('leads/form/' . $id));
            }
        }

        $data['formData'] = [];
        $custom_fields    = get_custom_fields('leads', 'type != "link"');

        $cfields       = format_external_form_custom_fields($custom_fields);
        $data['title'] = _l('web_to_lead');

        if ($id != '') {
            $data['form'] = $this->leads_model->get_form([
                'id' => $id,
            ]);
            $data['title']    = $data['form']->name . ' - ' . _l('web_to_lead_form');
            $data['formData'] = $data['form']->form_data;
        }

        $this->load->model('roles_model');
        $data['roles']    = $this->roles_model->get();
        $data['sources']  = $this->leads_model->get_source();
        $data['statuses'] = $this->leads_model->get_status();

        $data['members'] = $this->staff_model->get('', [
            'active'       => 1,
            'is_not_staff' => 0,
        ]);

        $data['languages'] = $this->app->get_available_languages();
        $data['cfields']   = $cfields;

        $db_fields = [];
        $fields    = [
            'name',
            'title',
            'email',
            'phonenumber',
            'company',
            'address',
            'city',
            'state',
            'country',
            'zip',
            'description',
            'website',
        ];

        $fields = do_action('lead_form_available_database_fields', $fields);

        $className = 'form-control';

        foreach ($fields as $f) {
            $_field_object = new stdClass();
            $type          = 'text';
            $subtype       = '';
            if ($f == 'email') {
                $subtype = 'email';
            } elseif ($f == 'description' || $f == 'address') {
                $type = 'textarea';
            } elseif ($f == 'country') {
                $type = 'select';
            }

            if ($f == 'name') {
                $label = _l('lead_add_edit_name');
            } elseif ($f == 'email') {
                $label = _l('lead_add_edit_email');
            } elseif ($f == 'phonenumber') {
                $label = _l('lead_add_edit_phonenumber');
            } else {
                $label = _l('lead_' . $f);
            }

            $field_array = [
                'subtype'   => $subtype,
                'type'      => $type,
                'label'     => $label,
                'className' => $className,
                'name'      => $f,
            ];

            if ($f == 'country') {
                $field_array['values'] = [];
                $countries             = get_all_countries();
                foreach ($countries as $country) {
                    $selected = false;
                    if (get_option('customer_default_country') == $country['country_id']) {
                        $selected = true;
                    }
                    array_push($field_array['values'], [
                        'label'    => $country['short_name'],
                        'value'    => (int) $country['country_id'],
                        'selected' => $selected,
                    ]);
                }
            }

            if ($f == 'name') {
                $field_array['required'] = true;
            }

            $_field_object->label    = $label;
            $_field_object->name     = $f;
            $_field_object->fields   = [];
            $_field_object->fields[] = $field_array;
            $db_fields[]             = $_field_object;
        }
        $data['bodyclass'] = 'web-to-lead-form';
        $data['db_fields'] = $db_fields;
        $this->load->view('admin/leads/formbuilder', $data);
    }

    public function forms($id = '')
    {
        if (!is_admin()) {
            access_denied('Web To Lead Access');
        }

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('web_to_lead');
        }

        $data['title'] = _l('web_to_lead');
        $this->load->view('admin/leads/forms', $data);
    }

    public function delete_form($id)
    {
        if (!is_admin()) {
            access_denied('Web To Lead Access');
        }

        $success = $this->leads_model->delete_form($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('web_to_lead_form')));
        }

        redirect(admin_url('leads/forms'));
    }

    // Sources
    /* Manage leads sources */
    public function sources()
    {
        if (!is_admin()) {
            access_denied('Leads Sources');
        }
        $data['sources'] = $this->leads_model->get_source();
        $data['title']   = 'Leads sources';
        $this->load->view('admin/leads/manage_sources', $data);
    }

    /* Add or update leads sources */
    public function source()
    {
        if (!is_admin() && get_option('staff_members_create_inline_lead_source') == '0') {
            access_denied('Leads Sources');
        }
        if ($this->input->post()) {
            $data = $this->input->post();
            if (!$this->input->post('id')) {
                $inline = isset($data['inline']);
                if (isset($data['inline'])) {
                    unset($data['inline']);
                }

                $id = $this->leads_model->add_source($data);

                if (!$inline) {
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('lead_source')));
                    }
                } else {
                    echo json_encode(['success' => $id ? true : fales, 'id' => $id]);
                }
            } else {
                $id = $data['id'];
                unset($data['id']);
                $success = $this->leads_model->update_source($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('lead_source')));
                }
            }
        }
    }

    /* Delete leads source */
    public function delete_source($id)
    {
        if (!is_admin()) {
            access_denied('Delete Lead Source');
        }
        if (!$id) {
            redirect(admin_url('leads/sources'));
        }

        $query = $this->db->query("SELECT * FROM `tblenquirycall` Where source_id = '".$id."' ");
        if($query)
        {
           set_alert('warning', 'Already exist');
           redirect($_SERVER['HTTP_REFERER']); die;
        }

        $query1 = $this->db->query("SELECT * FROM `tblleads` Where source = '".$id."' ");
        if($query1)
        {
           set_alert('warning', 'Already exist');
           redirect($_SERVER['HTTP_REFERER']); die;
        }
        $query2 = $this->db->query("SELECT * FROM `tblproposals` WHERE find_in_set('".$id."',source) ");
        if($query2)
        {
           set_alert('warning', 'Already exist');
           redirect($_SERVER['HTTP_REFERER']); die;
        }

        $response = $this->leads_model->delete_source($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('lead_source_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('lead_source')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('lead_source_lowercase')));
        }
        redirect(admin_url('leads/sources'));
    }

    // Statuses
    /* View leads statuses */
    public function statuses()
    {
        if (!is_admin()) {
            access_denied('Leads Statuses');
        }
        $data['statuses'] = $this->leads_model->get_status();
        $data['title']    = 'Leads statuses';
        $this->load->view('admin/leads/manage_statuses', $data);
    }

    /* Add or update leads status */
    public function status()
    {
        if (!is_admin() && get_option('staff_members_create_inline_lead_status') == '0') {
            access_denied('Leads Statuses');
        }
        if ($this->input->post()) {
            $data = $this->input->post();
            if (!$this->input->post('id')) {
                $inline = isset($data['inline']);
                if (isset($data['inline'])) {
                    unset($data['inline']);
                }
                $id = $this->leads_model->add_status($data);
                if (!$inline) {
                    if ($id) {
                        set_alert('success', _l('added_successfully', _l('lead_status')));
                    }
                } else {
                    echo json_encode(['success' => $id ? true : fales, 'id' => $id]);
                }
            } else {
                $id = $data['id'];
                unset($data['id']);
                $success = $this->leads_model->update_status($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('lead_status')));
                }
            }
        }
    }

    /* Delete leads status from databae */
    public function delete_status($id)
    {
        if (!is_admin()) {
            access_denied('Leads Statuses');
        }
        if (!$id) {
            redirect(admin_url('leads/statuses'));
        }
        $response = $this->leads_model->delete_status($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('lead_status_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('lead_status')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('lead_status_lowercase')));
        }
        redirect(admin_url('leads/statuses'));
    }

    /* Add new lead note */
    public function add_note($rel_id)
    {
        if (!is_staff_member() || !$this->leads_model->staff_can_access_lead($rel_id)) {
            $this->access_denied_ajax();
        }

        if ($this->input->post()) {
            $data = $this->input->post();

            if ($data['contacted_indicator'] == 'yes') {
                $contacted_date         = to_sql_date($data['custom_contact_date'], true);
                $data['date_contacted'] = $contacted_date;
            }

            unset($data['contacted_indicator']);
            unset($data['custom_contact_date']);

            // Causing issues with duplicate ID or if my prefixed file for lead.php is used
            $data['description'] = isset($data['lead_note_description']) ? $data['lead_note_description'] : $data['description'];

            if (isset($data['lead_note_description'])) {
                unset($data['lead_note_description']);
            }

            $note_id = $this->misc_model->add_note($data, 'lead', $rel_id);

            if ($note_id) {
                if (isset($contacted_date)) {
                    $this->db->where('id', $rel_id);
                    $this->db->update('tblleads', [
                        'lastcontact' => $contacted_date,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $this->leads_model->log_lead_activity($rel_id, 'not_lead_activity_contacted', false, serialize([
                            get_staff_full_name(get_staff_user_id()),
                            _dt($contacted_date),
                        ]));
                    }
                }
            }
        }
        echo json_encode(['leadView' => $this->_get_lead_data($rel_id), 'id' => $rel_id]);
    }

    public function test_email_integration()
    {
        if (!is_admin()) {
            access_denied('Leads Test Email Integration');
        }

        require_once(APPPATH . 'third_party/php-imap/Imap.php');

        $mail = $this->leads_model->get_email_integration();
        $ps   = $mail->password;
        if (false == $this->encryption->decrypt($ps)) {
            set_alert('danger', _l('failed_to_decrypt_password'));
            redirect(admin_url('leads/email_integration'));
        }
        $mailbox    = $mail->imap_server;
        $username   = $mail->email;
        $password   = $this->encryption->decrypt($ps);
        $encryption = $mail->encryption;
        // open connection
        $imap = new Imap($mailbox, $username, $password, $encryption);

        if ($imap->isConnected() === false) {
            set_alert('danger', _l('lead_email_connection_not_ok') . '<br /><b>' . $imap->getError() . '</b>');
        } else {
            set_alert('success', _l('lead_email_connection_ok'));
        }

        redirect(admin_url('leads/email_integration'));
    }

    public function email_integration()
    {
        if (!is_admin()) {
            access_denied('Leads Email Intregration');
        }
        if ($this->input->post()) {
            $data             = $this->input->post();
            $data['password'] = $this->input->post('password', false);

            if (isset($data['fakeusernameremembered'])) {
                unset($data['fakeusernameremembered']);
            }
            if (isset($data['fakepasswordremembered'])) {
                unset($data['fakepasswordremembered']);
            }

            $success = $this->leads_model->update_email_integration($data);
            if ($success) {
                set_alert('success', _l('leads_email_integration_updated'));
            }
            redirect(admin_url('leads/email_integration'));
        }
        $data['roles']    = $this->roles_model->get();
        $data['sources']  = $this->leads_model->get_source();
        $data['statuses'] = $this->leads_model->get_status();

        $data['members'] = $this->staff_model->get('', [
            'active'       => 1,
            'is_not_staff' => 0,
        ]);

        $data['title']     = _l('leads_email_integration');
        $data['mail']      = $this->leads_model->get_email_integration();
        $data['bodyclass'] = 'leads-email-integration';
        $this->load->view('admin/leads/email_integration', $data);
    }

    public function change_status_color()
    {
        if ($this->input->post()) {
            $this->leads_model->change_status_color($this->input->post());
        }
    }

    public function import()
    {
        if (!is_admin() && get_option('allow_non_admin_members_to_import_leads') != '1') {
            access_denied('Leads Import');
        }

        $simulate_data  = [];
        $total_imported = 0;
        if ($this->input->post()) {
            $simulate = $this->input->post('simulate');
            if (isset($_FILES['file_csv']['name']) && $_FILES['file_csv']['name'] != '') {
                // Get the temp file path
                $tmpFilePath = $_FILES['file_csv']['tmp_name'];
                // Make sure we have a filepath
                if (!empty($tmpFilePath) && $tmpFilePath != '') {
                    // Setup our new file path
                    $newFilePath = TEMP_FOLDER . $_FILES['file_csv']['name'];
                    if (!file_exists(TEMP_FOLDER)) {
                        mkdir(TEMP_FOLDER, 0777);
                    }
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $import_result = true;
                        $fd            = fopen($newFilePath, 'r');
                        $rows          = [];
                        while ($row = fgetcsv($fd)) {
                            $rows[] = $row;
                        }
                        fclose($fd);
                        $data['total_rows_post'] = count($rows);
                        if (count($rows) <= 1) {
                            set_alert('warning', 'Not enought rows for importing');
                            redirect(admin_url('leads/import'));
                        }

                        unset($rows[0]);
                        if ($simulate) {
                            if (count($rows) > 500) {
                                set_alert('warning', 'Recommended splitting the CSV file into smaller files. Our recomendation is 500 row, your CSV file has ' . count($rows));
                            }
                        }
                        $db_temp_fields = $this->db->list_fields('tblleads');
                        array_push($db_temp_fields, 'tags');

                        $db_fields = [];
                        foreach ($db_temp_fields as $field) {
                            if (in_array($field, $this->not_importable_leads_fields)) {
                                continue;
                            }
                            $db_fields[] = $field;
                        }
                        $custom_fields = get_custom_fields('leads');
                        $_row_simulate = 0;
                        foreach ($rows as $row) {
                            // do for db fields
                            $insert = [];
                            for ($i = 0; $i < count($db_fields); $i++) {
                                // Avoid errors on nema field. is required in database
                                if ($db_fields[$i] == 'name' && $row[$i] == '') {
                                    $row[$i] = '/';
                                } elseif ($db_fields[$i] == 'country') {
                                    if ($row[$i] != '') {
                                        if (!is_numeric($row[$i])) {
                                            $this->db->where('iso2', $row[$i]);
                                            $this->db->or_where('short_name', $row[$i]);
                                            $this->db->or_where('long_name', $row[$i]);
                                            $country = $this->db->get('tblcountries')->row();
                                            if ($country) {
                                                $row[$i] = $country->country_id;
                                            } else {
                                                $row[$i] = 0;
                                            }
                                        }
                                    } else {
                                        $row[$i] = 0;
                                    }
                                }
                                if ($row[$i] === 'NULL' || $row[$i] === 'null') {
                                    $row[$i] = '';
                                }
                                $insert[$db_fields[$i]] = $row[$i];
                            }

                            if (count($insert) > 0) {
                                if (isset($insert['email']) && $insert['email'] != '') {
                                    if (total_rows('tblleads', ['email' => $insert['email']]) > 0) {
                                        continue;
                                    }
                                }
                                $total_imported++;
                                $insert['dateadded'] = date('Y-m-d H:i:s');
                                $insert['addedfrom'] = get_staff_user_id();
                                //   $insert['lastcontact'] = null;
                                $insert['status'] = $this->input->post('status');
                                $insert['source'] = $this->input->post('source');
                                if ($this->input->post('responsible')) {
                                    $insert['assigned'] = $this->input->post('responsible');
                                }
                                if (!$simulate) {
                                    foreach ($insert as $key => $val) {
                                        $insert[$key] = trim($val);
                                    }
                                    if (isset($insert['tags'])) {
                                        $tags = $insert['tags'];
                                        unset($insert['tags']);
                                    }
                                    $this->db->insert('tblleads', $insert);
                                    $leadid = $this->db->insert_id();
                                } else {
                                    if ($insert['country'] != 0) {
                                        $c = get_country($insert['country']);
                                        if ($c) {
                                            $insert['country'] = $c->short_name;
                                        }
                                    } else {
                                        $insert['country'] = '';
                                    }
                                    $simulate_data[$_row_simulate] = $insert;
                                    $leadid                        = true;
                                }
                                if ($leadid) {
                                    if (!$simulate) {
                                        handle_tags_save($tags, $leadid, 'lead');
                                    }
                                    $insert = [];
                                    foreach ($custom_fields as $field) {
                                        if (!$simulate) {
                                            if ($row[$i] != '' && $row[$i] !== 'NULL' && $row[$i] !== 'null') {
                                                $this->db->insert('tblcustomfieldsvalues', [
                                                    'relid'   => $leadid,
                                                    'fieldid' => $field['id'],
                                                    'value'   => trim($row[$i]),
                                                    'fieldto' => 'leads',
                                                ]);
                                            }
                                        } else {
                                            $simulate_data[$_row_simulate][$field['name']] = $row[$i];
                                        }
                                        $i++;
                                    }
                                }
                            }
                            $_row_simulate++;
                            if ($simulate && $_row_simulate >= 100) {
                                break;
                            }
                        }
                        unlink($newFilePath);
                    }
                } else {
                    set_alert('warning', _l('import_upload_failed'));
                }
            }
        }
        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();

        $data['members'] = $this->staff_model->get('', ['is_not_staff' => 0, 'active' => 1]);

        if (count($simulate_data) > 0) {
            $data['simulate'] = $simulate_data;
        }

        if (isset($import_result)) {
            set_alert('success', _l('import_total_imported', $total_imported));
        }

        $data['not_importable'] = $this->not_importable_leads_fields;
        $data['title']          = _l('import');
        $this->load->view('admin/leads/import', $data);
    }

    public function email_exists()
    {
        if ($this->input->post()) {
            // First we need to check if the email is the same
            $leadid = $this->input->post('leadid');

            if ($leadid != '') {
                $this->db->where('id', $leadid);
                $_current_email = $this->db->get('tblleads')->row();
                if ($_current_email->email == $this->input->post('email')) {
                    echo json_encode(true);
                    die();
                }
            }
            $exists = total_rows('tblleads', [
                'email' => $this->input->post('email'),
            ]);
            if ($exists > 0) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    public function bulk_action()
    {
        if (!is_staff_member()) {
            $this->access_denied_ajax();
        }

        do_action('before_do_bulk_action_for_leads');
        $total_deleted = 0;
        if ($this->input->post()) {
            $ids                   = $this->input->post('ids');
            $status                = $this->input->post('status');
            $source                = $this->input->post('source');
            $assigned              = $this->input->post('assigned');
            $visibility            = $this->input->post('visibility');
            $tags                  = $this->input->post('tags');
            $last_contact          = $this->input->post('last_contact');
            $has_permission_delete = has_permission('leads', '', 'delete');
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    if ($this->input->post('mass_delete')) {
                        if ($has_permission_delete) {
                            if ($this->leads_model->delete($id)) {
                                $total_deleted++;
                            }
                        }
                    } else {
                        if ($status || $source || $assigned || $last_contact || $visibility) {
                            $update = [];
                            if ($status) {
                                // We will use the same function to update the status
                                $this->leads_model->update_lead_status([
                                    'status' => $status,
                                    'leadid' => $id,
                                ]);
                            }
                            if ($source) {
                                $update['source'] = $source;
                            }
                            if ($assigned) {
                                $update['assigned'] = $assigned;
                            }
                            if ($last_contact) {
                                $last_contact          = to_sql_date($last_contact, true);
                                $update['lastcontact'] = $last_contact;
                            }

                            if ($visibility) {
                                if ($visibility == 'public') {
                                    $update['is_public'] = 1;
                                } else {
                                    $update['is_public'] = 0;
                                }
                            }

                            if (count($update) > 0) {
                                $this->db->where('id', $id);
                                $this->db->update('tblleads', $update);
                            }
                        }
                        if ($tags) {
                            handle_tags_save($tags, $id, 'lead');
                        }
                    }
                }
            }
        }

        if ($this->input->post('mass_delete')) {
            set_alert('success', _l('total_leads_deleted', $total_deleted));
        }
    }
	public function sendapproval()
    {
		$staffid=$this->input->post('staffid');
		$leadid=$this->input->post('leadid');
		foreach($staffid as $singlelead)
		{
			$ldata['staff_id']=$singlelead;
			$ldata['lead_id']=$leadid;
			$ldata['status']=1;
			$ldata['created_at'] = date("Y-m-d H:i:s");
			$ldata['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert('tblleadstaffapproval',$ldata);
			//echo $this->db->last_query();
			$this->load->model('Leads_model');
			echo $this->Leads_model->lead_approval_member_notification($leadid, $singlelead);
		}

		$lddata['lead_send']=1;
		$this->db->where('id', $leadid);
		$this->db->update('tblleads', $lddata);
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
        //$this->db->update('tblleadstaffapproval', $ldata);
		$this->db->update('tblleadassignstaff', $ldata);
		$this->load->model('Leads_model');
		if($approve_status==1)
		{
		  $this->Leads_model->lead_accept_member_notification($leadid, $leadcreatorid);
		}
		else
		{
			$this->Leads_model->lead_decline_member_notification($leadid, $leadcreatorid);
		}
		exit;
	}
	public function deletelead($id)
    {
		$this->db->where('id', $id);
        $this->db->delete('tblenquiry');
		$this->db->where('enquiry_id', $id);
		$this->db->delete('tblenquiryclientperson');
		$this->db->where('lead_id', $id);
		$this->db->delete('tblleadassignstaff');
		$this->db->where('enquiry_id', $id);
		$this->db->delete('tblproductinquiry');
	    set_alert('success', _l('deleted', _l('enquiry')));
		redirect(admin_url('enquiry'));
	}
    private function access_denied_ajax()
    {
        header('HTTP/1.0 404 Not Found');
        echo _l('access_denied');
        die;
    }



    public function leads($id = '') {

        check_permission(3,'create');

        if ($this->input->post()) {
            $unit_data = $this->input->post();
            /*echo '<pre/>';
            print_r($unit_data);
            die;*/

            $unit_data = nestedUppercase($unit_data);


            if ($id == '') {
                $this->load->model('Leads_model');
                $token = $this->input->post('form_token');
                $token_info = $this->db->query('SELECT * FROM `tblleads` WHERE `token_id`="'.$token.'"')->row();
                if(empty($token_info))
                {
                   $id = $this->Leads_model->add($unit_data);
                }
                else
                {
                   set_alert('warning', _l('Details Are Already Submitted', _l('enquiry')));
                   redirect(admin_url('leads/new_list'));
                }

                if ($id) {
                    set_alert('success', _l('added_successfully', _l('enquiry')));
                    if(isset($unit_data['send']))
                    {
                        redirect(admin_url('leads/index/'.$id.'#lead_approval'));
                    }
                    else
                    {
                         redirect(admin_url('leads/new_list'));
                    }
                }
            } else {
                check_permission(3,'edit');

                $this->load->model('Leads_model');
                $success = $this->Leads_model->update($unit_data,$id);

                //Update all the quotation address
                update_quotation_billto_datails($id);

                set_alert('success', _l('updated_successfully', _l('enquiry')));

                redirect(admin_url('leads/new_list'));

            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('enquiry_lowercase'));
            $data["section_type"] = "add";

            $this->load->model('Enquirytype_model');
            $data['enquiry_type'] = $this->Enquirytype_model->get();

        } else {
            $data["section_type"] = "update";

            $data['lead'] = $this->db->query('SELECT * FROM `tblleads` WHERE `id`="'.$id.'"')->row_array();
            $lead = $this->db->query('SELECT * FROM `tblleads` WHERE `id`="'.$id.'"')->row_array();
            $this->db->where('userid', $lead['client_id']);
            $this->db->order_by('client_branch_name', 'ASC');
            $clientbranchdata= $this->db->get('tblclientbranch')->row();
            $this->db->where('userid', $lead['client_id']);
            $this->db->order_by('firstname', 'ASC');
            $data['contactall']= $this->db->get('tblcontacts')->result_array();

            $this->db->where('enquiry_id', $id);
            $data['productqnq']= $this->db->get('tblproductinquiry')->result_array();

            $this->db->where('lead_id', $id);
            $assignlist= $this->db->get('tblleadassignstaff')->result_array();

            $assignlist = array_column($assignlist, 'staff_id');
            $data['assignlist']= $assignlist;
            $this->db->where('id', $lead['site_id']);
            $this->db->order_by('name', 'ASC');
            $sitedata= $this->db->get('tblsitemanager')->row();
            $this->db->where('enquiry_id', $id);
            $contactpersondata= $this->db->get('tblenquiryclientperson')->result_array();
            $contactpersondata=(array) $contactpersondata;
            $contactpersondata = array_column((array)$contactpersondata, 'contact_id');

            foreach($contactpersondata as $singleperson)
            {
                $this->db->where('id', $singleperson);
                $contactdata[]= $this->db->get('tblcontacts')->row_array();
                $contactdata= (array) $contactdata;
            }
            $data['contactdata']=$contactdata;
            $this->db->where('lead_id', $id);
            $staffassigndata= $this->db->get('tblleadassignstaff')->result_array();
            $staffassigndata=array_column($staffassigndata,'staff_id');
            $data['staffassigndata']=$staffassigndata;
            $data['lead_id']=$lead['id'];
            $data['lead']['clientbranch']=(array) $clientbranchdata;
            $data['lead']['sitedata']=(array) $sitedata;
            $title = _l('edit', _l('enquiry_lowercase'));

            $data['enquiry_type'] = $this->db->query("SELECT * FROM `tblenquirytypemaster` WHERE enquiry_type_main_id = ".$data['lead']['enquiry_type_main_id']." AND status = 1 ")->result_array();
        }
        $data['title'] = $title;


        $this->load->model('Leads_model');
        //$data['all_source'] = $this->Leads_model->get_source();
        $data['all_source'] = $this->db->query("SELECT * from `tblleadssources` where status = 1 ORDER BY `name` ASC ")->result_array();

        $this->load->model('Enquiryfor_model');
        $data['enquiry_for'] = $this->Enquiryfor_model->get();

        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();

        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();

        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();

        $this->load->model('Client_category_model');
        $data['client_category_data'] = $this->Client_category_model->get();

        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();

        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
        $i=0;
        $stafff = array();
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $this->load->model('Staff_model');
        $data['allStaff'] = $this->Staff_model->get();
        $data['allStaffdata'] = $stafff;

        $data['client_branch_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `client_branch_name`!='' AND `active`=1 ORDER BY `client_branch_name` ASC ")->result();
        //$data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch`")->result_array();
        $client_branch_data = $this->db->query("SELECT * FROM `tblclientbranch` ORDER BY client_branch_name ASC")->result_array();
        $data['lead_status'] = $this->Leads_model->get_status();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();
        /*$data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='Lead' group by p.id")->result_array();*/

        // Getting Main products and Temp Products In Single Array
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
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }

        $data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
         if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
        $data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities` ORDER BY name ASC")->result_array();

        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ORDER BY name ASC")->result_array();

        $data['lead_category_list'] = $this->db->query("SELECT * FROM `tblmainenquirytypemaster` WHERE status = 1 ORDER BY name ASC ")->result_array();

        $this->load->view('admin/enquiry/lead', $data);
    }


    public function change_followup_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'followup' => $status
            );

            $this->home_model->update('tblleads',$update_data,array('id'=>$id));
        }
    }



    public function lead_process($id = '')
    {


        //get_staff_state();
		close_setup_menu();
        if (!is_staff_member()) {
            access_denied('Leads');
        }

       /* if ($this->session->userdata('leads_kanban_view') == 'true') {
            $data['switch_kanban'] = false;
            $data['bodyclass']     = 'kan-ban-body';
        }

        $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        if (is_gdpr() && get_option('gdpr_enable_consent_for_leads') == '1') {
            $this->load->model('gdpr_model');
            $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
        }
        $data['summary']  = get_leads_summary();
        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();
        $data['title']    = _l('leads');*/
        // in case accesed the url leads/index/ directly with id - used in search
        $data['leadid'] = ' ';

		$this->load->view('admin/enquiry/lead_process', $data);
    }


    public function lead_contact($id = '')
    {

    	$data['contact_info'] = $this->db->query("SELECT c.* from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$id."' and c.phonenumber != ''")->result();
    	$number_list = $this->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$id."' ")->result();


    	$numbers = '';
    	if(!empty($number_list)){
    		$i = 0;
    		foreach ($number_list as $no) {
    			if($i == 0){
    				$numbers .= $no->phonenumber;
    			}else{
    				$numbers .= ','.$no->phonenumber;
    			}
    			$i++;
    		}
    	}

        if(!empty($numbers)){
            $where = "customer_number IN (".$numbers.")";
        $data['call_history'] = $this->db->query("SELECT * from tblcalloutgoing where ".$where." order by id desc ")->result();
        }

        $keys_info  = $this->db->query("SELECT `staffid`,`callingnumber` FROM tblstaff WHERE staffid = '".get_staff_user_id()."' ")->row();
        if(!empty($keys_info) && !empty($keys_info->callingnumber)){
            $data['calling_numbes'] = $this->db->query("SELECT * from tblvagentnumbers  where status = 1 and id IN (".$keys_info->callingnumber.") group by exotel_number order by id asc")->result();
        }

    	$data['lead_id'] = $id;
    	$data['title'] = 'Leads Contacts';
        $this->load->view('admin/leads/lead_contact', $data);
    }

    public function make_call()
    {
    	$agent_number = get_employee_info(get_staff_user_id())->phonenumber;
    	if(!empty($_POST)){
            extract($this->input->post());
            /*$api_info = $this->db->query("SELECT * from tblvagentkeys  where id = '".$api_id."' ")->row();

            if(!empty($agent_number)){
               $link = 'http://c2c.minavo.in/make-call-c2n.php?mobile1='.$agent_number.'&mobile2='.$customer_number.'&apikey='.$api_info->api_key.'&secret='.$api_info->secret.'';

               $payload = file_get_contents($link);
               $response = json_decode($payload);
                $status = 'status:';
                $error = 'error:';
               if($response->$status == 'Fail'){
                    set_alert('danger', $response->$error);
               }else{
                    set_alert('success', 'Your call will initiate shortly');
               }
            }else{
                set_alert('danger', 'Your mobile is not updated!');
            }*/

            $StatusCallback = base_url().'vagent/get_outgoing';
            $data = [
               'From' => $agent_number,
               'To' => $customer_number,
               'CallerId' => $exotel_number,
               'StatusCallback' => $StatusCallback,
               'StatusCallbackEvents[0]' => 'terminal',
            ];

            $makeCall = makeCall($data);

            set_alert('success', 'Your call will initiate shortly');
        }



    	redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_segment()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $product_info = $this->db->query("SELECT * from tblproducts where id = '".$product_id."' ")->row();
            $temp_product_info = $this->db->query("SELECT * from tbltemperoryproduct where id = '".$product_id."' ")->row();


            $html = '';
            $temp = 0;
            if ($is_temp == 0){
                if (!empty($product_info)) {
                    if ($product_info->product_cat_id > 0) {
                        $html .= '<div class="bg-primary text-white text-center" style="width: 200px;height: auto;">' . value_by_id('tblproductcategory', $product_info->product_cat_id, 'name') . '</div>';
                    }
                    if ($product_info->product_sub_cat_id > 0) {
                        $html .= '<div class="bg-success text-white text-center" style="width: 200px;height: auto;">' . value_by_id('tblproductsubcategory', $product_info->product_sub_cat_id, 'name') . '</div>';
                    }
                    if ($product_info->parent_category_id > 0) {
                        $html .= '<div class="bg-warning text-white text-center" style="width: 200px;height: auto;">' . value_by_id('tblproductparentcategory', $product_info->parent_category_id, 'name') . '</div>';
                    }
                    if ($product_info->child_category_id > 0) {
                        $html .= '<div class="bg-info text-white text-center" style="width: 200px;height: auto;">' . value_by_id('tblproductchildcategory', $product_info->child_category_id, 'name') . '</div>';
                    }
                }
            }
            else{
                if(!empty($temp_product_info)){
                    $product_temp_name = $temp_product_info->product_name.temp_product_code($product_id);
                    if($is_temp == 1){
                        $temp = '1';
                        $html = '<div class="bg-warning text-white text-center" style="width: 200px;height: auto;">Product For Quotation</div>';
                    }
                }
            }
            echo json_encode(array('html'=>$html,'temp'=>$temp));


        }
    }


    public function get_lead_process()
    {
        if(!empty($_POST)){
          extract($this->input->post());
          $leadprocess_info = $this->db->query("SELECT * from tblleadprocess where status = '1' order by orders asc ")->result();
          $notinterest_info = $this->db->query("SELECT * from tblleadnot_interest where status = '1' order by order_by asc ")->result();
          $lead = $this->db->query("SELECT * from tblleads where id = '".$lead_id."' ")->row();
          $process_arr = explode(',',$lead->process);
            ?>


            <?php
          if(!empty($leadprocess_info)){
            foreach ($leadprocess_info as $val) {
                ?>
                <p class="staus_process" style="background: <?php if(in_array($val->id, $process_arr)){ echo '#46A049'; }else{ echo '#757575'; }?>;"><input <?php if(in_array($val->id, $process_arr)){ echo 'checked'; }?> class="process" type="checkbox" name="process[]" val="<?php echo $lead_id; ?>" value="<?php echo $val->id; ?>"> <?php echo $val->name; ?></p>
                <?php
            }
          }
          ?>


            <div id="notintrestdiv<?php echo $lead_id; ?>"  <?php if(!in_array(12, $process_arr)){ echo 'hidden'; }?>>
                <label for="not_interested" class="control-label">Select Reason</label>
                <select class="form-control" id="not_interested" name="not_interested" onchange="check_other_remark(<?php echo $lead_id; ?>,this.value)">
                    <option value=""></option>
                    <?php
                    if (!empty($notinterest_info)) {
                        foreach ($notinterest_info as $r)
                        {
                        ?>
                            <option value="<?php echo $r->id; ?>" <?php if($lead->not_interested == $r->id){ echo 'selected'; } ?>><?php echo $r->name; ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div id="notintrestrmkdiv<?php echo $lead_id; ?>" <?php if($lead->not_interested != '6'){ echo 'hidden'; } ?>>
                <label for="not_interested_other" class="control-label">Other Remark</label>
                <textarea id="not_interested_other" style="height: 110px;" name="not_interested_other" class="form-control"><?php echo (isset($lead->not_interested_other) && $lead->not_interested_other != "") ? $lead->not_interested_other : "" ?></textarea>
            </div>


            <input type="hidden" value="<?php echo $lead_id; ?>" name="lead_id">


          <?php

        }
    }

    public function update_process()
    {
        if(!empty($_POST)){
          extract($this->input->post());
          /*echo '<pre/>';
          print_r($_POST);
          die;*/

          if(!empty($process)){
            if(empty($not_interested)){
                $not_interested = 0;
            }
            if(empty($not_interested_other)){
                $not_interested_other = "";
            }

            if(!in_array(12, $process)){
                $not_interested_other = ' ';
            }

            $process_str = implode(",",$process);


            $update_data = array(
                'process' => $process_str,
                'not_interested' => $not_interested,
                'not_interested_other' => $not_interested_other
            );
             $update = $this->home_model->update('tblleads',$update_data,array('id'=>$lead_id));
                if($update){
                    set_alert('success', 'Lead process updated successfully');
                }else{
                    set_alert('danger', 'Fail to update lead process!');
                }
                redirect(admin_url('leads/list'));

          }else{
            set_alert('danger', 'Lead process is empty!');
            redirect(admin_url('leads/list'));
          }
        }

    }

    public function lead_profile($lead_id)
    {

        $data['lead'] = $this->leads_model->get($lead_id);
        $data['lead_data']     = $this->db->query("SELECT cb.client_branch_name,cb.email_id,cb.phone_no_1,cb.address,cb.state,cb.city,cb.zip,l.`source`,l.`status`,l.`created_at`,l.`site_id`,s.name as site_name,l.`reference`,l.`remark`,l.`product_remark`,l.enquiry_type_id,lt.name as lead_type,st.name as state_name,ct.name as city_name,ls.name as source,lst.name as statusname FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid  LEFT JOIN `tblsitemanager` s ON s.`id`=l.`site_id` LEFT JOIN `tblenquirytypemaster` lt ON lt.`id`=l.`enquiry_type_id` LEFT JOIN `tblstates` st ON st.id=cb.`state` LEFT JOIN `tblcities` ct ON ct.id=cb.`city`  LEFT JOIN `tblleadssources` ls ON ls.id=l.`source` LEFT JOIN `tblleadsstatus` lst ON lst.id=l.`status` WHERE l.`id`='".$lead_id."'")->row();
        $data['lead_assign_data']= $this->db->query("SELECT s.firstname,s.email FROM `tblleadassignstaff` ast LEFT JOIN `tblstaff` s ON s.staffid=ast.`staff_id` WHERE `lead_id`='".$lead_id."'")->result_array();
        $data['contactdata'] = $this->db->query("SELECT `c`.`firstname`,`c`.`email`,`c`.`phonenumber`  FROM `tblenquiryclientperson` as e RIGHT JOIN `tblcontacts` as c ON `e`.`contact_id` = `c`.`id` WHERE `e`.`enquiry_id` = '".$lead_id."'")->result();

        $data['title'] = 'Lead Profile';
        $data['lead_id'] = $lead_id;
        $this->load->view('admin/lead_report/lead_profile', $data);

    }

    public function lead_activity($lead_id)
    {

        $data['lead'] = $this->leads_model->get($lead_id);
        $data['activity_log']  = $this->leads_model->get_lead_activity_log($lead_id);
        $data['title'] = 'Lead Activity';
        $data['lead_id'] = $lead_id;
        $this->load->view('admin/lead_report/lead_activity', $data);

    }

    public function lead_attachment($lead_id)
    {

        $data['lead'] = $this->leads_model->get($lead_id);

        $data['title'] = 'Lead Attachment';
        $data['lead_id'] = $lead_id;
        $this->load->view('admin/lead_report/lead_attachment', $data);

    }

    public function lead_quotation($lead_id)
    {

        $where = "rel_id = '".$lead_id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $where .= " and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;


        }
        $data['quotation_list'] = $this->db->query("SELECT * from `tblproposals` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Lead Quotation Report';
        $data['lead_id'] = $lead_id;
        $data['lead'] = $this->leads_model->get($lead_id);
        $this->load->view('admin/lead_report/quotation_report', $data);

    }

    public function lead_invoice($lead_id)
    {
        $where = "lead_id = '".$lead_id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $where .= "and invoice_date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Lead Invoice Report';
        $data['lead_id'] = $lead_id;
        $data['lead'] = $this->leads_model->get($lead_id);
        $this->load->view('admin/lead_report/invoice_report', $data);

    }

    public function lead_perfomainvoice($lead_id)
    {
        $where = "lead_id = '".$lead_id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $where .= "and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblestimates` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Lead Perfoma Invoice Report';
        $data['lead_id'] = $lead_id;
        $data['lead'] = $this->leads_model->get($lead_id);
        $this->load->view('admin/lead_report/perfomainvoice_report', $data);

    }

    public function lead_followup($lead_id)
    {

        $number_list = $this->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' ")->result();


        $numbers = '';
        if(!empty($number_list)){
            $i = 0;
            foreach ($number_list as $no) {
                if($i == 0){
                    $numbers .= $no->phonenumber;
                }else{
                    $numbers .= ','.$no->phonenumber;
                }
                $i++;
            }
        }

        if(!empty($numbers)){
            $where = "customer_number IN (".$numbers.")";

            if(!empty($_POST)){
                extract($this->input->post());
                $date_range = get_date_range($range);

                $where .= "and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
                $data['range'] = $range;
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

            }

            $data['call_history'] = $this->db->query("SELECT * from tblcalloutgoing where ".$where." order by id desc ")->result();

        }
        $data['title'] = 'Followup Report';
        $data['lead_id'] = $lead_id;
        $data['lead'] = $this->leads_model->get($lead_id);
        $this->load->view('admin/lead_report/lead_followup', $data);

    }


    public function get_lead_client_model(){
        if(!empty($_POST)){
           extract($this->input->post());
              $lead = $this->db->query("SELECT * from tblleads where id = '".$lead_id."' ")->row();
              $client_branch_data = $this->db->query("SELECT * FROM `tblclientbranch`")->result();
           ?>
            <form action="<?php echo admin_url('leads/update_client');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="col-md-12">Lead ID<div class="well well-sm"><?php echo 'LEAD-'.number_series($lead->id) ; ?></div></div>


                <div class="col-md-12">
                    <div class="form-group">
                       <label for="client_id" class="control-label">Select Client</label>
                        <select class="form-control selectpicker" data-live-search="true" id="client_id" name="client_id">
                            <option value="0"></option>
                             <?php
                                if (!empty($client_branch_data)) {
                                    foreach ($client_branch_data as $r)
                                    {
                                    ?>
                                        <option value="<?php echo $r->userid; ?>" <?php if($lead->client_branch_id == $r->userid){ echo 'selected'; } ?>><?php echo cc($r->client_branch_name); ?></option>
                                    <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                </div>

                <input type="hidden" value="<?php echo $lead_id; ?>" name="id">

                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="form-group text-right">
                        <button class="btn btn-info" type="submit">Update</button>
                    </div>
                </div>
            </div>
            </form>
           <?php
       }
    }


    public function update_client()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $this->home_model->update('tblleads',array('client_branch_id'=>$client_id,'client_id'=>$client_id),array('id'=>$id));

            set_alert('success', 'lead client updated');
            // redirect(admin_url('leads/list'));
            redirect($_SERVER['HTTP_REFERER']); die;
        }
    }

     //By safiya
    public function activity_lead($lead_id)
    {
        if(!empty($lead_id)){
           $number_list = $this->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' ")->result();


            $numbers = '';
            if(!empty($number_list)){
                $i = 0;
                foreach ($number_list as $no) {
                    if($i == 0){
                        $numbers .= $no->phonenumber;
                    }else{
                        $numbers .= ','.$no->phonenumber;
                    }
                    $i++;
                }
            }

            if(!empty($numbers)){
                $data['numbers'] = $numbers;
                /*$where = "customer_number IN (".$numbers.")";
                $data['call_history'] = $this->db->query("SELECT * from tblcalloutgoing where ".$where." order by id desc ")->result();*/
            }
        }


        if(!empty($_POST)){
            extract($this->input->post());


            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' and priority = '1' order by id asc")->result();
            }else{

                if(!empty($suggestion)){
                    $message = $suggestion;
                }else{
                    $message = $description;
                }


                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

                 $ad_data = array(
                            'lead_id' => $lead_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $this->home_model->insert('tblfollowupleadactivity',$ad_data);

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('leads/activity_lead/' . $lead_id));
            }


        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' order by id asc LIMIT 20")->result();
        }

        $LeadNumber = value_by_id('tblleads',$lead_id,'leadno');
        $data['contact_info'] = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' and c.phonenumber != '' ")->row();
        $data['lead_id'] = $lead_id;



        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();

        krsort($data['activity_log']);



        $data['title'] = $LeadNumber.' - Followup Activities';

        //$data['lead'] = $this->leads_model->get($lead_id);
        //$data['activity_log']  = $this->leads_model->get_lead_activity_log($lead_id);
       //$data['title'] = 'Lead Activity';
        $data['lead_id'] = $lead_id;
        $this->load->view('admin/lead_report/activity_lead', $data);

    }

    public function get_email_template(){
        $t_id = $this->input->post("t_id");
        $template = $this->db->query("SELECT email_message FROM tblemailmoduletemplate WHERE id = '".$t_id."' AND status = 1")->row();
        $response = "";
        if ($template){
           $response = $template->email_message;
        }
        echo $response;
    }

    /* this is for get template attechment files */
    public function get_templete_attechment($templete_id){
        $attechment = $this->db->query("SELECT id, file_name FROM tblfiles WHERE rel_id = '".$templete_id."' AND rel_type = 'email_template'")->result();
        if ($attechment){
            $i = 0;
            echo '<label for="attech" class="control-label">Attachment</label>';
            foreach ($attechment as $file){
                echo '<div class="jFiler-items jFiler-row">'
                        . '<ul class="jFiler-items-list jFiler-items-default">'
                                . '<li class="jFiler-item box'.$i.'" data-jfiler-index="A'.$i.'" style="">'
                                    . '<div class="jFiler-item-container">'
                                        . '<div class="jFiler-item-inner">'
                                            . '<div class="jFiler-item-icon pull-left"><i class="icon-jfi-file-o jfi-file-type-application jfi-file-ext-pdf"></i></div>'
                                            . '<div class="jFiler-item-info pull-left">'
                                                . '<div class="jFiler-item-title" title="'.$file->file_name.'">'.$file->file_name.'</div>'
                                                . '<div class="jFiler-item-others"><input type="hidden" name="module_attech[]" value="'.$file->file_name.'"></div>'
                                                . '<div class="jFiler-item-assets" onclick="removeattch('.$i.')"><ul class="list-inline"><li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li></ul></div>'
                                            . '</div>'
                                        . '</div>'
                                    . '</div>'
                                . '</li>'
                        . '</ul>'
                    . '</div>';
                $i++;
            }
        }
    }

    /* this function use for send mail of lead */
    public function send_to_email(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            $lead_data = $this->db->query("SELECT * FROM tblleads WHERE id = ".$lead_id."")->row();
            if (!empty($lead_data)){
                $response = $this->emails_model->send_mail($lead_id, "leads", $module_template_id, $lead_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Lead mail send successfully");
                    redirect(admin_url('leads/list'));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url('leads/list'));
                }
            }
            else{
                set_alert('danger', "Leads not found");
                redirect(admin_url('leads/list'));
            }
        }
        else{
            redirect(admin_url('leads/list'));
        }
    }

    public function get_client_list(){
        $lead_id = $this->input->post("lead_id");
        $contacts = $this->db->query("SELECT c.firstname, c.email, c.id FROM `tblcontacts` as c LEFT JOIN tblenquiryclientperson lc ON c.id = lc.contact_id where lc.enquiry_id = ".$lead_id." and c.email != '' GROUP by c.email")->result_array();
        echo render_select('sent_to[]',$contacts,array('email','email','firstname'),'invoice_estimate_sent_to_email', array(),array('multiple'=>true, 'required'=>true),array(),'','',false);
    }


    public function questionnaire_list() {

        $data['questionnaire_info']  = $this->db->query("SELECT * FROM tblquestionmaster order by id DESC ")->result();


        $data['title'] = 'Questionnaire Master List';
        $this->load->view('admin/leads/questionnaire_list', $data);
    }

    public function change_questionnaire_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tblquestionmaster',$update_data,array('id'=>$id));
        }
    }

    public function questionnaire($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());

                if(empty($is_required)){
                     $is_required = 0;
                }

                if($type == 1 || $type == 2){
                    $options = '';
                }

            if ($id == '') {

                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'question' => $question,
                    'type' => $type,
                    'is_required' => $is_required,
                    'size' => $size,
                    'options' => $options,
                    'question_order' => $question_order,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $insert = $this->home_model->insert('tblquestionmaster', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'New Questionnaire added successfully'));
                    redirect(admin_url('leads/questionnaire_list'));
                }
            } else {

                $ad_data = array(
                    'question' => $question,
                    'type' => $type,
                    'is_required' => $is_required,
                    'size' => $size,
                    'options' => $options,
                    'question_order' => $question_order,
                );
                $update = $this->home_model->update('tblquestionmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Questionnaire updated successfully');
                }
                redirect(admin_url('leads/questionnaire_list'));
            }
        }

        if ($id == '') {
            $title = 'Add Questionnaire Master';
        } else {
            $data['question_info'] = $this->db->query("SELECT * FROM tblquestionmaster where id = '".$id."' ")->row();
            $title = 'Edit Questionnaire Master';
        }

        $data['title'] = $title;

        $this->load->view('admin/leads/questionnaire', $data);
    }

    public function delete_questionnaire($id) {

        $response = $this->home_model->delete('tblquestionmaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Questionnaire Deleted Successfully');
            redirect(admin_url('leads/questionnaire_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('leads/questionnaire_list'));
        }

    }

    /* this function use for lost lead */
    public function lost_leads(){
        if ($this->input->post()) {
            extract($this->input->post());
            $ad_data = array(
                'process_id' => 6,
                'lost_remark' => trim($lost_remark),
            );
            $update = $this->home_model->update('tblleads', $ad_data,array('id'=>$lead_id));
            if ($update) {
                set_alert('success', 'Lead updated successfully');
            }
        }
        redirect(admin_url('leads/list'));
    }


    public function sales_person_lead_report()
    {
        $data['title'] = 'Sales Person Lead Report';
        check_permission(336,'view');

        if(!empty($_POST)){
            extract($this->input->post());
            
            if(!empty($staff_id)){

                $data['s_staff_id'] = $staff_id;
                $staffids = implode(',', $staff_id);
                $where = "ls.type = 2 and ls.staff_id IN (".$staffids.") ";
                // if ($staff_id == "all"){
                //     $staff_info = $this->db->query("SELECT GROUP_CONCAT(`sales_person_id`) as staff_ids from `tblleadstaffgroup` where status = 1  ")->row();
                //     if(!empty($staff_info) && !empty($staff_info->staff_ids)){
                //         $where = "ls.type = 2 and ls.staff_id IN (".$staff_info->staff_ids.")";
                //     }
                // }

                if(!empty($service_type)){
                    $data['s_service_type'] = $service_type;

                    $where .= " and lp.enquiry_for_id = '".$service_type."' ";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= " and l.enquiry_date between '".$f_date."' and '".$t_date."' ";
                }

                if (!empty($pro_category_id)){
                    $data['product_category_id'] = $pro_category_id;
                    $where .= " and pro.product_cat_id = '".$pro_category_id."' ";
                }

                if(!empty($enquiry_type_id)){
                    $data['enquiry_type_id'] = $enquiry_type_id;
                    $where .= " and l.enquiry_type_main_id = '".$enquiry_type_id."'";
                }

                $orderby = "l.id ASC";
                if ($staff_id == "all"){
                    $orderby = "s.firstname ASC";
                }
                $data['lead_info'] = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id LEFT JOIN tblproductinquiry as lp ON l.id = lp.enquiry_id LEFT JOIN `tblstaff` as s ON s.staffid = ls.staff_id LEFT JOIN tblproducts as pro ON pro.id = lp.product_id WHERE ".$where." GROUP BY l.id ORDER BY ".$orderby." ")->result();
            }

        }

        $data['mainleadtype_info'] = $this->db->query("SELECT * from `tblmainenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result();
        $data['leadtype_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['procategory_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC")->result();

        $this->load->view('admin/report/sales_person_lead_report', $data);
    }

    public function assign_lead_report()
    {
        $data['title'] = 'Assign Lead Report';

        $where = "ls.type = 2 and ls.staff_id = '".get_staff_user_id()."' ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($service_type)){
                $data['s_service_type'] = $service_type;

                $where .= " and lp.enquiry_for_id = '".$service_type."' ";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                $where .= " and l.enquiry_date between '".$f_date."' and '".$t_date."' ";
            }
        }else{
            
            /* get last 3 month record by defult */
            $date_range = get_last_month_date();
            $where .= " and l.enquiry_date BETWEEN '".$date_range["start_date"]."' and '".$date_range["end_date"]."' ";
        }

        $data['lead_info'] = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id LEFT JOIN tblproductinquiry as lp ON l.id = lp.enquiry_id where ".$where." GROUP BY l.id ORDER BY l.id desc ")->result();
        $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1  ")->result();
        $data['leadtype_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ")->result();
        $data['mainleadtype_info'] = $this->db->query("SELECT * from `tblmainenquirytypemaster` where status = 1 ")->result();
        $this->load->view('admin/report/assign_lead_report', $data);
    }

    /* this function use for export assign lead */
    public function export_assign_lead()
    {
        $where = "ls.type = 2 and ls.staff_id = '".get_staff_user_id()."' ";
        if(!empty($this->session->userdata('lead_where'))){
            $where = $this->session->userdata('lead_where');
        }
        $lead_list = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id LEFT JOIN tblproductinquiry as lp ON l.id = lp.enquiry_id where ".$where." GROUP BY l.id ORDER BY l.id desc ")->result();

        // create file name
        $fileName = 'export/assignleadreport.xlsx';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Assign Lead Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');

        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Lead');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Quotation');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Enq date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Source');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Contact Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Contact Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Contact Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Created');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Last Activity');
        $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'Last Activity On');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($lead_list as $value)
        {
            $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

              if($value->client_branch_id > 0){
                  $company = $client_info->client_branch_name;
              }else{
                  $company = $value->company;
              }

              if(check_quotation($value->id) == 1){
                  $quotation = 'Yes';
              }else{
                  $quotation = 'No';
              }

            //getting last quotation amount
            $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
            if(!empty($quotation_info)){
                $amount = $quotation_info->total;
            }else{
                $amount = '0.00';
            }

            $contact_person_info = $this->db->query("SELECT c.firstname,c.email,c.phonenumber FROM `tblcontacts` as c LEFT JOIN tblenquiryclientperson as lc ON lc.contact_id = c.id where lc.enquiry_id = '".$value->id."' ")->row();

            $contact_name = '--';
            $contact_number = '--';
            $contact_email = '--';
            if(!empty($contact_person_info)){
                $contact_name = $contact_person_info->firstname;
                $contact_number = $contact_person_info->phonenumber;
                $contact_email = $contact_person_info->email;
            }

            /* Lead Activity data */
            $lead_activity = $this->db->query("SELECT * FROM `tblfollowupleadactivity` WHERE lead_id= '".$value->id."' ORDER BY id DESC LIMIT 1")->row();
            $last_activity = (!empty($lead_activity)) ? cc($lead_activity->message) : '--';
            $last_activity_on = (!empty($lead_activity)) ? _d($lead_activity->date) : '--';

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'LEAD-'.number_series($value->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $company);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $quotation);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->enquiry_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, value_by_id('tblleadssources',$value->source,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, value_by_id('tblenquirytypemaster',$value->enquiry_type_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $amount);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $contact_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $contact_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $contact_email);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, _d($value->dateadded));
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $last_activity);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $last_activity_on);

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);
    }

    public function change_source_status($id, $status) {
        $this->load->model('home_model');
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tblleadssources',$update_data,array('id'=>$id));
        }
    }

    public function get_lead_subtype(){
        if ($this->input->post()) {
            extract($this->input->post());
            $subtype_list = $this->db->query("SELECT * FROM tblenquirytypemaster WHERE enquiry_type_main_id = '".$type_id."' ")->result();
            echo '<option value=""></option>';
            if (!empty($subtype_list)){
                foreach($subtype_list as $subtype){
                    echo '<option value="'.$subtype->id.'">'.cc($subtype->name).'</option>';
                }
            }
        }
    }

    public function lead_export()
    {

        $data['lead_list'] = $this->db->query("SELECT * from `tblleads` order by id desc ")->result();

        $this->load->view('admin/leads/lead_export', $data);

    }

    public function get_lead_totalamount(){

        /*$where = "id > 0 and created_at > '2021-03-31 23:59:59' ";
        $status_where = "id > 0 and created_at > '2021-03-31 23:59:59' ";
        if(!empty($this->session->userdata('lead_where'))){
            $where = $this->session->userdata('lead_where');
        }
        if(!empty($this->session->userdata('lead_where_status'))){
            $status_where = $this->session->userdata('lead_where_status');
        }
        $leadcount = $this->leads_model->get_lead_search_details($where,$status_where);
        echo $leadcount["ttl_amount"];*/
        echo 0;
    } 

    /* this function use for untouch lead */
    public function untouch_lead(){
        $data['title'] = 'Untouch Lead Report';
        
        $where = "l.enquiry_type_main_id IN (1,2,3) ";
        if(!empty($_POST)){
            extract($this->input->post());
            
            if(!empty($customer_company)){
                $data['customer_company'] = $customer_company;
                $where .= " and (l.company LIKE '%".$customer_company."%' || l.client_person_name LIKE '%".$customer_company."%')";
                $status_where .= " and (l.company LIKE '%".$customer_company."%' || l.client_person_name LIKE '%".$customer_company."%')";
            }

            if(!empty($lead_no)){
                $data['lead_no'] = $lead_no;
                $where .= " and (l.leadno LIKE '%".$lead_no."%')";
                $status_where .= " and (l.leadno LIKE '%".$lead_no."%')";
            }

            if(!empty($client_id)){
                $data['client_id'] = $client_id;
                $where .= " and l.client_branch_id = '".$client_id."'";
                $status_where .= " and l.client_branch_id = '".$client_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }else{
            $from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
            $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');
            $where .= " and l.enquiry_date BETWEEN '".$from_date_year."' AND '".$to_date_year."' ";
            $data['f_date'] = _d($from_date_year);
            $data['t_date'] = _d($to_date_year);
        }
        $data['lead_info'] = $this->db->query("SELECT l.* from `tblleads` as l WHERE ".$where." GROUP BY l.id ORDER BY l.id DESC ")->result();
        $data['mainleadtype_info'] = $this->db->query("SELECT * from `tblmainenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['leadtype_info'] = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
        $data['client_list'] = $this->db->query("SELECT * from `tblclientbranch` WHERE client_branch_name != '' and active = 1 ORDER BY client_branch_name ASC")->result();
        $this->load->view('admin/report/untouch_lead_report', $data);
    }

    /* this function use for last month lead projection submission */
    public function lead_projection_submission($id){

        /* this condition check submission status */
        $leadprojection = $this->db->query("SELECT * FROM `tblleadprojection` WHERE `id` ='".$id."' ")->row();
        if ($leadprojection->status == 1){
            set_alert('warning', 'Aleady lead projection submitted');
            redirect(admin_url('approval/notifications'));
        }

        if(!empty($_POST)){
            extract($this->input->post());
            
            $lead_ids = implode(",", $lead_id);
            $submissiondata["salesparson_remark"] = $salesparson_remark;
            $submissiondata["lead_ids"] = $lead_ids;
            $submissiondata["status"] = 1;
            $submissiondata["updated_at"] = date('Y-m-d H:i:s');
            $response = $this->home_model->update("tblleadprojection", $submissiondata, array("id" => $id));
            if ($response){
                update_masterapproval_single(get_staff_user_id(),57,$id,1);
                update_masterapproval_all(57,$id,1);

                set_alert('success', 'Lead Projection Submission Successfully');
                redirect(admin_url('approval/notifications'));
            }
        }    
        
        $data["title"] = "Next Month Lead Projection Submission - (<span class='text-danger'>".date("M-Y", strtotime('01-'.$leadprojection->month.'-'.$leadprojection->year))."</span>)";

        $where = "l.enquiry_type_main_id IN (1,2,3) and ls.type = 2 and ls.staff_id = '".$leadprojection->salesperson_id."' ";
        $data['lead_info'] = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id WHERE ".$where." GROUP BY l.id ORDER BY l.id DESC ")->result();

        $this->load->view('admin/report/lead_projection_submission', $data);
    }

    /* this is sales parson lead projection report */
    public function lead_projection_report(){

        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($staff_id) && !empty($month) && !empty($year)){
                $data["s_staff_id"] = $staff_id;
                $data["s_month"] = $month;
                $data["s_year"] = $year;

                $projection_data = $this->db->query("SELECT lead_ids FROM `tblleadprojection` WHERE `salesperson_id`='".$staff_id."' AND `month` = '".$month."' AND `year` = '".$year."' AND `status`='1'")->row();
                $lead_ids = (!empty($projection_data)) ? $projection_data->lead_ids : '';
                if (!empty($lead_ids) && $lead_ids != ''){
                    $where = "ls.type = 2 and ls.staff_id = '".$staff_id."' and l.id IN (".$lead_ids.") ";
                    $data['lead_info'] = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id WHERE ".$where." GROUP BY l.id ORDER BY l.id DESC ")->result();
                    $data['complate_lead'] = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id WHERE l.enquiry_type_main_id = 5 and ".$where." GROUP BY l.id ORDER BY l.id DESC ")->result();
                    $data['pending_lead'] = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id WHERE l.enquiry_type_main_id IN (1,2,3) and ".$where." GROUP BY l.id ORDER BY l.id DESC ")->result();
                }
            }
        }    
        $data["title"] = "Monthly Lead Projection Report";

        $data['sales_person_info'] = $this->db->query("SELECT `sales_person_id` from `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result();
        $data['month_list'] = $this->db->query("SELECT * from `tblmonths` ORDER BY id ASC ")->result();
        $this->load->view('admin/report/lead_projection_report', $data);
    }

    /* this code use for lead assigned vs lead converted report */
    public function lead_assign_and_converted()
    {
        $data['title'] = 'Lead assigned Vs Lead converted';
       
        $data["f_date"] = date("d/m/Y", strtotime('first day of this month', time()));
        $data["t_date"] = date("d/m/Y", strtotime('last day of this month', time()));
        
        if(!empty($_POST)){
            extract($this->input->post());
            
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
            }
        }

        $data['sales_person_list'] = $this->db->query("SELECT `sales_person_id` FROM `tblleadstaffgroup` WHERE `status` = 1 ORDER BY `name` ASC ")->result();
        $this->load->view('admin/leads/lead_assign_and_converted', $data);
    }

}
