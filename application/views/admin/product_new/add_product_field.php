<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo admin_url('product_new/add_product_field'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="field_id" class="control-label">Main ID *</label>
                                    <input type="text" id="field_id" name="field_id" class="form-control" required="" value="">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="field_value" class="control-label">Field Value *</label>
                                    <input type="text" id="field_value" name="field_value" class="form-control" required="" value="">
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
</script>





</body>
</html>
