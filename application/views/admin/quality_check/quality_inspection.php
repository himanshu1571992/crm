<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'inspection_form', 'name'=>'inspectionfrm', 'class' => 'proposal-form', 'onsubmit'=>"return checkform()")); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?></h4>
                            <hr class="hr-panel-heading">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">    
                                        <div class="col-md-3">  
                                            <label for="requested_id" class="control-label"><u>Requested ID : </u></label>
                                            <div class="form-group">
                                                <?php echo "INSP-".str_pad($request_info->id, 4, '0', STR_PAD_LEFT);?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <label for="product_name" class="control-label"><u>Product :</u></label>
                                            <div class="form-group">
                                                <?php echo value_by_id("tblproducts", $request_info->product_id, "sub_name");?>
                                            </div>
                                        </div>
                                        <?php if ($request_info->type == "1"){ 
                                            $vendorid = value_by_id("tblmaterialreceipt", $request_info->rel_id, "vendor_id");
                                        ?>
                                            <div class="col-md-3">  
                                                <label for="customer_name" class="control-label"><u>Customer Name :</u></label>
                                                <div class="form-group">
                                                    <?php echo cc(value_by_id("tblvendor", $vendorid, "name")); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="mr_number" class="control-label"><u>MR NO.</u></label>  
                                                <div class="form-group">
                                                    <?php echo value_by_id("tblmaterialreceipt", $request_info->rel_id, "numer");?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="requested_id" class="control-label">Date Of Inspection</label>
                                                <div class="input-group date">
                                                    <input id="inspectiondate" name="inspection_date" required='' class="form-control datepicker" value="<?php echo (!empty($request_info->inspection_date)) ? _d($request_info->inspection_date) : date("d/m/Y"); ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="total_received_qty" class="control-label">Total Received Qty</label>
                                                <input type="number" class="form-control" min="0" id="total_received_qty" name="total_received_qty" value="<?php echo $request_info->quantity; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="total_accepted_qty" class="control-label">Total Accepted Qty</label>
                                                <input type="number" class="form-control" min="0" id="total_accepted_qty" name="total_accepted_qty" step=".01" value="<?php echo ($request_info->total_accepted_qty > 0) ? $request_info->total_accepted_qty : '';?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="total_rejected_qty" class="control-label">Total Rejected Qty</label>
                                                <input type="number" class="form-control" id="total_rejected_qty" name="total_rejected_qty" step=".01" value="<?php echo ($request_info->total_rejected_qty > 0) ? $request_info->total_rejected_qty : '';?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom:2%;">
                                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                            <select onchange="staffdropdown()" required="required" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">
                                                <?php
                                                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                ?>
                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                            <?php
                                                                foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                            ?>
                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php echo (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) ? 'selected' : '';?>><?php echo $singstaff['firstname'] ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                <?php   }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">  
                                            <div class="form-group">
                                                <label for="remark" class="control-label">Remark</label>
                                                <textarea name="remark" class="form-control" id="remark" cols="20" rows="2" required><?php echo (!empty($request_info->remark)) ? $request_info->remark : ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <?php 
                                                    $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'quality_report' and rel_id = '".$request_info->id."' ")->result();
                                                ?>
                                                <label for="remark" class="control-label">Attach Image / Reports</label>
                                                <input type="file" name="quality_report[]" class="form-control" multiple <?php echo (!empty($file_info)) ? : 'required'; ?>>
                                            </div>
                                                <?php 
                                                    if(!empty($file_info)){
                                                        foreach ($file_info as $key => $file) {
                                                ?>
                                                            <?php echo 1+$key.') '; ?><a target="_blank" href="<?php echo base_url('uploads/inspection/quality_report/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a>
                                                <?php            
                                                        }
                                                    }
                                                ?>
                                        </div>
                                        <div class="col-md-3">  
                                            <?php 
                                                $certificatefile_info = $this->db->query("SELECT * from tblfiles where rel_type = 'test_certificate' and rel_id = '".$request_info->id."' ")->result();
                                            ?>
                                            <div class="form-group">
                                                <label for="remark" class="control-label">Attach Supplier Material Test Certificates</label>
                                                <input type="file" name="test_certificate[]" class="form-control" multiple <?php echo (!empty($certificatefile_info)) ? : 'required'; ?>>
                                            </div>
                                                <?php
                                                    if(!empty($certificatefile_info)){
                                                        foreach ($certificatefile_info as $key => $file) {
                                                ?>
                                                            <?php echo 1+$key.') '; ?><a target="_blank" href="<?php echo base_url('uploads/inspection/test_certificate/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a>
                                                <?php            
                                                        }
                                                    }
                                                ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="table-responsive">  
                                            <table class="table" id="inwardingtable1">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">S.No</th>
                                                        <th rowspan="2" align="center">Parameter</th>
                                                        <th rowspan="2" align="center">Specification</th>
                                                        <th rowspan="2" align="center">Tolerance Min</th>
                                                        <th rowspan="2" align="center">Tolerance Max</th>
                                                        <th rowspan="2" align="center">Measuring Instrument</th>
                                                        <th rowspan="2" align="center">Remarks</th>
                                                        <th colspan="5" align="center">Observed Readings</th>
                                                    </tr>
                                                    <tr>
                                                        <th align="center">1</th>
                                                        <th align="center">2</th>
                                                        <th align="center">3</th>
                                                        <th align="center">4</th>
                                                        <th align="center">5</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $i=1;
                                                        $inspection_parameterdata = $this->db->query("SELECT * FROM `tblproductinspection_details` WHERE `insp_id`='".$request_info->id."' ")->result();
                                                        if (empty($inspection_parameterdata)){
                                                            $inspection_parameterdata = $this->db->query("SELECT * FROM `tblproductinspection_master` WHERE `product_id`='".$request_info->product_id."' ")->result();
                                                        }
                                                        
                                                        if ($inspection_parameterdata){
                                                            foreach ($inspection_parameterdata as $value) {
                                                                
                                                                $inspectionremark = (!empty($value->remark)) ? $value->remark : '';
                                                                $observed_reading_1 = (!empty($value->observed_reading_1)) ? $value->observed_reading_1 : '';
                                                                $observed_reading_2 = (!empty($value->observed_reading_2)) ? $value->observed_reading_2 : '';
                                                                $observed_reading_3 = (!empty($value->observed_reading_3)) ? $value->observed_reading_3 : '';
                                                                $observed_reading_4 = (!empty($value->observed_reading_4)) ? $value->observed_reading_4 : '';
                                                                $observed_reading_5 = (!empty($value->observed_reading_5)) ? $value->observed_reading_5 : '';
                                                                $tolerance_min = ($value->tolerance_min > 0) ? $value->tolerance_min : 'Nil'; 
                                                                $tolerance_max = ($value->tolerance_max > 0) ? $value->tolerance_max : 'Nil'; 
                                                                echo "<tr>
                                                                        <td>".$i++."</td>
                                                                        <td>".$value->parameter."</td>
                                                                        <td>".$value->specification."</td>
                                                                        <td>".$tolerance_min."</td>
                                                                        <td>".$tolerance_max."</td>
                                                                        <td>".$value->measuring_instrument."</td>
                                                                        <td><textarea name='inspectiondata[".$i."][remark]' class='form-control' id='remark' cols='20' rows='5' required>".$inspectionremark."</textarea></td>
                                                                        <td>
                                                                            <input type='hidden' class='form-control' name='inspectiondata[".$i."][inspection_mst_id]' value='".$value->id."'>
                                                                            <input type='hidden' class='form-control' name='inspectiondata[".$i."][parameter]' value='".$value->parameter."'>
                                                                            <input type='hidden' class='form-control' name='inspectiondata[".$i."][specification]' value='".$value->specification."'>
                                                                            <input type='hidden' class='form-control' name='inspectiondata[".$i."][tolerance_min]' value='".$value->tolerance_min."'>
                                                                            <input type='hidden' class='form-control' name='inspectiondata[".$i."][tolerance_max]' value='".$value->tolerance_max."'>
                                                                            <input type='hidden' class='form-control' name='inspectiondata[".$i."][measuring_instrument]' value='".$value->measuring_instrument."'>
                                                                            <input type='text'   onblur='check_observe_reading(".$value->tolerance_min.",".$value->tolerance_max.",1".$i.")' class='form-control reading1".$i."' name='inspectiondata[".$i."][observed_reading_1]' value='".$observed_reading_1."'>
                                                                        </td>
                                                                        <td><input type='text' onblur='check_observe_reading(".$value->tolerance_min.",".$value->tolerance_max.",2".$i.")' class='form-control reading2".$i."' name='inspectiondata[".$i."][observed_reading_2]' value='".$observed_reading_2."'></td>
                                                                        <td><input type='text' onblur='check_observe_reading(".$value->tolerance_min.",".$value->tolerance_max.",3".$i.")' class='form-control reading3".$i."' name='inspectiondata[".$i."][observed_reading_3]' value='".$observed_reading_3."'></td>
                                                                        <td><input type='text' onblur='check_observe_reading(".$value->tolerance_min.",".$value->tolerance_max.",4".$i.")' class='form-control reading4".$i."' name='inspectiondata[".$i."][observed_reading_4]' value='".$observed_reading_4."'></td>
                                                                        <td><input type='text' onblur='check_observe_reading(".$value->tolerance_min.",".$value->tolerance_max.",5".$i.")' class='form-control reading5".$i."' name='inspectiondata[".$i."][observed_reading_5]' value='".$observed_reading_5."'></td>
                                                                    </tr>";
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-bottom-toolbar text-right">
                                            <input type="hidden" name="inspection_id" value="<?php echo $request_info->id; ?>">
                                            <button class="btn btn-info" type="submit">
                                                <?php echo _l('submit'); ?>
                                            </button>
                                            <!-- <a href="javascript:void(0);" class="btn btn-info submit-btn" >Save</a> -->
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div> 
                    </div>  
                </div>        
            <?php echo form_close(); ?>
        <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
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


<script>

    function checkform(evt)    {     
        
        var ttlreceived_qty = document.getElementById("total_received_qty").value;
        var ttlaccepted_qty = document.getElementById("total_accepted_qty").value;
        var ttlrejected_qty = document.getElementById("total_rejected_qty").value;
        var ttlqty = parseFloat(ttlaccepted_qty) + parseFloat(ttlrejected_qty);
        var condition = true;
        if (ttlqty != ttlreceived_qty){
            alert("Total Accepted Qty and Rejected Qty equals to Total Received Qty."); 
            condition = false;
            return false;
        }
        if(condition){
            condition =  confirm('Do you want to submit the form?');
            return true;
        }
    }
    /* this function use for check observe reading with tolerance */
    function check_observe_reading(min, max, rowid){
        var readingval = $(".reading"+rowid).val();
        if (readingval != ''){
            if (min > readingval || max < readingval){
                alert("Reading is out of tolerance range");
                $(".reading"+rowid).val('');
            }
        }
    }
    function staffdropdown()
    {
        $.each($("#assign option:selected"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().attr('selected', 'selected');
        });
        $('.selectpicker').selectpicker('refresh');
        $.each($("#assign option:not(:selected)"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().removeAttr('selected');
        });
        $('.selectpicker').selectpicker('refresh');
    }
</script>


</body>
</html>

