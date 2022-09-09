<div class="modal-header">
    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
    <h3 id="myModalLabel">Product Information</h3>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#basic_details_info" aria-controls="basic_details" role="tab" data-toggle="tab" aria-expanded="true">Basic Details</a>
                </li>
                <?php if($protype == 1){ ?>
                    <li role="presentation">
                        <a href="#custom_fields_info" aria-controls="custom_fields" role="tab" data-toggle="tab" aria-expanded="false">Custom Product Fields</a>
                    </li>
                    <li role="presentation">
                        <a href="#other_details_info" aria-controls="other_details" role="tab" data-toggle="tab" aria-expanded="false">Other Information</a>
                    </li>
                    <?php if (isset($section) && $section == "productlog"){ ?>
                    <li role="presentation">
                        <a href="#component_info" aria-controls="component" role="tab" data-toggle="tab" aria-expanded="false">Product Component</a>
                    </li>
                    <li role="presentation">
                        <a href="#images_drawing_info" aria-controls="component" role="tab" data-toggle="tab" aria-expanded="false">Images & Drawings</a>
                    </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="basic_details_info">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                $product_image = base_url('assets/images/') . "/no_image_available.jpeg";
                                if (isset($productinfo['photo']) && !empty($productinfo['photo']) && ($productinfo['photo'] != "--")) {
                                    $product_image = base_url('uploads/product') . "/" . $productinfo['photo'];
                                }
                            ?>
                            <img alt="" style="height: 60%;width: 60%;margin-left: 20%;" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo $product_image; ?>" data-original-title="Product">
                            <ul title="Ratings" class="list-inline ratings text-center">
                                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <strong>Information</strong><br>
                            <div class="table-responsive">
                                <table class="table table-user-information">
                                    <tbody>
                                        <?php
                                        if (!empty($productinfo['name'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_name'); ?></strong></td>
                                                <td class="text-primary"><?php echo cc($productinfo['name']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($productinfo['sub_name'])) {
                                            ?>
                                            <tr>
                                                <td><strong>Print Name</strong></td>
                                                <td class="text-primary"><?php echo cc($productinfo['sub_name']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($productcode)) {
                                            ?>
                                            <tr>
                                                <td><strong>Product Code</strong></td>
                                                <td class="text-primary"><?php echo $productcode; ?></td>
                                            </tr>
                                        <?php } ?>
                                            <tr>
                                                <td><strong>Product Type</strong></td>
                                                <td class="text-primary"><?php echo ($protype == 1) ? 'Main Product': 'Temperory Product'; ?></td>
                                            </tr>
                                            <?php
                                        if (!empty($productinfo['company_product_code'])) {
                                            ?>
                                            <tr>
                                                <td><strong>Company Product Code</strong></td>
                                                <td class="text-primary"><?php echo $productinfo['company_product_code']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($productinfo['product_cat_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_cat'); ?></strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblproductcategory', $productinfo['product_cat_id'], 'name'); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        if (!empty($productinfo['product_sub_cat_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_sub_cat'); ?></strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblproductsubcategory', $productinfo['product_sub_cat_id'], 'name'); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        if (!empty($productinfo['parent_category_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong>Product Parent Category</strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblproductparentcategory', $productinfo['parent_category_id'], 'name'); ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['child_category_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong>Product Child Category</strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblproductchildcategory', $productinfo['child_category_id'], 'name'); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($productinfo['division_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong>Division</strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tbldivisionmaster', $productinfo['division_id'], 'title'); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($productinfo['sub_division_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong>Sub Division</strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblsubdivisionmaster', $productinfo['sub_division_id'], 'title'); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($productinfo['product_description'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_description'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['product_description']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['unit_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('unit'); ?></strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblunitmaster', $productinfo['unit_id'], 'name'); ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['working_height'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_working_height'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['working_height']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['platform_height'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_platform_height'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['platform_height']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['tower_height'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_tower_height'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['tower_height']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['dimensions'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_dimensions'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['dimensions']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['gst_id'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_gst'); ?></strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tbltaxes', $productinfo['gst_id'], 'name'); ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['hsn_code'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_hsn_code'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['hsn_code']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['sac_code'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_sac_code'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['sac_code']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['product_weight'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_weight'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['product_weight']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['purchase_price'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_purchase_price'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['purchase_price']; ?></td>
                                            </tr>
                                            <?php
                                        }

                                        if (!empty($productinfo['product_remarks'])) {
                                            ?>
                                            <tr>
                                                <td><strong><?php echo _l('product_remarks'); ?></strong></td>
                                                <td class="text-primary"><?php echo $productinfo['product_remarks']; ?></td>
                                            </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($protype == 1){ ?>
                    <div role="tabpanel" class="tab-pane" id="custom_fields_info">
                        <div class="row">
                            <?php
                                if(!empty($field_info) && !empty($productinfo)){
                                    foreach ($field_info as $key => $row) {
                                        $color_cls = ($key%2 == 1) ? "panel-primary" : "panel-info";
                                        if ($row->type != 3){
                                            $custom_value = $this->db->query("SELECT * FROM `tblproductsfield` where `product_id`='".$productinfo['id']."' and field_id = '".$row->field_id."' ")->row();
                                            $field_value = '';
                                            if(!empty($custom_value)){
                                                $field_value = $custom_value->field_value;
                                            }
                            ?>
                                            <div class="col-md-4">
                                                <div class="panel <?php echo $color_cls; ?>">
                                                    <div class="panel-body">
                                                        <div class="bio-desk">
                                                            <h4><?php echo $row->name; ?></h4><p><?php echo implode(PHP_EOL, str_split($field_value, 45)); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php }}}else{
                                    echo '<div><p class="col-md-12 text-center">Record not found!</p></div>';
                                } ?>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="other_details_info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td><strong><?php echo _l('unit'); ?></strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblunitmaster',$productinfo['unit_id'],'name'); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Size</strong></td>
                                                <td class="text-primary"><?php echo (isset($productinfo['size']) && $productinfo['size'] != "") ? $productinfo['size'] : "" ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Unit 1</strong></td>
                                                <td class="text-primary"><?php echo value_by_id('tblunitmaster',$productinfo['unit_1'],'name'); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Conversion 1</strong></td>
                                                <td class="text-primary"><?php echo (isset($productinfo['conversion_1']) && $productinfo['conversion_1'] != "") ? $productinfo['conversion_1'] : "" ?></td>
                                            </tr>
                                            <?php if(isset($productinfo['productmaterial_id']) && $productinfo['productmaterial_id'] > 0){ ?>
                                                <tr>
                                                    <td><strong> Product Material </strong></td>
                                                    <td class="text-primary"><?php echo (isset($productinfo['productmaterial_id']) && $productinfo['productmaterial_id'] != "") ? cc(value_by_id("tblproductmaterial", $productinfo['productmaterial_id'], "name")) : "" ?></td>
                                                </tr>
                                                    <?php if (isset($productinfo['width']) && $productinfo['width'] > 0 && $productinfo['productmaterial_id'] > 0) { ?>
                                                        <tr>
                                                            <td><strong> Width </strong></td>
                                                            <td class="text-primary"><?php echo (isset($productinfo['width']) && $productinfo['width'] != "") ? $productinfo['width'] : "" ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <?php if (isset($productinfo['diameter']) && $productinfo['diameter'] > 0 && $productinfo['productmaterial_id'] > 0) { ?>
                                                        <tr>
                                                            <td><strong> Diameter </strong></td>
                                                            <td class="text-primary"><?php echo (isset($productinfo['diameter']) && $productinfo['diameter'] != "") ? $productinfo['diameter'] : "" ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <?php if (isset($productinfo['width_thickness']) && $productinfo['width_thickness'] > 0 && $productinfo['productmaterial_id'] > 0) { ?>
                                                        <tr>
                                                            <td><strong> Width Thickness </strong></td>
                                                            <td class="text-primary"><?php echo (isset($productinfo['width_thickness']) && $productinfo['width_thickness'] != "") ? $productinfo['width_thickness'] : "" ?></td>
                                                        </tr>
                                                    <?php } ?>
                                            <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <br>
                                <?php
                                    if (isset($productinfo['faq']) && $productinfo['faq'] != ""){
                                ?>
                                <div class="panel">
                                    <div class="panel-body" style="background: #75ba48">
                                        <div class="bio-desk">
                                            <h4>FAQ</h4>
                                            <p>
                                                <?php echo implode(PHP_EOL, str_split($productinfo['faq'], 45)); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td><strong>Unit 2 </strong><small>(For PDF View)</small></td>
                                                <td class="text-primary"><?php echo value_by_id('tblunitmaster',$productinfo['unit_2'],'name'); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Conversion 2</strong></td>
                                                <td class="text-primary"><?php echo (isset($productinfo['conversion_2']) && $productinfo['conversion_2'] != "") ? $productinfo['conversion_2'] : "" ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sales Price</strong></td>
                                                <td class="text-primary"><?php echo (isset($productinfo['price']) && $productinfo['price'] != "") ? $productinfo['price'] : "" ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>GST Percent</strong></td>
                                                <td class="text-primary">
                                                    <?php
                                                        if (isset($tax_data) && count($tax_data) > 0) {
                                                            foreach ($tax_data as $tax_key => $tax_value) {
                                                                ?>
                                                                <?php echo (isset($productinfo['gst_id']) && $productinfo['gst_id'] == $tax_value['id']) ? $tax_value['name'].' ('.$tax_value['taxrate'].') ' : "" ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Product Master</strong></td>
                                                <td class="text-primary">
                                                    <?php
                                                        echo value_by_id('tblproductnewmaster',$productinfo['master_id'],'name');
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                    if (isset($productinfo['merging_remark']) && $productinfo['merging_remark'] != ""){
                                ?>
                                <div class="panel">
                                    <div class="panel-body" style="background: #00BCD4">
                                        <div class="bio-desk">
                                            <h4>Merging Remark</h4>
                                            <p>
                                                <?php echo implode(PHP_EOL, str_split($productinfo['merging_remark'], 45)); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($section) && $section == "productlog"){ ?>
                    <div role="tabpanel" class="tab-pane" id="component_info">
                        <div class="row">
                            <?php
                                if (!empty($productcomponent)) {
                                    foreach ($productcomponent as $key => $singleproductcomp) {
                                        $color_cls = ($key%2 == 1) ? "panel-success" : "panel-info";
                            ?>
                            <div class="col-lg-3">
                                <div class="panel <?php echo $color_cls; ?>">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-12 text-right">
                                                <h1 class="announcement-heading"><?php echo (isset($singleproductcomp['qty']) && $singleproductcomp['qty'] != "") ? $singleproductcomp['qty'] : ""; ?></h1>
                                                <?php
                                                    if (isset($item_data) && count($item_data) > 0) {
                                                        foreach ($item_data as $unit_key => $item_value) {
                                                ?>
                                                <p class="announcement-text"><?php echo (isset($item_value['id']) && $singleproductcomp['item_id'] == $item_value['id']) ? $item_value['name'].'<br> <span class="text-danger">('.get_product_category($item_value['product_cat_id']).') </span>' : ""; ?></p>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <p class="announcement-text"><?php echo (isset($singleproductcomp['size']) && $singleproductcomp['size'] > 0) ? 'Size : <span class="text-danger">'.$singleproductcomp['size'].' (In MM) </span>' : ""; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="../../product_new/view/<?php echo $singleproductcomp['item_id'];?>" target="_blank">
                                        <div class="panel-footer announcement-bottom">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    View
                                                </div>
                                                <div class="col-xs-6 text-right">
                                                    <i class="fa fa-arrow-circle-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php }}else{
                                echo '<div><p class="col-md-12 text-center">Record not found!</p></div>';
                            } ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="images_drawing_info">
                        <?php
                            // $mutlimages_info = $this->db->query("SELECT * FROM `tblproductfiles` where `rel_id`='".$product['id']."' and rel_type = 'mutliple_image' and file_name != ''")->result();
                            if ($mutlimages_info){
                        ?>
                        <div class="col-md-12">
                            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Product Images</h1>
                            <hr class="mt-2 mb-5">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" style="width:300px; margin-left: 35%;">
                                    <?php
                                        foreach ($mutlimages_info as $key => $multi) {
                                            $multi_url = base_url('uploads/product/product_multiple') . "/" . $multi->file_name;
                                    ?>
                                    <div class="item <?php echo ($key == 0)? 'active': ''?>">
                                        <a target="_blank" href="<?php echo $multi_url; ?>"><img src="<?php echo $multi_url; ?>" title="<?php echo $multi->file_name; ?>" style="width:100%;"></a>
                                    </div>
                                        <?php } ?>
                                </div>

                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <?php }

                        // $file_info = $this->db->query("SELECT * FROM `tblproductfiles` where `rel_id`='".$product['id']."' and rel_type = 'drawing' and file_name != '' ")->result();
                        if (!empty($file_info)){
                        ?>
                        <div class="container">
                            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Product Drawings</h1>
                            <hr class="mt-2 mb-5">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <h5> Product Drawings</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                                foreach ($file_info as $key => $file) {
                                                    $ext = pathinfo($file->file_name, PATHINFO_EXTENSION);
                                                    echo ($key != 0) ? "<hr>":"";
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-10">
                                                    <h4 class="product-name"><strong><?php echo $file->file_name; ?></strong></h4>
                                                </div>
                                                <div class="col-xs-2">

                                                    <div class="col-xs-2">
                                                        <button type="button" class="btn btn-link btn-xs">
                                                            <a class="btn btn-danger" href="<?php echo site_url('uploads/product/product_drawing/'.$file->file_name);?>" download><i class="fa fa-download"></i></a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="table-responsive s_table">
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                        <thead>
                                            <tr>
                                                <th width="5%"  align="center">S.No.</th>
                                                <th width="40%" align="left">Name of Drawing</th>
                                                <th width="20%" align="left">Drawing ID</th>
                                                <th width="10%" align="left">Rev No</th>
                                                <th width="20%" align="left">Drawing</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ui-sortable">
                                            <?php
                                            if (!empty($productdrawing_list)) {
                                                $i = 0;
                                                foreach ($productdrawing_list  as $key => $value) {

                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo cc($value->drawing_name) ?></td>
                                                        <td><?php echo $value->drawing_id; ?></td>
                                                        <td><?php echo $value->rev_no; ?></td>
                                                        <td>
                                                            <?php if (!empty($value->files)){
                                                                $filesdata = json_decode($value->files);
                                                                foreach ($filesdata as $k => $file) {
                                                            ?>
                                                                <a href="<?php echo base_url('uploads/product/product_drawing') . "/" . $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                                            <?php
                                                                }
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else{
                                                ?>
                                                <tr>
                                                    <td colspan="4">product drawing Not Available</td>
                                                </tr>
                                                <?php
                                            }
                                                ?>

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php }
                        if (empty($mutlimages_info) && empty($file_info)){
                            echo '<div><p class="col-md-12 text-center">Record not found!</p></div>';
                        }
                        ?>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>    
        </div>
    </div>
</div>
<div class="modal-footer productdetailsbtn">
    
</div>