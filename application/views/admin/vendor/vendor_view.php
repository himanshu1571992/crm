<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('holidays/edit'); }else{ echo admin_url('holidays/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
                <label class="control-label">Name Of Vendor </label>
                <input type="text" readonly="" class="form-control" value="<?php echo $value['vendor_name']; ?>">
            </div>


        </div>
        <div class="col-md-3">
            <div class="panel_s no-shadow">
                
                        <div class="form-group" app-field-wrapper="">
                            <label class="control-label">Contact Number</label>
                            <input type="text" readonly="" class="form-control" value="<?php echo $value['contact_no']; ?>">
                        </div>
                    </div>
                </div>
                
                    <div class="col-md-3">


                       <div class="form-group" app-field-wrapper="date"><label for="date" class="control-label"> <small class="req text-danger">* </small>Email Id</label>
                      
                            <input type="email" id="date" name="date" disabled="" class="form-control datepicker" value="<?php echo $value['email_id']; ?>">
                        
                       
                        </div>
                    </div>
                <?php }} ?>
                </div>

                
                <h4 class="no-margin">Address Details</h4>
                    <hr class="hr-panel-heading">
            <div class="row">
                <?php if(!empty($registeredvendor)){
                  foreach ($registeredvendor as $address) { ?>
            <br>
            <div class="col-md-6 col-sm-6">
                <label for="name">Office Address*</label>
                <textarea id="permenent_address" disabled="" name="office_address" required="" class="form-control"><?php echo $address['office_address']; ?></textarea>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label for="name">State*</label>
                        <select class="form-control" disabled="" id="permenent_state" name="office_state" >
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
                        <label for="name">City*</label>
                        <select class="form-control" disabled="" id="permenent_city" name="office_city">
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
                <label for="name">Work Address*</label>
                <textarea id="residential_address" disabled="" name="work_address" class="form-control"><?php echo $address['work_address']; ?></textarea>
                <div class="row">
                    <div class="col--md-6 col-sm-6">
                        <label for="name">State*</label>
                        <select class="form-control" disabled="" id="residential_state" name="work_state">
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
                        <label for="name">City*</label>
                        <select class="form-control" disabled="" id="residential_city" name="work_city">
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


<div class="row">
<br><br>
            <h4 class="no-mtop mrg3">Contact Person</h4>
<hr/>


<div class="table-responsive s_table">

<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">

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
foreach ($vendorcontact as $contact) { ?>
<tr class="main" id="tr0">

<td>

<div class="form-group">

    <input type="text" id="firstname" value="<?php echo $contact['contactperson_name']; ?>" name="clientdata[0][firstname]" class="form-control" >

</div>

</td>

<td>

<div class="form-group">

    <input type="text" id="email0" value="<?php echo $contact['contactperson_email']; ?>" name="clientdata[0][email]"  class="form-control clientmail" >

</div>

</td>

<td>

<div class="form-group">

    <input type="text" id="phonenumber0" value="<?php echo $contact['contactperson_no']; ?>" name="clientdata[0][phonenumber]" class="form-control onlynumbers">

</div>

</td>

<td>

<div class="form-group">

<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[0][designation_id]">

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
                <input type="text" readonly="" class="form-control" value="<?php echo $statutory['business_activity']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Year of comencement</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $statutory['comencement_year']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">PAN Number</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $statutory['pan_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">GST Number</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $statutory['gst_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">MSME Number</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $statutory['msme_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">IEC Number </label>
                <input type="text" readonly="" class="form-control" value="<?php echo $statutory['iec_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">CIN Number </label>
                <input type="text" readonly="" class="form-control" value="<?php echo $statutory['cin_no']; ?>">
            </div>


        </div>
        <?php }} ?>
        </div>


        <div class="row">

            <h4 class="no-mtop mrg3">Financial Details</h4>
<hr/>

<div class="col-sm-12">
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
      foreach ($vendorfinancial as $financial) { ?>
                <tr class="main" id="tr0">
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $financial['financial_year']; ?>" name="financialdata['+newaddmore+'][financial_year]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $financial['turnover_details']; ?>" name="financialdata['+newaddmore+'][turnover_details]" class="form-control" >
                        </div>
                    </td>
                    
                    
                    <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="removeclientperson2('0');"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            <?php }} ?>
            </tbody>

</table>

<!-- <div class="col-xs-12">

<label class="label-control subHeads"><a  class="addmorecontact" value="<?php echo count($productcomponent); ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>

</div> -->

</div>
</div>

</div>

<div class="row">

            <h4 class="no-mtop mrg3">Customer Reference</h4>
<hr/>
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
                    <?php if(!empty($vendorcustomer)){
                    foreach ($vendorcustomer as $customer) { 
                    ?>
                    <tr class="main" id="tr0">
                        <td>
                            <div class="form-group">
                                <input type="text" value="<?php echo $customer['customer_name']; ?>" name="customerdata['+newaddmore+'][customer_name]" class="form-control" >
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" value="<?php echo $customer['customercontact_person']; ?>" name="customerdata['+newaddmore+'][customercontact_person]" class="form-control" >
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" value="<?php echo $customer['customercontact_no']; ?>" name="customerdata['+newaddmore+'][customercontact_no]" class="form-control">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea name="customerdata['+newaddmore+'][customer_address]" required="" class="form-control"><?php echo $customer['customer_address']; ?></textarea>
                            </div>
                        </td>
                        
                        
                        <td class="text-center">
                        <button type="button" class="btn btn-danger" onclick="removeclientperson('0');"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                <?php }} ?>
                </tbody>
            </table>
            </div>
            <!-- <div class="col-xs-12 text-right">
                <label class="label-control subHeads"><a  class="addmorecontact addMore" value="0">Add More <i class="fa fa-plus"></i></a></label>
            </div> -->
        </div>
</div>

<div class="row">

            <h4 class="no-mtop mrg3">Product Details</h4>
<hr/>
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
                foreach ($vendorproduct as $product) { 
                ?>
                <tr class="main" id="tr0">
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $product['product_name']; ?>" name="productdata['+newaddmore+'][product_name]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $product['quality_certification']; ?>" name="productdata['+newaddmore+'][quality_certification]" class="form-control" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" value="<?php echo $product['product_specification']; ?>" name="productdata['+newaddmore+'][product_specification]" class="form-control">
                        </div>
                    </td>
                    
                    
                    <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="removeclientpersons('0');"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
             <?php }} ?>
            </tbody>
        </table>
        <!-- <div class="col-xs-12 text-right">
            <label class="label-control subHeads"><a  class="addmorecontact1 addMore" value="0">Add More <i class="fa fa-plus"></i></a></label>
        </div> -->
        </div>
        </div>
</div>

<h4 class="no-margin">Bank Details</h4>
                    <hr class="hr-panel-heading">

            <div class="row">
                <?php if(!empty($registeredvendor)){
                    foreach ($registeredvendor as $bank) { 
                 ?>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Name of Bank</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $bank['bank_name']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Address</label>
                <textarea name="bank_address" class="form-control"><?php echo $bank['bank_address']; ?><?php echo $bank['bank_address']; ?></textarea>
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Type of Account</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $bank['account_type']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">Account Number</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $bank['account_no']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">IFC Code</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $bank['ifc_code']; ?>">
            </div>


        </div>
        <div class="col-md-6">

            <div class="form-group" app-field-wrapper="">
                <label class="control-label">MICR Code</label>
                <input type="text" readonly="" class="form-control" value="<?php echo $bank['micr_code']; ?>">
            </div>


        </div>
        <?php }} ?>
        </div>



                        <!-- <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div> -->



                    </div>
                </div>
            </div> 
            </form>

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
