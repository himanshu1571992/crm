<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        

           <?php echo form_open_multipart($this->uri->uri_string(),array('class'=>'staff-form','autocomplete'=>'off')); ?>
        
                <div class="panel_s">
                    <div class="panel-body">


                    <h4 class="no-margin">Employee Details</h4>
                    <hr class="hr-panel-heading">
                        <?php if (!empty($registeredstaff)) {
                            foreach ($registeredstaff as $value) {
                                ?>
                            <div class="row"> 
                                <div class="col-12 col-sm-4">
                                    <span id="errmsg1" style="color: red"></span>
                                    <label for="1">Name of Employee</label>
                                    <input type="text" id="employee_name" name="employee_name"  class="form-control" value="<?php echo cc($value['employee_name']); ?>">
                                </div>
                                <div class="col-12 col-sm-4">
                                    <span id="contact_no_err" style="color: red"></span>
                                    <label for="contact_no">Contact Number</label>
                                    <input type="tel" id="contact_no" minlength="10" maxlength="10" value="<?php echo $value['contact_no']; ?>" name="contact_no" class="form-control" required>

                                </div>
                                <div class="col-12 col-sm-4">
                                    <span id="lblError" style="color: red"></span>
                                    <label for="name">Email Id</label>
                                    <input type="email" id="email" name="email"  class="form-control" onkeyup="ValidateEmail();" value="<?php echo $value['email']; ?>">
                                </div>
                            </div>
                            <br>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                    <span id="errmsg1"></span>
                                    <label for="Date of Birth">Date of Birth</label>
                                    <input type="text"  name="birth_date" class="form-control datepicker" value="<?php echo _d($value['birth_date']); ?>">
                            </div>
                            <div class="col-12 col-sm-4">
                                    <span id="errmsg"></span>
                                    <div class="form-group">
                                    <label for="gender" class="control-label">Gender</label>
                                    <select class="form-control"   id="gender" name="gender"  data-live-search="true" >
                                    <option value="" disabled selected>--Select One--</option>
                                    <option value="1" <?php if($value['gender']==1){ echo 'selected';}?>>Male</option>
                                    <option value="2"  <?php if($value['gender']==2){ echo 'selected';}?>>Female</option>
                                    </select>
                                    </div>

                            </div>
                            <div class="col-12 col-sm-4">
                                <span id="errmsg1"></span>
                                <label for="Date of Birth">Adhaar Card No.</label>
                                <input type="text" id="adhar_no"  name="adhar_no" class="form-control"  value="<?php echo $value['adhar_no']; ?>">
                            </div>
			</div>
                    <div class="row">
			

			<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="Date of Birth">Pan Card No.</label>
				<input type="text" id="pan_card_no"  name="pan_card_no" class="form-control" value="<?php echo $value['pan_card_no']; ?>">
			</div>
                        
                    </div>
			 <?php }} ?> 
		

		<hr>

         <br/>  <br/> 
        
            <h4 class="no-margin">Address Details</h4>
                <hr class="hr-panel-heading">
                <div class="row">
                    <div class="col-md-12 text-right">	
                            <input type="checkbox" id="sameas">Same as Permenant Address
                    </div>
                    <?php if (!empty($registeredstaff)) {
                        foreach ($registeredstaff as $address) {
                            ?>
                            <br>
                            <div class="col-md-6 col-sm-6">
                                <label for="name">Permenent Address</label>
                                <textarea id="permenent_address" name="permenent_address" required="" class="form-control"><?php echo cc($address['permenent_address']); ?></textarea>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <label for="name">State</label>
                                        <select class="form-control selectpicker"  id="permenent_state" onchange="get_city_by_state(this.value)" name="permenent_state" data-live-search="true">
                                            <option value="">select state</option>
                                            <?php
                                            if (isset($state_data) && count($state_data) > 0) {
                                                foreach ($state_data as $state_key => $state_value) {
                                                    $office_state = $address['permenent_state'];
                                                    ?>
                                                    <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($office_state) && $office_state == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label for="name">City</label>
                                        <select class="form-control selectpicker"  id="permenent_city" name="permenent_city" data-live-search="true">
                                            <option value="">select city</option>
                                            <?php
                                            if (isset($allcity) && count($allcity) > 0) {
                                                foreach ($allcity as $city_key => $city_value) {
                                                    $office_city = $address['permenent_city'];
                                                    ?>
                                                    <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($office_city) && $office_city == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <label for="name">Residential Address</label>
                                <textarea id="residential_address" name="residential_address" class="form-control"><?php echo cc($address['residential_address']); ?></textarea>
                                <br>
                                <div class="row">
                                    <div class="col--md-6 col-sm-6">
                                        <label for="name">State</label>
                                        <select class="form-control selectpicker" id="residential_state" onchange="get_city_by_statee(this.value)" name="residential_state" data-live-search="true">
                                            <option value="">select state</option>
                                            <?php
                                            if (isset($state_data) && count($state_data) > 0) {
                                                foreach ($state_data as $state_key => $state_value) {
                                                    $work_state = $address['residential_state'];
                                                    ?>
                                                    <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($work_state) && $work_state == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="name">City</label>
                                        <select class="form-control selectpicker"  id="residential_city" name="residential_city" data-live-search="true">
                                            <option value="">select city</option>
                                            <?php
                                            if (isset($allcity) && count($allcity) > 0) {
                                                foreach ($allcity as $city_key => $city_value) {
                                                    $work_city = $address['residential_city'];
                                                    ?>
                                                    <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($work_city) && $work_city == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
                    <br/>  <br/>
                    <h4>Office Use</h4>            
                    <hr>
                    <div class="row">
                        <div class="col-12 col-sm-2">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Old EPF No.</span></label>
                            <input type="text" id="epf_no"   name="epf_no" class="form-control" value="<?php echo $value['epf_no']; ?>">
                        </div>

                        <div class="col-12 col-sm-2">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Old ESIC No.</span></label>
                            <input type="text" id="esic_no"   name="esic_no" class="form-control" value="<?php echo $value['esic_no']; ?>">
                        </div>

                        <div class="col-12 col-sm-4">
                            <span id="lblError" style="color: red"></span>
                            <label>ESIC and EPF Deduction</label>
                            <select class="form-control select2"  name="epf_esicdeduct_id" id="epf_esicdeduct_id"  required>
                                <option  value="">Select</option>
                                <option value="1"<?php if ($value['epf_esicdeduct_id'] == 1) {echo 'selected';} ?>>Yes</option>
                                <option value="2"<?php if ($value['epf_esicdeduct_id'] == 2) { echo 'selected';} ?>>No</option>
                            </select>  
                        </div>
                        <div class="col-12 col-sm-4">
                            <span id="lblError" style="color: red"></span>
                            <label>Approved Probation Period</label>
                            <select class="form-control select2"  name="probationperiod_id" id="probationperiod_id" >
                                <option  value="">Select</option>
                                <option value="1"<?php if ($value['probationperiod_id'] == 1) {echo 'selected';} ?>>Yes</option>
                                <option value="2"<?php if ($value['probationperiod_id'] == 2) {echo 'selected';} ?>>No</option>
                            </select>  
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <span id="lblError" style="color: red"></span>
                            <label>Working </label>
                            <select class="form-control select2"  name="workingbasis_id" id="workingbasis_id"  required>
                                <option  value="">Select</option>
                                <option value="1"<?php if ($value['workingbasis_id'] == 1) {echo 'selected';} ?>>Daily Basis</option>
                                <option value="2"<?php if ($value['workingbasis_id'] == 2) {echo 'selected';} ?>>Monthly Basis</option>
                            </select>  
                        </div>
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Gross Salary</label>
                            <input type="text" id="gross_salary"   name="gross_salary" class="form-control" value="<?php echo $value['gross_salary']; ?>">
                        </div>
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Net Salary</label>
                            <input type="text" id="net_salary"   name="net_salary" class="form-control" value="<?php echo $value['net_salary']; ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">    
                        <div class="col-12 col-sm-4">
                            <label>Designation</label>
                            <select class="form-control" id="designation_data" name="office_city">
                                <option value=""></option>

                                <?php
                                if (isset($designation_data) && count($designation_data) > 0) {

                                    foreach ($designation_data as $designation_key => $designation_value) {
                                        $designation_id = $value['designation_id'];
                                        ?>
                                        <option value="<?php echo $designation_value['id'] ?>" <?php echo (isset($designation_id) && $designation_id == $designation_value['id']) ? 'selected' : "" ?>><?php echo cc($designation_value['designation']); ?></option>

                                        <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="department_id">Department</label>
                            <select class="form-control selectpicker" required="" id="department_id" name="department_id"  data-live-search="true">
                                <option value=""></option>
                                <?php
                                if (isset($departments_info) && count($departments_info) > 0) {
                                    foreach ($departments_info as $departments_key => $departments_value) {
                                        ?>
                                        <option value="<?php echo $departments_value['id'] ?>" <?php echo (isset($value['department_id']) && $value['department_id'] == $departments_value['id']) ? 'selected' : "" ?>><?php echo cc($departments_value['name']); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="superior_id" class="control-label">Superior</label>
                            <select class="form-control selectpicker" required="" id="superior_id" name="superior_id"  data-live-search="true">
                                <option value=""></option>
                                <?php
                                if (isset($superior_info) && count($superior_info) > 0) {
                                    foreach ($superior_info as $superior_key => $superior_value) {
                                        ?>
                                        <option value="<?php echo $superior_value['staffid'] ?>" <?php echo (isset($value['superior_id']) && $value['superior_id'] == $superior_value['staffid']) ? 'selected' : "" ?>><?php echo cc($superior_value['firstname']); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">    
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Interviewers Name</label>
                            <input type="text" id="interviewername"  name="interviewername" class="form-control" value="<?php echo $value['interviewername']; ?>">
                        </div>
                        <div class="col-12 col-sm-8">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Interviewers Remark</label>
                            <textarea id="interviewername"  name="interviewerremark" class="form-control"><?php echo $value['interviewerremark']; ?></textarea>
                        </div>
                    </div>
        <div class="row">
            <br><br>
            <h4 class="no-mtop mrg3">Contact Person</h4>
            <hr>


            <div class="table-responsive s_table">
                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
                    <thead>
                        <tr>
                            <th width="20%" align="left"><?php echo _l('Full Name'); ?></th>
                            <th width="20%" class="qty" align="left"><?php echo _l('Adhaar Card No'); ?></th>
                            <th width="20%" align="left"><?php echo _l('Contact No'); ?> </th>
                            <th width="20%" align="left"><?php echo _l('Date of Birth'); ?>    </th>
                            <th width="20%" align="left"><?php echo _l('Relatioship'); ?>    </th>
                            <th width="10%"  align="center"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <?php
                        if (!empty($staffcontact)) {
                            foreach ($staffcontact as $contact) {
                                ?>
                                <tr class="main" id="tr0">

                                    <td>

                                        <div class="form-group">

                                            <input type="text" id="firstname"  value="<?php echo $contact['full_name']; ?>" name="clientdata[0][firstname]" class="form-control" >

                                        </div>

                                    </td>

                                    <td>

                                        <div class="form-group">

                                            <input type="text" id="email0"   value="<?php echo $contact['adhar_no']; ?>" name="clientdata[0][email]"  class="form-control clientmail" >

                                        </div>

                                    </td>

                                    <td>

                                        <div class="form-group">

                                            <input type="text" id="phonenumber0"  value="<?php echo $contact['contact_no']; ?>" name="clientdata[0][phonenumber]" class="form-control onlynumbers">

                                        </div>

                                    </td>

                                    <td>
                                        <div class="form-group">

                                            <input type="text" id="phonenumber0"  value="<?php echo _d($contact['date_of_birth']); ?>" name="clientdata[0][phonenumber]" class="form-control onlynumbers">

                                        </div>

                                    </td>

                                    <td>

                                        <div class="form-group">

                                            <select class="form-control " >

                                                <?php
                                                if (isset($relationship_data) && count($relationship_data) > 0) {

                                                    foreach ($relationship_data as $designation_key => $designation_value) {
                                                        $designation_id = $contact['relationship_id'];
                                                        ?>
                                                        <option value="<?php echo $designation_value['id'] ?>" <?php echo (isset($designation_id) && $designation_id == $designation_value['id']) ? 'selected' : "" ?>><?php echo $designation_value['relationship'] ?></option>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>

                                        </div>

                                    </td>
                                    <td>

                                        <button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('0');" ><i class="fa fa-remove"></i></button>

                                    </td>

                                </tr>
                    <?php }} ?>
                    </tbody>

                </table>

			<div class="col-xs-12">

			<!-- <label class="label-control subHeads"><a  class="addmorecontact" value="<?php echo count($productcomponent); ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label> -->

			</div>

			</div>

			</div>

			<br><hr/>
            <h4 class="no-mtop mrg3">Bank Detail</h4>
        <hr/>
         <div class="row">
				  <?php if(!empty($registeredstaff)){
                    foreach ($registeredstaff as $bank) { 
                 ?>
		
				
			
			
			<div class="col-md-6">
				<label for="name">Account Number</label>
				<input type="text"  name="account_no" class="form-control" value="<?php echo $bank['account_no']; ?>">
			</div>
			
			<div class="col-md-6">
				<label for="name">IFC Code</label>
				<input type="text"  name="ifc_code" class="form-control"  value="<?php echo $bank['ifc_code']; ?>">
			</div>
			
			
			 <?php }} ?>
			
		</div>

		<!--<div class="form-group">
		<span id="captchaImage" ><?php if(isset($captchaImage)) echo $captchaImage; ?> </span>
        <a class="btn loadCaptcha" href="javascript:void(0);" title="Refresh Captcha Access code" onClick="reloadCaptcha();">Refresh Captcha 
        </a>
		</div>
		<div class="form-group">
        <input type="text" class="form-control form-control-lg" placeholder="Captcha" name="captcha" id="captcha" required>
        <div id="status"></div>
        </div>-->
<br>
<hr/>
        <div class="row bg-gray">
	<div class="col-12">
		 
		<h4 class="no-mtop mrg3">Document Uploads</h3>
	</div>
	
		<div class="row">
			 <div class="col-md-12">
				<div class="col-12 col-sm-3">
				<label for="name">Photo</label>
				
			</div>
			
			<div class="col-12 col-sm-9">
				<?php if(!empty($stafffiles)){
                    foreach ($stafffiles as $upload) { 

                    	if($upload['rel_type']== 'photo_doc'){
                 ?>

				<a href="<?php echo base_url().'uploads/registered_staff/photo_attach/'. $upload['rel_id'].'/'.$upload['file_name'];?>" download><img src="<?php echo base_url().'uploads/registered_staff/photo_attach/'.$upload['rel_id'].'/'.$upload['file_name'];?>" width=100 height=100 > </a>
				&nbsp
                  
               <?php }} }?>
			</div>
			
		</div>
		
	</div>
	<br>
<hr/>
		<div class="row">
			<div class="col-md-12">
				<div class="col-12 col-sm-3">
				<label for="name">PAN Number</label>
				
			</div>
			<div class="col-12 col-sm-9">
				<?php if(!empty($stafffiles)){
                    foreach ($stafffiles as $upload) { 
                    	if($upload['rel_type']== 'pan_attach'){
                 ?>
                <P><?php echo $upload['file_name'];?></P>
				<a href="<?php echo base_url().'uploads/registered_staff/pan_attach/'. $upload['rel_id'].'/'.$upload['file_name'];?>" download>Download</a>
				&nbsp
                  
               <?php }} }?>
			</div>
			
		</div>
		
	</div>
	<br>
<hr/>
		<div class="row">
			<div class="col-md-12">
				<div class="col-12 col-sm-3">
				<label for="name">Adhaar Card </label>
				
			</div>
			<div class="col-12 col-sm-9">
				<?php if(!empty($stafffiles)){
                    foreach ($stafffiles as $upload) { 
                    	if($upload['rel_type']== 'adhar_attach'){
                 ?>
                 <P><?php echo $upload['file_name'];?></P>
				<a href="<?php echo base_url().'uploads/registered_staff/adhar_attach/'. $upload['rel_id'].'/'.$upload['file_name'];?>" download>Download </a>
				&nbsp
                  
               <?php }} }?>
			</div>
			
		</div>
		
	</div>
	<br>
<hr/>
		<div class="row">
			<div class="col-md-12">
				<div class="col-12 col-sm-3">
				<label for="name">Qualification Certificate</label>
				
			</div>
			<div class="col-12 col-sm-9">
				<?php if(!empty($stafffiles)){
                    foreach ($stafffiles as $upload) { 

                   if($upload['rel_type']== 'qualification_attach'){
                 ?>
                  <P><?php echo $upload['file_name'];?></P>
				<a href="<?php echo base_url().'uploads/registered_staff/qualification_attach/'. $upload['rel_id'].'/'.$upload['file_name'];?>" download> Download</a>
				&nbsp
                  
               <?php }}} ?>
			</div>
			
		</div>
		
	</div>
	<br>
<hr/>
		<div class="row">
			<div class="col-md-12">
				<div class="col-12 col-sm-3">
				<label for="name">Relieving Certificate</label>
				
			</div>
			<div class="col-12 col-sm-9">
				<?php if(!empty($stafffiles)){
                    foreach ($stafffiles as $upload) { 
                    	if($upload['rel_type']== 'relieving_attach'){
                 ?>
                   <P><?php echo $upload['file_name'];?></P>
				<a href="<?php echo base_url().'uploads/registered_staff/relieving_attach/'. $upload['rel_id'].'/'.$upload['file_name'];?>" download> Download</a>
				&nbsp
                  
               <?php }} }?>
			</div>
			
		</div>
		
	</div>
	<br>
<hr/>
		<div class="row">
				<div class="col-md-12">
				<div class="col-12 col-sm-3">
				<label for="name">Old Salary Slip</label>
				
			</div>
			<div class="col-12 col-sm-9">
				<?php if(!empty($stafffiles)){
                    foreach ($stafffiles as $upload) { 
                    	if($upload['rel_type']== 'sal_attach'){
                 ?>
                   <P><?php echo $upload['file_name'];?></P>
				<a href="<?php echo base_url().'uploads/registered_staff/sal_attach/'. $upload['rel_id'].'/'.$upload['file_name'];?>" download>Download </a>
				&nbsp
                  
               <?php }}} ?>
			</div>
			
		</div>
		
	</div>
	<!-- <div class="col-12 col-sm-6">
		<label for="photo" class="control-label">Certificate Copy</label>
		<input type="file" id="" name="certificate_image[]" style="width: 100%;" multiple>
	</div> -->
</div>

	
		
		<!--<table>
	      <tr>
			<td>
				<h3 style="font-size:18px;margin-bottom: 5px; font-weight:900;">INSTRUCTIONS</h3>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">01). (<span style="color: red;">*</span>) Mandatory Fields.</p>
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">02). Hand written form will not be acceptable. </p>
				
				<p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">03). Bank Details should be verified by the respective Bank.</p>

				<p style="text-align: center;font-weight:700;font-size: 10px;">IN CASE OF ANY QUERY RELATED TO FILLING FORM PLEASE CONTCT US ON +91-7304997369 OR ON ADMIN@SCHACHENGINEERS.COM </p>
			</td>
		</tr>
      </table>-->
	</div>
            <div class="btn-bottom-toolbar text-right btn-toolbar-container-out">
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
	<?php echo form_close(); ?>
</section>

</body>
</html>
<?php init_tail(); ?>

<script>
    function get_city_by_state(state_id) {
        var html = '<option value=""></option>';
        
        if(state_id == "") {
            $("#permenent_city").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#permenent_city").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	
    function get_city_by_statee(state_id) {
        var html = '<option value=""></option>';
        
        if(state_id == "") {
            $("#residential_city").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#residential_city").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
    
    $('#sameas').change(function() {
		 var permenent_address=$('#permenent_address').val();
		 var permenent_state=$('#permenent_state').val();
		 var permenent_city=$('#permenent_city').val();
		 
		  var html = '<option value=""></option>';
        
        if(permenent_state == "") {
            $("#residential_city").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + permenent_state,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#residential_city").html('').html(html);
				$('#residential_city').val(permenent_city);
                $('.selectpicker').selectpicker('refresh');
            }
        });
		 
        if($(this).is(":checked")) {
            $('#residential_address').val(permenent_address);
            $('#residential_state').val(permenent_state);
            $('#residential_city').val(permenent_city);
            $('.selectpicker').selectpicker('refresh');
        }
        $('#textbox1').val($(this).is(':checked'));        
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#contact_no").keypress(function (e) {

            if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {

                //display error message
                $("#contact_no_err").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
    });
</script>
</body>
</html>