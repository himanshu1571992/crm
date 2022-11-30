<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('complain_types'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title; ?> </h4>
                                </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <?php if(check_permission_page(342,'create')){?>
                                        <a href="#" class="btn btn-info pull-right add-model" data-toggle="modal" data-target="#addModal" style="margin-top:-6px; "> Add New Complain Types</a>
                                    <?php } ?>
                                </div>
                            </div>                   

                            <hr class="hr-panel-heading">

                            <div class="row">

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($f_date) && $f_date != "") ? $f_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($t_date) && $t_date != "") ? $t_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>


                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Added By</th>
                                                <th>Title</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($complaintypes_list)) {
                                                foreach ($complaintypes_list as $k => $row) {
                                                    
                                                    if ($row->status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning btn-xs';
                                                    } elseif ($row->status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success btn-xs';
                                                    } elseif ($row->status == 2) {
                                                        $status = 'Rejected';
                                                        $cls = 'btn-danger btn-xs';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$k; ?></td>
                                                        <td><?php echo ($row->added_by > 0) ? get_employee_fullname($row->added_by) : 'N/A'; ?></td>
                                                        <td><?php echo cc($row->title); ?></td>
                                                        <td><?php echo ($row->created_on != '0000-00-00 00:00:00') ? _d($row->created_on) : '--'; ?></td>
                                                        <td><?php echo "<span class='".$cls."'>".$status."</span>"?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                            <?php if(check_permission_page(342,'edit')){?>
                                                                <a href="#" class="btn-sm btn-primary edit-model" data-title='<?php echo $row->title; ?>' data-id="<?php echo $row->id; ?>" data-toggle="modal" data-target="#addModal" title="Edit Complain Type"><i class="fa fa-edit"></i></a>
                                                            <?php } ?>    
                                                            <?php if(check_permission_page(342,'delete')){?>
                                                                <a href="<?php echo admin_url('complain_types/delete/' . $row->id); ?>" class="btn-sm btn-danger _delete"  title="Delete Complain Type"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>    
                                                            </div>
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





                            <div class="btn-bottom-toolbar text-right">

                            </div>

                            <!-- Tracks used in this music/audio player application are free to use. I downloaded them from Soundcloud and NCS websites. I am not the owner of these tracks. -->



                        </div>

                    </div>
                </div>

            </form>
        </div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Complain Type</h4>
            </div>
            <?php
                $attributes = array('id' => 'complain_types_form');
                echo form_open(admin_url("complain_types/add"), $attributes);
            ?>
            <div class="modal-body" id="approval_html">
                <div class="form-group ">
                    <label for="source" class="control-label">Title</label>
                    <input type="text" id="title" required="" class="form-control" value="" name="title">
                    <input type="hidden" id="comp_type_id" class="form-control" value="" name="comp_type_id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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

    $(document).ready(function () {
        $('#newtable').DataTable({
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>

<script type="text/javascript">
    $('.edit-model').click(function(){
        var comp_type_id = $(this).data("id");  
        var title = $(this).data("title");
        $("#title").val(title);
        $("#comp_type_id").val(comp_type_id);
        $(".modal-title").val("Edit Complain Type");
    });
</script>
<script type="text/javascript">
    $('.add-model').click(function(){
        $("#comp_type_id").val("");
        $("#title").val("");
        $(".modal-title").val("Add Complain Type");
    });
</script>

</body>
</html>
