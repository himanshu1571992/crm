<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;} 
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
      /*width:inherit;*/ /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}</style>

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

           <form action="<?php echo site_url($this->uri->uri_string()); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <?php $visible = ($section == "view") ? "readonly=''": ""; ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                       
                         <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Date </label>
                                <?php $salesdate = (isset($sales_report_info)) ? db_date($sales_report_info->salesdate) : date("d/m/Y") ?>
                                <input type="text" id="date" <?php echo $visible; ?> name="salesdate" class="form-control datepicker" value="<?php echo $salesdate; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="remark" class="control-label">Remarks</label>
                                <?php $remark = (isset($sales_report_info)) ? $sales_report_info->remark : "" ?>
                                <textarea id="remark" <?php echo $visible; ?> class="form-control" required="" name="remark"><?php echo $remark; ?></textarea>
                            </div>    

                        </div>
                        <br/>
                        <br/>
                        <div id="demoAccordion">
                            <?php $i = 0; ?>
                            <?php if (isset($sales_details)){ 
                                    foreach ($sales_details as $svalue) {
                            ?>
                                <h2 class="salesitems<?php echo $i;?>">Sales Details</h2>
                                <div id="form_data_<?php echo $i;?>">  
                                    <fieldset class="scheduler-border">
                                        <br>    
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Client Name </label>
                                                        <?php if ($svalue->client_id == 0 ) { ?>
                                                            <a href="javascript:void(0);" style="float: right;" class="select<?php echo $i; ?>" onclick="enableselectname('<?php echo $i; ?>');">Select Name</a>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);" style="float: right;" class="enter<?php echo $i; ?>" onclick="enablename('<?php echo $i; ?>');">Enter Name</a>
                                                        <?php } ?>
                                                        <div class="client_<?php echo $i; ?>">
                                                            <?php if ($svalue->client_id == 0 ) { ?>
                                                                <input type="text" class="form-control" <?php echo $visible; ?> id="client_name<?php echo $i; ?>" name="salesdetails[<?php echo $i; ?>][client_name]" value="<?php echo $svalue->clientname; ?>">
                                                            <?php }else{?>
                                                                <select class="form-control selectpicker client_id<?php echo $i; ?>" required="" val="<?php echo $i;?>" onchange="getclientdetails('<?php echo $i; ?>')" id="client_id<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][client_id]">
                                                                  <option value="" disabled selected >--Select One-</option>
                                                                  <?php
                                                                    if ($client_list){
                                                                        foreach ($client_list as $value) { ?>
                                                                            <option value="<?php echo $value->userid; ?>" <?php echo ($value->userid == $svalue->client_id) ? "selected":""; ?>><?php echo cc($value->client_branch_name); ?></option>
                                                                <?php   }
                                                                    }
                                                                  ?>
                                                                </select>
                                                            <?php }?>
                                                        </div>
                                                        
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Contact Person </label>                                    
                                                     <input type="text" id="contact_parson<?php echo $i;?>" <?php echo $visible; ?> name="salesdetails[<?php echo $i;?>][contact_parson]" class="form-control" value="<?php echo ($svalue->contact_person) ? $svalue->contact_person : ""; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Contact Number </label>                                    
                                                     <input type="text" id="contact_number<?php echo $i;?>" <?php echo $visible; ?> name="salesdetails[<?php echo $i;?>][contact_number]" class="form-control" value="<?php echo ($svalue->contact_number) ? $svalue->contact_number : ""; ?>">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Industry </label>                                    
                                                    <input type="text" id="industry<?php echo $i;?>" <?php echo $visible; ?> name="salesdetails[<?php echo $i;?>][industry]" class="form-control" value="<?php echo ($svalue->industry) ? $svalue->industry : ""; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Products </label>
                                                    <?php if ($svalue->product_category_id == 0 ) { ?>
                                                        <a href="javascript:void(0);" style="float: right;" class="selectpn<?php echo $i; ?>" onclick="showprouctdropdown('<?php echo $i; ?>');">Select Name</a>
                                                    <?php } else { ?>
                                                        <a href="javascript:void(0);" style="float: right;" class="enterpn<?php echo $i; ?>" onclick="showproductinput('<?php echo $i; ?>');">Enter Name</a>
                                                    <?php } ?>    
                                                    <div class="product_<?php echo $i; ?>">
                                                        <?php if ($svalue->product_category_id == 0 ) { ?>
                                                            <input type="text" class="form-control" <?php echo $visible; ?> id="product_name<?php echo $i; ?>" name="salesdetails[<?php echo $i; ?>][product_name]" value="<?php echo $svalue->product_name; ?>">
                                                        <?php }else{?>
                                                        <select class="form-control selectpicker" required="" id="products<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][product_category_id]">
                                                          <option value="" disabled selected >--Select One-</option>
                                                          <?php
                                                            if ($sales_product){
                                                                foreach ($sales_product as $value) { ?>
                                                                    <option value="<?php echo $value->id; ?>" <?php echo ($value->id == $svalue->product_category_id) ? "selected":""; ?>><?php echo cc($value->product_name); ?></option>
                                                            <?php   }
                                                                }
                                                              ?>
                                                        </select>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Email</label>                                    
                                                     <input type="email" id="email<?php echo $i;?>" <?php echo $visible; ?> name="salesdetails[<?php echo $i;?>][email]" class="form-control" value="<?php echo ($svalue->email_id) ? $svalue->email_id : ""; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Address</label>             
                                                    <textarea id="address<?php echo $i;?>" class="form-control" <?php echo $visible; ?> name="salesdetails[<?php echo $i;?>][address]"><?php echo ($svalue->address) ? $svalue->address : ""; ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="remark" class="control-label">Remarks</label>
                                                    <textarea id="remark<?php echo $i;?>" class="form-control" <?php echo $visible; ?> name="salesdetails[<?php echo $i;?>][remark]"><?php echo ($svalue->remark) ? $svalue->remark : ""; ?></textarea>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label"> File Upload </label>
                                                     <br>                                 
                                                    <input type="file" id="file" class="form-control" name="file_<?php echo $i;?>" value="<?php echo $svalue->upload_file; ?>">
                                                </div>
                                            </div>
                                            <button style="float: right;" onclick="removeprocomp('<?php echo $i;?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>
                            <?php $i++;} } else { ?>
                                <h2 class="salesitems<?php echo $i;?>">Sales Details</h2>
                                <div id="form_data_<?php echo $i;?>">  
                                    <fieldset class="scheduler-border">
                                        <br>    
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Client Name </label>
                                                        <a href="javascript:void(0);" style="float: right;" class="enter<?php echo $i; ?>" onclick="enablename('<?php echo $i; ?>');">Enter Name</a>
                                                        <a href="javascript:void(0);" style="float: right; display:none;" class="select<?php echo $i; ?>" onclick="enableselectname('<?php echo $i; ?>');">Select Name</a>
                                                        <div class="client_<?php echo $i; ?>">
                                                            <select class="form-control selectpicker client_id<?php echo $i; ?>" required="" val="<?php echo $i;?>" onchange="getclientdetails('<?php echo $i; ?>')" id="client_id<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][client_id]">
                                                              <option value="" disabled selected >--Select One-</option>
                                                              <?php
                                                                if ($client_list){
                                                                    foreach ($client_list as $value) { ?>
                                                                        <option value="<?php echo $value->userid; ?>"><?php echo cc($value->client_branch_name); ?></option>
                                                            <?php   }
                                                                }
                                                              ?>
                                                            </select>
                                                        </div>
                                                        
                                                </div> 
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Contact Person </label>                                    
                                                     <input type="text" id="contact_parson<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][contact_parson]" class="form-control" value="">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Contact Number </label>                                    
                                                     <input type="text" id="contact_number<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][contact_number]" class="form-control" value="">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Industry </label>                                    
                                                    <input type="text" id="industry<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][industry]" class="form-control" value="">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Products </label>
                                                    <a href="javascript:void(0);" style="float: right;" class="enterpn<?php echo $i; ?>" onclick="showproductinput('<?php echo $i; ?>');">Enter Name</a>
                                                        <a href="javascript:void(0);" style="float: right; display:none;" class="selectpn<?php echo $i; ?>" onclick="showprouctdropdown('<?php echo $i; ?>');">Select Name</a>
                                                    <div class="product_<?php echo $i; ?>">
                                                        <select class="form-control selectpicker" required="" id="products<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][product_category_id]">
                                                          <option value="" disabled selected >--Select One-</option>
                                                          <?php
                                                            if ($sales_product){
                                                                foreach ($sales_product as $value) { ?>
                                                                    <option value="<?php echo $value->id; ?>"><?php echo cc($value->product_name); ?></option>
                                                            <?php   }
                                                                }
                                                              ?>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                        <label class="control-label">Email</label>                                    
                                                         <input type="email" id="email<?php echo $i;?>" name="salesdetails[<?php echo $i;?>][email]" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="control-label">Address</label>             
                                                        <textarea id="address<?php echo $i;?>" class="form-control" name="salesdetails[<?php echo $i;?>][address]"></textarea>
                                                    </div>
                                                <div class="form-group col-md-3">
                                                    <label for="remark" class="control-label">Remarks</label>
                                                    <textarea id="remark<?php echo $i;?>" class="form-control" name="salesdetails[<?php echo $i;?>][remark]"></textarea>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label"> File Upload </label>                                    
                                                    <input type="file" id="file" class="form-control" name="file_<?php echo $i;?>">
                                                </div>
                                            </div>
                                    </fieldset>
                                </div>
                            <?php } ?> 
                        </div>
                        
                        <?php if ($section != "view") { ?>
                            <br>
                            <button style="float: right;" class="btn btn-info addmorepro" value="<?php echo $i; ?>" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" type="submit"><?php echo $btn_title; ?></button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(document).ready(function() {
        var $demoAccordion = $("#demoAccordion"); 
        $demoAccordion.accordion();
        $('.addmorepro').click( function() {
            var addmore = parseInt($(this).attr('value'));
            var newaddmore = addmore + 1;
            $(this).attr('value', newaddmore);
            var newAccordion = '<h2 class="salesitems'+newaddmore+'">Sales Details</h2><div id="form_data_'+newaddmore+'"> <fieldset class="scheduler-border"><div id="cat_data_'+newaddmore+'"><br><div class="row"><div class="form-group col-md-3"><label class="control-label">Client Name </label><a href="javascript:void(0);" style="float: right;" class="enter'+newaddmore+'" onclick="enablename('+newaddmore+');">Enter Name<a><a href="javascript:void(0);" style="float: right; display:none;" class="select'+newaddmore+'" onclick="enableselectname('+newaddmore+');">Select Name<a><div class="client_'+newaddmore+'"><select required="" class="form-control selectpicker client_id'+newaddmore+'" val="'+newaddmore+'" onchange="getclientdetails('+newaddmore+')" id="client_id'+newaddmore+'" name="salesdetails['+newaddmore+'][client_id]"><option value="" disabled selected >--Select One-</option><?php if ($client_list){
            foreach ($client_list as $value) { ?><option value="<?php echo $value->userid; ?>"><?php echo cc($value->client_branch_name); ?></option><?php   }} ?></select></div></div><div class="form-group col-md-2"><label class="control-label">Contact Person </label><input type="text" id="contact_parson'+newaddmore+'" name="salesdetails['+newaddmore+'][contact_parson]" class="form-control" value=""></div><div class="form-group col-md-2"><label class="control-label">Contact Number </label><input type="text" id="contact_number'+newaddmore+'" name="salesdetails['+newaddmore+'][contact_number]" class="form-control" value=""></div><div class="form-group col-md-2"><label class="control-label">Industry </label><input type="text" id="industry'+newaddmore+'" name="salesdetails['+newaddmore+'][industry]" class="form-control" value=""></div><div class="form-group col-md-3"><label class="control-label">Products </label><a href="javascript:void(0);" style="float: right;" class="enterpn'+newaddmore+'" onclick="showproductinput('+newaddmore+');">Enter Name</a><a href="javascript:void(0);" style="float: right; display:none;" class="selectpn'+newaddmore+'" onclick="showprouctdropdown('+newaddmore+');">Select Name<a><div class="product_'+newaddmore+'"><select class="form-control selectpicker client_name" required="" id="products'+newaddmore+'" name="salesdetails['+newaddmore+'][product_category_id]"><option value="" disabled selected >--Select One-</option><?php if ($sales_product){foreach ($sales_product as $value) { ?><option value="<?php echo $value->id; ?>"><?php echo cc($value->product_name); ?></option><?php }} ?></select></div></div></div> </div><div class="row"><div class="form-group col-md-3"><label class="control-label">Email</label> <input type="email" id="email'+newaddmore+'" name="salesdetails['+newaddmore+'][email]" class="form-control" value=""></div><div class="form-group col-md-3"><label class="control-label">Address</label> <textarea id="address'+newaddmore+'" class="form-control" name="salesdetails['+newaddmore+'][address]"></textarea></div><div class="form-group col-md-3"><label for="remark" class="control-label">Remarks</label><textarea id="remark'+newaddmore+'" class="form-control" name="salesdetails['+newaddmore+'][remark]"></textarea></div><div class="form-group col-md-3"><label class="control-label"> File Upload </label> <input type="file" id="file" class="form-control" name="file_'+newaddmore+'"></div></div><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">Remove</button></fieldset> </div>';
            $demoAccordion.append(newAccordion).accordion("refresh");        
            $('.selectpicker').selectpicker('refresh');
            $('.salesitems'+newaddmore).click();
        });

    });
