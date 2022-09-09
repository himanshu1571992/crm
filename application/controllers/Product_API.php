<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Product_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
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

            $category_data = $this->db->query("SELECT id,name FROM `tblproductcategory` where `status`='1' ")->result_array();
            $unit_data = $this->db->query("SELECT id,name FROM `tblunitmaster` where `status`='1' ")->result_array();

            //staff group
            $Staffgroup =  get_staff_group(19,$user_id);
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

            if(!empty($unit_data)){
                $new_arr['unit_info'] = $unit_data;
            }else{
                $new_arr['unit_info'] = [];
            }

            if(!empty($category_data)){
                $new_arr['category_info'] = $category_data;
            }else{
                $new_arr['category_info'] = [];
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
        
        //http://mustafa-pc/crm/Product_API/get_masters?user_id=1

    }


    public function getProductList()
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
        if (!empty($division_id)){

            $item_data = $this->db->query("SELECT `id`,`sub_name` as `name`,`product_cat_id` FROM `tblproducts` where `status`='1' and `product_cat_id` = '2' and `division_id` = '".$division_id."' ")->result_array(); 
            if(!empty($item_data)){
                $return_arr = array('status' => true, 'message' => "Successfully", 'data' => $item_data); 
            }else{
                $return_arr = array('status' => false, 'message' => "Record Not Found", 'data' => array());  
            }
        } 


      
       header('Content-type: application/json');
       echo json_encode($return_arr);

       //http://mustafa-pc/crm/Product_API/getProductList

    }



    public function add_temperory_product() {
        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($user_id) && !empty($assignid) && !empty($product_cat_id) && !empty($product_name) && !empty($product_price) ){
        
                $assignid = json_decode($assignid);
                $staff_id = array();
               if(!empty($assignid)){
                    foreach ($assignid as $single_staff) {
                        $staff_id[] = $single_staff;
                      
                    }
                    $staff_id = array_unique($staff_id);

                    $staff_str = implode(",",$staff_id);
               }else{
                    $staff_str = '';
               }

            if (empty($id)) {

                $ad_data = array(                            
                    'staff_id' => $user_id,
                    'assignid' => $staff_str,
                    'category_id' => $product_cat_id,
                    'product_name' => $product_name,
                    'product_desc' => $description,
                    'unit' => $unit,
                    'price' => $product_price,
                    'sac' => $sac,
                    'hsn' => $hsn,
                    'created_at' => date('Y-m-d H:i:s')
                ); 

                $insert = $this->home_model->insert('tbltemperoryproduct', $ad_data);
                if ($insert) {
                    $insert_id = $this->db->insert_id();
                    temperory_product_image_upload($insert_id);

                    if(!empty($staff_id)){
                     foreach ($staff_id as $staffid) {

                       $approval_data = array(                            
                            'staff_id' => $staffid,
                            'pro_id' => $insert_id,
                            'approve_status' => '0',
                            'created_at' => date("Y-m-d H:i:s")
                        ); 
                       $this->db->insert('tbltemperoryproduct_approval', $approval_data);

                       $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => $user_id,
                        'module_id' => 13,
                        'description' => 'Temperory Product Send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'product_new/temperory_product_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);

                     }
                    }
                    $return_arr['status'] = true;   
					$return_arr['message'] = "Product added Successfully";
					$return_arr['data'] = [];
                }else{
					$return_arr['status'] = false;   
					$return_arr['message'] = "Some Error Occurred!";
					$return_arr['data'] = [];
				}
            } else {

                $this->db->delete('tbltemperoryproduct',array('id'=>$id));
                $this->db->delete('tbltemperoryproduct_approval',array('pro_id'=>$id));
                $this->db->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>13));

                $ad_data = array(                            
                    'staff_id' => $user_id,
                    'assignid' => $staff_str,
                    'category_id' => $product_cat_id,
                    'product_name' => $product_name,
                    'product_desc' => $description,
                    'unit' => $unit,
                    'price' => $product_price,
                    'sac' => $sac,
                    'hsn' => $hsn,
                    'created_at' => date('Y-m-d H:i:s')
                ); 

                $insert = $this->home_model->insert('tbltemperoryproduct', $ad_data);
                if ($insert) {
                    $insert_id = $this->db->insert_id();
                    if(!empty($_FILES['product_image']['name']))
                    { 
                      temperory_product_image_upload($insert_id);  
                    }
                    if(!empty($staff_id)){
                     foreach ($staff_id as $staffid) {

                       $approval_data = array(                            
                            'staff_id' => $staffid,
                            'pro_id' => $insert_id,
                            'approve_status' => '0',
                            'created_at' => date("Y-m-d H:i:s")
                        ); 
                       $this->db->insert('tbltemperoryproduct_approval', $approval_data);

                       $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => $user_id,
                        'module_id' => 13,
                        'description' => 'Temperory Product Send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'product_new/temperory_product_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);

                     }
                    }
					
                    $return_arr['status'] = true;   
					$return_arr['message'] = "Product added Successfully";
					$return_arr['data'] = [];
                }else{
					$return_arr['status'] = false;   
					$return_arr['message'] = "Some Error Occurred!";
					$return_arr['data'] = [];
				}
            }
        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Product_API/add_temperory_product?unit=6&user_id=1&product_cat_id=1&product_name=mouse&description=xyz&product_price=1100&sac=111111&hsn=2222222&assignid=[27]
    }


    public function delete_temperory_product() {
        $return_arr = array();
        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($id)){
            $response = $this->home_model->delete('tbltemperoryproduct', array('id'=>$id));
            if ($response == true) {
                $this->home_model->delete('tbltemperoryproduct_approval', array('pro_id'=>$id));
                $this->db->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>13));
                
                $return_arr['status'] = true;   
                $return_arr['message'] = "Product deleted Successfully";
                $return_arr['data'] = [];

            } else {
                $return_arr['status'] = false;   
                $return_arr['message'] = "Some Error Occurred!";
                $return_arr['data'] = [];
            }
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }
        

        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://mustafa-pc/crm/Product_API/delete_temperory_product?id=3
    }


    public function temp_product_list()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        $user_info = get_employee_info($user_id);

        $where = ' id > 0 ';

        if($user_info->admin == 0){
            $where .= " and staff_id = '".$user_id."' ";
        }

        $product_info = $this->db->query("SELECT * FROM `tbltemperoryproduct` where ".$where."  order by id desc")->result(); 
        if(!empty($product_info)){
            foreach ($product_info as $value) {

                $product_img = "";
                if(!empty($value->file_name)){
                    $product_img = base_url('uploads/temperory_product/'.$value->id.'/'.$value->file_name);
                }

                $arr[] = array(
                    'id' => $value->id,
                    'product_name' => $value->product_name,
                    'category_id' => $value->category_id,
                    'category_name' => value_by_id('tblproductcategory',$value->category_id,'name'),
                    'unit_id' => $value->unit,
                    'unit_name' => value_by_id('tblunitmaster',$value->unit,'name'),
                    'product_desc' => $value->product_desc,
                    'price' => $value->price,
                    'sac' => $value->sac,
                    'hsn' => $value->hsn,
                    'product_img' => $product_img,
                    'status' => $value->status,
                    'created_at'   => _d($value->created_at)   
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
        //http://mustafa-pc/crm/Product_API/temp_product_list?user_id=1

    }


    public function get_approval_info()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        $assign_info = $this->db->query("SELECT * from tbltemperoryproduct_approval  where pro_id = '".$id."'  ")->result();
        if(!empty($assign_info)){
            foreach ($assign_info as $value) {

                if($value->approve_status == 0){
                    $status = 'Pending';
                }elseif($value->approve_status == 1){
                    $status = 'Approved';
                }elseif($value->approve_status == 2){
                    $status = 'Reject';
                }
                $remark = ($value->remark != '') ?  $value->remark : '--';
                $arr[] = array(
                    'id' => $value->id,
                    'status' => $status,
                    'status_id' => $value->approve_status,
                    'staff_name' => get_employee_name($value->staff_id),
                    'remark' => $remark,   
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
        //http://mustafa-pc/crm/Product_API/get_approval_info?id=5
    }

}
