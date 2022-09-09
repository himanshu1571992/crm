<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Petty_cash extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function department_list()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        $department_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  status = '1' and staff_id > 0 and staff_confirmed = 1 and staff_id != '".$user_id."' ")->result();

        if(!empty($department_info)){
            foreach ($department_info as $value) {


                $arr[] = array(
                    'id' => $value->id,
                    'department_name' => $value->department_name,
                    'manager_name' => get_employee_name($value->staff_id),
                    'amount' => $value->amount          
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

        //http://mustafa-pc/crm/Petty_cash/department_list?user_id=1

    }

    public function department_details()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){
            $department_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  id = '".$id."' ")->row();
        
            if(!empty($department_info)){


                $arr = array(
                    'id' => $department_info->id,
                    'department_name' => $department_info->department_name,
                    'amount' => $department_info->amount,
                    'staff_confirmed' => $department_info->staff_confirmed,
                    'manager_name' => get_employee_name($department_info->staff_id),
                    'description' => $department_info->description,
                    'created_at'   => date('d-m-Y',strtotime($department_info->created_at))
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
        //http://mustafa-pc/crm/Petty_cash/department_details?id=1

    }


    public function confirmation()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        $pettycash_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE id = '".$id."' ")->row();
     
        if($user_id == $pettycash_info->staff_id){
            if($pettycash_info->staff_confirmed == 0){

                $ad_data = array(
                    'staff_confirmed' => $staff_confirmed,
                    'staff_remark' => $staff_remark,
                    'payment_mode' => $payment_mode,
                    'status' => 1
                );                    
                    
                $update = $this->home_model->update('tblpettycashmaster', $ad_data,array('id'=>$id));  

                if($update){

                    if($pettycash_info->addedby > 0){

                        if($staff_confirmed == 1){
                            $description = 'Employee Confimed as a Petty Cash department Manger';
                        }else{
                            $description = 'Employee Reject as a Petty Cash department Manger';
                        }

                        $notified = add_notification([
                                'description'     => $description,
                                'touserid'        => $pettycash_info->addedby,
                                'table_id'        => $id,
                                'fromuserid'      => get_staff_user_id(),
                                'link'            => 'petty_cash',
                               
                            ]);
                            if ($notified) {
                                pusher_trigger_notification([$pettycash_info->addedby]);
                            }
                    }
                
                    $return_arr['status'] = true;  
                    $return_arr['message'] = "Record Updated Successfully";
                    $return_arr['data'] = [];
                }

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Record Already Updated !";
                $return_arr['data'] = [];
            }
        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Access Denied !";
          $return_arr['data'] = [];  
        }


        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Petty_cash/confirmation?id=1&user_id=25&staff_confirmed=1&staff_remark=app_approved

    }




    public function get_group_info()
    {

        $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());  
        }


        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }
        if(!empty($user_id)){
            //getting group info
            $stafff = array();
            
            //$Staffgroup = get_staff_group(14);
            $Staffgroup =  get_staff_group(18,$user_id);
            $i=0;
            foreach($Staffgroup as $singlestaff)
            {
                $stafff[$i]['id']=$singlestaff['id'];

                $stafff[$i]['name']=$singlestaff['name'];

                $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='".$user_id."' AND s.active = 1")->result_array();

                $stafff[$i]['staffs']=$query;
                $i++;

            }

            if(!empty($stafff)){
                $return_arr['group_info'] = $stafff;
            }else{
                $return_arr['msg'] = "Record Not Found!"; 
            }
        }


       header('Content-type: application/json');
       echo json_encode($return_arr);
        //http://mustafa-pc/crm/Petty_cash/get_group_info?user_id=1
    }

    public function add_request()
    {
        $return_arr = array();

        if(!empty($_GET))
        {
            extract($this->input->get());   
        }

        elseif(!empty($_POST)) 
        {
            extract($this->input->post());

        }


        if(!empty($user_id) && !empty($amount) ){

            $exist_request_info = $this->db->query("SELECT * from `tblpettycashrequest` where addedfrom = '".$user_id."' and approved_status = 0 and cancel = 0 ")->row();

            if(empty($exist_request_info)){
              
                if(empty($group_ids)){
                    $group_ids = '';
                }else{
                    $group_ids = json_decode($group_ids); 
                    $group_ids = implode(',',$group_ids);
                }

                if(empty($cash_received)){
                    $cash_received = 0;
                }

                $ad_data = array( 
                            'amount' => $amount,
                            'reason' => $reason,
                            'description' => $description,
                            'group_ids' => $group_ids,
                            'cash_received' => $cash_received,
                            'date' => date('Y-m-d'),
                            'dateadded' => date('Y-m-d H:i:s'),
                            'addedfrom' => $user_id
                        );


               $insert = $this->db->insert('tblpettycashrequest',$ad_data);


                if(!empty($staffid) && ($insert == true)){

                    $pettycash_id = $this->db->insert_id();

                    $staffid = json_decode($staffid);           


                    foreach($staffid as $singlelead)
                    {
                        if($singlelead!=0)
                        {
                        $prdata['staff_id']=$singlelead;
                        $prdata['pettycash_id']=$pettycash_id;
                        $prdata['status']=1;
                        $prdata['created_at'] = date("Y-m-d H:i:s");
                        $prdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblpettycashrequestapproval',$prdata);




                        //Sending Mobile Intimation
                        $token = get_staff_token($singlelead);
                        $message = 'Petty Cash Request Send to you for Approval';
                        $title = 'Schach';

                        $send_intimation = sendFCM($message, $title, $token);
                        
                            $full_name = get_employee_fullname($user_id);       
                            $notified_data = array(
                                        'description'     => 'Petty Cash Request Send to you for Approval',
                                        'touserid'        => $singlelead,
                                        'fromuserid'      => $user_id,
                                        'module_id'        => 9,
                                        'type'            => 1,
                                        'table_id'        => $pettycash_id,
                                        //'link'            => 'requests/request_approval/' . $pettycash_id.'',
                                        'from_fullname'    => $full_name,
                                        'date'             => date('Y-m-d H:i:s'),


                            );  
                            $insert_notified = $this->home_model->insert('tblnotifications', $notified_data);

                        }
                    }
                }


                if($pettycash_id) {
                    $return_arr['success'] = 'Petty Cash Request Added Successfully';
                }else{
                    $return_arr['error'] = 'Fail To Add Request';
                }
            }else{
                $return_arr['error'] = 'Your Request is Already is Process!';

            }

            


        }
        else
        {
            $return_arr['error'] = 'Request Parameters are Missing';

        }


       header('Content-type: application/json');
       echo json_encode($return_arr);

        //http://mustafa-pc/crm/Petty_cash/add_request?user_id=25&reason=Need Money&description=description&group_ids=14&staffid=[1]&amount=1100


    }



    public function approve_request()
    { 

      $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());
        }


        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }

        if(!empty($approve_status) && !empty($remark) && !empty($approved_amount) && !empty($user_id) && !empty($request_id)){

            $ldata = array(
                            'approve_status' => $approve_status,
                            'approvereason' => $remark,
                            'approved_amount' => $approved_amount,
                            'updated_at' => date('Y-m-d H:i:s'),
                    );

                    $success = $this->home_model->update('tblpettycashrequestapproval',$ldata,array('pettycash_id'=>$request_id,'staff_id'=>$user_id));
                    $request_info = $this->db->query("SELECT * from `tblpettycashrequest` where id = '".$request_id."' ")->row();          


                    $update_data = array(
                            'approved_status' => $approve_status,
                            'approved_amount' => $approved_amount,
                            'approved_remark' => $remark,
                    );

                  
                    $update_request = $this->home_model->update('tblpettycashrequest',$update_data,array('id'=>$request_id));           


                    if($update_request){        



                        if($approve_status==1){
                            $description = 'Petty Cash Request Approved Successfully'; 
                        }else{
                            $description = 'Petty Cash Request Decline';   
                        }   


                        //Sending Mobile Intimation
                        $token = get_staff_token($request_info->addedfrom);
                        //$message = 'You Have Request for Approval';
                        $title = 'Schach';
                        $send_intimation = sendFCM($description, $title, $token);   

                        //Adding Notificaion

                        $full_name = get_employee_fullname($user_id);   

                        $notified_data = array(
                                    'description'     => $description,
                                    'touserid'        => $request_info->addedfrom,
                                    'fromuserid'      => $user_id,
                                    'module_id'       => 9,
                                    'type'            => 2,
                                    'table_id'        => $request_id,
                                   // 'link'            => 'requests/request_comfirm/'.$request_id,
                                    'from_fullname'    => $full_name,
                                    'date'             => date('Y-m-d H:i:s'),
                        );  

                        $insert_notified = $this->home_model->insert('tblnotifications', $notified_data);   


                        $return_arr['status'] = true;   
                        $return_arr['message'] = "Record Added Successfully";
                        $return_arr['data'] = '';   

                    }
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Petty_cash/approve_request?user_id=1&approve_status=1&remark=Approved&approved_amount=500&request_id=1

    }

    public function get_user_request()
    { 


      $return_arr = array();

        if(!empty($_GET))
        {
            extract($this->input->get());

        }


        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }


        if(!empty($user_id)){

            $from_date = date('Y-m-d', strtotime(' - 30 days'));

            $request_list = $this->db->query("SELECT * FROM `tblpettycashrequest` where cancel = 0 and  addedfrom = '".$user_id."' and date > '".$from_date."'  ORDER by id desc")->result();


               if(!empty($request_list)){

                   foreach($request_list as $row){

                    if($row->approved_amount > 0){
                        $amount = $row->approved_amount;
                    }else{
                        $amount = $row->amount;
                    }


                    $staff_details = $this->home_model->get_result('tblpettycashrequestapproval', array('pettycash_id'=>$row->id),  array('staff_id'),'');

                    $staff_names = '';


                    foreach ($staff_details  as $staffid) {
                        $staff_names.=get_employee_fullname($staffid->staff_id).',';
                    }


                    $staff_names=substr($staff_names, 0, -1);
                    if(empty($staff_names))
                    {
                        $staff_names="";

                    }


                    $group_name = '';
                    if(!empty($row->group_ids)){
                        $group_arr = explode(',',$row->group_ids);

                        if(!empty($group_arr)){
                            foreach($group_arr as $group_id){
                                $group_info = $this->home_model->get_row('tblstaffgroup', array('id'=>$group_id), '');
                                if(!empty($group_info)){
                                    $group_name .= $group_info->name.' ,';
                                }
                            }
                        }                       
                    }


                    $get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$row->id,'module_id'=>9,'isread'=>1,'type '=>1, 'for_manager_approval' =>0),  array('id','readdate','touserid'),'');

                    $notification_read_by=array();

                    if($get_notification_user_info)
                    {
                        foreach ($get_notification_user_info as $notification_user) {
                            $temp_data['name'] = get_employee_fullname($notification_user->touserid);
                            $temp_data['read_date']=$notification_user->readdate;
                            array_push($notification_read_by, $temp_data);
                        }
                    }

               
                    $array = array(
                        'id' => $row->id,   
                        'amount' => $amount,
                        'group_name' => $group_name,
                        'reason' => $row->reason,
                        'description' => $row->description, 
                        'approved_status' => $row->approved_status,
                        'date' => date('d/m/Y H:i a',strtotime($row->dateadded)),
                        'request_names'=>$staff_names,
                        'read_by_user' =>$notification_read_by,
                    );

                    $return_arr['request_list'][] = $array;

                   }

               }else{
                  $return_arr['msg'] = "Record Not Found!"; 
               }    

        }

       header('Content-type: application/json');
       echo json_encode($return_arr);


       //http://mustafa-pc/crm/Petty_cash/get_user_request?user_id=1


    }


    public function get_single_request()
    { 

      $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }


        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }


        if(!empty($request_id)){


            $request_info = $this->home_model->get_row('tblpettycashrequest', array('id'=>$request_id), '');


               if(!empty($request_info)){


                    $group_name = '';
                    if(!empty($request_info->group_ids)){
                        $group_arr = explode(',',$request_info->group_ids);
                        if(!empty($group_arr)){

                            foreach($group_arr as $group_id){
                                $group_info = $this->home_model->get_row('tblstaffgroup', array('id'=>$group_id), '');  
                                if(!empty($group_info)){
                                    $group_name .= $group_info->name.' ,';
                                }
                            }
                        }
                    }


                    if($request_info->cancel==1)
                    {
                        $status_cancel="true";
                        $approved_status="3";
                    }
                    else
                    {
                        $status_cancel="false";
                        $approved_status=$request_info->approved_status;
                    }


                    $approve_info = $this->home_model->get_result('tblpettycashrequestapproval', array('pettycash_id'=>$request_id),  array('staff_id','updated_at','approve_status','approvereason'),'');


                    $staff_ids = '';
                    $staff_dates ='--';
                    $approved_id ='0';
                    $remark='--';
                    foreach ($approve_info  as $staffid) {
                        $staff_ids.=$staffid->staff_id.','; 
                        if($staffid->approve_status == 1 || $staffid->approve_status == 2 )
                        {
                            $staff_dates= $staffid->updated_at; 
                            $approved_id = $staffid->staff_id;
                            $remark = $staffid->approvereason;

                        }
                    }
                    $staff_ids=substr($staff_ids, 0, -1);
                    $group_name = rtrim($group_name,",");

                    $pettycash_balance = 0;
                    $pettycash_info = $this->home_model->get_row('tblpettycashmaster', array('staff_id'=>$request_info->addedfrom,'staff_confirmed'=>1,'status'=>1), '');
                    if(!empty($pettycash_info)){
                        $pettycash_balance = $pettycash_info->amount;
                    }
                    


                    $array = array(
                        'id' => $request_id,
                        'request_amount' => $request_info->amount,  
                        'approved_amount' => $request_info->approved_amount,
                        'group_name' => $group_name,
                        'reason' => $request_info->reason,
                        'description' => $request_info->description,
                        'confirmed_by_user' => $request_info->confirmed_by_user,   
                        'group_ids' =>$request_info->group_ids,
                        'cash_received' =>$request_info->cash_received,
                        'approved_status' =>$approved_status,
                        'cancel_status' =>$status_cancel,
                        'confirmed_date' => $request_info->confirmed_date,
                        'approved_date' => $staff_dates,
                        'staffids' => $staff_ids,
                        'remark' => $remark,
                        'pettycash_balance' => $pettycash_balance,
                        'approved_by' => ($approved_id > 0) ? get_employee_fullname($approved_id) : '',
                        'date' => date('d/m/Y H:i:s',strtotime($request_info->dateadded)),
                        'note' =>$request_info->description
                    );

                    $return_arr['request_info'] = $array;
                    $return_arr['msg'] = "Success"; 

                    $get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$request_id,'module_id'=>9,'type'=>1,'for_manager_approval'=>0),  array('id','readdate','touserid','isread'),'');
                    $notification_read_by=array();
                    if($get_notification_user_info)
                    {

                        foreach($get_notification_user_info as $notification_user){
                            if($notification_user->isread == 1){
                                $read_date = $notification_user->readdate;
                            }else{
                                $read_date = 'Not Yet';
                            }
                
                            $notification_read_by[] = array(

                                    'name' => get_employee_fullname($notification_user->touserid),
                                    'read_date' => $read_date,
                            );
                        }
                    }

                    $return_arr['read_by_user']=$notification_read_by;


               }else{
                  $return_arr['msg'] = "Record Not Found!";
               }
        }

       header('Content-type: application/json');
       echo json_encode($return_arr);


       //http://mustafa-pc/crm/Petty_cash/get_single_request?request_id=1


    }


    public function get_request_approved_info()
    { 

      $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }
        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }

        if(!empty($confirmation_remark) && !empty($receive_status) && !empty($request_id)){     

                   
                    $ldata = array(
                            'confirmed_by_user' => 1,
                            'receive_status' => $receive_status,
                            'user_confirmation_remark' => $confirmation_remark,
                            'confirmation_payment_mode' => $payment_mode,
                            'confirmed_date' => date('Y-m-d H:i:s'),
                    );

                    $success = $this->home_model->update('tblpettycashrequest',$ldata,array('id'=>$request_id));
                    $request_info = $this->home_model->get_row('tblpettycashrequest', array('id'=>$request_id), '');
                   
                    //Adding petty cash amount
                    if($receive_status == 1){
                        $pettycash_info = $this->home_model->get_row('tblpettycashmaster', array('staff_id'=>$request_info->addedfrom,'staff_confirmed'=>1,'status'=>1), '');
                        if(!empty($pettycash_info)){
                            $n_pettyamt = ($request_info->approved_amount + $pettycash_info->amount);
                            $this->home_model->update('tblpettycashmaster',array('amount'=>$n_pettyamt),array('id'=>$pettycash_info->id));

                            $ad_data = array( 
                                    'pettycash_id' => $pettycash_info->id,
                                    'manager_id' => $pettycash_info->staff_id,
                                    'request_id' => $request_id,
                                    'amount' => $request_info->approved_amount,
                                    'balance' => $n_pettyamt,
                                    'type ' => 1,
                                    'status' => 1,
                                    'date' => date('Y-m-d'),
                                    'date_time' => date('Y-m-d H:i:s')
                                );

                           $insert = $this->db->insert('tblpettycashlogs',$ad_data);
                        }
                    }

                    

                    if($success){
                        $return_arr['success'] = 'Petty Cash Request Confirmed Successfully';
                    }else{
                        $return_arr['error'] = 'Fail to update';
                    }        
        }else{
            $return_arr['error'] = 'Request Parameters are Missing';
        }

       header('Content-type: application/json');
       echo json_encode($return_arr);
       //http://mustafa-pc/crm/Petty_cash/get_request_approved_info?request_id=1&confirmation_remark=Thanks&payment_mode=1&receive_status=1


    }


    public function request_cancel()
    {

          $return_arr = array();

            if(!empty($_GET))
            {
                extract($this->input->get());   
            }

            elseif(!empty($_POST)) 
            {
                extract($this->input->post());
            }

            if(!empty($request_id) && !empty($user_id))
            {
                $ldata = array(
                 'cancel' => $cancel_status,
                );                  

            $update_request = $this->home_model->update('tblpettycashrequest',$ldata,array('id'=>$request_id));

            if($update_request){
                        $this->db->where('table_id', $request_id);
                        $this->db->where('module_id',9);
                        $this->db->delete('tblnotifications');

                        $return_arr['status'] = true;
                        $return_arr['message'] = "Request Cancelled successfully";
                        $return_arr['data'] = '';  

                    }
            }else{

            $return_arr['status'] = false;
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }


        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Petty_cash/request_cancel?user_id=25&cancel_status=1&request_id=3

    }



    public function edit_request()
    {
        $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());

        }


        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }

        if(!empty($user_id)  && !empty($amount) && !empty($request_id)){

                if(empty($group_ids)){
                    $group_ids = '';
                }else{
                    $group_ids = json_decode($group_ids);
                    $group_ids = implode(',',$group_ids);
                }

                if(empty($cash_received)){
                    $cash_received = 0;
                }

                $ad_data = array(
                            'amount' => $amount,
                            'reason' => $reason,
                            'description' => $description,
                            'group_ids' => $group_ids,
                            'cash_received' => $cash_received,
                            'date' => date('Y-m-d'),
                            'dateadded' => date('Y-m-d H:i:s'),
                            'addedfrom' => $user_id
                        );

                $success = $this->home_model->update('tblpettycashrequest', $ad_data,array('id'=>$request_id));  
                if(!empty($staffid)){
                    $staffid = json_decode($staffid);
                    $this->db->where('pettycash_id', $request_id);
                    $this->db->delete('tblpettycashrequestapproval');
                    $this->db->where('table_id', $request_id);
                    $this->db->where('module_id',9);
                    $this->db->delete('tblnotifications');  

                    foreach($staffid as $singlelead)
                    {
                        if($singlelead!=0)
                        {
                        $prdata['staff_id']=$singlelead;
                        $prdata['pettycash_id']=$request_id;
                        $prdata['status']=1;
                        $prdata['created_at'] = date("Y-m-d H:i:s");
                        $prdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblpettycashrequestapproval',$prdata);

                        //Sending Mobile Intimation
                        $token = get_staff_token($singlelead);
                        $message = 'Updated Petty Cash Request Send to you for Approval';
                       $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token);
                            $full_name = get_employee_fullname($user_id);  
                            $notified_data = array(
                                        'description'     => 'Petty Cash Request Send to you for Approval',
                                        'touserid'        => $singlelead,
                                        'fromuserid'      => $user_id,
                                        'module_id'        => 9,
                                        'type'            => 1,
                                        'table_id'        => $request_id,
                                        //'link'            => 'requests/request_approval/' . $pettycash_id.'',
                                        'from_fullname'    => $full_name,
                                        'date'             => date('Y-m-d H:i:s'),
                            );   

                            $insert_notified = $this->home_model->insert('tblnotifications', $notified_data); 
                        }
                    }
                }

                if($request_id) {
                    $return_arr['success'] = 'Petty Cash Request Updated Successfully';     
                }else{
                    $return_arr['error'] = 'Fail To Add Request';
                }
        }

       header('Content-type: application/json');
       echo json_encode($return_arr);

        //http://mustafa-pc/crm/Petty_cash/edit_request?user_id=25&reason=Need Money&description=description&group_ids=[14]&staffid=[1]&amount=1100&request_id=1
    }


    public function get_single_request_details()
    { 

      $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());   
        }


        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }


        if(!empty($table_id)){


            $approval_info = $this->home_model->get_row('tblpettycashapproved', array('id'=>$table_id), '');
            $request_id = $approval_info->request_id;
            $request_info = $this->home_model->get_row('tblrequests', array('id'=>$request_id), '');


               if(!empty($request_info)){


                    $group_name = '';
                    if(!empty($request_info->group_ids)){
                        $group_arr = explode(',',$request_info->group_ids);
                        if(!empty($group_arr)){

                            foreach($group_arr as $group_id){
                                $group_info = $this->home_model->get_row('tblstaffgroup', array('id'=>$group_id), '');  
                                if(!empty($group_info)){
                                    $group_name .= $group_info->name.' ,';
                                }
                            }
                        }
                    }


                    if($request_info->cancel==1)
                    {
                        $status_cancel="true";
                        $approved_status="3";
                    }
                    else
                    {
                        $status_cancel="false";
                        $approved_status=$approval_info->approved_status;
                    }


                    $approve_info = $this->home_model->get_result('tblrequestapproval', array('request_id'=>$request_id),  array('staff_id','updated_at','approve_status','approvereason'),'');


                    $staff_ids = '';
                    $staff_dates ='--';
                    $approved_id ='0';
                    $remark='--';
                    foreach ($approve_info  as $staffid) {
                        $staff_ids.=$staffid->staff_id.','; 
                        if($staffid->approve_status == 1 || $staffid->approve_status == 2 )
                        {
                            $staff_dates= $staffid->updated_at; 
                            $approved_id = $staffid->staff_id;
                            $remark = $staffid->approvereason;

                        }
                    }
                    $staff_ids=substr($staff_ids, 0, -1);
                    $group_name = rtrim($group_name,",");

                    //Getting Category
                    $tenure_info = $this->home_model->get_row('tblloantenues', array('id'=>$request_info->tenure), '');
                    if(!empty($tenure_info)){
                        $tenure_name = $tenure_info->name;
                    }else{
                        $tenure_name = '--';
                    }

                    $on_behalf_name = '';
                    $on_behalf = '0';
                    $on_behalf_branch = '0';
                    if($request_info->addedby > 0){
                        $on_behalf = $request_info->addedfrom;
                        $on_behalf_branch = employee_single_branch($request_info->addedfrom);
                        $on_behalf_name = get_employee_fullname($request_info->addedfrom);
                    }

                    $pay_to_staff = get_employee_fullname($request_info->addedfrom);
                    //Getting loan balance
                    $wallet_amount = wallet_amount($request_info->addedfrom,'','');
                    $advance_amt = get_staff_advance_salary_month($request_info->addedfrom);
                    $loan_amt = get_loan_installment($request_info->addedfrom);
                    $expense_amt_info = $this->db->query("SELECT   COALESCE(SUM(amount),0) as ttl_amt from `tblexpenses` where (addedfrom = '".$request_info->addedfrom."' || paidby_employee = '".$request_info->addedfrom."') and (paidby_employee = '0' || paidby_employee = '".$request_info->addedfrom."') and approved_status = 0 and save_status = 0 and status = 1 and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ")->row();

                    $array = array(
                        'id' => $request_id,
                        'request_amount' => $request_info->amount,  
                        'approved_amount' => $request_info->approved_amount,
                        'group_name' => $group_name,
                        'reason' => $request_info->reason,
                        'description' => $request_info->description,
                        'confirmed_by_user' => $request_info->confirmed_by_user,
                        'tenure_id' =>  $request_info->tenure,
                        'tenure_name' =>  $tenure_name,
                        'category_id' =>  $request_info->category,
                        'branch'    => $request_info->branch,
                        'payment_mode'  => $request_info->payment_mode,
                        'group_ids' =>$request_info->group_ids,
                        'person_id' => $request_info->person_id,
                        'approved_status' =>$approved_status,
                        'cancel_status' =>$status_cancel,
                        'confirmed_date' => $request_info->confirmed_date,
                        'approved_date' => $staff_dates,
                        'staffids' => $staff_ids,
                        'remark' => $remark,
                        'approved_by' => $full_name = get_employee_fullname($approved_id),
                        'date' => date('d/m/Y H:i:s',strtotime($request_info->dateadded)),
                        'note' =>$request_info->description,
                        'on_behalf_name' =>$on_behalf_name,
                        'on_behalf' =>$on_behalf,
                        'on_behalf_branch' =>$on_behalf_branch,
                        'pay_to_staff' =>$pay_to_staff,
                        'wallet_amount' => number_format($wallet_amount, 2, '.', ''),
                        'advance_amt'=>$advance_amt,
                        'loan_amt'=>$loan_amt,
                        'expense_amt'=>$expense_amt_info->ttl_amt
                    );

                    $return_arr['request_info'] = $array;
                    $return_arr['msg'] = "Success"; 

                    $get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$request_id,'module_id'=>1),  array('id','readdate','touserid','isread'),'');
                    $notification_read_by=array();
                    if($get_notification_user_info)
                    {

                        foreach($get_notification_user_info as $notification_user){
                            if($notification_user->isread == 1){
                                $read_date = $notification_user->readdate;
                            }else{
                                $read_date = 'Not Yet';
                            }
                
                            $notification_read_by[] = array(

                                    'name' => get_employee_fullname($notification_user->touserid),
                                    'read_date' => $read_date,
                            );
                        }
                    }

                    $return_arr['read_by_user']=$notification_read_by;


               }else{
                  $return_arr['msg'] = "Record Not Found!";
               }
        }

       header('Content-type: application/json');
       echo json_encode($return_arr);


       //https://schachengineers.com/schacrm_test/Petty_cash/get_single_request_details?table_id=1

    }


