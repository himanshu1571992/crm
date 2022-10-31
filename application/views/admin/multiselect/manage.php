<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php if(check_permission_page(279,'create') ){ ?>
                            <a href="<?php echo admin_url('multiselect/multiselect'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_multiselect'); ?>
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
                            _l('multiselect_name'),                            
                            _l('designation_color'),                       
                            _l('designation_order'), 
							_l('designation_status'),							
                            _l('bank_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('multiselect', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('multiselect_table_columns', $table_data);

                        render_datatable($table_data, 'multiselect', [], [
                            'data-last-order-identifier' => 'multiselect',
                            'data-default-order' => get_table_last_order('multiselect'),
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
        initDataTable('.table-multiselect', admin_url + 'multiselect/table',<?php echo do_action('multiselect_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>
</body>
</html>
