<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


<style type="text/css">
    .popover{
        max-width:600px;
    }
    .btn-hold{
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-hold:hover {
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-brown{
        background-color: brown;
        color: #fff;
    }
    .btn-brown:hover {
        background-color: brown;
        color: #fff;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('complains'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4>
                                <?php if(check_permission_page(341,'create')){ ?>
                                <a href="<?php echo admin_url('complains/add'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add New Complains</a>
                                <?php } ?>
                            </div>
                            </div>	                   

                            <hr class="hr-panel-heading">

                            <div class="row">

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">Status</label>
                                    <select class="form-control selectpicker" id="approve_status" name="approve_status">
                                        <option value="" disabled selected >--Select One-</option>
                                        <option value="0"<?php echo (isset($approve_status) && $approve_status == 0) ? 'selected' : "" ?>>Pending</option>
                                        <option value="1"<?php echo (isset($approve_status) && $approve_status == 1) ? 'selected' : "" ?>>Approved</option>
                                        <option value="2"<?php echo (isset($approve_status) && $approve_status == 2) ? 'selected' : "" ?>>Rejected</option>
                                        <option value="4"<?php echo (isset($approve_status) && $approve_status == 4) ? 'selected' : "" ?>>Reconciliation</option>
                                        <option value="5"<?php echo (isset($approve_status) && $approve_status == 5) ? 'selected' : "" ?>>On Hold</option>
                                   </select>
                                </div>

                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>


                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Complain ID</th>
                                                <th>Complain Date</th>
                                                <th>Resolve Till</th>
                                                <th>Customer Name</th>
                                                <th>Complain Type</th>
                                                <th>Complain Status</th>
                                                <th>Status</th>
                                                <th width="15%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($complains_list)) {
                                                foreach ($complains_list as $k => $row) {
                                                    $client_info = $this->db->query("SELECT `company` FROM tblclients WHERE userid ='".$row->client_id."'")->row();
                                                    
                                                    if ($row->approve_status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning btn-xs';
                                                    } elseif ($row->approve_status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success btn-xs';
                                                    } elseif ($row->approve_status == 2) {
                                                        $status = 'Rejected';
                                                        $cls = 'btn-danger btn-xs';
                                                    }elseif ($row->approve_status == 4) {
                                                        $status = 'Reconciliation';
                                                        $cls = 'btn-brown btn-xs';
                                                    }elseif ($row->approve_status == 5) {
                                                        $status = 'On Hold';
                                                        $cls = 'btn-hold btn-xs';
                                                    }
                                                    if ($row->status == 1) {
                                                        $cstatus = 'Running';
                                                        $ccls = 'btn-info btn-xs';
                                                    } elseif ($row->status == 2) {
                                                        $cstatus = 'Closed';
                                                        $ccls = 'btn-success btn-xs';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$k; ?></td>
                                                        <td>
                                                            <?php echo "Comp-".$row->id; ?>
                                                            <?php echo get_creator_info($row->staff_id, $row->created_on); ?>
                                                        </td>
                                                        <td><?php echo _d($row->complain_date); ?></td>
                                                        <td><?php echo (!empty($row->resolve_till)) ? _d($row->resolve_till) : 'N/a'; ?></td>
                                                        <td><?php echo $client_info->company; ?></td>
                                                        <td><?php echo value_by_id("tblcomplainstypes", $row->complain_type_id, "title"); ?></td>
                                                        <td><?php echo '<button type="button" class="btn ' . $ccls . ' btn-sm">' . $cstatus . '</button>'; ?></td>
                                                        <td><?php echo '<button type="button" class="btn ' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group"> 
                                                                <?php if ($row->approve_status != 1){ ?>
                                                                    <?php if(check_permission_page(341,'edit')){ ?>
                                                                <a href="<?php echo admin_url('complains/add/' . $row->id); ?>" class="btn-sm btn-primary" title="Edit Complains Details"><i class="fa fa-edit"></i></a>
                                                                <?php } 
                                                                if(check_permission_page(341,'delete')){ ?>
                                                                <a href="<?php echo admin_url('complains/delete/' . $row->id); ?>" class="btn-sm btn-danger _delete" title="Delete Complains Details"><i class="fa fa-trash"></i></a>
                                                                <?php } } ?>
                                                                <a href="<?php echo admin_url('complains/view/' . $row->id); ?>" class="btn-sm btn-primary" target="_blank" title="View Complains Details"><i class="fa fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>    
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>



                            </div>





                            <div class="btn-bottom-toolbar text-right">

                            </div>

                            <!-- Tracks used in this music/audio player application are free to use. I downloaded them from Soundcloud and NCS websites. I am not the owner of these tracks. -->



                        </div>

                    </div>
                </div>

            </form>
        </div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Complains Approval Status</h4>
            </div>
            <div class="modal-body" id="approval_html">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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

                                            $(document).ready(function () {
                                                $('#newtable').DataTable({
                                                });
                                            });
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script> 

<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {
        if (!$("input[name='staffid[]']").is(":checked")) {
            alert('Please Check Any Checkbox First!');
            return false;
        } else {
            $("#salary_form").submit();
        }



    });
</script> 
<script type="text/javascript">
    $('.status').click(function(){
        var id = $(this).val();  
        $.ajax({
                type    : "POST",
                url     : "<?php echo base_url('admin/complains/get_status'); ?>",
                data    : {'id' : id},
                success : function(response){
                        if(response != ''){
                                $("#approval_html").html(response);
                        }
                }
        })
    });
</script>

</body>
</html>
