<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vendorproduct extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Vendorproduct_model');
    }

    /* List all Component Data */

    public function index() {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $data['product_data'] = $this->Vendorproduct_model->get();

        $this->load->view('admin/vendor_product/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('vendorproduct');
    }
	public function getproddet()
	{
		
		$proid=$this->input->post('proid');
		$this->db->where('id', $proid);
	    $productdata= $this->db->get('tblproducts')->row();
		$productdata= (array) $productdata;
		//print_r($staffdata);exit;
		echo json_encode(array('name'=>$productdata['name'],'sub_name'=>$productdata['sub_name'],'sac_code'=>$productdata['sac_code'],'hsn_code'=>$productdata['hsn_code'],'working_height'=>$productdata['working_height'],'tower_height'=>$productdata['tower_height'],'platform_height'=>$productdata['platform_height'],'dimensions'=>$productdata['dimensions'],'gst_id'=>$productdata['gst_id'],'unit_id'=>$productdata['unit_id'],'purchase_price'=>$productdata['purchase_price'],'product_weight'=>$productdata['product_weight'],'status'=>$productdata['status'],'product_description'=>$productdata['product_description'],'product_remarks'=>$productdata['product_remarks'],'sale_price_cat_a'=>$productdata['sale_price_cat_a'],'sale_price_cat_b'=>$productdata['sale_price_cat_b'],'sale_price_cat_c'=>$productdata['sale_price_cat_c'],'sale_price_cat_d'=>$productdata['sale_price_cat_d'],'rental_price_cat_a'=>$productdata['rental_price_cat_a'],'rental_price_cat_b'=>$productdata['rental_price_cat_b'],'rental_price_cat_c'=>$productdata['rental_price_cat_c'],'rental_price_cat_d'=>$productdata['rental_price_cat_d'],'damage_rate'=>$productdata['damage_rate'],'lost_rate'=>$productdata['lost_rate'],'repairable_rate'=>$productdata['repairable_rate']));
	}
    public function product($id = '') {
        if ($this->input->post()) {
            $product_data = $this->input->post();
			
            if ($id == '') {

                $id = $this->Vendorproduct_model->add($product_data);
                if ($id) {
                    handle_product_image_upload($id);
                    set_alert('success', _l('added_successfully', _l('vendor_product')));
                    redirect(admin_url('vendorproduct'));
                }
            } else {
                handle_product_image_upload($id);
                $success = $this->Vendorproduct_model->edit($product_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('vendor_product')));
                }

                redirect(admin_url('vendorproduct'));
            }
        }

        $this->load->model('Unit_model');
        $data['unit_data'] = $this->Unit_model->get();
  
		
		$this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->getallcatbymultiselect();
		
		$this->load->model('Product_model');
        $data['pro_data'] = $this->Product_model->get();

		$this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();
		
		$this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();
		
		
		$this->load->model('Vendor_model');
        $data['vendor_data'] = $this->Vendor_model->get();
        
        if ($id == '') {
            $title = _l('add_new', _l('product_lowercase'));
        } else {
            $data['product'] = (array) $this->Vendorproduct_model->get($id);
            $data['productcomponent'] = (array) $this->Vendorproduct_model->getcomponentdata($id);
			
            $title = _l('edit', _l('product_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/vendor_product/product', $data);
    }

    public function delete($id) {

        $success = $this->Vendorproduct_model->delete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('vendor_product')));
            if (strpos($_SERVER['HTTP_REFERER'], 'vendorproduct/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('vendorproduct'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('vendor_product_lowercase')));
            redirect(admin_url('vendorproduct/product/' . $id));
        }
    }
    
    /* Change Component status / active / inactive */

    public function change_product_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $product_data = array(
                'status' => $status
            );
            
            $this->Vendorproduct_model->edit($product_data, $id);
        }
    }
	
	
	 public function imagedelete() {

		$id=$this->input->post('proid');
        $success = $this->Vendorproduct_model->imagedelete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('product')));
            if (strpos($_SERVER['HTTP_REFERER'], 'vendor_product/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('vendor_product/vendor_product/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('component_lowercase')));
            redirect(admin_url('vendor_product/vendor_product/' . $id));
        }
    }

}
