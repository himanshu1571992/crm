<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4><a target="_blank" href="<?php echo admin_url('product_new/inspection_template'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Inspection Templates</a></div>
                                <div class="col-md-12">
                                    <hr>
                                    <h4 class="text-center" style="color:#53bfee;"><u>INSPECTION STANDARD PARAMETERS</u></h4>
                                    <h4 class="text-center" style="color:red;"><u><?php echo cc(value_by_id('tblproducts', $product_id, 'name')); ?></u></h4>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <label class="form-check-label">Inspection Required</label>
                                            <input class="form-check-input" type="checkbox" id="inspection_required" name="inspection_required" value="<?php echo (!empty($inspection_data)) ? '1':'0'; ?>" <?php echo (!empty($inspection_data)) ? 'checked':''; ?>>
                                        </div> 
                                    </div>
                                    <div class="col-md-6 template_div" <?php echo (!empty($inspection_data)) ? '':'style="display: none;"'; ?>>
                                        <div class="form-check">
                                            <label class="form-check-label">Inspection Templates</label>
                                            <select class="form-control selectpicker" onchange="get_template_data(this.value)" data-live-search="true" id="template_id" name="template_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($inspection_template_list) && count($inspection_template_list) > 0) {
                                                    foreach ($inspection_template_list as $key => $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php echo (isset($product['template_id']) && $product['template_id'] == $value->id) ? 'selected' : "" ?>><?php echo cc($value->template_name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                    </div>
                                    
                                </div>
                                <div class="col-md-12 inspectionproduct_div" <?php echo (!empty($inspection_data)) ? '':'style="display: none;"'; ?> >
                                    <br>
                                    <br>
                                    <div class="table-responsive s_table">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="productparameterTable">
                                            <thead>
                                                <tr>
                                                    <th width="5%"  align="center">#</th> 
                                                    <th width="20%" align="left">Parameter to be chacked</th>
                                                    <th align="left">Specification</th>
                                                    <th align="left">Tolerance (-)</th>
                                                    <th align="left">Tolerance (+)</th>
                                                    <th align="left">Tolerance Min</th>
                                                    <th align="left">Tolerance Max</th>
                                                    <th align="left">Measuring Instrument</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ui-sortable pro_inspection_div">
                                                <?php
                                                    $i = 1;
                                                    $template_id = 0;
                                                    if (!empty($inspection_data)){
                                                        foreach ($inspection_data as $key => $value) {
                                                            $template_id = $value->template_id;
                                                ?>
                                                    <tr class="tr<?php echo $i; ?>">
                                                        <td><button type="button" class="btn pull-right btn-danger " onclick="removeparameters('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button></td>
                                                        <td><textarea name="inspectiondata[<?php echo $i; ?>][parameter]" id="parameter<?php echo $i; ?>" class="form-control" required><?php echo $value->parameter; ?></textarea></td>
                                                        <td><input type="text" name="inspectiondata[<?php echo $i; ?>][specification]" onkeyup="parametercalculation('<?php echo $i; ?>');" id="specification<?php echo $i; ?>" class="form-control" value="<?php echo $value->specification; ?>" required></td>
                                                        <td><input type="number" min='0' step="any" onkeyup="parametercalculation('<?php echo $i; ?>');" class="form-control inspectionless" name="inspectiondata[<?php echo $i; ?>][tolerance_less]" value="<?php echo $value->tolerance_less; ?>" id="tolerance_less<?php echo $i; ?>" class="form-control" required></td>
                                                        <td><input type="number" min='0' step="any" onkeyup="parametercalculation('<?php echo $i; ?>');" class="form-control inspectionplus" name="inspectiondata[<?php echo $i; ?>][tolerance_add]" value="<?php echo $value->tolerance_add; ?>" id="tolerance_add<?php echo $i; ?>" class="form-control" required></td>
                                                        <td><input type="number" min='0' step="any" class="form-control" name="inspectiondata[<?php echo $i; ?>][tolerance_min]" id="tolerance_min<?php echo $i; ?>" class="form-control" value="<?php echo $value->tolerance_min; ?>" readonly></td>
                                                        <td><input type="number" min='0' step="any" class="form-control" name="inspectiondata[<?php echo $i; ?>][tolerance_max]" id="tolerance_max<?php echo $i; ?>" class="form-control" value="<?php echo $value->tolerance_max; ?>" readonly></td>
                                                        <td><textarea class="form-control" name="inspectiondata[<?php echo $i; ?>][measuring_instrument]" id="measuring_instrument<?php echo $i; ?>" class="form-control" required><?php echo $value->measuring_instrument; ?></textarea></td>
                                                    </tr>
                                                    <?php 
                                                        $i++;
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                        <div class="col-xs-12">
                                            <label class="label-control subHeads"><a  class="addmore" value="<?php echo $i; ?>">Add More <i class="fa fa-plus"></i></a></label>
                                        </div>
                                    </div>
                                               
                                </div>
                                <div class="col-md-12">
                                    <div class="btn-bottom-toolbar text-right">
                                        <button class="btn btn-info" type="submit">
                                            <?php echo _l('submit'); ?>
                                        </button>
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
    init_selectpicker();

    var templete_id = "<?php echo $template_id; ?>";
    if (templete_id > 0){
        $("#template_id").val(templete_id);
        $('.selectpicker').selectpicker('refresh');
    }
    

    $("#inspection_required").on("click", function(){
        $(".template_div").hide();
        $(this).val('0');
        if ($(this).is(":checked")){
            $(".template_div").show();
            $(this).val('1');
        }
    });

    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#productparameterTable tbody').append('<tr id="tr' + newaddmore + '"><td><button type="button" class="btn pull-right btn-danger " onclick="removeparameters('+ newaddmore +');"><i class="fa fa-remove"></i></button></td><td><textarea name="inspectiondata['+newaddmore+'][parameter]" id="parameter'+ newaddmore +'" class="form-control" required></textarea></td><td><input type="text" name="inspectiondata['+newaddmore+'][specification]" onkeyup="parametercalculation('+newaddmore+');" id="specification'+ newaddmore +'" class="form-control" required></td><td><input type="number" min="0" step="any" class="form-control inspectionless" onkeyup="parametercalculation('+newaddmore+');" name="inspectiondata['+newaddmore+'][tolerance_less]" id="tolerance_less'+ newaddmore +'" class="form-control" required></td><td><input type="number" min="0"  step="any" onkeyup="parametercalculation('+newaddmore+');" class="form-control inspectionplus" name="inspectiondata['+newaddmore+'][tolerance_add]" id="tolerance_add'+ newaddmore +'" class="form-control" required></td><td><input type="number" min="0" step="any" name="inspectiondata['+newaddmore+'][tolerance_min]" id="tolerance_min'+ newaddmore +'" class="form-control" readonly></td><td><input type="number" min="0" step="any" name="inspectiondata['+newaddmore+'][tolerance_max]" id="tolerance_max'+ newaddmore +'" class="form-control" readonly></td><td><textarea name="inspectiondata['+newaddmore+'][measuring_instrument]" id="measuring_instrument'+ newaddmore +'" class="form-control" required></textarea></td></tr>');
	});

    function removeparameters(procompid)
    {
        $('.tr' + procompid).remove();
    }

    function parametercalculation(rowid){
        var specification = $("#specification"+rowid).val();
        var tolerance_less = $("#tolerance_less"+rowid).val();
        var tolerance_add = $("#tolerance_add"+rowid).val();
        if (specification != ''){
            var tolerance_min = specification;
            var tolerance_max = specification;
            if ($.isNumeric(tolerance_less)){
                var tolerance_min = parseFloat(specification)-parseFloat(tolerance_less);
            }
            if ($.isNumeric(tolerance_add)){
                var tolerance_max = parseFloat(specification)+parseFloat(tolerance_add);
            }
            $("#tolerance_min"+rowid).val(tolerance_min);
            $("#tolerance_max"+rowid).val(tolerance_max);
        }
    }

    function get_template_data(template_id){
        $(".inspectionproduct_div").hide();
        $.ajax({
            type    : "GET",
            url     : "<?php echo base_url(); ?>admin/product_new/get_template_data/"+template_id,
            success : function(response){
                if (response != ''){
                    $(".inspectionproduct_div").show();
                    $(".pro_inspection_div").html(response);
                    var rowCount = $('#productparameterTable tr').length;
                    $('.addmore').attr('value', rowCount);
                }
            }
        });
    }
</script>
</body>
</html>    