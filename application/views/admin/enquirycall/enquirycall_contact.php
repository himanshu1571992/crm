
<?php init_head(); ?>

<style type="text/css">

    .ui-table > thead > tr > th {
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }
  .popover{
        max-width:600px;
    }
</style>


<div id="wrapper">
    <div class="content accounting-template">
     <div class="row">
        <div class="col-md-12">
            <div class="panel_s">

                <div class="widget" id="widget-user_data" data-name="User Widget">
                       <div class="panel_s user-data">
                          <div class="panel-body home-activity">
                             <div class="horizontal-scrollable-tabs">
                                <div class="scroller scroller-left arrow-left"><i class="fa fa-angle-left"></i></div>
                                <div class="scroller scroller-right arrow-right"><i class="fa fa-angle-right"></i></div>
                                <div class="horizontal-tabs">
                                   <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                                      <li role="presentation" class="active">
                                         <a href="#contact_tab" aria-controls="contact_tab" role="tab" data-toggle="tab">
                                         <i class="fa fa-users menu-icon"></i>Enquirycall Contacts </a>
                                      </li>
                                   </ul>
                                   <hr class="hr-panel-heading hr-user-data-tabs" />
                                   <div class="tab-content">
                                     
                                      <div role="tabpanel" class="tab-pane active" id="contact_tab">
                                        <div class="row">
                                           <div class="col-md-12 table-responsive">
                                            <h4 class="no-margin">Contact Person Number : <?php if(isset($enquirycall_info) && isset($enquirycall_info["customer_number"]) && $enquirycall_info["customer_number"] !="") {
                                                            $number = $enquirycall_info["customer_number"];
                                                            echo $enquirycall_info["customer_number"].' <a class="make_call" val="'.$number.'" data-toggle="modal" data-target="#myModal" href="#"><img height="35" width="35" src="'.base_url("assets/images/make_call.png").'"></a>';
                                                        }?></h4>
                                              <table class="table ui-table">
                                                 <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Call Type</th>
                                                        <th>Recording</th>
                                                        <th>Date Time</th>
                                                    </tr>
                                                 </thead>
                                                 <tbody>
                                                    <?php
                                                    if(!empty($enquirycall_info) && !empty($enquirycall_info["enquirycall_details"])){
                                                        foreach ($enquirycall_info["enquirycall_details"] as $key => $value) {
                                                            
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$key; ?></td>
                                                                <td><?php echo $value["type"]; ?></td>
                                                                <td>
                                                                    <?php if (!empty($value["recording_url"])){ ?>
                                                                    <a href="#" data-toggle="popover" class="recording_play" id="record<?php echo $key; ?>" data-placement="top" data-container="body" data-html="true" onclick="recording(this, '<?php echo $key; ?>', '<?php echo $value["recording_url"]; ?>');" style="font-size: 40px;" data-content=""><i class="fa fa-play-circle"></i></a>
                                                                    <?php }else{
                                                                        echo '--';
                                                                    } ?>
                                                                </td>
                                                                <td><?php echo date("d-m-Y H:i:s", strtotime($value["created_at"])); ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo '<tr><td class="text-center" colspan="4"><b>Record Not Found!</b></td></tr>';
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
                       </div>
                    </div>

            </div>
        </div>
     </div>
    </div>
</div>

<?php init_tail(); ?>




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
<script type="text/javascript">

    function recording(el, id, url) {
        var audio = '<audio controls autoplay><source src="' + url + '" type="audio/ogg"></audio>';
        $(el).attr('data-content', audio);
        $('#record'+id+' i').toggleClass('fa-play-circle fa-pause-circle');
    }
</script>
