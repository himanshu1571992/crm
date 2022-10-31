<?php
init_head();
?>
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="status" class="control-label">Module</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="module_id" name="module_id">
                                        <option value="" ></option>
                                        <?php 
                                        foreach ($module_list as $value) {
                                            $selected = (isset($module_id) && $module_id == $value->id) ? 'selected' : "";
                                            echo '<option value="'.$value->id.'" '.$selected.'>'.cc($value->name).'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status" class="control-label">Tagged To</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="tagged_to" name="tagged_to">
                                        <option value="" ></option>
                                        <?php 
                                        foreach ($staff_list as $value) {
                                            $selected = (isset($tagged_to) && $tagged_to == $value->staffid) ? 'selected' : "";
                                            echo '<option value="'.$value->staffid.'" '.$selected.'>'.cc($value->firstname).'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="col-md-12"> 
                            <hr> 
                            <div class="table-responsive" style="margin-bottom:30px;">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Module</th>
                                            <th>Tagged To</th>
                                            <th>Tagged At</th>
                                            <th width="25%">Message</th>
                                            <th align="center">Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        $i = 1;
                                        if (!empty($activity_tagged_report)) {
                                            foreach ($activity_tagged_report as $key => $row) {
                                                $activitydata = get_activity_tagdata($row->module_id, $row->table_id, $row->activity_id);
                                        ?>        
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo value_by_id("tblcrmmodules", $row->module_id, "name"); ?></td>
                                                    <td><span class="badge badge-info"><?php echo get_employee_fullname($row->tagged_to); ?></span></td>
                                                    <td><?php echo _d($row->created_at); ?></td>
                                                    <td><?php echo $activitydata["message"]; ?></td>
                                                    <td><a href="<?php echo admin_url($activitydata["link"]); ?>" target="_blank" class="btn-sm btn-info"><i class="fa fa-eye"></i></td>
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
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
<?php init_tail(); ?>
</body>
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
            "iDisplayLength": 25,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'

                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis',
            ]
        });
    });
</script>
</html>
