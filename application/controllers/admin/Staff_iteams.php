<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff_iteams extends Admin_controller {

    public function __construct() {
        parent::__construct();
       $this->load->model('home_model');
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
            check_permission(310,'view');
            $where = "id > 0";
            if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($staff_id) || !empty($f_date) || !empty($t_date) || !empty($status)){


                if(!empty($staff_id)){
                    $data['staff_id'] = $staff_id;
                    $where .= " and staff_id = '".$staff_id."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));
                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= " and date between '".$f_date."' and '".$t_date."' ";
                }

                if(!empty($status)){
                    $data['status'] = $status;
                    if($status == 3){
                        $status = 0;
                    }

                    $where .= " and receive_status = '".$status."'";
                }

            }
        }
        else
        {
            $where .= " and receive_status = 0";
        }

            $data['allot_iteams'] = $this->db->query("SELECT * from `tblstaffitemsdetails` where ".$where." order by id desc  ")->result_array();

            $data['staff_list'] = get_staff_list();

            $data['title'] = 'Allot Iteams List';
            $data['id'] = $id;
            $this->load->view('admin/staff_iteams/allot_iteams_list', $data);

        }

        public function add_allot_iteams($id = '')
        {
           check_permission(310,'create');
          $this->load->model('home_model');

          if ($this->input->post()) {
            extract($this->input->post());

            if(!empty($assignid)){
            foreach($assignid as $single_staff)
            {
                if (strpos($single_staff, 'staff') !== false)
                {
                    $staff_i[]=str_replace("staff","",$single_staff);
                }
            }
            $staff_i = array_unique($staff_i);

            $staff_str = implode(",",$staff_i);
            }else{
                    $staff_str = '';
               }

            if(!empty($item_ids)){

                $this->db->delete('tblstaffitemsdetails',array('id'=>$item_ids));
                $this->db->delete('tblstaffitemsdetails_approval',array('itemsdetail_id'=>$item_ids));
                $this->db->delete('tblmasterapproval',array('table_id'=>$item_ids,'module_id'=>14));
                $this->db->delete('tblmasterapproval',array('table_id'=>$item_ids,'module_id'=>11));

                $sdate = str_replace("/","-",$date);
                $cdate = date("Y-m-d",strtotime($sdate));

                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'staff_id' => $staff_id,
                    'assignid' => $staff_str,
                    'item_id' => $item_id,
                    'description' => $description,
                    'date' => $cdate,
                    'remark' => $remark,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $update = $this->home_model->insert('tblstaffitemsdetails',$ad_data);

                if($update){
                $insert_id = $this->db->insert_id();

                $data = array('is_allotted' => 0);

                $this->home_model->update('tblproducts',$data,array('id'=>$product_id));



                if(!empty($staff_i)){
                            foreach($staff_i as $single_staff)
                            {
                                if($single_staff!=get_staff_user_id())
                                {
                                    $sdata['staff_id']=$single_staff;
                                    $sdata['itemsdetail_id']=$insert_id;
                                    $sdata['created_at'] = date("Y-m-d H:i:s");
                                    $this->db->insert('tblstaffitemsdetails_approval', $sdata);

                                    $adata = array(
                                        'staff_id' => $single_staff,
                                        'fromuserid' => get_staff_user_id(),
                                        'module_id' => 14,
                                        'table_id' => $insert_id,
                                        'approve_status' => 0,
                                        'status' => 0,
                                        'description'     => 'Staff Allot Item send product confirmation',
                                        'link' => 'staff_iteams/allot_iteams_approval/'.$insert_id,
                                        'date' => date('Y-m-d'),
                                        'date_time' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('tblmasterapproval', $adata);

                                    //Sending Mobile Intimation
                                    $token = get_staff_token($single_staff);
                                    $message = 'Staff Allot Item send product confirmation';
                                    $title = 'Schach';
                                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                                }
                            }
                        }
                }

                $data = array('is_allotted' => 2);

                $this->home_model->update('tblproducts',$data,array('id'=>$item_id));

               set_alert('success', _l('updated_successfully', _l('staff_allot')));
               redirect(admin_url('staff_iteams/allot_iteams'));

            }
            else
            {
                $sdate = str_replace("/","-",$date);
                $cdate = date("Y-m-d",strtotime($sdate));

                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'staff_id' => $staff_id,
                    'assignid' => $staff_str,
                    'item_id' => $item_id,
                    'description' => $description,
                    'date' => $cdate,
                    'remark' => $remark,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $insert = $this->home_model->insert('tblstaffitemsdetails',$ad_data);

                if($insert){

                $insert_id = $this->db->insert_id();

                if(!empty($staff_i)){
                            foreach($staff_i as $single_staff)
                            {
                                if($single_staff!=get_staff_user_id())
                                {
                                    $sdata['staff_id']=$single_staff;
                                    $sdata['itemsdetail_id']=$insert_id;
                                    $sdata['created_at'] = date("Y-m-d H:i:s");
                                    $this->db->insert('tblstaffitemsdetails_approval', $sdata);

                                    $adata = array(
                                        'staff_id' => $single_staff,
                                        'fromuserid' => get_staff_user_id(),
                                        'module_id' => 14,
                                        'table_id' => $insert_id,
                                        'approve_status' => 0,
                                        'status' => 0,
                                        'description'     => 'Staff Allot Item send product confirmation',
                                        'link' => 'staff_iteams/allot_iteams_approval/'.$insert_id,
                                        'date' => date('Y-m-d'),
                                        'date_time' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('tblmasterapproval', $adata);

                                    //Sending Mobile Intimation
                                    $token = get_staff_token($single_staff);
                                    $message = 'Staff Allot Item send product confirmation';
                                    $title = 'Schach';
                                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                                }
                            }
                        }



                $product = $this->db->query("SELECT * FROM `tblstaffitemsdetails` where  id = '".$insert_id."' ")->row();

                $data = array('is_allotted' => 2);

                $this->home_model->update('tblproducts',$data,array('id'=>$product->item_id));

                set_alert('success', _l('added_successfully', _l('staff_allot')));
                redirect(admin_url('staff_iteams/allot_iteams'));

                }

        }


    }


    //$iteams_id = $this->input->get('id');

    if ($id == '') {
        $data['title'] = 'Add Allot Items';
    } else {
        $data['title'] = 'Edit Allot Items';
        $data['staff_allot'] = $this->db->query("SELECT * FROM `tblstaffitemsdetails` where id = '".$id."' ")->row_array();
        $data['staffassigndata'] = explode(',', $data['staff_allot']['assignid']);
        $query = $this->db->query("SELECT * FROM `tblstaffitemsdetails` where id = '".$id."' ")->row();
        $data['staff_id'] = $query->staff_id;

    }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

    $data['allStaffdata'] = $stafff;

    $data['staff_list'] = get_staff_list();

    $this->load->view('admin/staff_iteams/staff_allot', $data);


    }



    public function allot_iteams_approval($id)
    {
       if(!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),14,$id,$submit);
            update_masterapproval_all(14,$id,1);

            $user_id = get_staff_user_id();
            $update = $this->home_model->update('tblstaffitemsdetails', array('status'=>$submit),array('id'=>$id));

            if($update)
            {
                  $ad_data = array('approve_status' => $submit,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'remark' => $remark
                        );

                  $this->home_model->update('tblstaffitemsdetails_approval', $ad_data,array('itemsdetail_id'=>$id,'staff_id'=>$user_id));

             if($submit == 1)
                {
                    $message = 'Staff Allot Item Acceptance product confirmation';
                    $query = $this->db->query("SELECT * FROM tblstaffitemsdetails WHERE id =  '".$id."' ")->row();

                    $adata = array(
                    'staff_id' => $query->staff_id,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 11,
                    'table_id' => $id,
                    'approve_status' => 0,
                    'status' => 0,
                    'description'     => $message,
                    'link' => 'staff_iteams/allot_acceptance_approval/'.$id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                    $token = get_staff_token($query->staff_id);
//                    $message = $message;
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
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

    public function allot_acceptance_approval($id)
    {
       if(!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),11,$id,$submit);
            update_masterapproval_all(11,$id,1);

            $user_id = get_staff_user_id();


                  $ad_data = array('receive_status' => $submit,
                            'receive_date' => date('Y-m-d H:i:s'),
                            'receive_remark' => $remark
                        );

                  $this->home_model->update('tblstaffitemsdetails', $ad_data,array('id'=>$id));

                  if($submit == 1)
                  {
                    $this->home_model->update('tblproducts', array('is_allotted'=>1),array('id'=>$product_id));
                  }
                  else
                  {
                    $this->home_model->update('tblproducts', array('is_allotted'=>0),array('id'=>$product_id));
                  }


            //Updating Products on stock
            $allot_info = $this->db->query("SELECT * from tblstaffitemsdetails where id = '".$id."'")->row();



                 set_alert('success', 'Allot Acceptance Item Receipt updated succesfully');
                 redirect(admin_url('approval/notifications'));


        }


        $data['info']  = $this->db->query("SELECT * FROM tblstaffitemsdetails where id = '".$id."'  ")->row();

        $staff  = $this->db->query("SELECT * FROM tblstaffitemsdetails where id = '".$id."'  ")->row();

        $data['image'] = $this->db->query("SELECT * FROM `tblproducts` where id = '".$staff->item_id."' and photo != ''  ")->row();

        $data['appvoal_info'] = $this->db->query("SELECT * from tblstaffitemsdetails where id = '".$id."' and staff_id = '".get_staff_user_id()."' and receive_status != 0 ")->row();

        $data['id'] = $id;
        $data['staff_id'] = $staff->staff_id;

        $data['title'] = 'Allot Items Approval';
        $this->load->view('admin/staff_iteams/allot_acceptance_approval', $data);

    }


    //By Safiya
    public function get_items_approval_info() {


        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblstaffitemsdetails_approval  where itemsdetail_id = '".$items_id."'  ")->result();
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
                                                <td>Remark</td>
                                                <td>Action</td>
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
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td><?php echo $value->remark; ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
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

}
