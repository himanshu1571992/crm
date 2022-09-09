    <div class="">
        <div class="">
            <div class="col-md-12">

                <div>
                    <div >
                        <div class="_buttons">
                            <a href="<?php echo admin_url('settings?group=branch'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_company_branch'); ?>
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
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="companybranchs"><label></label></div>',
                            '#',
                            _l('company_branch_name'),
                            _l('company_branch_mail_id'),
                            _l('company_branch_cont_1'),
                            _l('company_branch_address'),
                            _l('company_branch_city')
                            
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('companybranch', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('companybranch_table_columns', $table_data);
						
                        render_datatable($table_data, 'companybranch', [], [
                            'data-last-order-identifier' => 'companybranch',
                            'data-default-order' => get_table_last_order('companybranch'),
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
        initDataTable('.table-companybranch', admin_url + 'settings/tablecompanybranch',<?php echo do_action('companybranch_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>