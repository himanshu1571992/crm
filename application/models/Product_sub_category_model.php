<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_sub_category_model extends CRM_Model {

    private $table_name = "tblproductsubcategory";

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

        //$data['multiselect_id'] =implode(',',$data['multiselect_id']);
        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert('tblproductsubcategory', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Product Root Category Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
            return true;
        }

        return false;
    }

    /**
     * Edit tax
     * @param  array $data tax data
     * @return boolean
     */
    public function edit($data, $id) {

        //$data['multiselect_id'] =implode(',',$data['multiselect_id']);
		$data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('tblproductsubcategory', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function add_parent($data) {

        //$data['multiselect_id'] =implode(',',$data['multiselect_id']);
        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->db->insert('tblproductparentcategory', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Product Parent Category Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
            return true;
        }

        return false;
    }

    public function edit_parent($data, $id) {

        //$data['multiselect_id'] =implode(',',$data['multiselect_id']);
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('tblproductparentcategory', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function add_child($data) {

        //$data['multiselect_id'] =implode(',',$data['multiselect_id']);
        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->db->insert('tblproductchildcategory', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Product Parent Category Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
            return true;
        }

        return false;
    }

    public function edit_child($data, $id) {

        //$data['multiselect_id'] =implode(',',$data['multiselect_id']);
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('tblproductchildcategory', $data);
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
        $this->db->delete('tblproductsubcategory');
        if ($this->db->affected_rows() > 0) {
            logActivity('Product Sub Category Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

}
