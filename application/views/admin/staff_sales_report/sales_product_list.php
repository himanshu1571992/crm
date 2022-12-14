<?php init_head(); ?>



<div id="wrapper">

    <div class="content accounting-template">

         <div class="row">



            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'sales_product', 'class' => 'sales_product-form')); ?>

            <div class="col-md-12">

                <div class="panel_s">



                    <div class="panel-body">



                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title;?></h4>
                        </div>
                        <?php if(check_permission_page(317,'create')){?>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('staffSalesReport/sales_product'); ?>" class="btn btn-info">Add Sales Product</a>
                        </div>
                        <?php } ?>
                    </div>



                    <hr class="hr-panel-heading">



                    <div class="row">

                    

                                                

                    <div class="col-md-12 table-responsive"> 

                            

                        <div>                                                    

                        <table class="table" id="newtable">

                            <thead>

                              <tr>

                                <th>S.No</th>

                                <th>Product Name</th>

                                <th>Description</th>

                                <th>Date</th>

                                <th>status</th>

                                <th class="text-center">Action</th>

                              </tr>

                            </thead>

                            <tbody>

                            <?php

                            if(!empty($sales_product_data)){



                                foreach ($sales_product_data as $key => $value) {

                                   $checked = ($value->status == 1 ) ? 'checked' : '';
                                   $toggleActive = '<div class="onoffswitch">
                                            <input type="checkbox" data-switch-url="' . admin_url() . 'staffSalesReport/change_sales_product_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                                            <label class="onoffswitch-label" for="' . $value->id . '"></label>
                                        </div>';
                                ?>

                                <tr>

                                    <td><?php echo ++$key; ?></td>                                                

                                    <td>
                                        <?php echo get_creator_info($value->added_by, $value->created_at); ?>
                                        <?php echo cc($value->product_name); ?>
                                    </td>

                                    <td><?php echo cc($value->description); ?></td>

                                    <td><?php echo _d($value->created_at); ?></td>

                                    <td><?php echo $toggleActive; ?></td>

                                    <td class="text-center">
                                    <?php if(check_permission_page(317,'edit')){ ?>
                                        <a href="<?php echo admin_url('staffSalesReport/sales_product/'.$value->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                    <?php }
                                            if(check_permission_page(317,'delete')){ ?>
                                        <a href="<?php echo admin_url('staffSalesReport/delete_sales_product/'.$value->id); ?>" class="btn btn-danger btn-xs _delete">Delete</a>
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

                    columns: [ 0, 1, 2, 3, 4 ]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 4 ]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4 ]

                }

            },

            'colvis',

        ]

    } );

} );


</script>



</body>

</html>



