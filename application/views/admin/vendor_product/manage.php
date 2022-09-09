<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('vendorproduct/product'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_vendor_product'); ?>
                            </a>
                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="clearfix mtop20"></div>
                        <?php
                        $table_data = array();
                        $_table_data = array(
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="clients"><label></label></div>',
                            '#',
                            _l('vendor_product_name'),
                            _l('vendor_product_id'),
                            _l('vendor_product_unit'),
                            _l('vendor_product_hsn_code'),
                            _l('vendor_product_sac_code'),
                            _l('vendor_product_image'),
                            _l('vendor_product_status'),
                            _l('vendor_product_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('vendorproduct', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('vendorproduct_table_columns', $table_data);
                        render_datatable($table_data, 'vendorproduct', [], [
                            'data-last-order-identifier' => 'vendorproduct',
                            'data-default-order' => get_table_last_order('vendorproduct'),
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(function () {
        initDataTable('.table-vendorproduct', admin_url + 'vendorproduct/table',<?php echo do_action('vendorproduct_table_default_order', json_encode(array(8, 'DESC'))); ?>);
    });
</script>
</body>
</html>
