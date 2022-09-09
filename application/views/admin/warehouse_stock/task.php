<?php
$getavailability=json_decode($_POST['availablestockarray'],true);
$yy=array_column($getavailability['table'], 'component');
foreach($yy as $single)
{
	echo $single['component_id'];
}
$result = call_user_func_array("array_merge", $yy);
foreach($result as $singleresult)
{
	$name=$singleresult['component_name'];
	$requiredqty=$singleresult['requiredqty'];
	if($checkwarehousedet['totalqty']>0){$availableqty=$checkwarehousedet['totalqty'];}else{$availableqty=0;}
	$remainingqty=$availableqty-$requiredqty;
	if(in_array($name,$compid))
	{
		$table=array_column($result,'component_name');
		$tt= array_search($name,$table);
		unset($result[$tt]);
	}
	$compid[]=$singleresult['component_name'];
}

 init_head(); 


?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
			<?php echo form_open_multipart(admin_url('tasks/task/'),array('id'=>'task-form')); ?>           
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
						<div class="row">
							<div class="col-md-12">
							   <?php
								  $rel_type = '';
								  $rel_id = '';
								  if(isset($task) || ($this->input->get('rel_id') && $this->input->get('rel_type'))){
									  $rel_id = isset($task) ? $task->rel_id : $this->input->get('rel_id');
									  $rel_type = isset($task) ? $task->rel_type : $this->input->get('rel_type');
								   }
								   if(isset($task) && $task->billed == 1){
									 echo '<div class="alert alert-success text-center no-margin">'._l('task_is_billed','<a href="'.admin_url('invoices/list_invoices/'.$task->invoice_id).'" target="_blank">'.format_invoice_number($task->invoice_id)). '</a></div><br />';
								   }
								  ?>
							   <?php if(isset($task)){ ?>
							   <div class="pull-right mbot10 task-single-menu task-menu-options">
								  <div class="content-menu hide">
									 <ul>
										<?php if(has_permission('tasks','','create')){ ?>
										<?php
										   $copy_template = "";
										   if(total_rows('tblstafftaskassignees',array('taskid'=>$task->id)) > 0){
											 $copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_assignees' id='copy_task_assignees' checked><label for='copy_task_assignees'>"._l('task_single_assignees')."</label></div>";
										   }
										   if(total_rows('tblstafftasksfollowers',array('taskid'=>$task->id)) > 0){
											 $copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_followers' id='copy_task_followers' checked><label for='copy_task_followers'>"._l('task_single_followers')."</label></div>";
										   }
										   if(total_rows('tbltaskchecklists',array('taskid'=>$task->id)) > 0){
											$copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_checklist_items' id='copy_task_checklist_items' checked><label for='copy_task_checklist_items'>"._l('task_checklist_items')."</label></div>";
										   }
										   if(total_rows('tblfiles',array('rel_id'=>$task->id,'rel_type'=>'task')) > 0){
											$copy_template .= "<div class='checkbox checkbox-primary'><input type='checkbox' name='copy_task_attachments' id='copy_task_attachments'><label for='copy_task_attachments'>"._l('task_view_attachments')."</label></div>";
										   }

										   $copy_template .= "<p>"._l('task_status')."</p>";
										   $task_copy_statuses = do_action('task_copy_statuses',$task_statuses);
										   foreach($task_copy_statuses as $copy_status){
										   $copy_template .= "<div class='radio radio-primary'><input type='radio' value='".$copy_status['id']."' name='copy_task_status' id='copy_task_status_".$copy_status['id']."'".($copy_status['id'] == do_action('copy_task_default_status',1) ? ' checked' : '')."><label for='copy_task_status_".$copy_status['id']."'>".$copy_status['name']."</label></div>";
										   }

										   $copy_template .= "<div class='text-center'>";
										   $copy_template .= "<button type='button' data-task-copy-from='".$task->id."' class='btn btn-success copy_task_action'>"._l('copy_task_confirm')."</button>";
										   $copy_template .= "</div>";
										   ?>
										<li> <a href="#" onclick="return false;" data-placement="bottom" data-toggle="popover" data-content="<?php echo htmlspecialchars($copy_template); ?>" data-html="true"><?php echo _l('task_copy'); ?></span></a>
										</li>
										<?php } ?>
										<?php if(has_permission('tasks','','delete')){ ?>
										<li>
										   <a href="<?php echo admin_url('tasks/delete_task/'.$task->id); ?>" class="_delete task-delete">
										   <?php echo _l('task_single_delete'); ?>
										   </a>
										</li>
										<?php } ?>
									 </ul>
								  </div>
								  <?php if(has_permission('tasks','','delete') || has_permission('tasks','','create')){ ?>
								  <a href="#" onclick="return false;" class="trigger manual-popover mright5">
								  <i class="fa fa-circle-thin" aria-hidden="true"></i>
								  <i class="fa fa-circle-thin" aria-hidden="true"></i>
								  <i class="fa fa-circle-thin" aria-hidden="true"></i>
								  </a>
								  <?php } ?>
							   </div>
							   <?php } ?>
							   <div class="checkbox checkbox-primary no-mtop checkbox-inline task-add-edit-public">
								  <input type="checkbox" id="task_is_public" name="is_public" <?php if(isset($task)){if($task->is_public == 1){echo 'checked';}}; ?>>
								  <label for="task_is_public" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('task_public_help'); ?>"><?php echo _l('task_public'); ?></label>
							   </div>
							   <div class="checkbox checkbox-primary checkbox-inline task-add-edit-billable">
								  <input type="checkbox" id="task_is_billable" name="billable"
									 <?php if((isset($task) && $task->billable == 1) || (!isset($task) && get_option('task_biillable_checked_on_creation') == 1)) {echo ' checked'; }?>>
								  <label for="task_is_billable"><?php echo _l('task_billable'); ?></label>
							   </div>
							   <div class="task-visible-to-customer checkbox checkbox-inline checkbox-primary<?php if((isset($task) && $task->rel_type != 'project') || !isset($task) || (isset($task) && $task->rel_type == 'project' && total_rows('tblprojectsettings',array('project_id'=>$task->rel_id,'name'=>'view_tasks','value'=>0)) > 0)){echo ' hide';} ?>">
								  <input type="checkbox" id="task_visible_to_client" name="visible_to_client" <?php if(isset($task)){if($task->visible_to_client == 1){echo 'checked';}} ?>>
								  <label for="task_visible_to_client"><?php echo _l('task_visible_to_client'); ?></label>
							   </div>
							   <?php if(!isset($task)){ ?>
							   <a href="#" class="pull-right" onclick="slideToggle('#new-task-attachments'); return false;">
							   <?php echo _l('attach_files'); ?>
							   </a>
							   <div id="new-task-attachments" class="hide">
								  <hr />
								  <div class="row attachments">
									 <div class="attachment">
										<div class="col-md-12">
										   <div class="form-group">
											  <label for="attachment" class="control-label"><?php echo _l('add_task_attachments'); ?></label>
											  <div class="input-group">
												 <input type="file" extension="<?php echo str_replace('.','',get_option('allowed_files')); ?>" filesize="<?php echo file_upload_max_size(); ?>" class="form-control" name="attachments[0]">
												 <span class="input-group-btn">
												 <button class="btn btn-success add_more_attachments p8" type="button"><i class="fa fa-plus"></i></button>
												 </span>
											  </div>
										   </div>
										</div>
									 </div>
								  </div>
							   </div>
							   <?php
								  if($this->input->get('ticket_to_task')) {
									echo form_hidden('ticket_to_task');
								  }
								  } ?>
							   <hr />
							   <?php $value = (isset($task) ? $task->name : ''); ?>
							   <label for="hourly_rate" class="control-label"><?php echo _l('task_add_edit_subject');?></label>
							   <?php //echo render_input('name','task_add_edit_subject',$value); ?>
							   <input type="text" id="name" name="name" required class="form-control" value="<?php echo $value;?>">
							   <div class="task-hours<?php if(isset($task) && $task->rel_type == 'project' && total_rows('tblprojects',array('id'=>$task->rel_id,'billing_type'=>3)) == 0){echo ' hide';} ?>">
								  <?php $value = (isset($task) ? $task->hourly_rate : 0); ?>
								  <?php echo render_input('hourly_rate','task_hourly_rate',$value); ?>
							   </div>
							   <div class="project-details<?php if($rel_type != 'project'){echo ' hide';} ?>">
								  <div class="form-group">
									 <label for="milestone"><?php echo _l('task_milestone'); ?></label>
									 <select name="milestone" id="milestone" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										<option value=""></option>
										<?php foreach($milestones as $milestone){ ?>
										<option value="<?php echo $milestone['id']; ?>" <?php if(isset($task) && $task->milestone == $milestone['id']){echo 'selected'; } ?>><?php echo $milestone['name']; ?></option>
										<?php } ?>
									 </select>
								  </div>
							   </div>
							   <div class="row">
								  <div class="col-md-6">
									 <?php if(isset($task)){
										$value = _d($task->startdate);
										} else if(isset($start_date)){
										$value = $start_date;
										} else {
										$value = _d(date('Y-m-d'));
										}
										$date_attrs = array();
										if(isset($task) && $task->recurring > 0 && $task->last_recurring_date != null) {
										$date_attrs['disabled'] = true;
										}
										?>
									 <?php echo render_date_input('startdate','task_add_edit_start_date',$value, $date_attrs); ?>
								  </div>
								  <div class="col-md-6">
									 <?php $value = (isset($task) ? _d($task->duedate) : ''); ?>
									 <?php echo render_date_input('duedate','task_add_edit_due_date',$value,$project_end_date_attrs); ?>
								  </div>
								  <div class="col-md-6">
									 <div class="form-group">
										<label for="priority" class="control-label"><?php echo _l('task_add_edit_priority'); ?></label>
										<select name="priority" class="selectpicker" id="priority" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										   <?php foreach(get_tasks_priorities() as $priority) { ?>
										   <option value="<?php echo $priority['id']; ?>"<?php if(isset($task) && $task->priority == $priority['id'] || !isset($task) && get_option('default_task_priority') == $priority['id']){echo ' selected';} ?>><?php echo $priority['name']; ?></option>
										   <?php } ?>
										   <?php do_action('task_priorities_select',(isset($task)?$task:0)); ?>
										</select>
									 </div>
								  </div>
								  <div class="col-md-6">
									 <div class="form-group">
										<label for="repeat_every" class="control-label"><?php echo _l('task_repeat_every'); ?></label>
										<select name="repeat_every" id="repeat_every" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										   <option value=""></option>
										   <option value="1-week" <?php if(isset($task) && $task->repeat_every == 1 && $task->recurring_type == 'week'){echo 'selected';} ?>><?php echo _l('week'); ?></option>
										   <option value="2-week" <?php if(isset($task) && $task->repeat_every == 2 && $task->recurring_type == 'week'){echo 'selected';} ?>>2 <?php echo _l('weeks'); ?></option>
										   <option value="1-month" <?php if(isset($task) && $task->repeat_every == 1 && $task->recurring_type == 'month'){echo 'selected';} ?>>1 <?php echo _l('month'); ?></option>
										   <option value="2-month" <?php if(isset($task) && $task->repeat_every == 2 && $task->recurring_type == 'month'){echo 'selected';} ?>>2 <?php echo _l('months'); ?></option>
										   <option value="3-month" <?php if(isset($task) && $task->repeat_every == 3 && $task->recurring_type == 'month'){echo 'selected';} ?>>3 <?php echo _l('months'); ?></option>
										   <option value="6-month" <?php if(isset($task) && $task->repeat_every == 6 && $task->recurring_type == 'month'){echo 'selected';} ?>>6 <?php echo _l('months'); ?></option>
										   <option value="1-year" <?php if(isset($task) && $task->repeat_every == 1 && $task->recurring_type == 'year'){echo 'selected';} ?>>1 <?php echo _l('year'); ?></option>
										   <option value="custom" <?php if(isset($task) && $task->custom_recurring == 1){echo 'selected';} ?>><?php echo _l('recurring_custom'); ?></option>
										</select>
									 </div>
								  </div>
							   </div>
							   <div class="recurring_custom <?php if((isset($task) && $task->custom_recurring != 1) || (!isset($task))){echo 'hide';} ?>">
								  <div class="row">
									 <div class="col-md-6">
										<?php $value = (isset($task) && $task->custom_recurring == 1 ? $task->repeat_every : 1); ?>
										<?php echo render_input('repeat_every_custom','',$value,'number',array('min'=>1)); ?>
									 </div>
									 <div class="col-md-6">
										<select name="repeat_type_custom" id="repeat_type_custom" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										   <option value="day" <?php if(isset($task) && $task->custom_recurring == 1 && $task->recurring_type == 'day'){echo 'selected';} ?>><?php echo _l('task_recurring_days'); ?></option>
										   <option value="week" <?php if(isset($task) && $task->custom_recurring == 1 && $task->recurring_type == 'week'){echo 'selected';} ?>><?php echo _l('task_recurring_weeks'); ?></option>
										   <option value="month" <?php if(isset($task) && $task->custom_recurring == 1 && $task->recurring_type == 'month'){echo 'selected';} ?>><?php echo _l('task_recurring_months'); ?></option>
										   <option value="year" <?php if(isset($task) && $task->custom_recurring == 1 && $task->recurring_type == 'year'){echo 'selected';} ?>><?php echo _l('task_recurring_years'); ?></option>
										</select>
									 </div>
								  </div>
							   </div>
							   <div id="cycles_wrapper" class="<?php if(!isset($task) || (isset($task) && $task->recurring == 0)){echo ' hide';}?>">
								  <?php $value = (isset($task) ? $task->cycles : 0); ?>
								  <div class="form-group recurring-cycles">
									 <label for="cycles"><?php echo _l('recurring_total_cycles'); ?>
									 <?php if(isset($task) && $task->total_cycles > 0){
										echo '<small>' . _l('cycles_passed', $task->total_cycles) . '</small>';
										}
										?>
									 </label>
									 <div class="input-group">
										<input type="number" class="form-control"<?php if($value == 0){echo ' disabled'; } ?> name="cycles" id="cycles" value="<?php echo $value; ?>" <?php if(isset($task) && $task->total_cycles > 0){echo 'min="'.($task->total_cycles).'"';} ?>>
										<div class="input-group-addon">
										   <div class="checkbox">
											  <input type="checkbox"<?php if($value == 0){echo ' checked';} ?> id="unlimited_cycles">
											  <label for="unlimited_cycles"><?php echo _l('cycles_infinity'); ?></label>
										   </div>
										</div>
									 </div>
								  </div>
							   </div>
							   <div class="row">
								  <div class="col-md-6">
									 <div class="form-group">
										<label for="rel_type" class="control-label"><?php echo _l('task_related_to'); ?></label>
										<select name="rel_type" class="selectpicker" id="rel_type" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										   <option value=""></option>
										   <option value="project"
											  <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'project'){echo 'selected';}} ?>><?php echo _l('project'); ?></option>
										   <option value="invoice" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'invoice'){echo 'selected';}} ?>>
											  <?php echo _l('invoice'); ?>
										   </option>
										   <option value="customer"
											  <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'customer'){echo 'selected';}} ?>>
											  <?php echo _l('client'); ?>
										   </option>
										   <option value="estimate" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'estimate'){echo 'selected';}} ?>>
											  <?php echo _l('estimate'); ?>
										   </option>
										   <option value="contract" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'contract'){echo 'selected';}} ?>>
											  <?php echo _l('contract'); ?>
										   </option>
										   <option value="ticket" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'ticket'){echo 'selected';}} ?>>
											  <?php echo _l('ticket'); ?>
										   </option>
										   <option value="expense" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'expense'){echo 'selected';}} ?>>
											  <?php echo _l('expense'); ?>
										   </option>
										   <option value="lead" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'lead'){echo 'selected';}} ?>>
											  <?php echo _l('lead'); ?>
										   </option>
										   <option value="proposal" <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'proposal'){echo 'selected';}} ?>>
											  <?php echo _l('proposal'); ?>
										   </option>
										   <option value="stock" selected <?php if(isset($task) || $this->input->get('rel_type')){if($rel_type == 'stock'){echo 'selected';}} ?>>
											  <?php echo _l('stock'); ?>
										   </option>
										</select>
									 </div>
								  </div>
								  <div class="col-md-6">
									 <div class="form-group<?php if($rel_id == ''){echo ' hide';} ?>" id="rel_id_wrapper">
										<label for="rel_id" class="control-label"><span class="rel_id_label"></span></label>
										<div id="rel_id_select">
										   <select name="rel_id" id="rel_id" class="ajax-sesarch" data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										   <?php if($rel_id != '' && $rel_type != ''){
											  $rel_data = get_relation_data($rel_type,$rel_id);
											  $rel_val = get_relation_values($rel_data,$rel_type);
											  echo '<option value="'.$rel_val['id'].'" selected>'.$rel_val['name'].'</option>';
											  } ?>
										   </select>
										</div>
									 </div>
								  </div>
							   </div>
							   <?php if(isset($task) && $task->status == 5 && (has_permission('create') || has_permission('edit'))){
								  echo render_datetime_input('datefinished','task_finished',_dt($task->datefinished));
								  }
								  ?>
							   <div class="form-group checklist-templates-wrapper<?php if(count($checklistTemplates) == 0 || isset($task)){echo ' hide';}  ?>">
								  <label for="checklist_items"><?php echo _l('insert_checklist_templates'); ?></label>
								  <select id="checklist_items" name="checklist_items[]" class="selectpicker checklist-items-template-select" multiple="1" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex') ?>" data-width="100%" data-live-search="true" data-actions-box="true">
									 <option value="" class="hide"></option>
									 <?php foreach($checklistTemplates as $chkTemplate){ ?>
									 <option value="<?php echo $chkTemplate['id']; ?>">
										<?php echo $chkTemplate['description']; ?>
									 </option>
									 <?php } ?>
								  </select>
							   </div>
							   <div class="form-group">
								  <div id="inputTagsWrapper">
									 <label for="tags" class="control-label"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo _l('tags'); ?></label>
									 <input type="text" class="tagsinput" id="tags" name="tags" value="<?php echo (isset($task) ? prep_tags_input(get_tags_in($task->id,'task')) : ''); ?>" data-role="tagsinput">
								  </div>
							   </div>
							   <?php $rel_id_custom_field = (isset($task) ? $task->id : false); ?>
							   <?php echo render_custom_fields('tasks',$rel_id_custom_field); ?>
							   <hr />
							   <p class="bold"><?php echo _l('task_add_edit_description'); ?></p>
							   <?php echo render_textarea('description','',(isset($task) ? $task->description : ''),array('rows'=>6,'placeholder'=>_l('task_add_description'),'data-task-ae-editor'=>true, !is_mobile() ? 'onclick' : 'onfocus'=>(!isset($task) || isset($task) && $task->description == '' ? 'init_editor(\'.tinymce-task\', {height:200, auto_focus: true});' : '')),array(),'no-mbot','tinymce-task'); ?>
							    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:4% !important;">
									<thead>
										<tr>
											<th width="25%" align="center">Component Name</th>
											<th width="25%" align="center">Required Qty</th>
											<th width="25%" class="qty" align="center">Available Qty</th>
											<th width="25%" align="center">Produce Qty</th>
										</tr>
									</thead>
									<tbody class="ui-sortable" style="font-size:15px;">
							<?php
								foreach($getavailability['table'] as $singleav)
								{			
									$i=0;								
									foreach($singleav['component'] as $singleavailabity)
									{
										$i++;
									if($singleavailabity['remainingqty']<0){$class='style="background:red;color:#fff"';}else{$class='style="background:green;color:#fff"';}
									?>
										<tr class="main" id="tr0">
											<td width="25%" align="left">
												<div class="form-group"><input type="text" readonly class="form-control" name="stockdata[<?php echo $i;?>][component_name]" value="<?php echo $singleavailabity['component_name']?>"><input type="hidden" name="stockdata[<?php echo $i;?>][component_id]" value="<?php echo $singleavailabity['component_id']?>"></div>
											</td>
											<td width="25%" align="center"><input type="text" readonly class="form-control" name="stockdata[<?php echo $i;?>][requiredqty]" value="<?php echo $singleavailabity['requiredqty']?>"></td>
											<td width="25%" align="center"><input type="text" readonly class="form-control" name="stockdata[<?php echo $i;?>][availableqty]" value="<?php echo $singleavailabity['availableqty']?>"></td>
											<td width="25%" align="center"  ><input type="text" class="form-control" <?php // echo $class;?> name="stockdata[<?php echo $i;?>][remainingqty]" value="<?php echo abs($singleavailabity['remainingqty']);?>"></td>
										</tr>
								<?php
									}
								}?>
									</tbody>
							  </table>
							  <div class="col-md-6">
								<div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker warehouse_id" data-live-search="true" id="warehouse_id"  name="warehouse_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($stockdata['warehouse_id']) && $stockdata['warehouse_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo $all_warehouse_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>
								
								<span class="warehouseerror" style="padding:2px;color:red;display:none;"> select any warehouse</span>
								<div class="col-md-6">
								<div class="form-group">
                                    <label for="service_type" class="control-label"><?php echo _l('stock_service_type'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">
                                        <option value=""></option>
                                        <?php
                                        if (isset($service_type) && count($service_type) > 0) {
                                            foreach ($service_type as $service_type_key => $service_type_value) 
											{?>
                                                <option value="<?php echo $service_type_value['id'] ?>" <?php echo (isset($stockdata['service_type']) && $stockdata['service_type'] == $service_type_value['id']) ? 'selected' : "" ?>><?php echo $service_type_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>
							  <div class="form-group">
									<label for="enquiry_date" class="control-label"><?php echo _l('assigned_to'); ?></label>
									<select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
										<option>Select</option>
										
									   
										<?php
										if (isset($allStaffdata) && count($allStaffdata) > 0) {
											foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
												?>
												 <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
												<option value="<?php echo 'group'.$Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
												<?php
												foreach($Staffgroup_value['staffs'] as $singstaff)
												{?>
													<option style="margin-left: 3%;" value="<?php echo 'staff'.$singstaff['staffid'] ?>" <?php if(isset($staffassigndata) && in_array($singstaff['staffid'],$staffassigndata)){echo'selected';}?>><?php echo $singstaff['firstname'] ?></option>
												<?php
												}?>
												</optgroup>
											<?php
											}
										}
										?>
									</select>
								</div>
							
						
						 </div>
						 
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
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
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="product_id" name="componnetdata[' + newaddmore + '][product_id]" data-live-search="true" onchange="get_comp_det(' + newaddmore + ',this.value)"><option value=""></option><?php
if (isset($component_data) && count($component_data) > 0) {
    foreach ($component_data as $unit_key => $component_value) { if($component_value['sac_code']!=''){$sac_code='('.$component_value['sac_code'].')';}else{$sac_code='';}
        ?><option value="<?php echo $component_value['id'] ?>" ><?php echo $component_value['name'].' '.$sac_code; ?></option><?php
    }
}
?></select></div></td><td id="view'+newaddmore+'"></td><td><div class="form-group"><input type="text" id="comphsn_code'+newaddmore+'" name="componnetdata['+newaddmore+'][hsn_code]" class="form-control" value=""></div></td><td><div class="form-group"><input type="text" id="compsac_code'+newaddmore+'" name="componnetdata['+newaddmore+'][sac_code]" class="form-control" value=""></div></td><td> <div class="form-group"><input type="number" id="qty" name="componnetdata[' + newaddmore + '][qty]" class="form-control" ></div></td><td><div class="form-group"><textarea id="remarks" name="componnetdata[' + newaddmore + '][remarks]" class="form-control" ></textarea></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
	
	$('.addmorepro').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myproTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><select class="form-control selectpicker" onchange="get_pro_per_cat('+newaddmore+',this.value)" data-live-search="true" id="product_cat_id'+newaddmore+'"><option value=""></option><?php if (isset($procategory) && count($procategory) > 0) { foreach ($procategory as $procategory_key => $procategory_value) {?><option value="<?php echo $procategory_value['id'] ?>"><?php echo $procategory_value['name'] ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" onchange="get_pro_det('+newaddmore+',this.value)" id="product_id'+newaddmore+'" name="productdata['+newaddmore+'][product_id]"><option value=""></option></select></div></td><td id="viewlink'+newaddmore+'"></td><td><div class="form-group"><input type="text" id="hsn_code'+newaddmore+'" name="productdata['+newaddmore+'][hsn_code]" class="form-control" value=""></div></td><td><div class="form-group"><input type="text" id="sac_code'+newaddmore+'" name="productdata['+newaddmore+'][sac_code]" class="form-control" value=""></div></td><td><div class="form-group"><input type="number" id="qty" name="productdata['+newaddmore+'][qty]" class="form-control" ></div></td><td><div class="form-group"><textarea id="remarks'+newaddmore+'" name="productdata['+newaddmore+'][remarks]" class="form-control"></textarea></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }
	function get_stock_type()
	{
		var stock_type=$('#stock_type').val();
		if(stock_type=='1')
		{
			$('.compdv').show();	
			$('.proddv').hide();	
		}
		if(stock_type=='2')
		{
			$('.proddv').show();
			$('.compdv').hide();
		}
		
	}
	
	function get_pro_per_cat(catid,value)
	{
		var product_cat_id = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_pro_per_cat/'+product_cat_id,
            method : 'GET',
            success:function(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    $.each(resArr, function(k, v) {
						html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $(document).find("#product_id"+catid).html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
	}
	function get_pro_det(proid,value)
	{
		var prodid = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_pro_det/'+prodid,
            method : 'GET',
            success:function(res) {
				var data=JSON.parse(res);
				$('#hsn_code'+proid).val(data.hsn_code);
				$('#sac_code'+proid).val(data.sac_code);
				$('#viewlink'+proid).html('<a href="../product/product/'+data.id+'" target="_blank">view</a>');
            }
        });
	}
	function get_comp_det(proid,value)
	{
		var component_id = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_comp_det/'+component_id,
            method : 'GET',
            success:function(res) {
				var data=JSON.parse(res);
				$('#comphsn_code'+proid).val(data.hsn_code);
				$('#compsac_code'+proid).val(data.sac_code);
				$('#view'+proid).html('<a href="../component/component/'+data.id+'" target="_blank">view</a>');
            }
        });
	}
	function staffdropdown()
	{
		$.each($("#assign option:selected"), function(){
		   var select=$(this).val();   
		   $("optgroup."+select).children().attr('selected','selected');
        });
		$('.selectpicker').selectpicker('refresh');
		$.each($("#assign option:not(:selected)"), function(){
		   var select=$(this).val();   
		   $("optgroup."+select).children().removeAttr('selected');
		});
		$('.selectpicker').selectpicker('refresh');
	}
	
</script>
</body>
</html>
