<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php if(check_permission_page(21,'create') ){ ?>
                            <a href="<?php echo admin_url('defaultsetting/default_setting'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_default_setting'); ?>
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
                            '#',
                            _l('default_setting_category_name'),                            
                            _l('default_setting_status'),                            
                            _l('default_setting_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('defaultsetting', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('defaultsetting_table_columns', $table_data);

                        render_datatable($table_data, 'defaultsetting', [], [
                            'data-last-order-identifier' => 'defaultsetting',
                            'data-default-order' => get_table_last_order('defaultsetting'),
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
        initDataTable('.table-defaultsetting', admin_url + 'defaultsetting/table',<?php echo do_action('defaultsetting_table_default_order', json_encode(array(3, 'DESC'))); ?>);
    });
</script>
</body>
</html>
