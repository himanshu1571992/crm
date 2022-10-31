
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php if(check_permission_page('129,261','create') ){ ?>
                            <a href="<?php echo admin_url('requests/add_loan_tenue'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo 'New Loan Tenure'; ?>
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
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="clients"><label></label></div>',
                            '#',
                            'Added By',
                            _l('unit_name'),
                            _l('unit_order'),
                            _l('unit_status'),
                            _l('unit_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('units', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('units_table_columns', $table_data);

                        render_datatable($table_data, 'units', [], [
                            'data-last-order-identifier' => 'units',
                            'data-default-order' => get_table_last_order('units'),
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
        initDataTable('.table-units', admin_url + 'requests/tenue_table',<?php echo do_action('units_table_default_order', json_encode(array(4, 'DESC'))); ?>);
    });
</script>
</body>
</html>


