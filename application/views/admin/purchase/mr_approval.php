<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
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
                        <div class="row">
                            <div class="col-md-6">
                            <?php
                                $vendor_name = value_by_id('tblvendor',$mr_info->vendor_id,'name');
                                if(!empty($purchaseorder_info)){
                                $warehouse_name = value_by_id('tblwarehouse',$purchaseorder_info->warehouse_id,'name'); 
                                }

                                if(!empty($purchaseorder_info)){
                                    echo '<input type="hidden" id="po_number" value="'.$purchaseorder_info->id.'">';
                                }
                            ?>
                                <div class="form-group" app-field-wrapper="">
                                    <label class="control-label">Vendor Name</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo  $vendor_name; ?>">
                                </div>

                                <?php
                                if(!empty($warehouse_name)){
                                ?>
                                <div class="form-group" app-field-wrapper="">
                                    <label class="control-label">Warehouse Name</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo  $warehouse_name; ?>">
                                </div>
                                <?php    
                                }
                                ?>
                                
                                <?php
                                if($mr_info->mr_for == 1){
                                ?>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>
                                        <address>
                                            <span class="billing_name">--</span><br>
                                            <span class="billing_street">--</span><br>
                                            <span class="billing_city">--</span>,
                                            <span class="billing_state">--</span>
                                            <br/>
                                            <span class="billing_country">--</span>,
                                            <span class="billing_zip">--</span>
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="bold"><?php echo _l('ship_to'); ?></p>
                                        <address>
                                            <span class="shipping_name">--</span><br>
                                            <span class="shipping_street">--</span><br>
                                            <span class="shipping_city">--</span>,
                                            <span class="shipping_state">--</span>
                                            <br/>
                                            <span class="shipping_country">--</span>,
                                            <span class="shipping_zip">--</span>
                                        </address>
                                    </div>
                                </div>
                                <?php    
                                }
                                ?>
                                
                                 <div class="form-group" app-field-wrapper="">
                                    <label class="control-label">Challan No.</label>
                                    <input type="text" readonly="" class="form-control" value="<?php echo  $mr_info->challan_no; ?>">
                                </div>
                               
                                <?php 
                                if($mr_info->mr_for != 1){
                                $value = (isset($mr_info) ? $mr_info->adminnote : ''); ?>
                                <div class="form-group" app-field-wrapper="adminnote">
                                    <label for="adminnote" class="control-label">Note</label>
                                    <textarea id="adminnote" name="adminnote" style="height: 83px; width: 100%;" class="form-control" disabled="" rows="4"><?php echo $value; ?></textarea>
                                </div>
                                <?php
                                }
                                ?>
                               


                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">
                                    <?php
                                    if($mr_info->mr_for == 1){
                                        $type = 'Against PO';
                                    }elseif($mr_info->mr_for == 2){
                                        $type = 'Cash';
                                    }elseif($mr_info->mr_for == 3){
                                        $type = 'GAS';
                                    } elseif ($mr_info->mr_for == 4) {
                                        $type = 'Delivery Challan';
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="control-label">MR Type</label>
                                                <input type="text" readonly="" class="form-control" value="<?php echo  $type; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $number = (isset($mr_info->numer) && !empty($mr_info->numer)) ? $mr_info->numer : 'MR-'.$mr_info->id; ?>
                                            <div class="form-group" app-field-wrapper="number">
                                                <label for="number" class="control-label">MR Number #</label>
                                                <input type="text" id="number" name="number" class="form-control" disabled="" value="<?php echo $number; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $value = (isset($mr_info) ? $mr_info->reference_no : ''); ?>
                                            <div class="form-group" app-field-wrapper="reference_no">
                                                <label for="reference_no" class="control-label">Reference #</label>
                                                <input type="text" id="reference_no" name="reference_no" class="form-control" disabled="" value="<?php echo $value; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $value = (isset($mr_info) ? _d($mr_info->date) : _d(date('Y-m-d'))); ?>
                                           <div class="form-group" app-field-wrapper="date"><label for="date" class="control-label"> <small class="req text-danger">* </small>Purchase Order Date</label>
                                            <div class="input-group date">
                                                <input type="text" id="date" name="date" disabled="" class="form-control datepicker" value="<?php echo $value; ?>">
                                                <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if($mr_info->mr_for == 1){
                                    $value = (isset($mr_info) ? $mr_info->adminnote : ''); ?>
                                    <div class="form-group" app-field-wrapper="adminnote">
                                        <label for="adminnote" class="control-label">Note</label>
                                        <textarea id="adminnote" name="adminnote" style="height: 83px; width: 595px;" class="form-control" disabled="" rows="4"><?php echo $value; ?></textarea>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <div class="form-group">
                                       <h5>Attachment File</h5>
                                        <?php
                                        if(!empty($file_info)){
                                            $j = 1;
                                            foreach ($file_info as $key => $value) {
                                                $extension = pathinfo($value->file, PATHINFO_EXTENSION);
                                                if (in_array(strtolower($extension), ["jpg", "png"])){
                                                    ?>
                                                    <a class="img-thumbnail" href="<?php echo base_url('uploads/material_receipt') . "/" . $value->file; ?>" target="_blank"><img src="<?php echo base_url('uploads/material_receipt') ."/". $value->file; ?>" title="<?php echo $value->file; ?>" width="50px" height="50px" ></a>
                                                <?php
                                                }else{
                                                ?>
                                                    <a href="<?php echo base_url('uploads/material_receipt') . "/" . $value->file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                <?php
                                                
                                            $j++;
                                                }
                                            }
                                        }else{
                                            echo '<span style="color:red;">Attachment not found!</span>';
                                        }
                                        ?>
                                        
                                    </div>
                                     <?php 
                                    if($mr_info->extrusion == 1){
                                        echo '<span><b>MR for Extrusion</b></span>';
                                    } 
                                    ?>
                                    
                                </div>
                            </div>
                           
                            
                        </div>

                        <?php 
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                            
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" style="background-color: #f9d306;color:#fff;" class="btn">On Hold</button>
                                <?php if ($mr_info->mr_for != 4){ ?>
                                    <button type="submit" name="submit" value="4" style="background-color: #9d0b1a;color:#fff;" class="btn">Reconciliation</button>
                                <?php } ?>
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
                                <h4 class="no-mtop mrg3">Material Receipt Products</h4>
                            </div>

                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" >
                                        <?php
                                        if($mr_info->mr_for == 1 || $mr_info->mr_for == 2){
                                        ?>
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                   <td>S.No</td>
                                                    <td>Pro Name</td>
                                                    <td>Pro ID</td>
                                                    <td>Unit as per PO</td>
                                                    <td>Qty Received as per PO <br><small>(Including Reject Qty)</small></td>
                                                    <td>Qty Received in Nos</td>
                                                    <td>Reject Qty</td>
                                                    <td>Rejection Remark</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(!empty($product_info)){
                                                $i = 1;
                                                foreach ($product_info as $key => $value) {

                                                    $product_name = value_by_id('tblproducts',$value->product_id,'sub_name');
                                                    $hsn_code = value_by_id('tblproducts',$value->product_id,'hsn_code');

                                                    $ttl_amount = ($value->qty * $value->price);
                                                    $tax_amount = ($ttl_amount*$value->prodtax/100);

                                                    if($mr_info->tax_type == 1){
                                                        $tax_amount = 0;
                                                    }
                                                    ?>
                                                     <tr>                                                      
                                                        <td><?php echo $i++;?></td>
                                                        <td><a target="_blank" href="<?php echo admin_url('product_new/view/'.$value->product_id);?>"><?php echo $product_name;?></a></td>
                                                        <td><?php echo 'PRO-ID'.$value->product_id;?></td>                                                       
                                                        <td><?php echo ($value->unit_id > 0) ? value_by_id("tblunitmaster", $value->unit_id, "name") : '--'; ?></td>                                                           
                                                        <td><?php echo $value->qty;?></td>
                                                        <td><?php echo $value->qty_in_nos;?></td>                                                       
                                                        <td><?php echo $value->reject_qty;?></td> 
                                                        <td><?php echo (!empty($value->remark)) ? $value->remark : '--';?></td>                                                           
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>  
                                                
                                            </tbody>
                                        </table>
                                        <?php
                                        }elseif($mr_info->mr_for == 3){
                                        ?>
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td>Pro Name</td>
                                                    <td >Hns Code</td>
                                                    <td >Receive Qty</td>
                                                    <td >Deliver Qty</td>
                                                    <td >Remark</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(!empty($product_info)){
                                                $i = 1;
                                                foreach ($product_info as $key => $value) {

                                                    $product_name = value_by_id('tblproducts',$value->product_id,'sub_name');
                                                    $hsn_code = value_by_id('tblproducts',$value->product_id,'hsn_code');

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $product_name;?></td>
                                                        <td><?php echo $hsn_code;?></td>
                                                        <td><?php echo $value->qty;?></td>  
                                                        <td><?php echo $value->deliver_qty;?></td>  
                                                        <td><?php echo $value->remark;?></td>                                                        
                                                                                                              
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>  
                                                
                                            </tbody>
                                        </table>
                                        <?php
                                        }elseif($mr_info->mr_for == 4){
                                        ?>
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td>Pro Name</td>
                                                    <td>Pro ID</td>
                                                    <td>Unit</td>
                                                    <td>Remark</td>
                                                    <td>Qty</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($product_info)) {
                                                    $i = 1;
                                                    foreach ($product_info as $key => $value) {
                                                        
                                                        $product_name = value_by_id('tblproducts', $value->product_id, 'name');
                                                        
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $product_name; ?></td>
                                                            <td><?php echo "PRO-".$value->product_id; ?></td>
                                                            <td><?php echo value_by_id("tblunitmaster", $value->unit_id, "name"); ?></td>
                                                            <td><?php echo $value->remark; ?></td>                                                        
                                                            <td><?php echo $value->qty; ?></td>  

                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>  

                                            </tbody>
                                        </table>
                                        <?php } ?>
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
                               
                                     <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row">
                                    <div class="col-md-12 pull-right">
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
$assign_info = $this->db->query("SELECT * from tblmasterapproval  where module_id = '4' and table_id = '".$mr_info->id."'  ")->result();
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
                                                    }elseif ($value->approve_status == 4) {
                                                        $status = 'Reconciliation';
                                                        $color = 'brown';
                                                    }elseif ($value->approve_status == 5) {
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
		var po_id = $("#po_number").val();
		if(po_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getbillandshipping';
                $.post(url,
                {
                    po_id: po_id,
                },
               function (data, status) {


                        var res = JSON.parse(data);
                        if(res != ''){
                            $('.billing_name').html(res.billing_name);
                            $('.billing_street').html(res.billing_street);
                            $('.billing_state').html(res.billing_state);
                            $('.billing_city').html(res.billing_city);
                            $('.billing_zip').html(res.billing_zip);
                            $('.billing_country').html('India');

                            $('.shipping_name').html(res.shipping_name);
                            $('.shipping_street').html(res.shipping_street);
		                    $('.shipping_state').html(res.shipping_state);
		                    $('.shipping_city').html(res.shipping_city);
		                    $('.shipping_zip').html(res.shipping_zip);
		                    $('.shipping_country').html('India');
                        }
                        
                    });
        }

	});



</script>
</body>
</html>
