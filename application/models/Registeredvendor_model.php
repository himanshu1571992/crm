<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Registeredvendor_model extends CRM_Model {

    //private $table_name = "tblregisteredvendor";
    
    public function __construct() {
        parent::__construct();
    }

    public function saverecords($data)
	{
          $this->db->insert('tblregisteredvendorfinancials',$data);
          return $this->db->insert_id();
	}

    public function add($data) {

    	$ad_data['vendor_name'] = $data['vendor_name'];
    	$ad_data['contact_no'] = $data['contact_no'];
    	$ad_data['email_id'] = $data['email_id'];
    	$ad_data['office_address'] = $data['office_address'];
    	$ad_data['office_state'] = $data['office_state'];
    	$ad_data['office_city'] = $data['office_city'];
      $ad_data['work_address'] = $data['work_address'];
      $ad_data['work_state'] = $data['work_state'];
      $ad_data['work_city'] = $data['work_city'];
      $ad_data['business_type'] = $data['business_type'];
    	$ad_data['business_activity'] = $data['business_activity'];
    	$ad_data['comencement_year'] = $data['comencement_year'];
    	$ad_data['pan_no'] = $data['pan_no'];
    	$ad_data['gst_no'] = $data['gst_no'];
    	$ad_data['msme_no'] = $data['msme_no'];
    	$ad_data['iec_no'] = $data['iec_no'];
    	$ad_data['cin_no'] = $data['cin_no'];
    	$ad_data['bank_name'] = $data['bank_name'];
    	$ad_data['bank_address'] = $data['bank_address'];
    	$ad_data['account_type'] = $data['account_type'];
    	$ad_data['account_no'] = $data['account_no'];
    	$ad_data['ifc_code'] = $data['ifc_code'];
    	$ad_data['micr_code'] = $data['micr_code'];
      $ad_data['created_at'] = date('Y-m-d H:i:s');
    	$ad_data['updated_at'] = date('Y-m-d H:i:s');
    	 $this->db->insert('tblregisteredvendor',$ad_data);
         $insert_id = $this->db->insert_id();
         

		if ($insert_id) {

           $persondata = $data['persondata'];
           if(!empty($persondata)){
            foreach ($persondata as $singlepersondata)
            {  
               $perdata['registeredvendor_id'] = $insert_id;
               $perdata['contactperson_name'] = $singlepersondata['contactperson_name'];
               $perdata['contactperson_email'] = $singlepersondata['contactperson_email'];
               $perdata['contactperson_no'] = $singlepersondata['contactperson_no'];
               $perdata['designation_id'] = $singlepersondata['designation_id'];
               $this->db->insert('tblregisteredvendorcontact', $perdata);
            }
            }

           $financialdata = $data['financialdata'];
           if(!empty($financialdata)){
	        foreach ($financialdata as $singlefinancialdata)
	        {  
	           $fdata['registeredvendor_id'] = $insert_id;
	           $fdata['financial_year'] = $singlefinancialdata['financial_year'];
	           $fdata['turnover_details'] = $singlefinancialdata['turnover_details'];
	           $this->db->insert('tblregisteredvendorfinancials', $fdata);
	        }
            }
            
            $customerdata = $data['customerdata'];
	        if(!empty($customerdata)){
            foreach ($customerdata as $singlecustomerdata)
	        {  
	           $cdata['registeredvendor_id'] = $insert_id;
	           $cdata['customer_name'] = $singlecustomerdata['customer_name'];
	           $cdata['customercontact_person'] = $singlecustomerdata['customercontact_person'];
	           $cdata['customercontact_no'] = $singlecustomerdata['customercontact_no'];
	           $cdata['customer_address'] = $singlecustomerdata['customer_address'];
	           $this->db->insert('tblregisteredvendorcustomer', $cdata);
	        }
            }

	        $productdata = $data['productdata'];
            if(!empty($productdata)){
	        foreach ($productdata as $singleproductdata)
	        {  
	           $pdata['registeredvendor_id'] = $insert_id;
	           $pdata['product_name'] = $singleproductdata['product_name'];
	           $pdata['quality_certification'] = $singleproductdata['quality_certification'];
	           $pdata['product_specification'] = $singleproductdata['product_specification'];
	           $this->db->insert('tblregisteredvendorproduct', $pdata);
	        }
            }

            return $insert_id;
        }

        return false;
    }

    
    public function registeredvendors_edit($data, $id)
    { 

      $ad_data['vendor_name'] = $data['vendor_name'];
      $ad_data['contact_no'] = $data['contact_no'];
      $ad_data['email_id'] = $data['email_id'];
      $ad_data['office_address'] = $data['office_address'];
      $ad_data['office_state'] = $data['office_state'];
      $ad_data['office_city'] = $data['office_city'];
      $ad_data['work_address'] = $data['work_address'];
      $ad_data['work_state'] = $data['work_state'];
      $ad_data['work_city'] = $data['work_city'];
      $ad_data['business_type'] = $data['business_type'];
      $ad_data['business_activity'] = $data['business_activity'];
      $ad_data['comencement_year'] = $data['comencement_year'];
      $ad_data['pan_no'] = $data['pan_no'];
      $ad_data['gst_no'] = $data['gst_no'];
      $ad_data['msme_no'] = $data['msme_no'];
      $ad_data['iec_no'] = $data['iec_no'];
      $ad_data['cin_no'] = $data['cin_no'];
      $ad_data['bank_name'] = $data['bank_name'];
      $ad_data['bank_address'] = $data['bank_address'];
      $ad_data['account_type'] = $data['account_type'];
      $ad_data['account_no'] = $data['account_no'];
      $ad_data['ifc_code'] = $data['ifc_code'];
      $ad_data['micr_code'] = $data['micr_code'];
      //$ad_data['created_at'] = date('Y-m-d H:i:s');
      $ad_data['updated_at'] = date('Y-m-d H:i:s');
      $this->db->where('id', $id);
      $update = $this->db->update('tblregisteredvendor', $ad_data);
      if($update)
      {
        $this->db->where('registeredvendor_id', $id);
        $del_contact = $this->db->delete('tblregisteredvendorcontact');
        if($del_contact)
        {
          $persondata = $data['persondata'];
          foreach ($persondata as $singlepersondata)
            {  
               $perdata['registeredvendor_id'] = $id;
               $perdata['contactperson_name'] = $singlepersondata['contactperson_name'];
               $perdata['contactperson_email'] = $singlepersondata['contactperson_email'];
               $perdata['contactperson_no'] = $singlepersondata['contactperson_no'];
               $perdata['designation_id'] = $singlepersondata['designation_id'];
               $this->db->insert('tblregisteredvendorcontact', $perdata);
               
            }
        }

        $this->db->where('registeredvendor_id', $id);
        $del_financial = $this->db->delete('tblregisteredvendorfinancials');
        if($del_financial)
        {
            $financialdata = $data['financialdata'];
           //if(!empty($financialdata)){
          foreach ($financialdata as $singlefinancialdata)
          {  
             $fdata['registeredvendor_id'] = $id;
             $fdata['financial_year'] = $singlefinancialdata['financial_year'];
             $fdata['turnover_details'] = $singlefinancialdata['turnover_details'];
             $this->db->insert('tblregisteredvendorfinancials', $fdata);
          }
           // }
        }

        $this->db->where('registeredvendor_id', $id);
        $del_customer = $this->db->delete('tblregisteredvendorcustomer');
        if($del_customer)
        {
          $customerdata = $data['customerdata'];
          //if(!empty($customerdata)){
            foreach ($customerdata as $singlecustomerdata)
          {  
             $cdata['registeredvendor_id'] = $id;
             $cdata['customer_name'] = $singlecustomerdata['customer_name'];
             $cdata['customercontact_person'] = $singlecustomerdata['customercontact_person'];
             $cdata['customercontact_no'] = $singlecustomerdata['customercontact_no'];
             $cdata['customer_address'] = $singlecustomerdata['customer_address'];
             $this->db->insert('tblregisteredvendorcustomer', $cdata);
          }
           // }
        }

        $this->db->where('registeredvendor_id', $id);
        $del_product = $this->db->delete('tblregisteredvendorproduct');
        if($del_product)
        {
          $productdata = $data['productdata'];
           // if(!empty($productdata)){
          foreach ($productdata as $singleproductdata)
          {  
             $pdata['registeredvendor_id'] = $id;
             $pdata['product_name'] = $singleproductdata['product_name'];
             $pdata['quality_certification'] = $singleproductdata['quality_certification'];
             $pdata['product_specification'] = $singleproductdata['product_specification'];
             $this->db->insert('tblregisteredvendorproduct', $pdata);
          }
            
           // }
        }



    }
  }

    
    public function getvendor($id='', $where = [])
        { 
            $this->db->select('*');
            $this->db->from('tblregisteredvendor t1'); 
            $this->db->join('tblregisteredvendorcustomer t2', 't2.registeredvendor_id = t1.id', 'left');
            $this->db->join('tblregisteredvendorfinancials t3', 't3.registeredvendor_id = t1.id', 'left');
            $this->db->join('tblregisteredvendorproduct t4', 't4.registeredvendor_id = t1.id', 'left');
           // $this->db->where($where);
            $this->db->where('t1.id',$id);         
            $query = $this->db->get()->row();  
            if($query)
            { 
                return $query;
            }
            else
            {
                return false;
            }
            return $this->db->get()->result_array();
        }

}    