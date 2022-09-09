<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form target="_blank" method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('salary/paid_salary_print'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <div class="row">
                    	<div class="col-md-10"><h4 class="no-margin">Paid Salary Report</h4></div>	
                    	<div class="col-md-2"><a href="<?php  echo admin_url('salary/export_report'); ?>" class="form-control btn-info text-center" type="submit" value="print">Export Report</a></div>	
                	</div>
					
					
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-3">
							<label for="year" class="control-label"><?php echo 'Year'; ?> *</label>
							<select class="form-control" id="year" name="year" required="">
								<option value="" disabled selected >--Select One-</option>
								<?php
								$j = date('Y');
								for($i=2017; $i<=$j; $i++){
									?>
									<option value="<?php echo $i;?>" <?php if(!empty($year) && $year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
									<?php
								}
								?>
							</select>
						</div>
					
						<div class="form-group col-md-3">
							<label for="month" class="control-label"><?php echo 'Month'; ?> *</label>
							<select class="form-control" id="month" name="month" required="">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($month_info)){
									foreach($month_info as $row){
										?>
										<option value="<?php echo $row->id;?>" <?php if(!empty($month) && $month == $row->id){ echo 'selected';} ?>  ><?php echo $row->month_name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="type" class="control-label">Report Type *</label>
							<select class="form-control" id="type" name="type" required="">
								<option value="" disabled selected >--Select One-</option>
								<option value="1">Salary Account</option>
								<option value="2">Personal Account</option>
								<option value="3">Cash</option>
							</select>
						</div>
						
						<div class="form-group col-md-2 float-right" style="margin-top: 22px;">
							<button class="form-control btn-info" type="submit" value="print">Print Report</button>
						</div>
													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
							
							
						<div class="btn-bottom-toolbar text-right">
                           
                        </div>
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
