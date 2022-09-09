<?php init_head(); ?>

<style type="text/css">
.ui-table>thead>tr>th {
    border: 1px solid #9d9d9d !important;
    color: #fff !important;
    background: #6d7580;
}

.ui-table>tbody>tr>td {
    border: 1px solid #c7c7c7;
    color: #5f6670;
}

.ui-table>tbody>tr:nth-child(even) {
    background: #f8f8f8;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title;?> </h4>
                            </div>
                            <div class="col-xs-12 col-md-6">
                            <a class="btn btn-info pull-right" href="<?php echo admin_url('product_new/add_inspection_template'); ?>"><i class="fa fa-plus"></i> Add New Template</a>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <hr>
                                <div class="table-responsive">
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th width="5%" align="center">S.No.</th>
                                                <th width="30%" align="left">Product Template Name</th>
                                                <th align="left" width="15%">Added On</th>
                                                <th align="left" width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($template_list)){
                                                  $z=1;
                                                foreach($template_list as $row){
                                          ?>
                                            <tr>
                                                <td align="center"><?php echo $z++;?></td>
                                                <td><?php echo cc($row->template_name); ?></td>
                                                <td><?php echo _d($row->created_at); ?></td>
                                                <td>
                                                    <a class="btn-sm btn-info" href="<?php echo admin_url('product_new/add_inspection_template/'.$row->id); ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn-sm btn-danger _delete" href="<?php echo admin_url('product_new/inspection_template_delete/'.$row->id); ?>"><i class="fa fa-trash"></i></a>
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>
$(document).ready(function() {
    $('#newtable').DataTable({

        "iDisplayLength": 15,
        dom: 'Bfrtip'
    });
});
</script>
</body>

</html>