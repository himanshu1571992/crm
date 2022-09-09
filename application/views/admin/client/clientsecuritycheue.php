<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'client-form', 'class' => 'client-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Client Name</label>
                                    <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($client_data) && count($client_data) > 0) {
                                            foreach ($client_data as $client_key => $client_value) {
                                                ?>
                                                <option value="<?php echo $client_value['userid'] ?>" <?php echo (isset($clientsecurity_info->client_id) && $clientsecurity_info->client_id == $client_value['userid']) ? 'selected' : "" ?>><?php echo cc($client_value['client_branch_name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label for="status" class="control-label">Cheque Amount</label>
                                    <input type="text" id="cheque_amount" name="cheque_amount" class="form-control" value="<?php echo (isset($clientsecurity_info->cheque_amount) && $clientsecurity_info->cheque_amount != "") ? $clientsecurity_info->cheque_amount : "" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label for="status" class="control-label">Cheque Number</label>
                                    <input type="text" id="cheque_number" name="cheque_number" class="form-control" value="<?php echo (isset($clientsecurity_info->cheque_number) && $clientsecurity_info->cheque_number != "") ? $clientsecurity_info->cheque_number : "" ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-4" app-field-wrapper="date">
                                <label for="cheque_date" class="control-label">Cheque Date</label>
                                <div class="input-group date">
                                    <?php $c_date = (isset($clientsecurity_info)) ? _d($clientsecurity_info->cheque_date) : ''; ?>
                                    <input id="cheque_date" name="cheque_date" class="form-control datepicker" value="<?php echo (isset($c_date) && $c_date != "") ? $c_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                        </div>

                       <?php if (isset($clientsecurity_info->cheque_image) && $clientsecurity_info->cheque_image != "") {
                                    ?>
                                    <div class="form-group proimg">
                                        <label class="control-label"></label>
                                        <img src="<?php echo base_url('uploads/client_security_cheque') . "/" . $clientsecurity_info->id . "/" . $clientsecurity_info->cheque_image ?>" style="width: 150px; height: 150px;">
                                    </div>
                                    <?php
                                }
                        ?>

                        <div class="row">
                            <div class="form-group col-md-4">
                                    <label for="cheque_image" class="control-label">Cheque Image</label>
                                    <input type="file" class="form-control" id="cheque_image" name="cheque_image">
                            </div>
                        </div>
                            <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                            </div>
                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>

</body>
</html>
