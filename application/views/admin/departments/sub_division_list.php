<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'department_form', 'class' => 'department-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('departments/add_subdivision'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Sub Division</a>
                            </div>
                        </div>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="">
                            <div class="col-md-12 table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>Title</th>
                                        <th>Division</th>
                                        <th>Status</th>
                                        <th>DateTime</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($division_list)){
                                        $i=1;
                                        foreach($division_list as $row){
                                            $checked = ($row->status == 1 ) ? 'checked' : '';
                                            $toggleActive = '<div class="onoffswitch">
                                                <input type="checkbox" data-switch-url="' . admin_url() . 'departments/change_subdivision_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $row->id . '" data-id="' . $row->id . '" ' . $checked . '>
                                                <label class="onoffswitch-label" for="' . $row->id . '"></label>
                                            </div>';


                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo ($row->added_by > 0) ? '<span class="badge badge-info">'.get_employee_fullname($row->added_by).'</span>' : '--'; ?></td>
                                                <td><?php echo cc($row->title); ?></td>
                                                <td><?php echo value_by_id("tbldivisionmaster", $row->division_id, "title"); ?></td>
                                                <td><?php echo $toggleActive;?></td>
                                                <td><?php echo _d($row->created_at);?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo admin_url('departments/add_subdivision/'.$row->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                                    <a href="<?php echo admin_url('departments/delete_subdivisionmaster/'.$row->id); ?>" class="btn btn-danger btn-xs _delete">Delete</a>
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
