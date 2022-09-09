
<?php init_head(); ?>
<?php
$s_range = '';
$date_a = '';
$date_b = '';

if(!empty($range)){
  $s_range = $range;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}

?>
<div id="wrapper" class="customer_profile">
<div class="content">
   <div class="row">
      <div class="col-md-2">
         <div class="panel_s mbot5">
            <div class="panel-body padding-10">
               <h4 class="bold"><?php echo $vendor_info->name; ?></h4>
            </div>
         </div>
         <?php echo vendor_report_tab('contacts',$vendor_info->id);?>
      </div>
          
          <form  action=""  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                   <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; ?></h4>
                        </div>
                    </div>
                    <hr class="hr-panel-heading">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive s_table">
                          <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                            <thead>
                              <tr>
                                <th width="20%" align="left"><?php echo _l('name');?></th>
                                <th width="20%" class="qty" align="left"><?php echo _l('email');?></th>
                                <th width="20%" align="left"><?php echo _l('number');?>	</th>
                                <th width="20%" align="left"><?php echo _l('designation');?>	</th>
                                <!-- <th width="20%" align="left"><?php echo _l('type');?>	</th> -->
                                <th width="10%"  align="center"><i class="fa fa-cog"></i></th>
                              </tr>
                            </thead>
                            <tbody class="ui-sortable">
                              <?php $k = 0;?>
                              <tr class="main" id="tr<?php echo $k;?>">
                                <td>
                                  <div class="form-group">
                                    <input type="text" id="name" name="vendordata[<?php echo $k;?>][name]" class="form-control" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="email" id="email<?php echo $k;?>" name="vendordata[<?php echo $k;?>][email]" onBlur="checkmail(this.value,<?php echo $k;?>);" class="form-control clientmail" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <input type="text" maxlength="10" minlength="10" id="phonenumber<?php echo $k;?>" name="vendordata[<?php echo $k;?>][phonenumber]" onBlur="checkcontno(this.value,<?php echo $k;?>);" class="form-control onlynumbers" required>
                                  </div><div id="phonenumberdiv1"></div>
                                </td>
                                <td>
                                  <div class="form-group">
                                    <select class="form-control selectpicker" data-live-search="true" id="designation_id" name="vendordata[<?php echo $k;?>][designation_id]" required>
                                      <option value=""></option>
                                      <?php
                                      if (isset($designation_data) && count($designation_data) > 0) {
                                        foreach ($designation_data as $designation_key => $designation_value) {
                                          ?>
                                          <option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option>
                                          <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </td>
                                <!-- <td>
                                  <div class="form-group">
                                    <select class="form-control selectpicker" data-live-search="true" id="contact_type" name="vendordata[<?php echo $k;?>][contact_type]" required>
                                      <option value=""></option>
                                      <?php
                                      if (isset($contact_type_data) && count($contact_type_data) > 0) {
                                        foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
                                          ?>
                                          <option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option>
                                          <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </td> -->
                                <td>
                                  <button type="button" class="btn pull-right btn-danger"  onclick="removevendorperson(<?php echo $k;?>);" ><i class="fa fa-remove"></i></button>
                                </td>
                              </tr>

                            </tbody>
                          </table>
                          <div class="col-xs-12">
                            <label class="label-control subHeads"><a  class="addmore" value="<?php echo $k; ?>">Add More <i class="fa fa-plus"></i></a></label>
                          </div>
                        </div>
                      </div>
                    </div> 
                      <div class="form-group col-md-2">
                        <button class="form-control btn-info" type="submit">Submit</button>
                      </div>



                        </div>
                        </div>
                       
                    </div>
                </div>
        </form>
   </div>
</div>
</div>

<?php init_tail(); ?>

</body>
</html>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body">
        <div id="approval_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>


<script type="text/javascript">
  $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        // $('#myTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><input type="text" id="firstname" name="vendordata['+newaddmore+'][firstname]" class="form-control" ></div></td><td><div class="form-group"><input type="email" id="email'+newaddmore+'" name="vendordata['+newaddmore+'][email]" class="form-control onlynumbers" onBlur="checkmail(this.value,'+newaddmore+');"></div></td><td><div class="form-group"><input type="text" maxlength="10" minlength="10" id="phonenumber'+newaddmore+'" onBlur="checkcontno(this.value,'+newaddmore+');" name="vendordata['+newaddmore+'][phonenumber]" onkeyup="nospaces(this)" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="vendordata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="contact_type" name="vendordata['+newaddmore+'][contact_type]"><option value=""></option><?php	if (isset($contact_type_data) && count($contact_type_data) > 0) {foreach ($contact_type_data as $contact_type_key => $contact_type_value) {?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php }}?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
        $('#myTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><input type="text" id="firstname" name="vendordata['+newaddmore+'][name]" class="form-control" ></div></td><td><div class="form-group"><input type="email" id="email'+newaddmore+'" name="vendordata['+newaddmore+'][email]" class="form-control " onBlur="checkmail(this.value,'+newaddmore+');"></div></td><td><div class="form-group"><input type="text" maxlength="10" minlength="10" id="phonenumber'+newaddmore+'" name="vendordata['+newaddmore+'][phonenumber]" onchange="checkonlynumber(this);" onBlur="checkcontno(this.value,'+newaddmore+');" class="form-control onlynumbers" required></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="vendordata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php }}?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});

  function removevendorperson(procompid)
  {
      $('#tr' + procompid).remove();
  }

  function checkmail(value,id)
	{
		var url = '<?php echo base_url(); ?>admin/Site_manager/checkmail';
		$.post(url,
				{
					vendormail: value,
				},
				function (data, status) {
          var res=JSON.parse(data);
          if(res.totalcontact!=0)
          {
            $('#email'+id).css("cssText", "border-color: red !important;");
          }
          else
          {
            $('#email'+id).css("cssText", "border-color: none !important;");
          }
				});
	}
	function checkcontno(value,id)
	{
		var url = '<?php echo base_url(); ?>admin/Site_manager/checkcontno';
		$.post(url,
				{
					venderno: value,
				},
				function (data, status) {
          var res=JSON.parse(data);
          if(res.totalcontact!=0)
          {
            $('#phonenumber'+id).css("cssText", "border-color: red !important;");
          }
          else
          {
            $('#phonenumber'+id).css("cssText", "border-color: none !important;");
          }
				});
	}

  function checkonlynumber(event){
    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
        event.preventDefault(); //stop character from entering input
    }
  }
  $(document).on("keypress", ".onlynumbers", function(event){
    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
      event.preventDefault(); //stop character from entering input
    }
  });

  // $('.onlynumbers').keypress(function(event){
  //     alert();
  //     if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
  //         event.preventDefault(); //stop character from entering input
  //     }
  //   });
</script>