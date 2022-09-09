<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Attendance_model extends CRM_Model	 
{
   
	private $table_name = "tblcompanyevents";
   public function __construct()
    {
        parent::__construct();
    }

    
    public function get_event($id = '')
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblcompanyevents')->row();
        }
        $this->db->order_by('order', 'asc');

        return $this->db->get('tblcompanyevents')->result_array();
    }

    public function add_event($data)
    {
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
	  
		$from_date = str_replace("/","-",$data['from_date']);
		$data['from_date'] = date("Y-m-d H:i:s",strtotime($from_date));
		$to_date = str_replace("/","-",$data['to_date']);
		$data['to_date'] = date("Y-m-d H:i:s",strtotime($to_date));
	  
        $this->db->insert('tblcompanyevents', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Event Added [ID: ' . $insert_id . ']');

            return $insert_id;
        }

        return false;
    }
	
	
    /**
     * Update expense category
     * @param  mixed $data All $_POST data
     * @param  mixed $id   expense id to update
     * @return boolean
     */
    public function update_event($data, $id)
    {
         
        $data['updated_at'] = date("Y-m-d H:i:s");
	  
		$from_date = str_replace("/","-",$data['from_date']);
		$data['from_date'] = date("Y-m-d H:i:s",strtotime($from_date));
		$to_date = str_replace("/","-",$data['to_date']);
		$data['to_date'] = date("Y-m-d H:i:s",strtotime($to_date));
		 
        $this->db->where('id', $id);
        $this->db->update('tblcompanyevents', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Event Updated [ID: ' . $id . ']');

            return true;
        }

        return false;
    }
	
	
    /**
     * @param  integer ID
     * @return mixed
     * Delete expense category from database, if used return array with key referenced
     */
    public function delete_event($id)
    {
        
        $this->db->where('id', $id);
        $this->db->delete('tblcompanyevents');
        if ($this->db->affected_rows() > 0) {
            logActivity('Event Deleted [' . $id . ']');

            return true;
        }

        return false;
    }
	
	public function edit_event($data, $id) {
        
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('tblcompanyevents', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }
	
   
}
