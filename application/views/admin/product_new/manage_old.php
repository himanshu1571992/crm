<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('product_new/action_pending'); ?>" class="btn btn-info mright5 test pull-left display-block">Action Pending</a>
                            <?php
                            if(check_permission_page(69,'create') ){
                                ?>
                                    <a href="<?php echo admin_url('product_new/product'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                        <?php echo _l('new_product'); ?>
                                    </a>

                                    <a href="<?php echo admin_url('product_new/product_for_delete'); ?>" class="btn btn-info mright5 test pull-left display-block">Product For Deletet</a>

                                    <a href="<?php echo admin_url('product_new/product_merge'); ?>" class="btn btn-info mright5 test pull-left display-block">Merge Product</a>
                                <?php
                            }
                            /*if(check_permission_page(69,'create') ){
                                ?>
                                    <a href="<?php echo admin_url('product/export_products'); ?>" class="btn btn-info mright5 test pull-left display-block">Export Products</a>
                                    
                                <?php
                            }*/
                            ?>
                            
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
                            _l('product_name'),
                            'Main Category',
                            _l('product_id'),
                            _l('product_unit'),
                            _l('product_image'),
                            _l('product_status'),
                            'Varified',
                            _l('product_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('product', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('product_table_columns', $table_data);
                        render_datatable($table_data, 'product', [], [
                            'data-last-order-identifier' => 'product',
                            'data-default-order' => get_table_last_order('product'),
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
        initDataTable('.table-product', admin_url + 'product_new/table',<?php echo do_action('product_table_default_order', json_encode(array(8, 'DESC'))); ?>);
    });
</script>
</body>
</html>
