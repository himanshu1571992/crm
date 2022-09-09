
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('document/add'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo 'New Document'; ?>
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
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="clients"><label></label></div>',
                            '#',
                            'Title',
                            'File',
                            _l('unit_status'),
                            _l('unit_created_date')
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



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Uploaded Documents</h4>
      </div>
      <div class="modal-body" id="file_div">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php init_tail(); ?>
<script>
    $(function () {
        initDataTable('.table-units', admin_url + 'document/table',<?php echo do_action('units_table_default_order', json_encode(array(4, 'DESC'))); ?>);
    });
</script>



<script type="text/javascript">
$(document).on('click', '.get_files', function() { 

    var id = $(this).val();  
    $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/document/get_fiel_list'); ?>",
            data    : {'id' : id},
            success : function(response){
                if(response != ''){                   
                     $('#file_div').html(response);  
                }
            }
        })
}); 
</script>

</body>
</html>

