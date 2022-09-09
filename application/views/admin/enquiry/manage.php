<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('leads/leads'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_enquiry'); ?>
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
                            _l('enquiry_id'),
                            
                            _l('client_name'),
							_l('enquiry_date'),
                            _l('enquiry_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('enquiry', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('enquiry_table_columns', $table_data);

                        render_datatable($table_data, 'enquiry', [], [
                            'data-last-order-identifier' => 'enquiry',
                            'data-default-order' => get_table_last_order('enquiry'),
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
        initDataTable('.table-enquiry', admin_url + 'enquiry/table',<?php echo do_action('enquiry_table_default_order', json_encode(array(4, 'DESC'))); ?>);
    });
</script>
</body>
</html>
