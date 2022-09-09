<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;} 
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        /*width:inherit;*/ /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }</style>

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

            <form action="<?php echo admin_url('stock_consumption/stock_approval') ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                                <div class="col-md-4">
                                    <label for="type" class="control-label">Stock Type</label>
                                    <select class="form-control selectpicker" disabled="" data-live-search="true" id="stock_type" name="stock_type">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($stock_info) && !empty($stock_info)) ? ($stock_info->type == 1) ? "selected": "" : ""; ?>>Production</option>
                                        <option value="2" <?php echo (isset($stock_info) && !empty($stock_info)) ? ($stock_info->type == 2) ? "selected": "" : ""; ?>>Outsource</option>
                                    </select> 
                                </div>
                                <?php if(isset($stock_info) && $stock_info->vendor_id > 0) { ?>
                                <div class="col-md-4 vender_list">  
                                    <div class="form-group">
                                        <label for="vender" class="control-label">Vendor</label>
                                        <select class="form-control selectpicker" disabled="" data-live-search="true" id="vendor_id" name="vendor_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($vendor_list) && count($vendor_list) > 0) {
                                                foreach ($vendor_list as $vendor) {
                                                    $selected = ($stock_info->vendor_id == $vendor->id) ? "selected": ""; ?>
                                                    ?>
                                                    <option value="<?php echo $vendor->id; ?>" <?php echo $selected; ?>><?php echo $vendor->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="service_type" class="control-label">Service Type</label>
                                        <select class="form-control selectpicker" disabled="" data-live-search="true" id="service_type" name="service_type">   
                                            <option value=""></option>                                    
                                            <option value="1" <?php echo (isset($stock_info) && !empty($stock_info)) ? ($stock_info->service_type == 1) ? "selected": "" : ""; ?>>Rent</option>
                                            <option value="2" <?php echo (isset($stock_info) && !empty($stock_info)) ? ($stock_info->service_type == 2) ? "selected": "" : ""; ?>>Sale</option>                                       
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label for="warehouse_id" class="control-label">Warehouse</label>
                                        <select class="form-control selectpicker" disabled="" data-live-search="true" id="warehouse_id" name="warehouse_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                foreach ($all_warehouse as $all_warehouse_value) {
                                                    $selected = ($stock_info->warehouse_id == $all_warehouse_value->id) ? "selected": ""; ?>
                                                    ?>
                                                    <option value="<?php echo $all_warehouse_value->id; ?>" <?php echo $selected; ?>><?php echo $all_warehouse_value->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <?php
                                if (!empty($action)) {
                                    ?>
                                    <div class="form-group col-md-4">
                                        <label class="control-label"> Approve Remark </label>                                    
                                        <textarea required="" id="approvereason" rows="5" name="approvereason" class="form-control"></textarea>                      
                                    </div>    
                                <?php }else{ ?>
                                    <div class="col-md-4">
                                        <label for="remark" class="control-label"> Remarks</label>
                                        <textarea id="remark" class="form-control" rows="5" readonly="" name="remark"><?php echo (!empty($stock_info->remark)) ? $stock_info->remark : ""; ?></textarea>
                                    </div>
                               <?php } ?>
                            </div>
                            <br/>
                            <br/>
                            
                            <div class="col-md-12">
                                <div>
                                    <h3>Product To Create</h3>
                                    <hr>
                                    <div class="form-group">
                                        <?php $i = 0; ?>
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td style="width:5%"><i class="fa fa-cog"></i></td>
                                                    <td style="width:20%">Product Name</td>
                                                    <td style="width:10%">Pro ID</td>
                                                    <td style="width:10%">Available Qty</td>
                                                    <td style="width:10%">Quantity</td>
                                                    <td style="width:30%">Remark</td>
                                                </tr>
                                            </thead>
                                            <tbody class="product_div">
                                                <?php
                                                    if (!empty($stock_details)){
                                                        foreach ($stock_details as $details) {
                                                            if ($details->type == 1){
                                                ?>
                                                    <tr>                                                      
                                                        <td><?php echo ++$i; ?></td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control selectpicker product_create" disabled=""onchange="getproductinfo(<?php echo $i; ?>)" required="" data-live-search="true" id="product_id_<?php echo $i; ?>" name="products[<?php echo $i; ?>][product_id]">
                                                                    <option value=""></option>
                                                                    <?php
                                                                    if (isset($product_info) && count($product_info) > 0) {
                                                                        foreach ($product_info as $value) {
                                                                                $selected = ($details->product_id == $value->id) ? "selected": "";
                                                                            ?>
                                                                            <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>><?php echo $value->sub_name ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                        </td>                                                  
                                                        <td><input type="text" id="pro_pid_<?php echo $i; ?>" readonly="" name="products[<?php echo $i; ?>][pro_id]" class="form-control" value="<?php echo (!empty($details->pro_id)) ? $details->pro_id : "--"?>"></td>
                                                        <td><input type="text" id="available_pqty_<?php echo $i; ?>" readonly="" name="products[<?php echo $i; ?>][available_qty]" class="form-control" value="<?php echo (!empty($details->available_qty)) ? $details->available_qty : "0"?>"></td>
                                                        <td><input type="number" id="pqty_<?php echo $i; ?>" readonly="" name="products[<?php echo $i; ?>][qty]" min="1" class="form-control" value="<?php echo (!empty($details->qty)) ? $details->qty : "0"?>"></td>
                                                        <td><textarea id="premark_<?php echo $i; ?>" readonly=""class="form-control" rows="2" name="products[<?php echo $i; ?>][remark]"><?php echo (!empty($details->remark)) ? $details->remark : ""?></textarea></td>                                                                                                  
                                                    </tr>
                                                <?php 
                                                            }
                                                       }
                                                    } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <br>
                            <div>
                                
                                <div class="col-md-12">
                                    <div>
                                        <h3>Product To Consume</h3>
                                        <?php $j = 0; ?>
                                        <div class="form-group">
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <td style="width:5%"><i class="fa fa-cog"></i></td>
                                                        <td style="width:20%">Product Name</td>
                                                        <td style="width:10%">Pro ID</td>
                                                        <td style="width:10%">Available Qty</td>
                                                        <td style="width:10%">Quantity</td>
                                                        <td style="width:30%">Remark</td>
                                                    </tr>
                                                </thead>
                                                <tbody class="consume_div">
                                                     <?php
                                                        if (!empty($stock_details)){
                                                            foreach ($stock_details as $details) {
                                                                if ($details->type == 2){
                                                    ?>
                                                        <tr>                                                      
                                                            <td><?php echo ++$j; ?></td>
                                                            <td>
                                                                <select class="form-control selectpicker product_counsume" disabled="" onchange="getproductconsumeinfo(<?php echo $j; ?>)"  data-live-search="true" id="product_counsume_id_<?php echo $j; ?>" name="products_consume[<?php echo $j; ?>][product_id]">
                                                                    <option value=""></option>
                                                                    <?php
                                                                    if (isset($product_info) && count($product_info) > 0) {
                                                                        foreach ($product_info as $value) {
                                                                            $selected = ($details->product_id == $value->id) ? "selected": "";
                                                                            ?>
                                                                            <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>><?php echo $value->sub_name ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>                                                  
                                                            <td><input type="text" id="pro_id_<?php echo $i; ?>" readonly="" name="products_consume[<?php echo $j; ?>][pro_id]" class="form-control" value="<?php echo (!empty($details->pro_id)) ? $details->pro_id : "--"?>"></td>
                                                            <td><input type="text" id="available_qty_<?php echo $i; ?>" readonly="" name="products_consume[<?php echo $j; ?>][available_qty]" class="form-control" value="<?php echo (!empty($details->available_qty)) ? $details->available_qty : "0"?>"></td>
                                                            <td><input type="number" id="qty_<?php echo $i; ?>" readonly="" name="products_consume[<?php echo $j; ?>][qty]" min="1" class="form-control" value="<?php echo (!empty($details->qty)) ? $details->qty : "0"?>"></td>                                                                                                  
                                                            <td><textarea id="pcremark_<?php echo $i; ?>" readonly="" class="form-control" rows="2" name="products_consume[<?php echo $j; ?>][remark]"><?php echo (!empty($details->remark)) ? $details->remark : ""?></textarea></td>   
                                                        </tr>
                                                    <?php 
                                                            }
                                                       }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                                if(!empty($id)){
                                    echo '<input type="hidden" value="'.$id.'" name="id">'; 
                                }

                                if(!empty($action)){
                            ?>
                                <div class="btn-bottom-toolbar text-right">
                                    <button class="btn btn-info" name="action" value="1" type="submit">Approve</button>
                                    <button class="btn btn-danger" name="action" value="2" type="submit">Reject</button>
                                </div>
                            <?php
                                 }
                            ?>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>

</body>
</html>