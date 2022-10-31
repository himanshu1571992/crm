<?php init_head(); ?>

<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height:98px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<!-- <input id="check_gst" type='hidden' value="<?php if(isset($proposal->is_gst)){if ($proposal->is_gst == 1){echo'1';}else{echo'0';}}else{if($clientsate == get_staff_state()){echo'1';}else{echo'0';}} ?>"> -->

<input id="check_gst" type='hidden' value="0">

<!-- Modal Contact -->

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <?php echo form_open('admin/clients/contact/' . $customer_id . '/' . $contactid, array('id' => 'contact-form', 'autocomplete' => 'off')); ?>

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?><br /><small class="color-white" id=""><?php echo get_company_name($customer_id, true); ?></small></h4>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-12">

                        <input type="hidden" name="cust_id" id="cust_id">

                        <?php if (isset($contact)) { ?>

                            <img src="<?php echo contact_profile_image_url($contact->id, 'thumb'); ?>" id="contact-img" class="client-profile-image-thumb">

                            <?php if (!empty($contact->profile_image)) { ?>

                                <a href="#" onclick="delete_contact_profile_image(<?php echo $contact->id; ?>); return false;" class="text-danger pull-right" id="contact-remove-img"><i class="fa fa-remove"></i></a>

                            <?php } ?>

                            <hr />

                        <?php } ?>

                        <div id="contact-profile-image" class="form-group <?php echo (isset($contact) && !empty($contact->profile_image)) ? 'hide' : ""; ?>">

                            <label for="profile_image" class="profile-image"><?php echo _l('client_profile_image'); ?></label>

                            <input type="file" name="profile_image" class="form-control" id="profile_image">

                        </div>

                        <?php if (isset($contact)) { ?>

                            <div class="alert alert-warning hide" role="alert" id="contact_proposal_warning">

                                <?php echo _l('proposal_warning_email_change', array(_l('contact_lowercase'), _l('contact_lowercase'), _l('contact_lowercase'))); ?>

                                <hr />

                                <a href="#" id="contact_update_proposals_emails" data-original-email="" onclick="update_all_proposal_emails_linked_to_contact(<?php echo $contact->id; ?>); return false;"><?php echo _l('update_proposal_email_yes'); ?></a>

                                <br />

                                <a href="#" onclick="close_modal_manually('#contact'); return false;"><?php echo _l('update_proposal_email_no'); ?></a>

                            </div>

                        <?php } ?>

                        <!-- // For email exist check -->

                        <?php echo form_hidden('contactid', $contactid); ?>

                        <?php $value = ( isset($contact) ? $contact->firstname : ''); ?>

                        <?php echo render_input('firstname', 'client_firstname', $value); ?>

                        <?php $value = ( isset($contact) ? $contact->lastname : ''); ?>

                        <?php echo render_input('lastname', 'client_lastname', $value); ?>

                        <?php $value = ( isset($contact) ? $contact->title : ''); ?>

                        <?php echo render_input('title', 'contact_position', $value); ?>

                        <?php $value = ( isset($contact) ? $contact->email : ''); ?>

                        <?php echo render_input('email', 'client_email', $value, 'email'); ?>

                        <?php $value = ( isset($contact) ? $contact->phonenumber : ''); ?>

                        <?php echo render_input('phonenumber', 'client_phonenumber', $value, 'text', array('autocomplete' => 'off')); ?>

                        <div class="form-group">

                            <label for="contact_type" class="control-label"><?php echo _l('contact_type'); ?></label>

                            <select class="form-control selectpicker" data-live-search="true" id="contact_type" name="contact_type">

                                <option value=""></option>

                                <?php

                                if (isset($contact_type_data) && count($contact_type_data) > 0) {

                                    foreach ($contact_type_data as $contact_type_key => $contact_type_value) {

                                        ?>

                                        <option value="<?php echo $contact_type_value['id'] ?>" <?php echo (isset($contact->contact_type) && $contact->contact_type == $contact_type_value['id']) ? 'selected' : "" ?>><?php echo $contact_type_value['contact_type'] ?></option>

                                        <?php

                                    }

                                }

                                ?>

                            </select>

                        </div>

                        <div class="form-group contact-direction-option">

                            <label for="direction"><?php echo _l('document_direction'); ?></label>

                            <select class="selectpicker" data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%" name="direction" id="direction">

                                <option value="" <?php echo (isset($contact) && empty($contact->direction)) ? 'selected' : ""; ?>></option>

                                <option value="ltr" <?php echo (isset($contact) && $contact->direction == 'ltr') ? 'selected' : ""; ?>>LTR</option>

                                <option value="rtl" <?php echo (isset($contact) && $contact->direction == 'rtl') ? 'selected' : ""; ?>>RTL</option>

                            </select>

                        </div>

                        <?php

                        $rel_id = ( isset($contact) ? $contact->id : false);

                        echo render_custom_fields('contacts', $rel_id);

                        ?>



                        <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->

                        <input  type="text" class="fake-autofill-field" name="fakeusernameremembered" value='' tabindex="-1" />

                        <input  type="password" class="fake-autofill-field" name="fakepasswordremembered" value='' tabindex="-1"/>



                        <div class="client_password_set_wrapper">

                            <label for="password" class="control-label">

                                <?php echo _l('client_password'); ?>

                            </label>

                            <div class="input-group">



                                <input type="password" class="form-control password" name="password" autocomplete="false">

                                <span class="input-group-addon">

                                    <a href="#password" class="show_password" onclick="showPassword('password'); return false;"><i class="fa fa-eye"></i></a>

                                </span>

                                <span class="input-group-addon">

                                    <a href="#" class="generate_password" onclick="generatePassword(this);return false;"><i class="fa fa-refresh"></i></a>

                                </span>

                            </div>

                            <?php if (isset($contact)) { ?>

                                <p class="text-muted">

                                    <?php echo _l('client_password_change_populate_note'); ?>

                                </p>

                                <?php

                                if ($contact->last_password_change != NULL) {

                                    echo _l('client_password_last_changed');

                                    echo '<span class="text-has-action" data-toggle="tooltip" data-title="' . _dt($contact->last_password_change) . '"> ' . time_ago($contact->last_password_change) . '</span>';

                                }

                            }

                            ?>

                        </div>

                        <hr />

                        <div class="checkbox checkbox-primary">

                            <input type="checkbox" name="is_primary" id="contact_primary" <?php

                            if ((!isset($contact) && total_rows('tblcontacts', array('is_primary' => 1, 'userid' => $customer_id)) == 0) || (isset($contact) && $contact->is_primary == 1)) {

                                echo 'checked';

                            };

                            ?> <?php

                            if ((isset($contact) && total_rows('tblcontacts', array('is_primary' => 1, 'userid' => $customer_id)) == 1 && $contact->is_primary == 1)) {

                                echo 'disabled';

                            }

                            ?>>

                            <label for="contact_primary">

                                <?php echo _l('contact_primary'); ?>

                            </label>

                        </div>

                        <?php if (!isset($contact) && total_rows('tblemailtemplates', array('slug' => 'new-client-created', 'active' => 0)) == 0) { ?>

                            <div class="checkbox checkbox-primary">

                                <input type="checkbox" name="donotsendwelcomeemail" id="donotsendwelcomeemail">

                                <label for="donotsendwelcomeemail">

                                    <?php echo _l('client_do_not_send_welcome_email'); ?>

                                </label>

                            </div>

                        <?php } ?>

                        <?php if (total_rows('tblemailtemplates', array('slug' => 'contact-set-password', 'active' => 0)) == 0) { ?>

                            <div class="checkbox checkbox-primary">

                                <input type="checkbox" name="send_set_password_email" id="send_set_password_email">

                                <label for="send_set_password_email">

                                    <?php echo _l('client_send_set_password_email'); ?>

                                </label>

                            </div>

                        <?php } ?>

                        <hr />

                        <p class="bold"><?php echo _l('customer_permissions'); ?></p>

                        <p class="text-danger"><?php echo _l('contact_permissions_info'); ?></p>

                        <?php

                        $default_contact_permissions = array();

                        if (!isset($contact)) {

                            $default_contact_permissions = @unserialize(get_option('default_contact_permissions'));

                        }

                        ?>

                        <?php foreach ($customer_permissions as $permission) { ?>

                            <div class="col-md-6 row">

                                <div class="row">

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><?php echo $permission['name']; ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="<?php echo $permission['id']; ?>" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && has_contact_permission($permission['short_name'], $contact->id) || is_array($default_contact_permissions) && in_array($permission['id'], $default_contact_permissions)) {

                                                echo 'checked';

                                            }

                                            ?> value="<?php echo $permission['id']; ?>" name="permissions[]">

                                            <label class="onoffswitch-label" for="<?php echo $permission['id']; ?>"></label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                        <?php } ?>

                        <hr />

                        <p class="bold"><?php echo _l('email_notifications'); ?><?php

                            if (is_sms_trigger_active()) {

                                echo '/SMS';

                            }

                            ?></p>

                        <div id="contact_email_notifications">

                            <div class="col-md-6 row">

                                <div class="row">

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><?php echo _l('invoice'); ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="invoice_emails" data-perm-id="1" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && $contact->invoice_emails == '1') {

                                                echo 'checked';

                                            }

                                            ?>  value="invoice_emails" name="invoice_emails">

                                            <label class="onoffswitch-label" for="invoice_emails"></label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 row">

                                <div class="row">

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><?php echo _l('estimate'); ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="estimate_emails" data-perm-id="2" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && $contact->estimate_emails == '1') {

                                                echo 'checked';

                                            }

                                            ?>  value="estimate_emails" name="estimate_emails">

                                            <label class="onoffswitch-label" for="estimate_emails"></label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 row">

                                <div class="row">

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><?php echo _l('credit_note'); ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="credit_note_emails" data-perm-id="1" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && $contact->credit_note_emails == '1') {

                                                echo 'checked';

                                            }

                                            ?>  value="credit_note_emails" name="credit_note_emails">

                                            <label class="onoffswitch-label" for="credit_note_emails"></label>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="col-md-6 row">

                                <div class="row">

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><?php echo _l('project'); ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="project_emails" data-perm-id="6" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && $contact->project_emails == '1') {

                                                echo 'checked';

                                            }

                                            ?>  value="project_emails" name="project_emails">

                                            <label class="onoffswitch-label" for="project_emails"></label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 row">

                                <div class="row">

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><?php echo _l('tickets'); ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="ticket_emails" data-perm-id="5" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && $contact->ticket_emails == '1') {

                                                echo 'checked';

                                            }

                                            ?>  value="ticket_emails" name="ticket_emails">

                                            <label class="onoffswitch-label" for="ticket_emails"></label>

                                        </div>

                                    </div>

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><i class="fa fa-question-circle" data-toggle="tooltip" data-title="<?php echo _l('only_project_tasks'); ?>"></i> <?php echo _l('task'); ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="task_emails" data-perm-id="6" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && $contact->task_emails == '1') {

                                                echo 'checked';

                                            }

                                            ?>  value="task_emails" name="task_emails">

                                            <label class="onoffswitch-label" for="task_emails"></label>

                                        </div>

                                    </div>



                                </div>

                            </div>

                            <div class="col-md-6 row">

                                <div class="row">

                                    <div class="col-md-6 mtop10 border-right">

                                        <span><?php echo _l('contract'); ?></span>

                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <div class="onoffswitch">

                                            <input type="checkbox" id="contract_emails" data-perm-id="3" class="onoffswitch-checkbox" <?php

                                            if (isset($contact) && $contact->contract_emails == '1') {

                                                echo 'checked';

                                            }

                                            ?>  value="contract_emails" name="contract_emails">

                                            <label class="onoffswitch-label" for="contract_emails"></label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>

                <button type="button" class="btn btn-info addcont" data-loading-text="<?php echo _l('wait_text'); ?>" autocomplete="off" data-form="#contact-form"><?php echo _l('submit'); ?></button>

            </div>

            <?php echo form_close(); ?>

        </div>

    </div>

</div>









<div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog modal-lg">

        <?php echo form_open('admin/Stock/converttask', array('id' => 'stock')); ?>

        <!-- Modal content-->

        <textarea name="availablestockarray" id="availablestockarray" style="display:none;"></textarea>

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title"><?php echo _l('check_availability'); ?></h4>

            </div>

            <div class="modal-body" id="stockavdv">

            </div>

            <div class="modal-footer">

                <!--<button type="submit" class="btn btn-info uploadpdf">Upload</button>-->

                <button type="submit" class="btn btn-info"  ><?php echo _l('add_task'); ?></button>

                <button type="button" id="cmd" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>

        <?php echo form_close(); ?>

    </div>

</div>

