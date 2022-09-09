<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Challan_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
        $this->load->model('estimates_model');
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

            //Driver
            $driver_info = $this->db->query("SELECT staffid as id, firstname as name FROM `tblstaff`  WHERE active = 1")->result_array();

            //Scaffolder
            $scaffolders_info = $this->db->query("SELECT staffid as id, firstname as name FROM `tblstaff`  WHERE active = 1")->result_array();

            //Delivery Person
            $delivery_person_info = $this->db->query("SELECT staffid as id, firstname as name FROM `tblstaff`  WHERE active = 1")->result_array();

            //Hand Over Person
            $handover_person_info = $this->db->query("SELECT staffid as id, firstname as name FROM `tblstaff`  WHERE active = 1")->result_array();

            //Vehicles
            $vehicles_info = $this->db->query("SELECT id,name,number,driver_id FROM `tbltempo`  WHERE status = 1")->result_array();
            


            $new_arr = array();            

            if(!empty($driver_info)){
                $new_arr['drivers'] = $driver_info;
            }else{
                $new_arr['drivers'] = [];
            }

            

            if(!empty($scaffolders_info)){
                $new_arr['scaffolders'] = $scaffolders_info;
            }else{
                $new_arr['scaffolders'] = [];
            }

            if(!empty($delivery_person_info)){
                $new_arr['delivery_persons'] = $delivery_person_info;
            }else{
                $new_arr['delivery_persons'] = [];
            }

            if(!empty($handover_person_info)){
                $new_arr['handover_person'] = $handover_person_info;
            }else{
                $new_arr['handover_person'] = [];
            }

            if(!empty($vehicles_info)){
                $new_arr['vehicles'] = $vehicles_info;
            }else{
                $new_arr['vehicles'] = [];
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

        

        
        //https://schachengineers.com/schacrm_test/Challan_API/get_masters?user_id=25

    }


    public function manager_delivery_list(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        

        if(!empty($user_id)){
            $delivery_list = $this->db->query("SELECT cp.*,c.chalanno from tblchallanprocess as cp LEFT JOIN tblchallanallotperson as ca ON cp.id = ca.challanprocess_id LEFT JOIN tblchalanmst as c ON cp.chalan_id = c.id where cp.for = '".$for."' and cp.final_complete = 0 and cp.status = 1 and ca.staff_id = '".$user_id."' GROUP BY cp.id order by cp.id desc")->result();

            if(!empty($delivery_list)){

                foreach ($delivery_list as $value) {

                    $pdf_link = base_url('challan_API/pdf/'.$value->chalan_id);

                    $arr[] = array(
                        'id' => $value->id,
                        'chalan_id' => $value->chalan_id,
                        'chalanno' => $value->chalanno,
                        'priority' => $value->priority,
                        'complete' => $value->complete,
                        'text_status' => $value->text_status,
                        'pdf_link' => $pdf_link,
                        'date' => _d($value->date), 
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
            $return_arr['data'] = '';

        }


        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/manager_delivery_list?user_id=25
    } 


    public function get_challan_info(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        

        if(!empty($id) && !empty($user_id)){
            $challanprocess_info = $this->db->query("SELECT * FROM `tblchallanprocess`  WHERE id = '".$id."'")->row();
            $challan_info = $this->db->query("SELECT * FROM `tblchalanmst`  WHERE id = '".$challanprocess_info->chalan_id."'")->row();
            
            $booking_info = $this->db->query("SELECT * FROM `tblchallanvehiclebookingreq` where  FIND_IN_SET('".$id."', process_id)")->row();
            $booking_id = 0;
            if(!empty($booking_info)){
                $booking_id = $booking_info->id;
            }


            if($challan_info->service_type == 1){
                $challan_for = 'Challan - Rental';                
            }else{
                $challan_for='Challan - Sales';
            }

            if($challanprocess_info->for == 2){
                $shipfrom_info = get_ship_to_array($challan_info->site_id,$challan_info->clientid);
                $shipto_info = get_warehouse_info($challan_info->warehouse_id);
            }elseif($challanprocess_info->for == 1){
                
                $shipfrom_info = get_warehouse_info($challan_info->warehouse_id);
                $shipto_info = get_ship_to_array($challan_info->site_id,$challan_info->clientid);
            }

            


            $pdf_link = base_url('challan_API/pdf/'.$challan_info->id);


            $vehicle_name = '';
            $vehicle_number = '';
            $driver_name = '';
            $driver_number = '';
            if($challanprocess_info->vehicle_type == 2){
                $vehicle_info = $this->db->query("SELECT * from tblnoncompanyvehicle where id = '".$challanprocess_info->vehicle_id."' ")->row();

                $vehicle_name = $vehicle_info->vehicle_name;
                $vehicle_number = $vehicle_info->vehicle_number;
                $driver_name = $vehicle_info->driver_name;
                $driver_number = $vehicle_info->driver_number;
            }


            if($challanprocess_info->delivery_person_id == $user_id){
                $for_action = 1;
            }else{
                $for_action = 0;
            }


            $arr = array(
                'id' => $challan_info->id,
                'chalanno' => $challan_info->chalanno,
                'site_person' => $challan_info->site_person,
                'site_person_number' => $challan_info->site_person_number,
                'client_name' => client_info($challan_info->clientid)->client_branch_name,
                'challan_for' => $challan_for,
                'shipfrom_info' => $shipfrom_info,
                'shipto_info' => $shipto_info,
                'date'   => date('d-m-Y',strtotime($challanprocess_info->date)),
                'priority' => $challanprocess_info->priority,                   
                'description' => $challanprocess_info->description,                   
                'pdf_link' => $pdf_link,   
                'vehicle_type' => $challanprocess_info->vehicle_type,
                'vehicle_id' => $challanprocess_info->vehicle_id,
                'delivery_person_id' => $challanprocess_info->delivery_person_id,
                'delivery_person_name' => get_employee_name($challanprocess_info->delivery_person_id),
                'driver_id' => $challanprocess_info->driver_id,
                'scaffolder_id' => $challanprocess_info->scaffolder_id,
                'scaffolder_name' => get_employee_name($challanprocess_info->scaffolder_id),
                'manager_remark' => $challanprocess_info->manager_remark,                   
                'complete' => $challanprocess_info->complete,                   
                'text_status' => $challanprocess_info->text_status,                   
                'vehicle_name' => $vehicle_name,                   
                'vehicle_number' => $vehicle_number,                   
                'driver_name' => $driver_name,                   
                'for_action' => $for_action,                   
                'driver_number' => $driver_number,                 
                'booking_id' => $booking_id,                 
                'created_at'   => date('d-m-Y',strtotime($challan_info->datecreated)),                   
            );


            $return_arr['status'] = true;
            $return_arr['message'] = "Success";
            $return_arr['data'] = $arr;

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';

        }


        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/get_challan_info?id=3

    }  


    public function add_vehicle(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        $add_data = array(
            'vehicle_name' => $vehicle_name,
            'vehicle_number' => $vehicle_number,
            'driver_name' => $driver_name,
            'driver_number' => $driver_number,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        $insert = $this->home_model->insert('tblnoncompanyvehicle', $add_data); 

        if($insert == true){

            $id = $this->db->insert_id();

            handle_vehicle_rc_upload($id);
            handle_driving_licence_upload($id);
            handle_insurance_upload($id);

            $id_arr = array('id' => $id);

            $return_arr['status'] = true;   
            $return_arr['message'] = "Vehicle added Successfully";
            $return_arr['data'] = $id_arr;
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Fail to add vehicle";
            $return_arr['data'] = [];
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);


        //https://schachengineers.com/schacrm_test/Challan_API/add_vehicle?vehicle_name=Pickup&vehicle_number=MP094552&driver_name=Kapil&driver_number=9752652253

    }


    public function noncompany_vehicle_list(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        

        $vehicle_list = $this->db->query("SELECT * from tblnoncompanyvehicle where status = 1")->result();

        if(!empty($vehicle_list)){

            foreach ($vehicle_list as $value) {

                
                if(!empty($value->vehicle_rc)){
                   $vehicle_rc = base_url('uploads/challan_delivery/vehicle_rc/'.$value->id.'/'.$value->vehicle_rc);
                }else{
                    $vehicle_rc = '--';
                }

                if(!empty($value->driving_licence)){
                   $driving_licence = base_url('uploads/challan_delivery/driving_licence/'.$value->id.'/'.$value->driving_licence);
                }else{
                    $driving_licence = '--';
                }

                if(!empty($value->insurance)){
                   $insurance = base_url('uploads/challan_delivery/insurance/'.$value->id.'/'.$value->insurance);
                }else{
                    $insurance = '--';
                }

                $arr[] = array(
                    'id' => $value->id,
                    'vehicle_name' => $value->vehicle_name,
                    'vehicle_number' => $value->vehicle_number,
                    'driver_name' => $value->driver_name,
                    'driver_number' => $value->driver_number,
                    'vehicle_rc' => $vehicle_rc,
                    'driving_licence' => $driving_licence,
                    'insurance' => $insurance,
                    'date' => _d($value->created_at), 
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

        //https://schachengineers.com/schacrm_test/Challan_API/noncompany_vehicle_list
    } 



    public function assign_delivery(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($for) && !empty($id) && !empty($user_id) && !empty($vehicle_type)){

            
            if($vehicle_type == 2){
               $data_1 = array(
                    'vehicle_name' => $vehicle_name,
                    'vehicle_number' => $vehicle_number,
                    'driver_name' => $driver_name,
                    'driver_number' => $driver_number
                );
                
               $this->home_model->update('tblnoncompanyvehicle', $data_1, array('id'=>$vehicle_id));  
                handle_vehicle_rc_upload($vehicle_id);
                handle_driving_licence_upload($vehicle_id);
                handle_insurance_upload($vehicle_id); 
            }

            //delete alloted persons
            $this->home_model->delete('tblchallanallotperson', array('challanprocess_id'=>$id,'manager'=>0)); 

            if(empty($delivery_person_id)){
                $delivery_person_id = 0;
            }else{
                $this->home_model->insert('tblchallanallotperson', array('challanprocess_id'=>$id,'staff_id'=>$delivery_person_id,'manager'=>0));
            }
            if(empty($driver_id)){
                $driver_id = 0;
            }else{
                $this->home_model->insert('tblchallanallotperson', array('challanprocess_id'=>$id,'staff_id'=>$driver_id,'manager'=>0));
            }

            if($for == 1){
              if(empty($scaffolder_id)){
                    $scaffolder_id = 0;
                    $text_status = 'Scaffolder not assigned';
                }else{
                    $text_status = 'Delivery challan alloted';
                    $this->home_model->insert('tblchallanallotperson', array('challanprocess_id'=>$id,'staff_id'=>$scaffolder_id,'manager'=>0));
                }  
            }else{
                $text_status = 'Pickup challan alloted';
            }
            

            $data_2 = array(
                'vehicle_type' => $vehicle_type,
                'vehicle_id' => $vehicle_id,
                'delivery_person_id' => $delivery_person_id,
                'driver_id' => $driver_id,
                'scaffolder_id' => $scaffolder_id,
                'text_status' => $text_status,
                'manager_remark' => $manager_remark
            );

            $assigned = $this->home_model->update('tblchallanprocess', $data_2, array('id'=>$id)); 

            $challanprocess_info = $this->db->query("SELECT * FROM `tblchallanprocess`  WHERE id = '".$id."'")->row();

            if($assigned == true)
            {
                $this->home_model->delete('tblnotifications', array('module_id'=>11,'table_id'=>$id)); 

                if($delivery_person_id > 0){

                    //Deleting Last Handover Record
                    $this->home_model->delete('tblhandover', array('id'=>$challanprocess_info->handover_id));
                    $handover_log  = $this->db->query("SELECT * FROM tblhandoverlog WHERE handover_id = '".$challanprocess_info->handover_id."'")->result();

                    foreach ($handover_log as $row) {
                       $this->home_model->delete('tblnotifications', array('module_id'=>12,'table_id'=>$row->id));
                    }
                    $this->home_model->delete('tblhandoverlog', array('handover_id'=>$challanprocess_info->handover_id));

                    if($for == 1){
                        $title = 'Challan Delivery Handover';
                    }else{
                        $title = 'Challan Pickup Handover';
                    }

                    $data_1 = array(
                        'title' => $title,
                        'staff_id' => $user_id,
                        'receiver_id' => $challanprocess_info->staff_id,
                        'created_at' => date('Y-m-d'),
                        'status' => 1
                    );

                    $insert_1 = $this->home_model->insert('tblhandover', $data_1);
                     if($insert_1 == true){
                        $handover_id = $this->db->insert_id();

                        $this->home_model->update('tblchallanprocess', array('handover_id'=>$handover_id), array('id'=>$id));
                        $data_2 = array(
                            'handover_id' => $handover_id,
                            'sender_staff_id' => $user_id,
                            'receiver_id' => $delivery_person_id,
                            'sender_remark' => $title,
                            'received_status' => 1,
                            'status' => 1,
                            'receive_date' => date('Y-m-d H:i:s'),
                            'created_date' => date('Y-m-d H:i:s'),
                        );

                        $insert_2 = $this->home_model->insert('tblhandoverlog', $data_2);

                    }


                    if($for == 1){
                        $message = 'Delivery challan assigned';
                    }else{
                        $message = 'Pickup challan assigned';    
                    }


                    //Sending Mobile Intimation
                    $token = get_staff_token($delivery_person_id);                    
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data1 = array(
                            'description' => $message,
                            'touserid' => $delivery_person_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 1,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => $for,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data1);
                }

                if($driver_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($driver_id);
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data2 = array(
                            'description' => $message,
                            'touserid' => $driver_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => $for,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data2);
                }

                if($scaffolder_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($scaffolder_id);
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data3 = array(
                            'description' => $message,
                            'touserid' => $scaffolder_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => $for,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data3);
                }

                if($for == 1){
                    $s_message = "Delivery Assigned Successfully";
                    $f_message = "Fail to Assign Delivery!";
                }else{
                    $s_message = "Pickup Assigned Successfully";
                    $f_message = "Fail to Assign Pickup!";
                }
                

                $return_arr['status'] = true;
                $return_arr['message'] = $s_message;
                $return_arr['data'] = [];

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = $f_message;
                $return_arr['data'] = [];
            }

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }


        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/assign_delivery?user_id=25&id=1&vehicle_type=2&vehicle_id=1&vehicle_name=Pickupn&vehicle_number=MP095352&driver_name=KapilP&driver_number=9752067095&delivery_person_id=12&scaffolder_id=27&driver_id=0&manager_remark=test_remark

    }

    /*public function get_assign_info(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        

        if(!empty($id)){
            $challanprocess_info = $this->db->query("SELECT * FROM `tblchallanprocess`  WHERE id = '".$id."'")->row();

            $vehicle_name = '';
            $vehicle_number = '';
            $driver_name = '';
            $driver_number = '';
            if($challanprocess_info->vehicle_type == 2){
                $vehicle_info = $this->db->query("SELECT * from tblnoncompanyvehicle where id = '".$challanprocess_info->vehicle_id."' ")->row();

                $vehicle_name = $vehicle_info->vehicle_name;
                $vehicle_number = $vehicle_info->vehicle_number;
                $driver_name = $vehicle_info->driver_name;
                $driver_number = $vehicle_info->driver_number;
            }
            

            $arr = array(
                'id' => $challanprocess_info->id,
                'vehicle_type' => $challanprocess_info->vehicle_type,
                'vehicle_id' => $challanprocess_info->vehicle_id,
                'delivery_person_id' => $challanprocess_info->delivery_person_id,
                'driver_id' => $challanprocess_info->driver_id,
                'scaffolder_id' => $challanprocess_info->scaffolder_id,
                'manager_remark' => $challanprocess_info->manager_remark,                   
                'vehicle_name' => $vehicle_name,                   
                'vehicle_number' => $vehicle_number,                   
                'driver_name' => $driver_name,                   
                'driver_number' => $driver_number                  
            );


            $return_arr['status'] = true;
            $return_arr['message'] = "Success";
            $return_arr['data'] = $arr;

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';

        }


        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/get_assign_info?id=1

    }*/

    public function make_delivery(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($for) && !empty($user_id) && !empty($id)){

            $challanprocess_info = $this->db->query("SELECT * FROM `tblchallanprocess`  WHERE id = '".$id."'")->row();

            if($for == 1 ){
                $message = 'Challan Delivery Completed';
            }else{
                $message = 'Challan Pickup Completed';
            }
            

            $this->home_model->update('tblchallanprocess', array('complete'=>1,'delivery_person_remark'=>$delivery_person_remark, 'text_status'=>$message), array('id'=>$id)); 
            $this->home_model->update('tblchalanmst', array('under_process'=>0), array('id'=>$challanprocess_info->chalan_id)); 

            //Upload Images
            handle_multi_challan_attachments($id,'challan');

           
                if($challanprocess_info->driver_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($challanprocess_info->driver_id);
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data2 = array(
                            'description' => $message,
                            'touserid' => $challanprocess_info->driver_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => $for,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data2);
                }

                if($challanprocess_info->scaffolder_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($challanprocess_info->scaffolder_id);
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data3 = array(
                            'description' => $message,
                            'touserid' => $challanprocess_info->scaffolder_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => $for,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data3);
                }


            //For Hand Over
            if($handover_id > 0){
               
                $ad_data = array(
                        'handover_id' => $challanprocess_info->handover_id,
                        'sender_staff_id' => $user_id,
                        'receiver_id' => $handover_id,
                        'sender_remark' => $handover_remark,
                        'status' => 1,
                        'created_date' => date('Y-m-d H:i:s')
                    );

                $insert_1 = $this->home_model->insert('tblhandoverlog', $ad_data);

                if($insert_1 == true){
                    $insert_id = $this->db->insert_id();
                    $n_data = array(
                            'description' => 'Challan Hand-Over for Accept',
                            'touserid' => $handover_id,
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

            if($for == 1){
                $s_message = "Challan Delivered Successfully";
            }else{
                $s_message = "Challan Pickup Successfully";
            }

            $return_arr['status'] = true;
            $return_arr['message'] = $s_message;
            $return_arr['data'] = [];

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }


        header('Content-type: application/json');
        echo json_encode($return_arr);


        //https://schachengineers.com/schacrm_test/Challan_API/make_delivery?user_id=25&id=1&delivery_person_remark=delivery_person_remark&handover_id=27&handover_remark=test_remark

    }


    public function challan_handover(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }


        if(!empty($user_id) && !empty($handover_id) && !empty($receiver_id)){

            $ad_data = array(
                'handover_id' => $handover_id,
                'sender_staff_id' => $user_id,
                'receiver_id' => $receiver_id,
                'sender_remark' => $handover_remark,
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s')
            );

            $insert_1 = $this->home_model->insert('tblhandoverlog', $ad_data);

            if($insert_1 == true){
                $insert_id = $this->db->insert_id();

                handle_multi_handover_attachments($insert_id,'handover');

                $n_data = array(
                        'description' => 'Challan Hand-Over for Accept',
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

                $return_arr['status'] = true;
                $return_arr['message'] = "Challan Hand-Over Successfully";
                $return_arr['data'] = [];
            }
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }


        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/challan_handover?user_id=25&handover_id=1&receiver_id=18&handover_remark=test_remark
    }


    public function handover_receive(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }


        if(!empty($id)){

            $log_info = $this->db->query("SELECT * from tblhandoverlog where id = '".$id."' ")->row();
            $handover_info = $this->db->query("SELECT * from tblhandover where id = '".$log_info->handover_id."' ")->row();
            $final_receiver_id = $handover_info->receiver_id;


            if($received_status == 1){
                $ad_data = array(                   
                    'receiver_remark' => $receive_remark,
                    'received_status' => $received_status,
                    'receive_date' => date('Y-m-d H:i:s')
                );

                $update = $this->home_model->update('tblhandoverlog', $ad_data, array('id'=>$id));

                if($update == true){

                    //make action complete if receiver is final
                    if($final_receiver_id == $log_info->receiver_id){
                        $this->home_model->update('tblhandover', array('final_receive'=>1), array('id'=>$handover_info->id));
                    }     


                   
                    handle_multi_handover_attachments($id,'handover');

                    $message = "Hand-Over Received Successfully";
                    $return_arr['status'] = true;
                    $return_arr['message'] = $message;
                    $return_arr['data'] = [];
                }
            }else{                

                //Delete notification from receiver
                $n_data = array(
                    'touserid' => $log_info->receiver_id,
                    'fromuserid' => $log_info->sender_staff_id,
                    'table_id' => $id,
                    'module_id' => 12
                );
                $this->home_model->delete('tblnotifications', $n_data);

                //delete alloted persons
                $delete = $this->home_model->delete('tblhandoverlog', array('id'=>$id)); 
                if($delete){
                    $return_arr['status'] = true;  
                    $return_arr['message'] = "Hand-Over Reject Successfully";
                    $return_arr['data'] = [];
                }else{
                    $return_arr['status'] = false;  
                    $return_arr['message'] = "Some error occurred";
                    $return_arr['data'] = [];
                }
            }
            
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }


        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/handover_receive?id=2&receive_remark=received&received_status=1
    }

    public function add_conversation(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }


        if(!empty($user_id) && !empty($id) && !empty($message)){

            $add_data = array(
                'challanprocess_id' => $id,
                'user_id' => $user_id,
                'message' => $message,
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s')
            );

            $insert = $this->home_model->insert('tblchallanconversation', $add_data); 

            if($insert == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "New Conversation added successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to add Conversation";
                $return_arr['data'] = [];
            }

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = '';
        }
        

        header('Content-type: application/json');
        echo json_encode($return_arr);


        //https://schachengineers.com/schacrm_test/Challan_API/add_conversation?id=1&user_id=25&message=First conversation

    }


    public function handover_list(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($user_id)){
                $sender_list = $this->db->query("SELECT h.title,h.receiver_id as r_id,hl.* from tblhandover as h LEFT JOIN tblhandoverlog as hl ON h.id = hl.handover_id where hl.sender_staff_id = '".$user_id."' and hl.received_status = 0 order by hl.id DESC")->result();

                $receiver_list = $this->db->query("SELECT h.title,h.receiver_id as r_id,hl.* from tblhandover as h LEFT JOIN tblhandoverlog as hl ON h.id = hl.handover_id where hl.receiver_id = '".$user_id."' and hl.received_status = 0 order by hl.id DESC")->result();

                $arr['for_send'] = array();
                $arr['not_received'] = array();
                $arr['for_receive'] = array();

                //The data which is received but not send
                $handover_data = handover_for_send($user_id);
                if(!empty($handover_data)){
                   foreach ($handover_data as $value) {

                        //$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'handover'),  array('id'),'');
                        $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->handover_id,'rel_type'=>'handover_master'),  array('id'),'');
                        if($files_count){
                            $count=count($files_count);
                        }else{
                            $count=0;
                        }

                        if($value->receive_date > 0){
                            $receive_date = _d($value->receive_date);
                        }else{
                            $receive_date = '--';
                        }

                        $arr['for_send'][] = array(
                            'id' => $value->id,
                            'handover_id' => $value->handover_id,
                            'title' => $value->title,
                            'final_receiver' => get_employee_name($value->r_id),
                            'created_date' => _d($value->created_date),
                            'receive_date' => $receive_date, 
                            'file_count' => $count 
                        );
                    }

                }


                //The data which is send but not recieved 
                if(!empty($sender_list)){
                    foreach ($sender_list as $value) {

                        //$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'handover'),  array('id'),'');
                        $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->handover_id,'rel_type'=>'handover_master'),  array('id'),'');
                        if($files_count){
                            $count=count($files_count);
                        }else{
                            $count=0;
                        }

                        if($value->receive_date > 0){
                            $receive_date = _d($value->receive_date);
                        }else{
                            $receive_date = '--';
                        }

                        $arr['not_received'][] = array(
                            'id' => $value->id,
                            'handover_id' => $value->handover_id,
                            'title' => $value->title,
                            'final_receiver' => get_employee_name($value->r_id),
                            'receiver_name' => get_employee_name($value->receiver_id),
                            'sender_remark' => $value->sender_remark,
                            'created_date' => _d($value->created_date),
                            'receive_date' => $receive_date, 
                            'file_count' => $count 
                        );
                    }
                }

                //The data which is not recieved
                if(!empty($receiver_list)){
                    foreach ($receiver_list as $value) {

                        //$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'handover'),  array('id'),'');
                        $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->handover_id,'rel_type'=>'handover_master'),  array('id'),'');
                        if($files_count){
                            $count=count($files_count);
                        }else{
                            $count=0;
                        }

                        if($value->receive_date > 0){
                            $receive_date = _d($value->receive_date);
                        }else{
                            $receive_date = '--';
                        }

                        $arr['for_receive'][] = array(
                            'id' => $value->id,
                            'handover_id' => $value->handover_id,
                            'title' => $value->title,
                            'final_receiver' => get_employee_name($value->r_id),
                            'sender_name' => get_employee_name($value->sender_staff_id),
                            'created_date' => _d($value->created_date),
                            'receive_date' => $receive_date, 
                            'file_count' => $count
                        );
                    }
                }

                if(!empty($arr)){
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
            $return_arr['data'] = '';
        }
        

        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/handover_list?user_id=25
    }

    public function cancel_handover(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($id)){
            $log_info = $this->db->query("SELECT * from tblhandoverlog where id = '".$id."' ")->row();


            //Delete notification from receiver
            $n_data = array(
                'touserid' => $log_info->receiver_id,
                'fromuserid' => $log_info->sender_staff_id,
                'table_id' => $id,
                'module_id' => 12
            );
            $this->home_model->delete('tblnotifications', $n_data);

            //delete alloted persons
            $delete = $this->home_model->delete('tblhandoverlog', array('id'=>$id)); 
            if($delete){
                $return_arr['status'] = true;  
                $return_arr['message'] = "Handover cancelled successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Some error occurred";
                $return_arr['data'] = [];
            }

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }
        

        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/cancel_handover?id=1 
    }

    public function handover_details(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($id)){
            $handover_detials = $this->db->query("SELECT h.title,h.receiver_id as r_id,hl.* from tblhandover as h LEFT JOIN tblhandoverlog as hl ON h.id = hl.handover_id where hl.id = '".$id."' ")->row();

            if(!empty($handover_detials)){
                
                if($handover_detials->received_status == 0){
                    $for_receive = 1;
                }else{
                    $for_receive = 0;
                }

                if($handover_detials->receive_date > 0){
                    $receive_date = _d($handover_detials->receive_date);
                }else{
                    $receive_date = '--';
                }


                $h_id = $this->db->query("SELECT handover_id from tblhandoverlog where id = '".$id."' ")->row()->handover_id;
                $sender_info = $this->db->query("SELECT id from tblhandoverlog where handover_id = '".$h_id."' and sender_staff_id = '".$user_id."' and id > '".$id."' ")->row();
                if(!empty($sender_info)){
                    $is_handover = 1;
                }else{
                    $is_handover = 0;
                }

                $arr = array(
                    'id' => $handover_detials->id,
                    'handover_id' => $handover_detials->handover_id,
                    'title' => $handover_detials->title,
                    'final_receiver' => get_employee_name($handover_detials->r_id),
                    'receiver_name' => get_employee_name($handover_detials->receiver_id),
                    'sender_name' => get_employee_name($handover_detials->sender_staff_id),
                    'sender_remark' => $handover_detials->sender_remark,
                    'receiver_remark' => $handover_detials->receiver_remark,
                    'created_date' => _d($handover_detials->created_date),
                    'for_receive' => $for_receive,
                    'is_handover' => $is_handover,
                    'receive_date' => $receive_date
                );


                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $arr;

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Records Not found!";
                $return_arr['data'] = null;
            }

        }

        header('Content-type: application/json');
        echo json_encode($return_arr);
        //https://schachengineers.com/schacrm_test/Challan_API/handover_details?id=1 
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

        //Getting HandoverId 
        $handover_id = value_by_id('tblhandoverlog',$id,'handover_id');

        //$files = $this->home_model->get_result('tblfiles', array('rel_id'=>$id,'rel_type'=>'handover'),  array('id','file_name','filetype','rel_id','rel_type'),'');
        $files = $this->home_model->get_result('tblfiles', array('rel_id'=>$handover_id,'rel_type'=>'handover_master'),  array('id','file_name','filetype','rel_id','rel_type'),'');
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
         //https://schachengineers.com/schacrm_test/Challan_API/get_file?id=1&type=handover 
    }


    public function get_conversation(){

        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($id)){
             $converstion_list = $this->db->query("SELECT * from tblchallanconversation where challanprocess_id = '".$id."' order by id ASC")->result();

            if(!empty($converstion_list)){

                foreach ($converstion_list as $value) {


                    $arr[] = array(
                        'id' => $value->id,
                        'challanprocess_id' => $value->challanprocess_id,
                        'user_id' => $value->user_id,
                        'message' => $value->message,
                        'employee_name' => get_employee_fullname($value->user_id),
                        'created_date' => $value->created_date, 
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
            $return_arr['data'] = '';
        }

       


    

        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm_test/Challan_API/get_conversation?id=1
    }


    public function pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $estimate = $this->estimates_model->getcreatedchalan($id);
        $estimate_number = $estimate->chalanno;
        
        $file_name = $estimate_number;  

        /*echo $html = challan_pdf($estimate);
        die;*/
        $html = challan_pdf($estimate);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

         // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');   
        $size       = 8;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );
        
        $dompdf->stream($file_name, array("Attachment" => false));
        
        
    }


    public function pending_delivery_pickup_report()
    {       
        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($user_id)){

            $user_info = get_staff_info($user_id);
            $is_admin = $user_info->admin;

            $this->home_model->delete('tbltempdeliverypickupreport', array('staff_id'=>$user_id));
            $financial_year = $this->db->query("SELECT * FROM `tblfinancialyear` where from_date <= '".date('Y-m-d')."' and to_date >= '".date('Y-m-d')."' ")->row()->id;            
            $where_a = "";
            $where_b = "";
            if($is_admin == 0){
                $where_a = " and ca.staff_id = '".$user_id."' ";
                $where_b = " and ta.staff_id = '".$user_id."' ";
            }
            // Get Pending records 
            /*$delivery_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id  where c.year_id = '".$financial_year."' and c.under_process = 1 and c.process = 1 and cp.for = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
            $pickup_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.year_id = '".$financial_year."' and c.under_process = 1 and c.process = 2 and cp.for = 2 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();*/
            $delivery_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id  where  c.under_process = 1 and c.process = 1 and cp.for = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
            $pickup_info = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where  c.under_process = 1 and c.process = 2 and cp.for = 2 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
            $task_pending = $this->db->query("SELECT t.id,t.other_date from `tbltasks` as t LEFT JOIN tbltaskassignees as ta on t.id = ta.task_id where t.related_to = 11 and t.status = 1 and ta.task_status = 0 ".$where_b." GROUP BY ta.task_id ORDER BY t.id desc ")->result();

            
            if(!empty($delivery_info)){
                foreach ($delivery_info as $value) {

                    if(!empty($value->challandate)){
                        $challandate = $value->challandate;
                    }else{
                        $challandate = '0000-00-00';
                    }
                    $data_1 = array(
                        'staff_id' => $user_id,
                        'main_id' => $value->id,
                        'date' => $challandate,
                        'for' => 1,
                        'type' => 1,
                        'by_task' => 0
                    );
                            
                    $this->home_model->insert('tbltempdeliverypickupreport', $data_1); 
                }
            }
            if(!empty($pickup_info)){
                foreach ($pickup_info as $value) {

                    if(!empty($value->challandate)){
                        $challandate = $value->challandate;
                    }else{
                        $challandate = '0000-00-00';
                    }

                    $data_2 = array(
                        'staff_id' => $user_id,
                        'main_id' => $value->id,
                        'date' => $challandate,
                        'for' => 2,
                        'type' => 1,
                        'by_task' => 0
                    );
                            
                    $this->home_model->insert('tbltempdeliverypickupreport', $data_2); 
                }
            }

            if(!empty($task_pending)){
                foreach ($task_pending as $value) {

                    if(!empty($value->other_date)){
                        $challandate = $value->other_date;
                    }else{
                        $challandate = '0000-00-00';
                    }

                    $data_3 = array(
                        'staff_id' => $user_id,
                        'main_id' => $value->id,
                        'date' => $challandate,
                        'for' => 0,
                        'type' => 1,
                        'by_task' => 1
                    );
                            
                    $this->home_model->insert('tbltempdeliverypickupreport', $data_3); 
                }
            }

            $where_p_delivery = "staff_id = '".$user_id."' and type = 1 and `for` = 1 and by_task = 0 ";
            $where_p_pickup = "staff_id = '".$user_id."' and type = 1 and `for` = 2 and by_task = 0 ";
            $where_p_other = "staff_id = '".$user_id."' and type = 1 and `for` = 0 and by_task = 1 "; 

            
            //Date Filter
            if(!empty($f_date) && !empty($t_date)){
                $where_p_delivery .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $where_p_pickup .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $where_p_other .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }


            $pending_delivery_info = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_p_delivery." ORDER BY id asc ")->result();
            $pending_pickup_info = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_p_pickup."  ORDER BY id asc ")->result();
            $pending_other_info = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_p_other." ORDER BY id asc ")->result();

            $pending_array = [];


            if(!empty($pending_delivery_info)){
                foreach ($pending_delivery_info as $row) {
                    $challan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$row->main_id."' ")->row();
                    $challanprocess_info = $this->db->query("SELECT description,id from `tblchallanprocess` where chalan_id = '".$row->main_id."' and `for` = 1 ")->row();

                    $shipto_info = get_ship_to_array($challan_info->site_id);
                    $product_data = json_decode($challan_info->product_json);

                    $service_type = ($challan_info->service_type == 1) ? 'RENT' : 'SALE';
                    $description = (!empty($challanprocess_info->description)) ? $challanprocess_info->description : '--' ; 
                    $process_id = (!empty($challanprocess_info->id)) ? $challanprocess_info->id : '0' ; 

                    $chalan_date = _d($challan_info->challandate);
                    if(!empty($challan_info->new_date)){ $chalan_date .= ' To '._d($challan_info->new_date); }

                    $product_arr = [];
                    if(!empty($product_data)){
                        foreach ($product_data as $value) {
                            $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                            if($isOtherCharge == 0){
                              $product_name =  value_by_id('tblproducts',$value->product_id,'sub_name');
                              $product_image =  value_by_id_empty('tblproducts',$value->product_id,'photo');
                              $product_qty = $value->product_qty.' '.get_product_units($value->product_id);

                                if(!empty($product_image) && $product_image != '--'){
				                    $image_path = site_url('uploads/product/'.$product_image);
				                }else{
				                    $image_path = base_url('assets/images/no_image_available.jpeg');
				                }

                              $product_arr[] = array(
                                    'product_id' => $value->product_id,
                                    'product_name' => $product_name,
                                    'image_path' => $image_path,
                                    'product_qty' => $product_qty
                                );
                            }
                        }
                    }

                    $delay = ($row->date < date('Y-m-d') ) ? '1' : '0' ;

                    $pending_array[] = array(
                        'id' => $row->main_id,
                        'process_id' => $process_id,
                        'pdf_url' => base_url('challan_API/pdf/'.$row->main_id),
                        'delay' => $delay,
                        'for' => 'DELIVERY',
                        'client_name' => client_info($challan_info->clientid)->client_branch_name,
                        'service_type' => $service_type,
                        'location' => $shipto_info['city'].', '.$shipto_info['state'],
                        'date' => $chalan_date, 
                        'assigned_to' => value_by_id('tblcompanybranch',$challan_info->billing_branch_id,'comp_branch_name'),
                        'description' => $description,
                        'product_arr' => $product_arr,
                    );
                }
            }

            if(!empty($pending_pickup_info)){              
                      foreach ($pending_pickup_info as $row) { 

                        $challan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$row->main_id."' ")->row();
                        $challanprocess_info = $this->db->query("SELECT description,id from `tblchallanprocess` where chalan_id = '".$row->main_id."' and `for` = 2 ")->row();
                        $shipto_info = get_ship_to_array($challan_info->site_id);
                        $product_data = json_decode($challan_info->product_json);

                        $service_type = ($challan_info->service_type == 1) ? 'RENT' : 'SALE';
                        $description = (!empty($challanprocess_info->description)) ? $challanprocess_info->description : '--' ; 
                        $process_id = (!empty($challanprocess_info->id)) ? $challanprocess_info->id : '0' ; 

                        $chalan_date = _d($challan_info->challandate);
                        if(!empty($challan_info->new_date)){ $chalan_date .= ' To '._d($challan_info->new_date); }

                        $product_arr = [];
                        if(!empty($product_data)){
                            foreach ($product_data as $value) {
                                $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                if($isOtherCharge == 0){
                                  $product_name =  value_by_id('tblproducts',$value->product_id,'sub_name');
                                  $product_image =  value_by_id_empty('tblproducts',$value->product_id,'photo');
                                  $product_qty = $value->product_qty.' '.get_product_units($value->product_id);

                                   if(!empty($product_image) && $product_image != '--'){
					                    $image_path = site_url('uploads/product/'.$product_image);
					                }else{
					                    $image_path = base_url('assets/images/no_image_available.jpeg');
					                }

                                  $product_arr[] = array(
                                        'product_id' => $value->product_id,
                                        'product_name' => $product_name,
                                        'image_path' => $image_path,
                                        'product_qty' => $product_qty
                                    );
                                }
                            }
                        }

                        $delay = ($row->date < date('Y-m-d') ) ? '1' : '0' ;

                        $pending_array[] = array(
                            'id' => $row->main_id,
                            'process_id' => $process_id,
                            'pdf_url' => base_url('challan_API/pdf/'.$row->main_id),
                            'delay' => $delay,
                            'for' => 'PICKUP',
                            'client_name' => client_info($challan_info->clientid)->client_branch_name,
                            'service_type' => $service_type,
                            'location' => $shipto_info['city'].', '.$shipto_info['state'],
                            'date' => $chalan_date, 
                            'assigned_to' => value_by_id('tblcompanybranch',$challan_info->billing_branch_id,'comp_branch_name'),
                            'description' => $description,
                            'product_arr' => $product_arr,
                        );

                }

            }

            if(!empty($pending_other_info)){              
                    foreach ($pending_other_info as $row) { 

                        $task_info = $this->db->query("SELECT * from `tbltasks` where id = '".$row->main_id."' ")->row();
                        $assigned_to = explode(',', $task_info->assigned_to);

                        $client_name = ($task_info->client_id > 0) ? client_info($task_info->client_id)->client_branch_name : $task_info->client_name;
                        $service_type = ($task_info->service_type == 1) ? 'RENT' : 'SALE';

                        $chalan_date = _d($task_info->other_date);
                        if(!empty($task_info->new_date)){ $chalan_date .= ' To '._d($task_info->new_date); } 

                        $staff_name = '--';
                        if(!empty($assigned_to)){
                            foreach ($assigned_to as $key => $staff_id) {
                                
                                if($key == 0){
                                    $staff_name = get_employee_name($staff_id);                                            
                                }else{
                                    $staff_name .= ', '.get_employee_name($staff_id);
                                }
                            }
                        }

                        $product_arr = [];
                        $product_arr[] = array(
                            'product_id' => 0,
                            'product_name' => $task_info->product_details,
                            'image_path' => '',
                            'product_qty' => '--'
                        );

                        $delay = ($row->date < date('Y-m-d') ) ? '1' : '0' ;

                        $pending_array[] = array(
                            'id' => $row->main_id,
                            'process_id' => '0',
                            'pdf_url' => '',
                            'delay' => $delay,
                            'for' => 'OTHER',
                            'client_name' => $client_name,
                            'service_type' => $service_type,
                            'location' => get_city($task_info->city_id).', '.get_city($task_info->state_id),
                            'date' => $chalan_date, 
                            'assigned_to' => $staff_name,
                            'description' => $task_info->description,
                            'product_arr' => $product_arr,
                        );

                }
            }

            if(!empty($pending_array)){
                $return_arr['status'] = true;  
                $return_arr['message'] = "Success";
                $return_arr['data'] = $pending_array;
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Recoreds not found!";
                $return_arr['data'] = [];
            }

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm/Challan_API/pending_delivery_pickup_report?user_id=1&f_date=&t_date

    }


    public function complete_delivery_pickup_report()
    {       
        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        if(!empty($user_id)){

            $user_info = get_staff_info($user_id);
            $is_admin = $user_info->admin;

            $this->home_model->delete('tbltempdeliverypickupreport', array('staff_id'=>$user_id));
            $financial_year = $this->db->query("SELECT * FROM `tblfinancialyear` where from_date <= '".date('Y-m-d')."' and to_date >= '".date('Y-m-d')."' ")->row()->id;            
            $where_a = "";
            $where_b = "";
            if($is_admin == 0){
                $where_a = " and ca.staff_id = '".$user_id."' ";
                $where_b = " and ta.staff_id = '".$user_id."' ";
            }
            

            // Get Completed Recoreds
            //There is no role of delivery and pickup in completed because this is the final complete process
            /*$sales_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.year_id = '".$financial_year."' and c.service_type = 2 and c.under_process = 0 and c.process = 1 and cp.for = 1 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
            $rent_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.year_id = '".$financial_year."' and c.under_process = 0 and c.process = 2 and cp.for = 2 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();*/
            $sales_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.service_type = 2 and c.under_process = 0 and c.process = 1 and cp.for = 1 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
            $rent_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.under_process = 0 and c.process = 2 and cp.for = 2 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();
            $task_complete = $this->db->query("SELECT t.id,t.other_date from `tbltasks` as t LEFT JOIN tbltaskassignees as ta on t.id = ta.task_id where t.related_to = 11 and t.status = 1 and ta.task_status = 1 ".$where_b." GROUP BY ta.task_id ORDER BY t.id desc ")->result();


            $rent_pickup_complete = $this->db->query("SELECT c.id,c.challandate from `tblchalanmst` as c LEFT JOIN tblchallanprocess as cp on c.id = cp.chalan_id LEFT JOIN tblchallanallotperson as ca on cp.id = ca.challanprocess_id where c.service_type = 1 and c.under_process = 0 and c.process = 1 and cp.for = 1 and cp.complete = 1 and cp.final_complete = 1 ".$where_a." group by ca.challanprocess_id ORDER BY c.id desc ")->result();


            if(!empty($rent_pickup_complete)){
                foreach ($rent_pickup_complete as $value) {

                    if(!empty($value->challandate)){
                        $challandate = $value->challandate;
                    }else{
                        $challandate = '0000-00-00';
                    }
                    $data_4 = array(
                        'staff_id' => $user_id,
                        'main_id' => $value->id,
                        'date' => $challandate,
                        'for' => 0,
                        'type' => 2,
                        'by_task' => 0
                    );
                            
                    $this->home_model->insert('tbltempdeliverypickupreport', $data_4); 
                }
            }
        

            if(!empty($sales_complete)){
                foreach ($sales_complete as $value) {

                    if(!empty($value->challandate)){
                        $challandate = $value->challandate;
                    }else{
                        $challandate = '0000-00-00';
                    }
                    $data_4 = array(
                        'staff_id' => $user_id,
                        'main_id' => $value->id,
                        'date' => $challandate,
                        'for' => 0,
                        'type' => 2,
                        'by_task' => 0
                    );
                            
                    $this->home_model->insert('tbltempdeliverypickupreport', $data_4); 
                }
            }

            if(!empty($rent_complete)){
                foreach ($rent_complete as $value) {

                    if(!empty($value->challandate)){
                        $challandate = $value->challandate;
                    }else{
                        $challandate = '0000-00-00';
                    }
                    $data_5 = array(
                        'staff_id' => $user_id,
                        'main_id' => $value->id,
                        'date' => $challandate,
                        'for' => 0,
                        'type' => 2,
                        'by_task' => 0
                    );
                            
                    $this->home_model->insert('tbltempdeliverypickupreport', $data_5); 
                }
            }

            if(!empty($task_complete)){
                foreach ($task_complete as $value) {

                    if(!empty($value->other_date)){
                        $challandate = $value->other_date;
                    }else{
                        $challandate = '0000-00-00';
                    }

                    $data_6 = array(
                        'staff_id' => $user_id,
                        'main_id' => $value->id,
                        'date' => $challandate,
                        'for' => 0,
                        'type' => 2,
                        'by_task' => 1
                    );
                            
                    $this->home_model->insert('tbltempdeliverypickupreport', $data_6); 
                }
            }

            $where_complete = "staff_id = '".$user_id."' and type = 2 and by_task = 0 "; 
            $where_complete_other = "staff_id = '".$user_id."' and type = 2 and by_task = 1 "; 
            
            //Date Filter
            if(!empty($f_date) && !empty($t_date)){
                $where_complete .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $where_complete_other .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }else{
               $where_complete .= " and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."' "; 
               $where_complete_other .= " and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."' ";
            }

            $complete_info = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_complete." ORDER BY id asc ")->result();
            $complete_other_info = $this->db->query("SELECT * from `tbltempdeliverypickupreport` where ".$where_complete_other." ORDER BY id asc ")->result();

            $complete_array = [];

            if(!empty($complete_info)){              
                  foreach ($complete_info as $row) { 

                    $challan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$row->main_id."' ")->row();
                    $challanprocess_info = $this->db->query("SELECT description,id from `tblchallanprocess` where chalan_id = '".$row->main_id."' and `for` = 1 ")->row();

                    $shipto_info = get_ship_to_array($challan_info->site_id);

                    $product_data = json_decode($challan_info->product_json);

                    if($challan_info->service_type == 1){
                        $service_type = 'RENT';
                        $type = 'DELIVERY & PICKUP';
                    }else{
                        $service_type = 'SALE';
                        $type = 'DELIVERY';
                    }

                    $chalan_date = _d($challan_info->challandate);
                    if(!empty($challan_info->new_date)){ $chalan_date .= ' To '._d($challan_info->new_date); }

                    $description = (!empty($challanprocess_info->description)) ? $challanprocess_info->description : '--' ; 
                    $process_id = (!empty($challanprocess_info->id)) ? $challanprocess_info->id : '0' ; 

                    $product_arr = [];
                    if(!empty($product_data)){
                        foreach ($product_data as $value) {

                            if(!empty($value->product_id)){
                                $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                if($isOtherCharge == 0){
                                  $product_name =  value_by_id('tblproducts',$value->product_id,'sub_name');
                                  $product_image =  value_by_id_empty('tblproducts',$value->product_id,'photo');
                                  $product_qty = $value->product_qty.' '.get_product_units($value->product_id);

                                    if(!empty($product_image) && $product_image != '--'){
                                        $image_path = site_url('uploads/product/'.$product_image);
                                    }else{
                                        $image_path = base_url('assets/images/no_image_available.jpeg');
                                    }

                                  $product_arr[] = array(
                                        'product_id' => $value->product_id,
                                        'product_name' => $product_name,
                                        'image_path' => $image_path,
                                        'product_qty' => $product_qty
                                    );
                                }  
                            }

                            
                        }
                    }

                    $complete_array[] = array(
                        'id' => $row->main_id,
                        'process_id' => $process_id,
                        'pdf_url' => base_url('challan_API/pdf/'.$row->main_id),
                        'for' => $type,
                        'client_name' => client_info($challan_info->clientid)->client_branch_name,
                        'service_type' => $service_type,
                        'location' => $shipto_info['city'].', '.$shipto_info['state'],
                        'date' => $chalan_date, 
                        'assigned_to' => value_by_id('tblcompanybranch',$challan_info->billing_branch_id,'comp_branch_name'),
                        'description' => $description,
                        'product_arr' => $product_arr,
                    );
                }
            }

            if(!empty($complete_other_info)){              
                      foreach ($complete_other_info as $row) { 

                        $task_info = $this->db->query("SELECT * from `tbltasks` where id = '".$row->main_id."' ")->row();
                        $assigned_to = explode(',', $task_info->assigned_to);

                        $client_name = ($task_info->client_id > 0) ? client_info($task_info->client_id)->client_branch_name : $task_info->client_name;
                        $service_type = ($task_info->service_type == 1) ? 'RENT' : 'SALE';

                        $chalan_date = _d($task_info->other_date);
                        if(!empty($task_info->new_date)){ $chalan_date .= ' To '._d($task_info->new_date); } 

                        $staff_name = '--';
                        if(!empty($assigned_to)){
                            foreach ($assigned_to as $key => $staff_id) {
                                
                                if($key == 0){
                                    $staff_name = get_employee_name($staff_id);                                            
                                }else{
                                    $staff_name .= ', '.get_employee_name($staff_id);
                                }
                            }
                        }

                        $product_arr = [];
                        $product_arr[] = array(
                            'product_id' => 0,
                            'product_name' => $task_info->product_details,
                            'image_path' => '',
                            'product_qty' => '--'
                        );

                        $complete_array[] = array(
                            'id' => $row->main_id,
                            'process_id' => '0',
                            'for' => 'OTHER',
                            'client_name' => $client_name,
                            'service_type' => $service_type,
                            'location' => get_city($task_info->city_id).', '.get_city($task_info->state_id),
                            'date' => $chalan_date, 
                            'assigned_to' => $staff_name,
                            'description' => $task_info->description,
                            'product_arr' => $product_arr,
                        );

                }
            }

            if(!empty($complete_array)){
                $return_arr['status'] = true;  
                $return_arr['message'] = "Success";
                $return_arr['data'] = $complete_array;
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Recoreds not found!";
                $return_arr['data'] = [];
            }

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm/Challan_API/complete_delivery_pickup_report?user_id=1&f_date=&t_date
	
	}
        
    /* this function use for assign challan vehicle */    
    public function assign_challan_vehicle()
    {       
        
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }

        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if(!empty($process_id) && !empty($vehicle_type)){
            $update_arr["vehicle_type"] = $vehicle_type;
            $update_arr["assign_vehicle_status"] = 0;
            $this->home_model->update("tblchallanprocess", $update_arr, array("id" => $process_id));
            
            $return_arr = array('status' => true, 'message' => "Assign challan vehicle successfully", 'data' => array());
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        
//        http://localhost/crm/Challan_API/assign_challan_vehicle?process_id=3&vehicle_type=2
    } 
    
    /* this function use for get challan vehicle */
    public function get_challan_vehicle(){
        
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }
        
        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($vehicle_type)){
            
            $return_arr = array('status' => false, 'message' => "Record not found", 'data' => array());
            $getchallan_data = $this->db->query("SELECT * FROM tblchallanprocess WHERE `vehicle_type` = '".$vehicle_type."' AND `assign_vehicle_status` = 0")->result();
            if (!empty($getchallan_data)){
                foreach ($getchallan_data as $value) {
                    
                    $getchallandetails = $this->db->query("SELECT `chalanno`,`clientid` FROM tblchalanmst WHERE `id` = '".$value->chalan_id."'")->row();
                    $challan_number = (!empty($getchallandetails)) ? $getchallandetails->chalanno : "";
                    $client_name = (!empty($getchallandetails) && $getchallandetails->clientid > 0) ? client_info($getchallandetails->clientid)->client_branch_name : "";
                    
                    $output[] = array(
                                "process_id" => $value->id,
                                "challan_id" => $value->chalan_id,
                                "challan_no" => $challan_number,
                                "client_name" => $client_name,
                            );
                }
                $return_arr = array('status' => true, 'message' => "success", 'data' => $output);
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
//        http://localhost/crm/Challan_API/get_challan_vehicle?vehicle_type=2
    }
    
    /* this function use for add Challan Vehicle Booking Req */
    public function addChallanVehicleBookingReq(){
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }
        
        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($process_id) && !empty($addedfrom) && !empty($staff_id)){
            $process_data = json_decode($process_id);
            $insert_data = array(
                                "process_id" => implode(",",$process_data),
                                "addedfrom" => $addedfrom,
                                "transporter_name" => $transporter_name,
                                "pan_no" => $pan_no,
                                "with_without_gst" => $with_without_gst,
                                "tds_amt" => (!empty($tds_amt)) ? $tds_amt : 0.00,
                                "tds_percent" => (!empty($tds_percent)) ? $tds_percent : 0,
                                "booking_amt" => (!empty($booking_amt)) ? $booking_amt : 0.00,
                                "basic_amt" => (!empty($basic_amt)) ? $basic_amt : 0.00,
                                "final_amt" => (!empty($final_amt)) ? $final_amt : 0.00,
                                "approve_status" => 0,
                                "date" => date("Y-m-d"),
                                "created_at" => date("Y-m-d H:i:s"),
                            );
            $insert_id = $this->home_model->insert("tblchallanvehiclebookingreq", $insert_data);
            if($insert_id){
                
                $process_data = json_decode($process_id);
                foreach ($process_data as $pid) {
                    $this->home_model->update('tblchallanprocess', array("assign_vehicle_status" => 1), array("id"=> $pid)); 
                }
                
                if(!empty($staff_id)){
                    
//                    $staff_arr = explode(",", $staff_id);
                    $staff_arr = json_decode($staff_id);
                    foreach ($staff_arr as $s_id) {
                        
                        $add_data = array(
                            'staffid' => $s_id,
                            'booking_req_id' => $insert_id,
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblchallanvehiclebookingreqapproval', $add_data); 
                        
                        $adata = array(
                            'staff_id' => $s_id,
                            'fromuserid' => $addedfrom,
                            'module_id' => 26,
                            'table_id' => $insert_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => 'Challan Vehicle Booking Request',
                            'link' => 'Chalan/challanVehicleBookingApproval/'.$insert_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );  
                        $this->db->insert('tblmasterapproval', $adata);
                    }
                }
                $return_arr = array('status' => true, 'message' => "Challan vehicle booking request added successfully", 'data' => array());
            }else{
                $return_arr = array('status' => false, 'message' => "something went wrong", 'data' => array());
            }
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Challan_API/addChallanVehicleBookingReq?process_id=[1,3]&addedfrom=1&transporter_name=text&pan_no=RTY858YU&with_without_gst=2&tds_amt=&tds_percent=&booking_amt=15.00&basic_amt=12.00&final_amt=16.00&date=2021-06-26&staff_id=[27,13]
    }
    
    /* this function use for getChallanVehicleBookingReq */
    public function getChallanVehicleBookingReq(){
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }
        $return_arr = array('status' => false, 'message' => "Record not found", 'data' => array());
        $getbookingrequests = $this->db->query("SELECT * FROM `tblchallanvehiclebookingreq` ORDER BY id DESC")->result();
        if (!empty($getbookingrequests)){
            foreach ($getbookingrequests as $value) {
                $output[] = array(
                            "id" => $value->id,
                            "date" => (!empty($value->date)) ? _d($value->date) : "",
                            "booking_amt" => (!empty($value->booking_amt)) ? $value->booking_amt : "",
                            "transporter_name" => (!empty($value->transporter_name)) ? $value->transporter_name : "",
                            "number" => "CVBR-".$value->id,
                            "approve_status" => $value->approve_status,
                        );
            }
            $return_arr = array('status' => true, 'message' => "success", 'data' => $output);
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Challan_API/getChallanVehicleBookingReq
    }
    
    /* this function use for getDetailChallanVehicleBookingReq */
    public function getDetailChallanVehicleBookingReq(){
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }
        
        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($booking_id)){
            
            $return_arr = array('status' => false, 'message' => "Record not found", 'data' => array());
            $getbookingrequests = $this->db->query("SELECT * FROM `tblchallanvehiclebookingreq` WHERE id = ".$booking_id."")->row();
            if (!empty($getbookingrequests)){
                $process_data = array();
                if (!empty($getbookingrequests->process_id)){
                    $getchallan_data = $this->db->query("SELECT * FROM tblchallanprocess WHERE `id` IN (".$getbookingrequests->process_id.")")->result();
                    if (!empty($getchallan_data)){
                        foreach ($getchallan_data as $sval) {
                            
                            $getchallandetails = $this->db->query("SELECT `chalanno`,`clientid` FROM tblchalanmst WHERE `id` = '" . $sval->chalan_id . "'")->row();
                            $challan_number = (!empty($getchallandetails)) ? $getchallandetails->chalanno : "";
                            $client_name = (!empty($getchallandetails) && $getchallandetails->clientid > 0) ? client_info($getchallandetails->clientid)->client_branch_name : "";

                            $process_data[] = array(
                                "process_id" => $sval->id,
                                "challan_id" => $sval->chalan_id,
                                "vehicle_type" => $sval->vehicle_type,
                                "challan_no" => $challan_number,
                                "client_name" => $client_name,
                            );
                        }
                    }
                }
                $readby = array();
                $getreadby_data = $this->db->query("SELECT * FROM tblmasterapproval WHERE `isread`= 1 AND `module_id` = 26 AND `table_id` = ".$getbookingrequests->id."")->result();
                if ($getreadby_data){
                    foreach ($getreadby_data as $value) {
                        $readby[] = array(
                            "employee_name" => get_employee_fullname($value->staff_id),
                            "readdate" => (!empty($value->readdate)) ? _d($value->readdate) : "",
                        );
                    }
                }
                
                $output = array(
                        "id"=> $getbookingrequests->id,
                        "addedfrom"=> get_employee_fullname($getbookingrequests->addedfrom),
                        "transporter_name"=> (!empty($getbookingrequests->transporter_name)) ? $getbookingrequests->transporter_name : "",
                        "pan_no"=> (!empty($getbookingrequests->pan_no)) ? $getbookingrequests->pan_no : "",
                        "with_without_gst"=> (!empty($getbookingrequests->with_without_gst)) ? $getbookingrequests->with_without_gst : "0",
                        "tds_amt"=> (!empty($getbookingrequests->tds_amt)) ? $getbookingrequests->tds_amt : 0.00,
                        "tds_percent"=> (!empty($getbookingrequests->tds_percent)) ? $getbookingrequests->tds_percent : 0,
                        "booking_amt"=> (!empty($getbookingrequests->booking_amt)) ? $getbookingrequests->booking_amt : 0.00,
                        "basic_amt"=> (!empty($getbookingrequests->basic_amt)) ? $getbookingrequests->basic_amt : 0.00,
                        "final_amt"=> (!empty($getbookingrequests->final_amt)) ? $getbookingrequests->final_amt : 0.00,
                        "approve_status"=> $getbookingrequests->approve_status,
                        "date"=> _d($getbookingrequests->date),
                        "readby_details" => $readby,
                        "process_data"=> $process_data,
                    );
                $return_arr = array('status' => true, 'message' => "success", 'data' => $output);
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Challan_API/getDetailChallanVehicleBookingReq?booking_id=6
    }
    
    /* this function use for challan vehicle booking approval*/
    public function challanVehicleBookingApproval()
    {
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }
        
        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($id) && !empty($status) && !empty($remark) && !empty($user_id)){
            
            //Update master approval
            update_masterapproval_single($user_id,26,$id,$status);
            update_masterapproval_all(26,$id,$status);
            
            $ad_data = array(                            
                'approvereason' => $remark,
                'approve_status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            );

            $return_arr = array('status' => false, 'message' => "Something went wrong", 'data' => array());
            $update = $this->home_model->update('tblchallanvehiclebookingreqapproval', $ad_data,array('booking_req_id'=>$id,'staffid'=>$user_id));
            if($update){
                
                $udata = array(                            
                    'approve_status' => $status,
                );
                $this->home_model->update('tblchallanvehiclebookingreq', $udata,array('id'=>$id));
            
                $msg = ($status == 1) ? "Challan vehicle booking approved succesfully" : "Challan vehicle booking rejected succesfully";
                $return_arr = array('status' => true, 'message' => $msg, 'data' => array());
            }
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Challan_API/challanVehicleBookingApproval?id=8&status=2&remark=testing%20rejected&user_id=27
    }
    
    /* this function use for edit Challan Vehicle Booking Req */
    public function editChallanVehicleBookingReq(){
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }
        
        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($booking_id) && !empty($addedfrom) && !empty($staff_id)){
            
            $update_data = array(
                                "transporter_name" => $transporter_name,
                                "pan_no" => $pan_no,
                                "with_without_gst" => $with_without_gst,
                                "tds_amt" => (!empty($tds_amt)) ? $tds_amt : 0.00,
                                "tds_percent" => (!empty($tds_percent)) ? $tds_percent : 0,
                                "booking_amt" => (!empty($booking_amt)) ? $booking_amt : 0.00,
                                "basic_amt" => (!empty($basic_amt)) ? $basic_amt : 0.00,
                                "final_amt" => (!empty($final_amt)) ? $final_amt : 0.00,
                                "approve_status" => 0
                            );
            $update = $this->home_model->update("tblchallanvehiclebookingreq", $update_data, array("id" => $booking_id));
            if($update){
                
                if(!empty($staff_id)){
                    
                    //deleting last records
                    $this->home_model->delete('tblchallanvehiclebookingreqapproval', array("booking_req_id" => $booking_id));
                    $this->home_model->delete('tblmasterapproval', array("module_id" => 26, "table_id" => $booking_id));
           
//                    $staff_arr = explode(",", $staff_id);
                    $staff_arr = json_decode($staff_id);
                    foreach ($staff_arr as $s_id) {
                        
                        $add_data = array(
                            'staffid' => $s_id,
                            'booking_req_id' => $booking_id,
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );

                        $this->home_model->insert('tblchallanvehiclebookingreqapproval', $add_data); 
                        
                        $adata = array(
                            'staff_id' => $s_id,
                            'fromuserid' => $addedfrom,
                            'module_id' => 26,
                            'table_id' => $booking_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => 'Challan Vehicle Booking Request',
                            'link' => 'Chalan/challanVehicleBookingApproval/'.$booking_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );  
                        $this->db->insert('tblmasterapproval', $adata);
                    }
                }
                $return_arr = array('status' => true, 'message' => "Challan vehicle booking request update successfully", 'data' => array());
            }else{
                $return_arr = array('status' => false, 'message' => "something went wrong", 'data' => array());
            }
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        // http://localhost/crm/Challan_API/editChallanVehicleBookingReq?booking_id=11&addedfrom=1&transporter_name=PR%20Travles&pan_no=12TYU55&with_without_gst=2&tds_amt=&tds_percent=&booking_amt=15.00&basic_amt=12.00&final_amt=16.00&date=2021-06-26&staff_id=[27,13]
    }
    
}
