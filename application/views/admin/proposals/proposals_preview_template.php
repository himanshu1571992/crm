<?php echo form_hidden('_attachment_sale_id',$proposal->id); ?>
<?php echo form_hidden('_attachment_sale_type','proposal'); $checkproposal=$this->db->query("SELECT * FROM `tblproposals` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$proposalid."'")->result_array(); 
//$proposalapproval=$this->db->query("SELECT * FROM `tblproposalstaffapproval` WHERE `lead_id`='".$proposalid."'")->row_array();?>
<div class="panel_s">
   <div class="panel-body">
      <div class="horizontal-scrollable-tabs preview-tabs-top">
         <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
         <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
         <div class="horizontal-tabs">
            <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
               <li role="presentation" class="active">
                  <a href="#tab_proposal" aria-controls="tab_proposal" role="tab" data-toggle="tab">
                  <?php echo _l('proposal'); ?>
                  </a>
               </li>
               <?php if(isset($proposal)){ ?>
               <!-- <li role="presentation">
                  <a href="#tab_comments" onclick="get_proposal_comments(); return false;" aria-controls="tab_comments" role="tab" data-toggle="tab">
                  <?php echo _l('proposal_comments'); ?>
                  </a>
               </li> -->
               <li role="presentation">
                  <a href="#tab_reminders" onclick="initDataTable('.table-reminders', admin_url + 'misc/get_reminders/' + <?php echo $proposal->id ;?> + '/' + 'proposal', undefined, undefined, undefined,[1,'asc']); return false;" aria-controls="tab_reminders" role="tab" data-toggle="tab">
                  <?php echo _l('estimate_reminders'); ?>
                  <?php
					
                     $total_reminders = total_rows('tblreminders',
                      array(
                       'isnotified'=>0,
                       'staff'=>get_staff_user_id(),
                       'rel_type'=>'proposal',
                       'rel_id'=>$proposal->id
                       )
                      );
                     if($total_reminders > 0){
                      echo '<span class="badge">'.$total_reminders.'</span>';
                     }
                     ?>
                  </a>
               </li>
               <li role="presentation" class="tab-separator">
                  <a href="#tab_tasks" onclick="init_rel_tasks_table(<?php echo $proposal->id; ?>,'proposal'); return false;" aria-controls="tab_tasks" role="tab" data-toggle="tab">
                  <?php echo _l('tasks'); ?>
                  </a>
               </li>
			   <?php
            $proposalapproval = [];
			    if(count($proposalapproval)>0 || count($checkproposal)>0)
				{?>
			   <li role="presentation" class="tab-separator">
                  <a href="#tab_approval"  role="tab" data-toggle="tab">
                  <?php echo 'Proposal Approval'; ?>
                  </a>
               </li>
			   <?php
				}?>
               <li role="presentation" data-toggle="tooltip" title="<?php echo _l('emails_tracking'); ?>" class="tab-separator">
                  <a href="#tab_emails_tracking" aria-controls="tab_emails_tracking" role="tab" data-toggle="tab">
                    <?php if(!is_mobile()){ ?>
                     <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                     <?php } else { ?>
                     <?php echo _l('emails_tracking'); ?>
                     <?php } ?>
                  </a>
               </li>
               <li role="presentation" data-toggle="tooltip" data-title="<?php echo _l('view_tracking'); ?>" class="tab-separator">
                  <a href="#tab_views" aria-controls="tab_views" role="tab" data-toggle="tab">
                    <?php if(!is_mobile()){ ?>
                     <i class="fa fa-eye"></i>
                     <?php } else { ?>
                     <?php echo _l('view_tracking'); ?>
                     <?php } ?>
                  </a>
               </li>
               <li role="presentation" data-toggle="tooltip" data-title="<?php echo _l('toggle_full_view'); ?>" class="tab-separator toggle_view">
                  <a href="#" onclick="small_table_full_view(); return false;">
                  <i class="fa fa-expand"></i></a>
               </li>
			   
               <?php } ?>
            </ul>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3">
            <?php echo format_proposal_status($proposal->status,'pull-left mright5 mtop5'); ?>
         </div>
         <div class="col-md-9 text-right _buttons proposal_buttons">
            <?php if(check_permission_page(5,'edit')){ ?>
            <a href="<?php echo admin_url('proposals/proposal/'.$proposal->id); ?>" data-placement="left" data-toggle="tooltip" title="<?php echo _l('proposal_edit'); ?>" class="btn btn-default btn-with-tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
            <?php } 
			$check_proposal_rent_item=check_proposal_item($proposal->id,0,'proposal');
			$check_proposal_sale_item=check_proposal_item($proposal->id,1,'proposal');
			?>
            <div class="btn-group">
               <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-pdf-o"></i><?php if(is_mobile()){echo ' PDF';} ?> <span class="caret"></span></a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <!-- <a href="<?php echo admin_url('proposals/pdf/'.$proposal->id.'?output_type=I&type=sale'); ?>"><?php echo _l('view_sale_pdf'); ?></a> -->

                  <?php if($check_proposal_sale_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('proposals/download_pdf/'.$proposal->id.'?type=sale'); ?>"><?php echo _l('view_sale_pdf'); ?></a></li><?php }?>
                 <?php if($check_proposal_rent_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('proposals/download_pdf/'.$proposal->id.'?type=rent'); ?>"><?php echo _l('view_rent_pdf'); ?></a></li><?php }?>
                   <?php if($check_proposal_sale_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('proposals/download_pdf/'.$proposal->id.'?type=sale'); ?>" target="_blank"><?php echo _l('view_sale_pdf_in_new_window'); ?></a></li><?php }?>
                   <?php if($check_proposal_rent_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('proposals/download_pdf/'.$proposal->id.'?type=rent'); ?>" target="_blank"><?php echo _l('view_rent_pdf_in_new_window'); ?></a></li><?php }?>
                   <?php /*if($check_proposal_sale_item>=1){?> <li><a href="<?php echo admin_url('proposals/pdf/'.$proposal->id.'?type=sale'); ?>"><?php echo _l('download_sale'); ?></a></li><?php }?>
				   <?php if($check_proposal_rent_item>=1){?> <li><a href="<?php echo admin_url('proposals/pdf/'.$proposal->id.'?type=rent'); ?>"><?php echo _l('download_rent'); ?></a></li><?php }*/?>
                  <li>
                     <a href="<?php echo admin_url('proposals/pdf/'.$proposal->id.'?print=true'); ?>" target="_blank">
                     <?php echo _l('print'); ?>
                     </a>
                  </li>
               </ul>
            </div>
            <a href="#" class="btn btn-default btn-with-tooltip" data-target="#proposal_send_to_customer" data-toggle="modal"><span data-toggle="tooltip" class="btn-with-tooltip" data-title="<?php echo _l('proposal_send_to_email'); ?>" data-placement="bottom"><i class="fa fa-envelope"></i></span></a>
            <div class="btn-group ">
               <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php echo _l('more'); ?> <span class="caret"></span>
               </button>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                     <a href="<?php echo site_url('proposal/'.$proposal->id .'/'.$proposal->hash); ?>" target="_blank"><?php echo _l('proposal_view'); ?></a>
                  </li>
                  <?php if(!empty($proposal->open_till) && date('Y-m-d') < $proposal->open_till && ($proposal->status == 4 || $proposal->status == 1) && is_proposals_expiry_reminders_enabled()) { ?>
                  <li>
                     <a href="<?php echo admin_url('proposals/send_expiry_reminder/'.$proposal->id); ?>"><?php echo _l('send_expiry_reminder'); ?></a>
                  </li>
                  <?php } ?>
                  <li>
                     <a href="#" data-toggle="modal" data-target="#sales_attach_file"><?php echo _l('invoice_attach_file'); ?></a>
                  </li>
                  <?php if(has_permission('proposals','','create')){ ?>
                 <!--  <li>
                     <a href="<?php echo admin_url() . 'proposals/copy/'.$proposal->id; ?>"><?php echo _l('proposal_copy'); ?></a>
                  </li> -->
                  <?php } ?>
                  <?php if($proposal->estimate_id == NULL && $proposal->invoice_id == NULL){ ?>
                  <?php foreach($proposal_statuses as $status){
                    // if(has_permission('proposals','','edit')){
                        if(check_permission_page(5,'edit')){
                      if($proposal->status != $status && $status != 5){ ?>
                  <li>
                     <a href="<?php echo admin_url() . 'proposals/mark_action_status/'.$status.'/'.$proposal->id; ?>"><?php echo _l('proposal_mark_as',format_proposal_status($status,'',false)); ?></a>
                  </li>
                  <?php
                     } } } ?>
                  <?php } ?>
                  <?php if(!empty($proposal->signature) && (check_permission_page(5,'delete'))){ ?>
                  <li>
                     <a href="<?php echo admin_url('proposals/clear_signature/'.$proposal->id); ?>" class="_delete">
                     <?php echo _l('clear_signature'); ?>
                     </a>
                  </li>
                  <?php } ?>
                  <li>
                     <a href="<?php echo admin_url() . 'proposals/revice_quotation/'.$proposal->id; ?>">Revise Quotation</a>
                  </li>
                  <?php if(check_permission_page(5,'delete')){ ?>
                  <li>
                     <a href="<?php echo admin_url() . 'proposals/delete/'.$proposal->id; ?>" class="text-danger delete-text _delete"><?php echo _l('proposal_delete'); ?></a>
                  </li>
                  <?php } ?>                  
               </ul>
            </div>
            <?php if($proposal->estimate_id == NULL && $proposal->invoice_id == NULL){ ?>
            <?php //if(has_permission('estimates','','create') || has_permission('invoices','','create')){ ?>
            <div class="btn-group">

               <?php
                  $check = check_already_converted($proposal->id,'proposal');
                  if($check == 0){
                     if(check_permission_page(6,'create')){
                     ?>
                     <a href="<?php echo admin_url('proposals/performerinvoice/'.$proposal->id); ?>" class="btn btn-success dropdown-toggle">Convert Proforma Invoice</a> 
                     <?php
                     }
                  }
               ?>


               <!-- <button type="button" class="btn btn-success dropdown-toggle<?php if($proposal->rel_type == 'customer' && total_rows('tblclients',array('active'=>0,'userid'=>$proposal->rel_id)) > 0){echo ' disabled';} ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php echo _l('proposal_convert'); ?> <span class="caret"></span>
               </button>
               <ul class="dropdown-menu dropdown-menu-right">
                  <?php
                     $disable_convert = false;
                     $not_related = false;

                     if($proposal->rel_type == 'lead'){
                      if(total_rows('tblclients',array('leadid'=>$proposal->rel_id)) == 0){
                       $disable_convert = true;
                       $help_text = 'proposal_convert_to_lead_disabled_help';
                     }
                     } else if(empty($proposal->rel_type)){
                     $disable_convert = true;
                     $help_text = 'proposal_convert_not_related_help';
                     }
                     ?>
                  <?php if(has_permission('estimates','','create')){ ?>
                  <li <?php if($disable_convert){ echo 'data-toggle="tooltip" title="'._l($help_text,_l('proposal_convert_estimate')).'"';} ?>><a  <?php if($disable_convert){ echo 'style="cursor:not-allowed;" onclick="return false;"';} else { echo'href="proposals/performerinvoice/'.$proposal->id.'"';/*echo 'data-template="estimate" onclick="convert_template(this); return false;"';*/ } ?>><?php echo _l('proposal_convert_estimate'); ?></a></li>
                  <?php } ?>
                  <?php if(has_permission('invoices','','create')){ ?>
                  <li <?php if($disable_convert){ echo 'data-toggle="tooltip" title="'._l($help_text,_l('proposal_convert_invoice')).'"';} ?>><a <?php if($disable_convert){ echo 'style="cursor:not-allowed;" onclick="return false;"';} else {echo'href="proposals/invoices/'.$proposal->id.'"';/*echo 'data-template="invoice" onclick="convert_template(this); return false;"';*/} ?>><?php echo _l('proposal_convert_invoice'); ?></a></li>
                  <?php } ?>
               </ul> -->
            </div>
            <?php //} ?>
            <?php } else {
               if($proposal->estimate_id != NULL){
                echo '<a href="'.admin_url('estimates/list_estimates/'.$proposal->estimate_id).'" class="btn btn-info">'.format_estimate_number($proposal->estimate_id).'</a>';
               } else {
                echo '<a href="'.admin_url('invoices/list_invoices/'.$proposal->invoice_id).'" class="btn btn-info">'.format_invoice_number($proposal->invoice_id).'</a>';
               }
               } ?>
         </div>
      </div>
      <div class="clearfix"></div>
      <hr class="hr-panel-heading" />
      <div class="row">
         <div class="col-md-12">
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="tab_proposal">
                  <div class="row mtop10">
                     <?php if($proposal->status == 3 && !empty($proposal->acceptance_firstname) && !empty($proposal->acceptance_lastname) && !empty($proposal->acceptance_email)){ ?>
                     <div class="col-md-12">
                        <div class="alert alert-info">
                           <?php echo _l('accepted_identity_info',array(
                              _l('proposal_lowercase'),
                              '<b>'.$proposal->acceptance_firstname . ' ' . $proposal->acceptance_lastname . '</b> (<a href="mailto:'.$proposal->acceptance_email.'">'.$proposal->acceptance_email.'</a>)',
                              '<b>'. _dt($proposal->acceptance_date).'</b>',
                              '<b>'.$proposal->acceptance_ip.'</b>'.(is_admin() ? '&nbsp;<a href="'.admin_url('proposals/clear_acceptance_info/'.$proposal->id).'" class="_delete text-muted" data-toggle="tooltip" data-title="'._l('clear_this_information').'"><i class="fa fa-remove"></i></a>' : '')
                              )); ?>
                        </div>
                     </div>
                     <?php } ?>
                     <div class="col-md-6">
                        <h4 class="bold">
                           <?php
                              $tags = get_tags_in($proposal->id,'proposal');
                              if(count($tags) > 0){
                               echo '<i class="fa fa-tag" aria-hidden="true" data-toggle="tooltip" data-title="'.implode(', ',$tags).'"></i>';
                              }
                              ?>
                           <a href="<?php echo admin_url('proposals/proposal/'.$proposal->id); ?>">
                           <span id="proposal-number">
                           <?php echo format_proposal_number($proposal->id); ?>
                           </span>
                           </a>
                        </h4>
                        <h5 class="bold mbot15 font-medium"><a href="<?php echo admin_url('proposals/proposal/'.$proposal->id); ?>"><?php echo $proposal->subject; ?></a></h5>
                        <address>
                           <?php echo format_organization_info(); ?>
                        </address>
                     </div>
                     <div class="col-md-6 text-right">
                        <address>
                           <span class="bold"><?php echo _l('proposal_to'); ?>:</span><br />
                           <?php echo get_proposal_to_data($proposal->id); ?>
                        </address>
                     </div>
                  </div>
                  <hr class="hr-panel-heading" />
                  <?php
                     if(count($proposal->attachments) > 0){ ?>
                  <p class="bold"><?php echo _l('proposal_files'); ?></p>
                  <?php foreach($proposal->attachments as $attachment){
                     $attachment_url = site_url('download/file/sales_attachment/'.$attachment['attachment_key']);
                     if(!empty($attachment['external'])){
                        $attachment_url = $attachment['external_link'];
                     }
                     ?>
                  <div class="mbot15 row" data-attachment-id="<?php echo $attachment['id']; ?>">
                     <div class="col-md-8">
                        <div class="pull-left"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i></div>
                        <a href="<?php echo $attachment_url; ?>" target="_blank"><?php echo $attachment['file_name']; ?></a>
                        <br />
                        <small class="text-muted"> <?php echo $attachment['filetype']; ?></small>
                     </div>
                     <div class="col-md-4 text-right">
                        <?php if($attachment['visible_to_customer'] == 0){
                           $icon = 'fa-toggle-off';
                           $tooltip = _l('show_to_customer');
                           } else {
                           $icon = 'fa-toggle-on';
                           $tooltip = _l('hide_from_customer');
                           }
                           ?>
                        <a href="#" data-toggle="tooltip" onclick="toggle_file_visibility(<?php echo $attachment['id']; ?>,<?php echo $proposal->id; ?>,this); return false;" data-title="<?php echo $tooltip; ?>"><i class="fa <?php echo $icon; ?>" aria-hidden="true"></i></a>
                        <?php if($attachment['staffid'] == get_staff_user_id() || is_admin()){ ?>
                        <a href="#" class="text-danger" onclick="delete_proposal_attachment(<?php echo $attachment['id']; ?>); return false;"><i class="fa fa-times"></i></a>
                        <?php } ?>
                     </div>
                  </div>
                  <?php } ?>
                  <?php } ?>
                  <div class="clearfix"></div>
                  <?php if(isset($proposal_merge_fields)){ ?>
                  <p class="bold text-right"><a href="#" onclick="slideToggle('.avilable_merge_fields'); return false;"><?php echo _l('available_merge_fields'); ?></a></p>
                  <hr class="hr-panel-heading" />
                  <div class="hide avilable_merge_fields mtop15">
                     <div class="row">
                        <div class="col-md-12">
                           <ul class="list-group">
                              <?php foreach($proposal_merge_fields as $field){
                                 foreach($field as $f){
                                 if($f['key'] != '{email_signature}'){
                                   echo '<li class="list-group-item"><b>'.$f['name'].'</b> <a href="#" class="pull-right" onclick="insert_proposal_merge_field(this); return false;">'.$f['key'].'</a></li>';
                                 }
                                 }
                                 } ?>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <div class="editable proposal tc-content" id="proposal_content_area" style="border:1px solid #d2d2d2;min-height:70px;border-radius:4px;">
                     <?php if(empty($proposal->content)){
                        echo '<span class="text-danger text-uppercase mtop15 editor-add-content-notice"> ' . _l('click_to_add_content') . '</span>';
                        } else {
                        echo $proposal->content;
                        }
                        ?>
                  </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="tab_comments">
                  <div class="row proposal-comments mtop15">
                     <div class="col-md-12">
                        <div id="proposal-comments"></div>
                        <div class="clearfix"></div>
                        <textarea name="content" id="comment" rows="4" class="form-control mtop15 proposal-comment"></textarea>
                        <button type="button" class="btn btn-info mtop10 pull-right" onclick="add_proposal_comment();"><?php echo _l('proposal_add_comment'); ?></button>
                     </div>
                  </div>
               </div>
			   <div role="tabpanel" class="tab-pane" id="tab_approval">
                  <div class="row proposal-comments mtop15">
                     <div class="col-md-12">
                        <div class="panel_s no-shadow leaddv">
					<?php
						$checkproposal=$this->db->query("SELECT * FROM `tblproposals` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$proposalid."'")->result_array();
						//$proposalapproval=$this->db->query("SELECT * FROM `tblproposalstaffapproval` WHERE `lead_id`='".$proposalid."'")->row_array();
						$proposalapproval=[];
						if(count($checkproposal)>0 && count($proposalapproval)==0)
						{
						foreach($allStaffdata as $singlegroup)
						{?>
							<h4><?php echo $singlegroup['name'];?></h4>
							<div class="activity-feed">
							<?php
							foreach($singlegroup['staffs'] as $singlestaff)
							{?>
								<div style="margin-bottom: 14px;" class="checkbox checkbox-primary">
									<input type="checkbox" name="staffs[]" value="<?php echo $singlestaff['staffid'];?>" id="contact_primary<?php echo $singlestaff['staffid'];?>">
									<label style="width:100%;" for="contact_primary<?php echo $singlestaff['staffid'];?>"><span style="font-size:14px;"><?php echo $singlestaff['firstname'].' '.$singlestaff['lastname'].' - '.$singlestaff['email'];?></span></label>
								</div>
						<?php
							}?>			
							</div>
					<?php
						}?>
							<div class="col-md-12">
							   <div class="text-right">
								  <button id="proposal_approval" class="btn btn-info proposal_approval"  value="<?php echo $proposalid;?>">Send For Approval</button>
							   </div>
							</div>
							<?php
						}
						else if(count($checkproposal)==0)
						{
							$propdetails=$this->db->query("SELECT * FROM `tblproposals` WHERE `id`='".$proposalid."'")->row_array();
								if(count($proposalapproval)>0 && $proposalapproval['approve_status']==0)
								{?>
									<div class="panel_s no-shadow leadsdv">
										<div class="activity-feed">
										  <div class="col-md-12">
											<h4>Would you like to accept this Proposal?</h4>
											<div class="text-right">
												<input type="hidden" id="addedfrom" value="<?php echo $propdetails['addedfrom']; ?>">
												<div class="form-group">
													<textarea id="proposal_desc" placeholder="Enter Reason"class="form-control proposal_desc" rows="4" enabled="enabled"></textarea>
												</div>
												<button val="<?php echo $proposalid;?>"class="btn btn-success approval" value="1"><?php echo 'Accept'; ?></button>
												<button val="<?php echo $proposalid;?>" class="btn btn-info approval" value="2"><?php echo 'Decline'; ?></button>
											</div>
										  </div>
										</div>
									</div>
									<div class="leadaccept" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Proposal is Accept Successfully.</div>
									<div class="leaddecline" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Proposal is Decline Successfully.</div>
					<?php
								}
								else
								{?>
									<table class="table table-proposals dataTable no-footer dtr-inline" id="DataTables_Table_1">
										<thead style="background: #f6f8fa;">
											<tr>
												<th width="20%">Name</th>
												<th width="30%"> Approve Status</th>
												<th width="25%">Approve reason</th>
												<th width="20%">Date</th>
											</tr>
										</thead>
										<tbody>
									<?php
									//$staffapprov=$this->db->query(" SELECT * FROM `tblproposalstaffapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`lead_id`='".$proposalid."' GROUP BY aps.staff_id")->result_array();
									foreach($staffapprov as $singleapprovstaff)
									{?>
										<tr>
											<td><span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' '.$singleapprovstaff['lastname'].'<br/> '.$singleapprovstaff['email']; ?></span></td>
											<td><?php if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;"> Sent</span>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;">Accepted</span>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;">Decline</span>';}	?></td>
											<td><?php if($singleapprovstaff['approvereason']!=''){echo $singleapprovstaff['approvereason'];}else{echo'-';}?></td>
											<td><?php if($singleapprovstaff['created_at']!=''){echo date('d M Y h:i:s',strtotime($singleapprovstaff['created_at']));}else{echo'-';}?></td>
										</tr>
									<?php
									}?>
									</tbody>
									</table>
									<?php
								}
												
						}
						else
						{?>
							<table class="table " id="DataTables_Table_1">
								<thead style="background: #f6f8fa;">
									<tr>
										<th width="20%">Name</th>
										<th width="30%"> Approve Status</th>
										<th width="25%">Approve reason</th>
										<th width="20%">Date</th>
									</tr> 
								</thead>
								<tbody>
						<?php
							//$staffapprov=$this->db->query(" SELECT * FROM `tblproposalstaffapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`lead_id`='".$proposalid."' GROUP BY aps.staff_id")->result_array();
							foreach($staffapprov as $singleapprovstaff)
							{?>
							<tr>
								<td><span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' '.$singleapprovstaff['lastname'].' <br/> '.$singleapprovstaff['email']; ?></span></td>
								<td><?php if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;"> Sent</span>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;"> Accepted</span>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;"> Decline</span>';}	?></td>
								<td><?php if($singleapprovstaff['approvereason']!=''){echo $singleapprovstaff['approvereason'];}else{echo'-';}?></td>
								<td><?php if($singleapprovstaff['created_at']!=''){echo date('d M Y h:i:s',strtotime($singleapprovstaff['created_at']));}else{echo'-';}?></td>
							</tr>
							<?php
							}?>
								</tbody>
							</table>
					<?php
						}?>
						
						<div class="leadSuccess" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Proposal Send to Staff For Approval.</div>
                        <div class="clearfix"></div>
                     
                  </div>
               </div>
               </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="tab_emails_tracking">
                  <?php
                     $this->load->view('admin/includes/emails_tracking',array(
                       'tracked_emails'=>
                       get_tracked_emails($proposal->id, 'proposal'))
                       );
                     ?>
               </div>
               <div role="tabpanel" class="tab-pane" id="tab_tasks">
                  <?php init_relation_tasks_table(array( 'data-new-rel-id'=>$proposal->id,'data-new-rel-type'=>'proposal')); ?>
               </div>
               <div role="tabpanel" class="tab-pane" id="tab_reminders">
                  <a href="#" data-toggle="modal" class="btn btn-info" data-target=".reminder-modal-proposal-<?php echo $proposal->id; ?>"><i class="fa fa-bell-o"></i> <?php echo _l('proposal_set_reminder_title'); ?></a>
                  <hr />
                  <?php render_datatable(array( _l( 'reminder_description'), _l( 'reminder_date'), _l( 'reminder_staff'), _l( 'reminder_is_notified')), 'reminders'); ?>
                  <?php $this->load->view('admin/includes/modals/reminder',array('id'=>$proposal->id,'name'=>'proposal','members'=>$members,'reminder_title'=>_l('proposal_set_reminder_title'))); ?>
               </div>
               <div role="tabpanel" class="tab-pane ptop10" id="tab_views">
                  <?php
                     $views_activity = get_views_tracking('proposal',$proposal->id);
                       if(count($views_activity) === 0) {
                     echo '<h4 class="no-margin">'._l('not_viewed_yet',_l('proposal_lowercase')).'</h4>';
                     }
                     foreach($views_activity as $activity){ ?>
                  <p class="text-success no-margin">
                     <?php echo _l('view_date') . ': ' . _dt($activity['date']); ?>
                  </p>
                  <p class="text-muted">
                     <?php echo _l('view_ip') . ': ' . $activity['view_ip']; ?>
                  </p>
                  <hr />
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('admin/proposals/send_proposal_to_email_template'); ?>
<script>
   init_btn_with_tooltips();
   init_datepicker();
   init_selectpicker();
   init_form_reminder();
   init_tabs_scrollable();
     // defined in manage proposals
     proposal_id = '<?php echo $proposal->id; ?>';
     init_proposal_editor();
</script>
<script>
$('.proposal_approval').click(function(){
	  var proposalid=$(this).attr('value');
	  var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
		var staffid=val;
		var url = '<?php echo base_url(); ?>admin/Proposals/sendapproval';
		$.post(url,
				{
					staffid: staffid,
					proposalid: proposalid,
				},
				function (data, status) {
					$('.leaddv').hide();
					$('.leadSuccess').show();
					
				});
				
   });
   $('.approval').click(function()
   {
	  var leadid=$(this).attr('val');
	  var approve_status=$(this).attr('value');
	  var leadcreatorid=$('#addedfrom').val();
	  var proposal_description=$('.proposal_desc').val();
	  var url = '<?php echo base_url(); ?>admin/Proposals/approvalaccept';
	  if(proposal_description.trim()!='')
	  {
	  $.post(url,
				{
					approve_status: approve_status,
					leadid: leadid,
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