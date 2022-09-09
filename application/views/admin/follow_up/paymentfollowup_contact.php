
<?php init_head(); ?>

<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

}

</style>
<?php
$designation_info = $this->db->query("SELECT * from tbldesignation  where status = 1 order by designation asc")->result();    
?>

<div id="wrapper">
    <div class="content accounting-template">
     <div class="row">
        <div class="col-md-12">
            <div class="panel_s">

                <div class="widget" id="widget-user_data" data-name="User Widget">
                       <div class="panel_s user-data">
                          <div class="panel-body home-activity">
                             <div class="horizontal-scrollable-tabs">
                                <div class="scroller scroller-left arrow-left"><i class="fa fa-angle-left"></i></div>
                                <div class="scroller scroller-right arrow-right"><i class="fa fa-angle-right"></i></div>
                                <div class="horizontal-tabs">
                                   <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                                      <li role="presentation" class="active">
                                         <a href="#contact_tab" aria-controls="contact_tab" role="tab" data-toggle="tab">
                                         <i class="fa fa-users menu-icon"></i>Client Contacts </a>
                                      </li>
                                      <li role="presentation">
                                         <a href="#call_history_tab" onclick="init_table_staff_projects(true);" aria-controls="call_history_tab" role="tab" data-toggle="tab">
                                         <i class="fa fa-history menu-icon"></i>Call History</a>
                                      </li>
                                   </ul>
                                   <hr class="hr-panel-heading hr-user-data-tabs" />

                                   <div class="tab-content">
                                     
                                      <div role="tabpanel" class="tab-pane active" id="contact_tab">
                                        <div class="row">

                                           <div class="col-md-12">
                                            <h4 class="no-margin">Contact Person List
                                            <button type="button" data-toggle="modal" data-target="#contactModal"  class="btn btn-info pull-right" >Add New Contact</button></h4>
                                              <table class="table ui-table">
                                                 <thead>
                                                    <tr>
                                                       <th>S.No</th>
                                                       <th>Contact Name</th>
                                                       <th>Contact Number</th>
                                                       <th>Contact Type</th>
                                                       <th>Designation</th>
                                                       <th class="text-center">Make Call</th>
                                                    </tr>
                                                 </thead>
                                                 <tbody>
                                                    <?php
                                                    if(!empty($contact_info)){
                                                        foreach ($contact_info as $key => $value) {
                                                            $contact_type = '--';
                                                            if($value->contact_type == 1){
                                                                $contact_type = 'OFFICE';
                                                            }elseif($value->contact_type == 2){
                                                                $contact_type = 'SITE';    
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$key; ?></td>
                                                                <td><?php echo $value->firstname; ?></td>
                                                                <td><?php echo $value->phonenumber; ?></td>
                                                                <td><?php echo $contact_type; ?></td>
                                                                <td><?php echo value_by_id('tbldesignation',$value->designation_id,'designation'); ?></td>
                                                                <!-- <td class="text-center"><a href="<?php echo admin_url('leads/make_call/'.$value->phonenumber); ?>"><img height="35" width="35" src="<?php echo base_url('assets/images/make_call.png');?>"></a></td> -->
                                                                <td class="text-center"><a class="make_call" val="<?php echo $value->phonenumber; ?>" data-toggle="modal" data-target="#myModal" href="#"><img height="35" width="35" src="<?php echo base_url('assets/images/make_call.png');?>"></a></td>

                                                            </tr>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo '<tr><td class="text-center" colspan="6"><b>Lead Contacts are empty!</b></td></tr>';
                                                    }
                                                    ?>
                                                 </tbody>
                                              </table>
                                           </div>
                                        </div>


                                      </div>

                                      <div role="tabpanel" class="tab-pane" id="call_history_tab">
                                        <div class="row">
                                           <div class="col-md-12">
                                            <h4 class="no-margin">Call History List</h4>
                                              <table class="table ui-table">
                                                 <thead>
                                                    <tr>
                                                       <th>S.No</th>
                                                       <th>Customer Name</th>
                                                       <th>Customer No.</th>
                                                       <th>Date</th>
                                                       <th>Agent No.</th>
                                                       <th class="text-center">Call Type</th>
                                                       <th class="text-center">Recording</th>
                                                    </tr>
                                                 </thead>
                                                 <tbody>
                                                    <?php
                                                    if(!empty($call_history)){
                                                        foreach ($call_history as $k => $row) {
                                                            $customer_name = $this->db->query("SELECT c.firstname from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' and c.phonenumber = '".$row->customer_number."' ")->row()->firstname;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$k; ?></td>
                                                                <td><?php echo (!empty($customer_name)) ? $customer_name : '--'; ?></td>
                                                                <td><?php echo $row->customer_number; ?></td>
                                                                <td><?php echo _d($row->created_at);?></td>
                                                                <td><?php echo $row->agent_number; ?></td>
                                                                <!-- <td class="text-center"><img height="35" width="35" src="<?php if($row->call_status == 'Answered'){ echo base_url('assets/images/calltransfer.png'); }else{ echo base_url('assets/images/misscall.png'); }  ?>"></td> -->

                                                                <td class="text-center"><img height="35" width="35" src="<?php if($row->recording_url != 'NA'){ echo base_url('assets/images/calltransfer.png'); }else{ echo base_url('assets/images/misscall.png'); }  ?>"></td>

                                                                <td class="text-center">
                                                                    <audio controls style="height: 30px;width: 210px;">
                                                                      <source src="<?php echo $row->recording_url; ?>" type="audio/mpeg">
                                                                    </audio>
                                                                </td>
                                                            </tr>    
                                                            <?php
                                                        }
                                                    }else{
                                                        echo '<tr><td class="text-center" colspan="7"><b>Call History are empty!</b></td></tr>';
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

            </div>
        </div>
     </div>
    </div>
</div>

<?php init_tail(); ?>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calling Numbers</h4>
      </div>
       <form  action="<?php echo admin_url('leads/make_call'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="modal-body">

        <div class="form-group">
            <label for="exotel_number" class="control-label">Select Calling Number</label>
            <select class="form-control selectpicker" name="exotel_number" required="" data-live-search="true">
              <option value=""></option>
              <?php
              if (isset($calling_numbes) && count($calling_numbes) > 0) {
                foreach ($calling_numbes as $r) {
                  ?>
                  <option value="<?php echo $r->exotel_number; ?>" ><?php echo $r->exotel_number; ?></option>
                  <?php
                }
              }
              ?>
            </select>

            <input type="hidden" name="customer_number" id="customer_number" >
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" >Make Call</button>
      </div>
    </form>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="contactModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Client Contact</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('follow_up/add_contact'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">

   

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="firstname" class="control-label">Name *</label>
                  <input type="text" name="firstname" class="form-control" value="" required="">
                 </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="phonenumber" class="control-label">Mobile *</label>
                  <input type="text" minlength="10" maxlength="10" name="phonenumber" class="form-control contact1" value="" required=""><span id="phonenumberdiv1"></span>
                 </div>
            </div>


            <div class="form-group col-md-6">
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                  <input type="email" name="email" class="form-control" value="">
                 </div>
            </div>


            <div class="form-group col-md-6">
                <label for="designation_id" class="control-label">Select Designation </label>
                <select class="form-control selectpicker" name="designation_id" >
                    <option value=""></option>
                    <?php
                    if(!empty($designation_info)){
                        foreach ($designation_info as $designation) {
                            ?>
                            <option value="<?php echo $designation->id; ?>"><?php echo $designation->designation; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="id" value="<?php echo $lead_id; ?>">
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


</body>
</html>

<script type="text/javascript">
  $(document).on('click', '.make_call', function() {
  var customer_number = $(this).attr('val');
  $("#customer_number").val(customer_number); 
});  

</script>
<script type="text/javascript">
$(document).ready(function() {
$('.contact1').keyup(function() {
    $('span.error-keyup-3').remove();
    var inputVal = $(this).val();
    var characterReg = /^([0-9]{0,10})$/;
    if(!characterReg.test(inputVal)) {
        $(this).after('<span class="error error-keyup-3" style="color: red">Only Numeric, Maximum 10 characters.</span>');
    }
});
  });

$(function() { 
        $('.contact1').on('keypress', function(e) {
          $('span.error-keyup-4').remove();
            if (e.which == 32){
              $("#phonenumberdiv1").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});
</script>