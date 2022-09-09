<html>
<head>
  <title>Salary Print</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">

  <style type="text/css">

	@page{
		margin:0px auto;
	}

	.print-wrapper{
		width:80%;
		margin:auto;
		font-family: 'PT Sans', sans-serif;
	}

  </style>

</head>

<body style="font-family: 'PT Sans', sans-serif;">
<div id="wrapper">
    <div class="print-wrapper">
<?php
$branch_info = get_company_info();
?>

<div class="btn-bottom-toolbar text-left">
		<button class="btn btn-info" onclick="goBack()">
		  Go Back
		</button>
</div>
		<table style="width: 100%; text-align: center;">

			<tr>
				<th style="text-align:center;">
				<?php
				if(!empty($branch_info)){
					echo '<h3>'.$branch_info[1]->value.'</h3>
					<h4>'.$branch_info[0]->value.'</h4>';
				}

				?>

				</th>
			</tr>

		</table>

<?php
if($staff_info->payment_mode == 1){
	$payment_mode = 'Salary Bank A/c';
}elseif($staff_info->payment_mode == 2){
	$payment_mode = 'Other Bank A/c';
}elseif($staff_info->payment_mode == 3){
	$payment_mode = 'Cash Salary';
}else{
	$payment_mode = '--';
}
?>
		<table style="width: 100%;">

			<tr>
				<td style="text-align:left; padding: 15px; width:50%;">
					<p><b>Pay slip cum Time card for the month of <?php echo get_month($salary_info->month);?>, <?php echo date('Y');?></b></p>
					<p><b>Payment Mode : <?php echo $payment_mode;?></b></p>
					<?php
					if($staff_info->payment_mode == 1 || $staff_info->payment_mode == 2){
						?>
						<p><b>Account No. : <?php echo $staff_info->account_no;?></b></p>
						<!-- <p><b>IFSC Code : <?php echo $staff_info->ifsc_code;?></b></p> -->
						<?php
					}
					?>
				</td>

				<td style="text-align:right; padding: 15px; width:50%;">
					<p><b>Issue Date : <?php echo date('d/m/Y',strtotime($salary_info->create_at));?></b></p>
					<!-- <p><b>Registration No. : <?php echo $staff_info->staffid;?></b></p> -->
					<p><b>Paid Days : <?php echo $salary_info->present_days;?></b></p>
				</td>
			</tr>

		</table>


		<table style="width: 100%; border:2px solid #111;margin-top: -2px;">

			<tr>
				<td style="text-align:left; padding: 15px; width:50%;">
					<p><b>Employee ID : <?php echo $staff_info->employee_id;?></b></p>
					<p><b>Employee Name : <?php echo $staff_info->firstname;?></b></p>
					<p><b>Father/Husband Name : <?php echo $staff_info->father_husband_name;?></b></p>
					<p><b>Date Of Joining : <?php echo date('d-M-Y',strtotime($staff_info->joining_date));?></b></p>
				</td>

				<td style="text-align:left; padding: 15px; width:50%;">
					<p><b>Designation : <?php echo get_designation($staff_info->designation_id);?></b></p>
					<p><b>Pan Card No. : <?php echo $staff_info->pan_card_no;?></b></p>
					<p><b>E.P.F. No. : <?php echo $staff_info->epf_no;?></b></p>
					<p><b>ESIC No. : <?php echo $staff_info->epic_no;?></b></p>

				</td>
			</tr>

		</table>

		<table style="width: 100%; border:2px solid #111;margin-top: -2px;">
			<tr>
				<td style="width:50%;">

					<table style="width: 100%;">

						<tr>
							<td style="text-align:left; padding: 15px;">
								<h4><b style="border-bottom: 2px solid #111;">Monthly Leave Status</b></h4>
								<table style="width:100%;">
									<tr>
										<td>CL</td>
										<td>EL</td>

									</tr>
									<tr>
										<td><?php echo $salary_info->paid_leave;?></td>
										<td><?php echo $salary_info->leave;?></td>

									</tr>
								</table>
							</td>
						</tr>

					</table>

				</td>

				<td style="width:50%;">

					<table style="width: 100%;">

						<tr>
							<td style="text-align:left; padding: 15px;">
								<table style="width:100%;">
									<tr>
										<td><b>Month Days</b></td>
										<td><b>Paid Days</b></td>
										<td><b>Present Days</b></td>
									</tr>
									<tr>
										<td><?php echo $salary_info->month_day;?></td>
										<td><?php echo $salary_info->present_days;?></td>
										<td><?php echo $salary_info->present_days; if($salary_info->half_days > 0){ echo '+'.$salary_info->half_days.' half day';}?></td>
									</tr>
								</table>
							</td>
						</tr>

					</table>

				</td>
			</tr>
		</table>



		<table style="width: 100%; border:2px solid #111;margin-top: -2px;">

			<tr>
				<td style="text-align:left; padding: 15px; width:50%; border-right: 2px solid #111;">
					<h4><b style="border-bottom: 2px solid #111;">Earnings</b></h4>

					<table style="width:100%;">
						<tr>
							<td style="padding:5px; width:33%;"></td>
							<td style="padding:5px; width:33%;"><b>Current Month</b></td>
						</tr>
						<tr>
							<td>BASIC</td>
							<td><?php echo $salary_info->bacis_salary;?></td>
						</tr>


						<tr>
							<td><?php echo salary_deduction_name(4);?></td>
							<td><?php echo $salary_info->ta_amt;?></td>
						</tr>

						<tr>
							<td><?php echo salary_deduction_name(5);?></td>
							<td><?php echo $salary_info->medical_amt;?></td>
						</tr>

						<tr>
							<td><?php echo salary_deduction_name(6);?></td>
							<td><?php echo $salary_info->hra_amt;?></td>
						</tr>

						<tr>
							<td><?php echo salary_deduction_name(7);?></td>
							<td><?php echo $salary_info->uniform_amt;?></td>
						</tr>

						<tr>
							<td><?php echo salary_deduction_name(8);?></td>
							<td><?php echo $salary_info->other_amt;?></td>
						</tr>

						<tr>
							<td>Over Time</td>
							<td><?php echo $salary_info->overtime_amt;?></td>
						</tr>

						<tr>
							<td>Arrear</td>
							<td><?php echo $salary_info->arrear_amt;?></td>
						</tr>

						<tr>
							<td>Incentive</td>
							<td><?php echo $salary_info->incentive_amt;?></td>
						</tr>
						<tr>
							<td>Rent</td>
							<td><?php echo $salary_info->rent_amt;?></td>
						</tr>
					</table>
				</td>

				<td style="text-align:left; padding: 15px; width:50%;">
					<h4><b style="border-bottom: 2px solid #111;">Deductions</b></h4>

					<table style="width:100%;">
						<tr>
							<td style="padding:5px; width:40%;"></td>
							<td style="padding:5px; width:60%;"><b>Current Month</b></td>
						</tr>
						<tr>
							<td>Loan</td>
							<td><?php echo $salary_info->loan;?></td>
						</tr>
						<tr>
							<td>Advance</td>
							<td><?php echo $salary_info->advance;?></td>
						</tr>
						<!-- <tr>
							<td>Expense</td>
							<td><?php echo $salary_info->expense;?></td>
						</tr> -->

						<tr>
							<td><?php echo salary_deduction_name(1);?></td>
							<td><?php echo $salary_info->pf_amt;?></td>
						</tr>

						<tr>
							<td><?php echo salary_deduction_name(2);?></td>
							<td><?php echo $salary_info->esic_amt;?></td>
						</tr>

						<tr>
							<td><?php echo salary_deduction_name(3);?></td>
							<td><?php echo $salary_info->pt_amt;?></td>
						</tr>

						<tr>
							<td>TDS</td>
							<td><?php echo $salary_info->tds_amt;?></td>
						</tr>

						<?php
						if($salary_info->lockDownDeduction_amt > 0){
						?>
						<tr>
							<td>Lock Down</td>
							<td><?php echo $salary_info->lockDownDeduction_amt;?></td>
						</tr>
						<?php
						}
            if($salary_info->outstanding_amt > 0){
						?>
            <tr>
							<td>Outstanding Amount</td>
							<td> <?php echo $salary_info->outstanding_amt;?></td>
						</tr>
						<?php
						}
						?>


					</table>

				</td>
			</tr>

		</table>

