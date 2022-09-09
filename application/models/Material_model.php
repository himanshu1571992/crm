<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Material_model extends CRM_Model	 
{
   
	private $table_name = "tblrawmaterial";
   public function __construct()
    {
        parent::__construct();
    }

	
	public function get($id = '')
    {
        $this->db->where('status', 1);
        $this->db->order_by('order', 'asc');

        return $this->db->get('tblrawmaterial')->result_array();
    }
    
	
	 public function get_rawmaterial($id = '')
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblrawmaterial')->row();
        }
        $this->db->order_by('order', 'asc');

        return $this->db->get('tblrawmaterial')->result_array();
    }

    public function add_material($data)
    {
        $in_data['created_at'] = date("Y-m-d H:i:s");
        $in_data['updated_at'] = date("Y-m-d H:i:s");
        $in_data['name'] = $data['name'];
        $in_data['code'] = $data['code'];
        $in_data['order'] = $data['order'];
        $in_data['status'] = $data['status'];
        $custom_fields = $data['custom_fields'];

	  
        $this->db->insert('tblrawmaterial', $in_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
			 if (isset($custom_fields)) {
                handle_custom_fields_post($insert_id, $custom_fields);
            }
			
            logActivity('New Material Added [ID: ' . $insert_id . ']');

            return $insert_id;
        }

        return false;
    }
	
	
    public function update_material($data, $id)
    {
         
        $in_data['updated_at'] = date("Y-m-d H:i:s");
		 $in_data['name'] = $data['name'];
        $in_data['code'] = $data['code'];
        $in_data['order'] = $data['order'];
        $in_data['status'] = $data['status'];
        $custom_fields = $data['custom_fields'];
	  
		 
        $this->db->where('id', $id);
        $this->db->update('tblrawmaterial', $in_data);
        if ($this->db->affected_rows() > 0) {
			
			if (isset($custom_fields)) {
                handle_custom_fields_post($id, $custom_fields);
            }
			
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
    public function delete_duduction($id)
    {
        
        $this->db->where('id', $id);
        $this->db->delete('tblsalarydeduction');
        if ($this->db->affected_rows() > 0) {
            logActivity('Event Deleted [' . $id . ']');

            return true;
        }

        return false;
    }
	
	public function edit_material($data, $id) {
        
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('tblrawmaterial', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }
	
	public function delete_material($id)
    {
       
        $this->db->where('id', $id);
        $this->db->delete('tblrawmaterial');
        if ($this->db->affected_rows() > 0) {
            logActivity('Material Deleted [' . $id . ']');

            return true;
        }

        return false;
    }
	
	
	
	
	
	/* productcomponent */
	
	public function get_productcomponent($id = '') {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get('tblproductcomponentrawmaterial')->row();
        }
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get('tblproductcomponentrawmaterial')->result_array();
    }

	
	 public function add($data) {

        
        $main_data['type'] = $data['type'];
        $main_data['product_category'] = $data['product_category'];
        $main_data['product'] = $data['product'];
        $main_data['component'] = $data['component'];
        $main_data['status'] = $data['status'];
		$main_data['created_at'] = date("Y-m-d H:i:s");
        $main_data['updated_at'] = date("Y-m-d H:i:s");
		
       $procomponnetdata = $data['componnetdata'];
       
        $this->db->insert('tblproductcomponentrawmaterial', $main_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            foreach ($procomponnetdata as $singlecomponentdata) {
                $pcata['parent_id'] = $insert_id;
                $pcata['raw_material_id'] = $singlecomponentdata['componnetid'];
                $pcata['quantity'] = $singlecomponentdata['compqty'];
                $pcata['status'] = 1;
                $pcata['created_at'] = date("Y-m-d H:i:s");
                $pcata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblproductcomponentrawmaterialdetails', $pcata);
				
            }
            logActivity('New Raw Material Added [ID: ' . $insert_id . ']');
            return $insert_id;
        }

        return false;
    }
	
	
	public function edit($data, $id) {

        $main_data['type'] = $data['type'];
        $main_data['product_category'] = $data['product_category'];
        $main_data['product'] = $data['product'];
        $main_data['component'] = $data['component'];
        $main_data['status'] = $data['status'];
        $main_data['updated_at'] = date("Y-m-d H:i:s");
        $procomponnetdata = $data['componnetdata'];
        unset($data['componnetdata']);
        $this->db->where('id', $id);
        $this->db->update('tblproductcomponentrawmaterial', $main_data);
       

	   $this->db->where('parent_id', $id);
        $this->db->delete('tblproductcomponentrawmaterialdetails');
        array_filter($procomponnetdata);
        foreach ($procomponnetdata as $singlecomponentdata) {
            $pcata['parent_id'] = $id;
			$pcata['raw_material_id'] = $singlecomponentdata['componnetid'];
			$pcata['quantity'] = $singlecomponentdata['compqty'];
			$pcata['status'] = 1;
			$pcata['created_at'] = date("Y-m-d H:i:s");
			$pcata['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert('tblproductcomponentrawmaterialdetails', $pcata);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }
	
	public function getmaterialdata($id = '') {
        if (is_numeric($id)) {
            $this->db->where('parent_id', $id);
            return $this->db->get('tblproductcomponentrawmaterialdetails')->result_array();
        }
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get('tblproductcomponentrawmaterialdetails')->result_array();
    }
	
	public function change_status($data, $id) {
        
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update('tblproductcomponentrawmaterial', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }
   
}
