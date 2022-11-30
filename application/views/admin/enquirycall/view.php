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
       <div class="col-md-12">
           <div class="panel_s">
               <div class="panel-body">
                   <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title : ""; ?></h4>
                   <div class="row">
                       <fieldset class="for-panel">
                           <legend>Client Info</legend>
                           <div class="col-sm-12">
                               <table class="col-md-4">
                                   <tr>
                                       <td class="col-sm-6"><label class=" control-label" style="color:red;">Lead Type <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success">
                                           <?php
                                           if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                               if ($enquirycall_info->lead_type == 1) {
                                                   echo '<i class="fa fa-check-circle success"></i> Verified';
                                               } else if ($enquirycall_info->lead_type == 2) {
                                                   echo '<i class="fa fa-question danger"></i> Unverified';
                                               }
                                           }
                                           ?>
                                       </p></td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Lead Category <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success">
                                           <?php
                                           if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                               echo ($enquirycall_info->lead_category_id > 0) ? cc(value_by_id("tblleadcategorymaster", $enquirycall_info->lead_category_id, "title")) : "--";
                                           }
                                           ?>
                                       </p> </td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Company Name <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6"><?php
                                        if ($enquirycall_info->clientid > 0){
                                            $company_name = client_info($enquirycall_info->clientid)->client_branch_name;
                                        }else{
                                            $company_name = (!empty($enquirycall_info->company_name)) ? cc($enquirycall_info->company_name) : "--";
                                        }
                                       ?>
                                       <p class="form-control-static text-success"><i class="fa fa-building-o" aria-hidden="true"></i> <?php echo $company_name; ?></p> 
                                       </td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;"> Root Category <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6">
                                           <p class="form-control-static text-success"><?php
                                               if (isset($enquirycall_info)) {

                                                    $show_temp_product = 0;
                                                    $sub_category_arr = explode(',', $enquirycall_info->sub_category_id);
                                                    if (in_array('Temp1', $sub_category_arr)){
                                                        $show_temp_product = 1;
                                                        $sub_category_arr = array_diff($sub_category_arr, array('Temp1'));
                                                    }
                                                    $sub_category_ids = implode(',', $sub_category_arr);
//                                                  value_by_id("tblproductsubcategory", $enquirycall_info->sub_category_id, "name");
                                                    $pro_k = 0;
                                                    if (!empty($sub_category_arr)){
                                                        $root_cat = $this->db->query("SELECT name FROM tblproductsubcategory WHERE id IN (" . $sub_category_ids . ")")->result();
                                                        
                                                        if (!empty($root_cat)) {
                                                            foreach ($root_cat as $k => $value) {
                                                                $pro_k++;
                                                                $kdata = ($k != 0) ? ", " : "";
                                                                echo $kdata . cc($value->name);
                                                            }
                                                        }
                                                    }
                                                    
                                                    if ($show_temp_product == 1){
                                                        echo ($pro_k > 0) ? ', Temporary products': 'Temporary products';
                                                    }
                                               } else {
                                                   echo "--";
                                               }
                                               ?>
                                           </p>
                                       </td>
                                       
                                   </tr>
                                   <tr>
                                        <td class="col-sm-6"><label class="control-label" style="color:red;"> Remark <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                        <td class="col-sm-6">
                                            <p class="form-control-static text-success"><?php echo (!empty($enquirycall_info->remark)) ? $enquirycall_info->remark :''; ?></p> 
                                        </td>
                                   </tr>
                                   <?php
                                        if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                            if (in_array($enquirycall_info->service_type, [1, 3]) && $enquirycall_info->duration > 0) {
                                                echo '<tr><td class="col-sm-6"><label class="control-label" style="color:red;">Duration <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                                             <td class="col-sm-6"><p class="form-control-static text-success">' . $enquirycall_info->duration . ' Month</p></td></tr>';
                                            }
                                        }
                                    ?>
                               </table>
                               <table class="col-md-4">
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Call Type <sapn class="pull-right">&nbsp;&nbsp;:</sapn> </label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success">
                                           <?php
                                           if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                                               if ($enquirycall_info->call_type == 1) {
                                                   echo '<img src="' . site_url() . 'assets/images/incoming-call.png" width="30" title="Incoming"> Incoming';
                                               } else if ($enquirycall_info->call_type == 2) {
                                                   echo '<img src="' . site_url() . 'assets/images/outgoing-call.png" width="30" title="Outgoing"> Outgoing';
                                               } else if ($enquirycall_info->call_type == 3) {
                                                   echo ' App Lead';
                                               }else if ($enquirycall_info->call_type == 4) {
                                                    echo ' India Mart Lead';
                                                }
                                           }
                                           ?>
                                       </p> </td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Contact Person Name <sapn class="pull-right">&nbsp;&nbsp;:</sapn> </label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success"><i class="fa fa-user" aria-hidden="true"></i> <?php echo (isset($enquirycall_info)) ? cc($enquirycall_info->person_name) : "--"; ?></p></td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">State <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success"><i class="fa fa-flag"></i> <?php echo (isset($enquirycall_info)) ? value_by_id("tblstates", $enquirycall_info->state_id, "name") : "--"; ?></p></td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Contact Number <sapn class="pull-right">&nbsp;&nbsp;:</sapn> </label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success"><i class="fa fa-phone"></i> <?php echo (isset($enquirycall_info) && $enquirycall_info->mobile > 0) ? $enquirycall_info->mobile : "--"; ?></p></td>
                                   </tr>
                               </table>
                               <table class="col-md-4">
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Service Type <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6">
                                           <p class="form-control-static text-success">
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
                                       </td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Email <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success"><i class="fa fa-envelope"></i> <?php echo (isset($enquirycall_info)) ? $enquirycall_info->email : "--"; ?></p></td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">District <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success"><i class="fa fa-building"></i> <?php echo (isset($enquirycall_info)) ? value_by_id("tblcities", $enquirycall_info->city_id, "name") : "--"; ?></p></td>
                                   </tr>
                                   <tr>
                                       <td class="col-sm-6"><label class="control-label" style="color:red;">Address <sapn class="pull-right">&nbsp;&nbsp;:</sapn> </label></td>
                                       <td class="col-sm-6"><p class="form-control-static text-success"><i class="fa fa-address-card"></i> <?php echo (isset($enquirycall_info)) ? $enquirycall_info->address : "--"; ?></p></td>
                                   </tr>
                               </table>
                           </div>  
                           
                       </fieldset>
                   </div>    
               
                
                <?php
                    if (isset($enquirycall_info) && (!empty($enquirycall_info->product_json))){
                        $decode_data = json_decode($enquirycall_info->product_json);
                ?>
                    <div class="row">
                        <fieldset class="for-panel">
                            <legend>Product Details</legend>
                            <?php
                                $i = 1;
                                foreach ($decode_data as $pdata) {
                                    if ($pdata->is_temp == 0){
                                        $color = "text-success";
                                        $product_name = value_by_id("tblproducts", $pdata->product_id, "sub_name").product_code($pdata->product_id);
                                    }else{
                                        $color = "text-danger";
                                        $product_name = value_by_id("tbltemperoryproduct", $pdata->product_id, "product_name").temp_product_code($pdata->product_id);
                                    }
                                    echo '<div class="row">
                                            <div class="col-sm-6">
                                                <div class="col-sm-12">               
                                                    <label class="col-sm-3 control-label" style="color:red;">'.$i++.') Product Name :</label>
                                                    <p class="col-sm-7 form-control-static '.$color.'">'.cc($product_name).'</p>                        
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="col-sm-12">               
                                                    <label class="col-sm-3 control-label" style="color:red;"> Qty :</label>
                                                    <p class="col-sm-7 form-control-static"><span class="badge badge-success" style="font-size: 13px;padding: 6px 12px 6px 12px;">'.$pdata->qty.'</span></p>                       
                                                </div>
                                            </div>
                                        </div>';
                                }
                            ?> 
                            
                        </fieldset>
                    </div>
                <?php } ?>
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
                                <label class="col-sm-2 control-label" style="color:red;">Question <?php echo $i++; ?> <sapn class="pull-right">:</sapn></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static text-success"><?php echo value_by_id("tblquestionmaster", $detils->question_id, "question"); ?></p> 
                                </div>
                                <label class="col-sm-2 control-label" style="color:red;">Answer <sapn class="pull-right">:</sapn></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static text-success"><?php echo cc($detils->answer); ?></p> 
                                </div>
                                
                            </div>
                        </div>
                        <?php   }
                            } 
                        ?>
                    </fieldset>
                </div>
                   <?php
                        if (isset($enquirycall_info) && !empty($enquirycall_info)) {
                            $getdrawing = $this->db->query("SELECT * FROM `tblfiles` where rel_id = '" . $enquirycall_info->id . "' AND `rel_type` = 'enquirycall_drawing'")->result();
                            if (!empty($getdrawing) OR !empty($enquirycall_info->production_remark)){
                    ?>        
                        <div class="row">
                           <fieldset class="for-panel">
                               <legend>Assign Production Details</legend>
                               <?php
                               if (!empty($getdrawing)) {
                                   ?>
                                   <div class="col-sm-12">
                                       <label class="col-sm-3 control-label">Production Drawings <sapn class="pull-right">:</sapn></label>
                                       <div class="col-sm-9">
                                           <?php
                                           foreach ($getdrawing as $file) {
                                               echo '<a target="_blank" href="' . site_url('uploads/enquirycall_drawing/' . $enquirycall_info->id . '/' . $file->file_name) . '">' . $file->file_name . '</a><br>';
                                           }
                                           ?>
                                       </div>
                                   </div>
                                   <?php
                               }
                               ?>
                               <div class="col-sm-12">
                                   <label class="col-sm-3 control-label">Action Remark <sapn class="pull-right">:</sapn> </label>
                                   <div class="col-sm-9">
                                       <p class="form-control-static text-success"><?php echo (isset($enquirycall_info) && !empty($enquirycall_info->production_remark)) ? $enquirycall_info->production_remark : "--"; ?></p>                                                   
                                   </div>

                               </div>
                           </fieldset>
                        </div>
                    <?php
                            }
                        }
                    ?>
                   
            </div>
         </div>
      </div>
   </div>
   <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>
</body>
</html>
