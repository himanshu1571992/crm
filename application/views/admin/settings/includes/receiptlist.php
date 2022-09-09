    <div class="">
        <div class="">
            <div class="col-md-12">

                <div>
                    <div >
                        <div class="_buttons">
                            <a href="<?php echo admin_url('settings?group=receipt'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_receipt'); ?>
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
                            _l('receipt_name'),
                            _l('receipt_bank_name'),
                            _l('receipt_account_no'),
                            _l('receipt_ifsc_code')
                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
						
                        render_datatable($table_data, 'receipt', [], [
                            'data-last-order-identifier' => 'receipt',
                            'data-default-order' => get_table_last_order('receipt'),
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
        initDataTable('.table-receipt', admin_url + 'settings/tablereceipt',<?php echo do_action('receipt_table_default_order', json_encode(array(4, 'DESC'))); ?>);
    });
</script>