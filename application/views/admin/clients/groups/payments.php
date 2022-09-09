<?php if(isset($client)){ 
$where = "cp.client_id = '".$client->userid."' ";
if(!empty($_GET)){
  extract($this->input->get());
  if(!empty($from_date) && !empty($to_date)){
    $where .= "and p.date between '".$from_date."' and '".$to_date."' ";  
  } 
 
}
$payment_list = $this->db->query("SELECT cp.client_id, p.* FROM tblinvoicepaymentrecords as p LEFT JOIN tblclientpayment as cp ON cp.id = p.pay_id where ".$where." ")->result();
?>
<h4 class="customer-profile-group-heading">Payments</h4>
<div class="row">
    <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('clients/payments_search'); ?>">
      <input type="hidden" name="clientid" value="<?php echo $client->userid; ?>">
     <div class="col-md-3">
        <div class="form-group select-placeholder">
            <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">
                <option value="">--Select One--</option>
                <option value="1" <?php if(!empty($range) && $range == 1){ echo 'selected'; } ?>>Today</option>
                <option value="2" <?php if(!empty($range) && $range == 2){ echo 'selected'; } ?>>This Week</option>
                <option value="3" <?php if(!empty($range) && $range == 3){ echo 'selected'; } ?>>This Month</option>
                <option value="4" <?php if(!empty($range) && $range == 4){ echo 'selected'; } ?>>Last Month</option>
                <option value="5" <?php if(!empty($range) && $range == 5){ echo 'selected'; } ?>>This Year</option>
                <option value="period" <?php if(!empty($range) && $range == 'period'){ echo 'selected'; } ?>>Custom Date</option>
            </select>
        </div>
       
    </div>
     <div class="col-md-3">
           <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">
              <div class="input-group date">
                  <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
              </div>
          </div>
      </div>
      <div class="col-md-3">
          <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">
               <div class="input-group date">
                  <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
              </div>
          </div>
      </div>

    
    <div class="form-group col-md-2 float-right">
      <button class="form-control btn-info" type="submit">Search</button>
    </div>
    </form>

    <div class="col-md-12">  
    <hr>                             
        <table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Payment No.</th>
										<th>Payment for</th>
										<th>Invoice/Debitnote</th>
										<th>Service Type</th>
										<th>Payment Mode</th>										
										<th>TDS %</th>
										<th>Date</th>
										<th>Amount</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									$ttl_amt = 0;
									if(!empty($payment_list)){
										$z=1;
										foreach($payment_list as $row){	
												$service_type = '--';
												if($row->paymentmethod == 2){
													$service_id = value_by_id('tblinvoices',$row->invoiceid,'service_type');
												   if($service_id == 1){
												   		$service_type = 'Rent';
												   }else{
												   		$service_type = 'Sales';
												   }
												}else{
													$debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$row->debitnote_no."' ")->row();
		        									$debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$row->debitnote_no."' ")->row();	
												}
											    if($row->paymentmode == 1){
											      $payment_name = 'Cheque';
											    }elseif($row->paymentmode == 2){
											      $payment_name = 'NEFT';
											    }elseif($row->paymentmode == 3){
											      $payment_name = 'Cash';
											    }
											    $ttl_amt += $row->amount;
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><a target="_blank" href="<?php echo admin_url('payments/payment/' . $row->id); ?>"><?php echo str_pad($row->id, 4, '0', STR_PAD_LEFT);?></a></td>
												<td><?php echo ($row->paymentmethod == 2) ? 'Invoice' : 'Debitnote';  ?></td>
												<?php
												if($row->paymentmethod == 2){
													?>
													
													<td><?php echo '<a target="_blank" href="' . admin_url('invoices/list_invoices/' . $row->invoiceid) . '">' . format_invoice_number($row->invoiceid) . '</a>'; ?></td>
													<?php
												}else{
													if(!empty($debit_info)){
														echo '<td><a target="_blank" href="' . admin_url('debit_note/download_pdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
													}elseif(!empty($debitpayment_info)){
														echo '<td><a target="_blank" href="' . admin_url('debit_note/download_paymentpdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
													}else{
														echo '<td>--</td>';
													}
												}
												?>
													
												<td><?php echo $service_type;?></td>												
												<td><?php echo $payment_name;?></td>												
												<td><?php echo $row->tds;?></td>
												<td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
												<td class="text-center"><?php echo $row->amount;?></td>
												
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="10"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
									<tfoot>
				                       <tr>
				                          <td colspan="8" class="text-center"><b>Total Amount</b></td>
				                          <td><b><?php echo $ttl_amt; ?></b></td>
				                        </tr>
				                  </tfoot>
								  </table>
      </div>                  
  </div>

<?php } ?>

