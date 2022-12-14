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
                                <a href="<?php echo admin_url('designation/designationquestion_add'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Add Designation Question</a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="f_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                            <div class="col-md-12 table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th width="1%">S.No</th>
                                            <th width="15%">Date</th>
                                            <th>Designation</th>
                                            <th>Round</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($question_list)) {
                                            $i = 1;
                                            foreach ($question_list as $row) {

                                                $dname = "";
                                                if(!empty($row->designation_ids)){
                                                    $designation = explode(",", $row->designation_ids);
                                                    foreach($designation as $d_id) {
                                                        $dname .= "<span class='btn-sm btn-success'>".value_by_id("tbldesignation", $d_id, "designation")."</span>&nbsp;";
                                                    }
                                                }
                                                $rname = "";
                                                if(!empty($row->designation_ids)){
                                                    $round = explode(",", $row->interview_round);
                                                    foreach($round as $r_id) {
                                                        if($r_id == 1){
                                                            $rname .= "<span class='btn-sm btn-info'>Screening Round</span>&nbsp;";
                                                        }elseif($r_id == 2){
                                                            $rname .= "<span class='btn-sm btn-info'>1st Round</span>&nbsp;";
                                                        }elseif($r_id == 3){
                                                            $rname .= "<span class='btn-sm btn-info'>Final Round</span>&nbsp;";
                                                        }
                                                    }
                                                }

                                        ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo _d($row->date); ?></td>
                                                    <td><?php echo $dname; ?></td>
                                                    <td><?php echo $rname; ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo admin_url('designation/designationquestion_add/' . $row->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                                        <a href="<?php echo admin_url('designation/designationquestion_delete/' . $row->id); ?>" class="btn btn-danger btn-xs _delete">Delete</a>
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
