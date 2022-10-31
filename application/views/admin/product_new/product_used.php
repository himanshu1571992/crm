<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                      <?php if ($type == 'temp'){?>
                          <h4 class="no-margin"><?php echo $title.' ('. value_by_id('tbltemperoryproduct',$product_id,'product_name') .')'. '('."Temp-PRO-" . number_series($product_id).')'; ?>  </h4>
                      <?php }else{ ?>
                          <h4 class="no-margin"><?php echo $title.' ('. value_by_id('tblproducts',$product_id,'sub_name') .')'. '('."PRO - " . number_series($product_id).')'; ?>  </h4>
                      <?php } ?>
					                 <hr class="hr-panel-heading">
					                      <div class="row">
                                    <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                        <div class="form-group col-md-4" app-field-wrapper="date">
                                            <label for="f_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($s_fdate)){ echo $s_fdate; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4" app-field-wrapper="date">
                                            <label for="t_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($s_tdate)){ echo $s_tdate; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                            <a class="btn btn-danger" style="margin-top: 24px;" href="">Reset</a>
                                        </div>
                                    <?php echo form_close(); ?>
                        						<?php if(!empty($lead_info)){ ?>
                          						<div class="col-md-6">
                          			          <h4 class="no-margin text-center">Lead Product Details</h4>
                              							<table class="table">
                                								<thead>
                                    								  <tr>
                                        									<th>S.No.</th>
                                        									<th>Lead No.</th>
                                        									<th>Amount</th>
                                        									<th>Date</th>
                                        									<th>Qty</th>
                                    								  </tr>
                                								</thead>
                              								  <tbody>
                                    								<?php
                                    									$z=1;
                                                      $ttlqty = 0;
                                    									foreach($lead_info as $value){
                                    										//getting last quotation amount
                                                          $quotation = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->enquiry_id."' order by id desc  ")->row();
                                                          $amount = (!empty($quotation)) ? $quotation->total : '0.00';
                                                          $ttlqty += $value->qty;
                                    										?>
                                    										<tr>
                                    											<td><?php echo $z++;?></td>
                                    											<td><?php echo '<a target="_blank" href="'.admin_url('leads/leads/' . $value->enquiry_id).'"> LEAD-'.number_series($value->enquiry_id).'</a>';?></td>
                                    											<td><?php echo $amount;?></td>
                                    											<td><?php echo _d($value->enquiry_date); ?></td>
                                                          <td><?php echo $value->qty; ?></td>
                                    										</tr>
                                    										<?php
                                    									}
                                    								?>
                                  								</tbody>
                                                  <tfoot style="background-color:#e5e7eb;">
                                                      <td colspan="4">Total</td>
                                                      <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                  </tfoot>
                              							  </table>
                          						    </div>
                      						<?php } ?>
		                              <?php if(!empty($quotation_info)){ ?>
                              				<div class="col-md-6">
                              						<h4 class="no-margin text-center">Quotation Product Details</h4>
                              						<table class="table">
                              								<thead>
                                								  <tr>
                                    									<th>S.No.</th>
                                    									<th>Quotation No.</th>
                                    									<th>Amount</th>
                                    									<th>Date</th>
                                    									<th>Qty</th>
                                    									<th>Rate</th>
                                								  </tr>
                              								</thead>
                              								<tbody>
                                  								<?php
                                  									$z=1;
                                                    $ttlqty = 0;
                                                    $ttlrate = 0;
                                    									foreach($quotation_info as $value){
                                                                            if($value->id > 0){
                                                        $ttlqty += $value->qty;
                                                        $ttlrate += $value->qty*$value->rate;
                                    							?>
                                    										<tr>
                                    											<td><?php echo $z++;?></td>
                                    											<td><?php echo '<a target="_blank" href="' . admin_url('proposals/download_pdf/' . $value->id) . '" onclick="init_proposal(' . $value->id . '); ">' . format_proposal_number($value->id) . '</a>'; ?></td>
                                    											<td><?php echo $value->total; ?></td>
                                    											<td><?php echo _d($value->date); ?></td>
                                                          <td><?php echo $value->qty; ?></td>
                                                          <td><?php echo $value->rate; ?></td>
                                    										</tr>
                                    							<?php
                                    									}
                                                                        }
                                  								?>
                              								 </tbody>
                                                <tfoot style="background-color:#e5e7eb;">
                                                    <td colspan="4">Total</td>
                                                    <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                    <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                                </tfoot>
                              							  </table>
                              						</div>
                                <?php } ?>
                                <?php if(!empty($pi_info)){ ?>
                        						<div class="col-md-6">
                          						  <h4 class="no-margin text-center">Proforma Invoice Product Details</h4>
                          							<table class="table">
                              								<thead>
                                								  <tr>
                                    									<th>S.No.</th>
                                    									<th>PI No.</th>
                                    									<th>Amount</th>
                                    									<th>Date</th>
                                                      <th>Qty</th>
                                    									<th>Rate</th>
                                								  </tr>
                              								</thead>
                              								<tbody>
                                    								<?php
                                    									$z=1;
                                                      $ttlqty = $ttlrate = 0;
                                    									foreach($pi_info as $value){
                                                          $ttlqty += $value->qty;
                                                          $ttlrate += $value->qty*$value->rate;
                                    								?>
                                    										<tr>
                                      											<td><?php echo $z++;?></td>
                                      											<td><?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $value->id) . '" onclick="init_estimate(' . $value->id . '); ">' . format_estimate_number($value->id) . '</a>';?></td>
                                      											<td><?php echo $value->total; ?></td>
                                      											<td><?php echo _d($value->date); ?></td>
                                                            <td><?php echo $value->qty; ?></td>
                                                            <td><?php echo $value->rate; ?></td>
                                    										</tr>
                                    								<?php
                                    									}
                                    								?>
                              								</tbody>
                                              <tfoot style="background-color:#e5e7eb;">
                                                  <td colspan="4">Total</td>
                                                  <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                  <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                              </tfoot>
                          							  </table>
                        						</div>
                              <?php } ?>
			                        <?php if(!empty($invoice_info)){ ?>
                        						<div class="col-md-6">
                    						        <h4 class="no-margin text-center">Invoice Product Details</h4>
                          							<table class="table">
                              								<thead>
                              								  <tr>
                                  									<th>S.No.</th>
                                  									<th>Invoice No.</th>
                                  									<th>Type</th>
                                  									<th>Amount</th>
                                  									<th>Date</th>
                                  									<th>Qty</th>
                                  									<th>Rate</th>
                              								  </tr>
                              								</thead>
                              								<tbody>
                              								<?php
                              									$z=1;
                                                $ttlqty = $ttlrate = 0;
                              									foreach($invoice_info as $value){
                                                  $ttlqty += $value->qty;
                                                  $ttlrate += $value->qty*$value->rate;
                              								?>
                              										<tr>
                              											<td><?php echo $z++;?></td>
                              											<td><?php echo '<a href="' . admin_url('invoices/download_pdf/' . $value->id ).'" target="_blank">' .format_invoice_number($value->id). '</a>'; ?></td>
                              											<td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sales';  ?></td>
                              											<td><?php echo $value->total; ?></td>
                              											<td><?php echo _d($value->invoice_date); ?></td>
                                                    <td><?php echo $value->qty; ?></td>
                                                    <td><?php echo $value->rate; ?></td>
                              										</tr>
                              										<?php
                              									}
                              								?>
                              								</tbody>
                                              <tfoot style="background-color:#e5e7eb;">
                                                <td colspan="5">Total</td>
                                                <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                              </tfoot>
                          							  </table>
              						              </div>
                                <?php } ?>
			                          <?php if(!empty($challan_info)){ ?>
                          						<div class="col-md-6">
                      						        <h4 class="no-margin text-center">Challan Product Details</h4>
                            							<table class="table">
                              								<thead>
                                								  <tr>
                                    									<th>S.No.</th>
                                    									<th>Challan No.</th>
                                    									<th>Service Type</th>
                                    									<th>Date</th>
                                    									<th>Qty</th>
                                								  </tr>
                              								</thead>
                              								<tbody>
                              								<?php
                                									$z=1;
                                                  $ttlqty = $qty = 0;
                                									foreach($challan_info as $value){
                                                        if (!empty($value->product_json) && $value->product_json != ""){
                                                           $productdata = json_decode($value->product_json);
                                                           foreach ($productdata as $pro) {
                                                              if ($pro->product_id == $product_id){
                                                                 $qty = $pro->product_qty;
                                                              }
                                                           }
                                                        }
                                                        $ttlqty += $qty;
                                										?>
                                  										<tr>
                                  											<td><?php echo $z++;?></td>
                                  											<td><?php echo '<a target="_blank" href="' . site_url('admin/chalan/view/' . $value->id). '" >' .$value->chalanno. '</a>'; ?></td>
                                  											<td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sale'; ?></td>
                                  											<td><?php echo _d($value->challandate); ?></td>
                                  											<td><?php echo $qty; ?></td>
                                  										</tr>
                                  										<?php
                                  									}
                              								?>
                              								</tbody>
                                              <tfoot style="background-color:#e5e7eb;">
                                                <td colspan="4">Total</td>
                                                <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                              </tfoot>
                            							</table>
                      						    </div>
                    						<?php } ?>
			                          <?php if(!empty($debitnote_info)){ ?>
                        						<div class="col-md-6">
                        				        <h4 class="no-margin text-center">Debit Note Product Details</h4>
                          							<table class="table">
                            								<thead>
                              								  <tr>
                                  									<th>S.No.</th>
                                  									<th>DN No.</th>
                                  									<th>Amount</th>
                                  									<th>Date</th>
                                  									<th>Qty</th>
                                  									<th>Rate</th>
                              								  </tr>
                            								</thead>
                            								<tbody>
                                								<?php
                                									$z=1;
                                                  $ttlqty = $ttlrate = 0;
                                									foreach($debitnote_info as $value){
                                                    $ttlqty += $value->qty;
                                                    $ttlrate += $value->qty*$value->price;
                                								?>
                                										<tr>
                                  											<td><?php echo $z++; ?></td>
                                  											<td><?php echo '<a target="_blank" href="' . admin_url('debit_note/download_pdf/' . $value->id). '" >' .$value->number. '</a>'; ?></td>
                                  											<td><?php echo $value->totalamount; ?></td>
                                  											<td><?php echo _d($value->dabit_note_date); ?></td>
                                                        <td><?php echo $value->qty; ?></td>
                                                        <td><?php echo $value->price; ?></td>
                                										</tr>
                                								<?php
                                									}
                                								?>
                            								</tbody>
                                            <tfoot style="background-color:#e5e7eb;">
                                              <td colspan="4">Total</td>
                                              <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                              <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                            </tfoot>
                        							  </table>
                        						</div>
	                            <?php } ?>
                  						<?php if(!empty($purchase_info)){ ?>
                  						<div class="col-md-6">
              						        <h4 class="no-margin text-center">PO Product Details</h4>
                    							<table class="table">
                      								<thead>
                        								  <tr>
                          									<th>S.No.</th>
                          									<th>PO No.</th>
                          									<th>Amount</th>
                          									<th>Date</th>
                          									<th>Qty</th>
                          									<th>Price</th>
                        								  </tr>
                      								</thead>
                      								<tbody>
                          								<?php
                          									$z=1;
                                            $ttlqty = $ttlrate = 0;
                          									foreach($purchase_info as $value){
                                                $ttlqty += $value->qty;
                                                $ttlrate += $value->qty*$value->price;
                          										?>
                          										<tr>
                          											<td><?php echo $z++;?></td>
                          											<td><?php echo '<a target="_blank" href="' . admin_url('purchase/download_pdf/' . $value->id) . '" >' . 'PO-'.$value->number . '</a>'; ?></td>
                          											<td><?php echo $value->totalamount; ?></td>
                          											<td><?php echo _d($value->date); ?></td>
                          											<td><?php echo $value->qty; ?></td>
                          											<td><?php echo $value->price; ?></td>
                          										</tr>
                          										<?php
                          									}
                          								?>
                      								</tbody>
                                      <tfoot style="background-color:#e5e7eb;">
                                        <td colspan="4">Total</td>
                                        <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                        <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                      </tfoot>
                    							</table>
                  						</div>
                  						<?php } ?>
			                        <?php if(!empty($component_info)){ ?>
                      						<div class="col-md-6">
                  						        <h4 class="no-margin text-center">Components Details</h4>
                        							<table class="table">
                            								<thead>
                              								  <tr>
                                  									<th>S.No.</th>
                                  									<th>Product Name <small>(In which item is Used)</small></th>
                                  									<th>Qty</th>
                              								  </tr>
                            								</thead>
                            								<tbody>
                            								<?php
                              									$z=1;
                                                $ttlqty = 0;
                              									foreach($component_info as $value){
                                                  $ttlqty += $value->qty;
                              							?>
                              										<tr>
                              											<td><?php echo $z++;?></td>
                              											<td><?php echo '<a target="_blank" href="' . admin_url('product_new/view/' . $value->product_id) . '" >' . value_by_id('tblproducts',$value->product_id,'name') . '</a>'; ?></td>
                                                    <td><?php echo $value->qty; ?></td>
                              										</tr>
                              							<?php
                              									}
                            								?>
                            								</tbody>
                                            <tfoot style="background-color:#e5e7eb;">
                                              <td colspan="2">Total</td>
                                              <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                            </tfoot>
                        							  </table>
                      						</div>
	                             <?php } ?>
					                 </div>
						                  <div class="btn-bottom-toolbar text-right"></div>
                        </div>

                    </div>
                </div>

            </form>
		</div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){
		$("#attendance_form").submit();
	});

	$(document).on('change', '#month', function(){
		$("#attendance_form").submit();
	});
</script>


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){
		if (! $("input[name='staffid[]']").is(":checked")){
		   alert('Please Check Any Checkbox First!');
		   return false;
		}else{
			$("#salary_form").submit();
		}



	});
</script>

<script type="text/javascript">
      $(".myselect").select2();
</script>

</body>
</html>
