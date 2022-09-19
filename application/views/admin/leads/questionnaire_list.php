<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> <a href="<?php echo admin_url('leads/questionnaire'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Questionnaire</a></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                        <div class="">
                            
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>Question Name</th>
                                        <th>Type</th>
                                        <th>Order</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($questionnaire_info)){
                                        $i=1;
                                        foreach($questionnaire_info as $row){  
                                            $checked = ($row->status == 1 ) ? 'checked' : '';
                                            $toggleActive = '<div class="onoffswitch">
                                                <input type="checkbox" data-switch-url="' . admin_url() . 'leads/change_questionnaire_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $row->id . '" data-id="' . $row->id . '" ' . $checked . '>
                                                <label class="onoffswitch-label" for="' . $row->id . '"></label>
                                            </div>';


                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo ($row->added_by > 0) ? get_employee_fullname($row->added_by) : 'N/A'; ?></td>
                                                <td title="<?php echo cc($row->question); ?>"><?php echo limit_word(cc($row->question)); ?></td>
                                                <td><?php if($row->type == 1) { echo "Input Box"; } elseif ($row->type == 2) { echo "Text Box"; } elseif ($row->type == 3) { echo "Selection Box"; } else { echo "Multi-Selection Box"; }  ?></td>
                                                <td><?php echo $row->question_order;?></td>
                                                <td><?php echo $row->size;?></td>
                                                <td><?php echo $toggleActive;?></td>
                                                <td><?php echo _d($row->created_at);?></td>

                                                <td class="text-center">
                                                  <a href="<?php echo admin_url('leads/questionnaire/'.$row->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                                  <a href="<?php echo admin_url('leads/delete_questionnaire/'.$row->id); ?>" class="btn btn-danger btn-xs _delete">Delete</a>  
                                                    
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
<script type="text/javascript">
    $(function() { 
   var lengthText = 5;
   var text = $('#test').text();
   var shortText = $.trim(text).substring(0, lengthText).split(" ").slice(0, -1).join(" ") + "...";

   $('#test').prop("title", text);
   $('#test').text(shortText);

   $('[data-toggle="tooltip"]').tooltip();
})
</script>

</body>
</html>
