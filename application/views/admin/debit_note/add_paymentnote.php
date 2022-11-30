<?php init_head(); ?>
<style>#adminnote{margin: 0px 13.5px 0px 0px;height: 128px;width: 509px;}.error{border:1px solid red !important;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<style>
    
@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
}
</style>
<!-- <input id="check_gst" type='hidden' value="<?php if(isset($invoice->is_gst)){if ($invoice->is_gst == 1){echo'1';}else{echo'0';}}else{if($clientsate == get_staff_state()){echo'1';}else{echo'0';}} ?>"> -->
<input id="check_gst" type='hidden' value="0">
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
   <?php  echo form_open('admin/Stock/converttask', array('id' => 'stock')); ?>
      <!-- Modal content-->
	   <textarea name="availablestockarray" id="availablestockarray" style="display:none;"></textarea>
      <div class="modal-content">
	  <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title"><?php echo _l('check_availability');?></h4>
		</div>
		<div class="modal-body" id="stockavdv">
		</div>
		<div class="modal-footer">
		  <!--<button type="submit" class="btn btn-info uploadpdf">Upload</button>-->
		  <button type="submit" class="btn btn-info" onclick="createtask('stockavdv')" ><?php echo _l('add_task');?></button>
		  <button type="button" id="cmd" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	    <?php echo form_close(); ?>
    </div>
  </div>