<div id="wrapper">

    <div class="content accounting-template">

        <a data-toggle="modal" id="modal" data-target="#myModal"></a>

        <div class="row">

            <?php

            if (isset($proposal)) {

                echo form_hidden('isedit', $proposal->id);

            }

            $rel_type = '';

            $rel_id = '';

            if (isset($proposal) || ($this->input->get('rel_id') && $this->input->get('rel_type'))) {

                if ($this->input->get('rel_id')) {

                    $rel_id = $this->input->get('rel_id');

                    $rel_type = $this->input->get('rel_type');

                } else {

                    $rel_id = (!empty($proposal->rel_id)) ? $proposal->rel_id : '';

                    $rel_type = (!empty($proposal->rel_type)) ? $proposal->rel_type : '';

                }

            }

            ?>

            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="f_client_id">

                                    <div class="form-group select-placeholder">

                                        <label for="clientid" class="control-label"><?php echo _l('estimate_select_customer'); ?></label>







                                        <!-- <select required="" class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">

                                            <option value=""></option>

                                            <?php

                                            if (isset($client_branch_data) && count($client_branch_data) > 0) {

                                                foreach ($client_branch_data as $client_value) {



                                                    foreach($client_value['compnybranch'] as $singlevalue)

                                                    {



                                                        ?>

                                                        <option value="<?php echo $singlevalue['userid'] ?>" <?php echo (isset($estimate->clientid) && $estimate->clientid == $singlevalue['userid']) ? 'selected' : "" ?>><?php echo $singlevalue['client_branch_name'].' - '.$singlevalue['email_id']; ?></option>

                                                        <?php

                                                     }

                                                }

                                            }

                                            ?>

                                        </select> -->

                                        <select required="" class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">

                                            <option value=""></option>

                                            <?php

                                            foreach($client_branch_data as $singlevalue)
                                            {
                                                ?>

                                                <option value="<?php echo $singlevalue['userid'] ?>" <?php echo (isset($estimate->clientid) && $estimate->clientid == $singlevalue['userid']) ? 'selected' : "" ?>><?php echo cc($singlevalue['client_branch_name']).' - '.$singlevalue['email_id']; ?></option>

                                                <?php
                                             }

                                            ?>

                                        </select>









                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <label class="label-control subHeads add_site_div_new" style="float:right;">

                                        <a class="newsite">Add Site <i class="fa fa-window-restore"></i></a></label>

                                </div>

                                <div class="sitedv" style="display:none;">

                                    <div >

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="sitename" class="control-label"><?php echo _l('site_name'); ?>* </label>

                                                <input type="text" id="sitename" class="form-control" >

                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="sitelocation" class="control-label"><?php echo _l('site_location'); ?>* </label>

                                                <input type="text" id="sitelocation" class="form-control">

                                            </div>

                                        </div>

                                    </div>



                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="sitedescription" class="control-label"><?php echo _l('site_description'); ?></label>

                                            <textarea id="sitedescription" class="form-control"></textarea>

                                        </div>

                                    </div>



                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="siteaddress" class="control-label"><?php echo _l('site_address'); ?>* </label>

                                            <textarea id="siteaddress" class="form-control" ></textarea>

                                        </div>

                                    </div>



                                    <div>

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="sitestate_id" class="control-label"><?php echo _l('site_state'); ?></label>

                                                <select class="form-control selectpicker" id="sitestate_id" onchange="get_city_by_stateval(this.value)" data-live-search="true">

                                                    <option value=""></option>

                                                    <?php

                                                    if (isset($state_data) && count($state_data) > 0) {

                                                        foreach ($state_data as $state_key => $state_value) {

                                                            ?>

                                                            <option value="<?php echo $state_value['id'] ?>" ><?php echo cc($state_value['name']); ?></option>

                                                            <?php

                                                        }

                                                    }

                                                    ?>

                                                </select>

                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="sitecity_id" class="control-label"><?php echo _l('site_city'); ?></label>

                                                <select class="form-control selectpicker" id="sitecity_id" data-live-search="true">

                                                    <option value=""></option>

                                                    <?php

                                                    if (isset($city_data) && count($city_data) > 0) {

                                                        foreach ($city_data as $city_key => $city_value) {

                                                            ?>

                                                            <option value="<?php echo $city_value['id'] ?>"><?php echo cc($city_value['name']); ?></option>

                                                            <?php

                                                        }

                                                    }

                                                    ?>

                                                </select>

                                            </div>

                                        </div>

                                    </div>



                                    <div>

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="sitelandmark" class="control-label"><?php echo _l('site_landmark'); ?>*</label>

                                                <input type="text" id="sitelandmark" class="form-control">

                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="sitepincode" class="control-label"><?php echo _l('site_pincode'); ?>* </label>

                                                <input type="text" id="sitepincode" class="form-control" >

                                            </div>

                                        </div>

                                    </div>

                                    <div class="text-left" style="margin-bottom:10px;">

                                        <button class="btn btn-success addsite" type="button"><?php echo _l('add_site'); ?></button>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="site_id" class="control-label"><?php echo _l('site_name'); ?></label>

                                    <select required="" class="form-control selectpicker" name="site_id" id="site_id" data-live-search="true">

                                        <option value=""></option>

                                        <?php

                                        if (isset($all_site) && count($all_site) > 0) {

                                            foreach ($all_site as $site_key => $site_value) {

                                                ?>

                                                <option value="<?php echo $site_value['id'] ?>" <?php echo (isset($estimate->site_id) && $estimate->site_id == $site_value['id']) ? 'selected' : "" ?>><?php echo cc($site_value['name']); ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>

                                <div class="form-group select-placeholder projects-wrapper<?php

                                if ((!isset($estimate)) || (isset($estimate) && !customer_has_projects($estimate->clientid))) {

                                    echo ' hide';

                                }

                                ?>">

                                    <label for="project_id"><?php echo _l('project'); ?></label>

                                    <div id="project_ajax_search_wrapper">

                                        <select name="project_id" id="project_id" class="projects ajax-search" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">

                                            <?php

                                            if (isset($estimate) && $estimate->project_id != 0) {

                                                echo '<option value="' . $estimate->project_id . '" selected>' . get_project_name_by_id($estimate->project_id) . '</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <a href="#" class="edit_shipping_billing_info" data-toggle="modal" data-target="#billing_and_shipping_details"><i class="fa fa-pencil-square-o"></i></a>

                                        <?php include_once(APPPATH . 'views/admin/estimates/billing_and_shipping_template.php'); ?>

                                    </div>

                                    <div class="col-md-6">

                                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>

                                        <address>

                                            <span class="billing_street">

                                                <?php $billing_street = (isset($estimate) ? $estimate->billing_street : '--'); ?>

                                                <?php $billing_street = ($billing_street == '' ? '--' : $billing_street); ?>

                                                <?php echo $billing_street; ?></span><br>

                                            <span class="billing_city">

                                                <?php $billing_city = (isset($estimate) ? $estimate->billing_city : '--'); ?>

                                                <?php $billing_city = ($billing_city == '' ? '--' : $billing_city); ?>

                                                <?php echo $billing_city; ?></span>,

                                            <span class="billing_state">

                                                <?php $billing_state = (isset($estimate) ? $estimate->billing_state : '--'); ?>

                                                <?php $billing_state = ($billing_state == '' ? '--' : $billing_state); ?>

                                                <?php echo $billing_state; ?></span>

                                            <br/>

                                            <!-- <span class="billing_country">

                                                <?php $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--'); ?>

                                                <?php $billing_country = ($billing_country == '' ? '--' : $billing_country); ?>

                                                <?php echo $billing_country; ?></span>, -->

                                            <span class="billing_zip">

                                                <?php $billing_zip = (isset($estimate) ? $estimate->billing_zip : '--'); ?>

                                                <?php $billing_zip = ($billing_zip == '' ? '--' : $billing_zip); ?>

                                                <?php echo $billing_zip; ?></span>

                                        </address>

                                    </div>

                                    <div class="col-md-6">

                                        <p class="bold"><?php echo _l('ship_to'); ?></p>

                                        <address>

                                            <span class="shipping_street">

                                                <?php $shipping_street = (isset($estimate) ? $estimate->shipping_street : '--'); ?>

                                                <?php $shipping_street = ($shipping_street == '' ? '--' : $shipping_street); ?>

                                                <?php echo $shipping_street; ?></span><br>

                                            <span class="shipping_city">

                                                <?php $shipping_city = (isset($estimate) ? $estimate->shipping_city : '--'); ?>

                                                <?php $shipping_city = ($shipping_city == '' ? '--' : $shipping_city); ?>

                                                <?php echo $shipping_city; ?></span>,

                                            <span class="shipping_state">

                                                <?php $shipping_state = (isset($estimate) ? $estimate->shipping_state : '--'); ?>

                                                <?php $shipping_state = ($shipping_state == '' ? '--' : $shipping_state); ?>

                                                <?php echo $shipping_state; ?></span>

                                            <br/>

                                            <!-- <span class="shipping_country">

                                                <?php $shipping_country = (isset($estimate) ? get_country_short_name($estimate->shipping_country) : '--'); ?>

                                                <?php $shipping_country = ($shipping_country == '' ? '--' : $shipping_country); ?>

                                                <?php echo $shipping_country; ?></span>, -->

                                            <span class="shipping_zip">

                                                <?php $shipping_zip = (isset($estimate) ? $estimate->shipping_zip : '--'); ?>

                                                <?php $shipping_zip = ($shipping_zip == '' ? '--' : $shipping_zip); ?>

                                                <?php echo $shipping_zip; ?></span>

                                        </address>

                                    </div>

                                </div>


                                 <div class="row">

                                    <div class="col-md-6">



                                        <?php $value = (isset($estimate) ? _d($estimate->date) : _d(date('Y-m-d'))); ?>

                                        <?php echo render_date_input('date', 'Proforma Invoice Date', $value); ?>

                                    </div>

                                    <div class="col-md-6">

                                        <?php

                                        $value = '';

                                        if (isset($estimate)) {

                                            $value = _d($estimate->expirydate);

                                        } else {

                                            if (get_option('estimate_due_after') != 0) {

                                                $value = _d(date('Y-m-d', strtotime('+' . get_option('estimate_due_after') . ' DAY', strtotime(date('Y-m-d')))));

                                            }

                                        }

                                        echo render_date_input('expirydate', 'estimate_add_edit_expirydate', $value);

                                        ?>

                                    </div>


                               </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">

                                           <label for="number">Proforma Invoice Number</label>

                                           <div class="input-group">

                                              <span class="input-group-addon">

                                                 <span id="prefix">PI-</span>

                                              </span>

                                              <input type="text" name="number" id="<?php echo  (isset($estimate) ? 'estimate' : 'estimate_number' ); ?>" class="form-control" value="<?php echo  (isset($estimate) ? $estimate->number : '' ); ?>" >



                                           </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                           <label for="number">Proforma Order Number</label>

                                           <div class="input-group">

                                              <span class="input-group-addon">

                                                 <span id="prefix">PO-</span>

                                              </span>

                                              <input type="text" name="po_number" id="po_number" class="form-control" value="<?php echo  (isset($estimate) ? $estimate->po_number : '' ); ?>" >



                                           </div>

                                        </div>
                                    </div>
                                </div>





                                <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="measurement" class="control-label">Measurement</label>

                                        <select class="form-control selectpicker" required="" data-live-search="true" id="measurement" name="measurement">

                                            <option value="1" <?php echo (!empty($estimate->measurement) && $estimate->measurement == 1) ? 'selected' : '' ; ?> >Pcs</option>

                                            <option value="2" <?php echo (!empty($estimate->measurement) && $estimate->measurement == 2) ? 'selected' : '' ; ?> >Kgs</option>

                                        </select>

                                    </div>

                                 </div>



                                <div class="col-md-6">

                                    <div class="form-group ">

                                        <label for="proforma_type" class="control-label">Proforma Type</label>

                                        <select class="form-control selectpicker" id="proforma_type" name="proforma_type" data-live-search="true">

                                            <option value="" disabled selected >--Select One-</option>

                                            <?php

                                            if(!empty($type_info)){

                                                foreach ($type_info as $value) {

                                                    ?>

                                                    <option value="<?php echo $value->id; ?>" <?php echo (!empty($estimate->proforma_type) && $estimate->proforma_type == $value->id) ? 'selected' : '' ; ?>><?php echo cc($value->name); ?></option>

                                                    <?php

                                                }

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                            </div>



                                <div class="form-group">

                                    <label for="service_type" class="control-label"><?php echo _l('stock_service_type'); ?></label>

                                    <select class="form-control selectpicker" onchange="get_terms_condition()" data-live-search="true" id="service_type" name="service_type">

                                        <option value=""></option>

                                        <?php

                                        if (isset($service_type) && count($service_type) > 0) {

                                            foreach ($service_type as $service_type_key => $service_type_value) {

                                                ?>

                                                <option value="<?php echo $service_type_value['id'] ?>" <?php echo (isset($estimate) && $estimate->service_type == $service_type_value['id']) ? 'selected' : "" ?>><?php echo $service_type_value['name'] ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>

                                <span class="servicetypeerror" style="padding:2px;color:red;display:none;"> select any service type</span>

















                            </div>

                            <div class="col-md-6">

                                <div class="panel_s no-shadow">

                                    <!-- <div class="form-group">

                                        <label for="tags" class="control-label"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo _l('tags'); ?></label>

                                        <input type="text" class="tagsinput" id="tags" name="tags" value="<?php echo (isset($estimate) ? prep_tags_input(get_tags_in($estimate->id, 'estimate')) : ''); ?>" data-role="tagsinput">

                                    </div> -->



                                    <input type="hidden" name="tags" value="">






                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">



                                                <label for="enquiry_date" class="control-label">Other Charges Tax Type</label>



                                                <select class="form-control selectpicker" data-live-search="true" id="other_charges_tax" name="other_charges_tax">



                                                    <option value="2" <?php echo (!empty($estimate->other_charges_tax) && $estimate->other_charges_tax == 2) ? 'selected' : '' ; ?> >Excluding Tax</option>

                                                    <option value="1" <?php echo (!empty($estimate->other_charges_tax) && $estimate->other_charges_tax == 1) ? 'selected' : '' ; ?> >Including Tax</option>



                                                </select>



                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="enquiry_date" class="control-label">Select Bank</label>

                                                <select class="form-control selectpicker" id="bank_id"  name="bank_id" data-live-search="true">
                                                    <?php

                                                    if(!empty($bank_info)){
                                                         foreach ($bank_info as $bank_key => $bank_value) {
                                                            ?>
                                                         <option value="<?php echo $bank_value->id; ?>" <?php if(!empty($estimate->bank_id) && $estimate->bank_id == $bank_value->id){ echo 'selected'; } ?>><?php echo cc($bank_value->name); ?></option>
                                                    <?php
                                                       }
                                                      }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                </div>







                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="currency" class="control-label">Currency</label>
                                                <select required="" class="form-control selectpicker" id="currency" required="" name="currency" data-live-search="true">
                                                    <option value="0" <?php echo (!empty($estimate->currency) && $estimate->currency == 0) ? 'selected' : '' ; ?> >INR</option>
                                                    <option value="1" <?php echo (!empty($estimate->currency) && $estimate->currency == 1) ? 'selected' : '' ; ?> >USD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <?php
                                                // $s_attrs = array('disabled' => true, 'data-show-subtext' => true);
                                                // $s_attrs = do_action('estimate_currency_disabled', $s_attrs);
                                                // foreach ($currencies as $currency) {
                                                //     if ($currency['isdefault'] == 1) {
                                                //         $s_attrs['data-base'] = $currency['id'];
                                                //     }
                                                //     if (isset($estimate)) {
                                                //         if ($currency['id'] == $estimate->currency) {
                                                //             $selected = $currency['id'];
                                                //         }
                                                //     } else {
                                                //         if ($currency['isdefault'] == 1) {
                                                //             $selected = $currency['id'];
                                                //         }
                                                //     }
                                                // }
                                            ?>
                                            <?php //echo render_select('currency', $currencies, array('id', 'name', 'symbol'), 'estimate_add_edit_currency', $selected, $s_attrs); ?>
                                        </div> -->

                                        <div class="col-md-6">

                                            <div class="form-group select-placeholder">

                                                <label class="control-label"><?php echo _l('estimate_status'); ?></label>

                                                <select class="selectpicker display-block mbot15" name="status" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">

                                                    <?php foreach ($estimate_statuses as $status) { ?>

                                                        <option value="<?php echo $status; ?>" <?php

                                                        if (isset($estimate) && $estimate->status == $status) {

                                                            echo 'selected';

                                                        }

                                                        ?>><?php echo format_estimate_status($status, '', false); ?></option>

                                                            <?php } ?>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <?php $value = (isset($estimate) ? $estimate->reference_no : ''); ?>
                                            <?php echo render_input('reference_no', 'reference_no', $value); ?>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="estimate_for" class="control-label">Estimate For</label>
                                                <select class="form-control selectpicker" required="" data-live-search="true" id="estimate_for" name="estimate_for">
                                                    <option value="1" <?php echo (!empty($estimate->estimate_for) && $estimate->estimate_for == 1) ? 'selected' : '' ; ?> >Domestic</option>
                                                    <option value="2" <?php echo (!empty($estimate->estimate_for) && $estimate->estimate_for == 2) ? 'selected' : '' ; ?> >Export</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="display:none;">

                                            <?php

                                            $selected = '';

                                            foreach ($staff as $member) {

                                                if (isset($estimate)) {

                                                    if ($estimate->sale_agent == $member['staffid']) {

                                                        $selected = $member['staffid'];

                                                    }

                                                }

                                            }

                                            echo render_select('sale_agent', $staff, array('staffid', array('firstname', 'lastname')), 'sale_agent_string', $selected);

                                            ?>

                                        </div>

                                        <div class="col-md-12" style="margin-bottom:2%;">

                                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" data-live-search="true" id="assign" name="assign" required="">
                                                <option>Select</option>
                                                <?php
                                                if (isset($group_info) && count($group_info) > 0) {
                                                    $group_id = (isset($estimate)) ? $estimate->group_id : 0;
                                                    foreach ($group_info as $value) {
                                                        $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '" . $value['id'] . "' ")->row_array();
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" <?php echo (!empty($group_id) && $group_id == $value['id']) ? 'selected' : "" ?>><?php echo cc($value['name']); ?></option>
                                                        <optgroup label="Sales Person">
                                                            <?php
                                                                $employee_info = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value['sales_person_id'] . "' ")->row_array();
                                                            ?>
                                                            <option disabled value="<?php echo $employee_info['staffid'] ?>"><?php echo $employee_info['firstname'] ?></option></optgroup>
                                                        <optgroup label="Superior Person">
                                                            <?php
                                                            $superiordata = explode(',', $lead_staff_info['superior_ids']);
                                                            foreach ($superiordata as $value1) {
                                                                $employee_info1 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value1 . "' ")->row_array();
                                                                ?>
                                                                <option disabled  value="<?php echo $employee_info1['staffid'] ?>"><?php echo $employee_info1['firstname'] ?></option>
                                                                <?php }
                                                            ?></optgroup>
                                                        <optgroup label="Quote Person">
                                                            <?php
                                                            $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
                                                            foreach ($quotedata as $value2) {
                                                                $employee_info2 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value2 . "' ")->row_array();
                                                                ?>
                                                                <option disabled value="<?php echo $employee_info2['staffid'] ?>"><?php echo $employee_info2['firstname'] ?></option>
                                                                <?php }
                                                            ?></optgroup>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                            </select>
<!--                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">

                                                <option>Select</option>

                                                <?php
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {

                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                        ?>

                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                                            <?php
                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                ?>

                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                                if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {

                                                                    echo'selected';
                                                                }
                                                                ?>><?php echo $singstaff['firstname'] ?></option>

                                                            <?php }
                                                            ?>

                                                        </optgroup>

                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>-->



                                        </div>

                                        <div class="col-md-6" style="display:none;">

                                            <div class="form-group select-placeholder">

                                                <label for="discount_type" class="control-label"><?php echo _l('discount_type'); ?></label>

                                                <select name="discount_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">

                                                    <option value="" selected><?php echo _l('no_discount'); ?></option>

                                                    <option value="before_tax" <?php

                                                    if (isset($estimate)) {

                                                        if ($estimate->discount_type == 'before_tax') {

                                                            echo 'selected';

                                                        }

                                                    }

                                                    ?>><?php echo _l('discount_type_before_tax'); ?></option>

                                                    <option value="after_tax" <?php

                                                    if (isset($estimate)) {

                                                        if ($estimate->discount_type == 'after_tax') {

                                                            echo 'selected';

                                                        }

                                                    }

                                                    ?>><?php echo _l('discount_type_after_tax'); ?></option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                    <?php $value = (isset($estimate) ? $estimate->adminnote : ''); ?>

                                    <?php echo render_textarea('adminnote', 'estimate_add_edit_admin_note', $value); ?>



                                </div>

                            </div>





                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="tax_type" class="control-label">Tax Type</label>

                                    <select required="" class="form-control selectpicker" id="tax_type" name="tax_type" data-live-search="true">



                                        <option value=""></option>

                                        <option value="1" <?php echo (!empty($estimate->tax_type) && $estimate->tax_type == 1) ? 'selected' : '' ; ?> >CGST+SGST</option>

                                        <option value="2" <?php echo (!empty($estimate->tax_type) && $estimate->tax_type == 2) ? 'selected' : '' ; ?> >IGST</option>



                                    </select>

                                </div>

                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_type" class="control-label">Product Type</label>
                                    <select required="" onchange="get_terms_condition()" class="form-control selectpicker" id="product_type" required="" name="product_type" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if(isset($product_types_list) && !empty($product_types_list)){
                                              foreach ($product_types_list as $value) {
                                                 $selectcls =  (!empty($estimate->product_type) && $estimate->product_type == $value->id) ? 'selected' : '';
                                                 echo '<option value="'.$value->id.'" '.$selectcls.'>'.$value->name.'</option>';
                                              }
                                            }
                                        ?>
                                        <!-- <option value="1" <?php echo (!empty($estimate->product_type) && $estimate->product_type == 1) ? 'selected' : '' ; ?> >Scaffold</option>
                                        <option value="2" <?php echo (!empty($estimate->product_type) && $estimate->product_type == 2) ? 'selected' : '' ; ?> >Boom Lift</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker warehouse_id" data-live-search="true" id="warehouse_id" name="warehouse_id[]">
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
                                <span class="warehouseerror" style="padding:2px;color:red;display:none;"> select any warehouse</span>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $pdf_line_breakvalue = (isset($estimate) ? $estimate->pdf_line_break : 0); ?>
                                    <?php  echo render_input('pdf_line_break', 'PDF Line Break', $pdf_line_breakvalue); ?>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <button class="btn btn-success check_availability" type="button" style="float:right;">

                                <?php echo _l('check_availability'); ?>

                            </button>
                        </div>

                        </div>

                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                            <p class="no-mbot pull-left mtop5 btn-toolbar-notice"><?php echo _l('include_proposal_items_merge_field_help', '<b>{proposal_items}</b>'); ?></p>

                            <?php if ($proposal->id != '') { ?>
                                <!-- <button class="btn btn-info mleft5 proposal-form-submit transaction-submit generate_chalan fgf" type="button">

                                <?php echo 'Generate Delivery Challan'; ?>

                                </button> -->
                            <?php } ?>
                            <?php
                                $chk_parmission = get_staff_info(get_staff_user_id())->createdirectinvoice;
                                if ($chk_parmission > 0){
                            ?>
                            <a href="javascript:void(0);" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit proposal-submit-btn">
                                Direct Approve
                            </a>
                            <!-- <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                <?php echo _l('submit'); ?>
                            </button> -->
                            <?php } ?>
                            <!-- <button class="btn btn-info mleft5 proposal-form-submit transaction-submit" type="submit">

                                <?php echo _l('send_for_approval'); ?>

                            </button> -->
                            <a href="javascript:void(0);" class="btn btn-info mleft5 proposal-form-submit transaction-submit proposal-submit-btn">
                                <?php echo _l('send_for_approval'); ?>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

            <?php // $tax_value = ( isset($estimate) ? $estimate->tax_type : '1'); ?>

            <!-- <input type="hidden" id="tax_type" name="tax_type" value="<?php echo $tax_value; ?>"> -->







            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">



						<div <?php if(empty($lead_prod_rent_det)  && empty($rent_prolist)){ echo 'hidden'; } ?> id="for_rent">







                        <div class="row">

                            <div class="col-md-12">

                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_rent'); ?></h4>

                                <hr/>

                            </div>

                            <div class="col-md-12">

                                <div style="overflow-x:auto !important;">

                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:2500px !important;">

                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop renttable">

                                            <thead>

                                                <tr>

                                                    <td style="width: 10px !important;"><i class="fa fa-cog"></i></td>

                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>

                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>

                                                    <td style="width: 90px !important;"><?php echo _l('prop_pro_id'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo 'Unit'; ?></td>
                                                    <td style="width: 70px !important;"><?php echo 'SAC Code'; ?></td>

                                                    <td style="width: 70px !important;"><?php echo 'Weight'; ?></td>

                                                    <td style="width: 70px  !important;"><?php echo _l('prop_pro_qty'); ?></td>

                                                    <td style="width: 70px  !important;"><?php echo _l('prop_pro_months'); ?></td>

                                                    <td style="width: 70px  !important;"><?php echo _l('prop_pro_days'); ?></td>

                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_price'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo 'View Price'; ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>

                                                    <td style="width: 70px !important;">Tax %</td>

                                                    <td style="width: 70px !important;">Tax Amt</td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>

                                                </tr>

                                            </thead>

                                            <tbody>





                                            	<input type="hidden" id="rent_company_category" value="1">

                                                <?php



                                                $i = 0;

                                                $totprod = 0;

                                                if (isset($rent_prolist)) {

                                                    $totprod = count($rent_prolist);

                                                    ?>

                                                <input type="hidden" id="totalrentpro" value="<?php echo count($rent_prolist); ?>">



                                                <?php

                                                foreach ($rent_prolist as $single_prod_rent_det) {

                                                    $i++;

                                                    $proprice = $single_prod_rent_det['rate'];

                                                    $months = $single_prod_rent_det['months'] + ($single_prod_rent_det['days'] / 30);

                                                    //$prodprice = $proprice * $single_prod_rent_det['qty'] * $months;

                                                    $prodprice = $proprice * $single_prod_rent_det['qty'] * $months * $single_prod_rent_det['weight'];

                                                   // $totpro = $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100);
                                                    $pricelist = array();
                                                    $prodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_rent_det['pro_id'] . "'")->row_array();
                                                    if (isset($prodet['rental_price_cat_a']) || isset($prodet['rental_price_cat_b']) || isset($prodet['rental_price_cat_c']) || isset($prodet['rental_price_cat_d'])){
                                                        $pricelist = array($prodet['rental_price_cat_a'], $prodet['rental_price_cat_b'], $prodet['rental_price_cat_c'], $prodet['rental_price_cat_d']);
                                                    }
                                                    
                                                    $min_price = (!empty($pricelist)) ? min($pricelist) : 0;

                                                    $profitper = ($min_price > 0) ? (($proprice - $min_price) / $min_price) * 100 : 0;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {

                                                        $color = 'red';

                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {

                                                        $color = 'yellow';

                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {

                                                        $color = 'blue';

                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {

                                                        $color = 'green';

                                                    } else if ($profitper >= 30) {

                                                        $color = 'orange';

                                                    }





                                                    //New Logic



                                                    $rnt_dis_price = $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100);

                                                    $totpro = ((($rnt_dis_price * $single_prod_rent_det['prodtax']) / 100) + $rnt_dis_price);



                                                    ?>

                                                    <tr class="trrentpro<?php echo $i; ?>">

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger" onclick="removerentpro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                                        </td>

                                                        <td>

                                                            <a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$single_prod_rent_det['pro_id']); ?>">

                                                                <input class="form-control" type="text" name="rentproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo $single_prod_rent_det['description']; ?>">

                                                            </a>

                                                            <input value="<?php echo $single_prod_rent_det['pro_id']; ?>" name="rentproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $single_prod_rent_det['id']; ?>" name="rentproposal[<?php echo $i; ?>][itemid]" type="hidden">

                                                            <input value="<?php echo $min_price; ?>" id="averageprice<?php echo $i; ?>" type="hidden">

                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_rent_det['long_description']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_rent_det['pro_id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][unit]" readonly="" value="<?php echo get_product_unit($single_prod_rent_det['pro_id']); ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo (!empty($single_prod_rent_det['sac_code'])) ? $single_prod_rent_det['sac_code'] : ''; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="rentweight_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][weight]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $single_prod_rent_det['weight']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="rentqty_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['qty']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="rentmonths_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][months]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['months']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="rentdays_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][days]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['days']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="rentmainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $proprice; ?>" name="rentproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="rentviewprice_<?php echo $i; ?>" value="<?php echo $single_prod_rent_det['rate_view']; ?>" name="rentproposal[<?php echo $i; ?>][price_view]">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentprice_<?php echo $i; ?>" value="<?php echo $prodprice; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="rentdisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)"  value="<?php echo $single_prod_rent_det['discount']; ?>" name="rentproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="rentdisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodprice * $single_prod_rent_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentdisc_price_<?php echo $i; ?>" value="<?php echo $rnt_dis_price; ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="rentprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="0">
                                                            <input readonly="" type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][prodtax]" id="rentprod_tax_<?php echo $i; ?>" value="<?php echo $single_prod_rent_det['prodtax']; ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="renttax_amt_<?php echo $i; ?>" value="<?php echo (($rnt_dis_price * $single_prod_rent_det['prodtax']) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_<?php echo $i; ?>">
                                                          <?php echo round($totpro, 0); ?>
                                                        </td>
                                                    </tr>

                                                    <?php

                                                }

                                            }

                                            ?>

                                            </tbody>

                                        </table>

                                        <div class="col-xs-12" style="margin-top: 40px;">

                                            <label class="label-control subHeads"><a class="addmorerentpro" value="<?php echo $totprod; ?>">Add More <i class="fa fa-plus"></i></a></label>

                                        </div>

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;">

                                    <div class="col-md-3">

                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>

                                        <input readonly="" type="text" class="form-control rent_total_amt" value="<?php echo (isset($proposal) && $proposal->rentsubtotal != '') ? $proposal->rentsubtotal : ""; ?>" name="rentproposal[finalsubtotalamount]" id="rent_total_amt">

                                        <div class="sale_total_amtError error_msg"></div>

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>

                                        <input type="text" class="form-control rent_discount_percentage onlynumbers" value="<?php echo (isset($proposal) && $proposal->rent_discount_percent != '') ? $proposal->rent_discount_percent : ""; ?>" onchange="get_total_disc_rent()" name="rentproposal[finaldiscountpercentage]" id="rent_discount_percentage">

                                        <div class="sale_discount_percentageError error_msg"></div>

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>

                                        <input readonly="" type="text" class="form-control rent_discount_amt" value="<?php echo (isset($proposal) && $proposal->rent_discount_total != '') ? $proposal->rent_discount_total : ""; ?>" name="rentproposal[finaldiscountamount]" id="rent_discount_amt">

                                        <div class="sale_discount_amtError error_msg"></div>

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Quotation Amount (Rent) <span style="color:red">*</span></label>

                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control rent_total_quotation_amt" value="<?php echo (isset($proposal) && $proposal->renttotal != '') ? $proposal->renttotal : ""; ?>" name="rentproposal[totalamount]" id="rent_total_quotation_amt">

                                        <div class="sale_total_quotation_amtError error_msg"></div>

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;padding:8px;">

                                    <div class="col-md-12 pull-right">

                                        <label class="col-md-6 control-label text-right">Total Margin Profits</label>

                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;padding:0;" class="col-md-6 pull-left control-label rent_total_quotation_margin_profit text-right"></label></div>

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;padding:8px;">

                                    <div class="col-md-12 pull-right">

                                        <label class="col-md-6 control-label text-right">Amount In Words</label>

                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label rent_total_quotation_amt_in_words text-right"></label>

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;padding:8px;">

                                    <div class="col-md-12 pull-right">

                                        <label class="col-md-6 control-label text-right">Tax Amount In Words</label>

                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label rent_total_quotation_tax_amt_in_words text-right"></label>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <hr/>

                        <div class="table-responsive s_table" style="margin-top:3%;">

                            <div class="col-md-12">

                                <h4 class="no-mtop mrg3"><?php echo _l('other_charges_for_rent'); ?></h4>

                                <hr/>

                            </div>

                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">

                                <thead>

                                    <tr>

                                        <th width="40%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>

                                        <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>

                                        <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>





                                        <th width="20%" align="left">Tax</th>



                                        <th width="10%" align="left">Tax Amount </th>



                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>	</th>

                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>

                                    </tr>

                                </thead>

                                <tbody class="ui-sortable">

                                    <?php

                                    if (count($rent_othercharges) > 0) {

                                        $l = 0;

                                        foreach ($rent_othercharges as $singlerentotherchargesp) {

                                            $l++;

                                            ?>

                                            <tr id="tr<?php echo $l; ?>">

                                                <td>

                                                    <div class="form-group">

                                                        <select class="form-control selectpicker" data-live-search="true" id="othercharges<?php echo $l; ?>" onchange="otherchargesdata(<?php echo $l; ?>)" name="othercharges[<?php echo $l; ?>][category_name]">

                                                            <option value=""></option>

                                                            <?php

                                                            if (isset($othercharges) && count($othercharges) > 0) {

                                                                foreach ($othercharges as $othercharges_key => $othercharges_value) {

                                                                    ?>

                                                                    <option value="<?php echo $othercharges_value['id'] ?>" <?php

                                                                    if (isset($singlerentotherchargesp['category_name']) && $singlerentotherchargesp['category_name'] != '' && $singlerentotherchargesp['category_name'] == $othercharges_value['id']) {

                                                                        echo'selected=selected';

                                                                    }

                                                                    ?> ><?php echo cc($othercharges_value['category_name']); ?></option>

                                                                            <?php

                                                                        }

                                                                    }

                                                                    ?>

                                                        </select>

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="text" id="sac_code<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['sac_code']; ?>" name="othercharges[<?php echo $l; ?>][sac_code]" class="form-control" >

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="amount<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['amount']; ?>" name="othercharges[<?php echo $l; ?>][amount]" onchange="getothercharges('<?php echo $l; ?>')"  class="form-control" >

                                                    </div>

                                                </td>

                                                <?php

                                                if (isset($proposal->is_gst)) {

                                                    if ($proposal->is_gst == 1) {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="gst<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['gst']; ?>" name="othercharges[<?php echo $l; ?>][gst]" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sgst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlerentotherchargesp['sgst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <?php

                                                    } else {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="igst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlerentotherchargesp['igst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <?php

                                                    }

                                                } else {

                                                    if ($clientsate == get_staff_state()) {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="gst<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['gst']; ?>" name="othercharges[<?php echo $l; ?>][gst]" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sgst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlerentotherchargesp['sgst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >

                                                            </div>

                                                        </td>



                                                        <?php

                                                    } else {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="igst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlerentotherchargesp['igst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <?php

                                                    }

                                                }

                                                ?>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="gst_sgst_amt<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlerentotherchargesp['gst_sgst_amt']; ?>"  class="form-control">

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="total_maount<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlerentotherchargesp['total_maount']; ?>" class="form-control">

                                                    </div>

                                                </td>

                                                <td>

                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges('<?php echo $l; ?>');" ><i class="fa fa-remove"></i></button>

                                                </td>

                                            </tr>

                                            <?php

                                        }

                                    }else {

                                        ?>

                                        <tr id="tr0">

                                            <td>

                                                <div class="form-group">

                                                    <select class="form-control selectpicker" data-live-search="true" id="othercharges0" name="othercharges[0][category_name]">

                                                        <option value=""></option>

                                                        <?php

                                                        if (isset($othercharges) && count($othercharges) > 0) {

                                                            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                                                                ?>

                                                                <option value="<?php echo $othercharges_value['id'] ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option>

                                                                <?php

                                                            }

                                                        }

                                                        ?>

                                                    </select>

                                                </div>

                                            </td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="text" id="sac_code0" name="othercharges[0][sac_code]" class="form-control" >

                                                </div>

                                            </td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="amount0" onchange="getothercharges(0)" name="othercharges[0][amount]" class="form-control" >

                                                </div>

                                            </td>

                                            <td>

												<div class="form-group">

													<input type="number" id="igst0" onchange="getothercharges(0)" name="othercharges[0][igst]" class="form-control" >

												</div>

											</td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="sgst_amt0" name="othercharges[0][gst_sgst_amt]" class="form-control">

                                                </div>

                                            </td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="total_maount0" name="othercharges[0][total_maount]" class="form-control">

                                                </div>

                                            </td>

                                            <td>

                                                <button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges('0');" ><i class="fa fa-remove"></i></button>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                            <div class="col-xs-4">

                                <label class="label-control subHeads"><a  class="addmore" value="<?php echo count($rent_othercharges); ?>">Add More <i class="fa fa-plus"></i></a></label>

                            </div>

                            <div class="col-xs-8">

                                <label style="float : right !important;">

                                    <strong style="font-size:14px;">Other Charges Sub Total For Rent :-</strong>

                                    <strong class="rent_other_charges_subtotal">0</strong>

                                </label>

                            </div>

                        </div>







						</div>



						<div <?php if(empty($lead_prod_sale_det) && empty($sale_prolist)){ echo 'hidden'; } ?>  id="for_sale">



                        <div class="row">

                            <div class="col-md-12">

                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_sale'); ?></h4>

                                <hr/>

                            </div>

                            <div class="col-md-12">

                                <div style="overflow-x:auto !important;">

                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:2500px !important;">

                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">

                                            <thead>

                                                <tr>

                                                    <td style="width: 10px !important;"><i class="fa fa-cog"></i></td>

                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>

                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 70px !important;"><?php echo 'Unit'; ?></td>
                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>

                                                    <td style="width: 35px !important;">Weight</td>

                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_price'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>

                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>



                                                    <td style="width: 47px !important;">Tax %</td>

                                                    <td style="width: 47px !important;">Tax Amt</td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                $i = 0;

                                                if (isset($sale_prolist)) {

                                                    $totsaleprod = count($sale_prolist);

                                                    ?>

                                                <input type="hidden" id="totalsalepro" value="<?php echo count($sale_prolist); ?>">

                                                <?php

                                                foreach ($sale_prolist as $single_prod_sale_det) {

                                                    $prosaleprice = $single_prod_sale_det['rate'];

                                                    //$prodproposalprice = $prosaleprice * $single_prod_sale_det['qty'];

                                                    $prodproposalprice = $prosaleprice * $single_prod_sale_det['qty'] * $single_prod_sale_det['weight'];

                                                    //$totproamt=$prodproposalprice-(($prodproposalprice*$single_prod_sale_det['discount'])/100)+(($prodproposalprice*18)/100);

                                                   // $totproamt = $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100);

                                                    $i++;
                                                    $salepricelist = array();
                                                    $saleprodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_sale_det['pro_id'] . "'")->row_array();
                                                    if (isset($saleprodet['sale_price_cat_a']) || isset($saleprodet['sale_price_cat_b']) || isset($saleprodet['sale_price_cat_c']) || isset($saleprodet['sale_price_cat_d'])){
                                                        $salepricelist = array($saleprodet['sale_price_cat_a'], $saleprodet['sale_price_cat_b'], $saleprodet['sale_price_cat_c'], $saleprodet['sale_price_cat_d']);
                                                    }

                                                    $min_saleprice = (!empty($salepricelist)) ? min($salepricelist) : 0;

                                                    $min_salepricee[] = $min_saleprice;

                                                    $profitper = ($min_saleprice > 0) ? (($prosaleprice - $min_saleprice) / $min_saleprice) * 100 : 0;

                                                    if ($profitper >= 0 && $profitper <= 9.99) {

                                                        $color = 'red';

                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {

                                                        $color = 'yellow';

                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {

                                                        $color = 'blue';

                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {

                                                        $color = 'green';

                                                    } else if ($profitper >= 30) {

                                                        $color = 'orange';

                                                    }



                                                     //New Logic

                                                    $sale_dis_price = $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100);

                                                    $totproamt = ((($sale_dis_price * $single_prod_sale_det['prodtax']) / 100) + $sale_dis_price);





                                                    ?>

                                                    <tr class="trsalepro<?php echo $i; ?>">

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                                        </td>

                                                        <td>

                                                            <a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$single_prod_sale_det['pro_id']); ?>">

                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['description']; ?>">

                                                            </a>

                                                            <input value="<?php echo $single_prod_sale_det['pro_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">

                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_sale_det['long_description']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_sale_det['pro_id']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][unit]" readonly="" value="<?php echo get_product_unit($single_prod_sale_det['pro_id']); ?>">

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" id="saleweight_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][weight]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['weight']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * $single_prod_sale_det['qty']; ?>" id="total_price1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['discount']; ?>" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodproposalprice * $single_prod_sale_det['discount']) / 100); ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $sale_dis_price; ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="saleprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">

                                                        </td>





                                                        <td>

                                                            <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">

                                                            <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saleprod_tax_<?php echo $i; ?>" value="<?php echo $single_prod_sale_det['prodtax']; ?>">

                                                        </td>



                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" value="<?php echo (($sale_dis_price * $single_prod_sale_det['prodtax']) / 100); ?>" id="total_price1">

                                                        </td>

                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">

                                                            <?php echo round($totproamt, 0); ?>

                                                        </td>

                                                    </tr>

                                                    <?php

                                                }

                                            } else {

                                                $totsaleprod = count($lead_prod_sale_det);

                                                ?>

                                                <input type="hidden" id="totalsalepro" value="<?php echo count($lead_prod_sale_det); ?>">

                                                <?php

                                                foreach ($lead_prod_sale_det as $single_prod_sale_det) {

                                                    $i++;

                                                    if ($single_prod_sale_det['company_category'] == 1) {

                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_a'];

                                                    } else if ($single_prod_sale_det['company_category'] == 2) {

                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_b'];

                                                    } else if ($single_prod_sale_det['company_category'] == 3) {

                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_c'];

                                                    } else if ($single_prod_sale_det['company_category'] == 4) {

                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_d'];

                                                    }

                                                    $salepricelist = array($single_prod_sale_det['sale_price_cat_a'], $single_prod_sale_det['sale_price_cat_b'], $single_prod_sale_det['sale_price_cat_c'], $single_prod_sale_det['sale_price_cat_d']);

                                                    $min_saleprice = min($salepricelist);

                                                    $min_salepricee[] = min($salepricelist);

                                                    $profitper = (($prosaleprice - $min_saleprice) / $min_saleprice) * 100;

                                                    if ($profitper >= 0 && $profitper <= 9.99) {

                                                        $color = 'red';

                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {

                                                        $color = 'yellow';

                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {

                                                        $color = 'blue';

                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {

                                                        $color = 'green';

                                                    } else if ($profitper >= 30) {

                                                        $color = 'orange';

                                                    }

                                                    ?>

                                                    <tr class="trsalepro<?php echo $i; ?>">

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                                        </td>

                                                        <td>

                                                            <a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$single_prod_sale_det['id']); ?>">

                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['name']; ?>">

                                                            </a>

                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_sale_det['product_remarks']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_sale_det['id']; ?>">

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][unit]" readonly="" value="PRO-ID<?php echo get_product_unit($single_prod_sale_det['pro_id']); ?>">

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>">

                                                        </td>



                                                        <td>

                                                            <input type="text" class="form-control" id="saleweight_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][weight]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="1">

                                                        </td>



                                                        <td>

                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * 1; ?>" id="total_price1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="0.00">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $prosaleprice * 1; ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="saleprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">

                                                        </td>

                                                        <?php

                                                        if ($single_prod_rent_det['state'] == get_staff_state()) {

                                                            ?>

                                                            <td>

                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="1">

                                                                <input readonly="" type="text" class="form-control" value="9">

                                                            </td>

                                                            <td>

                                                                <input readonly="" type="text" class="form-control" value="9">

                                                            </td>

                                                            <?php

                                                        } else {

                                                            ?>

                                                            <td>

                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">

                                                                <input readonly="" type="text" class="form-control" value="18">

                                                            </td>

                                                        <?php }

                                                        ?>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" value="<?php echo (($prosaleprice * 18) / 100); ?>" id="total_price1">

                                                        </td>

                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">

                                                           <?php echo round($totproamt, 0); ?>

                                                        </td>

                                                    </tr>

                                                    <?php

                                                }

                                            }

                                            ?>

                                            </tbody>

                                        </table>

                                        <div class="col-xs-12" style="margin-top: 40px;">

                                            <label class="label-control subHeads"><a class="addmoresalepro" value="<?php echo $totsaleprod; ?>">Add More <i class="fa fa-plus"></i></a></label>

                                        </div>

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;">

                                    <div class="col-md-3">

                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>

                                        <input readonly="" type="text" class="form-control sale_total_amt" value="<?php echo (isset($proposal) && $proposal->salesubtotal != '') ? $proposal->salesubtotal : ""; ?>" name="saleproposal[finalsubtotalamount]" id="sale_total_amt">

                                        <div class="sale_total_amtError error_msg"></div>

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>

                                        <input type="text" class="form-control sale_discount_percentage onlynumbers" value="<?php echo (isset($proposal) && $proposal->sale_discount_percent != '') ? $proposal->sale_discount_percent : ""; ?>" onchange="get_total_disc_sale()" name="saleproposal[finaldiscountpercentage]" id="sale_discount_percentage">

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>

                                        <input readonly="" type="text" class="form-control sale_discount_amt" value="<?php echo (isset($proposal) && $proposal->sale_discount_total != '') ? $proposal->sale_discount_total : ""; ?>" name="saleproposal[finaldiscountamount]" id="sale_discount_amt">

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Quotation Amount (Rent) <span style="color:red">*</span></label>

                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control sale_total_quotation_amt" value="<?php echo (isset($proposal) && $proposal->saletotal != '') ? $proposal->saletotal : ""; ?>" name="saleproposal[totalamount]" id="sale_total_quotation_amt">

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;padding:8px;">

                                    <div class="col-md-12 pull-right">

                                        <label class="col-md-6 control-label text-right">Amount In Words</label>

                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_amt_in_words text-right"></label>

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;padding:8px;">

                                    <div class="col-md-12 pull-right">

                                        <label class="col-md-6 control-label text-right">Total Margin Profits</label>

                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;padding:0;" class="col-md-6 pull-left control-label sale_total_quotation_margin_profit text-right"></label></div>

                                    </div>

                                </div>

                                <div class="row" style="margin-top:2%;padding:8px;">

                                    <div class="col-md-12 pull-right">

                                        <label class="col-md-6 control-label text-right">Tax Amount In Words</label>

                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_tax_amt_in_words text-right"></label>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="table-responsive s_table" style="margin-top:3%;">

                            <div class="col-md-12">

                                <h4 class="no-mtop mrg3"><?php echo _l('other_charges_for_sale'); ?></h4>

                                <hr/>

                            </div>

                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="mysaleTable">

                                <thead>

                                    <tr>

                                        <th width="40%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>

                                        <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>

                                        <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>



                                        <th width="20%" align="left">Tax</th>



                                        <th width="10%" align="left">Tax Amount </th>

                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>	</th>

                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>

                                    </tr>

                                </thead>

                                <tbody class="ui-sortable">

                                    <?php

                                    if (count($sale_othercharges) > 0) {

                                        $l = 0;

                                        foreach ($sale_othercharges as $singlesaleothercharges) {

                                            $l++;

                                            ?>

                                            <tr id="trsale<?php echo $l; ?>">

                                                <td>

                                                    <div class="form-group">

                                                        <select class="form-control selectpicker" data-live-search="true" id="sale_othercharges<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][category_name]">

                                                            <option value=""></option>

                                                            <?php

                                                            if (isset($othercharges) && count($othercharges) > 0) {

                                                                foreach ($othercharges as $othercharges_key => $othercharges_value) {

                                                                    ?>

                                                                    <option value="<?php echo $othercharges_value['id'] ?>" <?php

                                                                    if (isset($singlesaleothercharges['category_name']) && $singlesaleothercharges['category_name'] != '' && $singlesaleothercharges['category_name'] == $othercharges_value['id']) {

                                                                        echo'selected=selected';

                                                                    }

                                                                    ?> ><?php echo cc($othercharges_value['category_name']); ?></option>

                                                                            <?php

                                                                        }

                                                                    }

                                                                    ?>

                                                        </select>

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="text" id="sale_sac_code<?php echo $l; ?>" value="<?php echo $singlesaleothercharges['sac_code']; ?>" name="saleothercharges[<?php echo $l; ?>][sac_code]" class="form-control" >

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_amount<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['amount']; ?>" name="saleothercharges[<?php echo $l; ?>][amount]" class="form-control" >

                                                    </div>

                                                </td>

                                                <?php

                                                if (isset($proposal->is_gst)) {

                                                    if ($proposal->is_gst == 1) {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sale_gst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['gst']; ?>" name="saleothercharges[<?php echo $l; ?>][gst]" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sale_sgst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlesaleothercharges['sgst']; ?>" class="form-control" >

                                                            </div>

                                                        </td>

                                                    <?php } else {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <?php

                                                    }

                                                } else {

                                                    if ($clientsate == get_staff_state()) {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sale_gst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['gst']; ?>" name="saleothercharges[<?php echo $l; ?>][gst]" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sale_sgst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlesaleothercharges['sgst']; ?>" class="form-control" >

                                                            </div>

                                                        </td>

                                                    <?php } else {

                                                        ?>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >

                                                            </div>

                                                        </td>

                                                        <?php

                                                    }

                                                }

                                                ?>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_gst_sgst_amt<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlesaleothercharges['gst_sgst_amt']; ?>" class="form-control">

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_total_maount<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlesaleothercharges['total_maount']; ?>" class="form-control">

                                                    </div>

                                                </td>

                                                <td>

                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges('<?php echo $l; ?>');" ><i class="fa fa-remove"></i></button>

                                                </td>

                                            </tr>

                                            <?php

                                        }

                                    } else {

                                        ?>

                                        <tr id="trsale0">

                                            <td>

                                                <div class="form-group">

                                                    <select class="form-control selectpicker" data-live-search="true" id="sale_othercharges0" name="saleothercharges[0][category_name]">

                                                        <option value=""></option>

                                                        <?php

                                                        if (isset($othercharges) && count($othercharges) > 0) {

                                                            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                                                                ?>

                                                                <option value="<?php echo $othercharges_value['id'] ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option>

                                                                <?php

                                                            }

                                                        }

                                                        ?>

                                                    </select>

                                                </div>

                                            </td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="text" id="sale_sac_code0" name="saleothercharges[0][sac_code]" class="form-control" >

                                                </div>

                                            </td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="sale_amount0" onchange="getothersalecharges(0)" name="saleothercharges[0][amount]" class="form-control" >

                                                </div>

                                            </td>

                                            <?php if ($clientsate == get_staff_state()) { ?>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_gst0"  value="0" onchange="getothersalecharges(0)" name="saleothercharges[0][gst]" class="form-control" >

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="text" id="sale_sgst0" value="0" onchange="getothersalecharges(0)" name="saleothercharges[0][sgst]" class="form-control" >

                                                    </div>

                                                </td>

                                            <?php } else {

                                                ?>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_igst0" onchange="getothersalecharges(0)" name="saleothercharges[0][igst]" class="form-control" >

                                                    </div>

                                                </td>

                                            <?php } ?>

                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="sale_gst_sgst_amt0" name="saleothercharges[0][gst_sgst_amt]" class="form-control">

                                                </div>

                                            </td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="sale_total_maount0" name="saleothercharges[0][total_maount]" class="form-control">

                                                </div>

                                            </td>

                                            <td>

                                                <button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges('0');" ><i class="fa fa-remove"></i></button>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                            <div class="col-xs-4">

                                <label class="label-control subHeads"><a  class="addsalemore" value="<?php echo count($sale_othercharges); ?>">Add More <i class="fa fa-plus"></i></a></label>

                            </div>

                            <div class="col-xs-8">

                                <label style="float : right !important;">

                                    <strong style="font-size:14px;">Other Charges Sub Total For Sale :-</strong>

                                    <strong class="sale_other_charges_subtotal">0</strong>

                                </label>

                            </div>

                        </div>





						</div>


                         <div class="col-md-12" style="margin-top:4%">

                            <h4 class="no-mtop mrg3">Prodcut Fields for PI</h4>

                            <hr>

                        </div>

                        <?php
                        if(!empty($productfield_info)){
                            ?>
                            <div class="col-md-12" style="overflow-x:auto !important;">
                                    <?php
                                    foreach ($productfield_info as $field) {
                                    ?>
                                    <div class="checkbox col-md-2" style="margin-top: 0; margin-bottom: 15px;">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array($field->id, $proposalfields)){echo"checked=checked";}}  ?> value="<?php echo $field->id; ?>">
                                        <label><?php echo $field->name; ?></label>

                                    </div>
                                    <?php
                                    }
                                    ?>
                            </div>
                            <hr>
                            <?php
                        }
                        ?>
                        <hr>



                        <div  class="col-md-12" style="margin-top: 15px;">

                            <div class="form-group">

                                <!-- <label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label> -->
                                <h4 class="no-mtop mrg3"><?php echo _l('terms_and_conditions'); ?></h4>
                                <hr>
                                <!-- <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions"><?php

                                    if (isset($estimate) && $estimate->terms_and_conditions != '') {

                                        echo $estimate->terms_and_conditions;

                                    } else {

                                        echo"1). Payment: 100% Advance<br/>2). Freight(Demob) will be charged extra at actual.<br/>3). Lead Time- 2-3 working days from the date of receipt of confirm order.<br/>4). Any other charges other than mentioned if incurred, shall be charged at actual. Sub Total (I) 66,000.00<br/>5). Unloading of Equipment/Material will not be in SCHACH'S scope. Freight(mob) At actual<br/>6). One time free training/Installation of scaffold/machine shall be conducted by us Sub Total (II) 66,000.00<br/>7). Security cheque (without date ) of material value will be required CGST 9% 5,940.00<br/>before material dispatch. (Material Value - 7.4 lacs) SGST 9% 5,940.00<br/>We hope our offer is in line with your requirement and we wait for your valued order, which shall receive our best and prompt attention.";

                                    }

                                    ?></textarea> -->


                                    <?php if(isset($estimate) && $estimate->terms_and_conditions!=''){ ?>
                                    <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions"><?php if (isset($estimate) && $estimate->terms_and_conditions != '') { echo $estimate->terms_and_conditions; } ?></textarea>
                                    <br>
                                    <br>
                                    <?php } ?>

                                    <div class="termsconditionmaindiv">

                                    </div>
                                    <?php if(isset($estimate) && !empty($estimate)){
                                        echo '<input type="hidden" class="relsection_id" name="relsection_id" value="'.$estimate->id.'">';
                                    } ?>


                            </div>

                        </div>
                        <div class="form-group">
                          <h4 class="no-mtop mrg3">Custom Terms & Conditions</h4>
                          <hr>
                          <!-- <div class="row"> -->
                          <?php
                              $document_name = 'estimate';
                              $relid = (isset($estimate) && !empty($estimate)) ? $estimate->id : 0;
                              $service_type = (isset($estimate) && !empty($estimate)) ? $estimate->service_type : 0;
                              $gettermscondition = $this->db->query("SELECT * FROM `tbltermsandconditions_selection_master` WHERE (`service_type` = '".$service_type."' OR `service_type` = '3') and `status` = '1' ORDER BY `order` ASC ")->result();
                              if (!empty($gettermscondition)){
                                  foreach ($gettermscondition as $k => $value) {
                                     $getermscondition = $this->db->query("SELECT * FROM `tbltermsandconditionsdetails` WHERE `master_id`='".$value->id."' AND `rel_id`='".$relid."' AND `document_name`='".$document_name."'")->row();
                                     $checked = '';
                                     if (!empty($getermscondition)){
                                       if ($getermscondition->status == 1){
                                          $checked = 'checked';
                                       }
                                     }else{
                                        $checked = ($relid == 0) ? 'checked':'';
                                     }
                          ?>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="title" class="control-label col-md-8"><?php echo ++$k; ?>) <?php echo $value->title; ?>
                                                    <?php
                                                        $disablecls = "";
                                                        if ($value->is_relative == 1){
                                                          $disablecls = "disabled";
                                                          $checked = 'checked';
                                                          echo '<input type="hidden" name="terms['.$k.'][active]" value="on">';
                                                        }
                                                    ?>
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" name="terms[<?php echo $k; ?>][active]" class="onoffswitch-checkbox termsswitch<?php echo $k; ?>" id="<?php echo $k; ?>" data-id="<?php echo $k; ?>" <?php echo $disablecls; ?> <?php echo $checked; ?>>
                                                        <label class="onoffswitch-label" for="<?php echo $k; ?>"></label>
                                                    </div>
                                                  </label>
                                                  <div class="col-md-4">
                                                    <?php if ($value->input_type == "2"){
                                                           $array_val = explode(',',$value->options);
                                                      ?>
                                                         <select class="form-control selectpicker termsconditionfield" data-row="<?php echo $k; ?>" data-title="<?php echo $value->title; ?>" data-id="<?php echo $value->id; ?>" data-live-search="true" data-defaultval="<?php echo trim($value->default_value); ?>" onchange="chkdefaltvalue('<?php echo $value->id; ?>',this.value)" id="svalue<?php echo $value->id; ?>" name="terms[<?php echo $value->id; ?>][value1]">
                                                           <option value=""></option>
                                                           <?php if (!empty($array_val)) {
                                                               foreach ($array_val as $val) {
                                                                 if (isset($getermscondition) && !empty($getermscondition->value1)){
                                                                   $selectcls = (trim($val) == trim($getermscondition->value1)) ? 'selected="selected"': '';
                                                                 }else{
                                                                   $selectcls = (trim($val) == trim($value->default_value)) ? 'selected="selected"': '';
                                                                 }
                                                                 echo '<option value="'.$val.'" '.$selectcls.'>'.$val.'</option>';
                                                               }
                                                           }?>
                                                         </select>
                                                    <?php }else{ ?>
                                                         <input type="text" data-title="<?php echo $value->title; ?>" data-row="<?php echo $k; ?>" data-id="<?php echo $value->id; ?>" class="form-control numericOnly termsconditionfield <?php echo ($value->id < 6) ? 'termpercentval': ''; ?>" id="svalue<?php echo $value->id; ?>" value="<?php echo (isset($getermscondition) && !empty($getermscondition->value1)) ? $getermscondition->value1 : ''; ?>" name="terms[<?php echo $value->id; ?>][value1]" placeholder="% Percent">
                                                    <?php } ?>
                                                  </div>
                                              </div>
                                          </div>
                                          <?php if ($value->is_extra_input == '1'){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="title" class="control-label col-md-3"><?php echo $value->extra_input_title; ?></label>
                                                    <div class="col-md-4">
                                                      <input type="text" class="form-control numericOnly" id="evalue<?php echo $value->id; ?>" name="terms[<?php echo $value->id; ?>][value2]" value="<?php echo (isset($getermscondition) && !empty($getermscondition->value2)) ? $getermscondition->value2 : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                          <?php } ?>
                                          <?php if ($value->days_week_selection == '1'){

                                              $selectiontitle = str_replace(",", " / ", $value->days_week_values);
                                              $selectionvalues = explode(',',$value->days_week_values);
                                             ?>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="title" class="control-label col-md-4"><?php echo $selectiontitle; ?></label>
                                                  <div class="col-md-4">
                                                      <select class="form-control selectpicker" data-live-search="true" id="evalue<?php echo $value->id; ?>" name="terms[<?php echo $value->id; ?>][value2]">
                                                        <?php foreach ($selectionvalues as $field) {
                                                             $selectfieldcls = (isset($getermscondition) && $getermscondition->value2 == strtolower($field)) ? 'selected=""' : '';
                                                             echo '<option value="'.strtolower($field).'" '.$selectfieldcls.'>'.$field.'</option>';
                                                        }?>
                                                      </select>
                                                  </div>
                                              </div>
                                          </div>
                                         <?php } ?>
                                       </div>
                                       <br>
                          <?php
                                  }
                              }
                          ?>
                          <!-- </div> -->
                        </div>
                    </div>

                </div>

            </div>

            <?php echo form_close(); ?>

            <?php $this->load->view('admin/invoice_items/item'); ?>

        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

</div>
<div id="productdetailsmodal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content producthtml">

        </div>    
    </div>    
</div>
<?php init_tail(); ?>

<script>
    function getproconfirmation(value, stype)
    {
        
        if (stype == 'rent'){
            var prodid=$('#prodid'+value).val();
        }else{
            var prodid=$('#saleprodid'+value).val();
        }
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/site_manager/getproductdetails'); ?>",
            data    : {'prodid' : prodid},
            success : function(data){
                if(data != ''){
                    $('#productdetailsmodal').modal({
                        show: 'false'
                    }); 
                    $('.producthtml').html(data);
                    if (stype == 'rent'){
                        $(".productdetailsbtn").html('<button type="button" class="btn btn-default close-model" onclick="removerentpro('+value+');" data-dismiss="modal">Cancel</button><button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
                    }else{
                        $(".productdetailsbtn").html('<button type="button" class="btn btn-default close-model" onclick="removesalepro('+value+');" data-dismiss="modal">Cancel</button><button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
                    }
                }
            }
        })
    }
    $('.generate_chalan').click(function ()

    {

        //alert('');

        var warehouse_id = $('#warehouse_id').val();

        var service_type = $('#service_type').val();

        var proposalid = '<?php echo $proposal->id; ?>';

        ;

        if (warehouse_id != '' & service_type != '')

        {

            var formData = $('#proposal-form').serialize();

            //formData.push({ proposalid: "1"});

            $.ajax({

                url: '<?php echo base_url(); ?>admin/Chalan/chalansession',

                type: 'post',

                //data: formData,

                data: $('#proposal-form').serialize() + "&proposalid=" + proposalid,

                success: function (data, status)

                {

                    //alert(data);die();

                    document.location = '<?php echo base_url() . 'admin/chalan/generate'; ?>';

                }

            });

        } else

        {

            if (warehouse_id == '')

            {

                $('.warehouseerror').show();

            } else

            {

                $('.warehouseerror').hide();

            }

            if (service_type == '')

            {

                $('.servicetypeerror').show();

            } else

            {

                $('.servicetypeerror').hide();

            }

        }

    });

    $('.check_availability').click(function ()

    {

        var warehouse_id = $('#warehouse_id').val();

        var service_type = $('#service_type').val();

        if (warehouse_id != '' & service_type != '')

        {

            var formData = $('#proposal-form').serialize();

            $.ajax({

                url: '<?php echo base_url(); ?>admin/Stock/getstockavailability',

                type: 'post',

                data: formData,

                success: function (data, status) {

                    var res = JSON.parse(data);

                    $('#availablestockhtml').val(res.html);

                    $('#availablestockarray').val(res.productdata);

                    $('.modal-body').html(res.html);

                    jQuery(function () {

                        jQuery('#modal').click();

                    });

                    $('.warehouseerror').hide();

                    $('.servicetypeerror').hide();

                }

            });

        } else

        {

            if (warehouse_id == '')

            {

                $('.warehouseerror').show();

            } else

            {

                $('.warehouseerror').hide();

            }

            if (service_type == '')

            {

                $('.servicetypeerror').show();

            } else

            {

                $('.servicetypeerror').hide();

            }

        }

    });

    $(function () {

        init_currency_symbol();

        // Maybe items ajax search

        init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');

        validate_proposal_form();



        $('.rel_id_label').html(_rel_type.find('option:selected').text());

        _rel_type.on('change', function () {

            var clonedSelect = _rel_id.html('').clone();

            _rel_id.selectpicker('destroy').remove();

            _rel_id = clonedSelect;

            $('#rel_id_select').append(clonedSelect);

            proposal_rel_id_select();

            if ($(this).val() != '') {

                _rel_id_wrapper.removeClass('hide');

            } else {

                _rel_id_wrapper.addClass('hide');

            }

            $('.rel_id_label').html(_rel_type.find('option:selected').text());

        });

        proposal_rel_id_select();

<?php if (!isset($proposal) && $rel_id != '') { ?>

            _rel_id.change();

<?php } ?>



    });



    function validate_proposal_form() {

        _validate_form($('#proposal-form'), {

            subject: 'required',

            proposal_to: 'required',

            rel_type: 'required',

            rel_id: 'required',

            date: 'required',

            email: {

                email: true,

                required: true

            },

            currency: 'required',

        });

    }

    function get_total_price_per_qty_rent(value)

    {

        var price = $('#rentmainprice_' + value).val();

        var qty = $('#rentqty_' + value).val();

        var weight = $('#rentweight_' + value).val();

        var months = $('#rentmonths_' + value).val();

        var days = $('#rentdays_' + value).val();

        var tax = $('#rentprod_tax_' + value).val();

        //var totalmonths = (parseInt(months) + (parseInt(days) / 30)).toFixed(2);

        var totalmonths = (parseInt(months) + (parseInt(days) / 30));

        //var total_price = (price * qty * totalmonths);

        var total_price = (price * qty * totalmonths * weight);

        // var total_price = (price * qty);

        var disc = $('#rentdisc_' + value).val();

        $('#rentprice_' + value).val(total_price);

        var disc_amt = ((total_price * disc) / 100);

        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));

        $('#rentdisc_amt_' + value).val(disc_amt);

        $('#rentdisc_price_' + value).val(disc_price);

        $('#renttax_amt_' + value).val((disc_price * tax) / 100);

        //var disc_price = $('#rentdisc_price_' + value).val();

        var tax_amt = $('#renttax_amt_' + value).val();

        var grand_total=parseInt(disc_price)+parseInt(tax_amt);

        //var grand_total = parseInt(disc_price);

        $('#grand_total_' + value).text(grand_total);

        var totalamt = 0;

        $('table.renttable').find('td.totalamt').each(function () {

            totalamt = parseInt(totalamt) + parseInt($(this).text());

        });

        $('.rent_total_amt').val(totalamt);

        //$('.rent_total_quotation_amt').val(totalamt);

        var rent_total_amt = $('.rent_total_amt').val();

        var rent_discount_percentage = $('.rent_discount_percentage').val();

        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);

        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));

        $('.rent_discount_amt').val(disamt);

        $('.rent_total_quotation_amt').val(distotalamt);

        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));



        var i;

        var arry = [];

        var minarry = [];

        j = 0;

        // var totalpro = $('#totalrentpro').attr('value');

        var totalpro = $('.addmorerentpro').attr('value');

        for (i = 0; i <= totalpro; i++) {

            arry[j++] = parseInt($('#renttax_amt_' + i).val());

            minarry[j++] = ((parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val())) * parseInt(totalmonths));

        }

        var totaltax = 0;

        for (var i = 0; i < arry.length; i++) {

            totaltax += arry[i] << 0;

        }

        var totalminprice = 0;

        for (var k = 0; k < minarry.length; k++) {

            totalminprice += minarry[k] << 0;

        }

        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));

        var rentamt = $('#averageprice' + value).val();

        //alert(rentamt+' - '+disc_price+' - '+distotalamt)

        var rentamt = (rentamt * qty * totalmonths);



        var marginprofit = (100 * (disc_price - rentamt) / rentamt);

        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);



