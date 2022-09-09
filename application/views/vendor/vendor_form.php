<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport"  content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/02cb9ab8ae.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
     <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<style type="text/css">

		body{
			font-family: 'Nunito', sans-serif;
		}

		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		.wrapper{
			padding: 30px;
		}

		.container{
			border: 1px solid #dfdfdf;
		    padding-top: 15px;
		    padding-bottom: 15px;
		    border-radius: 5px;
		    box-shadow: 0px 0px 5px #e3e3e3;
		}

		.topHead h2{
			font-weight: 900;
			text-transform: capitalize;
    		margin-bottom: 30px;
		}

		.form-group {
		    margin-bottom:0;
		}

		.form-control {
		    height: 42px;
		    border-radius: 0;
		    margin-bottom: 5px;
		}

		textarea.form-control {
		    height: 42px;
		}

		.sectionHeading {
		    font-weight: 900;
		    font-size: 24px;
		    text-decoration: underline;
		    margin-bottom: 15px;
		}

		.table thead th {
		    vertical-align: bottom;
		    border-bottom: none;
		    background: #243C52;
		    color: #fff;
		}

		.table{
			width: 99.6%;
		}

		.table td {
		    border: 1px solid #e9e9e9;
		}

		.bg-gray{
			background: #fafafa;
		    padding-top: 20px;
		    padding-bottom: 20px;
		}

		.addMore {
		    background: #2196F3;
		    color: #fff;
		    padding: 6px 10px;
		    border-radius: 30px;
		    margin-bottom: 10px;
		    display: inline-block;
		    cursor: pointer;
		}

		.addMore:hover{
			color: #fff;
			text-decoration: none;
		}

		input.save-btn {
		    padding: 8px 40px;
		    border: none;
		    border-radius: 50px;
		    margin-top: 20px;
		    background: #49be4e;
		    color: #fff;
		    font-weight: 900;
		    cursor: pointer;
		}
		#errmsg
			{
			color: red;
			}
			#errmsg1
			{
			color: red;
			}

   	</style>

</head>

