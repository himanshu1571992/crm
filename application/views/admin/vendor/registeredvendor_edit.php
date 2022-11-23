<?php  init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
         <?php echo form_open($this->uri->uri_string(), array('id' => 'vendor-form', 'class' => '_vendor_form vendor-form')); ?>
            <!-- <form  action="<?php if(!empty($id)){ echo admin_url('vendor/registeredvender_edit'); }else{ echo admin_url('company_expense/add_party'); } ?>"  class="vendor-form" enctype="multipart/form-data" method="post" accept-charset="utf-8"> -->
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">


                    <h4 class="no-margin">Business Details</h4>
                    <hr class="hr-panel-heading">

            <div class="row">
             <?php if(!empty($registeredvendor)){
                 foreach ($registeredvendor as $value) { ?>
            <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <span id="errmsg1" style="color: red;"></span>
                <label class="control-label">Name Of Vendor <span style="color: red;">*</span></label>
                <input type="text" required="" id="vendor_name" name="vendor_name" class="form-control" value="<?php echo $value['vendor_name']; ?>">
            </div>


        </div>
        <div class="col-md-3">
            <div class="panel_s no-shadow">
                
                        <div class="form-group" app-field-wrapper="">
                            <label class="control-label">Contact Number<span style="color: red;">*</span></label>
                            <span id="errmsg" style="color: red;"></span>
                            <input type="text" required="" name="contact_no" id="contact_no" minlength="10" maxlength="10" class="form-control" value="<?php echo $value['contact_no']; ?>">
                        </div>
                    </div>
                </div>
                
                    <div class="col-md-3">


                       <div class="form-group" app-field-wrapper="date"><label for="date" class="control-label">Email Id<span style="color: red;">*</span></label>
                            <span id="lblError" style="color: red"></span>
                            <input type="text" required="" id="email_id" name="email_id" class="form-control" value="<?php echo $value['email_id']; ?>" onkeyup="ValidateEmail();">
                        
                       
                        </div>
                    </div>
                    <?php }} ?>
                </div>

                
        <h4 class="no-margin">Address Details</h4>
        <hr class="hr-panel-heading">
           <div class="row">
            <div class="col-md-6 "></div>
               <div class="col-md-6 ">
                <input type="checkbox" id="sameas">
                Same As Office Address
               </div>
           </div>
            <div class="row">
            <?php if(!empty($registeredvendor)){
            foreach ($registeredvendor as $address) { ?>
            <br>
            <div class="col-md-6 col-sm-6">
                <label for="name">Office Address<span style="color: red;">*</span></label>
                <textarea id="permenent_address" name="office_address" required="" class="form-control"><?php echo $address['office_address']; ?></textarea>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label for="name">State<span style="color: red;">*</span></label>
                        <select class="form-control" id="permenent_state" name="office_state" required="">
                            <option value="">select state</option>
                            <?php
                            if (isset($state_data) && count($state_data) > 0) {
                                foreach ($state_data as $state_key => $state_value) 
                                {
                                $office_state = $address['office_state'];
                                ?>
                                <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($office_state) && $office_state == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label for="name">City<span style="color: red;">*</span></label>
                        <select class="form-control" id="permenent_city" name="office_city" required="">
                            <option value="">select city</option>
                            <?php
                            if (isset($allcity) && count($allcity) > 0  ) {
                                foreach ($allcity as $city_key => $city_value) {
                                    $office_city = $address['office_city'];
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
                <label for="name">Work Address<span style="color: red;">*</span></label>
                <textarea id="residential_address" name="work_address" required="" class="form-control"><?php echo $address['work_address']; ?></textarea>
                <div class="row">
                    <div class="col--md-6 col-sm-6">
                        <label for="name">State<span style="color: red;">*</span></label>
                        <select class="form-control" id="residential_state" name="work_state" required="">
                            <option value="">select state</option>
                            <?php
                            if (isset($state_data) && count($state_data) > 0) {
                                foreach ($state_data as $state_key => $state_value) 
                                {
                                $work_state = $address['work_state'];
                                ?>
                                <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($work_state) && $work_state == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label for="name">City<span style="color: red;">*</span></label>
                        <select class="form-control" id="residential_city" name="work_city" required="">
                            <option value="">select city</option>
                            <?php
                            if (isset($allcity) && count($allcity) > 0  ) {
                                foreach ($allcity as $city_key => $city_value) {
                                    $work_city = $address['work_city'];
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
           <?php }} ?>
                </div>

                <!-- <h4 class="no-margin">Contact Person</h4>
                    <hr class="hr-panel-heading"> -->

            <div class="row">
<br><br>
            <h4 class="no-mtop mrg3">Contact Person</h4>
<hr/>
<?php

if(!isset($vendorcontact))

{?>

<div class="table-responsive s_table">

<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable3">

<thead>

<tr>

<th width="20%" align="left"><?php echo _l('name');?></th>

<th width="20%" class="qty" align="left"><?php echo _l('email');?></th>

<th width="20%" align="left"><?php echo _l('number');?> </th>

<th width="20%" align="left"><?php echo _l('designation');?>    </th>

<th width="10%"  align="center"><i class="fa fa-cog"></i></th>

</tr>

</thead>

<tbody class="ui-sortable">
<?php //if(!empty($vendorcontact)){ ?>
<tr class="main" id="tr0">

<td>

<div class="form-group">

    <input type="text" id="firstname" value="" name="persondata['+newaddmore+'][contactperson_name]" class="form-control" >

</div>

</td>

<td>

<div class="form-group">
    <span id="lblError1" style="color: red"></span>
    <input type="text" id="contactperson_email" value="" name="persondata['+newaddmore+'][contactperson_email]" class="form-control clientmail" onkeyup="ValidateEmail1();">

</div>

</td>

<td>

<div class="form-group">
    <span id="errmsg2" style="color: red;"></span>
    <input type="text" id="contactperson_no" value="" name="persondata['+newaddmore+'][contactperson_no]"  minlength="10" maxlength="10" class="form-control onlynumbers">

</div>

</td>

<td>

<div class="form-group">

<select class="form-control selectpicker" data-live-search="true" id="person_designation" name="persondata['+newaddmore+'][designation_id]">

<option value=""></option>

<?php

if (isset($designation_data) && count($designation_data) > 0) {

    foreach ($designation_data as $designation_key => $designation_value) {

        $designation_id = $contact['designation_id'];
        ?>
        <option value="<?php echo $designation_value['id'] ?>" <?php echo (isset($designation_id) && $designation_id == $designation_value['id']) ? 'selected' : "" ?>><?php echo cc($designation_value['designation']); ?></option>

        <?php

    }

}

?>

</select>

        </div>

    </td>
    <td>

        <button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson3('0');" ><i class="fa fa-remove"></i></button>

    </td>

</tr>

</tbody>

</table>

<div class="col-xs-12">

<label class="label-control subHeads"><a  class="addmorecontact3 addMore" value="0">Add More <i class="fa fa-plus"></i></a></label>

</div>

</div>
<?php

					}

					else

					{?>

				<div class="table-responsive s_table">

<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable3">

<thead>

<tr>

<th width="20%" align="left"><?php echo _l('name');?></th>

<th width="20%" class="qty" align="left"><?php echo _l('email');?></th>

<th width="20%" align="left"><?php echo _l('number');?> </th>

<th width="20%" align="left"><?php echo _l('designation');?>    </th>

<th width="10%"  align="center"><i class="fa fa-cog"></i></th>

</tr>

</thead>

<tbody class="ui-sortable">
<?php if(!empty($vendorcontact)){
	$i=0;
foreach ($vendorcontact as $contact) {
$i++; ?>
<tr class="main" id="trcc<?php echo $i;?>">

<td>

<div class="form-group">

    <input type="text" id="firstname" name="persondata[<?php echo $i;?>][contactperson_name]" value="<?php echo $contact['contactperson_name']; ?>" class="form-control" >

</div>

</td>

<td>

<div class="form-group">
    <span id="lblError1" style="color: red"></span>
    <input type="text" id="contactperson_email" name="persondata[<?php echo $i;?>][contactperson_email]" value="<?php echo $contact['contactperson_email']; ?>" class="form-control clientmail" onkeyup="ValidateEmail1();">

</div>

</td>

<td>

<div class="form-group">
    <span id="errmsg2" style="color: red;"></span>
    <input type="text" id="contactperson_no" name="persondata[<?php echo $i;?>][contactperson_no]" minlength="10" maxlength="10" value="<?php echo $contact['contactperson_no']; ?>"  class="form-control onlynumbers">

</div>

</td>

<td>

<div class="form-group">

<select class="form-control selectpicker" data-live-search="true" id="person_designation" name="persondata[<?php echo $i;?>][designation_id]">

<option value=""></option>

<?php

if (isset($designation_data) && count($designation_data) > 0) {

    foreach ($designation_data as $designation_key => $designation_value) {

        $designation_id = $contact['designation_id'];
        ?>
        <option value="<?php echo $designation_value['id'] ?>" <?php echo (isset($designation_id) && $designation_id == $designation_value['id']) ? 'selected' : "" ?>><?php echo cc($designation_value['designation']); ?></option>

        <?php

    }

}

?>

</select>

        </div>

    </td>
    <td>

        <button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson3('<?php echo $i;?>');" ><i class="fa fa-remove"></i></button>

    </td>

</tr>
<?php } } ?>
</tbody>

</table>

<div class="col-xs-12">

<label class="label-control subHeads"><a  class="addmorecontact3 addMore" value="<?php echo $i;?>">Add More <i class="fa fa-plus"></i></a></label>

</div>

</div>
<?php
} ?>
</div>

     <h4 class="no-margin">Statutory Details</h4>
                    <hr class="hr-panel-heading">

            <div class="row">
             <?php if(!empty($registeredvendor)){
            foreach ($registeredvendor as $statutory) { ?>
            <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Business Type </label>
                <select class="form-control" name="business_type">
            <option value=""></option>
            <?php
            if (isset($business_type_data) && count($business_type_data) > 0) {
                foreach ($business_type_data as $business_type_key => $business_type_value) {
                    $business_type = $statutory['business_type'];
                    ?>
                    <option value="<?php echo $business_type_value['id'] ?>" <?php echo (isset($business_type) && $business_type == $business_type_value['id']) ? 'selected' : "" ?>><?php echo cc($business_type_value['name']); ?></option>
                    <?php
                }
            }
            ?>
        </select>
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Business Activity </label>
                <input type="text" name="business_activity" class="form-control" value="<?php echo $statutory['business_activity']; ?>" >
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Year of comencement</label>
                <input type="text" name="comencement_year" class="form-control" value="<?php echo $statutory['comencement_year']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">PAN Number<span style="color: red;">*</span></label>
                <input type="text" name="pan_no" required="" class="form-control" value="<?php echo $statutory['pan_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">GST Number<span style="color: red;">*</span></label>
                <input type="text" required="" name="gst_no" class="form-control" value="<?php echo $statutory['gst_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">MSME Number</label>
                <input type="text" name="msme_no" class="form-control" value="<?php echo $statutory['msme_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">IEC Number </label>
                <input type="text" name="iec_no" class="form-control" value="<?php echo $statutory['iec_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">CIN Number </label>
                <input type="text" name="cin_no" class="form-control" value="<?php echo $statutory['cin_no']; ?>">
            </div>


        </div>
       <?php }} ?>
        </div>


        <div class="row">

            <h4 class="no-mtop mrg3">Financial Details</h4>
<hr/>
<?php

if(!isset($vendorfinancial))

{?>

<div class="table-responsive s_table">

<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">

<thead>
    <tr>
        <th width="20%" align="left">Financial Year</th>
        <th width="20%" class="qty" align="left">TurnOver Details</th>
        <th width="10%"  align="center" class="text-center">Action</th>
    </tr>
</thead>

<tbody class="ui-sortable">
                <tr class="main" id="tr0">
                    <td>
                        <div class="form-group">
                            <input type="text" value="" name="financialdata['+newaddmore+'][financial_year]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="" name="financialdata['+newaddmore+'][turnover_details]" class="form-control" >
                        </div>
                    </td>
                    
                    
                    <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="removeclientperson2('0');"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>

</table>

<div class="col-xs-12">

<label class="label-control subHeads"><a  class="addmorecontact2 addMore" value="0">Add More <i class="fa fa-plus"></i></a></label>

</div>

</div>

<?php

}

else

{?>
<div class="table-responsive s_table">

<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">

<thead>
    <tr>
        <th width="20%" align="left">Financial Year</th>
        <th width="20%" class="qty" align="left">TurnOver Details</th>
        <th width="10%"  align="center" class="text-center">Action</th>
    </tr>
</thead>

<tbody class="ui-sortable">
	<?php if(!empty($vendorfinancial)){
	  $j=0;
      foreach ($vendorfinancial as $financial) { 
       $j++;
      	?>
                <tr class="main" id="trccf<?php echo $j;?>">
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $financial['financial_year']; ?>" name="financialdata[<?php echo $j;?>][financial_year]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $financial['turnover_details']; ?>" name="financialdata[<?php echo $j;?>][turnover_details]" class="form-control" >
                        </div>
                    </td>
                    
                    
                    <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="removeclientperson2('<?php echo $j;?>');"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>

</table>

<div class="col-xs-12">

<label class="label-control subHeads"><a  class="addmorecontact2 addMore" value="<?php echo $j;?>">Add More <i class="fa fa-plus"></i></a></label>

</div>

</div>
<?php
} ?>
</div>

<div class="row">

            <h4 class="no-mtop mrg3">Customer Reference</h4>
<hr/>
<?php

if(!isset($vendorcustomer))

{?>
<div class="col-sm-12">
            <div class="table-responsive s_table">
            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable0">
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
                	
                    <tr class="main" id="tr0">
                        <td>
                            <div class="form-group">
                                <input type="text" value="" name="customerdata['+newaddmore+'][customer_name]" class="form-control" >
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" value="" name="customerdata['+newaddmore+'][customercontact_person]" class="form-control" >
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <span id="errmsg3" style="color: red;"></span>
                                <input type="text" value="" id="customercontact_no" name="customerdata['+newaddmore+'][customercontact_no]" class="form-control">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea name="customerdata['+newaddmore+'][customer_address]" required="" class="form-control"></textarea>
                            </div>
                        </td>
                        
                        
                        <td class="text-center">
                        <button type="button" class="btn btn-danger" onclick="removeclientperson0('0');"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="col-xs-12 text-right">
                <label class="label-control subHeads"><a  class="addmorecontact addMore" value="0">Add More <i class="fa fa-plus"></i></a></label>
            </div>
        </div>
        <?php

}

else

{?>
	<div class="col-sm-12">
            <div class="table-responsive s_table">
            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable0">
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
                	<?php if(!empty($vendorcustomer)){
                	$k=0;
                    foreach ($vendorcustomer as $customer) { 
                    $k++;
                    ?>
                    <tr class="main" id="trcus<?php echo $k;?>">
                        <td>
                            <div class="form-group">
                                <input type="text" value="<?php echo $customer['customer_name']; ?>" name="customerdata[<?php echo $k;?>][customer_name]" class="form-control" >
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" value="<?php echo $customer['customercontact_person']; ?>" name="customerdata[<?php echo $k;?>][customercontact_person]" class="form-control" >
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <span id="errmsg3" style="color: red;"></span>
                                <input type="text" id="customercontact_no" value="<?php echo $customer['customercontact_no']; ?>" name="customerdata[<?php echo $k;?>][customercontact_no]" class="form-control">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea name="customerdata[<?php echo $k;?>][customer_address]" required="" class="form-control"><?php echo $customer['customer_address']; ?></textarea>
                            </div>
                        </td>
                        
                        
                        <td class="text-center">
                        <button type="button" class="btn btn-danger" onclick="removeclientperson0('<?php echo $k;?>');"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
            </div>
            <div class="col-xs-12 text-right">
                <label class="label-control subHeads"><a  class="addmorecontact addMore" value="<?php echo $k;?>">Add More <i class="fa fa-plus"></i></a></label>
            </div>
        </div>
<?php
} ?>
</div>

<div class="row">

            <h4 class="no-mtop mrg3">Product Details</h4>
<hr/>
<?php

if(!isset($vendorproduct))

{?>
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
                <tr class="main" id="tr0">
                    <td>
                        <div class="form-group">
                            <input type="text" value="" name="productdata['+newaddmore+'][product_name]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="" name="productdata['+newaddmore+'][quality_certification]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="" name="productdata['+newaddmore+'][product_specification]" class="form-control">
                        </div>
                    </td>
                    
                    
                    <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="removeclientpersons('0');"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-xs-12 text-right">
            <label class="label-control subHeads"><a  class="addmorecontact1 addMore" value="0">Add More <i class="fa fa-plus"></i></a></label>
        </div>
        </div>
        </div>
        <?php

		}

		else

		{?>
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
            	<?php if(!empty($vendorproduct)){
            	$l=0;
                foreach ($vendorproduct as $product) { 
                $l++;
                ?>
                <tr class="main" id="trpro<?php echo $l;?>">
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $product['product_name']; ?>" name="productdata[<?php echo $l;?>][product_name]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $product['quality_certification']; ?>" name="productdata[<?php echo $l;?>][quality_certification]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $product['product_specification']; ?>" name="productdata[<?php echo $l;?>][product_specification]" class="form-control">
                        </div>
                    </td>
                    
                    
                    <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="removeclientpersons('<?php echo $l;?>');"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            <?php }} ?>
            </tbody>
        </table>
        <div class="col-xs-12 text-right">
            <label class="label-control subHeads"><a  class="addmorecontact1 addMore" value="<?php echo $l;?>">Add More <i class="fa fa-plus"></i></a></label>
        </div>
        </div>
        </div>
<?php
} ?>
</div>

<h4 class="no-margin">Bank Details</h4>
                    <hr class="hr-panel-heading">

        <div class="row">
    	<?php if(!empty($registeredvendor)){
                foreach ($registeredvendor as $bank) { 
             ?>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Name of Bank<span style="color: red;">*</span></label>
                <input type="text" required="" name="bank_name" class="form-control" value="<?php echo $bank['bank_name']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Address<span style="color: red;">*</span></label>
                <textarea name="bank_address" required="" class="form-control"><?php echo $bank['bank_address']; ?></textarea>
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Type of Account<span style="color: red;">*</span></label>
                <input type="text" required="" name="account_type" class="form-control" value="<?php echo $bank['account_type']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Account Number<span style="color: red;">*</span></label>
                <input type="text" required="" name="account_no" class="form-control" value="<?php echo $bank['account_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">IFC Code<span style="color: red;">*</span></label>
                <input type="text" required="" name="ifc_code" class="form-control" value="<?php echo $bank['ifc_code']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">MICR Code</label>
                <input type="text" name="micr_code" class="form-control" value="<?php echo $bank['micr_code']; ?>">
            </div>


        </div>
        <?php }} ?>
        </div>



                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div>



                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>
 
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>





</body>
</html>

<script type="text/javascript">
	$('.addmorecontact3').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable3 tbody').append('<tr class="main" id="trcc4'+newaddmore+'"><td><div class="form-group"><input type="text" required name="persondata['+newaddmore+'][contactperson_name]" class="form-control" ></div></td><td><div class="form-group"><input type="email" required name="persondata['+newaddmore+'][contactperson_email]" class="form-control"></div></td><td><div class="form-group"><input type="text" required name="persondata['+newaddmore+'][contactperson_no]" minlength="10" maxlength="10" class="form-control"></div></td><td><div class="form-group"><select name="persondata['+newaddmore+'][designation_id]" required class="form-control"><option value="">select Designation</option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php }}?></select></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientperson44('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson3(procompid)
    {
        $('#trcc' + procompid).remove();
    }
    function removeclientperson44(procompid)
    {
        $('#trcc4' + procompid).remove();
    }
</script>
<script type="text/javascript">
	$('.addmorecontact2').click(function ()
    {
        var addmore = parseInt($(this).attr('value')); 
        var newaddmore = addmore + 1; 
        $(this).attr('value', newaddmore);
        $('#myContactTable tbody').append('<tr class="main" id="trccj'+newaddmore+'"><td><div class="form-group"><input type="text" required name="financialdata['+newaddmore+'][financial_year]" class="form-control" ></div></td><td><div class="form-group"><input type="text" required name="financialdata['+newaddmore+'][turnover_details]" class="form-control"></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientpersonj('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson2(procompid)
    {
        $('#trccf' + procompid).remove();
    }
    function removeclientpersonj(procompid)
    {
        $('#trccj' + procompid).remove();
    }
</script>
<script type="text/javascript">
	$('.addmorecontact').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable0 tbody').append('<tr class="main" id="trcus1'+newaddmore+'"><td><div class="form-group"><input type="text" required name="customerdata['+newaddmore+'][customer_name]" class="form-control" ></div></td><td><div class="form-group"><input type="text" required name="customerdata['+newaddmore+'][customercontact_person]" class="form-control"></div></td><td><div class="form-group"><input type="text" required name="customerdata['+newaddmore+'][customercontact_no]" class="form-control"></div></td><td><div class="form-group"><textarea name="customerdata['+newaddmore+'][customer_address]" required="" class="form-control"></textarea></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientpersoncus('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson0(procompid)
    {
        $('#trcus' + procompid).remove();
    }
    function removeclientpersoncus(procompid)
    {
        $('#trcus1' + procompid).remove();
    }
</script>
<script type="text/javascript">
	$('.addmorecontact1').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable1 tbody').append('<tr class="main" id="trpro1'+newaddmore+'"><td><div class="form-group"><input type="text" required name="productdata['+newaddmore+'][product_name]" class="form-control" ></div></td><td><div class="form-group"><input type="text" required name="productdata['+newaddmore+'][quality_certification]" class="form-control"></div></td><td><div class="form-group"><input type="text" required name="productdata['+newaddmore+'][product_specification]" class="form-control"></div></td><td class="text-center"><button type="button" class="btn btn-danger"  onclick="removeclientpersonspro('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientpersons(procompid)
    {
        $('#trpro' + procompid).remove();
    }
    function removeclientpersonspro(procompid)
    {
        $('#trpro1' + procompid).remove();
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
    function number(){
        var a=document.getElementById('nu').value;
        if(a>10000000000){
            alert("not valid");
        }
        else{
            alert("ok");
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
  //called when key is pressed in textbox
  $("#contact_no").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {
        
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
  $("#vendor_name").keypress(function (a) {
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
    });

   $("#contactperson_no").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {
        
        //display error message
        $("#errmsg2").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

    $("#customercontact_no").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {
        
        //display error message
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