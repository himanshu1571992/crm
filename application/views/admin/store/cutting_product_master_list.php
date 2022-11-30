<?php init_head(); ?>
<style>
    .popover{
        top: 70.4167px;
        left: 288.158px;
        display: block;
        max-width: revert;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title; ?></h4>
                                </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <a target="_blank" class="btn btn-info pull-right" href="<?php echo admin_url('store/add_cutting_products'); ?>">Add Cutting Product</a>
                                </div>
                            </div>
                            <hr class="hr-panel-heading">
                        </div>
                    <div>
                        </div>                    
                            <div class="col-md-12"> 
                                <div class="table-responsive">  
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>Created Date</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($cutting_products_list)){
                                        foreach ($cutting_products_list as $key => $value) { 
                                            $addedbyname = get_employee_fullname($value->added_by);
                                            $prohtml ='';
                                            $sub_products  = $this->db->query("SELECT `id`,`sub_name` FROM `tblproducts` WHERE id IN (".$value->sub_products_ids.")  ")->result();
                                            if (!empty($sub_products)){
                                                $prohtml .= "<div class='table-responsive'><table class='table ui-table'><thead><tr><th>Sub Product List</th></tr></thead><tbody>";
                                                foreach ($sub_products as $val) {
                                                    $productname = str_replace('"','&quot;', $val->sub_name);
                                                    $prohtml .= "<tr><td>".cc($productname)." ".product_code($val->id)."</td></li></tr>";
                                                }
                                                $prohtml .= "</tbody></table></div>";
                                            }
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo $addedbyname; ?></td>
                                            <td><?php echo _d($value->created_date); ?></td>
                                            <td><a target="_blank" href="<?php echo admin_url('product_new/view/'.$value->product_id);?>"><?php echo value_by_id("tblproducts", $value->product_id, "sub_name"); ?></a></td>
                                            <td><a target="_blank" href="<?php echo admin_url('product_new/view/'.$value->product_id);?>"><?php echo  product_code($value->product_id); ?></a> </td>
                                            <td>
                                                <a  class="btn btn-success" href="javascript:void(0);" data-html="true" data-container="body" data-toggle="popover" data-placement="left" data-content="<?php echo $prohtml; ?>">View</a>
                                                <a class="btn btn-info" href="<?php echo admin_url('store/add_cutting_products/'.$value->id); ?>">Edit</a>
                                                <a  class="btn btn-danger _delete" href="<?php echo admin_url('store/deleteCuttingProducts/'.$value->id); ?>" >Delete</a>
                                            </td>
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
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<div id="stock_details" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Product Log Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">  
                        <table class="table">
                            <thead>
                                <th>S.no.</th>
                                <th>Product Name</th>
                                <th>Product ID</th>
                                <th>Total Qty</th>
                                <th>Size <small>( MM )</small></th>
                            </thead>
                            <tbody class="stockdetails">

                            </tbody>
                        </table>
                    </div>                                
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
    $('#newtable').DataTable( {
        
        "iDisplayLength": 15,
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
                    columns: ":visible"
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: ":visible"
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ":visible"
                }
            },
            'colvis',
        ]
    } );
} );
    
    function get_productlog_details(id){
        var url = "<?php echo site_url('admin/store/get_productlog_details/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id,
            success: function (res) {
                $('.stockdetails').html(res);
            }
        })
    }

</script>


</body>
</html>

