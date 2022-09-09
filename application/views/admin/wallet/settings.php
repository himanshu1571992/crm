<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
							
                                <div class="form-group">
                                    <label for="from" class="control-label">Form Day *</label>
                                    <input type="text" id="from" placeholder="Form Day" name="from" class="form-control" required="" value="<?php echo $from; ?>">
                                </div>

                            </div>
							
							<div class="col-md-6">
							
                                <div class="form-group">
                                    <label for="to" class="control-label">To Day *</label>
                                    <input type="text" id="to" placeholder="To Day" name="to" class="form-control" required="" value="<?php echo $to; ?>">
                                </div>

                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
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
