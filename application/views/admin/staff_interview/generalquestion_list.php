
<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'department_form', 'class' => 'department-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?>  
                        <?php if(check_permission_page(388,'create')){?>
                        <a class="pull-right btn btn-info" href="<?php echo admin_url('staff_interview/addGeneralQuestion');?>"><i class="fa fa-plus"></i> Add General Question</a>
                        <?php } ?>
                    </h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="f_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="t_date" class="control-label">To Date</label>
                                        <div class="input-group date">
                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" style="margin-top: 26px;">
                                        <button type="submit" class="btn btn-info">Search</button>
                                        <a class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="col-md-12">
                                <hr>
                                <div class="table-responsive">
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Question</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($generalquestion_list)) {

                                                    foreach ($generalquestion_list as $key => $value) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo ++$key; ?>
                                                                
                                                            </td>
                                                            <td>
                                                                <?php echo get_creator_info($value->staff_id, $value->created_at); ?>
                                                                <?php echo cc($value->question); ?></td>
                                                            <td><?php echo _d($value->date); ?></td>
                                                            <td><div class="onoffswitch">
                                                                    <input type="checkbox" data-switch-url="<?php echo admin_url('staff_interview/changegeneralquestionStatus'); ?>" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $value->id; ?>" data-id="<?php echo $value->id; ?>" <?php echo ($value->status == 1) ? "checked" : ""; ?>>
                                                                    <label class="onoffswitch-label" for="<?php echo $value->id; ?>"></label>
                                                                </div>
                                                                <span class="hide"><?php echo ($value->status == 1) ? _l('is_active_export') : _l('is_not_active_export'); ?></span>
                                                            </td>
                                                            <td class="text-center">
                                                            <?php if(check_permission_page(388,'edit')){ ?>
                                                                <a class="btn-sm btn-info" href="<?php echo admin_url('staff_interview/addGeneralQuestion/' . $value->id); ?>" data-status="1">Edit</a>
                                                            <?php 
                                                            }
                                                            if(check_permission_page(388,'delete')){ ?>
                                                                <a class="btn-sm btn-danger _delete" href="<?php echo admin_url('staff_interview/deleteGeneralQuestion/' . $value->id); ?>" title="Delete General Question">Delete</a>
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
                    columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            'colvis',
        ]
    } );


} );


</script>
</body>
</html>
