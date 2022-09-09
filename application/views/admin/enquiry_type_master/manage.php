<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <?php if(check_permission_page('11,239','create') ){ ?>
                            <a href="<?php echo admin_url('enquirytype/enquirytype'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_enquiry_type'); ?>
                            </a>
                            <?php
                            }
                            ?>
                            <!-- <a href="<?php echo admin_url('enquirytype/main_lead_status'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo 'Main Lead Status'; ?>
                            </a> -->
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
                            _l('enquiry_type_name'),
                            'Category',
                            _l('enquiry_type_color'),
                            _l('enquiry_type_order'),
                            _l('enquiry_type_status'),
                            _l('enquiry_type_created_date')
                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('enquirytype', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('enquirytype_table_columns', $table_data);

                        render_datatable($table_data, 'enquirytype', [], [
                            'data-last-order-identifier' => 'enquirytype',
                            'data-default-order' => get_table_last_order('enquirytype'),
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Main Category</h4>
            </div>
            <?php echo form_open(admin_url("Enquirytype/setmaincategory"), array('id' => 'setmaincategory', 'class' => 'setmaincategory')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status" class="control-label"><?php echo 'Main Category'; ?> *</label>
                            <select class="form-control selectpicker" name="enquiry_type_main_id" required="">
                                <option value=""></option>
                                <?php
                                    if (isset($main_enquiry_type_list)){
                                        foreach ($main_enquiry_type_list as $value) {
                                ?>
                                <option value="<?php echo $value->id; ?>" <?php echo (isset($enquirytype['enquiry_type_main_id']) && $enquirytype['enquiry_type_main_id'] == $value->id) ? 'selected' : ""; ?> ><?php echo cc($value->name); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="enquiry_type_id" name="enquiry_type_id" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(function () {
        initDataTable('.table-enquirytype', admin_url + 'enquirytype/table',<?php echo do_action('enquirytype_table_default_order', json_encode(array(6, 'DESC'))); ?>);
    });
    
    $(document).on("click", ".enquirytype_cls", function(){
       var enquiry_type_id = $(this).data("id"); 
       $(".enquiry_type_id").val(enquiry_type_id);
    });
</script>
</body>
</html>
