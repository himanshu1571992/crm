<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Salary Details</h4>
					<hr class="hr-panel-heading">

<?php
$month_info = $this->home_model->get_row('tblmonths', array('id'=>$month), ''  );


$loan_amt = get_loan_installment($staff_id);
/*$instalment_count = get_loan_installment_count($staff_id);
$ttl_instalment_count = get_ttl_loan_installment_count($staff_id);*/
$advance_amt = get_staff_advance_salary($staff_id);
$gross_salary = get_staff_net_salary($staff_id,$month,$year);

//Basic Salary
//$bacis_salary = ($gross_salary/2);
$bacis_salary = (50*$gross_salary/100);


//Calculate Other Allownce -- getting 80% of ctc
$g_salary = get_staff_gross_salary($staff_id,$month,$year);

$ctc_80 = (82*$gross_salary/100);
$other_amt  = ($g_salary - $ctc_80);


$payable_expense = convenience_balance($staff_id,$month,$year);




//ESIC
if($g_salary > '21000'){
	$esic_amt = '0';
}else{
	$esic_amt = get_salary_deduction(2,$g_salary);
}

//PT
if($staff_id != 1 && $staff_id != 26){
	$gender = $staff_info->gender;
	if($gender == 1){
		if($g_salary < '7500'){
			$pt_amt = '0';
		}elseif($g_salary >= '7500' && $g_salary <= '10000'){
			$pt_amt = '175';
		}elseif($g_salary > '10000'){
			if($month == '02'){
				$pt_amt = '300';
			}else{
				$pt_amt = '200';
			}
		}else{
			$pt_amt = '0';
		}
	}else{
		if($g_salary < '10000'){
			$pt_amt = '0';
		}elseif($g_salary > '10000'){
			if($month == '02'){
				$pt_amt = '300';
			}else{
				$pt_amt = '200';
			}
		}else{
			$pt_amt = '0';
		}
	}
}else{
	$pt_amt = '0';
}






//$net_salary = ($gross_salary-$d_amnt);

//Getting Earning Master
$ta_amt = get_salary_earning(4,$gross_salary);
$medical_amt = get_salary_earning(5,$gross_salary);
$hra_amt = get_salary_earning(6,$gross_salary);
$uniform_amt = get_salary_earning(7,$gross_salary);


//New pf logic
$all_allownce = ($ta_amt+$medical_amt+$uniform_amt+$other_amt+$bacis_salary);
$pf_amt = get_salary_deduction(1,$all_allownce);
if($pf_amt > '1800'){
	$pf_amt = '1800';
}


//$d_amnt = ($payable_expense+$advance_amt+$loan_amt+$pf_amt+$esic_amt+$pt_amt);
$outstanding_amt = get_outstanding_amount($staff_id);
$d_amnt = ($advance_amt+$loan_amt+$pf_amt+$esic_amt+$pt_amt+$outstanding_amt);

$e_amnt = ($bacis_salary+$ta_amt+$medical_amt+$hra_amt+$uniform_amt+$other_amt);

$net_salary = ($e_amnt-$d_amnt);

$amt = ($net_salary+$loan_amt);




?>

