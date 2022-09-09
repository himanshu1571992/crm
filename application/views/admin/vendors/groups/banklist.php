   
 <div class="">
        <div class="">
            <div class="col-md-12">

                <div>
                    <div >
                        <div class="_buttons">
                            <a href="<?php echo admin_url('vendors/vendor/'.$this->uri->segment(4).'?group=bankdetails'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_bank'); ?>
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
                            _l('bank_name'),
                            _l('bank_branch'),
                            _l('bank_mail'),
                            _l('bank_phone'),
                            _l('bank_created_date')
                            
                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('bank', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('bank_table_columns', $table_data);
						
                        render_datatable($table_data, 'bank', [], [
                            'data-last-order-identifier' => 'bank',
                            'data-default-order' => get_table_last_order('bank'),
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
        initDataTable('.table-bank', admin_url + 'vendors/banktable/<?php echo $this->uri->segment(4);?>',<?php echo do_action('bank_table_default_order', json_encode(array(5, 'DESC'))); ?>);
    });
</script>