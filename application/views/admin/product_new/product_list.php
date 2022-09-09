<?php init_head(); ?>

<?php
if(!empty($this->session->userdata('product_search'))){
    $search_arr = $this->session->userdata('product_search');
}
?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">
                        <div class="_buttons">
                            <!-- <a href="<?php echo admin_url('product_new/action_pending'); ?>" class="btn btn-info mright5 test pull-left display-block">Action Pending</a> -->
                            <?php
                            if(check_permission_page(295,'create') ){
                                ?>
                                    <a href="<?php echo admin_url('product_new/product'); ?>" class="btn btn-info mright5 test pull-left display-block">
                                        <?php echo _l('new_product'); ?>
                                    </a>

                                    <!-- <a href="<?php echo admin_url('product_new/product_for_delete'); ?>" class="btn btn-info mright5 test pull-left display-block">Product For Deletet</a> -->

                                    <!-- <a href="<?php echo admin_url('product_new/product_merge'); ?>" class="btn btn-info mright5 test pull-left display-block">Merge Product</a> -->
                                    <a href="<?php echo admin_url('product_new/export_product'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Export</a>
                                <?php
                            }
                            ?>

                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                        </div>






                    <div class="row"  style="margin-top: 30px;">
                        <?php echo form_open($this->uri->uri_string(), array('id' => 'product_form', 'class' => 'product-form')); ?>
                          <div class="col-md-12">
                            <hr class="hr-panel-heading">
                            <div class="form-group col-md-3">
                                <select class="form-control selectpicker" id="product_cat_id" name="category_id" data-live-search="true">
                                    <option value="" selected >--Select Category-</option>
                                    <?php
                                    if(!empty($category_list)){
                                        foreach($category_list as $row){
                                            ?>
                                            <option value="<?php echo $row->id;?>" <?php if(!empty($search_arr["category_id"]) && $search_arr["category_id"] == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control selectpicker" id="product_sub_cat_id" name="sub_category_id" data-live-search="true">
                                    <option value="" selected >--Select Sub Category-</option>
                                    <?php
                                    if(!empty($sub_category_list)){
                                        foreach($sub_category_list as $row){
                                            ?>
                                            <option value="<?php echo $row->id;?>" <?php if(!empty($search_arr["sub_category_id"]) && $search_arr["sub_category_id"] == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control selectpicker" id="parent_category_id" name="parent_category_id" data-live-search="true">
                                    <option value="" selected >--Select Parent Category-</option>
                                    <?php
                                    if(!empty($parent_category_list)){
                                        foreach($parent_category_list as $row){
                                            ?>
                                            <option value="<?php echo $row->id;?>" <?php if(!empty($search_arr["parent_category_id"]) && $search_arr["parent_category_id"] == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control selectpicker" id="child_category_id" name="child_category_id" data-live-search="true">
                                    <option value="" selected >--Select Child Category-</option>
                                    <?php
                                    if(!empty($child_category_list)){
                                        foreach($child_category_list as $row){
                                            ?>
                                            <option value="<?php echo $row->id;?>" <?php if(!empty($search_arr["child_category_id"]) && $search_arr["child_category_id"] == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group col-md-3">
                                  <select class="form-control selectpicker" id="is_varified" name="is_varified" data-live-search="true">
                                      <option value="" selected >--Select Status--</option>
                                      <option value="1" <?php echo (isset($search_arr["is_varified"]) && $search_arr["is_varified"] == 1) ? 'selected':''; ?>>Verified</option>
                                      <option value="0" <?php echo (isset($search_arr["is_varified"]) && $search_arr["is_varified"] == 0) ? 'selected':''; ?>>Unverified</option>
                                  </select>
                              </div>
                              <div class="col-md-3">
                                 <input type="text" name="product_name" class="form-control" placeholder="product name" value="<?php echo (!empty($search_arr["product_name"])) ? $search_arr["product_name"] : ''; ?>">
                              </div>
                              <div class="col-md-3">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                         <span id="prefix">PRO-</span>
                                      </span>
                                      <input type="text" name="pro_id" id="pro_id" class="form-control" value="<?php echo (isset($search_arr["pro_id"])) ? $search_arr["pro_id"]:''; ?>">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <button type="submit" class="btn btn-info">Search</button>
                                  <!-- <a class="btn btn-danger " href="" style="margin-left: 20px">Reset</a> -->
                                  <button type="submit" value="1" name="reset" class="btn btn-danger">Reset</button>
                              </div>
                          </div>

                      <?php echo form_close(); ?>

                        <div class="">


                            <div class="col-md-12 table-responsive">

                            <div class="row" style="margin-top: 15px;">
                            <div class="col-md-4">
                                <h4 style="color: red;">Verified Product : <?php echo $verify_count; ?></h4>
                            </div>
                            <div class="col-md-4">
                                <h4 style="color: red;">Unverified Product : <?php echo $unverify_count; ?></h4>
                            </div>
                            </div>
                                <table class="table" id="newtable" style="margin-top: 30px;">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Pro ID</th>
                                        <th>Unit</th>
                                        <th>Category</th>
                                        <th>Picture</th>
                                        <th>Status</th>
                                        <th>Verified</th>
                                        <th>Date Created</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    $i = (isset($page) && $page == 0) ? 1 : $page+1;
                                    if(!empty($product_data)){
                                        foreach($product_data as $aRow){

                                            $url = admin_url('product_new/product/' . $aRow['id']);
                                            $viewurl = admin_url('product_new/view/' . $aRow['id']);
                                            $detail_url = admin_url('product_new/product_used/' . $aRow['id']);
                                            $inspection_url = admin_url('product_new/product_inspection/' . $aRow['id']);

                                            $img_url = base_url('assets/images/no_image_available.jpeg');
                                            if($aRow['photo'] != "") {
                                                $img_url = base_url('uploads/product') . "/" . $aRow['photo'];
                                            }

                                            if($aRow['is_varified'] == 1){
                                                $is_varified = '<button disabled="" class="btn-sm btn-success">Verified</button>';
                                            }else{
                                                $is_varified = '<button disabled="" class="btn-sm btn-danger">Pending</button>';
                                            }

                                            $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
                                            $toggleActive = '<div class="onoffswitch">
                                                <input type="checkbox" data-switch-url="' . admin_url() . 'product_new/change_product_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
                                                <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
                                            </div>';

                                            $name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';
                                            $name_html .= '<div class="row-options">';
                                            $name_html .= '<a target="_blank" href="' . $viewurl . '">' . _l('view') . '</a>';
                                            $name_html .= ' | <a target="_blank" href="' . $detail_url . '">Details</a>';
                                            if(check_permission_page(2,'delete') ){
                                                $name_html .= ' | <a href="' . admin_url('product_new/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
                                            }
                                            $name_html .= ' | <a target="_blank" href="' . $inspection_url . '">Inspection Details</a>';
                                            $name_html .= '</div>';
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $name_html; ?></td>
                                                <td><?php echo "PRO-" .number_series($aRow['id']); ?></td>
                                                <td><?php echo cc(value_by_id('tblunitmaster',$aRow['unit_2'],'name'));?></td>
                                                <td><?php echo cc(value_by_id('tblproductcategory',$aRow['product_cat_id'],'name'));?></td>
                                                <td><?php echo '<img src="' . $img_url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="' . cc($aRow['name']) . '" />';?></td>
                                                <td><?php echo $toggleActive;?></td>
                                                <td><?php echo $is_varified;?></td>
                                                <td><?php echo _d($aRow['created_at']);?></td>
                                              </tr>
                                            <?php
                                        }
                                    }
                                    ?>


                                    </tbody>
                                  </table>
                                  <div class="pagination pull-right">
                                      <?php echo $this->pagination->create_links(); ?>
                                  </div>
                            </div>




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

$(document).ready(function() {
    // $('#newtable1').DataTable( {
    //
    //     "iDisplayLength": 25,
    //     dom: 'Bfrtip',
    //     lengthMenu: [
    //         [ 10, 25, 50, -1 ],
    //         [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    //     ],
    //     buttons: [
    //         'pageLength',
    //         {
    //             extend: 'excel',
    //             exportOptions: {
    //                 columns: [ 0, 1, 2, 3, 4]
    //             }
    //         },
    //         {
    //             extend: 'pdf',
    //             exportOptions: {
    //                  columns: [ 0, 1, 2, 3, 4]
    //             }
    //         },
    //         {
    //             extend: 'print',
    //             exportOptions: {
    //                 columns: [ 0, 1, 2, 3, 4]
    //             }
    //         },
    //         'colvis',
    //     ]
    // } );

    // $(document).on("change", "#product_cat_id,#product_sub_cat_id,#parent_category_id,#child_category_id", function(){
    //   // $("#product_form").submit();
    //    var parentForm = $(this).closest("form");
    //    if (parentForm && parentForm.length > 0){
    //       parentForm.submit();
    //    }
    //
    // });
} );



</script>
</body>
</html>
