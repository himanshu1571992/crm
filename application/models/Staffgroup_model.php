<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staffgroup_model extends CRM_Model {

    private $table_name = "tblstaffgroup";
    
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

     public function get_employee_group($user_id) {
          
        $employee_info = get_employee_info($user_id);    
        
        if(!empty($employee_info->employee_group)){
            return $this->db->query("SELECT * FROM `tblstaffgroup` where status = 1 and id IN (".$employee_info->employee_group.") ")->result_array();
        }
    }

    /**
     * Add new tax
     * @param array $data tax data
     * @return boolean
     */
    public function add($data) {
        $multiselect_id=$data['multiselect_id'];
        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
		$data['multiselect_id'] =implode(',',$data['multiselect_id']);
		$staff_id =$data['staff_id'];
		$data['staff_id'] =implode(',',$data['staff_id']);
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
			print_r($staff_id);
			foreach($staff_id as $single_staff_id)
			{
				$sdata['group_id'] = $insert_id;
				$sdata['staff_id'] = $single_staff_id;
				$this->db->insert('tblstaffgroupmembers', $sdata);
			}
			foreach($multiselect_id as $catmultiselect)
			{
				$msdata['staffgroup_id'] = $insert_id;
				$msdata['multiselect_id'] = $catmultiselect;
				$this->db->insert('tblstaffgroupmultiselect', $msdata);
			}
            logActivity('New Staff Group Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
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
        $multiselect_id=$data['multiselect_id'];
		$data['multiselect_id'] =implode(',',$data['multiselect_id']);
        $data['updated_at'] = date("Y-m-d H:i:s");
		$staff_id =$data['staff_id'];
		$data['staff_id'] =implode(',',$data['staff_id']);
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {
			$this->db->where('group_id', $id);
			$this->db->delete('tblstaffgroupmembers');
			
			$this->db->where('staffgroup_id', $id);
			$this->db->delete('tblstaffgroupmultiselect');
			
			foreach($staff_id as $single_staff_id)
			{
				$sdata['group_id'] = $id;
				$sdata['staff_id'] = $single_staff_id;
				$this->db->insert('tblstaffgroupmembers', $sdata);
			}
			foreach($multiselect_id as $catmultiselect)
			{
				$msdata['staffgroup_id'] = $id;
				$msdata['multiselect_id'] = $catmultiselect;
				$this->db->insert('tblstaffgroupmultiselect', $msdata);
			}
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
