<?php init_head(); ?>
<style>
 .inf-content{
    border:1px solid #DDDDDD;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><?php echo $title; ?> <a href="<?php echo admin_url('product_new/product/'.$product['id']);?>" class="btn-sm btn-primary pull-right">Edit</a></h3>
                                <hr/>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#basic_details" aria-controls="basic_details" role="tab" data-toggle="tab" aria-expanded="true">Basic Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#custom_fields" aria-controls="custom_fields" role="tab" data-toggle="tab" aria-expanded="false">Custom Product Fields</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#other_details" aria-controls="other_details" role="tab" data-toggle="tab" aria-expanded="false">Other Information</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#component" aria-controls="component" role="tab" data-toggle="tab" aria-expanded="false">Product Component</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#images_drawing" aria-controls="component" role="tab" data-toggle="tab" aria-expanded="false">Images & Drawings</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#product_details" aria-controls="product_details" role="tab" data-toggle="tab" aria-expanded="false">Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#revision_details" aria-controls="revision_details" role="tab" data-toggle="tab" aria-expanded="false">Revision Details</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="basic_details">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php
                                                    $product_image = base_url('assets/images/') . "/no_image_available.jpeg";
                                                    if (isset($product['photo']) && !empty($product['photo']) && ($product['photo'] != "--")) {
                                                        $product_image = base_url('uploads/product') . "/" . $product['photo'];
                                                    }
                                                ?>
                                                <img alt="" style="height:300px;width: 300px;margin-left: 20%;" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo $product_image; ?>" data-original-title="Product">
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
                                                            if (!empty($product['name'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_name'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['name']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            if (!empty($product['sub_name'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Print Name</strong></td>
                                                                    <td class="text-primary"><?php echo $product['sub_name']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            if (!empty($product['company_product_code'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Company Product Code</strong></td>
                                                                    <td class="text-primary"><?php echo $product['company_product_code']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            if (!empty($product['product_cat_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_cat'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tblproductcategory', $product['product_cat_id'], 'name'); ?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            if (!empty($product['product_sub_cat_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_sub_cat'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tblproductsubcategory', $product['product_sub_cat_id'], 'name'); ?></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            if (!empty($product['parent_category_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Product Parent Category</strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tblproductparentcategory', $product['parent_category_id'], 'name'); ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['child_category_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Product Child Category</strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tblproductchildcategory', $product['child_category_id'], 'name'); ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            if (!empty($product['division_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Division</strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tbldivisionmaster', $product['division_id'], 'title'); ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            if (!empty($product['sub_division_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Sub Division</strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tblsubdivisionmaster', $product['sub_division_id'], 'title'); ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            if (!empty($product['product_description'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_description'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['product_description']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['unit_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('unit'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tblunitmaster', $product['unit_id'], 'name'); ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['working_height'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_working_height'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['working_height']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['platform_height'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_platform_height'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['platform_height']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['tower_height'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_tower_height'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['tower_height']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['dimensions'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_dimensions'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['dimensions']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['gst_id'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_gst'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo value_by_id('tbltaxes', $product['gst_id'], 'name'); ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['hsn_code'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_hsn_code'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['hsn_code']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['sac_code'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_sac_code'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['sac_code']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['product_weight'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_weight'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['product_weight']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['purchase_price'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_purchase_price'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['purchase_price']; ?></td>
                                                                </tr>
                                                                <?php
                                                            }

                                                            if (!empty($product['product_remarks'])) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong><?php echo _l('product_remarks'); ?></strong></td>
                                                                    <td class="text-primary"><?php echo $product['product_remarks']; ?></td>
                                                                </tr>
                                                        <?php }
                                                            echo '<tr><td colspan="2"><strong class="text-danger">Printing Name Details:-</strong></td></tr>';
                                                            if ($product['print_thickness'] > 0) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Thickness</strong></td>
                                                                    <td class="text-primary"><?php echo $product['print_thickness']; ?></td>
                                                                </tr>
                                                        <?php }
                                                            if ($product['print_diameter'] > 0) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Diameter</strong></td>
                                                                    <td class="text-primary"><?php echo $product['print_diameter']; ?></td>
                                                                </tr>
                                                        <?php }
                                                            if ($product['print_width'] > 0) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Width</strong></td>
                                                                    <td class="text-primary"><?php echo $product['print_width']; ?></td>
                                                                </tr>
                                                        <?php }
                                                            if ($product['print_height'] > 0) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Height</strong></td>
                                                                    <td class="text-primary"><?php echo $product['print_height']; ?></td>
                                                                </tr>
                                                        <?php }
                                                            if ($product['print_length'] > 0) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Length</strong></td>
                                                                    <td class="text-primary"><?php echo $product['print_length']; ?></td>
                                                                </tr>
                                                        <?php }
                                                            if ($product['print_range'] > 0) {
                                                                ?>
                                                                <tr>
                                                                    <td><strong>Range</strong></td>
                                                                    <td class="text-primary"><?php echo $product['print_range']; ?></td>
                                                                </tr>
                                                        <?php }
                                                        if (!empty($product['print_capacity'])) {
                                                            ?>
                                                            <tr>
                                                                <td><strong>Capacity</strong></td>
                                                                <td class="text-primary"><?php echo $product['print_capacity']; ?>
                                                            </tr>    
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="custom_fields">
                                        <div class="row">
                                            <?php
                                                if(!empty($field_info) && !empty($product)){
                                                    foreach ($field_info as $key => $row) {
                                                        $color_cls = ($key%2 == 1) ? "panel-primary" : "panel-info";
                                                        if ($row->type != 3){
                                                            $custom_value = $this->db->query("SELECT * FROM `tblproductsfield` where `product_id`='".$product['id']."' and field_id = '".$row->field_id."' ")->row();
                                                            $field_value = '';
                                                            if(!empty($custom_value)){
                                                                $field_value = $custom_value->field_value;
                                                            }
                                            ?>
                                            <div class="col-md-3">
                                                <div class="panel <?php echo $color_cls; ?>">
                                                    <div class="panel-body">
                                                        <div class="bio-desk">
                                                            <h4 class="red"><?php echo $row->name; ?></h4><p><?php echo implode(PHP_EOL, str_split($field_value, 45)); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php }}}else{
                                                    echo '<div><p class="col-md-12 text-center">Record not found!</p></div>';
                                                } ?>
                                        </div>

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="other_details">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table class="table table-user-information">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong><?php echo _l('unit'); ?></strong></td>
                                                                <td class="text-primary"><?php echo value_by_id('tblunitmaster',$product['unit_id'],'name'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Size</strong></td>
                                                                <td class="text-primary"><?php echo (isset($product['size']) && $product['size'] != "") ? $product['size'] : "" ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Unit 1</strong></td>
                                                                <td class="text-primary"><?php echo value_by_id('tblunitmaster',$product['unit_1'],'name'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Conversion 1</strong></td>
                                                                <td class="text-primary"><?php echo (isset($product['conversion_1']) && $product['conversion_1'] != "") ? $product['conversion_1'] : "" ?></td>
                                                            </tr>
                                                            <?php if(isset($product['productmaterial_id']) && $product['productmaterial_id'] > 0){ ?>
                                                                <tr>
                                                                    <td><strong> Product Material </strong></td>
                                                                    <td class="text-primary"><?php echo (isset($product['productmaterial_id']) && $product['productmaterial_id'] != "") ? cc(value_by_id("tblproductmaterial", $product['productmaterial_id'], "name")) : "" ?></td>
                                                                </tr>
                                                                    <?php if (isset($product['width']) && $product['width'] > 0 && $product['productmaterial_id'] > 0) { ?>
                                                                        <tr>
                                                                            <td><strong> Width </strong></td>
                                                                            <td class="text-primary"><?php echo (isset($product['width']) && $product['width'] != "") ? $product['width'] : "" ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (isset($product['diameter']) && $product['diameter'] > 0 && $product['productmaterial_id'] > 0) { ?>
                                                                        <tr>
                                                                            <td><strong> Diameter </strong></td>
                                                                            <td class="text-primary"><?php echo (isset($product['diameter']) && $product['diameter'] != "") ? $product['diameter'] : "" ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (isset($product['width_thickness']) && $product['width_thickness'] > 0 && $product['productmaterial_id'] > 0) { ?>
                                                                        <tr>
                                                                            <td><strong> Width Thickness </strong></td>
                                                                            <td class="text-primary"><?php echo (isset($product['width_thickness']) && $product['width_thickness'] != "") ? $product['width_thickness'] : "" ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                            <?php } ?>


                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br>
                                                <br>
                                                <?php
                                                    if (isset($product['faq']) && $product['faq'] != ""){
                                                ?>
                                                <div class="panel">
                                                    <div class="panel-body" style="background: #75ba48">
                                                        <div class="bio-desk">
                                                            <h4 class="red">FAQ</h4>
                                                            <p>
                                                                <?php echo implode(PHP_EOL, str_split($product['faq'], 45)); ?>
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
                                                                <td class="text-primary"><?php echo value_by_id('tblunitmaster',$product['unit_2'],'name'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Conversion 2</strong></td>
                                                                <td class="text-primary"><?php echo (isset($product['conversion_2']) && $product['conversion_2'] != "") ? $product['conversion_2'] : "" ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Sales Price</strong></td>
                                                                <td class="text-primary"><?php echo (isset($product['price']) && $product['price'] != "") ? $product['price'] : "" ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>GST Percent</strong></td>
                                                                <td class="text-primary">
                                                                    <?php
                                                                        if (isset($tax_data) && count($tax_data) > 0) {
                                                                            foreach ($tax_data as $tax_key => $tax_value) {
                                                                                ?>
                                                                                <?php echo (isset($product['gst_id']) && $product['gst_id'] == $tax_value['id']) ? $tax_value['name'].' ('.$tax_value['taxrate'].') ' : "" ?></option>
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
                                                                      echo value_by_id('tblproductnewmaster',$product['master_id'],'name');
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php if (isset($product['width_mm']) && $product['width_mm'] > 0 && $product['width_mm'] > 0) { ?>
                                                                <tr>
                                                                    <td><strong> Width (MM) </strong></td>
                                                                    <td class="text-primary"><?php echo (isset($product['width_mm']) && $product['width_mm'] != "") ? $product['width_mm'] : "" ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <?php
                                                    if (isset($product['merging_remark']) && $product['merging_remark'] != ""){
                                                ?>
                                                <div class="panel">
                                                    <div class="panel-body" style="background: #00BCD4">
                                                        <div class="bio-desk">
                                                            <h4 class="red">Merging Remark</h4>
                                                            <p>
                                                                <?php echo implode(PHP_EOL, str_split($product['merging_remark'], 45)); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="component">
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
<!--                                                            <div class="col-xs-6">
                                                                <i class="fa fa-address-card-o fa-5x"></i>
                                                                </div>-->
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
                                    <div role="tabpanel" class="tab-pane" id="images_drawing">
                                        <?php
                                            $mutlimages_info = $this->db->query("SELECT * FROM `tblproductfiles` where `rel_id`='".$product['id']."' and rel_type = 'mutliple_image' and file_name != ''")->result();
                                            if ($mutlimages_info){
                                        ?>
                                        <div class="container">
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

                                        $file_info = $this->db->query("SELECT * FROM `tblproductfiles` where `rel_id`='".$product['id']."' and rel_type = 'drawing' and file_name != '' ")->result();
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
                                <div role="tabpanel" class="tab-pane" id="product_details">
                                    <?php 
                                        if (empty($lead_info) && empty($quotation_info) && empty($pi_info) && empty($invoice_info) && empty($challan_info) && empty($debitnote_info) && empty($purchase_info) && empty($component_info)){
                                            echo '<div><p class="col-md-12 text-center">Record not found!</p></div>';
                                        }
                                    ?>
                                    <?php if(!empty($lead_info)){ ?>
                                         <div class="col-md-6">
                                             <div class="table-responsive">
                                                <h4 class="no-margin text-center">Lead Product Details</h4>
                                                <hr>
                                                <table class="table pro_tbl">
                                                   <thead>
                                                         <tr>
                                                             <th>S.No.</th>
                                                             <th>Lead No.</th>
                                                             <th>Amount</th>
                                                             <th>Date</th>
                                                             <th>Qty</th>
                                                         </tr>
                                                   </thead>
                                                   <tbody>
                                                       <?php
                                                         $z=1;
                                                          $ttlqty = 0;
                                                         foreach($lead_info as $value){
                                                           //getting last quotation amount
                                                              $quotation = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->enquiry_id."' order by id desc  ")->row();
                                                              $amount = (!empty($quotation)) ? $quotation->total : '0.00';
                                                              $ttlqty += $value->qty;
                                                           ?>
                                                           <tr>
                                                             <td><?php echo $z++;?></td>
                                                             <td><?php echo '<a target="_blank" href="'.admin_url('leads/leads/' . $value->enquiry_id).'"> LEAD-'.number_series($value->enquiry_id).'</a>';?></td>
                                                             <td><?php echo $amount;?></td>
                                                             <td><?php echo _d($value->enquiry_date); ?></td>
                                                              <td><?php echo $value->qty; ?></td>
                                                           </tr>
                                                           <?php
                                                         }
                                                       ?>
                                                     </tbody>
                                                      <tfoot style="background-color:#e5e7eb;">
                                                          <td colspan="4">Total</td>
                                                          <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                      </tfoot>
                                                 </table>
                                             </div>
                                        </div>
                                     <?php } ?>
                                     <?php if(!empty($quotation_info)){ ?>
                                 				<div class="col-md-6">
                                           <div class="table-responsive">
                                   						<h4 class="no-margin text-center">Quotation Product Details</h4>
                                              <hr>
                                   						<table class="table pro_tbl">
                                 								<thead>
                                   								  <tr>
                                       									<th>S.No.</th>
                                       									<th>Quotation No.</th>
                                       									<th>Amount</th>
                                       									<th>Date</th>
                                       									<th>Qty</th>
                                       									<th>Rate</th>
                                   								  </tr>
                                 								</thead>
                                 								<tbody>
                                     								<?php
                                     									$z=1;
                                                       $ttlqty = 0;
                                                       $ttlrate = 0;
                                       									foreach($quotation_info as $value){
                                                           $ttlqty += $value->qty;
                                                           $ttlrate += $value->qty*$value->rate;
                                       							?>
                                       										<tr>
                                       											<td><?php echo $z++;?></td>
                                       											<td><?php echo '<a target="_blank" href="' . admin_url('proposals/download_pdf/' . $value->id) . '" onclick="init_proposal(' . $value->id . '); ">' . format_proposal_number($value->id) . '</a>'; ?></td>
                                       											<td><?php echo $value->total; ?></td>
                                       											<td><?php echo _d($value->date); ?></td>
                                                             <td><?php echo $value->qty; ?></td>
                                                             <td><?php echo $value->rate; ?></td>
                                       										</tr>
                                       							<?php
                                       									}
                                     								?>
                                 								 </tbody>
                                                   <tfoot style="background-color:#e5e7eb;">
                                                       <td colspan="4">Total</td>
                                                       <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                       <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                                   </tfoot>
                                 							  </table>
                                 				   </div>
                                 				</div>
                                        <?php } ?>
                                        <?php if(!empty($pi_info)){ ?>
                           						<div class="col-md-6">
                                          <div class="table-responsive">
                                 						  <h4 class="no-margin text-center">Proforma Invoice Product Details</h4>
                                              <hr>
                                 							<table class="table pro_tbl">
                                   								<thead>
                                     								  <tr>
                                         									<th>S.No.</th>
                                         									<th>PI No.</th>
                                         									<th>Amount</th>
                                         									<th>Date</th>
                                                           <th>Qty</th>
                                         									<th>Rate</th>
                                     								  </tr>
                                   								</thead>
                                   								<tbody>
                                           								<?php
                                           									$z=1;
                                                             $ttlqty = $ttlrate = 0;
                                           									foreach($pi_info as $value){
                                                                 $ttlqty += $value->qty;
                                                                 $ttlrate += $value->qty*$value->rate;
                                           								?>
                                           										<tr>
                                             											<td><?php echo $z++;?></td>
                                             											<td><?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $value->id) . '" onclick="init_estimate(' . $value->id . '); ">' . format_estimate_number($value->id) . '</a>';?></td>
                                             											<td><?php echo $value->total; ?></td>
                                             											<td><?php echo _d($value->date); ?></td>
                                                                   <td><?php echo $value->qty; ?></td>
                                                                   <td><?php echo $value->rate; ?></td>
                                           										</tr>
                                           								<?php
                                           									}
                                           								?>
                                     								</tbody>
                                                  <tfoot style="background-color:#e5e7eb;">
                                                         <td colspan="4">Total</td>
                                                         <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                         <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                                     </tfoot>
                                 							</table>
                             						  </div>
                           						</div>
                                        <?php } ?>
   			                            <?php if(!empty($invoice_info)){ ?>
                           						<div class="col-md-6">
                                          <div class="table-responsive">
                                            <h4 class="no-margin text-center">Invoice Product Details</h4>
                                            <hr>
                                            <table class="table pro_tbl">
                                                  <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Invoice No.</th>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php
                                                        $z=1;
                                                         $ttlqty = $ttlrate = 0;
                                                        foreach($invoice_info as $value){
                                                           $ttlqty += $value->qty;
                                                           $ttlrate += $value->qty*$value->rate;
                                                      ?>
                                                          <tr>
                                                            <td><?php echo $z++;?></td>
                                                            <td><?php echo '<a href="' . admin_url('invoices/download_pdf/' . $value->id ).'" target="_blank">' .format_invoice_number($value->id). '</a>'; ?></td>
                                                            <td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sales';  ?></td>
                                                            <td><?php echo $value->total; ?></td>
                                                            <td><?php echo _d($value->invoice_date); ?></td>
                                                             <td><?php echo $value->qty; ?></td>
                                                             <td><?php echo $value->rate; ?></td>
                                                          </tr>
                                                          <?php
                                                        }
                                                      ?>
                                                  </tbody>
                                                   <tfoot style="background-color:#e5e7eb;">
                                                     <td colspan="5">Total</td>
                                                     <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                     <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                                   </tfoot>
                                            </table>
                       						        </div>
                 						          </div>
                                        <?php } ?>
   			                            <?php if(!empty($challan_info)){ ?>
                             						<div class="col-md-6">
                                            <div class="table-responsive">
                             						        <h4 class="no-margin text-center">Challan Product Details</h4>
                                                <hr>
                                   							<table class="table pro_tbl">
                                     								<thead>
                                       								  <tr>
                                           									<th>S.No.</th>
                                           									<th>Challan No.</th>
                                           									<th>Service Type</th>
                                           									<th>Date</th>
                                           									<th>Qty</th>
                                       								  </tr>
                                     								</thead>
                                     								<tbody>
                                     								<?php
                                       									$z=1;
                                                         $ttlqty = $qty = 0;
                                       									foreach($challan_info as $value){
                                                               if (!empty($value->product_json) && $value->product_json != ""){
                                                                  $productdata = json_decode($value->product_json);
                                                                  foreach ($productdata as $pro) {
                                                                     if ($pro->product_id == $product_id){
                                                                        $qty = $pro->product_qty;
                                                                     }
                                                                  }
                                                               }
                                                               $ttlqty += $qty;
                                       										?>
                                         										<tr>
                                         											<td><?php echo $z++;?></td>
                                         											<td><?php echo '<a target="_blank" href="' . site_url('admin/chalan/view/' . $value->id). '" >' .$value->chalanno. '</a>'; ?></td>
                                         											<td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sale'; ?></td>
                                         											<td><?php echo _d($value->challandate); ?></td>
                                         											<td><?php echo $qty; ?></td>
                                         										</tr>
                                         										<?php
                                         									}
                                     								?>
                                     								</tbody>
                                                     <tfoot style="background-color:#e5e7eb;">
                                                       <td colspan="4">Total</td>
                                                       <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                     </tfoot>
                                   							</table>
                                            </div>
                         						    </div>
                       						<?php } ?>
   			                            <?php if(!empty($debitnote_info)){ ?>
                           						<div class="col-md-6">
                                          <div class="table-responsive">
                               				        <h4 class="no-margin text-center">Debit Note Product Details</h4>
                                              <hr>
                                 							<table class="table pro_tbl">
                                     								<thead>
                                       								  <tr>
                                           									<th>S.No.</th>
                                           									<th>DN No.</th>
                                           									<th>Amount</th>
                                           									<th>Date</th>
                                           									<th>Qty</th>
                                           									<th>Rate</th>
                                       								  </tr>
                                     								</thead>
                                     								<tbody>
                                       								<?php
                                       									$z=1;
                                                         $ttlqty = $ttlrate = 0;
                                       									foreach($debitnote_info as $value){
                                                           $ttlqty += $value->qty;
                                                           $ttlrate += $value->qty*$value->price;
                                       								?>
                                       										<tr>
                                         											<td><?php echo $z++; ?></td>
                                         											<td><?php echo '<a target="_blank" href="' . admin_url('debit_note/download_pdf/' . $value->id). '" >' .$value->number. '</a>'; ?></td>
                                         											<td><?php echo $value->totalamount; ?></td>
                                         											<td><?php echo _d($value->dabit_note_date); ?></td>
                                                               <td><?php echo $value->qty; ?></td>
                                                               <td><?php echo $value->price; ?></td>
                                       										</tr>
                                       								<?php
                                       									}
                                       								?>
                                   								</tbody>
                                                   <tfoot style="background-color:#e5e7eb;">
                                                     <td colspan="4">Total</td>
                                                     <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                                     <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                                   </tfoot>
                               							  </table>
                                          </div>
                           						</div>
   	                                    <?php } ?>
                     						<?php if(!empty($purchase_info)){ ?>
                     						<div class="col-md-6">
                                     <div class="table-responsive">
                     						        <h4 class="no-margin text-center">PO Product Details</h4>
                                        <hr>
                           							<table class="table pro_tbl">
                         								<thead>
                           								  <tr>
                             									<th>S.No.</th>
                             									<th>PO No.</th>
                             									<th>Amount</th>
                             									<th>Date</th>
                             									<th>Qty</th>
                             									<th>Price</th>
                           								  </tr>
                         								</thead>
                         								<tbody>
                             								<?php
                             									$z=1;
                                               $ttlqty = $ttlrate = 0;
                             									foreach($purchase_info as $value){
                                                   $ttlqty += $value->qty;
                                                   $ttlrate += $value->qty*$value->price;
                             										?>
                             										<tr>
                             											<td><?php echo $z++;?></td>
                             											<td><?php echo '<a target="_blank" href="' . admin_url('purchase/download_pdf/' . $value->id) . '" >' . 'PO-'.$value->number . '</a>'; ?></td>
                             											<td><?php echo $value->totalamount; ?></td>
                             											<td><?php echo _d($value->date); ?></td>
                             											<td><?php echo $value->qty; ?></td>
                             											<td><?php echo $value->price; ?></td>
                             										</tr>
                             										<?php
                             									}
                             								?>
                         								</tbody>
                                         <tfoot style="background-color:#e5e7eb;">
                                           <td colspan="4">Total</td>
                                           <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                           <td><?php echo number_format($ttlrate, 2, '.', ''); ?></td>
                                         </tfoot>
                       							</table>
                                     </div>
                     						</div>
                     						<?php } ?>
   			                        <?php if(!empty($component_info)){ ?>
                         						<div class="col-md-6">
                                        <div class="table-responsive">
                         						        <h4 class="no-margin text-center">Components Details</h4>
                                            <hr>
                               							<table class="table pro_tbl">
                               								<thead>
                                 								  <tr>
                                     									<th>S.No.</th>
                                     									<th>Product Name <small>(In which item is Used)</small></th>
                                     									<th>Qty</th>
                                 								  </tr>
                               								</thead>
                               								<tbody>
                               								<?php
                                 									$z=1;
                                                   $ttlqty = 0;
                                 									foreach($component_info as $value){
                                                     $ttlqty += $value->qty;
                                 							?>
                                 										<tr>
                                 											<td><?php echo $z++;?></td>
                                 											<td><?php echo '<a target="_blank" href="' . admin_url('product_new/view/' . $value->product_id) . '" >' . value_by_id('tblproducts',$value->product_id,'name') . '</a>'; ?></td>
                                                       <td><?php echo $value->qty; ?></td>
                                 										</tr>
                                 							<?php
                                 									}
                               								?>
                               								</tbody>
                                               <tfoot style="background-color:#e5e7eb;">
                                                 <td colspan="2">Total</td>
                                                 <td><?php echo number_format($ttlqty, 2, '.', ''); ?></td>
                                               </tfoot>
                           							  </table>
                                        </div>
                         						</div>
   	                             <?php } ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="revision_details">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Create By</th>
                                                            <th>Create At</th>
                                                            <th>Approved By</th>
                                                            <th>Action</th>         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            if (!empty($revision_details)){
                                                                foreach ($revision_details as $key => $logdata) {
                                                                    $approval_info = $this->db->query("SELECT m.staff_id FROM `tblproductapprovalsend_products` as p RIGHT JOIN `tblmasterapproval` as m ON p.main_id = m.table_id WHERE `m`.`module_id` = '10' AND `p`.`product_id` = ".$logdata->id." AND `m`.`approve_status` = '1' AND `m`.`status` = '1'")->row();
                                                        ?>
                                                                    <tr>
                                                                        <td><?php echo ++$key; ?></td>
                                                                        <td><?php echo get_employee_fullname($logdata->staff_id); ?></td>
                                                                        <td><?php echo _d($logdata->created_at) ?></td>
                                                                        <td><?php echo (!empty($approval_info)) ? get_employee_fullname($approval_info->staff_id) : '--';?></td>
                                                                        <td><a href="javascript:void(0);" onclick="get_productlog_info('<?php echo $logdata->id; ?>')" class="btn-sm btn-info" >View</a></td>
                                                                    </tr>
                                                        <?php            
                                                                }
                                                            }else{
                                                                echo '<tr><td colspan="5" class="col-md-12 text-center">Record not found!</td></tr>';
                                                            } 
                                                        ?>
                                                        <tr></tr>
                                                    </tbody>
                                                </table>    
                                            </div>    
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="productdetailsmodal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content producthtml">

        </div>    
    </div>    
</div>
<?php init_tail(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script>
    init_selectpicker();
</script>
<script>

$(document).ready(function() {
    $('.pro_tbl').DataTable( {

        "iDisplayLength": 15,
        dom: 'Bfrtip'
    } );
} );

function get_productlog_info(productlog_id){
    $.ajax({
        type    : "GET",
        url     : "<?php echo site_url('admin/product_new/getproductlogdetails/'); ?>"+productlog_id,
        success : function(data){
            if(data != ''){
                $('#productdetailsmodal').modal({
                    show: 'false'
                });
                $('.producthtml').html(data);
                $(".productdetailsbtn").html('<button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
            }
        }
    });
}
</script>

</body>
</html>
