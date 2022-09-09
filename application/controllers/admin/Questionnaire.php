<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Questionnaire extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    /* List all Quations */
    public function index() {
        check_permission(333,'view');
        $where = " status = '1' ";
        if (!empty($_POST)) {
            extract($this->input->post());

            
            if (!empty($staff_id)) {
                $data['staff_id'] = $staff_id;

                $where .= " and staff_id = '" . $staff_id . "'";
            }

            if (!empty($f_date) && !empty($t_date)) {

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $where .= " and dabit_note_date  BETWEEN  '" . db_date($f_date) . "' and  '" . db_date($t_date) . "' ";
            }
        }

        
        $data['questions_list'] = $this->db->query("SELECT * from tblproductquestions where  " . $where . " order by id desc ")->result();
        $data['staff_list'] = get_staff_list();

        $data['title'] = 'Product Questions List';
        $this->load->view('admin/questionnaire/list', $data);
    }
    
    /* this function use for add Questionnaire */
    public function add(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $insert_data["staff_id"] = get_staff_user_id();
            $insert_data["product_category_id"] = $product_category_id;
            $insert_data["questions"] = $questions;
            $insert_data["date"] = date("Y-m-d");
            $insert_data["status"] = 1;
            $insert_data["created_at"] = date("Y-m-d H:i:s");
            
            $insert_id = $this->home_model->insert("tblproductquestions", $insert_data);
            if ($insert_id){
                set_alert("success", "Your Question Add successfully");
                redirect(admin_url('questionnaire'));
            }else{
                set_alert("danger", "Something went wroung.");
                redirect(admin_url('questionnaire'));
            }
        }
    }
    
    /* this function use for add Question Answer */
    public function add_answer(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $insert_data["questions_id"] = $question_id;
            $insert_data["answer"] = $answer;
            $insert_data["answer_by"] = get_staff_user_id();
            $insert_data["created_at"] = date("Y-m-d H:i:s");
            
            $insert_id = $this->home_model->insert("tblproductquestionsanswers", $insert_data);
            if ($insert_id){
                set_alert("success", "Your answer submited");
                redirect(admin_url('questionnaire'));
            }else{
                set_alert("danger", "Something went wroung.");
                redirect(admin_url('questionnaire'));
            }
        }
    }
    /* this function use for get Question Answer */
    public function get_answer_list($question_id) {
        if (!empty($question_id)) {
            $question_data = $this->db->query("SELECT * FROM tblproductquestions WHERE `id` = '" . $question_id . "'")->row();
            $answer_list = $this->db->query("SELECT * FROM tblproductquestionsanswers WHERE `questions_id` = '" . $question_id . "' order by created_at desc ")->result();
            if ($answer_list) {
                echo '<section class="comments col-sm-12"><div class="question_div">
                        <h4>
                            <span class="question-text"> '.$question_data->id.') '. $question_data->questions .'</span>
                        </h4>
                    </div><br>';
                foreach ($answer_list as $questionanswer) {
                    
                    $profile = $this->db->query("SELECT `profile_image` FROM tblstaff WHERE `staffid` = ".$questionanswer->answer_by."")->row();
                    if (!empty($profile) && !empty($profile->profile_image)){
                        $profile_url = "uploads/staff_profile_images/".$questionanswer->answer_by."/".$profile->profile_image;
                    }else{
                        $profile_url = "assets/images/user-placeholder.jpg";
                    }
                    echo '<article class="comment">
                              <a class="comment-img" href="#non">
                                <img src="'.  site_url($profile_url).'" alt="" width="50" height="50">
                              </a>
                              <div class="comment-body">
                                <div class="text">
                                  <p>'.cc($questionanswer->answer).'</p>
                                </div>
                                <p class="attribution">by <a href="#non">'.get_employee_name($questionanswer->answer_by).'</a> at '.  _d($questionanswer->created_at).'</p>
                              </div>
                            </article>';
                }
                echo '</section>';
            }
        } else {
            set_alert("danger", "Something went wroung.");
            redirect(admin_url('questionnaire'));
        }
    }

}
