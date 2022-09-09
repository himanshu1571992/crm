<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?> <!-- <a href="<?php echo admin_url('letters_format/add'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Letter Format</a> --></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">        
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo 'Letter Type'; ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="lettertype_id" name="lettertype_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_letters_types) && count($all_letters_types) > 0) {
                                            foreach ($all_letters_types as $types) {
                                                $selected = (isset($lettertype_id) && $lettertype_id == $types->id) ? "selected": ""; ?>
                                                ?>
                                                <option value="<?php echo $types->id; ?>" <?php echo $selected; ?>><?php echo cc($types->title); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group" style="margin-top: 26px;">
                                    <button type="submit" class="btn btn-info">Search</button>
                                    <a class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <div class="col-md-12">                                                             
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Created Date</th>
                                                <th>Update Date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($letters_format)) {
                                                $i = 1;
                                                foreach ($letters_format as $key => $row) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo value_by_id("tbllettersformattypes", $row->lettertype_id, "title"); ?></td>
                                                        <td><?php echo _d($row->created_on); ?></td>                                                 
                                                        <td><?php echo _d($row->updated_on); ?></td>                                                 
                                                        <td class="text-center">
                                                            <a href="<?php echo admin_url('letters_format/add/' . $row->id); ?>" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>                                                    
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
                            <!-- <div class="btn-bottom-toolbar text-right">
                           <button class="btn btn-info" value="1" name="mark" type="submit">
<?php echo _l('submit'); ?>
                           </button>
                       </div> -->
                        </div>

                    </div>
                </div>

<?php echo form_close(); ?>
            </div>      
            <div class="btn-bottom-pusher"></div>
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
</body>
</html>


<script type="text/javascript">
    $(document).on('click', '.handover', function () {

        var handover_id = $(this).val();
        if (handover_id > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/handover/get_handover_data'); ?>",
                data: {'handover_id': handover_id},
                success: function (response) {
                    if (response != '') {


                        $('#handover_data').html(response);
                    }
                }
            })
        }


    });
</script>