//alert(distotalamt)



        //$('.rent_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');

        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');

        $('.rent_total_quotation_margin_profit').css("width", totalmarginprofit + '%');



        if (marginprofit >= 0 && marginprofit <= 9.99) {

            var color = 'red';

            $('#rentprofit_amt' + value).removeClass('yellow');

            $('#rentprofit_amt' + value).removeClass('blue');

            $('#rentprofit_amt' + value).removeClass('green');

            $('#rentprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 10 && marginprofit <= 14.99) {

            var color = 'yellow';

            $('#rentprofit_amt' + value).removeClass('red');

            $('#rentprofit_amt' + value).removeClass('blue');

            $('#rentprofit_amt' + value).removeClass('green');

            $('#rentprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 15 && marginprofit <= 19.99) {

            var color = 'blue';

            $('#rentprofit_amt' + value).removeClass('yellow');

            $('#rentprofit_amt' + value).removeClass('red');

            $('#rentprofit_amt' + value).removeClass('green');

            $('#rentprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 20 && marginprofit <= 29.99) {

            var color = 'green';

            $('#rentprofit_amt' + value).removeClass('yellow');

            $('#rentprofit_amt' + value).removeClass('blue');

            $('#rentprofit_amt' + value).removeClass('red');

            $('#rentprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 30) {

            var color = 'orange';

            $('#rentprofit_amt' + value).removeClass('yellow');

            $('#rentprofit_amt' + value).removeClass('blue');

            $('#rentprofit_amt' + value).removeClass('green');

            $('#rentprofit_amt' + value).removeClass('red');

        } else if (marginprofit <= 0) {

            var color = 'red';

            $('#rentprofit_amt' + value).removeClass('yellow');

            $('#rentprofit_amt' + value).removeClass('blue');

            $('#rentprofit_amt' + value).removeClass('green');

            $('#rentprofit_amt' + value).removeClass('orange');

        }



        $('#rentprofit_amt' + value).val(marginprofit);

        $('#rentprofit_amt' + value).addClass(color);

        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99) {

            var margincolor = 'red';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99) {

            var margincolor = 'yellow';

            $('.rent_total_quotation_margin_profit').removeClass('red');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99) {

            var margincolor = 'blue';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('red');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99) {

            var margincolor = 'green';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('red');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 30) {

            var margincolor = 'orange';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('red');

        } else if (totalmarginprofit <= 0) {

            var margincolor = 'red';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        }

        $('.rent_total_quotation_margin_profit').addClass(margincolor);

    }



    function get_total_disc_rent() {

        var rent_total_amt = $('.rent_total_amt').val();

        var rent_discount_percentage = $('.rent_discount_percentage').val();

        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);

        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));

        $('.rent_discount_amt').val(disamt);

        $('.rent_total_quotation_amt').val(distotalamt);

        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));

    }



    function get_total_price_per_qty_sale(value) {

        var price = $('#salemainprice_' + value).val();

        var qty = $('#saleqty_' + value).val();

        var weight = $('#saleweight_' + value).val();

        //var total_price = (price * qty);

        var total_price = (price * qty * weight);

        var disc = $('#saledisc_' + value).val();

        var tax = $('#saleprod_tax_' + value).val();

        $('#saleprice_' + value).val(total_price);

        var disc_amt = ((total_price * disc) / 100);

        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));

        $('#saledisc_amt_' + value).val(disc_amt);

        $('#saledisc_price_' + value).val(disc_price);

        $('#saletax_amt_' + value).val((disc_price * tax) / 100);



        //var disc_price=$('#saledisc_price_'+value).val();

        var tax_amt = $('#saletax_amt_' + value).val();

        //var grand_total = parseInt(disc_price);

        var grand_total=parseInt(disc_price)+parseInt(tax_amt);

        $('#grand_total_sale' + value).text(grand_total);

        var totalamt = 0;

        $('table.saletable').find('td.totalsaleamt').each(function () {

            totalamt = parseInt(totalamt) + parseInt($(this).text());

        });

        $('.sale_total_amt').val(totalamt);

        //$('.sale_total_quotation_amt').val(totalamt);

        var rent_total_amt = $('.sale_total_amt').val();

        var rent_discount_percentage = $('.sale_discount_percentage').val();

        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);

        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));

        $('.sale_discount_amt').val(disamt);

        $('.sale_total_quotation_amt').val(distotalamt);

        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));



        var i;

        var arry = [];

        var minarry = [];

        j = 0;

        //var totalpro = $('#totalsalepro').attr('value');

        var totalpro = $('.addmoresalepro').attr('value');

        for (i = 0; i <= totalpro; i++) {

            arry[j++] = parseInt($('#saletax_amt_' + i).val());

            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());

        }

        var totaltax = 0;

        for (var i = 0; i < arry.length; i++) {

            totaltax += arry[i] << 0;

        }

        var totalminprice = 0;

        for (var k = 0; k < minarry.length; k++) {

            totalminprice += minarry[k] << 0;

        }



        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));

        var rentamt = $('#averagesaleprice' + value).val();

        var rentamt = (rentamt * qty);

        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);

        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');

        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');

        $('.sale_total_quotation_margin_profit').css("width", totalmarginprofit + '%');

        var marginprofit = (100 * (disc_price - rentamt) / rentamt);

        if (marginprofit >= 0.00 && marginprofit <= 9.99)

        {

            var color = 'red';

            $('#saleprofit_amt' + value).removeClass('yellow');

            $('#saleprofit_amt' + value).removeClass('blue');

            $('#saleprofit_amt' + value).removeClass('green');

            $('#saleprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 10 && marginprofit <= 14.99)

        {

            var color = 'yellow';

            $('#saleprofit_amt' + value).removeClass('red');

            $('#saleprofit_amt' + value).removeClass('blue');

            $('#saleprofit_amt' + value).removeClass('green');

            $('#saleprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 15 && marginprofit <= 19.99)

        {

            var color = 'blue';

            $('#saleprofit_amt' + value).removeClass('yellow');

            $('#saleprofit_amt' + value).removeClass('red');

            $('#saleprofit_amt' + value).removeClass('green');

            $('#saleprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 20 && marginprofit <= 29.99)

        {

            var color = 'green';

            $('#saleprofit_amt' + value).removeClass('yellow');

            $('#saleprofit_amt' + value).removeClass('blue');

            $('#saleprofit_amt' + value).removeClass('red');

            $('#saleprofit_amt' + value).removeClass('orange');

        } else if (marginprofit >= 30)

        {

            var color = 'orange';

            $('#saleprofit_amt' + value).removeClass('yellow');

            $('#saleprofit_amt' + value).removeClass('blue');

            $('#saleprofit_amt' + value).removeClass('green');

            $('#saleprofit_amt' + value).removeClass('red');

        }

        if (marginprofit <= 0)

        {

            var color = 'red';

            $('#saleprofit_amt' + value).removeClass('yellow');

            $('#saleprofit_amt' + value).removeClass('blue');

            $('#saleprofit_amt' + value).removeClass('green');

            $('#saleprofit_amt' + value).removeClass('orange');

        }

        $('#saleprofit_amt' + value).val(marginprofit);

        $('#saleprofit_amt' + value).addClass(color);





        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)

        {

            var margincolor = 'red';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)

        {

            var margincolor = 'yellow';

            $('.sale_total_quotation_margin_profit').removeClass('red');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)

        {

            var margincolor = 'blue';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('red');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)

        {

            var margincolor = 'green';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('red');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 30)

        {

            var margincolor = 'orange';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('red');

        } else if (totalmarginprofit <= 0)

        {

            var margincolor = 'red';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        }

        $('.sale_total_quotation_margin_profit').addClass(margincolor);

    }

    function get_total_disc_sale()

    {

        var rent_total_amt = $('.sale_total_amt').val();

        var rent_discount_percentage = $('.sale_discount_percentage').val();

        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);

        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));

        $('.sale_discount_amt').val(disamt);

        $('.sale_total_quotation_amt').val(distotalamt);

        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));

    }

    $(document).ready(function () {

        var totalamt = 0;

        $('table.renttable').find('td.totalamt').each(function () {

            totalamt = parseInt(totalamt) + parseInt($(this).text());

        });

        $('.rent_total_amt').val(totalamt);

        //$('.rent_total_quotation_amt').val(totalamt);



        var rent_total_amt = $('.rent_total_amt').val();

        var rent_discount_percentage = $('.rent_discount_percentage').val();

        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);

        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));

        $('.rent_discount_amt').val(disamt);

        $('.rent_total_quotation_amt').val(distotalamt);

        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;

        var arry = [];

        var minarry = [];

        j = 0;

        var totalpro = $('#totalrentpro').attr('value');

        for (i = 0; i <= totalpro; i++)

        {

            arry[j++] = parseInt($('#renttax_amt_' + i).val());

            minarry[j++] = parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val());

        }

        var totaltax = 0;

        for (var i = 0; i < arry.length; i++)

        {

            totaltax += arry[i] << 0;

        }

        var totalminprice = 0;

        for (var k = 0; k < minarry.length; k++)

        {

            totalminprice += minarry[k] << 0;

        }

        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));

        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);



        //alert(distotalamt+'/'+totalminprice+'/'+totalminprice);

        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');

        $('.rent_total_quotation_margin_profit').css("width", totalmarginprofit + '%');

        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)

        {

            var margincolor = 'red';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)

        {

            var margincolor = 'yellow';

            $('.rent_total_quotation_margin_profit').removeClass('red');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)

        {

            var margincolor = 'blue';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('red');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)

        {

            var margincolor = 'green';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('red');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 30)

        {

            var margincolor = 'orange';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('red');

        } else if (totalmarginprofit <= 0)

        {

            var margincolor = 'red';

            $('.rent_total_quotation_margin_profit').removeClass('yellow');

            $('.rent_total_quotation_margin_profit').removeClass('blue');

            $('.rent_total_quotation_margin_profit').removeClass('green');

            $('.rent_total_quotation_margin_profit').removeClass('orange');

        }

        $('.rent_total_quotation_margin_profit').addClass(margincolor);



        var i;

        var arr = [];

        j = 0;

        var addmore = $('.addsalemore').attr('value');

        for (i = 0; i <= addmore; i++)

        {

            arr[j++] = parseInt($('#sale_total_maount' + i).val());

        }

        var total = 0;

        for (var i = 0; i < arr.length; i++)

        {

            total += arr[i] << 0;

        }

        $('.sale_other_charges_subtotal').html(total);

    });

    $(document).ready(function () {





        var totalamt = 0;

        $('table.saletable').find('td.totalsaleamt').each(function () {

            totalamt = parseInt(totalamt) + parseInt($(this).text());

        });

        $('.sale_total_amt').val(totalamt);

        var rent_total_amt = $('.sale_total_amt').val();

        var rent_discount_percentage = $('.sale_discount_percentage').val();

        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);

        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));

        $('.sale_discount_amt').val(disamt);

        $('.sale_total_quotation_amt').val(distotalamt);

        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));



        var i;

        var arry = [];

        var minarry = [];

        j = 0;

        var totalpro = $('#totalsalepro').attr('value');

        for (i = 0; i <= totalpro; i++)

        {

            arry[j++] = parseInt($('#saletax_amt_' + i).val());

            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());

        }

        var totaltax = 0;

        for (var i = 0; i < arry.length; i++)

        {

            totaltax += arry[i] << 0;

        }

        var totalminprice = 0;

        for (var k = 0; k < minarry.length; k++)

        {

            totalminprice += minarry[k] << 0;

        }



        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));

        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);

        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');

        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');

        $('.sale_total_quotation_margin_profit').css("width", totalmarginprofit + '%');

        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)

        {

            var margincolor = 'red';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');



        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)

        {

            var margincolor = 'yellow';

            $('.sale_total_quotation_margin_profit').removeClass('red');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)

        {

            var margincolor = 'blue';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('red');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)

        {

            var margincolor = 'green';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('red');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        } else if (totalmarginprofit >= 30)

        {

            var margincolor = 'orange';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('red');

        } else if (totalmarginprofit <= 0)

        {

            var margincolor = 'red';

            $('.sale_total_quotation_margin_profit').removeClass('yellow');

            $('.sale_total_quotation_margin_profit').removeClass('blue');

            $('.sale_total_quotation_margin_profit').removeClass('green');

            $('.sale_total_quotation_margin_profit').removeClass('orange');

        }

        $('.sale_total_quotation_margin_profit').addClass(margincolor);



        var i;

        var arr = [];

        j = 0;

        var addmore = $('.addmore').attr('value');

        for (i = 0; i <= addmore; i++)

        {

            arr[j++] = parseInt($('#total_maount' + i).val());

        }

        var total = 0;

        for (var i = 0; i < arr.length; i++)

        {

            total += arr[i] << 0;

        }

        $('.rent_other_charges_subtotal').html(total);

    });