public function approve_request_by_manager()
    { 

      $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());
        }


        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }

        if(!empty($approve_status) && !empty($remark) && !empty($user_id) && !empty($request_id)){

                    $managerrequest_info  = $this->db->query("SELECT * FROM tblpettycashapproved WHERE  id = '".$request_id."' ")->row();  
                    $request_info = get_request_info($managerrequest_info->request_id); 
                    $pettycash_master_info = $this->home_model->get_row('tblpettycashmaster', array('id'=>$managerrequest_info->pettycash_id), '');

                    if($pettycash_master_info->amount >= $managerrequest_info->amount){
                        
						$ldata = array(
                                'approved_status' => $approve_status,
                                'approvereason' => $remark
                        );
						$update = $this->home_model->update('tblpettycashapproved',$ldata,array('id'=>$request_id));                    

                         if($update){   
                            //update Request
                            $update_request = $this->home_model->update('tblrequests',array('approved_status'=>$approve_status,'manager_approved_status'=>1),array('id'=>$managerrequest_info->request_id));


                                                      
                            if($approve_status==1){
                                $description = 'Request Approved by Petty Cash'; 
								
								//Manage petty cash amount
								if($request_info->category != 4 && $request_info->pettycash_id > 0 && $request_info->by_pettycash == 1){
									$pettycash_info = $this->home_model->get_row('tblpettycashmaster', array('id'=>$request_info->pettycash_id), '');
									if(!empty($pettycash_info)){
										$n_pettyamt = ($pettycash_info->amount - $request_info->approved_amount);
										$this->home_model->update('tblpettycashmaster',array('amount'=>$n_pettyamt),array('id'=>$pettycash_info->id));

										$ad_data = array( 
												'pettycash_id' => $pettycash_info->id,
												'manager_id' => $pettycash_info->staff_id,
												'request_id' => $managerrequest_info->request_id,
												'amount' => $request_info->approved_amount,
												'balance' => $n_pettyamt,
												'type ' => 2,
												'status' => 1,
												'date' => date('Y-m-d'),
												'date_time' => date('Y-m-d H:i:s')
											);

									   $insert = $this->db->insert('tblpettycashlogs',$ad_data);
									}
								}
								
								
								
                            }else{
                                $description = 'Request Decline';   
                            }   


                                if($request_info->addedby > 0){

                                    //Sending Mobile Intimation
                                    $token = get_staff_token($request_info->addedby);
                                    //$message = 'You Have Request for Approval';
                                    $title = 'Schach';
                                    $send_intimation = sendFCM($description, $title, $token);   

                                    //Adding Notificaion
                                    $full_name = get_employee_fullname($user_id);   

                                    $notified_data = array(
                                                'description'     => $description,
                                                'touserid'        => $request_info->addedby,
                                                'fromuserid'      => $user_id,
                                                'module_id'       => 1,
                                                'type'            => 2,
                                                'table_id'        => $managerrequest_info->request_id,
                                                'category_id'     => $request_info->category,
                                                'link'            => 'requests/request_comfirm/'.$managerrequest_info->request_id,
                                                'from_fullname'    => $full_name,
                                                'date'             => date('Y-m-d H:i:s'),
                                    );  

                                    $insert_notified = $this->home_model->insert('tblnotifications', $notified_data);   

                                }

                           
                                //Sending Mobile Intimation
                                $token = get_staff_token($request_info->addedfrom);
                                //$message = 'You Have Request for Approval';
                                $title = 'Schach';
                                $send_intimation = sendFCM($description, $title, $token);   

                                //Adding Notificaion

                                $full_name = get_employee_fullname($user_id);
                                $notified_data = array(
                                            'description'     => $description,
                                            'touserid'        => $request_info->addedfrom,
                                            'fromuserid'      => $user_id,
                                            'module_id'       => 1,
                                            'type'            => 2,
                                            'table_id'        => $managerrequest_info->request_id,
                                            'category_id'     => $request_info->category,
                                            'link'            => 'requests/request_comfirm/'.$managerrequest_info->request_id,
                                            'from_fullname'    => $full_name,
                                            'date'             => date('Y-m-d H:i:s'),
                                );  

                            $insert_notified = $this->home_model->insert('tblnotifications', $notified_data);     


                            $return_arr['status'] = true;   
                            $return_arr['message'] = "Record Added Successfully";
                            $return_arr['data'] = '';   

                        }
                    }else{
						$return_arr['status'] = false;  
                        $return_arr['message'] = "Insufficient petty cash balance. Request for petty cash first!";
                        $return_arr['data'] = '';	
                    }
                    
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);


        //https://schachengineers.com/schacrm_test/Petty_cash/approve_request_by_manager?user_id=25&approve_status=1&remark=Approved&approved_amount=500&request_id=2


    }



    public function pettycash_history()
    {
      $return_arr = array();
        if(!empty($_GET))
        {
            extract($this->input->get());
        }

        elseif(!empty($_POST)) 
        {
            extract($this->input->post());
        }


        if(!empty($user_id)){

            $department_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  staff_id = '".$user_id."' and staff_confirmed = 1")->row();

            if(!empty($department_info)){

                $where = " pettycash_id = '".$department_info->id."' and manager_id = '".$user_id."' ";
                if(!empty($from_date) && !empty($to_date)){
                    $from_date = date('Y-m-d',strtotime($from_date));
                    $to_date = date('Y-m-d',strtotime($to_date));
                    $where .= " and date between '".$from_date."' and '".$to_date."'";

                }

                $pettycash_log  = $this->db->query("SELECT * FROM tblpettycashlogs WHERE  ".$where." order by id desc ")->result();

                if(!empty($pettycash_log)){
                    foreach ($pettycash_log as $row) {

                        
                        if($row->type == 1 && $row->by_transfer == 0){
                            $request_info  = $this->db->query("SELECT * FROM tblpettycashrequest WHERE  id = '".$row->request_id."' ")->row();

                            $reference_id = 'REQ-PETTY-'.number_series($request_info->id);
                            $staff_name = 'Self';                            
                        }else{
                            $request_info  = $this->db->query("SELECT * FROM tblrequests WHERE  id = '".$row->request_id."' ")->row();

                            $cat = get_last(get_request_category($request_info->category));       
                            $reference_id = 'REQ-'.get_short($cat).'-'.number_series($request_info->id);
                            $staff_name = get_employee_name($request_info->addedfrom);
                        }

                        $remark = '';
                        if(!empty($request_info)){
                            $remark = $request_info->reason;
                        }

                        $array[] = array(
                            'id' => $row->id,
                            'reference_id' => $reference_id,
                            'date' => date('d-m-Y H:i a',strtotime($row->date_time)),
                            'type' => $row->type,
                            'amount' => $row->amount,
                            'balance' => $row->balance,
                            'staff_name' => $staff_name,
                            'remark' => $remark,
                        );


                    }


                    $return_arr['status'] = true;  
                    $return_arr['message'] = "Success";
                    $return_arr['data'] = $array;
                    $return_arr['department_name'] = $department_info->department_name;
                    $return_arr['amount'] = $department_info->amount;
                }else{
                    $return_arr['status'] = false;  
                    $return_arr['message'] = "Record not found!";
                    $return_arr['data'] = [];
                    $return_arr['department_name'] = $department_info->department_name;
                    $return_arr['amount'] = $department_info->amount;
                }  

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Petty cash department is not assigned!";
                $return_arr['data'] = [];
                $return_arr['department_name'] = '';
                $return_arr['amount'] = 0;
            } 

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
            $return_arr['department_name'] = '';
            $return_arr['amount'] = 0;
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Petty_cash/pettycash_history?user_id=25
    }

   

}
