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

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4>Bank Payments List</h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <?php if(check_permission_page(57,'create')){ ?><a href="<?php echo admin_url('bank_payments/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Payments</a><?php } ?>
                            </div>
                        </div>
                    <hr class="hr-panel-heading">
                    <div class="row">
                    
                    <div class="row col-md-12">
                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" required="" name="f_date" class="form-control datepicker" value="<?php if(!empty($s_fdate)){ echo $s_fdate; }else{ echo date('d/m/Y'); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" required="" name="t_date" class="form-control datepicker" value="<?php if(!empty($s_tdate)){ echo $s_tdate; }else{ echo date('d/m/Y'); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                        <div class="col-md-2">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                    </div>
                    
                        <div class="">
                        <hr>
                            
                        <div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Payment Id</th>
                                        <th>Added By</th>                                        
                                        <th>Date</th>
                                        <th>UTR No.</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th width="20%" class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($payment_info)){
                                        $i=1;
                                        foreach($payment_info as $row){

                                            if($row->status == 0){
                                                $status = 'Pending';
                                                $cls = 'btn-warning';
                                            }elseif($row->status == 1){
                                                $status = 'Approved';
                                                $cls = 'btn-success';
                                            }elseif($row->status == 2){
                                                $status = 'Rejected';
                                                $cls = 'btn-danger';
                                            }elseif($row->status == 4){
                                                $status = 'Reconciliation';
                                                $cls = 'btn-brown';
                                            }elseif($row->status == 5){
                                                $status = 'ON Hold';
                                                $cls = 'btn-hold';
                                            }  

                                            $details = $this->db->query("SELECT SUM(`amount`) as ttl_amt FROM tblbankpaymentdetails WHERE main_id = '".$row->id."' ")->row();
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo 'PAY-'.$row->id;?></td>
                                                <td><?php echo get_employee_name($row->staff_id);?></td>
                                                <td><?php echo _d($row->created_at);?></td>
                                                <td>
                                                    <?php
                                                    if($row->status == 2){
                                                        $reject_info = $this->db->query("SELECT * FROM tblbankpaymentapproval WHERE payment_id = '".$row->id."' and approve_status = 2 ")->row();
                                                        ?>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal<?php echo $row->id; ?>">Rejected</button>
                                                            <div id="rejectModal<?php echo $row->id; ?>" class="modal fade" role="dialog">
                                                              <div class="modal-dialog modal-sm">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Payment is Rejected</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <p style="color: red;"><?php echo (!empty($reject_info)) ? $reject_info->approvereason : '--'; ?></p>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  </div>
                                                                </div>

                                                              </div>
                                                            </div>
                                                        <?php    
                                                    }else{
                                                        $pending_info = $this->db->query("SELECT * FROM tblbankpaymentdetails WHERE main_id = '".$row->id."' and utr_no = '' ")->row();
                                                        if(!empty($pending_info)){
                                                        ?>
                                                            <button type="button" value="<?php echo $row->id; ?>" class="ref_no btn-sm btn-warning" data-toggle="modal" data-target="#myModal">UTR Pending</button>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <button type="button" value="<?php echo $row->id; ?>" class="ref_no btn-sm btn-info" data-toggle="modal" data-target="#myModal">Show Details</button>
                                                        <?php
                                                        }
                                                        
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                <td><?php echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal1">'.$status.'</button>'; ?></td>
                                                <td><?php echo $details->ttl_amt;?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if($row->status == 1){
                                                    ?>
                                                    <a href="<?php echo admin_url('bank_payments/export/'.$row->id); ?>" class="btn btn-info" >Excel Export</a>
                                                    <?php    
                                                    }
                                                    ?>
                                                    
                                                    <a href="<?php echo admin_url('bank_payments/view/'.$row->id); ?>" class="btn btn-success" >View</a>
                                                     <?php
                                                    
                                                    if($row->status == 0 || $row->status == 2 || $row->status == 4 || $row->status == 5){ 
                                                        if(check_permission_page(57,'edit')){
                                                        ?>
                                                            <a href="<?php echo admin_url('bank_payments/add/'.$row->id); ?>" class="actionBtn" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?php
                                                        }else{
                                                            echo '--';
                                                        }
                                                    }

                                                    if($row->status == 0){
                                                    if(check_permission_page(57,'delete')){
                                                        ?>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('bank_payments/delete/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php
                                                    }else{
                                                        echo '--';
                                                    }
                                                    }
                                                    ?>
                                                   
                                                </td>    
                                              
                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="8"><h4>Record Not Found</h4></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update UTR No.</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <div id="utr_html"></div>
        </div>
        
        <!-- <div class="row">
            <form action="<?php echo admin_url('bank_payments/update_reference'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-6">
                <label class="control-label">UTR No. </label>
                <input type="text" class="form-control" value="" name="reference_no">
            </div>

            <input type="hidden" id="pay_id" value="" name="pay_id">

            <div style="float: right;" class="col-md-6">
                <button style="margin-top: 27px;" type="submit" class="btn btn-info">Update</button>
            </div>
            </form>
        </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal1" class="modal fade" role="dialog">
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            'colvis',
        ]
    } );
} );
</script>

<script type="text/javascript">
    $(document).on('click', '.ref_no', function()   
    {
        var id = $(this).val();        

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/bank_payments/get_detail_html'); ?>",
                data    : {'id' : id},
                success : function(response){
                    if(response != ''){                   
                         $('#utr_html').html(response);  
                         /* $('.selectpicker').selectpicker('refresh');
                         */
                         $('.date_picker').datepicker();
                    }
                }
            })    
       

    }); 
</script>

<script type="text/javascript">
    $('.status').click(function(){
    var payment_id = $(this).val();
    
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/bank_payments/get_approval_info'); ?>",
            data    : {'payment_id' : payment_id},
            success : function(response){
                if(response != ''){
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script>

</body>
</html>
