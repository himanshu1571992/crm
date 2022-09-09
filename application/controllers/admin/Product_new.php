<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_new extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('home_model');
    }

    /* List all Component Data */

    public function check() {
        $product_data = $this->Product_model->get_product_weight_and_price(11,1,1);
        echo '<pre/>';
        print_r($product_data);
        die;
    }

    /* COMMENT THIS CODE FOR CHECK NEW FUNCTIONALITY AND ITS WORKING PROCESS */
    /*public function index() {
        check_permission(295,'view');
        $this->load->library('session');

        $where = "status ='1'";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('product_where');
                $this->session->unset_userdata('product_search');
            }else{
                if (isset($category_id) || isset($sub_category_id) || isset($parent_category_id) || isset($child_category_id) || isset($is_varified) || isset($product_name) || isset($pro_id)){
                    $this->session->unset_userdata('product_where');
                    $this->session->unset_userdata('product_search');
                    $sreach_arr = array();
                    if(!empty($category_id)){
                        $where .= " and product_cat_id = '".$category_id."' ";
                        $sreach_arr['category_id'] = $category_id;
                    }

                    if(!empty($sub_category_id)){
                        $where .= " and product_sub_cat_id = '".$sub_category_id."' ";
                        $sreach_arr['sub_category_id'] = $sub_category_id;
                    }

                    if(!empty($parent_category_id)){
                        $where .= " and parent_category_id = '".$parent_category_id."' ";
                        $sreach_arr['parent_category_id'] = $parent_category_id;
                    }

                    if(!empty($child_category_id)){
                        $where .= " and child_category_id = '".$child_category_id."' ";
                        $sreach_arr['child_category_id'] = $child_category_id;
                    }

                    if(isset($is_varified) && strlen($is_varified) > 0){
                        $where .= " and is_varified = '".$is_varified."' ";
                        $sreach_arr['is_varified'] = $is_varified;
                    }

                    if(!empty($product_name)){
                        $sreach_arr['product_name'] = $product_name;
                        $where .= " and (name LIKE '%".$product_name."%' || name LIKE '%".$product_name."%')";
                    }
                    if(!empty($pro_id)){
                        $sreach_arr['pro_id'] = $pro_id;
                        $where .= " and id = '".$pro_id."' ";
                    }

                    $this->session->set_userdata('product_where',$where);
                    $this->session->set_userdata('product_search',$sreach_arr);
                }

            }

        }else{
          if(!empty($this->session->userdata('product_where'))){
              $where = $this->session->userdata('product_where');
          }
        }

        $this->load->library('pagination');
        $uriSegment = 4;
        $perPage = 25;
        // Get record count
        $totalRec = $this->Product_model->get_product_count($where);

        // Pagination configuration
        $config['base_url']    = admin_url().'Product_new/index/';
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
        $data["page"] = $offset;
        // Get records
        $data['product_data'] = $this->Product_model->get_product($where,$offset,$perPage);
        // echo $this->db->last_query();
        // exit;
        // $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` WHERE $where ")->result_array();
        $data['verify_count'] = $this->db->query("SELECT count(id) as verified FROM `tblproducts` WHERE $where AND is_approved = '1' AND is_varified = '1' ")->row()->verified;
        $data['unverify_count'] = $this->db->query("SELECT count(id) as unverified FROM `tblproducts` WHERE $where AND is_approved = '1' AND is_varified = '0' ")->row()->unverified;
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();
        $this->load->view('admin/product_new/product_list', $data);
    }*/

    public function export_product()
    {
        $where = "id > 0 ";
        $product_list = $this->db->query("SELECT * from `tblproducts` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/products.xlsx';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Product List');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');

        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Product Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Pro ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Unit');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Category');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Verified');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Date Created');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($product_list as $value)
        {
            $product_name = (!empty($value->name)) ? cc($value->name) : '--';
            $pro_id = "PRO-" .number_series($value->id);
            $unit_id = ($value->unit_2 > 0) ? value_by_id('tblunitmaster',$value->unit_2,'name') : '--';
            $product_cat_id = value_by_id('tblproductcategory',$value->product_cat_id,'name');
            $is_varified = ($value->is_varified == 1) ? 'Verified':'Unverified';

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $product_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $pro_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $unit_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $product_cat_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $is_varified);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, _d($value->created_at));

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function index_old() {
        check_permission(295,'view');

        $where = "status ='1'";
        $pwhere = "is_approved='1'";
        $where1 = "status ='1'";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($category_id)){
                $where .= " and product_cat_id = '".$category_id."' ";
                $where1 .= " and category_id = '".$category_id."' ";
                $data['category_id'] = $category_id;
            }

            if(!empty($sub_category_id)){
                $where .= " and product_sub_cat_id = '".$sub_category_id."' ";
                $data['sub_category_id'] = $sub_category_id;
            }

            if(!empty($parent_category_id)){
                $where .= " and parent_category_id = '".$parent_category_id."' ";
                $data['parent_category_id'] = $parent_category_id;
            }

            if(!empty($child_category_id)){
                $where .= " and child_category_id = '".$child_category_id."' ";
                $data['child_category_id'] = $child_category_id;
            }

            if(isset($is_varified) && strlen($is_varified) > 0){
                $where .= " and is_varified = '".$is_varified."' ";
                $data['is_varified'] = $is_varified;
            }
        }

        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` WHERE $where ")->result_array();
        $data['temp_product_data'] = $this->db->query("SELECT * FROM `tbltemperoryproduct` WHERE $where1 ")->result_array();
        $data['verify_count'] = $this->db->query("SELECT count(id) as verified FROM `tblproducts` WHERE $where AND is_approved = '1' AND is_varified = '1' ")->row()->verified;
        $data['unverify_count'] = $this->db->query("SELECT count(id) as unverified FROM `tblproducts` WHERE $where AND is_approved = '1' AND is_varified = '0' ")->row()->unverified;
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();
        $this->load->view('admin/product_new/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('product_new');
    }


    public function action_pending() {
        check_permission(295,'view');

        $data['product_data'] = $this->Product_model->get();

        $this->load->view('admin/product_new/manage_pending', $data);
    }

    public function table_pending() {
        $this->app->get_table_data('product_pending');
    }


	 public function get_pro_per_cat($product_cat_id) {
		$this->db->where('product_cat_id', $product_cat_id);
		$prodet= $this->db->get('tblproducts')->result_array();

		echo json_encode($prodet);
    }

	public function get_pro_det($product_id) {
		$this->db->where('id', $product_id);
		$prodet= $this->db->get('tblproducts')->row_array();

		echo json_encode($prodet);
    }

	public function get_comp_det($component_id) {
		$this->db->where('id', $component_id);
		$componentdet= $this->db->get('tblcomponents')->row_array();

		echo json_encode($componentdet);
    }

    public function product($id = '', $type = '') {
        check_permission(295,'create');
        if ($this->input->post()) {
            $product_data = $this->input->post();
            /*echo '<pre/>';
            print_r() ;
            die;*/

            if ($id == '') {

                $id = $this->Product_model->add_log($product_data,0);
                if ($id) {
                    handle_product_image_upload_new($id);
                    handle_product_multiple_image_upload($id);
                    handle_product_drawing_upload($id);
                    set_alert('success', 'Product Added, Pending for Approval!');
                    redirect(admin_url('product_new'));
                }
            } else {
                check_permission(295,'edit');
                $added_id = $this->Product_model->add_log($product_data,$id);

                //Updating Last Product Image
                $image = value_by_id('tblproducts',$id,'photo');
                $this->home_model->update('tblproducts_log', array('photo '=>$image),array('id'=>$added_id));


                $this->home_model->update('tblproducts', array('is_update '=>1),array('id'=>$id));
                handle_product_image_upload_new($added_id);
                handle_product_multiple_image_upload($added_id);
                handle_product_drawing_upload($added_id);

                //Taking old drwaing
                 if (empty($_FILES['drawing']['name'][0])) {
                    $productfiles = $this->db->query("SELECT * FROM `tblproductfiles` where rel_id = '".$id."' and rel_type = 'drawing' ")->result();
                    if(!empty($productfiles)){
                        foreach ($productfiles as $row4) {
                                $add_items =  array(
                                    'rel_id' => $added_id,
                                    'rel_type' => $row4->rel_type,
                                    'file_name' => $row4->file_name
                                );
                            $this->db->insert('tblproductfiles_log', $add_items);
                        }
                    }
                }


                set_alert('success', 'Product Update, Pending for Approval!');
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('product')));
                }
                $redirect = ($type == "categorytree") ? 'productsubcategory/product_category_tree' : 'product_new';
                redirect(admin_url($redirect));
            }
        }

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();

		$this->load->model('Product_category_model');
        //$data['pro_cat_data'] = $this->Product_category_model->get();
        $data['pro_cat_data'] = $this->db->query("SELECT * FROM `tblproductcategory` where `status`='1' order by name asc")->result_array();

		$this->load->model('Product_sub_category_model');
        $data['pro_sub_cat_data'] = $this->Product_sub_category_model->get();

		$this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();

		$this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();

        $data['item_data'] = $this->db->query("SELECT `id`,`sub_name` as `name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' order by name asc ")->result_array();
        $data['product_master'] = $this->db->query("SELECT `id`,`name` FROM `tblproductnewmaster` where `status`='1' order by name asc ")->result_array();
        $data['productmaterial_list'] = $this->db->query("SELECT `id`,`name` FROM `tblproductmaterial` where `status`='1' order by name asc ")->result();
        $data['division_list'] = $this->db->query("SELECT `id`,`title` FROM `tbldivisionmaster` where `status`='1' order by title asc")->result_array();
        $data['sub_division_list'] = $this->db->query("SELECT `id`,`title` FROM `tblsubdivisionmaster` where `status`='1' order by title asc")->result_array();

        if ($id == '') {
            $title = _l('add_new', _l('product_lowercase'));
        } else {
            $data['product'] = $this->db->query("SELECT * FROM `tblproducts` where id = '".$id."' ")->row_array();
            //$data['productcomponent'] = (array) $this->Product_model->getcomponentdata($id);
            $data['productcomponent'] = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();
            $data['product_drawingdata'] = $this->db->query("SELECT * FROM `tblproductdrawing` where `status`='1' and product_id = '".$id."' ORDER BY id DESC")->result_array();

            $data['pro_sub_cat_data'] = $this->db->query("SELECT * FROM `tblproductsubcategory` where `status`='1' and category_id = '".$data['product']['product_cat_id']."' order by name asc")->result_array();
            $data['parent_category_info'] = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$data['product']['product_sub_cat_id']."'  order by name asc")->result_array();
            $data['child_category_info'] = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$data['product']['parent_category_id']."'  order by name asc")->result_array();

            $final_category = 1;
            $final_category_id = $data['product']['product_cat_id'];
            if(!empty($data['product']['product_sub_cat_id'])){
                $final_category_id = $data['product']['product_sub_cat_id'];
                $final_category = 2;
            }if(!empty($data['product']['parent_category_id'])){
                $final_category_id = $data['product']['parent_category_id'];
                $final_category = 3;
            }if(!empty($data['product']['child_category_id'])){
                $final_category_id = $data['product']['child_category_id'];
                $final_category = 4;
            }

            $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
            if(!empty($custom_category_info)){
                $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
            }

            $title = _l('edit', _l('product_lowercase'));
        }

        $data['title'] = $title;
        $data['edit_product_id'] = $id;
        $this->load->view('admin/product_new/product', $data);
    }

    public function reject_product($id = '') {

        if ($this->input->post()) {
            $product_data = $this->input->post();

                $success = $this->Product_model->add_reject($product_data,$id);

                handle_product_image_upload_new($success);
                handle_product_multiple_image_upload($success);
                handle_product_drawing_upload($success);


                if ($success) {
                    set_alert('success', 'Product Update, Pending for Approval!');
                }

                redirect(admin_url('product'));

        }

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();

        $this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->get();

        $this->load->model('Product_sub_category_model');
        $data['pro_sub_cat_data'] = $this->Product_sub_category_model->get();

        $this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();

        $this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' ")->result_array();
        $data['product_master'] = $this->db->query("SELECT `id`,`name` FROM `tblproductnewmaster` where `status`='1' ")->result_array();

        $data['productsfield_log'] = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`= '".$id."' ")->result_array();
        $data['productsitems_log'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();


        $data['product'] = $this->db->query("SELECT * FROM `tblproducts_log` where id = '".$id."' ")->row_array();

        $data['parent_category_info'] = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$data['product']['product_sub_cat_id']."' ")->result_array();
        $data['child_category_info'] = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$data['product']['parent_category_id']."' ")->result_array();

            $final_category = 1;
            $final_category_id = $data['product']['product_cat_id'];
            if(!empty($data['product']['product_sub_cat_id'])){
                $final_category_id = $data['product']['product_sub_cat_id'];
                $final_category = 2;
            }if(!empty($data['product']['parent_category_id'])){
                $final_category_id = $data['product']['parent_category_id'];
                $final_category = 3;
            }if(!empty($data['product']['child_category_id'])){
                $final_category_id = $data['product']['child_category_id'];
                $final_category = 4;
            }

            $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
            if(!empty($custom_category_info)){
                $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
            }


        $data['title'] = "Reject Product";
        $this->load->view('admin/product_new/reject_product', $data);
    }

    public function view($id) {

        $title = 'Product Details';
        $product_title_data = '';
        $data['product'] = (array) $this->Product_model->get($id);
        if ($data['product']['product_cat_id'] > 0){
            $product_category = value_by_id_empty("tblproductcategory", $data['product']['product_cat_id'], "name");
            $product_title_data .= $product_category;
        }
        if ($data['product']['product_sub_cat_id'] > 0){
            $productsub_category = value_by_id_empty("tblproductsubcategory", $data['product']['product_sub_cat_id'], "name");
            $product_title_data .= ' > '.$productsub_category;
        }
        if ($data['product']['parent_category_id'] > 0){
            $parent_category = value_by_id_empty("tblproductparentcategory", $data['product']['parent_category_id'], "name");
            $product_title_data .= ' > '.$parent_category;
        }
        if ($data['product']['child_category_id'] > 0){
            $child_category = value_by_id_empty("tblproductchildcategory", $data['product']['child_category_id'], "name");
            $product_title_data .= ' > '.$child_category;
        }

        $title = ($product_title_data != '') ? 'Product Details <span class="text-info">'.$product_title_data.'</span>' : $title;

        if (empty($data['product'])){
            redirect(admin_url('product_new'));
        }

        $data['item_info'] = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result();
        $final_category = 1;
        $final_category_id = $data['product']['product_cat_id'];
        if(!empty($data['product']['product_sub_cat_id'])){
            $final_category_id = $data['product']['product_sub_cat_id'];
            $final_category = 2;
        }if(!empty($data['product']['parent_category_id'])){
            $final_category_id = $data['product']['parent_category_id'];
            $final_category = 3;
        }if(!empty($data['product']['child_category_id'])){
            $final_category_id = $data['product']['child_category_id'];
            $final_category = 4;
        }

        $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
        if(!empty($custom_category_info)){
            $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
        }

        $this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();
        $data['productcomponent'] = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' ")->result_array();
        $data['productdrawing_list'] = $this->db->query("SELECT * FROM `tblproductdrawing` WHERE `product_id`= '".$id."' ORDER BY id DESC ")->result();
        $data['title'] = $title;

        /* this code for product used */
        $data['lead_info'] = $this->db->query("SELECT l.id,l.enquiry_date,p.qty,p.enquiry_id FROM `tblproductinquiry` as p LEFT JOIN tblleads as l ON l.id = p.enquiry_id where p.product_id = '".$id."' and p.status = 1 group by p.enquiry_id ")->result();
        $quotation_info = $this->db->query("SELECT s.total,s.date,s.id,s.revice_id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblproposals as s ON s.id = p.rel_id where p.pro_id = '".$id."' and p.rel_type = 'proposal' group by p.rel_id  ")->result();
        $quotation_list = array();
        if (!empty($quotation_info)){
            foreach ($quotation_info as $val) {
                if (array_key_exists($val->revice_id, $quotation_list)){
                    $quotation_list[$val->revice_id] = $val;
                }else{
                    $quotation_list[$val->id] = $val;
                }
            }
        }
        $data['quotation_info'] = $quotation_list;
        $data['pi_info'] = $this->db->query("SELECT s.total,s.date,s.id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblestimates as s ON s.id = p.rel_id where p.pro_id = '".$id."' and p.rel_type = 'estimate' group by p.rel_id  ")->result();

        $data['invoice_info'] = $this->db->query("SELECT s.service_type,s.total,s.invoice_date,s.id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblinvoices as s ON s.id = p.rel_id where p.pro_id = '".$id."' and p.rel_type = 'invoice' group by p.rel_id order by s.invoice_date asc ")->result();

        $data['challan_info'] = $this->db->query("SELECT c.id,c.chalanno,c.service_type,c.challandate,c.product_json FROM `tblchalandetailsmst` as p LEFT JOIN tblchalanmst as c ON c.id = p.chalan_id where p.component_id = '".$id."' and c.status = 1 group by p.chalan_id ")->result();

        $data['debitnote_info'] = $this->db->query("SELECT d.id,d.dabit_note_date,d.number,d.totalamount,p.qty,p.price FROM `tbldebitnoteproduct` as p LEFT JOIN tbldebitnote as d ON d.id = p.debitnote_id where p.product_id = '".$id."' and d.status = 1 group by p.debitnote_id ")->result();

        $data['purchase_info'] = $this->db->query("SELECT po.id,po.date,po.number,po.totalamount,p.qty,p.price FROM `tblpurchaseorderproduct` as p LEFT JOIN tblpurchaseorder as po ON po.id = p.po_id where p.product_id = '".$id."' and po.status = 1 group by p.po_id ")->result();

        $data['component_info'] = $this->db->query("SELECT `product_id`,`qty` FROM `tblproductitems` where item_id = '".$id."' and status = 1 group by product_id")->result();

        $data['revision_details'] = $this->db->query("SELECT * FROM `tblproducts_log` WHERE product_id = '".$id."' AND id != (SELECT MAX(id) FROM `tblproducts_log` WHERE product_id = '".$id."' AND approval_send = 1 AND approval_status = 1) AND approval_send = 1 AND approval_status = 1 ORDER BY id DESC;")->result();
        $this->load->view('admin/product_new/productview', $data);
    }

    public function products_log_view($id) {

        $data['products_log'] = $this->db->query("SELECT * FROM `tblproducts_log` where `id`= '".$id."' ")->row();
        $data['productsfield_log'] = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`= '".$id."' ")->result_array();
        $data['productsitems_log'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `product_id`= '".$id."' ")->result();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' ")->result_array();

        $data['multiple_images'] = $this->db->query("SELECT * FROM `tblproductfiles_log` where `rel_id`= '".$id."' and `rel_type` = 'mutliple_image' ")->result();
        $data['product_drawing'] = $this->db->query("SELECT * FROM `tblproductfiles_log` where `rel_id`= '".$id."' and `rel_type` = 'drawing' ")->result();
        $data['productmaterial_list'] = $this->db->query("SELECT * FROM `tblproductmaterial` WHERE `status` = '1' ")->result();
        $data['productdrawing_list'] = $this->db->query("SELECT * FROM `tblproductdrawing_log` WHERE `product_id`= '".$id."' ORDER BY id DESC ")->result();


        $data['product'] = $this->db->query("SELECT * FROM `tblproducts_log` where id = '".$id."' ")->row_array();

            $final_category = 1;
            $final_category_id = $data['product']['product_cat_id'];
            if(!empty($data['product']['product_sub_cat_id'])){
                $final_category_id = $data['product']['product_sub_cat_id'];
                $final_category = 2;
            }if(!empty($data['product']['parent_category_id'])){
                $final_category_id = $data['product']['parent_category_id'];
                $final_category = 3;
            }if(!empty($data['product']['child_category_id'])){
                $final_category_id = $data['product']['child_category_id'];
                $final_category = 4;
            }

            $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
            if(!empty($custom_category_info)){
                $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' and fd.type != '3' order by f.field_order asc ")->result();
            }

        $title = 'View Custom Products';

        $data['title'] = $title;
        $this->load->view('admin/product_new/products_log_view', $data);
    }

    public function delete($id) {

        check_permission(295,'delete');

        $can_delete = can_product_delete($id);
        if($can_delete == 0){
            set_alert('warning', 'This Product is in Used, can\'t Delete !');
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }
        $success = $this->Product_model->delete_new($id);

        if ($success) {
            set_alert('success', _l('deleted', _l('product')));
            if (strpos($_SERVER['HTTP_REFERER'], 'product/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
               redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('product/product/' . $id));
        }
    }

    /* Change Component status / active / inactive */

    public function change_product_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $product_data = array(
                'status' => $status
            );
            $this->home_model->update('tblproducts', $product_data,array('id'=>$id));
           // $this->Product_model->edit($product_data, $id);
        }
    }


	 public function imagedelete() {

		$id=$this->input->post('proid');
        $success = $this->Product_model->imagedelete($id);

        if ($success) {
            set_alert('success', _l('deleted', _l('product')));
            if (strpos($_SERVER['HTTP_REFERER'], 'product/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('product/product/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('product/product/' . $id));
        }
    }


    public function export_products()
    {

        check_permission(295,'view');



                // create file name
                $fileName = 'Products.xlsx';
                // load excel library
                $this->load->library('excel');


                $product_info = $this->db->query("SELECT * from tblproducts  WHERE status='1' and isOtherCharge = '0' ")->result();


                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);


                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:U1');
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:U2');
                $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Date : '.date('d/m/Y').'');



                // set Header
                $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Sr.No.');
                $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Product Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Company Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Product Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Product Category');
                $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Product Sub Category');
                $objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Product Parent Category');
                $objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Product Child Category');
                $objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Print Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Unit');
                $objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Product Description');
                $objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Size');
                $objPHPExcel->getActiveSheet()->SetCellValue('M3', 'Working Height');
                $objPHPExcel->getActiveSheet()->SetCellValue('N3', 'Platform Height');
                $objPHPExcel->getActiveSheet()->SetCellValue('O3', 'Tower Height');
                $objPHPExcel->getActiveSheet()->SetCellValue('P3', 'Dimensions');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q3', 'HSN Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('R3', 'SAC Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('S3', 'GST Percent');
                $objPHPExcel->getActiveSheet()->SetCellValue('T3', 'Purchase Price');
                $objPHPExcel->getActiveSheet()->SetCellValue('U3', 'Product Weight');
                $objPHPExcel->getActiveSheet()->SetCellValue('V3', 'Sale Price(Cat A)');
                $objPHPExcel->getActiveSheet()->SetCellValue('W3', 'Sale Price(Cat B)');
                $objPHPExcel->getActiveSheet()->SetCellValue('X3', 'Sale Price(Cat C)');
                $objPHPExcel->getActiveSheet()->SetCellValue('Y3', 'Sale Price(Cat D)');
                $objPHPExcel->getActiveSheet()->SetCellValue('Z3', 'Rental Price(Cat A)');
                $objPHPExcel->getActiveSheet()->SetCellValue('AA3', 'Rental Price(Cat B)');
                $objPHPExcel->getActiveSheet()->SetCellValue('AB3', 'Rental Price(Cat C)');
                $objPHPExcel->getActiveSheet()->SetCellValue('AC3', 'Rental Price(Cat D)');
                $objPHPExcel->getActiveSheet()->SetCellValue('AD3', 'Damage Rate');
                $objPHPExcel->getActiveSheet()->SetCellValue('AE3', 'Lost Rate');
                $objPHPExcel->getActiveSheet()->SetCellValue('AF3', 'Repairable Rate');
                $objPHPExcel->getActiveSheet()->SetCellValue('AG3', 'Product Description');
                // set Row
                $rowCount = 4;
                $i = 1;
                foreach ($product_info as $val)
                {

                    $cateogry_name = value_by_id('tblproductcategory',$val->product_cat_id,'name');
                    $sub_cateogry_name = value_by_id('tblproductsubcategory',$val->product_sub_cat_id,'name');
                    $parent_cateogry_name = value_by_id('tblproductparentcategory',$val->parent_category_id,'name');
                    $child_cateogry_name = value_by_id('tblproductchildcategory',$val->child_category_id,'name');
                    $unit = value_by_id('tblunitmaster',$val->unit_id,'name');

                    $tax_info = $this->db->query("select * from tbltaxes where id = '".$val->gst_id."'")->row();
                    $tax_name =  (!empty($tax_info)) ? $tax_info->name.' ('.$tax_info->taxrate.') ' : '--';


                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'PRO-'.$val->id);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, strtoupper($val->company_product_code));
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, strtoupper($val->name));
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, strtoupper($cateogry_name));
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, strtoupper($sub_cateogry_name));
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, strtoupper($parent_cateogry_name));
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, strtoupper($child_cateogry_name));
                    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, strtoupper($val->sub_name));
                    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $unit);
                    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, (!empty($val->product_description)) ? $val->product_description : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, (!empty($val->size)) ? $val->size : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, (!empty($val->working_height)) ? $val->working_height : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, (!empty($val->platform_height)) ? $val->platform_height : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, (!empty($val->tower_height)) ? $val->tower_height : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, (!empty($val->dimensions)) ? $val->dimensions : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, (!empty($val->hsn_code)) ? $val->hsn_code : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, (!empty($val->sac_code)) ? $val->sac_code : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $tax_name);
                    $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, (!empty($val->purchase_price)) ? $val->purchase_price : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, (!empty($val->product_weight)) ? $val->product_weight : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $val->sale_price_cat_a);
                    $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $val->sale_price_cat_b);
                    $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $val->sale_price_cat_c);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $val->sale_price_cat_d);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $val->rental_price_cat_a);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $rowCount, $val->rental_price_cat_b);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, $val->rental_price_cat_c);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, $val->rental_price_cat_d);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $rowCount, (!empty($val->damage_rate)) ? $val->damage_rate : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('AE' . $rowCount, (!empty($val->lost_rate)) ? $val->lost_rate : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $rowCount, (!empty($val->repairable_rate)) ? $val->repairable_rate : '--');
                    $objPHPExcel->getActiveSheet()->SetCellValue('AG' . $rowCount, (!empty($val->product_description)) ? $val->product_description : '--');

                    $i++;
                    $rowCount++;
                }
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save($fileName);
                // download file
                header("Content-Type: application/vnd.ms-excel");
                redirect(site_url().$fileName);


    }

    public function get_sub_categoty() {
        if ($this->input->post()) {
            extract($this->input->post());
            $sub_category_info = $this->db->query("SELECT * FROM `tblproductsubcategory` where `status`='1' and category_id = '".$id."' order by name asc ")->result();
            $html = '<option value=""></option>';
            if(!empty($sub_category_info)){
                foreach ($sub_category_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }
            echo $html;
        }
    }

    public function get_parent_categoty() {
        if ($this->input->post()) {
            extract($this->input->post());
            $parent_category_info = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$id."'  order by name asc")->result();
            $html = '<option value=""></option>';
            if(!empty($parent_category_info)){
                foreach ($parent_category_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }
            echo $html;
        }
    }

    public function get_product() {
        if ($this->input->post()) {
            extract($this->input->post());
            $where = "status = 1 ";
            if(!empty($product_cat_id)){
                $where .= "and product_cat_id = '".$product_cat_id."'";
            }
            if(!empty($product_sub_cat_id)){
                $where .= "and product_sub_cat_id = '".$product_sub_cat_id."'";
            }
            if(!empty($parent_category_id)){
                $where .= "and parent_category_id = '".$parent_category_id."'";
            }
            if(!empty($child_category_id)){
                $where .= "and child_category_id = '".$child_category_id."'";
            }
            $product_info = $this->db->query("SELECT * FROM `tblproducts` where ".$where."  order by name asc")->result();
            $html = '<option value=""></option>';
            if(!empty($product_info)){
                foreach ($product_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.product_code($value->id).'</option>';
                }
            }
            echo $html;
        }
    }

    public function check_bundles_entry() {
        if ($this->input->post()) {
            extract($this->input->post());
            $child_category_info = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$id."'  order by name asc")->result();
            $html = '<option value=""></option>';
            if(!empty($child_category_info)){
                foreach ($child_category_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }
            echo $html;
        }
    }

    public function get_custom_fields() {
        if ($this->input->post()) {
            extract($this->input->post());
            $html = '';

            $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$type."' and final_category_id = '".$id."' ")->row();
            if(!empty($custom_category_info)){
                $field_info = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
                if(!empty($field_info)){
                    foreach ($field_info as $row) {
                        $required = "";
                        $require_html = "";
                        if($row->required == 1){
                            $required = "required";
                            $require_html = "<span style=\"color: red;\">*</span>";
                        }
                        if($row->type == 1){
                            $html .= '<div class="form-group col-md-'.$row->size.'">
                                    <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.' </label>
                                    <input type="text" id="'.$row->field_id.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control" value="">
                                </div>';
                        }if($row->type == 2){
                            $html .= '<div class="form-group col-md-'.$row->size.'" >
                                    <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.'</label>
                                    <textarea id="'.$row->field_id.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control"></textarea>
                                </div>';
                        }if($row->type == 3){
                            $html .= '<div class="form-group col-md-'.$row->size.'">
                                    <label for="drawing" class="control-label">'.$row->name.$require_html.'</label>
                                    <input type="file" id="drawing" name="drawing[]" multiple="" '.$required.'>
                                </div>';
                        }
                    }
                }
            }

            echo $html;
        }
    }


    public function approval_list() {
        check_permission(293,'view');
        $where = "`staff_id`= '".get_staff_user_id()."' ";
        if ($this->input->post()) {
            extract($this->input->post());
            if(!empty($status)){
                $data['status'] = $status;
                if($status == 3){
                    $status = 0;
                }
                $where .= " and approval_status = '".$status."' ";
            }
        }else{

        }

        $data['send_info'] = $this->db->query("SELECT * FROM `tblproductapprovalsend` where ".$where." ORDER BY id desc ")->result();

        $data['title'] = 'Approval List';
        $this->load->view('admin/product_new/approval_list', $data);
    }

    public function reject_list() {

        $data['send_info'] = $this->db->query("SELECT * FROM `tblproductrejectsend` where `staff_id`= '".get_staff_user_id()."' and status = '0' ORDER BY id desc ")->result();

        $data['title'] = 'Reject List';
        $this->load->view('admin/product_new/reject_list', $data);
    }


    public function send_product_approval($id = '') {
        check_permission(293,'create');
        if ($this->input->post()) {
            $product_data = $this->input->post();

            if(empty($product_data['row'])){
                set_alert('warning', 'Please Select Product for approval!');
                redirect(admin_url('product_new/send_product_approval'));
            }
            $id = $this->Product_model->add_product_approval($product_data);
            if ($id) {
                set_alert('success', 'Product list send for approval!');
                redirect(admin_url('product_new/approval_list'));
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

        $data['item_data'] = $this->db->query("SELECT * FROM `tblproducts_log` where `approval_send`='0' and staff_id = '".get_staff_user_id()."' ")->result();
        $data['title'] = 'Send Product For Approval';
        $this->load->view('admin/product_new/send_product_approval', $data);
    }


    public function product_approval($id = '') {
        //check_permission(295,'create');

        $info = $this->db->query("SELECT * from tblproductapprovalsend  where id = '".$id."' and approval_status > 0 ")->row();
        if(!empty($info)){
            set_alert('warning', 'Action already taken!');
             redirect(admin_url('approval/notifications'));
        }

        if ($this->input->post()) {
            $product_data = $this->input->post();
            $id = $this->Product_model->product_approval($product_data,$id);
            if ($id) {
                set_alert('success', 'Record updated succesfully');
                redirect(admin_url('approval/notifications'));
            }
        }

        if($id != ''){
           $data['main_info'] = $this->db->query("SELECT * FROM `tblproductapprovalsend` where id = '".$id."' ")->row();
           $data['item_data'] = $this->db->query("SELECT ps.id as main_id,pl.* FROM `tblproducts_log` as pl LEFT JOIN tblproductapprovalsend_products as ps ON pl.id = ps.product_id where main_id = '".$id."' ")->result();
        }

        $data['title'] = 'Product For Approval';
        $this->load->view('admin/product_new/product_approval', $data);
    }

    public function get_product_approval_status() {


        if(!empty($_POST)){
            extract($this->input->post());

            $product_info = $this->db->query("SELECT * from tblproductapprovalsend_products  where main_id = '".$id."' ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Product Details for Approval</h4>

                </div>
                 <hr/>
                <div class="col-md-12">
                <div style="overflow-x:auto !important;">
                    <div class="form-group" >
                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Product Name</th>
                                    <th>Print Name</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($product_info)){
                                $i = 1;
                                foreach ($product_info as $value) {

                                        if($value->approval_status == 0){
                                            $status = 'Pending';
                                            $color = 'Darkorange';
                                        }elseif($value->approval_status == 1){
                                            $status = 'Approved';
                                            $color = 'green';
                                        }elseif($value->approval_status == 2){
                                            $status = 'Reject';
                                            $color = 'red';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><a target="_blank" href="<?php echo admin_url('product_new/products_log_view/'.$value->product_id); ?>"><?php echo value_by_id('tblproducts_log',$value->product_id,'name'); ?></a></td>
                                        <td><?php echo value_by_id('tblproducts_log',$value->product_id,'sub_name'); ?></td>
                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                        <!-- <td><?php

                                        /*if($value->approval_status == 0) {
                                            ?>
                                            <a class="btn-sm btn-info" target="_blank" href="<?php echo admin_url('product_new/edit_product/'.$value->product_id); ?>">Edit</a>
                                            <?php
                                        }else{
                                            echo '--';
                                        }*/
                                        ?><!-- </td> -->
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

    public function get_product_reject_status() {


        if(!empty($_POST)){
            extract($this->input->post());

            $product_info = $this->db->query("SELECT * from tblproductrejectsend  where id = '".$id."' ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Product Details for Approval</h4>

                </div>
                 <hr/>
                <div class="col-md-12">
                <div style="overflow-x:auto !important;">
                    <div class="form-group" >
                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Product Name</th>
                                    <th>Print Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($product_info)){
                                $i = 1;
                                foreach ($product_info as $value) {

                                        if($value->status == 0){
                                            $status = 'Pending';
                                            $color = 'Darkorange';
                                        }elseif($value->status == 1){
                                            $status = 'Approved';
                                            $color = 'green';
                                        }elseif($value->status == 2){
                                            $status = 'Reject';
                                            $color = 'red';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><a target="_blank" href="<?php echo admin_url('product_new/products_log_view/'.$value->product_id); ?>"><?php echo value_by_id('tblproducts_log',$value->product_id,'name'); ?></a></td>
                                        <td><?php echo value_by_id('tblproducts_log',$value->product_id,'sub_name'); ?></td>
                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
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



    public function product_for_delete()
    {

        $data['product_info'] = $this->db->query("SELECT * from tblproducts where updated_at < '2020-09-01 00:00:00'")->result();


        $data['title'] = 'Product For Delete';
        $this->load->view('admin/product_new/product_for_delete', $data);

    }

    public function productmaster_view() {

        $data['productmaster_info'] = $this->db->query("SELECT * from tblproductnewmaster ")->result();
        $data['title'] = 'Product Master';
        $this->load->view('admin/product_new/productmaster_view', $data);
    }

    public function product_master($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());
            if ($id == '') {

                $ad_data = array(
                    'name' => $name,
                    'status' => $status,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $insert = $this->home_model->insert('tblproductnewmaster',$ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'product master'));
                    redirect(admin_url('product_new/productmaster_view'));
                }
            } else {
                $up_data = array(
                    'name' => $name,
                    'status' => $status,
                    'update_at' => date('Y-m-d H:i:s')
                );

                $update = $this->home_model->update('tblproductnewmaster',$up_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', _l('updated_successfully', 'product master'));
                }

                redirect(admin_url('product_new/productmaster_view'));
            }
        }

        if ($id == '') {
            $title = 'Add Product data';
        } else {
            $data['product_info'] = $this->db->query("SELECT * from tblproductnewmaster WHERE id = '".$id."' ")->row();
            $title = 'Edit Product data';
        }

        $data['title'] = $title;
        $this->load->view('admin/product_new/product_master', $data);
    }


    // Edit Product
    public function edit_product($id = '') {

        if ($this->input->post()) {
            $product_data = $this->input->post();

                $success = $this->Product_model->edit_log($product_data,$id);

                if(in_array("", $_FILES['drawing']['name']))
                {
                   set_alert('success','file not select');
                }
                else
                {
                    $check = $this->db->query("SELECT * FROM `tblproductfiles_log` where rel_id = '".$id."' and rel_type = 'drawing' ");
                    if($check)
                    {
                      $this->db->delete('tblproductfiles_log',array('rel_id'=>$id,'rel_type'=>'drawing'));
                    }

                    handle_product_drawing_upload($id);
                }

                if(in_array("", $_FILES['photo_multiple']['name']))
                {
                   set_alert('success','file not select');
                }
                else
                {
                    $check1 = $this->db->query("SELECT * FROM `tblproductfiles_log` where rel_id = '".$id."' and rel_type = 'mutliple_image' ");
                    if($check1)
                    {
                      $this->db->delete('tblproductfiles_log',array('rel_id'=>$id,'rel_type' => 'mutliple_image'));
                    }

                    handle_product_multiple_image_upload($id);
                }

                handle_product_image_upload_new($id);

                if ($success) {
                    set_alert('success', 'Product Update, Pending for Approval!');
                }

                redirect(admin_url('product'));

        }

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();

        $this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->get();

        $this->load->model('Product_sub_category_model');
        $data['pro_sub_cat_data'] = $this->Product_sub_category_model->get();

        $this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();

        $this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1'  order by name asc")->result_array();
        $data['product_master'] = $this->db->query("SELECT `id`,`name` FROM `tblproductnewmaster` where `status`='1'  order by name asc")->result_array();

        $data['productsfield_log'] = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`= '".$id."' ")->result_array();
        $data['productsitems_log'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();


        $data['product'] = $this->db->query("SELECT * FROM `tblproducts_log` where id = '".$id."' ")->row_array();

        $data['parent_category_info'] = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$data['product']['product_sub_cat_id']."'  order by name asc")->result_array();
        $data['child_category_info'] = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$data['product']['parent_category_id']."'  order by name asc")->result_array();

         $data['productcomponent'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();

            $final_category = 1;
            $final_category_id = $data['product']['product_cat_id'];
            if(!empty($data['product']['product_sub_cat_id'])){
                $final_category_id = $data['product']['product_sub_cat_id'];
                $final_category = 2;
            }if(!empty($data['product']['parent_category_id'])){
                $final_category_id = $data['product']['parent_category_id'];
                $final_category = 3;
            }if(!empty($data['product']['child_category_id'])){
                $final_category_id = $data['product']['child_category_id'];
                $final_category = 4;
            }

            $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
            if(!empty($custom_category_info)){
                $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
            }


        $data['title'] = "Edit Product";
        $this->load->view('admin/product_new/edit_product', $data);
    }


    public function product_used($product_id = '') {

        $section = 1;
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;
                $section = 2;

              	$data['lead_info'] = $this->db->query("SELECT l.id,l.enquiry_date,p.qty,p.enquiry_id FROM `tblproductinquiry` as p LEFT JOIN tblleads as l ON l.id = p.enquiry_id where p.product_id = '".$product_id."' and enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' and p.status = 1 group by p.enquiry_id ")->result();
              	$quotation_info = $this->db->query("SELECT s.total,s.date,s.id,s.revice_id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblproposals as s ON s.id = p.rel_id where p.pro_id = '".$product_id."' and date between '".db_date($f_date)."' and '".db_date($t_date)."' and p.rel_type = 'proposal' group by p.rel_id  ")->result();
                $quotation_list = array();
                if (!empty($quotation_info)){
                    foreach ($quotation_info as $val) {
                        if (array_key_exists($val->revice_id, $quotation_list)){
                            $quotation_list[$val->revice_id] = $val;
                        }else{
                            $quotation_list[$val->id] = $val;
                        }
                    }
                }
                $data['quotation_info'] = $quotation_list;
              	$data['pi_info'] = $this->db->query("SELECT s.total,s.date,s.id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblestimates as s ON s.id = p.rel_id where p.pro_id = '".$product_id."' and date between '".db_date($f_date)."' and '".db_date($t_date)."' and p.rel_type = 'estimate' group by p.rel_id  ")->result();

              	$data['invoice_info'] = $this->db->query("SELECT s.service_type,s.total,s.invoice_date,s.id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblinvoices as s ON s.id = p.rel_id where p.pro_id = '".$product_id."' and invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' and p.rel_type = 'invoice' group by p.rel_id order by s.invoice_date asc ")->result();

              	$data['challan_info'] = $this->db->query("SELECT c.id,c.chalanno,c.service_type,c.challandate,c.product_json FROM `tblchalandetailsmst` as p LEFT JOIN tblchalanmst as c ON c.id = p.chalan_id where p.component_id = '".$product_id."' and challandate between '".db_date($f_date)."' and '".db_date($t_date)."' and c.status = 1 group by p.chalan_id ")->result();

              	$data['debitnote_info'] = $this->db->query("SELECT d.id,d.dabit_note_date,d.number,d.totalamount,p.qty,p.price FROM `tbldebitnoteproduct` as p LEFT JOIN tbldebitnote as d ON d.id = p.debitnote_id where p.product_id = '".$product_id."' and dabit_note_date between '".db_date($f_date)."' and '".db_date($t_date)."' and d.status = 1 group by p.debitnote_id ")->result();

                $data['purchase_info'] = $this->db->query("SELECT po.id,po.date,po.number,po.totalamount,p.qty,p.price FROM `tblpurchaseorderproduct` as p LEFT JOIN tblpurchaseorder as po ON po.id = p.po_id where p.product_id = '".$product_id."'  and date between '".db_date($f_date)."' and '".db_date($t_date)."' and po.status = 1 group by p.po_id ")->result();

                $data['component_info'] = $this->db->query("SELECT `product_id`,`qty` FROM `tblproductitems` where item_id = '".$product_id."' and status = 1 group by product_id")->result();
            }
        }

        if ($section == 1){
            $data['lead_info'] = $this->db->query("SELECT l.id,l.enquiry_date,p.qty,p.enquiry_id FROM `tblproductinquiry` as p LEFT JOIN tblleads as l ON l.id = p.enquiry_id where p.product_id = '".$product_id."' and p.status = 1 group by p.enquiry_id ")->result();
            $quotation_info = $this->db->query("SELECT s.total,s.date,s.id,s.revice_id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblproposals as s ON s.id = p.rel_id where p.pro_id = '".$product_id."' and p.rel_type = 'proposal' group by p.rel_id  ")->result();
            $quotation_list = array();
            if (!empty($quotation_info)){
                foreach ($quotation_info as $val) {
                    if (array_key_exists($val->revice_id, $quotation_list)){
                        $quotation_list[$val->revice_id] = $val;
                    }else{
                        $quotation_list[$val->id] = $val;
                    }
                }
            }
            $data['quotation_info'] = $quotation_list;
            $data['pi_info'] = $this->db->query("SELECT s.total,s.date,s.id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblestimates as s ON s.id = p.rel_id where p.pro_id = '".$product_id."' and p.rel_type = 'estimate' group by p.rel_id  ")->result();

            $data['invoice_info'] = $this->db->query("SELECT s.service_type,s.total,s.invoice_date,s.id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblinvoices as s ON s.id = p.rel_id where p.pro_id = '".$product_id."' and p.rel_type = 'invoice' group by p.rel_id order by s.invoice_date asc ")->result();

            $data['challan_info'] = $this->db->query("SELECT c.id,c.chalanno,c.service_type,c.challandate,c.product_json FROM `tblchalandetailsmst` as p LEFT JOIN tblchalanmst as c ON c.id = p.chalan_id where p.component_id = '".$product_id."' and c.status = 1 group by p.chalan_id ")->result();

            $data['debitnote_info'] = $this->db->query("SELECT d.id,d.dabit_note_date,d.number,d.totalamount,p.qty,p.price FROM `tbldebitnoteproduct` as p LEFT JOIN tbldebitnote as d ON d.id = p.debitnote_id where p.product_id = '".$product_id."' and d.status = 1 group by p.debitnote_id ")->result();

            $data['purchase_info'] = $this->db->query("SELECT po.id,po.date,po.number,po.totalamount,p.qty,p.price FROM `tblpurchaseorderproduct` as p LEFT JOIN tblpurchaseorder as po ON po.id = p.po_id where p.product_id = '".$product_id."' and po.status = 1 group by p.po_id ")->result();

            $data['component_info'] = $this->db->query("SELECT `product_id`,`qty` FROM `tblproductitems` where item_id = '".$product_id."' and status = 1 group by product_id")->result();
        }

      	$data['product_id'] = $product_id;
      	$data['title'] = "Product Used";
        $data['type'] = "product";
        $this->load->view('admin/product_new/product_used', $data);
    }

    public function temp_product_used($product_id = '') {

      	$data['lead_info'] = $this->db->query("SELECT l.id,l.enquiry_date,p.qty,p.enquiry_id FROM `tblproductinquiry` as p LEFT JOIN tblleads as l ON l.id = p.enquiry_id where p.product_id = '".$product_id."' and p.temp_product = 1 and p.status = 1 group by p.enquiry_id ")->result();
      	$quotation_info = $this->db->query("SELECT s.total,s.date,s.id,s.revice_id,p.qty,p.rate FROM `tblitems_in` as p LEFT JOIN tblproposals as s ON s.id = p.rel_id where p.pro_id = '".$product_id."'  and p.temp_product = 1 and p.rel_type = 'proposal' group by p.rel_id  ")->result();
        $quotation_list = array();
        if (!empty($quotation_info)){
            foreach ($quotation_info as $val) {
                if (array_key_exists($val->revice_id, $quotation_list)){
                    $quotation_list[$val->revice_id] = $val;
                }else{
                    $quotation_list[$val->id] = $val;
                }
            }
        }
        $data['quotation_info'] = $quotation_list;
      	$data['product_id'] = $product_id;
      	$data['type'] = "temp";
      	$data['title'] = "Product Used";
        $this->load->view('admin/product_new/product_used', $data);
    }

    public function product_merge() {

        if ($this->input->post()) {
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            if(!empty($sub_product_id) && !empty($main_product_id)){

                $sub_str = implode(',', $sub_product_id);
                $ad_data = array(
                    'staff_id' => get_staff_user_id(),
                    'main_id' => $main_product_id,
                    'sub_id' => $sub_str,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $this->home_model->insert('tblproducts_mergelog',$ad_data);

                $product_name = value_by_id('tblproducts',$main_product_id,'sub_name');
                $hsn_code = get_hsn_code($main_product_id);
                $pro_id = 'PRO-ID'.$main_product_id;

                foreach ($sub_product_id as $sub_id) {



                    //Lead Product
                    $leadproduct_info = $this->db->query("SELECT * FROM `tblproductinquiry`  where product_id = '".$sub_id."' and status = 1 and temp_status = 0 ")->result();
                    if(!empty($leadproduct_info)){
                        foreach ($leadproduct_info as $row) {
                            $this->home_model->update('tblproductinquiry', array('product_id '=>$main_product_id,'temp_status'=>1),array('id'=>$row->id));
                        }
                    }

                    //Sales Product
                    $items_info = $this->db->query("SELECT * FROM `tblitems_in`  where pro_id = '".$sub_id."' and rel_type IN ('proposal','estimate','invoice') and temp_status = 0 ")->result();
                    if(!empty($items_info)){
                        foreach ($items_info as $row_1) {
                            $this->home_model->update('tblitems_in', array('pro_id '=>$main_product_id,'description'=>$product_name,'hsn_code'=>$hsn_code,'temp_status'=>1),array('id'=>$row_1->id));
                        }
                    }

                    //Challan Product
                    $challanproduct_info = $this->db->query("SELECT * FROM `tblchalandetailsmst`  where component_id = '".$sub_id."' and temp_status = 0 ")->result();
                    if(!empty($challanproduct_info)){
                        foreach ($challanproduct_info as $row_2) {
                            $this->home_model->update('tblchalandetailsmst', array('component_id '=>$main_product_id,'temp_status'=>1),array('id'=>$row_2->id));
                        }
                    }

                    //DN Product
                    $dnproduct_info = $this->db->query("SELECT * FROM `tbldebitnoteproduct`  where product_id = '".$sub_id."' and temp_status = 0 ")->result();
                    if(!empty($dnproduct_info)){
                        foreach ($dnproduct_info as $row_3) {
                            $this->home_model->update('tbldebitnoteproduct', array('product_id '=>$main_product_id,'product_name'=>$product_name,'hsn_code'=>$hsn_code,'pro_id'=>$pro_id,'temp_status'=>1),array('id'=>$row_3->id));
                        }
                    }

                    //PO Products
                    $poproduct_info = $this->db->query("SELECT * FROM `tblpurchaseorderproduct`  where product_id = '".$sub_id."' and temp_status = 0 ")->result();
                    if(!empty($poproduct_info)){
                        foreach ($poproduct_info as $row_4) {
                            $this->home_model->update('tblpurchaseorderproduct', array('product_id '=>$main_product_id,'product_name'=>$product_name,'hsn_code'=>$hsn_code,'pro_id'=>$pro_id,'temp_status'=>1),array('id'=>$row_4->id));
                        }
                    }


                }

                set_alert('success', 'Product Merged Successfully!');
                redirect(admin_url('product_new'));
            }
        }

        $data['products_info'] = $this->db->query("SELECT * FROM `tblproducts` where `status`='1' ")->result_array();

        $data['title'] = "Product Merging";
        $this->load->view('admin/product_new/product_merge', $data);
    }

    public function merge_old_to_new() {

        $products_info = $this->db->query("SELECT *  FROM `tblproducts_new` WHERE `is_approved` = 1 and merging_remark != ' ' ")->result();
        /*echo '<pre/>';
        print_r($products_info);
        die;*/
        if(!empty($products_info)){
            foreach ($products_info as $value) {
               $new_product_id = $value->id;
               $old_product_arr = explode(',', $value->merging_remark);
               $product_name = value_by_id('tblproducts_new',$new_product_id,'sub_name');
               if(!empty($old_product_arr)){
                    foreach ($old_product_arr as $product_id) {
                        //Lead Product
                        $this->db->query("Update `tblproductinquiry` set product_id = '".$new_product_id."' where product_id = '".$product_id."' and status = 1 ");

                        //Sales Product
                        $this->db->query("Update `tblitems_in` set pro_id = '".$new_product_id."', description = '".$product_name."' where pro_id = '".$product_id."' and rel_type IN ('proposal','estimate','invoice') ");

                        //Challan Product
                        $this->db->query("Update `tblchalandetailsmst` set component_id = '".$new_product_id."' where component_id = '".$product_id."' ");

                        //DN Product
                        $this->db->query("Update `tbldebitnoteproduct` set product_id = '".$new_product_id."', product_name = '".$product_name."' where product_id = '".$product_id."' ");

                        //DN Product
                        $this->db->query("Update `tblvendorproductsname` set product_id = '".$new_product_id."' where product_id = '".$product_id."' and status = 1 ");
                    }
               }

            }
        }

    }

    public function merge_old_to_new_updated() {

        $products_info = $this->db->query("SELECT *  FROM `tblproducts` WHERE `is_approved` = 1 and merging_remark != ' ' ")->result();
        /*echo '<pre/>';
        print_r($products_info);
        die;*/
        if(!empty($products_info)){
            foreach ($products_info as $value) {
               $new_product_id = $value->id;
               $old_product_arr = explode(',', $value->merging_remark);
               $product_name = value_by_id('tblproducts',$new_product_id,'sub_name');
               if(!empty($old_product_arr)){
                    foreach ($old_product_arr as $product_id) {
                        //DN Product
                        $this->db->query("Update `tblpurchaseorderproduct` set product_id = '".$new_product_id."', product_name = '".$product_name."' where product_id = '".$product_id."' ");
                    }
               }

            }
        }

    }

    public function revert_back() {
        $old_items_info = $this->db->query("SELECT *  FROM `tblpurchaseorderproduct_old` order by id ASC ")->result();
        foreach ($old_items_info as $key => $value) {

            $this->home_model->update('tblpurchaseorderproduct', array('product_id '=>$value->product_id),array('id'=>$value->id));
        }
    }


    public function new_product_merge() {

        $products_info = $this->db->query("SELECT *  FROM `tblproducts` WHERE `is_approved` = 1 and merging_remark != ' ' ")->result();

        if(!empty($products_info)){
            foreach ($products_info as $value) {
               $new_product_id = $value->id;
               $old_product_arr = explode(',', $value->merging_remark);
               $product_name = value_by_id('tblproducts',$new_product_id,'sub_name');
               $hsn_code = get_hsn_code($new_product_id);
               $pro_id = 'PRO-ID'.$new_product_id;

               if(!empty($old_product_arr)){
                    foreach ($old_product_arr as $product_id) {

                         $old_products_info = $this->db->query("SELECT *  FROM `tblpurchaseorderproduct` WHERE `product_id` = '".$product_id."' and temp_status = '0' ")->result();

                         if(!empty($old_products_info)){
                            foreach ($old_products_info as $row) {
                                $this->home_model->update('tblpurchaseorderproduct', array('product_id '=>$new_product_id,'product_name'=>$product_name,'hsn_code'=>$hsn_code,'pro_id'=>$pro_id,'temp_status'=>1),array('id'=>$row->id));
                            }
                         }
                    }
               }

            }
        }

    }



    public function test() {
        $product_info = $this->db->query("SELECT p.id as new_id,op.id as old_id, p.name as new_name,op.name as old_name, p.merging_remark FROM `tblproducts` as p LEFT JOIN tblproducts_old as op ON p.id = op.id where p.is_approved = 0 ")->result();
        foreach ($product_info as $key => $value) {

            $exist_info = $this->db->query("SELECT * FROM `tblproducts` WHERE FIND_IN_SET('".$value->old_id."', merging_remark)   ")->result();
            if(!empty($exist_info)){
                 $add_items =  array(
                        'new_id' => $value->new_id,
                        'old_id' => $value->old_id,
                        'new_name' => $value->new_name,
                        'old_name' => $value->old_name,
                        'merging_remark' => $value->merging_remark,
                    );
                $this->db->insert('tblproducttemp', $add_items);
            }
        }
    }

    public function test_new() {
        $product_info = $this->db->query("SELECT * FROM `tblproducts` WHERE is_approved =0")->result();
        $ids = 0;
        foreach ($product_info as $key => $value) {
           $exist_info = $this->db->query("SELECT * FROM `tblproducttemp` WHERE new_id = '".$value->id."'")->row();
           if(empty($exist_info)){
               $ids .= ','.$value->id;
           }
        }
        echo $ids;
    }

    public function add_product_field() {

        if ($this->input->post()) {
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            $this->db->query("UPDATE `tblproductsfield` SET `field_value`= '".$field_value."' WHERE id IN (".$field_id.")  ");

            set_alert('success', 'Product Field Added Successfully!');
            redirect(admin_url('product_new/add_product_field'));
        }


        $data['title'] = "Add Product Fields For Priyanka";
        $this->load->view('admin/product_new/add_product_field', $data);
    }

    public function temperory_product_view() {

        $data['product_data'] = $this->db->query("SELECT * FROM `tbltemperoryproduct` order by id desc ")->result();

        $data['title'] = 'Products For Quote List';
        $this->load->view('admin/product_new/temperory_product_view', $data);
    }

    public function temperory_product($id = '') {
        if ($this->input->post()) {
            extract($this->input->post());


               if(!empty($assignid)){
                    foreach ($assignid as $single_staff) {
                    if (strpos($single_staff, 'staff') !== false) {
                            $staff_id[] = str_replace("staff", "", $single_staff);
                        }

                    }
                    $staff_id = array_unique($staff_id);

                    $staff_str = implode(",",$staff_id);
               }else{
                    $staff_str = '';
               }
               
            if ($id == '') {

                $ad_data = array(
                    'staff_id' => get_staff_user_id(),
                    'assignid' => $staff_str,
                    'category_id' => $product_cat_id,
                    'product_name' => $product_name,
                    'product_desc' => $description,
                    'unit' => $unit,
                    'price' => $product_price,
                    'sac' => $sac,
                    'hsn' => $hsn,
                    'status'=> 0,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $insert = $this->home_model->insert('tbltemperoryproduct', $ad_data);
                if ($insert) {
                    $insert_id = $this->db->insert_id();
                    temperory_product_image_upload($insert_id);

                    if (!empty($staff_id)) {
                        foreach ($staff_id as $staffid) {

                            $approval_data = array(
                                'staff_id' => $staffid,
                                'pro_id' => $insert_id,
                                'approve_status' => '0',
                                'created_at' => date("Y-m-d H:i:s")
                            );
                            $this->db->insert('tbltemperoryproduct_approval', $approval_data);

                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid' => get_staff_user_id(),
                                'module_id' => 13,
                                'description' => 'Temperory Product Send to you for Approval',
                                'table_id' => $insert_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'link' => 'product_new/temperory_product_approval/' . $insert_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $message = 'Temperory Product('.$product_name.') Send to you for Approval';
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }
                    set_alert('success', _l('added_successfully', 'Temperory Product'));
                    redirect(admin_url('product_new/temperory_product_view'));
                }
            } else {

                $ad_data = array(
                    'staff_id' => get_staff_user_id(),
                    'category_id' => $product_cat_id,
                    'product_name' => $product_name,
                    'product_desc' => $description,
                    'unit' => $unit,
                    'price' => $product_price,
                    'sac' => $sac,
                    'hsn' => $hsn,
                    'status'=> 0,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $update = $this->home_model->update('tbltemperoryproduct', $ad_data, array("id" => $id));
                if ($update){
                    if(!empty($_FILES['product_image']['name']))
                    {
                        $oldfiledata = $this->db->query("SELECT `file_name` FROM `tbltemperoryproduct` WHERE id = '".$id."' ")->row();
                        $path = get_upload_path_by_type('temperory_product') . $id . '/'.$oldfiledata->file_name;
                        unlink($path);
                        temperory_product_image_upload($id);
                    }

                    if (!empty($staff_id)) {

                        $this->home_model->delete("tbltemperoryproduct_approval", array("pro_id" => $id));
                        $this->home_model->delete("tblmasterapproval", array("module_id" => 13, "table_id" => $id));
                        foreach ($staff_id as $staffid) {

                            $approval_data = array(
                                'staff_id' => $staffid,
                                'pro_id' => $id,
                                'approve_status' => '0',
                                'created_at' => date("Y-m-d H:i:s")
                            );
                            $this->db->insert('tbltemperoryproduct_approval', $approval_data);

                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid' => get_staff_user_id(),
                                'module_id' => 13,
                                'description' => 'Temperory Product Send to you for Approval',
                                'table_id' => $id,
                                'approve_status' => 0,
                                'status' => 0,
                                'link' => 'product_new/temperory_product_approval/' . $id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $message = 'Temperory Product('.$product_name.') Send to you for Approval';
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }
                    set_alert('success', _l('updated_successfully', 'Temperory Product'));
                }
                redirect(admin_url('product_new/temperory_product_view'));
            }
        }

        if ($id == '') {
            $title = 'Add Quotation Product';
        } else {
            $data['product_data'] = $this->db->query("SELECT * FROM `tbltemperoryproduct` Where id = '".$id."' ")->row_array();
            $data['staffassigndata'] = explode(',', $data['product_data']['assignid']);
            $title = 'Edit Quotation Product';
        }

        $data['pro_cat_data'] = $this->db->query("SELECT * FROM `tblproductcategory` where `status`='1' order by name asc")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();

        $data['title'] = $title;
        $this->load->view('admin/product_new/temperory_product', $data);
    }

    public function get_approval_info() {


        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tbltemperoryproduct_approval  where pro_id = '".$po_id."'  ")->result();
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

    public function temperory_product_approval($id)
    {
       if(!empty($_POST)){
            extract($this->input->post());


             $ad_data = array(
                        'approve_status' => $submit,
                        'remark' => $remark,
                        'updated_at' => date('Y-m-d H:i:s')
                    );

            $update = $this->home_model->update('tbltemperoryproduct_approval', $ad_data,array('pro_id'=>$id,'staff_id'=>get_staff_user_id()));

            //Update master approval
             update_masterapproval_single(get_staff_user_id(),13,$id,$submit);

             $approve_status = $submit;
             $reject_info = $this->db->query("SELECT * FROM `tbltemperoryproduct_approval` where pro_id='".$id."' and approve_status = 2 ")->row_array();
             if(!empty($reject_info)){
                $approve_status = 2;
                $this->home_model->update('tbltemperoryproduct', array('status'=>$submit),array('id'=>$id));
             }else{

                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tbltemperoryproduct_approval` where pro_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 2){
                    $approve_status = 1;
                    $this->home_model->update('tbltemperoryproduct', array('status'=>$submit,'updated_at'=>date('Y-m-d')),array('id'=>$id));
                }
            }

            $approval_info = $this->db->query("SELECT * FROM `tbltemperoryproduct_approval` where pro_id='".$id."' and ( approve_status = 0 || approve_status = 2 || approve_status = 4 || approve_status = 5) ")->row_array();
            if(empty($approval_info)){
                $approve_status = 1;
                $this->home_model->update('tbltemperoryproduct', array('status'=>$submit,'updated_at'=>date('Y-m-d')),array('id'=>$id));
            }


            //Update master approval
            update_masterapproval_all(13,$id,$approve_status);

            if($update){
                 set_alert('success', 'Temperory updated succesfully');
                 redirect(admin_url('product_new/temperory_product_view'));
            }
        }


        $data['info']  = $this->db->query("SELECT * from tbltemperoryproduct where id = '".$id."' ")->row();

        $data['appvoal_info'] = $this->db->query("SELECT * from tbltemperoryproduct_approval where pro_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();

        $data['title'] = 'Temperory Product Approval';
        $this->load->view('admin/product_new/temperory_product_approval', $data);

    }

    public function delete_temperory_product($id) {

        $response = $this->home_model->delete('tbltemperoryproduct', array('id'=>$id));
        if ($response == true) {
            $this->home_model->delete('tbltemperoryproduct_approval', array('pro_id'=>$id));
            $this->db->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>13));
            set_alert('success', 'Temperory Product Deleted Successfully');
            redirect(admin_url('product_new/temperory_product_view'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('product_new/temperory_product_view'));
        }

    }


    public function delete_product_log($id) {

        $response = $this->home_model->delete('tblproducts_log', array('id'=>$id));
        if ($response == true) {
            $this->home_model->delete('tblproductsfield_log', array('product_id'=>$id));
            $this->home_model->delete('tblproductitems_log', array('product_id'=>$id));
            $this->home_model->delete('tblproductdrawing_log', array('product_id'=>$id));

            set_alert('success', 'Product Log Deleted Successfully');
            redirect(admin_url('product_new/send_product_approval'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('product_new/send_product_approval'));
        }

    }

    /* this function use for unverified product list */
    public function unverified_products(){

        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where is_approved = '1' and is_varified = '0' and status = 1")->result_array();
        $this->load->view('admin/product_new/unverified_products_list', $data);
    }

//    public function view($id = '') {
//
//        $data['title'] = "View Product Details";
//        $data['edit_product_id'] = $id;
////        $this->load->view('admin/product_new/view_product', $data);
//    }

    public function get_productmaterial_field(){
        $product_fields = array();
        $width = $diameter = $width_thickness = $html ="";
        if(!empty($_POST)){
            $id = $this->input->post("id");
//            $p_id = $this->input->post("p_id");
//            if (!empty($p_id)){
//                $product_info = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='".$p_id."' ")->row();
//                if (!empty($product_info)){
//                    $width = ($product_info->width > 0) ? $product_info->width : "";
//                    $diameter = ($product_info->diameter > 0) ? $product_info->diameter : "";
//                    $width_thickness = ($product_info->width_thickness > 0) ? $product_info->width_thickness :"";
//                }
//            }

            $promaterial = $this->db->query("SELECT `product_fields` FROM `tblproductmaterial` WHERE `id`='".$id."' ")->row();
            if (!empty($promaterial)){
                $product_fields = explode(",", $promaterial->product_fields);
                foreach ($product_fields as $value) {
                    if($value == 1){
                        $html .= '<div class="form-group col-md-2">
                                    <label for="productmaterial" class="control-label">Width (In MM) *</label>
                                    <input type="text" id="width" name="width" required="" class="form-control" >
                                </div>';
                    }
                    if($value == 2){
                        $html .= '<div class="form-group col-md-2">
                                    <label for="productmaterial" class="control-label">Diameter (In MM) *</label>
                                    <input type="text" id="diameter" name="diameter" required="" class="form-control" >
                                </div>';
                    }
                    if($value == 3){
                        $html .= '<div class="form-group col-md-2">
                                    <label for="productmaterial" class="control-label">Edge Width Small (In MM) *</label>
                                    <input type="text" id="edge_width_small" name="edge_width_small" required="" class="form-control" >
                                </div>';
                    }
                    if($value == 4){
                        $html .= '<div class="form-group col-md-2">
                                    <label for="productmaterial" class="control-label">Edge Width (In MM) *</label>
                                    <input type="text" id="edge_width" name="edge_width" required="" class="form-control" >
                                </div>';
                    }
                    if($value == 5){
                        $html .= '<div class="form-group col-md-2">
                                    <label for="productmaterial" class="control-label">Edge Length (In MM) *</label>
                                    <input type="text" id="edge_length" name="edge_length" required="" class="form-control" >
                                </div>';
                    }
                }
            }
        }
        echo $html;
    }

    /* this function use for Standerd Product rate list*/
    public function standard_product_ratelist(){
        $data["title"] = "Standard Product Rate List";

        if(!empty($_POST)){

            extract($this->input->post());
            $data = $this->input->post();
            foreach ($data["rate"] as $prod_id => $value) {
                $updatedata["price"] = $value["price"];
                $this->home_model->update("tblproducts", $updatedata, array("id" => $prod_id));
            }
            set_alert('success', "Standard Product Rate update Successfully");
            redirect(admin_url('product_new/standard_product_ratelist'));
        }
        $data["standard_rate_list"] = $this->db->query("SELECT p.* FROM `tblproducts` as p LEFT JOIN `tblproductmaterial` as pm ON p.productmaterial_id = pm.id WHERE pm.is_standard = 1 ORDER BY id ASC")->result();
        $this->load->view('admin/product_new/standard_product_ratelist', $data);
    }

    public function product_calculator() {

        $data['title'] = "Product Calculator";

        if (!empty($_POST)){
            extract($this->input->post());

            $cost_info = $this->db->query("SELECT * FROM `tblproductcalculatorcost` where id = '1' ")->row();

            $product_cat_id = (!empty($product_cat_id)) ? $product_cat_id : 0;
            $product_id = (!empty($product_id)) ? $product_id : 0;
            $product_grade_id = (!empty($product_grade_id)) ? $product_grade_id : 0;
            $pipe_type = (!empty($pipe_type)) ? $pipe_type : 0;

            $thickness = 0;
            $grad_info = $this->db->query("SELECT * FROM `tblmaterialgrade` where id = '".$product_grade_id."' ")->row();

            if(!empty($grad_info)){
                $thickness = $grad_info->thickness;
            }


            $total_weight = 0;
            $total_rm_cost = 0;
            $pro_id = $product_id;

            $productcomponent = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$pro_id."' ")->result();
            if(empty($productcomponent)){
                // If the product has no componants
                $product_data = $this->Product_model->get_product_weight_and_price($product_id,$thickness,$pipe_type,0);
                $total_weight += ($product_data['weight']*1);
                $total_rm_cost += ($product_data['price']*1);
            }else{
                for ($i=0; $i < 6; $i++) {
                    $productcomponent = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$pro_id."' ")->result();

                        if (!empty($productcomponent)){
                            foreach ($productcomponent as $row) {
                                $product_data = $this->Product_model->get_product_weight_and_price($row->item_id,$thickness,$pipe_type,$row->size);
                                $total_weight += ($product_data['weight']*$row->qty);
                                $total_rm_cost += ($product_data['price']*$row->qty);

                                $pro_id =  $row->item_id ;
                            }
                        }
                }
            }




            $final_weight = ($total_weight*$qty);
            $final_cost = ($total_rm_cost*$qty);

            $process_cost = ($final_weight*$cost_info->process_cost);
            $transport_cost = ($cost_info->transport_cost / 100) * $final_cost;
            $loading_charges = ($final_weight*$cost_info->loading_charges);

            $ttl_chargers = ($final_cost+$process_cost+$transport_cost+$loading_charges);

            $over_head_profit = ($cost_info->over_head_profit / 100) * $ttl_chargers;
            $final_price = ($final_cost+$process_cost+$transport_cost+$loading_charges+$over_head_profit);

            $rate_per_kg = 0;
            if(!empty($final_weight)){
                $rate_per_kg = ($final_price/$final_weight);
            }




            $insertData["staff_id"] = get_staff_user_id();
            $insertData["product_category_id"] = $product_cat_id;
            $insertData["product_id"] = $product_id;
            $insertData["product_grade_id"] = $product_grade_id;
            $insertData["pipe_type"] = $pipe_type;
            $insertData["qty"] = $qty;
            $insertData["weight"] = $final_weight;
            $insertData["raw_material_cost"] = $final_cost;
            $insertData["process_cost"] = $process_cost;
            $insertData["transport_cost"] = $transport_cost;
            $insertData["loading_charges"] = $loading_charges;
            $insertData["over_head_profit"] = $over_head_profit;
            $insertData["final_price"] = $final_price;
            $insertData["rate_per_kg"] = $rate_per_kg;
            $insertData["create_at"] = date("Y-m-d H:s:i");
            $insert_id = $this->home_model->insert("tblproductcostcalculate", $insertData);

            if (!empty($insert_id)){
                set_alert('success', "Product information added successfully");
                redirect(admin_url('product_new/product_calculator'));
            }
        }
        $data['pro_cat_data'] = $this->db->query("SELECT * FROM `tblproductcategory` WHERE `status`='1' ORDER BY name ASC ")->result_array();
        $data['product_grade_list'] = $this->db->query("SELECT * FROM `tblmaterialgrade` WHERE `status`='1' ORDER BY title ASC ")->result_array();
        $data['product_details'] = $this->db->query("SELECT * FROM `tblproductcostcalculate` WHERE `staff_id`= '".get_staff_user_id()."' ORDER BY id DESC ")->result();

        $data['ttl_final_price'] = $this->db->query("SELECT COALESCE(SUM(final_price),0) as amt from `tblproductcostcalculate` WHERE `staff_id`= '".get_staff_user_id()."' ")->row()->amt;

        $this->load->view('admin/product_new/product_calculator', $data);
    }

    public function get_products(){
        if(!empty($_POST)){
            extract($this->input->post());
            $where = "`status`= 1 AND `product_cat_id`='".$category_id."'";
            if(isset($sub_category_id)){
                $where .= " AND `product_sub_cat_id`='".$sub_category_id."'";
            }
            if(isset($parent_category_id)){
                $where .= "AND `parent_category_id`='".$parent_category_id."'";
            }
            $product_info = $this->db->query("SELECT * FROM `tblproducts` WHERE ".$where." ORDER BY `name` ASC")->result();
            echo json_encode($product_info);
            exit;
        }
    }
    public function get_sub_division($division_id){
      echo '<option value=""></option>';
      $subdivision_list = $this->db->query("SELECT `id`,`title` FROM `tblsubdivisionmaster` WHERE `division_id` = '".$division_id."' ")->result();
      if (!empty($subdivision_list)){
          foreach ($subdivision_list as $value) {
             echo '<option value="'.$value->id.'">'.cc($value->title).'</option>';
          }
      }
    }


    public function remove_all_calculator_products(){
        $response = $this->home_model->delete('tblproductcostcalculate', array('staff_id'=>get_staff_user_id()));
        if ($response == true) {
            set_alert('success', 'Product costing details delete successfully');
            redirect(admin_url('product_new/product_calculator'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('product_new/product_calculator'));
        }
    }

    public function delete_pro_casting($id){
        $response = $this->home_model->delete('tblproductcostcalculate', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Product costing details delete successfully');
            redirect(admin_url('product_new/product_calculator'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('product_new/product_calculator'));
        }
    }


    public function get_product_details($pro_id){
        $total_weight = 0;
        $total_rm_cost = 0;

        for ($i=0; $i < 6; $i++) {
            $productcomponent = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$pro_id."' ")->result();

                if (!empty($productcomponent)){
                    foreach ($productcomponent as $row) {
                        //$ttl_qty += $row->qty;
                        //echo $row->item_id.'-'.$row->qty.'<br>';
                        $product_data = $this->Product_model->get_product_weight_and_price(11,1,1);
                        $total_weight += ($product_data['weight']*$row->qty);
                        $total_rm_cost += ($product_data['price']*$row->qty);

                    }
                }
            $pro_id =  $row->item_id ;
        }
        echo $total_rm_cost;
    }


    /* this function use for master of product costing */
    public function calculate_cost(){
        $data["title"] = "Product Calculator Cost";

        if(!empty($_POST)){
            extract($this->input->post());

            $updata["process_cost"] = $process_cost;
            $updata["transport_cost"] = $transport_cost;
            $updata["loading_charges"] = $loading_charges;
            $updata["over_head_profit"] = $over_head_profit;
            $update = $this->home_model->update("tblproductcalculatorcost", $updata, array("id" => $rid));
            if ($update){
                set_alert('success', 'Cast update successfully');
            }else{
                set_alert('warning', 'Somthing went wrong');
            }
            redirect(admin_url('product_new/calculate_cost'));
        }

        $data["cost_info"] = $this->db->query("SELECT * FROM `tblproductcalculatorcost` ORDER BY `id` DESC LIMIT 1")->row();
        $this->load->view('admin/product_new/calculate_cost', $data);
    }

    /* this function use product log edit */
    public function edit_product_log($id){
        $data['title'] = "Edit Product";

        if ($this->input->post()) {
            $product_data = $this->input->post();

            $success = $this->Product_model->edit_log($product_data,$id);
            if ($success) {

                if (isset($_FILES['drawing']['name'][0]) && $_FILES['drawing']['name'][0] != ""){
                    $check = $this->db->query("SELECT * FROM `tblproductfiles_log` where rel_id = '".$id."' and rel_type = 'drawing' ");
                    if($check)
                    {
                      $this->db->delete('tblproductfiles_log',array('rel_id'=>$id,'rel_type'=>'drawing'));
                    }

                    handle_product_drawing_upload($id);
                }
                if (isset($_FILES['photo_multiple']['name'][0]) && $_FILES['photo_multiple']['name'][0] != ""){
                    $check1 = $this->db->query("SELECT * FROM `tblproductfiles_log` where rel_id = '".$id."' and rel_type = 'mutliple_image' ");
                    if($check1)
                    {
                      $this->db->delete('tblproductfiles_log',array('rel_id'=>$id,'rel_type' => 'mutliple_image'));
                    }

                    handle_product_multiple_image_upload($id);
                }
                set_alert('success', 'Product Update, Pending for Approval!');
            }
            handle_product_image_upload_new($id);
            redirect(admin_url('product_new/send_product_approval'));
        }

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();

        $this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->get();

        $this->load->model('Product_sub_category_model');
        $data['pro_sub_cat_data'] = $this->Product_sub_category_model->get();

        $this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();

        $this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' ")->result_array();
        $data['product_master'] = $this->db->query("SELECT `id`,`name` FROM `tblproductnewmaster` where `status`='1' ")->result_array();
        $data['products_log'] = $this->db->query("SELECT * FROM `tblproducts_log` where `id`= '".$id."' ")->row();
        $data['productsfield_log'] = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`= '".$id."' ")->result_array();
        $data['productsitems_log'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `product_id`= '".$id."' ")->result();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' ")->result_array();

        $data['multiple_images'] = $this->db->query("SELECT * FROM `tblproductfiles_log` where `rel_id`= '".$id."' and `rel_type` = 'mutliple_image' ")->result();
        $data['product_drawing'] = $this->db->query("SELECT * FROM `tblproductfiles_log` where `rel_id`= '".$id."' and `rel_type` = 'drawing' ")->result();
        $data['productmaterial_list'] = $this->db->query("SELECT * FROM `tblproductmaterial` WHERE `status` = '1' ")->result();

        $data['product'] = $this->db->query("SELECT * FROM `tblproducts_log` where id = '".$id."' ")->row_array();

        $data['parent_category_info'] = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$data['product']['product_sub_cat_id']."' ")->result_array();
        $data['child_category_info'] = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$data['product']['parent_category_id']."' ")->result_array();

        $data['productcomponent'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();

        $final_category = 1;
        $final_category_id = $data['product']['product_cat_id'];
        if(!empty($data['product']['product_sub_cat_id'])){
            $final_category_id = $data['product']['product_sub_cat_id'];
            $final_category = 2;
        }if(!empty($data['product']['parent_category_id'])){
            $final_category_id = $data['product']['parent_category_id'];
            $final_category = 3;
        }if(!empty($data['product']['child_category_id'])){
            $final_category_id = $data['product']['child_category_id'];
            $final_category = 4;
        }

        $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
        if(!empty($custom_category_info)){
            $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
        }
        $this->load->view('admin/product_new/edit_product_log', $data);
    }

    public function check_product_standard($product_id){
        $is_standard = 0;
        $product_material_id = value_by_id_empty("tblproducts", $product_id, "productmaterial_id");
        if (!empty($product_material_id)){
            $is_standard = value_by_id_empty("tblproductmaterial", $product_material_id, "is_standard");
            $is_standard = (!empty($is_standard)) ? $is_standard : 0;
        }
        echo $is_standard;
    }

    public function print_pro_casting(){

        $data['title'] = "Product Calculator";

        $data['product_details'] = $this->db->query("SELECT * FROM `tblproductcostcalculate` WHERE `staff_id`= '".get_staff_user_id()."' ORDER BY id DESC ")->result();

        $data['ttl_final_price'] = $this->db->query("SELECT COALESCE(SUM(final_price),0) as amt from `tblproductcostcalculate` WHERE `staff_id`= '".get_staff_user_id()."' ")->row()->amt;

        $this->load->view('admin/product_new/print_product_calculator', $data);
    }

    public function convert_to_product($product_id){

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();

		$this->load->model('Product_category_model');
        //$data['pro_cat_data'] = $this->Product_category_model->get();
        $data['pro_cat_data'] = $this->db->query("SELECT * FROM `tblproductcategory` where `status`='1' ")->result_array();

		$this->load->model('Product_sub_category_model');
        $data['pro_sub_cat_data'] = $this->Product_sub_category_model->get();

		$this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();

		$this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' ")->result_array();
        $data['product_master'] = $this->db->query("SELECT `id`,`name` FROM `tblproductnewmaster` where `status`='1' ")->result_array();
        $data['productmaterial_list'] = $this->db->query("SELECT `id`,`name` FROM `tblproductmaterial` where `status`='1' ")->result();
        $data['division_list'] = $this->db->query("SELECT `id`,`title` FROM `tbldivisionmaster` where `status`='1' ")->result_array();
        $data['sub_division_list'] = $this->db->query("SELECT `id`,`title` FROM `tblsubdivisionmaster` where `status`='1' ")->result_array();


        $data['tempproduct_info'] = $this->db->query("SELECT * FROM `tbltemperoryproduct` where id = '".$product_id."' ")->row_array();
        $data['title'] = "Convert To Product";
        $data['edit_product_id'] = "";
        $this->load->view('admin/product_new/product', $data);
    }

    public function get_converted_product_info(){
        if ($this->input->post()) {
            extract($this->input->post());


            $chk_converted = $this->db->query("SELECT `id`,`name` FROM `tblproducts` WHERE temperoryproduct_id ='" . $p_id . "' ")->row();
            if (!empty($chk_converted)) {
                $pro_url = admin_url("product_new/view/".$chk_converted->id);
                echo "<div class='row'><div class='col-md-12 text-center'>
                        <h4>This Product Completely Converted In Product </h4>
                        <h3>Product Name : ".cc($chk_converted->name)."</h3>&nbsp;<a target='_blank' class='btn btn-info' href='".$pro_url."'>View</a>
                    </div></div>";

            }else{
                $chkconverted2 = $this->db->query("SELECT `id`,`name` FROM `tblproducts_log` WHERE temperoryproduct_id ='" . $p_id . "' ")->row();
                if (!empty($chkconverted2)) {
                    $pro_url = admin_url("product_new/products_log_view/".$chkconverted2->id);
                    echo "<div class='row'><div class='col-md-12 text-center'>
                        <h4>This product converted in product log waiting for approval </h4>
                        <h3>Product Name : ".cc($chkconverted2->name)."</h3>&nbsp;<a target='_blank' class='btn btn-info' href='". $pro_url ."'>View</a>
                    </div></div>";
                }
            }
        }
    }

    /* this function use for product drawing list */
    public function product_drawing_list(){
        $data["title"] = "Product Drawing List";

        $data["productdrawing_list"] = $this->db->query("SELECT id,product_id FROM `tblproductdrawing` GROUP BY product_id ORDER BY id DESC")->result();
        $this->load->view('admin/product_new/product_drawing_list', $data);
    }

    public function get_productdrawing_history() {


        if(!empty($_POST)){
            extract($this->input->post());

            $product_info = $this->db->query("SELECT * from tblproductdrawing  where id != '".$id."' AND product_id = '".$product_id."' ORDER BY id DESC")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Product Drawings </h4>
                </div>
                 <hr/>
                <div class="col-md-12">
                <div style="overflow-x:auto !important;">
                    <div class="form-group" >
                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th  align="left">Name of Drawing</th>
                                    <th  align="left">Drawing ID</th>
                                    <th  align="left">Rev No</th>
                                    <th  align="left">Drawing</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($product_info)){
                                $i = 1;
                                foreach ($product_info as $value) {
                                    ?>
                                    <tr>
                                      <td><?php echo $i++;?></td>
                                      <td><?php echo (!empty($value->drawing_name)) ? cc($value->drawing_name) : "--"; ?></td>
                                      <td><?php echo (!empty($value->drawing_id)) ? $value->drawing_id : "--"; ?></td>
                                      <td><?php echo (!empty($value->rev_no)) ? $value->rev_no : "--"; ?></td>
                                      <td>
                                        <?php if (!empty($value->files)){
                                            $filesdata = json_decode($value->files);
                                            foreach ($filesdata as $k => $file) {
                                        ?>
                                              <a href="<?php echo base_url('uploads/product/product_drawing') . "/" . $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                        <?php
                                            }
                                        } ?>
                                      </td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found!</h5></td></tr>';
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

    public function getproductlogdetails($id) {

        $data['productinfo'] = $this->db->query("SELECT * FROM `tblproducts_log` where `id`= '".$id."' ")->row_array();
        $data['productsfield_log'] = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`= '".$id."' ")->result_array();
        $data['productcomponent'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `product_id`= '".$id."' ")->result_array();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' and is_approved = '1' ")->result_array();

        $data['mutlimages_info'] = $this->db->query("SELECT * FROM `tblproductfiles_log` where `rel_id`= '".$id."' and `rel_type` = 'mutliple_image' ")->result();
        $data['file_info'] = $this->db->query("SELECT * FROM `tblproductfiles_log` where `rel_id`= '".$id."' and `rel_type` = 'drawing' ")->result();
        $data['productmaterial_list'] = $this->db->query("SELECT * FROM `tblproductmaterial` WHERE `status` = '1' ")->result();
        $data['productdrawing_list'] = $this->db->query("SELECT * FROM `tblproductdrawing_log` WHERE `product_id`= '".$id."' ORDER BY id DESC ")->result();

        $data['product'] = $this->db->query("SELECT * FROM `tblproducts_log` where id = '".$id."' ")->row_array();

            $final_category = 1;
            $final_category_id = $data['product']['product_cat_id'];
            if(!empty($data['product']['product_sub_cat_id'])){
                $final_category_id = $data['product']['product_sub_cat_id'];
                $final_category = 2;
            }if(!empty($data['product']['parent_category_id'])){
                $final_category_id = $data['product']['parent_category_id'];
                $final_category = 3;
            }if(!empty($data['product']['child_category_id'])){
                $final_category_id = $data['product']['child_category_id'];
                $final_category = 4;
            }

            $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
            if(!empty($custom_category_info)){
                $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' and fd.type != '3' order by f.field_order asc ")->result();
            }

        $title = 'View Custom Products';
        $data["protype"] = 1;    
        $data["section"] = "productlog";    
        $data['title'] = $title;
        $this->load->view('admin/proposals/getproductdetails', $data);
    }

    /* this is function use product inspection */
    public function product_inspection($product_id){

        if ($this->input->post()) {
            $product_data = $this->input->post();
            extract($this->input->post());

            // echo "<pre>";
            // print_r($product_data);
            // exit;
            if ($inspection_required == '1'){

                if (!empty($inspectiondata)){

                    /* this is parameter delete */
                    $this->home_model->delete('tblproductinspection_master', array('product_id' => $product_id));
                    $insettype = 0;
                    foreach($inspectiondata as $val){
                        $insertdata['added_by'] = get_staff_user_id();
                        $insertdata['product_id'] = $product_id;
                        $insertdata['template_id'] = $template_id;
                        $insertdata['parameter'] = $val['parameter'];
                        $insertdata['specification'] = $val['specification'];
                        $insertdata['tolerance_less'] = $val['tolerance_less'];
                        $insertdata['tolerance_add'] = $val['tolerance_add'];
                        $insertdata['tolerance_min'] = $val['tolerance_min'];
                        $insertdata['tolerance_max'] = $val['tolerance_max'];
                        $insertdata['measuring_instrument'] = $val['measuring_instrument'];
                        $insertdata['status'] = '1';

                        $this->home_model->insert('tblproductinspection_master',$insertdata);
                        $insettype = 1;
                    }
                    if ($insettype == '1'){
                        $this->home_model->update('tblproducts', array("inspection_required" => 1), array('id' => $product_id));
                    }
                }
                
                set_alert('success', 'Product inspection parameter added successfully');
                redirect(admin_url('product_new/product_inspection/'.$product_id));
            }else{
                $this->home_model->delete('tblproductinspection_master', array('product_id' => $product_id));
                $this->home_model->update('tblproducts', array("inspection_required" => 0), array('id' => $product_id));
                set_alert('success', 'Product inspection parameter remove successfully');
                redirect(admin_url('product_new/product_inspection/'.$product_id));
            }
        }    

        $data['title'] = "Product Inspection Details";
        $data['product_id'] = $product_id;
        $data['inspection_data'] = $this->db->query("SELECT * FROM tblproductinspection_master WHERE `product_id`='".$product_id."' ORDER BY id ASC")->result();
        $data['inspection_template_list'] = $this->db->query("SELECT * FROM tblproductinspection_templates ORDER BY id ASC")->result();
        $this->load->view("admin/product_new/product_inspection", $data);
    }

    public function index(){
        $data["title"] = "Product List";
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();

        $data['verify_count'] = $this->db->query("SELECT count(id) as verified FROM `tblproducts` WHERE `status` = '1' AND is_approved = '1' AND is_varified = '1' ")->row()->verified;
        $data['unverify_count'] = $this->db->query("SELECT count(id) as unverified FROM `tblproducts` WHERE `status` = '1' AND is_approved = '1' AND is_varified = '0' ")->row()->unverified;
        $this->load->view("admin/product_new/product_data_list", $data);
    }

    public function product_ajax_list()
    {
        $this->load->model('Products_list_model');
        $list = $this->Products_list_model->get_products();
       
        //output to json format
        echo json_encode($list);
    }

    public function get_product_count(){

        $this->load->model('Products_list_model');
        $verified_products = $this->Products_list_model->verified_count();
        $unverified_products = $this->Products_list_model->unverified_count();

        echo json_encode(array("verified" => $verified_products, "unverified" => $unverified_products));
    }

    /* This function use for product inspection template */
    public function inspection_template(){
        $data["title"] = "Inspection Templates";
        $data["template_list"] = $this->db->query("SELECT * FROM `tblproductinspection_templates` ORDER BY id DESC")->result();
        $this->load->view("admin/product_new/inspection_template_list",$data);
    }

    /* this function use for add inspection templates */
    public function add_inspection_template($id = ''){

        if ($this->input->post()) {
            extract($this->input->post());

            $ad_data = array(
                'template_name'=> $template_name,
                'data'=> json_encode($template_data),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            if ($id != ''){
                unset($ad_data['created_at']);
                $response = $this->home_model->update('tblproductinspection_templates', $ad_data, array('id' => $id));
                if ($response){
                    set_alert('success', 'Product inspection Template updated successfully');
                }else{
                    set_alert('warning', 'somthing went wrong');
                }
                
            }else{
                $response = $this->home_model->insert('tblproductinspection_templates', $ad_data);
                if ($response){
                    set_alert('success', 'Product inspection Template added successfully');
                }else{
                    set_alert('warning', 'somthing went wrong');
                }
            }
            redirect(admin_url('product_new/inspection_template'));
        }    
        $data["title"] = "Add Inspection Templates";
        if ($id != ''){
            $data["title"] = "Edit Inspection Templates";
            $data["template_data"] = $this->db->query("SELECT * FROM `tblproductinspection_templates` WHERE id = '".$id."' ")->row();
        }
        $this->load->view("admin/product_new/add_inspection_template", $data);
    }

    /* this function use for delete inspection template */
    function inspection_template_delete($id){
        $chk_data = $this->db->query("SELECT id FROM tblproductinspection_master WHERE template_id = '".$id."'")->row();
        if (!empty($chk_data)){
            set_alert('warning', "Can't be delete, its used anywhare.");
            redirect(admin_url('product_new/inspection_template'));
        }

        $response = $this->home_model->delete("tblproductinspection_templates", array("id" => $id));
        if ($response){
            set_alert('success', "Inspection template delete successfully");
        }
        redirect(admin_url('product_new/inspection_template'));
    }

    /* this function use for get template data */
    function get_template_data($template_id){
        $templatedata = $this->db->query("SELECT * FROM `tblproductinspection_templates` WHERE id = '".$template_id."' ")->row();
        if (!empty($templatedata) && !empty($templatedata->data)){
            $template_list = json_decode($templatedata->data);
            $i = 1;
            foreach ($template_list as $key => $value) {
    ?>
                <tr class="tr<?php echo $i; ?>">
                    <td><button type="button" class="btn pull-right btn-danger " onclick="removeparameters('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button></td>
                    <td><textarea name="inspectiondata[<?php echo $i; ?>][parameter]" id="parameter<?php echo $i; ?>" class="form-control" required><?php echo $value->parameter; ?></textarea></td>
                    <td><input type="text" name="inspectiondata[<?php echo $i; ?>][specification]" onkeyup="parametercalculation('<?php echo $i; ?>');" id="specification<?php echo $i; ?>" class="form-control" value="" required></td>
                    <td><input type="number" min='0' step="any" onkeyup="parametercalculation('<?php echo $i; ?>');" class="form-control inspectionless" name="inspectiondata[<?php echo $i; ?>][tolerance_less]" value="<?php echo $value->tolerance_less; ?>" id="tolerance_less<?php echo $i; ?>" class="form-control" required></td>
                    <td><input type="number" min='0' step="any" onkeyup="parametercalculation('<?php echo $i; ?>');" class="form-control inspectionplus" name="inspectiondata[<?php echo $i; ?>][tolerance_add]" value="<?php echo $value->tolerance_add; ?>" id="tolerance_add<?php echo $i; ?>" class="form-control" required></td>
                    <td><input type="number" min='0' step="any" class="form-control" name="inspectiondata[<?php echo $i; ?>][tolerance_min]" id="tolerance_min<?php echo $i; ?>" class="form-control" value="" readonly></td>
                    <td><input type="number" min='0' step="any" class="form-control" name="inspectiondata[<?php echo $i; ?>][tolerance_max]" id="tolerance_max<?php echo $i; ?>" class="form-control" value="" readonly></td>
                    <td><textarea class="form-control" name="inspectiondata[<?php echo $i; ?>][measuring_instrument]" id="measuring_instrument<?php echo $i; ?>" class="form-control" required><?php echo $value->measuring_instrument; ?></textarea></td>
                </tr>
    <?php 
                $i++;
            }
        }
    }
}
