<?php init_head(); ?>
<?php
$s_range = '';
$date_a = '';
$date_b = '';

if(!empty($range)){
  $s_range = $range;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}

?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-2">
                <div class="panel_s mbot5">
                    <div class="panel-body padding-10">
                        <h4 class="bold"><?php echo value_by_id("tblvendor", $vendor_id, "name"); ?></h4>
                    </div>
                </div>
                <?php echo vendor_report_tab('po_activity', $vendor_id); ?>
            </div>
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                        <div class="col-md-4"><h4 class="no-margin"> </h4></div>  

                        <h4 class="no-margin"><?php echo $title; ?> </h4>

                        <hr class="hr-panel-heading">

                        <div class="row">
                            <div class="col-md-12">  
                                <div class="row">

                                <?php
                                    if($activity_log){
                                        
                                        
                                        foreach ($activity_log as $po_id => $po_activity) {
//                                            echo '<pre>';
//                                        print_r($po_activity);
                                ?>           
                                            <div class="col-md-12">
                                                <h3 class='btn-sm btn-success col-md-2 text-center'> <?php echo value_by_id("tblpurchaseorder", $po_id, "number"); ?> </h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div role="tabpanel" class="tab-pane" id="lead_activity">
                                                    <div class="panel_s no-shadow">
                                                        <div class="activity-feed ex3">
                                                            
                                                            <?php
                                                            $last_id = 0;
                                                            $i = 0;
                                                            foreach ($po_activity as $key => $log) {
//                                                                if ($i == 0) {
                                                                    $last_id = $log->id;
//                                                                }
                                                                ?>
                                                                <div class="feed-item">
                                                                    <div class="date">
                                                                        <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($log->datetime); ?>">
                                                                            <?php echo time_ago($log->datetime); ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="text <?php
                                                                    if ($log->status == 2) {
                                                                        echo 'line-throught';
                                                                    }
                                                                    ?>">


                                                                        <a href="#" val="<?php echo $log->id; ?>" pri="<?php echo $log->priority; ?>" onclick="return false;" class="priority" ><i class="fa <?php echo ($log->priority == 1) ? 'fa-star' : 'fa-star-o'; ?>" aria-hidden="true"></i></a>

                                                                        <?php
                                                                        if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                                            ?>
                                                                            <a href="<?php echo admin_url('follow_up/cut_po_conversation/' . $log->id); ?>" onclick="return confirm('Are you sure you want to cut?');"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                                            <?php
                                                                        }
                                                                        ?>


                                                                        <?php
                                                                        if (is_admin() == 1) {
                                                                            ?>
                                                                            <a href="<?php echo admin_url('follow_up/delete_po_conversation/' . $log->id); ?>" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                            <?php if ($log->staffid != 0) { ?>                     
                                                                            <a href="<?php echo admin_url('profile/' . $log->staffid); ?>">
                                                                            <?php echo staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5'));
                                                                            ?>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                        echo get_employee_name($log->staffid) . ' - ';
                                                                        echo _l(str_replace("@", '<span style="color:red;">@</span>', $log->message), '', false);
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                                $i++;
                                                            }
                                                            ?>
                                                            <div id="last_div<?php echo $po_id; ?>" ></div>
                                                        </div>


                                                        <input type="hidden" value="<?php echo $po_id; ?>" class="po_id" name="po_id">
                                                        <input type="hidden" value="<?php echo $last_id; ?>" class="last_id<?php echo $po_id; ?>">
                                                        <div class="clear"></div>
                                                        <div id="userDetail"></div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="javascript:void(0);" data-po_id="<?php echo $po_id; ?>" data-last_id="<?php echo $last_id; ?>" class="btn btn-info col-md-12 load_more"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i>  Load last conversation</a>
                                            </div>
                                <?php            
                                        }
                                    }
                                ?>    

                                

                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>


<script>
$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    } );
} );
</script>
<script type="text/javascript">
    $(document).on('click', '.load_more', function () {

        var po_id = $(this).data("po_id");
        var id = $(".last_id"+po_id).val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo site_url('admin/vendor/get_last_po_conversion'); ?>",
            data: {'id': id, 'po_id': po_id},
            success: function (response) {
                if (response != '') {
                    $(".last_id"+po_id).val(response.last_id);
                    $("#last_div"+po_id).prepend(response.html);
                }
            }
        })
    });

    $(document).ready(function () {
        $('.ex3').animate({
            scrollTop: 999
        }, 1000);

        /*$(".ex3").animate({ scrollTop: 0 }, "slow");*/
    });
</script>
</body>
</html>

