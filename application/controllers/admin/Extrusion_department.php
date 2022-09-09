<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Extrusion_department extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index() {

        check_permission(172,'view');    

        $where = " id > '0' ";

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
        
    	$data['title'] = 'Item Demand List';
        $this->load->view('admin/extrusion_department/view_request', $data);
    }

    public function cutting_request_details($id) {

        $data['request_info'] = $this->db->query("SELECT * FROM `tblrequestcutting`  where id = '".$id."' ")->row();
        $data['requestitem_info'] = $this->db->query("SELECT * FROM `tblrequestcuttingitems`  where request_id = '".$id."' ")->result();

        $data['title'] = 'Cutting Request Details';
        $this->load->view('admin/extrusion_department/cutting_request_details', $data);
    }

    public function approve_request() {
        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            $ad_data = array(
                    'approve_by' => get_staff_user_id(),
                    'approve_status' => $action, 
                    'approve_remark' => $approve_remark,   
                    'approve_date' => date('Y-m-d')
            );

            if($this->home_model->update('tblrequestcutting', $ad_data,array('id'=>$id))){
                set_alert('success', 'Action taken succesfully');
                redirect(admin_url('extrusion_department')); 
            }

        }
    }


    public function store()
    {
        check_permission(173,'view');
        /*$this->session->unset_userdata('extrusion_where');
        $this->session->unset_userdata('extrusion_search');*/

        $where = "department_id = 1 and qty > 0 ";
        
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('extrusion_where');
                $this->session->unset_userdata('extrusion_search');
            }else{
                if(isset($product_id) || isset($warehouse_id)){
                    $this->session->unset_userdata('extrusion_where');
                    $this->session->unset_userdata('extrusion_search');
                    $sreach_arr = array();
                    if(!empty($product_id)){
                        $sreach_arr['product_id'] = $product_id; 
                        $where .= " and product_id = '".$product_id."'";               
                    } 

                    if(!empty($warehouse_id)){
                        $sreach_arr['warehouse_id'] = $warehouse_id; 
                        $where .= " and warehouse_id = '".$warehouse_id."'";               
                    }                    

                    $this->session->set_userdata('extrusion_where',$where);
                    $this->session->set_userdata('extrusion_search',$sreach_arr);                    
                }
              
            }            
        }else{
            if(!empty($this->session->userdata('extrusion_where'))){
                $where = $this->session->userdata('extrusion_where');
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
        
 
        $data['title'] = 'Extrusion Stock'; 
        $this->load->view('admin/extrusion_department/store', $data); 

    }
   

    public function transfer_request() {

        check_permission(174,'view');    

        $where = " id > '0' ";

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            if(!empty($accept_status)){
                 
                $data['s_accept_status'] = $accept_status;
                $where .= " and accept_status = '".$accept_status."'";
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
                $where .= " and accept_status =  1 ";
        }


        $data['request_list'] = $this->db->query("SELECT * from tblextrutiontransfer where  ".$where." order by id desc ")->result();
        
        $data['title'] = 'Transfer Request';
        $this->load->view('admin/extrusion_department/transfer_request', $data);
    }



    public function get_transfer_confirmation_html() {
        if(!empty($_POST)){
            extract($this->input->post());

            $request_info = $this->db->query("SELECT * from tblextrutiontransfer where id = '".$id."' ")->row();           
            $stock_info = $this->db->query("SELECT * from tblmanufacturestock where id = '".$request_info->ms_id."' ")->row(); 

            $requestitem_info = $this->db->query("SELECT * FROM `tblrequestcuttingitems` where request_id = '".$request_info->request_id."' ")->result_array();

            $confirmation_status = 'Pending';
            if($request_info->accept_status == 2){
                $confirmation_status = 'Received';
            }elseif($request_info->accept_status == 3){
                $confirmation_status = 'Not Received';
            }          
            
            ?>
            <form action="<?php echo admin_url('extrusion_department/trasfer_confirmation');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="row">
                <div class="col-md-12">  

            <?php
            if($request_info->transfer_type == 1){
            ?>        

            <div class="lead-view" id="leadViewWrapper">
             <div class="col-md-4 col-xs-12 lead-information-col">
                <div class="lead-info-heading">
                   <h4 class="no-margin font-medium-xs bold">Product Information </h4>
                </div>
                <p class="text-muted lead-field-heading no-mtop">Prodcut Name</p>
                <p class="bold font-medium-xs lead-name"><?php echo value_by_id('tblproducts',$stock_info->product_id,'sub_name'); ?></p>
                <p class="text-muted lead-field-heading">Warehouse</p>
                <p class="bold font-medium-xs"><?php echo value_by_id('tblwarehouse',$stock_info->warehouse_id,'name'); ?></p>
                <p class="text-muted lead-field-heading">Quantity</p>
                <p class="bold font-medium-xs"><?php echo $stock_info->qty; ?></p>
                <p class="text-muted lead-field-heading">Size</p>
                <p class="bold font-medium-xs"><?php echo $stock_info->size; ?></p>

             </div>
            <div class="col-md-4 col-xs-12 lead-information-col">
                <div class="lead-info-heading">
                   <h4 class="no-margin font-medium-xs bold">General Information</h4>
                </div>
                 <p class="text-muted lead-field-heading">Transfer By</p>
                <p class="bold font-medium-xs"><?php echo ($request_info->transfer_by > 0) ?  get_employee_name($request_info->transfer_by) : '--'; ?></p>
                <p class="text-muted lead-field-heading">Trasfer Date</p>
                <p class="bold font-medium-xs"><?php echo _d($request_info->date); ?></p>
                <p class="text-muted lead-field-heading no-mtop">Status</p>
                <p class="bold font-medium-xs lead-name"><?php echo $confirmation_status; ?></p>

             </div>
         <div class="col-md-4 col-xs-12 lead-information-col">
            <div class="lead-info-heading">
               <h4 class="no-margin font-medium-xs bold">Acceptance Details</h4>
            </div>

            <p class="text-muted lead-field-heading">Action By</p>
            <p class="bold font-medium-xs"><?php echo ($request_info->accept_by > 0) ?  get_employee_name($request_info->accept_by) : '--'; ?></p>
            <p class="text-muted lead-field-heading">Action Date</p>
            <p class="bold font-medium-xs"><?php echo (!empty($request_info->accept_date)) ?  _d($request_info->accept_date) : '--'; ?></p>
            <p class="text-muted lead-field-heading">Action Remark</p>
            <p class="bold font-medium-xs"><?php echo (!empty($request_info->accept_remark)) ? $request_info->accept_remark : '--' ; ?></p>
            

         </div>
         
      </div>

        <?php
        }else{
        ?>
        <h4 class="no-mtop mrg3">Transfer Item List </h4>
        <hr>
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

        <div class="col-md-4">  
            <div class="form-group">
               <label for="accept_status" class="control-label">Item Status</label>
               <input type="text" class="form-control" disabled="" value="<?php echo ($request_info->item_status == 1) ? 'Used' : 'Unused'; ?>">               
            </div>
        </div>

         <div class="col-md-8">
            <div class="form-group">
                <label class="control-label">Transfer Remarks</label>
                <textarea class="form-control" disabled=""><?php if(!empty($request_info->transfer_remark)){ echo $request_info->transfer_remark; }?></textarea>
            </div>
        </div>


        <?php    
        }
        if($request_info->accept_status == 1){
        ?>
        <hr>
        <br>
        <div class="col-md-12">                
        <h4 class="text-center"><u>Transfer Acceptance</u></h4>
                    <div class="col-md-4">  
                        <div class="form-group">
                           <label for="accept_status" class="control-label">Confirmation Status</label>
                            <select class="form-control selectpicker" required="" data-live-search="true" name="accept_status">
                                <option value=""></option>
                                <option value="2" <?php if(!empty($request_info) && $request_info->accept_status == 2){ echo 'selected'; } ?>>Received</option>
                                <option value="3" <?php if(!empty($request_info) && $request_info->accept_status == 3){ echo 'selected'; } ?>>Not Received</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="accept_remark" class="control-label">Remarks</label>
                            <textarea id="accept_remark" class="form-control" required="" name="accept_remark"><?php if(!empty($request_info->accept_remark)){ echo $request_info->accept_remark; }?></textarea>
                        </div>
                    </div>

                            <input type="hidden" value="<?php echo $id; ?>" name="id">
                  
                        <div class="col-md-12">  
                       <div class="form-group text-right">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div> 
                        </div> 
                   
                </div>
         <?php    
                    }
                    ?>    

                </div>
            </div>    

            </form> 
            <?php

        }
    }

    public function trasfer_confirmation() {
        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
                    'accept_by' => get_staff_user_id(),
                    'accept_status' => $accept_status, 
                    'accept_remark' => $accept_remark,   
                    'accept_date' => date('Y-m-d')
            );

            if($this->home_model->update('tblextrutiontransfer', $ad_data,array('id'=>$id))){                

                if($accept_status == 2){

                    $request_info = $this->db->query("SELECT * from tblextrutiontransfer where id = '".$id."' ")->row();

                    if($request_info->transfer_type == 1){
                        $ms_id = value_by_id('tblextrutiontransfer',$id,'ms_id');
                        $this->home_model->update('tblmanufacturestock', array('department_id'=>1),array('id'=>$ms_id));
                    }else{
                        $requestitem_info = $this->db->query("SELECT * FROM `tblrequestcuttingitems`  where request_id = '".$request_info->request_id."' ")->result();
                        if(!empty($requestitem_info)){
                            foreach ($requestitem_info as $key => $value) {

                                $service_type = value_by_id('tblmanufacturestock',$value->bundle_id,'service_type');
                                $warehouse_id = value_by_id('tblmanufacturestock',$value->bundle_id,'warehouse_id');

                                $main_id = $value->bundle_id;
                                $parent_id = value_by_id('tblmanufacturestock',$value->bundle_id,'parent_id');
                                if($parent_id > 0){
                                   $main_id = $parent_id; 
                                }

                                //Less quantity from cutting department
                                $cutting_stock_info = $this->db->query("SELECT * FROM `tblmanufacturestock`  where service_type = '".$service_type."' and warehouse_id = '".$warehouse_id."' and department_id = '2' and  parent_id = '".$main_id."' and size = '".$value->item_size."' and product_id = '".$value->item_id."' and waste = '0' and status = '1' and transferable = 0 ")->row();
                                if(!empty($cutting_stock_info)){
                                    $less_qty = ($cutting_stock_info->qty - $value->quantity);
                                    $this->home_model->update('tblmanufacturestock', array('qty'=>$less_qty),array('id'=>$cutting_stock_info->id));
                                }

                                //Add quantity from Extrution department
                                $extrution_stock_info = $this->db->query("SELECT * FROM `tblmanufacturestock`  where service_type = '".$service_type."' and warehouse_id = '".$warehouse_id."' and department_id = '1' and size = '".$value->item_size."' and product_id = '".$value->item_id."' and waste = '0' and status = '1' ")->row();
                                 if(!empty($extrution_stock_info)){
                                    $n_qty = ($extrution_stock_info->qty + $value->quantity);
                                    $this->home_model->update('tblmanufacturestock', array('qty'=>$n_qty),array('id'=>$extrution_stock_info->id));
                                }

                            }
                        }
                    }
                    
                }

                set_alert('success', 'Transfer Confirmation succesfully');
                redirect(admin_url('extrusion_department/transfer_request')); 
            }
        }


    }


}
