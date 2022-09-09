    <div class="">
        <div class="">
            <div class="col-md-12">

                <div>
                    <div >
                        <div class="_buttons">
                            <a href="<?php echo admin_url('settings?group=Warehouse'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_warehouse'); ?>
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
                            _l('warehouse_name'),
                            _l('warehouse_mail_id_1'),
                            _l('warehouse_number_1'),
                            _l('warehouse_address'),
                            _l('warehouse_city')
                            
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
<?php init_tail(); ?>
<script>
    $(function () {
        initDataTable('.table-warehouse', admin_url + 'settings/table',<?php echo do_action('warehouse_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>