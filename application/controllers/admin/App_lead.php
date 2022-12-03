<?php

defined('BASEPATH') or exit('No direct script access allowed');
class App_lead extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function image_upload()
    {
        if ($this->input->post()) {
            echo '<pre>';
            print_r($_POST);
             $result_file=handle_multi_expense_attachments('1','expense');
            die;
        }
        $data['title'] = 'Lead Added By App';
        $this->load->view('admin/app_lead/image_upload', $data);    
    } 

    public function index()
    {
       
       check_permission(4,'view');

        if ($this->input->post()) {
            extract($this->input->post());

            $where = " la.staff_id = '".get_staff_user_id()."' ";

           if(!empty($f_date) && !empty($t_date)){

                    $data['s_fdate'] = $f_date;
                    $data['s_tdate'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $t_date = str_replace("/","-",$t_date);

                    $from_date = date('Y-m-d',strtotime($f_date));           
                    $to_date = date('Y-m-d',strtotime($t_date));

                    $where .= " and l.created_at  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           } 

            

           if(!empty($status)){
                $where .= " and l.status = '".$status."'";
                $data['s_status'] = $status;
           }
            

          $data['task_list'] = $this->db->query("SELECT l.* from tblappleads as l LEFT JOIN tbllappeadassignstaff  as la ON l.id = la.lead_id where  ".$where."  ORDER by l.id desc")->result(); 
        }else{
          $data['task_list'] = $this->db->query("SELECT l.* from tblappleads as l LEFT JOIN tbllappeadassignstaff  as la ON l.id = la.lead_id where la.staff_id = '".get_staff_user_id()."' and l.status = 0 and YEAR(l.created_at) = '".date('Y')."' and MONTH(l.created_at) = '".date('m')."' ORDER by l.id desc")->result(); 
        
        }

        $data['title'] = 'Lead Added By App';

        $this->load->view('admin/app_lead/view', $data);
    }





    public function details($id)
    {

        check_permission(4,'view');

        $data['lead_info']  = $this->db->query("SELECT * FROM tblappleads WHERE id = '".$id."'")->row();
        $data['lead_attachment']  = $this->db->query("SELECT * FROM tblfiles WHERE rel_type = 'app_leads' and  rel_id = '".$id."'")->result();
       
        $this->load->view('admin/app_lead/details', $data);

    }
    public function get_details($id)
    {
        $lead_info  = $this->db->query("SELECT * FROM tblappleads WHERE id = '".$id."'")->row();
        $lead_attachment  = $this->db->query("SELECT * FROM tblfiles WHERE rel_type = 'app_leads' and  rel_id = '".$id."'")->result();
       
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="Description-box">
                        <p><b style="color: red; font-size: 15px;">Lead Created Date  : </b> <?php echo (!empty($lead_info)) ? date('d/m/Y', strtotime($lead_info->created_at)) : "--"; ?></p> 
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Company Name :</label>
                            <p> <?php echo (!empty($lead_info)) ? cc($lead_info->company_name) : "--"; ?></p> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Company Number :</label>
                            <p><?php echo (!empty($lead_info)) ? $lead_info->company_number : "--"; ?></p> 
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Company Email :</label>
                            <p><?php echo (!empty($lead_info)) ? $lead_info->company_email : "--"; ?></p> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Contact Person Name :</label>
                            <p><?php echo (!empty($lead_info)) ? $lead_info->person_name : "--"; ?></p> 
                        </div>
                    </div>
                </div>    
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Contact Person Number :</label>
                            <p><?php echo (!empty($lead_info)) ? $lead_info->person_number : "--"; ?></p> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Contact Person Email :</label>
                            <p><?php echo (!empty($lead_info) && !empty($lead_info->person_email)) ? $lead_info->person_email : "--"; ?></p> 
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Contact Person Designation :</label>
                            <p><?php echo (!empty($lead_info) && $lead_info->designation_id > 0) ? value_by_id('tbldesignation', $lead_info->designation_id, 'designation') : "--"; ?></p> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drawing" style="color: red; font-size: 15px;" class="control-label">Lead Description :</label>
                            <p><?php echo (!empty($lead_info)) ? $lead_info->description : "--"; ?></p> 
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="Description-box">
                        <?php
                        if (!empty($lead_attachment)) {
                            echo '<p><b>Image Attachment : </b>';
                            foreach ($lead_attachment as $key => $value) {
                                ?>
                                <p><?php if (!empty($value->file_name)) { ?><a target="_blank" href="<?php echo base_url('uploads/app_leads/' . $value->rel_id . '/' . $value->file_name); ?>" >View Attachment</a><?php } ?></p> 
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        <?php
    }

    public function mark_complete($id)
    {
       
        if($this->home_model->update('tblappleads',array('status'=>1),array('id'=>$id))) {
            set_alert('success', 'Lead Completed successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }


    public function delete($id)
    {
       check_permission(4,'delete');

        if($this->home_model->delete('tblreminder',array('id'=>$id))){
        	$this->home_model->delete('tblnotifications',array('module_id'=>5,'table_id'=>$id));
            set_alert('success', 'Reminder deleted successfully');
            redirect(admin_url('reminder/'));
        }

    }
    

}
