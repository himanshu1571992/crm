<?php

$session_id = $this->session->userdata();
?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
            <h4><?php echo $title; ?></h4>
          <div class="clearfix"></div>
          <hr class="hr-panel-heading" />
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>"><a  href="#limit_not_set" aria-controls="limit_not_set" role="tab" data-toggle="tab">Credit Limit Not Set</a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>"><a href="#limit_set" aria-controls="limit_set" role="tab" data-toggle="tab">Credit Limit Set</a></li>
            
            <!--<li role="presentation"><a href="#phrases" aria-controls="phrases" role="tab" data-toggle="tab">third</a></li>-->
          </ul>
          <div class="tab-content">


            <div role="tabpanel" class="tab-pane <?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>" id="limit_not_set">
              <!-- <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="1" name="from_page">
              <div class="row">

              <div class="form-group col-md-3">
                <label for="status" class="control-label">Select Status</label>
                <select class="form-control selectpicker" id="status" name="status">
                  <option value="" disabled selected >--Select One-</option>
                  <option value="1"<?php echo (isset($status_1) && $status_1 == 1) ? 'selected' : "" ?>>Payfile Pending</option>
                  <option value="2"<?php echo (isset($status_1) && $status_1 == 2) ? 'selected' : "" ?>>Payfile Done</option>
                </select>
              </div>

              <div class="form-group col-md-2" app-field-wrapper="date">
                <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                  <div class="input-group date">
                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
              </div>

               

              <div class="form-group col-md-2" app-field-wrapper="date">
                <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                  <div class="input-group date">
                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text">
                  <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>

              </form> -->


            <div class="table-responsive" style="margin-bottom:30px;">
              <table class="table newtable" id="payfill_table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Client Name</th>                            
                            <th>Activity</th>                                        
                            <th>Contacts</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php

                $i=1;
                if(!empty($clientLimitNotSet)){              
                      foreach ($clientLimitNotSet as $row) { 
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$row->userid)?>" ><?php echo cc($row->client_branch_name); ?></a></td>
                        <td><a target="_blank" href="<?php echo admin_url('follow_up/client_activity/'.$row->userid); ?>">Activity</a></td>
                        <td><a class="text-right" target="_blank" href="<?php echo base_url("admin/follow_up/payment_contact/".$row->userid)?>" class="pull-right text-muted" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></a></td>
                        <td><?php echo '<button type="button" class="btn-info btn-sm show_group" value="'.$row->userid.'" data-toggle="modal" data-target="#myModal">Set Limit</button>';  ?></td>                        
                      </tr> 
        
                       <?php 
                    }                      
                }                

                ?>
                </tbody>                              
               </table>
             </div>
           </div>



          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>" id="limit_set">
            <!-- <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="2" name="from_page">
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="employee_id" class="control-label">Select Employee</label>
                    <select class="form-control selectpicker employee_id" data-live-search="true" id="employee_id" name="employee_id">
                        <option value=""></option>
                        <?php
                        if (isset($employee_info) && count($employee_info) > 0) {
                            foreach ($employee_info as $employee_value) {
                                ?>
                                <option value="<?php echo $employee_value['staffid']; ?>" <?php if(!empty($employee_id) && $employee_id == $employee_value['staffid']){ echo 'selected'; } ?>><?php echo $employee_value['firstname'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>                  

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

            </div>

            </form> -->

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table newtable" >
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Client Name</th>                            
                            <th>Activity</th>                                        
                            <th>Contacts</th>
                            <th>Credit Limit</th>
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php

                $i=1;
                if(!empty($clientLimitSet)){              
                      foreach ($clientLimitSet as $row) { 
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$row->userid)?>" ><?php echo cc($row->client_branch_name); ?></a></td>
                        <td><a target="_blank" href="<?php echo admin_url('follow_up/client_activity/'.$row->userid); ?>">Activity</a></td>
                        <td><a class="text-right" target="_blank" href="<?php echo base_url("admin/follow_up/payment_contact/".$row->userid)?>" class="pull-right text-muted" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></a></td>
                        <td><?php echo $row->credit_limit;  ?></td>                        
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
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set Client Credit Limit</h4>
      </div>
      <div class="modal-body">
        <form  action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
              <div class="form-group col-md-6">
                  <label for="credit_limit" class="control-label">Credit Limit *</label>
                  <input type="text" id="credit_limit" name="credit_limit" class="form-control" required="" value="">
              </div>
              <input type="hidden" id="client_id" name="client_id">
              <div class="form-group col-md-12">
                <button class="btn btn-info" type="submit">Submit</button>
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



$(document).ready(function() {

    $('.newtable').DataTable( {

      

        "iDisplayLength": 25,

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

    } );

} );

</script>

<script type="text/javascript">
  $('.show_group').click(function(){
  var client_id = $(this).val();
  
    $("#client_id").val(client_id);
  });
</script>

</html>
