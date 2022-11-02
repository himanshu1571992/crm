<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
    .b-success{
        background-color: yellowgreen;
        color: #FFF;
        padding: 5px;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        padding: 15px;
        /*width: 20%;*/
        /*border-radius: 50%;*/
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .card-inform {
        margin-bottom: 10px;
    }
    .bg-c-green {
        /* background: linear-gradient(45deg,#2ed8b6,#59e0c5); */
        background-color: #252733;
    }
    .bg-palegoldenrod {
        background-color: palegoldenrod;
    }
    .bg-moccasin {
        background-color: moccasin;
    }
    .bg-gray {
        background-color: #e4e6ea;
    }

    .checked {
  color: orange;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'interview_details-form', 'class' => 'proposal-form','enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12 bg-c-green">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-3">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Parson Name</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (isset($satisfaction_data) && !empty($satisfaction_data->parson_name)) ? cc($satisfaction_data->parson_name) : "--" ; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title" >Parson Position</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (isset($satisfaction_data) && !empty($satisfaction_data->parson_position)) ? cc($satisfaction_data->parson_position) : "--" ; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Challan No</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (isset($satisfaction_data) && !empty($satisfaction_data->chalanno)) ? cc($satisfaction_data->chalanno) : "--" ; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Client Name</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php
                                                    if (isset($satisfaction_data) && !empty($satisfaction_data->clientid)) {
                                                        $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$satisfaction_data->clientid."'  ")->row();
                                                        echo (!empty($client_info)) ? cc($client_info->client_branch_name) : "--";
                                                    }
                                                ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-12">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Final Remark</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($satisfaction_data->remark)) ? cc($satisfaction_data->remark) : "--"; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="designation_question">
                        <div class="panel_s">
                            <div class="panel-body">
                                <h4>Customer Feedback Rating</h4>
                                <hr class="hr-panel-heading">
                                <div class="col-md-12 card-inform">
                                    <h4>Note :</h4> Highly Satisfied <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
                                    |&nbsp;&nbsp;Satisfied <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
                                    |&nbsp;&nbsp;Partially Satisfied <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
                                    |&nbsp;&nbsp;Dis-satisfied <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>
                                    |&nbsp;&nbsp;Highly dis-satisfied <span class="fa fa-star checked"></span>
                                    <h4>Average Rating : </h4><span class="average_rating"></span>
                                    <hr>
                                    <?php $ttl_rating = 0;?>
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        1) <?php  echo customer_satisfaction(1); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question1){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php if (!empty($satisfaction_data->remark1)){ ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark1)) ? cc($satisfaction_data->remark1) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card label-info ">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        2) <?php  echo customer_satisfaction(2); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question2){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php if (!empty($satisfaction_data->remark2)){ ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark2)) ? cc($satisfaction_data->remark2) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        3) <?php  echo customer_satisfaction(3); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question3){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php if (!empty($satisfaction_data->remark3)){ ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark3)) ? cc($satisfaction_data->remark3) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card label-info ">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        4) <?php  echo customer_satisfaction(4); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question4){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php if (!empty($satisfaction_data->remark4)){ ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark4)) ? cc($satisfaction_data->remark4) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        5) <?php  echo customer_satisfaction(5); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question5){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php if (!empty($satisfaction_data->remark5)){ ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark5)) ? cc($satisfaction_data->remark5) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card label-info ">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        6) <?php  echo customer_satisfaction(6); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question6){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php if (!empty($satisfaction_data->remark6)){ ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark6)) ? cc($satisfaction_data->remark6) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        7) <?php  echo customer_satisfaction(7); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question7){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                                <div class="form-group" style="font-size: 15px;">
                                                    <?php if (!empty($satisfaction_data->remark7)) { ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark7)) ? cc($satisfaction_data->remark7) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card label-info ">
                                        <div class="card-body ">
                                            <h4 class="card-title">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        8) <?php  echo customer_satisfaction(8); ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                            for($i=5; $i >= 1; $i--){
                                                                if($i > $satisfaction_data->question8){
                                                                    echo '<span class="fa fa-star"></span>';
                                                                }else{
                                                                    echo '<span class="fa fa-star checked"></span>';
                                                                    $ttl_rating++;
                                                                }
                                                            }
                                                        ?>

                                                    </div>
                                                </div>
                                            </h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php if (!empty($satisfaction_data->remark8)){ ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Remark: <span style="color:#000000"><?php echo (!empty($satisfaction_data->remark8)) ? cc($satisfaction_data->remark8) : "--"; ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            </p>
                                            <?php 
                                                echo round($ttl_rating/8);
                                            ?>
                                        </div>
                                    </div>
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

<?php init_tail(); ?>


<script type="text/javascript">

    $(function () {
        $('#color-group').colorpicker({horizontal: true});
       
    });

    $(document).on('change', '#designation_id', function() {

        var designation_id = $(this).val();
        var url = "<?php echo admin_url("staff_interview/get_designation_question"); ?>";
        $.post(url, { designation_id: designation_id, interview_round: "<?php echo (isset($round) ? $round : 0); ?>"}, function (response){
            if (response != ''){
                $(".designation_question").html(response);
            }else{
                $(".designation_question").html("");
            }
        });
    });

    
    var ttlrating = "<?php echo round($ttl_rating/8); ?>";
    var rating = '';
    for(var i=ttlrating; i >= 1; i--){
        rating += '<span class="fa fa-star checked"></span>';
    }
    $(".average_rating").html(rating);
</script>

</body>

</html>
