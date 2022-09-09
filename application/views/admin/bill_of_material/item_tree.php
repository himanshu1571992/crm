<?php init_head(); ?>

<style>
ul.tree, ul.tree ul {
    list-style: none;
     margin: 0;
     padding: 0;
   } 
  
   ul.tree li {
        margin-bottom: 20px;
     padding: 0 7px;
     line-height: 20px;
     color: #369;
     font-weight: bold;
     /*border-left:1px solid #415165;*/

   }
   ul.tree li:last-child {
       border-left:none;
   }
ul.tree li:before {
    position: relative;
    top: -0.3em;
    /* height: 2em; */
    width: 12px;
    color: white;
    /* border-bottom: 1px solid #415165; */
    content: "";
    display: none;
    left: -7px;
}
   /*ul.tree li:last-child:before {
      border-left:1px solid #415165;   
   }*/
ul.tree h4 {
    display: inline-block;
    color: #fff;
    /* border: 1px solid; */
    padding: 10px 15px;
    /* border-radius: 20px; */
    font-size: 17px;
    box-shadow: 0px 3px 8px #ccc;
    background: #FF9800;
    display: block;
    margin: 0;
}
  ul.tree ul li b{
	color:#415165;
  }
ul.tree ul {
    background: #f6f6f6;
    padding: 10px 0px;
    box-shadow: 0px 3px 7px #ccc;
}
ul.tree ul li {
    margin: 0;
    padding: 6px 15px;
    line-height: 20px;
    color: #369;
    font-weight: bold;
	font-size:14px;
    /* border-left: 1px solid #415165; */
}
</style>

<div id="wrapper">
    <div class="content accounting-template">
		<a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

           <form action="<?php echo admin_url('bill_of_material/availability'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
           
			<div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Bill Of Material (Item Tree)</h4>
                                <hr/>


                               <ul class="tree">



                                <?php
                                if(!empty($product_data)){
                                    $p_arr = array();
                                    foreach ($product_data as $key => $value) {
                                        //For HTML Print
                                        global $id_arr;
                                        echo createTreeView($value['productid'],$id_arr);
                                       
                                    }

                                     /*echo '<pre/>';
                                     print_r($p_arr);*/
                                }
                                ?>

                            

                               </ul>


                            </div>
							
							
							<div class="ee"></div>
							<div class="eeff"></div>
                        </div>

              <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>">          
              <input type="hidden" name="service_type" value="<?php echo $service_type; ?>">  
              <?php
                if(!empty($pro_data)){
                  foreach ($pro_data as $key => $value) {                  
                    echo '<input type="hidden" name="product_info[]" value="'.$value['product_qty'].'">';
                  }
                }
              ?>        
                      


                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info check_availability" type="submit">
                                <?php echo _l('check_availability'); ?>
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

</body>
</html>