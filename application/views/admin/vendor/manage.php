<?php init_head(); ?>
<style type="text/css">
  .card {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      padding: 15px;
      /*width: 20%;*/
      /*border-radius: 50%;*/
  }

  .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }
</style>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4>Material Vendor (SEPL/PUR/03)<?php
if (check_permission_page(91, 'create')) { ?></h4>
                                    </div>
                                    <div class="col-xs-12 col-md-6 text-right">
                                        <a href="<?php echo admin_url('vendor/vendor'); ?>" class="btn btn-info">Create Vendor</a><?php } ?>
                                </div>
                            </div>
                        <!-- <div class="_buttons">
                            <?php if(check_permission_page(91,'create') ){ ?>
                            <a href="<?php echo admin_url('vendor/vendor'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                <?php echo _l('new_vendor'); ?>
                            </a>
                            <?php
                            }
                            ?>
                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                        </div> -->
                        <div class="clearfix"></div>

                        <div class="clearfix mtop20"></div>
                        <?php
                        $table_data = array();
                        $_table_data = array(
//                            '<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="clients"><label></label></div>',
                            '#',
                            _l('vendor_name'),
                            _l('vendor_id'),
                            'Description',
                            _l('vendor_email'),
                            _l('vendor_status'),
                            "Audit Status",
                            "Vendor Created Date",

                        );

                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }

                        $custom_fields = get_custom_fields('vendor', array('show_on_table' => 1));
                        foreach ($custom_fields as $field) {
                            array_push($table_data, $field['name']);
                        }

                        $table_data = do_action('vendor_table_columns', $table_data);

                        render_datatable($table_data, 'vendor', [], [
                            'data-last-order-identifier' => 'vendor',
                            'data-default-order' => get_table_last_order('vendor'),
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="auditstatusmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">

        Material Audit
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Material Audit</h4>
            </div>
            <form  action="<?php echo admin_url('vendor/update_audit_status'); ?>"  class="audit-form" method="post" accept-charset="utf-8">
            <div class="modal-body" >
                <div class="row" id="audit_div">


                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-info" value="save">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>

    </div>
</div>
<?php init_tail(); ?>
<script>
    $(function () {
        initDataTable('.table-vendor', admin_url + 'vendor/table',<?php echo do_action('vendor_table_default_order', json_encode(array(7, 'DESC'))); ?>);
    });
    $(document).ready(function() {
        $(document).on("click", ".auditstatus", function(){
            $('#auditstatusmodel').modal('show');
            var vendor_id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('admin/vendor/update_audit_status/'); ?>"+vendor_id,
                data: {'vendor_id': vendor_id},
                success: function (response) {
                    if (response != '') {
                        $("#audit_div").html(response);
                        $('.selectpicker').selectpicker('refresh');
                    }
                }
            })
        });
    });
</script>
</body>
</html>
