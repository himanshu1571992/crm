<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'interview_details-form', 'class' => 'proposal-form','enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="rating" class="control-label">Question <span style="color: red;">*</span></label>
                                    <input type="text" name="question" class="form-control" required="" value="<?php echo (!empty($generalquestioninfo->question)) ? $generalquestioninfo->question : ""; ?>">
                                </div>
                            </div>
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

            <?php echo form_close(); ?>



        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

<?php init_tail(); ?>


<script type="text/javascript">

</script>

</body>

</html>
