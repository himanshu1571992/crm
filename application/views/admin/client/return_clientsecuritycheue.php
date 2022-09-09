<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'client-form', 'class' => 'client-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="row">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin">Client Security Cheque Information</h4>
                    <hr class="hr-panel-heading">
                        <div class="lead-view" id="leadViewWrapper">
                          <div class=" lead-information-col">
			               <div class="col-md-6">
			               	 <h4 class="no-margin font-medium-xs bold">Client Name </h4>
                            <p class="bold font-medium-xs lead-name">
                            <?php $client_info = $this->db->query("SELECT * from tblclientbranch WHERE userid = '".$clientsecurity_info->client_id."' ")->row();
                            echo $client_info->company; 
                            ?>
                            </p>
			               </div>
                           <div class="col-md-6">
                           	 <h4 class="no-margin font-medium-xs bold">Cheque Amount</h4>
                            <p class="bold font-medium-xs"><?php echo $clientsecurity_info->cheque_amount; ?></p>
                           
                           </div>
                           <div class="col-md-6">
                           	 <h4 class="no-margin font-medium-xs bold">Cheque Number</h4>
                            <p class="bold font-medium-xs"><?php echo $clientsecurity_info->cheque_number; ?></p>
                            
                            <?php if (isset($clientsecurity_info->cheque_date) && $clientsecurity_info->cheque_date != "") { ?>
                           </div>
                           <div class="col-md-6">
                           	 <h4 class="no-margin font-medium-xs bold">Cheque Date</h4>
                            <p class="bold font-medium-xs"><?php echo $clientsecurity_info->cheque_date; ?></p>
                            <?php } ?>

                            <?php if (isset($clientsecurity_info->cheque_image) && $clientsecurity_info->cheque_image != "") {
                                    ?>
                           </div>
                           <div class="col-md-6">
                           	
                                     <h4 class="no-margin font-medium-xs bold">Cheque Date</h4>

                                        <img src="<?php echo base_url('uploads/client_security_cheque') . "/" . $clientsecurity_info->id . "/" . $clientsecurity_info->cheque_image ?>" style="width: 150px; height: 150px;">
                                    
                                    <?php
                                }
                            ?>
                           </div>
                          </div>
                             <hr>
        <br>
        <div class="col-md-12">                
        <h4 class="text-center"><u>Return Information</u></h4>
           <div class="form-group col-md-3 select-placeholder">

                <label for="return_cheque" class="control-label">Return client security cheque</label>

                <select class="form-control selectpicker" id="return_cheque"  name="return_cheque" required="">

                    <option value="">--Select One--</option>

                    <option value="1" <?php if(!empty($clientsecurity_info->return_type) && $clientsecurity_info->return_type == 1){ echo 'selected'; } ?>>Return</option>

                    <option value="2" <?php if(!empty($clientsecurity_info->return_type) && $clientsecurity_info->return_type == 2){ echo 'selected'; } ?>>Cancel</option>

                </select>

            </div>
            <div class="col-md-12">
            <?php if(!empty($clientsecurity_info->return_type) && $clientsecurity_info->return_type == 1)
            { ?>
            <div id="return_div">
            	<div class="row">
            		<div class="col-md-4">   
                        <div class="form-group">
                            <label for="courier_name" class="control-label">Courier Name</label>
                            <input type="text" id="courier_name" name="courier_name" class="form-control" value="<?php echo (isset($clientsecurity_info->courier_name) && $clientsecurity_info->courier_name != "") ? $clientsecurity_info->courier_name : "" ?>">
                        </div>
                    </div>
                     <div class="col-md-4">   
                        <div class="form-group">
                            <label for="courier_tracking" class="control-label">Courier Tracking Number</label>
                            <input type="text" id="courier_tracking" name="courier_tracking" class="form-control" value="<?php echo (isset($clientsecurity_info->courier_tracking) && $clientsecurity_info->courier_tracking != "") ? $clientsecurity_info->courier_tracking : "" ?>">
                        </div>
                    </div>
                       <div class="form-group col-md-4">
            		<label for="invoice_id" class="control-label">Courier Date</label>
                    <div class="input-group date">
                        <?php $c_date = _d($clientsecurity_info->courier_date); ?>
                        <input id="courier_date" name="courier_date" class="form-control datepicker" value="<?php echo (isset($c_date) && $c_date != "") ? $c_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i>
                        </div>
                    </div>
                  </div>
            	</div>
            </div>
            <?php } else { ?>
            <div id="return_div" hidden>
              <div class="row">
                <div class="col-md-4">   
                        <div class="form-group">
                            <label for="courier_name" class="control-label">Courier Name</label>
                            <input type="text" id="courier_name" name="courier_name" class="form-control" value="">
                        </div>
                    </div>
                     <div class="col-md-4">   
                        <div class="form-group">
                            <label for="courier_tracking" class="control-label">Courier Tracking Number</label>
                            <input type="text" id="courier_tracking" name="courier_tracking" class="form-control" value="">
                        </div>
                    </div>
                       <div class="form-group col-md-4">
                <label for="invoice_id" class="control-label">Courier Date</label>
                    <div class="input-group date">
                        <input id="courier_date" name="courier_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            <?php } ?>
            </div>
           <?php if (isset($clientsecurity_info->return_image) && $clientsecurity_info->return_image != "") {
              ?>
              <div class="form-group col-md-4">
                  <label class="control-label"></label>
                  <img src="<?php echo base_url('uploads/client_security_cheque/courier_return') . "/" . $clientsecurity_info->id . "/" . $clientsecurity_info->return_image ?>" style="width: 150px; height: 150px;">
              </div>
              <?php
                 }
              ?>
           <div class="col-md-12">
            <?php if (isset($clientsecurity_info->return_image) && $clientsecurity_info->return_image != "") {
              ?>
           	 <div id="cancel_div">
            	<div class="row">
                    <div class="form-group col-md-4">
                            <label for="return_image" class="control-label">Courier Image</label>
                            <input type="file" id="return_image" name="return_image">
                    </div>
                </div>
             </div>
            <?php } else { ?>
            <div id="cancel_div" hidden>
              <div class="row">
                    <div class="form-group col-md-4">
                            <label for="return_image" class="control-label">Courier Image</label>
                            <input type="file" id="return_image" name="return_image">
                    </div>
                </div>
             </div>
            <?php } ?>
            </div>    

          <div class="btn-bottom-toolbar text-right">
            <button class="btn btn-info" type="submit">
                <?php echo _l('submit'); ?>
            </button>
          </div>
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
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>
<script type="text/javascript">
	$(document).on('change', '#return_cheque', function() {   

       var return_cheque = $(this).val();

       if(return_cheque == 2){

            $('#cancel_div').show();
            $('#return_div').hide();

       }else{

            $('#return_div').show();
            $('#cancel_div').show();
       }



    });
</script>

</body>
</html>
