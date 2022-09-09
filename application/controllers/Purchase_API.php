<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Purchase_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();   
		$this->load->model('home_model');

    }

    public function getMasters()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        $vendor_arr = array();
        $stafff = array();


        $vendor_info  = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc")->result();
        if(!empty($vendor_info)){
            foreach ($vendor_info as $value) {
                $vendor_arr[] = array(
                    'id' => $value->id,
                    'name' => $value->name,              

                );
            }
        }

 
      $Staffgroup =  get_staff_group(19,$user_id);
      $i=0;
      foreach($Staffgroup as $singlestaff)
      {   
        $stafff[$i]['id']=$singlestaff['id'];
        $stafff[$i]['name']=$singlestaff['name'];

        $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='".$user_id."' and s.active = 1")->result_array();
        $stafff[$i]['staffs']=$query;
        $i++;
      }

      $item_data = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ")->result_array();
      $all_warehouse = $this->db->query("SELECT `id`,`name` FROM `tblwarehouse` where status= '1' ")->result_array();

      $data_array =  array('vendor_data' => $vendor_arr, 'group_info' =>$stafff, 'item_data' =>$item_data, 'all_warehouse' =>$all_warehouse);


        $return_arr['status'] = true;
        $return_arr['message'] = 'Success';
        $return_arr['data'] = $data_array;

        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Purchase_API/getMasters?user_id=1

    }

    public function getMrList()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        $where = " id > '0' ";
        if($vendor_id != ''){
            $where .= " and vendor_id = '".$vendor_id."'";
        }
          
        if($status != ''){
            $where .= " and status = '".$status."'";
        }

        if($type != ''){
            $where .= " and mr_for = '".$type."'";
        }

        $from_date = date('Y-m-d', strtotime(' - 30 days'));

        if(!empty($f_date) && !empty($t_date)){
              $f_date = str_replace("/","-",$f_date);
              $t_date = str_replace("/","-",$t_date);

              $from_date = date('Y-m-d',strtotime($f_date));           
              $to_date = date('Y-m-d',strtotime($t_date));

              $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
         }else{
            $where .= " and date > '".$from_date."' ";
         }

         $materialreceipt_list = $this->db->query("SELECT * from tblmaterialreceipt where  ".$where." order by id desc ")->result();
          if($materialreceipt_list){
              foreach ($materialreceipt_list as $row) {

                  $po_number = '--';
                  if($row->po_id > 0){
                    $purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$row->po_id."' ")->row(); 
                    $po_number = 'PO-'.$purchase_info->number;
                  }elseif($row->deliverychallan_id > 0){
                    $po_number = 'JDC-' . str_pad($row->deliverychallan_id, 4, '0', STR_PAD_LEFT);
                  }

                  if($row->mr_for == 1){
                    $type = 'Against PO';
                  }elseif($row->mr_for == 2){
                    $type = 'Cash';
                  }elseif($row->mr_for == 3){
                    $type = 'GAS';
                  }elseif($row->mr_for == 4){
                    $type = 'Delivery Challan';
                  }

                  $data_arr[] = array(
                      'id' => $row->id,
                      'mr_no' => 'MR-'.$row->id,
                      'po_number' => $po_number,
                      'mr_for' => $row->mr_for,
                      'mr_for_name' => $type,
                      'vendor_id' => $row->vendor_id,
                      'vendor_name' => value_by_id('tblvendor',$row->vendor_id,'name'),
                      'date' => _d($row->created_date),
                      'status' => $row->status
                   );
              }

              $return_arr['status'] = true;
              $return_arr['message'] = "Success";
              $return_arr['data'] = $data_arr;
          }else{
              $return_arr['status'] = false;  
              $return_arr['message'] = "Record not found!";
              $return_arr['data'] = [];
          }
          


        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Purchase_API/getMrList?vendor_id=&status=&type=&f_date=&t_date=

    }

