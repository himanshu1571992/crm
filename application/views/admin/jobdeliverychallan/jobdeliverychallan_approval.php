<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}

@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
}        
</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4><?php echo $title; ?></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">

                            <?php
                            $vendor_name = value_by_id('tblvendor',$info->vendor_id,'name');

                            ?>
                                <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $info->vendor_id; ?>">
                                <input type="hidden" name="site_id" id="site_id" value="<?php echo $info->site_id; ?>">
                                <div class="form-group" app-field-wrapper="">
                                    <label class="control-label">Vendor Name</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo  $vendor_name; ?>">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>
                                        <address>
                                            <span class="billing_name"><?php echo  cc($vendor_name); ?></span><br>
                                            <span class="billing_street">--</span><br>
                                            <span class="billing_city">--</span>,
                                            <span class="billing_state">--</span>
                                            <br/>
                                            <span class="billing_country">--</span>,
                                            <span class="billing_zip">--</span>
                                        </address>
                                    </div>
                                  
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" app-field-wrapper="">
                                            <label class="control-label"> Material sending for </label>
                                            <?php $material_sending_for = (!empty($info)) ? $info->material_sending_for : ""; ?>
                                            <input type="text" readonly="" class="form-control" value="<?php echo  $material_sending_for; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" app-field-wrapper="">
                                            <label class="control-label">  Transporter Name  </label>
                                            <?php $transporter_name = (!empty($info)) ? $info->transporter_name : ""; ?>
                                            <input type="text" readonly="" class="form-control" value="<?php echo  $transporter_name; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label">Challan No.</label>
                                                <input type="text" readonly="" class="form-control" value="<?php echo 'JDC-' . str_pad($info->id, 4, '0', STR_PAD_LEFT); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $value = (isset($info) ? _d($info->date) : _d(date('Y-m-d'))); ?>
                                           <div class="form-group" app-field-wrapper="date"><label for="date" class="control-label"> <small class="req text-danger">* </small>Date</label>
                                            <div class="input-group date">
                                                <input type="text" id="date" name="date" disabled="" class="form-control datepicker" value="<?php echo $value; ?>">
                                                <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label">Service Type</label>
                                                <?php $service_type = (!empty($info)) ? ($info->service_type == 1) ? 'Rent' : 'Sale' : ""; ?>
                                                <input type="text" readonly="" class="form-control" value="<?php echo  $service_type; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label"> Vehicle No </label>
                                                <?php $vehicle_no = (!empty($info)) ? $info->vehicle_no : ""; ?>
                                                <input type="text" readonly="" class="form-control" value="<?php echo  $vehicle_no; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label">Store Type</label>
                                                <?php $store_type = (!empty($info)) ? ($info->store_type == 1) ? 'Main Store' : 'Shop Floor' : ""; ?>
                                                <input type="text" readonly="" class="form-control" value="<?php echo  $store_type; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label"> Warehouse </label>
                                                <?php $warehouse_name = (!empty($info)) ? value_by_id('tblwarehouse', $info->warehouse_id, 'name') : ""; ?>
                                                <input type="text" readonly="" class="form-control" value="<?php echo  $warehouse_name; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php $value = (isset($info) ? $info->adminnote : ''); ?>
                                    <div class="form-group" app-field-wrapper="adminnote">
                                        <label for="adminnote" class="control-label">Note</label>
                                        <textarea id="adminnote" name="adminnote" style="height: 83px; width: 100%;" class="form-control" disabled="" rows="4"><?php echo $value; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label">  Driver Name  </label>
                                                <?php $driver_name = (!empty($info)) ? $info->driver_name : ""; ?>
                                                <input type="text" readonly="" class="form-control" value="<?php echo  $driver_name; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label">   Driver No   </label>
                                                <?php $driver_no = (!empty($info)) ? $info->driver_no : ""; ?>
                                                <input type="text" readonly="" class="form-control" value="<?php echo  $driver_no; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                           
                            
                        </div>

                        <?php 
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" style="background-color: #f9d306;color:#fff;" class="btn">
                                    On Hold
                                </button>
                                <button type="submit" name="submit" value="4" style="background-color: #9d0b1a;color:#fff;" class="btn">
                                    Reconciliation
                                </button>
                                <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>
                                <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approve
                                </button>
                            </div> 
                           <?php 
                        }
                        ?>
                          
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Delivery Products</h4>
                            </div>

                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" >
                                        <div class="col-md-12">
                                            <div >
                                                <div class="form-group" id="docAttachDivVideo" >
                                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                        <thead>
                                                            <tr>
                                                                <td style="width: 80px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                                <td style="width: 20px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                                <td style="width: 20px !important;">Unit</td>
                                                                <td style="width: 70px !important;">Remark</td>
                                                                <td style="width: 16px  !important;">Available Qty</td>
                                                                <td style="width: 16px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $i = 1;
                                                            $totsaleprod = 0;

                                                            if (isset($product_info)) {

                                                                $totsaleprod = count($product_info);
                                                                ?>

                                                            <input type="hidden" id="totalsalepro" value="<?php echo count($product_info); ?>">

                                                                <?php
                                                                foreach ($product_info as $single_prod_sale_det) {
                                                                    ?>

                                                                <tr class="trsalepro<?php echo $i; ?>">

                                                                    <td>
                                                                        <?php
                                                                            $url = admin_url("product_new/view/");
                                                                            $unit_id = ($single_prod_sale_det['unit_id'] > 0) ? $single_prod_sale_det['unit_id'] : value_by_id_empty('tblproducts', $single_prod_sale_det['product_id'], 'unit_2');
                                                                        ?>
                                                                        <a target="_blank" href="<?php echo $url . $single_prod_sale_det['product_id']; ?>">

                                                                            <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['product_name']; ?>">

                                                                        </a>

                                                                        <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                                        <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">

                                                                    </td>

                                                                    <td>

                                                                        <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $single_prod_sale_det['pro_id']; ?>">

                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="salepro_unit1_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][unit_id]">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (isset($unit_list) && count($unit_list) > 0) {
                                                                                foreach ($unit_list as $uvalue) {
                                                                                    $selected = ($unit_id == $uvalue->id) ? "selected" : "";
                                                                                    echo '<option value="' . $uvalue->id . '" ' . $selected . '>' . $uvalue->name . '</option>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>

                                                                    <td>

                                                                        <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_sale_det['remark']; ?>">

                                                                    </td>

                                                                    <td>
                                                                        <?php
                                                                        // $where = "pro_id = '" . $single_prod_sale_det['product_id'] . "' and service_type = '" . $info->service_type . "' and stock_type = 1 and status = 1 and staff_id = 0";
                                                                        // $getprostock = $this->db->query("SELECT `id`,`qty` FROM tblprostock WHERE " . $where . " ORDER BY id DESC")->row();
                                                                            $ttl_qty = 0;
                                                                            if ($info->store_type == 1){
                                                                                $ttl_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE `pro_id` = '".$single_prod_sale_det['product_id']."' and qty > 0 and warehouse_id = '".$info->warehouse_id."' and service_type = 2 and material_status = 1 and main_store = 1 and shop_floor_store = 0 and finish_goods_store = 0")->row()->ttl_qty;
                                                                            }else{
                                                                                $ttl_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE `pro_id` = '".$single_prod_sale_det['product_id']."' and qty > 0 and warehouse_id = '".$info->warehouse_id."' and service_type = 2 and material_status = 1 and shop_floor_store = 1 and finish_goods_store = 0")->row()->ttl_qty;
                                                                            }
                                                                        ?>
                                                                        <input type="number" class="form-control availableqty" data-rid="<?php echo $i; ?>" id="saleavailableqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][availableqty]" min="1" value="<?php echo $ttl_qty; ?>" readonly="">

                                                                    </td>
                                                                    <td>

                                                                        <input type="number" class="form-control qty" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">

                                                                    </td>
                                                                </tr>

                                                                <?php
                                                                $i++;
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

                    </div>


                </div>
            </div>   	
           

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                            </div>

                            <hr/>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; } ?></textarea>
                                    </div>
                                    </div>
                                </div>
                                </div>
                           
                        </div>

                    </div>


                </div>
            </div>  
<?php
$assign_info = $this->db->query("SELECT * from tblmasterapproval  where module_id = '32' and table_id = '".$info->id."'  ")->result();
?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                                <h5 style="color: red;">Minimum <?php echo (count($assign_info) > 1 ) ? 2 : 1; ?> Approval is Required</h5>
                                
                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Status</td>
                                                <td>Read At</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                    }elseif($value->approve_status == 4){
                                                        $status = 'Reconciliation';
                                                        $color = 'brown';
                                                    }elseif($value->approve_status == 5){
                                                        $status = 'On Hold';
                                                        $color = '#e8bb0b;';
                                                    }
                                                ?>
                                                <tr>                                                      
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>   
                                                    <td><?php if(!empty($value->readdate)){ echo _d($value->readdate); }else{ echo 'Not Yet'; }   ?></td>                                                       
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
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
           

            

            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">	
    $( document ).ready(function() { 
        
            var vendor_id = $('#vendor_id').val();

            if(vendor_id > 0){
                var url = '<?php echo base_url(); ?>admin/Purchase/getvendordtails';
                $.post(url,
                        {
                            vendor_id: vendor_id,
                        },
                        function (data, status) {
                            var res = JSON.parse(data);
                            if(res != ''){
                                $('.billing_street').html(res.address);
                                $('#billing_street').val(res.address);
                                $('.billing_state').html(res.state_name);
                                $('#billing_state').val(res.state_name);
                                $('.billing_city').html(res.city_name);
                                $('#billing_city').val(res.city_name);
                                $('.billing_zip').html(res.pincode);
                                $('#billing_zip').val(res.pincode);
                                $('.billing_country').html('India');
                                $('#billing_country').val('India');
                            }                        

                        });
            }
        

	});

</script>
</body>
</html>
