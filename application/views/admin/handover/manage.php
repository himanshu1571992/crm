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

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Handover List <?php if(check_permission_page(154,'create')){ ?> <a href="<?php echo admin_url('handover/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Handover</a> <?php } ?></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div class="row col-md-12">
                        <div class="form-group col-md-4" id="employee_div">
                            <label for="receiver" class="control-label">Search by receiver *</label>
                            <select class="form-control selectpicker" id="receiver" name="receiver" data-live-search="true">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                               if(!empty($staff_info)){
                                    foreach ($staff_info as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value->staffid; ?>" <?php if(!empty($s_receiver) && $s_receiver == $value->staffid){ echo 'selected'; }?>><?php echo cc($value->firstname); ?></option>
                                        <?php     
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        

                        
                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
               
                    </div>
                    
                        <div class="">
                        
                            
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>Title</th>
                                        <th>Final Receiver</th>
                                        <th>Remark</th>
                                        <th>Date</th>
                                        <th>Attachments</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($handover_info)){
                                        $i=1;
                                        foreach($handover_info as $row){  
                                            $can_delete = $this->db->query("SELECT * FROM tblhandoverlog  where handover_id = '".$row->id."' and received_status > 0 ")->row();

                                            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'handover_master' and rel_id = '".$row->id."' ")->result();

                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo get_employee_fullname($row->staff_id);?></td>
                                                <td><?php echo cc($row->title);?></td>
                                                <td><?php echo get_employee_fullname($row->receiver_id);?></td>
                                                <td><?php echo (!empty($row->remark)) ? cc($row->remark) : '--'; ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($row->created_at));?></td>
                                                <td><?php
                                                    if(!empty($file_info)){
                                                        foreach ($file_info as $file) {
                                                            ?>
                                                            <a target="_blank" href="<?php echo base_url('uploads/handover_master/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo '--';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">

                                                    <button value="<?php echo $row->id; ?>" type="button" class="btn btn-info handover" data-toggle="modal" data-target="#handover_modal">Show Status</button>
                                                    <?php 
                                                    
                                                    if(check_permission_page(154,'delete') && empty($can_delete)){
                                                        ?>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('handover/delete/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php
                                                    }else{
                                                        echo '--';
                                                    }
                                                    ?>
                                                    
                                                    
                                                </td>    
                                              
                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="6"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>
                        
                        

                               
                            </div>
                             <!-- <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div> -->
                        </div>
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
        </div>      
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
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            'colvis',
        ]
    } );
} );
</script>

</body>
</html>

<!-- Modal -->
<div id="handover_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receiver to Final Receiver</h4>
      </div>
      <div class="modal-body" id="handover_data">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
    $(document).on('click', '.handover', function() {  

    var handover_id = $(this).val(); 
    if(handover_id > 0 ){
          $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/handover/get_handover_data'); ?>",
            data    : {'handover_id' : handover_id},
            success : function(response){
                if(response != ''){       

                     
                     $('#handover_data').html(response);  
                }
            }
        })  
    }
    

});    
</script>
