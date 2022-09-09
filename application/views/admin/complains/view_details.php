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
                                        <div class="form-group ">
                                            <label for="source" class="control-label">Customer :</label>
                                            <?php
                                                $client_info = $this->db->query("SELECT * FROM `tblclients` where `userid` = '".$complain_info->client_id."'")->row(); 
                                            ?>
                                            <p ><?php echo (!empty($client_info)) ? $client_info->company : ""; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="source" class="control-label">Complain Type :</label>
                                            <p ><?php echo (!empty($complain_info)) ? value_by_id("tblcomplainstypes", $complain_info->complain_type_id, "title") : ""; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">   
                                        <div class="form-group ">
                                            <label for="complain_date" class="control-label">Complain Date :</label>
                                            <div class="input-group date">
                                                <p><?php echo (isset($complain_info)) ? _d($complain_info->complain_date) : '--'; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location" class="control-label">Location :</label>
                                            <p><?php echo (isset($complain_info)) ? $complain_info->location : ""; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remark" class="control-label">Remark : </label>
                                            <p><?php echo (isset($complain_info)) ? $complain_info->remark : ""; ?></p>
                                        </div>
                                    </div>
                                    <?php if(isset($page) && $page == "upload_action_plan"){?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="action plan" class="control-label">Action Plan File : </label>
                                                <input type="file" required="" id="filer_input2" class="form-control"  name="files[]" multiple="">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <br>
                                <div class="row">
                                    <div class="table-responsive s_table compdv">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                            <thead>
                                                <tr>
                                                    <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                                    <th width="35%" align="left">Product Name</th>
                                                    <th width="10%" align="left">Quantity</th>
                                                    <th width="20%" align="left">Defect Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ui-sortable">
                                                <?php
                                                    if (!empty($complain_products)){
                                                        foreach ($complain_products as $key => $value) {
                                                           
                                                ?>
                                                            <tr class="main" id="tr0">
                                                                <td align="center"> <?php echo ++$key; ?></td>
                                                                <td> <?php echo value_by_id("tblproducts", $value->product_id, "name"); ?></td>
                                                                <td><?php echo $value->qty;?></td>
                                                                <td><?php echo $value->defect_remark;?></td>
                                                            </tr>
                                                <?php   }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if (!isset($page)){
                        ?>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
                        <?php }elseif(isset($page) && $page == "approval"){
                            if(empty($approval_info) OR (!empty($approval_info) && $approval_info->approve_status == 5)){    
                        ?>
                            <div class="btn-bottom-toolbar text-right">
                                <button type="submit" name="action" value="5" style="background-color: #f9d306;color:#fff;" class="btn">On Hold</button>
                                <button type="submit" name="action" value="4" style="background-color: #9d0b1a;color:#fff;" class="btn">Reconciliation</button>
                                <button class="btn btn-info" name="action" value="1" type="submit">Approve</button>
                                <button class="btn btn-danger" name="action" value="2" type="submit">Reject</button>
                            </div>
                        <?php }
                            }elseif(isset($page) && $page == "upload_action_plan"){ ?>
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" type="submit">
                                    <?php echo _l('submit'); ?>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if(isset($page) && $page == "approval"){ ?>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remark" class="control-label">Approval Remark</label>
                                    <textarea id="remark" rows="5" required="" name="approval_remark" class="form-control" placeholder="remark..."><?php echo (!empty($approval_info) && !empty($approval_info->approve_remark)) ? $approval_info->approve_remark : ""; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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
