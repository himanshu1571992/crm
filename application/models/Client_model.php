<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Client_model extends CRM_Model {

    private $table_name = "tblclients";

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
            $this->db->where('userid', $id);
            $this->db->order_by('client_branch_name', 'ASC');
            return $this->db->get('tblclientbranch')->row();
        }
        $this->db->order_by('client_branch_name', 'ASC');
        return $this->db->get('tblclientbranch')->result_array();
    }

     public function get_ajax($id = '', $where = [])
    {
        //$this->db->select(implode(',', prefixed_table_fields_array('tblclients')) . ',' . get_sql_select_client_branch_company());
        $this->db->select(implode(',', prefixed_table_fields_array('tblclients')) . ', CASE company WHEN "" THEN (SELECT CONCAT(firstname, " ", lastname) FROM tblcontacts WHERE userid = tblclients.userid and is_primary = 1) ELSE company END as company');

        $this->db->join('tblcountries', 'tblcountries.country_id = tblclients.country', 'left');
        $this->db->join('tblcontacts', 'tblcontacts.userid = tblclients.userid AND is_primary = 1', 'left');
        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('tblclients.userid', $id);
            $client = $this->db->get('tblclients')->row();

            if (get_option('company_requires_vat_number_field') == 0) {
                $client->vat = null;
            }
            //print_r($client);
            return $client;
            exit;
        }

        $this->db->order_by('company', 'asc');

        return $this->db->get('tblclients')->result_array();
    }


    /**
     * Add new tax
     * @param array $data tax data
     * @return boolean
     */
    public function add($data) {
        
        if (isset($data["sales_parson"])){
            $data["sales_parson"] = implode(",", $data["sales_parson"]);
        }
        $branch_with_location = $data['branch_with_location'];
        $vendor_id = $data['vendor_id'];
        unset($data['vendor_id']);
        unset($data['branch_with_location']);
        $data['addedfrom'] = get_staff_user_id();
        $data['datecreated'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        unset($data['password']);
		unset($data['followup']);
		$data['client_id']=$insert_id;

        /* this condition for client name with its location */
        if ($branch_with_location == 'on'){
            $data['client_branch_name']=$data['company'].' '.$data['location'];
        }else{
            $data['client_branch_name']=$data['company'];
        }
        $data['vendor_id'] = $vendor_id;
		$this->db->insert('tblclientbranch', $data);
        if ($insert_id) {

            logActivity('New Client Master Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
            return $insert_id;
        }

        return false;
    }

    /**
     * Edit tax
     * @param  array $data tax data
     * @return boolean
     */
    public function edit($data, $id) {

        $this->db->where('userid', $id);
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

        $this->db->where('userid', $id);
        $this->db->delete($this->table_name);



        if ($this->db->affected_rows() > 0) {
            logActivity('Client Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    public function imagedelete($id) {

        $data['photo'] = '';
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Product Images Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

}
