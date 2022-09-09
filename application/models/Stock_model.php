<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stock_model extends CRM_Model {

    private $table_name = "tblwarehousestock";

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
    public function addpdf($data) {
		$data['addedfrom']=get_staff_user_id();
		$data['status']=1;
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		$this->db->insert('tblwarehousestockpdf', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}	
		
	public function addtransferstock($data) {
		$assignstaff=$data['assign']['assignid'];
		/*$data['stock_type']=='1';
		if($data['stock_type']=='1')
		{
			$data['is_product']=0;
			$compdata=$data['componnetdata'];
		}
		else
		{
			$data['is_product']=1;
			$compdata=$data['productdata'];
		}*/
		$compdata=$data['componnetdata'];
		foreach($assignstaff as $single_staff)
		{
			if (strpos($single_staff, 'staff') !== false) 
			{
				$staff_id[]=str_replace("staff","",$single_staff);
			}
		}
		$staff_id=array_unique($staff_id);
		$staffid=implode(',',array_unique($staff_id));
		$data['addedfrom']=get_staff_user_id();
		$data['approvby']=$staffid;
		$data['status']=1;
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		unset($data['assign']);
		unset($data['componnetdata']);
		unset($data['productdata']);
		unset($data['stock_type']);
		
		//print_r($data);
		//exit;
		$this->db->insert('tblstocktransfer', $data);
		$insert_id = $this->db->insert_id();
		$pretct = 'TRANS';
        $chalanno = $pretct . str_pad($insert_id, 4, "0", STR_PAD_LEFT);
		$udata['transferstockno'] = $chalanno;
		$this->db->where('id', $insert_id);
        $this->db->update('tblstocktransfer', $udata);
        if ($insert_id) 
		{//print_r($compdata);exit;
			foreach($compdata as $singlecompdata)
			{
				$wpdata['stocktransfer_id']=$insert_id;
				$wpdata['product_id']=$singlecompdata['product_id'];
				//$wpdata['remarks']=$singlecompdata['remarks'];
				$wpdata['transfer_qty']=$singlecompdata['transfer_stock'];
				$wpdata['available_stock']=$singlecompdata['available_stock'];
				$wpdata['status']=1;
				$this->db->insert('tblprotransferstock', $wpdata);
				//echo $this->db->last_query();exit;
			}
			foreach($staff_id as $single_staff)
			{
				if($single_staff!=get_staff_user_id())
				{
					$sdata['staffid']=$single_staff;
					$sdata['stocktransfer_id']=$insert_id;
					$sdata['status']=1;
					$sdata['created_at'] = date("Y-m-d H:i:s");
					$sdata['updated_at'] = date("Y-m-d H:i:s");
					$this->db->insert('tbltransferstockapproval', $sdata);
					/*$notified = add_notification([
							'description'     => 'Stock For Approval',
							'touserid'        => $single_staff,
							'fromuserid'      => get_staff_user_id(),
							'link'            => 'Stock/view/' . $insert_id,
							'additional_data' => serialize([
								'Transfer Stock Approval',
							]),
						]);
						if ($notified) {
							pusher_trigger_notification([$single_staff]);
						}*/

					//adding on master log
					$adata = array(
						'staff_id' => $single_staff,
						'fromuserid'      => get_staff_user_id(),
						'module_id' => 2,
						'table_id' => $insert_id,
						'approve_status' => 0,
						'status' => 0,
						'description'     => 'Stock For Approval',
						'link' => 'Stock/view/' . $insert_id,
						'date' => date('Y-m-d'),
						'date_time' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);	
					$this->db->insert('tblmasterapproval', $adata);	
                                        
                                        //Sending Mobile Intimation
                                        $token = get_staff_token($single_staff);
                                        $message = 'Stock For Approval';
                                        $title = 'Schach';
                                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
				}
			}
			return $insert_id;
        }
        return false;
    }

    public function add($data) {

		$assignstaff=$data['assign']['assignid'];
		$data['is_product']=1;
		$compdata=$data['componnetdata'];
		foreach($assignstaff as $single_staff)
		{
			if (strpos($single_staff, 'staff') !== false) 
			{
				$staff_id[]=str_replace("staff","",$single_staff);
			}
		}
		$staff_id=array_unique($staff_id);
		$staffid=implode(',',array_unique($staff_id));
		$data['addedfrom']=get_staff_user_id();
		$data['approvby']=$staffid;
		$data['stock_for']=0;
		$data['service_type']=2;
		$data['is_product']=1;
		$data['status']=1;
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		unset($data['assign']);
		unset($data['componnetdata']);
		
		$this->db->insert('tblwarehousestock', $data);
		$insert_id = $this->db->insert_id();
        if ($insert_id) 
		{
			foreach($compdata as $singlecompdata)
			{
				$wpdata['warehousestockid']=$insert_id;
				$wpdata['product_id']=$singlecompdata['product_id'];
				$wpdata['remarks']=$singlecompdata['remarks'];
				$wpdata['qty']=$singlecompdata['qty'];				
				$wpdata['status']=1;
				$this->db->insert('tblprowarehousestock', $wpdata);
			}
			foreach($staff_id as $single_staff)
			{
				if($single_staff!=get_staff_user_id())
				{
					$sdata['staffid']=$single_staff;
					$sdata['warehousestockid']=$insert_id;
					$sdata['status']=1;
					$sdata['created_at'] = date("Y-m-d H:i:s");
					$sdata['updated_at'] = date("Y-m-d H:i:s");
					$this->db->insert('tblstockapproval', $sdata);
					/*$notified = add_notification([
							'description'     => 'Stock For Approval',
							'touserid'        => $single_staff,
							'fromuserid'      => get_staff_user_id(),
							'link'            => 'Stock/approvestock/' . $insert_id,
							'additional_data' => serialize([
								'Stock Approval',
							]),
						]);
						if ($notified) {
							pusher_trigger_notification([$single_staff]);
						}*/


					//adding on master log
					$adata = array(
						'staff_id' => $single_staff,
						'fromuserid'      => get_staff_user_id(),
						'module_id' => 1,
						'table_id' => $insert_id,
						'approve_status' => 0,
						'status' => 0,
						'description'     => 'Stock For Approval',
						'link' => 'Stock/approvestock/' . $insert_id,
						'date' => date('Y-m-d'),
						'date_time' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);	
					$this->db->insert('tblmasterapproval', $adata);
                                        
					//Sending Mobile Intimation
					$token = get_staff_token($single_staff);
					$message = 'Stock For Approval';
					$title = 'Schach';
					$send_intimation = sendFCM($message, $title, $token, $page = 2);
				}
			}
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
		$assignstaff=$data['assign']['assignid'];
		$data['is_product']=1;
		$compdata=$data['componnetdata'];
		foreach($assignstaff as $single_staff)
		{
			if (strpos($single_staff, 'staff') !== false) 
			{
				$staff_id[]=str_replace("staff","",$single_staff);
			}
		}
		$staff_id=array_unique($staff_id);
		$staffid=implode(',',array_unique($staff_id));
		$data['approvby']=$staffid;
		$data['status']=1;
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		unset($data['assign']);
		unset($data['componnetdata']);
		unset($data['stock_type']);
		
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
		$insert_id=$id;
        if ($this->db->affected_rows() > 0) 
		{
			$this->db->where('warehousestockid', $id);
			$this->db->delete('tblprowarehousestock');
			$this->db->where('warehousestockid', $id);
			$this->db->delete('tblstockapproval');
			foreach($compdata as $singlecompdata)
			{
				if($singlecompdata['product_id']!='')
				{
					$wpdata['warehousestockid']=$insert_id;
					$wpdata['product_id']=$singlecompdata['product_id'];
					$wpdata['remarks']=$singlecompdata['remarks'];
					$wpdata['qty']=$singlecompdata['qty'];
					$wpdata['status']=1;
					$this->db->insert('tblprowarehousestock', $wpdata);
				}
			}
			foreach($staff_id as $single_staff)
			{
				if($single_staff!=get_staff_user_id())
				{
					$sdata['staffid']=$single_staff;
					$sdata['warehousestockid']=$insert_id;
					$sdata['status']=1;
					$sdata['created_at'] = date("Y-m-d H:i:s");
					$sdata['updated_at'] = date("Y-m-d H:i:s");
					$this->db->insert('tblstockapproval', $sdata);
					$notified = add_notification([
							'description'     => 'Stock For Approval',
							'touserid'        => $single_staff,
							'fromuserid'      => get_staff_user_id(),
							'link'            => 'Stock/approvestock/' . $insert_id,
							'additional_data' => serialize([
								'Stock Approval',
							]),
						]);
						if ($notified) {
							pusher_trigger_notification([$single_staff]);
						}
				}
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
			$this->db->where('warehousestockid', $id);
			$this->db->delete('tblprowarehousestock');
			$this->db->where('warehousestockid', $id);
			$this->db->delete('tblstockapproval');
            return true;
        }
        return false;
    } 
	
	public function delete_transferstock($id) {

        $this->db->where('id', $id);
        $this->db->delete('tblstocktransfer');
		
        if ($this->db->affected_rows() > 0) {
			$this->db->where('stocktransfer_id', $id);
			$this->db->delete('tblprotransferstock');
			$this->db->where('stocktransfer_id', $id);
			$this->db->delete('tbltransferstockapproval');
            return true;
        }
        return false;
    } 
	
	public function deletepdf($id) {

        $this->db->where('id', $id);
        $this->db->delete('tblwarehousestockpdf');
        return true;
    }
    
    public function get_state() {
        
        $this->db->order_by('name', 'ASC');
        return $this->db->get($this->state_table_name)->result_array();
    } 
	
	public function get_city() {
        
        $this->db->order_by('name', 'ASC');
        return $this->db->get('tblcities')->result_array();
    }
    
    public function get_cities_by_state_id($state_id) {
        
        $this->db->where('state_id', $state_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get($this->city_table_name)->result_array();
    } 
	
    public function get_subcat_by_cat_id($category_id) {
        
        $this->db->where('category_id', $category_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('tblproductsubcategory')->result_array();
    }
	
	 public function get_product_by_cat_id($category_id) {
        $this->db->where('product_cat_id', $category_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('tblproducts')->result_array();
    }

    public function get_stock($where,$start_from,$limit)
    {

         return $this->db->query("SELECT * from `tblprostock` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
    }

    public function get_stock_count($where)
    {

         return $this->db->query("SELECT count(id) as `ttl_count` from `tblprostock` where ".$where."  ")->row()->ttl_count;
    }
}
