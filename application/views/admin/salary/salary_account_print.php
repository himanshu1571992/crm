<html>
<head>
  <title>Salary Account Print</title>
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

	@media print {
	  #wrapper {page-break-after: always;}
	}
	
	#wrapper{
		width:800px;
		margin:0 auto 50px auto;
		height:1050px;
		font-size:16px;
		position:relative;
	}
	
	.print-wrapper{
		padding:15px;
		font-family: 'PT Sans', sans-serif;
	}

	.footer{
		position: absolute;
		bottom:0;
		left: 0;
    	right: 0;
	}
	
  </style>
  
</head>

<body style="font-family: 'PT Sans', sans-serif;">
<div id="wrapper">
    <div class="print-wrapper">
<?php
$branch_info = get_company_info();


$total_amount = 0;
if(!empty($paid_info)){
	foreach ($paid_info as $row) {
		$total_amount += $row->net_salary;
	}
}

?>
					
		<table style="width: 100%; text-align: center; margin-top:15px;">
						
			<tr>
				<th>
				<?php
				if(!empty($branch_info)){
					echo '<h3>'.$branch_info[1]->value.'</h3>
					<h5>'.$branch_info[0]->value.'</h5>';
				}
				
				?>
				</th>
				<th>
					<img src="<?php echo base_url('uploads/company/logo.png')?>" class="img-responsive" alt="Schach Engineers Pvt Ltd">
				</th>
			</tr>
				
		</table>
		
		<hr>
		
		<p>Date : <?php echo date('d/m/Y');?></p>
		
		<br>
		<p>
			To,<br>
			The Manager<br>
			Kotak Mahindra Bank Ltd.
		</p>
		
		<br>
		
		<p>Dear Sir,</p>
		
		<p><b>Sub:</b> Salary Remittance to</p>
		
		<p><b>Ref:</b> <u>SCHACH Engineers Pvt Ltd.</u></p>
		
		<br>
				
		<p>We request you to kindly debit our Current number: <b><u>8111580589</u></b> for <b><u>Rs. <?php echo number_format($total_amount,2).'/-'; ?></u> <?php echo convert_number_to_words($total_amount); ?></b> and credit the same to our employees accounts mentioned in the Annexure towards Salary <b>for the month of <u><?php echo get_month_name($month).' '.$year ;?> </u></b></p>
		
		<br>
		
		<p>Kindly do the needful.</p>
		<p>Thanking You</p>
		
		<br>

		<p>Your faithfully<br>
		for Schach Engineers Pvt Ltd.</p>
		
		<br>
		<br>
		
		<p>ABHISHEK SINGH<br>
		Authorised Signatory</p>
	
		<br>
		<br>
	
		<p>Place : Mumbai</p>
		


		
		<p class="footer" style="text-align:center;"><b>Regd Off.:</b> G-401, AVJ Heights, Sector Zeta 1, Greater Noida 201306 India.<br>
		<b>CIN</b> : U51101UP2015PTC068937 <br>
			Cell : +91 80976 97444 Email : info@schachengineers.com  Website : schachengineers.com<br>
			<b>**ALUMINIUM SCAFFOLD**ALUMINIUM LADDER**BOOM LIFT**SCISSOR LIFT**</b>
		</p>
		<p></p>

	
    </div>
             
    </div>
	
<div id="wrapper">
    <div class="print-wrapper">

					
		<table style="width: 100%; text-align: center; margin-top:15px;">
						
			<tr>
				<th>
				<?php
				if(!empty($branch_info)){
					echo '<h3>'.$branch_info[1]->value.'</h3>
					<h5>'.$branch_info[0]->value.'</h5>';
				}
				
				?>
				</th>
				<th>
					<img src="http://it-mustafa/crm_live/uploads/company/logo.png" class="img-responsive" alt="Schach Engineers Pvt Ltd">
				</th>
			</tr>
				
		</table>
		
		<hr>
		
		
		<table style="width: 100%; text-align: center; margin-top:15px;">
			
			<tr>   
				<th style="border:1px solid #ccc;padding:6px;text-align:center;">Sr.No.</th>
				<th style="border:1px solid #ccc;padding:6px;text-align:center;">Account Number</th>
				<th style="border:1px solid #ccc;padding:6px;text-align:center;">Employee name (NAME AS PER BANK)</th>
				<th style="border:1px solid #ccc;padding:6px;text-align:center;">Net Salary</th>
			</tr>
			
			<?php			
			if(!empty($paid_info)){
				$i = 1;
				foreach ($paid_info as $row) {
					?>
						<tr>   
							<td style="border:1px solid #ccc;padding:5px;"><?php echo $i++; ?></td>
							<td style="border:1px solid #ccc;padding:5px;"><?php if(!empty($row->account_no)){ echo $row->account_no; }else{ echo '--';} ?></td>
							<td style="border:1px solid #ccc;padding:5px;"><?php if(!empty($row->firstname)){ echo strtoupper($row->firstname); }else{ echo '--';} ?></td>
							<td style="border:1px solid #ccc;padding:5px;"><?php if(!empty($row->net_salary)){ echo $row->net_salary; }else{ echo '--';} ?></td>
						</tr>
					<?php
				}
			}else{
				echo '<tr><td style="border:1px solid #ccc;padding:5px;" colspan="4">Record Not Found!</td></tr>';
			}
			?>
						
		</table>
		
		<br>
		<br>
		<br>

		
			<p>(Authorised Signatory's sign and stamp)</p>

		<br>
		<br>
		<br>
		
		<p style="text-align:center;"><b>Regd Off.:</b> G-401, AVJ Heights, Sector Zeta 1, Greater Noida 201306 India.<br>
		<b>CIN</b> : U51101UP2015PTC068937 <br>
			Cell : +91 80976 97444 Email : info@schachengineers.com  Website : schachengineers.com<br>
			<b>**ALUMINIUM SCAFFOLD**ALUMINIUM LADDER**BOOM LIFT**SCISSOR LIFT**</b>
		</p>
		<p></p>

	
    </div>
             
    </div>
	
	
	
</body>



</html>

<script type="text/javascript">
    $( document ).ready(function() {
      window.print();
    });
</script>