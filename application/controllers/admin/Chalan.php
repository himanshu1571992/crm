<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Chalan extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('estimates_model');
        $this->load->model('home_model');
        //$this->load->model('chalan_model');
    }

    /* Get all estimates in case user go on index page */

    /*public function index($estimate_id='') {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
              //  access_denied('customers');
            }
        }
        $data['estimate_id'] = $estimate_id;
        $this->load->view('admin/chalan/manage', $data);
    }*/

    /*public function created()
    {

        check_permission(23,'view');


        $where = "id > 0 and year_id = '".financial_year()."' ";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('challan_where');
                $this->session->unset_userdata('challan_search');
            }else{
                if(!empty($client_id) || !empty($f_date) || !empty($t_date) || !empty($service_type)){
                    $this->session->unset_userdata('challan_where');
                    $this->session->unset_userdata('challan_search');
                    $sreach_arr = array();
                    if(!empty($client_id)){
                        $sreach_arr['client_id'] = $client_id;
                        $where .= " and clientid = '".$client_id."'";
                    }

                    if(!empty($service_type)){
                        $sreach_arr['service_type'] = $service_type;
                        $where .= " and is_sale = '".$service_type."'";
                    }

                    if(!empty($f_date) && !empty($t_date)){
                        $sreach_arr['f_date'] = $f_date;
                        $sreach_arr['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $f_date = $f_date.' 00:00:00';
                        $t_date = $t_date.' 23:59:59';

                        $where .= " and `datecreated` >= '".$f_date."' and `datecreated` <= '".$t_date."' ";
                    }


                    $this->session->set_userdata('challan_where',$where);
                    $this->session->set_userdata('challan_search',$sreach_arr);

                }

            }
        }else{
            if(!empty($this->session->userdata('challan_where'))){
                $where = $this->session->userdata('challan_where');
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 15;


        // Get record count
        $totalRec = $this->home_model->get_challan_count($where);

        // Pagination configuration
        $config['base_url']    = admin_url().'chalan/created/';
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
        $data['invoice_list'] = $this->home_model->get_challan($where,$offset,$perPage);



        $data['client_data'] = $this->db->query("SELECT `company`,`userid` from `tblclients`  ")->result();

        $data['title'] = 'Challan List';
        $this->load->view('admin/chalan/list', $data);

    }*/

    public function created()
    {
        check_permission(23,'view');

        $where = "id > 0  ";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id) || !empty($f_date) || !empty($t_date) || isset($approve_status) || !empty($service_type)){
                if(!empty($client_id)){
                    $data['client_id'] = $client_id;
                    $where .= " and clientid = '".$client_id."'";
                }

                if(!empty($service_type)){
                    $data['service_type'] = $service_type;
                    $where .= " and service_type = '".$service_type."'";
                }
                if(isset($approve_status)){
                    $data['approve_status'] = $approve_status;
                    $where .= " and approve_status = '".$approve_status."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    /*$f_date = $f_date.' 00:00:00';
                    $t_date = $t_date.' 23:59:59';*/

                    $where .= " and `challandate` >= '".$f_date."' and `challandate` <= '".$t_date."' ";
                }

            }
        }else{
            $where = " year_id = '".financial_year()."' ";
        }
        /*echo $where;
        die;*/

        // Get records
        $data['invoice_list'] = $this->db->query("SELECT * from `tblchalanmst` where ".$where." ORDER BY id desc ")->result();
        $data['client_data'] = $this->db->query("SELECT * from `tblclientbranch` WHERE `active` = 1 AND `client_branch_name` != '' ORDER BY client_branch_name ASC ")->result();
        $data['branch_info'] = $this->db->query("SELECT `id`,`comp_branch_name` from `tblcompanybranch` where status = 1 ORDER BY comp_branch_name ASC ")->result();

        $data['title'] = 'Challan List';
        $this->load->view('admin/chalan/list', $data);

    }


	/*public function created($id = '') {
        check_permission(23,'view');

        $data['estimate_id'] = $id;

        $this->load->view('admin/chalan/managechalan', $data);
    }*/

    public function table($estimate_id='') {
        $this->app->get_table_data('chalan',[
      'estimate_id' => $estimate_id,
      ]);
    }

	public function chalantable($estimate_id='') {
        $this->app->get_table_data('createdchalan',[
      'estimate_id' => $estimate_id,
      ]);
    }

	public function createdchalantable($estimate_id='') {
        $this->app->get_table_data('createdchalans',[
      'estimate_id' => $estimate_id,
      ]);
    }

    public function delete($id) {
        $this->load->model('Estimates_model');
        $success = $this->Estimates_model->delete_chalan($id);
        if ($success) {

            set_alert('success', _l('deleted', _l('challan')));
            if (strpos($_SERVER['HTTP_REFERER'], 'chalan/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('chalan'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('challan_lowercase')));
            redirect(admin_url('chalan/chalan/' . $id));
        }
    }

	public function deletechalan($id) {
        check_permission(23,'delete');
        $this->load->model('Estimates_model');

        $chk_production_plan = $this->db->query("SELECT * from tblchalanproductionplan where chalan_id = '".$id."' ")->row();
        if (!empty($chk_production_plan)){
            set_alert('warning', "Can't be deleted this, its used somewhere.");
            redirect(admin_url('chalan/created'));
        }
        $success = $this->Estimates_model->deletechalan($id);
        $success = $this->Estimates_model->delete_chalan($id);
        if ($success) {

            //Add qty to stock
            $chk_consumed_log = $this->db->query("SELECT * FROM tblstore_challan_consumed_log WHERE `challan_id`= '".$id."' AND `table_type` = 1 ")->result();
            if (!empty($chk_consumed_log)){
                foreach ($chk_consumed_log as $clog) {
                    
                    $proqty = value_by_id("tblproduct_store_log", $clog->table_id, "qty");
                    $finalqty = $clog->consumed_qty + $proqty;
                    $this->home_model->update('tblproduct_store_log', array('qty'=>$finalqty, "updated_at" => date("Y-m-d H:i:s")), array('id'=>$clog->table_id));

                    $this->home_model->delete("tblstore_challan_consumed_log", array('id'=>$clog->id));
                }
                /* this is for deleted record */
                $this->home_model->delete("tblproduct_store_log", array("ref_type" => 'challan_created', "ref_id" => $id));
            }

            $chk_consumed_log = $this->db->query("SELECT * FROM tblstore_challan_consumed_log WHERE `challan_id`= '".$id."' AND `table_type` = 2 ")->result();
            if (!empty($chk_consumed_log)){
                foreach ($chk_consumed_log as $clog) {
                    
                    $proqty = value_by_id("tblprostock", $clog->table_id, "qty");
                    $finalqty = $clog->consumed_qty + $proqty;
                    $this->home_model->update('tblprostock', array('qty'=>$finalqty, "updated_at" => date("Y-m-d H:i:s")), array('id'=>$clog->table_id));

                    $this->home_model->delete("tblstore_challan_consumed_log", array('id'=>$clog->id));
                }
            }

            $this->home_model->delete('tblcreatedchalandetailsmst', array('chalan_id'=>$id));

            // $product_data = $this->db->query("SELECT * from `tblcreatedchalandetailsmst` where chalan_id = '".$id."'  ")->result();
            // if(!empty($product_data)){
            //     foreach ($product_data as $value) {
            //         $stock_info = $this->db->query("SELECT * from `tblprostock` where pro_id = '".$value->component_id."' and stock_type = 1 and staff_id = 0 ")->row();
            //         if(!empty($stock_info)){
            //             $new_qty = ($value->deleverable_qty + $stock_info->qty);
            //             $update = $this->home_model->update('tblprostock', array('qty'=>$new_qty), array('id'=>$stock_info->id));
            //         }
            //     }
            //     $this->home_model->delete('tblcreatedchalandetailsmst', array('chalan_id'=>$id));
            // }

            //Delete challan process
            $this->home_model->delete('tblchallanprocess', array('chalan_id'=>$id));

            set_alert('success', _l('deleted', _l('challan')));
            if (strpos($_SERVER['HTTP_REFERER'], 'chalan/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('chalan'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('challan_lowercase')));
            redirect(admin_url('chalan/chalan/' . $id));
        }
    }


	public function view($id = '') {
		$this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');
		$this->load->model('estimates_model');
		$getchalandata=$this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='".$id."'")->row_array();
		$getchalandetails=$this->db->query("SELECT * FROM `tblchalandetailsmst` WHERE `chalan_id`='".$id."'")->result_array();
		$chalandetails=array();
		$i=0;
		foreach($getchalandetails as $singlechalandetail)
		{
			$chalandetails[$i]['qty']=$singlechalandetail['deleverable_qty'];
			$getcomponentdetails=$this->db->query("SELECT * FROM `tblproducts` WHERE `id`='".$singlechalandetail['component_id']."'")->row_array();
			$chalandetails[$i]['component_name']=$getcomponentdetails['name'];
			$i++;
		}
		$data['chalan']=$getchalandata;
		$data['chalan_details']=$chalandetails;
		$getwarehousedetails=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$getchalandata['warehouse_id']."' ORDER BY name ASC")->row_array();
		$data['warehouse_name']=$getwarehousedetails['name'];
		$pro_id=explode(',',$getchalandata['pro_id']);
		foreach($pro_id as $singlepro)
		{
			$getprodet=$this->db->query("SELECT * FROM `tblproducts` WHERE `id`='".$singlepro."' ORDER BY name ASC")->row_array();
			$proname[]=$getprodet['name'];
		}
		$pro_name=implode(',',$proname);
		$data['proname']=$pro_name;
		if ($getchalandata['service_type'] == 1) {
            $is_sale = 0;
            $servicetype = 'Challan For Rent';
        } else {
            $is_sale = 1;
            $servicetype = 'Challan For Sale';
        }
		$data['servicetype']=$servicetype;
        $this->load->model('estimates_model');
        $data['estimate'] = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='" . $id . "'")->row();
        $this->load->view('admin/chalan/view_chalan', $data);

	}

    public function edit($id = '') {

        $this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');

        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            if ($id == '') {
                if (!has_permission('challan', '', 'create')) {
                    access_denied('challan');
                }
                $id = $this->Estimates_model->updatechalan($proposal_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('challan')));
                    redirect(admin_url('chalan/created'));
                }
            } else {
                //echo'ss';exit;
                if (!has_permission('challan', '', 'edit')) {
                   // access_denied('challan');
                }
                $success = $this->Estimates_model->updatechalan($proposal_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('challan')));
                    redirect(admin_url('chalan/created'));
                }
                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('chalan/created'));
                } else {
                    redirect(admin_url('chalan' . $success));
                }
            }
        }

        if ($id == '') {

            $title = _l('add_new', _l('proposal_lowercase'));
        } else {
            $this->load->model('estimates_model');
            $data['proposal'] = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='" . $id . "'")->row();
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
            $otherchargesforrent = $this->db->get('tblestimateothercharges')->result_array();

            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblestimateproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'fieldname');

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblestimateothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;

            if (!$data['proposal'] || !user_can_view_chalan($id)) {
                blank_page(_l('proposal_not_found'));
            }

            $data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
            $this->db->where('lead_id', $id);
            $staffassigndata = $this->db->get('tblestimateassignstaff')->result_array();
            $staffassigndata = array_column($staffassigndata, 'staff_id');
            $data['staffassigndata'] = $staffassigndata;
            $data['contactdata'] = $this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='" . $id . "' AND `type`='estimate'")->result_array();
            $data['staff_data'] = $this->db->query("SELECT * FROM `tblcontacts` WHERE `userid`='" . $proposalll['clientid'] . "'")->result_array();
        }

        $default_settings = $this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
        $data['default_setting_field'] = array_column($default_settings, 'default_setting_field');
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
        $leaddetails = $this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='" . $_GET['rel_id'] . "' ORDER BY cb.`client_branch_name` ASC")->row_array();
        $data['client_branch_name'] = $leaddetails['client_branch_name'];
        $lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();
        $clientsate = array_column($lead_prod_rent_det, 'state');
        $data['clientsate'] = $clientsate[0];
        $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        $data['lead_prod_sale_det'] = $lead_prod_sale_det;
        $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal' ORDER BY p.name ASC")->result_array();
        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
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
        $compbranchid = $this->session->userdata('staff_user_id'); //exit;
        $compnybranch_warehouse = $this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='" . $compbranchid . "'")->row_array();
        $warehouseid = explode(',', $compnybranch_warehouse['warehouse_id']);
        foreach ($warehouseid as $singlewarehouseid) {
            $warehousedata[] = $this->db->query("SELECT * FROM `tblwarehouse` where id='" . $singlewarehouseid . "' ORDER BY name ASC")->row_array();
        }
        $data['all_warehouse'] = $warehousedata;
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $this->load->model('Contact_type_model');

        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $sessiondata = $this->session->userdata();
        //$id= $sessiondata['proposalid'];
        $this->load->model('estimates_model');
        $data['estimate'] = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='" . $id . "'")->row();


        $service_type = $sessiondata['service_type'];
        $warehouse_id = $sessiondata['warehouse_id'];
        foreach ($warehouse_id as $single_warehouse) {
            $get_warehouse_details = $this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='" . $single_warehouse . "' ORDER BY name ASC")->row_array();
            $warehouse[] = $get_warehouse_details['name'];
        }
        $data['warehouse'] = implode(',', $warehouse);
        if ($service_type == 1) {
            $is_sale = 0;
            $servicetype = 'Challan For Rent';
        } else {
            $is_sale = 1;
            $servicetype = 'Challan For Rent';
        }
        $this->db->where('chalan_id', $id);
        //$this->db->get('tblchalandetailsmst')->result_array();
        $data['productdata'] = $this->db->get('tblchalandetailsmst')->result_array();
        $this->db->where('id', $id);
        $chal_det = $this->db->get('tblchalanmst')->row_array();
        //print_r($chal_det);exit;
        $data['servicetype'] = $servicetype;
        $data['rely_type'] = $chal_det['rel_type'];
        $data['rel_id'] = $chal_det['rel_type'];
        //echo"<pre>";print_r($data);exit;
		$this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();
        $this->load->view('admin/chalan/generate_chalan', $data);
    }

    public function generate($id = '') {

        $this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');

        if ($this->input->post()) {
            extract($this->input->post());
            $proposal_data = $this->input->post();

            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/


            if ($id == '') {
                /*if (!has_permission('challan', '', 'create')) {
                    access_denied('challan');
                }*/
                $id = $this->Estimates_model->addchalan($proposal_data);
                if ($id) {

                    //Less quantity from the stock
                    /*if(!empty($proposal_data['componentdata'])){
                        foreach ($proposal_data['componentdata'] as  $value) {

                            $componentid = $value['componentid'];
                            $deliverableqty = $value['deliverableqty'];


                            $staff_stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$componentid."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 1 and staff_id = '".get_staff_user_id()."'")->row();

                            if(!empty($staff_stock_info)){

                            	$staff_deliverableqty = $deliverableqty;

                            	$deliverableqty = ($staff_deliverableqty - $staff_stock_info->qty);

                            	$staff_qty = ($staff_stock_info->qty - $staff_deliverableqty);
                            	if($staff_qty > 0){
                            		$staff_qty = $staff_qty;
                            	}else{
                            		$staff_qty = 0;
                            	}

                            	$update = $this->home_model->update('tblprostock', array('qty'=>$staff_qty), array('id'=>$staff_stock_info->id));

                            }



                            if($deliverableqty > 0){
                            	$stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$componentid."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 1 ")->row();

	                             if(!empty($stock_info)){
	                                $n_qty = ($stock_info->qty - $deliverableqty);
	                                $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
	                            }
                            }


                        }
                    }*/


                    set_alert('success', _l('added_successfully', _l('challan')));
                    redirect(admin_url('chalan/created'));
                }
            } else {
                //echo'ss';exit;
                /*if (!has_permission('challan', '', 'edit')) {
                    access_denied('challan');
                }*/
                echo $success = $this->Estimates_model->update_pi($proposal_data, $id);
                // exit;
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('challan')));
                    redirect(admin_url('chalan/created'));
                }
                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('chalan'));
                } else {
                    redirect(admin_url('chalan' . $success));
                }
            }
        }

        if ($id == '') {

            $title = 'Generate new challan';
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
            $otherchargesforrent = $this->db->get('tblestimateothercharges')->result_array();

            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblestimateproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'fieldname');

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblestimateothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;

            if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }

            $data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
            $this->db->where('lead_id', $id);
            $staffassigndata = $this->db->get('tblestimateassignstaff')->result_array();
            $staffassigndata = array_column($staffassigndata, 'staff_id');
            $data['staffassigndata'] = $staffassigndata;
            $data['contactdata'] = $this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='" . $id . "' AND `type`='estimate'")->result_array();
            $data['staff_data'] = $this->db->query("SELECT * FROM `tblcontacts` WHERE `userid`='" . $proposalll['clientid'] . "'")->result_array();
        }

        $rel_id = 0;
        if (!empty($data['estimate'])){
            $rel_id = $data['estimate']->id;
        }else if (isset($_GET['rel_id'])){
            $rel_id = $_GET['rel_id'];
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
        $leaddetails = $this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='" . $rel_id . "' ORDER BY cb.`client_branch_name` ASC")->row_array();
        $data['client_branch_name'] = $leaddetails['client_branch_name'];
        $lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $rel_id . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();
        $clientsate = array_column($lead_prod_rent_det, 'state');
        $data['clientsate'] = (!empty($clientsate)) ? $clientsate[0] : '';
        $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        $data['lead_prod_sale_det'] = $lead_prod_sale_det;
        $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal' ORDER BY p.name ASC")->result_array();
        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
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
        $compbranchid = $this->session->userdata('staff_user_id'); //exit;
        $compnybranch_warehouse = $this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='" . $compbranchid . "'")->row_array();
        $warehouseid = explode(',', $compnybranch_warehouse['warehouse_id']);
        foreach ($warehouseid as $singlewarehouseid) {
            $warehousedata[] = $this->db->query("SELECT * FROM `tblwarehouse` where id='" . $singlewarehouseid . "'")->row_array();
        }
        $data['all_warehouse'] = $warehousedata;
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $this->load->model('Contact_type_model');



        $sessiondata = $this->session->userdata();
        $id = $sessiondata['proposalid'];
        $this->load->model('estimates_model');
        $data['estimate'] = $this->estimates_model->get($id);

        $data['rel_id'] = $id;
        $service_type = $sessiondata['service_type'];
        $warehouse_id = $sessiondata['warehouse_id'];
        foreach ($warehouse_id as $single_warehouse) {
            $get_warehouse_details = $this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='" . $single_warehouse . "' ORDER BY name ASC")->row_array();
            $warehouse[] = $get_warehouse_details['name'];
        }
        $data['warehouse'] = implode(',', $warehouse);
        if ($service_type == 1) {
            $is_sale = 0;
            $servicetype = 'Challan For Rent';
        } else {
            $is_sale = 1;
            $servicetype = 'Challan For Sale';
        }
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        $this->db->where('rel_id', $id);
        $this->db->where('is_sale', $is_sale);
        $this->db->where('rel_type', 'estimate');
        $data['servicetype'] = $servicetype;
        $data['is_sale'] = $is_sale;
        $data['productdata'] = $this->db->get('tblitems_in')->result_array();
        //echo $this->db->last_query();
        $data['rely_type'] = 'estimate';
		$this->load->model('Component_model');
        //$data['component_data'] = $this->Component_model->get();
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC ")->result_array();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result_array();
        $this->load->view('admin/proposals/generate_chalan', $data);
    }

    public function chalansession() {

        $data = $this->input->post();
        $proposalid = $this->input->post('proposalid');
        $warehouse_id = $this->input->post('warehouse_id');
        $service_type = $this->input->post('service_type');
        $newdata = array(
            'warehouse_id' => $warehouse_id,
            'service_type' => $service_type,
            'proposalid' => $proposalid
        );

        $this->session->set_userdata($newdata);
    }

    /* List all estimates datatables */

    public function list_estimates($id = '') {
        /*if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && get_option('allow_staff_view_estimates_assigned') == '0') {
            access_denied('estimates');
        }*/

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

    /* public function table($clientid = '')
      {
      if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && get_option('allow_staff_view_estimates_assigned') == '0') {
      ajax_access_denied();
      }

      $this->app->get_table_data('estimates', [
      'clientid' => $clientid,
      ]);
      }

      Add new estimate or update existing */

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

            if (!$estimate || !user_can_view_estimate($id)) {
                blank_page(_l('estimate_not_found'));
            }

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
        $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal' ORDER BY p.name ASC")->result_array();
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

        $this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            if ($id == '') {
                if (!has_permission('proposals', '', 'create')) {
                    access_denied('proposals');
                }
                $id = $this->Estimates_model->add($proposal_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('estimate')));
                    redirect(admin_url('estimates/list_estimates/' . $id));
                }
            } else {
                //echo'ss';exit;
                if (!has_permission('proposals', '', 'edit')) {
                    access_denied('proposals');
                }
                echo $success = $this->Estimates_model->update_pi($proposal_data, $id);
                // exit;
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('estimate')));
                    redirect(admin_url('estimates/list_estimates/' . $id));
                }
                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('estimate'));
                } else {
                    redirect(admin_url('estimates/list_estimates/' . $success));
                }
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('proposal_lowercase'));
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
            $otherchargesforrent = $this->db->get('tblestimateothercharges')->result_array();

            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblestimateproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'fieldname');

            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $otherchargesforsale = $this->db->get('tblestimateothercharges')->result_array();

            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;

            if (!$data['proposal'] || !user_can_view_proposal($id)) {
                blank_page(_l('proposal_not_found'));
            }

            $data['estimate'] = $data['proposal'];
            $data['is_proposal'] = true;
            $title = _l('edit', _l('proposal_lowercase'));
            $this->db->where('lead_id', $id);
            $staffassigndata = $this->db->get('tblestimateassignstaff')->result_array();
            $staffassigndata = array_column($staffassigndata, 'staff_id');
            $data['staffassigndata'] = $staffassigndata;
            $data['contactdata'] = $this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='" . $id . "' AND `type`='estimate'")->result_array();
            $data['staff_data'] = $this->db->query("SELECT * FROM `tblcontacts` WHERE `userid`='" . $proposalll['clientid'] . "'")->result_array();
        }

        $default_settings = $this->db->query("SELECT ds.*,dsc.category_name FROM `tbldefaultsetting` ds LEFT JOIN `tbldefaultsettingcategory` dsc ON ds.`default_setting_category_id`=dsc.id")->result_array();
        $data['default_setting_field'] = array_column($default_settings, 'default_setting_field');
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
        $leaddetails = $this->db->query("SELECT cb.`client_branch_name` FROM `tblleads` l LEFT JOIN `tblclientbranch` cb ON l.`client_id`=cb.userid WHERE l.`id`='" . $_GET['rel_id'] . "' ORDER BY cb.`client_branch_name` ASC")->row_array();
        $data['client_branch_name'] = $leaddetails['client_branch_name'];
        $lead_prod_rent_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Rent' OR ef.name='Both Rent & Sale') ")->result_array();
        $lead_prod_sale_det = $this->db->query("SELECT p.*,l.company_category,l.state FROM `tblproductinquiry` pe LEFT JOIN `tblenquiryformaster` ef ON pe.`enquiry_for_id`=ef.id LEFT JOIN `tblproducts` p ON p.id=pe.product_id  LEFT JOIN `tblleads` l ON l.id=pe.`enquiry_id`  WHERE pe.`enquiry_id`='" . $_GET['rel_id'] . "' AND (ef.name='Sale' OR ef.name='Both Rent & Sale')")->result_array();
        $clientsate = array_column($lead_prod_rent_det, 'state');
        $data['clientsate'] = $clientsate[0];
        $data['lead_prod_rent_det'] = $lead_prod_rent_det;
        $data['lead_prod_sale_det'] = $lead_prod_sale_det;
        $data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal' ORDER BY p.name ASC")->result_array();
        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
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
        $compbranchid = $this->session->userdata('staff_user_id'); //exit;
        $compnybranch_warehouse = $this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='" . $compbranchid . "' ORDER BY name ASC")->row_array();
        $warehouseid = explode(',', $compnybranch_warehouse['warehouse_id']);
        foreach ($warehouseid as $singlewarehouseid) {
            $warehousedata[] = $this->db->query("SELECT * FROM `tblwarehouse` where id='" . $singlewarehouseid . "' ORDER BY name ASC")->row_array();
        }
        $data['all_warehouse'] = $warehousedata;
        $this->load->model('Enquiryfor_model');
        $data['service_type'] = $this->Enquiryfor_model->get();
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
        $this->load->view('admin/estimates/perfoma_invoice', $data);
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
        if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && get_option('allow_staff_view_estimates_assigned') == '0') {
            echo _l('access_denied');
            die;
        }

        if (!$id) {
            die('No estimate found');
        }

        $estimate = $this->estimates_model->get($id);

        if (!$estimate || !user_can_view_estimate($id)) {
            echo _l('estimate_not_found');
            die;
        }

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
        if (!has_permission('estimates', '', 'edit')) {
            access_denied('estimates');
        }
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
            if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('Estimates');
            }
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
            if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('estimates');
            }
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
        if (!has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }
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
        if (!has_permission('estimates', '', 'create')) {
            access_denied('estimates');
        }
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

    /* Delete challan */

    public function clear_acceptance_info($id) {
        if (is_admin()) {
            $this->db->where('id', $id);
            $this->db->update('tblestimates', get_acceptance_info_array(true));
        }

        redirect(admin_url('estimates/list_estimates/' . $id));
    }

    /* Generates estimate PDF and senting to email  */

    /*public function pdf($id) {
        $canView = user_can_view_chalan($id);
        if (!$canView) {
            access_denied('Estimates');
        } else {
            if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('Estimates');
            }
        }
        if (!$id) {
            redirect(admin_url('estimates/list_estimates'));
        }
        $estimate = $this->estimates_model->getcreatedchalan($id);
        //$estimate_number = format_estimate_number($estimate->id);
        $estimate_number = $estimate->chalanno;

        try {
            $pdf = chalan_pdf($estimate);
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
    }*/


    public function pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $estimate = $this->estimates_model->getcreatedchalan($id);
        $estimate_number = $estimate->chalanno;

        $file_name = $estimate_number;

        /*echo $html = challan_pdf($estimate);
        die;*/

        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            $html = nturm_challan_pdf($estimate);
        }else{
            $html = challan_pdf($estimate);
        }
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
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

        $dompdf->stream($file_name, array("Attachment" => false));


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
            if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('Estimates');
            }
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

    public function return_challan($id = '') {



        //$data['challan_info'] = $this->db->query("SELECT cm.id,cm.chalanno,cm.addedfrom,cm.datecreated FROM `tblchalanmst` cm LEFT JOIN tblchallanapproval ca ON cm.`id`=ca.challan_id WHERE cm.rel_id='".$id."' AND (cm.`addedfrom`='".get_staff_user_id()."' OR ca.staff_id='".get_staff_user_id()."') GROUP BY cm.id desc")->result_array();

        $challan_ids = '0';
        $proforma_challan_info = $this->db->query("SELECT id FROM `tblproformachalan` where rel_id = '".$id."'")->result();
        if(!empty($proforma_challan_info)){
            foreach($proforma_challan_info as $proforma_challan){
                $info = $this->db->query("SELECT id FROM `tblchalanmst` where rel_type = 'proforma_challan' and service_type = '1' and rel_id = '".$proforma_challan->id."'")->row();
                if(!empty($info)){
                    $challan_ids .= ','.$info->id;
                }
            }
        }

        $data['challan_info'] = $this->db->query("SELECT id,chalanno,addedfrom,datecreated FROM `tblchalanmst`  WHERE id IN (".$challan_ids.") GROUP BY id desc")->result_array();

        $data['estimate_id'] = $id;


        $last_challan_info = $this->db->query("SELECT DISTINCT challan_id FROM tblchallanreturn where perfoma_id = '".$id."' and status = 1")->result_array();

       $challan_ids = array();
       if(!empty($last_challan_info)){
           foreach ($last_challan_info as $row) {
                $challan_ids[] = $row['challan_id'];
            }
       }

        $data['last_challan_info'] = $challan_ids;


        if(!empty($_POST)){
            extract($this->input->post());

           /* echo '<pre/>';
            print_r($_POST);
            die;*/
            if(!empty($challan_list)){
                foreach ($challan_list as $challan_id) {



                    $challan_info = $this->home_model->get_row('tblchalanmst', array('id'=>$challan_id), '');
                    $warehouse_id = $challan_info->warehouse_id;
                    $service_type = $challan_info->service_type;

                    $picktype = $_POST['picktype_'.$challan_id];

                    if($picktype == 1){

                         $insert_data_1 = array(
                                    'perfoma_id' => $perfoma_id,
                                    'challan_id' => $challan_id,
                                    'pickup_type' => $picktype,
                                    'pickup_count' => 1,
                                    'product_json' => '',
                                    'status' => 1,
                                    'created_at' => date('Y-m-d H:i:s')
                                );

                        $insert_1 = $this->home_model->insert('tblchallanreturn', $insert_data_1);

                        if($insert_1){
                            $return_id = $this->db->insert_id();

                            $chalancomponents=$this->db->query("SELECT * FROM `tblchalandetailsmst` WHERE `chalan_id`='".$challan_id."' ")->result();
                            if(!empty($chalancomponents)){
                                foreach ($chalancomponents as $value) {

                                        $total = $_POST['ttl_'.$challan_id.'_'.$value->component_id.''];
                                        $ok = $_POST['ok_'.$challan_id.'_'.$value->component_id.''];
                                        $non_repairable = $_POST['nr_'.$challan_id.'_'.$value->component_id.''];
                                        $repairable = $_POST['r_'.$challan_id.'_'.$value->component_id.''];
                                        $lost = $_POST['lost_'.$challan_id.'_'.$value->component_id.''];
                                        $pending = $_POST['pending_'.$challan_id.'_'.$value->component_id.''];
                                        $remark = $_POST['remark_'.$challan_id.'_'.$value->component_id.''];


                                        $insert_data_2 = array(
                                            'return_id' => $return_id,
                                            'perfoma_id' => $perfoma_id,
                                            'challan_id' => $challan_id,
                                            'component_id' => $value->component_id,
                                            'total' => $total,
                                            'ok' => $ok,
                                            'non_repairable' => $non_repairable,
                                            'repairable' => $repairable,
                                            'lost' => $lost,
                                            'pending' => $pending,
                                            'remark' => $remark,
                                            'status' => 1,
                                            'created_at' => date('Y-m-d H:i:s')
                                        );

                                        $insert_2 = $this->home_model->insert('tblchallanreturndetails', $insert_data_2);

                                        $prod_info = $this->db->query("SELECT `unit_id`,`unit_1`,`unit_2`,`size`,`conversion_1`,`conversion_2`,`width_mm` FROM `tblproducts` where `id`= '".$value->component_id."' ")->row();
                                        $product_size = 0;
                                        if($prod_info->unit_id == 7){
                                            $product_size = $prod_info->size;
                                        }elseif($prod_info->unit_1 == 7){
                                            $product_size = $prod_info->conversion_1;
                                        }elseif($prod_info->unit_2 == 7){
                                            $product_size = $prod_info->conversion_2;
                                        }
                                        //Adding Quantities to stock
                                        if(!empty($ok)){
                                            // $stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->component_id."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 1 ")->row();
                                            //  if(!empty($stock_info)){
                                            //     $n_qty = ($stock_info->qty + $ok);
                                            //     $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                            // }
											
											
											// Insert in tblproduct_store_log 
                                            $pdata['pro_id'] = $value->component_id;
                                            $pdata['warehouse_id'] = $warehouse_id;
                                            $pdata['service_type'] = $service_type;
                                            $pdata['size'] = $product_size;
                                            $pdata['width'] = $prod_info->width_mm;
                                            $pdata['total_qty'] = $ok;
                                            $pdata['qty'] = $ok;
                                            $pdata['ref_type'] = 'challan_return';
                                            $pdata['ref_id'] = $return_id;
                                            $pdata['main_store'] = 1;
                                            $pdata['material_status'] = 1;
                                            $pdata['date'] = date("Y-m-d");
                                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                                            $this->home_model->insert('tblproduct_store_log', $pdata);
                                        }

                                        if(!empty($non_repairable)){
                                            /*$stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->component_id."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 2 ")->row();
                                             if(!empty($stock_info)){
                                                $n_qty = ($stock_info->qty + $non_repairable);
                                                $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                            }else{

                                                $ad_data = array(
                                                        'pro_id' => $value->component_id,
                                                        'warehouse_id' => $warehouse_id,
                                                        'service_type' => $service_type,
                                                        'qty' => $non_repairable,
                                                        'store' => '1',
                                                        'is_pro' => '1',
                                                        'stock_type' => '2',
                                                        'status' => '1',
                                                        'created_at' => date('Y-m-d H:i:s'),
                                                        'updated_at' => date('Y-m-d H:i:s')
                                                    );

                                                $update = $this->home_model->insert('tblprostock', $ad_data);

                                            }*/
											
											// Insert in tblproduct_store_log 
                                            $pdata1['pro_id'] = $value->component_id;
                                            $pdata1['warehouse_id'] = $warehouse_id;
                                            $pdata1['service_type'] = $service_type;
                                            $pdata1['size'] = $product_size;
                                            $pdata1['width'] = $prod_info->width_mm;
                                            $pdata1['total_qty'] = $non_repairable;
                                            $pdata1['qty'] = $non_repairable;
                                            $pdata1['ref_type'] = 'challan_return';
                                            $pdata1['ref_id'] = $return_id;
                                            $pdata1['main_store'] = 1;
                                            $pdata1['scrap_store'] = 1;
                                            $pdata1['material_status'] = 2;
                                            $pdata1['date'] = date("Y-m-d");
                                            $pdata1['updated_at'] = date("Y-m-d H:i:s");

                                            $this->home_model->insert('tblproduct_store_log', $pdata1);
                                        }

                                        if(!empty($repairable)){
                                            /*$stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->component_id."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 3 ")->row();
                                             if(!empty($stock_info)){
                                                $n_qty = ($stock_info->qty + $repairable);
                                                $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                            }else{

                                                $ad_data = array(
                                                        'pro_id' => $value->component_id,
                                                        'warehouse_id' => $warehouse_id,
                                                        'service_type' => $service_type,
                                                        'qty' => $repairable,
                                                        'store' => '1',
                                                        'is_pro' => '1',
                                                        'stock_type' => '3',
                                                        'status' => '1',
                                                        'created_at' => date('Y-m-d H:i:s'),
                                                        'updated_at' => date('Y-m-d H:i:s')
                                                    );

                                                $update = $this->home_model->insert('tblprostock', $ad_data);

                                            }*/
											
											// Insert in tblproduct_store_log 
                                            $pdata2['pro_id'] = $value->component_id;
                                            $pdata2['warehouse_id'] = $warehouse_id;
                                            $pdata2['service_type'] = $service_type;
                                            $pdata2['size'] = $product_size;
                                            $pdata2['width'] = $prod_info->width_mm;
                                            $pdata2['total_qty'] = $repairable;
                                            $pdata2['qty'] = $repairable;
                                            $pdata2['main_store'] = 1;
                                            $pdata2['ref_type'] = 'challan_return';
                                            $pdata2['ref_id'] = $return_id;
                                            $pdata2['material_status'] = 3;
                                            $pdata2['date'] = date("Y-m-d");
                                            $pdata2['updated_at'] = date("Y-m-d H:i:s");

                                            $this->home_model->insert('tblproduct_store_log', $pdata2);
                                        }

                                        /*if(!empty($lost)){
                                            $stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->component_id."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 4 ")->row();
                                             if(!empty($stock_info)){
                                                $n_qty = ($stock_info->qty + $lost);
                                                $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                            }else{

                                                $ad_data = array(
                                                        'pro_id' => $value->component_id,
                                                        'warehouse_id' => $warehouse_id,
                                                        'service_type' => $service_type,
                                                        'qty' => $lost,
                                                        'store' => '1',
                                                        'is_pro' => '1',
                                                        'stock_type' => '4',
                                                        'status' => '1',
                                                        'created_at' => date('Y-m-d H:i:s'),
                                                        'updated_at' => date('Y-m-d H:i:s')
                                                    );

                                                $update = $this->home_model->insert('tblprostock', $ad_data);

                                            }
                                        }*/

                                }
                            }
                        }

                    }elseif($picktype == 2){

                        $product_arr = $_POST['product_'.$challan_id];

                        $productdata = array();

                        $productdata = array();

                        if(!empty($product_arr)){
                           foreach ($product_arr as $product_id) {
                              $taken_qty = $_POST['taken_'.$challan_id.'_'.$product_id];

                              $productdata[] = array(
                                              'product_id' => $product_id,
                                              'taken_qty' => $taken_qty
                                        );
                           }
                           $product_json = json_encode($productdata);

                             $i = 0;
                            $arrayh = array();
                            foreach ($productdata as $singleproductdata) {


                                $prodetails = $this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='" . $singleproductdata['product_id'] . "'")->row_array();

                                $getallrequriedcomponent = $this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id` ='" . $singleproductdata['product_id'] . "'")->result_array();
                                $proname[] = $prodetails['pro_name'];
                                foreach ($getallrequriedcomponent as $singlerequriedcomponent) {

                                    $requiredqty = $singleproductdata['taken_qty'] * $singlerequriedcomponent['qty'];

                                    $name = $singlerequriedcomponent['name'];

                                    if (!in_array($name, $arrayh)) {
                                        $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                                        $componentdata[$i]['name'] = $singlerequriedcomponent['name'];
                                        $componentdata[$i]['requiredqty'] = $requiredqty;
                                        $arrayh[] = $name;
                                    } else {
                                        $table = array_column($componentdata, 'name');
                                        $tt = array_search($name, $table);
                                        $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                                        $componentdata[$i]['name'] = $singlerequriedcomponent['name'];
                                        $componentdata[$i]['requiredqty'] = $componentdata[$tt]['requiredqty'] + $requiredqty;

                                    }



                                    $i++;
                                }
                            }

                            //New Logic


                            foreach($componentdata as $element) {
                                $hash = $element['componentid'];
                                $chalancomponents[$hash] = $element;
                            }


                            $last_info = $this->db->query("SELECT   COALESCE(MAX(pickup_count),0) as last_count FROM `tblchallanreturn` where perfoma_id = '".$perfoma_id."' and challan_id = '".$challan_id."' and status = 1")->row();
                            $pickup_count = ($last_info->last_count + 1);

                            $insert_data_1 = array(
                                        'perfoma_id' => $perfoma_id,
                                        'challan_id' => $challan_id,
                                        'pickup_type' => $picktype,
                                        'pickup_count' => $pickup_count,
                                        'product_json' => $product_json,
                                        'status' => 1,
                                        'created_at' => date('Y-m-d H:i:s')
                                    );

                            $insert_1 = $this->home_model->insert('tblchallanreturn', $insert_data_1);

                            if($insert_1){
                              $return_id = $this->db->insert_id();

                                 if(!empty($chalancomponents)){
                                            foreach ($chalancomponents as $row) {

                                                    $total = $_POST['ttl_'.$challan_id.'_'.$row['componentid'].''];
                                                    $ok = $_POST['ok_'.$challan_id.'_'.$row['componentid'].''];
                                                    $non_repairable = $_POST['nr_'.$challan_id.'_'.$row['componentid'].''];
                                                    $repairable = $_POST['r_'.$challan_id.'_'.$row['componentid'].''];
                                                    $lost = $_POST['lost_'.$challan_id.'_'.$row['componentid'].''];
                                                    $pending = $_POST['pending_'.$challan_id.'_'.$row['componentid'].''];
                                                    $remark = $_POST['remark_'.$challan_id.'_'.$row['componentid'].''];


                                                    $insert_data_2 = array(
                                                        'return_id' => $return_id,
                                                        'perfoma_id' => $perfoma_id,
                                                        'challan_id' => $challan_id,
                                                        'component_id' => $row['componentid'],
                                                        'total' => $total,
                                                        'ok' => $ok,
                                                        'non_repairable' => $non_repairable,
                                                        'repairable' => $repairable,
                                                        'lost' => $lost,
                                                        'pending' => $pending,
                                                        'remark' => $remark,
                                                        'status' => 1,
                                                        'created_at' => date('Y-m-d H:i:s')
                                                    );

                                                    $insert_2 = $this->home_model->insert('tblchallanreturndetails', $insert_data_2);

                                                    $prod_info = $this->db->query("SELECT `unit_id`,`unit_1`,`unit_2`,`size`,`conversion_1`,`conversion_2`,`width_mm` FROM `tblproducts` where `id`= '".$row['componentid']."' ")->row();
                                                    $product_size = 0;
                                                    if($prod_info->unit_id == 7){
                                                        $product_size = $prod_info->size;
                                                    }elseif($prod_info->unit_1 == 7){
                                                        $product_size = $prod_info->conversion_1;
                                                    }elseif($prod_info->unit_2 == 7){
                                                        $product_size = $prod_info->conversion_2;
                                                    }
                                                     //Adding Quantities to stock
                                                    if(!empty($ok)){
                                                        /*$stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$row['componentid']."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 1 ")->row();
                                                         if(!empty($stock_info)){
                                                            $n_qty = ($stock_info->qty + $ok);
                                                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                                        }*/
														
														// Insert in tblproduct_store_log
                                                        $pdata['pro_id'] = $row['componentid'];
                                                        $pdata['warehouse_id'] = $warehouse_id;
                                                        $pdata['service_type'] = $service_type;
                                                        $pdata['size'] = $product_size;
                                                        $pdata['width_mm'] = $prod_info->width_mm;
                                                        $pdata['total_qty'] = $ok;
                                                        $pdata['qty'] = $ok;
                                                        $pdata['ref_type'] = 'challan_return';
                                                        $pdata['ref_id'] = $return_id;
                                                        $pdata['main_store'] = 1;
                                                        $pdata['material_status'] = 1;
                                                        $pdata['date'] = date("Y-m-d");
                                                        $pdata['updated_at'] = date("Y-m-d H:i:s");

                                                        $this->home_model->insert('tblproduct_store_log', $pdata); 
                                                    }

                                                    if(!empty($non_repairable)){
                                                        /*$stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$row['componentid']."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 2 ")->row();
                                                         if(!empty($stock_info)){
                                                            $n_qty = ($stock_info->qty + $non_repairable);
                                                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                                        }else{

                                                            $ad_data = array(
                                                                    'pro_id' => $row->item_id,
                                                                    'warehouse_id' => $warehouse_id,
                                                                    'service_type' => $service_type,
                                                                    'qty' => $non_repairable,
                                                                    'store' => '1',
                                                                    'is_pro' => '1',
                                                                    'stock_type' => '2',
                                                                    'status' => '1',
                                                                    'created_at' => date('Y-m-d H:i:s'),
                                                                    'updated_at' => date('Y-m-d H:i:s')
                                                                );

                                                            $update = $this->home_model->insert('tblprostock', $ad_data);

                                                        }*/
														
														// Insert in tblproduct_store_log 
                                                        $pdata1['pro_id'] = $row['componentid'];
                                                        $pdata1['warehouse_id'] = $warehouse_id;
                                                        $pdata1['service_type'] = $service_type;
                                                        $pdata1['size'] = $product_size;
                                                        $pdata1['width_mm'] = $prod_info->width_mm;
                                                        $pdata1['total_qty'] = $non_repairable;
                                                        $pdata1['qty'] = $non_repairable;
                                                        $pdata1['ref_type'] = 'challan_return';
                                                        $pdata1['ref_id'] = $return_id;
                                                        $pdata1['main_store'] = 1;
                                                        $pdata1['scrap_store'] = 1;
                                                        $pdata1['material_status'] = 2;
                                                        $pdata1['date'] = date("Y-m-d");
                                                        $pdata1['updated_at'] = date("Y-m-d H:i:s");

                                                        $this->home_model->insert('tblproduct_store_log', $pdata1);
                                                        
                                                    }

                                                    if(!empty($repairable)){
                                                        /*$stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$row['componentid']."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 3 ")->row();
                                                         if(!empty($stock_info)){
                                                            $n_qty = ($stock_info->qty + $repairable);
                                                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                                        }else{

                                                            $ad_data = array(
                                                                    'pro_id' => $row['componentid'],
                                                                    'warehouse_id' => $warehouse_id,
                                                                    'service_type' => $service_type,
                                                                    'qty' => $repairable,
                                                                    'store' => '1',
                                                                    'is_pro' => '1',
                                                                    'stock_type' => '3',
                                                                    'status' => '1',
                                                                    'created_at' => date('Y-m-d H:i:s'),
                                                                    'updated_at' => date('Y-m-d H:i:s')
                                                                );

                                                            $update = $this->home_model->insert('tblprostock', $ad_data);

                                                        }*/
														// Insert in tblproduct_store_log 
                                                        $pdata2['pro_id'] = $row['componentid'];
                                                        $pdata2['warehouse_id'] = $warehouse_id;
                                                        $pdata2['service_type'] = $service_type;
                                                        $pdata2['size'] = $product_size;
                                                        $pdata2['width_mm'] = $prod_info->width_mm;
                                                        $pdata2['total_qty'] = $repairable;
                                                        $pdata2['qty'] = $repairable;
                                                        $pdata2['main_store'] = 1;
                                                        $pdata2['ref_type'] = 'challan_return';
                                                        $pdata2['ref_id'] = $return_id;
                                                        $pdata2['material_status'] = 3;
                                                        $pdata2['date'] = date("Y-m-d");
                                                        $pdata2['updated_at'] = date("Y-m-d H:i:s");

                                                        $this->home_model->insert('tblproduct_store_log', $pdata2);
                                                    }

                                                    /*if(!empty($lost)){
                                                        $stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$row['componentid']."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and store = 1 and status = 1 and stock_type = 4 ")->row();
                                                         if(!empty($stock_info)){
                                                            $n_qty = ($stock_info->qty + $lost);
                                                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                                                        }else{

                                                            $ad_data = array(
                                                                    'pro_id' => $row['componentid'],
                                                                    'warehouse_id' => $warehouse_id,
                                                                    'service_type' => $service_type,
                                                                    'qty' => $lost,
                                                                    'store' => '1',
                                                                    'is_pro' => '1',
                                                                    'stock_type' => '4',
                                                                    'status' => '1',
                                                                    'created_at' => date('Y-m-d H:i:s'),
                                                                    'updated_at' => date('Y-m-d H:i:s')
                                                                );

                                                            $update = $this->home_model->insert('tblprostock', $ad_data);

                                                        }
                                                    }*/

                                            }

                                }




                            }

                        }

					}



                }
            }

            if($insert_1 == true){
                set_alert('success', 'Record Added Successfully');
                redirect(admin_url('estimates/list_estimates'));
            }else{
                set_alert('warning', 'Some Error Occurred!');
                redirect(admin_url('estimates/list_estimates'));
            }
        }



        $this->load->view('admin/chalan/return_challan', $data);
    }


     public function get_challan_products() {
        if(!empty($_POST)){
            extract($this->input->post());
            $challan_info = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='".$challan_id."'")->row();
            $client_info = $this->db->query("SELECT * FROM `tblclients` WHERE `userid`='".$challan_info->clientid."'")->row();

            $last_info = $this->db->query("SELECT * FROM `tblchallanreturn` WHERE `challan_id`='".$challan_id."' and status = 1 ")->result();

            $product_arr = explode(',',$challan_info->pro_id);

            $product_details = json_decode($challan_info->product_json);
            ?>

            <div id="main_<?php echo $challan_id; ?>" class="row">
            <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Challan Details</h3><br>
                <div class="col-md-6">
                    <h4>Challan No. :- <?php echo $challan_info->chalanno; ?></h4>
                     <h4>Client Name :- <?php if(!empty($client_info)){ echo $client_info->company; }else{ echo '--';} ?></h4>
                </div>

                <div class="col-md-6">
                    <h4>Warehouse :- <?php echo value_by_id('tblwarehouse',$challan_info->warehouse_id,'name'); ?></h4>
                     <h4>Challan For <?php echo value_by_id('tblenquiryformaster',$challan_info->service_type,'name'); ?></h4>
                </div>

            </div>
            <div class="<?php if(empty($last_info)){ echo 'col-md-12';}else{ echo 'col-md-8'; } ?>">
                <h4 class="text-center">Product Details</h4>
                 <div class="tabel-responsive" style="margin-bottom:30px;">
             <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                    <thead>
                        <tr>
                            <th align="center">S.No</th>
                            <th align="center">Product Name</th>
                            <th align="center">Qty</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <?php
                        if(!empty($product_details)){
                            $i =  1;
                            foreach ($product_details as $value) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $i++; ?></td>
                                    <td align="center"><?php echo value_by_id('tblproducts',$value->product_id,'name')." (PRO - " . number_series($value->product_id).')'; ?></td>
                                    <td align="center"><?php echo $value->product_qty; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>

                </table>
                </div>
            </div>

            <?php
            if(!empty($last_info)){
                ?>
                <div class="col-md-4">
                    <h4 class="text-center">Last Pickup Details</h4>
                     <div class="tabel-responsive" style="margin-bottom:30px;">
                   <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                        <thead>
                            <tr>
                                <th align="center">S.No</th>
                                <th align="center">Pickup Type</th>
                                <th align="center">Pickup</th>
                                <th align="center">Pickup Date</th>
                            </tr>
                        </thead>
                        <tbody class="ui-sortable">
                            <?php
                            if(!empty($last_info)){
                                $i = 1;
                                foreach ($last_info as $value) {
                                    if($value->pickup_type == 1){
                                        $pickup_type = 'Full Pickup';
                                    }else{
                                        $pickup_type = 'Part Pickup';
                                    }
                                 ?>

                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td align="center"><a href="<?php echo base_url('admin/chalan/view_pickup/'.$value->id);?>" target="_blank"><?php echo $pickup_type; ?></a></td>
                                    <td align="center"><a href="<?php echo base_url('admin/chalan/view_pickup/'.$value->id);?>" target="_blank"><?php echo $value->pickup_count.get_superscript($value->pickup_count).' Pickup'; ?></a></td>
                                    <td align="center"><?php echo date('d-m-Y',strtotime($value->created_at)); ?></td>
                                </tr>
                                <?php
                                }
                            }
                            ?>
                        </tbody>

                </table>
                    </div>
                </div>
                <?php
            }

            $check_pickup = $this->db->query("SELECT * FROM `tblchallanreturn` WHERE `challan_id`='".$challan_id."' and status = 1 ")->row();
            ?>


            <div class="col-md-12">
                 <div class="col-md-6">
                        <div class="form-group">
                            <label for="picktype_<?php echo $challan_id;?>" class="control-label">Pickup Type *</label>
                            <select class="form-control picktype" id="picktype_<?php echo $challan_id;?>" name="picktype_<?php echo $challan_id;?>" required="">
                                <option value="">--Select Pickup Type--</option>

                                <?php
                                if(empty($check_pickup)){
                                    echo '<option value="1">Full Pickup</option>';
                                }
                                ?>
                                <option value="2">Part Pickup</option>

                            </select>
                        </div>
                  </div>

                 <div class="col-md-6">
                    <div id="productdiv_<?php echo $challan_id; ?>">

                    </div>


                 </div>

            </div>
            </div>

            <div id="challandiv_<?php echo $challan_id; ?>">


            </div>
            </div>


            <?php

        }

     }



    public function get_challan_products_list() {
    if(!empty($_POST)){
        extract($this->input->post());
        $challan_info = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='".$challan_id."'")->row();
       // $product_arr = explode(',',$challan_info->pro_id);

        $product_arr = json_decode($challan_info->product_json);

        ?>
        <div class="tabel-responsive" style="margin-bottom:30px;">
             <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                    <thead>
                        <tr>
                            <th align="center">S.No</th>
                            <th align="center">Product Name</th>
                            <th align="center">Qty</th>
                            <th align="center">Taken</th>
                            <th align="center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <?php
                        if(!empty($product_arr)){
                            foreach ($product_arr as $key => $row) {

                                 $ttl_taken = 0;
                                 $challan_info = $this->db->query("SELECT * FROM `tblchallanreturn` WHERE `challan_id`='".$challan_id."' and pickup_type = 2 ")->result();
                                 if(!empty($challan_info)){
                                    foreach ($challan_info as $value) {
                                        $product_dtl = json_decode($value->product_json);
                                        if(!empty($product_dtl)){
                                            foreach ($product_dtl as $val) {
                                                if($val->product_id == $row->product_id){
                                                    $ttl_taken += $val->taken_qty;
                                                }
                                            }
                                        }
                                    }
                                 }

                                 $product_qty = ($row->product_qty - $ttl_taken);
                                ?>
                                <tr>
                                    <td align="center"><?php echo $key+1; ?></td>
                                    <td align="center"><?php echo value_by_id('tblproducts',$row->product_id,'name')." (PRO - " . number_series($row->product_id).')'; ?></td>

                                    <?php
                                    if(!empty($challan_info)){
                                        echo '<td><button type="button" val="'.$challan_id.'" value="'.$row->product_id.'" class="btn btn-info btn-sm pickup" data-toggle="modal" data-target="#productlistmodel">'.$product_qty.'</button></td>';
                                    }else{
                                        echo '<td align="center">'.$product_qty.'</td>';
                                    }
                                    ?>

                                    <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" p_qty="<?php echo $product_qty; ?>" pro="<?php echo $row->product_id; ?>" class="qty product_id_<?php echo $challan_id; ?>" id="" name="<?php echo 'taken_'.$challan_id.'_'.$row->product_id; ?>" type="text"></td>

                                    <td align="center"><input class="product_id" type="checkbox"  value="<?php echo $row->product_id; ?>" name="product_<?php echo $challan_id; ?>[]"></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>



                    </tbody>

            </table>
            <div class="text-right"><button type="button" value="<?php echo $challan_id; ?>" class="get_data btn btn-success">Get Components</button></div>


        </div>
            <?php

        }

    }

    public function get_challan_component() {
        if(!empty($_POST)){
            extract($this->input->post());

             $chalancomponents=$this->db->query("SELECT * FROM `tblchalandetailsmst` WHERE `chalan_id`='".$challan_id."' ")->result();

            if(!empty($chalancomponents)){
                ?>

                <div class="tabel-responsive" style="margin-bottom:30px;">
                     <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                            <thead>
                                <tr>
                                    <th style="width:30%" align="center">Component Name</th>
                                    <th style="width:7%" align="center">Total</th>
                                    <th style="width:8%" align="center">Ok</th>
                                    <th style="width:8%" align="center">Non Repairable</th>
                                    <th style="width:8%" align="center">Repairable</th>
                                    <th style="width:8%" align="center">Lost</th>
                                    <th style="width:8%" align="center">Pending</th>
                                    <th style="width:8%" align="center">Remark</th>
                                </tr>
                            </thead>

                            <tbody class="ui-sortable">
                                <?php
                                foreach ($chalancomponents as  $row) {

                                         $title = '';
                                         if($row->required_qty != $row->deleverable_qty){
                                            $title = 'Required quantity was ('.$row->required_qty.') but you delivered ('.$row->deleverable_qty.')';
                                         }
                                      ?>
                                        <tr>
                                            <td align="center"><span <?php if(!empty($title)){ ?>style="background: red; color:white; padding: 5px;" <?php } ?> data-toggle="tooltip" data-placement="bottom" title="<?php echo $title; ?>"><?php echo value_by_id('tblproducts',$row->component_id,'name'); ?></span></td>


                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" <?php if(empty($title)){ echo 'readonly'; } ?> required name="<?php echo 'ttl_'.$challan_id.'_'.$row->component_id.''; ?>" id="<?php echo 'ttl_'.$challan_id.'_'.$row->component_id.''; ?>"  type="text" value="<?php if(empty($title)){ echo $row->required_qty; } ?>"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="qty" id="<?php echo 'ok_'.$challan_id.'_'.$row->component_id.''; ?>" name="<?php echo 'ok_'.$challan_id.'_'.$row->component_id.''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="qty" id="<?php echo 'nr_'.$challan_id.'_'.$row->component_id.''; ?>" name="<?php echo 'nr_'.$challan_id.'_'.$row->component_id.''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="qty" id="<?php echo 'r_'.$challan_id.'_'.$row->component_id.''; ?>" name="<?php echo 'r_'.$challan_id.'_'.$row->component_id.''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="qty" id="<?php echo 'lost_'.$challan_id.'_'.$row->component_id.''; ?>" name="<?php echo 'lost_'.$challan_id.'_'.$row->component_id.''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" id="<?php echo 'pending_'.$challan_id.'_'.$row->component_id.''; ?>" name="<?php echo 'pending_'.$challan_id.'_'.$row->component_id.''; ?>" type="text"></td>

                                            <td align="center"><textarea name="<?php echo 'remark_'.$challan_id.'_'.$row->component_id.''; ?>" style="height: 36px;" class=""> </textarea></td>
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


    public function get_challan_product_component() {
        if(!empty($_POST)){
            extract($this->input->post());


             $product_str = '';

            foreach ($arr as $value) {
            	foreach ($value as $r1) {
            		 $productdata[] = array(
	     				'pro_id' =>$r1[1],
	     				'qty' => $r1[0]
	     			);

                    $product_str .= value_by_id('tblproducts',$r1[1],'name').', ';
            	}
            }

            $product_str = rtrim($product_str,", ");

            $i = 0;
		$arrayh = array();
		foreach ($productdata as $singleproductdata) {


			$prodetails = $this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='" . $singleproductdata['pro_id'] . "'")->row_array();

			$getallrequriedcomponent = $this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id` ='" . $singleproductdata['pro_id'] . "'")->result_array();
			$proname[] = $prodetails['pro_name'];
			foreach ($getallrequriedcomponent as $singlerequriedcomponent) {

				$requiredqty = $singleproductdata['qty'] * $singlerequriedcomponent['qty'];

				$name = $singlerequriedcomponent['name'];

				if (!in_array($name, $arrayh)) {
					$componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
					$componentdata[$i]['name'] = $singlerequriedcomponent['name'];
					$componentdata[$i]['requiredqty'] = $requiredqty;
					$arrayh[] = $name;
				} else {
					$table = array_column($componentdata, 'name');
					$tt = array_search($name, $table);
					$componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
					$componentdata[$i]['name'] = $singlerequriedcomponent['name'];
					$componentdata[$i]['requiredqty'] = $componentdata[$tt]['requiredqty'] + $requiredqty;

				}



				$i++;
			}
		}

		//New Logic
		foreach($componentdata as $element) {
			$hash = $element['componentid'];
			$chalancomponents[$hash] = $element;
		}


             //$chalancomponents=$this->db->query("SELECT * FROM `tblproductitems` WHERE  product_id = '".$product_id."' and status = 1")->result();

              $last_info = $this->db->query("SELECT   COALESCE(MAX(pickup_count),0) as last_count FROM `tblchallanreturn` where challan_id = '".$challan_id."' and status = 1")->row();
             $pickup_count = ($last_info->last_count + 1);

            if(!empty($chalancomponents)){
                ?>

                <div id="<?php echo 'challanproduct_'.$challan_id; ?>">

                <h3 class="text-center"><u><?php echo $pickup_count.get_superscript($pickup_count).' Pickup'; ?></u></h3>
                <h4>Product Name :- <?php echo $product_str; ?></h4>

                <div class="tabel-responsive" style="margin-bottom:30px;">
                     <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                            <thead>
                                <tr>
                                    <th style="width:30%" align="center">Item Name</th>
                                    <th style="width:7%" align="center">Total</th>
                                    <th style="width:8%" align="center">Ok</th>
                                    <th style="width:8%" align="center">Non Repairable</th>
                                    <th style="width:8%" align="center">Repairable</th>
                                    <th style="width:8%" align="center">Lost</th>
                                    <th style="width:8%" align="center">Pending</th>
                                    <th style="width:8%" align="center">Remark</th>
                                </tr>
                            </thead>

                            <tbody class="ui-sortable">
                                <?php
                                foreach ($chalancomponents as  $row) {

                                        //$qty = ($row->qty*$r_qty);


                                         $title = '';
                                         $ttl_taken = 0;
                                         $comp_info = $this->db->query("SELECT * FROM `tblchalandetailsmst` WHERE  chalan_id = '".$challan_id."' and component_id = '".$row['componentid']."' ")->row();
                                         if(!empty($comp_info) && $comp_info->required_qty != $comp_info->deleverable_qty){


                                            $last_info = $this->db->query("SELECT COALESCE(SUM(total),0) AS ttl FROM tblchallanreturndetails WHERE challan_id = '".$challan_id."' and component_id = '".$row['componentid']."' and status = 1")->row();
                                           $ttl_taken = $last_info->ttl;

                                            $bal_qty = ($comp_info->deleverable_qty - $ttl_taken);




                                            $title = 'Required quantity was ('.$comp_info->required_qty.') but you delivered ('.$comp_info->deleverable_qty.') . Balanced quantity is ('.$bal_qty.')';
                                         }





                                      ?>
                                        <tr>
                                            <td align="center"><span <?php if(!empty($title)){ ?>style="background: red; color:white; padding: 5px;" <?php } ?> data-toggle="tooltip" data-placement="bottom" title="<?php echo $title; ?>"><?php echo value_by_id('tblproducts',$row['componentid'],'name'); ?></span></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" <?php if(empty($title)){ echo 'readonly'; } ?> required name="<?php echo 'ttl_'.$challan_id.'_'.$row['componentid'].''; ?>" id="<?php echo 'ttl_'.$challan_id.'_'.$row['componentid'].''; ?>"  type="text" value="<?php if(empty($title)){ echo $row['requiredqty']; } ?>"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="part_qty" id="<?php echo 'ok_'.$challan_id.'_'.$row['componentid'].''; ?>" name="<?php echo 'ok_'.$challan_id.'_'.$row['componentid'].''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="part_qty" id="<?php echo 'nr_'.$challan_id.'_'.$row['componentid'].''; ?>" name="<?php echo 'nr_'.$challan_id.'_'.$row['componentid'].''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="part_qty" id="<?php echo 'r_'.$challan_id.'_'.$row['componentid'].''; ?>" name="<?php echo 'r_'.$challan_id.'_'.$row['componentid'].''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" class="part_qty" id="<?php echo 'lost_'.$challan_id.'_'.$row['componentid'].''; ?>" name="<?php echo 'lost_'.$challan_id.'_'.$row['componentid'].''; ?>" type="text"></td>

                                            <td align="center"><input oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="0" id="<?php echo 'pending_'.$challan_id.'_'.$row['componentid'].''; ?>" name="<?php echo 'pending_'.$challan_id.'_'.$row['componentid'].''; ?>" type="text"></td>

                                            <td align="center"><textarea name="<?php echo 'remark_'.$challan_id.'_'.$row['componentid'].''; ?>" style="height: 36px;" class=""> </textarea></td>
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


     public function last_pickup_model() {
        if(!empty($_POST)){
            extract($this->input->post());


            $last_info = $this->db->query("SELECT * FROM `tblchallanreturn` WHERE  challan_id = '".$challan_id."' and status = 1 order by pickup_count asc")->result();

            $challan_info = $this->home_model->get_row('tblchalanmst', array('id'=>$challan_id), '');
            ?>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Challan Number :- <?php echo $challan_info->chalanno; ?></h4>
            </div>
            <div class="modal-body">
                 <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                        <thead>
                            <tr>
                                <th align="center">S.No</th>
                                <th align="center">Product Name</th>
                                <th align="center">Pickup</th>
                                <th align="center">Pickup Qty</th>
                                <th align="center">Pickup Date</th>
                            </tr>
                        </thead>
                        <tbody class="ui-sortable">
                            <?php
                            if(!empty($last_info)){
                                $i = 1;
                                foreach ($last_info as $value) {
                                    $product_arr = json_decode($value->product_json);
                                    if(!empty($product_arr)){
                                        foreach ($product_arr as $row) {
                                            if($row->product_id == $product_id){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td align="center"><?php echo value_by_id('tblproducts',$row->product_id,'name'); ?></td>
                                                    <td align="center"><?php echo $value->pickup_count.get_superscript($value->pickup_count).' Pickup'; ?></td>
                                                    <td align="center"><?php echo $row->taken_qty; ?></td>
                                                    <td align="center"><?php echo date('d-m-Y',strtotime($value->created_at)); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>

                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

            <?php

        }

    }

    public function view_pickup($id) {

        if(!empty($id)){
            $data['return_info'] = $this->db->query("SELECT * FROM `tblchallanreturn` WHERE `id`='" .$id. "'")->row();
            $data['challan_info'] = $this->home_model->get_row('tblchalanmst', array('id'=>$data['return_info']->challan_id), '');
            $data['returndtl_info'] = $this->db->query("SELECT * FROM `tblchallanreturndetails` WHERE `return_id`='" .$id. "'")->result();



            $this->load->view('admin/chalan/view_pickup', $data);
        }

    }


    public function make_delivery() {
        if(!empty($_POST)){
            extract($this->input->post());

            $redirecturl = (isset($request_type) && $request_type == "deliveryorder") ? 'estimates/delivery_order_list' : 'chalan/created';

            $challan_manage_id = $this->db->query("SELECT `challan_manage_id` FROM `tblcompanybranch` WHERE `id` = '".$branch_id."' ")->row()->challan_manage_id;
            if(empty($challan_manage_id)){
                set_alert('warning', 'Responsible person is not allotted to handle this request!');
                redirect(admin_url($redirecturl));
                die;
            }

            $delivery_date = str_replace("/","-",$delivery_date);
            $delivery_date = date("Y-m-d",strtotime($delivery_date));

            if($for == 1){
                $text_status = 'Delivery challan assign';
            }else{
                $text_status = 'Pickup challan assign';
            }
            $insert_data = array(
                        'staff_id' => get_staff_user_id(),
                        'chalan_id' => $chalan_id,
                        'for' => $for,
                        'priority' => $priority,
                        'date' => $delivery_date,
                        'description' => $description,
                        'status' => 1,
                        'status_id' => 1,
                        'text_status' => $text_status,
                        'created_at' => date('Y-m-d')
                    );

            $insert = $this->home_model->insert('tblchallanprocess', $insert_data);

            if($insert == true){

                $challanprocess_id = $this->db->insert_id();

                $this->home_model->update('tblchalanmst', array('process'=>$for,'under_process'=>1), array('id'=>$chalan_id));
                /* this is for update delivery order status in the case of request send from delevery section */
                if (isset($request_type) && $request_type == "deliveryorder"){
                     
                    $this->home_model->update(' tblconfirmorder', array('delivery_complete_status'=>1), array('id'=>$confirm_order_id));
                }
                /*if(!empty($staff_info)){
                    foreach($staff_info as $row)
                    {*/
                        $staffid = $challan_manage_id;

                        $prdata['staff_id']=$staffid;
                        $prdata['challanprocess_id']=$challanprocess_id;
                        $prdata['status']=1;
                        $this->db->insert('tblchallanallotperson',$prdata);

                        if($for == 1){
                            $message = 'Delivery challan allotted to you assign';
                        }else{
                            $message = 'Pickup challan allotted to you assign';
                        }

                        //Sending Mobile Intimation
                        $token = get_staff_token($staffid);
                        $title = 'SSAFE';
                        $send_intimation = sendFCM($message, $title, $token);


                        $notified = add_notification([
                                    'description'     => $message,
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

                set_alert('success', 'Challan allotted successfully to manager');
                redirect(admin_url($redirecturl));

            }

        }
    }


    public function get_handover_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $process_info = $this->db->query("SELECT * from tblchallanprocess where chalan_id = '".$challan_id."' and `for` = '".$type."' and complete = 1 ")->row();

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

        set_alert('success', 'Challan completed successfully');
        redirect(admin_url('chalan/created'));
    }


    public function challan_upload() {
        if(!empty($_POST)){
            extract($this->input->post());


            handle_multi_attachments($process_id,'challan_final');

            set_alert('success', 'File Uploaded successfully');
            redirect(admin_url('chalan/created'));
        }
    }

    public function challan_eway_upload() {
        if(!empty($_POST)){
            extract($this->input->post());

            handle_multi_attachments($process_id,'eway_upload');
            set_alert('success', 'Eway Bill Uploaded successfully');
            redirect(admin_url('chalan/created'));
        }
    }

    public function get_uploads_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'challan_final' and rel_id = '".$process_id."' ")->result();

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
                            <td><a target="_blank" href="<?php echo base_url('uploads/challan/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></td>
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

    public function get_ewayuploads_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $file_info = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_type` = 'eway_upload' AND `rel_id` = '".$process_id."' ORDER BY `id` DESC")->result();

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
                            <td><a target="_blank" href="<?php echo base_url('uploads/challan/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></td>
                            <td><?php echo _d($file->dateadded); ?></td>
                            <td><a href="<?php echo admin_url('chalan/delete_ewaybills/'.$file->id.'/'.$file->rel_id); ?>" class="btn-sm btn-danger _delete"><i class="fa fa-trash"></i></a></td>
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

    public function delete_ewaybills($id, $challan_id){

        $filename = value_by_id('tblfiles', $id, "file_name");
        $response = $this->home_model->delete('tblfiles', array('rel_type' => 'eway_upload', 'id' => $id));
        if($response){
            $path = get_upload_path_by_type('eway_upload') . $challan_id . '/'.$filename;
            unset($path);
            set_alert('success', "Eway Bill Deleted succesfully");
            redirect(admin_url('chalan/created'));
        }else{
            set_alert('danger', "Something went wrong");
            redirect(admin_url('chalan/created'));
        }
    }

    public function edit_challan($id = '') {
        $this->load->model('Estimates_model');

        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            // echo '<pre/>';
            // print_r($proposal_data);
            // die;
            $success = $this->Estimates_model->updatechalan($proposal_data,$id);
            if($success){

                $chk_consumed_log = $this->db->query("SELECT * FROM tblstore_challan_consumed_log WHERE `challan_id`= '".$id."' AND `table_type` = 1 ")->result();
                if (!empty($chk_consumed_log)){
                    foreach ($chk_consumed_log as $clog) {
                        
                        $proqty = value_by_id("tblproduct_store_log", $clog->table_id, "qty");
                        $finalqty = $clog->consumed_qty + $proqty;
                        $this->home_model->update('tblproduct_store_log', array('qty'=>$finalqty, "updated_at" => date("Y-m-d H:i:s")), array('id'=>$clog->table_id));

                        $this->home_model->delete("tblstore_challan_consumed_log", array('id'=>$clog->id));
                    }
                    /* this is for deleted record */
                    $this->home_model->delete("tblproduct_store_log", array("ref_type" => 'challan_created', "ref_id" => $id));
                }

                $chk_consumed_log = $this->db->query("SELECT * FROM tblstore_challan_consumed_log WHERE `challan_id`= '".$id."' AND `table_type` = 2 ")->result();
                if (!empty($chk_consumed_log)){
                    foreach ($chk_consumed_log as $clog) {
                        
                        $proqty = value_by_id("tblprostock", $clog->table_id, "qty");
                        $finalqty = $clog->consumed_qty + $proqty;
                        $this->home_model->update('tblprostock', array('qty'=>$finalqty, "updated_at" => date("Y-m-d H:i:s")), array('id'=>$clog->table_id));

                        $this->home_model->delete("tblstore_challan_consumed_log", array('id'=>$clog->id));
                    }
                }

                // $chk_product_log = $this->db->query("SELECT * FROM `tblproduct_store_log` where `ref_type`= 'challan_created' and ref_id = '".$id."' order by qty ASC")->row();
                // if (!empty($chk_product_log)){
                //     $logdata = $this->db->query("SELECT * FROM `tblproduct_store_log` where finish_goods_store = 1 and material_status = 1 and pro_id = '".$chk_product_log->pro_id."' and warehouse_id = '".$chk_product_log->warehouse_id."' and service_type = '".$chk_product_log->service_type."' order by qty ASC")->row();
                //     if(!empty($logdata)){
                //         $finalqty = $logdata->qty + $chk_product_log->total_qty;
                //         $this->home_model->update('tblproduct_store_log', array('qty'=>$finalqty, "updated_at" => date("Y-m-d H:i:s")), array('id'=>$logdata->id));
                //     }

                //     /* this is for deleted record */
                //     $this->home_model->delete("tblproduct_store_log", array("id" => $chk_product_log->id));

                //     /* this is for update product stock qty */
                //     $getprostock = $this->db->query("SELECT * FROM `tblprostock` WHERE pro_id = '".$chk_product_log->pro_id."' and warehouse_id = '".$chk_product_log->warehouse_id."' and service_type = '".$chk_product_log->service_type."' and stock_type = 1 and department_id = 0 and status = 1")->row();
                //     if (!empty($getprostock)){
                        
                //         $stockqty = number_format($getprostock->qty, 2) + number_format($chk_product_log->total_qty, 2);
                //         $this->home_model->update("tblprostock", array("qty" => $stockqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $getprostock->id));
                //     }
                // }

                set_alert('success', _l('updated_successfully', _l('challan')));
                redirect(admin_url('chalan/created'));
            }

        }
        $data['challan_info'] = $this->db->query("SELECT * from tblchalanmst where id = '".$id."' ")->row();
        $data['components_info'] = $this->db->query("SELECT * from tblchalandetailsmst where chalan_id = '".$id."' ")->result_array();
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`sub_name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 ORDER BY name ASC ")->result_array();

        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ORDER BY name ASC ")->result_array();
        $data['title'] = 'Edit Challan';
        $this->load->view('admin/chalan/edit_challan', $data);

    }

    public function get_components() {
        if ($this->input->post()) {
            extract($this->input->post());
            $challan_info = $this->db->query("SELECT * from tblchalanmst where id = '".$id."' ")->row_array();

            $i = 0;
            $arrayh = array();
            foreach ($productdata as $singleproductdata) {
                $warehouse_id = $challan_info['warehouse_id'];
                $service_type = $challan_info['service_type'];
                $pro_id[] = $singleproductdata['product_id'];
                $yy = $warehouse_id;
                $prodetails = $this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='" . $singleproductdata['product_id'] . "'")->row_array();

                $getallrequriedcomponent = $this->db->query("SELECT tc.`sub_name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id` ='" . $singleproductdata['product_id'] . "'")->result_array();
                foreach ($getallrequriedcomponent as $singlerequriedcomponent) {

                    $checkwarehousedet = $this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='" . $singlerequriedcomponent['id'] . "' AND `service_type`='" . $service_type . "' AND `stock_type` = 1 AND (`warehouse_id`=" . $yy . ")  AND (staff_id = 0 || staff_id = '".get_staff_user_id()."')")->row_array();
                    $requiredqty = $singleproductdata['product_qty'] * $singlerequriedcomponent['qty'];
                    if ($checkwarehousedet['totalqty'] > 0) {
                        $availableqty = $checkwarehousedet['totalqty'];
                    } else {
                        $availableqty = 0;
                    }
                    $remainingqty = $availableqty - $requiredqty;
                    $name = $singlerequriedcomponent['sub_name'];

                    if (!in_array($name, $arrayh)) {
                        $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                        $componentdata[$i]['name'] = $singlerequriedcomponent['sub_name'];
                        //$componentdata[$i]['qty']=$singlerequriedcomponent['qty'];
                        $componentdata[$i]['requiredqty'] = $requiredqty;
                        $componentdata[$i]['availableqty'] = $availableqty;
                        $componentdata[$i]['remainingqty'] = $remainingqty;
                        $arrayh[] = $name;
                    } else {
                        $table = array_column($componentdata, 'name');
                        $tt = array_search($name, $table);
                        $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                        $componentdata[$i]['name'] = $singlerequriedcomponent['sub_name'];
                        //$componentdata[$i]['qty']=$componentdata[$tt]['qty']+$singlerequriedcomponent['qty'];
                        $componentdata[$i]['requiredqty'] = $componentdata[$tt]['requiredqty'] + $requiredqty;
                        //$componentdata[$i]['availableqty'] = $componentdata[$tt]['availableqty'] + $availableqty;
                        $componentdata[$i]['availableqty'] = $componentdata[$tt]['availableqty'] ;
                        $componentdata[$i]['remainingqty'] = $componentdata[$tt]['remainingqty'] + $remainingqty;

                    }

                    $i++;
                }
            }

            foreach($componentdata as $element) {
                $hash = $element['componentid'];
                $unique_array[$hash] = $element;
            }

            ?>
            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                <thead>
                    <tr>
                        <th width="25%" align="center">Item Name</th>
                        <th width="15%" align="center">Req Qty</th>
                        <th width="15%" align="center">Deliverable Quantity</th>
                        <th width="20%" align="center">Chalan Status</th>
                        <th width="10%" align="center">Pending</th>
                        <th width="5%" align="center"></th>
                    </tr>
                </thead>
                <tbody class="ui-sortable" style="font-size:15px;">
                    <?php
                    $k = 0;
                    if(!empty($unique_array)){
                        foreach ($unique_array as $singlerequriedcomponent) {



                            $deliverableqty = $singlerequriedcomponent['requiredqty'];

                            ?>
                            <tr class="main" id="tr<?php echo $k; ?>">
                                <td width="25%" align="left">
                                    <div class="form-group"><input type="hidden" name="componentdata[<?php echo $k; ?>][componentid]" value="<?php echo $singlerequriedcomponent['componentid']; ?>"><?php echo value_by_id('tblproducts',$singlerequriedcomponent['componentid'],'sub_name'); ?></div>
                                </td>

                                <td width="15" align="center"><input type="hidden" id="reqqty<?php echo $k; ?>" name="componentdata[<?php echo $k; ?>][requiredqty]" value="<?php echo $deliverableqty; ?>"><?php echo $deliverableqty; ?></td>


                                <td width="10%" align="center"><input class="form-control deliver_qty" id="deliverableqty<?php echo $k; ?>"  type="text" name="componentdata[<?php echo $k; ?>][deliverableqty]" value="<?php echo $deliverableqty; ?>"></td>

                                <td width="20%" align="center" >
                                    <select class="form-control selectpicker" id="pendingststatus<?php echo $k; ?>" name="componentdata[<?php echo $k; ?>][flag]" onchange="statuschange(this.value,'<?php echo $k; ?>')" data-live-search="true">
                                        <option value="0">Pending</option>
                                        <option value="1" selected=selected>Approved</option>
                                    </select>
                                </td>

                                <td width="15%" align="center"><input class="form-control" id="pendingqty<?php echo $k; ?>" onkeyup="getdeliverableqty(this.value,'<?php echo $k; ?>')" type="text" name="componentdata[<?php echo $k; ?>][remainingqty]" value="0"></td>

                                <td width="5%">
                                    <button type="button" class="btn pull-right btn-danger"  onclick="removecomponent(<?php echo $k; ?>);" ><i class="fa fa-remove"></i></button>
                                </td>

                            </tr>
                            <?php
                            $k++;
                        }
                    }else{
                       ?>
                        <tr class="main" id="tr0">
                            <td colspan="7" align="center">Components are not available</td>
                        </tr>
                       <?php
                    }
                    ?>

                </tbody>
            </table>
            <div class="col-xs-12">
                <label class="label-control subHeads"><a class="addmorecomp" value="<?php echo (!empty($k)) ? $k : 1; ?>">Add More Item<i class="fa fa-plus"></i></a></label>
            </div>
            <?php

        }
    }


    public function delivery_pickup_report()
    {
        check_permission(308,'view');

        $pending_arr = [];
        $completed_arr = [];

        $this->home_model->delete('tbltempdeliverypickupreport', array('staff_id'=>get_staff_user_id()));
        $where_a = "";
        $where_b = "";
        if(is_admin() == 0){
            $where_a = " and ca.staff_id = '".get_staff_user_id()."' ";
            $where_b = " and ta.staff_id = '".get_staff_user_id()."' ";
        }
        // Get Pending records
        /*$delivery_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id  where c.year_id = '".financial_year()."' and c.under_process = 1 and c.process = 1 and cp.for = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $pickup_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.year_id = '".financial_year()."' and c.under_process = 1 and c.process = 2 and cp.for = 2 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $task_pending = $this->db->query("SELECT t.id,t.other_date from `tbltasks` as t LEFT JOIN tbltaskassignees as ta on t.id = ta.task_id where t.related_to = 11 and t.status = 1 and ta.task_status = 0 ".$where_b." GROUP BY ta.task_id ORDER BY t.id desc ")->result();*/

        $delivery_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id  where  c.under_process = 1 and c.process = 1 and cp.for = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $pickup_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where  c.under_process = 1 and c.process = 2 and cp.for = 2 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $task_pending = $this->db->query("SELECT t.id,t.other_date from `tbltasks` as t LEFT JOIN tbltaskassignees as ta on t.id = ta.task_id where t.related_to = 11 and t.status = 1 and ta.task_status = 0 ".$where_b." GROUP BY ta.task_id ORDER BY t.id desc ")->result();


        // Get Completed Recoreds
        //There is no role of delivery and pickup in completed because this is the final complete process
        /*$sales_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.year_id = '".financial_year()."' and c.service_type = 2 and c.under_process = 0 and c.process = 1 and cp.for = 1 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $rent_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.year_id = '".financial_year()."' and c.under_process = 0 and c.process = 2 and cp.for = 2 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $task_complete = $this->db->query("SELECT t.id,t.other_date from `tbltasks` as t LEFT JOIN tbltaskassignees as ta on t.id = ta.task_id where t.related_to = 11 and t.status = 1 and ta.task_status = 1 ".$where_b." GROUP BY ta.task_id ORDER BY t.id desc ")->result();*/

        $sales_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where  c.service_type = 2 and c.under_process = 0 and c.process = 1 and cp.for = 1 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $rent_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where  c.under_process = 0 and c.process = 2 and cp.for = 2 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
        $task_complete = $this->db->query("SELECT t.id,t.other_date from `tbltasks` as t LEFT JOIN tbltaskassignees as ta on t.id = ta.task_id where t.related_to = 11 and t.status = 1 and ta.task_status = 1 ".$where_b." GROUP BY ta.task_id ORDER BY t.id desc ")->result();

        $rent_pickup_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.service_type = 1 and c.under_process = 0 and c.process = 1 and cp.for = 1 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();

        if(!empty($delivery_info)){
            foreach ($delivery_info as $value) {

                if(!empty($value->challandate)){
                    $challandate = $value->challandate;
                }else{
                    $challandate = '0000-00-00';
                }
                $data_1 = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $value->id,
                    'date' => $challandate,
                    'for' => 1,
                    'type' => 1,
                    'by_task' => 0
                );

                $this->home_model->insert('tbltempdeliverypickupreport', $data_1);
            }
        }
        if(!empty($pickup_info)){
            foreach ($pickup_info as $value) {

                if(!empty($value->challandate)){
                    $challandate = $value->challandate;
                }else{
                    $challandate = '0000-00-00';
                }

                $data_2 = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $value->id,
                    'date' => $challandate,
                    'for' => 2,
                    'type' => 1,
                    'by_task' => 0
                );

                $this->home_model->insert('tbltempdeliverypickupreport', $data_2);
            }
        }

        if(!empty($task_pending)){
            foreach ($task_pending as $value) {

                if(!empty($value->other_date)){
                    $challandate = $value->other_date;
                }else{
                    $challandate = '0000-00-00';
                }

                $data_3 = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $value->id,
                    'date' => $challandate,
                    'for' => 0,
                    'type' => 1,
                    'by_task' => 1
                );

                $this->home_model->insert('tbltempdeliverypickupreport', $data_3);
            }
        }

        if(!empty($sales_complete)){
            foreach ($sales_complete as $value) {

                if(!empty($value->challandate)){
                    $challandate = $value->challandate;
                }else{
                    $challandate = '0000-00-00';
                }
                $data_4 = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $value->id,
                    'date' => $challandate,
                    'for' => 0,
                    'type' => 2,
                    'by_task' => 0
                );

                $this->home_model->insert('tbltempdeliverypickupreport', $data_4);
            }
        }

        if(!empty($rent_complete)){
            foreach ($rent_complete as $value) {

                if(!empty($value->challandate)){
                    $challandate = $value->challandate;
                }else{
                    $challandate = '0000-00-00';
                }
                $data_5 = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $value->id,
                    'date' => $challandate,
                    'for' => 0,
                    'type' => 2,
                    'by_task' => 0
                );

                $this->home_model->insert('tbltempdeliverypickupreport', $data_5);
            }
        }

        if(!empty($task_complete)){
            foreach ($task_complete as $value) {

                if(!empty($value->other_date)){
                    $challandate = $value->other_date;
                }else{
                    $challandate = '0000-00-00';
                }

                $data_6 = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $value->id,
                    'date' => $challandate,
                    'for' => 0,
                    'type' => 2,
                    'by_task' => 1
                );

                $this->home_model->insert('tbltempdeliverypickupreport', $data_6);
            }
        }

        if(!empty($rent_pickup_complete)){
            foreach ($rent_pickup_complete as $value) {

                if(!empty($value->challandate)){
                    $challandate = $value->challandate;
                }else{
                    $challandate = '0000-00-00';
                }
                $data_5 = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $value->id,
                    'date' => $challandate,
                    'for' => 0,
                    'type' => 2,
                    'by_task' => 0
                );

                $this->home_model->insert('tbltempdeliverypickupreport', $data_5);
            }
        }


        $where_p_delivery = "staff_id = '".get_staff_user_id()."' and type = 1 and `for` = 1 and by_task = 0 ";
        $where_p_pickup = "staff_id = '".get_staff_user_id()."' and type = 1 and `for` = 2 and by_task = 0 ";
        $where_p_other = "staff_id = '".get_staff_user_id()."' and type = 1 and `for` = 0 and by_task = 1 ";

        $where_complete = "staff_id = '".get_staff_user_id()."' and type = 2 and by_task = 0 ";
        $where_complete_other = "staff_id = '".get_staff_user_id()."' and type = 2 and by_task = 1 ";
        if(!empty($_POST)){
            extract($this->input->post());
            $data['from_page'] = $from_page;
            $data['s_fdate'] = $f_date;
            $data['s_tdate'] = $t_date;

            if($from_page == 1){
                $where_p_delivery .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $where_p_pickup .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $where_p_other .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }else{
                $where_complete .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $where_complete_other .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }


        }else{

        }
        $data['pending_delivery_info'] = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_p_delivery." ORDER BY id asc ")->result();
        $data['pending_pickup_info'] = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_p_pickup."  ORDER BY id asc ")->result();
        $data['pending_other_info'] = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_p_other." ORDER BY id asc ")->result();

        $data['complete_info'] = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_complete." ORDER BY id asc ")->result();
        $data['complete_other_info'] = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_complete_other." ORDER BY id asc ")->result();


        $data['title'] = 'Delivery & Pickup Report';
        $this->load->view('admin/chalan/delivery_pickup_report', $data);

    }

    public function change_chalan_date() {
        if(!empty($_POST)){
            extract($this->input->post());

            $old_date = '00/00/0000';
            if($for == 3){
                $task_info = $this->db->query("SELECT * from `tbltasks` where id = '".$chalan_id."' ")->row();
                if(!empty($task_info)){
                    if(!empty($task_info->new_date)){
                        $old_date = _d($task_info->new_date);
                    }else{
                        $old_date = _d($task_info->other_date);
                    }
                }
                $this->home_model->update('tbltasks', array('new_date'=>db_date($delivery_date)), array('id'=>$chalan_id));

                $type = '2';
            }else{
                $chalan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$chalan_id."' ")->row();
                if(!empty($chalan_info)){
                    if(!empty($chalan_info->new_date)){
                        $old_date = _d($chalan_info->new_date);
                    }else{
                        $old_date = _d($chalan_info->challandate);
                    }
                }
                $this->home_model->update('tblchalanmst', array('new_date'=>db_date($delivery_date)), array('id'=>$chalan_id));

                $type = '1';
            }
            $message = 'Date has changed from '.$old_date.' To '.$delivery_date;
            $add_data_1 = array(
                'main_id' => $chalan_id,
                'type' => $type,
                'staff_id' => get_staff_user_id(),
                'description' => $message,
                'created_at' => date('Y-m-d H:i:s')
            );

            $insert_1 = $this->home_model->insert('tblchallan_activity_log', $add_data_1);

            set_alert('success', 'New Date Updated successfully');
            redirect(admin_url('chalan/delivery_pickup_report'));

            }
    }

    public function change_chalan_remark() {
        if(!empty($_POST)){
            extract($this->input->post());

            $remark = '--';
            if($for == 3){
                $type = '2';
                $task_info = $this->db->query("SELECT * from `tbltasks` where id = '".$chalan_id."' ")->row();
                if(!empty($task_info)){
                    $remark = $task_info->description;
                }
                $this->home_model->update('tbltasks', array('description'=>$description), array('id'=>$chalan_id));
            }else{
                $type = '1';
                $chalan_info = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$chalan_id."' and `for` = '".$for."' ")->row();
                if(!empty($chalan_info)){
                    $remark = $chalan_info->description;
                }
                $this->home_model->update('tblchallanprocess', array('description'=>$description), array('chalan_id'=>$chalan_id,'for'=>$for));
            }
             $message = 'Special remark has changed from "'.$remark.'" To "'.$description.'"';

            $add_data_1 = array(
                'main_id' => $chalan_id,
                'type' => $type,
                'staff_id' => get_staff_user_id(),
                'description' => $message,
                'created_at' => date('Y-m-d H:i:s')
            );

            $insert_1 = $this->home_model->insert('tblchallan_activity_log', $add_data_1);

            set_alert('success', 'New Remark Updated successfully');
            redirect(admin_url('chalan/delivery_pickup_report'));

            }
    }

    public function activity_log($type='',$id='')
    {

        $data['id'] = $id;
        $data['type'] = $type;

        $data['activity_log'] = $this->home_model->get_result('tblchallan_activity_log', array('main_id'=>$id,'type'=>$type), '');


        if(!empty($_POST)){
            extract($this->input->post());


            $add_data_1 = array(
                            'main_id' => $id,
                            'type' => $type,
                            'staff_id' => get_staff_user_id(),
                            'description' => $description,
                            'created_at' => date('Y-m-d H:i:s')
                        );

            $insert_1 = $this->home_model->insert('tblchallan_activity_log', $add_data_1);

           if($insert_1){
                set_alert('success', 'New Activity Add Successfully');
                redirect($_SERVER['HTTP_REFERER']);
           }

        }

        $this->load->view('admin/chalan/activity_log', $data);
    }


    public function chalan_prodcess()
    {
        $challan_info = $this->db->query("SELECT * from `tblchalanmst` where product_json != ' '  ")->result();

        if(!empty($challan_info)){
            foreach ($challan_info as $key => $value) {
                $product_info = json_decode($value->product_json);
                if(!empty($product_info)){
                    foreach ($product_info as  $row) {
                        $insert_data_1 = array(
                                    'chalan_id' => $value->id,
                                    'product_id' => $row->product_id,
                                    'product_qty' => $row->product_qty
                                );

                        $this->home_model->insert('tblchalanproducts', $insert_data_1);
                    }
                }
            }
        }
    }


    public function merge_old_to_new() {

        $products_info = $this->db->query("SELECT *  FROM `tblproducts` WHERE `is_approved` = 1 and merging_remark != ' ' ")->result();
        /*echo '<pre/>';
        print_r($products_info);
        die;*/
        if(!empty($products_info)){
            foreach ($products_info as $value) {
               $new_product_id = $value->id;
               $old_product_arr = explode(',', $value->merging_remark);
               if(!empty($old_product_arr)){
                    foreach ($old_product_arr as $product_id) {
                        //DN Product
                        $this->db->query("Update `tblchalanproducts` set product_id = '".$new_product_id."' where product_id = '".$product_id."' ");
                    }
               }

            }
        }

    }

    public function chalan_prodcess_2()
    {
        $challan_info = $this->db->query("SELECT * from `tblchalanmst` where product_json != ' '  ")->result();

        if(!empty($challan_info)){
            foreach ($challan_info as $key => $value) {
                //$product_info = json_decode($value->product_json);
                $products_info = $this->db->query("SELECT *  FROM `tblchalanproducts` WHERE `chalan_id` = '".$value->id."' ")->result();
                if(!empty($products_info)){
                    $pro_arr = array();
                    foreach ($products_info as $row) {
                        $pro_arr[] = array(
                            'product_id' => $row->product_id,
                            'product_qty' => $row->product_qty
                        );
                    }
                   $product_json = json_encode($pro_arr);
                   $this->home_model->update('tblchalanmst', array('product_json'=>$product_json), array('id'=>$value->id));
                }
            }
        }
    }

    /* this function use for send mail of lead */
    public function challan_send_to_mail(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            $challan_data = $this->db->query("SELECT * FROM tblchalanmst WHERE id = ".$challan_id."")->row();
            if (!empty($challan_data)){
                $response = $this->emails_model->send_mail($challan_id, "challan", $module_template_id, $challan_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Challan send on mail successfully");
                    redirect(admin_url("chalan/created"));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url("chalan/created"));
                }
            }
            else{
                set_alert('danger', "Estimate not found");
                redirect(admin_url("chalan/created"));
            }
        }
        else{
            redirect(admin_url("chalan/created"));
        }
    }

    /* this function use for getChallanVehicleBookingReq */
    public function challanVehicleBooking(){

        $where = "approve_status != 1";

        if(!empty($_POST)){
            extract($this->input->post());

            if(isset($status)){
                $data['status'] = $status;
                $where = "approve_status = '".$status."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and `date` >= '".db_date($f_date)."' and `date` <= '".db_date($t_date)."' ";
            }
        }

        // Get records
        $data['booking_req_list'] = $this->db->query("SELECT * from `tblchallanvehiclebookingreq` where ".$where." ORDER BY id desc ")->result();

        $data['title'] = 'Challan Vehicle Booking List';
        $this->load->view('admin/chalan/challan_vehicle_booking_list', $data);
    }

    public function tripRequestList(){
        check_permission(347,'view');
        $where = "approve_status != 1";

        if(!empty($_POST)){
            extract($this->input->post());

            if(isset($status)){
                $data['status'] = $status;
                $where = "approve_status = '".$status."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and `date` >= '".db_date($f_date)."' and `date` <= '".db_date($t_date)."' ";
            }
        }

        // Get records
        $data['booking_req_list'] = $this->db->query("SELECT * from `tblchallantriprequest` where ".$where." ORDER BY id desc ")->result();

        $data['title'] = 'Trip Request List';
        $this->load->view('admin/chalan/tripRequestList', $data);
    }

    public function tripRequestStatus() {

        if (!empty($_POST)) {
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblchallantriprequestapproval where req_id = '" . $id . "'  ")->result();
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
                                    if (!empty($assign_info)) {
                                        $i = 1;
                                        foreach ($assign_info as $key => $value) {

                                            if ($value->approve_status == 0) {
                                                $status = 'Pending';
                                                $color = 'Darkorange';
                                            } elseif ($value->approve_status == 1) {
                                                $status = 'Approved';
                                                $color = 'green';
                                            } elseif ($value->approve_status == 2) {
                                                $status = 'Reject';
                                                $color = 'red';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo get_employee_name($value->staffid); ?></td>
                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                <td><?php echo ($value->approvereason != '') ? $value->approvereason : '--'; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
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

    /* this function use for view challan vehicle booking */
    public function tripRequestView($id){
        $data['title'] = 'View Challan Vehicle Booking';
        $data['page'] = 'view';

        $data["vehiclebooking_data"] = $this->db->query("SELECT * FROM `tblchallantriprequest` WHERE id = ".$id."")->row();
        $this->load->view('admin/chalan/trip_request_view', $data);
    }

    /* this function use for challan vehicle booking approval*/
    public function challanVehicleBookingApproval($id)
    {
       if(!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),26,$id,$submit);
            update_masterapproval_all(26,$id,$submit);

            $ad_data = array(
                'approvereason' => $remark,
                'approve_status' => $submit,
                'created_at' => date('Y-m-d H:i:s')
            );

            $update = $this->home_model->update('tblchallanvehiclebookingreqapproval', $ad_data,array('booking_req_id'=>$id,'staffid'=>get_staff_user_id()));
            if($update){

                $udata = array(
                    'approve_status' => $submit,
                );
                $this->home_model->update('tblchallanvehiclebookingreq', $udata,array('id'=>$id));

                $msg = ($submit == 1) ? "approved" : "rejected";
                set_alert('success', 'Challan vehicle booking '.$msg.' succesfully');
                redirect(admin_url('approval/notifications'));
            }else{
                set_alert('warning', 'Somthing went wrong');
                redirect(admin_url('approval/notifications'));
            }
        }

        $data['page'] = 'approval';
        $data['title'] = 'Challan Vehicle Booking Approval';
        $data["vehiclebooking_data"] = $this->db->query("SELECT * FROM `tblchallanvehiclebookingreq` WHERE id = ".$id."")->row();
        $data["appvoal_info"] = $this->db->query("SELECT * FROM `tblchallanvehiclebookingreqapproval` WHERE id = ".$id." AND approve_status = 1")->row();
        $this->load->view('admin/chalan/challan_vehicle_booking_view', $data);

    }

    public function get_assign_status($id) {
        $getapprovel = $this->db->query("SELECT * FROM `tblmasterapproval`  where table_id = '" . $id . "' and module_id = 29")->result();
        echo '<div class="form-group">
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Action</td>
                                                <td>Read At</td>
                                            </tr>
                                        </thead>
                                        <tbody>';
        $status_arr = array('<p class="text-warning">Pending</p>' => '0', '<p class="text-success">Approved</p>' => '1', '<p class="text-danger">Rejected</p>' => '2','<p class="text-danger" style="color:brown;">Reconciliation</p>' => '4','<p style="color:#e8bb0b;" class="text-danger">ON Hold</p>' => '5');
        if (!empty($getapprovel)){
            foreach ($getapprovel as $key => $value) {
                $readdate = ($value->isread == 1) ? _d($value->readdate) : "--";
                echo '<tr>
                        <td>'.++$key.'</td>
                        <td>'.get_employee_fullname($value->staff_id).'</td>
                        <td>'.array_search($value->approve_status, $status_arr).'</td>
                        <td>'.$readdate.'</td>
                     </tr>';
            }
        }
        echo'</tbody></table></div>';
    }

    /* this function use for chalan approval */
    public function delivery_chalan_approval($id){

        if(!empty($_POST)){
            $data = $this->input->post();
            $update = $this->home_model->update('tblchalanmst', array('approve_status'=>$data["action"]),array('id'=>$id));
            if ($update) {
                $ad_data = array(
                    'approvereason' => $data["approvereason"],
                    'approve_status' => $data["action"],
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $this->home_model->update('tblchallanapproval', $ad_data, array('challan_id' => $id, 'staff_id' => get_staff_user_id()));

                update_masterapproval_single(get_staff_user_id(), 29, $id, $data["action"]);
                update_masterapproval_all(29, $id, $data["action"]);
            }

            $des =  'Chalan Rejected Successfully';
            if($data["action"] == 1){
                $challan_data = $this->db->query("SELECT product_json,warehouse_id,service_type FROM `tblchalanmst` WHERE `id` = '".$id."' ")->row();
                $productjson = json_decode($challan_data->product_json,TRUE);
                
                if (!empty($productjson)){
                    foreach ($productjson as $proval) {
                        $product_id = $proval["product_id"];
                        $chk_product_log = $this->db->query("SELECT * FROM `tblproduct_store_log` where qty > 0 and finish_goods_store = 1 and material_status = 1 and pro_id = '".$product_id."' and warehouse_id = '".$challan_data->warehouse_id."' and service_type = '".$challan_data->service_type."' order by qty ASC")->result();
                        if (!empty($chk_product_log)){
                            $product_qty = $proval["product_qty"];
                            foreach ($chk_product_log as $productlog) {

                                if ($product_qty > 0){
                                    $availableqty = $product_qty;
                                    $finalqty = number_format($product_qty, 2) - number_format($productlog->qty, 2);
                                    $product_qty = ($finalqty > 0) ? $finalqty : 0;
                                    $itemqty = ($finalqty < 0) ? abs($finalqty) : 0;
                                    $this->home_model->update("tblproduct_store_log", array("qty" => $itemqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $productlog->id));
                                    /* this is for store consumed qty */
                                    $consumed_qty = $availableqty - $product_qty;
                                    $challanlog = array(
                                        'challan_id' => $id,
                                        'table_type' => 1,
                                        'table_id' => $productlog->id,
                                        'consumed_qty' => $consumed_qty
                                    );
                                    $this->home_model->insert('tblstore_challan_consumed_log', $challanlog);
                                }
                            }

                            /* storing product log data */
                            $pdata['parent_id'] = 0;
                            $pdata['pro_id'] = $product_id;
                            $pdata['warehouse_id'] = $challan_data->warehouse_id;
                            $pdata['service_type'] = $challan_data->service_type;
                            $pdata['total_qty'] = $proval["product_qty"];
                            $pdata['qty'] = 0;
                            $pdata['finish_goods_store'] = 1;
                            $pdata['outward_store'] = 1;
                            $pdata['material_status'] = 1;
                            $pdata['ref_type'] = "challan_created";
                            $pdata['ref_id'] = $id;
                            $pdata['date'] = date("Y-m-d");
                            $pdata['updated_at'] = date("Y-m-d H:i:s");
                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            /* this function use for update stock qty */
                            $getprostock = $this->db->query("SELECT * FROM `tblprostock` WHERE pro_id = '".$product_id."' and warehouse_id = '".$challan_data->warehouse_id."' and service_type = '".$challan_data->service_type."' and stock_type = 1 and department_id = 0 and status = 1")->row();

                            if (!empty($getprostock)){
                                
                                $stockqty = number_format($getprostock->qty, 2) - number_format($proval["product_qty"], 2);
                                $sqty = ($stockqty > 0) ? $stockqty : 0;
                                $this->home_model->update("tblprostock", array("qty" => $sqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $getprostock->id));

                                /* this is for store consumed qty */
                                $challanlog = array(
                                    'challan_id' => $id,
                                    'table_type' => 2,
                                    'table_id' => $getprostock->id,
                                    'consumed_qty' => $proval["product_qty"]
                                );
                                $this->home_model->insert('tblstore_challan_consumed_log', $challanlog);
                            }
                        }
                    }
                }
                
                $des = 'Chalan Approved Successfully';
            }else if($data["action"] == 4){
                $des = 'Chalan Reconciliation Successfully';
            }else if($data["action"] == 5){
                $des = 'Chalan Hold Successfully';
            }
            set_alert('success', $des);
            redirect(admin_url('approval/notifications'));
            exit;
        }

        $this->load->model('Estimates_model');
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');
        $this->load->model('estimates_model');
        $getchalandata = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='" . $id . "'")->row_array();
        $getchalandetails = $this->db->query("SELECT * FROM `tblchalandetailsmst` WHERE `chalan_id`='" . $id . "'")->result_array();
        $chalandetails = array();
        $i = 0;
        foreach ($getchalandetails as $singlechalandetail) {
            $chalandetails[$i]['qty'] = $singlechalandetail['deleverable_qty'];
            $getcomponentdetails = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $singlechalandetail['component_id'] . "'")->row_array();
            $chalandetails[$i]['component_name'] = $getcomponentdetails['sub_name'];
            $i++;
        }
        $data['chalan'] = $getchalandata;
        $data['chalan_details'] = $chalandetails;
        $getwarehousedetails = $this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='" . $getchalandata['warehouse_id'] . "'")->row_array();
        $data['warehouse_name'] = $getwarehousedetails['name'];
        $pro_id = explode(',', $getchalandata['pro_id']);
        foreach ($pro_id as $singlepro) {
            $getprodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $singlepro . "'")->row_array();
            $proname[] = $getprodet['name'];
        }
        $pro_name = implode(',', $proname);
        $data['proname'] = $pro_name;
        if ($getchalandata['service_type'] == 1) {
            $is_sale = 0;
            $servicetype = 'Challan For Rent';
        } else {
            $is_sale = 1;
            $servicetype = 'Challan For Sale';
        }
        $data['title'] = "Delivery Challan Approval";
        $this->load->model('estimates_model');
        $data['estimate'] = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `id`='" . $id . "'")->row();
        $this->load->view('admin/chalan/chalan_approval', $data);
    }

    /* this function use for delivery challan issuee */
    public function delivery_challan_issue()
    {
        check_permission(365,'view');
        $where = "c.id > 0  and c.process != 0 and c.approve_status = 1";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($client_id)){
                $data['client_id'] = $client_id;
                $where .= " and c.clientid = '".$client_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and c.`challandate` >= '".db_date($f_date)."' and c.`challandate` <= '".db_date($t_date)."' ";
            }
        }else{
            $where .= " and c.year_id = '".financial_year()."' and MONTH(c.`challandate`) = '".date('m')."' and YEAR(c.`challandate`) = '".date('Y')."' ";
        }

        // Get records
        $data['invoice_list'] = $this->db->query("SELECT c.*, citems.component_id, citems.deleverable_qty  FROM `tblchalanmst` as c RIGHT JOIN `tblchalandetailsmst` as citems ON c.id = citems.chalan_id WHERE ".$where." ORDER BY c.id DESC ")->result();
        $data['client_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE client_branch_name !='' ORDER BY client_branch_name ASC ")->result();

        $data['title'] = 'Delivery Challan Issue';
        $this->load->view('admin/chalan/delivery_challan_issue', $data);
    }

    /* this fuctio use for production plan list */
    public function production_plan_list(){
        check_permission(375,'view');
        $where = "p.id > 0";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($client_id)){
                $data['client_id'] = $client_id;
                $where .= " and p.clientid = '".$client_id."'";
            }
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and p.`date` >= '".db_date($f_date)."' and p.`date` <= '".db_date($t_date)."' ";
            }
        }else{
            $where .= " and MONTH(p.`date`) = '".date('m')."' and YEAR(p.`date`) = '".date('Y')."' ";
        }

        // Get records
        $data['invoice_list'] = $this->db->query("SELECT p.* FROM `tblchalanproductionplan` as p WHERE ".$where." ORDER BY p.id DESC ")->result();
        // $data['invoice_list'] = $this->db->query("SELECT p.*, c.chalanno, c.clientid  FROM `tblchalanproductionplan` as p RIGHT JOIN `tblchalanmst` as c ON c.id = p.chalan_id WHERE ".$where." ORDER BY p.id DESC ")->result();
        $data['client_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE client_branch_name !='' ORDER BY client_branch_name ASC ")->result();

        $data['title'] = 'Production Plan (SEPL/PRD/16)';
        $this->load->view('admin/chalan/production_plan_list', $data);
    }

    /* this function convert chalan to productionplan */
    public function convert_to_productionplan($id){
        check_permission(375,'create');
        $this->load->model('Estimates_model');
        $ref_type = $this->input->get("ref_type");
        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            $success = $this->Estimates_model->convert_to_productionplan($proposal_data, $id);
            if($success){
                set_alert('success', "production plan successfully converted");
                redirect(admin_url('chalan/production_plan_list'));
            }
        }

        if ($ref_type == '2'){
            $data["ref_type"] = "proforma_challan";
            $data['challan_info'] = $this->db->query("SELECT * FROM tblproformachalan WHERE id = '".$id."' ")->row();
            $data['product_info'] = $this->db->query("SELECT `product_id`,`qty` as `product_qty` FROM tblproformachalandetails WHERE proformachalan_id = '".$id."' AND `type`='1' ")->result();
            $data['components_info'] = $this->db->query("SELECT * FROM tblproformachalandetails WHERE proformachalan_id = '".$id."' AND `type`='2' ")->result_array();
        }else{
            $data["ref_type"] = "challan";
            $data['challan_info'] = $this->db->query("SELECT * from tblchalanmst where id = '".$id."' ")->row();
            $data["product_info"] = json_decode($data['challan_info']->product_json);
            $data['components_info'] = $this->db->query("SELECT * from tblchalandetailsmst where chalan_id = '".$id."' ")->result_array();
        }
        
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 ORDER BY name ASC ")->result_array();
        $data['employee_info'] = $this->db->query("SELECT * from tblstaff where active = '1' ORDER BY firstname ASC ")->result_array();

        $data['title'] = 'Convert To Production Plan';
        $this->load->view('admin/chalan/production_plan_add', $data);
    }

    /* this function use for edit productionplan */
    public function edit_production_plan($id){
        check_permission(375,'edit');
        $this->load->model('Estimates_model');

        if ($this->input->post()) {
            $proposal_data = $this->input->post();
            $success = $this->Estimates_model->edit_production_plan($proposal_data, $id);
            if($success){
                set_alert('success', "production plan update successfully");
                redirect(admin_url('chalan/production_plan_list'));
            }
        }
        
        $data['production_plan_info'] = $this->db->query("SELECT * from tblchalanproductionplan where id = '".$id."' ")->row();
        
        if (!empty($data['production_plan_info'])){
            if ($data['production_plan_info']->ref_type == '1'){
                $data["ref_type"] = "challan";
                $data['challan_info'] = $this->db->query("SELECT * from tblchalanmst where production_plan_id = '".$id."' ")->row();
                $chalan_id = $data['production_plan_info']->chalan_id;
                $data["product_info"] = json_decode($data['challan_info']->product_json);
                $data['components_info'] = $this->db->query("SELECT * from tblchalandetailsmst where chalan_id = '".$chalan_id."' ")->result_array();
            }else{
                $data["ref_type"] = "proforma_challan";
                $data['challan_info'] = $this->db->query("SELECT * FROM tblproformachalan WHERE production_plan_id = '".$id."' ")->row();
                $data['product_info'] = $this->db->query("SELECT `product_id`,`qty` as `product_qty` FROM tblproformachalandetails WHERE proformachalan_id = '".$data['challan_info']->id."' AND `type`='1' ")->result();
                $data['components_info'] = $this->db->query("SELECT * FROM tblproformachalandetails WHERE proformachalan_id = '".$data['challan_info']->id."' AND `type`='2' ")->result_array();
            }
        }

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = 1 ORDER BY name ASC ")->result_array();
        $data['employee_info'] = $this->db->query("SELECT * from tblstaff where active = '1' ORDER BY firstname ASC ")->result_array();

        $data['title'] = 'Edit Production Plan';
        $this->load->view('admin/chalan/production_plan_add', $data);
    }

    public function delete_production_plan($id) {
        check_permission(375,'delete');
        $check_production = $this->db->query("SELECT * from tblchalanproductionplan where id = '".$id."' ")->row();
        if(!empty($check_production)){
            $response = $this->home_model->delete("tblchalanproductionplan", array("id" => $id));
            if ($response) {

                if ($check_production->ref_type == '1'){
                    /* this for remove production plan from chalan link */
                    $this->home_model->update("tblchalanmst", array("production_plan_id" => 0), array("id" => $check_production->chalan_id));
                    $this->home_model->update("tblchalandetailsmst", array("remark" => NULL), array("chalan_id" => $check_production->chalan_id));
                }else{
                    $this->home_model->update("tblproformachalan", array("production_plan_id" => 0), array("id" => $check_production->chalan_id));
                }
                set_alert('success', _l('deleted', "Production plan"));
                if (strpos($_SERVER['HTTP_REFERER'], 'chalan/') !== false) {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(admin_url('chalan/production_plan_list'));
                }
            } else {
                set_alert('warning', _l('problem_deleting', "production plan"));
                redirect(admin_url('chalan/production_plan_list'));
            }
        }else {
            set_alert('warning', _l('problem_deleting', "production plan"));
            redirect(admin_url('chalan/production_plan_list'));
        }
    }

    /* this is for production plan pdf */
    public function production_plan_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $check_production = $this->db->query("SELECT * from tblchalanproductionplan where id = '".$id."' ")->row();
        if(!empty($check_production)){

            if ($check_production->ref_type == '1'){
                $estimate = $this->estimates_model->getcreatedchalan($check_production->chalan_id);
            }else{
                $estimate = $this->db->query("SELECT * FROM tblproformachalan WHERE `id` = '".$check_production->chalan_id."' ")->row();
            }
            
            $file_name = 'CPP-' . str_pad($id, 4, '0', STR_PAD_LEFT);;

            if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                $html = nturm_production_plan_pdf($estimate);
            }else{
                $html = production_plan_pdf($estimate);
            }
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // $dompdf->setPaper('A4', 'portrait');
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

            $dompdf->stream($file_name, array("Attachment" => false));
        }
    }

    public function satisfaction_email()
    {
        if ($this->input->post()) {
            extract($this->input->post());

            $this->load->model('emails_model');

            if(isset($challan_id) && !empty($challan_id)){

                $link = base_url('survey/survey_form/'.ci_enc($challan_id));
                $message = str_replace("#link#",$link,$message);
                $message .= get_company_signature();

//                $email = "himanshu.mandloi5@gmail.com";
                $sent = $this->emails_model->send_simple_email($email, $subject, $message);
                if ($sent) {

                    $this->home_model->update('tblchalanmst', array("send_satisfaction_link" => 1), array('id' => $challan_id));
                    set_alert('success', 'Email send successfully');
                }else{
                    set_alert('warning', 'Email not sent!');
                }
                if (strpos($_SERVER['HTTP_REFERER'], 'satisfaction_email/') == false) {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(admin_url("chalan/customer_satisfaction"));
                }
            }else{
                set_alert('warning', 'Somthing went wrong!');
                redirect(admin_url("chalan/customer_satisfaction"));
            }
        }
    }

    /* this function use for customer satisfaction list */
    public function customer_satisfaction(){
        check_permission(387,'view');
        $where = "id > 0 and approve_status = 1 ";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id) || !empty($f_date) || !empty($t_date) || isset($approve_status) || !empty($service_type)){
                if(!empty($client_id)){
                    $data['client_id'] = $client_id;
                    $where .= " and clientid = '".$client_id."'";
                }

                if(!empty($service_type)){
                    $data['service_type'] = $service_type;
                    $where .= " and service_type = '".$service_type."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    /*$f_date = $f_date.' 00:00:00';
                    $t_date = $t_date.' 23:59:59';*/

                    $where .= " and `challandate` >= '".$f_date."' and `challandate` <= '".$t_date."' ";
                }
            }
        }else{
            $where .= " and year_id = '".financial_year()."' ";
        }

        // Get records
        $data['invoice_list'] = $this->db->query("SELECT * from `tblchalanmst` where ".$where." ORDER BY id desc ")->result();

        $data['client_data'] = $this->db->query("SELECT * from `tblclientbranch` WHERE `active`=1 AND `client_branch_name` != '' ORDER BY client_branch_name ASC ")->result();
        $data['branch_info'] = $this->db->query("SELECT `id`,`comp_branch_name` from `tblcompanybranch` where status = 1 ORDER BY comp_branch_name ASC ")->result();

        $data['title'] = 'Customer Satisfaction List';
        $this->load->view('admin/chalan/customer_satisfaction_list', $data);
    }

    /* this function use for customer satisfaction report */
    public function customer_satisfaction_report(){

        $where = "id > 0";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and `created_at` >= '".db_date($f_date)."' and `created_at` <= '".db_date($t_date)."' ";
            }
        }else{
            $where .= " and MONTH(`created_at`) = '".date('m')."' and YEAR(`created_at`) = '".date('Y')."' ";
        }

        // Get records
        $data['satisfactionlist'] = $this->db->query("SELECT * FROM `tblcustomersatificationdetails` WHERE ".$where." ORDER BY id DESC ")->result();
        $data['client_data'] = $this->db->query("SELECT * FROM `tblclientbranch`  ")->result();
        $data["title"] = "Customer Satisfaction Report";
        $this->load->view('admin/chalan/customer_satisfaction_report', $data);
    }

    /* this function use for vview_satisfaction_details */
    public function view_satisfaction_details($id){
        $data['title'] = 'View Customer Feedback Details';

        $data["satisfaction_data"] = $this->db->query("SELECT s.*,`c`.`chalanno`,`c`.`clientid` FROM `tblcustomersatificationdetails` as s LEFT JOIN `tblchalanmst` as c ON c.id = s.challan_id WHERE s.id = ".$id."")->row();
        $this->load->view('admin/chalan/view_satisfaction_details', $data);
    }

    /* this function use for production demand qty list */
    public function demand_component_list(){
        
        $where = "id > 0";
        if(!empty($_POST)){
            extract($this->input->post());

            if(strlen($status) > 0){
                $data['status'] = $status;
                $where .= " and status = '".$status."'";
            }
        }else{
           $where .= " and status = '0'"; 
        }

        // Get records
        $data['demand_list'] = $this->db->query("SELECT * FROM `tblproduction_component_demand` WHERE ".$where." ORDER BY id DESC ")->result();

        $data['title'] = 'Production Component Demand List';
        $this->load->view('admin/chalan/component_demand_list', $data);
    }

    /* this is for demand product cutting */
    public function demand_product_cutting(){
        if(!empty($_POST)){
            extract($this->input->post());
            $data = array();
            if (isset($demandproduct) && !empty($demandproduct)){
                foreach ($demandproduct as $value) {
                    if (isset($value['action']) && !empty($value['action'])){
                        $data[] = array('product_id' => $value['product_id'], 'qty' => $value['qty']);
                    }
                }
            }
            
            if (!empty($data)){
                $this->session->set_flashdata('item', $data);
                if ($cutting_type == '1'){
                    redirect(admin_url("store/store_cutting/demand"));
                }else{
                    redirect(admin_url("store/sheet_cutting/demand"));
                }
            }
        }    
    }
}