<body>
<section class="wrapper">

	<div class="container">

		<div class="row ">
			<div class="col-12 text-center topHead">
				<img width="150" height="50" src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" class="logo">
				<h2>Vendor registration form</h2>
			</div>
		</div>

		<form action="<?= base_url();?>vendor/vendor_form" method="post" enctype="multipart/form-data" id="myForm">

	    <div class="row  ">
			<div class="col-12">
				<h3 class="sectionHeading">Business Details</h3>
			</div>
			<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="1">Name of Vendor<span style="color: red;">*</span></label>
				<input type="text" id="vendor_name" name="vendor_name" class="form-control"  required="">
			</div>
			<div class="col-12 col-sm-4">
				<span id="errmsg"></span>
				<label for="contact_no">Contact Number<span style="color: red;">*</span></label>
				<input type="tel" id="contact_no" minlength="10" maxlength="10" name="contact_no" class="form-control" required="">
				
			</div>
			<div class="col-12 col-sm-4">
				<span id="lblError" style="color: red"></span>
				<label for="name">Email Id<span style="color: red;">*</span></label>
				<input type="text" id="email_id" name="email_id" class="form-control" onkeyup="ValidateEmail();" required="">
			</div>
		</div>
         
        <hr>

        <div class="row bg-gray">
			<div class="col-12 col-sm-6">
				<h3 class="sectionHeading">Address Details</h3>
			</div>
			<div class="col-12 col-sm-6 text-right">
				<input type="checkbox" id="sameas">
				<label for="sameas">Same as Office Address</label>
			</div>
			<div class="col-12 col-sm-6">
				<label for="name">Office Address<span style="color: red;">*</span></label>
				<textarea id="permenent_address" name="office_address" class="form-control" required=""></textarea>
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="name">State<span style="color: red;">*</span></label>
						<select class="form-control" id="permenent_state" name="office_state" required="">
							<option value="">select state</option>
							<?php
							if (isset($state_data) && count($state_data) > 0) {
								foreach ($state_data as $state_key => $state_value) 
								{?>
									<option value="<?php echo $state_value['id'] ?>"><?php echo $state_value['name'] ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>

					<div class="col-12 col-sm-6">
						<label for="name">City<span style="color: red;">*</span></label>
						<select class="form-control" id="permenent_city" name="office_city" required="">
							<option value="">select city</option>
							<?php
							if (isset($city_data) && count($city_data) > 0  ) {
								foreach ($city_data as $city_key => $city_value) {
									?>
									<option value="<?php echo $city_value['id'] ?>"><?php echo $city_value['name'] ?></option>
									<?php
								}
							}
							
							?>
						</select>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6">
				<label for="name">Work Address<span style="color: red;">*</span></label>
				<textarea id="residential_address" name="work_address" class="form-control" required=""></textarea>
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="name">State<span style="color: red;">*</span></label>
						<select class="form-control" id="residential_state" name="work_state" required="">
							<option value="">select state</option>
							<?php
							if (isset($state_data) && count($state_data) > 0) {
								foreach ($state_data as $state_key => $state_value) 
								{?>
									<option value="<?php echo $state_value['id'] ?>"><?php echo $state_value['name'] ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>
					<div class="col-12 col-sm-6">
						<label for="name">City<span style="color: red;">*</span></label>
						<select class="form-control" id="residential_city" name="work_city" required="">
							<option value="">select city</option>
							<?php
							if (isset($city_data) && count($city_data) > 0  ) {
								foreach ($city_data as $city_key => $city_value) {
									?>
									<option value="<?php echo $city_value['id'] ?>"><?php echo $city_value['name'] ?></option>
									<?php
								}
							}
							
							?>
						</select>
					</div>
				</div>
			</div>
		</div>

		<hr>

        <div class="row">
			<div class="col-12">
				<h3 class="sectionHeading">Contact Person</h3>
			</div>

		<div class="col-sm-12">
		<div class="table-responsive s_table">
		<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable3">
			<thead>
				<tr>
					<th width="20%" align="left">Name</th>
					<th width="20%" class="qty" align="left">Email</th>
					<th width="20%" align="left">Number</th>
					<th width="20%" align="left">Designation</th>
					<th width="10%"  align="center" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody class="ui-sortable">
				<!-- <tr class="main" id="tr0">
					<td>
						<div class="form-group">
							<input type="text" name="persondata['+newaddmore+'][contactperson_name]" class="form-control">
						</div>
					</td>
					<td>
						<div class="form-group">
							<span id="lblError1" style="color: red"></span>
							<input type="text" id="contactperson_email" name="persondata['+newaddmore+'][contactperson_email]" class="form-control" onkeyup="ValidateEmail1();">
						</div>
					</td>
					<td>
						<div class="form-group">
						<span id="errmsg2" style="color: red;"></span>
						<input type="text" id="contactperson_no" name="persondata['+newaddmore+'][contactperson_no]" class="form-control">
						</div>
					</td>
					<td>
						<div class="form-group">
						<select class="form-control" id="person_designation" name="persondata['+newaddmore+'][designation_id]">
								<option>Select Designation</option>
								<?php

								if (isset($designation_data) && count($designation_data) > 0) {

									foreach ($designation_data as $designation_key => $designation_value) {

										?>

										<option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option>

										<?php

									}

								}

								?>
						</select>
						</div>
					</td>
					
					<td class="text-center">
						<button type="button" class="btn btn-danger" onclick="removeclientperson3('0');"><i class="fa fa-remove"></i></button>
					</td>
				</tr> -->
			</tbody>
		</table>
			<div class="col-xs-12 text-right">
				<label class="label-control subHeads"><a  class="addmorecontact3 addMore" value="0">Add<i class="fa fa-plus"></i></a></label>
			</div>
		</div>
	</div>
	</div>

  <div class="row bg-gray">
	<div class="col-12">
		<h3 class="sectionHeading">Statutory Details</h3>
	</div>
	<div class="col-12 col-sm-6">
		<label for="name">Business Type</label>
		<select class="form-control" name="business_type">
	        <option value=""></option>
	        <?php
	        if (isset($business_type_data) && count($business_type_data) > 0) {
	            foreach ($business_type_data as $business_type_key => $business_type_value) {
	                ?>
	                <option value="<?php echo $business_type_value['id'] ?>"><?php echo $business_type_value['name'] ?></option>
	                <?php
	            }
	        }
	        ?>
	    </select>
	</div>
	<div class="col-12 col-sm-6">
		<label for="name">Business Activity</label>
		<input type="text" name="business_activity" class="form-control">
	</div>
	<div class="col-12 col-sm-6">
		<label for="name">Year of comencement</label>
		<input type="text" name="comencement_year" class="form-control">
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">PAN Number<span style="color: red;">*</span></label>
				<input type="text" name="pan_no" class="form-control" required="">
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="pan_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">GST Number<span style="color: red;">*</span></label>
				<input type="text" name="gst_no" class="form-control" required="">
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="gst_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">MSME Number</label>
				<input type="text" name="msme_no" class="form-control">
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="msme_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">IEC Number</label>
				<input type="text" name="iec_no" class="form-control">
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="iec_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">CIN Number</label>
				<input type="text" name="cin_no" class="form-control">
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="cin_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<!-- <div class="col-12 col-sm-6">
		<label for="photo" class="control-label">Certificate Copy</label>
		<input type="file" id="" name="certificate_image[]" style="width: 100%;" multiple>
	</div> -->
</div>

	<hr>
         
      <div class="row">
        <div class="col-12">
			<h3 class="sectionHeading">Financial Details</h3>
		</div>

		<div class="col-sm-12">
        <div class="table-responsive s_table">
		<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable2">
			<thead>
				<tr>
					<th width="20%" align="left">Financial Year</th>
					<th width="20%" class="qty" align="left">TurnOver Details</th>
					<th width="10%"  align="center" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody class="ui-sortable">
				<!-- <tr class="main" id="tr0">
					<td>
						<div class="form-group">
							<input type="text" name="financialdata['+newaddmore+'][financial_year]" class="form-control">
						</div>
					</td>
					<td>
						<div class="form-group">
							<input type="text" name="financialdata['+newaddmore+'][turnover_details]" class="form-control">
						</div>
					</td>
					
					
					<td class="text-center">
					<button type="button" class="btn btn-danger" onclick="removeclientperson2('0');"><i class="fa fa-remove"></i></button>
					</td>
				</tr> -->
			</tbody>
		</table>
		</div>
			<div class="row">
				<div class="col-sm-6">
					<label for="photo" class="control-label">Financial Copy</label>
					<input type="file" id="" name="financial_attach[]" multiple="">
				</div>

				<div class="col-sm-6 text-right">
					<label class="label-control subHeads"><a  class="addmorecontact2 addMore" value="0">Add<i class="fa fa-plus"></i></a></label>
				</div>
			</div>
		</div>	
		</div>

		<hr>
         
         <div class="row bg-gray">
			<div class="col-12">
				<h3 class="sectionHeading">Customer Reference</h3>
			</div>
			<div class="col-sm-12">
			<div class="table-responsive s_table">
			<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
				<thead>
					<tr>
						<th width="20%" align="left">Name of Customer</th>
						<th width="20%" class="qty" align="left">Contact Person</th>
						<th width="20%" align="left">Contact Number</th>
						<th width="20%" align="left">Address</th>
						<th width="10%"  align="center" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody class="ui-sortable">
					<!-- <tr class="main" id="tr0">
						<td>
							<div class="form-group">
								<input type="text" name="customerdata['+newaddmore+'][customer_name]" class="form-control">
							</div>
						</td>
						<td>
							<div class="form-group">
								<input type="text" name="customerdata['+newaddmore+'][customercontact_person]" class="form-control">
							</div>
						</td>
						<td>
							<div class="form-group">
								<span id="errmsg3" style="color: red;"></span>
								<input type="text" name="customerdata['+newaddmore+'][customercontact_no]" id="customercontact_no" class="form-control">
							</div>
						</td>
						<td>
							<div class="form-group">
								<textarea name="customerdata['+newaddmore+'][customer_address]" class="form-control"></textarea>
							</div>
						</td>
						
						
						<td class="text-center">
						<button type="button" class="btn btn-danger" onclick="removeclientperson('0');"><i class="fa fa-remove"></i></button>
						</td>
					</tr> -->
				</tbody>
			</table>
			</div>
			<div class="col-xs-12 text-right">
				<label class="label-control subHeads"><a  class="addmorecontact addMore" value="0">Add <i class="fa fa-plus"></i></a></label>
			</div>
		</div>
		</div>

		<hr>

        <div class="row">
        <div class="col-12">
			<h3 class="sectionHeading">Product Details</h3>
		</div>
		<div class="col-sm-12">
        <div class="table-responsive s_table">
		<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable1">
			<thead>
				<tr>
					<th width="20%" align="left">Name of Product</th>
					<th width="20%" class="qty" align="left">Quality Certification</th>
					<th width="20%" align="left">Product Specification</th>
					<th width="10%"  align="center" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody class="ui-sortable">
				<!-- <tr class="main" id="tr0">
					<td>
						<div class="form-group">
							<input type="text" name="productdata['+newaddmore+'][product_name]" class="form-control">
						</div>
					</td>
					<td>
						<div class="form-group">
							<input type="text" name="productdata['+newaddmore+'][quality_certification]" class="form-control">
						</div>
					</td>
					<td>
						<div class="form-group">
							<textarea name="productdata['+newaddmore+'][product_specification]" class="form-control"></textarea>
						</div>
					</td>
					
					
					<td class="text-center">
					<button type="button" class="btn btn-danger" onclick="removeclientpersons('0');"><i class="fa fa-remove"></i></button>
					</td>
				</tr> -->
			</tbody>
		</table>
		<div class="col-xs-12 text-right">
			<label class="label-control subHeads"><a  class="addmorecontact1 addMore" value="0">Add<i class="fa fa-plus"></i></a></label>
		</div>
		</div>
		</div>	
		</div>
         
        <hr>

         <div class="row bg-gray">
			<div class="col-12">
				<h3 class="sectionHeading">Bank Details</h3>
			</div>
			<div class="col-6   ">
				<label for="name">Name of Bank<span style="color: red;">*</span></label>
				<input type="text" name="bank_name" class="form-control" required="" >
			</div>
			<div class="col-6   ">
				<label for="name">Address<span style="color: red;">*</span></label>
				<textarea name="bank_address" class="form-control" required=""></textarea>
			</div> 
			<div class="col-6   ">
				<label for="name">Type of Account<span style="color: red;">*</span></label>
				<input type="text" name="account_type" class="form-control" required="">
			</div>
			<div class="col-6   ">
				<label for="name">Account Number<span style="color: red;">*</span></label>
				<input type="text" name="account_no" class="form-control" required="">
			</div>
			
			<div class="col-6   ">
				<label for="name">IFC Code<span style="color: red;">*</span></label>
				<input type="text" name="ifc_code" class="form-control" required="">
			</div>
			
			<div class="col-6   ">
				<label for="name">MICR Code</label>
				<input type="text" name="micr_code" class="form-control">
			</div>
			<div class="col-6">
				<label for="photo" class="control-label">Cheque Copy</label>
				<input type="file" id="" name="bank_attach[]" style="width: 100%;" multiple="">
			</div>
			
		</div>

		<div class="form-group">
		<span id="captchaImage" ><?php if(isset($captchaImage)) echo $captchaImage; ?> </span>
        <a class="btn loadCaptcha" href="javascript:void(0);" title="Refresh Captcha Access code" onClick="reloadCaptcha();">Refresh Captcha 
        </a>
		</div>
		<div class="form-group">
        <input type="text" class="form-control form-control-lg" placeholder="Captcha" name="captcha" id="captcha" required>
        <div id="status"></div>
        </div>

        
        <div class="btn-bottom-toolbar text-right">
			<input type="submit" name="save" value="Save" class="save-btn" />
		</div>
		</form> 
		<table>
	      <tr>
			<td>
				<h3 style="font-size:18px;margin-bottom: 5px; font-weight:900;">INSTRUCTIONS</h3>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">01). (<span style="color: red;">*</span>) Mandatory Fields.</p>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">02). Hand written form will not be acceptable. </p>
				
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">03). Bank Details should be verified by the respective Bank.</p>

				<p style="text-align: center;font-weight:700;font-size: 10px;">IN CASE OF ANY QUERY RELATED TO FILLING FORM PLEASE CONTCT US ON +91-7304997369 OR ON ADMIN@SCHACHENGINEERS.COM </p>
			</td>
		</tr>
      </table>
	</div>
	
</section>

</body>
</html>
<script type="text/javascript">
	$('.addmorecontact').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable tbody').append('<tr class="main" id="trcc'+newaddmore+'"><td><div class="form-group"><input type="text" required name="customerdata['+newaddmore+'][customer_name]" class="form-control"></div></td><td><div class="form-group"><input type="text" required name="customerdata['+newaddmore+'][customercontact_person]" class="form-control"></div></td><td><div class="form-group"><input type="text" required name="customerdata['+newaddmore+'][customercontact_no]" class="form-control"></div></td><td><div class="form-group"><textarea name="customerdata['+newaddmore+'][customer_address]" required="" class="form-control"></textarea></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson(procompid)
    {
        $('#trcc' + procompid).remove();
    }
</script>
<script type="text/javascript">
	$('.addmorecontact1').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable1 tbody').append('<tr class="main" id="trcc1'+newaddmore+'"><td><div class="form-group"><input type="text" required name="productdata['+newaddmore+'][product_name]" class="form-control" ></div></td><td><div class="form-group"><input type="text" required name="productdata['+newaddmore+'][quality_certification]" class="form-control"></div></td><td><textarea name="productdata['+newaddmore+'][product_specification]" required="" class="form-control"></textarea></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientpersons('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientpersons(procompid)
    {
        $('#trcc1' + procompid).remove();
    }
</script>
<script type="text/javascript">
	$('.addmorecontact2').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable2 tbody').append('<tr class="main" id="trcc1'+newaddmore+'"><td><div class="form-group"><input type="text" required name="financialdata['+newaddmore+'][financial_year]" class="form-control" ></div></td><td><div class="form-group"><input type="text" required name="financialdata['+newaddmore+'][turnover_details]" class="form-control"></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientperson2('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson2(procompid)
    {
        $('#trcc1' + procompid).remove();
    }
</script>
<script type="text/javascript">
	$('.addmorecontact3').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable3 tbody').append('<tr class="main" id="trcc1'+newaddmore+'"><td><div class="form-group"><input type="text" required name="persondata['+newaddmore+'][contactperson_name]" class="form-control" ></div></td><td><div class="form-group"><span id="lblError1" style="color: red"></span><input type="email" id="contactperson_email" required name="persondata['+newaddmore+'][contactperson_email]" class="form-control" onkeyup="ValidateEmail1();"></div></td><td><div class="form-group"><input type="text" required name="persondata['+newaddmore+'][contactperson_no]" class="form-control"></div></td><td><div class="form-group"><select required name="persondata['+newaddmore+'][designation_id]" class="form-control"><option value="">select Designation</option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option><?php }}?></select></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientpersons3('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientpersons3(procompid)
    {
        $('#trcc1' + procompid).remove();
    }
</script>
<script type="text/javascript">
    $(document).on('change', '#permenent_state', function() {   
       var state_id = $("#permenent_state").val();
	       $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('vendor/get_city'); ?>",
	            data    : {'state_id' : state_id},
	            success : function(response){
	                if(response != ''){                   
	                     $('#permenent_city').html(response);  
	                }
	            }
	        })	  
    }); 

    $(document).on('change', '#residential_state', function() {   
       var state_id = $("#residential_state").val();
	       $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('vendor/get_city'); ?>",
	            data    : {'state_id' : state_id},
	            success : function(response){
	                if(response != ''){                   
	                     $('#residential_city').html(response);  
	                }
	            }
	        })	  
    });

    $('#sameas').change(function() {
		 var permenent_address=$('#permenent_address').val();
		 var permenent_state=$('#permenent_state').val(); 
		 var permenent_city=$('#permenent_city').val(); 
		 
		 $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('vendor/residential_city'); ?>",
	            data    : {'permenent_city' : permenent_city},
	            success : function(response){
	                if(response != ''){                   
	                     $('#residential_city').html(response);  
	                }
	            }
	        }) 

        if($(this).is(":checked")) {
            $('#residential_address').val(permenent_address);
            $('#residential_state').val(permenent_state);
            $('#residential_city').val(permenent_city);
			$('.selectpicker').selectpicker('refresh');
        }
        });
