<?php init_head(); ?>



<div id="wrapper">

    <div class="content accounting-template">

         <div class="row">



            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'othercollection_form', 'class' => 'othercollection-form')); ?>

            <div class="col-md-12">

                <div class="panel_s">



                    <div class="panel-body">



                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title;?></h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('report/client_othercollection'); ?>" class="btn btn-info">Add Client Other Collection</a>
                        </div>
                    </div>



                    <hr class="hr-panel-heading">



                    <div class="row">

                    

                                                

                    <div class="col-md-12 table-responsive"> 

                            

                        <div>                                                    

                        <table class="table" id="newtable">

                            <thead>

                              <tr>

                                <th>S.No</th>

                                <th>Name</th>

                                <th>Date</th>

                                <th class="text-center">Action</th>

                              </tr>

                            </thead>

                            <tbody>

                            <?php

                            if(!empty($othercollection_data)){



                                foreach ($othercollection_data as $key => $value) {



                                ?>

                                <tr>

                                    <td><?php echo ++$key; ?></td>                                                

                                    <td><?php echo $value->name; ?></td>

                                    <td><?php echo _d($value->created_at); ?></td>

                                    <td class="text-center">
                                        <a href="<?php echo admin_url('report/client_othercollection/'.$value->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                        <a href="<?php echo admin_url('report/delete_client_othercollection/'.$value->id); ?>" class="btn btn-danger btn-xs _delete">Delete</a>
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



