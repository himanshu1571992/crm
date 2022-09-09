<?php init_head(); ?>

<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 120px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<input id="check_gst" type='hidden' value="0">

<!-- Modal Contact -->



<div id="wrapper">

    <div class="content accounting-template">

        <a data-toggle="modal" id="modal" data-target="#myModal"></a>

        <div class="row">

            

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'mr_form', 'class' => 'proposal-form')); ?>

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-6">

                               

                                <div class="form-group">

                                    <label for="vendor_id" class="control-label">Select Vendor</label>

                                    <select class="form-control selectpicker vendor_id" data-live-search="true" required="" id="vendor_id" name="vendor_id">

                                        <option value=""></option>

                                        <?php

                                        if (isset($vendors_info) && count($vendors_info) > 0) {

                                            foreach ($vendors_info as $vendor_value) {

                                                ?>

                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (!empty($vendor_id) && $vendor_id == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>



                                <div class="form-group">

                                    <label for="po_number" class="control-label">Purchase Order Number</label>

                                    <select class="form-control selectpicker po_number" data-live-search="true" required="" id="po_number" name="po_number">

                                        <option value=""></option>

                                        <?php

                                        if(!empty($po_info)){

                                            echo '<option value="'.$po_info->id.'" selected>'.$po_info->prefix.$po_info->number.' - '._d($po_info->date).'</option>';

                                        }

                                        ?>

                                        

                                    </select>

                                </div>

                                <div class="form-group select-placeholder projects-wrapper<?php

                                if ((!isset($estimate)) || (isset($estimate) && !customer_has_projects($estimate->clientid))) {

                                    echo ' hide';

                                }

                                ?>">

                                    <label for="project_id"><?php echo _l('project'); ?></label>

                                    <div id="project_ajax_search_wrapper">

                                        <select name="project_id" id="project_id" class="projects ajax-search" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">

                                            <?php

                                            if (isset($estimate) && $estimate->project_id != 0) {

                                                echo '<option value="' . $estimate->project_id . '" selected>' . get_project_name_by_id($estimate->project_id) . '</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                   

                                    <div class="col-md-6">

                                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>

                                        <address>

                                            <span class="billing_name">--</span><br>

                                            <span class="billing_street">--</span><br>

                                            <span class="billing_city">--</span>,

                                            <span class="billing_state">--</span>

                                            <br/>

                                            <span class="billing_country">--</span>,

                                            <span class="billing_zip">--</span>

                                        </address>

                                    </div>

                                    <div class="col-md-6">

                                        <p class="bold"><?php echo _l('ship_to'); ?></p>

                                        <address>

                                            <span class="shipping_name">--</span><br>

                                            <span class="shipping_street">--</span><br>

                                            <span class="shipping_city">--</span>,

                                            <span class="shipping_state">--</span>

                                            <br/>

                                            <span class="shipping_country">--</span>,

                                            <span class="shipping_zip">--</span>

                                        </address>

                                    </div>

                                </div>

                                <?php

                                $next_estimate_number = last_purchaseorder();

                                $format = get_option('estimate_number_format');



                                if (isset($estimate)) {

                                    $format = $estimate->number_format;

                                }



                                $prefix = get_option('estimate_prefix');



                                if ($format == 1) {

                                    $__number = $next_estimate_number;

                                    if (isset($estimate)) {

                                        $__number = $estimate->number;

                                        $prefix = '<span id="prefix">' . $estimate->prefix . '</span>';

                                    }

                                } else if ($format == 2) {

                                    if (isset($estimate)) {

                                        $__number = $estimate->number;

                                        $prefix = $estimate->prefix;

                                        $prefix = '<span id="prefix">' . $prefix . '</span><span id="prefix_year">' . date('Y', strtotime($estimate->date)) . '</span>/';

                                    } else {

                                        $__number = $next_estimate_number;

                                        $prefix = $prefix . '<span id="prefix_year">' . date('Y') . '</span>/';

                                    }

                                } else if ($format == 3) {

                                    if (isset($estimate)) {

                                        $yy = date('y', strtotime($estimate->date));

                                        $__number = $estimate->number;

                                        $prefix = '<span id="prefix">' . $estimate->prefix . '</span>';

                                    } else {

                                        $yy = date('y');

                                        $__number = $next_estimate_number;

                                    }

                                } else if ($format == 4) {

                                    if (isset($estimate)) {

                                        $yyyy = date('Y', strtotime($estimate->date));

                                        $mm = date('m', strtotime($estimate->date));

                                        $__number = $estimate->number;

                                        $prefix = '<span id="prefix">' . $estimate->prefix . '</span>';

                                    } else {

                                        $yyyy = date('Y');

                                        $mm = date('m');

                                        $__number = $next_estimate_number;

                                    }

                                }



                                $_estimate_number = str_pad($__number, get_option('number_padding_prefixes'), '0', STR_PAD_LEFT);

                                $isedit = isset($estimate) ? 'true' : 'false';

                                $data_original_number = isset($estimate) ? $estimate->number : 'false';

                                ?>















                                <div class="row">

                                    <div class="col-md-12">



                                        <?php $value = (isset($purchase_info) ? _d($purchase_info['date']) : _d(date('Y-m-d'))); ?>

                                        <?php echo render_date_input('date', 'Material Receipt Date', $value); ?>

                                    </div>

                                </div>



                                

                                <div class="form-group" app-field-wrapper="challan_no">

                                    <label for="challan_no" class="control-label">challan No.</label>

                                    <input type="text" id="challan_no" name="challan_no" class="form-control" value="">

                                </div>



                                

                            </div>

                            <div class="col-md-6">

                                <div class="panel_s no-shadow">

                                  

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="number" class="control-label">MR Number</label>
                                            <input type="text" id="number" name="number" class="form-control" value="<?php echo mr_next_number(); ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <?php $value = (isset($purchase_info) ? $purchase_info['reference_no'] : ''); ?>
                                            <?php echo render_input('reference_no', 'reference_no', $value); ?>
                                        </div>
                                        <div class="col-md-12" style="display:none;">

                                            <?php

                                            $selected = '';

                                            foreach ($staff as $member) {

                                                if (isset($estimate)) {

                                                    if ($estimate->sale_agent == $member['staffid']) {

                                                        $selected = $member['staffid'];

                                                    }

                                                }

                                            }

                                            echo render_select('sale_agent', $staff, array('staffid', array('firstname', 'lastname')), 'sale_agent_string', $selected);

                                            ?>

                                        </div>

                                        <div class="col-md-12" style="margin-bottom:2%;">

                                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>

                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">



                                                <?php

                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {

                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {

                                                        ?>

                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                                            <?php

                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {

                                                                ?>

                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php

                                                                if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {

                                                                    echo'selected';

                                                                }

                                                                ?>><?php echo $singstaff['firstname'] ?></option>

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

                                    <?php $value = (isset($purchase_info) ? $purchase_info['adminnote'] : ''); ?>

                                    <?php //echo render_textarea('adminnote', 'note', $value); ?>



                                    <div class="form-group" app-field-wrapper="adminnote">

                                        <label for="adminnote" class="control-label">Note</label>

                                        <textarea id="adminnote" name="adminnote" class="form-control" style="height: 110px;" rows="5"><?php echo $value; ?></textarea>

                                    </div>



                                    <div class="form-group col-md-6" app-field-wrapper="complete">

                                        <label for="complete" class="control-label">Mark as complete </label>

                                        <input type="checkbox" name="complete" value="1">

                                    </div>



                                    <div class="form-group col-md-6" app-field-wrapper="extrusion">

                                        <label for="extrusion" class="control-label">MR for Extrusion </label>

                                        <input type="checkbox" name="extrusion" id="extrusion" value="1">

                                    </div>



                                    <div class="form-group">

                                        <label for="files" class="control-label"><?php echo 'Attachment File'; ?></label>

                                        <input type="file" id="files" multiple="" name="files[]" style="width: 100%;">

                                    </div>

                                </div>

                            </div>

                           

                            

                        </div>

                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                           <button type="button" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit mr_submit">

                                <?php echo _l('send_for_approval'); ?>

                            </button>

                        </div>

                    </div>

                </div>

            </div>





            <div id="produc_table">

            		



            </div>	

           

           



            



            <?php echo form_close(); ?>

            <?php $this->load->view('admin/invoice_items/item'); ?>

        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

</div>

<?php init_tail(); ?>







<script type="text/javascript">

	$('#vendor_id').change(function(){

	var vendor_id = $(this).val();

		 $.ajax({

			type    : "POST",

			url     : "<?php echo base_url(); ?>admin/Purchase/get_purchase_number",

			data    : {'vendor_id' : vendor_id},

			success : function(response){

				if(response != ''){

					$("#po_number").html(response);

					$('.selectpicker').selectpicker('refresh');

				}

			}

		})

	});

</script> 	







<script type="text/javascript">

	$(document).on('change', '#po_number', function() { 

		var po_id = $(this).val();

		if(po_id > 0){

            var url = '<?php echo base_url(); ?>admin/Purchase/getbillandshipping';

                $.post(url,

                {

                    po_id: po_id,

                },

               function (data, status) {





                        var res = JSON.parse(data);

                        if(res != ''){

                            $('.billing_name').html(res.billing_name);

                            $('.billing_street').html(res.billing_street);

                            $('.billing_state').html(res.billing_state);

                            $('.billing_city').html(res.billing_city);

                            $('.billing_zip').html(res.billing_zip);

                            $('.billing_country').html('India');



                            $('.shipping_name').html(res.shipping_name);

                            $('.shipping_street').html(res.shipping_street);

		                    $('.shipping_state').html(res.shipping_state);

		                    $('.shipping_city').html(res.shipping_city);

		                    $('.shipping_zip').html(res.shipping_zip);

		                    $('.shipping_country').html('India');

                        }

                        

                    });

        }



	});







	$(document).on('change', '#po_number', function() { 

	var po_id = $(this).val();

		 $.ajax({

			type    : "POST",

			url     : "<?php echo base_url(); ?>admin/Purchase/get_product_table",

			data    : {'po_id' : po_id},

			success : function(response){

				if(response != ''){

					$("#produc_table").html(response);

				}

			}

		})

	});







	/*$(document).on('keyup', '.p_id', function() { 

		var qty = parseInt($(this).val());

		var p_id = $(this).attr('val');



		var bal_qty = parseInt($("#product_"+p_id).val());

		

		if(qty > bal_qty){

			alert('Quantity cannot be grater then balance quantity!');

			$(this).val(bal_qty);

		}

	});*/



    $( document ).ready(function() {

        var po_id = $("#po_number").val();

        if(po_id > 0){

            var url = '<?php echo base_url(); ?>admin/Purchase/getbillandshipping';

                $.post(url,

                {

                    po_id: po_id,

                },

               function (data, status) {





                        var res = JSON.parse(data);

                        if(res != ''){

                            $('.billing_name').html(res.billing_name);

                            $('.billing_street').html(res.billing_street);

                            $('.billing_state').html(res.billing_state);

                            $('.billing_city').html(res.billing_city);

                            $('.billing_zip').html(res.billing_zip);

                            $('.billing_country').html('India');



                            $('.shipping_name').html(res.shipping_name);

                            $('.shipping_street').html(res.shipping_street);

                            $('.shipping_state').html(res.shipping_state);

                            $('.shipping_city').html(res.shipping_city);

                            $('.shipping_zip').html(res.shipping_zip);

                            $('.shipping_country').html('India');

                        }

                        

                    });





                $.ajax({

                    type    : "POST",

                    url     : "<?php echo base_url(); ?>admin/Purchase/get_product_table",

                    data    : {'po_id' : po_id},

                    success : function(response){

                        if(response != ''){

                            $("#produc_table").html(response);

                        }

                    }

                })

        }



     }); 

       

</script>





<script type="text/javascript">

    $(function() {

       $(".mr_submit").click(function(){

            

            var assign = $("#assign").val();

            var vendor_id = $("#vendor_id").val();

            var po_number = $("#po_number").val();

            if(assign != ''){

              if(vendor_id != ''){

                if(po_number != ''){





               if($('#extrusion').is(':checked')){

                    $('form#mr_form').submit();

                }else{

                    if (confirm("You sure this MR is not for Extrusion?")){

                        $('form#mr_form').submit();

                    }

                } 



                }else{

                    alert('Please select Purchse order!');

                } 



                }else{

                    alert('Please select vendor!');

                }



            }else{

                alert('Please select assign person!');

            }

                     

       });

    });

</script>

</body>

</html>

