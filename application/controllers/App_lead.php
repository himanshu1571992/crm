<?php

defined('BASEPATH') or exit('No direct script access allowed');
class App_lead extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function test(){
        $query = $this->db->query("SELECT number  FROM `tblproposals` WHERE `city` = '548'")->result();
        foreach ($query as $key => $value) {
            echo $value->number.'<br>';
        }
    }

    public function get_masters(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        

        if(!empty($user_id)){

            //Designation
            $this->load->model('Designation_model');
            $designation_data = $this->Designation_model->get();
           

            //staff group
            $Staffgroup =  get_staff_group(7,$user_id);
            foreach($Staffgroup as $singlestaff)
            {

                $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='".$user_id."'")->result_array();

                $stafff['staffs'][]=$query;                

                $staff_arr[] = array(
                    'id' =>  $singlestaff['id'],
                    'name' =>  $singlestaff['name'],
                    'staffs' =>  $query,
                );

                

            }

            $allStaffdata = $staff_arr;
            


            $new_arr = array();            

            if(!empty($designation_data)){
                $new_arr['designations'] = $designation_data;
            }else{
                $new_arr['designations'] = [];
            }

            

            if(!empty($allStaffdata)){
                $new_arr['group_info'] = $allStaffdata;
            }else{
                $new_arr['group_info'] = [];
            }

            $return_arr['status'] = true;   
            $return_arr['message'] = "Success";
            $return_arr['data'] = $new_arr;

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';

        }


        header('Content-type: application/json');

        echo json_encode($return_arr);

        

        
        //http://35.154.77.171/schach/App_lead/get_masters?user_id=2

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


        if(!empty($user_id) ){

            if(empty($city_id)){
                $city_id = 0;
            }
            if(empty($state_id)){
                $state_id = 0;
            }

           $ad_data = array(
                        'staff_id' => $user_id,
                        'company_name' => $company_name,
                        'company_number' => $company_number,
                        'company_email' => $company_email,
                        'person_name' => $person_name,
                        'person_number' => $person_number,
                        'person_email' => $person_email,
                        'address' => $address,
                        'state_id' => $state_id,
                        'city_id' => $city_id,
                        'designation_id' => $designation_id,
                        'description' => $description,
                        'status' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                    );

            $insert = $this->home_model->insert('tblappleads',$ad_data);

            $lead_id = $this->db->insert_id();

            $result_file=handle_multi_expense_attachments($lead_id,'app_leads');

            if(!empty($staffid)){

                $staffid = json_decode($staffid);
                
                foreach($staffid as $singlelead){
                            if($singlelead!=0)
                            {
                                $prdata['staff_id']=$singlelead;
                                $prdata['lead_id']=$lead_id;
                                $prdata['status']=1;
                                $this->db->insert('tbllappeadassignstaff',$prdata);

                                
                                $full_name = get_employee_fullname($user_id);       
                                $notified_data = array(
                                            'description'     => 'New Lead Added by App',
                                            'touserid'        => $singlelead,
                                            'from_fullname'    => $full_name,
                                            'date'             => date('Y-m-d H:i:s'),
                                            'fromuserid'      => $user_id,
                                            'link'            => 'expenses/list_expenses/' . $lead_id,
                                );      
                                        
                                $insert_notified = $this->home_model->insert('tblnotifications', $notified_data);      
                                    
                        }
                    }
            }


            if($insert == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Lead added Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to add Lead";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);


        //http://mustafa-pc/crm/App_lead/add?user_id=1&staffid=[1,58]&company_name=ABS&company_number=98565855855&company_email=company@gmail.com&person_name=Kapil&person_number=755256658&person_email=kpl.ptdr@gmail.com&designation_id=35&description=description

    }


    public function edit()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($user_id) && !empty($id)){

            if(empty($city_id)){
                $city_id = 0;
            }
            if(empty($state_id)){
                $state_id = 0;
            }
            
           $ad_data = array(
                        'staff_id' => $user_id,
                        'company_name' => $company_name,
                        'company_number' => $company_number,
                        'company_email' => $company_email,
                        'person_name' => $person_name,
                        'person_number' => $person_number,
                        'person_email' => $person_email,
                        'address' => $address,
                        'state_id' => $state_id,
                        'city_id' => $city_id,
                        'designation_id' => $designation_id,
                        'description' => $description
                    );

            $update = $this->home_model->update('tblappleads', $ad_data,array('id'=>$id));

            $lead_id = $id;

            $result_file=handle_multi_expense_attachments($lead_id,'app_leads');

            if(!empty($staffid)){

                $staffid = json_decode($staffid);

                $delete = $this->home_model->delete('tbllappeadassignstaff', array('lead_id'=>$lead_id));
                
                foreach($staffid as $singlelead){
                            if($singlelead!=0)
                            {

                                $prdata['staff_id']=$singlelead;
                                $prdata['lead_id']=$lead_id;
                                $prdata['status']=1;

                                $this->db->insert('tbllappeadassignstaff',$prdata);

                                
                                    
                                    
                        }
                    }
            }


            if($update == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Lead Updated Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to Update Lead";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);


        //http://mustafa-pc/crm/App_lead/edit?user_id=1&staffid=[1,58]&company_name=ABS&company_number=98565855855&company_email=abs@gmail.com&person_name=Kapil Patidar&person_number=9752067095&person_email=kpl23.ptdr@gmail.com&designation_id=36&description=description edited&id=2

    }


    public function lead_details()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){
            $lead_info  = $this->db->query("SELECT * FROM tblappleads WHERE  id = '".$id."' ")->row();
        
            if(!empty($lead_info)){

                $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$lead_info->id,'rel_type'=>'app_leads'),  array('id'),'');
                if($files_count){
                    $count=count($files_count);
                }else{
                    $count=0;
                }

                //$main_list_info = $this->db->query("SELECT * FROM `tblleads` where id = '".$lead_info->lead_id."' ")->row(); 
                $leadstatus = '';
                if(!empty($main_list_info)){
                    $leadstatus = value_by_id("tblleadprocess", $main_list_info->process_id, "name");
                }

                $arr = array(
                    'id' => $lead_info->id,
                    'staff_id' => $lead_info->staff_id,
                    'company_name' => $lead_info->company_name,
                    'company_number' => $lead_info->company_number,
                    'company_email' => $lead_info->company_email,
                    'person_name' => $lead_info->person_name,
                    'person_number' => $lead_info->person_number,
                    'person_email' => $lead_info->person_email,
                    'designation_id' => $lead_info->designation_id,
                    'address' => $lead_info->address,
                    'state_id' => $lead_info->state_id,
                    'state_name' => (!empty($lead_info->state_id)) ? value_by_id('tblstates',$lead_info->state_id,'name') : '',
                    'city_id' => $lead_info->city_id,
                    'city_name' => (!empty($lead_info->city_id)) ? value_by_id('tblcities',$lead_info->city_id,'name') : '',
                    'designation_name' => (!empty($lead_info->designation_id)) ? value_by_id('tbldesignation',$lead_info->designation_id,'designation') : '',
                    'description' => $lead_info->description,
                    'status' => $lead_info->status,
                    'created_at'   => date('d-m-Y',strtotime($lead_info->created_at)),
                    'file_count' => $count,                    
                    'leadstatus' => $leadstatus                    
                );


                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $arr;


            }else{
                $return_arr['status'] = false;
                $return_arr['message'] = "Records not found!";
                $return_arr['data'] = [];

            }
           

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/App_lead/lead_details?id=2

    }



    public function lead_list()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        $where = "staff_id = '".$user_id."' ";

        if(!empty($from_date) && !empty($to_date)){
           
            $from_date = date('Y-m-d',strtotime($from_date));           
            $to_date = date('Y-m-d',strtotime($to_date));  

            $where .= " and created_at >= '".$from_date."' and created_at <= '".$to_date."' ";

        }else{
            $where .= " and YEAR(created_at) = '".date('Y')."' and MONTH(created_at) = '".date('m')."' ";
        }


        if($statusId == ''){
            
        }else{
            $where .= " and status = '".$statusId."' ";
        }

        $lead_info = $this->db->query("SELECT * FROM `tblappleads` where ".$where."  order by id desc")->result(); 
        if(!empty($lead_info)){
            foreach ($lead_info as $value) {


                $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'app_leads'),  array('id'),'');
                if($files_count){
                    $count=count($files_count);
                }else{
                    $count=0;
                }

                //$main_list_info = $this->db->query("SELECT * FROM `tblleads` where id = '".$value->lead_id."' ")->row(); 
                $leadstatus = '';
                if(!empty($main_list_info)){
                    $leadstatus = value_by_id("tblleadprocess", $main_list_info->process_id, "name");
                }


                $arr[] = array(
                    'id' => $value->id,
                    'company_name' => $value->company_name,
                    'company_number' => $value->company_number,
                    'person_name' => $value->person_name,
                    'person_number' => $value->person_number,
                    //'designation_name' => value_by_id('tbldesignation',$value->designation_id,'designation'),
                    'status' => $value->status,
                    'company_email' => $value->company_email,
                    'person_email' => $value->person_email,
                    'address' => $value->address,
                    'state_id' => $value->state_id,
                    'state_name' => (!empty($value->state_id)) ? value_by_id('tblstates',$value->state_id,'name') : '',
                    'city_id' => $value->city_id,
                    'city_name' => (!empty($value->city_id)) ? value_by_id('tblcities',$value->city_id,'name') : '',
                    'designation_name' => (!empty($value->designation_id)) ? value_by_id('tbldesignation',$value->designation_id,'designation') : '',
                    'designation_id' => $value->designation_id,
                    'description' => $value->description,
                    'created_at'   => date('d-m-Y',strtotime($value->created_at)),
                    'file_count' => $count,                    
                    'leadstatus' => $leadstatus                   
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

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/App_lead/lead_list?user_id=1&statusId=''&from_date=01-05-2019&to_date=30-06-2019

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
        $files = $this->home_model->get_result('tblfiles', array('rel_id'=>$id,'rel_type'=>'app_leads'),  array('id','file_name','filetype','rel_id','rel_type'),'');
        $result=array();
        foreach ($files as $file ) {
            $temp['id']=$file->id;
            $temp['rel_id']=$file->rel_id;
            $temp['file_name']=$file->file_name;
      
            $temp['file_path']=base_url('uploads/app_leads/'.$file->rel_id.'/'.$file->file_name);
            array_push($result, $temp);

        }

        $return_arr['file_list']=$result;
        header('Content-type: application/json');
        echo json_encode($return_arr);      
         //https://schachengineers.com/schacrm_test/Task_API/get_file?id=12&type=task 
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

    public function addSiteLead()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($name) && !empty($number) ){

           $ad_data = array(
                        'name' => $name,
                        'number' => $number,
                        'city' => $city,
                        'email' => $email,
                        'date' => date('Y-m-d'),
                    );

            $insert = $this->home_model->insert('tblsitelead',$ad_data);



            $return_arr['status'] = true;   
            $return_arr['message'] = "Lead added Successfully";

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);


        //http://mustafa-pc/crm/App_lead/addSiteLead?name=mustafa&number=9999999999&email=test@gmail.com&city=indore
    }

}
