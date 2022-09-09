

<?php init_head(); ?>

<?php

$s_range = '';

$date_a = '';

$date_b = '';

$staff = '';



if(!empty($range)){

  $s_range = $range;

}

if(!empty($f_date)){

  $date_a = $f_date;

}

if(!empty($t_date)){

  $date_b = $t_date;

}

if(!empty($staff_id)){

  $staff = $staff_id;

}

?>

<div id="wrapper" class="customer_profile">

<div class="content">

   <div class="row">

      <div class="col-md-2">

         <div class="panel_s mbot5">

            <div class="panel-body padding-10">

               <h4 class="bold">Master Report</h4>

            </div>

         </div>

         <?php echo master_report_tab('challan');?>

      </div>

      

            <div class="col-md-10">

                <div class="panel_s">

                    <div class="panel-body">



                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  



                   <h4 class="no-margin"><?php echo $title; ?> <!-- <a href="<?php echo admin_url('master_report_export/export_challan?range='.$s_range.'&f_date='.$date_a.'&t_date='.$date_b.'&staff_id='.$staff); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Export</a> --></h4>



          <hr class="hr-panel-heading">

          

          <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">

             <div class="form-group col-md-3">

                  <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">

                      <option value="" selected >--Select Employee-</option>

                      <?php

                      if(!empty($staff_list)){

                          foreach($staff_list as $staff){

                              ?>

                              <option value="<?php echo $staff->staffid;?>" <?php if(!empty($staff_id) && $staff_id == $staff->staffid){ echo 'selected'; } ?>><?php echo cc($staff->firstname); ?></option>

                              <?php

                          }

                      }

                      ?>

                  </select>

              </div>

             <div class="col-md-2">

                <div class="form-group select-placeholder">

                    <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">

                        <option value="1" <?php if(!empty($range) && $range == 1){ echo 'selected'; } ?>>Today</option>

                        <option value="2" <?php if(!empty($range) && $range == 2){ echo 'selected'; } ?>>This Week</option>

                        <option value="3" <?php if(!empty($range) && $range == 3){ echo 'selected'; } ?>>This Month</option>

                        <option value="4" <?php if(!empty($range) && $range == 4){ echo 'selected'; } ?>>Last Month</option>

                        <option value="5" <?php if(!empty($range) && $range == 5){ echo 'selected'; } ?>>This Year</option>

                        <option value="period" <?php if(!empty($range) && $range == 'period'){ echo 'selected'; } ?>>Custom Date</option>

                    </select>

                </div>

               

            </div>

             <div class="col-md-2">

                   <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">

                      <div class="input-group date">

                          <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                      </div>

                  </div>

              </div>

              <div class="col-md-2">

                  <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">

                       <div class="input-group date">

                          <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                      </div>

                  </div>

              </div>

    

            

            <div class="col-md-1">                            
            <button type="submit" class="btn btn-info">Search</button>
            </div>
            <div class="col-md-1">
             <a class="btn btn-danger" href="" style="margin-left: 20px;">Reset</a>
            </div>

            </form>

          <div class="col-md-12">
            <hr>
          </div>

            <div class="col-md-12 table-responsive">  

                <table class="table" id="newtable">

                  <thead>

                    <tr>

                      <th>S.No</th>

                      <th>Challan #</th>

                      <th>Staff Name</th>

                      <th>Service Type</th>

                      <th>Customer</th>

                      <th>Date</th>

                      <th class="text-center">Action</th>

                    </tr>

                  </thead>

                 <tbody>

                  <?php

                  if(!empty($challan_list)){

                      foreach ($challan_list as $key => $value) {



                           $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();



                           $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 1 ")->row();

                           $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 2 ")->row();



                          ?>

                          <tr>

                              <td><?php echo ++$key; ?></td>                                                

                              <td><?php echo '<a target="_blank" href="' . site_url('admin/chalan/view/' . $value->id). '" >' .$value->chalanno. '</a>'; ?></td>

                              <td><?php echo cc(get_employee_name($value->addedfrom)); ?></td>

                              <td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sale'; ?></td>

                              <td><a href="<?php echo admin_url('clients/client/'.$value->clientid); ?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>

                              <td><?php echo _d($value->challandate); ?></td> 

                              <td class="text-center">



                                  <?php

                                  if(!empty($delivery_ho)){

                                      ?>

                                      <button value="<?php echo $value->id; ?>" val="1" type="button" class="btn btn-info handover" data-toggle="modal" data-target="#handover_modal">Delivery HO</button>

                                      <?php

                                  }



                                  if(!empty($pickup_ho)){

                                     ?>

                                     <button value="<?php echo $value->id; ?>" val="2" type="button" class="btn btn-info handover" data-toggle="modal" data-target="#handover_modal">Pickup HO</button>

                                     <?php 

                                  }

                                  ?>



                                  



                                  



                                <?php

                                if($value->process == 0){

                                echo '<button value="'.$value->id.'" title="Make Delivery" type="button" val="1" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Delivery</button>';  

                                }elseif($value->process == 1 && $value->under_process == 1){

                                      echo '<button disabled type="button" class="btn btn-success">Delivery In Process</button>';  

                                  }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 0){

                                      echo '<a href="'.admin_url('chalan/make_complete/'.$delivery_ho->id).'" class="btn btn-success">Mark Delivery Complete</a>';  

                                  }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1 && $value->service_type == 2){

                                      echo '<button type="button" class="btn btn-info">Completed</button>'; 

                                  }

                                  



                                  elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1){

                                  echo '<button value="'.$value->id.'" title="Make Pickup" type="button" val="2" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Pickup</button>';  

                                  }elseif($value->process == 2 && $value->under_process == 1){

                                      echo '<button disabled type="button" class="btn btn-success">Pickup In Process</button>';  

                                  }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 0){

                                      echo '<a href="'.admin_url('chalan/make_complete/'.$pickup_ho->id).'" class="btn btn-success">Mark Pick Complete</a>';  

                                  }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){

                                      echo '<button type="button" class="btn btn-info">Completed</button>';  

                                  }



                                ?>

                                



                                                            

                                  <div class="btn-group pull-right">

                                       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>

                                       </button>

                                       <ul class="dropdown-menu dropdown-menu-right toggle-menu">

                                          <li>

                                                                                                             

                                             <a target="_blank" href="<?php echo admin_url('Chalan/pdf/'.$value->id.'/?output_type=I');?>" data-status="1">View PDF</a>



               <?php

                                             if(check_permission_page(100,'edit')){

                                                  ?>

                                                  <a class="text-danger" href="<?php echo admin_url('chalan/edit_challan/'.$value->id);?>" data-status="1">Edit</a> 

                                              <?php

                                              }

              if(check_permission_page(100,'delete')){

                ?>

                <a class="text-danger _delete" href="<?php echo admin_url('chalan/deletechalan/'.$value->id);?>" data-status="1">DELETE</a> 

              <?php

              }

              ?>



                                              <?php

                                              if(!empty($delivery_ho)){

                                                  ?>

                                                  <a  href="#" class="uplaods" process_id="<?php echo $delivery_ho->id; ?>" val="1" data-toggle="modal" data-target="#upload_modal">Delivery Uploads</a>

                                                  <?php

                                              }

                                              if(!empty($pickup_ho)){

                                                  ?>

                                                  <a  href="#" class="uplaods" process_id="<?php echo $pickup_ho->id; ?>" val="2" data-toggle="modal" data-target="#upload_modal">Pickup Uploads</a>

                                                  <?php

                                              }

                                              ?>

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

   </div>

