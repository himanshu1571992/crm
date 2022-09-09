<?php /*init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                      <div class="_buttons">
                        <a href="<?php echo admin_url('expenses/add_category'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('new_expense_category'); ?></a>
                    </div>
                    <div class="clearfix"></div>
                    <hr class="hr-panel-heading" />
                    <div class="clearfix"></div>
                    <?php render_datatable(array(_l('name'),_l('color'),_l('dt_expense_description'),_l('options')),'expenses-categories'); ?>
					  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('admin/expenses/expense_category'); ?>
<?php init_tail(); ?>
<script>
    $(function(){
        initDataTable('.table-expenses-categories', window.location.href, [2], [2]);
    });
</script>
</body>
</html>
*/
?>


<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php
                            if(check_permission_page(59,'create')){
                            ?>
                            <a href="<?php echo admin_url('leaves/leave'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo 'New Leave Apply'; ?>
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
                            'ID',
                            'Category',
                            'From Date',
                            'To Date',
                            'Total Day',
                            'Reason',
                            'Status'
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
        initDataTable('.table-units', admin_url + 'leaves/table',<?php echo do_action('units_table_default_order', json_encode(array(7, 'DESC'))); ?>);
    });
</script>
</body>
</html>


