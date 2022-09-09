<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vendor_model extends CRM_Model {

    private $table_name = "tblvendor";
    private $state_table_name = "tblstates";
    private $city_table_name = "tblcities";
    private $business_type_table_name = "tblbusinesstype";

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get tax by id
     * @param  mixed $id tax id
     * @return mixed     if id passed return object else array
     */
    public function get($id = '') {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get($this->table_name)->row();
        }
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get($this->table_name)->result_array();
    }
    
    /**
     * Add new tax
     * @param array $data tax data
     * @return boolean
     */
    public function add($data) {

        $req_vendor_id = 0;
        $req_id = 0;
        if (isset($data['req_vendor_id'])){
            $req_vendor_id = $data['req_vendor_id'];
            $req_id = $data['req_id'];
            unset($data['req_vendor_id']);
            unset($data['req_id']);
        }
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
		$vbdata['phone_no_1']=$data['contact_number'];
		$vbdata['vendor_id']=$insert_id;
		$vbdata['location']=$data['location'];
		$vbdata['email_id']=$data['email'];
		$vbdata['vat']=$data['gst_no'];
		$vbdata['pan_no']=$data['pan_no'];
		$vbdata['cin_no']=$data['cin_no'];
		$vbdata['address']=$data['address'];
		$vbdata['state']=$data['state_id'];
		$vbdata['city']=$data['city_id'];
		$vbdata['landmark']=$data['landmark'];
		$vbdata['zip']=$data['pincode'];
		$vbdata['vendor_branch_name']= cc($data['name'].' '.$data['location']);
		$vbdata['created_at'] = date("Y-m-d H:i:s");
        $vbdata['updated_at'] = date("Y-m-d H:i:s");
		$this->db->insert('tblvendorbranch', $vbdata);
        if ($insert_id) {
            if ($req_vendor_id > 0 && $req_id > 0){
                $reqdata['vendor_name'] = cc($data['name']);
                $reqdata['vendor_id'] = $insert_id;
                $vname = value_by_id('tblrequirement_productvendors', $req_vendor_id, 'vendor_name');
                $this->home_model->update('tblrequirement_productvendors', $reqdata, array('req_id' => $req_id, 'vendor_name' => $vname));
            }
            return $insert_id;
        }

        return false;
    }

    /**
     * Edit tax
     * @param  array $data tax data
     * @return boolean
     */
    public function edit($data, $id) {

        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Delete tax from database
     * @param  mixed $id tax id
     * @return boolean
     */
    public function delete($id) {

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

//check product id
    public function check_vendor_product($product_id,$vendor_id){
        $this->db->select('*');
        $this->db->from('tblvendorproductsname');
        $this->db->where('product_id', $product_id);
        $this->db->where('vendor_id', $vendor_id);
        $query = $this->db->get();
        //echo $query;die;
        if($query->num_rows() >=1){
              $data = $query->row_array();
              return (1);
        }else{
            return (0);
        }
        }

    
    public function get_business_type() {
        
        $this->db->order_by('name', 'ASC');
        return $this->db->get($this->business_type_table_name)->result_array();
    } 
    
    public function get_state() {
        
        $this->db->order_by('name', 'ASC');
        return $this->db->get($this->state_table_name)->result_array();
    } 
	
    public function get_city() {
        
        $this->db->order_by('name', 'ASC');
        return $this->db->get('tblcities')->result_array();
    }
    
    public function get_cities_by_state_id($state_id) {
        
        $this->db->where('state_id', $state_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get($this->city_table_name)->result_array();
    } 
	
    public function get_subcat_by_cat_id($category_id) {
        
        $this->db->where('category_id', $category_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('tblproductsubcategory')->result_array();
    }
    
    /**
     * Edit product term condition
     * @param  array $data product term condition data
     * @return boolean
     */
    public function add_product_term_condition($data, $id) {
        
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

}
