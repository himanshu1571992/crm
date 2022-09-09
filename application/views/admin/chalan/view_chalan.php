<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            
            
		<?php
			$sessiondata = $this->session->userdata();
			$warehouse_id = $estimate->warehouse_id;
			$get_warehouse_details=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$warehouse_id."'")->row_array();
			$warehouse=$get_warehouse_details['name'];
			$service_type = $estimate->service_type;?>
			<input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id;?>">
			<input type="hidden" name="service_type" value="<?php echo $service_type;?>">
            <div class="col-md-12">
				
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body" id="stockavdv">
                            <input type="hidden" name="rel_type" value="<?php echo $rely_type; ?>">
                            <input type="hidden" name="rel_id" value="<?php echo $rel_id; ?>">
                            <input type="hidden" name="is_sale" value="<?php echo $is_sale; ?>">
							<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop">
								<tbody class="ui-sortable" style="font-size:15px;">
								<tr>
									<td><b>Chalan No :</b></td>
									<td><?php echo $chalan['chalanno'];?></td>
									<td><b>Warehouse Selected :</b></td>
									<td><?php echo $warehouse_name;?></td>
								</tr>
								<tr>
									<td><b>Work Order No :</b></td>
									<td><?php echo $chalan['work_no'];?></td>
									<td><b>Work Order Date :</b></td>
									<td><?php echo date('d/m/Y',strtotime($chalan['workdate']));?></td>
								</tr>
								<tr >
									<td><b>Product Name :</b></td>
									<td><?php echo $proname;?></td>
									<td><b>Service Type :</b></td>
									<td><?php echo $servicetype;?></td>
								</tr>
								<tr >
									<td><b><p class="bold"><?php echo _l('invoice_bill_to'); ?></p></b></td>
									<td>
                                        <address>
                                            <span class="billing_street">
                                                <?php $billing_street = (isset($estimate) ? $estimate->billing_street : '--'); ?>
                                                <?php $billing_street = ($billing_street == '' ? '--' : $billing_street); ?>
                                                <?php echo $billing_street; ?></span><br>
                                            <span class="billing_city">
                                                <?php $billing_city = (isset($estimate) ? $estimate->billing_city : '--'); ?>
                                                <?php $billing_city = ($billing_city == '' ? '--' : $billing_city); ?>
                                                <?php echo $billing_city; ?></span>,
                                            <span class="billing_state">
                                                <?php $billing_state = (isset($estimate) ? $estimate->billing_state : '--'); ?>
                                                <?php $billing_state = ($billing_state == '' ? '--' : $billing_state); ?>
                                                <?php echo $billing_state; ?></span>
                                            <br/>
                                           <!--  <span class="billing_country">
                                                <?php 
                                                    $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--');
                                                    $billing_country = ($billing_country == '' ? '--' : $billing_country);
                                                    echo $billing_country; 
                                                ?>
                                            </span>, -->
                                            <span class="billing_zip">
                                                <?php $billing_zip = (isset($estimate) ? $estimate->billing_zip : '--'); ?>
                                                <?php $billing_zip = ($billing_zip == '' ? '--' : $billing_zip); ?>
                                                <?php echo $billing_zip; ?></span>
                                        </address></td>
									<td><b><?php echo _l('ship_to'); ?></b></td>
									<td>
                                        <address>
                                            <span class="shipping_street">
                                                <?php $shipping_street = (isset($estimate) ? $estimate->shipping_street : '--'); ?>
                                                <?php $shipping_street = ($shipping_street == '' ? '--' : $shipping_street); ?>
                                                <?php echo $shipping_street; ?></span><br>
                                            <span class="shipping_city">
                                                <?php $shipping_city = (isset($estimate) ? $estimate->shipping_city : '--'); ?>
                                                <?php $shipping_city = ($shipping_city == '' ? '--' : $shipping_city); ?>
                                                <?php echo $shipping_city; ?></span>,
                                            <span class="shipping_state">
                                                <?php $shipping_state = (isset($estimate) ? $estimate->shipping_state : '--'); ?>
                                                <?php $shipping_state = ($shipping_state == '' ? '--' : $shipping_state); ?>
                                                <?php echo $shipping_state; ?></span>
                                            <br/>
                                            <!-- <span class="shipping_country">
                                                <?php $shipping_country = (isset($estimate) ? get_country_short_name($estimate->shipping_country) : '--'); ?>
                                                <?php $shipping_country = ($shipping_country == '' ? '--' : $shipping_country); ?>
                                                <?php echo $shipping_country; ?></span>, -->
                                            <span class="shipping_zip">
                                                <?php $shipping_zip = (isset($estimate) ? $estimate->shipping_zip : '--'); ?>
                                                <?php $shipping_zip = ($shipping_zip == '' ? '--' : $shipping_zip); ?>
                                                <?php echo $shipping_zip; ?></span>
                                        </address></td>
								</tr>
								</tbody>
							</table>
                            
                           
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th width="20%" align="center">S.no</th>
                                        <th width="50%" align="center">Item Name</th>
                                        <th width="30%" align="center">Deliverable Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                    <?php
                                    $k = 0;
                                    $i = 1;
                                    foreach ($chalan_details as $single_chalan_details)
									{?>
                                        <tr class="main" id="tr<?php echo $k;?>">

                                            <td width="20%" align="center"><?php echo $i++;?></td>
                                            <td width="50%" align="center"><?php echo $single_chalan_details['component_name'];?></td>
                                            <td width="30%" align="center"><?php echo $single_chalan_details['qty'];?></td>
                                           
                                        </tr>
                                        <?php
                                        $k++;
                                    }
                                    ?>

                                </tbody>
                            </table>
							<?php
							 $checkchalanapprov=$this->db->query("SELECT * FROM `tblchallanapproval` WHERE `challan_id`='".$chalan['id']."' AND `staff_id`='".get_staff_user_id()."'")->row_array();
							 $checkchalanapproval=$this->db->query("SELECT * FROM `tblchallanapproval` WHERE `challan_id`='".$chalan['id']."' AND `staff_id`='".get_staff_user_id()."'")->result_array();
							 if(count($checkchalanapproval)>0)
							 {
								 if($checkchalanapprov['approve_status']==1)
								 {?>
								<div class="col-md-12">
									<h4 style="background: #4caf5052;color:green;padding:23px;">Challan is Allready approved.</h4>
									
								</div>
							<?php
							 }
							 else if($checkchalanapprov['approve_status']==2)
							 {
								 echo'<div class="col-md-12"><h4 style="background: #f4433640;color:green;padding:23px;">Challan is Allready Declined.</h4></div>';
							 }
							 else
							 {?>
						 <div class="col-md-12 chalandv">
									<h4>Would you like to accept this Chalan?</h4>
									<div class="text-right">
										<input type="hidden" id="addedfrom" value="1">
										<div class="form-group">
											<textarea id="approval_desc" placeholder="Enter Reason" class="form-control approval_desc" rows="4" enabled="enabled"></textarea>
										</div>
										<button val="52" class="btn btn-success approval" value="1">Accept</button>
										<button val="52" class="btn btn-info approval" value="2">Decline</button>
									</div>
								</div>
								<?php
							 }
							 }?>
							 <div class="col-md-12 successdv" style="display:none;">
									<h4 style="background: #4caf5052;color:green;padding:23px;">Challan approve Successfully.</h4>
									
								</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>
    <script>

        $('#site_id').change(function () {
            var site_id = $('#site_id').val();
            var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
            $.post(url,
                    {
                        site_id: site_id,
                    },
                    function (data, status) {
                        var res = JSON.parse(data);

                        $('.shipping_street').html(res.address);
                        $('#shipping_street').val(res.address);
                        $('.shipping_state').html(res.state_name);
                        $('#shipping_state').val(res.state_name);
                        $('.shipping_city').html(res.city_name);
                        $('#shipping_city').val(res.city_name);
                        $('.shipping_zip').html(res.pincode);
                        $('#shipping_zip').val(res.pincode);
                    });

        });
        $(function () {
            init_currency_symbol();
            // Maybe items ajax search
            init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
            validate_proposal_form();

            $('.rel_id_label').html(_rel_type.find('option:selected').text());
            _rel_type.on('change', function () {
                var clonedSelect = _rel_id.html('').clone();
                _rel_id.selectpicker('destroy').remove();
                _rel_id = clonedSelect;
                $('#rel_id_select').append(clonedSelect);
                proposal_rel_id_select();
                if ($(this).val() != '') {
                    _rel_id_wrapper.removeClass('hide');
                } else {
                    _rel_id_wrapper.addClass('hide');
                }
                $('.rel_id_label').html(_rel_type.find('option:selected').text());
            });
            proposal_rel_id_select();
<?php if (!isset($proposal) && $rel_id != '') { ?>
                _rel_id.change();
<?php } ?>

        });
        /* function proposal_rel_id_select() {
         var serverData = {};
         serverData.rel_id = _rel_id.val();
         data.type = _rel_type.val();
<?php if (isset($proposal)) { ?>
             serverData.connection_type = 'proposal';
             serverData.connection_id = '<?php echo $proposal->id; ?>';
<?php } ?>
         init_ajax_search(_rel_type.val(), _rel_id, serverData);
         }*/
        function validate_proposal_form() {
            _validate_form($('#proposal-form'), {
                subject: 'required',
                proposal_to: 'required',
                rel_type: 'required',
                rel_id: 'required',
                date: 'required',
                email: {
                    email: true,
                    required: true
                },
                currency: 'required',
            });
        }
		function removecomponent(procompid)
		{
			$('#tr' + procompid).remove();
		}
       function getprostock(proid,value) {
		   
			var warehouseid='<?php echo $warehouse_id;?>';
			var service_type='<?php echo $service_type;?>';
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
		$('.approval').click(function(){
			 var approval = parseInt($(this).attr('value'));
			 var approval_desc = $('#approval_desc').val();
			 var chalan_id = '<?php echo $chalan['id'];?>';
			 var url = '<?php echo base_url(); ?>admin/Site_manager/approvchalan';
			  $.post(url,
					{
						chalan_id: chalan_id,
						approval: approval,
						approval_desc: approval_desc,
					},
					function (data, status) 
					{
						$('.successdv').show();
						$('.chalandv').hide();
					});
		});
        
        
	function changeDeliverableQty(product_key) {
		var pending_qty = $("#pendingqty" + product_key).val();
		var required_qty = $("#reqqty" + product_key).val();
		if ((pending_qty !== '') && (pending_qty.indexOf('.') === -1)) 
		{
			$('#pendingqty'+product_key).val(Math.max(Math.min(pending_qty, required_qty), -required_qty));
		}
		var pending_qty = $("#pendingqty" + product_key).val();
		var deliverable_qty = parseInt(required_qty) - Math.abs(parseInt(pending_qty));
		$("#deliverable_qty_" + product_key).html("").html(deliverable_qty);
		if(pending_qty==0)
		{
			$('#pendingststatus'+product_key).val(1);
			$('.selectpicker').selectpicker('refresh');
		}
		else
		{
			$('#pendingststatus'+product_key).val(0);
			$('.selectpicker').selectpicker('refresh');
		}
	}
    </script>
</body>
</html>
