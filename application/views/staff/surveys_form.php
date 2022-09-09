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

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

/*            textarea.form-control {
                height: 42px;
            }*/

            .sectionHeading {
                font-weight: 900;
                font-size: 24px;
                text-decoration: underline;
                margin-bottom: 15px;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: none;
                background: #087AE3;
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
            .checkbox{
                width: 35px; height: 35px;
            }
            
            .bg-info {
                /*background-color: #9fdce6 !important;*/
                background-color: #fff !important;
            }
            .bg-second {
                background-color: #b9cbce !important;
            }
        </style>

    </head>

    <body>
        <section class="wrapper">

            <div class="container">

                <div class="row ">
                    <div class="col-12 text-center topHead">
                        <img width="150" height="50" src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" class="logo">
                        <h2><?php echo (!empty($title)) ? $title : ""; ?></h2>
                    </div>
                </div>
                <?php
                if (isset($alert_msg)) {
                    ?>

                    <div class="alert alert-success">

                        <?php echo $alert_msg; ?>

                    </div>

                    <?php
                }
                ?>



                <form action="<?= base_url(); ?>Survey/survey_form" method="post" enctype="multipart/form-data" id="myForm">

                    <div class="row">
                        <div class="col-12">
                            <h3 class="sectionHeading"><?php echo (isset($challan_data) && !empty($challan_data)) ? client_info($challan_data->clientid)->client_branch_name:"--"; ?></h3>
                        </div>
                        <div class="col-12 col-sm-6">
                            <span id="errmsg1"></span>
                            <label for="1">Your Name <span style="color: red;">*</span></label>
                            <input type="text" name="parson_name" class="form-control" required="">
                        </div>
                        <div class="col-12 col-sm-6">
                            <span id="lblError" style="color: red"></span>
                            <label for="name">Your Position<span style="color: red;">*</span></label>
                            <input type="text" name="parson_position" class="form-control" required="">
                        </div>
                    </div>


                    <br/> 
                    <hr>

                    <div class="row bg-gray">
                        <div class="col-md-12">
                            <br>
                            <br>
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h4>Please rate your satisfaction with...</h4>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table ui-table">
                                            <thead>
                                                <tr>
                                                    <th width="50%">Questions</th>
                                                    <th width="15%" class="text-center">Highly Satisfied</th>
                                                    <th class="text-center">Satisfied</th>
                                                    <th class="text-center">Partially Satisfied</th>
                                                    <th width="15%" class="text-center">Dis-satisfied</th>
                                                    <th width="20%" class="text-center">Highly dis-satisfied</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-info">
                                                    <td>
                                                        <?php echo customer_satisfaction(1); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo1" >Give Remark</a>
                                                        <div id="demo1" class="collapse form-group">
                                                            <textarea id="questionremark1" rows="2" name="questionremark1" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[1]" id="answer1" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[1]" id="answer2" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[1]" id="answer3" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[1]" id="answer4" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[1]" id="answer5" value="1"></td>
                                                </tr>
                                                <tr class="bg-second">
                                                    <td>
                                                        <?php echo customer_satisfaction(2); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo2" >Give Remark</a>
                                                        <div id="demo2" class="collapse form-group">
                                                            <textarea id="questionremark2" name="questionremark2" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[2]" id="answer12" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[2]" id="answer22" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[2]" id="answer32" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[2]" id="answer42" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[2]" id="answer52" value="1"></td>
                                                </tr>
                                                <tr class="bg-info">
                                                    <td><?php echo customer_satisfaction(3); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo3" >Give Remark</a>
                                                        <div id="demo3" class="collapse form-group">
                                                            <textarea id="questionremark3" name="questionremark3" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[3]" id="answer13" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[3]" id="answer23" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[3]" id="answer33" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[3]" id="answer43" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[3]" id="answer53" value="1"></td>
                                                </tr>
                                                <tr class="bg-second">
                                                    <td><?php echo customer_satisfaction(4); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo4" >Give Remark</a>
                                                        <div id="demo4" class="collapse form-group">
                                                            <textarea id="questionremark4" name="questionremark4" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[4]" id="answer14" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[4]" id="answer24" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[4]" id="answer34" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[4]" id="answer44" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[4]" id="answer54" value="1"></td>
                                                </tr>
                                                <tr class="bg-info">
                                                    <td><?php echo customer_satisfaction(5); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo5" >Give Remark</a>
                                                        <div id="demo5" class="collapse form-group">
                                                            <textarea id="questionremark5" name="questionremark5" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[5]" id="answer15" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[5]" id="answer25" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[5]" id="answer35" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[5]" id="answer45" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[5]" id="answer55" value="1"></td>
                                                </tr>
                                                <tr class="bg-second">
                                                    <td><?php echo customer_satisfaction(6); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo6" >Give Remark</a>
                                                        <div id="demo6" class="collapse form-group">
                                                            <textarea id="questionremark6" name="questionremark6" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[6]" id="answer16" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[6]" id="answer26" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[6]" id="answer36" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[6]" id="answer46" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[6]" id="answer56" value="1"></td>
                                                </tr>
                                                <tr class="bg-info">
                                                    <td><?php echo customer_satisfaction(7); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo7" >Give Remark</a>
                                                        <div id="demo7" class="collapse form-group">
                                                            <textarea id="questionremark7" name="questionremark7" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[7]" id="answer17" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[7]" id="answer27" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[7]" id="answer37" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[7]" id="answer47" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[7]" id="answer57" value="1"></td>
                                                </tr>
                                                <tr class="bg-second">
                                                    <td><?php echo customer_satisfaction(8); ?><br>
                                                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo8" >Give Remark</a>
                                                        <div id="demo8" class="collapse form-group">
                                                            <textarea id="questionremark8" name="questionremark8" class="form-control" placeholder="remark..."></textarea>
                                                        </div>
                                                    </td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[8]" id="answer18" value="5"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[8]" id="answer28" value="4"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[8]" id="answer38" value="3"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[8]" id="answer48" value="2"></td>
                                                    <td align="center"><input class="form-check-input checkbox" type="radio" name="question[8]" id="answer58" value="1"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>    
                            </div>    
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="form-group">
                                <label for="orther_remark" class="control-label" style="font-size:20px;">If you are expecting any other improvement from us please write here :</label>
                                <textarea id="orther_remark" rows="5" name="remark" class="form-control" placeholder="remark..."></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="btn-bottom-toolbar text-right">
                        <?php
                        if (!empty($challan_id)) {
                            echo '<input type="hidden" name="challan_id" value="' . $challan_id . '">';
                        }
                        ?>
                        <input type="submit" name="save" value="Save" class="save-btn" />
                    </div>
                </form> 
            </div>
        </section>
    </body>
</html>



