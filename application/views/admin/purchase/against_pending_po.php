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

</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php echo $title; ?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="row col-md-12">
                            <div class="form-group col-md-3" id="employee_div">
                                <label for="vendor_id" class="control-label">Search by Vendor </label>
                                <select class="form-control selectpicker" id="vendor_id" name="vendor_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                        if(!empty($vendor_info)){
                                            foreach ($vendor_info as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if(!empty($s_vendor) && $s_vendor == $value->id){ echo 'selected'; }?>><?php echo $value->name; ?></option>
                                                <?php     
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="branchid">
                                <label for="vendor_id" class="control-label">Branch *</label>
                                <select class="form-control selectpicker" id="branch_id" name="branch_id" required="" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                        if(!empty($branch_list)){
                                            foreach ($branch_list as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if(!empty($branch_id) && $branch_id == $value->id){ echo 'selected'; }?>><?php echo $value->comp_branch_name; ?></option>
                                                <?php     
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="financialyear_div">
                                <label for="financialyear_id" class="control-label">Financial Year *</label>
                                <select class="form-control selectpicker" id="financialyear_id" name="financialyear_id" required="" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                        if(!empty($financialyear_list)){
                                            foreach ($financialyear_list as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" <?php if(!empty($financialyear_id) && $financialyear_id == $value->id){ echo 'selected'; }?>><?php echo $value->name; ?></option>
                                                <?php     
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">                            
                                <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>PO No.</th>
                                        <th>Vendor</th>
                                        <th>Warehouse</th>
                                        <th>PO Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($purchaseorder_info)){
                                        $i=1;
                                        foreach($purchaseorder_info as $row){  

                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row->prefix.$row->number.' - '._d($row->date);?></td>
                                                <td><?php echo value_by_id('tblvendor',$row->vendor_id,'name');?></td>
                                                <td><?php echo value_by_id('tblwarehouse',$row->warehouse_id,'name'); ?></td>
                                                <td><?php echo _d($row->date);?></td>
                                                
                                                <td class="text-center"><a  href="<?php echo admin_url('purchase/material_receipt/'.$row->id); ?>" class="btn btn-info" >Create MR</a></td>    
                                              
                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="6"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                                <!-- <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" value="1" name="mark" type="submit">
                                    <?php echo _l('submit'); ?>
                                </button>
                            </div> -->
                        </div>
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>


</body>
</html>

<!-- Modal -->
<div id="handover_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receiver to Final Receiver</h4>
      </div>
      <div class="modal-body" id="handover_data">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
    $(document).on('click', '.handover', function() {  

    var handover_id = $(this).val(); 
    if(handover_id > 0 ){
          $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/handover/get_handover_data'); ?>",
            data    : {'handover_id' : handover_id},
            success : function(response){
                if(response != ''){       

                     
                     $('#handover_data').html(response);  
                }
            }
        })  
    }
    

});    
</script>