</script>

<script type="text/javascript">

// American Numbering System

    var th = ['', 'thousand', 'million', 'billion', 'trillion'];



    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];



    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];



    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];



    function toWords(s) {

        s = s.toString();

        s = s.replace(/[\, ]/g, '');

        if (s != parseFloat(s))

            return 'not a number';

        var x = s.indexOf('.');

        if (x == -1)

            x = s.length;

        if (x > 15)

            return 'too big';

        var n = s.split('');

        var str = '';

        var sk = 0;

        for (var i = 0; i < x; i++) {

            if ((x - i) % 3 == 2) {

                if (n[i] == '1') {

                    str += tn[Number(n[i + 1])] + ' ';

                    i++;

                    sk = 1;

                } else if (n[i] != 0) {

                    str += tw[n[i] - 2] + ' ';

                    sk = 1;

                }

            } else if (n[i] != 0) {

                str += dg[n[i]] + ' ';

                if ((x - i) % 3 == 0)

                    str += 'hundred ';

                sk = 1;

            }

            if ((x - i) % 3 == 1) {

                if (sk)

                    str += th[(x - i - 1) / 3] + ' ';

                sk = 0;

            }

        }

        if (x != s.length) {

            var y = s.length;

            str += 'point ';

            for (var i = x + 1; i < y; i++)

                str += dg[n[i]] + ' ';

        }

        return str.replace(/\s+/g, ' ');



    }

    $('.addmore').click(function ()

    {

        var addmore = parseInt($(this).attr('value'));

        var newaddmore = addmore + 1;

        $(this).attr('value', newaddmore);

<?php

if (isset($proposal->is_gst)) {

    if ($proposal->is_gst == 1) {

        ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][gst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="number" id="sgst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" onchange="getothercharges(' + newaddmore + ')" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="igst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php

    }

} else {

    if ($clientsate == get_staff_state()) {

        ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst' + newaddmore + '" value="0" name="othercharges[' + newaddmore + '][gst]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="igst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][igst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php

    }

}

?>

        $('.selectpicker').selectpicker('refresh');

    });





    $('.addmorerentpro').click(function ()

    {

        var addmorerentpro = parseInt($(this).attr('value'));

        var check_gst = parseInt($('#check_gst').val());

        var newaddmorerentpro = addmorerentpro + 1;

        $(this).attr('value', newaddmorerentpro);

        if (check_gst == 0)

        {

            $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo cc($product_value['sub_name']); ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="rentpro_name' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="150" name="rentproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averageprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" id="rentpro_remark_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" readonly id="rentpro_pro_id_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" readonly id="rentpro_unit_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][unit]"></td><td><input type="text" id="rentpro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="rentproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="text" class="form-control" id="rentweight_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][weight]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')"  value="1"></td><td><input type="number" class="form-control" id="rentqty_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="rentmonths_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][months]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="1"></td><td><input type="number" class="form-control" id="rentdays_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][days]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="0"></td><td><input type="number" class="form-control" id="rentmainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" name="rentproposal[' + newaddmorerentpro + '][price]"></td><td><input type="number" class="form-control" id="rentviewprice_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][price_view]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_' + newaddmorerentpro + '" ></td><td><input type="number" class="form-control" id="rentdisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="0" name="rentproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt' + newaddmorerentpro + '" value="20"></td><td><input type="hidden" name="rentproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="rentproposal[' + newaddmorerentpro + '][prodtax]" id="rentprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_' + newaddmorerentpro + '"></td></tr>');

        } else

        {

            $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo cc($product_value['sub_name']); ?></option><?php

    }

}

