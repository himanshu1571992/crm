<?php $this->load->view('authentication/includes/head.php'); ?>

<body class="login_admin"<?php if (is_rtl()) {
    echo ' dir="rtl"';
} ?>>

    <div class="container d-flex">

        <div class="row w-100">

            <div class="col-md-4 col-md-offset-4 authentication-form-wrapper">


                <div class="mtop40 authentication-form">

                    <div class="company-logo">

<?php get_company_logo(); ?>

                    </div>

                    <h1><?php echo _l('admin_auth_login_heading'); ?></h1>

                    <?php $this->load->view('authentication/includes/alerts'); ?>

                    <?php echo form_open($this->uri->uri_string(), array('id' => 'adminloginform', 'class' => 'adminloginform')); ?>

                    <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>

<?php do_action('after_admin_login_form_start'); ?>

                    <div class="form-group">

                        <label for="email" class="control-label"><?php echo _l('admin_auth_login_email'); ?></label>

                        <input type="email" id="email" required="" name="email" class="form-control" autofocus="1">

                    </div>

                    <div class="form-group">

                        <label for="password" class="control-label"><?php echo _l('admin_auth_login_password'); ?></label>

                        <input type="password" id="password" required="" name="password" class="form-control">

                    </div>

                    <div class="form-group financial_year">
                        <input type="hidden" name="year_id" id="year_id" value="">

                    </div>

                    <div class="form-group staffbranch">
                        <input type="hidden" name="staffbranch" id="staffbranch" value="">

                    </div>

                    <!-- <div class="checkbox">

                        <label for="remember">

                            <input type="checkbox" id="remember" name="remember"> <?php echo _l('admin_auth_login_remember_me'); ?>

                        </label>

                    </div> -->



                    <div class="form-group">

                        <!--<button type="submit" class="btn btn-info btn-block hvr-shutter-out-vertical"><?php echo _l('admin_auth_login_button'); ?></button>-->
                        <a href="javascript:void(0);"  class="btn btn-info btn-block hvr-shutter-out-vertical admin_login"><?php echo _l('admin_auth_login_button'); ?></a>
                    </div>

                    <div class="form-group">

                        <a href="<?php echo site_url('authentication/forgot_password'); ?>"><?php echo _l('admin_auth_login_fp'); ?></a>

                    </div>

<?php if (get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '') { ?>

                        <div class="g-recaptcha" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>

                    <?php } ?>

                    <?php do_action('before_admin_login_form_close'); ?>

<?php echo form_close(); ?>

                </div>

            </div>

        </div>

    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script type="text/javascript">

    $(document).on("click", ".admin_login", function(){
        
        var email = $("#email").val();
        var password = $("#password").val();
        var staffbranch = $("#staffbranch").val();
        var year_id = $("#year_id").val();
        if (email != "" && password != "" && staffbranch !== "" && year_id !== ""){
            $("#adminloginform").submit();
        }else{
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>Authentication/getstaffbranch",
                data: {'email': email},
                success: function (response) {
                    if (response != '') {
                        pdata = JSON.parse(response);
                        $('.staffbranch').html(pdata.staff_branch);
                        $('.financial_year').html(pdata.financial_year);
//                        $('.selectpicker').selectpicker('refresh');
                    }
                }

            });
        }
        
        
    });
//    $(document).on('change', '#email', function () {
//
//        var email = $(this).val();
//
//
//
//        $.ajax({
//            type: "GET",
//            url: "<?php echo base_url(); ?>Authentication/getstaffbranch",
//            data: {'email': email},
//            success: function (response) {
//
//                if (response != '') {
//                    pdata = JSON.parse(response);
//                    $('.staffbranch').html(pdata.staff_branch);
//                    $('.financial_year').html(pdata.financial_year);
//
//                    $('.selectpicker').selectpicker('refresh');
//
//                }
//
//            }
//
//        })
//
//
//
//    });

</script>





<script>



    /*$( document ).ready(function() {
     
     var email=$('#email').val();
     
     var url = '<?php echo base_url(); ?>Authentication/getstaffbranch';
     
     var html = '<option value=""></option>';
     
     var html = '<option value=""></option>';
     
     
     
     if(email != ''){
     
     $.ajax({
     
     url: url,
     
     type: 'GET',
     
     data: {email: email},
     
     success: function(result)
     
     {
     
     if(result != "") 
     
     {
     
     var resArr = $.parseJSON(result);
     
     if(resArr.length>0)
     
     {
     
     $.each(resArr, function(k, v) {
     
     html+= '<option value="'+v.id+'">'+v.comp_branch_name+' - '+v.email_id+'</option>';
     
     });
     
     $("#staffbranch").show();
     
     $("#staffbranch").html('').html(html);
     
     $('.selectpicker').selectpicker('refresh');
     
     }
     
     else
     
     {
     
     //$("#staffbranch").hide();
     
     }
     
     
     
     }
     
     
     
     }
     
     });
     
     }
     
     
     
     });*/

</script>



</html>

