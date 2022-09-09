<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h4 class="no-margin">Client Ledger Reco </h4>
            <a href="<?php echo admin_url('clients/client/'.$id.'?group=add_client_ledger_reco'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Ledger Reco</a>
        </div>
        <div class="col-md-12 table-responsive">
            <hr class="hr-panel-heading">
            <table class="table" id="newtable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Added By</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Created At</th>
                        <th>File</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                if (!empty($ledger_reco_data)) {
                    foreach ($ledger_reco_data as $k => $row) {
                        // $client_info = $this->db->query("SELECT `company` FROM tblclients WHERE userid ='".$row->client_id."'")->row();
                        
                        ?>
                    <tr>
                        <td><?php echo ++$k; ?></td>
                        <td><span class="badge badge-info"><?php echo get_employee_fullname($row->added_by); ?></span></td>
                        <!-- <td><?php echo $client_info->company; ?></td> -->
                        <td><?php echo _d($row->from_date); ?></td>
                        <td><?php echo _d($row->to_date); ?></td>
                        <td><?php echo _d($row->created_at); ?></td>
                        <td>
                            <?php 
                                if (!empty($row->file)){
                                    echo '<a target="_blank" href="'.site_url('uploads/ledger_reco/'.$row->id.'/'.$row->file).'">'.$row->file.'</a>';
                                }
                            ?>
                        </td>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="<?php echo admin_url('clients/client/'.$id.'?group=add_client_ledger_reco&edit_id='. $row->id); ?>" class="btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo admin_url('clients/delete_ledger_reco/' . $row->id); ?>" class="btn-sm btn-danger _delete" title="Delete"><i class="fa fa-trash"></i></a>
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
    
    <div id="requisition_status" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Assigned Person</h4>
                </div>
                <div class="modal-body requisition_status_details"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#newtable').DataTable();
    });
    </script>