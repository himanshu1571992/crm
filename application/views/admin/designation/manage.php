<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php if(check_permission_page('126,258','create') ){ ?>
                            <a href="<?php echo admin_url('designation/designation'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_designation'); ?>
                            </a>
                            <a target="_blank" href="<?php echo admin_url('designation/designationquestion_list'); ?>" class="btn btn-info mright5 test pull-left display-block">Designation Wise Questions</a>
                            <a target="_blank" href="<?php echo admin_url('designation/designationskill_list'); ?>" class="btn btn-info mright5 test pull-left display-block">Designation Skills & Qualities</a>
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
                            _l('designation'),
                            _l('designation_color'),
                            _l('designation_order'),
                            _l('designation_status'),
                            _l('designation_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('designation', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('designation_table_columns', $table_data);

                        render_datatable($table_data, 'designation', [], [
                            'data-last-order-identifier' => 'designation',
                            'data-default-order' => get_table_last_order('designation'),
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
        initDataTable('.table-designation', admin_url + 'designation/table',<?php echo do_action('designation_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>
</body>
</html>
