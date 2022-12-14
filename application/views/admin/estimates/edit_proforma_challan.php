<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php
            if (isset($proposal)) {
                echo form_hidden('isedit', $proposal->id);
            }
            $rel_type = '';
            $rel_id = '';
            if (isset($proposal) || ($this->input->get('rel_id') && $this->input->get('rel_type'))) {
                if ($this->input->get('rel_id')) {
                    $rel_id = $this->input->get('rel_id');
                    $rel_type = $this->input->get('rel_type');
                } else {
                    $rel_id = $proposal->rel_id;
                    $rel_type = $proposal->rel_type;
                }
            }
            ?>
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
                                        <?php
                                            $value = (isset($challan_info) ? _d($challan_info->date) : _d(date('Y-m-d')));
                                            echo render_date_input('date', 'Challan Date', $value);
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php $pdf_line_breakvalue = (isset($challan_info) ? $challan_info->pdf_line_break : 0); ?>
                                            <?php  echo render_input('pdf_line_break', 'PDF Line Break', $pdf_line_breakvalue); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date" class="control-label"> <small class="req text-danger">* </small>Po/Wo No.</label>
                                        <input type="text" id="work_no" name="work_no" class="form-control" value="<?php if(!empty($challan_info)){ echo $challan_info->work_no; }?>">
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            $value = (isset($challan_info) ? _d($challan_info->workdate) : _d(date('Y-m-d')));
                                            echo render_date_input('workdate', 'Po/Wo Date', $value);
                                        ?>
                                    </div>
                                </div>
                                <div class="clearfix mbot15"></div>

                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">

                                    <div class="row">


                                        <div class="col-md-6">
                                            <?php
                                            $office_person = $challan_info->office_person;

                                                echo render_input('office_person', 'Office Person', $office_person);
                                            ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?php
                                            $office_person_number = $challan_info->office_person_number;
                                                echo render_input('office_person_number', 'Office Person Number', $office_person_number);
                                            ?>
                                        </div>


                                        <div class="col-md-6">
                                            <?php
                                            $site_person = $challan_info->site_person;
                                                echo render_input('site_person', 'Site Person', $site_person);
                                            ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?php
                                            $site_person_number = $challan_info->site_person_number;
                                                echo render_input('site_person_number', 'Site Person Number', $site_person_number);
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom:2%;">
                                    <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                    <select onchange="staffdropdown()" class="form-control selectpicker" data-live-search="true" id="assign" name="assign" required="">
                                        <option value="">Select</option>
                                        <?php
                                        if (isset($group_info) && count($group_info) > 0) {
                                            $group_id = (isset($challan_info)) ? $challan_info->group_id : 0;
                                            foreach ($group_info as $value) {
                                                $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '" . $value['id'] . "' ")->row_array();
                                                ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo (!empty($group_id) && $group_id == $value['id']) ? 'selected' : "" ?>><?php echo cc($value['name']); ?></option>
                                                <optgroup label="Sales Person">
                                                    <?php
                                                        $employee_info = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value['sales_person_id'] . "' ")->row_array();
                                                    ?>
                                                    <option disabled value="<?php echo $employee_info['staffid'] ?>"><?php echo $employee_info['firstname'] ?></option></optgroup>
                                                <optgroup label="Superior Person">
                                                    <?php
                                                    $superiordata = explode(',', $lead_staff_info['superior_ids']);
                                                    foreach ($superiordata as $value1) {
                                                        $employee_info1 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value1 . "' ")->row_array();
                                                        ?>
                                                        <option disabled  value="<?php echo $employee_info1['staffid'] ?>"><?php echo $employee_info1['firstname'] ?></option>
                                                        <?php }
                                                    ?></optgroup>
                                                <optgroup label="Quote Person">
                                                    <?php
                                                    $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
                                                    foreach ($quotedata as $value2) {
                                                        $employee_info2 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value2 . "' ")->row_array();
                                                        ?>
                                                        <option disabled value="<?php echo $employee_info2['staffid'] ?>"><?php echo $employee_info2['firstname'] ?></option>
                                                        <?php }
                                                    ?></optgroup>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="assign_error" style="color:red;"></div>
                            </div>
                        </div>
                    <div class="row">
                        
                            
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body" id="stockavdv">
                            <input type="hidden" name="id" value="<?php echo $challan_info->id; ?>">

                            <div style="padding:7px;margin-bottom:5%;">
                                <h4 class="modal-title pull-left"><?php echo ($challan_info->service_type == 1) ? 'Challan For Rent' : 'Challan For Sales'  ?></h4>
                                <h4 class="modal-title pull-right">Warehouse Selected :- <?php echo value_by_id('tblwarehouse',$challan_info->warehouse_id,'name'); ?></h4>
                            </div>
                            <h4 class="text-center">Product List</h4>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="productTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th width="25%" align="center">Product Name</th>
                                        <th width="15%" align="center">Quantity</th>
                                        <!-- <th width="5%" align="center"></th> -->
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                    <?php
                                    $j = 0;
                                    if(!empty($product_info)){
                                        foreach ($product_info as  $singleproduct) {
                                            
                                    ?>
                                            <tr class="main" id="ptr<?php echo $j; ?>">
                                                <td class="text-center">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" name="productdata[<?php echo $j; ?>][product_id]" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($item_data) && count($item_data) > 0) {
                                                                foreach ($item_data as $product_value) {

                                                                    ?>
                                                                    <option value="<?php echo $product_value['id'] ?>" <?php echo ($singleproduct["product_id"] == $product_value['id']) ? 'selected':''; ?>><?php echo cc($product_value['sub_name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?></select>
                                                    </div>
                                                </td>
                                                <td width="15" align="center"><input class="form-control" type="text" id="reqqty<?php echo $j; ?>" name="productdata[<?php echo $j; ?>][qty]" value="<?php echo $singleproduct["qty"]; ?>"></td>
                                                <!-- <td width="5%">
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeproduct(<?php echo $j; ?>);" ><i class="fa fa-remove"></i></button>
                                                </td> -->
                                            </tr>
                                            <?php
                                            $j++;
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
                            <div class="col-xs-12">
                                <!-- <label class="label-control subHeads"><a class="addmoreproduct" value="<?php echo (!empty($j)) ? $j : 1; ?>">Add More Product<i class="fa fa-plus"></i></a></label> -->
                                <!-- <button type="button" class="get_components btn btn-info pull-right">Get Component</button> -->
                            </div>
                            <br>
                            <br>
                            <br>

                            <h4 class="text-center">Component List</h4>
                            <div id="component_table_div">
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                    <th>Item Name</th>
                                        <th width="5%" align="center">Product Code</th>
                                        <th width="2%" align="center">View</th>
                                        <th width="15%" align="center">Available Stock</th>
                                        <th width="15%" align="center">Req Qty</th>
                                        <th width="5%" align="center"></th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                    <?php
                                    $k = 0;
                                    if(!empty($components_info)){
                                        foreach ($components_info as $singlerequriedcomponent) {

                                            $requiredqty = $singlerequriedcomponent['qty'];
                                            $checkwarehousedet = $this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='" . $singlerequriedcomponent["product_id"] . "' AND `service_type`='" . $challan_info->service_type . "' AND `store` = 1 AND `stock_type` = 1 AND (`warehouse_id`=" . $challan_info->warehouse_id . ")  AND (staff_id = 0 || staff_id = '".get_staff_user_id()."')")->row_array();
                                            $availableqty = 0;
                                            if ($checkwarehousedet['totalqty'] > 0) {
                                                $availableqty = $checkwarehousedet['totalqty'];
                                            }

                                            ?>
                                            <tr class="main" id="tr<?php echo $k; ?>">
                                                <!-- <td align="left">
                                                    <div class="form-group"><input type="hidden" name="componentdata[<?php echo $k; ?>][componentid]" value="<?php echo $singlerequriedcomponent['product_id']; ?>"><?php echo value_by_id('tblproducts',$singlerequriedcomponent['product_id'],'name'); ?></div>
                                                </td> -->
                                                <td align="left">
                                                    <div class="form-group">
                                                        <select style="display: block !important;" class="form-control selectpicker" id="componnetid" onchange="getprostock(this.value, <?php echo $k; ?>)" name="componentdata[<?php echo $k; ?>][componentid]" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                                if (isset($item_data) && count($item_data) > 0) {
                                                                    foreach ($item_data as $unit_key => $component_value) {
                                                                        $selectedcls = ($singlerequriedcomponent['product_id'] == $component_value['id']) ? 'selected=""':'';
                                                            ?>
                                                                        <option value="<?php echo $component_value['id'] ?>" <?php echo $selectedcls; ?>><?php echo cc($component_value['sub_name']).product_code($component_value['id']); ?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>    
                                                <td class="procode_<?php echo $k; ?>"><?php echo product_code($singlerequriedcomponent['product_id']); ?></td>
                                                <td class="prolink_<?php echo $k; ?>"><a target="_blank" href="<?php echo admin_url("product_new/view/".$singlerequriedcomponent['product_id']); ?>">View</a></td>
                                                <td width="10%" align="center"><input class="form-control" id="avabqty<?php echo $k; ?>"  type="text" name="componentdata[<?php echo $k; ?>][availableqty]" value="<?php echo $availableqty; ?>"></td>
                                                <td width="15" align="center"><input class="form-control" type="text" id="reqqty<?php echo $k; ?>" name="componentdata[<?php echo $k; ?>][requiredqty]" value="<?php echo $requiredqty; ?>"></td>

                                                <td width="5%">
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removecomponent(<?php echo $k; ?>);" ><i class="fa fa-remove"></i></button>
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
							<div class="col-xs-12">
								<label class="label-control subHeads"><a class="addmorecomp" value="<?php echo (!empty($k)) ? $k : 1; ?>">Add More Item<i class="fa fa-plus"></i></a></label>
							</div>
                            </div>

                            <div  class="col-md-12">
                                <div class="form-group">
                                    <label for="note" class="control-label">Note</label>
                                    <textarea class="form-control tinymce" name="note" id="note"><?php echo $challan_info->note; ?></textarea>
                                </div>
                            </div>


                            <div  class="col-md-12" style="margin-top:50px;">
                                <div class="form-group">
                                    <label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label>
                                    <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions"><?php echo $challan_info->terms_and_conditions; ?></textarea>
                                </div>
                            </div>





                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <!--<button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Update Challan</button>-->
                                <a href="javascript:void(0);" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">Update Challan</a>
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


    <script>

        function removecomponent(procompid)
		{
			$('#tr' + procompid).remove();
		}

        function getprostock(proid,value) {

            var procode = 'PRO-'+proid;
            var prolink = "<?php echo admin_url("product_new/view/")?>"+proid;
            $(".procode_"+value).html(procode);
            $(".prolink_"+value).html('<a target="_blank" href="'+prolink+'">View</a>');

            var warehouseid='<?php echo $challan_info->warehouse_id;?>';
            var service_type='<?php echo $challan_info->service_type;?>';
            var url = '<?php echo base_url(); ?>admin/Site_manager/getprostock';
            $.post(url,
                    {
                        proid: proid,
                        warehouseid: warehouseid,
                        service_type: service_type,
                    },
                    function (data, status) 
                    {						
                        $('#avabqty'+value).val(data);
                        $('#pendingqty'+value).val('0');
                    });
        }
        
		function statuschange(value,val) {
			if(value==1)
			{
				$('#pendingqty'+val).val(0);
				$('#deliverableqty'+val).val($('#reqqty'+val).val());
			}
		}
			function getdeliverableqty(value,val) {
			var requiredqty =$('#reqqty'+val).val();
			if ((value !== '') && (value.indexOf('.') === -1))
			{
				$('#pendingqty'+val).val(Math.max(Math.min(value, requiredqty), -requiredqty));
			}
			var value=$('#pendingqty'+val).val();
			var deliverableqty=requiredqty-value;
			$('#deliverableqty'+val).val(deliverableqty);
			if(value==0)
			{
				$('#pendingststatus'+val).val(1);
				$('.selectpicker').selectpicker('refresh');
			}
			else
			{
				$('#pendingststatus'+val).val(0);
				$('.selectpicker').selectpicker('refresh');
			}


			//alert(value);
		}
		function staffdropdown() {
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

		$('.addmorecomp').click(function(){
			 var addmore = parseInt($(this).attr('value'));
            var newaddmore = addmore + 1;
             $(this).attr('value', newaddmore);
			$('#myproTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td align="left"><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="componnetid" onchange="getprostock(this.value,'+newaddmore+')" name="componentdata[' + newaddmore + '][componentid]" data-live-search="true"><option value=""></option><?php
            if (isset($item_data) && count($item_data) > 0) {
                foreach ($item_data as $unit_key => $component_value) {
                    ?><option value="<?php echo $component_value['id'] ?>" ><?php echo cc($component_value['sub_name']).product_code($component_value['id']); ?></option><?php
                }
            }
            ?></select></div></td><td class="procode_'+newaddmore+'"></td><td class="prolink_'+newaddmore+'"></td><td width="10%" align="center"><input class="form-control" id="avabqty' + newaddmore + '"  type="text" name="componentdata[' + newaddmore + '][availableqty]" ></td><td width="10" align="center"><input type="text" id="reqqty'+newaddmore+'" name="componentdata['+newaddmore+'][requiredqty]" class="form-control" value="1"></td><td width="5%"><button type="button" class="btn pull-right btn-danger"  onclick="removecomponent(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');
	$('.selectpicker').selectpicker('refresh');		
		});

        $('.addmoreproduct').click(function(){
             var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
            $('#productTable tbody').append('<tr class="main" id="ptr'+newaddmore+'"><td width="25%" align="left"><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" onchange="getprostock(this.value,'+newaddmore+')" name="productdata[' + newaddmore + '][product_id]" data-live-search="true"><option value=""></option><?php
if (isset($item_data) && count($item_data) > 0) {
    foreach ($item_data as $unit_key => $component_value) {
        ?><option value="<?php echo $component_value['id'] ?>" ><?php echo cc($component_value['sub_name']) ?></option><?php
    }
}
?></select></div></td><td width="15" align="center"><input class="form-control" type="text" id="reqqty'+newaddmore+'" name="productdata['+newaddmore+'][product_qty]" value="1"></td><td width="5%"><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
        });

        function removeproduct(procompid)
        {
            $('#ptr' + procompid).remove();
        }
    </script>

<script type="text/javascript">
    $(document).on('click', '.get_components', function() {

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/chalan/get_components",
            data    : $('#proposal-form').serialize(),
            success : function(response){
                if(response != ''){
                    $("#component_table_div").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
            })

    });
</script>
<script>
        $(".transaction-submit").on("click", function(event){
            event.preventDefault();
            var assign_val = $("#assign").val();
            if (assign_val == ""){
                $(".assign_error").html("Please assign parson select first");
            }else{
                $("#proposal-form").submit();
            }
        });
    </script>
</body>
</html>
