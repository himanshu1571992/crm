<div id="tagstaffmodel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Person To Tag</h4>
      </div>
      <?php
        $branch_list = $this->db->query("SELECT * FROM `tblcompanybranch` WHERE `status` = 1 ")->result();
        $department_list = $this->db->query("SELECT * FROM `tbldepartmentsmaster` WHERE `status` = 1 ")->result();
      ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6" style="margin-bottom: 6px;">
              <div class="form-group" app-field-wrapper="branch">
                  <label for="branch" class="control-label">Branch</label>
                  <select class="form-control selectpicker branch_id" onchange="get_staff_list();" id="branch_id" name="branch_id" data-live-search="true">
                      <option value=""></option>
                      <?php
                        if (!empty($branch_list)) {
                            foreach ($branch_list as $value) {
                                echo '<option value="' . $value->id . '" >' . $value->comp_branch_name . '</option>';
                            }
                        }
                      ?>
                  </select>
              </div>
            </div>
            <div class="col-md-6" style="margin-bottom: 6px;">
              <div class="form-group" app-field-wrapper="department_id">
                  <label for="department_id" class="control-label">Department</label>
                  <select class="form-control selectpicker department_id" onchange="get_staff_list();" id="department_id" name="department_id" data-live-search="true">
                      <option value=""></option>
                      <?php
                        if (!empty($department_list)) {
                            foreach ($department_list as $value) {
                                echo '<option value="' . $value->id . '" >' . $value->name . '</option>';
                            }
                        }
                      ?>
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="staff_selection_div"></div>
            </div>   
          </div>
        </div>
      </div>
      <div class="modal-footer">
           <input type="hidden" class="tag_box_id" value="0">             
          <button type="submit" class="btn btn-info tag_btn" style="display: none;">Tag</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

    
 $(document).on("click", ".tag_employee_btn", function(){
    $("#tagstaffmodel").modal("show");
    var tag_box = $(this).attr("value");
    $(".tag_box_id").val(tag_box);
 });

  function get_staff_list(){
    var branch_id = $("#branch_id").val();
    var department_id = $("#department_id").val();
    $(".staff_selection_div").html('');
    if (branch_id !='' && department_id !=''){
      $.ajax({
          type    : "POST",
          url     : "<?php echo site_url('admin/follow_up/get_branch_employees'); ?>",            
          data    : {'branch_id': branch_id, 'department_id' : department_id},
          success : function(response){
            if(response != ''){
              $(".staff_selection_div").html(response);
              $('.selectpicker').selectpicker('refresh'); 
            }
          }
      });
    }
  }
  function showtag_btn(el){
     var staff = $("#staffuserlist").val();
     $(".tag_btn").hide();
     if (staff != ''){
        $(".tag_btn").show();
        var tagstaff = $(".staff_ids").val();
        tagselection = el.selectedOptions.length;
        for (let i = 0; i < el.selectedOptions.length; i++) {
          if (tagstaff == ''){
            tagstaff = el.selectedOptions[i].getAttribute('data-staff_id');
          }else{
            tagstaff = tagstaff+','+el.selectedOptions[i].getAttribute('data-staff_id');
          }
        }
        $(".staff_ids").val(tagstaff);
     }
  }

  $(document).on("click", ".tag_btn", function(){
    var tag_box_id = $(".tag_box_id").val();
    var staff = $("#staffuserlist").val();
    // var staff = $(".staff_ids").val();
    if (staff == ''){
      alert("Please Select Someone for tagging");
    }else{
      var descriptionval = $("#description"+tag_box_id).val();
      $(".branch_id").val('');
      $(".department_id").val('');
      $('.selectpicker').selectpicker('refresh');
      $(".staff_selection_div").html("");
      $("#tagstaffmodel").modal("hide");
      $(".tag_btn").hide();
      $("#description"+tag_box_id).val(descriptionval+' '+staff);
      $("#description"+tag_box_id).focus();
    }
  });

</script>