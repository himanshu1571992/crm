<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Live_location_model extends CRM_Model	 
{
   
	private $table_name = "tblemployeelocations";
   public function __construct()
    {
        parent::__construct();
    }

    public function get_location($id = '')
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblemployeelocations')->row();
        }
        $this->db->order_by('order', 'asc');

        return $this->db->get('tblemployeelocations')->result_array();
    }
  
    public function add($data)
    {
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
	  // $data['description'] = nl2br($data['description']);
        $this->db->insert('tblemployeelocations', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('Live Location Added [ID: ' . $insert_id . ']');

            return $insert_id;
        }

        return false;
    }
	
	
    public function update($data, $id)
    {
         $data['updated_at'] = date("Y-m-d H:i:s");
         $data['admin_action'] = 1;
        $this->db->where('id', $id);
        $this->db->update('tblemployeelocations', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Live Location Updated [ID: ' . $id . ']');

            return true;
        }

        return false;
    }
	
	
    /**
     * @param  integer ID
     * @return mixed
     * Delete expense category from database, if used return array with key referenced
     */
    public function delete($id)
    {
        
        $this->db->where('id', $id);
        $this->db->delete('tblemployeelocations');
        if ($this->db->affected_rows() > 0) {
            logActivity('Location Deleted [' . $id . ']');

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
	
}
