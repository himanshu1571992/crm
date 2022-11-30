<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'product_form', 'class' => 'product-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <a href="<?php echo admin_url('product_new/product_master'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Add Product Master</a>
                            </div>
                        </div>



                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th >Added By</th>
                                            <th >Name</th>
                                            <th >Status</th>
                                            <th >Created At</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if(!empty($productmaster_info)){

                                    foreach ($productmaster_info as $key => $value) {
                                        
                                           if($value->status == 1){
                                                $status = 'Active';
                                                $cls = 'btn-success';
                                            }elseif($value->status == 0){
                                                $status = 'Inactive';
                                                $cls = 'btn-danger';
                                            }
                                        ?>

                                    <tr>
                                        <td><?php echo ++$key; ?></td>
                                        <td><?php echo ($value->added_by > 0) ? '<span class="badge badge-info">'.get_employee_fullname($value->added_by).'</span>' : 'N/A'; ?></td>
                                        <td><?php echo cc($value->name); ?></td>
                                        <td ><?php echo '<button type="button" class="'.$cls.' btn-sm status">'.$status.'</button>'; ?></td>
                                        <td><?php echo _d($value->created_at); ?></td>
                                        <td class="text-center">
                                          <a href="<?php echo admin_url('product_new/product_master/'.$value->id); ?>" class="btn-sm btn-primary" title="Edit">Edit</a>
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

                    columns: [ 0, 1, 2, 3 ]

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

                    columns: [ 0, 1, 2, 3 ]

                }

            },

            'colvis',

        ]

    } );

} );


</script>



</body>

</html>



