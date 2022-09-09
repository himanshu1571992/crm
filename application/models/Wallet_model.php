<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Wallet_model extends CRM_Model	 
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

    	
	public function edit_wallet($data, $id) {
        
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('tblstaffwallet', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }
	
   
}
