<!DOCTYPE html>
<html lang="en">
    <head id="non-printable">
        <style>
            .card {
              box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
              transition: 0.3s;
              padding: 25px;
              /*width: 20%;*/
              /*border-radius: 50%;*/
            }

            .card:hover {
              box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            }


            .bill-head {
                color: #ffffff;
                font-weight: bold;
                margin-bottom: 0px;
                margin-top: 0px;
                font-size: 30px
            }

            .line {
                border-right: 1px grey solid
            }

            .bill-date {
                color: #BDBDBD
            }


            .red-bg {
                margin-top: 25px;
                margin-left: 0px;
                margin-right: 0px;
                background-color: #F44336;
                padding-left: 20px !important;
                padding: 25px 10px 25px 15px
            }

            #total {
                margin-top: 0px;
                padding-left: 7px
            }

            #total-label {
                margin-bottom: 0px;
                color: #ffffff;
                padding-left: 7px
            }
            @media print
            {
                #non-printable { display: none; }
                #printable { display: block; }
            }
        </style>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    </head>
    <body onload="printdiv()">
        <div id="wrapper" style="margin-left: 1%;margin-right: 1%;">
            <div id="printable" class="content accounting-template">
                <div class="btn-bottom-pusher"></div>
                <?php
                if (!empty($product_details)) {
                    ?>
                    <div class="row" id="divToPrint"> 
                        <div class="col-md-12">
                            <h3 style="text-align: center"><?php echo $title; ?></h3>
                            <div class="col-lg-3 pull-right" style="margin-left: 75%">
                                <div class="red-bg" style="border-radius: 60px; margin-bottom: 15px;">
                                    <p class="bill-date" id="total-label">Total Product Costing Price</p>
                                    <h2 class="bill-head" id="total"><i class="fa fa-rupee"></i><?php echo $ttl_final_price; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel_s">
                                <div class="panel-body" style="page-break-after: always;">
                                    <?php
                                    foreach ($product_details as $key => $value) {
                                        $material_grade = $this->db->query("SELECT * FROM `tblmaterialgrade` WHERE `id`='" . $value->product_grade_id . "' ")->row();
                                        ?>
                                    <div class="card label-info" >
                                            <div class="card-body ">
                                                <div class="col-md-12">
                                                    <div class="row" >
                                                        <div class="col-sm-6">
                                                            <h4 class="card-title" style="font-size:15px;">Product Information</h4>
                                                            <div class="row"></div>
                                                            <hr/>
                                                            <div class="card label-info">
                                                                <div class="card-body ">
                                                                    <div class="card-text">
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Product Category</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo value_by_id("tblproductcategory", $value->product_category_id, "name"); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Product Name</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo value_by_id("tblproducts", $value->product_id, "name"); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Product Grade (In MM)</label>
                                                                            <div class="col-sm-6">
                                                                                <?php
                                                                                if (!empty($material_grade)) {
                                                                                    echo cc($material_grade->title) . " (" . $material_grade->thickness . ")";
                                                                                }
                                                                                ?>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Pipe Type</label>
                                                                            <div class="col-sm-6">
                                                                                <?php
                                                                                if ($value->pipe_type == 1) {
                                                                                    echo "Coil Pipe";
                                                                                } elseif ($value->pipe_type == 2) {
                                                                                    echo "Non Coil Pipe";
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Product Qty</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->qty; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h4 class="card-title col-sm-5" style="font-size:15px;">Costing Details</h4>

                                                            <hr/>
                                                            <div class="card label-info">
                                                                <div class="card-body ">
                                                                    <div class="card-text">
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Weight :</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->weight; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Total RM Cost</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->raw_material_cost; ?> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Process Cost</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->process_cost; ?> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Transport cost</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->transport_cost; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Loading charges</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->loading_charges; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">OHP</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->over_head_profit; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="inputPassword" class="col-sm-6 col-form-label">Final Price</label>
                                                                            <div class="col-sm-6">
                                                                                <?php echo $value->final_price; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <p></p>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
    </body>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript"> 
        function printdiv(){
           window.print();
           setTimeout("closePrintView()", 3000);
        }
        function closePrintView() {
            document.location.href = "<?php echo admin_url(); ?>product_new/product_calculator";
        }
    </script>
</body>
</html>
