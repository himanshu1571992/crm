<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Production_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }


    public function staffList()
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

        
        $staff_info = $this->db->query("SELECT `staffid` as id,`firstname` as name FROM tblstaff WHERE designation_id IN (11,13,14,20,21,22,29,30,54,55,49,45) and active = '1' ")->result_array();

        if(!empty($staff_info)){
            $return_arr = array('status' => true, 'message' => "Successfully", 'data' => $staff_info); 
        }else{
            $return_arr = array('status' => false, 'message' => "Record Not Found", 'data' => array());  
        }


      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //http://mustafa-pc/crm/Production_API/staffList

    }


    public function getDivisionList()
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

        

        $division_info = $this->db->query("SELECT id,title as name FROM tbldivisionmaster WHERE status = '1' ")->result_array();

        if(!empty($division_info)){
            $return_arr = array('status' => true, 'message' => "Successfully", 'data' => $division_info); 
        }else{
            $return_arr = array('status' => false, 'message' => "Record Not Found", 'data' => array());  
        }
        

      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //http://mustafa-pc/crm/Production_API/getDivisionList

    }

    public function getMachineList()
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

        

        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());  
        if (!empty($department_id)){
            $machine_info = $this->db->query("SELECT id,name FROM tblmachinemaster WHERE department = '".$department_id."' and status = '1' ")->result_array();

            if(!empty($machine_info)){
                $return_arr = array('status' => true, 'message' => "Successfully", 'data' => $machine_info); 
            }else{
                $return_arr = array('status' => false, 'message' => "Record Not Found", 'data' => array());  
            }
        }


      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //http://mustafa-pc/crm/Production_API/getMachineList?department_id=1

    }

    public function getOperationList()
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

        

        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());  
        if (!empty($machine_id)){
            $machine_info = $this->db->query("SELECT id,name,cycle_time FROM tbloperationsmaster WHERE FIND_IN_SET('".$machine_id."', machine_id) and status = '1' ")->result_array();

            if(!empty($machine_info)){
                $return_arr = array('status' => true, 'message' => "Successfully", 'data' => $machine_info); 
            }else{
                $return_arr = array('status' => false, 'message' => "Record Not Found", 'data' => array());  
            }
        }


      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //http://mustafa-pc/crm/Production_API/getOperationList?department_id=1&machine_id=1

    }

    public function addProduction(){
        if (!empty($_GET)){
            extract($this->input->get());
        }
        elseif (!empty($_POST)){
            extract($this->input->post());
        }
        
        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($user_id) && !empty($date) && !empty($operator1_id)){

            if(empty($id)){
                $insert_data = array(
                    "added_by" => $user_id,
                    "date" => db_date($date),
                    "operator1_id" => $operator1_id,
                    "operator2_id" => $operator2_id,
                    "department_id" => $department_id,
                    "machine_id" => $machine_id,
                    "operation_id" => $operation_id,
                    "size" => $size,
                    "start_time" => date('H:i:s',strtotime($start_time)),
                    "end_time" => date('H:i:s',strtotime($end_time)),
                    "produced_qty" => $produced_qty,
                    "rejection_qty" => $rejection_qty,
                    "no_power" => $no_power,
                    "machine_breakdown" => $machine_breakdown,
                    "fixture_setting" => $fixture_setting,
                    "other_work" => $other_work,
                    "loading_unloading" => $loading_unloading,
                    "other_remark" => $other_remark,
                    "status" => 1,
                    "created_at" => date("Y-m-d H:i:s"),
                );
                if($this->home_model->insert("tblproductionsubmission", $insert_data)){
                    $return_arr = array('status' => true, 'message' => 'Record added sucessfully', 'data' => array());
                }else{
                    $return_arr = array('status' => false, 'message' => "something went wrong", 'data' => array());
                }
            }else{
                $update_data = array(
                    "date" => db_date($date),
                    "operator1_id" => $operator1_id,
                    "operator2_id" => $operator2_id,
                    "department_id" => $department_id,
                    "machine_id" => $machine_id,
                    "operation_id" => $operation_id,
                    "size" => $size,
                    "start_time" => date('H:i:s',strtotime($start_time)),
                    "end_time" => date('H:i:s',strtotime($end_time)),
                    "produced_qty" => $produced_qty,
                    "rejection_qty" => $rejection_qty,
                    "no_power" => $no_power,
                    "machine_breakdown" => $machine_breakdown,
                    "fixture_setting" => $fixture_setting,
                    "other_work" => $other_work,
                    "loading_unloading" => $loading_unloading,
                    "other_remark" => $other_remark,
                ); 
                if($this->home_model->update('tblproductionsubmission', $update_data,array('id'=>$id))){
                    $return_arr = array('status' => true, 'message' => 'Record updated sucessfully', 'data' => array());
                }else{
                    $return_arr = array('status' => false, 'message' => "something went wrong", 'data' => array());
                }
            }
            
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Production_API/addProduction?user_id=1&date=24/01/2022&operator1_id=27&operator2_id=18&machine_id=1&operation_id=2&size=20&start_time=8:30 AM&end_time=5:30 PM&produced_qty=110&rejection_qty=21&no_power=1&machine_breakdown=2&fixture_setting=3&other_work=4&loading_unloading=5&other_remark=Test&id=1
    }


    public function getProductionReport()
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


        $employee_info = get_employee_info($user_id);

        $where = "status = '1' ";

        if($employee_info->designation_id != 2 && $employee_info->designation_id != 3 && $employee_info->designation_id != 5 && $employee_info->designation_id != 8 && $employee_info->designation_id != 18 && $employee_info->designation_id != 34 && $employee_info->designation_id != 49 ){
            $where .= " and added_by = '".$user_id."' ";
        };
       
        if(!empty($from_date) && !empty($to_date)){
            $where .= " and date  BETWEEN  '".db_date($from_date)."' and  '".db_date($to_date)."' ";
        }else{
            $where .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ";  
        }

        $production_info = $this->db->query("SELECT * FROM tblproductionsubmission WHERE ".$where." order by id desc ")->result();

        if(!empty($production_info)){
            foreach ($production_info as $row) {

                $total_mins = round(abs(strtotime($row->end_time) - strtotime($row->start_time)) / 60,2);    
                $total_waste_mins = ($row->no_power+$row->machine_breakdown+$row->fixture_setting+$row->other_work+$row->loading_unloading);
                $cycle_time = value_by_id('tbloperationsmaster',$row->operation_id,'cycle_time');
                $available_mins = abs($total_mins-$total_waste_mins);
                $target_qty = round($available_mins/$cycle_time);
                $actual_produced_qty = ($row->produced_qty+$row->rejection_qty);

                if($target_qty > 0){
                    $operator_efficiency = (($actual_produced_qty/$target_qty)*100);
                }else{
                   $operator_efficiency = 0; 
                }
                if($operator_efficiency > 100){
                    $operator_efficiency = '100';
                }
                

                $data[] = array(
                    'id' => $row->id,
                    'added_by_id' => $row->added_by,
                    'added_by_name' => get_employee_name($row->added_by),
                    'date' => _d($row->date),
                    'operator1_id' =>$row->operator1_id,
                    'operator1_name' => get_employee_name($row->operator1_id),
                    'operator2_id' =>$row->operator2_id,
                    'operator2_name' => ($row->operator2_id > 0) ? get_employee_name($row->operator2_id) : '',
                    'department_id' => $row->department_id,
                    'department_name' => value_by_id('tbldivisionmaster',$row->department_id,'title'),
                    'machine_id' => $row->machine_id,
                    'machine_name' => value_by_id('tblmachinemaster',$row->machine_id,'name'),
                    'operation_id' => $row->operation_id,
                    'operation_name' => value_by_id('tbloperationsmaster',$row->operation_id,'name'),
                    'size' => $row->size,
                    'start_time' => date('h:i A',strtotime($row->start_time)),
                    'end_time' => date('h:i A',strtotime($row->end_time)),
                    'produced_qty' => $row->produced_qty,
                    'rejection_qty' => $row->rejection_qty,
                    'no_power' => $row->no_power,
                    'machine_breakdown' => $row->machine_breakdown,
                    'fixture_setting' => $row->fixture_setting,
                    'other_work' => $row->other_work,
                    'loading_unloading' => $row->loading_unloading,
                    'other_remark' => $row->other_remark,
                    'available_mins' => (number_format($available_mins, 2, '.', '')),
                    'target_qty' => (number_format($target_qty, 2, '.', '')),
                    'operator_efficiency' => (number_format($operator_efficiency, 2, '.', '')),
                    'created_at' => _d($row->created_at),
                    'for_edit' =>checkMenuPermission($user_id,'edit_production'),
                    );
            }
            $return_arr = array('status' => true, 'message' => "Successfully", 'data' => $data); 
        }else{
            $return_arr = array('status' => false, 'message' => "Record Not Found", 'data' => array()); 
        }

      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //http://mustafa-pc/crm/Production_API/getProductionReport

    }

    public function deleteProductionReport(){
        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($id)){
            $this->home_model->delete('tblproductionsubmission', array("id" => $id)); 
            $return_arr = array('status' => true, 'message' => "Record Deleted Successfully", 'data' => array()); 
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Production_API/deleteProductionReport?id=1
    }

    
    public function addFinalProduction()
    {
       
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($user_id) && !empty($date) && !empty($productData) && !empty($department_id) ){
            $productData = json_decode($productData);

            if(!empty($id)){
                $this->home_model->delete('tblfinishedgoodproductionsubmission', array("id" => $id)); 
                $this->home_model->delete('tblfinishedgoodproductionsubmission', array("parent_id" => $id)); 
            }

            if(!empty($productData)){
                foreach ($productData as $key => $p_data) {
                    if($key == 0){
                        $insert_data = array(
                            "parent_id" => 0,
                            "added_by" => $user_id,
                            "date" => db_date($date),
                            "department_id" => $department_id,
                            "product_id" => $p_data->product_id,
                            "produced_qty" => $p_data->produced_qty,
                            "rejection_qty" => $p_data->rejection_qty,
                            "remark" => $p_data->remark,
                            "status" => 1,
                            "created_at" => date("Y-m-d H:i:s"),
                        );
                        $this->db->insert('tblfinishedgoodproductionsubmission', $insert_data);
                        $insert_id = $this->db->insert_id();
                    }else{
                        $insert_data = array(
                            "parent_id" => $insert_id,
                            "added_by" => $user_id,
                            "date" => db_date($date),
                            "department_id" => $department_id,
                            "product_id" => $p_data->product_id,
                            "produced_qty" => $p_data->produced_qty,
                            "rejection_qty" => $p_data->rejection_qty,
                            "remark" => $p_data->remark,
                            "status" => 1,
                            "created_at" => date("Y-m-d H:i:s"),
                        );
                        $this->db->insert('tblfinishedgoodproductionsubmission', $insert_data);
                    }
                }
            }
            if ($insert_id) {
                if(!empty($id)){
                    $message = "Production Updated Successfully";
                }else{
                    $message = "Production Added Successfully";
                }
                $return_arr['status'] = true;  
                $return_arr['message'] = $message;
                $return_arr['data'] = [];

            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Something went wrong!";
                $return_arr['data'] = [];
            }     


        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Required Parameters are missing";
          $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Production_API/addFinalProduction?user_id=1&date=24/01/2022&department_id=11&productData=[{"product_id":"2","produced_qty":"4","rejection_qty":"1","remark":"product remark"},{"product_id":"6","produced_qty":"10","rejection_qty":"3","remark":"product remark2"}]&id=1
    }


    public function getFinalProductionReport()
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


        $employee_info = get_employee_info($user_id);

        $where = "status = '1' and parent_id = '0'";

        if($employee_info->designation_id != 2 && $employee_info->designation_id != 3 && $employee_info->designation_id != 5 && $employee_info->designation_id != 8 && $employee_info->designation_id != 18 && $employee_info->designation_id != 34 && $employee_info->designation_id != 49 ){
            $where .= " and added_by = '".$user_id."' ";
        };
       
        if(!empty($from_date) && !empty($to_date)){
            $where .= " and date  BETWEEN  '".db_date($from_date)."' and  '".db_date($to_date)."' ";
        }else{
            $where .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ";  
        }

        $production_info = $this->db->query("SELECT * FROM tblfinishedgoodproductionsubmission WHERE ".$where." order by id desc ")->result();
     

        if(!empty($production_info)){
            foreach ($production_info as $row) {

                $sub_production_info = $this->db->query("SELECT * FROM tblfinishedgoodproductionsubmission WHERE parent_id = '".$row->id."' ")->result();                

                $sub_data[] = array(
                    'id' => $row->id,
                    'product_id' => $row->product_id,
                    'pro_id' => "PRO-" .number_series($row->product_id),
                    'product_name' => get_product_name($row->product_id),
                    'produced_qty' => $row->produced_qty,
                    'rejection_qty' => $row->rejection_qty,
                    'remark' => $row->remark,
                );
                if(!empty($sub_production_info)){
                    foreach ($sub_production_info as $key => $value) {
                        $sub_data[] = array(
                            'id' => $value->id,
                            'product_id' => $value->product_id,
                            'pro_id' => "PRO-" .number_series($value->product_id),
                            'product_name' => get_product_name($value->product_id),
                            'produced_qty' => $value->produced_qty,
                            'rejection_qty' => $value->rejection_qty,
                            'remark' => $value->remark,
                        );
                    }
                    
                }

                $data[] = array(
                    'id' => $row->id,
                    'added_by_id' => $row->added_by,
                    'added_by_name' => get_employee_name($row->added_by),
                    'date' => _d($row->date),
                    'department_id' => $row->department_id,
                    'department_name' => value_by_id('tbldivisionmaster',$row->department_id,'title'),
                    'sub_data' => $sub_data,
                    'created_at' => _d($row->created_at),
                    'for_edit' =>checkMenuPermission($user_id,'edit_production'),
                );


            }
            $return_arr = array('status' => true, 'message' => "Successfully", 'data' => $data); 
        }else{
            $return_arr = array('status' => false, 'message' => "Record Not Found", 'data' => array()); 
        }

      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //http://mustafa-pc/crm/Production_API/getFinalProductionReport?user_id=1

    }


    public function deleteFinalProductionReport(){
        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());
        }

        $return_arr = array('status' => false, 'message' => "Required Parameters are messing", 'data' => array());
        if (!empty($id)){
            $this->home_model->delete('tblfinishedgoodproductionsubmission', array("id" => $id)); 
            $this->home_model->delete('tblfinishedgoodproductionsubmission', array("parent_id" => $id)); 
            $return_arr = array('status' => true, 'message' => "Record Deleted Successfully", 'data' => array()); 
        }
        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Production_API/deleteFinalProductionReport?id=1
    }
}
