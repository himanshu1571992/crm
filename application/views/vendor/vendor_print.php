<!DOCTYPE html>
<html>
<head>
  <title>Print Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
  <style type="text/css">
	  	@page{margin:20px auto};
	  	td p{
	  		font-size: 12px;
	  	}
	  	td{font-size: 12px;}
  </style>
</head>
<body style="font-family: 'Nunito', sans-serif;">
	<table border="0" cellspacing="0" cellpadding="0" style="width: 100%; margin: auto;">
		<tr>
			<td style="text-align:center;">
				<img src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" class="logo">
				<h3 style="margin-top: 0; margin-bottom:5px; font-size: 20px; text-decoration: underline; font-weight: 900;">VENDOR REGISTRTION FORM</h3>
			</td>
		</tr>
		<tr>
			<td>
				<h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Business Details</h3>
				
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<?php if(!empty($registeredvendor)){
                                foreach ($registeredvendor as $value) { ?>
					<tr>
						<td style="border: 1px solid #d7d7d7; padding:8px 5px;" colspan="2">
							<p style="margin:0;">Name of Vendor :- <b><?php echo $value['vendor_name']; ?></b></p>
						</td>
					</tr>
					<tr>
						<td style="border: 1px solid #d7d7d7; padding:8px 5px;">
							<p style="margin:0;">Contact Number :- <b><?php echo $value['contact_no']; ?></b></p>
						</td>
						<td style="border: 1px solid #d7d7d7; padding:8px 5px;">
							<p style="margin:0;">Email Id :- <b><?php echo $value['email_id']; ?></b></p>
						</td>
					</tr>
					<?php }} ?>
				</table>

			</td>
		</tr>

		<tr>
			<td>
				<h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Address Details</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<tr>
						<?php if(!empty($registeredvendor)){
                                foreach ($registeredvendor as $address) { ?>
						<td style="border: 1px solid #d7d7d7;">
							<h4 style="margin:0;padding: 5px; text-decoration: underline;">Office Address Details</h4>
							<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
								<tr>
									<td style="padding:2px 5px;" colspan="2">
										<p style="margin:0;">Office Address :- <b><?php echo $address['office_address']; ?></b></p>
									</td>
								</tr>
								<tr>
									<td style="padding:2px 5px;">
										<p style="margin:0;">State :- <b><?php 
										$state_id = $address['office_state'];
                                        $state_info = $this->db->query("SELECT * FROM `tblstates` where id = '".$state_id."'")->row();
										echo $state_info->name; ?></b></p>
									</td>
								</tr>
								<tr>
									<td style="padding:2px 5px;">
										<p style="margin:0;">City :- <b><?php 
										$city_id = $address['office_city'];
                                        $city_info = $this->db->query("SELECT * FROM `tblcities` where id = '".$city_id."'")->row();
										echo $city_info->name; ?></b></p>
									</td>
								</tr>
							</table>
						</td>
						<td style="border: 1px solid #d7d7d7;">
							<h4 style="margin:0;padding: 5px; text-decoration: underline;">Work Address Details</h4>
							<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
								<tr>
									<td style="padding:2px 5px;" colspan="2">
										<p style="margin:0;">Office Address :- <b><?php echo $address['work_address']; ?></b></p>
									</td>
								</tr>
								<tr>
									<td style="padding:2px 5px;">
										<p style="margin:0;">State :- <b><?php 
										$state_id = $address['work_state'];
                                        $state_info = $this->db->query("SELECT * FROM `tblstates` where id = '".$state_id."'")->row();
										echo $state_info->name; ?></b></p>
									</td>
								</tr>
								<tr>
									<td style="padding:2px 5px;">
										<p style="margin:0;">City :- <b><?php 
										$city_id = $address['work_city'];
                                        $city_info = $this->db->query("SELECT * FROM `tblcities` where id = '".$city_id."'")->row();
										echo $city_info->name; ?></b></p>
									</td>
								</tr>
							</table>
						</td>
						<?php }} ?>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
         <?php if(empty($vendorcontact))
         { ?>
         <td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
         </td>
         <tr>
         	<th style="border: 1px solid #ccc;">No Records</th>
         </tr>
         <?php }
         else
         {
         ?>
          <td>
				<h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<thead>
						<tr>
							<th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name</th>
							<th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Email</th>
							<th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Number</th>
							<th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Designation</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($vendorcontact)){
                                foreach ($vendorcontact as $contact) { ?>
						<tr>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $contact['contactperson_name']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $contact['contactperson_email']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $contact['contactperson_no']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;">
								<?php 
								$designation_id = $contact['designation_id'];
                                $designation_info = $this->db->query("SELECT * FROM `tbldesignation` where id = '".$designation_id."'")->row();
								echo $designation_info->designation; ?>
						    </td>
						</tr>
					<?php }} ?>
					</tbody>
				</table>
			</td>
         <?php }
         ?>
        </tr>

		<tr>
			<td>
				<h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Statutory Details</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<?php if(!empty($registeredvendor)){
                                foreach ($registeredvendor as $statutory) { ?>
					<tr>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">Business Type :- <b><?php 
							$business_id = $statutory['business_type'];
                            $business_info = $this->db->query("SELECT * FROM `tblbusinesstype` where id = '".$business_id."'")->row();
							echo $business_info->name; ?>
								
							</b></p>
						</td>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">Business Activity :- <b><?php echo $statutory['business_activity']; ?></b></p>
						</td>
					</tr>
					<tr>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">Year of comencement :- <b><?php echo $statutory['comencement_year']; ?></b></p>
						</td>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">PAN Number :- <b><?php echo $statutory['pan_no']; ?></b></p>
						</td>
					</tr>
					<tr>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">GST Number :- <b><?php echo $statutory['gst_no']; ?></b></p>
						</td>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">MSME Number :- <b><?php echo $statutory['msme_no']; ?></b></p>
						</td>
					</tr>
					<tr>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">IEC Number :- <b><?php echo $statutory['iec_no']; ?></b></p>
						</td>
						<td style="padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">CIN Number :- <b><?php echo $statutory['cin_no']; ?></b></p>
						</td>
					</tr>
				<?php }} ?>
				</table>
			</td>
		</tr>

		<tr>
		<?php if(empty($vendorfinancial))
         { ?>
         <td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Financial Details</h3>
         </td>
         <tr>
         	<th style="border: 1px solid #ccc;">No Records</th>
         </tr>
         <?php }
         else
         {
         ?>
			<td>
				<h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Financial Details</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<thead>
						<tr>
							<th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Financial Year</th>
							<th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">TurnOver Details</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($vendorfinancial)){
                                foreach ($vendorfinancial as $financial) { ?>
						<tr>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $financial['financial_year']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $financial['turnover_details']; ?></td>
						</tr>
					<?php }}?>
					</tbody>
				</table>
			</td>
		<?php } ?>
		</tr>

		<tr>
		<?php if(empty($vendorcustomer))
         { ?>
         <td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Customer Reference</h3>
         </td>
         <tr>
         	<th style="border: 1px solid #ccc;">No Records</th>
         </tr>
         <?php }
         else
         {
         ?>
			<td>
				<h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Customer Reference</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<thead>
						<tr>
							<th style="width:25%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name of Customer</th>
							<th style="width:25%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact Person</th>
							<th style="width:15%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact Number</th>
							<th style="width:35%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Address</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($vendorcustomer)){
                            foreach ($vendorcustomer as $customer) { 
                         ?>
						<tr>
							<td style="padding: 5pxcustomer_name; border: 1px solid #ccc;"><?php echo $customer['customer_name']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $customer['customercontact_person']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $customer['customercontact_no']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $customer['customer_address']; ?></td>
						</tr>
					<?php }} ?>
					</tbody>
				</table>
			</td>
		<?php } ?>
		</tr>

		<tr>
		<?php if(empty($vendorproduct))
         { ?>
         <td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Product Details</h3>
         </td>
         <tr>
         	<th style="border: 1px solid #ccc;">No Records</th>
         </tr>
         <?php }
         else
         {
         ?>
			<td>
				<h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Product Details</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<thead>
						<tr>
							<th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name of Product</th>
							<th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Quality Certification</th>
							<th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Product Specification</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($vendorproduct)){
                            foreach ($vendorproduct as $product) { 
                         ?>
						<tr>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $product['product_name']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $product['quality_certification']; ?></td>
							<td style="padding: 5px; border: 1px solid #ccc;"><?php echo $product['product_specification']; ?></td>
						</tr>
					<?php }} ?>
					</tbody>
				</table>
			</td>
		<?php } ?>
		</tr>

		<tr>
			<td>
				<h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Bank Details</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
					<?php if(!empty($registeredvendor)){
                            foreach ($registeredvendor as $bank) { 
                         ?>
					<tr>
						<td style="width:50%; padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">Name of Bank :- <b><?php echo $bank['bank_name']; ?></b></p>
						</td>
						<td style="width:50%; padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">Address :- <b><?php echo $bank['bank_address']; ?></b></p>
						</td>
					</tr>
					<tr>
						<td style="width:50%; padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">Type of Account :- <b><?php echo $bank['account_type']; ?></b></p>
						</td>
						<td style="width:50%; padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">Account Number :- <b><?php echo $bank['account_no']; ?></b></p>
						</td>
					</tr>
					<tr>
						<td style="width:50%; padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">IFC Code :- <b><?php echo $bank['ifc_code']; ?></b></p>
						</td>
						<td style="width:50%; padding: 5px; border: 1px solid #ccc;">
							<p style="margin:0;">MICR Code :- <b><?php echo $bank['micr_code']; ?></b></p>
						</td>
					</tr>
				<?php }} ?>
				</table>
			</td>
		</tr>

		<tr>
			<td>
				<h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Acknowledgement of Bank</h3>
				<table border="0" cellspacing="0" cellpadding="0" style="width: 100%; border: 1px solid #ccc;">
					<tr>
						<td style="padding: 5px; text-align: center;">
							<p>This is to confirm that all the above information furnished by us is true. </p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Name :-</b> Mustafa Bohra</p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Designation :-</b> sales manager</p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Date :-</b> 21-08-2020</p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Place :-</b> Indore M.P.</p>
						</td>
					</tr>

					<tr>
						<td style="padding:5px;">
							<p style="text-align: right;">
								<b>Signature of Authorized Person</b>
							</p>
						</td>
					</tr>
				</table>

				<table border="0" cellspacing="0" cellpadding="0" style="margin-top: 30px; width: 100%; border: 1px solid #ccc;">
					<tr>
						<td style="padding: 5px; text-align: center;">
							<p><b>FOR SCHACH USE ONLY.</b></p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Vendor Approved By :-</b> </p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Date of Approval :-</b> 21-08-2020</p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Approval Remark :-</b> </p>
						</td>
					</tr>
					<tr>
						<td style="padding:2px 5px;">
							<p style="margin:0;"><b>Vendor Reference :-</b> </p>
						</td>
					</tr>

					<tr>
						<td style="padding:5px;">
							<p style="text-align: right;">
								<b>Signature of Purchase Manager</b>
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td>
				<h3 style="font-size:18px;margin-bottom: 5px; font-weight:900;">INSTRUCTIONS</h3>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">01. (*) Mandatory Fields.</p>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">02. Hand written form will not be acceptable. </p>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">03. All the pages of Registration form should duly signed by the authorized person along with the stamp.</p>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">04. Bank Details should be verified by the respective Bank.</p>

				<p style="text-align: center;font-weight:700;font-size: 10px;">IN CASE OF ANY QUERY RELATED TO FILLING FORM PLEASE CONTCT US ON +91-7304997369 OR ON ADMIN@SCHACHENGINEERS.COM </p>
			</td>
		</tr>

	</table>
</body>
</html>