
<?php init_head(); ?>

<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>

<?php
if(!empty($this->session->userdata('extrusion_search'))){
    $search_arr = $this->session->userdata('extrusion_search');
}    
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label for="product_id" class="control-label">Select Product</label>
                                <select class="form-control selectpicker" data-live-search="true" id="product_id" name="product_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($product_info) && count($product_info) > 0) {
                                        foreach ($product_info as $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if(!empty($search_arr['product_id']) && $search_arr['product_id'] == $value['id']){ echo 'selected';} ?> ><?php echo $value['sub_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="warehouse_id" name="warehouse_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <option value="<?php echo $all_warehouse_value['id']; ?>"  <?php if(!empty($search_arr['warehouse_id']) && $search_arr['warehouse_id'] == $all_warehouse_value['id']){ echo 'selected';} ?> ><?php echo $all_warehouse_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>

                        <!-- <div class="col-md-4">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Service Type</label>
                                <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 1){ echo 'selected';} ?>>Rent</option>
                                    <option value="2" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 2){ echo 'selected';} ?>>Sale</option>
                                    
                                </select>
                            </div>
                        </div> -->


                        
                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a href=""><button type="submit" value="1" name="reset" style="margin-top: 24px;" class="btn btn-danger">Reset</button></a>
                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Product Name</th>
                                        <th>Warehouse</th>
                                        <th>Service Type</th>
                                        <th>Size</th>
                                        <th>Bundle No.</th>
                                        <th>Weight Per Psc</th>
                                        <th>Quantity</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $z=1;
                                    if(!empty($store_list)){
                                        foreach ($store_list as $key => $row) {       

                                            $main_id = $row->id;
                                            $parent_id = value_by_id('tblmanufacturestock',$row->id,'parent_id');
                                            if($parent_id > 0){
                                               $main_id = $parent_id; 
                                            }                                
                                            ?>
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><?php if($row->waste == 1){ echo 'Waste'; }else{ ?><a target="_balnk" href="<?php echo admin_url('product_new/view/'.$row->product_id); ?>"><?php echo value_by_id('tblproducts',$row->product_id,'sub_name'); ?></a><?php }?></td>
                                                <td><?php echo value_by_id('tblwarehouse',$row->warehouse_id,'name'); ?></td>
                                                <td><?php echo ($row->service_type == 1) ? 'Rent' : 'Sales'; ?></td>              
                                                <td><?php echo $row->size; ?></td>                                               
                                                <td><?php echo value_by_id('tblmanufacturestock',$main_id,'bundle_no'); ?></td>                                               
                                                <td><?php echo value_by_id('tblmanufacturestock',$main_id,'weight_per_psc'); ?></td>     
                                                <td><?php echo $row->qty; ?></td>                                             
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                     
                                    </tbody>
                                  </table>

                                <div class="pagination">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        
                               
                            
                        </div>
						 <!-- <div class="btn-bottom-toolbar text-right">
								<button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo _l('submit'); ?>
								</button>
							</div> -->
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<?php init_tail(); ?>


</body>
</html>
