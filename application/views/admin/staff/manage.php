<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">

				<div class="panel_s">
					<div class="panel-body">
						<?php if(check_permission_page(101,'create')){ ?>
						<div class="_buttons">
							<a href="<?php echo admin_url('staff/member'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new_staff'); ?></a>
							<a href="<?php echo admin_url('staff/ExportStaff'); ?>" class="btn btn-info pull-right display-block"><?php echo 'Export Staff'; ?></a>
						</div>
						<div class="clearfix"></div>
						<hr class="hr-panel-heading" />
						<?php } ?>
						<div class="clearfix"></div>
						<?php
						$table_data = array(
							_l('staff_dt_name'),
							_l('staff_dt_email'),
							'Phone No.',
							'Added By',
							_l('staff_dt_last_Login'),
							_l('staff_dt_active'),
							'Changes Status',
							'Permission',
							);
						$custom_fields = get_custom_fields('staff',array('show_on_table'=>1));
						foreach($custom_fields as $field){
							array_push($table_data,$field['name']);
						}
						render_datatable($table_data,'staff');
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="delete_staff" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<?php echo form_open(admin_url('staff/delete',array('delete_staff_form'))); ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo _l('delete_staff'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="delete_id">
					<?php echo form_hidden('id'); ?>
				</div>
				<p><?php echo _l('delete_staff_info'); ?></p>
				<?php
				echo render_select('transfer_data_to',$staff_members,array('staffid',array('firstname','lastname')),'staff_member',get_staff_user_id(),array(),array(),'','',false);
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-danger _delete"><?php echo _l('confirm'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="approvestatusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Changes Info Status</h4>
            </div>
            <div class="modal-body" id="approval_html">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
	$(function(){
		initDataTable('.table-staff', window.location.href);
	});
	function delete_staff_member(id){
		$('#delete_staff').modal('show');
		$('#transfer_data_to').find('option').prop('disabled',false);
		$('#transfer_data_to').find('option[value="'+id+'"]').prop('disabled',true);
		$('#delete_staff .delete_id input').val(id);
		$('#transfer_data_to').selectpicker('refresh');
	}
	function get_changes_status(id){
            $.ajax({
                    type    : "POST",
                    url     : "<?php echo base_url('admin/staff/get_changes_status'); ?>",
                    data    : {'id' : id},
                    success : function(response){
                            if(response != ''){
                                    $("#approval_html").html(response);
                            }
                    }
            })
	}
        
</script>
<script type="text/javascript">
    $('.status').click(function(){
        
    });
</script>
</body>
</html>
