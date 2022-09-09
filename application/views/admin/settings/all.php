<?php init_head(); ?>
<?php $designationdata = $this->db->get('tbldesignation')->result_array();?>
<div id="wrapper">
 <div class="content">
  <?php echo form_open_multipart($this->uri->uri_string().'?group='.$view_name,array('id'=>'settings-form')); ?>
  <div class="row">
   <?php if($this->session->flashdata('debug')){ ?>
   <div class="col-lg-12">
    <div class="alert alert-warning">
     <?php echo $this->session->flashdata('debug'); ?>
   </div>
 </div>
 <?php } ?>
 <div class="col-md-3">

  <ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked">
    <?php $settings_groups = array(
      array(
        'name'=>'general',
        'lang'=>_l('settings_group_general'),
        'order'=>1,
      ),
      array(
        'name'=>'company',
        'lang'=>_l('company_information'),
        'order'=>2,
      ),
	  
	array(
        'name'=>'warehouselist',
        'lang'=>_l('Warehouse'),
        'order'=>3,
      ),
	array(
        'name'=>'paymenttypelist',
        'lang'=> "Payment Type",
        'order'=>4,
      ),
	  array(
        'name'=>'banklist',
        'lang'=>_l('bank'),
        'order'=>5,
      ),
    array(
        'name'=>'receiptlist',
        'lang'=>'General Receipt',
        'order'=>6,
      ),
	   array(
        'name'=>'branchlist',
        'lang'=>_l('company_branch'),
        'order'=>7,
      ),
      array(
        'name'=>'localization',
        'lang'=>_l('settings_group_localization'),
        'order'=>8,
      ),
      array(
        'name'=>'email',
        'lang'=>_l('settings_group_email'),
        'order'=>9,
      ),
      array(
        'name'=>'sales',
        'lang'=>_l('settings_group_sales'),
        'order'=>10,
      ),
      array(
        'name'=>'subscriptions',
        'lang'=>_l('subscriptions'),
        'order'=>11,
      ),
      array(
        'name'=>'online_payment_modes',
        'lang'=>_l('settings_group_online_payment_modes'),
        'order'=>12,
      ),
      array(
        'name'=>'clients',
        'lang'=>_l('settings_group_clients'),
        'order'=>13,
      ),
      array(
        'name'=>'tasks',
        'lang'=>_l('tasks'),
        'order'=>14,
      ),
      array(
        'name'=>'tickets',
        'lang'=>_l('support'),
        'order'=>15,
      ),
      array(
        'name'=>'leads',
        'lang'=>_l('leads'),
        'order'=>16,
      ),
      array(
        'name'=>'calendar',
        'lang'=>_l('settings_calendar'),
        'order'=>17,
      ),
      array(
        'name'=>'pdf',
        'lang'=>_l('settings_pdf'),
        'order'=>18,
      ),
      array(
        'name'=>'e_sign',
        'lang'=>'E-Sign',
        'order'=>19,
      ),
      array(
        'name'=>'cronjob',
        'lang'=>_l('settings_group_cronjob'),
        'order'=>20,
      ),
      array(
        'name'=>'tags',
        'lang'=>_l('tags'),
        'order'=>21,
      ),
      array(
        'name'=>'pusher',
        'lang'=>'Pusher.com',
        'order'=>22,
      ),
      array(
        'name'=>'misc',
        'lang'=>_l('settings_group_misc'),
        'order'=>23,
      ),
      array(
        'name'=>'payment_method_list',
        'lang'=>'Payment Method',
        'order'=>24,
      ),
      
    );

    if (is_admin() == 1){
        $settings_groups = array_merge($settings_groups, array(array(
            'name'=>'employee_master_password',
            'lang'=>'Employee Master Password',
            'order'=>25,
          )));
    }
    $settings_groups = do_action('settings_groups',$settings_groups);
    usort($settings_groups, function($a, $b) {
      return $a['order'] - $b['order'];
    });
    ?>
    <?php
    $i = 0;
    foreach($settings_groups as $group){
      if($group['name'] == 'update' && !is_admin()){continue;}
      ?>
      <li<?php if($i == 0){echo " class='active'"; } ?>>
      <a href="<?php echo (!isset($group['url']) ? admin_url('settings?group='.$group['name']) : $group['url']) ?>" data-group="<?php echo $group['name']; ?>">
        <?php echo $group['lang']; ?></a>
      </li>
      <?php $i++; } ?>
    </ul>
    <div class="panel_s">
      <div class="panel-body">
  <?php
	  if($_GET['group']!='banklist' & $_GET['group']!='warehouselist' & $_GET['group']!='branchlist' & $_GET['group']!='paymenttypelist')
	  {?>
        <a href="<?php echo admin_url('settings?group=update'); ?>" class="<?php if($this->input->get('group') == 'update'){echo 'bold';} ?>"><?php echo _l('settings_update'); ?></a>
        <div class="btn-bottom-toolbar text-right">
         <button type="submit" class="btn btn-info"><?php echo _l('settings_save'); ?></button>
       </div>
  <?php
	  }?>
     </div>
   </div>
 </div>
 <div class="col-md-9">
  <div class="panel_s">
   <div class="panel-body">
    <?php do_action('before_settings_group_view',$group_view); ?>
    <?php echo $group_view; ?>
    <?php do_action('after_settings_group_view',$group_view); ?>
  </div>
