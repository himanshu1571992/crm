<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php
                            if(check_permission_page(81,'create') ){
                            ?>
                            <a href="<?php echo admin_url('site_manager/site_manager'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_site_manager'); ?>
                            </a>
                            <?php
                            }
                            ?>
                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo admin_url('site_manager/export'); ?>" type="submit" class="btn btn-info">Export</a>
                        </div>
                        <div class="clearfix"></div>

                        <div class="clearfix mtop20"></div>
                        <?php
                        $table_data = array();
                        $_table_data = array(
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="clients"><label></label></div>',
                            '#',
                            'Added By',
                            _l('site_name'),
                            _l('site_id'),
                            _l('site_location'),
                            _l('site_status'),
                            _l('site_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('site_manager', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('site_manager_table_columns', $table_data);

                        render_datatable($table_data, 'site_manager', [], [
                            'data-last-order-identifier' => 'site_manager',
                            'data-default-order' => get_table_last_order('site_manager'),
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
        initDataTable('.table-site_manager', admin_url + 'site_manager/table',<?php echo do_action('site_manager_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>
</body>
</html>
