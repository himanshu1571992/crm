<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff_iteams_model extends CRM_Model {

    private $table_name = "tblstaffitems";
    
    public function __construct() {
        parent::__construct();
    }

    
    public function get($id = '') {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get($this->table_name)->row();
        }
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get($this->table_name)->result_array();
    }

    
    public function add($data) {
        
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Staff Iteams Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
            return true;
        }

        return false;
    }

    
    public function edit($data, $id) {
        
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

   
    public function delete($id) {
        
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        if ($this->db->affected_rows() > 0) {
            logActivity('Unit Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

}
