<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('follow_up/allot_group'); ?>" class="btn btn-info pull-left display-block">Allot Group</a>
                            <a href="<?php echo admin_url('follow_up/allot_group'); ?>" class="btn btn-info pull-right display-block">Not Allotted Clients</a>
                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="clearfix mtop20"></div>
                        <?php
                        $table_data = array();
                        $_table_data = array(
//                           
                            'S.No.',
                            'Client',
                            'Client Location',
                            'Phone No.',
                            'Email Id',
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
        initDataTable('.table-units', admin_url + 'follow_up/not_allotted_table',<?php echo do_action('units_table_default_order', json_encode(array(4, 'DESC'))); ?>);
    });
</script>
</body>
</html>