?></select><input class="form-control" id="rentpro_name' + newaddmorerentpro + '" type="hidden" name="rentproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="150" name="rentproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averageprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" id="rentpro_remark_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" id="rentpro_pro_id_' + newaddmorerentpro + '" readonly name="rentproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" id="rentpro_unit_' + newaddmorerentpro + '" readonly name="rentproposal[' + newaddmorerentpro + '][unit]"></td><td><input type="text" class="form-control" id="rentpro_pro_hsncode_' + newaddmorerentpro + '" readonly name="rentproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="1.00"></td><td><input type="text" class="form-control" id="rentweight_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][weight]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="1"></td><td><input type="number" class="form-control" id="rentmonths_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][months]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="1"></td><td><input type="number" class="form-control" id="rentdays_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][days]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="0"></td><td><input type="number" class="form-control" id="rentmainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" name="rentproposal[' + newaddmorerentpro + '][price]"></td><td><input type="number" class="form-control" id="rentviewprice_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][price_view]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_' + newaddmorerentpro + '" ></td><td><input type="number" class="form-control" id="rentdisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="0" name="rentproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt' + newaddmorerentpro + '" value="20"></td><td><input type="hidden" name="rentproposal[' + newaddmorerentpro + '][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_' + newaddmorerentpro + '"></td></tr>');

        }

        $('.selectpicker').selectpicker('refresh');

    });



    $('.addmoresalepro').click(function ()

    {

        var addmorerentpro = parseInt($(this).attr('value'));

        var check_gst = parseInt($('#check_gst').val());

        var newaddmorerentpro = addmorerentpro + 1;

        $(this).attr('value', newaddmorerentpro);

        if (check_gst == 0)

        {

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo cc($product_value['sub_name']); ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" id="salepro_remark_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" readonly id="salepro_unit_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][unit]"></td><td><input type="text" id="salepro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="text" class="form-control" id="saleweight_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][weight]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" value="1"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" ></td><td><input type="number" class="form-control" id="saledisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" value="0" name="saleproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="saledisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="saledisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="saleprofit_amt' + newaddmorerentpro + '"></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][prodtax]" id="saleprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');

        } else

        {

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo cc($product_value['sub_name']); ?></option><?php

    }

}

