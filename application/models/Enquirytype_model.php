<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enquirytype_model extends CRM_Model {

    private $table_name = "tblenquirytypemaster";

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
            logActivity('New Enquiry type Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
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
            logActivity('Enquiry type Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Add addmainleadstatus tax
     * @param array $data tax data
     * @return boolean
     */
    public function addmainleadstatus($data) {

        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert("tblmainenquirytypemaster", $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Main Lead Status Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
            return true;
        }

        return false;
    }

    /**
     * Edit tax
     * @param  array $data tax data
     * @return boolean
     */
    public function editmainleadstatus($data, $id) {

        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update("tblmainenquirytypemaster", $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Delete deletemainleadstatus from database
     * @param  mixed $id tax id
     * @return boolean
     */
    public function deletemainleadstatus($id) {

        $this->db->where('id', $id);
        $this->db->delete("tblmainenquirytypemaster");
        if ($this->db->affected_rows() > 0) {
            logActivity('Main Lead Status Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }
}
