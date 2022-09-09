<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($client) && $client->registration_confirmed == 0 && is_admin()) { ?>
                    <div class="alert alert-warning">
                        <?php echo _l('customer_requires_registration_confirmation'); ?>
                        <br />
                        <a href="<?php echo admin_url('clients/confirm_registration/' . $client->userid); ?>"><?php echo _l('confirm_registration'); ?></a>
                    </div>
                <?php } else if (isset($client) && $client->active == 0 && $client->registration_confirmed == 1) { ?>
                    <div class="alert alert-warning">
                        <?php echo _l('customer_inactive_message'); ?>
                        <br />
                        <a href="<?php echo admin_url('clients/mark_as_active/' . $client->userid); ?>"><?php echo _l('mark_as_active'); ?></a>
                    </div>
                <?php } ?>
                <?php if (isset($client) && $client->leadid != NULL) { ?>
                    <div class="alert alert-info">
                        <a href="<?php echo admin_url('leads/index/' . $client->leadid); ?>" onclick="init_lead(<?php echo $client->leadid; ?>); return false;"><?php echo _l('customer_from_lead', _l('lead')); ?></a>
                    </div>
                <?php } ?>
                <?php if (isset($client) && (!has_permission('customers', '', 'view') && is_customer_admin($client->userid))) { ?>
                    <div class="alert alert-info">
                        <?php echo _l('customer_admin_login_as_client_message', get_staff_full_name(get_staff_user_id())); ?>
                    </div>
                <?php } ?>
            </div>
            <?php if ($group == 'profile') { ?>
                <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
                    <button class="btn btn-info only-save customer-form-submiter">
                        <?php echo _l('submit'); ?>
                    </button>
                    <?php if (!isset($client)) { ?>
                        <button class="btn btn-info save-and-add-contact customer-form-submiter">
                            <?php echo _l('save_customer_and_add_contact'); ?>
                        </button>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if (isset($client)) { ?>
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
                                                    <a href="<?php echo admin_url('clients/login_as_client/' . $client->userid); ?>" target="_blank">
                                                        <i class="fa fa-share-square-o"></i> <?php echo _l('login_as_client'); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if (has_permission('customers', '', 'delete')) { ?>
                                                <li>
                                                    <a href="<?php echo admin_url('clients/delete/' . $client->userid); ?>" class="text-danger delete-text _delete"><i class="fa fa-remove"></i> <?php echo _l('delete'); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                                #<?php echo $client->userid . ' ' . $title; ?>
                            </h4>
                        </div>
                    </div>
                    <?php $this->load->view('admin/clients/tabs'); ?>
                </div>
            <?php } ?>
            <div class="col-md-<?php
            if (isset($client)) {
                echo 9;
            } else {
                echo 12;
            }
            ?>">
                <div class="panel_s">
                    <div class="panel-body">
                        <?php if (isset($client)) { ?>
                            <?php echo form_hidden('isedit'); ?>
                            <?php echo form_hidden('userid', $client->userid); ?>
                            <div class="clearfix"></div>
                        <?php } ?>
                        <div>
                            <div class="tab-content">
                                <?php $this->load->view('admin/clients/groups/' . $group); ?>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>

<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    } );
} );
</script>
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
<?php if (isset($client)) { ?>
    <script>
        $(function () {
            init_rel_tasks_table(<?php echo $client->userid; ?>, 'customer');
        });
    </script>
<?php } ?>
<?php if (!empty(get_option('google_api_key')) && !empty($client->latitude) && !empty($client->longitude)) { ?>
    <script>
        var latitude = '<?php echo $client->latitude; ?>';
        var longitude = '<?php echo $client->longitude; ?>';
        var mapMarkerTitle = '<?php echo $client->company; ?>';
    </script>
    <?php echo app_script('assets/js', 'map.js'); ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('google_api_key'); ?>&callback=initMap"></script>
<?php } ?>
<?php $this->load->view('admin/clients/client_js'); ?>
</body>
</html>





<script type="text/javascript">
   
$(document).on('click', '.action', function() {
  var challan_id = $(this).val();
  var type = $(this).attr('val');
  $('#chalan_id').val(challan_id); 
  $('#for').val(type); 

    if(type == 1){
        var title = 'Make Challan Delivery';
        var date_type = 'Delivery Date';
    }else{
        var title = 'Make Challan Pickup';
        var date_type = 'Pickup Date';
    }

     $('.action_title').html(title);  
     $('#date_type').html(date_type);  

}); 


$(document).on('click', '.handover', function() {  

    var challan_id = $(this).val(); 
    var type = $(this).attr('val');
    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/chalan/get_handover_data'); ?>",
        data    : {'challan_id' : challan_id, 'type' : type},
        success : function(response){
            if(response != ''){       

                if(type == 1){
                    var title = 'Delivery Hand Overs';
                }else{
                    var title = 'Pickup Hand Overs';
                }

                 $('.handover_title').html(title);  
                 $('#handover_data').html(response);  
            }
        }
    })

});

$(document).on('click', '.uplaods', function() {  

    var process_id = $(this).attr('process_id');
    var type = $(this).attr('val');

    $('#upload_data').html('');

    $('#process_id').val(process_id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/chalan/get_uploads_data'); ?>",
        data    : {'process_id' : process_id},
        success : function(response){
            if(response != ''){       

                if(type == 1){
                    var title = 'Delivery Challan Uploads';
                }else{
                    var title = 'Pickup Challan Uploads';
                }

                 $('.upload_title').html(title);  
                 $('#upload_data').html(response);  
            }
        }
    })

});    
</script>