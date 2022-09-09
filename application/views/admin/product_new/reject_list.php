
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
        border: 1px solid #00BCD4;
        padding: 8px 10px;
        border-radius: 3px;
        background: #03A9F4;
        color: #fff;
        margin: 2px;
    }

    .actionBtn:hover {
        background:#255fe5;
        color:#fff;
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
                            <h4><?php echo $title; ?> </h4>
                        </div>
                    </div>

                    <div class="row">
                    
                           <div class="col-md-12">  
                            <hr> 
                            <div class="table-responsive">                                                         
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Product</th>
                                        <th>Reject/Approval Remark</th>
                                        <th class="text-center">Status</th>
                                        <th>Create Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($send_info)){
                                        $z=1;
                                        foreach($send_info as $row){ 
                                        $info = $this->db->query("SELECT * FROM `tblproducts_log` where id = '".$row->product_id."' ")->result();

                                           if($row->status == 0){
                                                $status = 'Rejected';
                                                $cls = 'btn-danger';
                                            }

                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td>
                                                <?php
                                                foreach($info as $product){ echo (!empty($product->sub_name)) ? cc($product->sub_name) : '--'; }
                                                  ?>
                                                </td>
                                                <td><?php echo cc($row->reject_remark); ?></td>
                                                <td class="text-center"><?php echo '<button type="button" class="'.$cls.' btn-sm status details" value="'.$row->id.'" data-toggle="modal" data-target="#detailModal">'.$status.'</button>'; ?></td>
                                                <td><?php echo _d($row->created_date);?></td>
                                                <td class="text-center"><a href="<?php echo admin_url('product_new/reject_product/' . $row->product_id); ?>" class="btn-sm btn-primary">Renew</a></td>
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

<div id="detailModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Approval Status</h4>
      </div>
      <div class="modal-body">
        <div id="status_html"></div>
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

   $('.details').click(function(){
    var id = $(this).val(); 
    
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/product_new/get_product_reject_status'); ?>",
            data    : {'id' : id},
            success : function(response){
                if(response != ''){
                    $("#status_html").html(response);
                }
            }
        })
    });

</script> 

</body>
</html>
