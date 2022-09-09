<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php
                            if(check_permission_page(157,'create')){
                            ?>
                            <a href="<?php echo admin_url('Stock/addstock'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_stock'); ?>
                            </a>
                            <?php
                            }
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
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="warehouses"><label></label></div>',
                            '#',
                            _l('warehouse_no'),
                            _l('warehouse_name'),
                            'Stock Type',
                            'Email ID',
                            _l('warehouse_address'),
                            'Stock Approved'
                            
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('warehouse', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('warehouse_table_columns', $table_data);
						
                        render_datatable($table_data, 'warehouse', [], [
                            'data-last-order-identifier' => 'warehouse',
                            'data-default-order' => get_table_last_order('warehouse'),
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
        initDataTable('.table-warehouse', admin_url + 'Stock/tablewarehouse',<?php echo do_action('warehouse_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>
</body>
</html>
