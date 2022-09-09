<?php init_head(); ?>
<style type="text/css">
    .btn-hold{
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-brown{
        background-color: brown;
        color: #fff;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'product_form', 'class' => 'product-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title;?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('product_new/temperory_product'); ?>" class="btn btn-info">Add Temperory Product</a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                              <div>
                                <table class="table" id="newtable">
                                      <thead>
                                          <tr>
                                              <th>S.No</th>
                                              <th>Product Name</th>
                                              <th>Pro ID</th>
                                              <th>Unit</th>
                                              <th>Category</th>
                                              <th>Picture</th>
                                              <th width="10%">Status</th>
                                              <th>Date Created</th>
                                              <th class="text-center">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      <?php

                                      if(!empty($product_data)){
                                          foreach ($product_data as $key => $value) {

                                                $name_html = '';
                                                if($value->status == 0){
                                                    $status = 'Pending';
                                                    $cls = 'btn-warning';
                                                }elseif($value->status == 1){
                                                    $status = 'Approved';
                                                    $cls = 'btn-success';
                                                }elseif($value->status == 2){
                                                    $status = 'Rejected';
                                                    $cls = 'btn-danger';
                                                }elseif($value->status == 4){
                                                    $status = 'Reconciliation';
                                                    $cls = 'btn-brown';
                                                }elseif($value->status == 5){
                                                    $status = 'ON Hold';
                                                    $cls = 'btn-hold';
                                                }  
                                              $category = $this->db->query("SELECT * FROM `tblproductcategory` where id ='".$value->category_id."' ")->row();
                                              $unit_name = $this->db->query("SELECT * FROM `tblunitmaster` where id ='".$value->unit."' ")->row();
                                              $img_url = base_url('assets/images/no_image_available.jpeg');
                                              if($value->file_name != "") {
                                                  $img_url = base_url('uploads/temperory_product/'.$value->id) . "/" . $value->file_name;
                                              }
                                          ?>
                                          <tr>
                                              <td class="text-center"><?php echo ++$key; ?></td>
                                              <td class="text-center">
                                                <?php echo cc($value->product_name); ?>
                                                <div class="row-options">
                                                    <a href="<?php echo admin_url('product_new/temperory_product/'.$value->id); ?>" >Edit</a> |
                                                    <a target="_blank" href="<?php echo admin_url('product_new/temp_product_used/' . $value->id); ?>">Details</a> |
                                                    <a href="<?php echo admin_url('product_new/delete_temperory_product/'.$value->id); ?>" class="text-danger _delete">Delete</a>
                                                </div>
                                              </td>
                                              <td class="text-center"><?php echo 'TEMP-PRO-'.number_series($value->id);?></td>
                                              <td class="text-center"><?php echo (!empty($unit_name)) ? $unit_name->name : "--"; ?></td>
                                              <td class="text-center"><?php echo cc($category->name); ?></td>
                                              <td><?php echo '<img src="' . $img_url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="' . $value->file_name . '" />';?></td>
                                              <td class="text-center">
                                                  <?php
                                                      if ($value->status == 2) {
                                                         echo '<button type="button" class="btn-danger btn-sm status" value="'.$value->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
                                                      }else{
                                                          echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$value->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
                                                      }
                                                  ?>
                                              </td>
                                              <td class="text-center"><?php echo _d($value->created_at); ?></td>
                                              <td>
                                                <?php
                                                if ($value->status == 1){
                                                    $chk_converted = $this->db->query("SELECT `id` FROM `tblproducts` WHERE temperoryproduct_id ='" . $value->id . "' ")->row();
                                                    if (empty($chk_converted)) {
                                                        $chkconverted2 = $this->db->query("SELECT `id` FROM `tblproducts_log` WHERE temperoryproduct_id ='" . $value->id . "' ")->row();
                                                        if (empty($chkconverted2)) {
                                                ?>
                                                        <a target="_blank" style="width: 230px;" href="<?php echo admin_url('product_new/convert_to_product/' . $value->id); ?>" class="action-btn btn">Convert To Product</a>
                                                <?php
                                                        }else{
                                                            echo '<a href="javascript:void(0);" data-target="#product_log" data-type="log" data-id="'.$value->id.'" data-toggle="modal" style="width: 230px;background-color:#84c529;color:#fff;" class="action-btn btn productlog">Product Converted</a>';
                                                        }
                                                    }else{
                                                        echo '<a href="javascript:void(0);" data-target="#product_log" data-type="prodlog" data-id="'.$value->id.'" data-toggle="modal" style="width: 230px;background-color:#84c529;color:#fff;" class="action-btn btn productlog">Product Converted</a>';
                                                    }
                                                }
                                                ?>
                                                  <!-- <div class="btn-group pull-right">
                                                       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                       </button>
                                                       <ul class="dropdown-menu dropdown-menu-left toggle-menu">
                                                          <li>

                                                          </li>
                                                       </ul>
                                                  </div> -->
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body">
        <div id="approval_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="product_log" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Details</h4>
            </div>
            <div class="modal-body">
                <div id="product_info_details"></div>
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

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]

                }

            },

            'colvis',

        ]

    } );



} );


</script>

<script type="text/javascript">
    $('.status').click(function(){
    var po_id = $(this).val();

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/product_new/get_approval_info'); ?>",
            data    : {'po_id' : po_id},
            success : function(response){
                if(response != ''){
                    $("#approval_html").html(response);
                }
            }
        })
    });

    $('.productlog').click(function(){
        var type = $(this).data("type");
        var p_id = $(this).data("id");

        $("#product_info_details").html('');
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/product_new/get_converted_product_info'); ?>",
            data    : {'p_id' : p_id, 'type' : type},
            success : function(response){
                if(response != ''){
                    $("#product_info_details").html(response);
                }
            }
        });
    });
</script>

</body>

</html>