</script>
<script type="text/javascript">
     $('.date').datepicker();

    function removeprocomp(procompid)
    {
        var id = procompid - 1;
        $('.salesitems' + procompid).remove();
        $('#form_data_' + procompid).remove();
        $('.salesitems'+id).click();
    }

    function getclientdetails(id){
        var client_id = $("#client_id"+id).val();
        $.get("<?php echo admin_url('staffSalesReport/getclientdetails/');?>"+client_id, function(data){
            var res = JSON.parse(data);
            $("#email"+id).val(res.email_id);
            $("#address"+id).val(res.address);
        });
    }

    function enablename(id){
        $(".client_"+id).html('<input type="text" class="form-control" id="client_name'+id+'" name="salesdetails['+id+'][client_name]" value="">');
        $(".select"+id).show();
        $(".enter"+id).hide();
    }

    function enableselectname(id){
        $(".select"+id).hide();
        $(".enter"+id).show();
        $(".client_"+id).html('<select class="form-control selectpicker client_id'+id+'" val="'+id+'" required="" onchange="getclientdetails('+id+')" id="client_id'+id+'" name="salesdetails['+id+'][client_id]"><option value="" disabled selected >--Select One-</option><?php if ($client_list){
            foreach ($client_list as $value) { ?><option value="<?php echo $value->userid; ?>"><?php echo cc($value->client_branch_name); ?></option><?php   }} ?></select>');
        $('.selectpicker').selectpicker('refresh');
    }

    function showproductinput(id){
        $(".product_"+id).html('<input type="text" class="form-control" id="product_name'+id+'" name="salesdetails['+id+'][product_name]" value="">');
        $(".selectpn"+id).show();
        $(".enterpn"+id).hide();
    }

    function showprouctdropdown(id){
        $(".selectpn"+id).hide();
        $(".enterpn"+id).show();
        $(".product_"+id).html('<select class="form-control selectpicker" required="" id="products'+id+'" name="salesdetails['+id+'][product_category_id]"><option value="" disabled selected >--Select One-</option><?php if ($sales_product){ foreach ($sales_product as $value) { ?><option value="<?php echo $value->id; ?>"><?php echo cc($value->product_name); ?></option> <?php   } }?></select>');
        $('.selectpicker').selectpicker('refresh');
    }
</script>

</body>
</html>