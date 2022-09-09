<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo site_url($this->uri->uri_string()); ?>"  class="letters_format" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php if (!empty($title)) { echo $title;} ?></h4>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name" class="control-label"><?php echo 'Letter Type'; ?> <span style="color:red">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="lettertype_id" name="lettertype_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($all_letters_types) && count($all_letters_types) > 0) {
                                                foreach ($all_letters_types as $types) {
                                                    $selected = ($letters_format->lettertype_id == $types->id) ? "selected": ""; ?>
                                                    ?>
                                                    <option value="<?php echo $types->id; ?>" <?php echo $selected; ?>><?php echo cc($types->title); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    <!--<input type="text" id="name" name="title" class="form-control" required="" value="<?php echo (isset($letters_format->title) && $letters_format->title != "") ? $letters_format->title : "" ?>">-->
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label"> Content <span style="color:red">*</span></label>
                                    <textarea id="content" name="content" class="form-control tinymce"><?php echo (isset($letters_format->content) && $letters_format->content != "") ? $letters_format->content : "" ?></textarea>
                                </div>
                            </div>

                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" type="submit">
                                    <?php echo 'Submit'; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> 
            </form>

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
