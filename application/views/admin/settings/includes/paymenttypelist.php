    <div class="">
        <div class="">
            <div class="col-md-12">

                <div>
                    <div >
                        <div class="_buttons">
                            <a href="<?php echo admin_url('settings?group=paymenttype'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo "Add Payment Type"; ?>
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
                            '#',
                            "Payment Type",
                            _l('bank_created_date')
                            
                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('payment_type', array('show_on_table' => 1));
                        
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('paymenttypes_table_columns', $table_data);
			
                        render_datatable($table_data, 'payment_type', [], [
                            'data-last-order-identifier' => 'payment_type',
                            'data-default-order' => get_table_last_order('payment_type'),
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
        initDataTable('.table-payment_type', admin_url + 'settings/tablepaymenttype',<?php echo do_action('bank_table_default_order', json_encode(array(2, 'DESC'))); ?>);
    });
</script>