</script>
<script type="text/javascript">
	$(document).ready(function () {
  
     $("#contact_no").keypress(function (e) {
     
     if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {
        
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
  /*$("#vendor_name").keypress(function (a) {
     //if the letter is not digit then display error and don't type anything
     var charactersOnly = document.getElementById('vendor_name').value;
        if (charactersOnly.search(/^[a-zA-Z]+$/) === -1)
        {
            
            document.getElementById('errmsg1').innerHTML = "Only characters";
            }
             else if(charactersOnly===''){
            	 document.getElementById('errmsg1').innerHTML = "";
            }
            else{
            	 document.getElementById('errmsg1').innerHTML = "";
            }
    });*/

    $("#contactperson_no").keypress(function (e) {
     
     if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {
        
        $("#errmsg2").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

    $("#customercontact_no").keypress(function (e) {
     
     if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {
        
        $("#errmsg3").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
    

   });
</script>
<script type="text/javascript">
    function ValidateEmail() {
        var email = document.getElementById("email_id").value;
        var lblError = document.getElementById("lblError");
        lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
        }
    }
    
    function ValidateEmail1() {
        var email = document.getElementById("contactperson_email").value;
        var lblError = document.getElementById("lblError1");
        lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
        }
    }

    
</script>

<script type="text/javascript">
var validated = false;
$("#myForm").on("submit", function (e) { 
    if (!validated) {
       e.preventDefault(); 
        var captcha = $("#captcha").val();
       
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('vendor/get_captcha'); ?>",
                data: {'captcha' : captcha},
                success:function(data) { 
                	if(data == 'wrong captcha'){                   
	                     $("#status").html('<span style="color: red;">Wrong Captcha</span>');
                     return false;
	                }
	                validated = true;
                    $("#myForm").submit();
                    
                }
            });
    }
     
});

 </script>
 <script>

    $(document).ready(function(){ 
        $('.loadCaptcha').on('click', function(){ 
          $.get('<?php echo site_url("vendor/captcha_refresh"); ?>', 
          	function(data){ 
                 $('#captchaImage').html(data);
           });
        });
   }); 
 </script>