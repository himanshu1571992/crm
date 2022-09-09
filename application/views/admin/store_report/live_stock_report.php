<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="warehouse_id" class="control-label">Warehouse</label>
                                            <select class="form-control selectpicker" required='' data-live-search="true" id="warehouse_id" name="warehouse_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                    foreach ($all_warehouse as $all_warehouse_value) {
                                                        $selected = ($warehouse_id == $all_warehouse_value->id) ? "selected": "";
                                                        ?>
                                                        <option value="<?php echo $all_warehouse_value->id; ?>" <?php echo $selected; ?>><?php echo $all_warehouse_value->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="warehouse_id" class="control-label">Division</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="division_id" name="division_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($division_list) && count($division_list) > 0) {
                                                    foreach ($division_list as $division) {
                                                        $selected = ($division_id == $division->id) ? "selected": "";
                                                        ?>
                                                        <option value="<?php echo $division->id; ?>" <?php echo $selected; ?>><?php echo $division->title; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="service_type" class="control-label">Service Type</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">
                                                <option value=""></option>
                                                <option value="1" <?php echo (isset($service_type) && $service_type == 1) ? 'selected': ''; ?>>Rent</option>
                                                <option value="2" <?php echo (isset($service_type) && $service_type == 2) ? 'selected': ''; ?>>Sales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="pro_category_id" class="control-label">Product Category</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="pro_category_id" name="pro_category_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($product_category_list) && count($product_category_list) > 0) {
                                                    foreach ($product_category_list as $category) {
                                                        $selected = ($pro_category_id == $category->id) ? "selected": "";
                                                        ?>
                                                        <option value="<?php echo $category->id; ?>" <?php echo $selected; ?>><?php echo cc($category->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="short_by" class="control-label">Short By</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="short_by" name="short_by">
                                                <option value=""></option>
                                                <option value="1" <?php echo (isset($short_by) && $short_by == 1) ? 'selected': ''; ?>>Min Qty</option>
                                                <option value="2" <?php echo (isset($short_by) && $short_by == 2) ? 'selected': ''; ?>>Max Qty</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="from_date">
                                            <label for="from_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="from_date" name="from_date" class="form-control datepicker" value="<?php echo (!empty($from_date)) ? $from_date:''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="to_date">
                                            <label for="to_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="to_date" name="to_date" class="form-control datepicker" value="<?php echo (!empty($to_date)) ? $to_date:''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group" style="margin-top: 26px;">
                                            <button type="submit" class="btn btn-info">Search</button>
                                            <a class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>                    
                        <div class="col-md-12 ttlbincard-div">
                            <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h3 class="text-muted _total mainstoreqty">0.00</h3>
                                        <span class="text-success">Main Store Qty</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h3 class="text-muted _total shopfloorqty">0.00</h3>
                                        <span class="text-success">Shop Floor Store Qty</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h3 class="text-muted _total finishedgoodsqty">0.00</h3>
                                        <span class="text-success">Finished Goods Store Qty</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12 col-md-12 total-column">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h3 class="text-muted _total ttlvalue">0.00</h3>
                                        <span class="text-success">Total Value</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <div class="table-responsive">  
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Unit</th>
                                            <th>Main Store</th>
                                            <th>Shop Floor Store</th>
                                            <th>Finished Good Store</th>
                                            <th>Total Qty</th>
                                            <th>Total Weight</th>
                                            <th>Value</th>
                                            <th>Min Qty</th>
                                            <th>Max Qty</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    $mainstoreqty = $shopfloorqty = $finishedgoodsqty = $ttlvalue = $sendbutton = 0;
                                    if(!empty($product_list)){
                                        foreach ($product_list as $key => $row) { 
                                            $product_image = base_url('assets/images/') . "/no_image_available.jpeg";
                                            if (isset($row->photo) && !empty($row->photo) && ($row->photo != "--")) {
                                                $product_image = base_url('uploads/product') . "/" . $row->photo;
                                            }

                                            if (!empty($from_date) && !empty($to_date)){
                                                $main_store_count = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log`  WHERE outward_store = 0 and scrap_store = 0 and qty > 0 and material_status != 2 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$row->id."' and date between '".db_date($from_date)."' and '".db_date($to_date)."' and job_work_store = 0 and main_store = 1 and shop_floor_store = 0 and finish_goods_store = 0 and consumable_store = 0")->row()->ttl_qty;
                                                $shopfloor_count = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log`  WHERE outward_store = 0 and scrap_store = 0 and qty > 0 and material_status != 2 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$row->id."' and date between '".db_date($from_date)."' and '".db_date($to_date)."' and job_work_store = 0 and shop_floor_store = 1 and finish_goods_store = 0 and consumable_store = 0")->row()->ttl_qty;
                                                $finishedgoods_count = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log`  WHERE outward_store = 0 and scrap_store = 0 and qty > 0 and material_status != 2 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$row->id."' and date between '".db_date($from_date)."' and '".db_date($to_date)."' and job_work_store = 0 and finish_goods_store = 1 and consumable_store = 0")->row()->ttl_qty;
                                            }else{
                                                $main_store_count = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblproduct_store_log`  WHERE outward_store = 0 and scrap_store = 0 and qty > 0 and material_status != 2 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$row->id."' and job_work_store = 0 and main_store = 1 and shop_floor_store = 0 and finish_goods_store = 0 and consumable_store = 0")->row()->ttl_qty;
                                                $shopfloor_count = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblproduct_store_log`  WHERE outward_store = 0 and scrap_store = 0 and qty > 0 and material_status != 2 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$row->id."' and job_work_store = 0 and shop_floor_store = 1 and finish_goods_store = 0 and consumable_store = 0")->row()->ttl_qty;
                                                $finishedgoods_count = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblproduct_store_log`  WHERE outward_store = 0 and scrap_store = 0 and qty > 0 and material_status != 2 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and pro_id = '".$row->id."' and job_work_store = 0 and finish_goods_store = 1 and consumable_store = 0")->row()->ttl_qty;
                                            }
                                            
                                            $mainstoreqty += $main_store_count;
                                            $shopfloorqty += $shopfloor_count;
                                            $finishedgoodsqty += $finishedgoods_count;

                                            $total_qty = $main_store_count+$shopfloor_count+$finishedgoods_count;
                                            $provalue = $this->db->query("SELECT `price` FROM `tblpurchaseorderproduct` where product_id = '".$row->id."' and price > 0 order by id desc LIMIT 1")->row();
                                            $price = (!empty($provalue)) ? $provalue->price * $total_qty : 0;
                                            $min_qty = value_by_id("tblproducts", $row->id, "min_qty");
                                            $max_qty = value_by_id("tblproducts", $row->id, "max_qty");
                                            $ttlvalue += $price;
                                            $display_row = 0;
                                            if(!empty($short_by)){
                                                if ($short_by == 1 && $total_qty <= $min_qty){
                                                    $display_row = 1;
                                                }
                                                
                                                if($short_by == 2 && $total_qty >= $max_qty){
                                                    $display_row = 1;
                                                }
                                            }else if(empty($short_by)){
                                                $display_row = 1;
                                            }

                                            if ($display_row == 1){
                                                
                                                $style = '';
                                                if($total_qty < $min_qty){ 
                                                    $sendbutton += 1;
                                                    $style =  'style="color: red; font-size: 16px;"';
                                                } 

                                                $ttl_weight = '--';
                                                $product_weight = get_product_weight($row->id);
                                                if ($product_weight > 0){
                                                    $ttl_weight = ($total_qty*$product_weight);
                                                    $ttl_weight = number_format($ttl_weight, 2);
                                                }
                                            ?>
                                                
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>                                                
                                                    <td <?php echo $style; ?>><img src="<?php echo $product_image; ?>" width="50" height="50"></td>
                                                    <td <?php echo $style; ?>><?php echo cc($row->sub_name); ?></td>
                                                    <td <?php echo $style; ?>><?php echo "PRO-ID".$row->id; ?></td>
                                                    <td <?php echo $style; ?>><?php echo value_by_id('tblunitmaster', $row->unit_id, 'name'); ?></td>
                                                    <td <?php echo $style; ?>><?php echo $main_store_count; ?></td>
                                                    <td <?php echo $style; ?>><?php echo $shopfloor_count; ?></td>
                                                    <td <?php echo $style; ?>><?php echo $finishedgoods_count; ?></td>
                                                    <td <?php echo $style; ?>><?php echo number_format($total_qty, 2); ?></td>
                                                    <td <?php echo $style; ?>><?php echo $ttl_weight; ?></td>
                                                    <td <?php echo $style; ?>><?php echo number_format($price, 2); ?></td>
                                                    <td <?php echo $style; ?>> <?php echo number_format($min_qty, 2); ?></td>
                                                    <td <?php echo $style; ?>><?php echo number_format($max_qty, 2); ?></td>
                                                    <td>
                                                        <?php 
                                                            if($total_qty < $min_qty){
                                                                $chk_prod = $this->db->query("SELECT * FROM tblrequirement_products WHERE `product_id`= '".$row->id."' AND `is_stock_added`= '0'")->row();
                                                                if (empty($chk_prod)){
                                                        ?>
                                                            <!-- <a target="_blank" href="<?php echo admin_url('requirement/add/livestock/'.$row->id); ?>" class="btn-sm btn-info">Send Requirement</a> -->
                                                            <input type="checkbox" name="stock_pro_ids[]" data-pid="<?php echo $row->id; ?>" class="form-control chk-box-req"><span></span>Send Requirement
                                                        <?php
                                                                }else{
                                                                    echo '<p class="text-success">Requirement Already Sent</p>';
                                                                }
                                                            }
                                                        ?>    
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if ($sendbutton > 0){ ?>
                            <div class="btn-bottom-toolbar text-right">
                                <a href="javascript:void(0);" onclick="send_requirement();" class="btn btn-success send-req-btn" >Send Requirement</a>
                            </div>
                        <?php } ?>
                    </div>
                        </div>
                    </div>
                </div>      
            <?php echo form_close(); ?>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<?php init_tail(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>


<script>

$(document).ready(function() {
    var mainstoreqty = '<?php echo number_format($mainstoreqty,2); ?>';
    var shopfloorqty = '<?php echo number_format($shopfloorqty,2); ?>';
    var finishedgoodsqty = '<?php echo number_format($finishedgoodsqty,2); ?>';
    var ttlvalue = '<?php echo number_format($ttlvalue,2); ?>';
    $(".ttlbincard-div").hide();
    if (mainstoreqty != '0.00' || shopfloorqty != '0.00' || finishedgoodsqty != '0.00' || ttlvalue != '0.00'){
       
        $(".ttlbincard-div").show();
        $(".mainstoreqty").html(mainstoreqty);
        $(".shopfloorqty").html(shopfloorqty);
        $(".finishedgoodsqty").html(finishedgoodsqty);
        $(".ttlvalue").html(ttlvalue);
    }
    

    $('#newtable').DataTable( {
        
        "iDisplayLength": 30,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                }
            },
            'colvis',
        ]
    } );
} );
    
    function get_productlog_details(id, ref_type){
        var url = "<?php echo site_url('admin/store/get_productlog_details/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id+"/"+ref_type,
            success: function (res) {
                $('.stockdetails').html(res);
            }
        })
    }

    function send_requirement(){
        var pids = [];
        $.each($(".chk-box-req"), function(){
            if ($(this).is(":checked")) {
                pids.push($(this).data('pid'));
            }
        });
        if (pids !=''){
            var url = "<?php echo site_url('admin/requirement/add/livestock?pids='); ?>";
            window.location.href = url+pids; 
        }else{
            alert("Please check at least one product for send requirement");
        }
    }
</script>


</body>
</html>

