<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($vendor) && $vendor->registration_confirmed == 0 && is_admin()) { ?>
                    <div class="alert alert-warning">
                        <?php echo _l('customer_requires_registration_confirmation'); ?>
                        <br />
                        <a href="<?php echo admin_url('vendors/confirm_registration/' . $vendor->userid); ?>"><?php echo _l('confirm_registration'); ?></a>
                    </div>
                <?php } else if (isset($vendor) && $vendor->active == 0 && $vendor->registration_confirmed == 1) { ?>
                    <div class="alert alert-warning">
                        <?php echo _l('customer_inactive_message'); ?>
                        <br />
                        <a href="<?php echo admin_url('vendors/mark_as_active/' . $vendor->userid); ?>"><?php echo _l('mark_as_active'); ?></a>
                    </div>
                <?php } ?>
                <?php if (isset($vendor) && $vendor->leadid != NULL) { ?>
                    <div class="alert alert-info">
                        <a href="<?php echo admin_url('leads/index/' . $vendor->leadid); ?>" onclick="init_lead(<?php echo $vendor->leadid; ?>); return false;"><?php echo _l('customer_from_lead', _l('lead')); ?></a>
                    </div>
                <?php } ?>
                <?php if (isset($vendor) && (!has_permission('customers', '', 'view') && is_customer_admin($vendor->userid))) { ?>
                    <div class="alert alert-info">
                        <?php echo _l('customer_admin_login_as_vendor_message', get_staff_full_name(get_staff_user_id())); ?>
                    </div>
                <?php } ?>
            </div>
            <?php if ($group == 'profile') { ?>
                <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
                    <button class="btn btn-info only-save customer-form-submiter">
                        <?php echo _l('submit'); ?>
                    </button>
                    <?php if (!isset($vendor)) { ?>
                        <button class="btn btn-info save-and-add-contact customer-form-submiter">
                            <?php echo _l('save_customer_and_add_contact'); ?>
                        </button>
                    <?php } ?>
                </div>
            <?php } ?>
			
            <?php if (isset($vendor)) { ?>
                <div class="col-md-3">
                    <div class="panel_s mbot5">
                        <div class="panel-body padding-10">
                            <h4 class="bold">
                                <?php if (has_permission('customers', '', 'delete') || is_admin()) { ?>
                                    <div class="btn-group pull-left mright10">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            <?php if (is_admin()) { ?>
                                                <li>
                                                    <a href="<?php echo admin_url('vendors/login_as_vendor/' . $vendor->userid); ?>" target="_blank">
                                                        <i class="fa fa-share-square-o"></i> <?php echo _l('login_as_vendor'); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (has_permission('customers', '', 'delete')) { ?>
                                                <li>
                                                    <a href="<?php echo admin_url('vendors/delete/' . $vendor->userid); ?>" class="text-danger delete-text _delete"><i class="fa fa-remove"></i> <?php echo _l('delete'); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                                #<?php echo $vendor->userid . ' ' . $title; ?>
                            </h4>
                        </div>
                    </div>
                    <?php $this->load->view('admin/vendors/tabs'); ?>
                </div>
            <?php } ?>
            <div class="col-md-<?php
            if (isset($vendor)) {
                echo 9;
            } else {
                echo 12;
            }
            ?>">
                <div class="panel_s">
                    <div class="panel-body">
                        <?php if (isset($vendor)) { ?>
                            <?php echo form_hidden('isedit'); ?>
                            <?php echo form_hidden('userid', $vendor->userid); ?>
                            <div class="clearfix"></div>
                        <?php } ?>
                        <div>
                            <div class="tab-content">
                                <?php $this->load->view('admin/vendors/groups/' . $group); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($group == 'profile') { ?>
            <div class="btn-bottom-pusher"></div>
        <?php } ?>
    </div>
</div>
<?php init_tail(); ?>

<script>
    init_selectpicker();

    function get_city_by_state(state_id) {
        var html = '<option value=""></option>';
        
        if(state_id == "") {
            $("#city_id").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#city_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
</script>
<?php if (isset($vendor)) { ?>
    <script>
        $(function () {
            init_rel_tasks_table(<?php echo $vendor->userid; ?>, 'customer');
        });
		
	
    </script>
<?php } ?>
<?php if (!empty(get_option('google_api_key')) && !empty($vendor->latitude) && !empty($vendor->longitude)) { ?>
    <script>
        var latitude = '<?php echo $vendor->latitude; ?>';
        var longitude = '<?php echo $vendor->longitude; ?>';
        var mapMarkerTitle = '<?php echo $vendor->company; ?>';
    </script>
    <?php echo app_script('assets/js', 'map.js'); ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('google_api_key'); ?>&callback=initMap"></script>
<?php } ?>
<?php $this->load->view('admin/vendors/vendor_js'); ?>
</body>
</html>
