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

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
				<h2>Employee registration form</h2>
			</div>
		</div>
		<?php 
		
		    if(isset($alert_msg)){
        ?>

              <div class="alert alert-success">

        <?php echo $alert_msg;?>

              </div>

        <?php 
           } 
        ?>



		<form action="<?= base_url();?>staff/staff_form" method="post" enctype="multipart/form-data" id="myForm">

	    <div class="row">
			<div class="col-12">
				<h3 class="sectionHeading">Employee Details</h3>
			</div>
			<div class="col-12 col-sm-8">
				<span id="errmsg1"></span>
				<label for="1">Name of Employee<span style="color: red;">*</span></label>
				<input type="text" id="employee_name" name="employee_name" class="form-control" required>
			</div>
			<div class="col-12 col-sm-4">
				<span id="errmsg"></span>
				<div class="form-group">
				<label for="gender" class="control-label">Gender<span style="color: red;">*</label>
				<select class="form-control selectpicker"  id="gender" name="gender"  data-live-search="true" required>
				<option value="" disabled selected>--Select One--</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
				</select>
				</div>

			</div>
			<div class="col-12 col-sm-8">
				<span id="lblError" style="color: red"></span>
				<label for="name">Email Id<span style="color: red;">*</span></label>
				<input type="text" id="email" name="email" class="form-control" onkeyup="ValidateEmail();" required>
			</div>
			<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="Date of Birth">Date of Birth<span style="color: red;">*</span></label>
				<input type="text"  name="birth_date" class="form-control datepicker1" required>
			</div>
			<div class="col-12 col-sm-8">
				<span id="errmsg"></span>
				<label for="contact_no">Contact Number<span style="color: red;">*</span></label>
				<input type="tel" id="contact_no" minlength="10" maxlength="10" name="contact_no" class="form-control" required>
				
			</div>
			<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="Date of Birth">PF Number</label>
				<input type="text" id="epf_no"  name="epf_no" class="form-control" value >
			</div>
            <div class="col-12 col-sm-8">
				<span id="errmsg1"></span>
				<label for="Date of Birth">Adhaar Card No.<span style="color: red;">*</span></label>
				<input type="text" id="adhar_no"  name="adhar_no" class="form-control"  required>
			</div>
            <div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="Date of Birth">ESIC Number</label>
				<input type="text" id="esic_no"  name="esic_no" class="form-control" value >
			</div>
			<div class="col-12 col-sm-8">
				<span id="errmsg1"></span>
				<label for="Date of Birth">Pan Card No.<span style="color: red;">*</span></label>
				<input type="text" id="pan_card_no"  name="pan_card_no" class="form-control" required>
			</div>

			<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="Date of Birth">Branch</label>
				<?php
				if(!empty($branch_id))
				{ 
                
				?>
                <input type="text" class="form-control" value="<?php echo value_by_id('tblcompanybranch',$branch_id,'comp_branch_name'); ?>" readonly>
                <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">
				<?php }
				else
				{ ?>
                <select class="form-control" id="branch_id" name="branch_id">
					<option value="">---select---</option>
					<?php
					if (isset($branch_info) && count($branch_info) > 0) {
						foreach ($branch_info as $branch_key => $branch_value) 
						{?>
							<option value="<?php echo $branch_value['id'] ?>"><?php echo cc($branch_value['comp_branch_name']); ?></option>
					<?php
						}
					}
					?>
				</select>
				<?php }
				?>
			</div>
		</div>

		
         <br/> 
        <hr>

        <div class="row bg-gray">
			<div class="col-12 col-sm-6">
				<h3 class="sectionHeading">Address Details</h3>
			</div>
			<div class="col-12 col-sm-6 text-right">
				<input type="checkbox" id="sameas">
				<label for="sameas">Same as Permenant Address</label>
			</div>
			<div class="col-12 col-sm-6">
				
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="name">State<span style="color: red;">*</span></label>
						<select class="form-control" id="permenent_state" name="permenent_state" required>
							<option value="">select state</option>

							<?php

							if (isset($state_data) && count($state_data) > 0) {
								foreach ($state_data as $state_key => $state_value) {?>
									<option value="<?php echo $state_value['id'] ?>"><?php echo $state_value['name'] ?></option>

							<?php

								}

							}

							?>

						</select>
					</div>

					<div class="col-12 col-sm-6">
						<label for="name">City<span style="color: red;">*</span></label>
						<select class="form-control" id="permenent_city" name="permenent_city" required>
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
				<div class="row col-12">
					<label for="name">Permenant Address<span style="color: red;">*</span></label>
					<textarea style="height: 80px;" id="permenent_address" name="permenent_address" row="3" class="form-control" required  ></textarea>
				</div>
				<div class="row col-8">
					<label for="permenent_pincode">Pincode<span style="color: red;">*</span></label>
					<input type="tel" id="permenent_pincode" name="permenent_pincode" class="form-control" required>
				</div>
			</div>

			<div class="col-12 col-sm-6">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="name">State<span style="color: red;">*</span></label>
						<select class="form-control" id="residential_state" name="residential_state">
							<option value="">select state</option>
							<?php
							if (isset($state_data) && count($state_data) > 0) {
								foreach ($state_data as $state_key => $state_value) {?>
									<option value="<?php echo $state_value['id'] ?>"><?php echo $state_value['name'] ?></option>
							<?php

								}

							}

							?>
						</select>
					</div>
					<div class="col-12 col-sm-6">
						<label for="name">City<span style="color: red;">*</span></label>
						<select class="form-control" id="residential_city" name="residential_city" >
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

				<div class="row col-12">
					<label for="name">Residential Address<span style="color: red;">*</span></label>
					<textarea style="height: 80px;" id="residential_address" name="residential_address" class="form-control" ></textarea>
				</div>

				<div class="row col-8">
					<label for="residential_pincode">Pincode<span style="color: red;">*</span></label>
					<input type="tel" id="residential_pincode" name="residential_pincode" class="form-control" required>
				</div>
				
			</div>
		</div>

		<hr>

        <div class="row">
			<div class="col-12">
				<h3 class="sectionHeading">Family Persons</h3>
			</div>

		<div class="col-sm-12">
		<div class="table-responsive s_table">
		<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable3">
			<thead>
				<tr>
					<th width="20%" align="left">Full Name</th>
					<th width="20%" class="qty" align="left">Adhaar Card No.</th>
					<th width="20%" align="left">Contact No.</th>
					<th width="20%" align="left">Date of Birth</th>
					<th width="20%" align="left">Relatioship</th>
					<th width="10%"  align="center" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody class="ui-sortable">
				
			</tbody>
		</table>
			<div class="col-xs-12 text-right">
				<label class="label-control subHeads"><a  class="addmorecontact3 addMore" value="0">Add<i class="fa fa-plus"></i></a></label>
			</div>
		</div>
	</div>
	</div>
    <hr>
  
     

        <div class="row bg-gray">
			<div class="col-12">
				<h3 class="sectionHeading">Bank Details</h3>
			</div>

			<div class="col-4">
				<label for="name">Bank Name<span style="color: red;">*</span></label>
				<input type="text" name="bank_name" class="form-control" required >
			</div>
			
			<div class="col-4">
				<label for="name">Account Number<span style="color: red;">*</span></label>
				<input type="text" name="account_no" class="form-control" required >
			</div>
			
			<div class="col-4">
				<label for="name">IFSC Code<span style="color: red;">*</span></label>
				<input type="text" name="ifc_code" class="form-control"  required>
			</div>
			
			
			
			
		</div>

		

        <div class="row bg-gray">
	<div class="col-12">
		<h3 class="sectionHeading">Document Uploads</h3>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">Photo<span style="color: red;">*</span></label>
				
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Photo</label>
				<input type="file" name="photo_attach[]"  required  class="form-control"   multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">PAN Number<span style="color: red;">*</span></label>
				
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="pan_attach[]"  required class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">Adhaar Card <span style="color: red;">*</span></label>
				
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="adhar_attach[]"  required class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">Qualification Certificate</label>
				
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="qualification_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">Relieving Certificate</label>
				
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="relieving_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6">
		<div class="row">
			<div class="col-12 col-sm-7 pr-0">
				<label for="name">Old Salary Slip</label>
				
			</div>
			<div class="col-12 col-sm-5">
				<label for="name">Attach Document</label>
				<input type="file" name="sal_attach[]" class="form-control" multiple="">
			</div>
		</div>
	</div>
	<br/>
	
	<hr/>
	<div class="row">
	 <div class="col-sm-12">	
	  <div class="form-group">
		<span id="captchaImage" ><?php if(isset($captchaImage)) echo $captchaImage; ?> </span>
        <a class="btn loadCaptcha" href="javascript:void(0);" title="Refresh Captcha Access code" onClick="reloadCaptcha();">Refresh Captcha 
        </a>
	   </div>
	</div>
	   <div class="col-sm-12">	
		<div class="form-group">
        <input type="text" class="form-control form-control-lg" placeholder="Captcha" name="captcha" id="captcha" required>
        <div id="status"></div>
        </div>
      </div>

