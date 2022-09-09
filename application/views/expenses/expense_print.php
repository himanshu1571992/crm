<html>
	
	<head>
		
		<style type="text/css">
			@import url('https://fonts.googleapis.com/css?family=Roboto');
			
			@page{
				margin:0px 15px;
			}
			
			table{
				width:100%;
				border:1px solid #ccc;
				font-family: 'Roboto', sans-serif;
				font-size:15px;
			}
			
			.print_button {
				background-color: #08b3f6; /* Green */
				border: none;
				color: white;
				padding: 10px 25px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
			}
			
		</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
	</head>
	
	<body>
	
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td rowspan="3" style="padding:5px; border: 1px solid #111; border-right:none; width:20%;"><img width="250" height="80" src="<?php echo base_url('uploads/company/logo.png')?>" alt="Schach Engineers Pvt Ltd"></td>
				<td rowspan="3" style="padding:5px; border: 1px solid #111; border-left:none; width:20%;"><h2 style="text-transform: uppercase; margin: 0;">Expense Details</h2></td>
				<td style="padding:5px; border: 1px solid #111; border-left:none; width:20%;"><b>Total Expense :  <span id="ttl_amount"></span></b></td>
				<td colspan="2" style="padding:5px; border: 1px solid #111; width:20%;"><b>Advance : <span id="advance_amt"></span></b></td>
				<td colspan="3" style="padding:5px; border: 1px solid #111; width:20%;"><b>Date : <?php echo $f_date.' To '.$t_date;?></b></td>
			</tr>
			
			<tr>
				<td style="padding:5px; border: 1px solid #111; border-left:none;"><b>Paid By Other :  <span id="ttl_paid"></span></b></td>
				<td colspan="2" style="padding:5px; border: 1px solid #111;"><b>Final Amount : <span id="final_amt"></span>	</b></td>
				<td colspan="3" style="padding:5px; border: 1px solid #111;"><b>Name : <?php echo get_employee_fullname($staff_id);?></b></td>
			</tr>
			
			<tr>
				<td style="padding:5px; border: 1px solid #111; border-left:none;"><b>Employee ID : <?php echo 'EMP-'.$staff_id;?></b></td>
				<td colspan="2" style="padding:5px; border: 1px solid #111;"><b>Contact No. : <?php echo get_staff_info($staff_id)->phonenumber;?>	</b></td>
				<td colspan="3" style="padding:5px; border: 1px solid #111;"><b>Branch : <?php echo get_branch($staff_id);?></b></td>
			</tr>
		</table>
		
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:5%;">Date</th>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:15%;">ID</th>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:20%;">Details</th>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:10%;">Category</th>
					<th colspan="7" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:60%;">Expense Details</th>
				</tr>
				
				<tr>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Head</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">From</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">To</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">KM</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Paid By</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Amount</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Advance</th>
				</tr>				
			</thead>
			
			<tbody>
			
						
			<?php
			if(!empty($date_list)){
				$ttl_advance = 0;
				$ttl_amount = 0;
				$ttl_paid = 0;
				foreach($date_list as $date){
					$expense_info = get_expense($staff_id,$date);
					$request_info = get_request($staff_id,$date);
					$transfer_add_info = get_expense_transfer_add($staff_id,$date);
					$transfer_less_info = get_expense_transfer_less($staff_id,$date);
					if(!empty($expense_info)){
						foreach($expense_info as $row_1){	
						$sub_expense_list = get_expense_by_parent($row_1->id);
						$sub_expense_count = count($sub_expense_list)+1;

						
						$expense_paid_by = get_expense_paidy($row_1->id);

						if($row_1->paidby_employee == $staff_id){
							$ttl_amount += $row_1->amount;	
						}else{
							if($expense_paid_by != '--'){
								$ttl_paid += $row_1->amount;
							}else{
								$ttl_amount += $row_1->amount;	
							}
						}
						
						
							
						
						?>
						<tr>
							<td rowspan="<?php echo $sub_expense_count; ?>" style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo date('d/m/Y',strtotime($date));?></td>
							<td rowspan="<?php echo $sub_expense_count; ?>" style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo 'EXP-'.get_short(get_expense_category($row_1->category)).'-'.number_series($row_1->id);?></td>
							<td rowspan="<?php echo $sub_expense_count; ?>" style="text-align:left; padding:8px; border: 1px solid #111;">
								Purpose - <?php echo get_expense_purpose($row_1->id); ?> <br>
								<?php echo get_expense_related($row_1->id);?>
							</td>
							<td rowspan="<?php echo $sub_expense_count; ?>" style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_expense_category($row_1->category);?></td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_expense_head($row_1->id); ?></td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_expense_from($row_1->id); ?></td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_expense_to($row_1->id); ?></td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_kilometer_limit($row_1->id); ?></td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $expense_paid_by; ?></td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $row_1->amount; ?></td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">0</td>
						</tr>
						<?php
						if(!empty($sub_expense_list)){
							foreach($sub_expense_list as $row_2){
								
								$sub_expense_paid_by = get_expense_paidy($row_2->id);


								if($row_2->paidby_employee == $staff_id){
									$ttl_amount += $row_2->amount;
								}else{
									if($sub_expense_paid_by != '--'){
										$ttl_paid += $row_2->amount;
									}else{
										$ttl_amount += $row_2->amount;
									}
								}

							
								
								?>
								<tr>
									<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_expense_head($row_2->id); ?></td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_expense_from($row_2->id); ?></td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_expense_to($row_2->id); ?></td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_kilometer_limit($row_2->id); ?></td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $sub_expense_paid_by; ?></td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $row_2->amount; ?></td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">0</td>
								</tr>
								<?php
							}
						}
						}
					}	

					if(!empty($request_info)){
						foreach($request_info as $row_3){
							$ttl_advance += $row_3->approved_amount;	
							
							$cat = get_last(get_request_category($row_3->category));	
							$cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_3->id);
						?>
							<tr>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo date('d/m/Y',strtotime($date));?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $cat_id; if($row_3->pettycash_id > 0 ){ echo '<small style="color: #e8283f;">(Petty Cash)</small>'; } ?></td>
								<td style="text-align:left; padding:8px; border: 1px solid #111;"><?php echo $row_3->reason; ?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_request_category($row_3->category);?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">0.00</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $row_3->approved_amount; ?></td>
							</tr>
						<?php
						}
					}
					
					
					if(!empty($transfer_less_info)){
						foreach($transfer_less_info as $row_5){
							$ttl_advance += $row_5->approved_amount;	
							
							$cat = get_last(get_request_category($row_5->category));	
							$cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_5->id);
						?>
							<tr>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo date('d/m/Y',strtotime($date));?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $cat_id; if($row_5->pettycash_id > 0 ){ echo '<small style="color: #e8283f;">(Petty Cash)</small>'; } ?></td>
								<td style="text-align:left; padding:8px; border: 1px solid #111;"><?php echo $row_5->reason; ?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_request_category($row_5->category);?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">0.00</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $row_5->approved_amount; ?></td>
								
							</tr>
						<?php
						}
					}
					
					
					if(!empty($transfer_add_info)){
						foreach($transfer_add_info as $row_4){
							$ttl_amount += $row_4->approved_amount;	
							
							$cat = get_last(get_request_category($row_4->category));	
							$cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_4->id);
						?>
							<tr>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo date('d/m/Y',strtotime($date));?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $cat_id; if($row_4->pettycash_id > 0 ){ echo '<small style="color: #e8283f;">(Petty Cash)</small>'; } ?></td>
								<td style="text-align:left; padding:8px; border: 1px solid #111;"><?php echo $row_4->reason; ?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo get_request_category($row_4->category);?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;"><?php echo $row_4->approved_amount; ?></td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">0.00</td>
							</tr>
						<?php
						}
					}
				}
			}
			
			?>
			
					
			</tbody>
			<?php
			if($ttl_amount > 0 || $ttl_advance > 0 || $ttl_paid > 0){
				?>
				<tfoot>
					<tr>
						<td colspan="9" style="background:#f0f0f0; text-align:center; padding:8px; border: 1px solid #111;"><b>Total</b></td>
						<td style="background:#f0f0f0; text-align:center; padding:8px; border: 1px solid #111;"><b><?php echo $ttl_amount; ?></b></td>
						<td style="background:#f0f0f0; text-align:center; padding:8px; border: 1px solid #111;"><b><?php echo $ttl_advance; ?></b></td>
					</tr>
				</tfoot>
				<?php
			}else{
				echo '<tfoot>
					<tr>
						<td colspan="11" style="background:#f0f0f0; text-align:center; padding:8px; border: 1px solid #111;"><b>No Record Found!</b></td>
					</tr>
				</tfoot>';
			}
			?>
			
			
			
		</table>
		
		<div id="print_div" style="text-align:right; margin-top:15px;">
		<button class="print_button" onclick="printFunction()">Print Report</button>
		<a class="print_button" href="<?php echo site_url('expenses/download_pdf/'.$from_date.'/'.$to_date.'/'.$staff_id);?>">Download PDF</a>
		
		<a class="print_button" href="<?php echo site_url('expenses/expense_print_details/'.$from_date.'/'.$to_date.'/'.$staff_id);?>">Get Details</a>
		</form>
		
		</div>
	</body>
	
</html>


<script type="text/javascript">

$( document ).ready(function() {
    $('#advance_amt').html(<?php echo $ttl_advance; ?>); 		
    $('#ttl_amount').html(<?php echo $ttl_amount; ?>); 		
    $('#ttl_paid').html(<?php echo $ttl_paid; ?>); 		
    $('#final_amt').html(parseInt(<?php echo ($ttl_amount - $ttl_advance); ?>)); 		
});	
</script> 


<script>
function printFunction() {
	$('#print_div').hide();
    window.print();
}
</script>