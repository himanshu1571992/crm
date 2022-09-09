<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport"  content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/02cb9ab8ae.js" crossorigin="anonymous"></script>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
<link rel= "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css"/>
  
        <style type="text/css">

            body{
                font-family: 'Nunito', sans-serif;
            }

            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .wrapper{
                padding: 30px;
            }

            .container{
                border: 1px solid #dfdfdf;
                padding-top: 15px;
                padding-bottom: 15px;
                border-radius: 5px;
                box-shadow: 0px 0px 5px #e3e3e3;
            }

            .topHead h2{
                font-weight: 900;
                text-transform: capitalize;
                margin-bottom: 30px;
            }

            .form-group {
                margin-bottom:0;
            }

            .form-control {
                height: 42px;
                border-radius: 0;
                margin-bottom: 5px;
            }

            textarea.form-control {
                height: 107px;
            }

            .sectionHeading {
                font-weight: 900;
                font-size: 24px;
                text-decoration: underline;
                margin-bottom: 15px;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: none;
                background: #243C52;
                color: #fff;
            }

            .table{
                width: 99.6%;
            }

            .table td {
                border: 1px solid #e9e9e9;
            }

            .bg-gray{
                background: #fafafa;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .addMore {
                background: #2196F3;
                color: #fff;
                padding: 6px 10px;
                border-radius: 30px;
                margin-bottom: 10px;
                display: inline-block;
                cursor: pointer;
            }

            .addMore:hover{
                color: #fff;
                text-decoration: none;
            }

            input.save-btn {
                padding: 8px 40px;
                border: none;
                border-radius: 50px;
                margin-top: 20px;
                background: #49be4e;
                color: #fff;
                font-weight: 900;
                cursor: pointer;
            }
            #errmsg
            {
                color: red;
            }
            #errmsg1
            {
                color: red;
            }

        </style>
    </head>

    <body>
        <section class="wrapper">

            <div class="container">

                <div class="row ">
                    <div class="col-12 text-center topHead">
                        <img width="150" height="50" src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" class="logo">
                        <h2><?php echo $title; ?></h2>
                    </div>
                </div>
                <?php
                    if (isset($message)){
                        echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
                    }
                ?>
                <?php echo form_open($this->uri->uri_string(), array('id' => 'enquiry-form', 'class' => 'enquirycall-form')); ?>
                <div class="row  ">
                    <div class="col-12">
                        <h3 class="sectionHeading">Personal Information</h3>
                    </div>
                    <input type="hidden" name="enqiry_id" value="<?php echo (isset($enquiry_id)) ? $enquiry_id : 0; ?>">
                    <?php if (in_array("service_type", $cust_fields)){ ?>
                        <div class="col-12 col-sm-4">
                            <label for="1">Service Type <span style="color: red;">*</span></label>
                            <select class="form-control" required="" id="service_type" name="service_type" data-live-search="true">
                                <option value="">Select Service Type</option>
                                <option value="1">Rent</option>
                                <option value="2">Sales</option>
                                <option value="3">Both (rent & sales)</option>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="col-12 col-sm-4 rent_duration" style="display:none;">
                        <label for="rent_duration" class="control-label">Duration (In Months) <span style="color: red;">*</span></label>
                        <input type="number" min="1" max="12" id="duration" class="form-control" name="duration">
                    </div>
                    <?php if (in_array("company_name", $cust_fields)){ ?>
                    <div class="col-12 col-sm-4">
                        <label for="company_name">Company Name <span style="color: red;">*</span></label>
                        <input type="text" id="company_name" class="form-control" required="" name="company_name" >
                    </div>
                    <?php } ?>
                    <?php if (in_array("contact_parson_name", $cust_fields)){ ?>
                    <div class="col-12 col-sm-4">
                        <label for="Contact Person Name" class="control-label">Contact Person Name <span style="color: red;">*</span></label>
                        <input type="text" id="contact_parson_name" class="form-control" required="" name="contact_parson_name" >
                    </div>
                    <?php } ?>
                    <?php if (in_array("mobile", $cust_fields)){ ?>
                    <div class="col-12 col-sm-4">
                        <span id="errmsg"></span>
                        <label for="mobile">Contact Number <span style="color: red;">*</span></label>
                        <input type="tel" id="mobile" minlength="10" maxlength="10" name="mobile" class="form-control" required="">

                    </div>
                    <?php } ?>
                    <?php if (in_array("state_id", $cust_fields)){ ?>
                    <div class="col-12 col-sm-4">
                        <label for="state">State <span style="color: red;">*</span></label>
                        <select class="form-control" id="permenent_state" name="state_id" required="">
                            <option value="">Select State</option>
                            <?php
                            if (isset($state_data) && count($state_data) > 0) {
                                foreach ($state_data as $state_key => $state_value) {
                                    ?>
                                    <option value="<?php echo $state_value->id ?>"><?php echo $state_value->name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <?php } ?>
                    <?php if (in_array("city_id", $cust_fields)){ ?>
                    <div class="col-12 col-sm-4">
                        <label for="city">City <span style="color: red;">*</span></label>
                        <select class="form-control" id="permenent_city" name="city_id" required="">
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <?php } ?>
                    <?php if (in_array("address", $cust_fields)){ ?>
                    <div class="col-12 col-sm-8">
                        <label for="address">Address <span style="color: red;">*</span></label>
                        <textarea id="address" name="address" class="form-control" required="" style="height: 110px;"></textarea>
                    </div>
                    <?php } ?>
                </div>
                <hr>
                <div class="row bg-gray">
                    <div class="col-12">
                        <h3 class="sectionHeading">Enquiry Questions</h3>
                    </div>
                    <?php
                        if (!empty($question_list)){
                            $i = 1;
                            foreach ($question_list as $value) {
                                $size = $value->size;
                                switch ($value->type) {
                                    case 1:
                                        $required_cls = '<span style="color: red;">*</span>';
                                        if (in_array($value->id, $questions)){ 
                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                    <label for="question"  class="control-label">'.$i.') '.$value->question.$required_cls.'</label><div>
                                                    <input type="text" required="" id="question['.$value->id.']" class="form-control" name="question['.$value->id.']"></div>
                                                </div></div>';
                                            $i++;
                                        }
                                        break;
                                    case 2:
                                        if (in_array($value->id, $questions)){ 
                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                    <label for="question" required="" class="control-label">'.$i.') '.$value->question.$required_cls.'</label><div>
                                                    <textarea id="question['.$value->id.']" name="question['.$value->id.']" rows="4" class="form-control"></textarea></div>
                                                </div></div>';
                                            $i++;
                                        }
                                        break;
                                    case 3:
                                        if (in_array($value->id, $questions)){ 
                                            $options = explode(",", $value->options);
                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                    <label for="question" class="control-label">'.$i.') '.$value->question.$required_cls.'</label><div>
                                                    <select class="form-control" required="" id="question['.$value->id.']" name="question['.$value->id.']" data-live-search="true">
                                                        <option value=""></option>';
                                                            foreach ($options as $val) {
                                                                echo '<option value="'.$val.'">'.$val.'</option>';
                                                            }
                                            echo   '</select></div></div></div>';
                                            $i++;
                                        }
                                        
                                        break;
                                    case 4:
                                        if (in_array($value->id, $questions)){ 
                                            $options = explode(",", $value->options);
                                            echo '<div class="col-md-'.$size.'"><div class="form-group">
                                                    <label for="question" class="control-label">'.$i.') '.$value->question.$required_cls.'</label><div>
                                                    <select class="form-control multiselect"  required="" id="question['.$value->id.']" multiple="" name="question['.$value->id.'][]" data-live-search="true">';
                                                            foreach ($options as $val) {
                                                                echo '<option value="'.$val.'">'.$val.'</option>';
                                                            }
                                            echo   '</select></div></div></div>';
                                            $i++;
                                        }
                                        break;    
                                }
                                
                            }
                        }
                    ?>
                    
                </div>

                <div class="form-group">
                    <span id="captchaImage" ><?php if (isset($captchaImage)) echo $captchaImage; ?> </span>
                    <a class="btn loadCaptcha" href="javascript:void(0);" title="Refresh Captcha Access code" onClick="reloadCaptcha();"><i class="fa fa-refresh"></i></a>
                </div>
                <br>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Captcha" name="captcha" id="captcha" required>
                    <div id="status"></div>
                </div>


                <div class="btn-bottom-toolbar text-right">
                    <!--<a href="javascript:void(0)" class="btn btn-info submit_btn">Save</a>-->
                    <input type="submit" name="save" value="Save" class="save-btn" />
                </div>
                </form> 
                <table>
                    <tr>
                        <td>
                            <h3 style="font-size:18px;margin-bottom: 5px; font-weight:900;">INSTRUCTIONS</h3>
                            <p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;">01). (<span style="color: red;">*</span>) Mandatory Fields.</p>

                            <p style="text-align: center;font-weight:700;font-size: 10px;">IN CASE OF ANY QUERY RELATED TO FILLING FORM PLEASE CONTCT US ON +91-7304997369 OR ON ADMIN@SCHACHENGINEERS.COM </p>
                        </td>
                    </tr>
                </table>
            </div>

        </section>

    </body>
