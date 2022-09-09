<?php

$session_id = $this->session->userdata();
?>
<?php init_head(); ?>
<style type="text/css">
  .button3 {background-color: #800000;}
</style>
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
            <li role="presentation" class="<?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>"><a  href="#pending_cheque" aria-controls="pending_cheque" role="tab" data-toggle="tab">Pending Cheque</a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>"><a href="#cleared_cheque" aria-controls="cleared_cheque" role="tab" data-toggle="tab">Cleared Cheque</a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 3) ? 'active' : ''; ?>"><a href="#cancelled_cheque" aria-controls="cancelled_cheque" role="tab" data-toggle="tab">Cancelled Cheque</a></li>
            
            
          </ul>
          <div class="tab-content">


            <div role="tabpanel" class="tab-pane <?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>" id="pending_cheque">
              <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="1" name="from_page">
              <div class="row">

              <div class="col-md-3">
                <label for="f_date" class="control-label">From Date</label>
                <div class="input-group date"> 
                    <input id="f_date"  name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>

              <div class="col-md-3">
                <label for="t_date" class="control-label">To Date</label>
                <div class="input-group date">                          
                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>
              </form>


            <div class="table-responsive" style="margin-bottom:30px;">
              <table class="table newtable" id="payfill_table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Category Name</th>
                            <th>payee Name</th>
                            <th>Cheque Number</th>
                            <th>Remark</th> 
                            <th>Payment Date</th>                                       
                            <th>Payment Amount</th> 
                            <th>Action Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php
                
                $i=1;
                if(!empty($pending_cheque)){              
                      foreach ($pending_cheque as $row) { 
                       
                       if($row->category_id == 1){
                          
                          $payee_info = $this->db->query("SELECT * FROM `tblstaff` where staffid = '".$row->payee_id."' ")->row();
                          $payee_name = $payee_info->firstname;
                            }

                       elseif($row->category_id == 2){

                          $payee_name = value_by_id('tblvendor',$row->payee_id,'name');
                            }

                      else{
                          
                          $payee_name = value_by_id('tblcompanyexpenseparties',$row->payee_id,'name'); 
                            }        
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo value_by_id('tblcompanyexpensecatergory',$row->category_id,'name'); ?></td>
                        <td><?php echo $payee_name; ?></td>
                        <td><?php echo $row->utr_no; ?></td>
                        <td><?php echo $row->first_remark; ?></td>
                        <td><?php echo _d($row->date); ?></td>
                        <td><?php echo $row->amount; ?></td>
                        <td><?php if($row->chaque_clear_date != '')
                        {
                          echo _d($row->chaque_clear_date);
                        } else { echo "---";}  ?></td>
                        <td><?php if($row->chaque_status == 0){
                            $cls = 'btn-warning';
                            echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">Pending</button>';
                          }elseif($row->chaque_status == 2){
                            $cls = 'btn-primary';
                            echo '<button type="button" class="'.$cls.' btn-sm status button3" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">Bounced</button>';
                          }elseif($row->chaque_status == 3){
                            $cls = 'btn-info';
                            echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">Redeposit</button>';
                          } ?></td>                     
                      </tr> 
        
                       <?php
                    }                      
                }                

                ?>
                </tbody>                             
               </table>
             </div>
           </div>



          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>" id="cleared_cheque">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="2" name="from_page">
              <div class="row">

              <div class="col-md-3">
                <label for="f_date1" class="control-label">From Date</label>
                <div class="input-group date"> 
                    <input id="f_date1"  name="f_date1" class="form-control datepicker" value="<?php if(!empty($f_date1)){ echo $f_date1; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>

              <div class="col-md-3">
                <label for="t_date1" class="control-label">To Date</label>
                <div class="input-group date">                          
                    <input id="t_date1" name="t_date1" class="form-control datepicker" value="<?php if(!empty($t_date1)){ echo $t_date1; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>
              

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>
              </form>

            <div class="table-responsive" style="margin-bottom:30px;">
              <table class="table newtable" id="">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Category Name</th>
                            <th>payee Name</th>
                            <th>Cheque Number</th>
                            <th>Remark</th> 
                            <th>Payment Date</th>                                       
                            <th>Payment Amount</th> 
                            <th>Action Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php
                
                $i=1;
                if(!empty($cleared_cheque)){              
                      foreach ($cleared_cheque as $row) { 
                      
                      if($row->category_id == 1){ 
                        
                      $payee_info1 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '".$row->payee_id."' ")->row();
                          $payee_name1 = $payee_info1->firstname;
                            }

                       elseif($row->category_id == 2){

                          $payee_name1 = value_by_id('tblvendor',$row->payee_id,'name');
                            }

                      else{
                          
                          $payee_name1 = value_by_id('tblcompanyexpenseparties',$row->payee_id,'name'); 
                            }        
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo value_by_id('tblcompanyexpensecatergory',$row->category_id,'name'); ?></td>
                        <td><?php echo $payee_name1; ?></td>
                        <td><?php echo $row->utr_no; ?></td>
                        <td><?php echo $row->first_remark; ?></td>
                        <td><?php echo _d($row->date); ?></td>
                        <td><?php echo $row->amount; ?></td>
                        <td><?php if($row->chaque_clear_date != '')
                        {
                          echo _d($row->chaque_clear_date);
                        } else { echo "---";}  ?></td>
                        <td><?php if($row->chaque_status == 1){
                            $cls = 'btn-success';
                            echo '<button type="button" class="'.$cls.' btn-sm status1" value="'.$row->id.'" data-toggle="modal" data-target="#myModal1">Cleared</button>';
                          } ?></td>                     
                      </tr> 
        
                       <?php
                    }                      
                }                

                ?>
                </tbody>                             
               </table>
             </div>
          </div>


          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 3) ? 'active' : ''; ?>" id="cancelled_cheque">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="3" name="from_page">
              <div class="row">

              <div class="col-md-3">
                <label for="f_date2" class="control-label">From Date</label>
                <div class="input-group date"> 
                    <input id="f_date2"  name="f_date2" class="form-control datepicker" value="<?php if(!empty($f_date2)){ echo $f_date2; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>

              <div class="col-md-3">
                <label for="t_date2" class="control-label">To Date</label>
                <div class="input-group date">                          
                    <input id="t_date2" name="t_date2" class="form-control datepicker" value="<?php if(!empty($t_date2)){ echo $t_date2; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>
              </form>

            <div class="table-responsive" style="margin-bottom:30px;">
              <table class="table newtable" id="">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Category Name</th>
                            <th>payee Name</th>
                            <th>Cheque Number</th>
                            <th>Remark</th> 
                            <th>Payment Date</th>                                       
                            <th>Payment Amount</th> 
                            <th>Action Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php
                
                $i=1;
                if(!empty($cancelled_cheque)){              
                      foreach ($cancelled_cheque as $row) { 
                      
                      if($row->category_id == 1){

                      $payee_info2 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '".$row->payee_id."' ")->row();
                          $payee_name2 = $payee_info2->firstname;
                            }

                       elseif($row->category_id == 2){

                          $payee_name2 = value_by_id('tblvendor',$row->payee_id,'name');
                            }

                      else{
                          
                          $payee_name2 = value_by_id('tblcompanyexpenseparties',$row->payee_id,'name'); 
                            }       
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo value_by_id('tblcompanyexpensecatergory',$row->category_id,'name'); ?></td>
                        <td><?php echo $payee_name2; ?></td>
                        <td><?php echo $row->utr_no; ?></td>
                        <td><?php echo $row->first_remark; ?></td>
                        <td><?php echo _d($row->date); ?></td>
                        <td><?php echo $row->amount; ?></td>
                        <td><?php if($row->chaque_clear_date != '')
                        {
                          echo _d($row->chaque_clear_date);
                        } else { echo "---";}  ?></td>
                        <td><?php if($row->chaque_status == 4){
                            $cls = 'btn-danger';
                            echo '<button type="button" class="'.$cls.' btn-sm status2" value="'.$row->id.'" data-toggle="modal" data-target="#myModal2">Cancelled</button>';
                          } ?></td>                     
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
        <h4 class="modal-title">Cheque Status Details</h4>
      </div>
      <div class="modal-body">
        <div id="approval_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cheque Status Details</h4>
      </div>
      <div class="modal-body">
        <div id="approval_html1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cheque Status Details</h4>
      </div>
      <div class="modal-body">
        <div id="approval_html2"></div>
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
  $('.status').click(function(){
  var id = $(this).val(); 
  
    $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/manage_cheque/pending_vendor_status'); ?>",
      data    : {'id' : id},
      success : function(response){
        if(response != ''){
          $("#approval_html").html(response);
          $('.date_picker').datepicker();
        }
      }
    })
  });
</script>

<script type="text/javascript">
  $('.status1').click(function(){
  var id = $(this).val();
  
    $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/manage_cheque/cleared_vendor_status'); ?>",
      data    : {'id' : id},
      success : function(response){
        if(response != ''){
          $("#approval_html1").html(response);
          $('.date_picker1').datepicker();
        }
      }
    })
  });
</script>

<script type="text/javascript">
  $('.status2').click(function(){
  var id = $(this).val();
  
    $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/manage_cheque/cancelled_vendor_status'); ?>",
      data    : {'id' : id},
      success : function(response){
        if(response != ''){
          $("#approval_html2").html(response);
          $('.date_picker2').datepicker();
        }
      }
    })
  });
</script>

</html>
