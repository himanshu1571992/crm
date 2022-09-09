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
	
	#wrapper{
		width:800px;
		margin:auto;
	}
	
	.print-wrapper{
		padding:15px;
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

		
		
		<table style="width: 100%;">
		
			<tr>
				<td style="text-align:left; padding: 15px; width:50%;">
					<p><b>Computer Generated CTC Structure		</b><p>
					
				</td>
				
				<td style="text-align:right; padding: 15px; width:50%;">
					<p><b>Issue Date : <?php echo date('d/m/Y');?></b></p>
					
				</td>
			</tr>
		
		</table>
		
		
		<table style="width: 100%; border:2px solid #111;margin-top: -2px;">
		
			<tr>
				<td style="text-align:left; padding: 15px; width:50%;">
					<p><b>Employee Name : <?php echo $name;?></b></p>
				</td>
				
			</tr>
		
		</table>
		
		
		

		
		<table style="width: 100%; border:2px solid #111;margin-top: -2px;">
			
			<tr>
				<td style="text-align:left; padding:8px; width:50%; border-right: 2px solid #111;">
					<h4><b style="border-bottom: 2px solid #111;">Cost To Company</b></h4>
					
					<table style="width:100%;">
						<tr>
							<td style="padding:5px; width:33%;"></td>
							<td style="padding:5px 0; width:25%; text-align: right;"><b>Monthly</b></td>
							<td style="padding:5px 0; width:25%; text-align: right;"><b>Annually</b></td>
						</tr>
						<tr>
							<td>Basic</td>
							<td style="text-align: right;"><?php echo round($ctc_info['basic']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['basic'] * 12); ?></td>
						</tr>
						

						<tr>
							<td>HRA</td>
							<td style="text-align: right;"><?php echo round($ctc_info['hra']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['hra'] * 12); ?></td>
						</tr>

						<tr>
							<td>Convence Allownce</td>
							<td style="text-align: right;"><?php echo round($ctc_info['convenience']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['convenience'] * 12); ?></td>
						</tr>
						

						<tr>
							<td>Medical Allownce</td>
							<td style="text-align: right;"><?php echo round($ctc_info['medical']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['medical'] * 12); ?></td>
						</tr>
						

						<tr>
							<td>Uniform Allownce</td>
							<td style="text-align: right;"><?php echo round($ctc_info['uniform']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['uniform'] * 12); ?></td>
						</tr>

						<tr>
							<td>Other Allownce</td>
							<td style="text-align: right;"><?php echo round($ctc_info['other_allowance']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['other_allowance']*12); ?></td>
						</tr>
						
						
					</table>
				</td>

<?php
	$ttl_montly_hand = ($ctc_info['gross']-$ctc_info['pf']-$ctc_info['employee_esic']-$ctc_info['pt']);
?>
				
				<td style="text-align:left; padding:8px; width:50%;">
					<h4><b style="border-bottom: 2px solid #111;">In Hand Salary</b></h4>
					
					<table style="width:100%;">
						<tr>
							<td style="padding:5px; width:40%;"></td>
							<td style="padding:5px 0; width:25%; text-align: right;"><b>Monthly</b></td>
							<td style="padding:5px 0; width:25%; text-align: right;"><b>Annually</b></td>
						</tr>
						<tr>
							<td>Gross Salary</td>
							<td style="text-align: right;"><?php echo round($ctc_info['gross']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['gross']*12); ?></td>
						</tr>

						<tr>
							<td>Employee PF</td>
							<td style="text-align: right;"><?php echo round($ctc_info['pf']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['pf']*12); ?></td>
						</tr>

						<tr>
							<td>Employee ESIC</td>
							<td style="text-align: right;"><?php echo round($ctc_info['employee_esic']); ?></td>
							<td style="text-align: right;"><?php echo round($ctc_info['employee_esic'] * 12); ?></td>
						</tr>

						<tr>
							<td>PT</td>
							<td style="text-align: right;"><?php echo round($ctc_info['pt']); ?></td>
							<td style="text-align: right;"><?php echo ($ctc_info['pt'] == 0)? 0 : 2500; ?></td>
						</tr>


						
						
					</table>	
					
				</td>
			</tr>
			
		</table>					
		
		<table style="width:100%;border:2px solid #111; margin-top: -2px;">
			<tr>
			
				<td style="width:50%;border-right: 2px solid #111;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:50%"><b>Gross Salary </b></td>
							<td style="padding:10px; width:13%; text-align: right;"><b><?php echo round($ctc_info['gross']); ?></b></td>
							<td style="padding:10px; width:13%; text-align: right;"><b><?php echo round($ctc_info['gross']*12); ?></b></td>
						</tr>
					</table>
				</td>

<?php
	if($ctc_info['pt'] > 0){
		$y_pt = 2500;		
	}else{
		$y_pt = 0;
	}

	$y_gross = ($ctc_info['gross']*12);
	$y_pf = ($ctc_info['pf']*12);
	$y_esic = ($ctc_info['employee_esic']*12);

	$year_hand = ($y_gross-$y_pf-$y_esic-$y_pt);
?>

				<td style="width:50%;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:40%"><b>In Hand</b></td>
							<td style="padding:10px; width:30%; text-align: right;"><b><?php echo round($ttl_montly_hand); ?></b></td>
							<td style="padding:10px; width:30%; text-align: right;"><b><?php echo round($year_hand); ?></b></td>
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
							<td style="padding:10px; width:40%">Employer PF</td>
							<td style="padding:10px; width:30%; text-align: right;"><?php echo round($ctc_info['pf']); ?></td>
							<td style="padding:10px; width:30%; text-align: right;"><?php echo round($ctc_info['pf']*12); ?></td>
						</tr>

						<tr>
							<td style="padding:10px; width:40%">Employer ESIC</td>
							<td style="padding:10px; width:30%; text-align: right;"><?php echo round($ctc_info['esic']); ?></td>
							<td style="padding:10px; width:30%; text-align: right;"><?php echo round($ctc_info['esic']*12); ?></td>
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


		<table style="width:100%;border:2px solid #111; margin-top: -2px;">
			<tr>
			
				<td style="width:50%;border-right: 2px solid #111;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:50%"><b>Monthly CTC </b></td>
							<td style="padding:10px; width:25%; text-align: right;"><b><?php echo round($ctc_info['monthly_ctc']);?></b></td>
							<td style="padding:10px; width:25%; text-align: right;"><b><?php echo round($ctc_info['monthly_ctc']*12);?></b></td>
						</tr>
					</table>
				</td>
				
				<td style="width:50%;">
					<table style="width:100%;">
						<!-- <tr>
							<td style="padding:10px; width:40%"></td>
							<td style="padding:10px; width:60%; text-align: right;">30</td>
						</tr> -->
					</table>
				</td>
				
			</tr>
		</table>


		<table style="width:100%; border:2px solid #111; margin-top: -2px;">
			<tr>
			
				<td style="width:50%;border-right: 2px solid #111;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:40%">Bonus</td>
							<td style="padding:10px; width:30%; text-align: right;"><?php echo round($ctc_info['bonus']); ?></td>
							<td style="padding:10px; width:30%; text-align: right;"><?php echo round($ctc_info['gross']); ?></td>
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

		<table style="width:100%;border:2px solid #111; margin-top: -2px;">
			<tr>
			
				<td style="width:50%;border-right: 2px solid #111;">
					<table style="width:100%;">
						<tr>
							<td style="padding:10px; width:50%"><b>Final CTC </b></td>
							<td style="padding:10px; width:25%; text-align: right;"><b><?php echo round($ctc_info['final']); ?></b></td>
							<td style="padding:10px; width:25%; text-align: right;"><b><?php echo round($ctc_info['final']*12); ?></b></td>
						</tr>
					</table>
				</td>
				
				<td style="width:50%;">
					<table style="width:100%;">
						<!-- <tr>
							<td style="padding:10px; width:40%"></td>
							<td style="padding:10px; width:60%; text-align: right;">40</td>
						</tr> -->
					</table>
				</td>
				
			</tr>
		</table>




		<table style="width:100%; border:2px solid #111; margin-top: -2px;">
			<tr>
			
				<td style="padding:10px;">
					<b>Note</b> :- <small>Bonus is subject to completion of 1 year of employement </small>
				</td>
				
			</tr>
		</table>
		
		<!-- <table style="width:100%; border:2px solid #111; margin-top: -2px;">
			<tr>
			
				<td style="padding:10px;">
					<b><?php if($salary_info->net_salary > 0){ echo convert_number_to_words(round($salary_info->net_salary)); }else{ echo '--'; } ?></b>
				</td>
				
			</tr>
		</table> -->


		      

    </div>

    <div class="form-group col-md-2 print_dev">
		<button class="form-control btn-info" type="button" id="print" value="print">Print</button>

	</div>
	<div class="form-group col-md-2 print_dev">
			<form action="<?php echo admin_url('salary/download_ctc'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<input type="hidden" value="<?php echo $name; ?>" name="name">
			<input type="hidden" value="<?php echo $salary; ?>" name="salary">
			<button class="form-control btn-info" type="submit">Download</button>
		</from>
	</div>			
                 
             
    </div>
</div>
</body>



</html>

<script type="text/javascript">
    /*$( document ).ready(function() {
      window.print();
    });*/

    $("#print").on("click", function(){
		  $(".print_dev").hide();
		  window.print();
	}); 
</script>