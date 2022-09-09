<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Reminder extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
       check_permission(155,'view');

        $this->load->model('follow_up_model');

        if ($this->input->post()) {
            extract($this->input->post());

            $data['s_fdate'] = $f_date;
            $data['s_tdate'] = $t_date;


            $f_date = str_replace("/","-",$f_date);
            $t_date = str_replace("/","-",$t_date);
           
           $from_date = date('Y-m-d',strtotime($f_date)).' 00:00:00';           
           $to_date = date('Y-m-d',strtotime($t_date)).' 23:59:59';

           $where = "staff_id = '".get_staff_user_id()."' and reminder_date >= '".$from_date."' and reminder_date <= '".$to_date."' ";

           if(!empty($reminder_for)){
                $where .= " and reminder_for = '".$reminder_for."'";
                $data['s_reminder'] = $reminder_for;
           }

            if(!empty($completed)){
                $data['s_status'] = $completed;
                if($completed == 2){
                    $completed = 0;
                }else{
                    $completed = $completed;
                }
                $where .= " and completed = '".$completed."'";
                
           }
            

          $data['reminder_list'] = $this->db->query("SELECT * FROM `tblreminder` where ".$where." ")->result(); 
        }else{
          $data['reminder_list'] = $this->db->query("SELECT * FROM `tblreminder` where staff_id = '".get_staff_user_id()."' and YEAR(reminder_date) = '".date('Y')."' and MONTH(reminder_date) = '".date('m')."' ")->result(); 
        }

        $data['title'] = 'My Reminders';

        $this->load->view('admin/reminder/view', $data);
    }



    public function add($id = '')
    {
        check_permission(155,'create');

         $data['r_id'] = $this->uri->segment(5);
         
        if ($this->input->post()) {
            extract($this->input->post());



            $reminder_date = str_replace("/","-",$reminder_date);
            $reminder_date = date("Y-m-d H:i:s",strtotime($reminder_date));
           
            if(empty($id)){
                

                $ad_data = array(
                            'staff_id' => get_staff_user_id(),
                            'reminder_for' => $reminder_for,
                            'remark' => $remark,
                            'reminder_date' => $reminder_date,
                            'status' => $status,
                            'created_at' => date('Y-m-d H:i:s'),
                        );

               
                 if ($this->home_model->insert('tblreminder',$ad_data)) {

                    $id = $this->db->insert_id();

                    handle_multi_attachments($id,'reminder');

                    set_alert('success', 'Reminder added successfully');
                    redirect(admin_url('reminder/add/'));
                } 
            }else{
                check_permission(155,'edit');

                $ad_data = array(
                            'staff_id' => get_staff_user_id(),
                            'reminder_for' => $reminder_for,
                            'remark' => $remark,
                            'reminder_date' => $reminder_date,
                            'status' => $status,
                            'created_at' => date('Y-m-d H:i:s'),
                        );


            
                 if ($this->home_model->update('tblreminder',$ad_data,array('id'=>$id))) {

                    handle_multi_attachments($id,'reminder');

                    set_alert('success', 'Suggestion udpated successfully');
                    redirect(admin_url('reminder'));
                }   
            }
                
            
            
        }

        if(!empty($id)){
            $data['title'] = 'Edit Reminder';

             $data['reminder']  = $this->db->query("SELECT * FROM tblreminder WHERE id = '".$id."'")->row_array();
             if (!$data['reminder']) {
                blank_page('Reminder Not Found', 'danger');
            }
        }else{
            $data['title'] = 'Add New Reminder';
        }       
       

        
        $this->load->view('admin/reminder/add', $data);
    }



    public function details($id)
    {

        $data['reminder_info']  = $this->db->query("SELECT * FROM tblreminder WHERE id = '".$id."'")->row();
       
        $this->load->view('admin/reminder/details', $data);

    }

    public function mark_complete($id)
    {
       
        if($this->home_model->update('tblreminder',array('completed'=>1),array('id'=>$id))) {
            set_alert('success', 'Reminder Completed successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }


    public function delete($id)
    {
       check_permission(155,'delete');
       
        if($this->home_model->delete('tblreminder',array('id'=>$id))){
        	$this->home_model->delete('tblnotifications',array('module_id'=>5,'table_id'=>$id));
            set_alert('success', 'Reminder deleted successfully');
            redirect(admin_url('reminder/'));
        }

    }


    public function make_notification()
    {
       
        $reminder_list  = $this->db->query("SELECT * FROM tblreminder WHERE status = 1 and  completed = 0 and reminder_date <= '".date('Y-m-d H:i:s')."' ")->result();
        
        if(!empty($reminder_list)){
            foreach ($reminder_list as $key => $row) {
                //Deleteing last notification
                $this->home_model->delete('tblnotifications',array('module_id'=>5,'table_id'=>$row->id));

                //Inserting new notification    


                if($row->reminder_for == 1){
                    $reminder_for = 'Payment Followup';
                }elseif($row->reminder_for == 2){
                    $reminder_for = 'Lead Followup';
                }elseif($row->reminder_for == 3){
                    $reminder_for = 'Task';
                }


                $description = "You have Reminder for ".$reminder_for;
                $link = 'reminder/details/'.$row->id;
                $ad_data = array(
                        'isread' => 0,
                        'isread_inline' => 0,
                        'date' => date('Y-m-d H:i:s'),
                        'description' => $description,
                        'fromuserid' => $row->staff_id,
                        'touserid' => $row->staff_id,
                        'from_fullname' => 'Reminder',
                        'link' => $link,
                        'module_id' => 5,
                        'table_id' => $row->id,
                    );


                $this->home_model->insert('tblnotifications',$ad_data);
                
                //Sending Mobile Intimation
                $token = get_staff_token($row->staff_id);
                $message = $description;
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }
        }

    }


    public function reminder_postpone()
    {
        check_permission(155,'create');

         if ($this->input->post()) {
            extract($this->input->post());

            $reminder_date = str_replace("/","-",$reminder_date);
            $reminder_date = date("Y-m-d H:i:s",strtotime($reminder_date));

            $ad_data = array(                
                'remark' => $remark,
                'reminder_date' => $reminder_date
            );


            if ($this->home_model->update('tblreminder',$ad_data,array('id'=>$id))) {

                set_alert('success', 'Reminder Postpone successfully');
                redirect(admin_url('reminder'));
            }  
        }

    }
}