//(create getApprovalMr by gopal)

    public function getApprovalMr()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        
        if(!empty($id) && $id!='0')
        {
        $materialreceipt_list = $this->db->query("SELECT * from tblmaterialreceiptapproval  where mr_id='$id' order by id desc")->result();
          if($materialreceipt_list){
              foreach ($materialreceipt_list as $row) {

                     if($row->approve_status == 0){
                        $status = 'Pending';
                        $date = '';
                      }elseif($row->approve_status == 1){
                        $status = 'Approve';
                        $date = _d($row->updated_at);
                      }elseif($row->approve_status == 2){
                        $status = 'Reject';
                        $date = _d($row->updated_at);
                      }                     

	                  $data_arr[] = array(
	                      'id' => $row->id,
	                      'staff_name' => get_employee_name($row->staff_id),
	                      'date' => $date,
	                      'remark' => $row->remark,
                        'status' => $row->approve_status
	                   );
              }
              $return_arr['status'] = true;
              $return_arr['message'] = "Success";
              $return_arr['data'] = $data_arr;
          }else{
              $return_arr['status'] = false;  
              $return_arr['message'] = "Record not found!";
              $return_arr['data'] = [];
          }
          }
         else{
              $return_arr['status'] = false;  
              $return_arr['message'] = "Required Parameters are missing!";
              $return_arr['data'] = [];
          }
          

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://localhost/crm/Purchase_API/getApprovalMr?id=4
	}