<input type="hidden" id="temp_loan" value="<?php echo $loan_amt; ?>">

					<div class="row">

					<div class="form-group col-md-3" app-field-wrapper="date">
						<label for="paid_date" class="control-label">Paid Date</label>
						<div class="input-group date">
							<input id="paid_date" required name="paid_date" class="form-control datepicker" value="<?php echo (isset($s_date) && $s_date != "") ? $s_date : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
						</div>
					</div>

						<div class="col-md-12 salary-dtls">

							<span class="pull-left"><b>Name : </b> <?php echo $staff_info->firstname;?></span>
							<span class="pull-right"><b>Date : </b> <?php if(!empty($month_info)){ echo $month_info->month_name.' / '.$year;} ?></span>
						</div>
					<hr>

					<!--<div class="row">
					<div class="col-md-12">
						<button class="btn btn-info pull-right" id="edit_field" >Edit Fields</button>
					</div>
					</div>-->

					<div class="col-md-6">
						<h4><u>Earning</u></h4>
						<hr>
						<table class="table">

								<tbody>

									<tr>
										<td><b>Basic Salary</b></td>
										<td><input type="text" name="bacis_salary" id="bacis_salary" value="<?php echo number_format($bacis_salary,2, '.', ''); ?>" class="input-control edit_field"></td>
									</tr>

									<tr>
										<td><?php echo salary_deduction_name(4);?></td>
										<td><input type="text" name="ta_amt" id="ta_amt" value="<?php if(!empty($ta_amt)){ echo number_format($ta_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (+)</td>
									</tr>

									<tr>
										<td><?php echo salary_deduction_name(5);?></td>
										<td><input type="text" name="medical_amt" id="medical_amt" value="<?php if(!empty($medical_amt)){ echo number_format($medical_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (+)</td>
									</tr>

									<tr>
										<td><?php echo salary_deduction_name(6);?></td>
										<td><input type="text" name="hra_amt" id="hra_amt" value="<?php if(!empty($hra_amt)){ echo number_format($hra_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (+)</td>
									</tr>

									<tr>
										<td><?php echo salary_deduction_name(7);?></td>
										<td><input type="text" name="uniform_amt" id="uniform_amt" value="<?php if(!empty($uniform_amt)){ echo number_format($uniform_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (+)</td>
									</tr>

									<tr>
										<td><?php echo salary_deduction_name(8);?></td>
										<td><input type="text" name="other_amt" id="other_amt" value="<?php if(!empty($other_amt)){ echo number_format($other_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (+)</td>
									</tr>

									<tr>
										<td>Over Time</td>
										<td><input type="text" name="overtime_amt" id="overtime_amt" value="0.00" class="input-control edit_field"> (+)</td>
									</tr>

									<tr>
										<td>Arrear</td>
										<td><input type="text" name="arrear_amt" id="arrear_amt" value="0.00" class="input-control edit_field"> (+)</td>
									</tr>

									<tr>
										<td>Incentive</td>
										<td><input type="text" name="incentive_amt" id="incentive_amt" value="0.00" class="input-control edit_field"> (+)</td>
									</tr>
									<tr>
										<td>Rent</td>
										<td><input type="text" name="rent_amt" id="rent_amt" value="0.00" class="input-control edit_field"> (+)</td>
									</tr>
								</tbody>

								  </table>

					</div>


					<div class="col-md-6">
						<h4><u>Deduction</u></h4>
						<hr>


						<table class="table">

								<tbody>
									<tr>
										<td>Loan(instalment)</td>
										<td><input type="text" readonly="" name="loan" id="loan" value="<?php if(!empty($loan_amt)){ echo $loan_amt; }else{ echo '0.00';}?>" class="input-control edit_field">
										<?php
										if(!empty($loan_amt)){
											?>
											<input name="leave_loan" value="1" type="checkbox" id="leave_loan" data-to-table="tasks"> <label for="leave_loan">Leave Loan Amount  <a target="_blank" href="<?php echo base_url('admin/requests/staff_loan_details/'.$staff_id);?>">(Show Installments)</a></label></td>
											<?php
										}
										?>



									</tr>

									<tr>
										<td>Advance</td>
										<td><input type="text" name="advance" id="advance" value="<?php if(!empty($advance_amt)){ echo number_format($advance_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (-) <?php if(!empty($advance_amt)){ ?> <button type='button' class='btn-sm btn-info advanceView' value="<?php echo $staff_id; ?>" data-toggle='modal' data-target='#myModalpercent'>Show Details</button>  <?php } ?> </td>
									</tr>

									<!-- <tr>
										<td>Expense(payable)</td>
										<td><input type="text" name="expense" id="expense" value="<?php if(!empty($payable_expense)){ echo number_format($payable_expense,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (-)</td>
									</tr> -->

									<tr>
										<td><?php echo salary_deduction_name(1);?></td>
										<td><input type="text" name="pf_amt" id="pf_amt" value="<?php if(!empty($pf_amt)){ echo number_format($pf_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (-)</td>
									</tr>

									<tr>
										<td><?php echo salary_deduction_name(2);?></td>
										<td><input type="text" name="esic_amt" id="esic_amt" value="<?php if(!empty($esic_amt)){ echo number_format($esic_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (-)</td>
									</tr>

									<tr>
										<td><?php echo salary_deduction_name(3);?></td>
										<td><input type="text" name="pt_amt" id="pt_amt" value="<?php if(!empty($pt_amt)){ echo number_format($pt_amt,2, '.', ''); }else{ echo '0.00';}?>" class="input-control edit_field"> (-)</td>
									</tr>

									<tr>
										<td>TDS</td>
										<td><input type="text" name="tds_amt" id="tds_amt" value="0.00" class="input-control edit_field"> (-)</td>
									</tr>

									<tr>
										<td>Lock Down</td>
										<td><input type="text" name="lockDownDeduction_amt" id="lockDownDeduction_amt" value="0.00" class="input-control edit_field"> (-)</td>
									</tr>

                  <tr>
										<td>Outstanding Amount</td>
										<td><input type="text" name="outstanding_amt" id="outstanding_amt" value="<?php echo get_outstanding_amount($staff_id); ?>" class="input-control edit_field"> (-)</td>
									</tr>

								</tbody>

								  </table>

					</div>



					<div class="col-md-12">
						<h3><span>Net Salary</span> <span id="g_salary"><b><?php echo number_format($net_salary,2, '.', '');?></b></span></h3>
					</div>


						<div class="col-md-12">


								  <div class="text-right">
								<button class="btn btn-info" value="1" name="preview" type="submit">
									<?php echo 'Preview'; ?>
								</button>
								 <button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo 'Pay'; ?>
								</button>
								<button class="btn btn-info" value="1" name="print" type="submit">
									<?php echo 'Pay and Print'; ?>
								</button>
							</div>

							</div>

							<input type="hidden" name="gross_salary" value="<?php echo $gross_salary; ?>">
							<input type="hidden" id="net_salary" name="net_salary" value="<?php echo $net_salary; ?>">
							<?php
							/*
							<input type="hidden" name="advance" value="<?php if(!empty($advance_amt)){ echo $advance_amt; }else{ echo '0.00';}?>">
							<input type="hidden" name="expense" value="<?php if(!empty($payable_expense)){ echo $payable_expense; }else{ echo '0.00';}?>">
							<input type="hidden" name="bacis_salary" value="<?php echo $bacis_salary; ?>">
							<input type="hidden" name="pf_amt" value="<?php echo $pf_amt; ?>">
							<input type="hidden" name="esic_amt" value="<?php echo $esic_amt; ?>">
							<input type="hidden" name="pt_amt" value="<?php echo $pt_amt; ?>">

							<input type="hidden" name="ta_amt" value="<?php echo $ta_amt; ?>">
							<input type="hidden" name="medical_amt" value="<?php echo $medical_amt; ?>">
							<input type="hidden" name="hra_amt" value="<?php echo $hra_amt; ?>">
							<input type="hidden" name="uniform_amt" value="<?php echo $uniform_amt; ?>">
							<input type="hidden" name="other_amt" value="<?php echo $other_amt; ?>">
							*/
							?>
							<input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
							<input type="hidden" name="month" value="<?php echo $month; ?>">
							<input type="hidden" name="year" value="<?php echo $year; ?>">

					</div>


							 <div class="btn-bottom-toolbar text-right">

                        </div>
                        </div>

                    </div>
                </div>

            <?php echo form_close(); ?>
		</div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<div id="myModalpercent" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:900px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advance Salary Details</h4>
            </div>
            <div class="modal-body">
                <div id="advanceDetailsModel"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	/*$(document).on('change', '#loan', function(){
		var loan = parseInt($(this).val());
		var amt = parseInt(<?php echo $amt; ?>);

		var f_value = (amt - loan);

		$("#g_salary").html(f_value);
		$("#net_salary").val(f_value);
	});
	*/

	//New Code
	$(document).on('keyup change', '.edit_field', function(){
		var bacis_salary = parseFloat($("#bacis_salary").val());
		var ta_amt = parseFloat($("#ta_amt").val());
		var medical_amt = parseFloat($("#medical_amt").val());
		var hra_amt = parseFloat($("#hra_amt").val());
		var uniform_amt = parseFloat($("#uniform_amt").val());
		var other_amt = parseFloat($("#other_amt").val());
		var overtime_amt = parseFloat($("#overtime_amt").val());
		var arrear_amt = parseFloat($("#arrear_amt").val());
		var incentive_amt = parseFloat($("#incentive_amt").val());
		var rent_amt = parseFloat($("#rent_amt").val());


		var loan = parseFloat($("#loan").val());
		var advance = parseFloat($("#advance").val());
		//var expense = parseFloat($("#expense").val());
		var pf_amt = parseFloat($("#pf_amt").val());
		var esic_amt = parseFloat($("#esic_amt").val());
		var pt_amt = parseFloat($("#pt_amt").val());
		var tds_amt = parseFloat($("#tds_amt").val());
		var lockDownDeduction_amt = parseFloat($("#lockDownDeduction_amt").val());
		var outstanding_amt = parseFloat($("#outstanding_amt").val());

		var e_amnt = (bacis_salary+ta_amt+medical_amt+hra_amt+uniform_amt+other_amt+overtime_amt+arrear_amt+incentive_amt+rent_amt);
		//var d_amnt = (expense+advance+loan+pf_amt+esic_amt+pt_amt+tds_amt+lockDownDeduction_amt);
		var d_amnt = (advance+loan+pf_amt+esic_amt+pt_amt+tds_amt+lockDownDeduction_amt+outstanding_amt);
		var f_value = parseFloat(e_amnt - d_amnt).toFixed(2);

		$("#g_salary").html(f_value);
		$("#net_salary").val(f_value);
	});


