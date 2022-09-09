<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" >
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="no-margin"><?php echo $title; ?> </h4>
                                    <?php if(check_permission_page(383,'create')){?>
                                    <a href="<?php echo admin_url('enquirytype/addleadcategory'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Add Lead Category</a>
                                    <?php } ?>
                                </div>
                            </div>	                   

                            <hr class="hr-panel-heading">

                            <div class="row">
                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>DateTime</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($lead_category_list)) {
                                                foreach ($lead_category_list as $k => $row) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo ++$k; ?></td>
                                                        <td><?php echo cc($row->title); ?></td>
                                                        <td><?php echo (!empty($row->description)) ? $row->description : "--"; ?></td>
                                                        <td><div class="onoffswitch">
                                                                <input type="checkbox" data-switch-url="<?php echo admin_url('enquirytype/change_unverifiedlead_status'); ?>" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $row->id; ?>" data-id="<?php echo $row->id; ?>" <?php echo ($row->status == 1) ? "checked" : ""; ?>>
                                                                <label class="onoffswitch-label" for="<?php echo $row->id; ?>"></label>
                                                            </div>
                                                            <span class="hide"><?php echo ($row->status == 1) ? _l('is_active_export') : _l('is_not_active_export'); ?></span>
                                                        </td>
                                                        <td><?php echo date("d-m-Y H:i:s", strtotime($row->created_at)); ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                            <?php 
                                                            if ($row->id != 3){
                                                                if(check_permission_page(383,'edit')){?>
                                                                    <a href="<?php echo admin_url('enquirytype/addleadcategory/' . $row->id); ?>" class="btn-sm btn-primary" target="_blank" title="Edit Lead Category"><i class="fa fa-edit"></i></a>   
                                                                <?php } 
                                                                    if(check_permission_page(383,'delete')){?>
                                                                    <a href="<?php echo admin_url('enquirytype/deleteleadcategory/' . $row->id); ?>" class="btn-sm btn-danger _delete" title="Delete Lead Category"><i class="fa fa-trash"></i></a>   
                                                                <?php }
                                                            }
                                                            ?>    
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

<?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>



                            <div class="btn-bottom-toolbar text-right">

                            </div>

                            <!-- Tracks used in this music/audio player application are free to use. I downloaded them from Soundcloud and NCS websites. I am not the owner of these tracks. -->



                        </div>

                    </div>
                </div>

            </form>
        </div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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

                                            $(document).ready(function () {
                                                $('#newtable').DataTable({
                                                });
                                            });
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script> 


<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {
        if (!$("input[name='staffid[]']").is(":checked")) {
            alert('Please Check Any Checkbox First!');
            return false;
        } else {
            $("#salary_form").submit();
        }



    });
</script> 

<script type="text/javascript">
    $(".myselect").select2();
</script>

<script type="text/javascript">
    $('.status').click(function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/approval/get_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script> 


<script type="text/javascript">
    $(document).on('click', '.uplaods', function () {

        var id = $(this).val();
        $('#mr_id').val(id);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_mr_uploads_data'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {

                    $('#upload_data').html(response);
                }
            }
        })

    });
</script>
<script type="text/javascript">

    function recording(el, id, url) {
        var audio = '<audio controls autoplay><source src="' + url + '" type="audio/ogg"></audio>';
        $(el).attr('data-content', audio);
        $('#record'+id+' i').toggleClass('fa-play-circle fa-pause-circle');
    }
</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calling Numbers</h4>
      </div>
       <form  action="<?php echo admin_url('leads/make_call'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="modal-body">

        <div class="form-group">
            <label for="exotel_number" class="control-label">Select Calling Number</label>
            <select class="form-control selectpicker" name="exotel_number" required="" data-live-search="true">
              <option value=""></option>
              <?php
              if (isset($calling_numbes) && count($calling_numbes) > 0) {
                foreach ($calling_numbes as $r) {
                  ?>
                  <option value="<?php echo $r->exotel_number; ?>" ><?php echo $r->exotel_number; ?></option>
                  <?php
                }
              }
              ?>
            </select>

            <input type="hidden" name="customer_number" id="customer_number" >
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" >Make Call</button>
      </div>
    </form>
    </div>

  </div>
</div>


</body>
</html>

<script type="text/javascript">
  $(document).on('click', '.make_call', function() {
  var customer_number = $(this).attr('val');
  $("#customer_number").val(customer_number); 
});  

</script>

</body>
</html>
