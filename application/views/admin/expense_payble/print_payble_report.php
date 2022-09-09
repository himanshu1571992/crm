<html>
<head>
  <title>Expense Payble Print</title>
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


		
		
		<table style="width: 100%; border:2px solid #111;margin-top: -2px;">
		
			<tr>
				<td style="text-align:left; padding: 15px; width:50%;">
					<p><b>Year : <?php echo $year;?></b></p>
					<p><b>Month : <?php echo date('M',strtotime('01-'.$month.'-2019')); ?></b></p>
				</td>
				
			</tr>
		
		</table>
		
		<table style="width: 100%; border:2px solid #111;margin-top: -2px;">
			<tr>
								
				<td style="width:100%;">
				
					<table style="width: 100%;">
			
						<tr>
							<td style="text-align:left; padding: 15px;">
								<table  border="1" style="width:100%;">
									<tr>
										<td class="text-center"><b>S.No</b></td>
										<td class="text-center"><b>Employee Name</b></td>
										<td class="text-center"><b>Amount</b></td>
										<td class="text-center"><b>Paid At</b></td>
										<td class="text-center"><b>Status</b></td>
									</tr>
									<?php
									if(!empty($staff_list)){
										$z=1;
										$ttl_amount  = 0;
										foreach($staff_list as $staff){
											
										
											$paid_info = $this->home_model->get_row('tblexpensepayble', array('staff_id'=>$staff->staffid,'month'=>$month,'year'=>$year,'status'=>1), '');
											$wallet_amount = wallet_amount($staff->staffid,$from_date,$to_date);
										if($wallet_amount > 1){		
										$ttl_amount += $wallet_amount; 	
									?>
										<tr>
											<td class="text-center"><?php echo $z++;?></td>
											<td class="text-center"><?php echo $staff->firstname;?></td>											
											<td class="text-center"><?php echo $wallet_amount; ?></td>											
											<td class="text-center"><?php if(!empty($paid_info)){ echo date('d/m/Y',strtotime($paid_info->paid_date)); }else{ echo '--'; }?></td>											
											<td class="text-center"><?php if(empty($paid_info)){ echo 'Unpaid'; }else{ echo '<b>Paid</b>'; } ?></td>											
										</tr>

									<?php
										}
										}
									}else{
										echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
									}
									?>
								</table>	
							</td>
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
							<td style="padding:10px; width:50%"><b>Total Amount</b></td>
							<td style="padding:10px; width:50%"><b><?php echo $ttl_amount; ?></b></td>
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
					<b> <?php if($ttl_amount > 0){ echo convert_number_to_words(round($ttl_amount)); }else{ echo '--'; } ?></b>
				</td>
				
			</tr>
		</table>
	

    </div>
             
    </div>
</div>
</body>



</html>

<script type="text/javascript">
    $( document ).ready(function() {
      window.print();
    });
</script>