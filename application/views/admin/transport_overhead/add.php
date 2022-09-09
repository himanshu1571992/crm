<?php init_head(); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<?php echo form_open($this->uri->uri_string(), array('id' => 'request_form', 'class' => 'proposal-form', 'onsubmit' => "return check_condition();")); ?>
				<div class="col-md-12">
					<div class="panel_s">
						<div class="panel-body">
							<h4 class="no-margin"><?php echo $title; ?></h4>
							<hr class="hr-panel-heading" />
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4" style="margin-bottom: -7px;">
										<div class="form-group">
											<label for="head" class="control-label">Head</label>
											<?php echo $headname = (!empty($overhead_info)) ? $overhead_info->head: ''; ?>
											<input id="text" name="head" class="form-control" value="<?php echo $headname; ?>" required>
										</div>
									</div>
									<div class="col-md-4" style="margin-bottom: -7px;">
										<div class="form-group">
											<label for="date" class="control-label">Date</label>
											<div class="input-group date">
                                                <input id="date" name="date" required='' class="form-control datepicker" value="<?php echo (!empty($overhead_info)) ? _d($overhead_info->date) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
										</div>
									</div>
									<div class="col-md-4" style="margin-bottom: -7px;">
										<div class="form-group">
											<label for="amount" class="control-label">Amount</label>
											<input type="number" id="amount" step="any" name="amount" class="form-control" value="<?php echo (!empty($overhead_info)) ? $overhead_info->amount : ''; ?>" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="remark" class="control-label"><?php echo 'Remark'; ?></label>
											<?php echo $remark = (!empty($overhead_info)) ? $overhead_info->remark: ''; ?>
											<textarea id="remark" name="remark" class="form-control" rows="7"><?php echo $remark; ?></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="btn-bottom-toolbar text-right">
								<button type="submit" id="submit_request" class="btn btn-info">Submit</button>
							</div>
						</div>
					</div>	 
				</div>
			
			<?php echo form_close(); ?>
			<div class="btn-bottom-pusher"></div>
		</div>
	</div>

<?php init_tail(); ?>

</body>
</html> 
<script type="text/javascript">
	$('#branch_id').change(function(){

		var branch_id = $(this).val();
		if (branch_id != ''){
			$.ajax({
				type    : "POST",
				url     : "<?php echo base_url('admin/requests_new/get_branch_person'); ?>",
				data    : {'branch_id' : branch_id},
				success : function(response){
					if(response != ''){
						$("#person_id").html(response);
						$(".person_id").attr("required", "");
						$('.selectpicker').selectpicker('refresh');
					}
				}
			});
		}else{
			$(".person_id").removeAttr("required", "");
			$("#person_id").html("");
			$('.selectpicker').selectpicker('refresh');
		}
	});

	$('#transfer_type').change(function(){

		$(".branch_id").removeAttr("required", "");
		$(".pettycash_id").removeAttr("required", "");
		
		var type = $(this).val();
		if (type == '1'){
			$(".staff_div").show();
			$(".pattycash_div").hide();
			$(".branch_id").attr("required", "");
		}else{
			$(".staff_div").hide();
			$(".pattycash_div").show();
			$(".pettycash_id").attr("required", "");
		}
	});

	function staffdropdown()
    {
        $.each($("#assign option:selected"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().attr('selected', 'selected');
        });
        $('.selectpicker').selectpicker('refresh');
        $.each($("#assign option:not(:selected)"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().removeAttr('selected');
        });
        $('.selectpicker').selectpicker('refresh');
    }

	function check_condition(){
		var amount = document.getElementById("amount").value;
		var wallet_amount = '<?php echo $wallet_amount; ?>';
		var condition = true;
		if (parseFloat(amount) > parseFloat(wallet_amount)){
			alert("Can't transfer amount greater then wallet amount."); 
            condition = false;
            return false;
		}
		if(condition){
            // condition =  confirm('Do you want to submit the form?');
            return true;
        }
	}
</script>