//(create viewMR by gopal)
    public function viewMr()
    {
   		$return_arr = array();

    if(!empty($_GET)){
        extract($this->input->get());
    }

    elseif(!empty($_POST)){
        extract($this->input->post());  
    }
  	$productData['productData'] = array();
     $row = $this->db->query("SELECT * from tblmaterialreceipt where  id='$id' order by id desc ")->row();

      $approval_info = $this->db->query("SELECT * from tblmaterialreceiptapproval  where mr_id= '".$id."' and staff_id = '".$user_id."'")->row();
      $approval_remark = "";
      $approve_status = "";
      if(!empty($approval_info)){
          $approval_remark = $approval_info->remark;
          $approve_status = $approval_info->approve_status;
      }
      if($row){
           $po_number = '--';
              if($row->po_id > 0){
                $purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$row->po_id."' ")->row(); 
                $po_number = 'PO-'.$purchase_info->number;
              }
               $file_count = $this->db->query("SELECT count(id) as file_count from tblmaterialreceiptfiles where mr_id = '".$id."' ")->row();
               $count_file= $file_count->file_count;
               $product_info = $this->db->query("SELECT * from tblmaterialreceiptproduct where mr_id = '".$id."' ")->result();
              if($row->mr_for == 1){
               $type = 'Against PO';
               $data_arr= array(
                  'id' => $row->id,
                  'mr_no' => 'MR-'.$row->id,
                  'po_number' => $po_number,
                  'mr_for' => $type,
                  'mr_for_id' => $row->mr_for,
                  'challan_no'=>$row->challan_no,
                  'reference_no'=>$row->reference_no,
                  'note'=>$row->adminnote,
                  'file_count'=>$count_file,
                  'vendor_id' => $row->vendor_id,
                  'vendor_name' => value_by_id('tblvendor',$row->vendor_id,'name'),
                  'warehouse_id' =>value_by_id('tblwarehouse',$row->warehouse_id,'id'),
                  'warehouse_name' =>value_by_id('tblwarehouse',$row->warehouse_id,'name'),
                  'purchase_order_date' => _d($row->date),
                  'status' => $row->status,
                  'approval_remark' => $approval_remark,
                  'approve_status' => $approve_status
               );
               
               foreach ($product_info as $row1) {
                  $unit = '--';
                if($row1->unit_id > 0){
                   $unit = value_by_id('tblunitmaster',$row1->unit_id,'name'); 
                }
                  $productData['productData'][] =array(
                     'product_id' =>$row1->product_id ,
                     'product_name' =>value_by_id('tblproducts',$row1->product_id,'sub_name'),
                     'hns_code' =>get_hsn_code($row1->product_id),
                     'product_remark' =>$row1->remark, 
                     'unit_id' =>$row1->unit_id, 
                     'unit' =>$unit, 
                     'product_qty' =>$row1->qty 
                  );
             }
           	}elseif($row->mr_for == 2){
              	  $type = 'Cash';
                  $data_arr = array(
                      'id' => $row->id,
                      'mr_no' => 'MR-'.$row->id,
                      'po_number' => $po_number,
                      'mr_for' => $type,
                      'mr_for_id' => $row->mr_for,
                      'challan_no'=>$row->challan_no,
                      'reference_no'=>$row->reference_no,
                      'note'=>$row->adminnote,
                      'file_count'=>$count_file,
                      'vendor_id' => $row->vendor_id,
                      'vendor_name' => value_by_id('tblvendor',$row->vendor_id,'name'),
                      'purchase_order_date' => _d($row->date),
                      'status' => $row->status,
                      'approval_remark' => $approval_remark,
                      'approve_status' => $approve_status
                   );
                  foreach ($product_info as $row1) {
                    $unit = '--';
                    if($row1->unit_id > 0){
                       $unit = value_by_id('tblunitmaster',$row1->unit_id,'name'); 
                    }
	                  $productData['productData'][] =array(
	                     'product_id' =>$row1->product_id ,
	                     'product_name' =>value_by_id('tblproducts',$row1->product_id,'sub_name'),
	                     'hns_code' =>get_hsn_code($row1->product_id),
	                     'product_remark' =>$row1->remark,  
                         'unit_id' =>$row1->unit_id, 
                         'unit' =>$unit, 
	                     'product_qty' =>$row1->qty 
	                  );
                 }
              }elseif($row->mr_for == 3){
                $type = 'GAS';
               $data_arr = array(
                    'id' => $row->id,
                    'mr_no' => 'MR-'.$row->id,
                    'po_number' => $po_number,
                    'mr_for' => $type,
                    'mr_for_id' => $row->mr_for,
                    'challan_no'=>$row->challan_no,
                    'reference_no'=>$row->reference_no,
                    'note'=>$row->adminnote,
                    'file_count'=>$count_file,
                    'vendor_id' => $row->vendor_id,                    
                    'vendor_name' => value_by_id('tblvendor',$row->vendor_id,'name'),
                    'purchase_order_date' => _d($row->date),
                    'status' => $row->status,
                    'approval_remark' => $approval_remark,
                    'approve_status' => $approve_status
                 );

              foreach ($product_info as $row1) {
                $unit = '--';
                if($row1->unit_id > 0){
                   $unit = value_by_id('tblunitmaster',$row1->unit_id,'name'); 
                }
				$productData['productData'][] =array(
					'product_id' =>$row1->product_id ,
					'product_name' =>value_by_id('tblproducts',$row1->product_id,'sub_name'),
					'hns_code' =>get_hsn_code($row1->product_id),
					'product_qty' =>$row1->qty, 
					'deliver_qty' =>$row1->deliver_qty,
					'product_remark' =>$row1->remark, 
                    'unit_id' =>$row1->unit_id, 
                    'unit' =>$unit, 
				);
            }
          }elseif($row->mr_for == 4){
                $type = 'Delivery Challan';
               $data_arr = array(
                    'id' => $row->id,
                    'mr_no' => 'MR-'.$row->id,
                    'po_number' => '--',
                    'mr_for' => $type,
                    'mr_for_id' => $row->mr_for,
                    'challan_no'=>$row->challan_no,
                    'reference_no'=>$row->reference_no,
                    'note'=>$row->adminnote,
                    'file_count'=>$count_file,
                    'vendor_id' => $row->vendor_id,                    
                    'vendor_name' => value_by_id('tblvendor',$row->vendor_id,'name'),
                    'purchase_order_date' => _d($row->date),
                    'status' => $row->status,
                    'approval_remark' => $approval_remark,
                    'approve_status' => $approve_status
                 );

              foreach ($product_info as $row1) {
                $unit = '--';
                if($row1->unit_id > 0){
                   $unit = value_by_id('tblunitmaster',$row1->unit_id,'name'); 
                }
                
                $productData['productData'][] =array(
                    'product_id' =>$row1->product_id ,
                    'product_name' =>value_by_id('tblproducts',$row1->product_id,'sub_name'),
                    'hns_code' => get_hsn_code($row1->product_id),
                    'product_qty' =>$row1->qty, 
                    'deliver_qty' =>$row1->deliver_qty,
                    'product_remark' =>$row1->remark, 
                    'unit_id' =>$row1->unit_id, 
                    'unit' =>$unit,  
                );
            }
          }

          $return_arr['status'] = true;
          $return_arr['message'] = "Success";
          $return_arr['data'] = array_merge($data_arr,$productData);
      }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Record not found!";
          $return_arr['data'] = null;
      }
      
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($return_arr);
    ////http://localhost/crm/Purchase_API/viewMr?id=4
}

