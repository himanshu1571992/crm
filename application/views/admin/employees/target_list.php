<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}</style>
<style>
    .our-team-main
{
	width:100%;
	height:auto;
	border-bottom:5px #323233 solid;
	background:#fff;
	text-align:center;
	border-radius:10px;
	overflow:hidden;
	position:relative;
	transition:0.5s;
	margin-bottom:28px;
}


.our-team-main img
{
	border-radius:50%;
	margin-bottom:20px;
	width: 90px;
}

.our-team-main h3
{
	font-size:20px;
	font-weight:700;
}

.our-team-main p
{
	margin-bottom:0;
}

.team-back
{
	width:100%;
	height:auto;
	position:absolute;
	top:0;
	left:0;
	padding:5px 15px 0 15px;
	text-align:left;
	background:#fff;
	
}

.team-front
{
	width:100%;
	height:auto;
	position:relative;
	z-index:10;
	background:#fff;
	padding:15px;
	bottom:0px;
	transition: all 0.5s ease;
}

/*.our-team-main:hover .team-front
{
	bottom:-200px;
	transition: all 0.5s ease;
}

.our-team-main:hover
{
	border-color:#777;
	transition:0.5s;
}*/

/*our-team-main*/
</style>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div>
                            <div class="tab-content">
                                <h4 class="customer-profile-group-heading">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <?php echo isset($title) ? $title : ""; ?>
                                            </div>
                                            <div class="col-md-8">
                                                <form method="post" id="target_form" action="<?php echo site_url($this->uri->uri_string()); ?>">
                                                    <div class="col-md-2">
                                                        <a href="javascript:void(0);" class="search_by" data-value="date" style="font-size:12px;">Search By Date</a>
                                                    </div>
                                                    <?php
                                                    if($check_staff_id > 0){
                                                    ?>
                                                    <div class="form-group col-md-3">
                                                        <select class="form-control selectpicker" id="staff_id" name="staff_id">
                                                            <option value=""></option>
                                                            <?php
                                                                foreach ($employee_list as $value) {
                                                                    $select_cls = (isset($staff_id) && $staff_id == $value->staff_id) ? "selected" : "";
                                                                    echo '<option value="'.$value->staff_id.'" '.$select_cls.' >'.get_employee_name($value->staff_id).'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <?php    
                                                    }
                                                    ?>
                                                    
                                                    <div class="month_div">
                                                        <div class="form-group col-md-2">
                                                            <select class="form-control" id="year" name="year">
                                                                <option value="" disabled selected >--Select One-</option>
                                                                <?php
                                                                $j = date('Y');
                                                                for ($i = 2017; $i <= $j; $i++) {
                                                                    ?>
                                                                    <option value="<?php echo $i; ?>" <?php
                                                                    if (!empty($year) && $year == $i) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>  ><?php echo $i; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <select class="form-control selectpicker" multiple data-live-search="true" id="month" name="month_arr[]">
                                                                <option value="" disabled >--Select One-</option>
                                                                <?php
                                                                if (!empty($month_info)) {
                                                                    foreach ($month_info as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row->id; ?>" <?php
                                                                        if (!empty($month_arr) && in_array($row->id, $month_arr)) {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>  ><?php echo $row->month_name; ?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="date_div" style="display:none;">
                                                        <div class="form-group col-md-2" app-field-wrapper="date">
                                                            <div class="input-group date">
                                                                <input id="f_date" name="f_date" class="form-control datepicker" placeholder="from date" value="<?php echo (!empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2" app-field-wrapper="date">
                                                            <div class="input-group date">
                                                                <input id="t_date" name="t_date" class="form-control datepicker" placeholder="to date date" value="<?php echo (!empty($t_date)) ? $t_date : "";?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-2">                            
                                                        <input type="hidden" name="search_by" class="search_filter" value="month">
                                                        <button type="submit" class="btn btn-info">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center text-success" style="margin-bottom: 20px; "><h3 class="total_archived_amt" style="margin-top: 5px; ">Overall Achieved Percent : 0.00 %</h3></div>
                                        </div>
                                    </div>
                                    <?php
                                        $ttl_target_amt = 0;
                                        $ttl_archive_amt = 0;
                                        
                                        $ttl_achived_percent = 0;
                                        foreach ($month_arr as $month) {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            <h2 class="text-danger"><?php echo value_by_id("tblmonths", $month, "month_name"); ?></h2>
                                                        </div>
                                                        <hr>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <?php
                                                        $f_date = (!empty($f_date)) ? $f_date : "";
                                                        $t_date = (!empty($t_date)) ? $t_date : "";
                                                            $ttl_monthly_percent = 0;
                                                            $ttlmonthlytarget = 0;
                                                            $ttlmonthlyarchive = 0;
                                                            $invoice_ids = "0";
                                                            $ttlmonth_target_amt = 0;
                                                            $ttlmonth_archive_amt = 0;
                                                            $productcategory = "";
                                                            $msg = "<div class='col-lg-12' style='text-align:center; margin-top:10%; margin-bottom:10%'>Record Not Found</div>";
                                                            if (isset($employee_target) && !empty($employee_target)) {
                                                                $msg = "";
                                                                foreach ($employee_target as $key => $value) {
                                                                    $productcategory .= ($key == 0) ? $value->product_category_id:",".$value->product_category_id;
                                                                    
                                                                    $monthly_amt = $this->Employee_model->getEmployeeMonthlyTarget($value->staff_id, $value->product_category_id, $month, $year);

                                                                    $getSaffArchiveTargetAmount = getSaffArchiveTargetAmount($value->staff_id, $month, $year, $value->product_category_id, $f_date, $t_date, "", "2", $invoice_ids);
                                                                    
                                                                    $achieved_percent = ($monthly_amt > 0) ? ($getSaffArchiveTargetAmount / $monthly_amt * 100) : 0;
                                                                    $ttl_monthly_percent += $achieved_percent;
                                                                    $ttl_target_amt += $getSaffArchiveTargetAmount;
                                                                    $ttlmonthlytarget += $getSaffArchiveTargetAmount;
                                                                    $ttl_archive_amt += $monthly_amt;
                                                                    $ttlmonthlyarchive += $monthly_amt;
                                                                    $ttlmonth_target_amt += $monthly_amt;
                                                                    $ttlmonth_archive_amt += $getSaffArchiveTargetAmount;
                                                                    ?>
                                                                    <!--team-1-->
                                                                    <div class="col-lg-4">
                                                                        <div class="our-team-main">
                                                                            <div class="team-front">
                                                                                <!--<img src="http://placehold.it/250x250/4caf50/fff?text=<?php echo $value->amount; ?>" class="img-fluid" />-->
                                                                                <h3 class="label label-primary product-category"><?php echo cc(value_by_id_empty('tbldivisionmaster',$value->product_category_id,'title')); ?></h3>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <p>Monthly Target Amount : <span class="label label-success"><?php echo number_format($monthly_amt, 2); ?></span></p>
                                                                                <br>
                                                                                <p>Achieved Target Amount : <span class="label label-warning"><?php echo $getSaffArchiveTargetAmount; ?></span></p>
                                                                                <br>
                                                                                <p class="label label-info">Achieved <?php echo number_format($achieved_percent, 2, '.', ''); ?>%</p>
                                                                            </div>
                                                                            <div class="team-back">
                                                                                <span><?php echo cc($value->remark); ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <p class="label label-info"><a target="_blank" href="<?php echo admin_url('employees/achievedTargetInvoiceList/' . $value->staff_id . '/' . $month . '/' . $year . '/' . $value->product_category_id . '?f_data=' . $f_date . '&t_date=' . $t_date. '&invoice_ids=' . $invoice_ids); ?>">Achieved Invoice List</a></p>
                                                                    </div>
                                                                    <!--team-1-->
                                                                <?php
                                                                    $invoiceids = getArchiveInvoiceids($value->staff_id, $month, $year, $value->product_category_id, $f_date, $t_date);
                                                                    //if($invoiceids != "" && $invoiceids > 0){
                                                                        $invoice_ids .= ",".$invoiceids;
                                                                   // }
                                                                }
                                                            } 
                                                            
                                                            /*echo $staff_id.'<br>';
                                                            echo $month.'<br>';
                                                            echo $year.'<br>';
                                                            echo $f_date.'<br>';
                                                            echo $t_date.'<br>';
                                                            echo $productcategory.'<br>';
                                                            echo $invoice_ids.'<br>';*/
                                                            $chkothertargetamount = getSaffArchiveTargetAmount($staff_id, $month, $year, "", $f_date, $t_date, $productcategory, "2", $invoice_ids);
                                                            if ($chkothertargetamount > 0.00){
                                                                
                                                                /*$invoiceids = getArchiveInvoiceids($staff_id, $month, $year, "", $f_date, $t_date, $productcategory, "2");
                                                                if($invoiceids != ""){
                                                                    $invoice_ids .= ",".$invoiceids;
                                                                }*/
                                                                $msg = "";
                                                                $f_date = (!empty($f_date)) ? $f_date : "";
                                                                    $t_date = (!empty($t_date)) ? $t_date : "";
                                                                    $achieved_percent = ($chkothertargetamount > 0) ? ($chkothertargetamount / $chkothertargetamount * 100) : 0;
                                                                    //$ttl_monthly_percent += $achieved_percent;
                                                                    $monthly_amt = $chkothertargetamount;
                                                                    $ttl_archive_amt += $chkothertargetamount;
                                                                    $ttlmonth_archive_amt += $chkothertargetamount;
                                                            ?>
                                                                    
                                                                    <div class="col-lg-4" style="margin-top:18px;">
                                                                        <div class="our-team-main">
                                                                            <div class="team-front">
                                                                                <h3 class="label label-primary"><?php echo "Other Achievement"; ?></h3>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <!--<p>Monthly Target Amount : <span class="label label-success"><?php echo number_format($monthly_amt, 2); ?></span></p>-->
                                                                                <br>
                                                                                <p>Achieved Target Amount : <span class="label label-warning"><?php echo $chkothertargetamount; ?></span></p>
                                                                                <br>
                                                                                <!--<p class="label label-info">Achieved <?php echo number_format($achieved_percent, 2, '.', ''); ?>%</p>-->
                                                                            </div>
                                                                            <div class="team-back">
                                                                                <span><?php echo "Orther Product Target Archived"; ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <p class="label label-info"><a target="_blank" href="<?php echo admin_url('employees/achievedTargetInvoiceList/' . $value->staff_id . '/' . $month . '/' . $year . '/0?f_data=' . $f_date . '&t_date=' . $t_date. '&orthercategoryid=' . $productcategory. '&invoice_ids=' . $invoice_ids); ?>">Achieved Invoice List</a></p>
                                                                    </div>
                                                            <?php
                                                                $invoiceids = getArchiveInvoiceids($staff_id, $month, $year, "", $f_date, $t_date, $productcategory, "2");
                                                                //if($invoiceids != "" && $invoiceids > 0){
                                                                    $invoice_ids .= ",".$invoiceids;
                                                                //}        
                                                            }
                                                            $chkrentinvoiceamount = getSaffArchiveTargetAmount($staff_id, $month, $year, "", $f_date, $t_date, "", "1", $invoice_ids);
                                                            if ($chkrentinvoiceamount > 0.00){
                                                                $msg = "";
                                                                $f_date = (!empty($f_date)) ? $f_date : "";
                                                                $t_date = (!empty($t_date)) ? $t_date : "";
                                                                $procategory = "";
                                                                $ttlmonth_archive_amt += $chkrentinvoiceamount;
                                                                
                                                            ?>
                                                                    
                                                                    <div class="col-lg-4" style="margin-top:18px;">
                                                                        <div class="our-team-main">
                                                                            <div class="team-front">
                                                                                <h3 class="label label-primary"><?php echo "Rent Invoice Details"; ?></h3>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <p>Achieved Target Amount : <span class="label label-warning"><?php echo $chkrentinvoiceamount; ?></span></p>
                                                                                <br>
                                                                                
                                                                            </div>
                                                                            <div class="team-back">
                                                                                <span><?php echo "Rent Invoice Details"; ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <p class="label label-info"><a target="_blank" href="<?php echo admin_url('employees/achievedTargetInvoiceList/' . $staff_id . '/' . $month . '/' . $year . '/0?f_data=' . $f_date . '&t_date=' . $t_date. '&orthercategoryid=' . $procategory. '&service_type=1'. '&invoice_ids=' . $invoice_ids); ?>">Achieved Invoice List</a></p>
                                                                    </div>
                                                            <?php        
                                                            }
                                                            
                                                            echo $msg;
                                                            
                                                        ?>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <?php
                                                            // $totalmonthlypercent = ($ttlmonthlyarchive > 0) ? ($ttlmonthlytarget / $ttlmonthlyarchive * 100) : 0;
                                                            // if ($totalmonthlypercent > 0) {
                                                            //     echo '<div class="label-warning col-lg-3" style="margin-top: 20px; "><p style="margin-top: 5px; ">Overall Monthly Percent : ' . number_format($totalmonthlypercent, 2, '.', '') . '%</p></div>';
                                                            // }
                                                            $finalmonthlypercent = ($ttlmonth_archive_amt > 0) ? ($ttlmonth_archive_amt/$ttlmonth_target_amt) * 100 : 0;
                                                            if ($finalmonthlypercent > 0) {
                                                                echo '<div class="label-warning col-lg-3" style="margin-top: 20px; "><p style="margin-top: 5px; ">Overall Monthly Percent : ' . number_format($finalmonthlypercent, 2, '.', '') . '%</p></div>';
                                                            }
                                                            // if ($ttl_monthly_percent > 0) {
                                                            //     echo '<div class="label-warning col-lg-3" style="margin-top: 20px; "><p style="margin-top: 5px; ">Overall Monthly Percent : ' . number_format($ttl_monthly_percent, 2, '.', '') . '%</p></div>';
                                                            // }
                                                        ?>
                                                    </div>
                                                 </div>
                                            </div>
                                                 
                                        </div>
                                        </br>
                                    <?php
                                            $ttl_achived_percent += $finalmonthlypercent;
                                        }
                                        
                                        if ($ttl_achived_percent > 0){
                                            $ttl_achived_percent = ($ttl_achived_percent/count($month_arr));
                                        }
                                        // $overall_percent = ($ttl_archive_amt > 0) ? ($ttl_target_amt/ $ttl_archive_amt * 100) : 0;
                                    ?>
                                        <!-- <input type="hidden" id="achived_percent" value="<?php echo number_format($overall_percent, 2, '.', ''); ?>"> -->    
                                        <input type="hidden" id="achived_percent" value="<?php echo number_format($ttl_achived_percent, 2, '.', ''); ?>">    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">
    
    var achived_percent = $("#achived_percent").val();
    $(".total_archived_amt").html("Overall Achieved Percent : "+ achived_percent +"%");
    
    var search = "<?php echo (isset($search_by) && !empty($search_by)) ? $search_by:"month"; ?>";
    if (search == "date"){
        $(".search_by").data("value", "month");
        $(".date_div").show();
        $(".month_div").hide();
        $(".search_by").html("Search By Month");
        $(".search_filter").val("date");
    }else{
        $(".search_by").data("value", "date");
        $(".date_div").hide();
        $(".month_div").show();
        $(".search_by").html("Search By Date");
        $(".search_filter").val("month");
    }
    $(document).on("click", ".search_by",function(){
        var search_by = $(this).data("value");
        if (search_by == "date"){
            $(this).data("value", "month");
            $(".date_div").show();
            $(".month_div").hide();
            $(this).html("Search By Month");
            $(".search_filter").val("date");
        }else{
            $(this).data("value", "date");
            $(".date_div").hide();
            $(".month_div").show();
            $(this).html("Search By Date");
            $(".search_filter").val("month");
        }
    });
</script>
</body>
</html>