<?php
$total_d = ($salary_info->loan+$salary_info->advance+$salary_info->expense+$salary_info->pf_amt+$salary_info->esic_amt+$salary_info->pt_amt+$salary_info->tds_amt+$salary_info->lockDownDeduction_amt+$salary_info->outstanding_amt);
$total_e = ($salary_info->bacis_salary+$salary_info->ta_amt+$salary_info->medical_amt+$salary_info->hra_amt+$salary_info->uniform_amt+$salary_info->other_amt+$salary_info->overtime_amt+$salary_info->arrear_amt+$salary_info->incentive_amt+$salary_info->rent_amt);
?>
		<table style="width:100%;border:2px solid #111; margin-top: -2px;">
			<tr>

				<td style="width:50%;border-right: 2px solid #111;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:50%"><b>TOTAL</b></td>
							<td style="padding:10px; width:50%"><?php echo $total_e;?></td>
						</tr>
					</table>
				</td>

				<td style="width:50%;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:40%"></td>
							<td style="padding:10px; width:60%"><?php echo $total_d; ?></td>
						</tr>
					</table>
				</td>

			</tr>
		</table>



		<table style="width:100%; border:2px solid #111; margin-top: -2px;">
			<tr>

				<td style="width:50%;border-right: 2px solid #111;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:50%"><b>Net Pay</b></td>
							<td style="padding:10px; width:50%"><b><?php echo $salary_info->net_salary;?></b></td>
						</tr>
					</table>
				</td>

				<td style="width:50%;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:40%"></td>
							<td style="padding:10px; width:60%"></td>
						</tr>
					</table>
				</td>

			</tr>
		</table>

		<table style="width:100%; border:2px solid #111; margin-top: -2px;">
			<tr>

				<td style="padding:10px;">
					<b><?php if($salary_info->net_salary > 0){ echo convert_number_to_words(round($salary_info->net_salary)); }else{ echo '--'; } ?></b>
				</td>

			</tr>
		</table>



    </div>

    </div>
</div>
</body>



</html>

<script>
function goBack() {
    window.history.back();
}
</script>