</html>
<script type="text/javascript">
    $(document).on('change', '#permenent_state', function () {
        var state_id = $("#permenent_state").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('vendor/get_city'); ?>",
            data: {'state_id': state_id},
            success: function (response) {
                if (response != '') {
                    $('#permenent_city').html(response);
                }
            }
        })
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#mobile").keypress(function (e) {

            if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 8) {

                //display error message
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
    });
</script>
<script type="text/javascript">
    function ValidateEmail() {
        var email = document.getElementById("email_id").value;
        var lblError = document.getElementById("lblError");
        lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
        }
    }

    function ValidateEmail1() {
        var email = document.getElementById("contactperson_email").value;
        var lblError = document.getElementById("lblError1");
        lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
        }
    }


</script>

<script type="text/javascript">
    var validated = false;
    $("#enquiry-form").on("submit", function (e) {
        if (!validated) {
            e.preventDefault();
            var captcha = $("#captcha").val();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('vendor/get_captcha'); ?>",
                data: {'captcha': captcha},
                success: function (data) {
                    if (data == 'wrong captcha') {
                        $("#status").html('<span style="color: red;">Wrong Captcha</span>');
                        return false;
                    }
                    validated = true;
                    $("#enquiry-form").submit();

                }
            });
        }

    });

</script>
<script>

    $(document).ready(function () {
        $('.loadCaptcha').on('click', function () {
            $.get('<?php echo site_url("vendor/captcha_refresh"); ?>',
                    function (data) {
                        $('#captchaImage').html(data);
                    });
        });
    });
    
    $(document).ready(function() {
         $(".multiselect").multiselect();
    });
    
    $(document).on("change", "#service_type",function(){
        var service_type = $(this).val();
        $(".rent_duration").hide();
        if (service_type == 1 || service_type == 3){
            $(".rent_duration").attr("required", "required");
            $(".rent_duration").show();
        }
    });
    
    setInterval(function(){
        var formdata = $('#enquiry-form').serialize();
        
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('Client_enquiry_form/add_form'); ?>",
                data: formdata
            });
    }, 5000);
</script>