public function getPurchaseOrderNumbers()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        if((!empty($vendor_id))){

        	$po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `vendor_id`='".$vendor_id."' and status = 1 and complete = 0 and show_list = 1")->result();
            if(!empty($po_info)){
              foreach ($po_info as $value) {

                    $data_arr[] = array(
                      'id' => $value->id,
                      'title' => $value->prefix.$value->number.' - '._d($value->date)
                   );
              }

              $return_arr['status'] = true;
              $return_arr['message'] = "Success";
              $return_arr['data'] = $data_arr;
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Record not found!";
                $return_arr['data'] = [];
            }
        }else{
        	$return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are missing";
            $return_arr['data'] = [];
        }
          


        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Purchase_API/getPurchaseOrderNumbers?vendor_id=4

    }

    public function getPurchaseOrderProducts()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        if((!empty($po_id))){

        	$product_info = $this->db->query("SELECT * FROM `tblpurchaseorderproduct` WHERE `po_id`='".$po_id."'")->result();
            if(!empty($product_info)){
              foreach ($product_info as $value) {

              	$qty_info = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` WHERE `po_id`='".$po_id."' and `product_id` = '".$value->product_id."'")->row();
                $bal_qty = ($value->qty-$qty_info->ttl_qty);
                    $data_arr[] = array(
                      'id' => $value->id,
                      'product_id' => $value->product_id,
                      'product_code' => $value->pro_id,
                      'prodcut_name' => $value->product_name,
                      'product_qty' => $value->qty,
                      'balance_qty' => $bal_qty
                   );
              }

              $return_arr['status'] = true;
              $return_arr['message'] = "Success";
              $return_arr['data'] = $data_arr;
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Record not found!";
                $return_arr['data'] = [];
            }
        }else{
        	$return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are missing";
            $return_arr['data'] = [];
        }
          


        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Purchase_API/getPurchaseOrderProducts?po_id=204

    }


  
    
    public function addMr()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($user_id) && !empty($staffid) && !empty($date) && !empty($productData) && !empty($vendor_id) ){
            $assignstaff = json_decode($staffid);
            $productData = json_decode($productData);

            $staff_id = array_unique($assignstaff);

            $staff_str = implode(",",$staff_id);

            $date = db_date($date);



            //Make PO as complete if quantity is match
            if($complete == 1){
              $this->home_model->update('tblpurchaseorder', array('complete'=>1),array('id'=>$post_data['po_number'])); 
            }

           if(!empty($productData)){
                $complete = 1;
                foreach ($productData as $p_row) {
                    $quantity = $p_row->quantity;
                    $p_id = $p_row->product_id;
                    $last_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` WHERE `po_id`='".$po_id."' and `product_id` = '".$p_id."'")->row()->ttl_qty;
                    $mr_qty = ($quantity + $last_qty);

                    $po_qty = $this->db->query("SELECT `qty` FROM `tblpurchaseorderproduct` WHERE `po_id`='".$po_id."' and `product_id` = '".$p_id."'")->row()->qty;

                    if(!empty($po_qty)){
                      if($po_qty > $mr_qty){
                          $complete = 0;                           
                      }  
                    }
                    
                    $this->home_model->update('tblpurchaseorder', array('complete'=>$complete),array('id'=>$po_id));
                }
            } 





            $po_info=$this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$po_id."'")->row_array();

            $ad_data = array(
                  'staff_id' => $user_id,
                  'po_id' => $po_id,
                  'vendor_id' => $vendor_id,
                  'warehouse_id' => $po_info['warehouse_id'],
                  'service_type' => $po_info['service_type'],
                  'date' => $date,
                  'reference_no' => $reference_no,
                  'assignid' => $staff_str,
                  'extrusion' => $extrusion,
                  'adminnote' => $adminnote,                        
                  'challan_no' => $challan_no,                        
                  'mr_for' => 1,                        
                  'created_date' => date('Y-m-d')
            );
            $this->db->insert('tblmaterialreceipt', $ad_data);
            $insert_id = $this->db->insert_id();

            if ($insert_id) {
                foreach ($productData as $p_row) {
                    $itemdata['po_id'] = $po_id;
                    $itemdata['mr_id'] = $insert_id;
                    $itemdata['product_id'] = $p_row->product_id;
                    $itemdata['qty'] = $p_row->quantity;
                    $itemdata['remark'] = $p_row->remark;
                    $this->db->insert('tblmaterialreceiptproduct', $itemdata);
                }

                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['po_id'] = $po_id;
                    $sdata['mr_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblmaterialreceiptapproval', $sdata);

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid'      => $user_id,
                        'module_id' => 4,
                        'description' => 'Material receipt send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/mr_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);     
                  
                }


                if(!empty($_FILES['file']['name'])){
          
                    $filesCount = count($_FILES['file']['name']);
                    for($i = 0; $i < $filesCount; $i++){
                        $_FILES['file']['name']     = $_FILES['file']['name'][$i];
                        $_FILES['file']['type']     = $_FILES['file']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                        $_FILES['file']['error']     = $_FILES['file']['error'][$i];
                        $_FILES['file']['size']     = $_FILES['file']['size'][$i];
                        
                        // File upload configuration
                        $config['upload_path'] = MR_IMAGES_FOLDER;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['encrypt_name'] = TRUE;
                        
                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            // Uploaded file data
                            $fileData = $this->upload->data();


                            $ad_data_1 = array(
                                    'mr_id' => $insert_id,
                                    'file' => $fileData['file_name'],
                                    'created_at' => date('Y-m-d H:i:s')
                                );

                        $this->home_model->insert('tblmaterialreceiptfiles',$ad_data_1);
                        }
                    }
                    
                }

                $return_arr['status'] = true;  
                $return_arr['message'] = "Material Receipt Added Successfully";
                $return_arr['data'] = [];

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Something went wrong!";
                $return_arr['data'] = [];
            }
      


        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Required Parameters are missing";
          $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Purchase_API/addMr?user_id=1&date=31-08-2020&extrusion=0&complete=0&po_id=204&vendor_id=1&reference_no=abc&adminnote=admin_remark&challan_no=CHA0021&staffid=[27,25]&productData=[{"product_id":"2","quantity":"4","remark":"product remark"},{"product_id":"6","quantity":"10","remark":"product remark2"}]
    }



    public function addCashMr()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($user_id) && !empty($staffid) && !empty($date) && !empty($productData) && !empty($vendor_id) ){
            $assignstaff = json_decode($staffid);
            $productData = json_decode($productData);

            $staff_id = array_unique($assignstaff);

            $staff_str = implode(",",$staff_id);

            $date = db_date($date);


            $ad_data = array(
                  'staff_id' => $user_id,
                  'po_id' => 0,
                  'vendor_id' => $vendor_id,
                  'warehouse_id' => $warehouse_id,
                  'service_type' => $service_type,
                  'date' => $date,
                  'reference_no' => $reference_no,
                  'assignid' => $staff_str,
                  'extrusion' => $extrusion,
                  'adminnote' => $adminnote,                        
                  'challan_no' => $challan_no,    
                  'mr_for' => 2,                      
                  'created_date' => date('Y-m-d'),
            );
            $this->db->insert('tblmaterialreceipt', $ad_data);
            $insert_id = $this->db->insert_id();

            if ($insert_id) {
                foreach ($productData as $p_row) {
                    $itemdata['po_id'] = 0;
                    $itemdata['mr_id'] = $insert_id;
                    $itemdata['product_id'] = $p_row->product_id;
                    $itemdata['qty'] = $p_row->quantity;
                    $itemdata['remark'] = $p_row->remark;
                    $this->db->insert('tblmaterialreceiptproduct', $itemdata);
                }

                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['po_id'] = 0;
                    $sdata['mr_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblmaterialreceiptapproval', $sdata);

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid'      => $user_id,
                        'module_id' => 4,
                        'description' => 'Material receipt send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/mr_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);     
                  
                }


                if(!empty($_FILES['file']['name'])){
          
                    $filesCount = count($_FILES['file']['name']);
                    for($i = 0; $i < $filesCount; $i++){
                        $_FILES['file']['name']     = $_FILES['file']['name'][$i];
                        $_FILES['file']['type']     = $_FILES['file']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                        $_FILES['file']['error']     = $_FILES['file']['error'][$i];
                        $_FILES['file']['size']     = $_FILES['file']['size'][$i];
                        
                        // File upload configuration
                        $config['upload_path'] = MR_IMAGES_FOLDER;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['encrypt_name'] = TRUE;
                        
                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            // Uploaded file data
                            $fileData = $this->upload->data();


                            $ad_data_1 = array(
                                    'mr_id' => $insert_id,
                                    'file' => $fileData['file_name'],
                                    'created_at' => date('Y-m-d H:i:s')
                                );

                        $this->home_model->insert('tblmaterialreceiptfiles',$ad_data_1);
                        }
                    }
                    
                }

                $return_arr['status'] = true;  
                $return_arr['message'] = "Material Receipt Added Successfully";
                $return_arr['data'] = [];

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Something went wrong!";
                $return_arr['data'] = [];
            }     


        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Required Parameters are missing";
          $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Purchase_API/addCashMr?user_id=1&warehouse_id=1&service_type=1&date=31-08-2020&extrusion=0&vendor_id=1&reference_no=abc&adminnote=admin_remark&challan_no=CHA0021&staffid=[27,25]&productData=[{"product_id":"2","quantity":"4","remark":"product remark"},{"product_id":"6","quantity":"10","remark":"product remark2"}]
    }


    public function addGasMr()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($user_id) && !empty($staffid) && !empty($date) && !empty($vendor_id) ){
            $assignstaff = json_decode($staffid);

            $staff_id = array_unique($assignstaff);

            $staff_str = implode(",",$staff_id);

            $date = db_date($date);


            $ad_data = array(
                  'staff_id' => $user_id,
                  'po_id' => 0,
                  'vendor_id' => $vendor_id,
                  'date' => $date,
                  'reference_no' => $reference_no,
                  'assignid' => $staff_str,
                  'adminnote' => $adminnote,                        
                  'challan_no' => $challan_no,    
                  'mr_for' => 3,                      
                  'created_date' => date('Y-m-d'),
            );
            $this->db->insert('tblmaterialreceipt', $ad_data);
            $insert_id = $this->db->insert_id();

            if ($insert_id) {

                $wpdata['mr_id']=$insert_id;
                $wpdata['po_id']=0;
                $wpdata['product_id']=$product_id;
                $wpdata['remark']=$remark;
                $wpdata['qty']=$receive_qty;
                $wpdata['deliver_qty']=$deliver_qty;
                $this->db->insert('tblmaterialreceiptproduct', $wpdata);

                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['po_id'] = 0;
                    $sdata['mr_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblmaterialreceiptapproval', $sdata);

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid'      => $user_id,
                        'module_id' => 4,
                        'description' => 'Material receipt send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/mr_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);     
                  
                }


                if(!empty($_FILES['file']['name'])){
          
                    $filesCount = count($_FILES['file']['name']);
                    for($i = 0; $i < $filesCount; $i++){
                        $_FILES['file']['name']     = $_FILES['file']['name'][$i];
                        $_FILES['file']['type']     = $_FILES['file']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                        $_FILES['file']['error']     = $_FILES['file']['error'][$i];
                        $_FILES['file']['size']     = $_FILES['file']['size'][$i];
                        
                        // File upload configuration
                        $config['upload_path'] = MR_IMAGES_FOLDER;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['encrypt_name'] = TRUE;
                        
                        // Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        
                        // Upload file to server
                        if($this->upload->do_upload('file')){
                            // Uploaded file data
                            $fileData = $this->upload->data();


                            $ad_data_1 = array(
                                    'mr_id' => $insert_id,
                                    'file' => $fileData['file_name'],
                                    'created_at' => date('Y-m-d H:i:s')
                                );

                        $this->home_model->insert('tblmaterialreceiptfiles',$ad_data_1);
                        }
                    }
                    
                }

                $return_arr['status'] = true;  
                $return_arr['message'] = "Material Receipt Added Successfully";
                $return_arr['data'] = [];

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Something went wrong!";
                $return_arr['data'] = [];
            }     


        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Required Parameters are missing";
          $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Purchase_API/addGasMr?user_id=1&date=31-08-2020&vendor_id=1&reference_no=abc&adminnote=admin_remark&product_id=12&receive_qty=4&deliver_qty=2&remark=product remark&challan_no=CHA0021&staffid=[27,25]
    }


    //create by gopal
   public function getMrfile()
   {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        
        if(!empty($id))
        {
           $file_list = $this->db->query("SELECT * from tblmaterialreceiptfiles  where mr_id='".$id."' order by id desc")->result();

            if($file_list){
                foreach ($file_list as $row){
                  $data_arr[] = array(
                      'id' => $row->id,
                      'file_name' => $row->file,
                      'file_path' => base_url('uploads/material_receipt/'.$row->file),
                      'rel_id'=>$id
                      
                  );
                  $return_arr['file_list'] = $data_arr;
                } 
            }else{
              $return_arr['file_list'] = [];
            }

        }else{
          $return_arr['file_list'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://localhost/crm/Purchase_API/getMrfile?id=95
    } 
    
    public function getPendingAgainstPo()
    {
       $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        $where = "status = 1 and complete = 0 and show_list = 1";

        if($vendor_id != ''){
              $where .= " and vendor_id = '".$vendor_id."' ";
              $po_list = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE ".$where." order by id desc")->result();
          }
        $po_list = $this->db->query("SELECT * FROM `tblpurchaseorder` WHERE ".$where." order by id desc")->result();
       if((!empty($po_list))){
         foreach ($po_list as $row) { 

                 $data_arr[] = array(
                      'id' => $row->id,
                      'po_number' => $row->prefix.$row->number,
                      'vendor_name' => value_by_id('tblvendor',$row->vendor_id,'name'),
                      'vendor_id' => $row->vendor_id,
                      'warehouse' => (!empty($row->warehouse_id)) ? value_by_id('tblwarehouse',$row->warehouse_id,'name') : "",
                      'po_date' => _d($row->date)
                   );

          }

         $return_arr['status'] = true;
         $return_arr['message'] = "Success";
         $return_arr['data'] = $data_arr;
        }
        else
        {
          $return_arr['status'] = false;  
            $return_arr['message'] = "Record not found!";
            $return_arr['data'] = [];
        }

          header('Content-type: application/json');
          echo json_encode($return_arr);
          //http://mustafa-pc/crm/Purchase_API/getPendingAgainstPo?vendor_id=4

    }

}

