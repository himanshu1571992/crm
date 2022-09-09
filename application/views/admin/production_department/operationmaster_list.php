<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> <?php if(check_permission_page(411,'create')){ ?><a href="<?php echo admin_url('production_department/addoperationmaster'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Operation Master</a><?php } ?></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                        <div class="">
                            
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Machine</th>
                                        <th>Division</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($machinemaster_info)){
                                        $i=1;
                                        foreach($machinemaster_info as $row){  
                                            $checked = ($row->status == 1 ) ? 'checked' : '';
                                            $toggleActive = '<div class="onoffswitch">
                                                <input type="checkbox" data-switch-url="' . admin_url() . 'production_department/change_operationmaster_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $row->id . '" data-id="' . $row->id . '" ' . $checked . '>
                                                <label class="onoffswitch-label" for="' . $row->id . '"></label>
                                            </div>';
                                            $machine_ids = explode(',', $row->machine_id);
                                            $machine_text = '';
                                            if (!empty($machine_ids)){
                                                foreach ($machine_ids as $key => $mid) {
                                                    $machinename = value_by_id('tblmachinemaster', $mid, 'name');
                                                    $machine_text .= ($key == 0) ? $machinename : ', '.$machinename;
                                                }
                                            }

                                            /*$department = '--';
                                            if($row->department == 1){
                                                $department = 'Aluminum Scaffolding';
                                            }elseif($row->department == 2){
                                                $department = 'MS Scaffolding';
                                            }elseif($row->department == 3){
                                                $department = 'Aluminum Formwork';
                                            }*/
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td title="<?php echo cc($row->name); ?>"><?php echo limit_word(cc($row->name)); ?></td>
                                                <td><?php echo $machine_text;?></td>
                                                <td><?php echo value_by_id('tbldivisionmaster',$row->department,'title'); ?></td>
                                                <td><?php echo $toggleActive;?></td>
                                                <td><?php echo _d($row->created_at);?></td>
                                                <td class="text-center">
                                                <?php if(check_permission_page(411,'edit')){ ?>    
                                                  <a href="<?php echo admin_url('production_department/addoperationmaster/'.$row->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                                  <?php 
                                                }
                                                if(check_permission_page(411,'delete')){
                                                ?>    
                                                  <a href="<?php echo admin_url('production_department/delete_operationmaster/'.$row->id); ?>" class="btn btn-danger btn-xs _delete">Delete</a>  
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
