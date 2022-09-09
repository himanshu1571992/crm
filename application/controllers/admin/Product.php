<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Product_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission(69,'view');

        $data['product_data'] = $this->Product_model->get();

        $this->load->view('admin/product/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('product');
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

                $id = $this->Product_model->add($product_data);
                if ($id) {
                    handle_product_image_upload($id);
                    set_alert('success', _l('added_successfully', _l('product')));
                    redirect(admin_url('product'));
                }
            } else {
                check_permission(69,'edit');
                handle_product_image_upload($id);
                $success = $this->Product_model->edit($product_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('product')));
                }

                redirect(admin_url('product'));
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
            $data['product'] = (array) $this->Product_model->get($id);
            //$data['productcomponent'] = (array) $this->Product_model->getcomponentdata($id);
            $data['productcomponent'] = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result_array();
           
            $data['parent_category_info'] = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$data['product']['product_sub_cat_id']."' ")->result_array();
            $data['child_category_info'] = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$data['product']['parent_category_id']."' ")->result_array();
           
            $title = _l('edit', _l('product_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/product/product', $data);
    }

    public function view($id) {
        check_permission(69,'view');
       
        $data['product'] = (array) $this->Product_model->get($id);
        $data['item_info'] = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and product_id = '".$id."' ")->result();
       
        $title = 'View Product';

        $data['title'] = $title;
        $this->load->view('admin/product/product_view', $data);
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

                        $value = '';
                        if(!empty($p_id)){
                            $field_value = $this->db->query("SELECT * FROM `tblproductsfield` where `product_id`='".$p_id."' and field_id = '".$row->field_id."' ")->row();
                            if(!empty($field_value)){
                                $value = $field_value->field_value;
                            }
                        }


                        if($row->type == 1){                            
                            $html .= '<div class="form-group col-md-'.$row->size.'">
                                    <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.' </label>
                                    <input type="text" id="'.$row->field_id.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control" value="'.$value.'">
                                </div>';
                        }if($row->type == 2){
                            $html .= '<div class="form-group col-md-'.$row->size.'" >
                                    <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.'</label>
                                    <textarea id="'.$row->field_id.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control">'.$value.'</textarea>
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

}
