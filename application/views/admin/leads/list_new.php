
<?php init_head(); ?>



<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Lead List <?php if(check_permission_page(96,'create')){ ?> <a href="<?php echo admin_url('leads/leads'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">New Lead</a> <!-- <a href="<?php echo admin_url('leads/export_lead'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Export</a> --> <?php } ?></h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div >
                        <div class="row col-md-12">

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="lead_type" class="control-label">Lead Type</label>
                                <select class="form-control selectpicker" id="lead_type" name="lead_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($leadtype_info)){
                                        foreach ($leadtype_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($lead_type) && $lead_type == $value->id){ echo 'selected';} ?>><?php echo $value->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="lead_source" class="control-label">Lead Source</label>
                                <select class="form-control selectpicker" id="lead_source" name="lead_source" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($sources_info)){
                                        foreach ($sources_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($lead_source) && $lead_source == $value->id){ echo 'selected';} ?>><?php echo $value->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="state" class="control-label">Site State</label>
                                <select class="form-control selectpicker" id="state" name="state" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($state_info)){
                                        foreach ($state_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($state) && $state == $value->id){ echo 'selected';} ?>><?php echo $value->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="city" class="control-label">Site City</label>
                                <select class="form-control selectpicker" id="city" name="city" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($city_info)){
                                        foreach ($city_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($city) && $city == $value->id){ echo 'selected';} ?>><?php echo $value->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        </div>
                                            
                        <div class="row col-md-12">
                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_company" class="control-label">Customer or Company Name </label>
                            <input type="text" name="customer_company" class="form-control" value="<?php if(!empty($customer_company)){ echo $customer_company; } ?>">
                       </div>   

                        
                        <div class="col-md-2">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info ">Search</button>
                        </div>
                       
                   </div>
                       
                    </div>
                                                
                            <div class="col-md-12">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Lead #</th>
                                        <th>Customer Name</th>
                                        <th>Quotation</th>
                                        <th>Enq date</th>
                                        <th>Type</th>
                                        <th>Source</th>                                        
                                        <th>Amount</th>                                        
                                        <th>Created</th>
                                        <th>Followup</th>
                                        <th>Contacts</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($lead_list)){
                                        foreach ($lead_list as $key => $value) {

                                            $client_info = $this->db->query("SELECT `client_branch_name` FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

                                            if($value->client_branch_id > 0){
                                                $company = $client_info->client_branch_name;
                                            }else{
                                                $company = $value->company;
                                            }

                                            if(check_quotation($value->id) == 1){
                                                $quotation = 'Yes';
                                            }else{
                                                $quotation = 'No';
                                            }

                                            $checked = ($value->followup == 1 ) ? 'checked' : '';
                                            $toggleActive = '<div class="onoffswitch">
                                                <input type="checkbox" data-switch-url="' . admin_url() . 'leads/change_followup_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                                                <label class="onoffswitch-label" for="' . $value->id . '"></label>
                                            </div>';

                                            //$contact_info = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$value->id."' and c.phonenumber != '' ")->row();

                                            //getting last quotation amount
                                            $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
                                            if(!empty($quotation_info)){
                                                $amount = $quotation_info->total;
                                            }else{
                                                $amount = '0.00';
                                            }

                                        ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo '<a href="'.admin_url('leads/index/' . $value->id).'" onclick="init_lead(' . $value->id . ');return false;"> LEAD-'.number_series($value->id).'</a>'; ?></td>
                                            <td><?php echo $company; ?></td>
                                            <td><?php echo $quotation; ?></td>                                            
                                            <td><?php echo _d($value->enquiry_date); ?></td> 
                                            <td><?php echo value_by_id('tblenquirytypemaster',$value->enquiry_type_id,'name'); ?></td>
                                            <td><?php echo value_by_id('tblleadssources',$value->source,'name'); ?></td>
                                            <td><?php echo $amount; ?></td>
                                            <td><?php echo _d($value->dateadded); ?></td>
                                            <td><?php echo $toggleActive; ?><a target="_blank" href="<?php echo admin_url('follow_up/lead_activity/'.$value->id); ?>">Activity</a></td>
                                            <!-- <td class="text-center"><?php if(!empty($contact_info)){ ?><a target="_blank" href="<?php echo admin_url('leads/lead_contact/'.$value->id); ?>" data-status="1"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a><?php }else{ echo '--'; }?></td> -->
                                            <td class="text-center"><a target="_blank" href="<?php echo admin_url('leads/lead_contact/'.$value->id); ?>" data-status="1"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a></td>
                                            <td class="text-center">
                                                
                                                <!-- <a href="<?php echo site_url('invoice/'.$value->id.'/'.$value->hash).$type ; ?>" target="_blank" class="actionBtn">View</a> -->
                                                <?php if(check_permission_page(96,'edit')){ ?>
                                                <a href="<?php echo admin_url('leads/leads/' . $value->id); ?>" class="actionBtn">Edit</a>
                                                <?php }  

                                                if(check_permission_page(96,'delete')){ ?>
                                                <a href="<?php echo admin_url('leads/delete/' . $value->id); ?>" class="_delete text-danger">Delete</a>
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
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>


<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lead Process</h4>
      </div>
      <form  action="<?php echo admin_url('leads/update_process'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Update</button>
      </div>
      </form>
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
</script>


</body>
</html>


<script type="text/javascript">
$(document).on('click', '.lead_process', function() { 
    var lead_id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/leads/get_lead_process",
        data    : {'lead_id' : lead_id},
        success : function(response){
            if(response != ''){
                $('.modal-body').html(response);
            }
        }
    })
}); 
</script>

<script type="text/javascript">
$(document).on('click', '.process', function() { 

    var lead_id = $(this).attr('val');
    var value = $(this).val();
    
    if($(this).is(":checked")){
        $(this).parent('p').css("background-color", "#46A049");
        
        if(value == 12){
            $('#notintrestdiv'+lead_id).show();
        }

    }else{
        $(this).parent('p').css("background-color", "#757575");
        if(value == 12){
           $('#notintrestdiv'+lead_id).hide(); 
           $('#notintrestrmkdiv'+lead_id).hide(); 
        }
    }
}); 
</script> 

<script type="text/javascript">
    function check_other_remark(lead_id,value) {
        if(value == 6){
            $('#notintrestrmkdiv'+lead_id).show(); 
        }else{
           $('#notintrestrmkdiv'+lead_id).hide();  
        }
    }
</script>
