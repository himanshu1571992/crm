<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'subhead_form', 'class' => 'subhead-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?>
                        <?php if (check_permission_page(327,'create')){ ?>
                        <a href="<?php echo admin_url('company_expense/subhead_master'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Sub Head</a>
                        <?php } ?>
                    </h4>

                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group" id="head_id">
                            <label for="branch_id" class="control-label">Head</label>
                            <select class="form-control" id="head_id" name="head_id">
                                <option value="" selected=" disabled ">--Select One--</option>
                                <?php
                                if(!empty($head_info)){
                                    foreach ($head_info as $key => $value) {
                                       ?>                                               
                                         <option value="<?php echo $value->id; ?>" <?php if(!empty($shead_id) && $shead_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                       <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        </div>

                        
                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                        <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                        <div class="col-md-12 table-responsive">
                            <hr>
                            <div>
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Head ID</th>
                                            <th>Head</th>
                                            <th>Sub Head ID</th>
                                            <th>Sub Head</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if(!empty($subheadmaster_info)){

                                    foreach ($subheadmaster_info as $key => $value) {
                                        
                                           $checked = ($value->status == 1 ) ? 'checked' : '';
                                           $toggleActive = '<div class="onoffswitch">
                                                    <input type="checkbox" data-switch-url="' . admin_url() . 'company_expense/change_subhead_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                                                    <label class="onoffswitch-label" for="' . $value->id . '"></label>
                                                </div>';

                                        ?>

                                    <tr>
                                        <td><?php echo ++$key; ?></td>
                                        <td>
                                            <?php echo get_creator_info($value->added_by, $value->created_at); ?>
                                            <?php echo "H-" . str_pad($value->head_id, 4, '0', STR_PAD_LEFT); ?>
                                        </td>
                                        <td><?php echo cc(value_by_id('tblheads',$value->head_id,'name')); ?></td>
                                        <td><?php echo "SH-" . str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                        <td><?php echo cc($value->name); ?></td>
                                        <td class="text-center"><?php echo $toggleActive; ?></td>
                                        <td class="text-center">
                                        <?php if (check_permission_page(327,'edit')){ ?>
                                          <a href="<?php echo admin_url('company_expense/subhead_master/'.$value->id); ?>" class="btn-sm btn-primary" title="Edit">Edit</a>
                                        <?php }else{ echo '--';} ?>  
                                        <?php if (check_permission_page(327,'delete')){ ?>
                                          <a href="<?php echo admin_url('company_expense/delete_subhead_master/'.$value->id); ?>" class="btn-sm btn-danger _delete" title="Edit">Delete</a>
                                        <?php }else{ echo '--';} ?>  
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

                    columns: [ 0, 1, 2]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2]

                }

            },

            'colvis',

        ]

    } );

} );


</script>



</body>

</html>



