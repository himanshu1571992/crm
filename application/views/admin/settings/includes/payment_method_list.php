    <div class="">
        <div class="">
            <div class="col-md-12">

                <div>
                    <div >
                        <div class="_buttons">
                            <a href="<?php echo admin_url('settings?group=payment_method'); ?>" class="btn btn-info mright5 test pull-left display-block">Payment Method
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
                            'S.No',
                            'Name',
                            'status',
                            'Action'
                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        
                        render_datatable($table_data, 'payment_method', [], [
                            'data-last-order-identifier' => 'payment_method',
                            'data-default-order' => get_table_last_order('payment_method'),
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
        initDataTable('.table-payment_method', admin_url + 'settings/tablepaymentmethod',<?php echo do_action('receipt_table_default_order', json_encode(array(3, 'DESC'))); ?>);
    });
</script>