<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        

           
        
                <div class="panel_s">
                    <div class="panel-body">


                    <h4 class="no-margin">Employee Details</h4>
                    <hr class="hr-panel-heading">
	     <div class="row">      
	    	  <?php if(!empty($registeredstaff)){
                 foreach ($registeredstaff as $value) { ?>

			<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="1">Name of Employee</label>
				<input type="text" id="employee_name" readonly name="employee_name"  class="form-control" value="<?php echo cc($value['employee_name']); ?>">
			</div>
			<div class="col-12 col-sm-4">
				<span id="errmsg"></span>
				<label for="contact_no">Contact Number</label>
				<input type="tel" id="contact_no" minlength="10" readonly maxlength="10" value="<?php echo $value['contact_no']; ?>" name="contact_no" class="form-control" required>
				
			</div>
			<div class="col-12 col-sm-4">
				<span id="lblError" style="color: red"></span>
				<label for="name">Email Id</label>
				<input type="text" id="email" readonly name="email"  class="form-control" onkeyup="ValidateEmail();" value="<?php echo $value['email']; ?>">
			</div>
</div>

 <div class="row">
			<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="Date of Birth">Date of Birth</label>
				<input type="text"  name="birth_date" readonly class="form-control datepicker" value="<?php echo _d($value['birth_date']); ?>">
			</div>
			<!--<div class="col-12 col-sm-4">
				<span id="errmsg1"></span>
				<label for="Date of Birth">Date of Joining<span style="color: red;">*</span></label>
				<input type="text"   name="joining_date" class="form-control datepicker" required>
			</div>-->
			 
			<div class="col-12 col-sm-4">
				<span id="errmsg"></span>
				<div class="form-group">
                    <label for="gender" class="control-label">Gender</label>
                    <select class="form-control"   id="gender" name="gender"  data-live-search="true" readonly>
                        <option value="" disabled selected>--Select One--</option>
                        <option value="1" <?php if($value['gender']==1){ echo 'selected';}?>>Male</option>
                        <option value="2"  <?php if($value['gender']==2){ echo 'selected';}?>>Female</option>
                    </select>
				</div>

			</div>
			<div class="col-12 col-sm-4">
			
                <label>Designation</label>


                <select class="form-control" disabled="" id="designation_data" name="office_city" readonly>

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
			</div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Adhaar Card No.</label>
                            <input type="text" id="adhar_no" readonly name="adhar_no" class="form-control"  value="<?php echo $value['adhar_no']; ?>">
                        </div>

                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Pan Card No.</label>
                            <input type="text" id="pan_card_no" readonly name="pan_card_no" class="form-control" value="<?php echo $value['pan_card_no']; ?>">
                        </div>


                        <div class="col-12 col-sm-2">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Old EPF No.</span></label>
                            <input type="text" id="epf_no" readonly  name="epf_no" class="form-control" value="<?php echo $value['epf_no']; ?>">
                        </div>

                        <div class="col-12 col-sm-2">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Old ESIC No.</span></label>
                            <input type="text" id="esic_no" readonly  name="esic_no" class="form-control" value="<?php echo $value['esic_no']; ?>">
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-12 col-sm-4">
                            <span id="lblError" style="color: red"></span>
                            <label>ESIC and EPF Deduction</label>
                            <select class="form-control select2" readonly name="epf_esicdeduct_id" id="epf_esicdeduct_id"  required>
                                <option  value="">Select</option>

                                <option value="1"<?php if ($value['epf_esicdeduct_id'] == 1) {echo 'selected';} ?>>Yes</option>
                                <option value="2"<?php if ($value['epf_esicdeduct_id'] == 2) {echo 'selected';} ?>>No</option>
                            </select>  
                        </div>
                        <div class="col-12 col-sm-4">
                            <span id="lblError" style="color: red"></span>
                            <label>Approved Probation Period</label>
                            <select class="form-control select2" readonly name="probationperiod_id" id="probationperiod_id" >
                                <option  value="">Select</option>

                                <option value="1"<?php if ($value['probationperiod_id'] == 1) {echo 'selected';} ?>>Yes</option>
                                <option value="2"<?php if ($value['probationperiod_id'] == 2) {echo 'selected';} ?>>No</option>
                            </select>  
                        </div>
                        <div class="col-12 col-sm-4">
                            <span id="lblError" style="color: red"></span>
                            <label>Working </label>
                            <select class="form-control select2" readonly name="workingbasis_id" id="workingbasis_id"  required>
                                <option  value="">Select</option>

                                <option value="1"<?php if ($value['workingbasis_id'] == 1) {echo 'selected';} ?>>Daily Basis</option>
                                <option value="2"<?php if ($value['workingbasis_id'] == 2) {echo 'selected';} ?>>Monthly Basis</option>
                            </select>  
                        </div>
                        
                    </div>
                    <div class="row">   
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Gross Salary</label>
                            <input type="text" id="gross_salary" readonly  name="gross_salary" class="form-control" value="<?php echo $value['gross_salary']; ?>">
                        </div>
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Net Salary</label>
                            <input type="text" id="net_salary" readonly  name="net_salary" class="form-control" value="<?php echo $value['net_salary']; ?>">
                        </div>

                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Interviewers Name</label>
                            <input type="text" id="interviewername" readonly name="interviewername" class="form-control" value="<?php echo $value['interviewername']; ?>">
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="department_id">Department</label>
                            <select class="form-control" disabled="" required="" id="department_id" name="department_id"  data-live-search="true">
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
                            <select class="form-control" disabled="" required="" id="superior_id" name="superior_id"  data-live-search="true">
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
                        <div class="col-12 col-sm-4">
                            <span id="errmsg1"></span>
                            <label for="Date of Birth">Interviewers Remark</label>
                            <textarea id="interviewername" readonly name="interviewerremark" rows="5" class="form-control"><?php echo $value['interviewerremark']; ?></textarea>
                        </div>
                    </div>
                    <?php }} ?> 

		<hr>
        <br/>  <br/> 
        
            <h4 class="no-margin" >Company Details</h4>
            <hr class="hr-panel-heading">
            <div class="row">
                <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
                    <div class="col-12 col-sm-4">
                        <label class="control-label">Designation</label>
                        <div class="form-group">
                            <select class="form-control selectpicker" id="designation_id" name="designation_id" data-live-search="true" required>
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
                    </div>  
                    <div class="col-12 col-sm-4">
                        <label for="branch_id" class="control-label">Branch</label>
                        <div class="form-group">
                            <select class="form-control selectpicker" required="" id="branch_id" name="branch_id"  data-live-search="true">
                                <option value=""></option>
                                <?php
                                if (isset($company_branch_list) && count($company_branch_list) > 0) {
                                    foreach ($company_branch_list as $key => $branch) {
                                        ?>
                                        <option value="<?php echo $branch['id'] ?>" <?php echo (isset($value['branch_id']) && $value['branch_id'] == $branch['id']) ? 'selected' : "" ?>><?php echo cc($branch['comp_branch_name']); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label for="superior_id" class="control-label">Superior</label>
                        <div class="form-group">
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
                    <div class="col-12 col-sm-4">
                        <span id="errmsg1"></span>
                        <div class="form-group">
                            <label for="Date of Birth">Net Salary</label>
                            <input type="text" id="net_salary" name="net_salary" class="form-control" value="<?php echo $value['net_salary']; ?>" required>
                        </div>   
                    </div>   
                    <div class="col-12 col-sm-4">
                        <span id="errmsg1"></span>
                        <div class="form-group">
                            <label for="Date of Birth">Date of Joining</label>
                            <input type="text" name="joining_date" class="form-control datepicker" value="<?php echo _d($value['joining_date']); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                <?php echo form_close(); ?>
            </div>    
         <br/>  <br/> 
        
       <h4 class="no-margin">Address Details</h4>
                    <hr class="hr-panel-heading">
            <div class="row">
                <?php if(!empty($registeredstaff)){
                  foreach ($registeredstaff as $address) { ?>
            <br>
            <div class="col-md-6 col-sm-6">
                
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label for="name">State</label>
                        <select class="form-control" disabled="" readonly id="permenent_state" name="office_state" >
                            <option value="">select state</option>
                            <?php
                            if (isset($state_data) && count($state_data) > 0) {
                                foreach ($state_data as $state_key => $state_value) 

                                {
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
                        <select class="form-control" readonly disabled="" id="permenent_city" name="office_city">
                            <option value="">select city</option>
                            <?php
                            if (isset($allcity) && count($allcity) > 0  ) {
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
                <label for="name">Permenent Address</label>
                <textarea id="permenent_address" disabled="" readonly name="office_address" required="" class="form-control"><?php echo cc($address['permenent_address']); ?></textarea>
                <label for="name">Permenent Pincode</label>
                <input class="form-control" type="text" readonly="" Value="<?php echo cc($address['permenent_pincode']); ?>">
            </div>

            <div class="col-md-6 col-sm-6">
                
                <div class="row">
                    <div class="col--md-6 col-sm-6">
                        <label for="name">State</label>
                        <select class="form-control" disabled="" readonly id="residential_state" name="work_state">
                            <option value="">select state</option>
                            <?php
                            if (isset($state_data) && count($state_data) > 0) {
                                foreach ($state_data as $state_key => $state_value) 
                                {
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
                        <select class="form-control" disabled=""  readonly id="residential_city" name="work_city">
                            <option value="">select city</option>
                            <?php
                            if (isset($allcity) && count($allcity) > 0  ) {
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

                <label for="name">Residential Address</label>
                <textarea id="residential_address" disabled="" readonly name="work_address" class="form-control"><?php echo cc($address['residential_address']); ?></textarea>

                <label for="name">Residential Pincode</label>
                <input class="form-control" type="text" readonly="" Value="<?php echo cc($address['residential_pincode']); ?>">
            </div>
            <?php }} ?>
                </div>


        <div class="row">
<br><br>
            <h4 class="no-mtop mrg3">Contact Person</h4>
<hr/>


            <div class="table-responsive s_table">

            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">

                <thead>

                    <tr>

						<th width="20%" align="left"><?php echo _l('Full Name');?></th>

						<th width="20%" class="qty" align="left"><?php echo _l('Adhaar Card No');?></th>

						<th width="20%" align="left"><?php echo _l('Contact No');?> </th>

						<th width="20%" align="left"><?php echo _l('Date of Birth');?>    </th>
						<th width="20%" align="left"><?php echo _l('Relatioship');?>    </th>

						<th width="10%"  align="center"><i class="fa fa-cog"></i></th>

                    </tr>

                </thead>

					<tbody class="ui-sortable">
					  <?php 
					        if(!empty($staffcontact)){
					          foreach ($staffcontact as $contact) { ?>
					            <tr class="main" id="tr0">

					                <td>

										<div class="form-group">

										    <input type="text" id="firstname" readonly value="<?php echo $contact['full_name']; ?>" name="clientdata[0][firstname]" class="form-control" >

										</div>

									</td>

									<td>

									    <div class="form-group">

									    <input type="text" id="email0" readonly  value="<?php echo $contact['adhar_no']; ?>" name="clientdata[0][email]"  class="form-control clientmail" >

									    </div>

									</td>

									<td>

									    <div class="form-group">

									    <input type="text" id="phonenumber0" readonly value="<?php echo $contact['contact_no']; ?>" name="clientdata[0][phonenumber]" class="form-control onlynumbers">

									    </div>

									</td>

									<td>
									   <div class="form-group">

									    <input type="text" id="phonenumber0" readonly value="<?php echo _d($contact['date_of_birth']); ?>" name="clientdata[0][phonenumber]" class="form-control onlynumbers">

									   </div>

									</td>

									<td>

								    <div class="form-group">

								    <select class="form-control " readonly>

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
		
				
			
			<div class="col-md-4">
                <label for="name">Bank Name</label>
                <input type="text" readonly name="account_no" class="form-control" value="<?php echo $bank['bank_name']; ?>">
            </div>

			<div class="col-md-4">
				<label for="name">Account Number</label>
				<input type="text" readonly name="account_no" class="form-control" value="<?php echo $bank['account_no']; ?>">
			</div>
			
			<div class="col-md-4">
				<label for="name">IFC Code</label>
				<input type="text" readonly name="ifc_code" class="form-control"  value="<?php echo $bank['ifc_code']; ?>">
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

	
		</form> 
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
	
</section>

</body>
</html>
<?php init_tail(); ?>


</body>
</html>
