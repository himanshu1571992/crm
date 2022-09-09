<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Raw_material extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('material_model');
        $this->load->model('home_model');
    }

	
	public function index()
    { 
        $data['title'] = 'Raw Material';
        $this->load->view('admin/raw_material/manage', $data);

    }
	
	
	public function add_material($id = '') {
        if ($this->input->post()) {
			$material_data = $this->input->post();
			
            if ($id == '') {

                $id = $this->material_model->add_material($material_data);
				
                if ($id) {
					
                    set_alert('success', _l('added_successfully', 'Raw Material'));
                    redirect(admin_url('raw_material'));
                }
            } else {

                $success = $this->material_model->update_material($material_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Raw Material'));
                }

				
                redirect(admin_url('raw_material'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'raw material');
        } else {
            $data['material'] = (array) $this->material_model->get_rawmaterial($id);
            $title = _l('edit', 'raw material');
        }

        $data['title'] = $title;
        $this->load->view('admin/raw_material/raw_material', $data);
    }
	

	
	public function material_table() {
        $this->app->get_table_data('raw_material');
    }
	
	public function delete_material($id)
    {
       
        if (!$id) {
            redirect(admin_url('raw_material'));
        }
        $response = $this->material_model->delete_material($id);
        if ($response == true) {
            set_alert('success', _l('deleted', 'raw material'));
        } else {
            set_alert('warning', _l('problem_deleting', 'raw material'));
        }
        redirect(admin_url('raw_material'));
    }
	
	
	 public function change_material_status($id, $status) {
        if ($this->input->is_ajax_request()) {            
            $unit_data = array(
                'status' => $status
            );
            
            $this->material_model->edit_material($unit_data, $id);
        }
    }
	
	
	
	
	
	
	
	public function view()
    { 
	   $data['title'] = 'Product/Component Raw Material';
        $this->load->view('admin/raw_material/view', $data);
    }
	
	
	public function add($id = '') {
        if ($this->input->post()) {
			$material_data = $this->input->post();
			
			
            if ($id == '') {
				
               $id = $this->material_model->add($material_data);
			  
                if ($id) {
					
                    set_alert('success', _l('added_successfully', 'Raw Material'));
                    redirect(admin_url('raw_material/view'));
                }
            } else {

               $success = $this->material_model->edit($material_data, $id);
				
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Raw Material'));
                }

                redirect(admin_url('raw_material/view'));
            }
        }

        if ($id == '') {
            $title = 'Add Product/Component Raw Material';
			
        } else {
            $data['product'] = (array) $this->material_model->get_productcomponent($id);

            $data['productcomponent'] = (array) $this->material_model->getmaterialdata($id);
            $title = 'Edit Product/Component Raw Material';
        }

		$this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->get();
		
		
		
		if(!empty($data['product'])){			
			$data['component_data'] = get_component($data['product']['component']);			
		}else{
			$data['component_data'] = get_component();			
		}
		
        $data['material_data'] = $this->material_model->get();
		
		
        $data['title'] = $title;
        $this->load->view('admin/raw_material/add', $data);
    }
	
	
	public function component_product_table() {
        $this->app->get_table_data('component_product');
    }
	
	public function change_status($id, $status) {
        if ($this->input->is_ajax_request()) {            
            $unit_data = array(
                'status' => $status
            );
            
            $this->material_model->change_status($unit_data, $id);
        }
    }
	
	public function get_material_det($component_id) {
		$this->db->where('id', $component_id);
		$componentdet= $this->db->get('tblrawmaterial')->row_array();
		
		echo json_encode($componentdet);
    }
	
	
	public function get_product_by_cat_id($category_id) {
		
		
        $cityArr = get_product_by_cat_id($category_id);
        
        if(count($cityArr) == 0) {
            echo "";
            exit;
        }
        
        echo json_encode($cityArr);
        exit;
    }

}