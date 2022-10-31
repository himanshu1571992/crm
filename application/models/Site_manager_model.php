<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Site_manager_model extends CRM_Model {

    private $table_name = "tblsitemanager";
    private $state_table_name = "tblstates";
    private $city_table_name = "tblcities";

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
        $this->db->order_by('name', 'ASC');

        return $this->db->get($this->table_name)->result_array();
    }

    /**
     * Add new tax
     * @param array $data tax data
     * @return boolean
     */
    public function add($data) {

        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
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

	 public function get_product_by_cat_id($category_id) {
        $this->db->where('product_cat_id', $category_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('tblproducts')->result_array();
    }
}
