<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Stock_consumption_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

   
    /**
     * @param $_POST array
     * @return Insert ID
     * Add new stock details this function
     */
    public function add($data)
    {
        $current_datetime = date('Y-m-d H:i:s');
        
        
        $assignstaff = $data['assignid'];
        $staff_id = array();
        foreach($assignstaff as $single_staff)
        {
            if (strpos($single_staff, 'staff') !== false) 
            {
                $staff_id[]=str_replace("staff","",$single_staff);
            }
        }
        
        $insert_data["type"] = $data["stock_type"];
        $insert_data["vendor_id"] = (!empty($data["vendor_id"])) ? $data["vendor_id"] : 0;
        $insert_data["service_type"] = $data["service_type"];
        $insert_data["warehouse_id"] = $data["warehouse_id"];
        $insert_data["remark"] = $data["remark"];
        $insert_data["created_at"] = $current_datetime;
        $insert_data["updated_at"] = $current_datetime;
        
        $insert_id = $this->home_model->insert('tblstockconsumption', $insert_data);
        if ($insert_id){
            
            /* this is for store product details */
            if (isset($data["products"]) && !empty($data["products"])){
                foreach ($data["products"] as $value) {
                    
                    $product_details["stockconsumption_id"] = $insert_id;
                    $product_details["product_id"] = $value["product_id"];
                    $product_details["pro_id"] = $value["pro_id"];
                    $product_details["available_qty"] = $value["available_qty"];
                    $product_details["qty"] = $value["qty"];
                    $product_details["remark"] = $value["remark"];
                    $product_details["type"] = 1;
                    $product_details["created_at"] = date('Y-m-d H:i:s');
                    $product_details["updated_at"] = date('Y-m-d H:i:s');
                    
                    $this->home_model->insert('tblstockconsumptionproductsdetails', $product_details);
                }
            }
            
            /* this is for store product consume details */
            if (isset($data["products_consume"]) && !empty($data["products_consume"])){
                foreach ($data["products_consume"] as $value) {
                    $details["stockconsumption_id"] = $insert_id;
                    $details["product_id"] = $value["product_id"];
                    $details["pro_id"] = $value["pro_id"];
                    $details["available_qty"] = $value["available_qty"];
                    $details["qty"] = $value["qty"];
                    $details["remark"] = $value["remark"];
                    $details["type"] = 2;
                    $details["created_at"] = date('Y-m-d H:i:s');
                    $details["updated_at"] = date('Y-m-d H:i:s');
                    
                    $this->home_model->insert('tblstockconsumptionproductsdetails', $details);
                }
            }
            
            if(!empty($staff_id)){
                foreach($staff_id as $single_staff)
                {
                    if($single_staff!=get_staff_user_id())
                    {
                        $sdata['staffid']=$single_staff;
                        $sdata['stockconsumption_id']=$insert_id;
                        $sdata['status']=1;
                        $sdata['created_at'] = date("Y-m-d H:i:s");
                        $sdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->home_model->insert('tblstockconsumptionapproval', $sdata);

                        $adata = array(
                            'staff_id' => $single_staff,
                            'fromuserid'      => get_staff_user_id(),
                            'module_id' => 17,
                            'table_id' => $insert_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => 'Stock Consumption For Approval',
                            'link' => 'stock_consumption/view/'.$insert_id.'/approval',
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );  
                        $this->home_model->insert('tblmasterapproval', $adata);
                        
                        //Sending Mobile Intimation
                            $token = get_staff_token($single_staff);
                            $title = 'Schach';
                            $message = 'Stock Consumption For Approval';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }
            }
            return $insert_id;
        }
        return false;
    }
    
    public function stock_update_status($id, $data){
        $user_id = get_staff_user_id();

        $update = $this->home_model->update('tblstockconsumption', array('status'=>$data["action"]),array('id'=>$id));
        if($update){
           $ad_data = array(                            
                'approvereason' => $data["approvereason"],
                'approve_status' => $data["action"],
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->home_model->update('tblstockconsumptionapproval', $ad_data,array('stockconsumption_id'=>$id,'staffid'=>$user_id));

            update_masterapproval_single(get_staff_user_id(),17,$id,$data["action"]);
            update_masterapproval_all(17,$id,$data["action"]);        
            
            if ($data["action"] == 1){
                $stock_info = $this->db->query("SELECT * FROM tblstockconsumption WHERE id = '" . $id . "'")->row();
                $stock_details = $this->db->query("SELECT * FROM tblstockconsumptionproductsdetails WHERE stockconsumption_id = '" . $id . "'")->result();
                if (!empty($stock_details)){
                    foreach ($stock_details as $details) {
                        
                        
                        
                        $where = "pro_id = '" . $details->product_id . "' and warehouse_id = '" . $stock_info->warehouse_id . "' and service_type = '" . $stock_info->service_type . "' and stock_type = 1";
                        $getprostock = $this->db->query("SELECT `id`,`qty` FROM tblprostock WHERE " . $where . "")->row();
                        
                        if (!empty($getprostock)){
                            
                            if ($details->type == 1) {
                                $final_qty = $getprostock->qty + $details->qty;
                                $this->home_model->update('tblprostock', array('qty' => $final_qty), array('id' => $getprostock->id));
                            }
                            
                            if ($details->type == 2) {
                                $final_qty = $getprostock->qty - $details->qty;
                                $this->home_model->update('tblprostock', array('qty' => $final_qty), array('id' => $getprostock->id));
                            }
                            
                        }else{
                            if ($details->type == 1) {
                                
                                $insert_data["pro_id"] = $details->product_id;
                                $insert_data["warehouse_id"] = $stock_info->warehouse_id;
                                $insert_data["service_type"] = $stock_info->service_type;
                                $insert_data["store"] = 1;
                                $insert_data["is_pro"] = 1;
                                $insert_data["qty"] = $details->qty;
                                $insert_data["created_at"] = date('Y-m-d H:i:s');
                                $insert_data["updated_at"] = date('Y-m-d H:i:s');
                                $this->home_model->insert('tblprostock', $insert_data);
                            }
                        } 
                    }
                }
            }
            
            return $update;
        }
        return false;
    }
    
    public function stock_issue_add($data)
    {
        $current_datetime = date('Y-m-d H:i:s');
        
        $insert_data["staff_id"] = get_staff_user_id();
        $insert_data["service_type"] = $data["service_type"];
        $insert_data["warehouse_id"] = $data["warehouse_id"];
        $insert_data["remark"] = $data["remark"];
        $insert_data["date"] = date("Y-m-d");
        $insert_data["created_at"] = $current_datetime;
        $insert_data["updated_at"] = $current_datetime;
        
        $insert_id = $this->home_model->insert('tblissue', $insert_data);
        if ($insert_id){
            
            /* this is for store product details */
            if (isset($data["products"]) && !empty($data["products"])){
                foreach ($data["products"] as $value) {
                    
                    $where = "pro_id = '" . $value["product_id"] . "' and warehouse_id = '" . $data["warehouse_id"] . "' and service_type = '" . $data["service_type"] . "' and stock_type = 1";
                    $getprostock = $this->db->query("SELECT `id`,`qty` FROM tblprostock WHERE " . $where . "")->row();
                    if (!empty($getprostock)){
                        $final_qty = $getprostock->qty - $value["qty"];
                        $this->home_model->update('tblprostock', array('qty' => $final_qty), array('id' => $getprostock->id));
                    }
                        
                    $product_details["stockissue_id"] = $insert_id;
                    $product_details["product_id"] = $value["product_id"];
                    $product_details["pro_id"] = $value["pro_id"];
                    $product_details["available_qty"] = $value["available_qty"];
                    $product_details["qty"] = $value["qty"];
                    $product_details["remark"] = $value["remark"];
                    $product_details["created_at"] = date('Y-m-d H:i:s');
                    $product_details["updated_at"] = date('Y-m-d H:i:s');
                    
                    $this->home_model->insert('tblissueproduct', $product_details);
                }
            }
            return $insert_id;
        }
        return false;
    }
    
    public function stock_issue_delete($id){
        
        $stock_info = $this->db->query("SELECT * FROM tblissue WHERE `id` = ".$id."")->row();
        if ($stock_info){
            $stock_product = $this->db->query("SELECT * FROM tblissueproduct WHERE `stockissue_id` = ".$id."")->result();
            if ($stock_product){
                foreach ($stock_product as $value) {
                    $where = "pro_id = '" . $value->product_id . "' and warehouse_id = '" . $stock_info->warehouse_id . "' and service_type = '" . $stock_info->service_type . "' and stock_type = 1";
                    $getprostock = $this->db->query("SELECT `id`,`qty` FROM tblprostock WHERE " . $where . "")->row();
                    if (!empty($getprostock)){
                        $final_qty = $getprostock->qty + $value->qty;
                        $this->home_model->update('tblprostock', array('qty' => $final_qty), array('id' => $getprostock->id));
                    }
                }
            }
        }
        
        $this->db->where('id', $id);
        $this->db->delete("tblissue");
        if ($this->db->affected_rows() > 0) {
            $this->db->where('stockissue_id', $id);
            $this->db->delete("tblissueproduct");
            if ($this->db->affected_rows() > 0) {
                
                return true;
            }
        }

        return false;
    }
   
}
