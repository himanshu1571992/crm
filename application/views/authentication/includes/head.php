<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

  <?php if(get_option('favicon') != ''){ ?>

    <link href="<?php echo base_url('uploads/company/'.get_option('favicon')); ?>" rel="shortcut icon">

  <?php } ?>

  <title>

    <?php echo get_option('companyname'); ?> - Authentication

  </title>

  <?php echo app_stylesheet('assets/css','reset.css'); ?>

  <!-- Bootstrap -->

  <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

  <?php if(is_rtl()){ ?>

    <link href="<?php echo base_url('assets/plugins/bootstrap-arabic/css/bootstrap-arabic.min.css'); ?>" rel="stylesheet">

  <?php } ?>

  <link href='<?php echo base_url('assets/plugins/roboto/roboto.css'); ?>' rel='stylesheet'>

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">

  <link href='<?php echo base_url('assets/css/bs-overides.min.css'); ?>' rel='stylesheet'>

  <style>

  body {

    /*font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;*/

    font-family: 'Nunito', sans-serif;

    background-color: #fff;

    font-size: 13px;

    color: #6a6c6f;

    /*background: #e5e5e5;*/
    background: url(https://schachengineers.com/images/home.jpg);
    background-size: cover;

    margin: 0;

    padding: 0;

  }



  h1 {

    font-weight: 800;
    font-size: 24px;
    margin-bottom: 20px;
    text-transform: uppercase;
    text-align: center;
    margin-top: 20px;
    color: #111;

  }

  .w-100{
    width: 100%;
  }

  .btn-primary {

    color: #ffffff;

    background-color: #28b8da;

    border-color: #22a7c6;

  }



  .btn-primary:focus,

  .btn-primary.focus {

    color: #ffffff;

    background-color: #1e95b1;

    border-color: #0f4b5a;

  }



  .btn-primary:hover {

    color: #ffffff;

    background-color: #1e95b1;

    border-color: #197b92;

  }



  .btn-primary:active,

  .btn-primary.active,

  .open>.dropdown-toggle.btn-primary {

    color: #ffffff;

    background-color: #1e95b1;

    border-color: #197b92;

  }



  .btn-primary:active:hover,

  .btn-primary.active:hover,

  .open>.dropdown-toggle.btn-primary:hover,

  .btn-primary:active:focus,

  .btn-primary.active:focus,

  .open>.dropdown-toggle.btn-primary:focus,

  .btn-primary:active.focus,

  .btn-primary.active.focus,

  .open>.dropdown-toggle.btn-primary.focus {

    color: #ffffff;

    background-color: #197b92;

    border-color: #0f4b5a;

  }



  .btn-primary:active,

  .btn-primary.active,

  .open>.dropdown-toggle.btn-primary {

    background-image: none;

  }



  .btn-primary.disabled,

  .btn-primary[disabled],

  fieldset[disabled] .btn-primary,

  .btn-primary.disabled:hover,

  .btn-primary[disabled]:hover,

  fieldset[disabled] .btn-primary:hover,

  .btn-primary.disabled:focus,

  .btn-primary[disabled]:focus,

  fieldset[disabled] .btn-primary:focus,

  .btn-primary.disabled.focus,

  .btn-primary[disabled].focus,

  fieldset[disabled] .btn-primary.focus,

  .btn-primary.disabled:active,

  .btn-primary[disabled]:active,

  fieldset[disabled] .btn-primary:active,

  .btn-primary.disabled.active,

  .btn-primary[disabled].active,

  fieldset[disabled] .btn-primary.active {

    background-color: #28b8da;

    border-color: #22a7c6;

  }



  .btn-primary .badge {

    color: #28b8da;

    background-color: #ffffff;

  }



  input[type="text"],

  input[type="password"],

  input[type="datetime"],

  input[type="datetime-local"],

  input[type="date"],

  input[type="month"],

  input[type="time"],

  input[type="week"],

  input[type="number"],

  input[type="email"],

  input[type="url"],

  input[type="search"],

  input[type="tel"],

  input[type="color"],

  .uneditable-input,

  input[type="color"] {

    border: 1px solid #bfcbd9;

    -webkit-box-shadow: none;

    box-shadow: none;

    color: #494949;

    font-size: 14px;

    line-height: 1;

    height: 36px;

  }



  input[type="text"]:focus,

  input[type="password"]:focus,

  input[type="datetime"]:focus,

  input[type="datetime-local"]:focus,

  input[type="date"]:focus,

  input[type="month"]:focus,

  input[type="time"]:focus,

  input[type="week"]:focus,

  input[type="number"]:focus,

  input[type="email"]:focus,

  input[type="url"]:focus,

  input[type="search"]:focus,

  input[type="tel"]:focus,

  input[type="color"]:focus,

  .uneditable-input:focus,

  input[type="color"]:focus {

    border-color: #03a9f4;

    -webkit-box-shadow: none;

    box-shadow: none;

    outline: 0 none;

  }



  input.form-control {

    -webkit-box-shadow: none;

    box-shadow: none;

  }

  .form-control {
    border: 1px solid rgba(45,41,38,0.18) !important;
    height: 40px !important;
  }


  .company-logo {

    padding:0px;

    display: block;

  }



  .company-logo img {

    margin: 0 auto;

    display: block;

    width: 80%;

  }


/*
  .authentication-form-wrapper {

    margin-top: 70px;

  }*/

.d-flex{
  display: flex;
  height: 100vh;
  align-items: center;
  justify-content: center;
}



  @media (max-width:768px) {

    .authentication-form-wrapper {

      margin-top: 15px;

    }

  }



  .authentication-form {

    border-radius: 8px;

    border: 1px solid #b4b4b4;

    padding: 20px;

    background:rgba(255, 255, 255, 0.95);

    box-shadow: 0 15px 50px -10px rgba(21,37,72,0.2);

  }



  label {

    font-weight: 700 !important;

  }


  .btn-info{
    color: #fff;
    background-color: #563dcd;
    border: 0;
    height: 43px;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
  }

  /* Shutter Out Vertical */
.hvr-shutter-out-vertical {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  position: relative;
  background:#252733;
  -webkit-transition-property: color;
  transition-property: color;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.hvr-shutter-out-vertical:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: #245de2;
  -webkit-transform: scaleY(0);
  transform: scaleY(0);
  -webkit-transform-origin: 50%;
  transform-origin: 50%;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
  border-radius: 50px;
}
.hvr-shutter-out-vertical:hover, .hvr-shutter-out-vertical:focus, .hvr-shutter-out-vertical:active {
  color: white;
}
.hvr-shutter-out-vertical:hover:before, .hvr-shutter-out-vertical:focus:before, .hvr-shutter-out-vertical:active:before {
  -webkit-transform: scaleY(1);
  transform: scaleY(1);
}

  input:-internal-autofill-selected{
    background-color: #fff !important;
  }

  @media screen and (max-height: 575px) {

    #rc-imageselect,

    .g-recaptcha {

      transform: scale(0.83);

      -webkit-transform: scale(0.83);

      transform-origin: 0 0;

      -webkit-transform-origin: 0 0;

    }

  }



</style>

<?php if(get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != ''){ ?>

  <script src='https://www.google.com/recaptcha/api.js'></script>

<?php } ?>

<?php if(file_exists(FCPATH.'assets/css/custom.css')){ ?>

  <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">

<?php } ?>

<?php render_custom_styles(array('general','buttons')); ?>

<?php do_action('app_admin_login_head'); ?>

</head>

