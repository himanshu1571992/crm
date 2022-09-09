<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Cutting_department extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Debitnote_model');
        $this->load->model('home_model');
    }

    public function index() {

        check_permission(176,'view');    

        $where = " id > '0' and cutting_process != 3 ";

    	if(!empty($_POST)){
       		extract($this->input->post());
       		/*echo '<pre/>';
       		print_r($_POST);
       		die;*/

       		if(!empty($approve_status)){
       		    $data['s_approve_status'] = $approve_status;
       		    $where .= " and approve_status = '".$approve_status."'";
       		}
       		
       		if(!empty($confirmation_status)){
       		    $data['s_confirmation_status'] = $confirmation_status;
       		    $where .= " and confirmation_status = '".$confirmation_status."'";
       		}


       		
       		if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));           
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
         
    	}


    	$data['request_list'] = $this->db->query("SELECT * from tblrequestcutting where  ".$where." order by id desc ")->result();
        
    	$data['title'] = 'Request List';
        $this->load->view('admin/cutting_department/view_request', $data);
    }
   

    public function add_request($id = '') {
        check_permission(176,'create'); 
        if ($this->input->post()) {
            extract($this->input->post());
           /* echo '<pre/>';
            print_r($_POST);
            die;*/
            if(!empty($bundles)){
            	$ad_data = array(
                    'staff_id' => get_staff_user_id(),
                    'approval_department' => $department_id, 
                    'service_type' => $service_type, 
                    'warehouse_id' => $warehouse_id, 
                    'product_id' => $product_id,    
                    'product_size' => $product_size,    
                    'product_qty' => $product_qty,
                    'waste' => $waste,
                    'remarks' => $remarks,    
                    'date' => date('Y-m-d'),    
                    'created_at' => date('Y-m-d H:i:s'),    
                    'approve_status' => 1   
                );
                if($this->home_model->insert('tblrequestcutting', $ad_data)){
                	$request_id = $this->db->insert_id();

                	foreach($bundles as $bundle_id) {
                        $req_qty = $_POST['req_qty'.$bundle_id];
                        $size = $_POST['item_size'.$bundle_id];
                        $item_id = $_POST['item_id'.$bundle_id];


                        $ad_data1 = array(
		                    'request_id' => $request_id,
		                    'bundle_id' => $bundle_id,    
		                    'item_id' => $item_id,    
		                    'quantity' => $req_qty,    
		                    'item_size' => $size,  
		                    'status' => 1    
		                );

		                $this->home_model->insert('tblrequestcuttingitems', $ad_data1);		                
                    }
                    set_alert('success', 'Cutting item request succesfully');
                    redirect(admin_url('cutting_department')); 
                }
            }else{
            	set_alert('danger', 'Pipe is not selected!');
                redirect(admin_url('cutting_department/add_request'));
            }            
        }


        //Check any pending request
        $pending_request_info = $this->db->query("SELECT id from tblrequestcutting where confirmation_status = '1' ")->row();
        if(!empty($pending_request_info)){
            set_alert('danger', 'There is already a pending request!');
            redirect(admin_url('cutting_department'));
        }

        $data['title'] = 'Cutting Item Request';

        $superior_ids = $this->db->query("SELECT superior_ids from tblproduction_department where id = '2' ")->row()->superior_ids;
        $data['department_info'] = $this->db->query("SELECT * FROM `tblproduction_department`  where id IN (".$superior_ids.") ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();
        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ")->result_array();

        $this->load->view('admin/cutting_department/add_request', $data);
    }


    public function cutting_request_details($id) {

    	$data['request_info'] = $this->db->query("SELECT * FROM `tblrequestcutting`  where id = '".$id."' ")->row();
    	$data['requestitem_info'] = $this->db->query("SELECT * FROM `tblrequestcuttingitems`  where request_id = '".$id."' ")->result();

    	$data['title'] = 'Cutting Request Details';
    	$this->load->view('admin/cutting_department/cutting_request_details', $data);
    }

    public function delete_request($id) {
        check_permission(176,'delete'); 
        
        $delete = $this->home_model->delete('tblrequestcutting',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblrequestcuttingitems',array('request_id'=>$id));
            set_alert('success', 'Cutting request deleted successfully');
            redirect(admin_url('cutting_department'));
        }       

    }


    public function get_confirmation_html() {
        if(!empty($_POST)){
            extract($this->input->post());

            $request_info = $this->db->query("SELECT * from tblrequestcutting where id = '".$id."' ")->row();           
            
            ?>
            <form action="<?php echo admin_url('cutting_department/request_confirmation');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="row">

                    <div class="col-md-12">
                        <h4>Cutting Item Request</h4>
                        <hr/>
                    </div>

                    <div class="col-md-4">  
                        <div class="form-group">
                           <label for="confirmation_status" class="control-label">Confirmation Status</label>
                            <select class="form-control selectpicker" required="" data-live-search="true" name="confirmation_status">
                                <option value=""></option>
                                <option value="2" <?php if(!empty($request_info) && $request_info->confirmation_status == 2){ echo 'selected'; } ?>>Received</option>
                                <option value="3" <?php if(!empty($request_info) && $request_info->confirmation_status == 3){ echo 'selected'; } ?>>Not Received</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="confirmation_remark" class="control-label">Remarks</label>
                            <textarea id="confirmation_remark" class="form-control" required="" name="confirmation_remark"><?php if(!empty($request_info->confirmation_remark)){ echo $request_info->confirmation_remark; }?></textarea>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    <?php
                    if($request_info->confirmation_status == 1){
                    ?>
                        <div class="col-md-12">  
                       <div class="form-group text-right">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div> 
                        </div> 
                    <?php    
                    }
                    ?>
                    

            </form> 
            <?php

        }
    }


    public function request_confirmation() {
        if(!empty($_POST)){
        	extract($this->input->post());

        	$ad_data = array(
                    'confirm_by' => get_staff_user_id(),
                    'confirmation_status' => $confirmation_status, 
                    'confirmation_remark' => $confirmation_remark,   
                    'confirmation_date' => date('Y-m-d')
            );

            if($this->home_model->update('tblrequestcutting', $ad_data,array('id'=>$id))){

            	$this->home_model->update('tblrequestcuttingitems', array('status'=>$confirmation_status),array('request_id'=>$id));

            	if($confirmation_status == 2){
            		$requestitem_info = $this->db->query("SELECT * FROM `tblrequestcuttingitems`  where request_id = '".$id."' ")->result();

            		foreach ($requestitem_info as $row) {

            			//Less bundle qantity from manufacturing stock and make as open bundle
            			$bundle_qty = value_by_id('tblmanufacturestock',$row->bundle_id,'qty');
                        $less_qty = ($bundle_qty-$row->quantity);
                        $this->home_model->update('tblmanufacturestock', array('open_bundle'=>1,'qty'=>$less_qty),array('id'=>$row->bundle_id));


                        //Adding stock to cutting department
                        $main_id = $row->bundle_id;
                        $parent_id = value_by_id('tblmanufacturestock',$row->bundle_id,'parent_id');
                        if($parent_id > 0){
                           $main_id = $parent_id; 
                        }
                        $service_type = value_by_id('tblmanufacturestock',$row->bundle_id,'service_type');
                        $warehouse_id = value_by_id('tblmanufacturestock',$row->bundle_id,'warehouse_id');

                        $exist_r_product = $this->db->query("SELECT * FROM `tblmanufacturestock`  where service_type = '".$service_type."' and warehouse_id = '".$warehouse_id."' and department_id = '2' and  parent_id = '".$main_id."' and size = '".$row->item_size."' and product_id = '".$row->item_id."' and waste = '0' and status = '1' ")->row();
                        if(!empty($exist_r_product)){
                            $r_qty = ($exist_r_product->qty + $row->quantity);
                            $this->home_model->update('tblmanufacturestock', array('qty'=>$r_qty),array('id'=>$exist_r_product->id));
                        }else{
                            $ad_data_3 = array(
                                'parent_id' => $main_id,
                                'service_type' => $service_type,
                                'warehouse_id' => $warehouse_id,
                                'm_id' => 0,
                                'department_id' => 2,
                                'product_id' => $row->item_id,
                                'bundle_no' => 0,
                                'size' => $row->item_size,   
                                'qty' => $row->quantity,    
                                'weight_per_psc' => 0,    
                                'bundle_weight' => 0,  
                                'waste' => 0, 
                                'status' => 1
                            );
                            $this->home_model->insert('tblmanufacturestock', $ad_data_3);
                        }
                        //End Adding stock to cutting department

            		}
            	}



                set_alert('success', 'Confirmation taken succesfully');
                redirect(admin_url('cutting_department')); 
            }
        }


    }



    public function demand() {

        check_permission(177,'view');    

        $where = " department_id = '2' ";

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            if(!empty($approve_status)){
                $data['s_approve_status'] = $approve_status;
                $where .= " and approve_status = '".$approve_status."'";
            }
            
            if(!empty($confirmation_status)){
                $data['s_confirmation_status'] = $confirmation_status;
                $where .= " and confirmation_status = '".$confirmation_status."'";
            }


            
            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));           
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
         
        }else{
            $where .= ' and approve_status = 1';
        }


        $data['demand_list'] = $this->db->query("SELECT * from tbldepartmentrequestitems where  ".$where." order by id desc ")->result();
        
        $data['title'] = 'Demand List';
        $this->load->view('admin/cutting_department/demand', $data);
    }



    public function get_details()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            
            $requestitem_info  = $this->db->query("SELECT * from tbldepartmentrequestitems where id = '".$id."' ")->row();
            $request_info  = $this->db->query("SELECT * from tbldepartmentrequest where id = '".$requestitem_info->request_id."' ")->row();


            $stock_info = $this->db->query("SELECT qty from tblprostock where warehouse_id = '".$request_info->warehouse_id."' and service_type = '".$request_info->service_type."' and department_id = '".$requestitem_info->department_id."' and pro_id = '".$requestitem_info->item_id."' and status = 1 and stock_type = 1  ")->row();
            $available_qty = 0;
            if(!empty($stock_info)){
                $available_qty = $stock_info->qty;
            }
       
            $confirmation_status = '--';
            if($requestitem_info->confirmation_status == 2){
                $confirmation_status = 'Received';
            }elseif($requestitem_info->confirmation_status == 3){
                $confirmation_status = 'Not Received';
            }
            ?>

            <?php
            if(empty($requestitem_info)){
                ?>
                <div class="col-md-12"><h3 class="text-danger text-center">This request is deleted</h3></div>
                <?php
                die;
            }
            ?>

            <form action="<?php echo admin_url('cutting_department/approve_demand');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

             <div class="col-md-12">  
                

            <div class="lead-view" id="leadViewWrapper">
             <div class="col-md-4 col-xs-12 lead-information-col">
                <div class="lead-info-heading">
                   <h4 class="no-margin font-medium-xs bold">Product Information </h4>
                </div>
                <p class="text-muted lead-field-heading no-mtop">Prodcut Name</p>
                <p class="bold font-medium-xs lead-name"><?php echo value_by_id('tblproducts',$request_info->product_id,'sub_name'); ?></p>
                <p class="text-muted lead-field-heading">Warehouse</p>
                <p class="bold font-medium-xs"><?php echo value_by_id('tblwarehouse',$request_info->warehouse_id,'name'); ?></p>
                <p class="text-muted lead-field-heading">Service Type</p>
                <p class="bold font-medium-xs"><?php echo ($request_info->service_type == 1) ? 'Rent' : 'Sale'; ?></p>

             </div>
            <div class="col-md-4 col-xs-12 lead-information-col">
                <div class="lead-info-heading">
                   <h4 class="no-margin font-medium-xs bold">General Information</h4>
                </div>
                <p class="text-muted lead-field-heading no-mtop">Reference No</p>
                <p class="bold font-medium-xs lead-name"><?php echo (!empty($request_info->reference_no)) ? $request_info->reference_no : '--'; ?></p>
                <p class="text-muted lead-field-heading">Date</p>
                <p class="bold font-medium-xs"><?php echo _d($request_info->date); ?></p>
                <p class="text-muted lead-field-heading">Remark</p>
                <p class="bold font-medium-xs"><?php echo (!empty($request_info->remarks)) ? cc($request_info->remarks) : '--'; ?></p>

             </div>
         <div class="col-md-4 col-xs-12 lead-information-col">
            <div class="lead-info-heading">
               <h4 class="no-margin font-medium-xs bold">Confirmation Details</h4>
            </div>
            <p class="text-muted lead-field-heading no-mtop">Status</p>
            <p class="bold font-medium-xs lead-name"><?php echo $confirmation_status; ?></p>
            <p class="text-muted lead-field-heading">Added By</p>
            <p class="bold font-medium-xs"><?php echo ($requestitem_info->confirm_by > 0) ?  get_employee_name($requestitem_info->confirm_by) : '--'; ?></p>
            <p class="text-muted lead-field-heading">Remark</p>
            <p class="bold font-medium-xs"><?php echo (!empty($requestitem_info->confirmation_remark)) ? cc($requestitem_info->confirmation_remark) : '--' ; ?></p>
            

         </div>
         
      </div>
        <hr>
        <br>
        <div class="col-md-12">                
        <h4 class="text-center"><u>Request Item Information</u></h4>
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th width="40%">Item Name</th>
                        <th width="5%">Req</th>
                        <th width="5%">Avail</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Remark</th>
                        <th width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td><?php echo value_by_id('tblproducts',$requestitem_info->item_id,'sub_name'); ?></td>  
                        <td><?php echo $requestitem_info->quantity; ?></td>                       
                        <td><?php echo $available_qty; ?></td>                       
                        <td><input type="text" class="form-control" required name="quantity" <?php echo ($requestitem_info->approve_status > 1) ?  'readonly' : '--'; ?> value=" <?php echo ($requestitem_info->approve_status > 1) ?  $requestitem_info->delivered_qty : ''; ?>"></td>                       
                        <td><textarea class="form-control" required="" <?php echo ($requestitem_info->approve_status > 1) ?  'readonly' : '--'; ?> name="approve_remark"><?php echo ($requestitem_info->approve_status > 1) ?  $requestitem_info->approve_remark : ''; ?></textarea></td>     
                        <td>
                            <select class="form-control selectpicker" data-live-search="true" name="approve_status" required="">
                                <option value=""></option>
                                <option value="2" <?php if(!empty($requestitem_info) && $requestitem_info->approve_status == 2){ echo 'selected'; } ?>>Approved</option>
                                <option value="3" <?php if(!empty($requestitem_info) && $requestitem_info->approve_status == 3){ echo 'selected'; } ?>>Rejected</option>
                            </select>
                        </td>              
                                         
                     </tr>
                      
                     
                    </tbody>
                  </table>
          </div>
          <?php
                    if($requestitem_info->approve_status == 1){
                    ?>
                        <div class="col-md-12">  
                       <div class="form-group text-right">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div> 
                        </div> 
                    <?php    
                    }
                    ?>        
            </div>

            </div>
             <input type="hidden" value="<?php echo $id; ?>" name="id">
                    
        </form>
            <?php
        }
    }


    public function approve_demand() {
        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            $ad_data = array(
                    'approve_by' => get_staff_user_id(),
                    'delivered_qty' => $quantity, 
                    'approve_status' => $approve_status, 
                    'approve_remark' => $approve_remark,   
                    'approve_date' => date('Y-m-d')
            );

            if($this->home_model->update('tbldepartmentrequestitems', $ad_data,array('id'=>$id))){
                set_alert('success', 'Action taken succesfully');
                redirect(admin_url('cutting_department/demand')); 
            }

        }
    }
   

    public function store() {

        check_permission(179,'view');    

        $where = " department_id = '2' ";

    	if(!empty($_POST)){
       		extract($this->input->post());
       		/*echo '<pre/>';
       		print_r($_POST);
       		die;*/

       		if(!empty($product_id)){
       		    $data['s_product_id'] = $product_id;
       		    $where .= " and pro_id = '".$product_id."'";
       		}
       		
       		if(!empty($warehouse_id)){
       		    $data['s_warehouse_id'] = $warehouse_id;
       		    $where .= " and warehouse_id = '".$warehouse_id."'";
       		}

         
    	}


    	$data['stock_list'] = $this->db->query("SELECT * from tblprostock where  ".$where." order by id asc ")->result();

    	$data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();
        
    	$data['title'] = 'Cutting Store';
        $this->load->view('admin/cutting_department/store', $data);
    }


    public function extrusion_store()
    {
        check_permission(180,'view');
        /*$this->session->unset_userdata('extrusion_where');
        $this->session->unset_userdata('extrusion_search');*/

        $where = "department_id = 2 and qty > 0 ";
        
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('cutting_extrusion_where');
                $this->session->unset_userdata('cutting_extrusion_search');
            }else{
                if(isset($product_id) || isset($warehouse_id)){
                    $this->session->unset_userdata('cutting_extrusion_where');
                    $this->session->unset_userdata('cutting_extrusion_search');
                    $sreach_arr = array();
                    if(!empty($product_id)){
                        $sreach_arr['product_id'] = $product_id; 
                        $where .= " and product_id = '".$product_id."'";               
                    } 

                    if(!empty($warehouse_id)){
                        $sreach_arr['warehouse_id'] = $warehouse_id; 
                        $where .= " and warehouse_id = '".$warehouse_id."'";               
                    }                    

                    $this->session->set_userdata('cutting_extrusion_where',$where);
                    $this->session->set_userdata('cutting_extrusion_search',$sreach_arr);                    
                }
              
            }            
        }else{
            if(!empty($this->session->userdata('cutting_extrusion_where'))){
                $where = $this->session->userdata('cutting_extrusion_where');
            }
        } 


        $this->load->library('pagination');

        $uriSegment = 4; 
        $perPage = 25;
        
         
        // Get record count 
        $totalRec = $this->home_model->get_extrusion_stock_count($where); 
         
        // Pagination configuration 
        $config['base_url']    = admin_url().'extrusion_department/store/'; 
        $config['uri_segment'] = $uriSegment; 
        $config['total_rows']  = $totalRec; 
        $config['per_page']    = $perPage; 

        // For pagination link
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">'; 
        $config['cur_tag_close'] = '</a></li>'; 
        $config['next_link'] = 'Next'; 
        $config['prev_link'] = 'Prev'; 
        $config['next_tag_open'] = '<li class="pg-next">'; 
        $config['next_tag_close'] = '</li>'; 
        $config['prev_tag_open'] = '<li class="pg-prev">'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>'; 
        $config['last_tag_close'] = '</li>';
         
        // Initialize pagination library 
        $this->pagination->initialize($config); 
         
        // Define offset 
        $page = $this->uri->segment($uriSegment); 
        $offset = !$page?0:$page; 
         
        // Get records 
        $data['store_list'] = $this->home_model->get_extrusion_stock($where,$offset,$perPage); 



        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();
        
 
        $data['title'] = 'Cutting Extrusion Stock'; 
        $this->load->view('admin/cutting_department/extrusion_store', $data); 

    }


    public function transfer_stock($id) {
        if ($id) {
            $ad_data = array(
                'ms_id' => $id,
                'transfer_by' => get_staff_user_id(),
                'date' => date('Y-m-d'), 
                'accept_status' => 1   
            );
            if($this->home_model->insert('tblextrutiontransfer', $ad_data)){
                set_alert('success', 'Transfer request send succesfully');
                redirect(admin_url('cutting_department/extrusion_store')); 
            } 

        }

    }


    public function get_trnsferdetails()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            
            $request_info = $this->db->query("SELECT * FROM `tblrequestcutting` where id = '".$id."' ")->row_array();
       		$requestitem_info = $this->db->query("SELECT * FROM `tblrequestcuttingitems` where request_id = '".$id."' ")->result_array();
            ?>
            <form action="<?php echo admin_url('cutting_department/transfer_request_stock');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

             <div class="col-md-12">  
              <h4 class="no-mtop mrg3">Transfer Item List </h4>
        <hr>

            <div class="col-md-4">
            <div class="form-group">
                <label for="item_status" class="control-label">Service status</label>
                <select class="form-control selectpicker" required="" data-live-search="true" id="item_status" name="item_status">   
                    <option value=""></option>                                    
                    <option value="1">Used</option>
                    <option value="2">Unused</option>                                       
                </select>
            </div>
        </div>

         <div class="col-md-8">
            <div class="form-group">
                <label for="transfer_remark" class="control-label">Remarks</label>
                <textarea id="transfer_remark" class="form-control" name="transfer_remark"></textarea>
            </div>
        </div>

        <br>

    
        <div style="">
            <div class="form-group" >
                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                    <thead>
                        <tr>
                            <td style="width:10%">S.No</td>
                            <td style="width:45%">Item Name</td>
                            <td style="width:15%">Bundle No.</td>
                            <td style="width:15%">Size</td>
                            <td style="width:15%">Quantity</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($requestitem_info)){
                        $i = 1;
                        foreach ($requestitem_info as $value) {

                            $b_info = $this->db->query("SELECT * FROM `tblmanufacturestock`  where id = '".$value['bundle_id']."' ")->row();
                            if($b_info->parent_id > 0){
                                $b_info = $this->db->query("SELECT * FROM `tblmanufacturestock`  where id = '".$b_info->parent_id."' ")->row();
                            }

                            ?>
                            <tr>                                                      
                                <td><?php echo $i++;?></td>
                                <td><?php echo value_by_id('tblproducts',$value['item_id'],'sub_name');?></td>
                                <td><?php echo $b_info->bundle_no;?></td>
                                <td><?php echo $value['item_size'];?></td>
                                <td><?php echo $value['quantity'];?></td>                                                                                                  
                            </tr>
                            <?php
                        }
                    }
                    ?>  
                    </tbody>
                </table>
            </div>
        </div>


          <div class="col-md-12">  
               <div class="form-group text-right">
            <button class="btn btn-danger" type="submit">Cancel and Transfer</button>
        </div> 
        </div>        
            </div>

            </div>
             <input type="hidden" value="<?php echo $id; ?>" name="id">
                    
        </form>
            <?php
        }
    }


    public function transfer_request_stock() {
        if ($_POST) {
        	extract($this->input->post());
            $ad_data = array(
                'ms_id' => 0,
                'request_id' => $id,
                'item_status' => $item_status,
                'transfer_remark' => $transfer_remark,
                'transfer_type' => 2,
                'transfer_by' => get_staff_user_id(),
                'date' => date('Y-m-d'), 
                'accept_status' => 1   
            );
            if($this->home_model->insert('tblextrutiontransfer', $ad_data)){

            	$this->home_model->update('tblrequestcutting', array('cutting_process'=>3),array('id'=>$id));

            	if($item_status == 2){
            		set_alert('success', 'Transfer request send succesfully');
                	redirect(admin_url('cutting_department'));
            	}else{
                	set_alert('success', 'Transfer request send succesfully. Add new request against');
                	redirect(admin_url('cutting_department/add_request/'.$id));
            	} 
            }

        }

    }

}
