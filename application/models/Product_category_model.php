<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_category_model extends CRM_Model {

    private $table_name = "tblproductcategory";

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


	public function getallcatbymultiselect() {
      $catdata=$this->db->query("SELECT pc.* FROM `tblproductcategory` pc LEFT JOIN `tblcategorymultiselect` cm on pc.`id`=cm.`category_id` LEFT JOIN `tblmultiselectmaster` ms ON ms.`id`=pc.`multiselect_id` where ms.multiselect	='Vendor Product' GROUP BY pc.`id`")->result_array();
	  return $catdata;
   }

    /**
     * Add new tax
     * @param array $data tax data
     * @return boolean
     */
    public function add($data) {
        /*$multiselect_id=$data['multiselect_id'];
		$data['multiselect_id'] =implode(',',$data['multiselect_id']);*/
        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");

        if(!empty($data['for_service'])){
            $data['for_service'] = 1;
        }else{
            $data['for_service'] = 0;
        }
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
			/*foreach($multiselect_id as $catmultiselect)
			{
				$msdata['category_id'] = $insert_id;
				$msdata['multiselect_id'] = $catmultiselect;
				$this->db->insert('tblcategorymultiselect', $msdata);
			}*/
            logActivity('New Product Category Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
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

		//unset($data['multiselect_id']);

        if(!empty($data['for_service'])){
            $data['for_service'] = 1;
        }else{
            $data['for_service'] = 0;
        }


		$data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {
			$this->db->where('category_id', $id);
			$this->db->delete('tblcategorymultiselect');

			foreach($multiselect_id as $catmultiselect)
			{
				$msdata['category_id'] = $id;
				$msdata['multiselect_id'] = $catmultiselect;
				$this->db->insert('tblcategorymultiselect', $msdata);
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
		$this->db->where('category_id', $id);
		$this->db->delete('tblcategorymultiselect');
        if ($this->db->affected_rows() > 0) {
            logActivity('Product Category Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

}
