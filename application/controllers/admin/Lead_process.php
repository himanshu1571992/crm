<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Lead_process extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

   
    public function index()
    {

        check_permission(117,'view');

        $data['process_info']  = $this->db->query("SELECT * FROM tblleadprocess order by orders ASC ")->result();
       
        $data['title'] = 'Lead Process List';
        $this->load->view('admin/lead_process/manage', $data);

    }

    public function add($id="")
    {

        check_permission(117,'create');

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(                            
                'name' => $name,
                'orders' => $orders,
                'status' => $status
            );  
                    
                    
            $insert = $this->home_model->insert('tblleadprocess', $ad_data);  

            if($insert){
            
                set_alert('success', 'Process added Successfully');
                redirect(admin_url('lead_process'));
            }
        }

        if(!empty($id)){
            $data['process_info']  = $this->db->query("SELECT * FROM tblleadprocess WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Process';
        }else{
            $data['title'] = 'Add Process';
        }

        
        $this->load->view('admin/lead_process/add', $data);

    }


    public function edit($id="")
    {

        check_permission(117,'edit');

        if(!empty($_POST)){
            extract($this->input->post());

        
            $ad_data = array(                            
                'name' => $name,
                'orders' => $orders,
                'status' => $status
            );
                    
                    
            $update = $this->home_model->update('tblleadprocess', $ad_data,array('id'=>$id));  

            if($update){
            
                set_alert('success', 'Process updated Successfully');
                redirect(admin_url('lead_process'));
            }
        }
    }


    public function delete($id)
    {
        check_permission(117,'delete');
        
        $response = $this->home_model->delete('tblleadprocess', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'process'));
        } else {
            set_alert('warning', _l('problem_deleting', 'process'));
        }
        redirect(admin_url('lead_process'));
    }


   
}