</div>
</div>

	<hr>
         
        <div class="btn-bottom-toolbar text-right">
            <?php
                if(!empty($candidate_id)){
                    echo '<input type="hidden" name="candidate_id" value="'.$candidate_id.'">';
                }
            ?>
			<input type="submit" name="save" value="Save" class="save-btn" />
		</div>
		</form> 
		
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
        $('#myContactTable3 tbody').append('<tr class="main" id="trcc1'+newaddmore+'"><td><div class="form-group"><input type="text" required name="persondata['+newaddmore+'][full_name]" class="form-control" ></div></td><td><div class="form-group"><span id="lblError1" style="color: red"></span><input type="text" id="contactperson" required name="persondata['+newaddmore+'][adhar_no]" class="form-control"></div></td><td><div class="form-group"><input type="text" required name="persondata['+newaddmore+'][contact_no]" class="form-control"></div></td><td><div class="form-group"><input type="text" required name="persondata['+newaddmore+'][date_of_birth]" class="form-control datepicker1" ></div></td><td><div class="form-group"><select required name="persondata['+newaddmore+'][relationship_id]" class="form-control"><option value="">select relationship</option><?php	if (isset($relationship_data) && count($relationship_data) > 0) {	foreach ($relationship_data as $relationship_key => $relationship_value) {?><option value="<?php echo $relationship_value['id'] ?>"><?php echo $relationship_value['relationship'] ?></option><?php }}?></select></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientpersons3('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
		 $( ".datepicker" ).datepicker();
    
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
		 var permenent_pincode=$('#permenent_pincode').val(); 
		 
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
            $('#residential_pincode').val(permenent_pincode);
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
                url: "<?php echo site_url('staff/get_captcha'); ?>",
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
          $.get('<?php echo site_url("staff/captcha_refresh"); ?>', 
          	function(data){ 
                 $('#captchaImage').html(data);
           });
        });
   }); 
 </script>//

  <script>
    $(document).on('focusin', '.datepicker1', function(){
      $(this).datepicker({dateFormat: $.datepicker.W3C, changeMonth: true, changeYear: true, yearRange: '2011:2020'});
    });
</script>

  
