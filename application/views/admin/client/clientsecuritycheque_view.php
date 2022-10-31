<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'client_form', 'class' => 'client-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('client/clientsecuritycheue'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Add Client Security Cheque</a>
                            </div>
                        </div>



                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="vendor_id" class="control-label">Select Client</label>
                            <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                            <option value=""></option>
                            <?php
                            if (isset($client_data) && count($client_data) > 0) {
                                foreach ($client_data as $client_key => $client_value) {
                                    ?>
                                    <option value="<?php echo $client_value['userid'] ?>" <?php if(!empty($client_id) && $client_id == $client_value['userid']){ echo 'selected';} ?>><?php echo cc($client_value['client_branch_name']); ?>
                                    <?php
                                }
                            }
                            ?>
                            </select>
                        </div>
                    <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                    </div>
                    

                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Client Name</th>
                                            <th class="text-center">Cheque Amount</th>
                                            <th class="text-center">Cheque Number</th>
                                            <th class="text-center">Cheque Date</th>
                                            <th class="text-center">Cheque Image</th>
                                            <th class="text-center">Return Image</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if(!empty($securitycheque_info)){

                                    foreach ($securitycheque_info as $key => $value) {
                                        
                                           if($value->return_type == 1){
                                                $status = 'Returned';
                                                $cls = 'btn-success';
                                            }elseif($value->return_type == 2){
                                                $status = 'Cancelled';
                                                $cls = 'btn-danger';
                                            }
                                            elseif($value->return_type == 0)
                                            {
                                                $status = '----';
                                            }

                                    $client_info = $this->db->query("SELECT * from tblclientbranch WHERE userid = '".$value->client_id."' ")->row();
                                        ?>
                                    
                                    <tr>
                                        <td class="text-center">
                                            <?php echo ++$key; ?>
                                            
                                        </td>
                                        <td>
                                            <?php echo get_creator_info($value->added_by, $value->created_date); ?>
                                            <?php echo cc($client_info->client_branch_name); ?>
                                        </td>
                                        <td class="text-center"><?php echo $value->cheque_amount; ?></td>
                                        <td class="text-center"><?php echo $value->cheque_number; ?></td>
                                        <td class="text-center"><?php if($value->cheque_date == null){
                                            echo '---';
                                        } 
                                        else {
                                        echo _d($value->cheque_date);
                                         } ?></td>
                                        <td class="text-center"><?php if (isset($value->cheque_image) && $value->cheque_image != "") { ?>
                                        <a target="_blank" href="<?php echo base_url('uploads/client_security_cheque/'.$value->id.'/'.$value->cheque_image); ?>">
                                        <img src="<?php echo base_url('uploads/client_security_cheque') . "/" . $value->id . "/" . $value->cheque_image ?>" style="width: 50px; height: 50px;">
                                        </a>
                                        <?php
                                        } else {
                                            echo '---';
                                        }
                                        ?></td>
                                        <td class="text-center"><?php if (isset($value->return_image) && $value->return_image != "") { ?>
                                        <a target="_blank" href="<?php echo base_url('uploads/client_security_cheque/courier_return/'.$value->id.'/'.$value->return_image); ?>">
                                        <img src="<?php echo base_url('uploads/client_security_cheque/courier_return') . "/" . $value->id . "/" . $value->return_image ?>" style="width: 50px; height: 50px;">
                                        </a>
                                        <?php
                                        } else {
                                            echo '---';
                                        }
                                        ?></td>
                                        <td class="text-center"><?php 
                                         if($value->return_type == 0){
                                            echo "---";
                                         }
                                         else
                                         { 
                                            echo '<button disabled class="btn-sm '.$cls.'">'.$status.'</button>';
                                         }
                                         
                                        ?></td>
                                        <td class="text-center">
                                          <div class="btn-group">
                                              <a href="<?php echo admin_url('client/clientsecuritycheue/'.$value->id); ?>" class="btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                          <a href="<?php echo admin_url('client/return_clientsecuritycheue/'.$value->id); ?>" class="btn-sm btn-primary" title="Edit"><i class="fas fa-undo-alt"></i></a>
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
<script src="https://kit.fontawesome.com/02cb9ab8ae.js" crossorigin="anonymous"></script>
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


</script>



</body>

</html>



