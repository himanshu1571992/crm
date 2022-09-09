<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Reducing_department extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index() {

        check_permission(187,'view');

        $where = " from_department = '4' ";

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
            $where .= ' and confirmation_status = 1';
        }


    	$data['request_list'] = $this->db->query("SELECT * from tbldepartmentrequestitems where  ".$where." order by id desc ")->result();

    	$data['title'] = 'Reducing Item Request List';
        $this->load->view('admin/reducing_department/view_request', $data);
    }


    public function add_request($id = '') {
        check_permission(187,'create');
        if ($this->input->post()) {
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            if(!empty($item_id)){
            	$ad_data = array(
                    'staff_id' => get_staff_user_id(),
                    'department_id' => 4,
                    'product_id' => $product_id,
                    'service_type' => $service_type,
                    'warehouse_id' => $warehouse_id,
                    'reference_no' => $reference_no,
                    'remarks' => $remarks,
                    'date' => date('Y-m-d'),
                    'status' => 1
                );
                if($this->home_model->insert('tbldepartmentrequest', $ad_data)){
                	$request_id = $this->db->insert_id();

                	foreach($item_id as $id) {
                        $department_id = $_POST['department_id'.$id];
                        $qty = $_POST['qty'.$id];


                        $ad_data1 = array(
		                    'request_id' => $request_id,
		                    'department_id' => $department_id,
                            'from_department' => 4,
		                    'item_id' => $id,
		                    'quantity' => $qty,
		                    'date' => date('Y-m-d'),
		                    'status' => 1
		                );

		                $this->home_model->insert('tbldepartmentrequestitems', $ad_data1);
                    }
                    set_alert('success', 'Notching Item requested succesfully');
                    redirect(admin_url('reducing_department'));
                }
            }else{
            	set_alert('danger', 'Components are empty!');
                redirect(admin_url('reducing_department/add_request'));
            }
        }


        //Check any pending request
        /*$pending_request_info = $this->db->query("SELECT id from tblrequestcutting where confirmation_status = '1' ")->row();
        if(!empty($pending_request_info)){
            set_alert('danger', 'There is already a pending request!');
            redirect(admin_url('reducing_department'));
        }*/

        $data['title'] = 'Reducing Item Request';

        $superior_ids = $this->db->query("SELECT superior_ids from tblproduction_department where id = '4' ")->row()->superior_ids;
        $data['department_info'] = $this->db->query("SELECT * FROM `tblproduction_department`  where id IN (".$superior_ids.") ")->result_array();

        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ")->result_array();
         $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();

        $this->load->view('admin/reducing_department/add_request', $data);
    }

    public function get_component_details() {
        extract($this->input->post());
        $item_info = $this->db->query("SELECT * FROM `tblproductitems` where `item_id`>'0' and `status`='1' and product_id = '".$product_id."' ")->result();

        $superior_ids = value_by_id('tblproduction_department',4,'superior_ids');
        $department_info = $this->db->query("SELECT * FROM `tblproduction_department`  where id IN (".$superior_ids.") ")->result();
        if(!empty($item_info)){
        ?>
        <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">


                    <div class="col-md-12" style="margin-bottom:5%;"></div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Components List</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <td style="width:10%">S.No</td>
                                                <td style="width:30%">Item Name</td>
                                                <td style="width:30%">Deaprtment</td>
                                                <td style="width:20%">Quantity</td>
                                                <td style="width:10%">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($item_info)){
                                            $i = 1;
                                            foreach ($item_info as $value) {
                                                $req_qty = ($value->qty*$quantity);
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo value_by_id('tblproducts',$value->item_id,'sub_name');?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" required="" data-live-search="true" name="department_id<?php echo $value->item_id; ?>" >
                                                                <!-- <option value=""></option> -->
                                                                <?php
                                                                if(!empty($department_info)){
                                                                    foreach ($department_info as  $row) {
                                                                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><input type="number" id="qty<?php echo $value->item_id; ?>" name="qty<?php echo $value->item_id; ?>" class="form-control" value="<?php echo $req_qty; ?>"></td>
                                                    <td> <input class="action" type="checkbox" name="item_id[]" value="<?php echo $value->item_id; ?>"></td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">Send Request</button>
                        </div>
                </div>


            </div>
        </div>

        <?php
        }
    }



    public function delete_request($id) {
        check_permission(187,'delete');

        $delete = $this->home_model->delete('tbldepartmentrequestitems',array('id'=>$id));

        if($delete == true){
            set_alert('success', 'Request deleted successfully');
            redirect(admin_url('reducing_department'));
        }

    }


    public function get_confirmation_html()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $requestitem_info  = $this->db->query("SELECT * from tbldepartmentrequestitems where id = '".$id."' ")->row();
            $request_info  = $this->db->query("SELECT * from tbldepartmentrequest where id = '".$requestitem_info->request_id."' ")->row();

            $approve_status = '--';
            if($requestitem_info->approve_status == 2){
                $approve_status = 'Approved';
            }elseif($requestitem_info->approve_status == 3){
                $approve_status = 'Reject';
            }
            ?>
            <form action="<?php echo admin_url('reducing_department/request_confirmation');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
                <p class="bold font-medium-xs"><?php echo (!empty($request_info->remarks)) ? $request_info->remarks : '--'; ?></p>

             </div>
         <div class="col-md-4 col-xs-12 lead-information-col">
            <div class="lead-info-heading">
               <h4 class="no-margin font-medium-xs bold">Approval Details</h4>
            </div>
            <p class="text-muted lead-field-heading no-mtop">Status</p>
            <p class="bold font-medium-xs lead-name"><?php echo $approve_status; ?></p>
            <p class="text-muted lead-field-heading">Added By</p>
            <p class="bold font-medium-xs"><?php echo ($requestitem_info->approve_by > 0) ?  get_employee_name($requestitem_info->approve_by) : '--'; ?></p>
            <p class="text-muted lead-field-heading">Remark</p>
            <p class="bold font-medium-xs"><?php echo (!empty($requestitem_info->approve_remark)) ? $requestitem_info->approve_remark : '--' ; ?></p>


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
                        <th width="10%">Request</th>
                        <th width="10%">Approved Qty</th>
                        <th width="20%">Remark</th>
                        <th width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td><?php echo value_by_id('tblproducts',$requestitem_info->item_id,'sub_name'); ?></td>
                        <td><?php echo $requestitem_info->quantity; ?></td>
                        <td><?php echo $requestitem_info->delivered_qty; ?></td>
                        <td>
                            <?php
                            if($requestitem_info->approve_status == 2){
                             ?>
                             <textarea class="form-control" required="" <?php echo ($requestitem_info->confirmation_status > 1) ?  'readonly' : '--'; ?> name="confirmation_remark"><?php echo ($requestitem_info->confirmation_status > 1) ?  $requestitem_info->confirmation_remark : ''; ?></textarea>
                             <?php
                            }else{
                                echo 'Rejected';
                            }
                            ?>
                         </td>
                        <td>
                             <?php
                            if($requestitem_info->approve_status == 2){
                             ?>
                             <select class="form-control selectpicker" data-live-search="true" name="confirmation_status">
                                <option value=""></option>
                                <option value="2" <?php if(!empty($requestitem_info) && $requestitem_info->confirmation_status == 2){ echo 'selected'; } ?>>Received</option>
                                <option value="3" <?php if(!empty($requestitem_info) && $requestitem_info->confirmation_status == 3){ echo 'selected'; } ?>>Not Received</option>
                            </select>
                             <?php
                            }else{
                                echo 'Rejected';
                            }
                            ?>

                        </td>

                     </tr>


                    </tbody>
                  </table>
          </div>
          <?php
                    if($requestitem_info->confirmation_status == 1 && $requestitem_info->approve_status == 2){
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


    public function request_confirmation() {
        if(!empty($_POST)){
        	extract($this->input->post());

        	$ad_data = array(
                    'confirm_by' => get_staff_user_id(),
                    'confirmation_status' => $confirmation_status,
                    'confirmation_remark' => $confirmation_remark,
                    'confirmation_date' => date('Y-m-d')
            );

            if($this->home_model->update('tbldepartmentrequestitems', $ad_data,array('id'=>$id))){

            	if($confirmation_status == 2){

                    $requestitem_info  = $this->db->query("SELECT * from tbldepartmentrequestitems where id = '".$id."' ")->row();
                    $request_info  = $this->db->query("SELECT * from tbldepartmentrequest where id = '".$requestitem_info->request_id."' ")->row();

                    //Less Stock from Department A
                    $stock_info = $this->db->query("SELECT * from tblprostock where warehouse_id = '".$request_info->warehouse_id."' and service_type = '".$request_info->service_type."' and department_id = '".$requestitem_info->department_id."' and pro_id = '".$requestitem_info->item_id."'   ")->row();

                    if(!empty($stock_info)){
                        $available_qty = ($stock_info->qty - $requestitem_info->delivered_qty);
                        $this->home_model->update('tblprostock', array('qty'=>$available_qty),array('id'=>$stock_info->id));
                    }


                    //Add Stock to department B
                    $stock_info = $this->db->query("SELECT * from tblprostock where warehouse_id = '".$request_info->warehouse_id."' and service_type = '".$request_info->service_type."' and department_id = '".$request_info->department_id."' and pro_id = '".$requestitem_info->item_id."' and status = 1 and stock_type = 1  ")->row();

                    if(!empty($stock_info)){
                        $n_qty = ($stock_info->qty + $requestitem_info->delivered_qty);
                        $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                    }else{
                        $ad_data = array(
                                'pro_id' => $requestitem_info->item_id,
                                'warehouse_id' => $request_info->warehouse_id,
                                'service_type' => $request_info->service_type,
                                'department_id' => $request_info->department_id,
                                'qty' => $requestitem_info->delivered_qty,
                                'is_pro' => '1',
                                'stock_type' => '1',
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );

                        $update = $this->home_model->insert('tblprostock', $ad_data);
                    }


            	}

                set_alert('success', 'Confirmation taken succesfully');
                redirect(admin_url('reducing_department'));
            }
        }


    }


    public function conversion_list($id = '') {
        check_permission(189,'view');
        $where = "department_id = 4";
        $data['s_warehouse_id'] = 0;
        if ($this->input->post()) {
            extract($this->input->post());

            if(!empty($warehouse_id)){
                $where .= " and warehouse_id = '".$warehouse_id."'";
                $data['s_warehouse_id'] = $warehouse_id;
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                $where .= " and date between '".$f_date."' and '".$t_date."'";
            }
        }

        $data['cuttitng_info'] = $this->db->query("SELECT * FROM `tbldepartmentconversion` where ".$where." order by id desc")->result();
        $data['warehouse_info'] = $this->db->query("SELECT * FROM `tblwarehouse`  where status = 1 ")->result();

        $data['title'] = 'Conversion List';
        $this->load->view('admin/reducing_department/conversion_list', $data);

    }


    public function conversion($id = '') {
        check_permission(189,'create');
        if ($this->input->post()) {
            /*extract($this->input->post());
            echo '<pre/>';
            print_r($_POST);
            die;*/
            if(!empty($item_id)){
                $ad_data = array(
                    'staff_id' => get_staff_user_id(),
                    'department_id' => 4,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'service_type' => $service_type,
                    'warehouse_id' => $warehouse_id,
                    'waste' => $waste,
                    'reference_no' => $reference_no,
                    'remarks' => $remarks,
                    'date' => date('Y-m-d'),
                    'status' => 1
                );
                if($this->home_model->insert('tbldepartmentconversion', $ad_data)){
                    $c_id = $this->db->insert_id();

                    //Start manage waste stock
                    if($waste > 0){
                        $waste_info = $this->db->query("SELECT * from tblprostock where warehouse_id = '".$warehouse_id."' and department_id = '4' and pro_id = '0' and status = 1 and stock_type = 5  ")->row();

                        if(!empty($waste_info)){
                            $n_qty = ($waste_info->qty + $waste);
                            $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$waste_info->id));
                        }else{
                            $ad_data = array(
                                    'pro_id' => 0,
                                    'warehouse_id' => $warehouse_id,
                                    'service_type' => 0,
                                    'department_id' => 4,
                                    'qty' => $waste,
                                    'is_pro' => '0',
                                    'stock_type' => '5',
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                );

                            $this->home_model->insert('tblprostock', $ad_data);
                        }
                    }

                    //End manage waste stock

                    //Start Adding New Stock
                    $stock_info = $this->db->query("SELECT * from tblprostock where warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and department_id = '4' and pro_id = '".$product_id."' and status = 1 and stock_type = 1  ")->row();

                    if(!empty($stock_info)){
                        $n_qty = ($stock_info->qty + $quantity);
                        $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                    }else{
                        $ad_data = array(
                                'pro_id' => $product_id,
                                'warehouse_id' => $warehouse_id,
                                'service_type' => $service_type,
                                'department_id' => 4,
                                'qty' => $quantity,
                                'is_pro' => '1',
                                'stock_type' => '1',
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );

                        $this->home_model->insert('tblprostock', $ad_data);
                    }
                    //End Adding New Stock

                    foreach($item_id as $id) {
                        $qty = $_POST['qty'.$id];
                        $ad_data1 = array(
                            'c_id' => $c_id,
                            'item_id' => $id,
                            'quantity' => $qty,
                            'status' => 1
                        );
                        $this->home_model->insert('tbldepartmentconversionitems', $ad_data1);


                        //start Less stock
                        $stock_info = $this->db->query("SELECT * from tblprostock where warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and department_id = '4' and pro_id = '".$id."'   ")->row();

                        if(!empty($stock_info)){
                            $available_qty = ($stock_info->qty - $qty);
                            $this->home_model->update('tblprostock', array('qty'=>$available_qty),array('id'=>$stock_info->id));
                        }
                        //end Less stock
                    }

                    set_alert('success', 'Conversion Made Succesfully');
                    redirect(admin_url('reducing_department/conversion_list'));
                }
            }else{
                set_alert('danger', 'Components are empty!');
                redirect(admin_url('reducing_department/conversion'));
            }
        }


        //Check any pending request
        /*$pending_request_info = $this->db->query("SELECT id from tblrequestcutting where confirmation_status = '1' ")->row();
        if(!empty($pending_request_info)){
            set_alert('danger', 'There is already a pending request!');
            redirect(admin_url('reducing_department'));
        }*/

        $data['title'] = 'Make Conversion';

        $superior_ids = $this->db->query("SELECT superior_ids from tblproduction_department where id = '2' ")->row()->superior_ids;
        $data['department_info'] = $this->db->query("SELECT * FROM `tblproduction_department`  where id IN (".$superior_ids.") ")->result_array();

        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ")->result_array();
         $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();

        $this->load->view('admin/reducing_department/conversion', $data);
    }



    public function get_conversion_component_details() {
        extract($this->input->post());
        $item_info = $this->db->query("SELECT * FROM `tblproductitems` where `item_id`>'0' and `status`='1' and product_id = '".$product_id."' ")->result();

        if(!empty($item_info)){
        ?>
        <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">


                    <div class="col-md-12" style="margin-bottom:5%;"></div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Components List</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <td style="width:10%">S.No</td>
                                                <td style="width:30%">Item Name</td>
                                                <td style="width:30%">Available Qty</td>
                                                <td style="width:20%">Quantity</td>
                                                <td style="width:10%">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($item_info)){
                                            $i = 1;
                                            foreach ($item_info as $value) {
                                                $stock_info = $this->db->query("SELECT qty from tblprostock where warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and department_id = '4' and pro_id = '".$value->item_id."' and status = 1 and stock_type = 1  ")->row();
                                                $available_qty = 0;
                                                if(!empty($stock_info)){
                                                    $available_qty = $stock_info->qty;
                                                }

                                                $req_qty = ($value->qty*$quantity);

                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo value_by_id('tblproducts',$value->item_id,'sub_name');?></td>
                                                    <td><?php echo $available_qty;  ?></td>
                                                    <td><input type="number" name="qty<?php echo $value->item_id; ?>" class="form-control" value="<?php echo $req_qty; ?>"></td>
                                                    <td> <input type="checkbox" name="item_id[]" value="<?php echo $value->item_id; ?>"></td>
                                                </tr>

                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" id="submit_request" type="button">Make Conversion</button>
                        </div>
                </div>


            </div>
        </div>

        <?php
        }
    }


    public function get_conversion_details()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $process_info  = $this->db->query("SELECT * from tbldepartmentconversion where id = '".$id."' ")->row();
            $processitem_info  = $this->db->query("SELECT * from tbldepartmentconversionitems where c_id = '".$id."' ")->result();
            ?>

            <div class="row">

             <div class="col-md-12">


                <div class="lead-view" id="leadViewWrapper">
         <div class="col-md-4 col-xs-12 lead-information-col">
            <div class="lead-info-heading">
               <h4 class="no-margin font-medium-xs bold">Product Information </h4>
            </div>
            <p class="text-muted lead-field-heading no-mtop">Prodcut Name</p>
            <p class="bold font-medium-xs lead-name"><?php echo value_by_id('tblproducts',$process_info->product_id,'sub_name'); ?></p>
            <p class="text-muted lead-field-heading">Warehouse</p>
            <p class="bold font-medium-xs"><?php echo value_by_id('tblwarehouse',$process_info->warehouse_id,'name'); ?></p>
            <p class="text-muted lead-field-heading">Service Type</p>
            <p class="bold font-medium-xs"><?php echo ($process_info->service_type == 1) ? 'Rent' : 'Sale'; ?></p>

         </div>
        <div class="col-md-4 col-xs-12 lead-information-col">
            <div class="lead-info-heading">
               <h4 class="no-margin font-medium-xs bold">Process Detail</h4>
            </div>
            <p class="text-muted lead-field-heading no-mtop">Product Quantity</p>
            <p class="bold font-medium-xs lead-name"><?php echo $process_info->quantity; ?></p>
            <p class="text-muted lead-field-heading">Waste (Kgs)</p>
            <p class="bold font-medium-xs"><?php echo $process_info->waste; ?></p>
            <p class="text-muted lead-field-heading">Reference#</p>
            <p class="bold font-medium-xs"><?php echo $process_info->reference_no; ?></p>

         </div>
         <div class="col-md-4 col-xs-12 lead-information-col">
            <div class="lead-info-heading">
               <h4 class="no-margin font-medium-xs bold">Conversion Information</h4>
            </div>
            <p class="text-muted lead-field-heading no-mtop">Date</p>
            <p class="bold font-medium-xs lead-name"><?php echo _d($process_info->date); ?></p>
            <p class="text-muted lead-field-heading">Remark</p>
            <p class="bold font-medium-xs"><?php echo $process_info->remarks; ?></p>
            <p class="text-muted lead-field-heading">Conversion By</p>
            <p class="bold font-medium-xs"><?php echo get_employee_name($process_info->staff_id); ?></p>

         </div>

      </div>
        <hr>
        <br>
        <div class="col-md-12">
        <h4 class="text-center"><u>Consumed Product Information</u></h4>
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(!empty($processitem_info)){
                        $z=1;
                        foreach($processitem_info as $row){

                            ?>

                            <tr>
                                <td><?php echo $z++;?></td>
                                <td><?php echo value_by_id('tblproducts',$row->item_id,'sub_name'); ?></td>
                                <td><?php echo $row->quantity; ?></td>

                             </tr>

                            <?php
                        }
                    }else{
                        echo '<tr><td class="text-center" colspan="3"><h5>Record Not Found</h5></td></tr>';
                    }
                    ?>


                    </tbody>
                  </table>
          </div>
            </div>
            </div>
            <?php
        }
    }



    public function demand() {

        check_permission(188,'view');

        $where = " department_id = '4' ";

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
        $this->load->view('admin/reducing_department/demand', $data);
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
            <form action="<?php echo admin_url('reducing_department/approve_demand');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
                <p class="bold font-medium-xs"><?php echo (!empty($request_info->remarks)) ? $request_info->remarks : '--'; ?></p>

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
            <p class="bold font-medium-xs"><?php echo (!empty($requestitem_info->confirmation_remark)) ? $requestitem_info->confirmation_remark : '--' ; ?></p>


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
                redirect(admin_url('reducing_department/demand'));
            }

        }
    }

    public function store() {

        check_permission(190,'view');

        $where = " department_id = '4' ";

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

        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ORDER BY name ASC")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1 ORDER BY name ASC")->result_array();

        $data['title'] = 'Reducing Store';
        $this->load->view('admin/reducing_department/store', $data);
    }


}
