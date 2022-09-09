<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }

  .fa-star {
        font-size : 30px;
        align-content: center;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'interview_details-form', 'class' => 'proposal-form','enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="designation" class="control-label">Designation <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" id="designation_id" onchange="get_designation_question(<?php echo $round; ?>);" name="designation_id" required="" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if($designation_list){
                                                foreach ($designation_list as $value) {
                                                    $selected = (!empty($interview_details->designation_id) && $value->id == $interview_details->designation_id) ? "selected='selected'":"";
                                                    echo '<option value="'.$value->id.'" '.$selected.'>'.$value->designation.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="interview_round" class="control-label">Interview Round <span style="color: red;">*</span></label>
                                   <?php
                                   $interview_round = "";
                                    if(!empty($interview_details->interview_round)){
                                        if($interview_details->interview_round == $round){
                                            $interview_round = $interview_details->interview_round;
                                        }else{
                                            $interview_round = $round;
                                        }
                                    }
                                   ?>
                                    <select class="form-control selectpicker" id="interview_round" onchange="get_designation_question(this.value);" name="interview_round" required="" data-live-search="true">
                                        <option value="1" <?php echo (!empty($interview_details->interview_round) && $interview_round == 1) ? "selected='selected'":""; ?>>Screening Round</option>
                                        <option value="2" <?php echo (!empty($interview_details->interview_round) && $interview_round == 2) ? "selected='selected'":""; ?>>1st Round</option>
                                        <option value="3" <?php echo (!empty($interview_details->interview_round) && $interview_round == 3) ? "selected='selected'":""; ?>>Final Round</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="interview_type" class="control-label">Interview Type <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" id="interview_type" name="interview_type" required="" data-live-search="true">
                                        <option value=""></option>
                                        <option value="1" <?php echo (!empty($interview_details->interview_type) && $interview_details->interview_round == $round && $interview_details->interview_type == 1) ? "selected='selected'":""; ?>>Face To Face</option>
                                        <option value="2" <?php echo (!empty($interview_details->interview_type) && $interview_details->interview_round == $round && $interview_details->interview_type == 2) ? "selected='selected'":""; ?>>Online</option>
                                        <option value="3" <?php echo (!empty($interview_details->interview_type) && $interview_details->interview_round == $round && $interview_details->interview_type == 3) ? "selected='selected'":""; ?>>Telephonic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="candidate_name" class="control-label">Name of Candidate <span style="color: red;">*</span></label>
                                    <input type="text" name="candidate_name" class="form-control" required="" value="<?php echo (!empty($interview_details->candidate_name)) ? $interview_details->candidate_name : ""; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                    $interview_date = (!empty($interview_details) && !empty($interview_details->date) && $interview_details->interview_round == $round) ? date("d/m/Y", strtotime($interview_details->date)) : date('d/m/Y');
                                    echo render_date_input('date', 'Interview Date  <span style="color: red;">*</span>', $interview_date, array("required" => ""));
                                ?>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="interviewer_name" class="control-label">Interviewer Name <span style="color: red;">*</span></label>
                                    <input type="text" name="interviewer_name" class="form-control" required="" value="<?php echo (!empty($interview_details->interviewer_name) && $interview_details->interview_round == $round) ? $interview_details->interviewer_name : ""; ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="interviewer_remark" class="control-label">Interviewer Final Remark <span style="color: red;">*</span></label>
                                    <textarea type="text" name="interviewer_remark" required="" class="form-control" rows="1"><?php echo (!empty($interview_details->interviewer_remark) && $interview_details->interview_round == $round) ? $interview_details->interviewer_remark : ""; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="resume" class="control-label"> Upload Resume </label>
                                    <?php $required_cls = ($round==1 && empty($interview_details)) ? "required=''": ""; ?>
                                    <input type="file" id="files" class="form-control" <?php echo $required_cls; ?> name="files" style="width: 100%;">
                                </div>
                            </div>

                            <?php
                                if(isset($parent_id)){
                                    echo '<input type="hidden" name="parent_id" value="'.$parent_id.'">';
                                    echo '<input type="hidden" name="old_round_id" value="'.$interview_details->id.'">';
                                }
                            ?>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="resume" class="control-label"> Relevance </label>
                                <select class="form-control selectpicker" required="" id="relevance" name="relevance" data-live-search="true">
                                    <option value=""></option>
                                    <option value="1" <?php echo (!empty($interview_details->relevance) && $interview_details->interview_round == $round && "1" == $interview_details->relevance) ? "selected='selected'":""; ?>>Yes</option>
                                    <option value="2" <?php echo (!empty($interview_details->relevance) && $interview_details->interview_round == $round && "2" == $interview_details->relevance) ? "selected='selected'":""; ?>>No</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                                <label for="resume" class="control-label"> Relevance Remark</label>
                                <textarea type="text" name="relevance_remark" class="form-control" rows="1"><?php echo (!empty($interview_details->relevance_remark) && $interview_details->interview_round == $round) ? $interview_details->relevance_remark : ""; ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="resume" class="control-label"> Willingness to join </label>
                                <select class="form-control selectpicker" required="" id="willingnesstojoin" name="willingnesstojoin" data-live-search="true">
                                    <option value=""></option>
                                    <option value="1" <?php echo (!empty($interview_details->willingnesstojoin) && $interview_details->interview_round == $round && "1" == $interview_details->willingnesstojoin) ? "selected='selected'":""; ?>>Yes</option>
                                    <option value="2" <?php echo (!empty($interview_details->willingnesstojoin) && $interview_details->interview_round == $round && "2" == $interview_details->willingnesstojoin) ? "selected='selected'":""; ?>>No</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                                <label for="resume" class="control-label"> Willingness Remark</label>
                                <textarea type="text" name="willingnesstojoin_remark" class="form-control" rows="1"><?php echo (!empty($interview_details->willingnesstojoin_remark) && $interview_details->interview_round == $round) ? $interview_details->willingnesstojoin_remark : ""; ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="resume" class="control-label"> Cost Competence </label>
                                <select class="form-control selectpicker" required="" id="cost_competence" name="cost_competence" data-live-search="true">
                                    <option value=""></option>
                                    <option value="1" <?php echo (!empty($interview_details->cost_competence) && $interview_details->interview_round == $round && "1" == $interview_details->cost_competence) ? "selected='selected'":""; ?>>Yes</option>
                                    <option value="2" <?php echo (!empty($interview_details->cost_competence) && $interview_details->interview_round == $round && "2" == $interview_details->cost_competence) ? "selected='selected'":""; ?>>No</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                                <label for="resume" class="control-label"> Cost Competence Remark</label>
                                <textarea type="text" name="cost_competence_remark" class="form-control" rows="1"><?php echo (!empty($interview_details->cost_competence_remark) && $interview_details->interview_round == $round) ? $interview_details->cost_competence_remark : ""; ?></textarea>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="btn-bottom-toolbar text-right">
                        <button class="btn btn-info" type="submit">
                            <?php echo 'Submit'; ?>
                        </button>
                    </div>

                    </div>

                    <div class="panel_s">
                        <div class="panel-body">
                            <h4>Interview Questions Answers</h4>
                            <hr class="hr-panel-heading">
                                    <?php
                                        $genqseq = 0;
                                        if (isset($general_question_list) && !empty($general_question_list)){
                                            echo '<div class="col-md-12"><div class="row"><span class="badge badge-pill badge-primary">General Questions</span></div></div><br><br>';

                                            foreach ($general_question_list as $k => $value) {
                                              $genqseq++;
                                              $answer = (isset($value->answer)) ? $value->answer : "";
                                              $comment = (isset($value->comment)) ? $value->comment : "";
                                              echo '<div class="col-md-12">
                                                        <div class="row">
                                                            <label for="question" style="color:red;" class="control-label col-md-12">'.$genqseq.") ".$value->question.'</label>
                                                            <div class="form-group col-md-4">
                                                                <input type="hidden" name="interview['.$genqseq.'][question]" value="'.$value->question.'">
                                                                <input type="hidden" name="interview['.$genqseq.'][is_general_question]" value="1">
                                                                <label for="answer" class="control-label">Answer :</label>
                                                                <textarea id="answer_'.$genqseq.'" required="" name="interview['.$genqseq.'][answer]" class="form-control col-md-6">'.$answer.'</textarea>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="comment" class="control-label">Comment :</label>
                                                                <textarea id="comment_'.$genqseq.'" name="interview['.$genqseq.'][comment]" class="form-control col-md-6">'.$comment.'</textarea>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="comment" class="control-label col-md-12">Rating :</label>';?>
                                                                <i class= "fa fa-star qusrate<?php echo $genqseq; ?>" <?php echo (isset($value->rating) && $value->rating >= 1) ? "style='color: yellow'" : ""; ?> onclick="questionrating(1,<?php echo $genqseq; ?>)" aria-hidden= "true" id= "qst1<?php echo $genqseq; ?>"></i>
                                                                <i class= "fa fa-star qusrate<?php echo $genqseq; ?>" <?php echo (isset($value->rating) && $value->rating >= 2) ? "style='color: yellow'" : ""; ?> onclick="questionrating(2,<?php echo $genqseq; ?>)" aria-hidden= "true" id= "qst2<?php echo $genqseq; ?>"></i>
                                                                <i class= "fa fa-star qusrate<?php echo $genqseq; ?>" <?php echo (isset($value->rating) && $value->rating >= 3) ? "style='color: yellow'" : ""; ?> onclick="questionrating(3,<?php echo $genqseq; ?>)" aria-hidden= "true" id= "qst3<?php echo $genqseq; ?>"></i>
                                                                <i class= "fa fa-star qusrate<?php echo $genqseq; ?>" <?php echo (isset($value->rating) && $value->rating >= 4) ? "style='color: yellow'" : ""; ?> onclick="questionrating(4,<?php echo $genqseq; ?>)" aria-hidden= "true" id= "qst4<?php echo $genqseq; ?>"></i>
                                                                <i class= "fa fa-star qusrate<?php echo $genqseq; ?>" <?php echo (isset($value->rating) && $value->rating >= 5) ? "style='color: yellow'" : ""; ?> onclick="questionrating(5,<?php echo $genqseq; ?>)" aria-hidden= "true" id= "qst5<?php echo $genqseq; ?>"></i>
                                                                <input type="hidden" class="questionrating<?php echo $genqseq; ?>" name="interview[<?php echo $genqseq; ?>][rating]" value="<?php echo (isset($value->rating)) ? $value->rating : 0; ?>">
                                                            <?php echo '</div>
                                                       </div>
                                                  </div>';
                                            }
                                        }
                                    ?>


                            <div class="designation_question">
                                <?php
                                    $qcount = (isset($general_question_list) && !empty($general_question_list)) ? count($general_question_list) : 0;
                                    if(!empty($interview_questions)){
                                        echo '<div class="col-md-12"><div class="row"><span class="badge badge-pill badge-primary">Designation Wise Questions</span></div><br></div>';
                                        foreach ($interview_questions as $k => $value) {
                                          $qcount++;
                                        echo    '<div class="col-md-12 div'.$qcount.'">
                                                    <div class="row">';
                                                        if ($value->is_custom_question == 1){
                                                          echo '<div class="form-group col-md-12"><div class="row"><div class="col-md-10"><label for="question" style="color:red" class="control-label">'.$qcount.') Question :</label></div><div class="col-md-2"><a herf="javascript:void(0);" onclick="removequestion('.$qcount.');" class="btn-sm btn-danger pull-right"><i class="fa fa-close"></i></a></div></div><br><textarea id="question_'.$qcount.'" required="" name="interview['.$qcount.'][question]" class="form-control">'.$value->question.'</textarea></div><div class="form-group col-md-4">
                                                                  <input type="hidden" name="interview['.$qcount.'][is_custom_question]" value="'.$value->is_custom_question.'">
                                                                  <label for="answer"  class="control-label">Answer :</label>
                                                                  <textarea id="answer_'.$qcount.'" required="" name="interview['.$qcount.'][answer]" class="form-control col-md-6">'.$value->answer.'</textarea>
                                                              </div>';
                                                        }else{
                                                          echo'<label for="question" style="color:red;" class="control-label col-md-12">'.$qcount.") ".cc($value->question).'</label>
                                                          <div class="form-group col-md-4">
                                                              <input type="hidden" name="interview['.$qcount.'][question]" value="'.$value->question.'">
                                                              <input type="hidden" name="interview['.$qcount.'][is_custom_question]" value="'.$value->is_custom_question.'">
                                                              <label for="answer"  class="control-label">Answer :</label>
                                                              <textarea id="answer_'.$qcount.'" required="" name="interview['.$qcount.'][answer]" class="form-control">'.$value->answer.'</textarea>
                                                          </div>';
                                                        }
                                                        echo'<div class="form-group col-md-4">
                                                            <label for="comment"  class="control-label">Comment :</label>
                                                            <textarea id="comment_'.$qcount.'" name="interview['.$qcount.'][comment]" class="form-control">'.$value->comment.'</textarea>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="comment" class="control-label col-md-12">Rating :</label>';?>
                                                            <i class= "fa fa-star qusrate<?php echo $qcount; ?>" <?php echo (isset($value->rating) && $value->rating >= 1) ? "style='color: yellow'" : ""; ?> onclick="questionrating(1,<?php echo $qcount; ?>)" aria-hidden= "true" id= "qst1<?php echo $qcount; ?>"></i>
                                                            <i class= "fa fa-star qusrate<?php echo $qcount; ?>" <?php echo (isset($value->rating) && $value->rating >= 2) ? "style='color: yellow'" : ""; ?> onclick="questionrating(2,<?php echo $qcount; ?>)" aria-hidden= "true" id= "qst2<?php echo $qcount; ?>"></i>
                                                            <i class= "fa fa-star qusrate<?php echo $qcount; ?>" <?php echo (isset($value->rating) && $value->rating >= 3) ? "style='color: yellow'" : ""; ?> onclick="questionrating(3,<?php echo $qcount; ?>)" aria-hidden= "true" id= "qst3<?php echo $qcount; ?>"></i>
                                                            <i class= "fa fa-star qusrate<?php echo $qcount; ?>" <?php echo (isset($value->rating) && $value->rating >= 4) ? "style='color: yellow'" : ""; ?> onclick="questionrating(4,<?php echo $qcount; ?>)" aria-hidden= "true" id= "qst4<?php echo $qcount; ?>"></i>
                                                            <i class= "fa fa-star qusrate<?php echo $qcount; ?>" <?php echo (isset($value->rating) && $value->rating >= 5) ? "style='color: yellow'" : ""; ?> onclick="questionrating(5,<?php echo $qcount; ?>)" aria-hidden= "true" id= "qst5<?php echo $qcount; ?>"></i>
                                                            <input type="hidden" class="questionrating<?php echo $qcount; ?>" name="interview[<?php echo $qcount; ?>][rating]" value="<?php echo (isset($value->rating)) ? $value->rating : 0; ?>">
                                                        <?php echo '</div>
                                                    </div>
                                                </div>';
                                        }
                                    } ?>
                            </div>
                            <a href="javascript:void(0);" class="btn-sm btn-info addmorequestion" value="<?php echo $qcount; ?>"><i class="fa fa-plus"></i> Add New Question</a>
                        </div>
                    </div>
                    <div class="skill_div">
                        <?php
                            $scount = 0;
                            if (isset($skill_details)){
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
                                                        <label for="question" style="color:red;" class="control-label col-md-8"><?php echo $scount.') '. cc($value->skill); ?></label>
                                                        <div class="form-group col-md-4">
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 1) ? "style='color: yellow'" : ""; ?> onclick="markrating(1,<?php echo $scount; ?>)" aria-hidden= "true" id= "st1<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 2) ? "style='color: yellow'" : ""; ?> onclick="markrating(2,<?php echo $scount; ?>)" aria-hidden= "true" id= "st2<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 3) ? "style='color: yellow'" : ""; ?> onclick="markrating(3,<?php echo $scount; ?>)" aria-hidden= "true" id= "st3<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 4) ? "style='color: yellow'" : ""; ?> onclick="markrating(4,<?php echo $scount; ?>)" aria-hidden= "true" id= "st4<?php echo $scount; ?>"></i>
                                                            <i class= "fa fa-star rating<?php echo $scount; ?>" <?php echo ($value->rating >= 5) ? "style='color: yellow'" : ""; ?> onclick="markrating(5,<?php echo $scount; ?>)" aria-hidden= "true" id= "st5<?php echo $scount; ?>"></i>
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
            <?php echo form_close(); ?>
        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

<?php init_tail(); ?>

<script type="text/javascript">

    $(function () {

        $('#color-group').colorpicker({horizontal: true});
        var chk_page = "<?php echo (!empty($interview_questions)) ? "edit": "add"; ?>";
        var chk_skill = "<?php echo (!empty($skill_details)) ? "edit": "add"; ?>";
        if(chk_page == "add"){
            get_designation_question();
        }
        if(chk_skill == "add"){
            get_designation_skills();
        }
    });

    function get_designation_question(){
        var designation_id = $("#designation_id").val();
        var interview_round = $("#interview_round").val();
        var url = "<?php echo admin_url("staff_interview/get_designation_question"); ?>";
        $.post(url, { designation_id: designation_id, interview_round: interview_round}, function (response){
            if (response != ''){
                $(".designation_question").html(response);
                var count = $(".qustioncount").val();
                $(".addmorequestion").attr("value",count);
            }else{
                // $(".designation_question").html("");
            }
        });
        get_designation_skills();
    }

    function get_designation_skills(){
        var designation_id = $("#designation_id").val();
        var url = "<?php echo admin_url("staff_interview/get_designation_skills"); ?>";
        $.post(url, { designation_id: designation_id}, function (response){
            if (response != ''){
                $(".skill_div").html(response);
            }else{
                $(".skill_div").html("");
            }
        });
    }

//    $(document).on('change', '#designation_id', function() {
//
//        var designation_id = $(this).val();
//        var url = "<?php echo admin_url("staff_interview/get_designation_question"); ?>";
//        $.post(url, { designation_id: designation_id, interview_round: "<?php echo $round; ?>"}, function (response){
//            if (response != ''){
//                $(".designation_question").html(response);
//            }else{
//                $(".designation_question").html("");
//            }
//        });
//    });

    $(document).on("click", ".addmorequestion", function(){
       var sequence = $(this).attr("value");
       var newsequence = ++sequence;
       var html = '<div class="col-md-12 div'+sequence+'"><div class="row"><div class="form-group col-md-12"><div class="row"><div class="col-md-10"><label for="question" style="color:red" class="control-label">'+sequence+') Question :</label></div><div class="col-md-2"><a herf="javascript:void(0);" onclick="removequestion('+sequence+');" class="btn-sm btn-danger pull-right"><i class="fa fa-close"></i></a></div></div><br><textarea id="question_'+sequence+'" required="" name="interview['+sequence+'][question]" class="form-control"></textarea></div><div class="form-group col-md-4"><input type="hidden" name="interview['+sequence+'][is_custom_question]" value="1"><label for="answer" style="color:red"  class="control-label">Answer :</label><textarea id="answer_'+sequence+'" required="" name="interview['+sequence+'][answer]" class="form-control col-md-6"></textarea></div><div class="form-group col-md-4"><label for="comment" style="color:red" class="control-label">Comment :</label><textarea id="comment_'+sequence+'" name="interview['+sequence+'][comment]" class="form-control col-md-6"></textarea></div><div class="form-group col-md-4"><label for="rating" class="control-label col-md-12">Rating :</label><i class= "fa fa-star qusrate'+sequence+'" onclick="questionrating(1, '+sequence+');" aria-hidden= "true" id= "qst1'+sequence+'"></i><i class= "fa fa-star qusrate'+sequence+'" onclick="questionrating(2, '+sequence+');" aria-hidden= "true" id= "qst2'+sequence+'"></i><i class= "fa fa-star qusrate'+sequence+'" onclick="questionrating(3, '+sequence+');" aria-hidden= "true" id= "qst3'+sequence+'"></i><i class= "fa fa-star qusrate'+sequence+'" onclick="questionrating(4, '+sequence+');" aria-hidden= "true" id= "qst4'+sequence+'"></i><i class= "fa fa-star qusrate'+sequence+'" onclick="questionrating(5, '+sequence+');" aria-hidden= "true" id= "qst5'+sequence+'"></i></div><input type="hidden" class="questionrating'+sequence+'" name="interview['+sequence+'][rating]" value="0"></div></div>';

        $(".designation_question").append(html);
        $(this).attr("value", sequence);
    });

    function removequestion(id){
       var sequence = parseInt($(".addmorequestion").attr('value'));
       var newsequence = sequence-1;
       $(".div"+id).remove();
       $(".addmorequestion").attr("value", newsequence);
    }


    function markrating(div, id){
      $(".rating"+id).css("color", "black");
      if (div == 2){
         $("#st1"+id+", #st2"+id+"").css("color", "yellow");
         $(".skillsrating"+id).val(2);
      }else if (div == 3){
          $("#st1"+id+", #st2"+id+", #st3"+id+"").css("color", "yellow");
          $(".skillsrating"+id).val(3);
      }else if (div == 4){
          $("#st1"+id+", #st2"+id+", #st3"+id+", #st4"+id+"").css("color", "yellow");
          $(".skillsrating"+id).val(4);
      }else if (div == 5){
          $("#st1"+id+", #st2"+id+", #st3"+id+", #st4"+id+", #st5"+id+"").css("color", "yellow");
          $(".skillsrating"+id).val(5);
      }else{
          $("#st1"+id).css("color", "yellow");
          $(".skillsrating"+id).val(1);
      }
    }

    function questionrating(div, id){
      $(".qusrate"+id).css("color", "black");
      if (div == 2){
         $("#qst1"+id+", #qst2"+id+"").css("color", "yellow");
         $(".questionrating"+id).val(2);
      }else if (div == 3){
          $("#qst1"+id+", #qst2"+id+", #qst3"+id+"").css("color", "yellow");
          $(".questionrating"+id).val(3);
      }else if (div == 4){
          $("#qst1"+id+", #qst2"+id+", #qst3"+id+", #qst4"+id+"").css("color", "yellow");
          $(".questionrating"+id).val(4);
      }else if (div == 5){
          $("#qst1"+id+", #qst2"+id+", #qst3"+id+", #qst4"+id+", #qst5"+id+"").css("color", "yellow");
          $(".questionrating"+id).val(5);
      }else{
          $("#qst1"+id).css("color", "yellow");
          $(".questionrating"+id).val(1);
      }
    }

</script>

</body>

</html>
