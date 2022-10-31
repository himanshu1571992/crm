<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4><?php echo $title; ?>
                    <a href="<?php echo admin_url('staff_iteams/add_allot_iteams'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Allot Iteams</a></h4>
                        

                    <hr class="hr-panel-heading">

                    <div class="row">
                    <div class="form-group col-md-4">
                            <label for="staff_id" class="control-label">Employee Name</label>
                            <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                                if(!empty($staff_list)){
                                    foreach($staff_list as $staff){
                                        ?>
                                        <option value="<?php echo $staff->staffid;?>" <?php if(!empty($staff_id) && $staff_id == $staff->staffid){ echo 'selected';} ?>><?php echo cc($staff->firstname); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                    </div>
                    <div class="col-md-2" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Receive Status</label>
                                <select class="form-control selectpicker" id="status" name="status">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="3" <?php if(!empty($status) && $status == 3){ echo 'selected';} ?>>Pending</option>
                                    <option value="1" <?php if(!empty($status) && $status == 1){ echo 'selected';} ?>>Received</option>
                                    <option value="2" <?php if(!empty($status) && $status == 2){ echo 'selected';} ?>>Not Received</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                                                
                    <div class="col-md-12"> 
                            
                        <div class="table-responsive">                                                    
                        <table class="table" id="newtable">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Employee Name</th>
                                <th>Iteams Name</th>
                                <th>Alloted Type</th>
                                <th>Receive Status</th>
                                <th>Acceptance Status</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($allot_iteams)){

                                foreach ($allot_iteams as $key => $value) {
   
                                    if($value['receive_status'] == 0){
                                        $status = 'Pending';
                                        $cls = 'btn-warning';
                                    }elseif($value['receive_status'] == 1){
                                        $status = 'Received';
                                        $cls = 'btn-success';
                                    }elseif($value['receive_status'] == 2){
                                        $status = 'Not Received';
                                        $cls = 'btn-danger';
                                    }
                                    
                                    if($value['status'] == 0){
                                        $status1 = 'Pending';
                                        $cls1 = 'btn-warning';
                                    }elseif($value['status'] == 1){
                                        $status1 = 'Approved';
                                        $cls1 = 'btn-success';
                                    }elseif($value['status'] == 2){
                                        $status1 = 'Rejected';
                                        $cls1 = 'btn-danger';
                                    }

                                    $iteam_name = $this->db->query("SELECT * FROM `tblproducts` where id = '".$value['item_id']."' ")->row();
                                    $employee_name = $this->db->query("SELECT * FROM `tblstaff` where staffid = '".$value['staff_id']."' ")->row(); 
                                ?>
                                <tr>
                                    <td>
                                        <?php echo ++$key; ?>
                                    </td>
                                    <td>
                                        <?php echo get_creator_info($value["added_by"], $value["created_date"]); ?>
                                        <?php echo $employee_name->firstname; ?>
                                    </td>
                                    <td><?php echo $iteam_name->name; ?></td>
                                    <td><?php if($value['remark'] == 1){ echo "Returnable";} else { echo "Non Returnable";} ?></td>
                                    <td><?php echo '<button type="button" class="'.$cls.' btn-sm" value="'.$value['id'].'">'.$status.'</button>'; ?></td>
                                    <td><?php echo '<button type="button" class="'.$cls1.' btn-sm status" value="'.$value['id'].'" data-toggle="modal" data-target="#myModal1">'.$status1.'</button>'; ?></td>
                                    <td><?php echo cc($value['description']); ?></td>
                                    <td><?php echo _d($value['date']); ?></td>
                                    <td class="text-center">
                                        <?php if($value['receive_status'] == 0){ ?>
                                      <div class="btn-group pull-right">
                                         <a class="btn btn-info" href="<?php echo admin_url('staff_iteams/add_allot_iteams/'.$value['id']); ?>">EDIT</a>
                                      </div>
                                    <?php } else {?>
                                    <span style="color: red;">Action Taken</span>
                                    <?php } ?>
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
    var items_id = $(this).val();
    
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/staff_iteams/get_items_approval_info'); ?>",
            data    : {'items_id' : items_id},
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

