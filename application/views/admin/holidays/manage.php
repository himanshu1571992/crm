<?php init_head(); ?>
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
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

</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin">Holidays List <?php if(check_permission_page(111,'create')){ ?> <a href="<?php echo admin_url('holidays/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Holiday</a> <?php } ?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                    <div class="row col-md-12">
                        <div class="form-group col-md-4" id="employee_div">
                            <label for="branch_id" class="control-label"><?php echo 'Year'; ?> *</label>
                            <select class="form-control selectpicker" data-live-search="true" id="year" name="year">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                                $j = date('Y')+1;
                                for($i=2018; $i<=$j; $i++){
                                    ?>
                                    <option value="<?php echo $i;?>" <?php if(!empty($year) && $year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px; margin-left: 5px;" class="btn btn-danger" href="">Reset</a>
                        </div>

                    </div>

                        <div class="">


                            <div class="col-md-12 table-responsive">
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Year</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($holiday_info)){
                                        $i=1;
                                        foreach($holiday_info as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i++;?>
                                                    <?php echo get_creator_info($row->added_by, $row->created_at); ?>
                                                </td>
                                                <td><?php echo $row->title;?></td>
                                                <td><?php echo $row->year;?></td>
                                                <td><?php echo date('d-m-Y',strtotime($row->date));?></td>
                                                <td class="text-center">
                                                    <?php if (strtotime($row->date) < strtotime(date('Y-m-d'))){ ?>
                                                       <button value="<?php echo $row->id; ?>" type="button" data-year="<?php echo $row->year; ?>" data-hdate="<?php echo _d($row->date); ?>" class="btn btn-info setholidaydate" data-toggle="modal" data-target="#setholidaydate_model">Reassign  Date</button>
                                                    <?php
                                                    }
                                                    if(check_permission_page(111,'edit')){
                                                    ?>
                                                        <a href="<?php echo admin_url('holidays/add/'.$row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <?php
                                                    }else{
                                                        echo '--';
                                                    }

                                                    if(check_permission_page(111,'delete')){
                                                        ?>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('holidays/delete/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php
                                                    }else{
                                                        echo '--';
                                                    }
                                                    ?>


                                                </td>

                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>


                                    </tbody>
                                  </table>
                            </div>




                            </div>
                             <!-- <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div> -->
                        </div>

                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>
<!-- Modal -->
<div id="setholidaydate_model" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <?php
    $attributes = array('id' => 'sub_form_order');
    echo form_open_multipart(admin_url("holidays/setholidaydate"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set Holiday Date</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                <div class="form-group col-md-6">
                    <label for="branch_id" class="control-label"><?php echo 'Year'; ?> </label>
                    <select class="form-control holidayyear selectpicker" data-live-search="true" required="" id="year" name="year">
                        <option value="" disabled selected >--Select One-</option>
                        <?php
                        $j = date('Y')+1;
                        for($i=2018; $i<=$j; $i++){
                            ?>
                            <option value="<?php echo $i;?>" ><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6" app-field-wrapper="date">
                    <label for="date" class="control-label"><?php echo 'Date'; ?></label>
                    <div class="input-group date">
                        <input id="date" required name="date" class="form-control datepicker holidaydate" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                    </div>
                </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" class="holidayid" name="holiday_id">
        <button type="submit" autocomplete="off" class="btn btn-info">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

</body>
</html>
<script type="text/javascript">
    $(document).on("click", ".setholidaydate", function(){
        var year = $(this).data("year");
        var hdate = $(this).data("hdate");
        var hid = $(this).attr("value");
        $(".holidayyear option[value='"+year+"']").attr("selected", "selected");
        $(".holidaydate").val(hdate);
        $(".holidayid").val(hid);
        $('.selectpicker').selectpicker('refresh');
    });
</script>
