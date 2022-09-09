<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Payment_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();   
		$this->load->model('home_model');

    }

    public function getMasters()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

      $category_info  = $this->db->query("SELECT * from tblcompanyexpensecatergory where status = 1 order by id asc")->result_array();
      $bank_info = $this->db->query("SELECT `id`,`name` FROM `tblbankmaster` where status= '1' ")->result_array();
      $paymentmethod_info  = $this->db->query("SELECT `id`,`name` from tblpaymentmethod where status = 1 ")->result_array();

      $data_array =  array('category_data' => $category_info, 'bank_data' =>$bank_info, 'paymentmethod_data' => $paymentmethod_info);


        $return_arr['status'] = true;
        $return_arr['message'] = 'Success';
        $return_arr['data'] = $data_array;

        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Payment_API/getMasters?user_id=1

    }


    public function getPayeeInfo()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        $iteam_arr = array();


        $payment_info  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory WHERE id = '".$category_id."'")->row();
        if(!empty($payment_info)){
          
          if($payment_info->id == 1){
                $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
            }elseif($payment_info->id == 2){
                $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where status = '1' ")->result();  
            }else{
                $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where category_id = '".$payment_info->id."' and status = '1' ")->result(); 
            }

          foreach ($payee_info as $row) {
              $iteam_arr[] = array(
                  'id' => $row->id,             
                  'category_id' => $category_id,             
                  'name' => $row->name
              );
          }

          $return_arr['status'] = true;
          $return_arr['message'] = 'Success';
          $return_arr['data'] = $iteam_arr;
        }else{
          $return_arr['status'] = false;
          $return_arr['message'] = 'Record not found!';
          $return_arr['data'] = [];
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Payment_API/getPayeeInfo?category_id=1

    }


    public function getPayeeNameInfo()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        $iteam_arr = array();

        if(!empty($category_id) && !empty($payee_id)){

            if($category_id == 1){
              $payee_info = $this->db->query("SELECT * FROM `tblstaff` where active = '1' and staffid = '".$payee_id."' ")->row();
                $iteam_arr = array(            
                    'IFSC_Code' => $payee_info->ifsc_code,
                    'Account_No' => $payee_info->account_no
                );

              }elseif($category_id == 2){
                $payee_info = $this->db->query("SELECT * FROM `tblvendor` where status = '1' and id = '".$payee_id."'")->row();  
                 $iteam_arr = array(             
                    'IFSC_Code' => $payee_info->ifsc,
                    'Account_No' => $payee_info->account_no
                );
              }else{
                $payee_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$category_id."' and id = '".$payee_id."' and status = '1' ")->row(); 
                  $iteam_arr = array(             
                    'IFSC_Code' => $payee_info->ifsc,
                    'Account_No' => $payee_info->account_no
                  );                
              }

            $return_arr['status'] = true;
            $return_arr['message'] = 'Success';
            $return_arr['data'] = $iteam_arr;
        }else{
            $return_arr['status'] = false;
            $return_arr['message'] = 'Record not found!';
            $return_arr['data'] = null;
        }
          

        

        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Payment_API/getPayeeNameInfo?category_id=1&payee_id=1

    }
    
    public function add_request()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($user_id) && !empty($requestData) ){
           $requestData = json_decode($requestData);
            /*echo '<pre/>';
            print_r($requestData);
            die;*/
          $ad_data = array(                            
                'staff_id' => $user_id,
                'remark' => $remark,
                'created_at' => date('Y-m-d'),
                'status' => 1
            );
          if($this->home_model->insert('tblbankpaymentrequest', $ad_data)){
              $main_id = $this->db->insert_id();
              if(!empty($requestData)){
                  foreach ($requestData as $key => $value) {

                       $date = db_date($value->date);

                       
                       $fromdate = '0000-00-00';
                       $todate = '0000-00-00';
                       $deposit = '0';
                       if(!empty($value->fromdate)){
                            $fromdate = db_date($value->fromdate);
                       }
                       
                       if(!empty($value->todate)){
                            $todate = db_date($value->todate);
                       } 

                       if(!empty($value->deposit)){
                            $deposit = $value->deposit;
                       }    


                        $ad_data_1 = array(                            
                            'main_id' => $main_id,
                            'date' => $date,
                            'category_id' => $value->category_id,
                            'bank_id' => $value->bank_id,
                            'payee_id' => $value->payee_id,
                            'ifsc' => $value->ifsc,
                            'account' => $value->account,
                            'method' => $value->method,
                            'type' => $value->type,
                            'amount' => $value->amount,
                            'first_remark' => $value->first_remark,
                            'second_remark' => $value->second_remark,
                            'fromdate' => $fromdate,
                            'todate' => $todate,
                            'deposit' => $deposit,
                        );

                        $insert_1 = $this->home_model->insert('tblbankpaymentrequestdetails', $ad_data_1);


                        
                    }
              }

              $return_arr['status'] = true;   
              $return_arr['message'] = "Request added Successfully";
              $return_arr['data'] = [];

          }      


        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Required Parameters are missing";
          $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Payment_API/add_request?user_id=1&remark=XYZ&requestData=[{"category_id":"1","date":"10/06/2020","payee_id":"27","ifsc":"BOB55E","account":"180002255522","bank_id":"2","method":"NEFT","type":"RPAY","amount":"5200","first_remark":"FIRST","second_remark":"SECOND","fromdate":"0000-00-00","todate":"0000-00-00","deposit":"0"},{"category_id":"3","date":"11/06/2020","payee_id":"1","ifsc":"KOTAK","account":"11122352245","bank_id":"3","method":"NEFT","type":"RPAY","amount":"5300","first_remark":"FIRST2","second_remark":"SECOND2","fromdate":"10/06/2020","todate":"10/07/2020","deposit":"45000"}]
    }

    public function edit_request()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($user_id) && !empty($requestData) && !empty($id)){
           $requestData = json_decode($requestData);
            /*echo '<pre/>';
            print_r($requestData);
            die;*/
          $ad_data = array(                            
                'staff_id' => $user_id,
                'remark' => $remark,
                'status' => 1
            );
          if($this->home_model->update('tblbankpaymentrequest', $ad_data,array('id'=>$id))){
              $this->home_model->delete('tblbankpaymentrequestdetails', array('main_id'=>$id));
              if(!empty($requestData)){
                  foreach ($requestData as $key => $value) {

                       $date = db_date($value->date);

                       
                       $fromdate = '0000-00-00';
                       $todate = '0000-00-00';
                       $deposit = '0';
                       if(!empty($value->fromdate)){
                            $fromdate = db_date($value->fromdate);
                       }
                       
                       if(!empty($value->todate)){
                            $todate = db_date($value->todate);
                       } 

                       if(!empty($value->deposit)){
                            $deposit = $value->deposit;
                       }    


                        $ad_data_1 = array(                            
                            'main_id' => $id,
                            'date' => $date,
                            'category_id' => $value->category_id,
                            'bank_id' => $value->bank_id,
                            'payee_id' => $value->payee_id,
                            'ifsc' => $value->ifsc,
                            'account' => $value->account,
                            'method' => $value->method,
                            'type' => $value->type,
                            'amount' => $value->amount,
                            'first_remark' => $value->first_remark,
                            'second_remark' => $value->second_remark,
                            'fromdate' => $fromdate,
                            'todate' => $todate,
                            'deposit' => $deposit,
                        );

                        $insert_1 = $this->home_model->insert('tblbankpaymentrequestdetails', $ad_data_1);


                        
                    }
              }

              $return_arr['status'] = true;   
              $return_arr['message'] = "Request updated Successfully";
              $return_arr['data'] = [];

          }      


        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Required Parameters are missing";
          $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Payment_API/edit_request?id=2&user_id=1&remark=XYZEdit&requestData=[{"category_id":"1","date":"10/06/2020","payee_id":"27","ifsc":"BOB55E","account":"180002255522","bank_id":"2","method":"NEFT","type":"RPAY","amount":"5200","first_remark":"FIRST","second_remark":"SECOND","fromdate":"0000-00-00","todate":"0000-00-00","deposit":"0"},{"category_id":"3","date":"11/06/2020","payee_id":"1","ifsc":"KOTAK","account":"11122352245","bank_id":"3","method":"NEFT","type":"RPAY","amount":"5300","first_remark":"FIRST2","second_remark":"SECOND2","fromdate":"10/06/2020","todate":"10/07/2020","deposit":"45000"}]
    }


    public function get_request_list()
    { 
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        $where = "id > 0";
        if(!empty($f_date) && !empty($t_date))
        {
          $f_date = str_replace("/","-",$f_date);
          $t_date = str_replace("/","-",$t_date);

          $from_date = date('Y-m-d',strtotime($f_date));           
          $to_date = date('Y-m-d',strtotime($t_date));

          $where .= " and created_at  BETWEEN  '".$from_date."' and  '".$to_date."' ";
          
        }
        $request_details = $this->db->query("SELECT * from tblbankpaymentrequest where  ".$where." ")->result();

        if(!empty($request_details))
        { 
            foreach ($request_details as $row) {

              $amount_detail = $this->db->query("SELECT * from tblbankpaymentrequestdetails WHERE main_id = '".$row->id."' ")->result();
              $sum = 0;
              foreach ($amount_detail as $amount) {
                  $sum+= $amount->amount;
              }

              $from_name = '';
                if($row->staff_id){
                    $from_name = get_employee_name($row->staff_id); 
                }

              $data_arr[] = array(
                      'id' => $row->id,
                      'req_id' => 'REQ-'.$row->id,
                      'staff_name' => $from_name,
                      'remark' => $row->remark,
                      'amount' => $sum,
                      'created_at' => _d($row->created_at),
                      'acceptance' => $row->acceptance,
                      'status' => $row->status
                   );

            }

         $return_arr['status'] = true;
         $return_arr['message'] = "Success";
         $return_arr['data'] = $data_arr;
        }
        else
        {
          $return_arr['status'] = false;  
            $return_arr['message'] = "Record not found!";
            $return_arr['data'] = [];
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);

    }
   //http://mustafa-pc/crm/Payment_API/get_request_list?f_date=06-10-2020&t_date=12-10-2020


    public function delete_request()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($id)){
            
            $exist = $this->db->query("SELECT * from tblbankpaymentrequest where  id = '".$id."' ")->row(); 
            $delete = $this->home_model->delete('tblbankpaymentrequest', array('id'=>$id));   
            
            if($delete && !empty($exist)){
               
               $this->home_model->delete('tblbankpaymentrequestdetails', array('main_id'=>$id)); 

                $return_arr['status'] = true;   
                $return_arr['message'] = "Request deleted Successfully";
                $return_arr['data'] = [];

            }else{
              $return_arr['status'] = false;  
              $return_arr['message'] = "Some error occured!";
              $return_arr['data'] = [];
            } 

          }else{
              $return_arr['status'] = false;  
              $return_arr['message'] = "Required Parameters are missing";
              $return_arr['data'] = [];
          }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Payment_API/delete_request?id=2
    }


    public function view_request()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }
        $paymentrequest_info = $this->db->query("SELECT * FROM `tblbankpaymentrequest` where id = '".$id."' ")->row();
        if(!empty($paymentrequest_info)){

          $requestdetail_info = $this->db->query("SELECT * FROM `tblbankpaymentrequestdetails` where main_id = '".$id."' ")->result();
          $sub_data = array();
          if(!empty($requestdetail_info)){
            foreach ($requestdetail_info as $value) {

                $bank_info = $this->db->query("SELECT * FROM `tblbankmaster` where id = '".$value->bank_id."' ")->row();

                $category_info  = $this->db->query("SELECT * FROM tblcompanyexpensecatergory WHERE id = '".$value->category_id."' ")->row();

                if($value->category_id == 1){
                $payee_info = $this->db->query("SELECT * FROM `tblstaff` where active = '1' and staffid = '".$value->payee_id."' ")->row();
                $payee_name =  $payee_info->firstname;

                }elseif($value->category_id == 2){
                  $payee_info = $this->db->query("SELECT * FROM `tblvendor` where status = '1' and id = '".$value->payee_id."'")->row();
                  $payee_name =  $payee_info->name; 
                }else{
                  $payee_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$value->category_id."' and id = '".$value->payee_id."' and status = '1' ")->row(); 
                  $payee_name = $payee_info->name;              
                }

              $sub_data[] =  array(
                'bank_id' => $value->bank_id,
                'bank_name' => $bank_info->name,
                'category_id' => $value->category_id,
                'category_name' => $category_info->name,
                'payee_id' => $value->payee_id,
                'payee_name' => $payee_name,
                'date' => _d($value->date),
                'ifsc' => $value->ifsc,
                'account' => $value->account,
                'amount' => $value->amount,
                'first_remark' => $value->first_remark,
                'second_remark' => $value->second_remark,
                'company_code' => $value->company_code,
                'utr_no' => $value->utr_no,
                'method' => $value->method,
                'type' => $value->type,
                'fromdate' => _d($value->fromdate),
                'todate' => _d($value->todate),
                'deposit' => $value->deposit,
              );
            }
          }

          
          $data_arr = array(
              'id' => $paymentrequest_info->id,
              'staffid' => $paymentrequest_info->staff_id,
              'staff_name' => get_employee_name($paymentrequest_info->staff_id),
              'remark' => $paymentrequest_info->remark,
              'created_at' => _d($paymentrequest_info->created_at),
              'status' => $paymentrequest_info->status,
              'sub_data' => $sub_data
           );

          $return_arr['status'] = true;
          $return_arr['message'] = 'Success';
          $return_arr['data'] = $data_arr;
        }else{
          $return_arr['status'] = false;
          $return_arr['message'] = 'No Record Found!';
          $return_arr['data'] = [];
        }
        


        

        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Payment_API/view_request?id=3

    }

}