</div>

</div>







<!-- Modal -->

<div id="deliveryModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title action_title"></h4>

      </div>

      <div class="modal-body">

        <form action="<?php echo admin_url('Chalan/make_delivery'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <div class="row">



          <div class="form-group col-md-6">

                <label for="priority" class="control-label">Priority *</label>

                <select class="form-control selectpicker" name="priority" required="">

                    <option value=""></option>

                    <option value="1">Low</option>

          <option value="2">Medium</option>

          <option value="3">High</option>

          <option value="4">Urgent</option>

                </select>

            </div>



            <div class="form-group col-md-6" app-field-wrapper="date">

                <label for="delivery_date" class="control-label" id="date_type">Delivery Date</label>

                <div class="input-group date">

                    <input id="delivery_date" name="delivery_date" class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

            </div>



            <div class="form-group col-md-12">

                <label for="name" class="control-label">Description </label>

                <textarea id="description" name="description" class="form-control"><?php echo (isset($event['description']) && $event['description'] != "") ? $event['description'] : "" ?></textarea>

            </div>



            <input type="hidden" id="chalan_id" name="chalan_id">

            <input type="hidden" id="for" name="for">

        </div>



        <div class="text-right">

            <button class="btn btn-info" type="submit">Submit</button>

        </div>  



      </form>



      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>



<!-- Modal -->

<div id="handover_modal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title handover_title">Delivery Hand Overs</h4>

      </div>

      <div class="modal-body" id="handover_data">

        

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>



<div id="upload_modal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title upload_title">Delivery Challan Uploads</h4>

      </div>

      <div class="modal-body">

        

        <div id="upload_data">

            

        </div>



        <form action="<?php echo admin_url('Chalan/challan_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">

            <div class="row">



                <div class="form-group col-md-12">

                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>

                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">

                </div>

                

                <input type="hidden" id="process_id" name="process_id">

            </div>



            <div class="text-right">

                <button class="btn btn-info" type="submit">Submit</button>

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

        buttons: [           

            {

                extend: 'excel',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5 ]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 4, 5 ]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5 ]

                }

            },

            'colvis'

        ]

    } );

} );

</script>



</body>

</html>





<script type="text/javascript">

   

$(document).on('click', '.action', function() {

  var challan_id = $(this).val();

  var type = $(this).attr('val');

  $('#chalan_id').val(challan_id); 

  $('#for').val(type); 



    if(type == 1){

        var title = 'Make Challan Delivery';

        var date_type = 'Delivery Date';

    }else{

        var title = 'Make Challan Pickup';

        var date_type = 'Pickup Date';

    }



     $('.action_title').html(title);  

     $('#date_type').html(date_type);  



}); 





$(document).on('click', '.handover', function() {  



    var challan_id = $(this).val(); 

    var type = $(this).attr('val');

    $.ajax({

        type    : "POST",

        url     : "<?php echo site_url('admin/chalan/get_handover_data'); ?>",

        data    : {'challan_id' : challan_id, 'type' : type},

        success : function(response){

            if(response != ''){       



                if(type == 1){

                    var title = 'Delivery Hand Overs';

                }else{

                    var title = 'Pickup Hand Overs';

                }



                 $('.handover_title').html(title);  

                 $('#handover_data').html(response);  

            }

        }

    })



});



$(document).on('click', '.uplaods', function() {  



    var process_id = $(this).attr('process_id');

    var type = $(this).attr('val');



    $('#upload_data').html('');



    $('#process_id').val(process_id); 



    $.ajax({

        type    : "POST",

        url     : "<?php echo site_url('admin/chalan/get_uploads_data'); ?>",

        data    : {'process_id' : process_id},

        success : function(response){

            if(response != ''){       



                if(type == 1){

                    var title = 'Delivery Challan Uploads';

                }else{

                    var title = 'Pickup Challan Uploads';

                }



                 $('.upload_title').html(title);  

                 $('#upload_data').html(response);  

            }

        }

    })



});    

</script>



