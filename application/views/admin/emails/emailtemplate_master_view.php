<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'client_form', 'class' => 'client-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <?php if(check_permission_page(111,'create')){ ?>
                                <a href="<?php echo admin_url('emails/emailtemplate_master'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Add Email Template</a>
                                <?php } ?>
                            </div>
                        </div>



                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="vendor_id" class="control-label">Select Email Module</label>
                            <select class="form-control selectpicker" id="module_id" name="module_id" data-live-search="true">
                            <option value=""></option>
                            <?php
                            if (isset($emailmodules_data) && count($emailmodules_data) > 0) {
                            foreach ($emailmodules_data as $emailmodules_key => $emailmodules_value) {
                                ?>
                                 <option value="<?php echo $emailmodules_value['id'] ?>" <?php if(!empty($module_id) && $module_id == $emailmodules_value['id']){ echo 'selected';} ?>><?php echo cc($emailmodules_value['name']); ?></option>
                             <?php
                                }
                            }
                            ?>
                            </select>
                        </div>
                    <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                    </div>
                    

                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <div>
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Module Name</th>
                                            <th class="text-center">Template Name</th>
                                            <th class="text-center">Subject</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if(!empty($emailtemplate_data)){

                                    foreach ($emailtemplate_data as $key => $value) {
                                     
                                       $checked = ($value->status == 1 ) ? 'checked' : '';
                                       $toggleActive = '<div class="onoffswitch">
                                                <input type="checkbox" data-switch-url="' . admin_url() . 'emails/change_emailtemplate_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                                                <label class="onoffswitch-label" for="' . $value->id . '"></label>
                                            </div>';
                                        ?>
                                    
                                    <tr>
                                        <td class="text-center"><?php echo ++$key; ?></td>
                                        <td class="text-center"><?php echo value_by_id('tblemailmodulemasters',$value->module_id,'name'); ?></td>
                                        <td class="text-center"><?php echo $value->template_name; ?></td>
                                        <td class="text-center"><?php echo $value->subject; ?></td>
                                        <td><?php echo _d($value->created_at); ?></td>
                                        <td><?php echo $toggleActive; ?></td>
                                        <td class="text-center">
                                        <?php if(check_permission_page(111,'edit')){ ?>
                                        <a href="<?php echo admin_url('emails/emailtemplate_master/'.$value->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                        <?php 
                                        }
                                        if(check_permission_page(111,'delete')){ ?>
                                        <a href="<?php echo admin_url('emails/delete_emailtemplate_master/'.$value->id); ?>" class="btn btn-danger btn-xs _delete">Delete</a>
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
<script src="https://kit.fontawesome.com/02cb9ab8ae.js" crossorigin="anonymous"></script>
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



