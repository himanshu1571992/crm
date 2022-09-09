<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase/supplier_rating'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title;  ?></h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                        </div>
                    </div>

					<hr class="hr-panel-heading">
					
					<div class="row">

						<div class="form-group col-md-4">
                            <label for="vendor_id" class="control-label">Select Vendor</label>
                            <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                <option value=""></option>
                                <?php
                                if (isset($vendors_info) && count($vendors_info) > 0) {
                                    foreach ($vendors_info as $vendor_value) {
                                        ?>
                                        <option value="<?php echo $vendor_value['id']; ?>" <?php if(!empty($vendor_id) && $vendor_id == $vendor_value['id']){ echo 'selected'; } ?>><?php echo cc($vendor_value['name']); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

						<div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th> S.No.</th>
										<th>PO No.</th>	
										<th>PO Date</th>
										<th>Supplier Name</th>
										<th>Item Description</th>
                                        <th>PO Qty</th>
                                        <th>Lead Time</th>
                                        <th>Expected <br> Material <br> Receipt Date</th>
                                        <th>Actual <br> Receipt <br> Date</th>
                                        <th>Actual <br> Received <br> Qty</th>
                                        <th>Rejection <br> Qty</th>
                                        <th>On time <br> Delivery <br> Rating</th>
                                        <th>PO Qty <br> Fulfilment <br> Rating</th>
                                        <th>Quality <br> Rating</th>
                                        <th>Overall  <br> Performance</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
                                    $average_overall_performance = 0;
                                    $ttl_overall_rating_percent = 0;
									if(!empty($po_item_list)){
										$z=1;
										foreach($po_item_list as $row){	

								
    											/*$po_number = '--';
    											if($row->po_id > 0){
    												$purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$row->po_id."' ")->row();	
    												$po_number = 'PO-'.$purchase_info->number;
    											}*/
                                                $lead_time = value_by_id_empty('tblvendor',$row->vendor_id,'lead_time');
    											$expectedReceiptDate =  date('Y-m-d', strtotime($row->date. ' + '.$lead_time.' days'));

                                                $mrDateInfo = $this->db->query("SELECT `date` from tblmaterialreceipt where po_id = '".$row->po_id."' order by date desc LIMIT 1 ")->row();  

                                                $receivedQtyInfo = $this->db->query("SELECT mp.qty,mp.reject_qty from tblmaterialreceiptproduct as mp LEFT JOIN tblpurchaseorderproduct as pp ON pp.po_id = mp.po_id where  mp.product_id = '".$row->product_id."' and mp.po_id = '".$row->po_id."' GROUP by mp.id ")->result(); 
                                                $received_qty = 0;  
                                                $reject_qty = 0;  
                                                if(!empty($receivedQtyInfo)){
                                                    foreach ($receivedQtyInfo as $val) {
                                                        $received_qty += $val->qty;  
                                                        $reject_qty += $val->reject_qty; 
                                                    }
                                                }

                                                //Getting On Time Delivery Rating
                                                $delivery_rating_percent = '0.00';
                                                if(!empty($mrDateInfo)){
                                                    $exta_days = dateDiffInDays($expectedReceiptDate,$mrDateInfo->date);
                                                    $delivery_rating = ($lead_time > 0) ? ($lead_time/$exta_days)*100 : 0;
                                                    $delivery_rating_percent = number_format($delivery_rating, 2, '.', '');
                                                    if($delivery_rating_percent > 100){
                                                        $delivery_rating_percent = '100.00';
                                                    }
                                                }

                                                //Getting Fulfilment Rating
                                                $fulfilment_rating = ($received_qty/$row->qty)*100;
                                                $fulfilment_rating_percent = number_format($fulfilment_rating, 2, '.', '');
                                                if($fulfilment_rating_percent > 100){
                                                    $fulfilment_rating_percent = '100.00';
                                                }

                                                //Getting  Quality Rating
                                                $quality_rating_percent = '0.00';
                                                if($received_qty > 0){
                                                    $final_receive = ($received_qty-$reject_qty);
                                                    $quality_rating = ($final_receive/$received_qty)*100;
                                                    $quality_rating_percent = number_format($quality_rating, 2, '.', '');
                                                    if($quality_rating_percent > 100){
                                                        $quality_rating_percent = '100.00';
                                                    }
                                                }

                                                //Getting  Overall Rating
                                                $overall_rating_percent = ($delivery_rating_percent+$fulfilment_rating_percent+$quality_rating_percent)/3;
                                                $overall_rating_percent = number_format($overall_rating_percent, 2, '.', '');
                                                $ttl_overall_rating_percent += $overall_rating_percent;
                                                

											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td class="text-center"><?php echo 'PO-'.$row->number;?></td>
												<td class="text-center"><?php echo _d($row->date);?></td>											
												<td class="text-center"><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
												<td class="text-center"><?php echo $row->product_name;?></td>
                                                <td class="text-center"><?php echo number_format($row->qty, 0, '.', '');?></td>
                                                <td class="text-center"><?php echo $lead_time; ?></td>
                                                <td class="text-center"><?php echo _d($expectedReceiptDate); ?></td>
                                                <td class="text-center"><?php echo (!empty($mrDateInfo)) ?  _d($mrDateInfo->date) : '--'; ?></td>
												<td class="text-center"><?php echo $received_qty; ?></td>
                                                <td class="text-center"><?php echo $reject_qty; ?></td>
                                                <td class="text-center"><?php echo $delivery_rating_percent.'%'; ?></td>
                                                <td class="text-center"><?php echo $fulfilment_rating_percent.'%'; ?></td>
                                                <td class="text-center"><?php echo $quality_rating_percent.'%'; ?></td>
                                                <td class="text-center"><?php echo $overall_rating_percent.'%'; ?></td>
											</tr>
											<?php
										}

                                        $average_overall_performance = ($ttl_overall_rating_percent/($z-1));
									}
									?>
									  
									 
									</tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center" colspan="8"><b>Average Overall Performance</b></td>
                                            <td class="text-center" colspan="7"><b><?php echo number_format($average_overall_performance,2).'%';?></b></td>
                                        </tr> 
                                    </tfoot>
								  </table>
							</div>


													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
							
							
						<div class="btn-bottom-toolbar text-right">
                           
                        </div>
                        </div>
                       
                    </div>
                </div>
             
            </form>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Material Receipt Status</h4>
      </div>
      <div class="modal-body" id="approval_html">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="upload_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Material Receipt Uploads</h4>
      </div>
      <div class="modal-body">
        
        <div id="upload_data">
            
        </div>

        <form action="<?php echo admin_url('purchase/mr_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;height: auto;padding: 10px 15px;">
                </div>
                <input type="hidden" id="mr_id" name="mr_id">
            </div>

            <div class="text-right">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>  
        </form>

      </div>
    </div>

  </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


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

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                }
            },
            'colvis'
        ]
    } );
} );
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#month', function(){	
		$("#attendance_form").submit();	
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){	
		if (! $("input[name='staffid[]']").is(":checked")){
		   alert('Please Check Any Checkbox First!');
		   return false;
		}else{
			$("#salary_form").submit();	
		}
		
		
		
	});	
</script> 

<script type="text/javascript">
      $(".myselect").select2();
</script>

<script type="text/javascript">
	$('.status').click(function(){
	var id = $(this).val();
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/purchase/get_mr_status'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
</script> 


<script type="text/javascript">
$(document).on('click', '.uplaods', function() {  

    var id = $(this).val();
    $('#mr_id').val(id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/purchase/get_mr_uploads_data'); ?>",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){       

                $('#upload_data').html(response);  
            }
        }
    })

}); 
</script>

</body>
</html>
