<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}
.ui-menu-item :hover{
    color: #03a9f4;
    border-color: #03a9f4;
}
.ui-menu-item {
    padding: 5px;
}
.bootstrap-select .dropdown-menu li a span.text {
    display: block ruby;
}
</style>
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
<!--      <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
         <button class="btn btn-info only-save customer-form-submiter">Save</button>
      </div>-->
      <div class="col-md-12">
         <div class="panel_s">
            <div class="panel-body">
               <div>
                  <div class="tab-content">
                      <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title: "";?><small style="margin-left:60%"><input type="checkbox" id="product_not_assign" name="product_not_assign" <?php echo (isset($enquirycall_info) && !empty($enquirycall_info->production_remark) && ($enquirycall_info->is_converted > 0)) ? 'checked' : ''; ?>> &nbsp;Product Not Define Assign To Production</small></h4>
                      <?php //echo form_open($this->uri->uri_string(), array('id' => 'enquirycall-form', 'class' => 'enquirycall-form')); ?>
                      <form action="" id="enquirycall-form" class="enquirycall-form" method="post" accept-charset="utf-8" <?php /*if(empty($enquirycall_info)){ ?> onsubmit="return confirm('Is your call is end ? Click Ok if yes');" <?php }*/ ?>>
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="lead_type" class="control-label">Lead Type</label>
                                        <select class="form-control selectpicker" id="lead_type" name="lead_type" required="" data-live-search="true">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->lead_type == 1) ? "selected=''": "": ""; ?>>Verified</option>
                                            <option value="2" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->lead_type == 2) ? "selected=''": "": ""; ?>>Unverified</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 verified_lead_div">
                                    <div class="form-group">
                                        <label for="lead_category" class="control-label">Lead Category</label>
                                        <select class="form-control selectpicker" id="lead_category_id" name="lead_category_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if (!empty($lead_category_list)){
                                                    foreach ($lead_category_list as $value) {
                                                        if (isset($call_type)){
                                                            $selectedcls = ($call_type == $value->id) ? "selected=''": "";
                                                        }else{
                                                            $selectedcls = (isset($enquirycall_info)) ? ($enquirycall_info->lead_category_id == $value->id) ? "selected=''": "": "";
                                                        }
                                            ?>
                                                        <option value="<?php echo $value->id; ?>" <?php echo $selectedcls; ?>><?php echo cc($value->title); ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 verified_lead_div">
                                    <div class="form-group">
                                        <label for="calltype_id" class="control-label">Call Type</label>

                                        <select class="form-control selectpicker" id="call_type" name="call_type" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if (isset($call_type)){
                                                   $incoming = ($call_type == 1) ? "selected=''": "";
                                                   $outcoming = ($call_type == 2) ? "selected=''": "";
                                                   $applead = ($call_type == 3) ? "selected=''": "";
                                                   $indiamartlead = ($call_type == 4) ? "selected=''": "";
                                                }else{
                                                   $incoming = (isset($enquirycall_info)) ? ($enquirycall_info->call_type == 1) ? "selected=''": "": "";
                                                   $outcoming = (isset($enquirycall_info)) ? ($enquirycall_info->call_type == 2) ? "selected=''": "": "";
                                                   $applead = (isset($enquirycall_info)) ? ($enquirycall_info->call_type == 3) ? "selected=''": "": "";
                                                   $indiamartlead = (isset($enquirycall_info)) ? ($enquirycall_info->call_type == 4) ? "selected=''": "": "";
                                                }
                                            ?>
                                            <option value="1" <?php echo $incoming; ?>>Incoming</option>
                                            <option value="2" <?php echo $outcoming; ?>>Outgoing</option>
                                            <option value="3" <?php echo $applead; ?>>App Lead</option>
                                            <option value="4" <?php echo $indiamartlead; ?>>India Mart Lead</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 verified_lead_div">
                                    <div class="form-group">
                                        <label for="lead_category" class="control-label">Source</label>
                                        <select class="form-control selectpicker" id="source_id" name="source_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if (!empty($source_list)){
                                                    foreach ($source_list as $value) {
                                                      $select_cls = "";
                                                      if (isset($source_id) && !isset($enquirycall_info)){
                                                          $select_cls = ($source_id == $value->id) ? "selected=''": "";
                                                      }elseif (isset($enquirycall_info->source_id)) {
                                                          $select_cls = ($enquirycall_info->source_id == $value->id) ? "selected=''": "";
                                                      }
                                            ?>
                                                        <option value="<?php echo $value->id; ?>" <?php echo $select_cls; ?>><?php echo cc($value->name); ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 verified_lead_div">
                                    <div class="form-group">
                                        <label for="service_type_id" class="control-label">Service Type</label>
                                        <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->service_type == 1) ? "selected=''": "": ""; ?>>Rent</option>
                                            <option value="2" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->service_type == 2) ? "selected=''": "": ""; ?>>Sales</option>
                                            <option value="3" <?php echo (isset($enquirycall_info)) ? ($enquirycall_info->service_type == 3) ? "selected=''": "": ""; ?>>Both (rent & sales)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 verified_lead_div">
                                    <div class="form-group rent_duration">
                                        <?php if(isset($enquirycall_info) && $enquirycall_info->duration > 0){ ?>
                                        <label for="rent_duration" class="control-label">Duration (In Months)</label><input type="number" min="1" max="12" id="duration" value="<?php echo $enquirycall_info->duration; ?>" class="form-control" name="duration">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row verified_lead_div">
                                <div class="col-md-4">
                                    <label for="company_name" class="control-label">Company Name</label><a href="javascript:void(0);" value="1" class="pull-right client_text">Select Client</a>
                                    <div class="form-group client_div">
                                        <?php
                                            if(isset($enquirycall_info) && $enquirycall_info->clientid > 0){
                                        ?>
                                            <select class="form-control selectpicker" data-live-search="true" id="clientid" name="clientid"><option value=""></option>
                                                <?php
                                                    if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                                        foreach ($client_branch_data as $client_branch_key => $client_branch_value){
                                                          $cityname = ($client_branch_value->city != '') ? value_by_id_empty("tblcities", $client_branch_value->city, "name") : '';
                                                          $select_cls = (isset($enquirycall_info) && $enquirycall_info->clientid == $client_branch_value->userid) ? "selected":"";
                                                          echo '<option value="'.$client_branch_value->userid.'" '.$select_cls.'>'.cc($client_branch_value->client_branch_name).' - '.$cityname.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        <?php
                                            }else{
                                                $company_name = (isset($enquirycall_info)) ? $enquirycall_info->company_name: "";
                                                if (isset($applead_info)){
                                                    $company_name = $applead_info->company_name;
                                                }else if (isset($indiamart_info)){
                                                    $company_name = $indiamart_info->company_name;
                                                }
                                        ?>
                                        <input type="text" id="company_name" class="form-control" value="<?php echo $company_name; ?>" name="company_name" placeholder="company name">
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <?php
                                            $company_email = (isset($enquirycall_info)) ? $enquirycall_info->email: "";
                                            if (isset($applead_info)){
                                                $company_email = $applead_info->person_email;
                                            }else if (isset($indiamart_info)){
                                                $company_email = $indiamart_info->email;
                                            }
                                        ?>
                                        <input type="email" id="email" class="form-control" name="email" value="<?php echo $company_email; ?>" placeholder="email">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Contact Person Name" class="control-label">Contact Person Name</label>
                                        <?php
                                            $person_name = (isset($enquirycall_info)) ? $enquirycall_info->person_name: "";
                                            if (isset($applead_info)){
                                                $person_name = $applead_info->person_name;
                                            }else if (isset($indiamart_info)){
                                                $person_name = $indiamart_info->customer_name;
                                            }
                                        ?>
                                        <input type="text" id="contact_parson_name" class="form-control" value="<?php echo $person_name; ?>" name="contact_parson_name" placeholder="contact parson name">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label">Contact Number</label>
                                        <?php
                                            $company_number = (isset($enquirycall_info) && $enquirycall_info->mobile > 0) ? $enquirycall_info->mobile: "";
                                            if (isset($applead_info)){
                                                $company_number = $applead_info->person_number;
                                            }else if (isset($indiamart_info)){
                                                $company_number = $indiamart_info->mobile;
                                            }
                                        ?>
                                        <input type="text" id="mobile" class="form-control"  name="mobile" value="<?php echo $company_number; ?>" placeholder="contact number">
                                    </div>
                                </div>
                            </div>
                            <div class="row verified_lead_div">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="state" class="control-label">State</label>
                                        <select class="form-control selectpicker" id="state_id" name="state_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if($states_list){
                                                    foreach ($states_list as $state) {
                                                        if (isset($enquirycall_info)){
                                                            $selected = ($enquirycall_info->state_id == $state->id) ? "selected=''": "";
                                                            echo '<option value="'.$state->id.'" '.$selected.' >'.$state->name.'</option>';
                                                        }else{
                                                            echo '<option value="'.$state->id.'">'.$state->name.'</option>';
                                                        }

                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="control-label">District</label>
                                        <select class="form-control selectpicker" id="city_id" name="city_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php if (isset($enquirycall_info) && isset($cities_list)){
                                                    foreach ($cities_list as $city) {
                                                        $selected = ($city->id == $enquirycall_info->city_id) ? "selected": "";
                                                        echo '<option value="'.$city->id.'" '.$selected.' >'.$city->name.'</option>';
                                                    }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Address</label>
                                        <?php
                                            $addressdata = (isset($enquirycall_info)) ? $enquirycall_info->address: "";
                                            if (isset($applead_info)){
                                                $addressdata = (!empty($applead_info->address)) ? $applead_info->address : "";
                                            }else if (isset($indiamart_info)){
                                                $addressdata = $indiamart_info->address;
                                            }
                                        ?>
                                        <textarea id="address" name="address" class="form-control" placeholder="address..."><?php echo $addressdata; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Mobile" class="control-label">Root Category</label>
                                        <select class="form-control selectpicker" id="sub_category_id" name="sub_category_id[]" multiple="" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if($sub_category){
                                                    foreach ($sub_category as $k => $scategory) {
                                                        if (isset($enquirycall_info)){
                                                            $category_ids = explode(",", $enquirycall_info->sub_category_id);

                                                            $selected = (in_array($scategory->id, $category_ids)) ? "selected=''": "";
                                                            echo '<option value="'.$scategory->id.'" '.$selected.'>'.$scategory->name.'</option>';
                                                        }else{
                                                            echo '<option value="'.$scategory->id.'">'.$scategory->name.'</option>';
                                                        }
                                                    }

                                                    /* this code use for enquiry call */
                                                    if (isset($enquirycall_info)){
                                                        $category_ids = explode(",", $enquirycall_info->sub_category_id);
                                                        $selectedtemp = (in_array('Temp1', $category_ids)) ? "selected=''": "";
                                                        echo '<option value="Temp1" '.$selectedtemp.'>Temporary products</option>';
                                                    }else{
                                                        echo '<option value="Temp1">Temporary products</option>';
                                                    }    
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="assign_production" <?php echo (isset($enquirycall_info) && !empty($enquirycall_info->production_remark) && ($enquirycall_info->is_converted > 0)) ? '' : 'style="display:none;"'; ?>>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="assign_production" class="control-label">Assign To Production</label>
                                            <select class="form-control selectpicker" id="assign_to_production" name="assignproductionid[]" multiple="" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                if (isset($approveby) && $enquirycall_info->is_converted > 0) {
                                                    $approvby = explode(',', $approveby->assignids);
                                                }
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                        ?>
                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                            <?php
                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                ?>
                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php if (isset($approvby) && in_array($singstaff['staffid'], $approvby)) {
                                                        echo'selected';
                                                    } ?>><?php echo $singstaff['firstname'] ?></option>
                                                                <?php }
                                                            ?>
                                                        </optgroup>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="production_remark" class="control-label">Assign Remark</label>
                                            <textarea id="production_remark" name="production_remark" class="form-control" placeholder="assign remark..."><?php echo (isset($enquirycall_info) && ($enquirycall_info->is_converted > 0)) ? $enquirycall_info->production_remark : ""; ?></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="main_remark" class="control-label">Remark</label>
                                        <textarea id="main_remark" name="remark" class="form-control" placeholder="remark..."><?php echo (isset($enquirycall_info) && !empty($enquirycall_info->remark)) ? $enquirycall_info->remark : ""; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 unverified_status_div" style="display:none;">
                                    <div class="form-group">
                                        <label for="" class="control-label">Unverified Status</label>
                                        <select class="form-control selectpicker" id="unverified_status_id" name="unverified_status_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($unverifed_status_list) && isset($unverifed_status_list)) {
                                                foreach ($unverifed_status_list as $unverifed_status) {
                                                    $selected = (isset($enquirycall_info) && $unverifed_status->id == $enquirycall_info->unverified_status_id) ? "selected" : "";
                                                    echo '<option data-is_order="'.$unverifed_status->is_other.'" value="' . $unverifed_status->id . '" ' . $selected . ' >' . cc($unverifed_status->title) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9 unverified_remark_div" style="display:none;">
                                    <div class="form-group">
                                        <label for="Unverified Order Remark" class="control-label">Unverified Order Remark</label>
                                        <textarea id="unverified_order_remark" name="unverified_order_remark" class="form-control" placeholder="unverified order remark..."><?php echo (isset($enquirycall_info)) ? $enquirycall_info->unverified_order_remark : ""; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 verified_lead_div">
                            <h3>Product Enquiry Details</h3>
                            <hr>
                            <?php
                                $show_pro = (isset($enquirycall_info) && (!empty($enquirycall_info->product_json))) ? "" : 'style="display:none;"';
                            ?>
                            <div class="row pro_enq_details" <?php echo $show_pro; ?>>
				                <div class="table-responsive s_table">
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
                                        <thead>
                                            <tr>
                                                <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                                <th width="30%" align="left"><?php echo _l('product_name');?></th>
                                                <th width="10%" align="left">View Product</th>
                                                <th width="10%" align="left"><?php echo _l('quantity_as_qty');?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="ui-sortable">
                                            <?php
                                                $i = 0;
                                                if (isset($enquirycall_info) && (!empty($enquirycall_info->product_json))){
                                                    $decode_data = json_decode($enquirycall_info->product_json);
                                                    foreach ($decode_data as $pdata) {
                                                        $pd_id = $pdata->product_id."-".$pdata->is_temp;
                                                        echo '<tr class="main" id="tre'.$i.'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('.$i.');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><div class="product_list1"><select class="form-control product_list selectpicker" onchange="showproductlink('.$i.', this);" data-live-search="true" id="product_id'.$i.'" name="proenqdata['.$i.'][product_id]"><option value=""></option>';
                                                        foreach ($product_data as $prod_list) {
                                                            // if ($prod_list['id'] == $pd_id) {
                                                            //     echo '<option value="'.$prod_list['id'].'" selected="selected">'.$prod_list['name'].'</option>';
                                                            // }
                                                            // else{
                                                            //     echo '<option value="'.$prod_list['id'].'">'.$prod_list['name'].'</option>';
                                                            // }
                                                            $select_cls = ($prod_list['id'] == $pd_id) ? 'selected="selected"': '';
                                                        ?>        
                                                            <option data-content="<?php echo $prod_list['name']; ?>" value="<?php echo $prod_list['id']; ?>" <?php echo $select_cls; ?>><?php echo $prod_list['name']; ?></option>
                                                        <?php     
                                                        }
                                                        $prourl = admin_url('product_new/view/'.$pdata->product_id); 
                                                        echo '</select></div></div></td><td class="productlink'.$i.'"><a target="_blank" href="'.$prourl.'">View</a></td><td><div class="form-group"><input type="number" id="qty" value="'.$pdata->qty.'" name="proenqdata['.$i.'][qty]" class="form-control"></div></td></tr>';
                                                       $i++;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12">
                                        <label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo $i; ?>"><?php echo _l('add_more_product');?> <i class="fa fa-plus"></i></a></label>
                                    </div>
                                </div>
			                </div>
                        </div>
                        <div class="col-md-12 verified_lead_div">
                            <h3>Enquiry Questions</h3>
                            <hr>
                            <div class="row">
				<?php
                                    if (!empty($question_list)){
                                        foreach ($question_list as $value) {
//                                            $required = ($value->is_required == 1) ? 'required=""' : "";
                                            $required_cls = ($value->is_required == 1) ? '<span class="text-danger"> * </span>' : "";
                                            $size = $value->size;
                                            $exist = 0;
                                            if (isset($enquirycall_info)){
                                                $calldetails = $this->db->query("SELECT * from `tblenquirycall_details` WHERE `main_id` = ".$enquirycall_info->id." AND `question_id` = ".$value->id." ORDER BY `id` DESC")->row();
                                                switch ($value->type) {
                                                        case 1:
                                                            $ans = (!empty($calldetails)) ? $calldetails->answer : "";
                                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                    <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                    <input type="text" id="question['.$value->id.']" class="form-control" name="question['.$value->id.']" value="'.$ans.'"></div>
                                                                </div></div>';
                                                            break;
                                                        case 2:
                                                            $ans = (!empty($calldetails)) ? $calldetails->answer : "";
                                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                    <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                    <textarea id="question['.$value->id.']" name="question['.$value->id.']" rows="4" class="form-control">'.$ans.'</textarea></div>
                                                                </div></div>';
                                                            break;
                                                        case 3:

                                                            $options = explode(",", $value->options);
                                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                    <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                    <select class="form-control selectpicker" id="question['.$value->id.']" name="question['.$value->id.']" data-live-search="true">
                                                                        <option value=""></option>';
                                                                            foreach ($options as $val) {
                                                                                if ((!empty($calldetails)) && $calldetails->answer == $val){
                                                                                    echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                                                                }else{
                                                                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                                                                }
                                                                            }
                                                            echo   '</select></div></div></div>';
                                                            break;
                                                        case 4:

                                                            if (!empty($calldetails)) {
                                                                $options = explode(",", $value->options);
                                                                echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                        <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                        <select class="form-control selectpicker" id="question['.$value->id.']" multiple="" name="question['.$value->id.'][]" data-live-search="true">
                                                                            <option value=""></option>';
                                                                                foreach ($options as $val) {
                                                                                    if (in_array($val, explode(",", $calldetails->answer))){
                                                                                        echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$val.'">'.$val.'</option>';
                                                                                    }
                                                                                }
                                                                echo   '</select></div></div></div>';
                                                            }
                                                            else{
                                                                $options = explode(",", $value->options);
                                                                echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                        <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                        <select class="form-control selectpicker" id="question['.$value->id.']" multiple="" name="question['.$value->id.'][]" data-live-search="true">
                                                                            <option value=""></option>';
                                                                                foreach ($options as $val) {
                                                                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                                                                }
                                                                echo   '</select></div></div></div>';
                                                            }
                                                            break;
                                                    }

                                            }else{
                                                switch ($value->type) {
                                                    case 1:

                                                        echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                <input type="text" id="question['.$value->id.']" class="form-control" name="question['.$value->id.']"></div>
                                                            </div></div>';

                                                        break;
                                                    case 2:
                                                        echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                <textarea id="question['.$value->id.']" name="question['.$value->id.']" rows="4" class="form-control"></textarea></div>
                                                            </div></div>';

                                                        break;
                                                    case 3:
                                                        $options = explode(",", $value->options);
                                                        echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                <select class="form-control selectpicker" id="question['.$value->id.']" name="question['.$value->id.']" data-live-search="true">
                                                                    <option value=""></option>';
                                                                        foreach ($options as $val) {
                                                                            echo '<option value="'.$val.'">'.$val.'</option>';
                                                                        }
                                                        echo   '</select></div></div></div>';
                                                        break;
                                                    case 4:
                                                        $options = explode(",", $value->options);
                                                        echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                                <label for="question" class="control-label">'.$value->question_order.') '.$value->question.$required_cls.'</label><div>
                                                                <select class="form-control selectpicker" id="question['.$value->id.']" multiple="" name="question['.$value->id.'][]" data-live-search="true">
                                                                    <option value=""></option>';
                                                                        foreach ($options as $val) {
                                                                            echo '<option value="'.$val.'">'.$val.'</option>';
                                                                        }
                                                        echo   '</select></div></div></div>';
                                                        break;
                                                }
                                            }

                                        }
                                    }
                                ?>
			    </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <!-- <input type="hidden" name="source_id" value="<?php echo $source_id; ?>"> -->
                            <input type="hidden" name="call_id" value="<?php echo $call_id; ?>">
                            <?php if (isset($call_type)) { ?>
                            <input type="hidden" name="calltype_id" value="<?php echo $call_type; ?>">
                            <?php } ?>
                                <button class="btn btn-info" type="submit">
                                        <?php echo _l('submit'); ?>
                                </button>
                        </div>
                      <?php //echo form_close(); ?>
                        </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>
<div id="productdetailsmodal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content producthtml">

        </div>    
    </div>    
</div>

<script type="text/javascript">

    $(document).ready(function() {
        var sub_categories = $("#sub_category_id").val();
        if (sub_categories !=""){
            $(".pro_enq_details").show();
//            $(".main").remove();
        }
        var lead_type = $("#lead_type").val();
        if (lead_type == 2){
            $(".unverified_status_div").show();
        }
        var unverified_status = $("#unverified_status_id").find(':selected').data('is_order');
        if (unverified_status == 1){
            $(".unverified_remark_div").show();
        }
    });

    $(document).on("change", "#service_type",function(){
        var service_type = $(this).val();
        $(".rent_duration").html("");
        if (service_type == 1 || service_type == 3){
            $(".rent_duration").html('<label for="rent_duration" class="control-label">Duration (In Months)</label><input type="number" min="1" max="12" id="duration" required="" class="form-control" name="duration">');
        }
    });

    $(document).on("change", "#state_id",function(){
        var state_id = $(this).val();
        if (state_id > 0){
            var url = "<?php echo admin_url("enquirycall/getcities/")?>"+state_id;
            $.get(url, function(data){
                $("#city_id").html(data);
                $('.selectpicker').selectpicker('refresh');
            });
        }

    });
    $(document).on("change", "#sub_category_id",function(){
        $(".pro_enq_details").show();
        $(".main").remove();
    });

    $(document).on("click", ".addmoreproenq",function(){
        var sub_category_id = $("#sub_category_id").val();
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);

        var url = "<?php echo admin_url("enquirycall/get_products_list")?>";
        
        $.post(url, {"sub_category_id": sub_category_id}, function(data){
                $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><div class="product_list1"><select data-html="true" class="form-control product_list selectpicker" onchange="showproductlink('+newaddmoreproenq+', this);" data-live-search="true" id="product_id'+newaddmoreproenq+'" name="proenqdata['+newaddmoreproenq+'][product_id]"><option value=""></option>'+data+'</select></div></div></td><td class="productlink'+newaddmoreproenq+'"></td><td><div class="form-group"><input type="number" id="qty" name="proenqdata['+newaddmoreproenq+'][qty]" class="form-control"></div></td></tr>');
                $('.selectpicker').selectpicker('refresh');
            })
//            $.get(url, function(data){
//                $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><div class="product_list1"><select class="form-control product_list selectpicker" data-live-search="true" id="product_id'+newaddmoreproenq+'" name="proenqdata['+newaddmoreproenq+'][product_id]"><option value=""></option>'+data+'</select></div></div></td><td><div class="form-group"><input type="number" id="qty" name="proenqdata['+newaddmoreproenq+'][qty]" class="form-control"></div></td></tr>');
//                $('.selectpicker').selectpicker('refresh');
//            });
    });

    function showproductlink(row_id, el){
        var product_id = $("#product_id"+row_id).val();
        var proarr = product_id.split("-");

        var prourl = "<?php echo admin_url("product_new/view/")?>"+proarr[0];
        if (proarr[1] == 1){
            prourl = "<?php echo admin_url("product_new/temperory_product/")?>"+proarr[0];
        }
        
        $(".productlink"+row_id).html('<a target="_blank" href="'+prourl+'">View</a>');

        getproconfirmation(row_id, el);  
    }

    function getproconfirmation(row_id, el)
    {
        var product_id = $("#product_id"+row_id).val();
        var proarr = product_id.split("-");
        var prodid = proarr[0];
        var is_temp = proarr[1];
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/site_manager/getproductdetails'); ?>",
            data    : {'prodid' : prodid, 'is_temp_product': is_temp},
            success : function(data){
                if(data != ''){
                    $('#productdetailsmodal').modal({
                        show: 'false'
                    });
                    $('.producthtml').html(data);
                    $(".productdetailsbtn").html('<button type="button" class="btn btn-default close-model" onclick="removeproduct('+row_id+');" data-dismiss="modal">Cancel</button><button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
                }
            }
        })
    }

    function removeproduct(proid)
    {
        $('#tre' + proid).remove();
    }

    $(document).on("keyup", "#mobile",function(){
        $('span.error-keyup-3').remove();
        var inputVal = $(this).val();
        var characterReg = /^([0-9]{0,10})$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-3" style="color: red">Only Numeric, Maximum 10 characters.</span>');
        }
    });
</script>
<script type="text/javascript">
    $(document).on("click", "#product_not_assign", function(){
        if ($(this).prop('checked')==true){
            $(".assign_production").show();
//            $("#assign_to_production").attr("required", "");
//            $("#production_remark").attr("required", "");
        }else{
            $(".assign_production").hide();
//            $("#assign_to_production").removeAttr("required");
//            $("#production_remark").removeAttr("required");
        }
    });

    $(document).on("click", ".client_text", function(){
        var id = parseInt($(this).attr('value'));
        if(id == 1){
            $(this).attr('value', "2");
            $(this).html("Enter Company Name");
            var client_div = '<select class="form-control selectpicker" data-live-search="true" id="clientid" name="clientid"><option value=""></option><?php
            if (isset($client_branch_data) && count($client_branch_data) > 0) {
                foreach ($client_branch_data as $client_branch_key => $client_branch_value){
                    $cityname = (!empty($client_branch_value->city)) ? value_by_id_empty('tblcities', $client_branch_value->city, 'name') : '';
                    echo '<option value="'.$client_branch_value->userid.'">'.cc($client_branch_value->client_branch_name).' - '.$cityname.'</option>';
                }
            }

            ?></select>';
            $(".client_div").html(client_div);
            $('.selectpicker').selectpicker('refresh');
            $("#contact_parson_name").val("");
            $("#email").val("");
            $("#mobile").val("");
        }else{
            $(this).attr('value', "1");
            $(this).html("Select Client");
            var client_div = '<input type="text" id="company_name" class="form-control" value="" name="company_name" placeholder="company name">';
            $(".client_div").html(client_div);
            $("#contact_parson_name").val("");
            $("#email").val("");
            $("#mobile").val("");
        }
    });


    $(document).on("change", "#clientid", function(){

        var clientid = $(this).val();
        var url = "<?php echo admin_url("enquirycall/getclientdata/")?>"+clientid;
            $.get(url, function(data){
                var res=JSON.parse(data);
                $("#contact_parson_name").val(res.client_person_name);
                $("#email").val(res.email_id);
                $("#mobile").val(res.phone_no_1);
                $("#address").val(res.address);

                $('#state_id option[value='+ res.state_id +']').attr('selected','selected');


                if (res.state_id > 0){
                    var url = "<?php echo admin_url("enquirycall/getcities/")?>"+res.state_id;
                    $.get(url, function(data){
                        $("#city_id").html(data);
                        $('#city_id option[value='+ res.city_id +']').attr('selected','selected');
                        $('.selectpicker').selectpicker('refresh');
                    });
                }

                $('.selectpicker').selectpicker('refresh');
            });
    });
    $(document).on("change", "#lead_type", function(){
        $(".unverified_status_div").hide();
        $(".verified_lead_div").show();
        var lead_type = $(this).val();
        if (lead_type == 2){
            $(".unverified_status_div").show();
            $(".verified_lead_div").hide();
        }
    });
    $(document).on("change", "#unverified_status_id", function(){
        $(".unverified_remark_div").hide();
        var unverified_status = $(this).find(':selected').data('is_order');
        if (unverified_status == 1){
            $(".unverified_remark_div").show();
        }
    });

    var companies_list = [<?php echo $lead_companies; ?>];
    $( "#company_name" ).autocomplete({
      source: companies_list
    });
</script>
</body>
</html>
