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
            $delivery_list = $this->db->query("SELECT cp.*,c.chalanno from tblchallanprocess as cp LEFT JOIN tblchallanallotperson as ca ON cp.id = ca.challanprocess_id LEFT JOIN tblchalanmst as c ON cp.chalan_id = c.id where cp.for = 1 and cp.final_complete = 0 and cp.status = 1 and ca.staff_id = '".$user_id."' order by cp.id desc")->result();

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

        

        if(!empty($id)){
            $challanprocess_info = $this->db->query("SELECT * FROM `tblchallanprocess`  WHERE id = '".$id."'")->row();
            $challan_info = $this->db->query("SELECT * FROM `tblchalanmst`  WHERE id = '".$challanprocess_info->chalan_id."'")->row();
            

            if($challan_info->service_type == 1){
                $challan_for = 'Challan - Rental';                
            }else{
                $challan_for='Challan - Sales';
            }

            if($challanprocess_info->for == 2){
                $shipfrom_info = get_warehouse_info($challan_info->warehouse_id);
                $shipto_info = get_ship_to_array($challan_info->site_id,$challan_info->clientid);
            }elseif($challanprocess_info->for == 1){
                $shipfrom_info = get_ship_to_array($challan_info->site_id,$challan_info->clientid);
                $shipto_info = get_warehouse_info($challan_info->warehouse_id);
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

            $arr = array(
                'id' => $challan_info->id,
                'chalanno' => $challan_info->chalanno,
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
                'driver_id' => $challanprocess_info->driver_id,
                'scaffolder_id' => $challanprocess_info->scaffolder_id,
                'manager_remark' => $challanprocess_info->manager_remark,                   
                'complete' => $challanprocess_info->complete,                   
                'text_status' => $challanprocess_info->text_status,                   
                'vehicle_name' => $vehicle_name,                   
                'vehicle_number' => $vehicle_number,                   
                'driver_name' => $driver_name,                   
                'driver_number' => $driver_number,                 
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

        if(!empty($id) && !empty($user_id) && !empty($vehicle_type)){

            
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
            if(empty($scaffolder_id)){
                $scaffolder_id = 0;
                $text_status = 'Scaffolder not assigned';
            }else{
                $text_status = 'Delivery challan alloted';
                $this->home_model->insert('tblchallanallotperson', array('challanprocess_id'=>$id,'staff_id'=>$scaffolder_id,'manager'=>0));
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


                    $data_1 = array(
                        'title' => 'Challan Delivery Handover',
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
                            'received_status' => 1,
                            'status' => 1,
                            'receive_date' => date('Y-m-d H:i:s'),
                            'created_date' => date('Y-m-d H:i:s'),
                        );

                        $insert_2 = $this->home_model->insert('tblhandoverlog', $data_2);

                    }



                    //Sending Mobile Intimation
                    $token = get_staff_token($delivery_person_id);
                    $message = 'Delivery challan assigned';
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data1 = array(
                            'description' => 'Delivery challan assigned',
                            'touserid' => $delivery_person_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 1,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => 1,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data1);
                }

                if($driver_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($driver_id);
                    $message = 'Delivery challan assigned';
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data2 = array(
                            'description' => 'Delivery challan assigned',
                            'touserid' => $driver_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => 1,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data2);
                }

                if($scaffolder_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($scaffolder_id);
                    $message = 'Delivery challan assigned';
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data3 = array(
                            'description' => 'Delivery challan assigned',
                            'touserid' => $scaffolder_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => 1,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data3);
                }


                $return_arr['status'] = true;
                $return_arr['message'] = "Delivery Assigned Successfully";
                $return_arr['data'] = [];

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to Assign Delivery!";
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

        if(!empty($user_id) && !empty($id)){

            $challanprocess_info = $this->db->query("SELECT * FROM `tblchallanprocess`  WHERE id = '".$id."'")->row();

            $text_status = 'Challan Delivery Completed';

            $this->home_model->update('tblchallanprocess', array('complete'=>1,'delivery_person_remark'=>$delivery_person_remark, 'text_status'=>$text_status), array('id'=>$id)); 
            $this->home_model->update('tblchalanmst', array('under_process'=>0), array('id'=>$challanprocess_info->chalan_id)); 

            //Upload Images
            handle_multi_challan_attachments($id,'challan');

           
                if($challanprocess_info->driver_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($challanprocess_info->driver_id);
                    $message = 'Challan Delivery Completed';
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data2 = array(
                            'description' => 'Challan Delivery Completed',
                            'touserid' => $challanprocess_info->driver_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => 1,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data2);
                }

                if($challanprocess_info->scaffolder_id > 0){
                    //Sending Mobile Intimation
                    $token = get_staff_token($challanprocess_info->scaffolder_id);
                    $message = 'Challan Delivery Completed';
                    $title = 'SSAFE';
                    $send_intimation = sendFCM($message, $title, $token);

                    $n_data3 = array(
                            'description' => 'Challan Delivery Completed',
                            'touserid' => $challanprocess_info->scaffolder_id,
                            'fromuserid' => $user_id,
                            'table_id' => $id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 11,
                            'category_id' => 1,
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


            $return_arr['status'] = true;
            $return_arr['message'] = "Challan Delivered Successfully";
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


            if($received_status == 1){
                $ad_data = array(                   
                    'receiver_remark' => $receive_remark,
                    'received_status' => $received_status,
                    'receive_date' => date('Y-m-d H:i:s')
                );

                $update = $this->home_model->update('tblhandoverlog', $ad_data, array('id'=>$id));

                if($update == true){
                   
                    handle_multi_handover_attachments($id,'handover');

                    $message = "Hand-Over Received Successfully";
                    $return_arr['status'] = true;
                    $return_arr['message'] = $message;
                    $return_arr['data'] = [];
                }
            }else{
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

                        $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'handover'),  array('id'),'');
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

                        $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'handover'),  array('id'),'');
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

                        $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'handover'),  array('id'),'');
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
                $sender_info = $this->db->query("SELECT id from tblhandoverlog where handover_id = '".$h_id."' and sender_staff_id = '".$user_id."' and received_status != 2 ")->row();
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
        $files = $this->home_model->get_result('tblfiles', array('rel_id'=>$id,'rel_type'=>'handover'),  array('id','file_name','filetype','rel_id','rel_type'),'');
        $result=array();
        foreach ($files as $file ) {
            $temp['id']=$file->id;
            $temp['rel_id']=$file->rel_id;
            $temp['file_name']=$file->file_name;
      
            $temp['file_path']=base_url('uploads/handover/'.$file->rel_id.'/'.$file->file_name);
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

}
