<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff_iteams extends Admin_controller {

    public function __construct() {
        parent::__construct();

    }

    /* List all Staff Iteams */

        public function index() {
         $data['iteams'] = $this->db->query("SELECT * from `tblstaffitems` order by id desc ")->result();

         $data['title'] = 'Staff Iteams List'; 
         $this->load->view('admin/staff_iteams/manage_iteams', $data);
         }

    /* Add Staff Iteams */

        public function iteams($id = '') {

            if ($this->input->post()) {
                $iteams_data = $this->input->post();
                if ($id == '') {
                    $this->load->model('Staff_iteams_model');
                    $id = $this->Staff_iteams_model->add($iteams_data);
                    if ($id) {

                        set_alert('success', _l('added_successfully', _l('iteams')));
                        redirect(admin_url('staff_iteams'));
                    }

                } else {

                    $this->load->model('Staff_iteams_model');
                    $success = $this->Staff_iteams_model->edit($iteams_data, $id);
                    if ($success) {
                        set_alert('success', _l('updated_successfully', _l('iteams')));

                    }
                    redirect(admin_url('staff_iteams'));
                }
            }

            if ($id == '') {
                $data['title'] = 'Add Staff Iteams';
            } else {
                $this->load->model('Staff_iteams_model');
                $data['iteams'] = (array) $this->Staff_iteams_model->get($id);
                $data['title'] = 'Edit Staff Iteams';
            }


            $this->load->view('admin/staff_iteams/add_iteams', $data);
        }


        /* Allot Item Details */

        public function allot_iteams($id = '') {

            $data['allot_iteams'] = $this->db->query("SELECT * from `tblstaffitemsdetails` WHERE staff_id = '".$id."' order by id desc  ")->result_array();

            $data['title'] = 'Allot Iteams List'; 
            $data['id'] = $id;
            $this->load->view('admin/staff_iteams/allot_iteams_list', $data);
        }

        public function add_allot_iteams($id = '')
        {  
           
          $this->load->model('home_model');

          if ($this->input->post()) { 
            extract($this->input->post()); 


            if(!empty($item_ids)){ 
                $sdate = str_replace("/","-",$date);
                $cdate = date("Y-m-d",strtotime($sdate));
                $up_data = array(                              
                    'staff_id' => $id,                               
                    'item_id' => $item_id,
                    'description' => $description,
                    'remark' => $remark,
                    'date' => $cdate, 
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $update = $this->home_model->update('tblstaffitemsdetails',$up_data,array('id'=>$item_ids));
                if($update)
                {
                $data = array('is_allotted' => 0);

                $this->home_model->update('tblproducts',$data,array('id'=>$product_id));
                }
                
                $data = array('is_allotted' => 2);

                $this->home_model->update('tblproducts',$data,array('id'=>$item_id));

               set_alert('success', _l('updated_successfully', _l('staff_allot')));
               redirect(admin_url('staff_iteams/allot_iteams/'.$id));

            }
            else
            { 
                $sdate = str_replace("/","-",$date);
                $cdate = date("Y-m-d",strtotime($sdate));

                $ad_data = array(
                    'staff_id' => $id,                               
                    'item_id' => $item_id,
                    'description' => $description,
                    'date' => $cdate, 
                    'remark' => $remark,                             
                    'status' => 1,                              
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ); 
                
                $insert = $this->home_model->insert('tblstaffitemsdetails',$ad_data);

                if($insert){

                $insert_id = $this->db->insert_id();
                $product = $this->db->query("SELECT * FROM `tblstaffitemsdetails` where  id = '".$insert_id."' ")->row();
              
                $data = array('is_allotted' => 2);

                $this->home_model->update('tblproducts',$data,array('id'=>$product->item_id));

                $message = 'Staff Allot Item send product confirmation';
                    

                $adata = array(
                    'staff_id' => $id,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 11,
                    'table_id' => $insert_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'description'     => $message,
                    'link' => 'staff_iteams/allot_iteams_approval/'.$insert_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );  
                $this->db->insert('tblmasterapproval', $adata);


                //staff_allot_attachments($insert_id);
                set_alert('success', _l('added_successfully', _l('staff_allot')));
                redirect(admin_url('staff_iteams/allot_iteams/'.$id));
               
                }
             


        }


    }


    $iteams_id = $this->input->get('id'); 

    if ($iteams_id == '') {
        $data['title'] = 'Add Allot Items';
    } else {
        $data['title'] = 'Edit Allot Items';
        $data['staff_allot'] = $this->db->query("SELECT * FROM `tblstaffitemsdetails` where staff_id = '".$id."' and id = '".$iteams_id."' ")->row();

    }

    /*$data['staff_iteams'] = $this->db->query("SELECT * FROM `tblproducts` where  is_allotted = '0' and status = '1' ")->result_array();*/

    $this->load->view('admin/staff_iteams/staff_allot', $data);


    }


    public function allot_iteams_approval($id)
    {
       if(!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),11,$id,$submit);
            update_masterapproval_all(11,$id,1);

            $ad_data = array('receive_status' => $submit,
                            'receive_date' => date('Y-m-d H:i:s'),
                            'receive_remark' => $remark
                        ); 
            $this->load->model('home_model');   
            $update = $this->home_model->update('tblstaffitemsdetails', $ad_data,array('id'=>$id)); 
            if($update)
            {   if($submit == 1)
                {
                    $this->home_model->update('tblproducts', array('is_allotted'=>1),array('id'=>$product_id));
                }
                else
                {
                   $this->home_model->update('tblproducts', array('is_allotted'=>0),array('id'=>$product_id)); 
                }

            }

            //Updating Products on stock
            $allot_info = $this->db->query("SELECT * from tblstaffitemsdetails where id = '".$id."'")->row();
                
                
            
            if($update){
                 set_alert('success', 'Allot Item Receipt updated succesfully');
                 redirect(admin_url('approval/notifications'));
            }

            
        }


        $data['info']  = $this->db->query("SELECT * FROM tblstaffitemsdetails where id = '".$id."'  ")->row();

        $staff  = $this->db->query("SELECT * FROM tblstaffitemsdetails where id = '".$id."'  ")->row();

        $data['image'] = $this->db->query("SELECT * FROM `tblproducts` where id = '".$staff->item_id."' and photo != ''  ")->row();

        $data['appvoal_info'] = $this->db->query("SELECT * from tblstaffitemsdetails where id = '".$id."' and staff_id = '".get_staff_user_id()."' and receive_status != 0 ")->row();

        $data['id'] = $id;
        $data['staff_id'] = $staff->staff_id;

        $data['title'] = 'Allot Items Approval';
        $this->load->view('admin/staff_iteams/allot_iteams_approval', $data);

    } 



}
