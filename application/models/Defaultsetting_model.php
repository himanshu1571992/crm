<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Defaultsetting_model extends CRM_Model {

    private $table_name = "tbldefaultsetting";
    
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
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
		$data['default_setting_field'] =implode(',',$data['default_setting_field']);
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Default Setting Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
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
		if(isset($data['default_setting_field']))
		{
			$data['default_setting_field'] =implode(',',$data['default_setting_field']);
		}
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
			$this->db->where('group_id', $id);
			$this->db->delete('tblstaffgroupmembers');
			$this->db->where('staffgroup_id', $id);
			$this->db->delete('tblstaffgroupmultiselect');
            logActivity('Staff Group Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

}
