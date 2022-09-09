<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Complain_types extends Admin_controller {

    public function __construct() {
        parent::__construct();
         $this->load->model('home_model');
    }

    /* List all Compain Types*/
    public function index() {
        check_permission(342,'view');
        $data['title'] = 'Complain Type List';
        $where = "status = 1";
        if ($_POST){
            extract($this->input->post());
            
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(created_on) between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
            
        }
        
        $data['complaintypes_list'] = $this->db->query("SELECT * FROM tblcomplainstypes WHERE ".$where." ORDER BY `id` DESC")->result();
        
        $this->load->view('admin/complain_types/list', $data);
    }
    
    /* This is for add compain types */
    public function add(){
        check_permission(342,'create');
        if ($this->input->post()){
            $data = $this->input->post();
            $id = $data["comp_type_id"];
            unset($data["comp_type_id"]);
            if ($id == ""){
                $data["created_on"] = date('Y-m-d H:i:s');
                $data["updated_on"] = date('Y-m-d H:i:s');
                $insert_id = $this->home_model->insert('tblcomplainstypes', $data);
                
                $msg = ($insert_id) ? "Complain Types add successfully" : "Something went wrong";
            }else{
                $data["updated_on"] = date('Y-m-d H:i:s');
                $update = $this->home_model->update('tblcomplainstypes', $data,array('id'=> $id));
                
                $msg = ($update) ? "Complain Types update successfully" : "Something went wrong";
            }
            
            set_alert('success', $msg);
            redirect(admin_url('complain_types')); 
        }
    }
    
    
    /* this function use for delete complain types */
    public function delete($id) {
        check_permission(342,'delete');
        $chk_complain = $this->home_model->get_row("tblcomplains", array("complain_type_id" => $id), array("id"));
        if (!empty($chk_complain)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }
        $response = $this->home_model->delete('tblcomplainstypes', array('id'=> $id));
        if ($response == true) {
            set_alert('success', 'Complain Types deleted successfully');
            redirect(admin_url('complain_types'));
        } else {
            set_alert('warning', 'problem deleting');
            redirect(admin_url('complain_types'));
        }
        
    }

}
