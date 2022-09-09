<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}
fieldset.for-panel {
    background-color: #fcfcfc;
	border: 1px solid #999;
	border-radius: 4px;	
	padding:15px 10px;
	background-color: #d9edf7;
    border-color: #bce8f1;
	background-color: #f9fdfd;
	margin-bottom:12px;
}
fieldset.for-panel legend {
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #4381ba;
    font-size: 14px;
    font-weight: bold;
    line-height: 10px;
    margin: inherit;
    padding: 7px;
    width: auto;
	background-color: #d9edf7;
	margin-bottom: 0;
}
fieldset.for-panel i.success {
    color: green;
    font-size: 30px;
}
fieldset.for-panel i.danger {
    color: red;
    font-size: 30px;
}
fieldset.for-panel p span.badge-success {
    color: #fff;
    background-color: #28a745;
}
</style>
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
       <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'enquirycall-approval-form', 'class' => 'enquirycall-approval-form')); ?>
       <div class="col-md-12">
           <div class="panel_s">
               <div class="panel-body">
                   <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title : ""; ?>
                       <?php
                            if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                echo '(<small class="text-danger">'.  get_employee_fullname($enquirycall_info->staff_id).'</small>)';
                            }
                        ?>    
                   </h4>
                   
                   <div class="row">
                      
                       <fieldset class="for-panel">
                           <legend>Client Info</legend>
                           <div class="col-sm-12">
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Lead Type <sapn class="pull-right">:</sapn></label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static">
                                           <?php
                                           if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                               if ($enquirycall_info->lead_type == 1) {
                                                   echo '<i class="fa fa-check-circle success"></i> Verified';
                                               } else if ($enquirycall_info->lead_type == 2) {
                                                   echo '<i class="fa fa-question danger"></i> Unverified';
                                               }
                                           }
                                           ?>
                                       </p>  
                                   </div>
                                   
                               </div>
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Company Name <sapn class="pull-right">:</sapn></label>
                                   <div class="col-sm-6">
                                       <?php
                                            if ($enquirycall_info->clientid > 0){
                                                $company_name = client_info($enquirycall_info->clientid)->client_branch_name;
                                            }else{
                                                $company_name = (!empty($enquirycall_info->company_name)) ? cc($enquirycall_info->company_name) : "--";
                                            }
                                       ?>
                                       <p class="form-control-static"><i class="fa fa-building-o" aria-hidden="true"></i> <?php echo $company_name; ?></p>               
                                   </div>
                               </div>
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Address <sapn class="pull-right">:</sapn> </label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static"><i class="fa fa-address-card"></i> <?php echo (isset($enquirycall_info)) ? $enquirycall_info->address : "--"; ?></p>
                                   </div>
                               </div>
                           </div>  

                           <div class="col-sm-12">
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Call Type <sapn class="pull-right">:</sapn> </label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static">
                                           <?php
                                           if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                               if ($enquirycall_info->call_type == 1) {
                                                   echo '<img src="' . site_url() . 'assets/images/incoming-call.png" width="30" title="Incoming"> Incoming';
                                               } else if ($enquirycall_info->call_type == 2) {
                                                   echo '<img src="' . site_url() . 'assets/images/outgoing-call.png" width="30" title="Outgoing"> Outgoing';
                                               }
                                           }
                                           ?>
                                       </p> 
                                   </div>
                               </div>
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Contact Person Name <sapn class="pull-right">:</sapn> </label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static"><i class="fa fa-user" aria-hidden="true"></i> <?php echo (isset($enquirycall_info)) ? cc($enquirycall_info->person_name) : "--"; ?></p>               
                                   </div>
                               </div>
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">State <sapn class="pull-right">:</sapn></label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static"><i class="fa fa-flag"></i> <?php echo (isset($enquirycall_info)) ? value_by_id("tblstates", $enquirycall_info->state_id, "name") : "--"; ?></p>             
                                   </div>
                               </div>
                           </div>
                           <div class="col-sm-12">
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Service Type <sapn class="pull-right">:</sapn></label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static">
                                       <?php
                                       if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                           if ($enquirycall_info->service_type == 1) {
                                               echo 'Rent';
                                           } else if ($enquirycall_info->service_type == 2) {
                                               echo 'Sales';
                                           } else if ($enquirycall_info->service_type == 3) {
                                               echo 'Both (rent & sales)';
                                           }
                                       }
                                       ?>
                                   </p> 
                                   </div>
                               </div>
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Email <sapn class="pull-right">:</sapn></label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static"><i class="fa fa-envelope"></i> <?php echo (isset($enquirycall_info)) ? $enquirycall_info->email : "--"; ?></p>
                                   </div>
                                                           
                               </div>
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">District <sapn class="pull-right">:</sapn></label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static"><i class="fa fa-building"></i> <?php echo (isset($enquirycall_info)) ? value_by_id("tblcities", $enquirycall_info->city_id, "name") : "--"; ?></p>
                                   </div>
                                           
                               </div>
                           </div>
                           <div class="col-sm-12">
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label"> Root Category <sapn class="pull-right">:</sapn></label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static"><?php 
                                       $sub_category_id = "";
                                       if (isset($enquirycall_info)) {
                                           $sub_category_id = $enquirycall_info->sub_category_id;
//                                           value_by_id("tblproductsubcategory", $enquirycall_info->sub_category_id, "name");
                                           $root_cat = $this->db->query("SELECT name FROM tblproductsubcategory WHERE id IN (".$enquirycall_info->sub_category_id.")")->result();
                                           if(!empty($root_cat)){
                                               foreach ($root_cat as $k => $value) {
                                                   $kdata = ($k != 0) ? ", ":"";
                                                   echo $kdata.cc($value->name);
                                               }
                                           }
                                           }else{ 
                                              echo "--";
                                           }
                                       ?></p>
                                   </div>
                               </div>
                               <div class="col-sm-4">
                                   <label class="col-sm-6 control-label">Contact Number <sapn class="pull-right">:</sapn> </label>
                                   <div class="col-sm-6">
                                       <p class="form-control-static"><i class="fa fa-phone"></i> <?php echo (isset($enquirycall_info) && $enquirycall_info->mobile > 0) ? $enquirycall_info->mobile : "--"; ?></p>                                                   
                                   </div>
                                   
                               </div>
                           </div>
                           <div class="col-sm-12">
                               <div class="col-sm-4">
                                   <?php
                                        if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                            if (in_array($enquirycall_info->service_type, [1, 3]) && $enquirycall_info->duration > 0) {
                                                echo '<label class="col-sm-6 control-label">Duration <sapn class="pull-right">:</sapn></label>
                                                             <div class="col-sm-6"><p class="form-control-static">' . $enquirycall_info->duration . ' Month</p></div>';
                                            }
                                        }
                                    ?>
                               </div>
                               
                               <div class="col-sm-8">
                                   <?php
                                        if (isset($enquirycall_info) && !empty($enquirycall_info->production_remark)) {
                                            echo '<label class="col-sm-3 control-label">Assign Remark <sapn class="pull-right">:</sapn></label>
                                                    <div class="col-sm-6"><p class="form-control-static">' . $enquirycall_info->production_remark . '</p></div>';
                                        }
                                    ?>
                               </div>
                           </div>
                           
                       </fieldset>
                   </div>    
                
                <div class="row">
                    <fieldset class="for-panel">
                        <legend>Enquiry Questions</legend>
                        <?php
                            $i = 1;
                            if (isset($enquirycall_info)){
                                $calldetails = $this->db->query("SELECT * from `tblenquirycall_details` WHERE `main_id` = ".$enquirycall_info->id." ORDER BY `id` DESC")->result();
                                foreach ($calldetails as $detils) {
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Question <?php echo $i++; ?> <sapn class="pull-right">:</sapn></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo value_by_id("tblquestionmaster", $detils->question_id, "question"); ?></p> 
                                </div>
                                <label class="col-sm-2 control-label">Answer <sapn class="pull-right">:</sapn></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php echo $detils->answer; ?></p> 
                                </div>
                                
                            </div>
                        </div>
                        <?php   }
                            } 
                        ?>
                    </fieldset>
                </div>
                   <?php 
                    if(!empty($info) && ($info->approve_status == 0) && ($check_approval->count == 0)){
                       ?>
                       <div class="btn-bottom-toolbar bottom-transaction text-right">
                          
                           <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                Submit
                            </button>
                        </div> 
                       <?php 
                    }
                    ?>
            </div>
         </div>
      </div>
        
       <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    
                    <div class="col-md-12">
                        <h3>Product Enquiry Details</h3>
                        <hr>
                        
                        <div class="row pro_enq_details">
                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
                                    <thead>
                                        <tr>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                            <th width="30%" align="left"><?php echo _l('product_name'); ?></th>
                                            <th width="10%" align="left"><?php echo _l('quantity_as_qty'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        $i = 0;
                                        if (isset($enquirycall_info) && (!empty($enquirycall_info->product_json))) {
                                            $decode_data = json_decode($enquirycall_info->product_json);
                                            foreach ($decode_data as $pdata) {
                                                $pd_id = $pdata->product_id . "-" . $pdata->is_temp;
                                                echo '<tr class="main" id="tre' . $i . '"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct(' . $i . ');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><div class="product_list1"><select class="form-control product_list selectpicker" data-live-search="true" id="product_id' . $i . '" name="proenqdata[' . $i . '][product_id]"><option value=""></option>';
                                                foreach ($product_data as $prod_list) {
                                                    if ($prod_list['id'] == $pd_id) {
                                                        echo '<option value="' . $prod_list['id'] . '" selected="selected">' . $prod_list['name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $prod_list['id'] . '">' . $prod_list['name'] . '</option>';
                                                    }
                                                }
                                                echo '</select></div></div></td><td><div class="form-group"><input type="number" id="qty" value="' . $pdata->qty . '" name="proenqdata[' . $i . '][qty]" class="form-control"></div></td></tr>';
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo $i; ?>"><?php echo _l('add_more_product'); ?> <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>							
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <br><br>
                            <label class="col-md-2 control-label">Upload Drawings <sapn class="pull-right">:</sapn></label>
                            <div class="col-md-6">
                                <input type="file" id="drawing" name="drawing[]" multiple="" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="6"><?php if(!empty($info)){ echo $info->approvereason; } ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    $(document).on("click", ".addmoreproenq",function(){
        var sub_category_id = "<?php echo $sub_category_id; ?>";
        
        var numbersArray = sub_category_id.split(',');
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);
        
        var url = "<?php echo admin_url("enquirycall/get_products_list")?>";
        $.post(url, {"sub_category_id": numbersArray}, function(data){
                $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><div class="product_list1"><select class="form-control product_list selectpicker" data-live-search="true" id="product_id'+newaddmoreproenq+'" name="proenqdata['+newaddmoreproenq+'][product_id]"><option value=""></option>'+data+'</select></div></div></td><td><div class="form-group"><input type="number" id="qty" name="proenqdata['+newaddmoreproenq+'][qty]" class="form-control"></div></td></tr>');
                $('.selectpicker').selectpicker('refresh');
            });
    });
   
    function removeproduct(proid)
    {
        $('#tre' + proid).remove();
    }
</script>
</body>
</html>
