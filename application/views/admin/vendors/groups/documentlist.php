   
 <div class="">
        <div class="">
            <div class="col-md-12">

                <div>
                    <div >
                        <div class="_buttons">
                            <a href="<?php echo admin_url('vendors/vendor/'.$this->uri->segment(4).'?group=documents'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('add_document'); ?>
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
                            _l('vendor'),
                            _l('pan_card'),
                            _l('cancel_cheque'),
                            _l('gst_reg_doc'),
                            _l('doc_created_date')
                            
                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('document', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('document_table_columns', $table_data);
						
                        render_datatable($table_data, 'document', [], [
                            'data-last-order-identifier' => 'document',
                            'data-default-order' => get_table_last_order('document'),
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
        initDataTable('.table-document', admin_url + 'vendors/documentable/<?php echo $this->uri->segment(4);?>',<?php echo do_action('document_table_default_order', json_encode(array(4, 'DESC'))); ?>);
    });
</script>