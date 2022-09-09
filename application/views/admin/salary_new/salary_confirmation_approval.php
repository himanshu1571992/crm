<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>

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
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title;?></h4>
                                <hr/>
                            </div>     
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="year_id" class="control-label" style="color:#2196f3;font-size: 20px;">Month-Year :</label>
                                                    <p><?php 
                                                    if (!empty($salaryconfirmation_info)){
                                                        $month = value_by_id("tblmonths", $salaryconfirmation_info->month_id, "month_name");
                                                        $year = $salaryconfirmation_info->year_id;
                                                        echo $month.", ".$year;
                                                    }
                                                     ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">   
                                         <div class="panel_s">
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <label for="request_type" class="control-label" style="color:#2196f3;font-size: 20px;">Request Type :</label>
                                                    <div class="input-group">
                                                        <p>
                                                            <?php
                                                            if (!empty($salaryconfirmation_info)) {
                                                                if ($salaryconfirmation_info->request_type == 1) {
                                                                    echo "Negative Wallet Balance";
                                                                } else {
                                                                    echo "Salary On Hold";
                                                                }
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <div class="form-group ">
                                                    <div class="form-group ">
                                                        <label for="send_by" class="control-label" style="color:#2196f3;font-size: 20px;">Send by :</label>
                                                        <p ><?php echo (!empty($salaryconfirmation_info)) ? get_staff_full_name($salaryconfirmation_info->staff_id) : ""; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="note" class="control-label" style="color:#2196f3;font-size: 20px;">Note : </label>
                                                    <p><?php echo (isset($salaryconfirmation_info)) ? $salaryconfirmation_info->remark : ""; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <br>
                                <div class="table-responsive s_table compdv">
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2% !important;">
                                        <thead>
                                            <tr>
                                                <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                                <th width="25%" align="left">Employee Name</th>
                                                <th width="20%" align="left">Branch</th>
                                                <th width="10%" align="left">Advance Convenience</th>
                                                <th width="10%" align="left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ui-sortable">
                                            <?php
                                            if (!empty($salaryconfirmation_details)) {
                                                foreach ($salaryconfirmation_details as $key => $value) {
                                                    
                                                    ?>
                                                    <tr class="main" id="tr0">
                                                        <td align="center"> <?php echo ++$key; ?></td>
                                                        <td> <?php echo get_staff_full_name($value->staff_id); ?></td>
                                                        <td> <?php echo get_branch($value->staff_id); ?></td>
                                                        <td><?php echo number_format(wallet_amount($value->staff_id), 2); ?></td>
                                                        <td>
                                                            <select class="form-control" id="staff_action" name="staffdata[<?php echo $key; ?>][staff_action]">
                                                                <option value="1">Accept</option>
                                                                <option value="2">On Hold</option>
                                                            </select>
                                                            <input type="hidden" name="staffdata[<?php echo $key; ?>][staff_id]" value="<?php echo $value->staff_id; ?>">
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
                        <?php
                            if (empty($check_approval)){
                        ?>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remark" class="control-label">Approval Remark</label>
                                    <textarea id="remark" rows="5" required="" name="approval_remark" class="form-control" placeholder="remark..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').first().append('<tr class="main" id="tr' + newaddmore + '"> <td> <div class="form-group"> <select class="form-control selectpicker" data-live-search="true" id="assign" name="complaindata[' + newaddmore + '][product_id]" required=""><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {
        if ($product_value['is_temp'] == 0) {
            $product_code = product_code($product_value['id']);
        } else {
            $product_code = temp_product_code($product_value['id']);
        }
        ?><option data-is_temp="<?php echo $product_value['is_temp']; ?>" value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].$product_code ?></option><?php

    }

}

?></select> </div></td><td><div class="form-group"><input class="form-control" type="number" name="complaindata[' + newaddmore + '][qty]"></div></td><td> <div class="form-group"> <textarea id="remarks" name="complaindata[' + newaddmore + '][defect_remark]" class="form-control"></textarea> </div></td><td> <button type="button" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');" ><i class="fa fa-remove"></i></button> </td></tr>');
$('.selectpicker').selectpicker('refresh');
    
    });
    
    
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }

    /*function staffdropdown()
    {
        $.each($("#assign option:selected"), function(){
           var select=$(this).val();   
           $("optgroup."+select).children().attr('selected','selected');
        });
        $('.selectpicker').selectpicker('refresh');
        $.each($("#assign option:not(:selected)"), function(){
           var select=$(this).val();   
           $("optgroup."+select).children().removeAttr('selected');
        });
        $('.selectpicker').selectpicker('refresh');
    }*/
   
    
</script>


<script type="text/javascript">
    $(document).on('click', '.addmore_model', function(){    
    
        var row = parseInt($(this).attr('val'));
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
     

          $('#table_'+row+' tbody').append('<tr id="trcf_'+row+'_'+newaddmore+'"><td><input class="form-control" name="customdata[product_field_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" name="customdata[product_value_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" name="customdata[product_remark_'+row+']['+newaddmore+']" type="text" ></td><td><button type="button" value="'+newaddmore+'" class="btn pull-right btn-danger" onclick="removeprofield('+row+','+newaddmore+');"><i class="fa fa-remove"></i></button></td></tr> ');

    });

    function removeprofield(row,procompid)
    {
        $('#trcf_'+row+'_'+procompid).remove();
    }
</script>


</body>
</html>
