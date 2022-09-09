<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_new extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('home_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission(69,'view');

        $data['product_data'] = $this->Product_model->get();

        $this->load->view('admin/product_new/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('product_new');
    }


    public function action_pending() {
        check_permission(69,'view');

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
	
    public function product($id = '') {
        check_permission(69,'create');
        if ($this->input->post()) {
            $product_data = $this->input->post();
            if ($id == '') {

                $id = $this->Product_model->add_log($product_data,0);
                if ($id) {
                    handle_product_image_upload_new($id);
                    set_alert('success', 'Product Added, Pending for Approval!');
                    redirect(admin_url('product_new'));
                }
            } else {
                check_permission(69,'edit');
                $added_id = $this->Product_model->add_log($product_data,$id);
                $this->home_model->update('tblproducts', array('is_update '=>1),array('id'=>$id));
                handle_product_image_upload_new($added_id);
                set_alert('success', 'Product Update, Pending for Approval!');
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('product')));
                }

                redirect(admin_url('product_new'));
            }
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

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ")->result_array();
    

        if ($id == '') {
            $title = _l('add_new', _l('product_lowercase'));
        } else {
            $data['product'] = $this->db->query("SELECT * FROM `tblproducts` where id = '".$id."' ")->row_array();
            //$data['productcomponent'] = (array) $this->Product_model->getcomponentdata($id);
            $data['productcomponent'] = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();
           
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
           
            $title = _l('edit', _l('product_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/product_new/product', $data);
    }

    public function view($id) {
        check_permission(69,'view');
       
        $data['product'] = (array) $this->Product_model->get($id);
        $data['item_info'] = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result();
       
        $title = 'View Product';

        $data['title'] = $title;
        $this->load->view('admin/product/product_view', $data);
    }

    public function products_log_view($id) {
       
        $data['products_log'] = $this->db->query("SELECT * FROM `tblproducts_log` where `id`= '".$id."' ")->result();
        $data['productsfield_log'] = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`= '".$id."' ")->result_array();
        $data['productsitems_log'] = $this->db->query("SELECT * FROM `tblproductitems_log` where `product_id`= '".$id."' ")->result();
       
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ")->result_array();


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
                $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
            }

        $title = 'View Custom Products';

        $data['title'] = $title;
        $this->load->view('admin/product_new/products_log_view', $data);
    }

    public function delete($id) {

        check_permission(69,'delete');

        $can_delete = can_product_delete($id);
        if($can_delete == 0){
            set_alert('warning', 'This Product is in Used, can\'t Delete !');
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }
        $success = $this->Product_model->delete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('product')));
            if (strpos($_SERVER['HTTP_REFERER'], 'product/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('product'));
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
            
            $this->Product_model->edit($product_data, $id);
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
        
        check_permission(69,'view');



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
            $sub_category_info = $this->db->query("SELECT * FROM `tblproductsubcategory` where `status`='1' and category_id = '".$id."' ")->result();
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
            $parent_category_info = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$id."' ")->result();
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
            $product_info = $this->db->query("SELECT * FROM `tblproducts` where ".$where." ")->result();
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
            $child_category_info = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$id."' ")->result();
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
                        }else{
                            $html .= '<div class="form-group col-md-'.$row->size.'" >
                                    <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.'</label>
                                    <textarea id="'.$row->field_id.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control"></textarea>
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

        $data['send_info'] = $this->db->query("SELECT * FROM `tblproductapprovalsend` where ".$where." ")->result();
       
        $data['title'] = 'Approval List';
        $this->load->view('admin/product_new/approval_list', $data);
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
        //check_permission(69,'create');

        $info = $this->db->query("SELECT * from tblproductapprovalsend  where id = '".$id."' and approval_status > 0 ")->row();
        if(!empty($info)){
            set_alert('warning', 'Action already taken!');
             redirect(admin_url('purchase/pending_purchaseorder'));
        }

        if ($this->input->post()) {
            $product_data = $this->input->post();
            $id = $this->Product_model->product_approval($product_data,$id);
            if ($id) {
                set_alert('success', 'Record updated succesfully');
                redirect(admin_url('purchase/pending_purchaseorder'));
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

}
