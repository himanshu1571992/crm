
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
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('product_new/send_product_approval'); ?>" type="submit" class="btn btn-info">Send Product Approval</a>
                            <a href="<?php echo admin_url('product_new/reject_list'); ?>" type="submit" class="btn btn-info">Product Reject List</a>
                             <?php //} ?>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Select Status</label>
                                <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="3" <?php echo (!empty($status) && $status == 3) ? 'selected' : ''; ?>>Pending</option>
                                    <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : ''; ?>>Approved</option>
                                    <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : ''; ?>>Rejected</option>
                                        
                                </select>
                            </div>
                        </div>


                        
                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                        <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12">  
                            <hr> 
                            <div class="table-responsive">                                                         
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Remark</th>
                                        <th>Reject/Approval Remark</th>
                                        <th class="text-center">Status</th> 
                                        <th class="text-center">Show Details</th>
                                        <th>Create Date</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($send_info)){
                                        $z=1;
                                        foreach($send_info as $row){ 

                                               if($row->approval_status == 0){
                                                    $status = 'Pending';
                                                    $cls = 'btn-warning';
                                                }elseif($row->approval_status == 1){
                                                    $status = 'Approved';
                                                    $cls = 'btn-success';
                                                }elseif($row->approval_status == 2){
                                                    $status = 'Rejected';
                                                    $cls = 'btn-danger';
                                                }

                                                $master_approval = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$row->id."' and module_id = 10 ")->row(); 
                                                if(!empty($master_approval)){
                                                    $master_id = $master_approval->id;
                                                }else{
                                                    $master_id = 0;
                                                }
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                               
                                                                                                                                    
                                                <td><?php echo (!empty($row->remark)) ? cc($row->remark) : '--'; ?></td>
                                                <td><?php echo (!empty($row->approval_remark)) ? cc($row->approval_remark) : '--'; ?></td>
                                                <td class="text-center"><?php echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$master_id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>'; ?></td>
                                                <td class="text-center"><button type="button" class="btn-sm btn-primary details" value="<?php echo $row->id; ?>" data-toggle="modal" data-target="#detailModal">Details</button></td>
                                                <td><?php echo _d($row->created_date);?></td>
                                            
                                                
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
    
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/product_new/get_product_approval_status'); ?>",
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
