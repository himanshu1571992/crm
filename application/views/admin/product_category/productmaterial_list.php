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
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4><!--<a href="<?php echo admin_url('productcategory/addProductMaterial'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Product Material</a>--></div>
                            </div>	                   
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Coil Pipe Price (In KG)</th>
                                                <th>Non Coil Pipe Price (In KG)</th>
                                                <th>Last Updated on </th>
                                                <th>Status</th>
                                                <th>DateTime</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($productmaterial_list)) {
                                                foreach ($productmaterial_list as $k => $row) {
                                                    $checked = ($row->status == 1 ) ? 'checked' : '';
                                                    $toggleActive = '<div class="onoffswitch">
                                                                        <input type="checkbox" data-switch-url="' . admin_url() . 'productcategory/change_productmaterial_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $row->id . '" data-id="' . $row->id . '" ' . $checked . '>
                                                                        <label class="onoffswitch-label" for="' . $row->id . '"></label>
                                                                    </div>';

                                                    // For exporting
                                                    $toggleActive .= '<span class="hide">' . ($row->status == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$k; ?></td>
                                                        <td><?php echo cc($row->name); ?></td>
                                                        <td><?php echo $row->coilPipePrice; ?></td>
                                                        <td><?php echo $row->nonCoilPipePrice; ?></td>
                                                        <td><?php echo date("d-m-Y", strtotime($row->update_date)); ?></td>
                                                        <td><?php echo $toggleActive; ?></td>
                                                        <td><?php echo _d($row->created_at); ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group"> 
                                                                <a href="<?php echo admin_url('productcategory/addProductMaterial/' . $row->id); ?>" class="btn-sm btn-primary" title="Edit Complains Details"><i class="fa fa-edit"></i></a>
                                                                <!--<a href="<?php echo admin_url('productcategory/deleteProductMaterial/'.$row->id); ?>" class="btn-sm btn-danger _delete action-btn" ><i class="fa fa-trash" aria-hidden="true"></i></a>-->
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


</body>
</html>
