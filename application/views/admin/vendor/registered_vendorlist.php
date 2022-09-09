<?php init_head(); ?>



<div id="wrapper">

    <div class="content accounting-template">

         <div class="row">



            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>

            <div class="col-md-12">

                <div class="panel_s">



                    <div class="panel-body">



                    <div class="row panelHead">

                        <div class="col-xs-12 col-md-6">

                            <h4><?php echo $title; ?></h4>

                        </div>

                        <div class="col-xs-12 col-md-6 text-right">

                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#whatsappModal"><i class="fa fa-whatsapp" aria-hidden="true"></i> Send Whatsapp</button>

                        

                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#emailModal"><i class="fa fa-envelope-o" aria-hidden="true"></i> Send Email</button>

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

                                <th>Vendor Name</th>

                                <th>Contact Number</th>

                                <th>Email Id</th>

                                <th>GST</th>

                                <th>Business Type</th>

                                <th class="text-center">Action</th>

                              </tr>

                            </thead>

                            <tbody>

                            <?php

                            if(!empty($vendor_list)){



                                foreach ($vendor_list as $key => $value) {



                                ?>

                                <tr>

                                    <td><?php echo ++$key; ?></td>                                                

                                    <td><?php echo $value->vendor_name; ?></td>

                                    <td><?php echo $value->contact_no; ?></td>

                                    <td><?php echo $value->email_id; ?></td>

                                    <td><?php echo $value->gst_no; ?></td>

                                    <td><?php echo value_by_id('tblbusinesstype',$value->business_type,'name'); ?></td>

                                    <td class="text-center">

                                        <?php

                                        if($value->status == 0){

                                        ?>

                                            <button type="button" value="<?php echo $value->id; ?>" id="reg_vendor" class="btn-sm btn-success" data-toggle="modal" data-target="#approvalModal">Make Vendor</button>

                                        <?php    

                                        }

                                        ?>

                                        

                                        <a href="<?php echo site_url('vendor/vendor_pdf/'.$value->id); ?>" target="_blank" class="btn-sm btn-info">PDF</a>

                                      <div class="btn-group pull-right">

                                             <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>

                                             </button>

                                             <ul class="dropdown-menu dropdown-menu-right toggle-menu">

                                                <li>

                                                  <a href="<?php echo site_url('vendor/vendor_print/'.$value->id); ?>" target="_blank" class="actionBtn" title="PRINT"><i class="fa fa-print" aria-hidden="true"></i></a>                                                  

                                                  <a href="<?php echo admin_url('vendor/registeredvender_edit/'.$value->id); ?>" class="actionBtn" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                  <a href="<?php echo admin_url('vendor/vendor_view/'.$value->id); ?>" class="actionBtn" title="VIEW"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                  

                                                </li>

                                             </ul>

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

                        

                        </div>

                       

                    </div>

                </div>

             

            <?php echo form_close(); ?>

        </div>      

        <div class="btn-bottom-pusher"></div>

    </div>

</div>

</div> 

<!-- Email Modal -->

<div id="emailModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Send Registration link to vendor via email</h4>

      </div>

      <div class="modal-body">

        <form  action="<?php echo admin_url('vendor/registration_email'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <div class="row">

                <div class="form-group col-md-12">

                    <label for="email" class="control-label">Vendor Email <span style="color: red;">*</span></label>

                    <input type="text" id="email" name="email" class="form-control" required="" value="">

                </div>

                <div class="form-group col-md-12">

                    <label for="subject" class="control-label">Subject <span style="color: red;">*</span></label>

                    <input type="text" id="subject" name="subject" class="form-control" required="" value="Vendor Registration">

                </div>

                                                                                

                <div class="form-group col-md-12">

                    <label for="name" class="control-label">Email Body <span style="color: red;">*</span></label>

                    <textarea class="form-control tinymce " required="" name="message" id="message">

                        <h3>Welcome to SCHACH ENGINEERS PVT. LTD.</h3>

                        <p>Click On below link to register yourself as a vendor of SCHACH ENGINEERS PVT. LTD. </p>

                        <p><a href="#link#">Click for Registration</a></p>

                    </textarea>

                </div>



                <div class="form-group col-md-12">

                    <button class="btn btn-info" type="submit">Send Email</button>

                </div>

        </div>

        </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>

<!-- whatsapp Modal -->

<div id="whatsappModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Send Registration link to vendor via Whatsapp</h4>

      </div>

      <div class="modal-body">

        <form  action="<?php echo admin_url('vendor/registered_whatsapp'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <div class="row">

                <div class="form-group col-md-12">

                    <label for="phone" class="control-label">Vendor Mobile No. <span style="color: red;">*</span></label>

                    <input type="text" id="phone" name="phone" class="form-control" required="" value="+91">

                </div>

                                                                                

                <div class="form-group col-md-12">

                    <label for="name" class="control-label">Message Body <span style="color: red;">*</span></label>

                    <textarea class="form-control tinymce " required="" name="message" id="message">

                        Welcome to SCHACH ENGINEERS PVT. LTD.

                        Click On below link to register yourself as a vendor of SCHACH ENGINEERS PVT. LTD.

                       Click for Registration -

                    </textarea>

                </div>



                <div class="form-group col-md-12">

                    <button class="btn btn-info" type="submit">Send Whatsapp</button>

                </div>

        </div>

        </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>



<div id="approvalModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Make a new Vendor</h4>

      </div>

      <div class="modal-body">

        <form  action="<?php echo admin_url('vendor/make_vedor'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <div class="row">

                                                                                              

                <div class="form-group col-md-12">

                    <label for="name" class="control-label">Remark <span style="color: red;">*</span></label>

                    <textarea class="form-control " required="" name="remark" id="remark"></textarea>

                </div>

                <input type="hidden" id="vendor_id" name="vendor_id">

                <div class="form-group col-md-12">

                    <button class="btn btn-info" type="submit">Make Vendor</button>

                </div>

        </div>

        </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

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



$(document).on('click', '#reg_vendor', function() {  

    var vendor_id = $(this).val();

    $('#vendor_id').val(vendor_id);



});

</script>



</body>

</html>



