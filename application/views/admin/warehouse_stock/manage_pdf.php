<?php init_head(); ?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
		<?php echo form_open($this->uri->uri_string(), array('id' => 'enquiry-form', 'class' => 'enquiry-form', 'enctype' => 'multipart/form-data')); ?>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Upload Stock PDF</h4>
			</div>
			<div class="modal-body">
			<input type="hidden" name="warehousestockid" value="<?php echo $id;?>">
				<div class="form-group">
					<label for="stockdesc" class="control-label">Description</label>
					<textarea id="stockdesc" class="form-control" name="description"></textarea>
				</div>
				<div class="form-group">
					<label for="pdf" class="control-label">PDF</label>
					<input type="file" id="pdf" name="photo">
				</div>
			</div>
			<div class="modal-footer">
			  <button type="submit" class="btn btn-info uploadpdf">Upload</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('stock_pdf_upload'); ?>
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
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="warehouses"><label></label></div>',
                            '#',
                            _l('warehouse_no'),
                            _l('added_by'),
                            _l('pdf'),
                            _l('uploaded_at')
                            
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('warehouse', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('warehouse_table_columns', $table_data);
						
                        render_datatable($table_data, 'warehouse', [], [
                            'data-last-order-identifier' => 'warehouse',
                            'data-default-order' => get_table_last_order('warehouse'),
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
        initDataTable('.table-warehouse', admin_url + 'Stock/tableuploadedstock/<?php echo $id;?>',<?php echo do_action('warehouse_table_default_order', json_encode(array(3, 'DESC'))); ?>);
    });
	
</script>
</body>
</html>
