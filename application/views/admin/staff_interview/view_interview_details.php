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
    .fa-star {
          font-size : 30px;
          align-content: center;
      }
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%;
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%;
        }
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
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Designation</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo value_by_id("tbldesignation", $interview_details->designation_id, "designation"); ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Interview Round</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php
                                                if ($interview_details->interview_round == 1) {
                                                    echo "Screening Round";
                                                } elseif ($interview_details->interview_round == 2) {
                                                    echo "1st Round";
                                                } elseif ($interview_details->interview_round == 3) {
                                                    echo "Final Round";
                                                }
                                                ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Interview Type</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php
                                                if ($interview_details->interview_type == 1) {
                                                    echo "Face To Face";
                                                } elseif ($interview_details->interview_type == 2) {
                                                    echo "Online";
                                                } elseif ($interview_details->interview_type == 3) {
                                                    echo "Telephonic";
                                                }
                                                ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Name of Candidate</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($interview_details->candidate_name)) ? $interview_details->candidate_name : "--"; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Interview Date</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($interview_details->date)) ? _d($interview_details->date) : "--"; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Interviewer Name</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($interview_details->interviewer_name)) ? $interview_details->interviewer_name : "--"; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Relevance <?php echo ($interview_details->relevance == 1) ? "<span class='btn-sm btn-success'>Yes</span>" : "<span class='btn-sm btn-danger'>No</span>"; ?></h4>
                                            <p class="card-text">
                                                <div class="form-group" style="font-size: 15px;">
                                                    Remark : <?php echo (!empty($interview_details->relevance_remark)) ? $interview_details->relevance_remark : "--"; ?>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                      <div class="card-body ">
                                          <h4 class="card-title">Willingness to join <?php echo ($interview_details->willingnesstojoin == 1) ? "<span class='btn-sm btn-success'>Yes</span>" : "<span class='btn-sm btn-danger'>No</span>"; ?></h4>
                                          <p class="card-text">
                                              <div class="form-group" style="font-size: 15px;">
                                                  Remark : <?php echo (!empty($interview_details->willingnesstojoin_remark)) ? $interview_details->willingnesstojoin_remark : "--"; ?>
                                              </div>
                                          </p>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                      <div class="card-body ">
                                          <h4 class="card-title">Cost Competence <?php echo ($interview_details->cost_competence == 1) ? "<span class='btn-sm btn-success'>Yes</span>" : "<span class='btn-sm btn-danger'>No</span>"; ?></h4>
                                          <p class="card-text">
                                              <div class="form-group" style="font-size: 15px;">
                                                  Remark : <?php echo (!empty($interview_details->cost_competence_remark)) ? $interview_details->cost_competence_remark : "--"; ?>
                                              </div>
                                          </p>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Interviewer Final Remark</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($interview_details->interviewer_remark)) ? $interview_details->interviewer_remark : "--"; ?>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">HR Rating</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                              <?php
                                                  $totalquestion = $this->db->query("SELECT COUNT(id) as ttlq, SUM(rating) as ttlrating FROM `tblstaffinterviewquestions` WHERE `staffinterview_id` = '".$interview_details->id."' ")->row();
                                                  $totalskill = $this->db->query("SELECT COUNT(id) as ttlq, SUM(rating) as ttlrating FROM `tblstaffinterviewskills` WHERE `staffinterview_id` = '".$interview_details->id."' ")->row();
                                                  $ttlqustions = $totalquestion->ttlq+$totalskill->ttlq;
                                                  $ttlrating = (!empty($totalquestion->ttlrating)) ? $totalquestion->ttlrating : 0;
                                                  $ttlrating1 = (!empty($totalskill->ttlrating)) ? $totalskill->ttlrating : 0;
                                                  $totalarchived = ($ttlrating+$ttlrating1)/$ttlqustions;

                                                  echo "<span style='font-size:25px;'>".$finalrating = number_format($totalarchived, 1, '.', '')."</span> &nbsp;";
                                              ?>
                                              <i class= "fa fa-star" <?php echo ($finalrating >= 1) ? "style='color: yellow'" : "style='color: #000'"; ?> aria-hidden= "true" ></i>
                                              <i class= "fa fa-star" <?php echo ($finalrating >= 2) ? "style='color: yellow'" : "style='color: #000'"; ?> aria-hidden= "true" ></i>
                                              <i class= "fa fa-star" <?php echo ($finalrating >= 3) ? "style='color: yellow'" : "style='color: #000'"; ?> aria-hidden= "true" ></i>
                                              <i class= "fa fa-star" <?php echo ($finalrating >= 4) ? "style='color: yellow'" : "style='color: #000'"; ?> aria-hidden= "true" ></i>
                                              <i class= "fa fa-star" <?php echo ($finalrating >= 5) ? "style='color: yellow'" : "style='color: #000'"; ?> aria-hidden= "true" ></i>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($interview_details->resume)){ ?>
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">View Resume</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <a download href="<?php echo site_url("uploads/interview_resume/".$interview_details->resume);?>"><?php echo $interview_details->resume; ?></a>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="designation_question">
                        <?php
                            if(!empty($interview_questions)){
                    ?>
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h4>Interview Questions Answers</h4>
                                    <hr class="hr-panel-heading">
                                    <?php
                                        foreach ($interview_questions as $k => $value) {
                                            $bbgcls = ($k%2 == 1) ? "bg-gray": "bg-gray";
                                            $comment_text = (!empty($value->comment)) ? cc($value->comment) : "--";
                                        echo    '<div class="col-md-12 card-inform">
                                                    <div class="card label-info '.$bbgcls.'">
                                                        <div class="card-body ">
                                                            <h4 class="card-title">'.++$k.") ".cc($value->question).' <i class="fa fa-question-circle-o text-danger"></i></h4>
                                                            <p class="card-text">
                                                            <div class="form-group" style="font-size: 15px;">
                                                                Answer : <span style="color:#000;">'.cc($value->answer).'</span>
                                                            </div>
                                                            <div class="form-group" style="font-size: 15px;">
                                                                Comment : <span style="color:#000;">'.$comment_text.'</span>
                                                            </div>
                                                            <div class="form-group" style="font-size: 15px;">
                                                                Rating : <span style="color:#000;">'?>
                                                                  <i class= "fa fa-star" <?php echo ($value->rating >= 1) ? "style='color: yellow'" : ""; ?> aria-hidden= "true" id="qst1<?php echo $k; ?>"></i>
                                                                  <i class= "fa fa-star" <?php echo ($value->rating >= 2) ? "style='color: yellow'" : ""; ?> aria-hidden= "true" id="qst2<?php echo $k; ?>"></i>
                                                                  <i class= "fa fa-star" <?php echo ($value->rating >= 3) ? "style='color: yellow'" : ""; ?> aria-hidden= "true" id="qst3<?php echo $k; ?>"></i>
                                                                  <i class= "fa fa-star" <?php echo ($value->rating >= 4) ? "style='color: yellow'" : ""; ?> aria-hidden= "true" id="qst4<?php echo $k; ?>"></i>
                                                                  <i class= "fa fa-star" <?php echo ($value->rating >= 5) ? "style='color: yellow'" : ""; ?> aria-hidden= "true" id="qst5<?php echo $k; ?>"></i>
                                                                  <?php echo'</span>
                                                            </div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php
                            }
                        ?>
                    </div>
                    <div class="skill_div">
                        <?php
                            $scount = 0;
                            if (isset($skill_details) && !empty($skill_details)){
                              echo '<div class="panel_s">
                                        <div class="panel-body">
                                            <h4>Skills & Qualities</h4>
                                            <hr class="hr-panel-heading">';
                                            foreach ($skill_details as $k => $value) {
                                                $scount++;
                                                $ratingcls = "style='color: yellow'";
                        ?>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label for="question" style="color:red;" class="control-label col-md-8"><?php echo $scount.') '. $value->skill; ?></label>
                                                        <div class="form-group col-md-4">
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 1) ? "style='color: yellow'" : ""; ?> onclick="markrating(<?php echo $scount; ?>)" aria-hidden= "true" id= "st1<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 2) ? "style='color: yellow'" : ""; ?> onclick="markrating(<?php echo $scount; ?>)" aria-hidden= "true" id= "st2<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 3) ? "style='color: yellow'" : ""; ?> onclick="markrating(<?php echo $scount; ?>)" aria-hidden= "true" id= "st3<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 4) ? "style='color: yellow'" : ""; ?> onclick="markrating(<?php echo $scount; ?>)" aria-hidden= "true" id= "st4<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 5) ? "style='color: yellow'" : ""; ?> onclick="markrating(<?php echo $scount; ?>)" aria-hidden= "true" id= "st5<?php echo $scount; ?>"></i>
                                                        </div>
                                                        <input type="hidden" class="skillsquantities<?php echo $scount; ?>" name="skillsquantities[<?php echo $scount; ?>][skill]" value="<?php echo $value->skill; ?>">
                                                        <input type="hidden" class="skillsrating<?php echo $scount; ?>" name="skillsquantities[<?php echo $scount; ?>][rating]" value="<?php echo $value->rating; ?>">
                                                    </div>
                                                </div>
                        <?php
                                            }
                                echo '</div>
                                        </div>';
                            }
                        ?>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
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
        $.post(url, { designation_id: designation_id, interview_round: "<?php echo $round; ?>"}, function (response){
            if (response != ''){
                $(".designation_question").html(response);
            }else{
                $(".designation_question").html("");
            }
        });
    });
</script>

</body>

</html>