</div>
</div>
<div class="clearfix"></div>
</div>
<?php echo form_close(); ?>
<div class="btn-bottom-pusher"></div>
</div>
</div><?php print_r($warehouse);?>
<div id="new_version"></div>
<?php init_tail(); ?>
<script>
 $(function(){
  $('input[name="settings[email_protocol]"]').on('change',function(){
    if($(this).val() == 'mail'){
      $('.smtp-fields').addClass('hide');
    } else {
     $('.smtp-fields').removeClass('hide');
   }
 });
  $('.sms_gateway_active input').on('change',function(){
    if($(this).val() == '1') {
      $('body .sms_gateway_active').not($(this).parents('.sms_gateway_active')[0]).find('input[value="0"]').prop('checked',true);
    }
  });
  <?php if($view_name == 'pusher'){ ?>
    <?php if(get_option('desktop_notifications') == '1'){ ?>
      // Let's check if the browser supports notifications
      if (!("Notification" in window)) {
        $('#pusherHelper').html('<div class="alert alert-danger">Your browser does not support desktop notifications, please disable this option or use more modern browser.</div>');
      } else {
        if(Notification.permission == "denied"){
          $('#pusherHelper').html('<div class="alert alert-danger">Desktop notifications not allowed in browser settings, search on Google "How to allow desktop notifications for <?php echo $this->agent->browser(); ?>"</div>');
        }
      }
      <?php } ?>
      <?php if(get_option('pusher_realtime_notifications') == '0'){ ?>
        $('input[name="settings[desktop_notifications]"]').prop('disabled',true);
        <?php } ?>
        <?php } ?>
        $('input[name="settings[pusher_realtime_notifications]"]').on('change',function(){
          if($(this).val() == '1'){
            $('input[name="settings[desktop_notifications]"]').prop('disabled',false);
          } else {
            $('input[name="settings[desktop_notifications]"]').prop('disabled',true);
            $('input[name="settings[desktop_notifications]"][value="0"]').prop('checked',true);
          }
        });
        $('.test_email').on('click', function() {
          var email = $('input[name="test_email"]').val();
          if (email != '') {
           $(this).attr('disabled', true);
           $.post(admin_url + 'emails/sent_smtp_test_email', {
            test_email: email
          }).done(function(data) {
            window.location.reload();
          });
        }
      });
        $('#update_app').on('click',function(e){
         e.preventDefault();
         $('input[name="settings[purchase_key]"]').parents('.form-group').removeClass('has-error');
         var purchase_key = $('input[name="settings[purchase_key]"]').val();
         var latest_version = $('input[name="latest_version"]').val();
         var update_errors;
         if(purchase_key != ''){
           var ubtn = $(this);
           ubtn.html('<?php echo _l('wait_text'); ?>');
           ubtn.addClass('disabled');
           $.post(admin_url+'auto_update',{purchase_key:purchase_key,latest_version:latest_version,auto_update:true}).done(function(){
             window.location.reload();
           }).fail(function(response){
             update_errors = JSON.parse(response.responseText);
             $('#update_messages').html('<div class="alert alert-danger"></div>');
             for (var i in update_errors){
              $('#update_messages .alert').append('<p>'+update_errors[i]+'</p>');
            }
            ubtn.removeClass('disabled');
            ubtn.html($('.update_app_wrapper').data('original-text'));
          });
         } else {
          $('input[name="settings[purchase_key]"]').parents('.form-group').addClass('has-error');
        }
      });
      });
	  
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
	
	
	 $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select style="display: block !important;" onChange="staffdata(' + newaddmore + ');" class="form-control selectpicker" id="staff_id'+newaddmore+'" name="staffdata[' + newaddmore + '][staff_id]" staff="' + newaddmore + '" data-live-search="true"><option value=""></option><?php  if (isset($staff_data) && count($staff_data) > 0) {  foreach ($staff_data as $unit_key => $staff_value) {?><option value="<?php echo $staff_value['staffid'] ?>" ><?php echo $staff_value['firstname'].' '. $staff_value['lastname']; ?></option><?php
    }
}
?></select></div></td><td> <div class="form-group"><input type="text" id="email' + newaddmore + '" name="staffdata[' + newaddmore + '][email]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="contno' + newaddmore + '" name="staffdata[' + newaddmore + '][contno]" class="form-control" ></div></td><td><select class="form-control selectpicker" data-live-search="true" id="designation' + newaddmore + '" name="staffdata[' + newaddmore + '][designation]" style="display: block !important;"><option value=""></option><?php  if (isset($designationdata) && count($designationdata) > 0) {  foreach ($designationdata as $designationdata_key => $designationdata_value) {?><option value="<?php echo $designationdata_value['id'] ?>"><?php echo $designationdata_value['designation']; ?></option><?php }}?></select></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
	
	 $('.addmoreperson').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select style="display: block !important;" data-live-search="true" class="form-control selectpicker" id="staff_id'+newaddmore+'" onChange="staffdata(' + newaddmore + ');" staff="' + newaddmore + '" name="companystaff[' + newaddmore + '][staff_id]" ><option value=""></option><?php  if (isset($staff_data) && count($staff_data) > 0) {  foreach ($staff_data as $unit_key => $staff_value) {?><option value="<?php echo $staff_value['staffid'] ?>" ><?php echo $staff_value['firstname'].' '. $staff_value['lastname']; ?></option><?php
    }
}
?></select></div></td><td> <div class="form-group"><input type="text" id="email' + newaddmore + '" name="companystaff[' + newaddmore + '][email]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="contno' + newaddmore + '" name="companystaff[' + newaddmore + '][contno]" class="form-control" ></div></td><td><select class="form-control selectpicker" data-live-search="true" id="designation' + newaddmore + '" name="companystaff[' + newaddmore + '][designation]" style="display: block !important;"><option value=""></option><?php  if (isset($designationdata) && count($designationdata) > 0) {  foreach ($designationdata as $designationdata_key => $designationdata_value) {?><option value="<?php echo $designationdata_value['id'] ?>"><?php echo $designationdata_value['designation']; ?></option><?php }}?></select></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
	
	
	function staffdata(sataff)
	{
		var staff_id=$('#staff_id'+sataff).val();
		var url = admin_url + 'Settings/getstaffdet/';
            $.post(url,
                    {
                        staff_id: staff_id,
                    },
                    function (data, status) {
						var res=JSON.parse(data);
						$('#email'+sataff).val(res.staff_email);
						$('#email'+sataff).attr('readonly', true);
						$('#contno'+sataff).val(res.staff_number);
						$('#contno'+sataff).attr('readonly', true);
						$('#designation'+sataff).val(res.staff_designation);
						$('#designation'+sataff).attr('readonly', true);
                    });	
	}
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }
	
</script>
  </body>
  </html>