?></select><input class="form-control" id="salepro_name' + newaddmorerentpro + '" type="hidden" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" id="salepro_remark_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" id="salepro_pro_id_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" readonly id="salepro_unit_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][unit]"></td><td><input type="text" class="form-control" id="salepro_pro_hsncode_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="text" class="form-control" id="saleweight_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][weight]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" value="1"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" ></td><td><input type="number" class="form-control" id="saledisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" value="0" name="saleproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="saledisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="saledisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="saleprofit_amt' + newaddmorerentpro + '"></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');

        }

        $('.selectpicker').selectpicker('refresh');

    });

    $('.addsalemore').click(function ()

    {

        var addmore = parseInt($(this).attr('value'));

        var newaddmore = addmore + 1;

        $(this).attr('value', newaddmore);

<?php

if (isset($proposal->is_gst)) {

    if ($proposal->is_gst == 1) {

        ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" onchange="getothersalecharges(' + newaddmore + ')"  class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>  $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_igst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" value="0" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php

    }

} else {

    if ($clientsate == get_staff_state()) {

        ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '"  name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" onchange="getothersalecharges(' + newaddmore + ')" ></div></td><td><div class="form-group"><input type="number" id="sale_gst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" onchange="getothersalecharges(' + newaddmore + ')" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_igst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][igst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php

    }

}

?>

        $('.selectpicker').selectpicker('refresh');

    });

    function removeothercharges(othercharg) {

        $('#tr' + othercharg).remove();

        var i;

        var arr = [];

        j = 0;

        var addmore = $('.addmore').attr('value');

        for (i = 0; i <= addmore; i++) {

            arr[j++] = parseInt($('#total_maount' + i).val());

        }

        var total = 0;

        for (var i = 0; i < arr.length; i++) {

            total += arr[i] << 0;

        }

        $('.rent_other_charges_subtotal').html(total);

    }





    function removerentpro(value)

    {

        $('.trrentpro' + value).remove();

        get_total_price_per_qty_rent(value);

    }

    function removesalepro(value)

    {

        $('.trsalepro' + value).remove();

        get_total_price_per_qty_sale(value);

    }

    function removesaleothercharges(othercharg) {

        $('#trsale' + othercharg).remove();

        var i;

        var arr = [];

        j = 0;

        var addmore = $('.addsalemore').attr('value');

        for (i = 0; i <= addmore; i++) {

            arr[j++] = parseInt($('#sale_total_maount' + i).val());

        }

        var total = 0;

        for (var i = 0; i < arr.length; i++) {

            total += arr[i] << 0;

        }

        $('.sale_other_charges_subtotal').html(total);

    }

    function get_rel_list(value)

    {

        var rel_type = value;

        var url = '<?php echo base_url(); ?>admin/Proposals/get_rel_list';

        var html = '<option value=""></option>';

        $.post(url,

                {

                    rel_type: rel_type,

                },

                function (data, status)

                {

                    if (data != "")

                    {

                        var resArr = $.parseJSON(data);

                        if (rel_type == 'proposal')

                        {

                            $.each(resArr, function (k, v) {

                                html += '<option value="' + v.id + '">' + v.leadno + '</option>';

                            });

                            $('.rel_id_label').text('Lead');

                        }

                        if (rel_type == 'customer')

                        {

                            $.each(resArr, function (k, v) {

                                html += '<option value="' + v.userid + '">' + v.client_branch_name + ' - ' + v.email_id + '</option>';

                            });

                            $('.rel_id_label').text('client');

                        }

                    }

                    $("#rel_id").val('');

                    $("#rel_id").html('').html(html);

<?php if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $proposal->rel_id; ?>');<?php } ?>

<?php if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $proposal->rel_id; ?>');<?php } ?>

<?php if (isset($_GET['rel_id'])) { ?> $("#rel_id").val('<?php echo $_GET['rel_id']; ?>');<?php } ?>

                    $('.selectpicker').selectpicker('refresh');

                });

    }

    $(function () {

<?php if (isset($_GET['rel_id'])) { ?>

            var rel_id = '<?php echo $_GET['rel_id']; ?>';

            get_rel_list('proposal');



            $.get(admin_url + 'proposals/get_relation_data_values/' + rel_id + '/proposal', function (response) {

                $('input[name="proposal_to"]').val(response.to);

                $('textarea[name="address"]').val(response.address);

                $('input[name="email"]').val(response.email);

                $('input[name="phone"]').val(response.phone);

                $('input[name="city"]').val(response.city);

                $('input[name="state"]').val(response.state);

                $('#state').val(response.state);

                $('#city').val(response.city);

                $('#source').val(response.source);

                $('input[name="zip"]').val(response.zip);

                $('select[name="country"]').selectpicker('val', response.country);

                $('.selectpicker').selectpicker('refresh');

                var currency_selector = $('#currency');

                if (_rel_type.val() == 'customer') {

                    if (typeof (currency_selector.attr('multi-currency')) == 'undefined') {

                        currency_selector.attr('disabled', true);

                    }



                } else {

                    currency_selector.attr('disabled', false);

                }

                var proposal_to_wrapper = $('[app-field-wrapper="proposal_to"]');

                if (response.is_using_company == false && !empty(response.company)) {

                    proposal_to_wrapper.find('#use_company_name').remove();

                    proposal_to_wrapper.find('#use_company_help').remove();

                    proposal_to_wrapper.append('<div id="use_company_help" class="hide">' + response.company + '</div>');

                    proposal_to_wrapper.find('label')

                            .prepend("<a href=\"#\" id=\"use_company_name\" data-toggle=\"tooltip\" data-title=\"<?php echo _l('use_company_name_instead'); ?>\" onclick='document.getElementById(\"proposal_to\").value = document.getElementById(\"use_company_help\").innerHTML.trim(); this.remove();'><i class=\"fa fa-building-o\"></i></a> ");

                } else {

                    proposal_to_wrapper.find('label #use_company_name').remove();

                    proposal_to_wrapper.find('label #use_company_help').remove();

                }

                /* Check if customer default currency is passed */

                if (response.currency) {

                    currency_selector.selectpicker('val', response.currency);

                } else {

                    /* Revert back to base currency */

                    currency_selector.selectpicker('val', currency_selector.data('base'));

                }

                currency_selector.selectpicker('refresh');

                currency_selector.change();

            }, 'json');

    <?php

}

if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) {

    ?>

            get_rel_list('customer');

    <?php

}

if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) {

    ?>

            get_rel_list('proposal');

<?php } ?>

    });



    function getothercharges(value)

    {

        var amount = $('#amount' + value).val();

        var igst = $('#igst' + value).val();

        if (typeof igst === "undefined") {

            var gst = $('#gst' + value).val();

            var sgst = $('#sgst' + value).val();

            var igst = parseInt(gst) + parseInt(sgst);

        }

        var totalgstamt = parseInt((igst * amount) / 100);

        var totalamt = parseInt(amount) + parseInt(totalgstamt);

        $('#gst_sgst_amt' + value).val(totalgstamt);

        $('#total_maount' + value).val(totalamt);

        var i;

        var arr = [];

        j = 0;

        var addmore = $('.addmore').attr('value');

        for (i = 0; i <= addmore; i++)

        {

            arr[j++] = parseInt($('#total_maount' + i).val());

        }

        var total = 0;

        for (var i = 0; i < arr.length; i++)

        {

            total += arr[i] << 0;

        }

        $('.rent_other_charges_subtotal').html(total);

    }



    function getothersalecharges(value)

    {

        var sale_amount = $('#sale_amount' + value).val();

        var igst = $('#sale_igst' + value).val();

        if (typeof igst === "undefined") {

            var gst = $('#sale_gst' + value).val();

            var sgst = $('#sale_sgst' + value).val();

            var igst = parseInt(gst) + parseInt(sgst);

        }

        var totalgstamt = parseInt((igst * sale_amount) / 100);

        var totalamt = parseInt(sale_amount) + parseInt(totalgstamt);

        $('#sale_gst_sgst_amt' + value).val(totalgstamt);

        $('#sale_total_maount' + value).val(totalamt);

        var i;

        var arr = [];

        j = 0;

        var addmore = $('.addsalemore').attr('value');

        for (i = 0; i <= addmore; i++) {

            arr[j++] = parseInt($('#sale_total_maount' + i).val());

        }

        var total = 0;

        for (var i = 0; i < arr.length; i++) {

            total += arr[i] << 0;

        }

        $('.sale_other_charges_subtotal').html(total);

    }

    function staffdropdown()

    {

        $.each($("#assign option:selected"), function () {

            var select = $(this).val();

            $("optgroup." + select).children().attr('selected', 'selected');

        });

        $('.selectpicker').selectpicker('refresh');

        $.each($("#assign option:not(:selected)"), function () {

            var select = $(this).val();

            $("optgroup." + select).children().removeAttr('selected');

        });

        $('.selectpicker').selectpicker('refresh');

    }

    function getprodata(value)
    {
        var prodid = $('#prodid' + value).val();
        var check_gst = parseInt($('#check_gst').val());
        var rent_company_category = $('#rent_company_category').val();

        var url = '<?php echo base_url(); ?>admin/Site_manager/getproddetails';
        $.post(url,
                {
                    prodid: prodid,
                    rent_company_category: rent_company_category,
                },
                function (data, status) {

                    var res = JSON.parse(data);

                    $('#renpro_id' + value).val(prodid);

                    $('#rentpro_remark_' + value).val(res.product_remarks);

                    $('#rentpro_name' + value).val(res.name);

                    $('#rentpro_pro_id_' + value).val(res.pro_id);

                    $('#rentpro_unit_' + value).val(res.product_unit);

                    $('#rentpro_pro_hsncode_' + value).val(res.sac_code);

                    $('#averageprice' + value).val(res.min_rentprice);

                    $('#rentmainprice_' + value).val(res.proprice);

                    $('#rentprice_' + value).val(res.proprice);

                    $('#rentdisc_price_' + value).val(res.proprice);

                    $('#renttax_amt_' + value).val(res.gstamt);

                    $('#grand_total_' + value).text(res.proprice);

                   // $('#rentprod_tax_' + value).val(res.tax_rate);

                    $('#rentprod_tax_' + value).val(res.tax);

                    $('.selectpicker').selectpicker('refresh');

                    get_total_price_per_qty_rent(value);

                    /* this is for redirect to product details on next tab */
                    // var reurl = '<?php echo base_url(); ?>admin/product_new/view/'+prodid; 
                    // window.open(reurl, '_blank');
                    getproconfirmation(value, 'rent');    
                });

    }

    function getsaleprodata(value)
    {
        var prodid = $('#saleprodid' + value).val();
        var check_gst = parseInt($('#check_gst').val());
        var rent_company_category = $('#rent_company_category').val();
        var url = '<?php echo base_url(); ?>admin/Site_manager/getsaleproddetails';
        $.post(url,
                {
                    prodid: prodid,
                    rent_company_category: rent_company_category,
                },
                function (data, status) {

                    var res = JSON.parse(data);

                    $('#salepro_id' + value).val(prodid);

                    $('#salepro_remark_' + value).val(res.product_remarks);

                    $('#salepro_name' + value).val(res.name);

                    $('#salepro_pro_id_' + value).val(res.pro_id);

                    $('#salepro_unit_' + value).val(res.product_unit);

                    $('#salepro_pro_hsncode_' + value).val(res.hsn_code);

                    $('#averagesaleprice' + value).val(res.min_rentprice);

                    $('#salemainprice_' + value).val(res.proprice);

                    $('#saleprice_' + value).val(res.proprice);

                    $('#saledisc_price_' + value).val(res.proprice);

                    $('#saletax_amt_' + value).val(res.gstamt);

                    $('#grand_total_sale' + value).text(res.proprice);

                    //$('#saleprod_tax_' + value).val(res.tax_rate);

                    $('#saleprod_tax_' + value).val(res.tax);

                    get_total_price_per_qty_sale(value);

                    $('.selectpicker').selectpicker('refresh');

                    
                    /* this is for redirect to product details on next tab */
                    // var url = '<?php echo base_url(); ?>admin/product_new/view/'+prodid; 
                    // window.open(url, '_blank');
                    getproconfirmation(value, 'sales');    
                });

    }

    $('#site_id').change(function () {

        var site_id = $('#site_id').val();



        if(site_id > 0){

            var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';

                $.post(url,

                {

                    site_id: site_id,

                },

                function (data, status) {

                    var res = JSON.parse(data);



                    $('.shipping_street').html(res.address);

                    $('#shipping_street').val(res.address);

                    $('.shipping_state').html(res.state_name);

                    $('#shipping_state').val(res.state_name);

                    $('.shipping_city').html(res.city_name);

                    $('#shipping_city').val(res.city_name);

                    $('.shipping_zip').html(res.pincode);

                    $('#shipping_zip').val(res.pincode);

                });

        }





    });





    $('.addmorecontact').click(function ()

    {

        var addmore = parseInt($(this).attr('value'));

        var newaddmore = addmore + 1;

        $(this).attr('value', newaddmore);



        var html = '<option value=""></option>';

        var clintid = $('#clientid').val();

        $.ajax({

            url: admin_url + 'Estimates/getcompnycontact/' + clintid,

            method: 'GET',

            success(res) {

                if (res != "") {

                    var resArr = $.parseJSON(res);

                    $.each(resArr, function (k, v) {

                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';

                    });

                }

                $("#staff_id" + newaddmore).html('').html(html);

                $('.selectpicker').selectpicker('refresh');

            }

        });



        $('#myContactTable tbody').append('<tr class="main" id="trcc' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker contid" data-live-search="true" id="staff_id' + newaddmore + '" sataff="' + newaddmore + '" onChange="staffdata(' + newaddmore + ');" name="clientdata[' + newaddmore + '][staff_id]"><option value=""></option><?php

if (isset($staff_data) && count($staff_data) > 0) {

    foreach ($staff_data as $unit_key => $staff_value) {

        ?><option value="<?php echo $staff_value['staffid'] ?>" <?php echo (isset($singlewarehouseperson['staffid']) && $singlewarehouseperson['staffid'] == $staff_value['staffid']) ? 'selected' : "" ?>><?php echo $staff_value['firstname'] . ' ' . $staff_value['lastname'] ?></option><?php

    }

}

?></select></div></td><td><div class="form-group"><input type="text" id="email' + newaddmore + '" name="clientdata[' + newaddmore + '][email]" class="form-control" onBlur="checkmail(this.value,' + newaddmore + ');"></div></td><td><div class="form-group"><input type="text" id="phonenumber' + newaddmore + '" onBlur="checkcontno(this.value,' + newaddmore + ');" name="clientdata[' + newaddmore + '][phonenumber]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id' + newaddmore + '" name="clientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php

if (isset($designation_data) && count($designation_data) > 0) {

    foreach ($designation_data as $designation_key => $designation_value) {

        ?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php

    }

}

?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="designation_id" name="clientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php

if (isset($contact_type_data) && count($contact_type_data) > 0) {

    foreach ($contact_type_data as $contact_type_key => $contact_type_value) {

        ?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php

    }

}

?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');

        $('.selectpicker').selectpicker('refresh');

    });



	$('.addmoreshippingcontact').click(function ()

    {

        var addmore = parseInt($(this).attr('value'));

        var newaddmore = addmore + 1;

        $(this).attr('value', newaddmore);



        var html = '<option value=""></option>';

        var clintid = $('#clientid').val();

        $.ajax({

            url: admin_url + 'Estimates/getcompnycontact/' + clintid,

            method: 'GET',

            success(res) {

                if (res != "") {

                    var resArr = $.parseJSON(res);

                    $.each(resArr, function (k, v) {

                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';

                    });

                }

                $("#shipstaff_id" + newaddmore).html('').html(html);

                $('.selectpicker').selectpicker('refresh');

            }

        });



        $('#myShippContactTable tbody').append('<tr class="main" id="trss' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker contid" data-live-search="true" id="shipstaff_id' + newaddmore + '" sataff="' + newaddmore + '" onChange="shipstaffdata(' + newaddmore + ');" name="shipclientdata[' + newaddmore + '][staff_id]"><option value=""></option><?php

if (isset($staff_data) && count($staff_data) > 0) {

    foreach ($staff_data as $unit_key => $staff_value) {

        ?><option value="<?php echo $staff_value['staffid'] ?>" <?php echo (isset($singlewarehouseperson['staffid']) && $singlewarehouseperson['staffid'] == $staff_value['staffid']) ? 'selected' : "" ?>><?php echo $staff_value['firstname'] . ' ' . $staff_value['lastname'] ?></option><?php

    }

}

?></select></div></td><td><div class="form-group"><input type="text" id="shipemail' + newaddmore + '" name="shipclientdata[' + newaddmore + '][email]" class="form-control" onBlur="checkmail(this.value,' + newaddmore + ');"></div></td><td><div class="form-group"><input type="text" id="shipphonenumber' + newaddmore + '" onBlur="checkcontno(this.value,' + newaddmore + ');" name="shipclientdata[' + newaddmore + '][phonenumber]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="shipdesignation_id' + newaddmore + '" name="shipclientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php

if (isset($designation_data) && count($designation_data) > 0) {

    foreach ($designation_data as $designation_key => $designation_value) {

        ?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php

    }

}

?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="designation_id" name="shipclientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php

if (isset($contact_type_data) && count($contact_type_data) > 0) {

    foreach ($contact_type_data as $contact_type_key => $contact_type_value) {

        ?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php

    }

}

?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeshipclientperson(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');

        $('.selectpicker').selectpicker('refresh');

    });

    function removeclientperson(procompid)

    {

        $('#trcc' + procompid).remove();

    }



	function removeshipclientperson(procompid)

    {

        $('#trss' + procompid).remove();

    }

    $('.newsite').click(function () {

        $('.sitedv').fadeToggle();

    });

    $('.addsite').click(function ()

    {

        var sitename = $('#sitename').val();

        var sitestate_id = $('#sitestate_id').val();

        var sitelocation = $('#sitelocation').val();

        var sitedescription = $('#sitedescription').val();

        var siteaddress = $('#siteaddress').val();

        var sitelandmark = $('#sitelandmark').val();

        var sitepincode = $('#sitepincode').val();

        var sitecity_id = $('#sitecity_id').val();

        //if (sitename != '' & sitelocation != '' & siteaddress != '' & sitelandmark != '' & sitepincode != '')

        if (sitename != '')

        {

            var url = '<?php echo base_url(); ?>admin/Site_manager/site_manager';

            var html = '<option value=""></option>';

            $.post(url,

                    {

                        newsitemanager: '1',

                        name: sitename,

                        state_id: sitestate_id,

                        location: sitelocation,

                        description: sitedescription,

                        address: siteaddress,

                        landmark: sitelandmark,

                        pincode: sitepincode,

                        city_id: sitecity_id,

                    },

                    function (result, status) {

                        var resArr = $.parseJSON(result);

                        $.each(resArr, function (k, v) {

                            html += '<option value="' + v.id + '">' + v.name + '</option>';

                        });

                        $("#site_id").html('').html(html);

                        $('.selectpicker').selectpicker('refresh');

                        $('.sitedv').find('input:text').val('');

                        $('.sitedv').fadeToggle();

                        $('#sitename').removeClass('error');

                        $('#sitelocation').removeClass('error');

                        $('#siteaddress').removeClass('error');

                        $('#sitelandmark').removeClass('error');

                        $('#sitepincode').removeClass('error');

                    });

        } else

        {

            if (sitename == '')

            {

                $('#sitename').addClass('error');

            } else

            {

                $('#sitename').removeClass('error');

            }

            /*if (sitelocation == '')

            {

                $('#sitelocation').addClass('error');

            } else

            {

                $('#sitelocation').removeClass('error');

            }

            if (siteaddress == '')

            {

                $('#siteaddress').addClass('error');

            } else

            {

                $('#siteaddress').removeClass('error');

            }

            if (sitelandmark == '')

            {

                $('#sitelandmark').addClass('error');

            } else

            {

                $('#sitelandmark').removeClass('error');

            }

            if (sitepincode == '')

            {

                $('#sitepincode').addClass('error');

            } else

            {

                $('#sitepincode').removeClass('error');

            }*/

        }

    });

    function get_city_by_stateval(state_id) {

        var html = '<option value=""></option>';



        if (state_id == "") {

            $("#sitecity_id").html('').html(html);

            $('.selectpicker').selectpicker('refresh');

            return false;

        }



        $.ajax({

            url: admin_url + 'site_manager/get_cities_by_state_id/' + state_id,

            method: 'GET',

            success(res) {

                if (res != "") {

                    var resArr = $.parseJSON(res);

                    $.each(resArr, function (k, v) {

                        html += '<option value="' + v.id + '">' + v.name + '</option>';

                    });

                }

                $("#sitecity_id").html('').html(html);

                $('.selectpicker').selectpicker('refresh');

            }

        });

    }

    function staffdata(sataff)

    {

        var staff_id = $('#staff_id' + sataff).val();

        var url = admin_url + 'Estimates/getstaffdet/';

        $.post(url,

                {

                    staff_id: staff_id,

                },

                function (data, status) {

                    var res = JSON.parse(data);

                    $('#email' + sataff).val(res.staff_email);

                    $('#email' + sataff).attr('readonly', true);

                    $('#phonenumber' + sataff).val(res.staff_number);

                    $('#phonenumber' + sataff).attr('readonly', true);

                    $('#designation_id' + sataff).val(res.staff_designation);

                    $('#designation_id' + sataff).attr('readonly', true);

                    $('.selectpicker').selectpicker('refresh');

                });

    }



	function shipstaffdata(sataff)

    {

        var staff_id = $('#shipstaff_id' + sataff).val();

        var url = admin_url + 'Estimates/getstaffdet/';

        $.post(url,

                {

                    staff_id: staff_id,

                },

                function (data, status) {

                    var res = JSON.parse(data);

                    $('#shipemail' + sataff).val(res.staff_email);

                    $('#shipemail' + sataff).attr('readonly', true);

                    $('#shipphonenumber' + sataff).val(res.staff_number);

                    $('#shipphonenumber' + sataff).attr('readonly', true);

                    $('#shipdesignation_id' + sataff).val(res.staff_designation);

                    $('#shipdesignation_id' + sataff).attr('readonly', true);

                    $('.selectpicker').selectpicker('refresh');

                });

    }

    $('#clientid').change(function () {



        var html = '<option value=""></option>';

        var clintid = $('#clientid').val();

        $('#cust_id').val(clintid);

        $.ajax({

            url: admin_url + 'Estimates/getcompnycontact/' + clintid,

            method: 'GET',

            success(res) {

                if (res != "") {

                    var resArr = $.parseJSON(res);

                    $.each(resArr, function (k, v) {

                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';

                    });

                }

                $("#shipstaff_id0").html('').html(html);

                $("#staff_id0").html('').html(html);

                $('.selectpicker').selectpicker('refresh');

            }

        });





    });



    $('.addcont').click(function () {

        var formData = $('#contact-form').serialize();

        $.ajax({

            url: '<?php echo base_url(); ?>admin/Estimates/add_cont',

            type: 'post',

            data: formData,

            success: function (data, status) {

                jQuery('.close').click();

                dropdownlist();

            }

        });







    });

    function dropdownlist()

    {

        var html = '<option value=""></option>';

        var clintid = $('#clientid').val();

        $.ajax({

            url: admin_url + 'Estimates/getcompnycontact/' + clintid,

            method: 'GET',

            success(res) {

                if (res != "") {

                    var resArr = $.parseJSON(res);

                    $.each(resArr, function (k, v) {

                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';

                    });

                }

                $("#staff_id0").html('').html(html);

                $("#shipstaff_id0").html('').html(html);

                $('.selectpicker').selectpicker('refresh');

            }

        });

    }

    function contact(client_id, contact_id) {

        var client_id = $('#clientid').val();

        if (typeof (contact_id) == 'undefined') {

            contact_id = '';

        }

        requestGet('clients/contact/' + client_id + '/' + contact_id).done(function (response) {

            $('#contact_data').html(response);

            $('#contact').modal({

                show: true,

                backdrop: 'static'

            });

            $('body').off('shown.bs.modal', '#contact');

            $('body').on('shown.bs.modal', '#contact', function () {

                if (contact_id == '') {

                    $('#contact').find('input[name="firstname"]').focus();

                }

            });

            init_selectpicker();

            init_datepicker();

            custom_fields_hyperlink();

            validate_contact_form();

        }).fail(function (error) {

            var response = JSON.parse(error.responseText);

            alert_float('danger', response.message);

        });

    }







    /*$('#clientid').change(function () {





       var clintid = $('#clientid').val();



       if(clintid > 0){

            $.ajax({

                url: admin_url + 'Estimates/gettaxinfo/' + clintid,

                method: 'GET',

                success(res) {

                    if (res != "") {

                         $('#tax_type').val(res);

                    }



                }

            });

       }







    });*/



</script>

<?php if (!isset($contact)) { ?>

    <script>

        $(function () {

            // Guess auto email notifications based on the default contact permissios

            var permInputs = $('input[name="permissions[]"]');

            $.each(permInputs, function (i, input) {

                input = $(input);

                if (input.prop('checked') === true) {

                    $('#contact_email_notifications [data-perm-id="' + input.val() + '"]').prop('checked', true);

                }

            });

        });

    </script>

<?php } ?>





<script type="text/javascript">

     $('.onlynumbers').keypress(function(event){



       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){

           event.preventDefault(); //stop character from entering input

       }



   });

</script>







<script type="text/javascript">

	$(document).on('change', '#clientid', function() {



	var client_id = $(this).val();



	if(client_id > 0){



   		$.ajax({

            type    : "POST",

            url     : "<?php echo site_url('admin/site_manager/getclientcategory'); ?>",

            data    : {'client_id' : client_id},

            success : function(response){

                if(response != ''){

                     $('#rent_company_category').val(response);

                }

            }

        })



	}





});





$(document).ready(function() {



	var client_id = $("#clientid").val();



	if(client_id > 0){



   		$.ajax({

            type    : "POST",

            url     : "<?php echo site_url('admin/site_manager/getclientcategory'); ?>",

            data    : {'client_id' : client_id},

            success : function(response){

                if(response != ''){

                     $('#rent_company_category').val(response);

                }

            }

        })



	}





});





</script>







<script type="text/javascript">



$(document).on('change', '#service_type', function() {

  var service_type = $(this).val();

  if(service_type == 1){

        $("#for_rent").show();

        $("#for_sale").hide();

  }else if(service_type == 2){

        $("#for_sale").show();

        $("#for_rent").hide();

  }

});





</script>







<script type="text/javascript">

    /*$(document).on('change', '#service_type', function() {

  var service_type = $(this).val();

  if(service_type == 1){

        var terms = "1). Payment : 100% advance along with work order.<br> 2). Freight (Demob) will be charged extra at actual.<br/> 3). Lead Time- 2-3 working days from the date of receipt of confirm order.<br/> 4). Any other charges other than mentioned if incurred, shall be charged at actual.<br/> 5). Loading and Unloading of Equipment/Material at client site will not be in SCHACH'S scope.<br/> 6). FIf there is any Mathadi charges then it will be taken care by the client. <br/> 7). Material Value cheque (Without Date) will be required before material dispatch. <br/> 8). If and when delay in payments occur 24% interest will be charged and debit note will be raised and paybale accordingly. <br/> 9). If there is any damage found in material at the time of return, we reserve rights to raise a debit note against the same, which shall be completely payable. <br/> 10). All the terms of SOP will be applicable.";

  }else if(service_type == 2){

       var terms = "1). Payment Terms : 100% advance along with the Purchase Order. <br/> 2). Freight (Mob) shall be charged extra at actual.<br/> 3). Delivery of scaffold - 4 days after recevied advance payment.<br/> 4). Any other charges other than mentioned if incurred, shall be charged at actual.<br/> 5). Loading and Unloading of Equipment/Material at client site will not be in SCHACH'S scope.<br/> 6). If there is any Mathadi charges then it will be taken care by the client.<br/> 7). If and when delay in payments occur 24% interest will be charged and debit note will be raised and paybale accordingly.";

  }

   tinyMCE.activeEditor.setContent(terms);

});





$(document).ready(function() {

  var service_type = $('#service_type').val();

  if(service_type == 1){

        var terms = "1). Payment : 100% advance along with work order.<br> 2). Freight (Demob) will be charged extra at actual.<br/> 3). Lead Time- 2-3 working days from the date of receipt of confirm order.<br/> 4). Any other charges other than mentioned if incurred, shall be charged at actual.<br/> 5). Loading and Unloading of Equipment/Material at client site will not be in SCHACH'S scope.<br/> 6). FIf there is any Mathadi charges then it will be taken care by the client. <br/> 7). Material Value cheque (Without Date) will be required before material dispatch. <br/> 8). If and when delay in payments occur 24% interest will be charged and debit note will be raised and paybale accordingly. <br/> 9). If there is any damage found in material at the time of return, we reserve rights to raise a debit note against the same, which shall be completely payable. <br/> 10). All the terms of SOP will be applicable.";

  }else if(service_type == 2){

       var terms = "1). Payment Terms : 100% advance along with the Purchase Order. <br/> 2). Freight (Mob) shall be charged extra at actual.<br/> 3). Delivery of scaffold - 4 days after recevied advance payment.<br/> 4). Any other charges other than mentioned if incurred, shall be charged at actual.<br/> 5). Loading and Unloading of Equipment/Material at client site will not be in SCHACH'S scope.<br/> 6). If there is any Mathadi charges then it will be taken care by the client.<br/> 7). If and when delay in payments occur 24% interest will be charged and debit note will be raised and paybale accordingly.";

  }

   tinyMCE.activeEditor.setContent(terms);

});*/





$(document).on('change', '#clientid', function() {

        var client_id = $('#clientid').val();



        if(client_id > 0){

            var url = '<?php echo base_url(); ?>admin/Site_manager/getclientdtails';

                $.post(url,

                {

                    client_id: client_id,

                },

                function (data, status) {

                    var res = JSON.parse(data);



                    $('.billing_street').html(res.address);

                    $('#billing_street').val(res.address);

                    $('.billing_state').html(res.state_name);

                    $('#billing_state').val(res.state_name);

                    $('.billing_city').html(res.city_name);

                    $('#billing_city').val(res.city_name);

                    $('.billing_zip').html(res.pincode);

                    $('#billing_zip').val(res.pincode);

                });

        }





    });





$(document).on('change', '#clientid', function() {

  var clientid = $(this).val();



  $.ajax({

        type    : "POST",

        url     : "<?php echo site_url('admin/estimates/gettaxtype'); ?>",

        data    : {'clientid' : clientid},

        success : function(response){

            if(response != ''){

                 $('#tax_type').val(response);

                 $('.selectpicker').selectpicker('refresh');

            }

        }

    })

});



$(document).ready(function() {
  var relsection_id = $(".relsection_id").val();
  var type = $("#product_type").val();
  var service_type = $("#service_type").val();
  if (typeof(relsection_id) != 'undefined'){
    $.ajax({
          type    : "POST",
          url     : "<?php echo site_url('admin/terms_conditions/getTermsConditionsData'); ?>",
          data    : {'slug' : 'estimate','rel_id' : relsection_id},
          success : function(response){
              if(response != ''){
                   $(".termsconditionmaindiv").html(response);
              }
          }
      });
  }else{
    $.ajax({
          type    : "POST",
          url     : "<?php echo site_url('admin/terms_conditions/getTermsConditionsData'); ?>",
          data    : {'slug' : 'proforma_invoice','for' : service_type,'type' : type},
          success : function(response){
              if(response != ''){
                   tinymce.activeEditor.execCommand('mceSetContent', false, "");
                   $(".termsconditionmaindiv").html(response);
              }
          }
      });
  }

});

function get_terms_condition() {

  var type = $("#product_type").val();

  var service_type = $("#service_type").val();



  if(type > 0 && service_type > 0){

    // $.ajax({
    //     type    : "POST",
    //     url     : "<?php echo site_url('admin/terms_conditions/get_termsandcondition_data'); ?>",
    //     data    : {'slug' : 'proforma_invoice','for' : service_type,'type' : type},
    //     success : function(response){
    //         if(response != ''){
    //              tinyMCE.activeEditor.setContent(response);
    //         }
    //     }
    // })
    $.ajax({
          type    : "POST",
          url     : "<?php echo site_url('admin/terms_conditions/getTermsConditionsData'); ?>",
          data    : {'slug' : 'proforma_invoice','for' : service_type,'type' : type},
          success : function(response){
              if(response != ''){
                   // tinyMCE.activeEditor.setContent("");
                   tinymce.activeEditor.execCommand('mceSetContent', false, "");
                   $(".termsconditionmaindiv").html(response);
              }
          }
      });
  }



}



</script>





<?php

if(empty($estimates->number)){

?>

<script type="text/javascript">



$(document).on('change', '#service_type', function() {

    var service_type = $(this).val();

    if(service_type > 0){

        $.ajax({

        type    : "POST",

            url     : "<?php echo site_url('admin/estimates/get_pi_number'); ?>",

            data    : {'service_type' : service_type},

            success : function(response){

                if(response != ''){

                      $('#estimate_number').val(response);

                }

            }

        })

    }

});


/* this function use for check defult value selection. changed or not */
function chkdefaltvalue(id, val){
    var defult_val = $("#svalue"+id).data("defaultval");
    if (defult_val != val){
        alert("You are changed defult selected value");
    }
}
$(".numericOnly").keypress(function (e) {
    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
});

$(".proposal-submit-btn").click(function(){
  var total_percent = 0;
  $(".termsconditionfield").each(function(){
      var pval = $(this).val();
      var pid = $(this).data("id");
      var ptitle = $(this).data("title");
      var days = $("#evalue"+pid).val();
      var rowid = $(this).data("row");
      var status = $(".termsswitch"+rowid).prop("checked");
      if (status == true){
          if (pval != ''){
            if (typeof(days) !="undefined" && days == ""){
              alert("Please submit "+ ptitle +" days");
              exit;
            }else{
              if (pid < 6){
                  total_percent += parseInt(pval);
              }
            }
          }else{
            if (typeof(days) !="undefined" && days != ""){
              alert("Please submit value of "+ ptitle);
              exit;
            }
          }
    }

  });

  if (total_percent != 100){
     alert("Payment Terms should be equel to 100 %.");
     return false;
  }else{
     $("#proposal-form").submit();
  }
});
</script>

<?php

}

?>





</body>

</html>
