<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'client-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo (!empty($title)) ? $title: ""; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="Bank" class="control-label">Bank *</label>
                                <select class="form-control selectpicker" data-live-search="true" required="" id="bank" name="bank_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($bank_list)) {
                                        foreach ($bank_list as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo (isset($cheque_book_info) && $cheque_book_info->bank_id == $value->id) ? "selected" : ""; ?>><?php echo cc($value->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="chequebook_name" class="control-label">Cheque Book Name *</label>
                                <input type="text" id="chequebook_name" name="chequebook_name" class="form-control" required="" value="<?php echo (isset($cheque_book_info->chequebook_name) && $cheque_book_info->chequebook_name != "") ? $cheque_book_info->chequebook_name : "" ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="From Page" class="control-label">From Page *</label>
                                <input type="number" id="from_page" name="from_page" class="form-control" required="" value="<?php echo (isset($cheque_book_info->from_page) && $cheque_book_info->from_page != "") ? $cheque_book_info->from_page : "" ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="To Page" class="control-label">To Page *</label>
                                <input type="number" id="to_page" name="to_page" class="form-control" required="" value="<?php echo (isset($cheque_book_info->to_page) && $cheque_book_info->to_page != "") ? $cheque_book_info->to_page : "" ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description" class="control-label">Description *</label>
                                <textarea id="description" name="description"rows="5" class="form-control" required=""><?php echo (isset($cheque_book_info->description) && $cheque_book_info->description != "") ? $cheque_book_info->description : "" ?></textarea>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit"><?php echo 'Submit'; ?></button>
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