<div id="wrapper">
    <div class="content accounting-template">
	<a data-toggle="modal" id="modal" data-target="#myModal"></a>

            <?php
			echo form_open($this->uri->uri_string(),array('id'=>'invoice-form','class'=>''));
			if(isset($invoice)){
				echo form_hidden('isedit');
			}
			?>
        <div class="row">
		<?php
            if (isset($invoice)) {
                echo form_hidden('isedit', $invoice->id);
            }
            $rel_type = '';
            $rel_id = '';
            if (isset($invoice) || ($this->input->get('rel_id') && $this->input->get('rel_type'))) {
                if ($this->input->get('rel_id')) {
                    $rel_id = $this->input->get('rel_id');
                    $rel_type = $this->input->get('rel_type');
                } else {
                    $rel_id = $invoice->rel_id;
                    $rel_type = $invoice->rel_type;
                }
            }
            ?>
			<div class="panel_s invoice accounting-template">
			  <div class="panel-body">
			  	<h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
				<div class="row">
				 <div class="col-md-6">
					<div class="f_client_id">
					  <div class="form-group select-placeholder">
						<label for="clientid" class="control-label"><?php echo _l('invoice_select_customer'); ?></label>

						<select class="form-control selectpicker" name="clientid" required="" id="clientid" data-live-search="true">
                            <option value=""></option>
                            <?php

                            if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                foreach ($client_branch_data as $client_value) {

                                    ?>
                                        <option value="<?php echo $client_value->userid; ?>" <?php echo (isset($debit_info->clientid) && $debit_info->clientid == $client_value->userid) ? 'selected' : "" ?>><?php echo cc($client_value->client_branch_name); ?></option>
                                        <?php
                                }
                            }
                            ?>
                        </select>



					  </div>
					</div>

                    <div class="row">
					<div class="form-group col-md-6">
					<?php
					  $value = date('d/m/Y');
					  if(isset($debit_info)){
						$value = _d($debit_info->date);
					  }
					?>

					<div class="form-group" app-field-wrapper="date">
							<label for="date" class="control-label">Date</label>
							<div class="input-group">
								<input id="date" name="date" class="form-control datepicker" value="<?php echo $value; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
					</div>
					</div>

					<div class="form-group col-md-6">
					<div class="form-group">
                            <label for="tax_type" class="control-label">Tax Type</label>
                            <select required="" class="form-control selectpicker" id="tax_type" name="tax_type" data-live-search="true">

                                <option value=""></option>
                                <option value="1" <?php echo (!empty($debit_info->tax_type) && $debit_info->tax_type == 1) ? 'selected' : '' ; ?> >CGST+SGST</option>
                                <option value="2" <?php echo (!empty($debit_info->tax_type) && $debit_info->tax_type == 2) ? 'selected' : '' ; ?> >IGST</option>

                            </select>
                    </div>
                    </div>
                    </div>


				 </div>
				 <div class="col-md-6">
					<div class="panel_s no-shadow">
						<?php $value = (isset($debit_info) ? $debit_info->number : get_debitnote_number()); ?>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="number">Debit Note Number</label>
								<div class="input-group">
									<span class="input-group-addon"> D-Note </span>
									<input type="text" name="number" required="" class="form-control" value="<?php echo $value; ?>" data-isedit="false" data-original-number="false">
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="number">Intrest Percent</label>
								<input type="text" id="intrest_percent" name="intrest_percent" class="form-control" required="" value="<?php echo (isset($debit_info->intrest_percent) && $debit_info->intrest_percent != "") ? $debit_info->intrest_percent : "" ?>">
							</div>
						</div>	
						<div class="row">
							<div class="form-group col-md-6">
								<label for="number">SAC/HSN Code</label>
								<input type="text" id="sac_code" name="sac_code" class="form-control" required="" value="<?php echo (isset($debit_info->sac_code) && $debit_info->sac_code != "") ? $debit_info->sac_code : "99731399" ?>">
							</div>
							<div class="form-group col-md-6">
                                <label for="sac_hsn" class="control-label">Select SAC/HSN</label>
                                <select required="" class="form-control selectpicker" id="sac_hsn" required="" name="sac_hsn" data-live-search="true">
                                    <option value="2" <?php echo (!empty($debit_info->sac_hsn) && $debit_info->sac_hsn == 2) ? 'selected' : ''; ?> >SAC</option>
									<option value="1" <?php echo (!empty($debit_info->sac_hsn) && $debit_info->sac_hsn == 1) ? 'selected' : ''; ?> >HSN</option>
                                </select>
                            </div>  
                   		</div>
					</div>
				 </div>





				</div>

			  </div>

			</div>

			<div class="panel_s invoice accounting-template">
                <div class="panel_s">
                    <div class="panel-body">
                    	<h4 class="no-mtop mrg3">Invioce Details</h4>
                        <hr/>
					  			<div class="table-responsive">
                                    <div class="form-group" id="docAttachDivVideo">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td width="5%"><i class="fa fa-cog"></i></td>
                                                    <th width="30%" align="left">Invoice Number</th>
                                                    <th width="15%" align="left">Due Date</th>
                                                    <th width="10%" align="left">Invoice Amount</th>
													<th width="10%" class="qty" align="left">Delay in Days</th>
													<th width="10%" align="left">Amount</th>
													<th width="5%" align="left">TAX</th>
													<th width="10%" align="left">Final Amount</th>
													<th width="5%" align="left">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(!empty($invoicedata_info)){
                                            	foreach ($invoicedata_info as $key => $value) {
                                            	?>
	                                            <tr class="trsalepro<?php echo $key; ?>">
	                                              		<td>
	                                                        <button type="button" class="btn btn-danger" onclick="removesalepro(<?php echo $key; ?>);"><i class="fa fa-remove"></i></button>
	                                                    </td>
	                                                    <td>
	                                                    	<select class="form-control selectpicker invoice" val="<?php echo $key; ?>" name="data[<?php echo $key; ?>][invoice_id]" id="invoiceid<?php echo $key; ?>" data-live-search="true" required="">
																<option value=""></option>
																<?php
																if (!empty($invoice_info)) {
																	foreach ($invoice_info as  $r) {

																		?>
																		<option value="<?php echo $r->id ?>" <?php echo ($value->invoice_id == $r->id) ? 'selected' : ''; ?>><?php echo $r->number; ?></option>
																		<?php
																	}
																}
																?>
															</select>
	                                                    </td>
	                                                    <td>
	                                                    	<div class="input-group ">
	                                                    		<input type="text" id="due_date<?php echo $key; ?>" name="data[<?php echo $key; ?>][due_date]" class="form-control date" value="<?php echo _d($value->due_date); ?>">
															</div>
	                                                    </td>
	                                                    <td>
	                                                    	<div class="form-group">
																<input type="text" name="data[<?php echo $key; ?>][invoice_amount]" id="invoice_amount<?php echo $key; ?>" readonly="" class="form-control" value="<?php echo $value->invoice_amount; ?>">
															</div>
	                                                    </td>
	                                                    <td>
															<div class="form-group">
																<input type="text" id="delay_days<?php echo $key; ?>" name="data[<?php echo $key; ?>][delay_days]" readonly="" class="form-control" value="<?php echo $value->delay_days; ?>">
															</div>
														</td>
														<td>
															<div class="form-group">
																<input type="text" id="amount<?php echo $key; ?>" name="data[<?php echo $key; ?>][amount]" readonly="" class="form-control onlynumbers" value="<?php echo $value->amount; ?>">
															</div>
														</td>

														<td>
															<div class="form-group">
																<input type="text" id="tax<?php echo $key; ?>" name="data[<?php echo $key; ?>][tax]" readonly="" class="form-control onlynumbers" value="<?php echo $value->tax; ?>">
															</div>
														</td>

														<td>
															<div class="form-group">
																<input type="text"  id="final_amount<?php echo $key; ?>" name="data[<?php echo $key; ?>][final_amount]"  readonly="" class="form-control onlynumbers" value="<?php echo $value->final_amount; ?>">
															</div>
														</td>
														<td>
															<button type="button" class="btn btn-success calculate" value="<?php echo $key; ?>">Calculate</button>
														</td>
	                                            </tr>
                                            	<?php
                                            	}
                                            }else{
                                            ?>
                                            <tr class="trsalepro0">
                                              		<td>
                                                        <button type="button" class="btn btn-danger" onclick="removesalepro(0);"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                    <td>
                                                    	<select class="form-control selectpicker invoice" val="0" name="data[0][invoice_id]" id="invoiceid0" data-live-search="true" >
															<option value=""></option>
														</select>
                                                    </td>
                                                    <td>
                                                    	<div class="input-group ">
                                                    		<input type="text" id="due_date0" name="data[0][due_date]" class="form-control date" value="">
														</div>
                                                    </td>
                                                    <td>
                                                    	<div class="form-group">
															<input type="text" name="data[0][invoice_amount]" id="invoice_amount0" readonly="" class="form-control" value="">
														</div>
                                                    </td>
                                                    <td>
														<div class="form-group">
															<input type="text" id="delay_days0" name="data[0][delay_days]" readonly="" class="form-control" value="">
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="text" id="amount0" name="data[0][amount]" readonly="" class="form-control onlynumbers" value="">
														</div>
													</td>

													<td>
														<div class="form-group">
															<input type="text" id="tax0" name="data[0][tax]" readonly="" class="form-control onlynumbers" value="">
														</div>
													</td>

													<td>
														<div class="form-group">
															<input type="text"  id="final_amount0" name="data[0][final_amount]"  readonly="" class="form-control onlynumbers" value="">
														</div>
													</td>
													<td>
														<button type="button" class="btn btn-success calculate" value="0">Calculate</button>
													</td>
                                             </tr>
                                            <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                        <div class="col-xs-12">
                                            <label class="label-control subHeads"><a class="addmoresalepro" value="<?php echo count($invoicedata_info); ?>>">Add More <i class="fa fa-plus"></i></a></label>
                                        </div>
                                    </div>
								</div>	
                            </div>
                        </div>
                    </div>


            <div class="panel_s invoice accounting-template">
                <div class="panel_s">
                    <div class="panel-body">
                    	<h4 class="no-mtop mrg3">Debit Note Details</h4>
                        <hr/>
					<div class="table-responsive">						
	                    <div class="form-group" id="docAttachDivVideo">
	                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop debitnotetable">
	                            <thead>
	                                <tr>
	                                    <td width="5%"><i class="fa fa-cog"></i></td>
	                                    <th width="30%" align="left">DN Number</th>
	                                    <th width="15%" align="left">DN Date</th>
	                                    <th width="10%" align="left">DN Amount</th>
										<th width="10%" class="qty" align="left">Delay in Days</th>
										<th width="10%" align="left">Amount</th>
										<th width="5%" align="left">TAX</th>
										<th width="10%" align="left">Final Amount</th>
										<th width="5%" align="left">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            <?php
	                            if(!empty($debitnotedata_info)){
	                            	foreach ($debitnotedata_info as $key => $value) {
	                            	?>
	                                <tr class="trdebitnote<?php echo $key; ?>">
	                                  		<td>
	                                            <button type="button" class="btn btn-danger" onclick="removedebitnote(<?php echo $key; ?>);"><i class="fa fa-remove"></i></button>
	                                        </td>
	                                        <td>
	                                        	<select class="form-control selectpicker debitnote" val="<?php echo $key; ?>" name="data_dn[<?php echo $key; ?>][invoice_id]" id="dn_invoiceid<?php echo $key; ?>" data-live-search="true" required="">
													<option value=""></option>
													<?php
													if (!empty($invoice_info)) {
														foreach ($invoice_info as  $r) {

															?>
															<option value="<?php echo $r->id ?>" <?php echo ($value->invoice_id == $r->id) ? 'selected' : ''; ?>><?php echo $r->number; ?></option>
															<?php
														}
													}
													?>
												</select>
	                                        </td>
	                                        <td>
	                                        	<div class="input-group ">
	                                        		<input type="text" id="dn_due_date<?php echo $key; ?>" name="data_dn[<?php echo $key; ?>][due_date]" class="form-control date" value="<?php echo _d($value->due_date); ?>">
												</div>
	                                        </td>
	                                        <td>
	                                        	<div class="form-group">
													<input type="text" name="data_dn[<?php echo $key; ?>][invoice_amount]" id="dn_invoice_amount<?php echo $key; ?>" readonly="" class="form-control" value="<?php echo $value->invoice_amount; ?>">
												</div>
	                                        </td>
	                                        <td>
												<div class="form-group">
													<input type="text" id="dn_delay_days<?php echo $key; ?>" name="data_dn[<?php echo $key; ?>][delay_days]" readonly="" class="form-control" value="<?php echo $value->delay_days; ?>">
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="text" id="dn_amount<?php echo $key; ?>" name="data_dn[<?php echo $key; ?>][amount]" readonly="" class="form-control onlynumbers" value="<?php echo $value->amount; ?>">
												</div>
											</td>

											<td>
												<div class="form-group">
													<input type="text" id="dn_tax<?php echo $key; ?>" name="data_dn[<?php echo $key; ?>][tax]" readonly="" class="form-control onlynumbers" value="<?php echo $value->tax; ?>">
												</div>
											</td>

											<td>
												<div class="form-group">
													<input type="text"  id="dn_final_amount<?php echo $key; ?>" name="data_dn[<?php echo $key; ?>][final_amount]"  readonly="" class="form-control onlynumbers" value="<?php echo $value->final_amount; ?>">
												</div>
											</td>
											<td>
												<button type="button" class="btn btn-success calculate_dn" value="<?php echo $key; ?>">Calculate</button>
											</td>
	                                </tr>
	                            	<?php
	                            	}
	                            }else{
	                            ?>
	                            <tr class="trdebitnote0">
	                              		<td>
	                                        <button type="button" class="btn btn-danger" onclick="removedebitnote(0);"><i class="fa fa-remove"></i></button>
	                                    </td>
	                                    <td>
	                                    	<select class="form-control selectpicker debitnote" val="0" name="data_dn[0][invoice_id]" id="dn_invoiceid0" data-live-search="true">
												<option value=""></option>
											</select>
	                                    </td>
	                                    <td>
	                                    	<div class="input-group ">
	                                    		<input type="text" id="dn_due_date0" name="data_dn[0][due_date]" class="form-control date" value="">
											</div>
	                                    </td>
	                                    <td>
	                                    	<div class="form-group">
												<input type="text" name="data_dn[0][invoice_amount]" id="dn_invoice_amount0" readonly="" class="form-control" value="">
											</div>
	                                    </td>
	                                    <td>
											<div class="form-group">
												<input type="text" id="dn_delay_days0" name="data_dn[0][delay_days]" readonly="" class="form-control" value="">
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="text" id="dn_amount0" name="data_dn[0][amount]" readonly="" class="form-control onlynumbers" value="">
											</div>
										</td>

										<td>
											<div class="form-group">
												<input type="text" id="dn_tax0" name="data_dn[0][tax]" readonly="" class="form-control onlynumbers" value="">
											</div>
										</td>

										<td>
											<div class="form-group">
												<input type="text"  id="dn_final_amount0" name="data_dn[0][final_amount]"  readonly="" class="form-control onlynumbers" value="">
											</div>
										</td>
										<td>
											<button type="button" class="btn btn-success calculate_dn" value="0">Calculate</button>
										</td>
	                             </tr>
	                            <?php
	                            }
	                            ?>

	                            </tbody>
	                        </table>
	                        <div class="col-xs-12">
	                            <label class="label-control subHeads"><a class="addmoredebitnote" value="<?php echo count($invoicedata_info); ?>>">Add More <i class="fa fa-plus"></i></a></label>
	                        </div>
	                    </div>
					</div>	
	            </div>
	        </div>
        </div>







			<div class="panel_s invoice accounting-template">



				<div class="panel_s">



					<div class="panel-body">


						<h4 class="no-mtop mrg3">Client Person</h4>
                        <hr/>
				<?php
					if(!isset($contactdata))
					{?>
					<div class="table-responsive s_table">
							<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
								<thead>
									<tr>
										<th width="20%" align="left"><?php echo _l('name');?></th>
										<th width="20%" class="qty" align="left"><?php echo _l('email');?></th>
										<th width="20%" align="left"><?php echo _l('number');?>	</th>
										<th width="20%" align="left"><?php echo _l('designation');?>	</th>
										<th width="20%" align="left"><?php echo _l('type');?>	</th>
										<th width="10%"  align="center"><i class="fa fa-cog"></i></th>
									</tr>
								</thead>
								<tbody class="ui-sortable">
									<tr class="main" id="tr0">
										<td>
											<div class="form-group">
												<input type="text" id="firstname" name="clientdata[0][firstname]" class="form-control" >
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="text" id="email0" name="clientdata[0][email]" onBlur="checkmail(this.value,0);" class="form-control clientmail" >
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="text" id="phonenumber0" minlength="10" maxlength="10" name="clientdata[0][phonenumber]" onBlur="checkcontno(this.value,0);" class="form-control onlynumbers">
												<span id="phonenumberdiv0"></span>
											</div>
										</td>
										<td>
											<div class="form-group">
												<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[0][designation_id]">
													<option value=""></option>
													<?php
													if (isset($designation_data) && count($designation_data) > 0) {
														foreach ($designation_data as $designation_key => $designation_value) {
															?>
															<option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</td>
										<td>
											<div class="form-group">
												<select class="form-control selectpicker" data-live-search="true" id="contact_type" name="clientdata[0][contact_type]">
													<option value=""></option>
													<?php
													if (isset($contact_type_data) && count($contact_type_data) > 0) {
														foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
															?>
															<option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</td>
										<td>
											<button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('0');" ><i class="fa fa-remove"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="col-xs-12">
								<label class="label-control subHeads"><a  class="addmorecontact" value="0"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>
							</div>
						</div>
						<?php
					}
					else
					{?>
					<div class="table-responsive s_table">
						<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
							<thead>
								<tr>
									<th width="20%" align="left"><?php echo _l('name');?></th>
									<th width="20%" class="qty" align="left"><?php echo _l('email');?></th>
									<th width="20%" align="left"><?php echo _l('number');?>	</th>
									<th width="20%" align="left"><?php echo _l('designation');?>	</th>
									<th width="20%" align="left"><?php echo _l('type');?>	</th>
									<th width="10%"  align="center"><i class="fa fa-cog"></i></th>
								</tr>
							</thead>
							<tbody class="ui-sortable">
								<?php
								$i=0;
								foreach($contactdata as $singlecontactdata)
								{$i++;?>
								<tr class="main" id="trcc<?php echo $i;?>">
									<td>
										<div class="form-group">
										<input type="hidden" name="client_data[<?php echo $i;?>][clientid]" value="<?php echo $singlecontactdata['contactid'];?>">
											<input type="text" id="firstname" name="clientdata[<?php echo $i;?>][firstname]" value="<?php echo $singlecontactdata['firstname'];?>" class="form-control" >
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" id="email<?php echo $i;?>" name="clientdata[<?php echo $i;?>][email]" value="<?php echo $singlecontactdata['email'];?>" onBlur="checkmail(this.value,0);" class="form-control clientmail" >
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" minlength="10" maxlength="10" id="phonenumber<?php echo $i;?>" name="clientdata[<?php echo $i;?>][phonenumber]" value="<?php echo $singlecontactdata['phonenumber'];?>" onBlur="checkcontno(this.value,0);" class="form-control onlynumbers contact1"><span id="phonenumberdiv1"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[<?php echo $i;?>][designation_id]">
												<option value=""></option>
												<?php
												if (isset($designation_data) && count($designation_data) > 0) {
													foreach ($designation_data as $designation_key => $designation_value) {
														?>
														<option value="<?php echo $designation_value['id'] ?>" <?php if($singlecontactdata['designation_id']==$designation_value['id']){echo"selected=selected";}?>><?php echo cc($designation_value['designation']); ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control selectpicker" data-live-search="true" id="contact_type" name="clientdata[<?php echo $i;?>][contact_type]">
												<option value=""></option>
												<?php
												if (isset($contact_type_data) && count($contact_type_data) > 0) {
													foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
														?>
														<option value="<?php echo $contact_type_value['id'] ?>" <?php if($singlecontactdata['contact_type']==$contact_type_value['id']){echo"selected=selected";}?>><?php echo $contact_type_value['contact_type'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</td>
									<td>
										<button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('<?php echo $i;?>');" ><i class="fa fa-remove"></i></button>
									</td>
								</tr>
								<?php
								}?>
							</tbody>
						</table>
						<div class="col-xs-12">
							<label class="label-control subHeads"><a  class="addmorecontact" value="<?php echo count($contactdata); ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>
						</div>
					</div>
				<?php
					}?>


				 <div  class="col-md-12">
                                    <div class="form-group">
                                        <label for="note" class="control-label">Note</label>

                                        <textarea class="form-control tinymce" name="note" id="note"><?php echo (isset($debit_info) && $debit_info->note != '') ? $debit_info->note : ""; ?></textarea>
                                    </div>
                                </div>


                                <div  class="col-md-12">
                                    <div class="form-group">
                                        <label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label>

                                        <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions">
                                            <?php
                                        if(!empty($debit_info)){
                                            echo $debit_info->terms_and_conditions;
                                        }else{
                                            echo get_terms_conditions('debit_note_payment');
                                        }
                                        ?>
                                        </textarea>
                                    </div>
                                    	<div class="btn-bottom-toolbar bottom-transaction text-right">
                    <button type="submit" name="save" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                        Save
                    </button>
                </div>
                                </div>


			</div>

			  </div>
			</div>



              <!-- <?php $tax_value = ( isset($invoice) ? $invoice->tax_type : '1'); ?>
            <input type="hidden" id="tax_type" name="tax_type" value="<?php echo $tax_value; ?>"> -->


            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">
	$('.addmorecontact').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable tbody').append('<tr class="main" id="trcc'+newaddmore+'"><td><div class="form-group"><input type="text" id="firstname" name="clientdata['+newaddmore+'][firstname]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="email'+newaddmore+'" name="clientdata['+newaddmore+'][email]" class="form-control" onBlur="checkmail(this.value,'+newaddmore+');"></div></td><td><div class="form-group"><input type="text" minlength="10" maxlength="10" id="phonenumber'+newaddmore+'" onkeyup="nospaces(this)" onBlur="checkcontno(this.value,'+newaddmore+');" name="clientdata['+newaddmore+'][phonenumber]" class="form-control onlynumbers"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="contact_type" name="clientdata['+newaddmore+'][contact_type]"><option value=""></option><?php	if (isset($contact_type_data) && count($contact_type_data) > 0) {foreach ($contact_type_data as $contact_type_key => $contact_type_value) {?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php }}?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson(procompid)
    {
        $('#trcc' + procompid).remove();
    }
</script>

<script type="text/javascript">
    $(document).on('change', '#clientid', function() {
		
    var clientid = $("#clientid").val();
    if(clientid > 0){
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/debit_note/get_invoice_list",
            data    : {'clientid' : clientid},
            success : function(response){
                if(response != ''){

                    $("#invoiceid0").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }else{
                	 $("#invoiceid0").html('');
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/debit_note/get_debitnote_list",
            data    : {'clientid' : clientid},
            success : function(response){
                if(response != ''){

                    $("#dn_invoiceid0").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }else{
                	 $("#dn_invoiceid0").html('');
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    }

   });
</script>



<script type="text/javascript">
	$(document).on('click', '.calculate', function() {

		var i = $(this).val();

		var date = $("#date").val();
		var due_date = $("#due_date"+i).val();
		var invoice_amount = $("#invoice_amount"+i).val();
		var intrest_percent = $("#intrest_percent").val();

		if(date != '' && due_date != '' && invoice_amount != '' && intrest_percent != ''){
			$.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/debit_note/make_calculation'); ?>",
	            data    : {'date' : date,'due_date' : due_date,'invoice_amount' : invoice_amount,'intrest_percent' : intrest_percent},
	            dataType: "json",
	            success : function(response){
	                if(response != ''){
	                    $('#invoice_amt'+i).val(response.invoice_amount);
	                    $('#delay_days'+i).val(response.delay_days);
	                    $('#amount'+i).val(response.amount);
	                    $('#tax'+i).val(response.tax);
	                    $('#final_amount'+i).val(response.final_amount);
	                }
	            }
	        })
		}else{
			alert('Required Fields are Missing!');
		}


	});
</script>

<script type="text/javascript">
	$(document).on('click', '.calculate_dn', function() {

		var i = $(this).val();

		var date = $("#date").val();
		var due_date = $("#dn_due_date"+i).val();
		var invoice_amount = $("#dn_invoice_amount"+i).val();
		var intrest_percent = $("#intrest_percent").val();

		if(date != '' && due_date != '' && invoice_amount != '' && intrest_percent != ''){
			$.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/debit_note/make_calculation'); ?>",
	            data    : {'date' : date,'due_date' : due_date,'invoice_amount' : invoice_amount,'intrest_percent' : intrest_percent},
	            dataType: "json",
	            success : function(response){
	                if(response != ''){
	                    $('#dn_invoice_amt'+i).val(response.invoice_amount);
	                    $('#dn_delay_days'+i).val(response.delay_days);
	                    $('#dn_amount'+i).val(response.amount);
	                    $('#dn_tax'+i).val(response.tax);
	                    $('#dn_final_amount'+i).val(response.final_amount);
	                }
	            }
	        })
		}else{
			alert('Required Fields are Missing!');
		}


	});
</script>


<script type="text/javascript">
	$(document).on('click', '.addmoresalepro', function() {
		var addmorerentpro = parseInt($(this).attr('value'));
		var newaddmorerentpro = addmorerentpro + 1;
		$(this).attr('value', newaddmorerentpro);

		var clientid = $("#clientid").val();

		if(clientid != ''){
		 $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/debit_note/get_invoice_row'); ?>",
	            data    : {'clientid' : clientid, 'row' : newaddmorerentpro},
	            success : function(response){
	                if(response != ''){
	                    $('.saletable tbody').append(response);
	                    $('.selectpicker').selectpicker('refresh');
	                     $('.date').datepicker( {
				            dateFormat: 'dd/mm/yy',
				        });
	                }
	            }
	        })

	    }else{
			alert('Client is not selected!');
		}

	});

	function removesalepro(procompid)
    {
        $('.trsalepro' + procompid).remove();
    }
</script>

<script type="text/javascript">
	$(document).on('click', '.addmoredebitnote', function() {
		var addmorerentpro = parseInt($(this).attr('value'));
		var newaddmorerentpro = addmorerentpro + 1;
		$(this).attr('value', newaddmorerentpro);

		var clientid = $("#clientid").val();

		if(clientid != ''){
		 $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/debit_note/get_debitnote_row'); ?>",
	            data    : {'clientid' : clientid, 'row' : newaddmorerentpro},
	            success : function(response){
	                if(response != ''){
	                    $('.debitnotetable tbody').append(response);
	                    $('.selectpicker').selectpicker('refresh');
	                     $('.date').datepicker( {
				            dateFormat: 'dd/mm/yy',
				        });
	                }
	            }
	        })

	    }else{
			alert('Client is not selected!');
		}

	});

	function removedebitnote(procompid)
    {
        $('.trdebitnote' + procompid).remove();
    }
</script>

<script type="text/javascript">
    $(function() {
        $('.date').datepicker( {
            dateFormat: 'dd/mm/yy',
        });
    });
</script>

<script type="text/javascript">
	$(document).on('change', '.invoice', function() {
		var i = $(this).attr('val');
		var id = $(this).val();

		if(id > 0){
			$.ajax({
				type    : "POST",
				url     : "<?php echo site_url('admin/debit_note/invoice_details'); ?>",
				data    : {'id' : id},
				dataType: "json",
				success : function(response){
					if(response != ''){
						$('#invoice_amount'+i).val(response.amount);
						$('#due_date'+i).val(response.date);
					}
				}
			})
		}

	});
</script>

<script type="text/javascript">
	$(document).on('change', '.debitnote', function() {
	var i = $(this).attr('val');
	var id = $(this).val();

	if(id > 0){
		$.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/debit_note/debitnote_details'); ?>",
            data    : {'id' : id},
            dataType: "json",
            success : function(response){
                if(response != ''){
                    $('#dn_invoice_amount'+i).val(response.amount);
                    $('#dn_due_date'+i).val(response.date);
                }
            }
        })
	}

	});

	$('.onlynumbers').keypress(function(event){



       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){

           event.preventDefault(); //stop character from entering input

       }



   });

	var validateEmail = function(elementValue) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(elementValue);
    }

    $('#email0').keyup(function() {

    var value = $(this).val();
    var valid = validateEmail(value);

    if (!valid) {


        $(this).css('color', 'red');

    } else {


        $(this).css('color', '#000');

    }



});

 $(function() {
        $('#phonenumber0').on('keypress', function(e) {
          $('span.error-keyup-4').remove();
            if (e.which == 32){
              $("#phonenumberdiv0").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
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

function nospaces(t){
  if(t.value.match(/\s/g)){
    t.value=t.value.replace(/\s/g,'');
  }
}
</script>


</body>
</html>
