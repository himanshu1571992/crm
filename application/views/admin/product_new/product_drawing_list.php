
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

</style>

<?php
if(!empty($this->session->userdata('invoice_search'))){
    $search_arr = $this->session->userdata('invoice_search');
}
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; //if(check_permission_page(62,'create')){ ?> </h4>
                        </div>
                    </div>
                    <div class="row">

                            <div class="col-md-12">
                            <hr>
                            <div class="table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th width="5%"  align="center">S.No.</th>
                                        <th width="30%" align="left">Product Name</th>
                                        <th  align="left">Product ID</th>
                                        <th  align="left">Name of Drawing</th>
                                        <th  align="left">Drawing ID</th>
                                        <th  align="left">Rev No</th>
                                        <th  align="left">Drawing</th>
                                        <th  align="left">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                              if(!empty($productdrawing_list)){
                                                  $z=1;
                                                  foreach($productdrawing_list as $row){
                                                    $drawingdata = $this->db->query("SELECT * FROM `tblproductdrawing` WHERE `product_id`= '".$row->product_id."' ORDER BY id DESC")->row();
                                          ?>
                                                  <tr>
                                                      <td><?php echo $z++;?></td>
                                                      <td><?php echo value_by_id("tblproducts", $row->product_id, "name"); ?></td>
                                                      <td><?php echo product_code($row->product_id); ?></td>
                                                      <td><?php echo (!empty($drawingdata) && !empty($drawingdata->drawing_name)) ? cc($drawingdata->drawing_name) : "--"; ?></td>
                                                      <td><?php echo (!empty($drawingdata) && !empty($drawingdata->drawing_id)) ? $drawingdata->drawing_id : "--"; ?></td>
                                                      <td><?php echo (!empty($drawingdata) && !empty($drawingdata->rev_no)) ? $drawingdata->rev_no : "--"; ?></td>
                                                      <td>
                                                        <?php if (!empty($drawingdata->files)){
                                                            $filesdata = json_decode($drawingdata->files);
                                                            foreach ($filesdata as $k => $file) {
                                                        ?>
                                                              <!-- <img src="<?php echo base_url('uploads/product/product_drawing') . "/" . $file; ?>" title="<?php echo $file; ?>" style="border: 1px solid;" width="50" height="50"> -->
                                                              <a href="<?php echo base_url('uploads/product/product_drawing') . "/" . $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                                        <?php
                                                            }
                                                        } ?>
                                                      </td>
                                                      <td class="text-center"><button type="button" class="btn-sm btn-primary details" data-product_id="<?php echo $row->product_id; ?>" value="<?php echo $drawingdata->id; ?>" data-toggle="modal" data-target="#detailModal">History</button></td>
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

<!-- Modal -->
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

<!-- Modal -->
<div id="detailModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Drawing History</h4>
      </div>
      <div class="modal-body">
        <div id="productdrawing_html"></div>
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



<script>

$(document).ready(function() {
    $('#newtable').DataTable( {

        "iDisplayLength": 15,
        dom: 'Bfrtip'
    } );
} );
</script>

<script type="text/javascript">
    $('.status').click(function(){
    var id = $(this).val();

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/approval/get_status'); ?>",
            data    : {'id' : id},
            success : function(response){
                if(response != ''){
                    $("#approval_html").html(response);
                }
            }
        })
    });

    $('.details').click(function(){
        var id = $(this).val();
        var product_id = $(this).data("product_id");

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/product_new/get_productdrawing_history'); ?>",
            data    : {'id' : id, 'product_id': product_id},
            success : function(response){
                if(response != ''){
                    $("#productdrawing_html").html(response);
                }
            }
        });
    });
</script>

</body>
</html>
