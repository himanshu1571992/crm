<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
			<input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id;?>">
			<input type="hidden" name="service_type" value="<?php echo $service_type;?>">
            <div class="col-md-12">
				
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body" id="stockavdv">
                            <input type="hidden" name="rel_type" value="<?php echo $rely_type; ?>">
                            <input type="hidden" name="rel_id" value="<?php echo $rel_id; ?>">
                            <input type="hidden" name="is_sale" value="<?php echo $is_sale; ?>">
							<a href="<?php echo admin_url('Stock/transferpdf/' . $stock_transfer['id']);?>" class="btn btn-default action-btn download mright10" style="float:right;margin-bottom:2%"><i class="fa fa-file-pdf-o"></i> Download</a>
							<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop">
								<tbody class="ui-sortable" style="font-size:15px;">
								<tr>
									<td><b>Transfer Stock No :</b></td>
									<td><?php echo $stock_transfer['transferstockno'];?></td>
									<td><b>Created At :</b></td>
									<td><?php echo _d($stock_transfer['created_at']);?></td>
								</tr>
								<tr>
									<td><b>Transfer From :</b></td>
									<td><?php echo $fromwarehouse;?></td>
									<td><b>Transfer To :</b></td>
									<td><?php echo $towarehouse;?></td>
								</tr>
								<tr >
									<td><b>Service Type :</b></td>
									<td><?php echo $service_type;?></td>
								</tr>
								
								</tbody>
							</table>
                            
                           
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th width="50%" align="center">Component Name</th>
                                        <th width="50%" align="center">Transfer Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                    <?php
                                    $k = 0;
                                    foreach ($stock_transfer_det as $single_stock_transfer_det)
									{?>
                                        <tr class="main" id="tr<?php echo $k;?>">
                                            <td width="50%" align="center"><?php echo $single_stock_transfer_det['name'];?></td>
                                            <td width="50%" align="center"><?php echo $single_stock_transfer_det['transfer_qty'];?></td>
                                        </tr>
                                        <?php
                                        $k++;
                                    }
                                    ?>

                                </tbody>
                            </table>
							<?php
							 $checkchalanapprov=$this->db->query("SELECT * FROM `tbltransferstockapproval` WHERE `stocktransfer_id`='".$stock_transfer['id']."' AND `staffid`='".get_staff_user_id()."'")->row_array();
							 $checkchalanapproval=$this->db->query("SELECT * FROM `tbltransferstockapproval` WHERE `stocktransfer_id`='".$stock_transfer['id']."' AND `staffid`='".get_staff_user_id()."'")->result_array();
							 if(count($checkchalanapproval)>0)
							 {
								 if($checkchalanapprov['approve_status']==1)
								 {?>
								<div class="col-md-12">
									<h4 style="background: #4caf5052;color:green;padding:23px;">Stock Transfer is Allready approved.</h4>
									
								</div>
							<?php
							 }
							 else if($checkchalanapprov['approve_status']==2)
							 {
								 echo'<div class="col-md-12"><h4 style="background: #f4433640;color:green;padding:23px;">Stock Transfer is Allready Declined.</h4></div>';
							 }
							 else
							 {?>
						 <div class="col-md-12 chalandv">
									<h4>Would you like to accept this Stock Transfer?</h4>
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
									<h4 style="background: #4caf5052;color:green;padding:23px;">Stock Transfer approve Successfully.</h4>
									
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
			 var stock_transfer_id = '<?php echo $stock_transfer['id'];?>';
			 var url = '<?php echo base_url(); ?>admin/Site_manager/approvstocktransfer';
			  $.post(url,
					{
						stock_transfer_id: stock_transfer_id,
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
