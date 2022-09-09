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
                                        <h3 class="text-info text-center">
                                            <?php
                                                if($request_info->type == '1'){
                                                    echo 'IN-WARDING INSPECTION REPORT';
                                                }else{
                                                    echo 'FINAL INSPECTION REPORT';
                                                }
                                            ?>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">    
                                        <div class="col-md-3">  
                                            <label for="requested_id" class="control-label"><u class="text-danger">Requested ID : </u></label>
                                            <div class="form-group">
                                                <?php echo "INSP-".str_pad($request_info->id, 4, '0', STR_PAD_LEFT);?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <label for="product_name" class="control-label"><u class="text-danger">Product :</u></label>
                                            <div class="form-group">
                                                <?php echo value_by_id("tblproducts", $request_info->product_id, "sub_name");?>
                                            </div>
                                        </div>
                                        <?php if ($request_info->type == "1"){ 
                                            $vendorid = value_by_id("tblmaterialreceipt", $request_info->rel_id, "vendor_id");
                                        ?>
                                            <div class="col-md-3">  
                                                <label for="customer_name" class="control-label"><u class="text-danger">Customer Name :</u></label>
                                                <div class="form-group">
                                                    <?php echo value_by_id("tblvendor", $vendorid, "name");?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="mr_number" class="control-label"><u class="text-danger">MR NO.</u></label>  
                                                <div class="form-group">
                                                    <?php echo value_by_id("tblmaterialreceipt", $request_info->rel_id, "numer");?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="requested_id" class="control-label"><u class="text-danger">Date Of Inspection :</u></label>
                                                <div class="input-group date">
                                                <?php echo (!empty($request_info->inspection_date)) ? _d($request_info->inspection_date) : date("d/m/Y"); ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">  
                                            <label for="total_received_qty" class="control-label"><u class="text-danger">Total Received Qty :</u></label>
                                            <div class="form-group">
                                                <?php echo $request_info->quantity; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <label for="total_accepted_qty" class="control-label"><u class="text-danger">Total Accepted Qty : </u></label>
                                            <div class="form-group">
                                                <?php echo ($request_info->total_accepted_qty > 0) ? $request_info->total_accepted_qty : '0.00';?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="total_rejected_qty" class="control-label"><u class="text-danger">Total Rejected Qty :</u></label>  
                                            <div class="form-group">
                                                <?php echo ($request_info->total_rejected_qty > 0) ? $request_info->total_rejected_qty : '0.00';?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inspection_by" class="control-label"><u class="text-danger">Inspection By :</u></label>  
                                            <div class="form-group">
                                                <?php echo ($request_info->inspection_by > 0) ? get_employee_fullname($request_info->inspection_by) : '0.00';?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <label for="remark" class="control-label"><u class="text-danger">Remark : </u></label>
                                            <div class="form-group">
                                                <?php echo (!empty($request_info->remark)) ? cc($request_info->remark) : '--'; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <label for="remark" class="control-label"><u class="text-danger">Attach Image / Reports</u></label>
                                            <div class="form-group">
                                                <?php 
                                                    $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'quality_report' and rel_id = '".$request_info->id."' ")->result();
                                                    if(!empty($file_info)){
                                                        foreach ($file_info as $key => $file) {
                                                ?>
                                                            <?php echo 1+$key.') '; ?><a target="_blank" href="<?php echo base_url('uploads/inspection/quality_report/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
                                                <?php            
                                                        }
                                                    }
                                                ?>
                                            </div>
                                                
                                        </div>
                                        <div class="col-md-4">  
                                            <label for="remark" class="control-label"><u class="text-danger">Attach Supplier Material Test Certificates</u></label>
                                            <div class="form-group">
                                                <?php
                                                    $certificatefile_info = $this->db->query("SELECT * from tblfiles where rel_type = 'test_certificate' and rel_id = '".$request_info->id."' ")->result();
                                                    if(!empty($certificatefile_info)){
                                                        foreach ($certificatefile_info as $key => $file) {
                                                ?>
                                                            <?php echo 1+$key.') '; ?><a target="_blank" href="<?php echo base_url('uploads/inspection/test_certificate/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
                                                <?php            
                                                        }
                                                    }
                                                ?>
                                            </div>
                                                
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
                                                        $inspection_masterdata = $this->db->query("SELECT * FROM `tblproductinspection_details` WHERE `insp_id`='".$request_info->id."' ")->result();
                                                        if ($inspection_masterdata){
                                                            foreach ($inspection_masterdata as $details) {
                                                                $tolerance_min = ($details->tolerance_min > 0) ? $details->tolerance_min : 'Nil'; 
                                                                $tolerance_max = ($details->tolerance_max > 0) ? $details->tolerance_max : 'Nil'; 
                                                                echo '<tr>
                                                                            <td class="desc">'.$i++.'</td>
                                                                            <td class="desc"><p>'.cc($details->parameter).'</p></td>
                                                                            <td class="desc">'.$details->specification.'</td>
                                                                            <td class="desc">'.$tolerance_min.'</td>
                                                                            <td class="desc">'.$tolerance_max.'</td>
                                                                            <td class="desc">'.$details->measuring_instrument.'</td>
                                                                            <td class="desc">'.$details->observed_reading_1.'</td>
                                                                            <td class="desc">'.$details->observed_reading_2.'</td>
                                                                            <td class="desc">'.$details->observed_reading_3.'</td>
                                                                            <td class="desc">'.$details->observed_reading_4.'</td>
                                                                            <td class="desc">'.$details->observed_reading_5.'</td>
                                                                            <td class="desc">'.$details->remark.'</td>
                                                                        </tr>';
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>        
                                    </div>
                                     
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <label for="remark" class="control-label">Approval Remark</label>
                                        <textarea name="approval_remark" class="form-control" id="approval_remark" cols="20" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <br>
                                    <div class="btn-bottom-toolbar text-right">
                                        <input type="hidden" name="inspection_id" value="<?php echo $request_info->id; ?>">
                                        <button class="btn btn-warning" name="action" style="background-color: #e8bb0b;" value="5" type="submit">On Hold</button>
                                        <button class="btn btn-danger" name="action" style="background-color: #800000;" value="4" type="submit">Recalculation</button>
                                        <button class="btn btn-danger" name="action" value="2" type="submit">Reject</button>
                                        <button class="btn btn-success" name="action" value="1" type="submit">Approve</button>
                                        <!-- <a href="javascript:void(0);" class="btn btn-info submit-btn" >Save</a> -->
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

