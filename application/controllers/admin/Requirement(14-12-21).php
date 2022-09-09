<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Requirement extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {

        check_permission(36,'view');

        if(is_admin() == 1){
        	$data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement order by id desc ")->result(); 
        }else{
        	$data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement where staff_id = '".get_staff_user_id()."' order by id desc ")->result(); 
        }


         $running_data[] = array(
                'id' => 1,
                'name' => 'Created'              
             );
        $running_data[] = array(
                'id' => 0,
                'name' => 'Not Created'              
             );

        /*echo '<pre/>';
        print_r($running_data);
        die;*/
        $data['running_data'] = $running_data;
               
       
        $data['title'] = 'Requirement List (SEPL/ST/02)';
        $this->load->view('admin/requirement/requirement', $data);

    }

    public function add($id="")
    {
        check_permission(36,'create');
        $data['product_info']  = $this->db->query("SELECT * FROM tblproducts WHERE status =  '1' order by name asc ")->result();

        if(!empty($_POST)){
            extract($this->input->post());
            $assignstaff=$assign['assignid'];
            $staff_id = array();
            foreach($assignstaff as $s_id)
            {
               if($s_id > 0){
                $staff_id[]=$s_id;
               }     
               
            }
            $staff_id=array_unique($staff_id);


            /*echo '<pre/>';
            print_r($_POST);            
            print_r($_FILES);
            die;*/

            $ad_data = array(                            
                'staff_id' => get_staff_user_id(),
                'billing_branch_id' => get_login_branch(),
                'remark' => $remarks,
                'created_at' => date('Y-m-d H:i:s')
            );                   
                    
                    
            $insert = $this->home_model->insert('tblrequirement', $ad_data);  

            if($insert){
                $req_id = $this->db->insert_id();

                if(!empty($staff_id)){
                    foreach ($staff_id as $staffid) {

                        $ad_field = array(
                            'staff_id' => $staffid,                        
                            'req_id' => $req_id,                        
                            'status' => 1,                        
                            'approve_status' => 0,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblrequirement_approval',$ad_field);

                        $message = 'Product Requirement send you for purchase';
                     
                            /*$notified = add_notification([
                                'description'     => $message,
                                'touserid'        => $staffid,
                                'module_id'       => 14,
                                'table_id'        => $req_id,
                                'fromuserid'      => get_staff_user_id(),
                                'link'            => 'requirement/purchase_process/'.$req_id,
                               
                            ]);
                            if ($notified) {
                                pusher_trigger_notification([$staffid]);
                            }*/

                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 7,
                                'table_id' => $req_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'requirement/purchase_process/'.$req_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );  
                            $this->db->insert('tblmasterapproval', $adata);
                            
                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }

                if(!empty($componnetdata)){
                    foreach ($componnetdata as $key => $row) {
                        
                        $product_info  = $this->db->query("SELECT * FROM tblproducts WHERE name =  '".$row['product_name']."' ")->row();  
                        if(!empty($product_info)){
                            $product_id = $product_info->id;                            
                        }else{
                            $product_id = 0;
                        }  

                        //Product
                        $data_1 = array(                            
                            'req_id' => $req_id,
                            'product_name' => $row['product_name'],
                            'quantity' => $row['quantity'],
                            'product_id' => $product_id,
                            'remark' => $row['remarks']
                        );                   
                                                           
                        $product_insert = $this->home_model->insert('tblrequirement_products', $data_1); 

                        if($product_insert){
                            $reqpro_id = $this->db->insert_id();

                            //Product Image
                            if(!empty($_FILES['images_'.$key])){
                                  $count = count($_FILES['images_'.$key]['name']);

                                  for($i=0;$i<$count;$i++){    

                                    if(!empty($_FILES['images_'.$key]['name'][$i])){

                                      $_FILES['file']['name'] = $_FILES['images_'.$key]['name'][$i];
                                      $_FILES['file']['type'] = $_FILES['images_'.$key]['type'][$i];
                                      $_FILES['file']['tmp_name'] = $_FILES['images_'.$key]['tmp_name'][$i];
                                      $_FILES['file']['error'] = $_FILES['images_'.$key]['error'][$i];
                                      $_FILES['file']['size'] = $_FILES['images_'.$key]['size'][$i];

                                      $config['upload_path'] = REQUIREMENT_ATTACHMENTS_FOLDER;
                                      $config['allowed_types'] = 'jpg|JPG|PNG|GIF|jpeg|gif|png';
                                     // $config['max_size'] = '2048570';
                                      $config['encrypt_name'] =TRUE;
                                      $config['file_name'] = $_FILES['images_'.$key]['name'][$i];   

                                      $this->load->library('upload',$config); 
                                

                                      if($this->upload->do_upload('file')){
                                        $uploadData = $this->upload->data();
                                        $filename = $uploadData['file_name'];
                                        
                                        $ad_img = array(
                                            'req_id' => $req_id,                        
                                            'reqpro_id' => $reqpro_id,                        
                                            'image' => $filename
                                        );
                                        $this->home_model->insert('tblrequirement_productimages',$ad_img);
                                      }

                                    }

                                  }
                            }

                            //Product Custom Fields
                            if(!empty($customdata['product_field_'.$key])){
                                foreach ($customdata['product_field_'.$key] as $r => $field) {
                                    $field_name = $field;

                                    if(!empty($customdata['product_value_'.$key][$r])){
                                        $product_value = $customdata['product_value_'.$key][$r];
                                    }else{
                                        $product_value = '';
                                    }

                                    if(!empty($customdata['product_remark_'.$key][$r])){
                                        $product_remark = $customdata['product_remark_'.$key][$r];
                                    }else{
                                        $product_remark = '';
                                    }



                                    $field_name = $field;

                                    $ad_field = array(
                                        'staff_id' => get_staff_user_id(),                        
                                        'req_id' => $req_id,                        
                                        'reqpro_id' => $reqpro_id,                        
                                        'field' => $field,
                                        'value' => $product_value,
                                        'remark' => $product_remark,
                                    );
                                    $this->home_model->insert('tblrequirement_productfields',$ad_field);
                                }
                            }

                        }

                    }
                }

            
                set_alert('success', 'New Requirement added Successfully');
                redirect(admin_url('requirement'));
            }
        }


        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        $data['title'] = 'Add Requirement';

        
        $this->load->view('admin/requirement/add_requirement', $data);

    }


    public function process_list()
    {

        check_permission(37,'view');
        
        $where = "ra.staff_id = '". get_staff_user_id()."' ";
        /*if(!empty($_POST)){
            extract($this->input->post());

        }*/
        if(is_admin() == 1){
        	$data['requirement_info']  = $this->db->query("SELECT r.*,ra.approve_status FROM `tblrequirement` as r LEFT JOIN tblrequirement_approval as ra ON r.id = ra.req_id where r.cancel = 0 group by r.id Order by r.id desc  ")->result();
        }else{
        	$data['requirement_info']  = $this->db->query("SELECT r.*,ra.approve_status FROM `tblrequirement` as r LEFT JOIN tblrequirement_approval as ra ON r.id = ra.req_id where ".$where." and r.cancel = 0 group by r.id Order by r.id desc  ")->result();
        }
        

        $data['title'] = 'Purchase Process List';
        $this->load->view('admin/requirement/process_list', $data);

    }


    public function purchase_process($id)
    {
        
    	$approval_send  = $this->db->query("SELECT id FROM tblrequirementprocess_approval where req_id = '".$id."'  ")->row();

    	if(!empty($approval_send)){
    		set_alert('warning', 'Action already taken!');
            redirect(admin_url('requirement/process_list'));	
    	}

        $data['vendor_info']  = $this->db->query("SELECT * FROM tblvendor WHERE status =  '1' order by name asc ")->result();

        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$id."' ")->result();

        $data['id'] = $id;


        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        $data['title'] = 'Purchase Process';
        $this->load->view('admin/requirement/purchase_process', $data);

    }

    public function purchase_process_action($id="")
    {

        if(!empty($_POST)){
            extract($this->input->post());

            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            $assignstaff=$assign['assignid'];
            $staff_id = array();
            if(!empty($assignstaff)){
            	foreach($assignstaff as $s_id)
	            {
	               if($s_id > 0){
	                $staff_id[]=$s_id;
	               }     
	               
	            }
            }
            
            $staff_id=array_unique($staff_id);

            if(!empty($staff_id)){
                update_masterapproval_single(get_staff_user_id(),7,$req_id,1);
                update_masterapproval_all(7,$req_id,1);
                foreach ($staff_id as $staffid) {

                    $ad_field = array(
                        'staff_id' => $staffid,                        
                        'req_id' => $req_id,                        
                        'status' => 1,                        
                        'approve_status' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->home_model->insert('tblrequirementprocess_approval',$ad_field);

                    $message = 'Purchase product vendors send you for approval';
                 
                        /*$notified = add_notification([
                            'description'     => $message,
                            'touserid'        => $staffid,
                            'module_id'       => 14,
                            'table_id'        => $req_id,
                            'fromuserid'      => get_staff_user_id(),
                            'link'            => 'requirement/purchase_process_approval/'.$req_id,
                           
                        ]);
                        if ($notified) {
                            pusher_trigger_notification([$staffid]);
                        }*/

                        $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 7,
                                'table_id' => $req_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'requirement/purchase_process_approval/'.$req_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );  
                        $this->db->insert('tblmasterapproval', $adata);
                        
                        //Sending Mobile Intimation
                        $token = get_staff_token($staffid);
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }

                $this->home_model->update('tblrequirement',array('purchase_person_status'=>1),array('id'=>$req_id)); 
                
            }


            $this->home_model->delete('tblrequirement_productvendors', array('req_id'=>$req_id)); 

            $requirement_products  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$req_id."' ")->result();
            foreach ($requirement_products as $row) {


                if(!empty($_POST['vendor_'.$row->id])){
                    foreach ($_POST['vendor_'.$row->id] as $key => $vendor_name) {
                        $vendor_info  = $this->db->query("SELECT * FROM tblvendor WHERE name =  '".$vendor_name."' ")->row();  
                        if(!empty($vendor_info)){
                            $vendor_id = $vendor_info->id;                            
                        }else{
                            $vendor_id = 0;
                        }

                        $rate =  $_POST['rate_'.$row->id][$key];  
                        $remark =  $_POST['vendorremark_'.$row->id][$key];  
                        $tax =  $_POST['tax_'.$row->id][$key];  
                      
                         $data_1 = array(                            
                            'staff_id' => get_staff_user_id(),
                            'req_id' => $req_id,
                            'reqpro_id' => $row->id,
                            'vendor_name' => $vendor_name,
                            'vendor_id' => $vendor_id,
                            'rate' => $rate,
                            'tax' => $tax,
                            'remark' => $remark,
                            'created_at' => date('Y-m-d')
                        );                   
                                                           
                        $vendor_insert = $this->home_model->insert('tblrequirement_productvendors', $data_1); 

                    }
                }


                //Product Custom Fields
                if(!empty($customdata['product_field_'.$row->id])){
                    foreach ($customdata['product_field_'.$row->id] as $r => $field) {
                       
                        if(!empty($customdata['product_value_'.$row->id][$r])){
                            $product_value = $customdata['product_value_'.$row->id][$r];
                        }else{
                            $product_value = '';
                        }

                        if(!empty($customdata['product_remark_'.$row->id][$r])){
                            $product_remark = $customdata['product_remark_'.$row->id][$r];
                        }else{
                            $product_remark = '';
                        }

                        if(!empty($customdata['product_pp_remark_'.$row->id][$r])){
                            $pp_remark = $customdata['product_pp_remark_'.$row->id][$r];
                        }else{
                            $pp_remark = '';
                        }

                        if(!empty($customdata['product_vendor_remark_'.$row->id][$r])){
                            $vendor_remark = $customdata['product_vendor_remark_'.$row->id][$r];
                        }else{
                            $vendor_remark = '';
                        }

                        $exist_info  = $this->db->query("SELECT * FROM tblrequirement_productfields WHERE req_id =  '".$req_id."' and reqpro_id = '".$row->id."' and field = '".$field."' and value = '".$product_value."' ")->row();   

                        if(!empty($exist_info)){
                            $up_field = array(                               
                                'pp_remark' => $pp_remark,
                                'vendor_remark' => $vendor_remark
                            );
                            $this->home_model->update('tblrequirement_productfields',$up_field,array('id'=>$exist_info->id));
                        }else{
                            $ad_field = array(
                                'staff_id' => get_staff_user_id(),                        
                                'req_id' => $req_id,                        
                                'reqpro_id' => $row->id,                        
                                'field' => $field,
                                'value' => $product_value,
                                'remark' => $product_remark,
                                'pp_remark' => $pp_remark,
                                'vendor_remark' => $vendor_remark
                            );
                            $this->home_model->insert('tblrequirement_productfields',$ad_field);
                        }    

                        
                    }
                }

            }
            set_alert('success', 'Product vendor added Successfully');
            redirect(admin_url('requirement/process_list'));
            
        }


    }


    public function approval_list()
    {
        check_permission(38,'view');
        $where = "ra.staff_id = '". get_staff_user_id()."' ";
        if(!empty($_POST)){
            extract($this->input->post());

        }

        if(is_admin() == 1){
        	$data['requirement_info']  = $this->db->query("SELECT r.* FROM `tblrequirement` as r LEFT JOIN tblrequirementprocess_approval as ra ON r.id = ra.req_id where r.cancel = 0 GROUP by r.id order by r.id desc ")->result();
        }else{
        	$data['requirement_info']  = $this->db->query("SELECT r.* FROM `tblrequirement` as r LEFT JOIN tblrequirementprocess_approval as ra ON r.id = ra.req_id where ".$where." and r.cancel = 0 GROUP by r.id order by r.id desc ")->result();
        }

        $data['title'] = 'Purchase Vendor Approval';
        $this->load->view('admin/requirement/approval_list', $data);

    }


    public function purchase_process_approval($id)
    {
        $info  = $this->db->query("SELECT * FROM tblrequirement where id = '".$id."'  ")->row();

    	/*if($info->approve_status == 1){
    		set_alert('warning', 'Action already taken!');
            redirect(admin_url('requirement/approval_list'));	
    	}*/

        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$id."' ")->result();

        $data['id'] = $id;
        $data['title'] = 'Purchase Process';
        $this->load->view('admin/requirement/purchase_process_approval', $data);

    }

    public function purchase_process_approval_action()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            $atLeastOneApproval = 0;
            if(!empty($row)){
            	$this->home_model->update('tblrequirement',array('approve_status'=>1),array('id'=>$req_id)); 
            	foreach ($row as $r) {
	            	if(!empty($_POST['approve_'.$r])){
	            		$approve = 1;
                        $atLeastOneApproval = 1;
	            	}else{
	            		$approve = 2;
	            	}

					$this->home_model->update('tblrequirement_productvendors',array('approve'=>$approve),array('id'=>$r));            	
	            }

                if($atLeastOneApproval == 1){
                    $f_approval = 1;
                }else{
                    $f_approval = 2;
                }
                update_masterapproval_single(get_staff_user_id(),7,$req_id,$f_approval);
                update_masterapproval_all(7,$req_id,$f_approval);

	            set_alert('success', 'Record updated Successfully');
            	redirect(admin_url('requirement/approval_list'));
            }
            
        }

    }


    public function requirement_process_view($id)
    {
        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$id."' ")->result();
        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE id =  '".$id."' ")->row();

        $data['id'] = $id;
        $data['title'] = 'Purchase Process';
        $this->load->view('admin/requirement/requirement_process_view', $data);

    }



    public function requirement_delete($id)
    {
        
        $response = $this->home_model->delete('tblrequirement', array('id'=>$id));
        if ($response == true) {
        	$this->home_model->delete('tblrequirement_approval', array('req_id'=>$id));
        	$this->home_model->delete('tblrequirement_products', array('req_id'=>$id));
        	$this->home_model->delete('tblrequirement_productimages', array('req_id'=>$id));
        	$this->home_model->delete('tblrequirement_productfields', array('req_id'=>$id));
        	$this->home_model->delete('tblnotifications', array('table_id'=>$id, 'module_id' => 14));
            $this->home_model->delete('tblmasterapproval', array('table_id'=>$id, 'module_id' => 7));
            set_alert('success', _l('deleted', 'requirement'));
        } else {
            set_alert('warning', _l('problem_deleting', 'requirement'));
        }
        redirect(admin_url('requirement'));
    }


    public function cancel_requirement()
    {
        if(!empty($_POST)){
            extract($this->input->post());

           $response = $this->home_model->update('tblrequirement',array('cancel_remark'=>$cancel_remark, 'cancel'=>1),array('id'=>$id)); 
           if ($response) {
           		$this->home_model->delete('tblnotifications', array('table_id'=>$id, 'module_id' => 14));
                $this->home_model->delete('tblmasterapproval', array('table_id'=>$id, 'module_id' => 7));
           		set_alert('success', 'Requirement cancelled');
           		redirect(admin_url('requirement'));
           }

        }

    }

    public function update_po_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());
            $update_data = array(
                'po_status' => $status
            );
            
            $this->home_model->update('tblrequirement',$update_data,array('id'=>$id));
        }
    }


   
}
