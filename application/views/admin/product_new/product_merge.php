<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <form action="" id="product_sub_category-form" class="proposal-form" method="post" accept-charset="utf-8" onsubmit="return confirm('Are you sure you want to merge products?');">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="color" class="control-label">New Product *</label>
                                    <select class="form-control selectpicker" required data-live-search="true" id="main_product_id" name="main_product_id">

                                        <option value=""></option>

                                        <?php

                                        if (isset($products_info) && count($products_info) > 0) {

                                            foreach ($products_info as $main_product) {
                                                $product_no = "PRO - " . number_series($main_product['id']);
                                                ?>
                                                <option value="<?php echo $main_product['id'] ?>" ><?php echo cc($main_product['name'].' '.$product_no); ?></option>
                                                <?php

                                            }

                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="color" class="control-label">Old Products *</label>
                                    <select class="form-control selectpicker" required data-live-search="true" id="sub_product_id" name="sub_product_id[]" multiple="">

                                        <option value=""></option>

                                        <?php

                                        if (isset($products_info) && count($products_info) > 0) {

                                            foreach ($products_info as $sub_product) {
                                                $product_no = "PRO - " . number_series($sub_product['id']);
                                                ?>
                                                <option value="<?php echo $sub_product['id'] ?>" ><?php echo cc($sub_product['name'].' '.$product_no); ?></option>
                                                <?php

                                            }

                                        }

                                        ?>
                                    </select>
                                </div>
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
              </form>
            </div> 

           



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

