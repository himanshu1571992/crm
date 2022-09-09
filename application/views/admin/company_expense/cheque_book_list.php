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
                    <h4 class="no-margin"><?php echo $title; ?> <?php if(check_permission_page('382','create') ){ ?> <a href="<?php echo admin_url('company_expense/addchequebook'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Cheque Book</a> <?php } ?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="Bank" class="control-label">Bank *</label>
                            <select class="form-control selectpicker" data-live-search="true"  id="bank" name="bank_id">
                                <option value=""></option>
                                <?php
                                if (isset($bank_list)) {
                                    foreach ($bank_list as $value) {
                                        ?>
                                        <option value="<?php echo $value->id; ?>" <?php echo (isset($bank_id) && $bank_id == $value->id) ? "selected" : ""; ?>><?php echo cc($value->name); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text">
                                <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                        <div class="form-group col-md-2 float-right">
                            <button class="btn btn-info" type="submit" style="margin-top: 26px;">Search</button>
                            <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                        <div class="">
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="example">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Bank Name</th>
                                        <th>Cheque Book Name</th>
                                        <th>Cheque Range</th>
                                        <th>Status</th>
                                        <th>Date Time</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($cheque_book_list)){
                                        $i=1;
                                        foreach($cheque_book_list as $row){  
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo value_by_id("tblbankmaster", $row->bank_id, "name"); ?></td>
                                                    <td><?php echo (!empty($row->chequebook_name)) ? $row->chequebook_name : "--"; ?></td>
                                                    <td><?php echo $row->from_page . "-" . $row->to_page; ?></td>
                                                    <td><div class="onoffswitch">
                                                            <input type="checkbox" data-switch-url="<?php echo admin_url('company_expense/change_chequebook_status'); ?>" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $row->id; ?>" data-id="<?php echo $row->id; ?>" <?php echo ($row->status == 1) ? "checked" : ""; ?>>
                                                            <label class="onoffswitch-label" for="<?php echo $row->id; ?>"></label>
                                                        </div>
                                                        <span class="hide"><?php echo ($row->status == 1) ? _l('is_active_export') : _l('is_not_active_export'); ?></span>
                                                    </td>
                                                    <!--<td><?php echo ($row->status == 1) ? "<span class='btn btn-success'>Active</span>" : "<span class='btn btn-danger'>De-active</span>"; ?></td>-->
                                                    <td><?php echo _d($row->created_at); ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo admin_url('company_expense/addchequebook/' . $row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <a target="_blank" href="<?php echo admin_url('company_expense/getchequebookreport/' . $row->id); ?>" class="btn btn-success" >Details</a>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('company_expense/deletechequebook/' . $row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                            
                        </div>
                      <div class="btn-bottom-toolbar text-right">
                                    <button class="btn btn-info" value="1" name="mark" type="submit">
                                        <?php echo _l('submit'); ?>
                                    </button>
                                </div>
                    </div>
                    </div>
                      
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<?php init_tail(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>

$(document).ready(function() {
    $('#example').DataTable();
} );
</script>


</body>
</html>
