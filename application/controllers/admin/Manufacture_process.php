<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Manufacture_process extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('manufacture_model');
        $this->load->model('home_model');
    }

    public function index($id = '') {
        check_permission(178,'view');
        $where = "status = 1";
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

                $where .= " and created_date between '".$f_date."' and '".$t_date."'";
            }
        }

        $data['cuttitng_info'] = $this->db->query("SELECT * FROM `tblcuttingprocess` where ".$where." ")->result();

        $data['warehouse_info'] = $this->db->query("SELECT * FROM `tblwarehouse`  where status = 1 ")->result();

        $data['title'] = 'Cutting List';
        $this->load->view('admin/manufacture_process/manage_cutting', $data);

    }

    public function cutting_process($id = '') {
        check_permission(178,'create');
        if ($this->input->post()) {
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            $final_size = ($product_size+$waste);
                   
            if(!empty($bundles)){
                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'request_id' => $request_id,
                    'service_type' => $service_type,
                    'warehouse_id' => $warehouse_id,    
                    'reference_no' => $reference_no,    
                    'product_id' => $product_id,    
                    'product_size' => $product_size,    
                    'product_qty' => $product_qty,    
                    'waste' => $waste,    
                    'remarks' => $remarks,    
                    'created_date' => date('Y-m-d'),    
                    'date_time' => date('Y-m-d H:i:s'),    
                    'status' => 1    
                );

                if($this->home_model->insert('tblcuttingprocess', $ad_data)){
                    $c_id = $this->db->insert_id();

                    //updating request table
                    $this->home_model->update('tblrequestcutting', array('cutting_process'=>2),array('id'=>$request_id));
                    $this->home_model->update('tblrequestcuttingitems', array('status'=>4),array('request_id'=>$request_id));

                    

                    foreach($bundles as $bundle_id) {
                        $req_qty = $_POST['req_qty'.$bundle_id];
                        $size = $_POST['item_size'.$bundle_id];
                        $item_id = $_POST['item_id'.$bundle_id];


                        //Less bundle qantity from manufacturing stock from cutting department
                        $main_id = $bundle_id;
                        $parent_id = value_by_id('tblmanufacturestock',$bundle_id,'parent_id');
                        if($parent_id > 0){
                           $main_id = $parent_id; 
                        }
                        $cutting_stock = $this->db->query("SELECT `id`,`qty` FROM `tblmanufacturestock`  where service_type = '".$service_type."' and warehouse_id = '".$warehouse_id."' and department_id = '2' and  parent_id = '".$main_id."' and size = '".$size."' and product_id = '".$item_id."' and waste = '0' and status = '1' ")->row();
                        if(!empty($cutting_stock)){
                            $less_qty = ($cutting_stock->qty-$req_qty);
                            $this->home_model->update('tblmanufacturestock', array('qty'=>$less_qty),array('id'=>$cutting_stock->id));
                        }
                        //End Less bundle qantity from manufacturing stock from cutting department


                        for ($i=1; $i<=$req_qty ; $i++) { 
                            $n_size = $size;

                            // This loop will find how much time we can cut the pipe for product
                            $k = 0;
                            for($j=0; $j <= 9; $j++) { 
                                if($n_size >= $final_size){
                                    $n_size = ($n_size - $final_size);
                                     $k++;   
                                }
                            }
                           
                           $r_size = $size;
                           for ($g=1; $g <= $k ; $g++) { 
                               $r_size = ($r_size-$final_size);
                                
                               // create entry for the $product_size on stock 
                               $exist_product = $this->db->query("SELECT * FROM `tblprostock`  where pro_id = '".$product_id."' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and department_id = '2' and stock_type = '1' and status = '1' ")->row();
                               if(!empty($exist_product)){
                                    $p_qty = ($exist_product->qty +1);
                                    $this->home_model->update('tblprostock', array('qty'=>$p_qty),array('id'=>$exist_product->id));
                               }else{
                                    $ad_data_1 = array(
                                        'service_type' => $service_type,
                                        'warehouse_id' => $warehouse_id,    
                                        'department_id' => 2,    
                                        'pro_id' => $product_id,    
                                        'is_pro' => 1,    
                                        'qty' => 1,    
                                        'stock_type' => 1,    
                                        'status' => 1,      
                                        'staff_id' => 0,      
                                        'created_at' => date('Y-m-d H:i:s'),    
                                        'updated_at' => date('Y-m-d H:i:s'),    
                                    );
                                    $this->home_model->insert('tblprostock', $ad_data_1);
                               }


                               //Adding waste stock
                               $exist_waste = $this->db->query("SELECT * FROM `tblmanufacturestock`  where department_id = '2' and service_type = '".$service_type."' and warehouse_id = '".$warehouse_id."' and size = '".$waste."' and waste = '1' and status = '1' ")->row();
                               if(!empty($exist_waste)){
                                    $w_qty = ($exist_waste->qty + 1);
                                    $this->home_model->update('tblmanufacturestock', array('qty'=>$w_qty),array('id'=>$exist_waste->id));
                               }else{
                                    $ad_data_2 = array(
                                        'parent_id' => 0,
                                        'service_type' => $service_type,
                                        'warehouse_id' => $warehouse_id,
                                        'department_id' => 2, 
                                        'm_id' => 0,
                                        'product_id' => 0,
                                        'bundle_no' => 0,
                                        'size' => $waste,   
                                        'qty' => 1,    
                                        'weight_per_psc' => 0,    
                                        'bundle_weight' => 0,  
                                        'waste' => 1, 
                                        'status' => 1
                                    );
                                    $this->home_model->insert('tblmanufacturestock', $ad_data_2);
                               }

                           }



                           // r_size will be the remaining mm which will make new product                   
                            $main_id = $bundle_id;
                            $parent_id = value_by_id('tblmanufacturestock',$bundle_id,'parent_id');
                            if($parent_id > 0){
                               $main_id = $parent_id; 
                            }

                            $exist_r_product = $this->db->query("SELECT * FROM `tblmanufacturestock`  where service_type = '".$service_type."' and warehouse_id = '".$warehouse_id."' and  department_id = '2' and  parent_id = '".$main_id."' and size = '".$r_size."' and product_id = '".$item_id."' and waste = '0' and status = '1' and transferable = '1' ")->row();
                            if(!empty($exist_r_product)){
                                $r_qty = ($exist_r_product->qty + 1);
                                $this->home_model->update('tblmanufacturestock', array('qty'=>$r_qty),array('id'=>$exist_r_product->id));
                            }else{
                                $ad_data_3 = array(
                                    'parent_id' => $main_id,
                                    'service_type' => $service_type,
                                    'warehouse_id' => $warehouse_id,
                                    'm_id' => 0,
                                    'department_id' => 2,
                                    'product_id' => $item_id,
                                    'bundle_no' => 0,
                                    'size' => $r_size,   
                                    'qty' => 1,    
                                    'weight_per_psc' => 0,    
                                    'bundle_weight' => 0,  
                                    'waste' => 0, 
                                    'transferable' => 1,
                                    'status' => 1
                                );
                                $this->home_model->insert('tblmanufacturestock', $ad_data_3);
                            }
                           
                        }
						
						//Log for used bundle quantity
                        $bundle_info = $this->db->query("SELECT * FROM `tblmanufacturestock`  where id = '".$bundle_id."' ")->row();
						$ad_data_4 = array(
							'c_id' => $c_id,
                            'ms_id' => $bundle_id,
                            'product_id' => $bundle_info->product_id,
                            'bundle_no' => $bundle_info->bundle_no,
                            'size' => $bundle_info->size,
                            'qty' => $req_qty,
							'status' => 1
						);
						$this->home_model->insert('tblcuttingprocesslog', $ad_data_4);

                    }


                    set_alert('success', 'Cutting pipe succesfully');
                    redirect(admin_url('manufacture_process'));

                } 
            }else{
                set_alert('error', 'Pipe is not selected!');
                redirect(admin_url('manufacture_process/cutting_process'));
            }
            

        }

        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();
        $data['request_info'] = $this->db->query("SELECT * FROM `tblrequestcutting` where approve_status = 2 and confirmation_status = 2 and cutting_process = 1")->result_array();

        $data['title'] = 'Cutting Process';
        $this->load->view('admin/manufacture_process/cutting_process', $data);

    }

    public function get_cutting_details()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $log_info  = $this->db->query("SELECT * from tblcuttingprocesslog where c_id = '".$id."' ")->result();
            $process_info  = $this->db->query("SELECT * from tblcuttingprocess where id = '".$id."' ")->row();
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
               <h4 class="no-margin font-medium-xs bold">Cutting Detail</h4>
            </div>
            <p class="text-muted lead-field-heading no-mtop">Cutting ID</p>
            <p class="bold font-medium-xs lead-name"><?php echo 'CP-'.str_pad($id, 4, "0", STR_PAD_LEFT);?></p>
            <p class="text-muted lead-field-heading no-mtop">Product Quantity</p>
            <p class="bold font-medium-xs lead-name"><?php echo $process_info->product_qty; ?></p>
            <p class="text-muted lead-field-heading">Product Size</p>
            <p class="bold font-medium-xs"><?php echo $process_info->product_size; ?></p>
            <p class="text-muted lead-field-heading">Waste per quantity</p>
            <p class="bold font-medium-xs"><?php echo $process_info->waste; ?></p>

         </div>
         <div class="col-md-4 col-xs-12 lead-information-col">
            <div class="lead-info-heading">
               <h4 class="no-margin font-medium-xs bold">Cutting Information</h4>
            </div>
            <p class="text-muted lead-field-heading no-mtop">Date</p>
            <p class="bold font-medium-xs lead-name"><?php echo _d($process_info->date_time); ?></p>
            <p class="text-muted lead-field-heading">Remark</p>
            <p class="bold font-medium-xs"><?php echo cc($process_info->remarks); ?></p>
            <p class="text-muted lead-field-heading">Added By</p>
            <p class="bold font-medium-xs"><?php echo get_employee_name($process_info->added_by); ?></p>

         </div>
         
      </div>
        <hr>
        <br>
        <div class="col-md-12">                
        <h4 class="text-center"><u>Cutting Bundle Information</u></h4>
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Item Name</th>
                        <th>Bundle No.</th>
                        <th>Size</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(!empty($log_info)){
                        $z=1;
                        foreach($log_info as $row){
                           
                            ?>
                                                                        
                            <tr>
                                <td><?php echo $z++;?></td>
                                <td><?php echo value_by_id('tblproducts',$row->product_id,'sub_name'); ?></td>  
                                <td><?php echo $row->bundle_no; ?></td>                       
                                <td><?php echo $row->size; ?></td>                       
                                <td><?php echo $row->qty; ?></td>                   
                                                 
                             </tr>   
                                
                            <?php
                        }
                    }else{
                        echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found</h5></td></tr>';
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


    public function get_bundels_table() {
        extract($this->input->post());
        
        $bundle_info = array();
        if(empty($waste)){
            $waste = 0;
        }
        $final_size = ($size+$waste);

        $master_id = value_by_id('tblproducts',$product_id,'master_id');


        $open_bundle_info = $this->db->query("SELECT * FROM `tblmanufacturestock` WHERE department_id = 1 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and `size` > '".$final_size."' and open_bundle = 1 and qty > 0 order by size desc")->result();
        $close_bundle_info = $this->db->query("SELECT * FROM `tblmanufacturestock` WHERE department_id = 1 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and `size` > '".$final_size."' and open_bundle = 0 and qty > 0 order by size desc")->result();

        if(!empty($open_bundle_info)){
            foreach ($open_bundle_info as $r1) {
                
                $main_id = $r1->id;
                if($r1->parent_id > 0){
                   $main_id = $r1->parent_id; 
                }
                $bundle_no = value_by_id('tblmanufacturestock',$main_id,'bundle_no');

                $master_id_1 = value_by_id('tblproducts',$r1->product_id,'master_id');

                if($master_id == $master_id_1){
                    $bundle_info[] = array(
                            'id' => $r1->id,
                            'product_id' => $r1->product_id,
                            'bundle_no' => $bundle_no,
                            'qty' => $r1->qty,
                            'size' => $r1->size
                    );
                }
                
            }
        }

        if(!empty($close_bundle_info)){
            foreach ($close_bundle_info as $r2) {

                $main_id = $r2->id;
                if($r2->parent_id > 0){
                   $main_id = $r2->parent_id; 
                }
                $bundle_no = value_by_id('tblmanufacturestock',$main_id,'bundle_no');

                $master_id_2 = value_by_id('tblproducts',$r2->product_id,'master_id');

                if($master_id == $master_id_2){
                    $bundle_info[] = array(
                            'id' => $r2->id,
                            'product_id' => $r2->product_id,
                            'bundle_no' => $bundle_no,
                            'qty' => $r2->qty,
                            'size' => $r2->size
                    );
                }
                
            }
        }
            
        /*echo '<pre/>';
        print_r($bundle_info);
        die;*/
        ?>
         <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                 
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Cutting Bundle List </h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <td style="width:10%">S.No</td>
                                                <td style="width:35%">Item Name</td>
                                                <td style="width:10%">Bundle No.</td>
                                                <td style="width:10%">Size</td>
                                                <td style="width:10%">Qty</td>
                                                <td style="width:20%">Required Qty</td>
                                                <td style="width:5%">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($bundle_info)){
                                            $i = 1;
                                            foreach ($bundle_info as $value) {
                                                ?>
                                                <input type="hidden" readonly="" value="<?php echo $value['qty'];?>" name="qty<?php echo $value['id']; ?>" id="qty<?php echo $value['id']; ?>">
                                                <input type="hidden" readonly="" value="<?php echo $value['size'];?>" name="item_size<?php echo $value['id']; ?>" id="item_size<?php echo $value['id']; ?>">
                                                <input type="hidden" readonly="" value="<?php echo $value['product_id'];?>" name="item_id<?php echo $value['id']; ?>" id="item_size<?php echo $value['id']; ?>">
                                                <tr>                                                      
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo value_by_id('tblproducts',$value['product_id'],'sub_name');?></td>
                                                    <td><?php echo $value['bundle_no'];?></td>
                                                    <td><?php echo $value['size'];?></td>
                                                    <td><?php echo $value['qty'];?></td>
                                                    <td><input type="number" name="req_qty<?php echo $value['id']; ?>" class="form-control req_qty" id="req_qty<?php echo $value['id']; ?>" val="<?php echo $value['id']; ?>" value=""></td>
                                                        
                                                    <td><input value="<?php echo $value['id']; ?>" class="action" type="checkbox" id="action<?php echo $value['id']; ?>" name="bundles[]"></td>
                                                                                                  
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

                    
                </div>


            </div>
        </div>
        <?php

    }

    public function get_request_details() {
        extract($this->input->post());
        $request_info = $this->db->query("SELECT * FROM `tblrequestcutting` where id = '".$request_id."' ")->row_array();
        $requestitem_info = $this->db->query("SELECT * FROM `tblrequestcuttingitems` where request_id = '".$request_id."' ")->result_array();
        if(!empty($request_id)){
        ?>
        <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">


                    <div class="table-responsive s_table compdv">
                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                            <thead>
                                <tr>
                                    <th width="50%" align="left">Product Name</th>
                                    <th width="5%" align="left">View</th>
                                    <th width="15%" class="qty" align="left">Size (MM)</th>
                                    <th width="15%" class="qty" align="left">Qty (Pcs)</th>
                                    <th width="15%" class="qty" align="left">Waste (MM)</th>
                                </tr>
                            </thead>
                            <tbody class="ui-sortable">
                                <tr class="main" id="tr0">
                                    <input type="hidden" value="<?php echo $request_info['product_id']; ?>" name="product_id">
                                    <td>
                                        <div class="form-group">
                                            <input readonly="" value="<?php echo value_by_id('tblproducts',$request_info['product_id'],'sub_name');?>" class="form-control" >
                                        </div>
                                    </td>

                                    <td id="view0"><a href="../product/product/<?php echo $request_info['product_id'];?>" target="_blank">view</a></td>

                                    <td>
                                        <div class="form-group">
                                            <input id="product_size" readonly="" name="product_size" value="<?php echo $request_info['product_size']; ?>" class="form-control" >
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="form-group">
                                            <input type="number" readonly="" id="product_qty" name="product_qty" value="<?php echo $request_info['product_qty']; ?>" class="form-control" >
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <input type="number" readonly="" id="waste" name="waste" value="<?php echo $request_info['waste']; ?>" class="form-control" >
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>

                    <div class="col-md-12" style="margin-bottom:5%;"></div>
                 
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Cutting Bundle List </h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
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
                                                <input type="hidden" readonly="" value="<?php echo $value['quantity'];?>" name="req_qty<?php echo $value['bundle_id']; ?>">
                                                <input type="hidden" readonly="" value="<?php echo $value['item_size'];?>" name="item_size<?php echo $value['bundle_id']; ?>">
                                                <input type="hidden" readonly="" value="<?php echo $value['item_id'];?>" name="item_id<?php echo $value['bundle_id']; ?>">
                                                <tr>                                                      
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo value_by_id('tblproducts',$value['item_id'],'sub_name');?></td>
                                                    <td><?php echo $b_info->bundle_no;?></td>
                                                    <td><?php echo $value['item_size'];?></td>
                                                    <td><?php echo $value['quantity'];?></td>                                                                                                  
                                                </tr>
                                                <input type="hidden" name="bundles[]" value="<?php echo $value['bundle_id']; ?>">
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
                            <button class="btn btn-info" type="submit">Make Cutting</button>
                        </div>
                </div>


            </div>
        </div>

        <?php
        }
    }

    public function get_servicetype_warehouse() {
        extract($this->input->post());
        $request_info = $this->db->query("SELECT warehouse_id,service_type FROM `tblrequestcutting` where id = '".$request_id."' ")->row();

        $service_name = ($request_info->service_type == 1) ? 'Rent' : 'Sales';
        $warehouse_name = value_by_id('tblwarehouse',$request_info->warehouse_id,'name');

        $data = array(
            'service_type' => $request_info->service_type,
            'warehouse_id' => $request_info->warehouse_id,
            'service_name' => $service_name,
            'warehouse_name' => $warehouse_name,
        );

        echo json_encode($data);

    }



    public function check_bundles_entry() {
        extract($this->input->post());

        if($waste != 0){
            $waste = $waste;
        }else{
            $waste = 0;
        }

        $final_size = ($product_size+$waste);
        $p_qty = $product_qty;

        if(!empty($itemdata)){
            foreach ($itemdata as $key => $value) {
                $size = $value['size'];
                $qty = $value['qty'];

                for($i=1; $i<=$qty; $i++) { 
                    $n_size = $size;
                    for($j=0; $j <= 9; $j++) { 
                        if($n_size >= $final_size){
                             $n_size = ($n_size - $final_size);
                             $p_qty--;
                             
                        }
                    }    

                }

            }
        }
        echo $p_qty; 
    }


    public function manage_final($id = '') {
        check_permission(113,'view');
        $where = "status = 1";
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

                $where .= " and created_date between '".$f_date."' and '".$t_date."'";
            }
        }

        $data['final_info'] = $this->db->query("SELECT * FROM `tblfinalprocess` where ".$where." ")->result();

        $data['warehouse_info'] = $this->db->query("SELECT * FROM `tblwarehouse`  where status = 1 ")->result();

        $data['title'] = $title;
        $this->load->view('admin/manufacture_process/manage_final', $data);

    }

    public function final_process($id = '') {
        check_permission(113,'create');
        if ($this->input->post()) {
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'service_type' => $service_type,
                    'warehouse_id' => $warehouse_id,    
                    'reference_no' => $reference_no,    
                    'product_to_id' => $product_to_id,    
                    'product_from_id' => $product_from_id,    
                    'quantity' => $quantity, 
                    'remarks' => $remarks,      
                    'created_date' => date('Y-m-d'),    
                    'created_at' => date('Y-m-d H:i:s'),    
                    'status' => 1    
                );

                if($this->home_model->insert('tblfinalprocess', $ad_data)){
                   
                    //Less Stock
                    $stock_info = $this->db->query("SELECT * FROM `tblprostock`  where stock_type = '1' and status = '1' and staff_id = '0' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$product_from_id."' and qty >= '".$quantity."' ")->row();
                    $less_qty = ($stock_info->qty-$quantity);
                    $this->home_model->update('tblprostock', array('qty'=>$less_qty,'updated_at'=>date('Y-m-d H:i:s')),array('id'=>$stock_info->id));

                    //Add to stock
                    $exist_info = $this->db->query("SELECT * FROM `tblprostock` WHERE stock_type = '1' and status = '1' and staff_id = '0' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$product_to_id."' ")->row();
                    if(!empty($exist_info)){
                        $n_qty = ($exist_info->qty + $quantity);
                        $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty,'updated_at'=>date('Y-m-d H:i:s')), array('id'=>$exist_info->id)); 
                    }else{
                        $ad_data = array(
                                    'pro_id' => $product_to_id,
                                    'warehouse_id' => $warehouse_id,
                                    'service_type' => $service_type,
                                    'qty' => $quantity,
                                    'is_pro' => '1',
                                    'stock_type' => '1',
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                );
                                
                        $update = $this->home_model->insert('tblprostock', $ad_data); 
                    }

                    if($update == true){
                        set_alert('success', 'Final process perform succesfully');
                        redirect(admin_url('manufacture_process/manage_final'));
                    }
                    
                }


        }

        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' and product_cat_id = '5' ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();

        $data['title'] = 'Final Process';
        $this->load->view('admin/manufacture_process/final_process', $data);

    }


    public function get_from_products() {
        extract($this->input->post());

        $size = value_by_id('tblproducts',$product_id,'size');

        $product_info = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' and size > '0' and size = '".$size."' and id != '".$product_id."' ")->result_array();

        $html = '<option value=""></option>';
        if(!empty($product_info)){
            foreach ($product_info as $key => $value) {
                $html .= '<option value="'.$value['id'].'">'.$value['sub_name'].'</option>'; 
            }
        }

        echo $html;

    }

    public function check_stock() {
        extract($this->input->post());

        $stock_info = $this->db->query("SELECT * FROM `tblprostock`  where stock_type = '1' and status = '1' and staff_id = '0' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$product_id."' and qty >= '".$quantity."' ")->row();

        if(!empty($stock_info)){
            echo '1';
        }else{
            echo '0';
        }

    }

    public function get_final_details()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            $process_info  = $this->db->query("SELECT * from tblfinalprocess where id = '".$id."' ")->row();
            ?>

            <div class="row">

             <div class="col-md-12">  
                

                <div class="lead-view" id="leadViewWrapper">
                 <div class="col-md-4 col-xs-12 lead-information-col">
                    <div class="lead-info-heading">
                       <h4 class="no-margin font-medium-xs bold">Created Product Information </h4>
                    </div>
                    <p class="text-muted lead-field-heading no-mtop">Prodcut Name</p>
                    <p class="bold font-medium-xs lead-name"><?php echo value_by_id('tblproducts',$process_info->product_to_id,'sub_name'); ?></p>
                    <p class="text-muted lead-field-heading">Quantity</p>
                    <p class="bold font-medium-xs"><?php echo $process_info->quantity; ?></p>
                    <p class="text-muted lead-field-heading">Warehouse</p>
                    <p class="bold font-medium-xs"><?php echo value_by_id('tblwarehouse',$process_info->warehouse_id,'name'); ?></p>
                    <p class="text-muted lead-field-heading">Service Type</p>
                    <p class="bold font-medium-xs"><?php echo ($row->service_type == 1) ? 'Rent' : 'Sale'; ?></p>

                 </div>
                <div class="col-md-4 col-xs-12 lead-information-col">
                    <div class="lead-info-heading">
                       <h4 class="no-margin font-medium-xs bold">Product Created By</h4>
                    </div>
                    <p class="text-muted lead-field-heading no-mtop">Product Name</p>
                    <p class="bold font-medium-xs lead-name"><?php echo value_by_id('tblproducts',$process_info->product_from_id,'sub_name'); ?></p>
                    <p class="text-muted lead-field-heading">Quantity</p>
                    <p class="bold font-medium-xs"><?php echo $process_info->quantity; ?></p>
                    

                 </div>
                 <div class="col-md-4 col-xs-12 lead-information-col">
                    <div class="lead-info-heading">
                       <h4 class="no-margin font-medium-xs bold">Process Information</h4>
                    </div>
                    <p class="text-muted lead-field-heading no-mtop">Date</p>
                    <p class="bold font-medium-xs lead-name"><?php echo _d($process_info->created_at); ?></p>
                    <p class="text-muted lead-field-heading">Remark</p>
                    <p class="bold font-medium-xs"><?php echo $process_info->remarks; ?></p>
                    <p class="text-muted lead-field-heading">Added By</p>
                    <p class="bold font-medium-xs"><?php echo get_employee_name($process_info->added_by); ?></p>

                 </div>
                 
              </div>
        <hr>
        <br>
             
            </div>
            </div>
            <?php
        }
    }
    
}