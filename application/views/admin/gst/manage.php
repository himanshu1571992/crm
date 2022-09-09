<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('gst/gst'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_gst'); ?>
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
                            _l('gst_igst') . " (%)",
                            _l('gst_cgst') . " (%)",
                            _l('gst_sgst') . " (%)",
                            _l('gst_status'),
                            _l('gst_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('gst', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('gst_table_columns', $table_data);

                        render_datatable($table_data, 'gst', [], [
                            'data-last-order-identifier' => 'gst',
                            'data-default-order' => get_table_last_order('gst'),
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
        initDataTable('.table-gst', admin_url + 'gst/table',<?php echo do_action('gst_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>
</body>
</html>
