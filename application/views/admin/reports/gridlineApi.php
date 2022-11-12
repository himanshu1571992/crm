<?php init_head(); ?>

<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

.panel_s .panel-body .panel-title {
    color: #8b8b8b;
}

</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?> </h4>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="col-md-12">
                            <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="vendor" class="control-label">Verification For</label>
                                        <select class="form-control selectpicker" name="type" id="type" data-live-search="true">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($type) && $type == 1) ? 'selected':''; ?>>Aadhaar Verification</option>
                                            <!-- <option value="2" <?php echo (isset($type) && $type == 2) ? 'selected':''; ?>>Aadhaar Details</option> -->
                                            <option value="3" <?php echo (isset($type) && $type == 3) ? 'selected':''; ?>>PAN Details</option>
                                            <option value="4" <?php echo (isset($type) && $type == 4) ? 'selected':''; ?>>Driving Licence Details</option>
                                            <option value="5" <?php echo (isset($type) && $type == 5) ? 'selected':''; ?>>Voter ID Details</option>
                                            <option value="6" <?php echo (isset($type) && $type == 6) ? 'selected':''; ?>>Bank Account Verification</option>
                                            <option value="7" <?php echo (isset($type) && $type == 7) ? 'selected':''; ?>>Vehicle RC Details</option>
                                            <option value="8" <?php echo (isset($type) && $type == 8) ? 'selected':''; ?>>Fetch UAN</option>
                                            <option value="9" <?php echo (isset($type) && $type == 9) ? 'selected':''; ?>>GST Details</option>
                                            <!-- <option value="9" <?php echo (isset($type) && $type == 8) ? 'selected':''; ?>>Passport Details</option>
                                            <option value="10" <?php echo (isset($type) && $type == 10) ? 'selected':''; ?>>Fetch EPFO Passbook</option> -->
                                        </select>
                                    </div>
                                    <div id="formFields_div">
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                        <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                        </div>

						 <!-- <div class="btn-bottom-toolbar text-right">
								<button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo _l('submit'); ?>
								</button>
							</div> -->

                    </div>
                </div>
                <?php if (!empty($response) && $response["status"] == 1){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel_s">
                                <div class="panel-body ">
                                    <div class="row">
                                        <?php 
                                            if (!empty($response) && $response["status"] == 1){
                                                if (isset($type) && $type == 3){
                                        ?>
                                            <div class="col-md-12">
                                                <div class="panel_s ">
                                                    <div class="panel-body" style="background-color: #e8eaee;">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center"><h4><u>PAN CARD DETAILS</u> </h4></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="table-responsive"> 
                                                                    <table class="table" id="newtable">
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">Name : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["name"]); ?></span></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">Number : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["document_id"]); ?></span></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">Phone : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["phone"]); ?></span></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">Gender : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["gender"]); ?></span></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">DOB : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["date_of_birth"]); ?></span></h4></td>
                                                                        </tr>
                                                                    </table>    
                                                                </div>    
                                                            </div>  
                                                            <div class="col-md-6">
                                                                <div class="table-responsive"> 
                                                                    <table class="table" id="newtable">
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">Address : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["address"]); ?></span></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">City : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["city"]); ?></span></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">State : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["state"]); ?></span></h4></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-md-4"><h4 class="panel-title">Pincode : </h4></td>
                                                                            <td><h4><span><?php echo cc($response["pincode"]); ?></span></h4></td>
                                                                        </tr>
                                                                    </table>    
                                                                </div>    
                                                            </div>  
                                                        </div>
                                                    </div>    
                                                </div> 
                                            </div> 
                                            <?php 
                                                    }else if (isset($type) && $type == 4){
                                            ?>
                                            <div class="col-md-12">
                                                <div class="panel_s">
                                                    <div class="panel-body" style="background-color: #e8eaee;">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center"><h4><u>DRIVING LICENSE DETAILS</u> </h4></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <br>
                                                                <br>
                                                                <div class="col-md-12">
                                                                    <img style="border: 5px #8b8b8b solid;" src="data:image/png;base64,<?php echo $response["photo_base64"]; ?>" width="150" height="150" alt="driving license" />
                                                                </div>    
                                                            </div>    
                                                            <div class="col-md-5">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-6"><h4 class="panel-title">Name : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["name"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-6"><h4 class="panel-title">Dependent Name : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["dependent_name"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">Number : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["document_id"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">DOB : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["date_of_birth"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">Address : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["address"]); ?></span></h4></td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            <div class="col-md-5">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">Expiry Date : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["expiry_date"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">RTO State : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["rto_state"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">RTO Authority : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["rto_authority"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">Vehicle Category : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["vehicle_category"]); ?></span></h4></td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>    
                                                </div> 
                                            </div>    
                                            <?php 
                                                    }else if (isset($type) && $type == 5){
                                            ?>
                                                <div class="col-md-12">
                                                    <div class="panel_s">
                                                        <div class="panel-body" style="background-color: #e8eaee;">
                                                            <div class="row">
                                                                <div class="col-md-12 text-center"><h4><u>VOTER ID DETAILS</u> </h4></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="table-responsive"> 
                                                                        <table class="table" id="newtable">
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">Name : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["name"]); ?></span></h4></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">Father Name : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["father_name"]); ?></span></h4></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">Gender : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["gender"]); ?></span></h4></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">Age : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["age"]); ?></span></h4></td>
                                                                            </tr>
                                                                        </table>    
                                                                    </div>    
                                                                </div>  
                                                                <div class="col-md-6">
                                                                    <div class="table-responsive"> 
                                                                        <table class="table" id="newtable">
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">Assembly Name : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["assembly_name"]); ?></span></h4></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">Polling Station : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["polling_station"]); ?></span></h4></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">District : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["district"]); ?></span></h4></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-md-4"><h4 class="panel-title">State : </h4></td>
                                                                                <td><h4><span><?php echo cc($response["state"]); ?></span></h4></td>
                                                                            </tr>
                                                                        </table>    
                                                                    </div>    
                                                                </div>  
                                                            </div>
                                                        </div>    
                                                    </div> 
                                                </div> 
                                            <?php
                                                    }else if (isset($type) && $type == 6){
                                            ?>
                                                    <div class="col-md-12">
                                                        <div class="panel_s">
                                                            <div class="panel-body" style="background-color:#e8eaee;">
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center"><h4><u>BANK ACCOUNT DETAILS</u> </h4></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">Name : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["name"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">Bank Name : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["bank_name"]); ?></span></h4></td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>    
                                                                    </div>  
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">Branch : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["branch"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-4"><h4 class="panel-title">City : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["city"]); ?></span></h4></td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>    
                                                                    </div>  
                                                                </div>
                                                            </div>    
                                                        </div> 
                                                    </div> 
                                            <?php
                                                    }else if (isset($type) && $type == 7){
                                            ?>
                                                    <div class="col-md-12">
                                                        <div class="panel_s">
                                                            <div class="panel-body" style="background-color:#e8eaee;">
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center"><h4><u> VEHICLE RC DETAILS</u> </h4></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Name : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["name"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Address : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["address"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Issue Date : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["issue_date"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Registered At : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["registered_at"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-6"><h4 class="panel-title">Insurance Policy Number : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["insurance_policy_number"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Insurance Company : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["insurance_company"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Insurance Expiry Date : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["insurance_expiry_date"]); ?></span></h4></td>
                                                                                </tr>
                                                                                
                                                                            </table>    
                                                                        </div>    
                                                                    </div>  
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-6"><h4 class="panel-title">Vehicle Manufactured Date : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["vehicle_manufactured_date"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Vehicle Category : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["vehicle_category"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Chassis Number : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["chassis_number"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Engine Number : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["engine_number"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Model : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["model"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Fuel Type : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["fuel_type"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Color : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["color"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Seating Capacity : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["seating_capacity"]); ?></span></h4></td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>    
                                                                    </div>  
                                                                </div>
                                                            </div>    
                                                        </div> 
                                                    </div> 
                                            <?php
                                                        }else if (isset($type) && $type == 8){
                                            ?>
                                                    <div class="col-md-6">
                                                        <div class="panel_s">
                                                            <div class="panel-body" style="background-color:#e8eaee;">
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center"><h4><u> UAN NUMBERS DETAILS</u> </h4></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">UAN : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["uan_numbers"]); ?></span></h4></td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>    
                                                                    </div>  
                                                                </div>
                                                            </div>    
                                                        </div> 
                                                    </div> 
                                            <?php
                                                    }else if (isset($type) && $type == 9){
                                            ?>
                                                    <div class="col-md-12">
                                                        <div class="panel_s">
                                                            <div class="panel-body" style="background-color:#e8eaee;">
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center"><h4><u> GST DETAILS</u> </h4></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive"> 
                                                                            <table class="table" id="newtable">
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Directors : </h4></td>
                                                                                    <td><h4><span style="color:#545556;"><?php echo cc($response["directors"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title">Legal Name : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["legal_name"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> Trade Name : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["trade_name"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> GST Number : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["gst_number"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> PAN Number : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["pan_number"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> Center Jurisdiction : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["center_jurisdiction"]); ?></span></h4></td>
                                                                                </tr>
                                                                                
                                                                            </table>    
                                                                        </div>    
                                                                    </div>  
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive">
                                                                            <table class="table" id="newtable"> 
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> State Jurisdiction : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["state_jurisdiction"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> Registration Date : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["registration_date"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> Address : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["address"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> Email : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["email"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> Mobile : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["mobile"]); ?></span></h4></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="col-md-5"><h4 class="panel-title"> Nature Of Business : </h4></td>
                                                                                    <td><h4><span><?php echo cc($response["nature_of_business"]); ?></span></h4></td>
                                                                                </tr>
                                                                            </table>    
                                                                        </div>    
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </div> 
                                                        <?php 
                                                            if (!empty($response["filing_data"])){
                                                                foreach ($response["filing_data"] as $key => $value) {
                                                        ?>
                                                                    <div class="col-lg-3">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title"><h4>Filling Data <?php echo ++$key; ?></h4></h5>
                                                                                <ul class="list-group">
                                                                                    <li class="list-group-item">Return Type :<span class="pull-right"><?php echo cc($value->return_type); ?></span></li>
                                                                                    <li class="list-group-item">Financial Year :<span class="pull-right"><?php echo cc($value->financial_year); ?></span></li>
                                                                                    <li class="list-group-item">Tax Period :<span class="pull-right"><?php echo cc($value->tax_period); ?></span></li>
                                                                                    <li class="list-group-item">Date Of Filling :<span class="pull-right"><?php echo _d($value->date_of_filing); ?></span></li>
                                                                                    <li class="list-group-item">Mode Of Filling :<span class="pull-right"><?php echo cc($value->mode_of_filing); ?></span></li>
                                                                                    <li class="list-group-item">Status :<span class="pull-right"><?php echo cc($value->status); ?></span></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        <?php            
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </div> 
                                            <?php            
                                                    }
                                                }
                                            ?>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>    
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<div id="vehicleDetails" class="modal fade" role="dialog">
    <div class="modal-dialog">

        Vehicle Details
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vehicle Details</h4>
            </div>
            <div class="modal-body" id="vehicle_details_div">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<?php init_tail(); ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
     <script type="text/javascript" src="http://cdn.rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js"></script>

<script>

$(document).ready(function() {
    var type = "<?php echo (isset($type)) ? $type : 0; ?>";
    var response_message = "<?php echo (!empty($response) && $response["status"] == 2) ? $response["message"] : ''; ?>";
    if (type == 1){
        var status = "<?php echo (isset($response["status"])) ? $response["status"] : 0; ?>";
        var message = "<?php echo (isset($response["message"])) ? $response["message"] : 0; ?>";
        var number = "<?php echo (isset($number)) ? $number : 0; ?>";
        if (status == 1){
            swal(message, number, "success");
        }else{
            swal(message, "", "warning");
        }
    }
    if (response_message != ''){
        var number = "<?php echo (isset($number)) ? $number : 0; ?>";
        swal(response_message, number, "warning");
    }
} );
</script>


<script type="text/javascript">
    $(document).ready(function(){
        var type_id = $("#type").val();
        if (type_id){
            var number = "<?php echo (isset($number)) ? $number : 0; ?>";
            var dob = "<?php echo (!empty($dob)) ? $dob : ''; ?>";
            var ifsc_code = "<?php echo (!empty($ifsc_code)) ? $ifsc_code : ''; ?>";

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/reports/getVerificationFormFields'); ?>",
                data: {'type_id': type_id, 'number': number, 'dob': dob, 'ifsc_code': ifsc_code},
                success: function (response) {
                    if (response != '') {
                        $("#formFields_div").html(response);
                    }
                }
            })
        }
        
    });
    $('#type').change(function () {
        var type_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/reports/getVerificationFormFields'); ?>",
            data: {'type_id': type_id},
            success: function (response) {
                if (response != '') {
                    $("#formFields_div").html(response);
                }
            }
        })
    });
</script>
</body>
</html>
