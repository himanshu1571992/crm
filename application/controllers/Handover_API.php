<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Handover_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }



      
    public function add()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($user_id) && !empty($final_receiver_id) && !empty($receiver_id) ){

            $ad_data = array(                            
                'title' => $title,
                'staff_id' => $user_id,
                'receiver_id' => $final_receiver_id,
                'remark' => $remark,
                'created_at' => date('Y-m-d'),
                'status' => 1
            );
                    
            $insert = $this->home_model->insert('tblhandover', $ad_data);  

            if($insert){

                $handover_id = $this->db->insert_id();

                handle_multi_handover_attachments($handover_id,'handover_master');

                $data_1 = array(
                        'handover_id' => $handover_id,
                        'sender_staff_id' => $user_id,
                        'receiver_id' => $receiver_id,
                        'sender_remark' => $remark,
                        'status' => 1,
                        'created_date' => date('Y-m-d H:i:s')
                    );

                $insert_1 = $this->home_model->insert('tblhandoverlog', $data_1);

                if($insert_1 == true){
                    $insert_id = $this->db->insert_id();
                    $n_data = array(
                            'description' => 'Document Hand-Over for Accept',
                            'touserid' => $receiver_id,
                            'fromuserid' => $user_id,
                            'table_id' => $insert_id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 12,
                            'category_id' => 1,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data);
                }
            
            }



            if($insert == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Handover added Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to add Handover";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);


        //http://schachengineers.com/schacrm_test/Handover_API/add?user_id=1&final_receiver_id=27&receiver_id=25&title=Handover_title&remark=remark

    }

    public function handover_list()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($user_id) ){
             $handover_info  = $this->db->query("SELECT * FROM tblhandover WHERE  staff_id = '".$user_id."' order by id desc ")->result();
             if(!empty($handover_info)){
                
                foreach ($handover_info as $value) {

                    $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'handover_master'),  array('id'),'');
                    if($files_count){
                        $count=count($files_count);
                    }else{
                        $count=0;
                    }

                    $arr[] = array(
                        'id' => $value->id,
                        'title' => $value->title,
                        'final_receiver' => get_employee_name($value->receiver_id),
                        'remark' => $value->remark,
                        'created_at'   => _d($value->created_at),
                        'file_count' => $count                    
                    );
                }

                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $arr;

             }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Records Not found!";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://schachengineers.com/schacrm_test/Handover_API/handover_list?user_id=1
    }


    public function handover_log()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        

        if(!empty($handover_id)){

            $handover_info = $this->db->query("SELECT * from tblhandoverlog where handover_id = '".$handover_id."' ")->result();

            if(!empty($handover_info)){
                foreach ($handover_info as $value) {

                    $arr[] = array(
                        'id' => $value->id,
                        'sender' => get_employee_name($value->sender_staff_id),
                        'receiver' => get_employee_name($value->receiver_id),
                        'remark' => (!empty($value->receiver_remark)) ? $value->receiver_remark : '--',
                        'status' => ($value->received_status == 1) ? 'Received' : 'Not Received',
                        'receive_date'   => ($value->receive_date > 0) ? _d($value->receive_date) : '--'
                    );
                }

                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $arr;

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Records Not found!";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://schachengineers.com/schacrm_test/Handover_API/handover_log?handover_id=1

    }

    public function get_file()
    {

        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        $files = $this->home_model->get_result('tblfiles', array('rel_id'=>$id,'rel_type'=>'handover_master'),  array('id','file_name','filetype','rel_id','rel_type'),'');
        $result=array();
        foreach ($files as $file ) {
            $temp['id']=$file->id;
            $temp['rel_id']=$file->rel_id;
            $temp['file_name']=$file->file_name;
      
            $temp['file_path']=base_url('uploads/handover_master/'.$file->rel_id.'/'.$file->file_name);
            array_push($result, $temp);

        }

        $return_arr['file_list']=$result;
        header('Content-type: application/json');
        echo json_encode($return_arr);      
         //https://schachengineers.com/schacrm_test/Handover_API/get_file?id=1
    }


    


   public function delete()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){

            $update = $this->home_model->delete('tblappleads',array('id'=>$id));
            

            if($update == true){
                $this->home_model->delete('tbllappeadassignstaff',array('lead_id'=>$id));

                $return_arr['status'] = true;   
                $return_arr['message'] = "Lead Deleted Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to delete Lead";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/App_lead/delete?id=1
    }

    public function delete_file()
    {
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }

        $this->db->where('rel_id', $rel_id);
        $this->db->where('id', $id);
        $this->db->where('rel_type', 'app_leads');
        $file = $this->db->get('tblfiles')->row();

        if(!empty($file))
        {
            if ($file->staffid == get_staff_user_id() || is_admin()) {
                if(is_dir(get_upload_path_by_type('app_leads') . $file->rel_id))
                {
                    unlink(get_upload_path_by_type('app_leads') . $file->rel_id . '/' . $file->file_name);

                    $this->db->where('rel_id', $rel_id);
                    $this->db->where('id', $id);
                    $this->db->delete('tblfiles');
                
                if ($this->db->affected_rows() > 0) {
                    $Deleted['status']=TRUE;
                    $Deleted['msg']="File Deleted Successfully";
                    
                }

                if (is_dir(get_upload_path_by_type('app_leads') . $file->rel_id)) {
                    // Check if no attachments left, so we can delete the folder also
                    $other_attachments = list_files(get_upload_path_by_type('app_leads') . $file->rel_id);
                    if (count($other_attachments) == 0) {
                        // okey only index.html so we can delete the folder also
                        delete_dir(get_upload_path_by_type('app_leads') . $file->rel_id);
                    }
                }
                    
                }   
                    
            }
            else
            {
                $Deleted['status'] =FALSE;
                $Deleted['msg']="You dont have permission to delete";
            }
        }
        else{
            $Deleted['status'] =FALSE;
            $Deleted['msg']="File Not Found";
        }
        header('Content-type: application/json');
        echo json_encode($Deleted);

            
    }

   

}
