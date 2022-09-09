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
        $where = "save=0 ";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($department_id)){
                $data['sdepartment_id'] = $department_id;
                $where .= " and department_id = '".$department_id."'";
            }
        }
        /*if(is_admin() == 1){
        	$data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE $where order by id desc ")->result();
        }else{
        	$data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement where $where and staff_id = '".get_staff_user_id()."' order by id desc ")->result();
        }*/
        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE $where order by id desc ")->result();

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
        $data['department_list'] = $this->db->query("SELECT * FROM `tbldepartmentsmaster` WHERE `status`=1")->result();
        $this->load->view('admin/requirement/requirement', $data);

    }

    public function add($id="")
    {
        check_permission(36,'create');
        $data['product_info']  = $this->db->query("SELECT * FROM tblproducts WHERE status =  '1' order by name asc ")->result();

        if(!empty($_POST)){
            extract($this->input->post());

            // echo "<pre>";
            // print_r($_POST);
            // exit;
            $assignstaff=$assign['assignid'];
            $staff_id = array();
            foreach($assignstaff as $s_id)
            {
               if($s_id > 0){
                  $staff_id[]=$s_id;
               }
            }
            $staff_id=array_unique($staff_id);

            $approvalstaff=$approvalstaff['assign'];
            $approval_staff_id = array();
            foreach($approvalstaff as $s_id)
            {
               if($s_id > 0){
                  $approval_staff_id[]=$s_id;
               }
            }
            $approval_staff_id=array_unique($approval_staff_id);

            if(!empty($save) && $save == 1){
                $save = 1;
                $staff_id = [];
                $approval_staff_id = [];
            }else{
                $save = 0;
            }

            if (isset($sendapprovalbtn) && empty($approval_staff_id)){
                set_alert('warning', 'Please select approval parson');
                redirect(admin_url('requirement/add'));
            }

            $directsubmit = (!empty($directsubmit) && $directsubmit == 1) ? 1 : 0;
            $reason_for_request = (isset($reason_for_request) && !empty($reason_for_request)) ? $reason_for_request : 0;
            $estimate_id = (isset($estimate_id) && !empty($estimate_id) && $reason_for_request == 1) ? $estimate_id : 0;
            $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'billing_branch_id' => get_login_branch(),
                'remark' => $remarks,
                'department_id' => $department_id,
                'save' => $save,
                'initial_approve_status' => 0,
                'reason_for_request' => $reason_for_request,
                'estimate_id' => $estimate_id,
                'created_at' => date('Y-m-d H:i:s')
            );
            if(!empty($save_id)){
               $insert = $this->home_model->update('tblrequirement', $ad_data,array('id'=>$save_id));
            }else{
               $insert = $this->home_model->insert('tblrequirement', $ad_data);
            }
            if($insert){

                if(!empty($save_id)){
                    $this->home_model->delete('tblrequirement_products', array('req_id'=>$save_id));
                    $files_data = $this->db->query("SELECT * FROM `tblrequirement_productimages` WHERE `req_id`='".$save_id."' ")->result();
                    if (!empty($files_data)){
                       foreach ($files_data as $file) {
                           $response = $this->home_model->delete("tblrequirement_productimages", array("id" => $file->id));
                           if ($response == true) {
                              $path = REQUIREMENT_ATTACHMENTS_FOLDER.$file->image;
                              unset($path);
                           }
                       }
                    }
                    $req_id = $save_id;
                }else{
                    $req_id = $this->db->insert_id();
                }
                if ($save == 0){
                    /* assign to staff code */
                    if(!empty($staff_id)){
                        foreach ($staff_id as $staffid) {
                            /* this code use for delete old requirement approval data */
                            $this->home_model->delete("tblrequirement_approval", array("req_id" => $req_id));

                            $ad_field = array(
                                'staff_id' => $staffid,
                                'req_id' => $req_id,
                                'type' => 1,
                                'status' => 1,
                                'approve_status' => 0,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->home_model->insert('tblrequirement_approval',$ad_field);

                            if ($directsubmit == 1 && empty($approval_staff_id)){

                                $message = 'Product Requirement send you for purchase';
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

                                /* this is a requirement initial approved */
                                $this->home_model->update("tblrequirement", array("initial_approve_status" => 1), array("id" => $req_id));

                                //Sending Mobile Intimation
                                $token = get_staff_token($staffid);
                                $title = 'Schach';
                                $send_intimation = sendFCM($message, $title, $token, $page = 2);
                            }
                        }
                    }

                    /* send for approval page */
                    if(!empty($approval_staff_id)){
                        foreach ($approval_staff_id as $astaffid) {

                            $ad_field = array(
                                'staff_id' => $astaffid,
                                'req_id' => $req_id,
                                'type' => 2,
                                'status' => 1,
                                'approve_status' => 0,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->home_model->insert('tblrequirement_approval',$ad_field);

                            // $message = 'Product Requirement send you for purchase';
                            $message = 'Requirement send you for Approval';

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
                                    'staff_id' => $astaffid,
                                    'fromuserid'      => get_staff_user_id(),
                                    'module_id' => 44,
                                    'table_id' => $req_id,
                                    'approve_status' => 0,
                                    'status' => 0,
                                    'description'     => $message,
                                    'link' => 'requirement/requirment_approval/'.$req_id,
                                    'date' => date('Y-m-d'),
                                    'date_time' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                );
                                $this->db->insert('tblmasterapproval', $adata);

                                //Sending Mobile Intimation
                                $token = get_staff_token($astaffid);
                                $title = 'Schach';
                                $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }
                }

                if(!empty($componnetdata)){
                    foreach ($componnetdata as $key => $row) {

                        $product_sname = htmlspecialchars($row['product_name'], ENT_QUOTES);
                        $product_info  = $this->db->query("SELECT * FROM tblproducts WHERE sub_name =  '".$product_sname."' ")->row();

                        $product_id = (!empty($product_info)) ? $product_info->id : 0;

                        //Product
                        $data_1 = array(
                            'req_id' => $req_id,
                            'product_name' => $product_sname,
                            'quantity' => $row['quantity'],
                            'unit' => $row['unit'],
                            'product_id' => $product_id,
                            'remark' => $row['remarks']
                        );

                        $product_insert = $this->home_model->insert('tblrequirement_products', $data_1);
                        if($product_insert){

                            $reqpro_id = $this->db->insert_id();

                            if (isset($row['image']) && !empty($row['image'])){
                                foreach ($row['image'] as $img) {
                                    $ad_img = array(
                                        'req_id' => $req_id,
                                        'reqpro_id' => $reqpro_id,
                                        'image' => $img
                                    );
                                    $this->home_model->insert('tblrequirement_productimages',$ad_img);
                                }
                            }
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
                            // if(!empty($customdata['product_field_'.$key])){
                            //     foreach ($customdata['product_field_'.$key] as $r => $field) {
                            //         $field_name = $field;
                            //
                            //         if(!empty($customdata['product_value_'.$key][$r])){
                            //             $product_value = $customdata['product_value_'.$key][$r];
                            //         }else{
                            //             $product_value = '';
                            //         }
                            //
                            //         if(!empty($customdata['product_remark_'.$key][$r])){
                            //             $product_remark = $customdata['product_remark_'.$key][$r];
                            //         }else{
                            //             $product_remark = '';
                            //         }
                            //
                            //
                            //
                            //         $field_name = $field;
                            //
                            //         $ad_field = array(
                            //             'staff_id' => get_staff_user_id(),
                            //             'req_id' => $req_id,
                            //             'reqpro_id' => $reqpro_id,
                            //             'field' => $field,
                            //             'value' => $product_value,
                            //             'remark' => $product_remark,
                            //         );
                            //         $this->home_model->insert('tblrequirement_productfields',$ad_field);
                            //     }
                            // }

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
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;
        
        $data['unit_list'] = $this->db->query("SELECT * FROM `tblunitmaster` WHERE status = 1 ORDER BY name ASC")->result();
        if ($id != ""){
            $data['title'] = 'Edit Purchase Requirement';
            $data['save_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE id = '".$id."' order by id desc ")->row();
        }else{
            $data['title'] = 'Add Purchase Requirement';
            $data['save_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE save = 1 and staff_id='".get_staff_user_id()."' order by id desc ")->row();
        }
        if(!empty($data['save_info'])){
            $data['save_products_info']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id = '".$data['save_info']->id."'")->result();
        }
        $data['department_list'] = $this->db->query("SELECT * FROM `tbldepartmentsmaster` WHERE `status`=1 ORDER BY name ASC")->result();
        $data['estimate_list'] = $this->db->query("SELECT e.id, e.number, e.clientid FROM `tblconfirmorder` as c RIGHT JOIN `tblestimates` as e  ON e.id = c.estimate_id WHERE c.branch_id=".get_login_branch()." and c.complete_status = 0 ORDER BY c.id DESC")->result();

        $this->load->view('admin/requirement/add_requirement', $data);
    }


    public function process_list()
    {
        check_permission(37,'view');
        $where = "r.id > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());
            if (!empty($f_date) && !empty($t_date)) {
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and DATE(r.created_at) between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
            }
        }
        if(is_admin() == 1){
        	$data['requirement_info']  = $this->db->query("SELECT r.*,ra.approve_status as approvalstatus FROM `tblrequirement` as r LEFT JOIN tblrequirement_approval as ra ON r.id = ra.req_id where ".$where." and r.cancel = 0 and r.initial_approve_status = 1 and r.approve_status != 1 group by r.id Order by r.id desc  ")->result();
        }else{
        	$data['requirement_info']  = $this->db->query("SELECT r.*,ra.approve_status as approvalstatus FROM `tblrequirement` as r LEFT JOIN tblrequirement_approval as ra ON r.id = ra.req_id where ".$where." and r.cancel = 0 and r.initial_approve_status = 1 and r.approve_status != 1 and ra.staff_id = '". get_staff_user_id()."' group by r.id Order by r.id desc  ")->result();
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

        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE id =  '".$id."' ")->row();
        $data['vendor_info']  = $this->db->query("SELECT * FROM tblvendor WHERE status =  '1' order by name asc ")->result();
        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$id."' ")->result();
        $data['unit_list']  = $this->db->query("SELECT * FROM tblunitmaster WHERE status = 1 ")->result();

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
        $data['section'] = 'create';
        $this->load->view('admin/requirement/purchase_process', $data);
    }

    public function purchase_process_action($id="")
    {

        if(!empty($_POST)){
            extract($this->input->post());

            /* echo '<pre/>';
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
            if (isset($save) && $save == 1){
               $save = 1;
            }else{
               $save = 0;
            }
            if ($save == 0){
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
            }

            $this->home_model->delete('tblrequirement_productvendors', array('req_id'=>$req_id));
            $requirement_products  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$req_id."' ")->result();
            foreach ($requirement_products as $row) {

                if(!empty($_POST['vendor_'.$row->id])){
                    foreach ($_POST['vendor_'.$row->id] as $key => $vendor_name) {
                        $vendor_info  = $this->db->query("SELECT * FROM tblvendor WHERE name =  '".$vendor_name."' ")->row();
                        $vendor_id = (!empty($vendor_info)) ? $vendor_info->id : 0;

                        $rate =  $_POST['rate_'.$row->id][$key];
                        $unit_id =  $_POST['unit_id_'.$row->id][$key];
                        $remark =  $_POST['vendorremark_'.$row->id][$key];
                        $tax =  $_POST['tax_'.$row->id][$key];

                         $data_1 = array(
                            'staff_id' => get_staff_user_id(),
                            'req_id' => $req_id,
                            'reqpro_id' => $row->id,
                            'vendor_name' => $vendor_name,
                            'vendor_id' => $vendor_id,
                            'unit_id' => $unit_id,
                            'rate' => $rate,
                            'tax' => $tax,
                            'remark' => $remark,
                            'save' => $save,
                            'created_at' => date('Y-m-d')
                        );

                        $vendor_insert = $this->home_model->insert('tblrequirement_productvendors', $data_1);
                    }
                }

                // //Product Custom Fields
                // if(!empty($customdata['product_field_'.$row->id])){
                //     foreach ($customdata['product_field_'.$row->id] as $r => $field) {
                //
                //         if(!empty($customdata['product_value_'.$row->id][$r])){
                //             $product_value = $customdata['product_value_'.$row->id][$r];
                //         }else{
                //             $product_value = '';
                //         }
                //
                //         if(!empty($customdata['product_remark_'.$row->id][$r])){
                //             $product_remark = $customdata['product_remark_'.$row->id][$r];
                //         }else{
                //             $product_remark = '';
                //         }
                //
                //         if(!empty($customdata['product_pp_remark_'.$row->id][$r])){
                //             $pp_remark = $customdata['product_pp_remark_'.$row->id][$r];
                //         }else{
                //             $pp_remark = '';
                //         }
                //
                //         if(!empty($customdata['product_vendor_remark_'.$row->id][$r])){
                //             $vendor_remark = $customdata['product_vendor_remark_'.$row->id][$r];
                //         }else{
                //             $vendor_remark = '';
                //         }
                //
                //         $exist_info  = $this->db->query("SELECT * FROM tblrequirement_productfields WHERE req_id =  '".$req_id."' and reqpro_id = '".$row->id."' and field = '".$field."' and value = '".$product_value."' ")->row();
                //
                //         if(!empty($exist_info)){
                //             $up_field = array(
                //                 'pp_remark' => $pp_remark,
                //                 'vendor_remark' => $vendor_remark
                //             );
                //             $this->home_model->update('tblrequirement_productfields',$up_field,array('id'=>$exist_info->id));
                //         }else{
                //             $ad_field = array(
                //                 'staff_id' => get_staff_user_id(),
                //                 'req_id' => $req_id,
                //                 'reqpro_id' => $row->id,
                //                 'field' => $field,
                //                 'value' => $product_value,
                //                 'remark' => $product_remark,
                //                 'pp_remark' => $pp_remark,
                //                 'vendor_remark' => $vendor_remark
                //             );
                //             $this->home_model->insert('tblrequirement_productfields',$ad_field);
                //         }
                //     }
                // }
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
        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement where id = '".$id."'  ")->row();

    	/*if($info->approve_status == 1){
    		set_alert('warning', 'Action already taken!');
            redirect(admin_url('requirement/approval_list'));
    	}*/

        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$id."' ")->result();

        $data['id'] = $id;
        $data['title'] = 'Purchase Process';
        $data['section'] = 'approval';
        $this->load->view('admin/requirement/purchase_process_approval', $data);

    }

    public function purchase_process_approval_action()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            // echo '<pre/>';
            // print_r($_POST);
            // die;
            $atLeastOneApproval = 0;
            if(!empty($row)){


                    foreach ($row as $r) {
        	            	if(!empty($_POST['approve_'.$r])){
          	            		$approve = 1;
                            $atLeastOneApproval = 1;
        	            	}else{
        	            		   $approve = 2;
        	            	}
        					      $this->home_model->update('tblrequirement_productvendors',array('approve'=>$approve),array('id'=>$r));
      	            }
                    $f_approval = ($atLeastOneApproval == 1) ? 1 : 2;

                    $this->home_model->update('tblrequirement',array('approve_status'=>$f_approval, "purchase_person_remark"=> $remark),array('id'=>$req_id));
                    $ad_data = array(
                         'approvereason' => $remark,
                         'approve_status' => $f_approval,
                         'updated_at' => date('Y-m-d H:i:s')
                     );

                     $this->home_model->update('tblrequirementprocess_approval', $ad_data,array('req_id'=>$req_id,'staff_id'=>get_staff_user_id()));

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

    public function delete_requirement_file($id){
       $files_data = $this->db->query("SELECT * FROM `tblrequirement_productimages` WHERE `id`='".$id."'")->row();
       if (!empty($files_data)){
           $response = $this->home_model->delete("tblrequirement_productimages", array("id" => $id));
           if ($response == true) {
              $path = REQUIREMENT_ATTACHMENTS_FOLDER.$files_data->image;
              unset($path);
              set_alert('success', "requirement product file delete successfully");
           }
       }
       redirect(admin_url('requirement/add'));
    }

    public function get_status() {
        if(!empty($_POST)){
            extract($this->input->post());

            $assign_info = $this->db->query("SELECT * from tblrequirement_approval  where req_id = '".$id."' and type='".$type."' ")->result();
            if(!empty($assign_info)){
            ?>
            <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Status</td>
                                                <td>Remark</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Rejected';
                                                        $color = 'red';
                                                    }elseif($value->approve_status == 4){
                                                        $status = 'Reconciliation';
                                                        $color = 'brown';
                                                    }elseif($value->approve_status == 5){
                                                        $status = 'On Hold';
                                                        $color = '#e8bb0b;';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                    <td><?php echo $value->approvereason; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>

            <?php
          }else{
            $approve_by = value_by_id("tblrequirement", $id, "staff_id");
            $staff_name = get_employee_name($approve_by);
            echo "<div class='row'><div class='col-md-12'><h4 class='text-center text-success'>Direct Approved By ".$staff_name."</h4></div></div>";
          }
        }
    }
    public function get_process_status() {
        if(!empty($_POST)){
            extract($this->input->post());

            $assign_info = $this->db->query("SELECT * from tblrequirementprocess_approval  where req_id = '".$id."' ")->result();
            ?>
            <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Status</td>
                                                <td>Remark</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Rejected';
                                                        $color = 'red';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                    <td><?php echo $value->approvereason; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>

            <?php
        }
    }

    /* this function use for requirement approval */
    public function requirment_approval($req_id)
    {
      	$approval_send  = $this->db->query("SELECT id FROM tblrequirement_approval where req_id = '".$req_id."' and type=2 and approve_status=1 ")->row();
        
      	// if(!empty($approval_send)){
      	// 	set_alert('warning', 'Action already taken!');
        //       redirect(admin_url('requirement/process_list'));
      	// }
        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE id='".$req_id."' ")->row();
        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$req_id."' ")->result();

        if (!empty($_POST)){
           extract($this->input->post());

           $this->home_model->update('tblrequirement',array('initial_approve_status'=>$action),array('id'=>$req_id));

           $ad_data = array(
                'approvereason' => $remark,
                'approve_status' => $action,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->home_model->update('tblrequirement_approval', $ad_data,array('req_id'=>$req_id,'type'=>2,'staff_id'=>get_staff_user_id()));

             update_masterapproval_single(get_staff_user_id(),44,$req_id,$action);
             update_masterapproval_all(44,$req_id,$action);

            if ($action == 1){
                  $getproductstaff = $this->db->query("SELECT staff_id FROM `tblrequirement_approval` WHERE `type`=1 and req_id = '".$req_id."'")->result();
                  if (!empty($getproductstaff)){
                      foreach ($getproductstaff as $productstaff) {

                          $message = 'Product Requirement send you for purchase';
                          $adata = array(
                              'staff_id' => $productstaff->staff_id,
                              'fromuserid'      => $data['requirement_info']->staff_id,
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
                          $token = get_staff_token($productstaff->staff_id);
                          $title = 'Schach';
                          $send_intimation = sendFCM($message, $title, $token, $page = 2);
                      }
                  }
            }
            if ($action == 1){
                set_alert('success', 'Requirement Approved Successfully');
            }else if ($action == 5){
                set_alert('success', 'Requirement Hold Successfully');
            }else{
                set_alert('danger', 'Requirement Rejected Successfully');
            }
            redirect(admin_url('approval/notifications'));
        }

        $data['title'] = 'Requirement Approval';
        $data['appvoal_info'] = $this->db->query("SELECT * from tblrequirement_approval where req_id = '".$req_id."' and type=2 and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();
        
        $this->load->view('admin/requirement/requirment_approval', $data);
    }

    /* this function use for requirment activity */
    public function requirement_activity($id){
        $data['title'] = 'Requirement Activities';
        $reinfo = $this->home_model->get_row("tblrequirement", array("id" => $id), array("*"));
        $data["parsonname"] = 'P-REQ-'.str_pad($reinfo->id, 4, '0', STR_PAD_LEFT);
        if(!empty($_POST)){
            extract($this->input->post());

            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$id."' and staff_id = '".get_staff_user_id()."' and module_id = 45")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }
            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblrequirmentactivity` where requirement_id = '".$id."' and priority = '1' and parent_id = '0' order by id asc")->result();
            }else{

                $message = (!empty($suggestion)) ? $suggestion : $description;
                $parent_id = (!empty($parent_id)) ? $parent_id : 0;
                if ($parent_id > 0){
                    $message = $activity_reply[$parent_id];
                }
                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

               $ad_data = array(
                          'requirement_id' => $id,
                          'parent_id' => $parent_id,
                          'message' => $message,
                          'staffid' => get_staff_user_id(),
                          'date' => date('Y-m-d'),
                          'datetime' => date('Y-m-d H:i:s'),
                          'priority' => 0,
                          'status' => 1
                      );

                $insert_id = $this->home_model->insert('tblrequirmentactivity',$ad_data);
                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {
                       $n_data = array(
                            'description' => 'You taged in requirment activity',
                            'staff_id' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $id,
                            'isread' => 0,
                            'module_id' => 45,
                            'link'  => "requirement/requirement_activity/".$id,
                            'date' => date('Y-m-d H:i:s'),
                            'date_time' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblmasterapproval', $n_data);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staff_id);
                            $title = 'Schach';
                            $message = 'You taged in requirment activity';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('requirement/requirement_activity/' . $id));
            }
        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblrequirmentactivity` where requirement_id = '".$id."' and parent_id = '0' order by id desc LIMIT 10")->result();
        }
        $data['requirement_id'] = $id;
        
        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE id =  '".$id."' ")->row();
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();
        krsort($data['activity_log']);
        $this->load->view('admin/requirement/requirement_activity', $data);
    }

    public function cut_requirement_conversation($id) {

        $success = $this->home_model->update('tblrequirmentactivity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Product Requirement Activity Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_requirement_conversation($id) {

        $success = $this->home_model->delete('tblrequirmentactivity',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function udpate_requirement_priority() {
        if (!empty($_POST)) {
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            $this->home_model->update('tblrequirmentactivity', array('priority' => $pri), array('id' => $id));
        }
    }

    public function get_last_requirement_conversion(){
        if (!empty($_POST)) {
               extract($this->input->post());

               $activity_log = $this->db->query("SELECT * FROM `tblrequirmentactivity` where id < '" . $id . "' and requirement_id = '" . $requirement_id . "' order by id desc LIMIT 10")->result();
               krsort($activity_log);
               $html = '';
               if (!empty($activity_log)) {
                   $i = 0;
                   foreach ($activity_log as $key => $log) {

                       if ($i == 0) {
                           $last_id = $log->id;
                       }

                       $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';
                       $cut = ($log->status == 2) ? 'line-throught' : '';
                       $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblrequirmentactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                       $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                            $html .= '<div class="feed-item">
                                        <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                        <div class="text ' . $cut . '">
                                            <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                            if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                $html .= ' <a href="' . admin_url('requirement/cut_requirement_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                            }
                                            if (is_admin() == 1 && $ttl_reply == 0) {
                                                $html .= ' <a href="' . admin_url('requirement/delete_requirement_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                                            }

                                            if ($log->staffid != 0) {
                                                $html .= '<a href="' . admin_url('profile/' . $log->staffid) . '">' . staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')) . '</a>';
                                                $html .= get_employee_name($log->staffid) . ' - ' . _l($log->message, '', false);
                                                $html .=' <a href="#" class="reply_comment" val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                                if ($ttl_reply > 0){
                                                    $html .=' |<a href="javascript:void(0);" class="view_reply" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                                }
                                            }
                            $html .='</div></div>
                                        <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                           <div class="text-right">
                                                <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                                <button class="btn btn-info">Reply</button>
                                                <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                           </div><br>
                                        </div><div class="reply-view'.$log->id.'"></div>';        
                       $html .= '</div>';  
                       $i++;
                   }
               }

               if (!empty($html) && !empty($last_id)) {
                   $json_arr = array("html" => $html, "last_id" => $last_id);
                   echo json_encode($json_arr);
               }
           }
    }

    /* this function use for edit purchase process */
    public function edit_purchase_process($id)
    {

        if(!empty($_POST)){
          extract($this->input->post());

          // echo '<pre/>';
          // print_r($_POST);
          // die;
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
            $this->home_model->delete("tblrequirementprocess_approval", array('req_id' => $req_id));
            $this->home_model->delete("tblmasterapproval", array('module_id' => 7,'table_id' => $req_id));

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

              $this->home_model->update('tblrequirement',array('approve_status'=>0),array('id'=>$req_id));
              
          }

          $this->home_model->delete('tblrequirement_productvendors', array('req_id'=>$req_id));
          $requirement_products  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$req_id."' ")->result();
          // echo "<pre>";
          // print_r($requirement_products);
          // exit;
          foreach ($requirement_products as $row) {

              if(!empty($_POST['vendor_'.$row->id])){
                  foreach ($_POST['vendor_'.$row->id] as $key => $vendor_name) {
                      $vendor_info  = $this->db->query("SELECT * FROM tblvendor WHERE name =  '".$vendor_name."' ")->row();
                      $vendor_id = (!empty($vendor_info)) ? $vendor_info->id : $vendor_id;

                      $rate =  $_POST['rate_'.$row->id][$key];
                      $unit_id =  $_POST['unit_id_'.$row->id][$key];
                      $remark =  $_POST['vendorremark_'.$row->id][$key];
                      $tax =  $_POST['tax_'.$row->id][$key];

                       $data_1 = array(
                          'staff_id' => get_staff_user_id(),
                          'req_id' => $req_id,
                          'reqpro_id' => $row->id,
                          'vendor_name' => $vendor_name,
                          'vendor_id' => $vendor_id,
                          'unit_id' => $unit_id,
                          'rate' => $rate,
                          'tax' => $tax,
                          'remark' => $remark,
                          'created_at' => date('Y-m-d')
                      );
                      // echo "<pre>";
                      // print_r($data_1);
                      // exit;
                      $vendor_insert = $this->home_model->insert('tblrequirement_productvendors', $data_1);
                  }
              }
          }
          set_alert('success', 'Product vendor Edit Successfully');
          redirect(admin_url('requirement/process_list'));
      }
        $data['vendor_info']  = $this->db->query("SELECT * FROM tblvendor WHERE status =  '1' order by name asc ")->result();
        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$id."' ")->result();
        $data['unit_list']  = $this->db->query("SELECT * FROM tblunitmaster WHERE status = 1 ORDER BY name ASC ")->result();
        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE id =  '".$id."' ")->row();

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
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        $data['title'] = 'Edit Purchase Process';
        $data['section'] = 'edit';
        $this->load->view('admin/requirement/purchase_process', $data);
    }

    /* this function is use for convert requirement */
    public function requirement_details($req_id){
        
        $data['requirement_products']  = $this->db->query("SELECT * FROM tblrequirement_products WHERE req_id =  '".$req_id."' ")->result();
        $data['requirement_info']  = $this->db->query("SELECT * FROM tblrequirement WHERE id =  '".$req_id."' ")->row();
        $data['requirement_vendors'] = $this->db->query("SELECT *, GROUP_CONCAT(reqpro_id) as reqpro_ids FROM tblrequirement_productvendors WHERE `req_id` = '".$req_id."' and `approve` = 1 GROUP BY `vendor_name` ")->result();
        $data['productlist'] = $this->db->query("SELECT `id`,`name`,`sub_name` FROM tblproducts WHERE `status` = 1 ORDER BY name ASC")->result();
        $data['id'] = $req_id;
        $data['title'] = 'Requirement Details';
        $this->load->view('admin/requirement/requirement_details', $data);
    }

    /* this function use for assign product */
    public function assign_product(){
        if(!empty($_POST)){
            extract($this->input->post());
            $product_name = value_by_id("tblproducts", $product_id, "name");
            $this->home_model->update('tblrequirement_products', array('product_id' => $product_id, 'product_name' => $product_name), array('id' => $reqproductid));
            set_alert('success', 'Product Assign Successfully');
        }   
        redirect($_SERVER['HTTP_REFERER']); 
    }
}
