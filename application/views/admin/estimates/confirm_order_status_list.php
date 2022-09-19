
<?php init_head(); ?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?>  
                    <?php if(check_permission_page(368,'create')){ ?>
                    <a href="<?php echo admin_url('estimates/addConfirmOrderStatus'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Create New Status</a>
                    <?php } ?>
                 </h4>

                    <hr class="hr-panel-heading">

                    <div>
                    
                    <div >
                        <div class="row col-md-12">
                            <div class="col-md-3">
                                <div class="form-group" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) {
                                            echo $f_date;
                                        } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) {
                                            echo $t_date;
                                        } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-3" style="margin-top: 28px;">
                                <div class="form-group" app-field-wrapper="date" >
                                    <button type="submit"  class="btn btn-info">Search</button>
                                    <a  class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>                 
                        </div>
                    </div>
                                                
                            <div class="col-md-12"> 
                                <hr>
                                <div class="table-responsive">  
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>Title</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    if(!empty($order_status_list)){
                                        foreach ($order_status_list as $key => $value) {
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>  
                                            <td><?php echo ($value->added_by > 0) ? get_employee_fullname($value->added_by) : 'N/A'; ?></td>
                                            <td><?php echo cc($value->title); ?></td>                                        
                                            <td><?php echo _d($value->created_at); ?></td>
                                            <td>
                                            <?php if(check_permission_page(368,'edit')){ ?>
                                                <a href="<?php echo admin_url("estimates/addConfirmOrderStatus/".$value->id); ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <?php
                                            }
                                             if(check_permission_page(368,'delete')){ ?>    
                                                <a href="<?php echo admin_url("estimates/deleteConfirmOrderStatus/".$value->id); ?>" class="btn btn-danger _delete"><i class="fa fa-trash"></i></a>
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
<?php init_tail(); ?>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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


</body>
</html>


<script type="text/javascript">
   
  $(document).ready(function(){
    'use-strict';

    //Example 2
    $('#filer_input2').filer({
//        limit: 5,
        maxSize: 20,
//        extensions: ['jpg', 'jpeg', 'png' ],
        changeInput: true,
        showThumbs: true,
        addMore: true
    });
    
    
  });
  
 
</script>
