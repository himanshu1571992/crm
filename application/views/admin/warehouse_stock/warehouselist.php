<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('Stock/addstock'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_stock'); ?>
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
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="warehouses"><label></label></div>',
                            '#',
                           'Prodcut Name',
                            _l('stock_service_type'),
                            _l('stock_qty'),
                            
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('warehousestock', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('warehouse_table_columns', $table_data);
						
                        render_datatable($table_data, 'warehousestock', [], [
                            'data-last-order-identifier' => 'warehousestock',
                            'data-default-order' => get_table_last_order('warehousestock'),
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
        initDataTable('.table-warehousestock', admin_url + 'Stock/tablewarehousestock/<?php echo $_GET['id'];?>',<?php echo do_action('warehousestock_table_default_order', json_encode(array(3, 'DESC'))); ?>);
    });
</script>
</body>
</html>
