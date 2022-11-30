<?php init_head(); ?>
<style>
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%;
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%;
        }
    } 
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'product-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="process_cost" class="control-label">Process Cost (Per Kg)</label>
                                    <input type="text" id="process_cost" name="process_cost" class="form-control" required="" value="<?php echo (isset($cost_info->process_cost) && $cost_info->process_cost != "") ? $cost_info->process_cost : "" ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transport_cost" class="control-label">Transport cost (In Percent)</label>
                                    <input type="text" id="transport_cost" name="transport_cost" class="form-control" required="" value="<?php echo (isset($cost_info->transport_cost) && $cost_info->transport_cost != "") ? $cost_info->transport_cost : "" ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="loading_charges" class="control-label">Loading charges (Per Kg)</label>
                                    <input type="text" id="loading_charges" name="loading_charges" class="form-control" required="" value="<?php echo (isset($cost_info->loading_charges) && $cost_info->loading_charges != "") ? $cost_info->loading_charges : "" ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="over_head_profit" class="control-label">Over Head Profit (In Percent)</label>
                                    <input type="text" id="over_head_profit" name="over_head_profit" class="form-control" required="" value="<?php echo (isset($cost_info->over_head_profit) && $cost_info->over_head_profit != "") ? $cost_info->over_head_profit : "" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <input type="hidden" name="rid" value="<?php echo (isset($cost_info->id) && $cost_info->id != "") ? $cost_info->id : 0;?>">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
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


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>

</body>
</html>
