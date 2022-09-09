<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('component/component'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_component'); ?>
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
                            _l('component_name'),
                            _l('component_id'),
                            _l('component_unit'),
                            _l('component_hsn_code'),
                            _l('component_sac_code'),
                            _l('component_image'),
                            _l('component_status'),
                            _l('component_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('component', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('component_table_columns', $table_data);

                        render_datatable($table_data, 'component', [], [
                            'data-last-order-identifier' => 'component',
                            'data-default-order' => get_table_last_order('component'),
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
        initDataTable('.table-component', admin_url + 'component/table',<?php echo do_action('component_table_default_order', json_encode(array(8, 'DESC'))); ?>);
    });
</script>
</body>
</html>
