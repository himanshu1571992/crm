<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row panelHead">
                                <div class="col-md-12">
                                    <!-- <a href="<?php echo admin_url('product_new/action_pending'); ?>" class="btn btn-info mright5 test pull-left display-block">Action Pending</a> -->
                                    <?php
                                    if(check_permission_page(295,'create') ){
                                        ?>
                                            <a href="<?php echo admin_url('product_new/product'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                                <?php echo _l('new_product'); ?>
                                            </a>

                                            <!-- <a href="<?php echo admin_url('product_new/product_for_delete'); ?>" class="btn btn-info mright5 test pull-left display-block">Product For Deletet</a> -->

                                            <!-- <a href="<?php echo admin_url('product_new/product_merge'); ?>" class="btn btn-info mright5 test pull-left display-block">Merge Product</a> -->
                                            <a href="<?php echo admin_url('product_new/export_product'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Export</a>
                                        <?php
                                    }
                                    ?>

                                    <div class="visible-xs">
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <form id="form-filter" class="form-horizontal">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="product_cat_id" name="category_id" data-live-search="true">
                                                <option value="" selected >--Select Category-</option>
                                                <?php
                                                if(!empty($category_list)){
                                                    foreach($category_list as $row){
                                                        ?>
                                                        <option value="<?php echo $row->id;?>"><?php echo cc($row->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="product_sub_cat_id" name="sub_category_id" data-live-search="true">
                                                <option value="" selected >--Select Sub Category-</option>
                                                <?php
                                                if(!empty($sub_category_list)){
                                                    foreach($sub_category_list as $row){
                                                        ?>
                                                        <option value="<?php echo $row->id;?>"><?php echo cc($row->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="parent_category_id" name="parent_category_id" data-live-search="true">
                                                <option value="" selected >--Select Parent Category-</option>
                                                <?php
                                                if(!empty($parent_category_list)){
                                                    foreach($parent_category_list as $row){
                                                        ?>
                                                        <option value="<?php echo $row->id;?>"><?php echo cc($row->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="child_category_id" name="child_category_id" data-live-search="true">
                                                <option value="" selected >--Select Child Category-</option>
                                                <?php
                                                if(!empty($child_category_list)){
                                                    foreach($child_category_list as $row){
                                                        ?>
                                                        <option value="<?php echo $row->id;?>"><?php echo cc($row->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="is_varified" name="is_varified" data-live-search="true">
                                                <option value="" selected >--Select Verified--</option>
                                                <option value="1">Verified</option>
                                                <option value="0">Unverified</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="product name">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <span id="prefix">PRO-</span>
                                                </span>
                                                <input type="text" name="pro_id" id="pro_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <button type="button" id="btn-filter" class="btn btn-primary">Search</button>
                                                <!-- <button type="button" id="btn-reset" class="btn btn-danger">Reset</button> -->
                                                <a class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                </form>
                                 
                                <div class="col-md-12">
                                    <div class="col-md-12 col-md-6 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted _total verified_count"><?php echo $verify_count; ?></h3>
                                                <span class="staff_logged_time_text text-success">Verified Product</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-md-6 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted _total unverified_count"><?php echo $unverify_count; ?></h3>
                                                <span class="staff_logged_time_text text-danger">Unverified Product</span>
                                            </div>
                                        </div>
                                    </div>         
                                </div>  
                                <div class="col-md-12 table-responsive">
                                <hr>
                                    <table id="productlistTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product Name</th>
                                                <th>Pro ID</th>
                                                <th>Unit</th>
                                                <th>Category</th>
                                                <th>Verified</th>
                                                <th>Date Created</th>
                                                <th>Picture</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product Name</th>
                                                <th>Pro ID</th>
                                                <th>Unit</th>
                                                <th>Category</th>
                                                <th>Verified</th>
                                                <th>Date Created</th>
                                                <th>Picture</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>    
                            </div>    
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        <div class="btn-bottom-pusher"></div>
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
    get_product_count();
    table = $('#productlistTable').DataTable({ 
        // "dom": 'lBfrtip',
        // "buttons": [
        //     {
        //         extend: 'excel',
        //         exportOptions: {
        //             columns: [ 0, 1, 2, 3, 4, 5, 6 ]
        //         }
        //     },
        //     {
        //         extend: 'pdf',
        //         exportOptions: {
        //              columns: [ 0, 1, 2, 3, 4, 5, 6 ]
        //         }
        //     },
        //     {
        //         extend: 'print',
        //         exportOptions: {
        //             columns: [ 0, 1, 2, 3, 4, 5, 6 ]
        //         }
        //     },
        // ],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "pageLength": 25,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo admin_url('product_new/product_ajax_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.product_cat_id = $("#product_cat_id").val();
                data.product_sub_cat_id = $('#product_sub_cat_id').val();
                data.parent_category_id = $('#parent_category_id').val();
                data.child_category_id = $('#child_category_id').val();
                data.is_varified = $('#is_varified').val();
                data.product_name = $('#product_name').val();
                data.pro_id = $('#pro_id').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
        ],

    });
    $('#btn-filter').click(function(){ //button filter event click
        get_product_count();
        table.ajax.reload();  //just reload table
    });
    // $('#btn-reset').click(function(){ //button reset event click
    //     // $('#form-filter')[0].reset();
    //     table.ajax.reload();  //just reload table
    // });

    function get_product_count(){
        var product_cat_id = $("#product_cat_id").val();
        var product_sub_cat_id = $('#product_sub_cat_id').val();
        var parent_category_id = $('#parent_category_id').val();
        var child_category_id = $('#child_category_id').val();
        var is_varified = $('#is_varified').val();
        var product_name = $('#product_name').val();
        var pro_id = $('#pro_id').val(); 

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/product_new/get_product_count'); ?>",
            data    : {
                'product_cat_id' : product_cat_id,
                'product_sub_cat_id' : product_sub_cat_id,
                'parent_category_id' : parent_category_id,
                'child_category_id' : child_category_id,
                'is_varified' : is_varified,
                'product_name' : product_name,
                'pro_id' : pro_id
            },
            success : function(response){
                
                if(response != ''){
                    var obj = jQuery.parseJSON(response);
                    $(".verified_count").html(obj.verified);
                    $(".unverified_count").html(obj.unverified);
                }
            }
        });
    }
    
});



</script>
</body>
</html>
