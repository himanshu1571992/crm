<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
						<!-- <div class="_buttons">
							<a href="#__todo" data-toggle="modal" class="btn btn-info">
								<?php echo _l('new_todo'); ?>
							</a>
						</div> -->
						<div class="clearfix"></div>
						<hr class="hr-panel-heading" />
						<div class="row">
							<div class="col-md-6">
								<div class="panel_s events animated fadeIn">
									<div class="panel-body todo-body">
									
											<div class="row todo-title warning-bg"><div class="col-md-9"><i class="fa fa-warning"></i> Follow up pending leads (<?php echo lead_followup_count(0); ?>)</div></div>
											<ul class="list-unstyled todo unfinished-todos todos-sortable">
												<li class="padding no-todos hide ui-state-disabled">
													<?php echo 'Follow up client not found!'; ?>
												</li>
											</ul>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 text-center padding">
											<span class="text-center unfinished-loader"></span>
											<!-- <a href="#" class="btn btn-default text-center unfinished-loader"><?php echo _l('load_more'); ?></a> -->
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="panel_s animated fadeIn">
										<div class="panel-body todo-body">
											
												<div class="row todo-title info-bg"><div class="col-md-9"><i class="fa fa-check"></i> Follow up finished leads (<?php echo lead_followup_count(1); ?>)</div></div>
												<ul class="list-unstyled todo finished-todos todos-sortable">
													<li class="padding no-todos hide ui-state-disabled">
														<?php echo 'Follow up finished client not found!'; ?>
													</li>
												</ul>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-center padding">
												<span class="text-center finished-loader"></span>
												<!-- <a href="#" class="btn btn-default text-center finished-loader">
													<?php echo _l('load_more'); ?>
												</a> -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/todos/_todo.php'); ?>
<?php init_tail(); ?>
<script>
	$(function(){
		var total_pages_unfinished = '<?php echo $total_pages_unfinished; ?>';
		var total_pages_finished = '<?php echo $total_pages_finished; ?>';
		var page_unfinished = 0;
		var page_finished = 0;
		$('.unfinished-loader').on('click', function(e) {
			e.preventDefault();
			if (page_unfinished <= total_pages_unfinished) {
				$.post(window.location.href, {
					finished: 0,
					todo_page: page_unfinished
				}).done(function(response) {
					response = JSON.parse(response);
					if (response.length == 0) {
						$('.unfinished-todos .no-todos').removeClass('hide');
					}

					$.each(response, function(i, obj) {
						$('.unfinished-todos').append(render_li_items(0, obj));
					});
					page_unfinished++;
				});

				if (page_unfinished >= total_pages_unfinished - 1) {
					$(".unfinished-loader").addClass("disabled");
				}
			}
		});

		$('.finished-loader').on('click', function(e) {
			e.preventDefault();
			if (page_finished <= total_pages_finished) {
				$.post(window.location.href, {
					finished: 1,
					todo_page: page_finished
				}).done(function(response) {
					response = JSON.parse(response);

					if (response.length == 0) {
						$('.finished-todos .no-todos').removeClass('hide');
					}
					$.each(response, function(i, obj) {
						$('.finished-todos').append(render_li_items(1, obj));
					});

					page_finished++;
				});

				if (page_finished >= total_pages_finished - 1) {
					$(".finished-loader").addClass("disabled");
				}
			}
		});
		$('.unfinished-loader').click();
		$('.finished-loader').click();
	});

	function render_li_items(finished, obj) {
		var todo_finished_class = '';
		var checked = '';
		if (finished == 1) {
			todo_finished_class = ' line-throught';
			checked = 'checked';
		}
		//this variable is useless
		var item_order = 2;
		return '<li><div class="media"><div class="media-left no-padding-right"><div class="dragger todo-dragger"></div> <input type="hidden" value="' + finished + '" name="finished"><input type="hidden" value="' + item_order + '" name="todo_order"><input type="hidden" value="2" name="for"><div class="checkbox checkbox-default todo-checkbox"><input type="checkbox" val="2" name="todo_id" value="' + obj.id + '" '+checked+'><label></label></div></div> <div class="media-body"><p class="todo-description' + todo_finished_class + ' no-padding-left"><a target="_blank" href="<?php echo base_url("admin/follow_up/lead_activity/")?>'+ obj.lead_id +'">' + obj.description + '</a></p><small class="todo-date">' + obj.date + '</small></div></div></li>';
	}
</script>
</body>
</html>
