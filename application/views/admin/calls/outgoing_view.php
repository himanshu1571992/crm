<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('calls/outgoingcalls'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4></div>
                            </div>	                   

                            <hr class="hr-panel-heading">

                            <div class="row">

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" required="" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" required="" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>


                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Source</th>
                                                <th>Customer Number</th>
                                                <th>Date</th>
                                                <th>Agent No.</th>
                                                <th class="text-center">Call Type</th>
                                                <th class="text-center">Recording</th>
                                                <th class="text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            if (!empty($outgoing_list)) {
                                                foreach ($outgoing_list as $k => $row) {
                                                    $chk_call = $this->db->query("SELECT `id` FROM `tblenquirycall` WHERE `call_type` = '2' and call_id = '".$row->id."' and status = 1")->row();

                                                    $source_info = $this->db->query("SELECT `source` from tblvagentnumbers where  `exotel_number` = '" . $row->vagent_number . "' ")->row();
                                                    if (!empty($source_info)) {
                                                        $source = $source_info->source;
                                                    } else {
                                                        $source = '--';
                                                    }

                                                    $agent_info = $this->db->query("SELECT * from tblstaff where  `phonenumber` = '" . ltrim($row->agent_number, "0") . "' ")->row();
                                                    $agent_name = (!empty($agent_info)) ? $agent_info->firstname : $row->agent_number;
                                                    
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$k; ?></td>
                                                        <td><?php echo cc($source); ?></td>
                                                        <td><?php echo $row->customer_number; ?></td>
                                                        <td><?php echo _d($row->created_at); ?></td>
                                                        <td><?php echo $agent_name; ?></td>
                                                        <td class="text-center"><img height="35" width="35" src="<?php if(!empty($row->recording_url)) {
                                                                echo base_url('assets/images/calltransfer.png');
                                                            } else {
                                                                echo base_url('assets/images/misscall.png');
                                                            } ?>">
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="#" data-toggle="popover" class="recording_play" id="record<?php echo $k; ?>" data-placement="top" data-container="body" data-html="true" onclick="recording(this, '<?php echo $k; ?>', '<?php echo $row->recording_url; ?>');" style="font-size: 40px;" data-content=""><i class="fa fa-play-circle"></i></a>
<!--                                                            <audio controls style="height: 30px;width: 210px;">
                                                                <source src="<?php echo $row->recording_url; ?>" type="audio/mpeg">
                                                            </audio>-->
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <?php
                                                                    if (!empty($chk_call)){
                                                                ?>
                                                                <a href="<?php echo admin_url('enquirycall/view/' . $chk_call->id); ?>" class="btn-sm btn-primary" target="_blank" title="View Enquiry Details"><i class="fa fa-eye"></i></a>
                                                                <?php 
                                                                    }else{
                                                                ?>
                                                                    <a href="<?php echo admin_url('enquirycall/add/'. $row->id.'/2'); ?>" class="btn-sm btn-primary" target="_blank" title="Add Enquiry Details"><i class="fa fa-plus"></i></a>
                                                                <?php } ?>    
                                                            </div>
                                                        </td>
                                                    </tr>    
                                                    <?php
                                                }
                                            } else {
                                                echo '<tr><td class="text-center" colspan="6"><b>Call History are empty!</b></td></tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>



                            </div>

<?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>



                            <div class="btn-bottom-toolbar text-right">

                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Approval Status</h4>
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
    $('.status').click(function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/approval/get_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script> 
<script type="text/javascript">

    function recording(el, id, url) {
        var audio = '<audio controls autoplay><source src="' + url + '" type="audio/ogg"></audio>';
        $(el).attr('data-content', audio);
        $('#record'+id+' i').toggleClass('fa-play-circle fa-pause-circle');
    }
</script>

</body>
</html>
