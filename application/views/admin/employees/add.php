<?php init_head(); ?>
<style>#adminnote{margin: 0px 13.5px 0px 0px;height: 128px;width: 509px;}.error{border:1px solid red !important;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<!-- <input id="check_gst" type='hidden' value="<?php if(isset($invoice->is_gst)){if ($invoice->is_gst == 1){echo'1';}else{echo'0';}}else{if($clientsate == get_staff_state()){echo'1';}else{echo'0';}} ?>"> -->

<div id="wrapper">
    <div class="content accounting-template">
	<a data-toggle="modal" id="modal" data-target="#myModal"></a>

        <div class="row">
        	<?php
        	echo form_open($this->uri->uri_string(),array('id'=>'invoice-form','class'=>''));
        	?>
			<div class="panel_s invoice accounting-template">
			  <div class="panel-body">
			  	<h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
				<div class="row">
				 <div class="col-md-12">
					<div class="panel_s no-shadow">

					   <div class="row">

					   	<div class="form-group col-md-3">
							  <?php
							  $value = date('d/m/Y');
							  if(isset($work_info)){
								$value = _d($work_info->date);
							  }
							   ?>
							  <?php echo render_date_input('date','Date',$value); ?>
						</div>	
                        
						<div class="col-md-12">
							
														
								<div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop transporttable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 5%;"><i class="fa fa-cog"></i></td>
                                                    <td style="width: 15%;">Project</td>
                                                    <td style="width: 15%;">Module</td>                                                                                                   
                                                    <td style="width: 10%;">Start Time</td>                                                                                                   
                                                    <td style="width: 10%;">End Time</td>                                                                                                   
                                                    <td style="width: 45%;">Description</td>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
                                            	if (!empty($workListInfo)) {
                                            		$i = 0;
                                            		foreach ($workListInfo as $row) {
                                            		?>
                                            		<tr class="trtrans<?php echo $i; ?>">
														<td><button required="" type="button" class="btn btn-danger" onclick="removetransport(<?php echo $i; ?>);"><i class="fa fa-remove"></i></button></td>
														<td><input required="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][project]" value="<?php echo $row['project']; ?>" /></td>
														<td><input required="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][module]" value="<?php echo $row['module']; ?>" /></td>
														<td><input required="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][start_time]" value="<?php echo $row['start_time']; ?>" /></td>
														<td><input required="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][end_time]" value="<?php echo $row['end_time']; ?>" /></td>
														<td><textarea required="" name="saleproposal[<?php echo $i; ?>][description]" class="form-control"><?php echo $row['description']; ?></textarea></td>

													</tr>
                                            		<?php
                                            		$i++;
                                            		}
                                            	}else{
                                            	?>
                                            	<tr class="trtrans0">
                                            		<td><button type="button" class="btn btn-danger" onclick="removetransport(0);"><i class="fa fa-remove"></i></button></td>
                                            		<td><input type="text" class="form-control" required="" name="saleproposal[0][project]" /></td>
                                            		<td><input type="text" class="form-control" required="" name="saleproposal[0][module]" /></td>
                                            		<td><input type="text" class="form-control" required="" name="saleproposal[0][start_time]" /></td>
                                            		<td><input type="text" class="form-control" required="" name="saleproposal[0][end_time]" /></td>
                                            		<td><textarea name="saleproposal[0][description]" required="" class="form-control"></textarea></td>											
													
												</tr>
                                            	<?php	
                                            	}
                                            	?>												
                                            </tbody>
                                        </table>
                                        <div class="col-xs-12">
                                            <label class="label-control subHeads"><a class="addmoretransport" value="<?php echo (!empty($workListInfo)) ? count($workListInfo) : 0; ?>">Add More <i class="fa fa-plus"></i></a></label>
                                        </div>
                                    </div>
                                </div>

							
                         



                            </div>

					   </div>


					</div>

				 </div>

				</div>
				<div class="btn-bottom-toolbar bottom-transaction text-right">
                    <button type="submit" class="btn btn-info mleft10 ">
                        Save
                    </button>
                </div>
			  </div>

			</div>
			



            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">

   



	$('.addmoretransport').click(function ()
    {
		var addmorerentpro = parseInt($(this).attr('value'));
        var newaddmorerentpro = addmorerentpro + 1;
        $(this).attr('value', newaddmorerentpro);
		$('.transporttable tbody').append('<tr class="trtrans' + newaddmorerentpro + '"><td><button type="button" class="btn btn-danger" onclick="removetransport(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><input type="text" required="" class="form-control" name="saleproposal[' + newaddmorerentpro + '][project]" /></td><td><input type="text" required="" class="form-control" name="saleproposal[' + newaddmorerentpro + '][module]" /></td><td><input type="text" required="" class="form-control" name="saleproposal[' + newaddmorerentpro + '][start_time]" /></td><td><input type="text" required="" class="form-control" name="saleproposal[' + newaddmorerentpro + '][end_time]" /></td><td><textarea required="" name="saleproposal[' + newaddmorerentpro + '][description]" class="form-control"></textarea></td></tr>');
	});
	function removetransport(value) 
	{
        $('.trtrans' + value).remove();
		get_total_price_per_qty_sale(value);
	}
    


</script>


</body>
</html>
