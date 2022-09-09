<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo site_url($this->uri->uri_string()); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="name" class="control-label"><?php echo 'Name'; ?> <span style="color:red;">*</span></label>
                                <input type="text" id="name" <?php echo $section == "edit" ? "readonly=''": ""; ?> name="name" class="form-control" required="" value="<?php echo (isset($material_data) && $material_data->name != "") ? $material_data->name : "" ?>">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="coilPipePrice" class="control-label"><?php echo 'Coil Pipe Price'; ?>  (In KG)<span style="color:red;">*</span></label>
                                <input type="text" id="coilPipePrice" name="coilPipePrice" class="form-control amount" required="" value="<?php echo  (!empty($material_data) && $material_data->coilPipePrice != "") ? $material_data->coilPipePrice : ""; ?>">
                                <div><p class="error-cp"></p></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nonCoilPipePrice" class="control-label"><?php echo 'Non Coil Pipe Price'; ?>  (In KG)<span style="color:red;">*</span></label>
                                <input type="text" id="nonCoilPipePrice" name="nonCoilPipePrice" class="form-control amount" required="" value="<?php echo  (!empty($material_data) && $material_data->nonCoilPipePrice != "") ? $material_data->nonCoilPipePrice : ""; ?>">
                                <div class="error-ncp" ></div>
                            </div>
                            <?php
                                $productfield = array();
                                if (!empty($material_data)){
                                   $productfield = explode(",", $material_data->product_fields);
                                }         
                            ?>
                            <div class="form-group col-md-3">
                                <div class="form-group select-placeholder">
                                    <label for="paymentmode" class="control-label"><small class="req text-danger">* </small> Product Fields </label>
                                    <select class="form-control selectpicker" id="product_fields" multiple="" name="product_fields[]" required="">
                                        <option value="">--Select One--</option>
                                        <option value="1" <?php echo (!empty($material_data->product_fields) && in_array(1, $productfield)) ? 'selected' : ''; ?>>Width</option>
                                        <option value="2" <?php echo (!empty($material_data->product_fields) && in_array(2, $productfield)) ? 'selected' : ''; ?>>Diameter</option>
                                        <option value="3" <?php echo (!empty($material_data->product_fields) && in_array(3, $productfield)) ? 'selected' : ''; ?>>Edge Width Small</option>
                                        <option value="4" <?php echo (!empty($material_data->product_fields) && in_array(4, $productfield)) ? 'selected' : ''; ?>>Edge Width</option>
                                        <option value="5" <?php echo (!empty($material_data->product_fields) && in_array(5, $productfield)) ? 'selected' : ''; ?>>Edge Length</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="is_main" class="control-label"><?php echo 'Remark'; ?> </label>
                                <textarea id="remark" name="remark" rows="4" class="form-control"><?php echo  (!empty($material_data) && $material_data->remark != "") ? $material_data->remark : ""; ?></textarea>
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
