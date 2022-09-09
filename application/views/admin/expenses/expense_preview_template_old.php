<?php
$approve_tab = $this->uri->segment(4); // 2ndsegment
?>
<div class="col-md-12 no-padding">
   <div class="panel_s">
      <div class="panel-body">
         <?php if($expense->recurring == 1){
            echo '<div class="ribbon info"><span>'._l('expense_recurring_indicator').'</span></div>';
            } ?>
         <div class="horizontal-scrollable-tabs preview-tabs-top">
            <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
            <div class="horizontal-tabs">
               <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
                  <li role="presentation" class="<?php if(empty($approve_tab)){ echo 'active';}else{ echo '';}?>">
                     <a href="#tab_expense" aria-controls="tab_expense" role="tab" data-toggle="tab">
                     <?php echo _l('expense'); ?>
                     </a>
                  </li>
                  <?php if($expense->recurring > 0) { ?>
                  <li role="presentation">
                     <a href="#tab_child_expenses" aria-controls="tab_child_expenses" role="tab" data-toggle="tab">
                     <?php echo _l('child_expenses'); ?>
                     </a>
                  </li>
                  <?php } ?>
                  <li role="presentation">
                     <a href="#tab_tasks" onclick="init_rel_tasks_table(<?php echo $expense->expenseid; ?>,'expense'); return false;" aria-controls="tab_tasks" role="tab" data-toggle="tab">
                     <?php echo _l('tasks'); ?>
                     </a>
                  </li>
                  <li role="presentation" class="tab-separator">
                     <a href="#tab_reminders" onclick="initDataTable('.table-reminders', admin_url + 'misc/get_reminders/' + <?php echo $expense->id ;?> + '/' + 'expense', undefined, undefined,undefined,[1,'ASC']); return false;" aria-controls="tab_reminders" role="tab" data-toggle="tab">
                     <?php echo _l('expenses_reminders'); ?>
                     <?php
                        $total_reminders = total_rows('tblreminders',
                          array(
                           'isnotified'=>0,
                           'staff'=>get_staff_user_id(),
                           'rel_type'=>'expense',
                           'rel_id'=>$expense->expenseid
                           )
                          );
                        if($total_reminders > 0){
                          echo '<span class="badge">'.$total_reminders.'</span>';
                        }
                        ?>
                     </a>
                  </li>
				   <li role="presentation" class="<?php if(!empty($approve_tab)){ echo 'active';}else{ echo '';}?>">
                     <a href="#tab_approval" aria-controls="tab_expense" role="tab" data-toggle="tab">
                     <?php echo 'Expense Approval'; ?>
                     </a>
                  </li>
                  <li role="presentation" class="tab-separator toggle_view">
                     <a href="#" onclick="small_table_full_view(); return false;" data-placement="left" data-toggle="tooltip" data-title="<?php echo _l('toggle_full_view'); ?>">
                     <i class="fa fa-expand"></i></a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <h3 class="bold no-margin"><?php echo $expense->category_name; ?></h3>
               <?php if(!empty($expense->expense_name)){ ?>
               <h4 class="text-muted font-medium no-mtop"><?php echo $expense->expense_name; ?></h4>
               <?php } ?>
            </div>
            <div class="col-md-6 _buttons text-right">
               <div class="visible-xs">
                  <div class="mtop10"></div>
               </div>
               <?php if($expense->billable == 1 && $expense->invoiceid == NULL){ ?>
               <?php if(has_permission('invoices','','create')){ ?>
               <button type="button" class="btn btn-success pull-right mleft5 expense_convert_btn" data-id="<?php echo $expense->expenseid; ?>" data-toggle="modal" data-target="#expense_convert_helper_modal">
               <?php echo _l('expense_convert_to_invoice'); ?>
               </button>
               <?php } ?>
               <?php } else if($expense->invoiceid != NULL){ ?>
               <a href="<?php echo admin_url('invoices/list_invoices/'.$expense->invoiceid); ?>" class="btn mleft10 pull-right btn-info"><?php echo format_invoice_number($invoice->id); ?></a>
               <?php } ?>
               <div class="pull-right">
				
				<?php
				if(($expense->category == 1) || ($expense->category == 2) || ($expense->category == 5)){
					?>
					 <a class="btn btn-default btn-with-tooltip" href="<?php echo admin_url('expenses/repeat_expense/'.$expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="Repeat"><i class="fa fa-repeat"></i></a>
					<?php
				}
				?>	
				 
				  
                  <?php if(has_permission('expenses','','edit')){ ?>
                  <a class="btn btn-default btn-with-tooltip" href="<?php echo admin_url('expenses/expense/'.$expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_edit'); ?>"><i class="fa fa-pencil-square-o"></i></a>
                  <?php } ?>
                  <?php if(has_permission('expenses','','create')){ ?>
                  <a class="btn btn-default btn-with-tooltip" href="<?php echo admin_url('expenses/copy/'.$expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_copy'); ?>"><i class="fa fa-clone"></i></a>
                  <?php } ?>
                  <?php if(has_permission('expenses','','delete')){ ?>
                  <a class="btn btn-danger btn-with-tooltip _delete" href="<?php echo admin_url('expenses/delete/'.$expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_delete'); ?>"><i class="fa fa-remove"></i></a>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <hr class="hr-panel-heading hr-10" />
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane ptop10 <?php if(empty($approve_tab)){ echo 'active';}else{ echo '';}?>" id="tab_expense" data-empty-note="<?php echo empty($expense->note); ?>" data-empty-name="<?php echo empty($expense->expense_name); ?>">
               <div class="row">
                  <?php
                     if($expense->recurring > 0 || $expense->recurring_from != NULL) {
                      echo '<div class="col-md-12">';
                      $recurring_expense = $expense;
                      $next_recurring_date_compare = $recurring_expense->date;
                      if($recurring_expense->last_recurring_date){
                        $next_recurring_date_compare = $recurring_expense->last_recurring_date;
                      }
                      if($expense->recurring_from != NULL){
                        $recurring_expense = $this->expenses_model->get($expense->recurring_from);
                        $next_recurring_date_compare = $recurring_expense->last_recurring_date;
                      }

                      $next_date = date('Y-m-d', strtotime('+' . $recurring_expense->recurring . ' ' . strtoupper($recurring_expense->recurring_type),strtotime($next_recurring_date_compare)));

                      ?>
                  <?php if($expense->recurring_from == null && $recurring_expense->cycles > 0 && $recurring_expense->cycles == $recurring_expense->total_cycles) { ?>
                  <div class="alert alert-info mbot15">
                     <?php echo _l('recurring_has_ended', _l('expense_lowercase')); ?>
                  </div>
                  <?php } else { ?>
                  <span class="label label-default padding-5">
                  <?php echo _l('cycles_remaining'); ?>:
                  <b>
                  <?php
                     if($recurring_expense->cycles == 0){
                         echo _l('cycles_infinity');
                        } else {
                         echo $recurring_expense->cycles - $recurring_expense->total_cycles;
                        }
                      ?>
                  </b>
                  </span>
                  <?php } ?>
                  <?php if($recurring_expense->cycles == 0 || $recurring_expense->cycles != $recurring_expense->total_cycles){ ?>
                  <?php echo '<span class="label label-default padding-5 mleft5"><i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-title="'._l('recurring_recreate_hour_notice',_l('expense')).'"></i> ' . _l('next_expense_date','<b>'._d($next_date).'</b>') .'</span>'; ?>
                  <?php } ?>
                  <?php
                     if($expense->recurring_from != NULL){ ?>
                  <?php echo '<p class="text-muted mtop15 no-mbot">'._l('expense_recurring_from','<a href="'.admin_url('expenses/list_expenses/'.$expense->recurring_from).'" onclick="init_expense('.$expense->recurring_from.');return false;">'.$recurring_expense->category_name.(!empty($recurring_expense->expense_name) ? ' ('.$recurring_expense->expense_name.')' : '').'</a></p>'); ?>
                  <?php } ?>
               </div>
               <div class="clearfix"></div>
               <hr class="hr-panel-heading" />
               <?php } ?>
               <div class="col-md-6">
                  <p><span class="bold font-medium"><?php echo _l('expense_amount'); ?></span> <span class="text-danger bold font-medium"><?php echo format_money($expense->amount,$expense->currency_data->symbol); ?></span>
                    
					 <p><span class="bold"><?php echo _l('expense_date'); ?></span> <span class="text-muted"><?php echo _d($expense->date); ?></span></p>
					<!-- Showing custom fields -->
					
					
					<?php
					if(!empty($expense->addedfrom)){
						$staff_info = $this->home_model->get_row('tblstaff', array('staffid'=>$expense->addedfrom), '');
						if(!empty($staff_info)){
							echo '<p class="bold mbot5"><b>Added By </b>: '.$staff_info->firstname.'</p>';
						}
					}
					
					if(!empty($expense->related_to)){
						$related_name = '--';
						if($expense->related_to == 1){
							$related_to = 'Customers';
							$client_info = $this->home_model->get_row('tblclient', array('userid'=>$expense->clientid), '');
							if(!empty($client_info)){
								$related_name = $client_info->company;
							}
						}elseif($expense->related_to == 2){
							$related_to = 'leads';
							$expense_info = $this->home_model->get_row('tblexpenses', array('id'=>$expense->id), '');
							$lead_info = $this->home_model->get_row('tblclient', array('userid'=>$expense_info->leadid), '');							
							if(!empty($lead_info)){
								$related_name = $lead_info->company;
							}	
						}elseif($expense->related_to == 3){
							$related_to = 'New Leads';
						}elseif($expense->related_to == 4){
							$related_to = 'Others';	
							$related_name = $expense->expense_other;	
						}
						if($expense->related_to == 3){
							echo '<p class="bold mbot5"><b>Related To </b>: <span class="text-muted">'.$related_to.'</span></p>';
						}else{
							echo '<p class="bold mbot5"><b>Related To </b>: <span class="text-muted">'.$related_to.' ('.$related_name.')'.'</span></p>';
						}	
						
						
						if($expense->related_to == 3){
							if(!empty($expense->newlead_company)){
								echo '<p class="bold mbot5"><b>New Lead Company </b>: <span class="text-muted">'.$expense->newlead_company.'</span></p>';
							}
							if(!empty($expense->newlead_name)){
								echo '<p class="bold mbot5"><b>New Lead Name </b>: <span class="text-muted">'.$expense->newlead_name.'</span></p>';
							}
							if(!empty($expense->newlead_mobile)){
								echo '<p class="bold mbot5"><b>New Lead Mobile </b>: <span class="text-muted">'.$expense->newlead_mobile.'</span></p>';
							}
							if(!empty($expense->newlead_email)){
								echo '<p class="bold mbot5"><b>New Lead Email </b>: <span class="text-muted">'.$expense->newlead_email.'</span></p>';
							}
						}
						
					}	
					
					if(!empty($expense->purpose)){
						$purpose_info = $this->home_model->get_row('tblpurpose', array('id'=>$expense->purpose), '');
						
						if(!empty($purpose_info)){
							if($purpose_info->name == 'Other'){
								if(!empty($expense->other_purpose)){
									echo '<p class="bold mbot5"><b>Purpose </b>: <span class="text-muted">'.$expense->other_purpose.'</span></p>';
								}																
							}else{
								echo '<p class="bold mbot5"><b>Purpose </b>: <span class="text-muted">'.$purpose_info->name.'</span></p>';
							}
						}					
					}
					?>
					
					<!-- Showing Destination -->					
					<?php
					if($expense->category == 1 || $expense->category == 2 || $expense->category == 5){
						if($expense->category == 1){
							$from_destination = $expense->form_destination;
							$to_destination = $expense->to_destination;
						}
						if($expense->category == 2){
							$from_destination = $expense->trmpo_form_destination;
							$to_destination = $expense->trmpo_to_destination;
						}
						if($expense->category == 5){
							$from_destination = $expense->logistic_to_address;
							$to_destination = $expense->logistic_from_address; 
						}
						echo '<p class="bold mbot5"><b>From Destination </b>: <span class="text-muted">'.$from_destination.'</span></p>
						<p class="bold mbot5"><b>To Destination </b>: <span class="text-muted">'.$to_destination.' </span></p>';
					}
					
					
					//Repeat Start Here
					if($expense->category == 1){
						if($expense->travel_mode > 0){
							$travel_mode = $this->home_model->get_row('tbltravelmode', array('id'=>$expense->travel_mode), '');
							if(!empty($travel_mode)){
								echo '<p class="bold mbot5"><b>Travel Mode </b>: <span class="text-muted">'.$travel_mode->name.'</span></p>';
							}
						}
						if($expense->kilometer_limit > 0){							
								echo '<p class="bold mbot5"><b>Kilometer Limit </b>: <span class="text-muted">'.$expense->kilometer_limit.'</span></p>';							
						}
					}
					
					if($expense->category == 2){
						
						if(!empty($expense->tempo_name)){							
								echo '<p class="bold mbot5"><b>Tempo Name </b>: <span class="text-muted">'.$expense->tempo_name.'</span></p>';							
						}
						if(!empty($expense->tempo_number)){							
								echo '<p class="bold mbot5"><b>Tempo No. </b>: <span class="text-muted">'.$expense->tempo_number.'</span></p>';							
						}
						if(!empty($expense->tempo_driver_name)){							
								echo '<p class="bold mbot5"><b>Temp Driver Name </b>: <span class="text-muted">'.$expense->tempo_driver_name.'</span></p>';							
						}
						if(!empty($expense->tempo_driver_number)){							
								echo '<p class="bold mbot5"><b>Temp Driver No. </b>: <span class="text-muted">'.$expense->tempo_driver_number.'</span></p>';							
						}
						if(!empty($expense->tempo_owner)){							
								echo '<p class="bold mbot5"><b>Tempo Owner </b>: <span class="text-muted">'.$expense->tempo_owner.'</span></p>';							
						}
					}
					
					if($expense->category == 5){
						echo '<br>';
						echo '<p class="bold mbot5"><b> LOGISTIC FROM :-</b>';
						
						if(!empty($expense->logistic_from_person_name)){							
								echo '<p class="bold mbot5"><b>Contact Person Name </b>: <span class="text-muted">'.$expense->logistic_from_person_name.'</span></p>';							
						}
						if(!empty($expense->logistic_from_person_no)){							
								echo '<p class="bold mbot5"><b>Contact Person No. </b>: <span class="text-muted">'.$expense->logistic_from_person_no.'</span></p>';							
						}
						if(!empty($expense->logistic_from_address)){							
								echo '<p class="bold mbot5"><b>From Address </b>: <span class="text-muted">'.$expense->logistic_from_address.'</span></p>';							
						}
						if(!empty($expense->logistic_from_state)){							
								echo '<p class="bold mbot5"><b> State </b>: <span class="text-muted">'.$expense->logistic_from_state.'</span></p>';							
						}
						if(!empty($expense->logistic_from_city)){							
								echo '<p class="bold mbot5"><b> City </b>: <span class="text-muted">'.$expense->logistic_from_city.'</span></p>';							
						}
						if(!empty($expense->logistic_from_pin)){							
								echo '<p class="bold mbot5"><b>Pin Code </b>: <span class="text-muted">'.$expense->logistic_from_pin.'</span></p>';							
						}
						
						echo '<br>';						
						echo '<p class="bold mbot5"><b> LOGISTIC TO :-</b>';
						
						if(!empty($expense->logistic_to_person_name)){							
								echo '<p class="bold mbot5"><b>Contact Person Name </b>: <span class="text-muted">'.$expense->logistic_to_person_name.'</span></p>';							
						}
						if(!empty($expense->logistic_to_person_no)){							
								echo '<p class="bold mbot5"><b>Contact Person No. </b>: <span class="text-muted">'.$expense->logistic_to_person_no.'</span></p>';							
						}
						if(!empty($expense->logistic_to_address)){							
								echo '<p class="bold mbot5"><b>From Address </b>: <span class="text-muted">'.$expense->logistic_to_address.'</span></p>';							
						}
						if(!empty($expense->logistic_to_state)){							
								echo '<p class="bold mbot5"><b> State </b>: <span class="text-muted">'.$expense->logistic_to_state.'</span></p>';							
						}
						if(!empty($expense->logistic_to_city)){							
								echo '<p class="bold mbot5"><b> City </b>: <span class="text-muted">'.$expense->logistic_to_city.'</span></p>';							
						}
						if(!empty($expense->logistic_to_pin)){							
								echo '<p class="bold mbot5"><b>Pin Code </b>: <span class="text-muted">'.$expense->logistic_to_pin.'</span></p>';							
						}
						echo '<br>';
						
						
						
						if($expense->logistic_paid_by > 0){
							$logistic_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$expense->logistic_paid_by), '');
							
							if(!empty($logistic_paid_by)){
							echo '<p class="bold mbot5"><b>Paid By </b>: <span class="text-muted">'.$logistic_paid_by->name.'</span></p>';
							}
						}
					}
					//Repeat End Here
					
					
					//Food
					if($expense->category == 3){
						if($expense->meal_type > 0){
							$meal_type = '--';
							if($expense->meal_type == 1){
								$meal_type = 'Breakfast';
								
							}elseif($expense->meal_type == 2){
								$meal_type = 'Lunch';
									
							}elseif($expense->meal_type == 3){
								$meal_type = 'Dinner';
							}
							
							echo '<p class="bold mbot5"><b>Meal Type </b>: <span class="text-muted">'.$meal_type.'</span></p>';
						}
						if(!empty($expense->pay_for_person)){							
								echo '<p class="bold mbot5"><b>Pay For Person </b>: <span class="text-muted">'.$expense->pay_for_person.'</span></p>';							
						}
					}
					
					//Hotel
					if($expense->category == 4){
						
						if(!empty($expense->hotel_name)){							
								echo '<p class="bold mbot5"><b>Hotel Name </b>: <span class="text-muted">'.$expense->hotel_name.'</span></p>';							
						}
						
						if(!empty($expense->hotel_address)){							
								echo '<p class="bold mbot5"><b>Hotel Address </b>: <span class="text-muted">'.$expense->hotel_address.'</span></p>';							
						}
						
						if(!empty($expense->hotel_no)){							
								echo '<p class="bold mbot5"><b>Hotel No. </b>: <span class="text-muted">'.$expense->hotel_no.'</span></p>';							
						}
						
						if($expense->stay_from > 0){								
								echo '<p class="bold mbot5"><b>Stay Date From </b>: <span class="text-muted">'.date('d/m/Y H:i A',strtotime($expense->stay_from)).'</span></p>';
						}
						
						if($expense->stay_to > 0){								
								echo '<p class="bold mbot5"><b>Stay Date To </b>: <span class="text-muted">'.date('d/m/Y H:i A',strtotime($expense->stay_to)).'</span></p>';						
						}
						
						if($expense->stay_day > 0){
							$stay_day = '--';
							if($expense->stay_day == 1){
								$stay_day = 'Morning';								
							}elseif($expense->stay_day == 2){
								$stay_day = 'Afternoon';									
							}elseif($expense->meal_type == 3){
								$stay_day = 'Evening';
							}elseif($expense->meal_type == 4){
								$stay_day = 'Night';
							}
							
							echo '<p class="bold mbot5"><b>Stay day </b>: <span class="text-muted">'.$stay_day.'</span></p>';
						}
						
						if(!empty($expense->person_no)){							
								echo '<p class="bold mbot5"><b>Person No. </b>: <span class="text-muted">'.$expense->person_no.'</span></p>';						
						}
						
						if($expense->pay_date > 0){							
								echo '<p class="bold mbot5"><b>Stay Date To </b>: <span class="text-muted">'.date('d/m/Y',strtotime($expense->pay_date)).'</span></p>';	
						}
						
						
						if($expense->hotel_paid_by > 0){
							$hotel_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$expense->hotel_paid_by), '');
							
							if(!empty($hotel_paid_by)){
							echo '<p class="bold mbot5"><b>Paid By </b>: <span class="text-muted">'.$hotel_paid_by->name.'</span></p>';
							}
						}
					}
					
					//Extra
					if($expense->category == 6){
						if($expense->bill_type > 0){
							$bill_type = $this->home_model->get_row('tblbilltype', array('id'=>$expense->bill_type), '');
							if(!empty($bill_type)){
								echo '<p class="bold mbot5"><b>Bill Type </b>: <span class="text-muted">'.$bill_type->name.'</span></p>';
							}
						}
						
						if($expense->extra_paid_by > 0){
							$extra_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$expense->extra_paid_by), '');
							
							if(!empty($extra_paid_by)){
							echo '<p class="bold mbot5"><b>Paid By </b>: <span class="text-muted">'.$extra_paid_by->name.'</span></p>';
							}
						}
					}
					
					
					
					?>
					
					
					
									
					
					
					
                     <?php if($expense->billable == 1){
                        echo '<br />';
                        echo '<br />';
                        if($expense->invoiceid == NULL){
                          echo '<span class="text-danger">'._l('expense_invoice_not_created').'</span>';
                        } else {
                          if($invoice->status == 2){
                            echo '<span class="text-success">'._l('expense_billed').'</span>';
                          } else {
                            echo '<span class="text-danger">'._l('expense_not_billed').'</span>';
                          }
                        }
                        } ?>
                  </p>
                  <br />
                  <br />
                  <?php if(!empty($expense->reference_no)){ ?>
                  <p class="bold mbot15"><?php echo _l('expense_ref_noe'); ?> <span class="text-muted"><?php echo $expense->reference_no; ?></span></p>
                  <?php } ?>
                  <?php 
				  /*
				  if($expense->clientid != 0){ ?>
                  <p class="bold mbot5"><?php echo _l('expense_customer'); ?></p>
                  <p class="mbot15"><a href="<?php echo admin_url('clients/client/'.$expense->clientid); ?>"><?php echo $expense->company; ?></a></p>
                  <?php } ?>
                  <?php if($expense->project_id != 0){ ?>
                  <p class="bold mbot5"><?php echo _l('project'); ?></p>
                  <p class="mbot15"><a href="<?php echo admin_url('projects/view/'.$expense->project_id); ?>"><?php echo $expense->project_data->name; ?></a></p>
                  <?php } 
				  */
				  ?>
                  <?php
                     $custom_fields = get_custom_fields('expenses');
                     foreach($custom_fields as $field){ ?>
                  <?php $value = get_custom_field_value($expense->expenseid, $field['id'], 'expenses');
                     if($value == ''){continue;} ?>
                  <div class="row mbot10">
                     <div class="col-md-12 mtop5">
                        <p class="mbot5">
                           <span class="bold"><?php echo ucfirst($field['name']); ?></span>
                        </p>
                        <div class="text-left">
                           <?php echo $value; ?>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <?php if($expense->note != ''){ ?>
                  <p class="bold mbot5"><?php echo _l('expense_note'); ?></p>
                  <p class="text-muted mbot15"><?php echo $expense->note; ?></p>
                  <?php } ?>
               </div>
               <div class="col-md-6">
                  <h4 class="bold mbot25"><?php echo _l('expense_receipt'); ?></h4>
                  <?php if(empty($expense->attachment)) { ?>
                  <?php echo form_open('admin/expenses/add_expense_attachment/'.$expense->expenseid,array('class'=>'mtop10 dropzone dropzone-expense-preview dropzone-manual','id'=>'expense-receipt-upload')); ?>
                  <div id="dropzoneDragArea" class="dz-default dz-message">
                     <span><?php echo _l('expense_add_edit_attach_receipt'); ?></span>
                  </div>
                  <?php echo form_close(); ?>
                  <?php }  else { 
				  
				  $expense_attechment = get_expense_attachment($expense->expenseid);
				  if(!empty($expense_attechment)){
					  foreach($expense_attechment as $attech){
						  ?>
						   <div class="row">
							 <div class="col-md-10">
								<i class="<?php echo get_mime_class($attech->filetype); ?>"></i> <a href="<?php echo site_url('download/file/expense/'.$attech->id); ?>"> <?php echo $attech->file_name; ?></a>
							 </div>
							 <?php if($expense->attachment_added_from == get_staff_user_id() || is_admin()){ ?>
							 <div class="col-md-2 text-right">
								<a class="_delete text-danger" href="<?php echo admin_url('expenses/delete_expense_attachment/'.$attech->id .'/'.'preview'); ?>" class="text-danger"><i class="fa fa fa-times"></i></a>
							 </div>
							 <?php } ?>
						  </div>
						  <?php
					  }
				  }
				  ?>
                 
				  
                  <?php } ?>
               </div>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			  <!-- Getting Sub Expenses -->
			  <?php
			  
			  $expenses_list = get_sub_expenses($expense->id);
			  if(!empty($expenses_list)){
				  foreach($expenses_list as $row){
					  
					   $sub_expense = $this->expenses_model->get($row->id);
					  
					  ?>
					  
					  
					   <div class="clearfix"></div>
               <hr class="hr-panel-heading" />
			   
			   <div class="pull-right">
				
				<?php
				if(($sub_expense->category == 1) || ($sub_expense->category == 2) || ($sub_expense->category == 5)){
					?>
					 <a class="btn btn-default btn-with-tooltip" href="<?php echo admin_url('expenses/repeat_expense/'.$sub_expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="Repeat"><i class="fa fa-repeat"></i></a>
					<?php
				}
				?>	
				 
				  
                  <?php if(has_permission('expenses','','edit')){ ?>
                  <a class="btn btn-default btn-with-tooltip" href="<?php echo admin_url('expenses/expense/'.$sub_expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_edit'); ?>"><i class="fa fa-pencil-square-o"></i></a>
                  <?php } ?>
                  <?php if(has_permission('expenses','','create')){ ?>
                  <a class="btn btn-default btn-with-tooltip" href="<?php echo admin_url('expenses/copy/'.$sub_expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_copy'); ?>"><i class="fa fa-clone"></i></a>
                  <?php } ?>
                  <?php if(has_permission('expenses','','delete')){ ?>
                  <a class="btn btn-danger btn-with-tooltip _delete" href="<?php echo admin_url('expenses/delete/'.$sub_expense->expenseid); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo _l('expense_delete'); ?>"><i class="fa fa-remove"></i></a>
                  <?php } ?>
               </div>
			   
					    <div class="col-md-6">
                  <p><span class="bold font-medium"><?php echo _l('expense_amount'); ?></span> <span class="text-danger bold font-medium"><?php echo format_money($sub_expense->amount,$sub_expense->currency_data->symbol); ?></span>
                     <p><span class="bold"><?php echo _l('expense_date'); ?></span> <span class="text-muted"><?php echo _d($sub_expense->date); ?></span></p>
                    <!-- Showing Destination -->
					<?php
					if($sub_expense->category == 1 || $sub_expense->category == 2 || $sub_expense->category == 5){
						if($sub_expense->category == 1){
							$from_destination = $sub_expense->form_destination;
							$to_destination = $sub_expense->to_destination;
						}
						if($sub_expense->category == 2){
							$from_destination = $sub_expense->trmpo_form_destination;
							$to_destination = $sub_expense->trmpo_to_destination;
						}
						if($sub_expense->category == 5){
							$from_destination = $sub_expense->logistic_to_address;
							$to_destination = $sub_expense->logistic_from_address; 
						}
						echo '<p class="mbot5"><b>From Destination </b>: <span class="text-muted">'.$from_destination.'</span></p>
						<p class="mbot5"><b>To Destination </b>: <span class="text-muted">'.$to_destination.' </span></p>';
					}
					
					
					
					//Repeat Start Here
					if($sub_expense->category == 1){
						if($sub_expense->travel_mode > 0){
							$travel_mode = $this->home_model->get_row('tbltravelmode', array('id'=>$sub_expense->travel_mode), '');
							if(!empty($travel_mode)){
								echo '<p class="bold mbot5"><b>Travel Mode </b>: <span class="text-muted">'.$travel_mode->name.'</span></p>';
							}
						}
						if($sub_expense->kilometer_limit > 0){							
								echo '<p class="bold mbot5"><b>Kilometer Limit </b>: <span class="text-muted">'.$sub_expense->kilometer_limit.'</span></p>';							
						}
					}
					
					if($sub_expense->category == 2){
						
						if(!empty($sub_expense->tempo_name)){							
								echo '<p class="bold mbot5"><b>Tempo Name </b>: <span class="text-muted">'.$sub_expense->tempo_name.'</span></p>';							
						}
						if(!empty($sub_expense->tempo_number)){							
								echo '<p class="bold mbot5"><b>Tempo No. </b>: <span class="text-muted">'.$sub_expense->tempo_number.'</span></p>';							
						}
						if(!empty($sub_expense->tempo_driver_name)){							
								echo '<p class="bold mbot5"><b>Temp Driver Name </b>: <span class="text-muted">'.$sub_expense->tempo_driver_name.'</span></p>';							
						}
						if(!empty($sub_expense->tempo_driver_number)){							
								echo '<p class="bold mbot5"><b>Temp Driver No. </b>: <span class="text-muted">'.$sub_expense->tempo_driver_number.'</span></p>';							
						}
						if(!empty($sub_expense->tempo_owner)){							
								echo '<p class="bold mbot5"><b>Tempo Owner </b>: <span class="text-muted">'.$sub_expense->tempo_owner.'</span></p>';							
						}
						
						
						if($sub_expense->tempo_paid_by > 0){
							$tempo_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$sub_expense->tempo_paid_by), '');
							
							if(!empty($tempo_paid_by)){
							echo '<p class="bold mbot5"><b>Paid By </b>: <span class="text-muted">'.$tempo_paid_by->name.'</span></p>';
							}
						}
					}
					
					if($sub_expense->category == 5){
						
						echo '<br>';
						echo '<p class="bold mbot5"><b> LOGISTIC FROM :-</b>';
						
						if(!empty($sub_expense->logistic_from_person_name)){							
								echo '<p class="bold mbot5"><b>Contact Person Name </b>: <span class="text-muted">'.$sub_expense->logistic_from_person_name.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_from_person_no)){							
								echo '<p class="bold mbot5"><b>Contact Person No. </b>: <span class="text-muted">'.$sub_expense->logistic_from_person_no.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_from_address)){							
								echo '<p class="bold mbot5"><b>From Address </b>: <span class="text-muted">'.$sub_expense->logistic_from_address.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_from_state)){							
								echo '<p class="bold mbot5"><b> State </b>: <span class="text-muted">'.$sub_expense->logistic_from_state.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_from_city)){							
								echo '<p class="bold mbot5"><b> City </b>: <span class="text-muted">'.$sub_expense->logistic_from_city.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_from_pin)){							
								echo '<p class="bold mbot5"><b>Pin Code </b>: <span class="text-muted">'.$sub_expense->logistic_from_pin.'</span></p>';							
						}
						
						echo '<br>';						
						echo '<p class="bold mbot5"><b> LOGISTIC TO :-</b>';
						
						if(!empty($sub_expense->logistic_to_person_name)){							
								echo '<p class="bold mbot5"><b>Contact Person Name </b>: <span class="text-muted">'.$sub_expense->logistic_to_person_name.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_to_person_no)){							
								echo '<p class="bold mbot5"><b>Contact Person No. </b>: <span class="text-muted">'.$sub_expense->logistic_to_person_no.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_to_address)){							
								echo '<p class="bold mbot5"><b>From Address </b>: <span class="text-muted">'.$sub_expense->logistic_to_address.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_to_state)){							
								echo '<p class="bold mbot5"><b> State </b>: <span class="text-muted">'.$sub_expense->logistic_to_state.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_to_city)){							
								echo '<p class="bold mbot5"><b> City </b>: <span class="text-muted">'.$sub_expense->logistic_to_city.'</span></p>';							
						}
						if(!empty($sub_expense->logistic_to_pin)){							
								echo '<p class="bold mbot5"><b>Pin Code </b>: <span class="text-muted">'.$sub_expense->logistic_to_pin.'</span></p>';							
						}
						echo '<br>';
						
						if($sub_expense->logistic_paid_by > 0){
							$logistic_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$sub_expense->logistic_paid_by), '');
							
							if(!empty($logistic_paid_by)){
							echo '<p class="bold mbot5"><b>Paid By </b>: <span class="text-muted">'.$logistic_paid_by->name.'</span></p>';
							}
						}
					}
					//Repeat End Here
					?>
					
					
					
                     <?php if($sub_expense->billable == 1){
                        echo '<br />';
                        echo '<br />';
                        if($sub_expense->invoiceid == NULL){
                          echo '<span class="text-danger">'._l('expense_invoice_not_created').'</span>';
                        } else {
                          if($invoice->status == 2){
                            echo '<span class="text-success">'._l('expense_billed').'</span>';
                          } else {
                            echo '<span class="text-danger">'._l('expense_not_billed').'</span>';
                          }
                        }
                        } ?>
                  </p>
                  
                  <br />
                  <br />
                  <?php if(!empty($sub_expense->reference_no)){ ?>
                  <p class="bold mbot15"><?php echo _l('expense_ref_noe'); ?> <span class="text-muted"><?php echo $sub_expense->reference_no; ?></span></p>
                  <?php } ?>
                  <?php if($sub_expense->clientid != 0){ ?>
                  <p class="bold mbot5"><?php echo _l('expense_customer'); ?></p>
                  <p class="mbot15"><a href="<?php echo admin_url('clients/client/'.$sub_expense->clientid); ?>"><?php echo $sub_expense->company; ?></a></p>
                  <?php } ?>
                  <?php if($sub_expense->project_id != 0){ ?>
                  <p class="bold mbot5"><?php echo _l('project'); ?></p>
                  <p class="mbot15"><a href="<?php echo admin_url('projects/view/'.$sub_expense->project_id); ?>"><?php echo $sub_expense->project_data->name; ?></a></p>
                  <?php } ?>
                  <?php
                     $custom_fields = get_custom_fields('expenses');
                     foreach($custom_fields as $field){ ?>
                  <?php $value = get_custom_field_value($sub_expense->expenseid, $field['id'], 'expenses');
                     if($value == ''){continue;} ?>
                  <div class="row mbot10">
                     <div class="col-md-12 mtop5">
                        <p class="mbot5">
                           <span class="bold"><?php echo ucfirst($field['name']); ?></span>
                        </p>
                        <div class="text-left">
                           <?php echo $value; ?>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <?php if($sub_expense->note != ''){ ?>
                  <p class="bold mbot5"><?php echo _l('expense_note'); ?></p>
                  <p class="text-muted mbot15"><?php echo $sub_expense->note; ?></p>
                  <?php } ?>
               </div>
               <div class="col-md-6">
                  <h4 class="bold mbot25"><?php echo _l('expense_receipt'); ?></h4>
                  <?php if(empty($sub_expense->attachment)) { ?>
                  <?php echo form_open('admin/expenses/add_expense_attachment/'.$sub_expense->expenseid,array('class'=>'mtop10 dropzone dropzone-expense-preview dropzone-manual','id'=>'expense-receipt-upload')); ?>
                  <div id="dropzoneDragArea" class="dz-default dz-message">
                     <span><?php echo _l('expense_add_edit_attach_receipt'); ?></span>
                  </div>
                  <?php echo form_close(); ?>
                  <?php }  else { 
				  
				    $expense_attechment = get_expense_attachment($sub_expense->expenseid);
				  if(!empty($expense_attechment)){
					  foreach($expense_attechment as $attech){
						  ?>
						   <div class="row">
							 <div class="col-md-10">
								<i class="<?php echo get_mime_class($attech->filetype); ?>"></i> <a href="<?php echo site_url('download/file/expense/'.$attech->id); ?>"> <?php echo $attech->file_name; ?></a>
							 </div>
							 <?php if($sub_expense->attachment_added_from == get_staff_user_id() || is_admin()){ ?>
							 <div class="col-md-2 text-right">
								<a class="_delete text-danger" href="<?php echo admin_url('expenses/delete_expense_attachment/'.$attech->id .'/'.'preview'); ?>" class="text-danger"><i class="fa fa fa-times"></i></a>
							 </div>
							 <?php } ?>
						  </div>
						  <?php
					  }
				  }
				  ?>
				  
                  <?php } ?>
               </div>
					  <?php
				  }
			  }
			  ?>	
				
			   
			   
			   
			  
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
            </div>
         </div>
         <?php if($expense->recurring > 0){ ?>
         <div role="tabpanel" class="tab-pane" id="tab_child_expenses">
            <?php if(count($child_expenses)){ ?>
            <p class="mtop30 bold"><?php echo _l('expenses_created_from_this_recurring_expense'); ?></p>
            <br />
            <ul class="list-group">
               <?php foreach($child_expenses as $recurring){ ?>
               <li class="list-group-item">
                  <a href="<?php echo admin_url('expenses/list_expenses/'.$recurring->expenseid); ?>" onclick="init_expense(<?php echo $recurring->expenseid; ?>); return false;" target="_blank"><?php echo $recurring->category_name.(!empty($recurring->expense_name) ? ' ('.$recurring->expense_name.')' : ''); ?>
                  </a>
                  <br />
                  <span class="inline-block mtop10">
                     <?php echo '<span class="bold">'._d($recurring->date).'</span>'; ?><br />
                     <p><span class="bold font-medium"><?php echo _l('expense_amount'); ?></span> <span class="text-danger bold font-medium"><?php echo format_money($recurring->amount,$recurring->currency_data->symbol); ?></span>
                        <?php
                           if($recurring->tax != 0){
                            echo '<br /><span class="bold">'._l('tax_1') .':</span> ' . $recurring->taxrate . '% ('.$recurring->tax_name.')';
                            $total = $recurring->amount;
                            $total += ($total / 100 * $recurring->taxrate);
                           }
                           if($recurring->tax2 != 0){
                            echo '<br /><span class="bold">'._l('tax_2') .':</span> ' . $recurring->taxrate2 . '% ('.$recurring->tax_name2.')';
                            $total += ($recurring->amount / 100 * $recurring->taxrate2);
                           }
                           if($recurring->tax != 0 || $recurring->tax2 != 0){
                           echo '<p class="font-medium bold text-danger">' . _l('total_with_tax') . ': ' . format_money($total,$recurring->currency_data->symbol) . '</p>';
                           }
                           ?>
                  </span>
				  
               </li>
               <?php } ?>
            </ul>
            <?php } else { ?>
            <p class="bold"><?php echo _l('no_child_found',_l('expenses')); ?></p>
            <?php } ?>
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane" id="tab_tasks">
            <?php init_relation_tasks_table(array('data-new-rel-id'=>$expense->expenseid,'data-new-rel-type'=>'expense')); ?>
         </div>
         <div role="tabpanel" class="tab-pane" id="tab_reminders">
            <a href="#" data-toggle="modal" class="btn btn-info" data-target=".reminder-modal-expense-<?php echo $expense->id; ?>"><i class="fa fa-bell-o"></i> <?php echo _l('expense_set_reminder_title'); ?></a>
            <hr />
            <?php render_datatable(array( _l( 'reminder_description'), _l( 'reminder_date'), _l( 'reminder_staff'), _l( 'reminder_is_notified')), 'reminders'); ?>
            <?php $this->load->view('admin/includes/modals/reminder',array('id'=>$expense->id,'name'=>'expense','members'=>$members,'reminder_title'=>_l('expense_set_reminder_title'))); ?>
         </div>
		 
		  <div role="tabpanel" class="tab-pane <?php if(!empty($approve_tab)){ echo 'active';}else{ echo '';}?>" id="tab_approval">
				<div class="row proposal-comments mtop15">
					
					<?php
					/*	
					<div class="col-md-12">
                        <div class="panel_s no-shadow leaddv">
					<?php
						if($expense->expense_send == 0){
						foreach($allStaffdata as $singlegroup)
						{?>
							<h4><?php echo $singlegroup['name'];?></h4>
							<div class="activity-feed">
							<?php
							foreach($singlegroup['staffs'] as $singlestaff)
							{?>
								<div style="margin-bottom: 14px;" class="checkbox checkbox-primary">
									<input type="checkbox" name="staffs[]" value="<?php echo $singlestaff['staffid'];?>" id="contact_primary<?php echo $singlestaff['staffid'];?>">
									<label style="width:100%;" for="contact_primary<?php echo $singlestaff['staffid'];?>"><span style="font-size:14px;"><?php echo $singlestaff['firstname'].' - '.$singlestaff['email'];?></span></label>
								</div>
						<?php
							}
							?>			
							</div>
						<?php
							}?>
							
							<div class="col-md-12">
							   <div class="text-right">
								  <button id="expense_approval" class="btn btn-info expense_approval"  value="<?php echo $expense->id ;?>">Submit</button>
							   </div>
							</div>
							<?php
						}else{
							$staffapprov=$this->db->query(" SELECT * FROM `tblexpensesapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`expense_id`='".$expense->id."' GROUP BY aps.staff_id")->result_array();
							foreach($staffapprov as $singleapprovstaff)
							{?>
							<div class="activity-feed">
								<div style="margin-bottom: 14px;" class="">
									<label style="width:100%;" for="contact_primary2">
										<span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' - '.$singleapprovstaff['email']; if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;">Approval Sent</span></h5>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;">Approval Accepted</span></h5>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;">Approval Decline</span></h5></span></label>';}	?></span>
									</label>
								</div>
							</div>
							<?php
							}	
						}						
						?>
						</div>
						<div class="leadSuccess" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Expense Send to Staff For Approval.</div>
                        <div class="clearfix"></div>
                     </div>
					 */
					 ?> 
					 <!-- new Logic -->
					  <div class="col-md-12">
                        <div class="panel_s no-shadow leaddv">
					<?php
						/*if(is_admin() == 1){
							$checkproposal=$this->db->query("SELECT * FROM `tblexpenses` WHERE `id`='".$expense->id."'")->result_array();
						}else{
							$checkproposal=$this->db->query("SELECT * FROM `tblexpenses` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$expense->id."'")->result_array();
						}*/
						
						$checkproposal=$this->db->query("SELECT * FROM `tblexpenses` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$expense->id."'")->result_array();
						
						$proposalapproval=$this->db->query("SELECT * FROM `tblexpensesapproval` WHERE `expense_id`='".$expense->id."' and `staff_id`='".get_staff_user_id()."' and (approve_status != '1' || approve_status != '2')")->row_array();
						if(count($checkproposal)>0 && count($proposalapproval)==0)
						{
							
						if(!empty($allStaffdata)){
							foreach($allStaffdata as $singlegroup)
							{
								?>
								<h4><?php echo $singlegroup['name'];?></h4>
								<div class="activity-feed">
								<?php
								foreach($singlegroup['staffs'] as $singlestaff)
								{?>
									<div style="margin-bottom: 14px;" class="checkbox checkbox-primary">
										<input type="checkbox" name="staffs[]" value="<?php echo $singlestaff['staffid'];?>" id="contact_primary<?php echo $singlestaff['staffid'];?>">
										<label style="width:100%;" for="contact_primary<?php echo $singlestaff['staffid'];?>"><span style="font-size:14px;"><?php echo $singlestaff['firstname'].' - '.$singlestaff['email'];?></span></label>
									</div>
							<?php
								}
								?>			
								</div>
						<?php
							}
							
							?>
							<div class="col-md-12">
							   <div class="text-right">
								  <button id="expense_approval" class="btn btn-info expense_approval"  value="<?php echo $expense->id;?>">Submit</button>
							   </div>
							</div>	
							<?php
						}	
						?>
							
							<?php
						}
						else if(count($checkproposal)==0)
						{
							
							$propdetails=$this->db->query("SELECT * FROM `tblexpenses` WHERE `id`='".$expense->id."'")->row_array();
								if(count($proposalapproval)>0 && $proposalapproval['approve_status']==0)
								{?>
									<div class="panel_s no-shadow leadsdv">
										<div class="activity-feed">
										  <div class="col-md-12">
											<h4>Would you like to accept this Expense?</h4>
											<div class="text-right">
												<input type="hidden" id="addedfrom" value="<?php echo $propdetails['addedfrom']; ?>">
												<div class="form-group">
													<textarea id="proposal_desc" placeholder="Enter Reason"class="form-control proposal_desc" rows="4" enabled="enabled"></textarea>
												</div>
												<button val="<?php echo $expense->id;?>"class="btn btn-success approval" value="1"><?php echo 'Accept'; ?></button>
												<button val="<?php echo $expense->id;?>" class="btn btn-info approval" value="2"><?php echo 'Decline'; ?></button>
											</div>
										  </div>
										</div>
									</div>
									<div class="leadaccept" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Expense is Accept Successfully.</div>
									<div class="leaddecline" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Expense is Decline Successfully.</div>
									<div class="actiontaken" style="color:yellow;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Action Already Taken On Request.</div>
								<?php
								}
								else
								{								
									$j = 0;
									$staffapprov=$this->db->query(" SELECT * FROM `tblexpensesapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`expense_id`='".$expense->id."' GROUP BY aps.staff_id")->result_array();
									foreach($staffapprov as $singleapprovstaff)
									{?>
									<div class="activity-feed">
										<div style="margin-bottom: 14px;" class="">
											<label style="width:100%;" for="contact_primary2">
												<span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' - '.$singleapprovstaff['email']; if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;">Approval Sent</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;">Approval Accepted</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span> </h5>'; $j++;}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;">Approval Decline</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5></span>';}	?></span>
											</label>
										</div>
										
										
									</div>
									<?php
									}
									
									if(is_admin() == 1 && $j > 0){
										
										?>
										<button  value="<?php echo $expense->id;?>" class="btn btn-danger reject" value="2">Decline</button>
										<?php
									}
								}
												
						}
						else
						{
							$staffapprov=$this->db->query(" SELECT * FROM `tblexpensesapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`expense_id`='".$expense->id."' GROUP BY aps.staff_id")->result_array();
							foreach($staffapprov as $singleapprovstaff)
							{?>
							<div class="activity-feed">
								<div style="margin-bottom: 14px;" class="">
									<label style="width:100%;" for="contact_primary2">
										<span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' - '.$singleapprovstaff['email']; if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;">Approval Sent</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['created_at'])).'</span></h5>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;">Approval Accepted</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;">Approval Decline</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5></span>';}	?></span>
									</label>
								</div>
							</div>
							<?php
							}
						}?>
						</div>
						<div class="leadSuccess" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Expense Send to Staff For Approval.</div>
                        <div class="clearfix"></div>
                     </div>
					
                  </div>
         </div>
      </div>
   </div>
</div>
</div>
<script>
   init_btn_with_tooltips();
   init_selectpicker();
   init_datepicker();
   init_form_reminder();
   init_tabs_scrollable();

   if($('#dropzoneDragArea').length > 0){
     if(typeof(expensePreviewDropzone) != 'undefined'){
       expensePreviewDropzone.destroy();
     }
     expensePreviewDropzone = new Dropzone("#expense-receipt-upload",  $.extend({},_dropzone_defaults(),{
       clickable: '#dropzoneDragArea',
       maxFiles: 1,
       success:function(file,response){
         init_expense(<?php echo $expense->expenseid; ?>);
       }
     }));
   }
</script>

<script>
$('.expense_approval').click(function(){
	  var expenseid=$(this).attr('value');
	  var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
		var staffid=val;
		var url = '<?php echo base_url(); ?>admin/expenses/sendapproval';
		$.post(url,
				{
					staffid: staffid,
					expenseid: expenseid,
				},
				function (data, status) {
					$('.leaddv').hide();
					$('.leadSuccess').show();
					
				});
				
   });
   
$('.approval').click(function()
   {
	  var expenseid=$(this).attr('val');
	  var approve_status=$(this).attr('value');
	  var leadcreatorid=$('#addedfrom').val();
	  var proposal_description=$('.proposal_desc').val();
	  var url = '<?php echo base_url(); ?>admin/expenses/approvalaccept';
	  if(proposal_description.trim()!='')
	  {
	  $.post(url,
				{
					approve_status: approve_status,
					expenseid: expenseid,
					leadcreatorid: leadcreatorid,
					approvereason: proposal_description,
				},
				function (data, status) {
					if(approve_status==1)
					{
						$('.leadsdv').hide();
						$('.leadaccept').show();
					}
					if(approve_status==2)
					{
						$('.leadsdv').hide();
						$('.leaddecline').show();
					}
				});
	  }
	  else
	  {
		  if(proposal_description=='')
		  {
			$('.proposal_desc').addClass('error');  
		  }
		  else
		  {
			$('.proposal_desc').removeClass('error');    
		  }
	  }
   });
      
   
</script>


<script type="text/javascript">
	$('.reject').click(function(){
	if (confirm('Are you sure you want to Reject?')) {		
		var  id = $(this).val();
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/expenses/rejectapproval'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response == '1'){
					location.reload();
				}
			}
		})
	}
	
	});
</script>
