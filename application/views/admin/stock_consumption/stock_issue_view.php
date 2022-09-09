<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;} 
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        /*width:inherit;*/ /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }
    
    
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.40rem
}

.img-sm {
    width: 80px;
    height: 80px
}

.itemside .info {
    padding-left: 15px;
    padding-right: 7px
}

.table-shopping-cart .price-wrap {
    line-height: 1.2
}

.table-shopping-cart .price {
    font-weight: bold;
    margin-right: 5px;
    display: block
}

.text-muted {
    color: #969696 !important
}

a {
    text-decoration: none !important
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 0px
}

.itemside {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%
}

.dlist-align {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex
}

[class*="dlist-"] {
    margin-bottom: 5px
}

.coupon {
    border-radius: 1px
}

.price {
    font-weight: 600;
    color: #212529
}

.btn.btn-out {
    outline: 1px solid #fff;
    outline-offset: -5px
}

.btn-main {
    border-radius: 2px;
    text-transform: capitalize;
    font-size: 15px;
    padding: 10px 19px;
    cursor: pointer;
    color: #fff;
    width: 100%
}

.btn-light {
    color: #ffffff;
    background-color: #F44336;
    border-color: #f8f9fa;
    font-size: 12px
}

.btn-light:hover {
    color: #ffffff;
    background-color: #F44336;
    border-color: #F44336
}

.btn-apply {
    font-size: 11px
}
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

            <form action="<?php echo admin_url('stock_consumption/stock_approval') ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card label-info">
                                                <div class="card-body ">
                                                    <label for="service_type" class="control-label" style="font-size:18px"> Service Type :</label>
                                                    <div class="form-group">
                                                        <?php
                                                        if (isset($stock_info) && !empty($stock_info)) {
                                                            echo ($stock_info->service_type == 1) ? "Rent" : "Sale";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card label-info">
                                                <div class="card-body ">
                                                    <label for="challan_no" class="control-label" style="font-size:18px"> Warehouse :</label>
                                                    <div class="form-group">
                                                        <?php
                                                        if (isset($stock_info)) {
                                                            echo value_by_id("tblwarehouse", $stock_info->warehouse_id, "name");
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card label-info">
                                                <div class="card-body ">
                                                    <label for="challan_no" class="control-label" style="font-size:18px"> Remark :</label>
                                                    <div class="form-group">
                                                        <?php echo (isset($stock_info)) ? $stock_info->remark : "--"; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card label-info">
                                                <div class="card-body ">
                                                    <label for="challan_no" class="control-label" style="font-size:18px"> Added By :</label>
                                                    <div class="form-group">
                                                        <?php echo (isset($stock_info)) ? get_employee_fullname($stock_info->staff_id) : "--"; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>    
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <aside class="col-lg-12">
                                            <h3>Product Issued</h3>
                                            <hr>
                                            <br>
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-shopping-cart">
                                                        <thead class="text-muted">
                                                            <tr class="small text-uppercase">
                                                                <th scope="col">Product</th>
                                                                <!--<th scope="col" width="150">Available Qty</th>-->
                                                                <th scope="col" width="150">Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if (!empty($stock_details)){
                                                                    foreach ($stock_details as $value) {
                                                                        $pro_img = value_by_id_empty("tblproducts", $value->product_id, "photo");
                                                                        $product_img = base_url('assets/images/no_image_available.jpeg');
                                                                        if(!empty($pro_img) && $pro_img != "--"){
                                                                            $product_img = base_url('uploads/product') . "/" . $pro_img;
                                                                        }
                                                            ?>
                                                                    <tr>
                                                                        <td>
                                                                            <figure class="itemside align-items-center">
                                                                                <!--<div class="aside"><img src="https://i.imgur.com/1eq5kmC.png" class="img-sm"></div>-->
                                                                                <div class="aside"><img src="<?php echo $product_img; ?>" class="img-sm"></div>
                                                                                <figcaption class="info"> <a target="_blank" href="<?php echo site_url("admin/product_new/view/".$value->product_id); ?>" class="title text-dark" data-abc="true"><?php echo value_by_id("tblproducts", $value->product_id, "name")?></a>
                                                                                    <p class="text-muted ">Pro ID: <?php echo $value->pro_id; ?> <br> Remark: <?php echo ($value->remark) ? $value->remark : "--"; ?></p>
                                                                                </figcaption>
                                                                            </figure>
                                                                        </td>
<!--                                                                        <td>
                                                                            <div class="price-wrap"> <var class="price"><?php echo $value->available_qty; ?></var> </div>
                                                                        </td>-->
                                                                        <td>
                                                                            <div class="price-wrap"> <var class="price"><?php echo $value->qty; ?></var> </div>
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
                                        </aside>
                                    </div>
                                </div>    
                            </div>    
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

</body>
</html>