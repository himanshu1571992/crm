<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enquiry_model extends CRM_Model {

    private $table_name = "tblenquiry";
    
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
		
		if(isset($data['existing_enquiry']))
		{
			$data['existing_enquiry']['status'] = '1';
			$data['existing_enquiry']['enquiry_date'] = date("Y-m-d",strtotime($data['existing_enquiry']['enquiry_date']));
			$data['existing_enquiry']['reminder_date'] = date("Y-m-d",strtotime($data['existing_enquiry']['reminder_date']));
			$data['existing_enquiry']['created_at'] = date("Y-m-d H:i:s");
			$data['existing_enquiry']['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert($this->table_name, $data['existing_enquiry']);
			$insert_id = $this->db->insert_id();
			$datace['enquiry_id']=$insert_id;
			$datace['contact_id']=$data['enquiryclientperson']['contact_id'];
			$this->db->insert('tblenquiryclientperson', $datace);
			$assignstaff=$data['existing_enquiryassign']['assignid'];
			$proenqdata=$data['proenqdata'];
			foreach($assignstaff as $single_staff)
			{
				if (strpos($single_staff, 'staff') !== false) 
				{
					$staff_id[]=str_replace("staff","",$single_staff);
				}
				if (strpos($single_staff, 'group') !== false) 
				{
					$single_staff=str_replace("group","",$single_staff);
					$staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
					foreach($staffgroup as $singlestaff)
					{
						$staff_id[]=$singlestaff['staff_id'];
					}
				}
			}
			$staff_id=array_unique($staff_id);
			foreach($staff_id as $staffid)
			{
				$sdata['staff_id']=$staffid;
				$sdata['lead_id']=$insert_id;
				$sdata['status'] = '1';
				$sdata['created_at'] = date("Y-m-d H:i:s");
				$sdata['updated_at'] = date("Y-m-d H:i:s");
				$this->db->insert('tblleadassignstaff', $sdata);
			}
			foreach($proenqdata as $singleproenq)
			{
				$singleproenq['status'] = '1';
				$singleproenq['enquiry_id'] = $insert_id;
				$singleproenq['created_at'] = date("Y-m-d H:i:s");
				$singleproenq['updated_at'] = date("Y-m-d H:i:s");
				$this->db->insert('tblproductinquiry', $singleproenq);
			}
			logActivity('Exiting Enquiry for Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
			return true;
		}
		else
		{
			$data['enquiry']['status'] = '1';
			$data['enquiry']['enquiry_date'] = date("Y-m-d",strtotime($data['enquiry']['enquiry_date']));
			$data['enquiry']['reminder_date'] = date("Y-m-d",strtotime($data['enquiry']['reminder_date']));
			$data['enquiry']['created_at'] = date("Y-m-d H:i:s");
			$data['enquiry']['updated_at'] = date("Y-m-d H:i:s");
			$assignstaff=$data['assign']['assignid'];
			$this->db->insert($this->table_name, $data['enquiry']);
			$insert_id = $this->db->insert_id();
			$clientdata=$data['clientdata'];
			$assignstaff=$data['assign']['assignid'];
			$proenqdata=$data['proenqdata'];
			if ($insert_id) {
				$this->db->insert('tblclientbranch', $data['clients']);
				$client_branch_id= $this->db->insert_id();
				foreach($clientdata as $singleclient)
				{
					$singleclient['userid']=$client_branch_id;
					$this->db->insert('tblcontacts', $singleclient);
					$cont_id = $this->db->insert_id();
					$datace['enquiry_id']=$insert_id;
					$datace['contact_id']=$cont_id;
					$this->db->insert('tblenquiryclientperson', $datace);
				}
				$cdata['client_id']=$client_branch_id;
				$this->db->where('id', $insert_id);
				$this->db->update($this->table_name, $cdata);
				foreach($proenqdata as $singleproenq)
				{
					$singleproenq['status'] = '1';
					$singleproenq['enquiry_id'] = $insert_id;
					$singleproenq['created_at'] = date("Y-m-d H:i:s");
					$singleproenq['updated_at'] = date("Y-m-d H:i:s");
					$this->db->insert('tblproductinquiry', $singleproenq);
				}
				foreach($assignstaff as $single_staff)
				{
					if (strpos($single_staff, 'staff') !== false) 
					{
						$staff_id[]=str_replace("staff","",$single_staff);
					}
					if (strpos($single_staff, 'group') !== false) 
					{
						$single_staff=str_replace("group","",$single_staff);
						$staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
						foreach($staffgroup as $singlestaff)
						{
							$staff_id[]=$singlestaff['staff_id'];
						}
					}
				}
				$staff_id=array_unique($staff_id);
				foreach($staff_id as $staffid)
				{
					$sdata['staff_id']=$staffid;
					$sdata['lead_id']=$insert_id;
					$sdata['status'] = '1';
					$sdata['created_at'] = date("Y-m-d H:i:s");
					$sdata['updated_at'] = date("Y-m-d H:i:s");
					$this->db->insert('tblleadassignstaff', $sdata);
				}
				logActivity('New Enquiry for Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
				return true;
			}
		}
        return false;
    }

    /**
     * Edit tax
     * @param  array $data tax data
     * @return boolean
     */
    public function edit($data, $id) {
		if(isset($data['existing_enquiry']))
		{
			$data['existing_enquiry']['status'] = '1';
			$data['existing_enquiry']['enquiry_date'] = date("Y-m-d",strtotime($data['existing_enquiry']['enquiry_date']));
			$data['existing_enquiry']['reminder_date'] = date("Y-m-d",strtotime($data['existing_enquiry']['reminder_date']));
			$data['existing_enquiry']['created_at'] = date("Y-m-d H:i:s");
			$data['existing_enquiry']['updated_at'] = date("Y-m-d H:i:s");
			$this->db->where('id', $id);
			$this->db->update($this->table_name, $data['existing_enquiry']);
			
			$this->db->where('enquiry_id', $id);
			$this->db->delete('tblenquiryclientperson');
			$this->db->where('lead_id', $id);
			$this->db->delete('tblleadassignstaff');
			$this->db->where('enquiry_id', $id);
			$this->db->delete('tblproductinquiry');
			$datace['enquiry_id']=$id;
			$datace['contact_id']=$data['enquiryclientperson']['contact_id'];
			$this->db->insert('tblenquiryclientperson', $datace);
			$assignstaff=$data['existing_enquiryassign']['assignid'];
			$proenqdata=$data['proenqdata'];
			foreach($assignstaff as $single_staff)
			{
				if (strpos($single_staff, 'staff') !== false) 
				{
					$staff_id[]=str_replace("staff","",$single_staff);
				}
				if (strpos($single_staff, 'group') !== false) 
				{
					$single_staff=str_replace("group","",$single_staff);
					$staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
					foreach($staffgroup as $singlestaff)
					{
						$staff_id[]=$singlestaff['staff_id'];
					}
				}
			}
			$staff_id=array_unique($staff_id);
			foreach($staff_id as $staffid)
			{
				$sdata['staff_id']=$staffid;
				$sdata['lead_id']=$id;
				$sdata['status'] = '1';
				$sdata['created_at'] = date("Y-m-d H:i:s");
				$sdata['updated_at'] = date("Y-m-d H:i:s");
				$this->db->insert('tblleadassignstaff', $sdata);
			}
			foreach($proenqdata as $singleproenq)
			{
				$singleproenq['status'] = '1';
				$singleproenq['enquiry_id'] = $id;
				$singleproenq['created_at'] = date("Y-m-d H:i:s");
				$singleproenq['updated_at'] = date("Y-m-d H:i:s");
				$this->db->insert('tblproductinquiry', $singleproenq);
			}
			logActivity('Exiting Enquiry for Added [ID: ' . $id . ', ' . $data['name'] . ']');
			return true;
		}
		
        
        
        
       
            return true;
       
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
            logActivity('Enquiry for Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

}
