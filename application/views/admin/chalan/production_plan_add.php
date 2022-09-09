<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">

                                    <div class="col-md-6">
                                        <h3 for="date" class="control-label" style="color:red;"> Challan No: </h3>
                                        <?php 
                                            if ($ref_type == 'proforma_challan'){
                                                echo (!empty($challan_info)) ? 'PC-'.sprintf("%'.05d\n", $challan_info->id) : "--";
                                            }else{
                                                echo (!empty($challan_info)) ? $challan_info->chalanno : "--";
                                            }
                                        ?>
                                    </div>

                                    <div class="col-md-6">
                                        <h3 for="date" class="control-label" style="color:red;"> Challan Date: </h3>
                                        <?php 
                                            if ($ref_type == 'proforma_challan'){
                                                echo (!empty($challan_info)) ? _d($challan_info->date) : date('Y-m-d');
                                            }else{
                                                echo (isset($challan_info) ? _d($challan_info->challandate) : _d(date('Y-m-d')));
                                            }
                                        ?>
                                    </div>

                                    <div class="col-md-6">
                                        <h3 for="date" class="control-label" style="color:red;"> Work Order No: </h3>
                                        <?php 
                                            echo (!empty($challan_info)) ? $challan_info->work_no : "";
                                        ?>
                                    </div>

                                    <div class="col-md-6">
                                        <h3 for="date" class="control-label" style="color:red;"> Work Order Date: </h3>
                                        <?php echo (!empty($challan_info)) ? _d($challan_info->workdate) : _d(date('Y-m-d')); ?>
                                    </div>
                                </div>
                                <div class="clearfix mbot15"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 for="date" class="control-label" style="color:red;"> Office Person: </h3>
                                            <?php echo (!empty($challan_info) && !empty($challan_info->office_person)) ? cc($challan_info->office_person) : "N/a"; ?>
                                        </div>

                                        <div class="col-md-6">
                                            <h3 for="date" class="control-label" style="color:red;"> Office Person Number : </h3>
                                            <?php echo (!empty($challan_info)  && !empty($challan_info->office_person_number)) ? $challan_info->office_person_number : "N/a"; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 for="date" class="control-label" style="color:red;"> Site Person : </h3>
                                            <?php echo (!empty($challan_info)  && !empty($challan_info->site_person)) ? cc($challan_info->site_person) : "N/a"; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 for="date" class="control-label" style="color:red;"> Site Person Number : </h3>
                                            <?php echo (!empty($challan_info)  && !empty($challan_info->site_person_number)) ? $challan_info->site_person_number : "N/a"; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel_s no-shadow">
                                    <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="branch_id" class="control-label">Assigned To</label>
                                    <select class="form-control selectpicker" id="assigned_to" name="assigned_to" data-live-search="true" required="">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($employee_info)){
                                            foreach ($employee_info as $row) {
                                                ?>
                                                <option value="<?php echo $row['staffid']; ?>" <?php if(!empty($production_plan_info) && $production_plan_info->assigned_to == $row['staffid']){ echo 'selected';} ?>><?php echo cc($row['firstname']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                            </div>

                            <div class="form-group col-md-4">
                                    <label for="branch_id" class="control-label">Department</label>
                                    <select class="form-control selectpicker" id="department" name="department" data-live-search="true" required="">
                                        <option value="" disabled selected >--Select One-</option>
                                        <option value="1" <?php if(!empty($production_plan_info) && $production_plan_info->department == 1){ echo 'selected';} ?>>Aluminium</option>
                                        <option value="2" <?php if(!empty($production_plan_info) && $production_plan_info->department == 2){ echo 'selected';} ?>>MS</option>
                                        
                                    </select>
                            </div>

                            <div class="form-group col-md-4" app-field-wrapper="date">
                                <label for="date" class="control-label">Date</label>
                                <div class="input-group date">
                                    <input id="date" name="date" class="form-control datepicker" value="<?php if(!empty($production_plan_info)){ echo _d($production_plan_info->date); }else{ echo date('d/m/Y'); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body" id="stockavdv">
                            <input type="hidden" name="id" value="<?php echo $challan_info->id; ?>">
                            <input type="hidden" name="clientid" value="<?php echo $challan_info->clientid; ?>">
                            <input type="hidden" name="ref_type" value="<?php echo $ref_type; ?>">
                            <div style="padding:7px;margin-bottom:5%;">
                                <h4 class="modal-title pull-left"><?php echo ($challan_info->service_type == 1) ? 'Challan For Rent' : 'Challan For Sales'  ?></h4>
                                <h4 class="modal-title pull-right">Warehouse Selected :- <?php echo value_by_id('tblwarehouse',$challan_info->warehouse_id,'name'); ?></h4>
                            </div>
                            <?php
                                // $product_info = json_decode($challan_info->product_json);
                            ?>
                            <h4 class="text-center">Product List</h4>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="productTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th width="1%" >S.No</th>
                                        <th width="25%">Product Name</th>
                                        <th width="15%" >Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                    <?php
                                    $j = 0;
                                    if(!empty($product_info)){
                                        foreach ($product_info as  $singleproduct) {

                                            ?>
                                            <tr class="main" id="ptr<?php echo $j; ?>">
                                                <td><?php echo ++$j; ?></td>
                                                <td>
                                                    <?php echo value_by_id("tblproducts", $singleproduct->product_id, "name"); ?>
                                                </td>
                                                <td width="15"><?php echo $singleproduct->product_qty; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                       ?>
                                        <tr class="main" id="tr0">
                                            <td colspan="3" align="center">Products are not available</td>
                                        </tr>    
                                       <?php 
                                    }                                    
                                    ?>

                                </tbody>
                            </table>
                            <br>
                            <br>
                            <br>

                            <h4 class="text-center">Component List</h4>
                            <div id="component_table_div">
                                <?php
                                    if ($ref_type == "proforma_challan"){
                                ?>
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                        <thead>
                                            <tr>
                                                <th width="1%" >S.No</th>
                                                <th width="25%">Item Name</th>
                                                <th width="5%" align="center">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ui-sortable" style="font-size:15px;">
                                            <?php
                                            $k = 0;
                                            if(!empty($components_info)){
                                            
                                                foreach ($components_info as $singlerequriedcomponent) {

                                                    $requiredqty = $singlerequriedcomponent['qty'];

                                                    ?>
                                                    <tr class="main" id="tr<?php echo $k; ?>">
                                                        <td><?php echo $k+1; ?></td>
                                                        <td width="25%" align="left"><?php echo value_by_id('tblproducts',$singlerequriedcomponent['product_id'],'name'); ?></td>
                                                        <td width="20%" align="center">
                                                            <?php echo $requiredqty; ?>
                                                            <input type="hidden" name="componentdata[<?php echo $k; ?>][component_deleverable_qty]" value="<?php echo $requiredqty; ?>">
                                                            <input type="hidden" name="componentdata[<?php echo $k; ?>][component_id]" value="<?php echo $singlerequriedcomponent['product_id']; ?>">
                                                            <input type="hidden" name="componentdata[<?php echo $k; ?>][component_item_id]" value="<?php echo $singlerequriedcomponent['id']; ?>">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $k++;
                                                }
                                            }else{
                                            ?>
                                                <tr class="main" id="tr0">
                                                    <td colspan="7" align="center">Components are not available</td>
                                                </tr>    
                                            <?php 
                                            }                                    
                                            ?>

                                        </tbody>
                                    </table>
                                <?php        
                                    }else{
                                ?>
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                    <thead>
                                        <tr>
                                            <th width="1%" >S.No</th>
                                            <th width="25%" align="center">Item Name</th>
                                            <th width="5%" align="center">Req Qty</th>
                                            <th width="5%" align="center">Deliverable Quantity</th>
                                            <th width="5%" align="center">Chalan Status</th>
                                            <th width="5%" align="center">Pending</th>
                                            <th width="20%" align="center">Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable" style="font-size:15px;">
                                        <?php
                                        $k = 0;
                                        if(!empty($components_info)){
                                        
                                            foreach ($components_info as $singlerequriedcomponent) {

                                                $deliverableqty = $singlerequriedcomponent['deleverable_qty'];
                                                $requiredqty = $singlerequriedcomponent['required_qty'];

                                                ?>
                                                <tr class="main" id="tr<?php echo $k; ?>">
                                                    <td><?php echo $k+1; ?></td>
                                                    <td width="25%" align="left"><?php echo value_by_id('tblproducts',$singlerequriedcomponent['component_id'],'name'); ?></td>
                                                    <td width="5%" align="center"><?php echo $requiredqty; ?></td>
                                                    <td width="5%" align="center"><?php echo $deliverableqty; ?></td>
                                                    <td width="5%" align="center" ><?php echo ($singlerequriedcomponent['flag'] == 1) ? "Approved": "Pending"; ?></td>
                                                    <td width="5%" align="center"><?php echo $singlerequriedcomponent['pending_qty']; ?></td>
                                                    <td width="20%" align="center">
                                                        <input type="hidden" name="componentdata[<?php echo $k; ?>][component_deleverable_qty]" value="<?php echo $deliverableqty; ?>">
                                                        <input type="hidden" name="componentdata[<?php echo $k; ?>][component_id]" value="<?php echo $singlerequriedcomponent['component_id']; ?>">
                                                        <input type="hidden" name="componentdata[<?php echo $k; ?>][component_item_id]" value="<?php echo $singlerequriedcomponent['id']; ?>">
                                                        <textarea required="" name="componentdata[<?php echo $k; ?>][remark]" rows="5" class="form-control remark" ><?php echo $singlerequriedcomponent['remark']; ?></textarea>
                                                    </td>
                                                </tr>
                                                <?php
                                                $k++;
                                            }
                                        }else{
                                        ?>
                                            <tr class="main" id="tr0">
                                                <td colspan="7" align="center">Components are not available</td>
                                            </tr>    
                                        <?php 
                                        }                                    
                                        ?>

                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                            <div  class="col-md-12">
                                <div class="form-group">
                                    <label for="note" class="control-label">Note</label>
                                    <textarea class="form-control tinymce" name="note" id="note"><?php echo (isset($production_plan_info)) ? $production_plan_info->note : $challan_info->note; ?></textarea>
                                </div>
                            </div>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Save</button>
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

</body>
</html>
