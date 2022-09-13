<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase/delivery_performance'); ?>">
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
                            <label for="cient_id" class="control-label">Select Client</label>
                            <select class="form-control selectpicker cient_id" data-live-search="true" id="cient_id" name="cient_id">
                                <option value=""></option>
                                <?php
                                if (isset($client_info) && count($client_info) > 0) {
                                    foreach ($client_info as $client_value) {
                                        ?>
                                        <option value="<?php echo $client_value['userid']; ?>" <?php if(!empty($cient_id) && $cient_id == $client_value['userid']){ echo 'selected'; } ?>><?php echo cc($client_value['client_branch_name']); ?></option>
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
										<th>S.No.</th>
										<th>PO No.</th>	
										<th>PO Date</th>
										<th>Order Type</th>
										<th>Customer Name</th>
                                        <th>Location</th>
                                        <th>Item Description</th>
                                        <th>Order Qty</th>
                                        <th>Lead Time</th>
                                        <th>Expected Date<br> of Delivery</th>
                                        <th>Dispatched<br> Qty</th>
                                        <th>Actual date <br> of dispatch</th>

                                        <th>On time </th>
                                        <th>Qty</th>
                                        <th>Overall</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
                                    $average_overall_performance = 0;
                                    $ttl_overall_rating_percent = 0;
									if(!empty($estimate_list)){
										$z=1;
										foreach($estimate_list as $row){


                                            $challan_ids = '0';
                                            $proforma_challan_info = $this->db->query("SELECT id FROM `tblproformachalan` where rel_id = '".$row->id."'")->result();
                                            if(!empty($proforma_challan_info)){
                                                foreach($proforma_challan_info as $proforma_challan){
                                                    $info = $this->db->query("SELECT id FROM `tblchalanmst` where rel_type = 'proforma_challan' and rel_id = '".$proforma_challan->id."' and process > 0 ")->row();
                                                    if(!empty($info)){
                                                        $challan_ids .= ','.$info->id;
                                                    }
                                                }
                                            }	

								
    										//$challan_info = $this->db->query("SELECT * from tblchalanmst where rel_id = '".$row->id."' and process > 0  ")->result(); 
                                            $challan_info = $this->db->query("SELECT * from tblchalanmst where id IN (".$challan_ids.")  ")->result(); 
                                            
                                            
                                            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$row->clientid."' ")->row();
                                            $lead_time = dateDiffInDays($row->date,$row->expected_date_of_delivery);
                                               
                                            if(!empty($challan_info)){
                                                foreach ($challan_info as  $challan) {
                                                    if(!empty($challan)){
                                                        $challan_delivery_info = $this->db->query("SELECT * from tblchallanprocess where chalan_id = '".$challan->id."' and `for` = 1  ")->row(); 
                                                    }
                                                    $product_info = json_decode($challan->product_json);

                                                    $shipto_info = get_ship_to_array($challan->site_id);
                                                    
                                                    if(!empty($product_info) && !empty($challan_delivery_info)){
                                                        foreach ($product_info as  $product) {

                                                            $order_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblitems_in` WHERE `rel_type` LIKE 'estimate' and rel_id = '".$row->id."' and pro_id = '".$product->product_id."'  ")->row()->ttl_qty;

                                                            //Getting Fulfilment Rating
                                                            $fulfilment_rating = ($product->product_qty/$order_qty)*100;
                                                            $fulfilment_rating_percent = number_format($fulfilment_rating, 2, '.', '');
                                                            if($fulfilment_rating_percent > 100){
                                                                $fulfilment_rating_percent = '100.00';
                                                            }

                                                            //Getting On Time Delivery Rating
                                                            $delivery_rating_percent = '0.00';
                                                            if($challan_delivery_info->date > $row->expected_date_of_delivery){
                                                                $exta_days = dateDiffInDays($row->expected_date_of_delivery,$challan_delivery_info->date);
                                                                $delivery_rating = ($exta_days/$lead_time)*100;
                                                                $delivery_rating_percent = number_format($delivery_rating, 2, '.', '');
                                                                if($delivery_rating_percent > 100){
                                                                    $delivery_rating_percent = '100.00';
                                                                }
                                                            }else{
                                                                $delivery_rating_percent = '100.00';
                                                            }

                                                             //Getting  Overall Rating
                                                            $overall_rating_percent = ($delivery_rating_percent+$fulfilment_rating_percent)/2;
                                                            $overall_rating_percent = number_format($overall_rating_percent, 2, '.', '');

                                                            $ttl_overall_rating_percent += $overall_rating_percent;

                                                            ?>                                                                                      
                                                            <tr>
                                                                <td><?php echo $z++;?></td>
                                                                <td class="text-center"><?php echo $challan->work_no;?></td>
                                                                <td class="text-center"><?php echo _d($challan->workdate);?></td>                                           
                                                                <td class="text-center"><?php echo ($challan->service_type == 2) ? 'Sales' : 'Rental'; ?></td>
                                                                <td class="text-center"><?php echo (!empty($client_info)) ?  $client_info->client_branch_name : '--'; ?></td>
                                                                <td class="text-center"><?php echo $shipto_info['city'].', '.$shipto_info['state']; ?></td>
                                                                <td class="text-center"><?php echo cc(value_by_id('tblproducts',$product->product_id,'sub_name'));?></td>
                                                                <td class="text-center"><?php echo $order_qty;?></td>
                                                                <td class="text-center"><?php echo $lead_time; ?></td>
                                                                <td class="text-center"><?php echo _d($row->expected_date_of_delivery); ?></td>
                                                                <td class="text-center"><?php echo $product->product_qty;?></td>
                                                                <td class="text-center"><?php echo _d($challan_delivery_info->date); ?></td>
                                                                <td class="text-center"><?php echo $delivery_rating_percent.'%'; ?></td>
                                                                <td class="text-center"><?php echo $fulfilment_rating_percent.'%'; ?></td>
                                                                <td class="text-center"><?php echo $overall_rating_percent.'%'; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                
                                                }
                                            }
											
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
