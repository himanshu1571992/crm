<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                           
                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="clearfix mtop20"></div>
                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:4% !important;">
						<thead>
							<tr>
								<th width="30%" align="center">Component Name</th>
								<th width="20%" align="center">Qty</th>
								<th width="15%" class="qty" align="center">Start Time</th>
								<th width="15%" align="center">End Time</th>
								<th width="20%" align="center">Approve</th>
							</tr>
						</thead>
						<tbody class="ui-sortable" style="font-size:15px;">
					<?php
						$stockapprovaldet=$this->db->query("SELECT ms.*,ta.*,ta.id as approvalid,ms.task_id as taskid,tc.name FROM `tblmanagetaskstock` ms LEFT JOIN `tbltaskapprovalstaff` ta ON ms.`id`=ta.`taskid` LEFT JOIN `tblcomponents` tc ON tc.id=ms.`component_id` WHERE ta.staff_id='".get_staff_user_id()."'")->result_array();
						foreach($stockapprovaldet as $singlestockapprovaldet)
						{?>
							<tr class="main" id="tr0">
								<td width="30%" align="left">
									<div class="form-group"><?php echo $singlestockapprovaldet['name']?></div>
								</td>
								<td width="20%" align="center"><?php echo $singlestockapprovaldet['qty']?></td>
								<td width="15%" align="center"><?php echo $singlestockapprovaldet['starttime'] ?></td>
								<td width="15%" align="center"><?php echo $singlestockapprovaldet['endtime'] ?></td>
								<td width="20%">
								<?php 
								if($singlestockapprovaldet['approve_status']==0)
								{?>
								<button type="button" class="btn btn-info" style="margin-top:4%;" data-toggle="modal" data-target="#myModal23">Approve Stock</button>
									<div class="modal fade" id="myModal23" role="dialog">
										<div class="modal-dialog">
										  <!-- Modal content-->
										  <div class="modal-content">
										  <?php echo form_open($this->uri->uri_string(), array('id' => 'stock-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
											<input type="hidden" id="taskid" name="taskid" value="<?php echo $singlestockapprovaldet['taskid'];?>">
											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal">×</button>
											  <h4 class="modal-title">Stock Approval</h4>
											</div>
											<div class="modal-body">
											  <div class="form-group" app-field-wrapper="approvereason">
												<label for="subject" class="control-label">Approve Reason</label>
												<textarea id="approvereason<?php echo $singlestockapprovaldet['approvalid'];?>" name="approvereason" class="form-control" required="true"></textarea>
											  </div>
											  
											</div>
											<div class="modal-footer">
											  <button type="button" class="btn btn-info qtychange" onclick="approvestock('<?php echo $singlestockapprovaldet['approvalid'];?>','1')">Accept</button>
											  <button type="button" class="btn btn-default" onclick="approvestock('<?php echo $singlestockapprovaldet['approvalid'];?>','2')">Decline</button>
											</div>
											<?php echo form_close(); ?>
											</div>
										</div>
									  </div>
									  <?php
								}
								else if($singlestockapprovaldet['approve_status']==1){?>
								<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;"> Accepted</span>
								<?php
								}
								else
								{?>
							<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;"> Decline</span>
							<?php
								}?>
								</td>
					</tr>
					<?php
						}?>
								
					</tbody>
				</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(function () {
        initDataTable('.table-warehouse', admin_url + 'Stock/tablewarehouse',<?php echo do_action('warehouse_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
	function approvestock(approvalid,accept)
	{
		var url = '<?php echo base_url(); ?>admin/Stock/stocktaskapproval';
		var approvereason=$('#approvereason'+approvalid).val();
		var taskid=$('#taskid').val();
		$.post(url,
				{
					approvalid: approvalid,
					approvereason: approvereason,
					taskid: taskid,
					accept: accept
				},
				function (data, status) {
					location. reload(true);
				});
	}
</script>
</body>
</html>
