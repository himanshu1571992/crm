<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h4 class="no-margin">Add Client Ledger Reco </h4>
        </div>
    </div>
    <div class="col-md-12">
        <hr class="hr-panel-heading">
        <form  action="<?php echo admin_url('clients/add_client_ledger_reco'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="from_date" name="from_date" class="form-control datepicker" value="<?php echo (isset($ledger_reco_info) && $ledger_reco_info != "") ? _d($ledger_reco_info->from_date) : ''; ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="to_date" name="to_date" class="form-control datepicker" value="<?php echo (isset($ledger_reco_info) && $ledger_reco_info != "") ? _d($ledger_reco_info->to_date) : ''; ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="upload_pdf" class="control-label">Upload PDF</label>
                            <input type="file" name="file" id="file" class="form-control" <?php echo (!isset($ledger_reco_info)) ? 'required':''; ?>>
                            <?php 
                                if (!empty($ledger_reco_info) && !empty($ledger_reco_info->file)){
                                    echo '<a target="_blank" href="'.site_url('uploads/ledger_reco/'.$ledger_reco_info->id.'/'.$ledger_reco_info->file).'">'.$ledger_reco_info->file.'</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <?php 
                        if (!empty($edit_id)){
                            echo '<input type="hidden" name="edit_id" value="'.$edit_id.'">';
                        }
                        echo '<input type="hidden" name="client_id" value="'.$id.'">';
                    ?>
                    <button class="btn btn-info" type="submit">
                        <?php echo 'Submit'; ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
    
</div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#newtable').DataTable();
    });
    </script>