</script>



<script type="text/javascript">
	$(document).on('click', '#leave_loan', function(){

		var loan_amt = $("#temp_loan").val();


		if($(this).prop('checked') === true){

			var bacis_salary = parseFloat($("#bacis_salary").val());
			var ta_amt = parseFloat($("#ta_amt").val());
			var medical_amt = parseFloat($("#medical_amt").val());
			var hra_amt = parseFloat($("#hra_amt").val());
			var uniform_amt = parseFloat($("#uniform_amt").val());
			var other_amt = parseFloat($("#other_amt").val());
			var overtime_amt = parseFloat($("#overtime_amt").val());
			var arrear_amt = parseFloat($("#arrear_amt").val());
			var incentive_amt = parseFloat($("#incentive_amt").val());
			var rent_amt = parseFloat($("#rent_amt").val());

			var loan = 0;
			var advance = parseFloat($("#advance").val());
			//var expense = parseFloat($("#expense").val());
			var pf_amt = parseFloat($("#pf_amt").val());
			var esic_amt = parseFloat($("#esic_amt").val());
			var pt_amt = parseFloat($("#pt_amt").val());
			var tds_amt = parseFloat($("#tds_amt").val());
			var lockDownDeduction_amt = parseFloat($("#lockDownDeduction_amt").val());

			var e_amnt = (bacis_salary+ta_amt+medical_amt+hra_amt+uniform_amt+other_amt+overtime_amt+arrear_amt+incentive_amt+rent_amt);
			//var d_amnt = (expense+advance+loan+pf_amt+esic_amt+pt_amt+tds_amt+lockDownDeduction_amt);
			var d_amnt = (advance+loan+pf_amt+esic_amt+pt_amt+tds_amt+lockDownDeduction_amt);

			var f_value = parseFloat(e_amnt - d_amnt).toFixed(2);

			$("#g_salary").html(f_value);
			$("#net_salary").val(f_value);



			$("#loan").val("0.00");
		}else{

			var bacis_salary = parseFloat($("#bacis_salary").val());
			var ta_amt = parseFloat($("#ta_amt").val());
			var medical_amt = parseFloat($("#medical_amt").val());
			var hra_amt = parseFloat($("#hra_amt").val());
			var uniform_amt = parseFloat($("#uniform_amt").val());
			var other_amt = parseFloat($("#other_amt").val());
			var overtime_amt = parseFloat($("#overtime_amt").val());
			var arrear_amt = parseFloat($("#arrear_amt").val());
			var incentive_amt = parseFloat($("#incentive_amt").val());
			var rent_amt = parseFloat($("#rent_amt").val());

			var loan = loan_amt;
			var advance = parseFloat($("#advance").val());
			//var expense = parseFloat($("#expense").val());
			var pf_amt = parseFloat($("#pf_amt").val());
			var esic_amt = parseFloat($("#esic_amt").val());
			var pt_amt = parseFloat($("#pt_amt").val());
			var tds_amt = parseFloat($("#tds_amt").val());
			var lockDownDeduction_amt = parseFloat($("#lockDownDeduction_amt").val());

			var e_amnt = (bacis_salary+ta_amt+medical_amt+hra_amt+uniform_amt+other_amt+overtime_amt+arrear_amt+incentive_amt+rent_amt);
			//var d_amnt = (expense+advance+loan+pf_amt+esic_amt+pt_amt+tds_amt+lockDownDeduction_amt);
			var d_amnt = (advance+loan+pf_amt+esic_amt+pt_amt+tds_amt+lockDownDeduction_amt);

			var f_value = parseFloat(e_amnt - d_amnt).toFixed(2);

			$("#g_salary").html(f_value);
			$("#net_salary").val(f_value);




			$("#loan").val(loan_amt);
		}
	});


</script>


<script type="text/javascript">
    $('.advanceView').click(function () {
        var staff_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/salary_new/getAdvanceSalaryDetails'); ?>",
            data: {'staff_id': staff_id},
            success: function (response) {
                if (response != '') {
                    $("#advanceDetailsModel").html(response);
                }
            }
        })
    });
</script>


</body>
</html>
