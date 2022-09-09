<?php

        if (!empty($task_info) OR !empty($task_byinfo)){
    ?>
<div class="widget" id="widget-<?php echo basename(__FILE__,".php"); ?>" data-name="<?php echo _l('user_widget'); ?>">
   <div class="panel_s user-data">
      <div class="panel-body home-activity">
         <div class="widget-dragger"></div>
<!--         <div class="horizontal-scrollable-tabs">
            <div class="scroller scroller-left arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="scroller scroller-right arrow-right"><i class="fa fa-angle-right"></i></div>
            <div class="horizontal-tabs">
               <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                  <li role="presentation" class="active">
                     <a href="#home_tab_tasks" aria-controls="home_tab_tasks" role="tab" data-toggle="tab">
                        <i class="fa fa-tasks menu-icon"></i> <?php echo _l('home_my_tasks'); ?>
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#home_my_projects" onclick="init_table_staff_projects(true);" aria-controls="home_my_projects" role="tab" data-toggle="tab">
                     <i class="fa fa-bars menu-icon"></i> <?php echo _l('home_my_projects'); ?>
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#home_my_reminders" onclick="initDataTable('.table-my-reminders', admin_url + 'misc/my_reminders', undefined, undefined,undefined,[2,'asc']);" aria-controls="home_my_reminders" role="tab" data-toggle="tab">
                     <i class="fa fa-clock-o menu-icon"></i> <?php echo _l('my_reminders'); ?>
                     <?php
                        $total_reminders = total_rows('tblreminders',
                          array(
                           'isnotified'=>0,
                           'staff'=>get_staff_user_id(),
                        )
                        );
                        if($total_reminders > 0){
                          echo '<span class="badge">'.$total_reminders.'</span>';
                        }
                        ?>
                     </a>
                  </li>
                  <?php if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
                  <li role="presentation">
                     <a href="#home_tab_tickets" onclick="init_table_tickets(true);" aria-controls="home_tab_tickets" role="tab" data-toggle="tab">
                     <i class="fa fa-ticket menu-icon"></i> <?php echo _l('home_tickets'); ?>
                     </a>
                  </li>
                  <?php } ?>
                  <?php if(is_staff_member()){ ?>
                  <li role="presentation">
                     <a href="#home_announcements" onclick="init_table_announcements(true);" aria-controls="home_announcements" role="tab" data-toggle="tab">
                     <i class="fa fa-bullhorn menu-icon"></i> <?php echo _l('home_announcements'); ?>
                     <?php if($total_undismissed_announcements != 0){ echo '<span class="badge">'.$total_undismissed_announcements.'</span>';} ?>
                     </a>
                  </li>
                  <?php } ?>
                  <?php if(is_admin()){ ?>
                  <li role="presentation">
                     <a href="#home_tab_activity" aria-controls="home_tab_activity" role="tab" data-toggle="tab">
                     <i class="fa fa-window-maximize menu-icon"></i> <?php echo _l('home_latest_activity'); ?>
                     </a>
                  </li>
                  <?php } ?>
               </ul>
               <hr class="hr-panel-heading hr-user-data-tabs" />
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home_tab_tasks">
                     <a href="<?php echo admin_url('tasks/list_tasks'); ?>" class="mbot20 inline-block full-width"><?php echo _l('home_widget_view_all'); ?></a>
                     <div class="clearfix"></div>
                     <div class="_hidden_inputs _filters _tasks_filters">
                        <?php
                           echo form_hidden('my_tasks',true);
                           foreach($task_statuses as $status){
                            $val = 'true';
                            if($status['id'] == 5){
                              $val = '';
                           }
                           echo form_hidden('task_status_'.$status['id'],$val);
                           }
                           ?>
                     </div>
                     <?php $this->load->view('admin/tasks/_table'); ?>
                  </div>
                  <?php if((get_option('access_tickets_to_none_staff_members') == 1 && !is_staff_member()) || is_staff_member()){ ?>
                  <div role="tabpanel" class="tab-pane" id="home_tab_tickets">
                     <a href="<?php echo admin_url('tickets'); ?>" class="mbot20 inline-block full-width"><?php echo _l('home_widget_view_all'); ?></a>
                     <div class="clearfix"></div>
                     <div class="_filters _hidden_inputs hidden tickets_filters">
                        <?php
                           // On home only show on hold, open and in progress
                           echo form_hidden('ticket_status_1',true);
                           echo form_hidden('ticket_status_2',true);
                           echo form_hidden('ticket_status_4',true);
                           ?>
                     </div>
                     <?php echo AdminTicketsTableStructure(); ?>
                  </div>
                  <?php } ?>
                  <div role="tabpanel" class="tab-pane" id="home_my_projects">
                     <a href="<?php echo admin_url('projects'); ?>" class="mbot20 inline-block full-width"><?php echo _l('home_widget_view_all'); ?></a>
                     <div class="clearfix"></div>
                     <?php render_datatable(array(
                        _l('project_name'),
                        _l('project_start_date'),
                        _l('project_deadline'),
                        _l('project_status'),
                        ),'staff-projects',[], [
                        'data-last-order-identifier' => 'my-projects',
                        'data-default-order'  => get_table_last_order('my-projects'),
                        ]);
                        ?>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="home_my_reminders">
                     <a href="<?php echo admin_url('misc/reminders'); ?>" class="mbot20 inline-block full-width">
                     <?php echo _l('home_widget_view_all'); ?>
                     </a>
                     <?php render_datatable(array(
                        _l( 'reminder_related'),
                        _l('reminder_description'),
                        _l( 'reminder_date'),
                        ), 'my-reminders'); ?>
                  </div>
                  <?php if(is_staff_member()){ ?>
                  <div role="tabpanel" class="tab-pane" id="home_announcements">
                     <?php if(is_admin()){ ?>
                     <a href="<?php echo admin_url('announcements'); ?>" class="mbot20 inline-block full-width"><?php echo _l('home_widget_view_all'); ?></a>
                     <div class="clearfix"></div>
                     <?php } ?>
                     <?php render_datatable(array(_l('announcement_name'),_l('announcement_date_list')),'announcements'); ?>
                  </div>
                  <?php } ?>
                  <?php if(is_admin()){ ?>
                  <div role="tabpanel" class="tab-pane" id="home_tab_activity">
                     <a href="<?php echo admin_url('utilities/activity_log'); ?>" class="mbot20 inline-block full-width"><?php echo _l('home_widget_view_all'); ?></a>
                     <div class="clearfix"></div>
                     <div class="activity-feed">
                        <?php foreach($activity_log as $log){ ?>
                        <div class="feed-item">
                           <div class="date">
                              <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($log['date']); ?>">
                              <?php echo time_ago($log['date']); ?>
                              </span>
                           </div>
                           <div class="text">
                              <?php echo $log['staffid']; ?><br />
                              <?php echo $log['description']; ?>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>-->
                              
        <div class="horizontal-scrollable-tabs">
            <div class="scroller scroller-left arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="scroller scroller-right arrow-right"><i class="fa fa-angle-right"></i></div>
            <div class="horizontal-tabs">
               <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                  <li role="presentation" class="active">
                     <a href="#home_tab_tasks" aria-controls="home_tab_tasks" role="tab" data-toggle="tab">
                        <i class="fa fa-tasks menu-icon"></i> <?php echo _l('home_my_tasks'); ?> <span class="badge badge-info" style="background-color: red;color:#fff;"><?php echo (!empty($mytaskcount) && !empty($mytaskcount->ttl_count)) ? $mytaskcount->ttl_count : ''; ?></span>
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#home_my_projects" aria-controls="home_my_projects" role="tab" data-toggle="tab">
                     <i class="fa fa-bars menu-icon"></i> Task Added By Me <span class="badge badge-info" style="background-color: red;color:#fff;"><?php echo (!empty($task_bycount) && !empty($task_bycount->ttl_count)) ? $task_bycount->ttl_count : ''; ?></span>
                     </a>
                  </li>
               </ul>
               <hr class="hr-panel-heading hr-user-data-tabs" />
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home_tab_tasks">
                     <div class="clearfix"></div>
                     <div class="table-responsive" style="margin-bottom:30px;">
                         <table class="table" id="newtable">
                             <thead>
                                 <tr>
                                     <th style="width: 1%" >S.No</th>
                                     <th align="center">Task Title</th>
                                     <th align="center">Repeat</th>
                                     <th align="center">Start / Due Date</th>
                                     <th align="center">Related To</th>
                                     <th align="center">Priority</th>
                                     <th align="center">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    if(!empty($task_info)){
                                        foreach ($task_info as $key => $value) {

                                                $priority = '--';
                                                if($value->priority == 1){
                                                        $priority = 'Low';
                                                }elseif($value->priority == 2){
                                                        $priority = 'Medium';
                                                }elseif($value->priority == 3){
                                                        $priority = 'High';
                                                }elseif($value->priority == 4){
                                                        $priority = 'Urgent';
                                                }


                                                ?>
                                                <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo $value->title; ?></td>
                                                        <td><?php echo ($value->is_repeat == 1) ? 'Yes' : 'No'; ?></td>
                                                        <td><?php if($value->is_repeat == 1){ echo ($value->repeat_type == 1) ? 'Weekly' : 'Monthly'; }else{ echo $value->start_date.' to '.$value->due_date; }  ?></td>
                                                        <td><?php echo value_by_id('tbltaskfor',$value->related_to,'name'); ?></td>
                                                        <td><?php echo $priority; ?></td>
                                                        <td align="center">
                                                            <div class="btn-group open">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <li>
                                                                        <a class="btn-sm" href="<?php echo admin_url('Task/task_details/'.$value->id); ?>">View</a>

                                                                        <a class="btn-sm" target="_blank" href="<?php echo admin_url('Task/activity_log/'.$value->id); ?>">Activity</a>

                                                                        <a class="btn-sm" target="_blank" href="<?php  echo admin_url('reminder/add/0/3'); ?>">Set Reminder</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                </tr>
                                                <?php
                                        }
				    }
                                 ?>
                             </tbody>
                         </table>
                     </div>     
                  </div>
                  <div role="tabpanel" class="tab-pane" id="home_my_projects">
                     <div class="clearfix"></div>
                     <table class="table" id="newtable1">
                        <thead>
                          <tr>
                              <th  style="width: 1%" >S.No</th>
                                <th style="width: 1%" align="center">Task Title</th>
                                <th align="center">Employees</th>
                                <th align="center">Repeat</th>
                                <th align="center">Start / Due Date</th>
                                <th align="center">Related To</th>
                                <th align="center">Priority</th>
                                <th align="center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                                <?php
                                if(!empty($task_byinfo)){
                                        foreach ($task_byinfo as $key => $value) {

                                                $priority = '--';
                                                if($value->priority == 1){
                                                        $priority = 'Low';
                                                }elseif($value->priority == 2){
                                                        $priority = 'Medium';
                                                }elseif($value->priority == 3){
                                                        $priority = 'High';
                                                }elseif($value->priority == 4){
                                                        $priority = 'Urgent';
                                                }

                                                $assignee_info = $this->db->query("SELECT count(id) as staff_count from `tbltaskassignees` where task_id = '".$value->id."' ")->row();

                                                $assignee_ids = $this->db->query("SELECT `staff_id` from `tbltaskassignees` where task_id = '".$value->id."' ")->result();
                                                $assign_name = '';
                                                if(!empty($assignee_ids)){
                                                        foreach ($assignee_ids as $j => $staff_id) {
                                                                if($j == 0){
                                                                        $assign_name = get_employee_name($staff_id->staff_id);
                                                                }else{
                                                                        $assign_name .= ', '.get_employee_name($staff_id->staff_id);
                                                                }

                                                        }

                                                }else{
                                                        $assign_name = '--';
                                                }

                                                ?>
                                                <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo $value->title; ?></td>
                                                        <td><?php echo $assign_name; ?></td>
                                                        <td><?php echo ($value->is_repeat == 1) ? 'Yes' : 'No'; ?></td>
                                                        <td><?php if($value->is_repeat == 1){ echo ($value->repeat_type == 1) ? 'Weekly' : 'Monthly'; }else{ echo $value->start_date.' to '.$value->due_date; }  ?></td>
                                                        <td><?php echo value_by_id('tbltaskfor',$value->related_to,'name'); ?></td>
                                                        <td><?php echo $priority; ?></td>
                                                        <td align="center">
                                                            <div class="btn-group open">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <li>
                                                                        <a class="btn-sm" href="<?php echo admin_url('Task/task_details/'.$value->id); ?>">View</a>
                                                                        <a class="btn-sm" href="<?php echo admin_url('Task/add/'.$value->id); ?>">Edit</a>
                                                                        <a class="btn-sm" target="_blank" href="<?php echo admin_url('Task/activity_log/'.$value->id); ?>">Activity</a>
                                                                        <a class="btn-sm" target="_blank" href="<?php  echo admin_url('reminder/add/0/3'); ?>">Set Reminder</a>
                                                                        <a href="javascript:void(0);" data-value="<?php echo $value->id; ?>" class="btn-sm assignees" data-toggle="modal" data-target="#myModal">Assignees (<?php echo $assignee_info->staff_count; ?>)</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
<!--                                                                <a class="btn-info btn-sm" href="<?php echo admin_url('Task/task_details/'.$value->id); ?>">View</a>

                                                                <a class="btn-info btn-sm" href="<?php echo admin_url('Task/add/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                                <a class="btn-info btn-sm" target="_blank" href="<?php echo admin_url('Task/activity_log/'.$value->id); ?>">Activity</a>

                                                                <a class="btn-info btn-sm" target="_blank" href="<?php  echo admin_url('reminder/add/0/3'); ?>">Set Reminder</a>

                                                                <button type="button" value="<?php echo $value->id; ?>" class="btn-info btn-sm assignees" data-toggle="modal" data-target="#myModal">Assignees (<?php echo $assignee_info->staff_count; ?>)</button>-->

                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
                                ?>

                        </tbody>

                     </table>
                  </div>
               </div>
            </div>
         </div>
            
      </div>
   </div>
</div>
<?php } ?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Task Assignee List</h4>
      </div>
      <div class="modal-body">
        <div id="assig_div"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
