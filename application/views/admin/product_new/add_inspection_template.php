<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo site_url($this->uri->uri_string()); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label">Template Name <span style="color:red;">*</span></label>
                                    <input type="text" id="template_name" name="template_name" class="form-control" required="" value="<?php echo (isset($template_data) && $template_data->template_name != "") ? $template_data->template_name : "" ?>">
                                </div>
                            </div>
                            <?php
                                $inspectiondata = array();
                                if (!empty($template_data)){
                                   $inspectiondata = json_decode($template_data->data);
                                }         
                            ?>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="productparameterTable">
                                    <thead>
                                        <tr>
                                            <th width="5%"  align="center">#</th> 
                                            <th width="20%" align="left">Parameter to be chacked</th>
                                            <th align="left">Tolerance (-)</th>
                                            <th align="left">Tolerance (+)</th>
                                            <th align="left">Measuring Instrument</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable ">
                                        <?php
                                            $i = 1;
                                            if (!empty($inspectiondata)){
                                                foreach ($inspectiondata as $key => $value) {
                                        ?>
                                            <tr class="tr<?php echo $i; ?>">
                                                <td><button type="button" class="btn pull-right btn-danger " onclick="removeparameters('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button></td>
                                                <td><textarea name="template_data[<?php echo $i; ?>][parameter]" id="parameter<?php echo $i; ?>" class="form-control" required><?php echo $value->parameter; ?></textarea></td>
                                                <td><input type="number" min='0' step="any" class="form-control inspectionless" name="template_data[<?php echo $i; ?>][tolerance_less]" value="<?php echo $value->tolerance_less; ?>" id="tolerance_less<?php echo $i; ?>" class="form-control" required></td>
                                                <td><input type="number" min='0' step="any" class="form-control inspectionplus" name="template_data[<?php echo $i; ?>][tolerance_add]" value="<?php echo $value->tolerance_add; ?>" id="tolerance_add<?php echo $i; ?>" class="form-control" required></td>
                                                <td><textarea class="form-control" name="template_data[<?php echo $i; ?>][measuring_instrument]" id="measuring_instrument<?php echo $i; ?>" class="form-control" required><?php echo $value->measuring_instrument; ?></textarea></td>
                                            </tr>
                                        <?php 
                                            $i++;
                                        }
                                        }else{ ?>
                                            <tr class="tr<?php echo $i; ?>">
                                                <td></td>
                                                <td><textarea name="template_data[<?php echo $i; ?>][parameter]" id="parameter<?php echo $i; ?>" class="form-control" required></textarea></td>
                                                <td><input type="number" min='0' step="any" class="form-control inspectionless" name="template_data[<?php echo $i; ?>][tolerance_less]" id="tolerance_less<?php echo $i; ?>" class="form-control" required></td>
                                                <td><input type="number" min='0' step="any" class="form-control inspectionplus" name="template_data[<?php echo $i; ?>][tolerance_add]" id="tolerance_add<?php echo $i; ?>" class="form-control" required></td>
                                                <td><textarea class="form-control" name="template_data[<?php echo $i; ?>][measuring_instrument]" id="measuring_instrument<?php echo $i; ?>" class="form-control" required></textarea></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php echo $i; ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            </form>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });

    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#productparameterTable tbody').append('<tr id="tr' + newaddmore + '"><td><button type="button" class="btn pull-right btn-danger " onclick="removeparameters('+ newaddmore +');"><i class="fa fa-remove"></i></button></td><td><textarea name="template_data['+newaddmore+'][parameter]" id="parameter'+ newaddmore +'" class="form-control" required></textarea></td><td><input type="number" min="0" step="any" class="form-control inspectionless" name="template_data['+newaddmore+'][tolerance_less]" id="tolerance_less'+ newaddmore +'" class="form-control" required></td><td><input type="number" min="0"  step="any" class="form-control inspectionplus" name="template_data['+newaddmore+'][tolerance_add]" id="tolerance_add'+ newaddmore +'" class="form-control" required></td><td><textarea name="template_data['+newaddmore+'][measuring_instrument]" id="measuring_instrument'+ newaddmore +'" class="form-control" required></textarea></td></tr>');
	});

    function removeparameters(procompid)
    {
        $('#tr' + procompid).remove();
    }
</script>
</body>
</html>
