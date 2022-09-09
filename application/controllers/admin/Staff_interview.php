<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_interview extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');

    }

    public function index($id = '')
    {   check_permission(379,'view');
        $where = "id > 0 ";
        if(!is_admin() == 1){
            $where .= " and branch_id=".  get_login_branch() ." ";
        }
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($designation_id)){
                $data["designation_id"] = $designation_id;
                $where .= " and designation_id = '" . $designation_id . "'";
            }
        }

        $data['interview_info'] = $this->db->query("SELECT designation_id FROM tblstaffinterviewdetails WHERE ".$where." GROUP BY `designation_id` ")->result();
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1 ORDER BY designation ASC")->result();

        $data['title'] = 'Staff Interview Dashboard';
        $this->load->view('admin/staff_interview/dashboard', $data);
    }

    /* this function use for add interview details */
    public function add_interview_details($id='', $interviewround=1){

        $this->load->model('Staff_interview_model');
        if ($this->input->post()) {
            $post_data = $this->input->post();
            if ($id == '') {

                $id = $this->Staff_interview_model->add($post_data);
                if ($id) {
                    $this->upload_resume($id);
                    set_alert('success', "Staff interview details added successfully");
                    redirect(admin_url('staff_interview'));
                }
            } else {

                $success = $this->Staff_interview_model->edit($post_data, $id);
                if ($success) {
                    $this->upload_resume($id);
                    set_alert('success', "Staff interview details updated successfully");
                }
                redirect(admin_url('staff_interview'));
            }
        }

        if ($id == '') {
            check_permission(379,'create');
            $title = "Add Staff Interview Details";
            $data['general_question_list'] = $this->db->query("SELECT * FROM `tblstaffinterviewquestionsgeneral` WHERE `status` = '1' ORDER BY `id` DESC")->result();
        } else {
            check_permission(379,'edit');
            $data["interview_details"] = $this->db->query("SELECT * FROM `tblstaffinterviewdetails` WHERE id='".$id."'")->row();
            $data["interview_questions"] = $this->db->query("SELECT * FROM `tblstaffinterviewquestions` WHERE `staffinterview_id`= '".$id."' and `is_general_question` = '0'")->result();

            $title = "Edit Staff Interview Details";
            $data['general_question_list'] = $this->db->query("SELECT * FROM `tblstaffinterviewquestions` WHERE `staffinterview_id`= '".$id."' and `is_general_question` = '1' ORDER BY `id` ASC")->result();
            $data['skill_details'] = $this->db->query("SELECT * FROM `tblstaffinterviewskills` WHERE `staffinterview_id`= '".$id."' ORDER BY `id` ASC")->result();
        }
        $data['round'] = $interviewround;
        $data['title'] = $title;
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1 order by designation asc")->result();

        $this->load->view('admin/staff_interview/add_interview_details', $data);
    }

    public function get_designation_question(){
        if ($this->input->post()) {
            extract($this->input->post());

            $html = "";
            $questions = $this->db->query("SELECT question FROM tbldesignationquestion as d LEFT JOIN `tbldesignationwisequestion` as dq ON d.id = dq.designationquestion_id WHERE FIND_IN_SET('".$designation_id."', `designation_ids`) AND FIND_IN_SET('".$interview_round."', `interview_round`)")->result();
            $generalquestioncount = $this->db->query("SELECT count(*) as ttlcount FROM `tblstaffinterviewquestionsgeneral` WHERE `status` = '1' ORDER BY `id` DESC")->row()->ttlcount;
            $qcount = $generalquestioncount;
            if(!empty($questions)){
                echo '<div class="col-md-12"><div class="row"><span class="badge badge-pill badge-primary">Designation Wise Questions</span></div><br></div>';
                foreach ($questions as $k => $value) {
                    $qcount++;
                    $html.= '<div class="col-md-12">
                                <div class="row">
                                    <label for="question" style="color:red;" class="control-label col-md-12">'.$qcount.") ".cc($value->question).'</label>
                                    <div class="form-group col-md-4">
                                        <input type="hidden" name="interview['.$qcount.'][question]" value="'.$value->question.'">
                                        <input type="hidden" name="interview['.$qcount.'][is_custom_question]" value="0">
                                        <label for="answer" class="control-label">Answer :</label>
                                        <textarea id="answer_'.$qcount.'" required="" name="interview['.$qcount.'][answer]" class="form-control col-md-6"></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="comment" class="control-label">Comment :</label>
                                        <textarea id="comment_'.$qcount.'" name="interview['.$qcount.'][comment]" class="form-control col-md-6"></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="rating" class="control-label col-md-12">Rating :</label>
                                        <i class= "fa fa-star qusrate'.$qcount.'" onclick="questionrating(1, '.$qcount.');" aria-hidden= "true" id= "qst1'.$qcount.'"></i>
                                        <i class= "fa fa-star qusrate'.$qcount.'" onclick="questionrating(2, '.$qcount.');" aria-hidden= "true" id= "qst2'.$qcount.'"></i>
                                        <i class= "fa fa-star qusrate'.$qcount.'" onclick="questionrating(3, '.$qcount.');" aria-hidden= "true" id= "qst3'.$qcount.'"></i>
                                        <i class= "fa fa-star qusrate'.$qcount.'" onclick="questionrating(4, '.$qcount.');" aria-hidden= "true" id= "qst4'.$qcount.'"></i>
                                        <i class= "fa fa-star qusrate'.$qcount.'" onclick="questionrating(5, '.$qcount.');" aria-hidden= "true" id= "qst5'.$qcount.'"></i>
                                    </div>
                                    <input type="hidden" class="questionrating'.$qcount.'" name="interview['.$qcount.'][rating]" value="0">
                                </div>

                            </div>
                        ';
                }
            }
            $html .= '<input type="hidden" class="qustioncount" value="'.$qcount.'">';
            echo $html;
        }
    }

    public function get_designation_skills(){
      if ($this->input->post()) {
          extract($this->input->post());

          $html = "";
          $skills_data = $this->db->query("SELECT skills FROM tbldesignationskills as d LEFT JOIN `tbldesignationskillsdetails` as dq ON d.id = dq.designationskills_id WHERE FIND_IN_SET('".$designation_id."', `designation_ids`)")->result();
          $qcount = 0;
          if(!empty($skills_data)){
              $html.= '<div class="panel_s">
                          <div class="panel-body">
                              <h4>Skills & Qualities</h4>
                              <hr class="hr-panel-heading">';
              foreach ($skills_data as $k => $value) {
                  $qcount++;
                  $html.= '<div class="col-md-12">
                              <div class="row">
                                  <label for="question" style="color:red;" class="control-label col-md-8">'.$qcount.') '.cc($value->skills).'</label>
                                  <div class="form-group col-md-4">
                                      <i class= "fa fa-star rating'.$qcount.'" onclick="markrating(1, '.$qcount.');" aria-hidden= "true" id= "st1'.$qcount.'"></i>
                                      <i class= "fa fa-star rating'.$qcount.'" onclick="markrating(2, '.$qcount.');" aria-hidden= "true" id= "st2'.$qcount.'"></i>
                                      <i class= "fa fa-star rating'.$qcount.'" onclick="markrating(3, '.$qcount.');" aria-hidden= "true" id= "st3'.$qcount.'"></i>
                                      <i class= "fa fa-star rating'.$qcount.'" onclick="markrating(4, '.$qcount.');" aria-hidden= "true" id= "st4'.$qcount.'"></i>
                                      <i class= "fa fa-star rating'.$qcount.'" onclick="markrating(5, '.$qcount.');" aria-hidden= "true" id= "st5'.$qcount.'"></i>
                                  </div>
                                  <input type="hidden" class="skillsquantities'.$qcount.'" name="skillsquantities['.$qcount.'][skill]" value="'.$value->skills.'">
                                  <input type="hidden" class="skillsrating'.$qcount.'" name="skillsquantities['.$qcount.'][rating]" value="0">
                              </div>
                          </div>';
              }
              $html.= '</div>
                   </div>';
          }
          echo $html;
      }
    }

    public function candidate_list($designation_id="", $round=""){


        $where = "show_list = 1 ";
        if(!empty($designation_id)){
            $where .= " and designation_id = ".  $designation_id ."";
        }
        if(!is_admin() == 1){
            $where .= " and branch_id=".  get_login_branch() ."";
        }
        if (!empty($round)){
            $where .= " and interview_round=".  $round ."";
        }
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
            }
        }

        $data['candidate_list'] = $this->db->query("SELECT * from `tblstaffinterviewdetails` where " . $where . " order by id desc")->result();
        $data["designation_id"] = $designation_id;
        $data['title'] = 'Interview Candidate List';
        $this->load->view('admin/staff_interview/candidate_list', $data);
    }

    public function view_interview_details($id){
        $data["interview_details"] = $this->db->query("SELECT * FROM tblstaffinterviewdetails WHERE id='".$id."'")->row();
        $data["interview_questions"] = $this->db->query("SELECT * FROM tblstaffinterviewquestions WHERE `staffinterview_id`= '".$id."'")->result();

        $data['title'] = "View Interview Details";
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1")->result();
        $data['skill_details'] = $this->db->query("SELECT * FROM `tblstaffinterviewskills` WHERE `staffinterview_id`= '".$id."' ORDER BY `id` ASC")->result();
        $this->load->view('admin/staff_interview/view_interview_details', $data);
    }

    /* this function use for add next round */
    public function add_next_round($pid='', $interviewround=1){

        $this->load->model('Staff_interview_model');
        if ($this->input->post()) {
            $post_data = $this->input->post();

            $id = $this->Staff_interview_model->add($post_data);
            if ($id) {
                $this->upload_resume($id);
                set_alert('success', "Staff interview details added successfully");
                $designation_id = value_by_id_empty("tblstaffinterviewdetails", $id, "designation_id");
                redirect(admin_url('staff_interview'));
            }
        }

        $data["interview_details"] = $this->db->query("SELECT * FROM tblstaffinterviewdetails WHERE id='".$pid."'")->row();
        $data['round'] = $interviewround;
        $data['parent_id'] = (!empty($data["interview_details"]) && $data["interview_details"]->parent_id > 0) ? $data["interview_details"]->parent_id : $pid;
        $data['title'] = "Add Staff Interview Details";
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1")->result();
        $data['general_question_list'] = $this->db->query("SELECT * FROM `tblstaffinterviewquestionsgeneral` WHERE `status` = '1' ORDER BY `id` DESC")->result();
        $this->load->view('admin/staff_interview/add_interview_details', $data);
    }

    public function confirm_employee($id){
        $interview_details = $this->db->query("SELECT * FROM tblstaffinterviewdetails WHERE id='".$id."'")->row();
        if(!empty($interview_details)){
            $up_data = array(
                "show_list" => 0,
                "confirm_status" => 1,
                "confirm_by" => get_staff_user_id(),
                "confirm_date" => date("Y-m-d"),
            );
            $update = $this->home_model->update('tblstaffinterviewdetails',$up_data, array("id" => $id));
            if($update){
                set_alert('success', "Confirmed Successfully");
                redirect(admin_url('staff_interview/confirm_employee_list'));
            }
        }
    }

    public function confirm_employee_list($designation_id=""){

        $where = "confirm_status = 1 and staffregistration_id = 0";
        if(!is_admin() == 1){
            $where .= "and branch_id=".  get_login_branch() ."";
        }
        if(!empty($designation_id)){
            $where .= " and designation_id = ".  $designation_id ."";
        }
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
            }

            if (!empty($designation_id)){
                $data["designation_id"] = $designation_id;
                $where .= " and designation_id = '" . $designation_id . "'";
            }
            if (!empty($interview_round)){
                $data["interview_round"] = $interview_round;
                $where .= " and interview_round = '" . $interview_round . "'";
            }
        }

        $data['candidate_list'] = $this->db->query("SELECT * from `tblstaffinterviewdetails` where " . $where . " order by id desc")->result();
        $data["designation_id"] = $designation_id;
        $data['title'] = 'Conform Employee List';
        $this->load->view('admin/staff_interview/confirm_employee_list', $data);
    }

    /* this function use for upload resume */
    public function upload_resume($id){

        if(!empty($_FILES['files']['name'])){

            // File upload configuration
            $config['upload_path'] = INTERVIEW_RESUME_FOLDER;
            $config['allowed_types'] = 'png|pdf|jpeg|jpg|doc';
            $config['encrypt_name'] = TRUE;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('files')){

                // Uploaded file data
                $fileData = $this->upload->data();
                $ad_data_1 = array(
                            'resume' => $fileData['file_name']
                        );
                $this->home_model->update('tblstaffinterviewdetails',$ad_data_1, array("id" => $id));
            }else{
                echo $error = $this->upload->display_errors();

            }
        }
    }

    public function upload_signed_ctc() {
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($_FILES['files']['name'])) {

                // File upload configuration
                $config['upload_path'] = STAFF_SIGNED_CTC_FOLDER;
                $config['allowed_types'] = 'png|pdf|jpeg|jpg|doc';
                $config['encrypt_name'] = TRUE;

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('files')) {

                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $ad_data_1 = array(
                        'signed_ctc' => $fileData['file_name']
                    );
                    $this->home_model->update('tblstaffinterviewdetails', $ad_data_1, array("id" => $candidate_id));
                    set_alert('success', "Upload Successfully");
                }else{
                    $message=$this->upload->display_errors();
                    set_alert('danger', $message);
                }
                redirect(admin_url('staff_interview'));
            }
        }
    }

    public function registered_employee_list($designation_id=""){

        $where = "si.confirm_status = 1 and si.staffregistration_id > 0";
        if(!is_admin() == 1){
            $where .= "and si.branch_id=".  get_login_branch() ."";
        }
        if(!empty($designation_id)){
            $where .= " and si.designation_id = ".  $designation_id ."";
        }
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and si.date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
            }

            if (!empty($designation_id)){
                $data["designation_id"] = $designation_id;
                $where .= " and si.designation_id = '" . $designation_id . "'";
            }
            if (!empty($interview_round)){
                $data["interview_round"] = $interview_round;
                $where .= " and si.interview_round = '" . $interview_round . "'";
            }
        }

        $data['employee_list'] = $this->db->query("SELECT rs.* FROM `tblstaffinterviewdetails` as si LEFT JOIN `tblregisteredstaff` as rs ON si.staffregistration_id = rs.staffid WHERE " . $where . " ORDER BY si.id DESC")->result();
        $data["designation_id"] = $designation_id;

        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();

        $i = 0;

        foreach ($Staffgroup as $singlestaff) {
            $i++;

            $stafff[$i]['id'] = $singlestaff['id'];

            $stafff[$i]['name'] = $singlestaff['name'];

            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();

            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['title'] = 'Registered Employee List';
        $this->load->view('admin/staff_interview/registered_employee_list', $data);
    }

    public function candidate_requirement(){
        check_permission(385,'view');
        $where = "id > 0 ";

        if(!is_admin() == 1){
            $where .= " and added_by=". get_staff_user_id() ." and branch_id=".  get_login_branch() ."";
        }
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and deadline_date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
            }

            if (!empty($designation_id)){
                $data["designation_id"] = $designation_id;
                $where .= " and designation_id = '" . $designation_id . "'";
            }
            if (!empty($department_id)){
                $data["department_id"] = $department_id;
                $where .= " and department_id = '" . $department_id . "'";
            }
            if (strlen($hr_status) > 0){
                $data["hr_status"] = $hr_status;
                $where .= " and hr_status = '" . $hr_status . "'";
            }
        }

        $data['requirements_list'] = $this->db->query("SELECT * FROM `tblcandidaterequirement` WHERE " . $where . "  ORDER BY id DESC")->result();
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1")->result();
        $data['department_list'] = $this->db->query("SELECT * FROM `tbldepartmentsmaster` WHERE status = 1")->result();
        $data['title'] = 'Candidate Requirement List';
        $this->load->view('admin/staff_interview/candidate_requirement_list', $data);
    }

    public function get_approval_info() {
        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblcandidaterequirementapproval  where requirement_id = '".$requirement_id."'  ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Assign Detail List</h4>
                </div>
                <hr/>
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                            <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Remark</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($assign_info)) {
                                        $i = 1;
                                        foreach ($assign_info as $key => $value) {

                                            if ($value->approve_status == 0) {
                                                $status = 'Pending';
                                                $color = 'Darkorange';
                                            } elseif ($value->approve_status == 1) {
                                                $status = 'Approved';
                                                $color = 'green';
                                            } elseif ($value->approve_status == 2) {
                                                $status = 'Reject';
                                                $color = 'red';
                                            }elseif ($value->approve_status == 4) {
                                                $status = 'Reconciliation';
                                                $color = 'brown';
                                            }elseif ($value->approve_status == 5) {
                                                $status = 'On Hold';
                                                $color = '#e8bb0b';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                <td><?php echo ($value->approve_remark) ? $value->approve_remark : "--"; ?></td>
                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public function add_candidate_requirement($id=''){
        
        $this->load->model('Staff_interview_model');
        if ($this->input->post()) {
            $post_data = $this->input->post();
            if ($id == '') {

                $id = $this->Staff_interview_model->add_requirement($post_data);
                if ($id) {
                    $this->upload_resume($id);
                    set_alert('success', "Candidate Requirement added successfully");
                    redirect(admin_url('staff_interview/candidate_requirement'));
                }
            } else {

                $success = $this->Staff_interview_model->edit_requirement($post_data, $id);
                if ($success) {
                    $this->upload_resume($id);
                    set_alert('success', "Candidate Requirement updated successfully");
                }
                redirect(admin_url('staff_interview/candidate_requirement'));
            }
        }

        if ($id == '') {
            check_permission(385,'create');
            $title = "Add Candidate Requirement";
        } else {
            check_permission(385,'create');
            $data["requirement_info"] = $this->db->query("SELECT * FROM tblcandidaterequirement WHERE id='".$id."'")->row();
            $title = "Edit Candidate Requirement";
        }
        $branch_str = get_staff_info(get_staff_user_id())->branch_id;
        $data['title'] = $title;
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1 order by designation asc")->result();
        $data['department_list'] = $this->db->query("SELECT * FROM `tbldepartmentsmaster` WHERE status = 1 order by name asc")->result();
        $data['branch_list'] = $this->db->query("SELECT * FROM `tblcompanybranch` where id IN (".$branch_str.") order by comp_branch_name asc ")->result();

        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='22'")->result_array();

        $i = 0;

        foreach ($Staffgroup as $singlestaff) {
            $i++;

            $stafff[$i]['id'] = $singlestaff['id'];

            $stafff[$i]['name'] = $singlestaff['name'];

            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();

            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $this->load->view('admin/staff_interview/add_candidate_requirement', $data);
    }

    public function requirementapprovalStatus($id){

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
             'approve_status' => $submit,
             'approve_remark' => $remark,
             'updated_at' => date("Y-m-d H:i:s")

            );
            $update = $this->home_model->update('tblcandidaterequirementapproval', $ad_data,array('requirement_id'=>$id,'staff_id'=>get_staff_user_id()));

            update_masterapproval_single(get_staff_user_id(),38,$id,$submit);
            update_masterapproval_all(38,$id,$submit);

            if($update){
                $this->home_model->update('tblcandidaterequirement', array("status" => $submit),array('id'=>$id));

                set_alert('success', 'Candidate Requirement Updated Succesfully');
                redirect(admin_url('approval/notifications'));
            }
        }
        $data['title'] = "Candidate Requirement Approval";
        $data["requirement_info"] = $this->db->query("SELECT * FROM tblcandidaterequirement WHERE id='".$id."'")->row();
        $data['appvoal_info'] = $this->db->query("SELECT * FROM tblcandidaterequirementapproval WHERE requirement_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();
        $this->load->view('admin/staff_interview/requirementapproval', $data);
    }

    public function get_requirement_html(){
        if (!empty($_POST)){
            extract($this->input->post());
            $requirement_info = $this->db->query("SELECT * FROM tblcandidaterequirement WHERE id='".$requirement_id."'")->row();
            if (!empty($requirement_info)){
    ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <table class="col-md-12">
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Designation <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo value_by_id("tbldesignation", $requirement_info->designation_id, "designation"); ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Location <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($requirement_info->location)) ? $requirement_info->location : "--"; ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">No Of Candidate Requirement <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($requirement_info->candidate_number)) ? $requirement_info->candidate_number : "--"; ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Experience <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($requirement_info->experience)) ? $requirement_info->experience : "--"; ?></p></td>
                                </tr>

                            </table>
                            <table class="col-md-12">
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Department <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo value_by_id("tbldepartmentsmaster", $requirement_info->department_id, "name"); ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Branch <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo value_by_id("tblcompanybranch", $requirement_info->branch_id, "comp_branch_name"); ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Deadline Date <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($requirement_info->deadline_date)) ? _d($requirement_info->deadline_date) : "--"; ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Added By <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo ($requirement_info->added_by > 0) ? get_employee_name($requirement_info->added_by) : "--"; ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Job Description <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($requirement_info->job_description)) ? cc($requirement_info->job_description) : "--"; ?></p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    <?php
            }
        }
    }

    public function staff_requirement_list(){
        $where = "status = 1";
        check_permission(386,'view');
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and deadline_date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
            }

            if (!empty($designation_id)){
                $data["designation_id"] = $designation_id;
                $where .= " and designation_id = '" . $designation_id . "'";
            }
            if (!empty($department_id)){
                $data["department_id"] = $department_id;
                $where .= " and department_id = '" . $department_id . "'";
            }
            if (!empty($branch_id)){
                $data["branch_id"] = $branch_id;
                $where .= " and branch_id = '" . $branch_id . "'";
            }
            if (strlen($hr_status) > 0){
                $data["hr_status"] = $hr_status;
                $where .= " and hr_status = '" . $hr_status . "'";
            }
        }

        $branch_str = get_staff_info(get_staff_user_id())->branch_id;
        $data['requirements_list'] = $this->db->query("SELECT * FROM `tblcandidaterequirement` WHERE " . $where . "  ORDER BY id DESC")->result();
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` WHERE status = 1")->result();
        $data['department_list'] = $this->db->query("SELECT * FROM `tbldepartmentsmaster` WHERE status = 1")->result();
        $data['branch_list'] = $this->db->query("SELECT * FROM `tblcompanybranch` where id IN (".$branch_str.") ")->result();
        $data['title'] = 'Staff Requirement List';
        $this->load->view('admin/staff_interview/requirement_list', $data);
    }

    public function deleterequirement($id){
        check_permission(386,'delete');
        $success = $this->home_model->delete("tblcandidaterequirement", array("id" => $id));
        if ($success) {
            $this->home_model->delete("tblcandidaterequirementapproval", array("requirement_id" => $id));
            $this->home_model->delete("tblmasterapproval", array("module_id" => 38, "table_id" => $id));

            set_alert('success', "Candidate Requirement Deleted Successfully");
            if (strpos($_SERVER['HTTP_REFERER'], 'staff_interview/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('staff_interview/candidate_requirement'));
            }
        } else {
            set_alert('warning', "Somthing went worng");
            redirect(admin_url('staff_interview/candidate_requirement/' . $id));
        }
    }

    public function change_status($requirement_id){
        $requirement_info = $this->db->query("SELECT hr_status FROM tblcandidaterequirement WHERE id='".$requirement_id."'")->row();
        if (!empty($requirement_info)){
            $hrstatus = ($requirement_info->hr_status == 0) ? 1 : 0;
            $this->home_model->update('tblcandidaterequirement', array("hr_status" => $hrstatus),array('id'=>$requirement_id));
        }
        redirect(admin_url('staff_interview/staff_requirement_list'));
    }

    /* this function use for generalquestion_master */
    public function generalquestion_master(){
        check_permission(388,'view');
        $where = "id > 0";
        if (!empty($_POST)) {
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)) {
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
            }
        }

        $data['generalquestion_list'] = $this->db->query("SELECT * FROM `tblstaffinterviewquestionsgeneral` WHERE " . $where . "  ORDER BY id DESC")->result();

        $data['title'] = 'General Question List';
        $this->load->view('admin/staff_interview/generalquestion_list', $data);
    }

    public function addGeneralQuestion($id=''){

        if ($this->input->post()) {
            $post_data = $this->input->post();
            $tdata["staff_id"] = get_staff_user_id();
            $tdata["question"] = $post_data["question"];
            $tdata["status"] = 1;
            $tdata["date"] = date("Y-m-d");
            $tdata["created_at"] = date("Y-m-d h:i:d");

            if ($id == '') {
                $insertid = $this->home_model->insert("tblstaffinterviewquestionsgeneral", $tdata);
                if ($insertid) {
                    set_alert('success', "General Question added successfully");
                    redirect(admin_url('staff_interview/generalquestion_master'));
                }
            } else {
                unset($tdata["date"]);
                unset($tdata["created_at"]);
                $update = $this->home_model->update("tblstaffinterviewquestionsgeneral", $tdata, array("id" => $id));
                if ($update) {
                    set_alert('success', "General Question updated successfully");
                }
                redirect(admin_url('staff_interview/generalquestion_master'));
            }
        }

        if ($id == '') {
            check_permission(388,'create');
            $title = "Add General Question";
        } else {
            check_permission(388,'edit');
            $data["generalquestioninfo"] = $this->db->query("SELECT * FROM `tblstaffinterviewquestionsgeneral` WHERE `id`='".$id."'")->row();
            $title = "Edit General Question";
        }

        $data['title'] = $title;
        $this->load->view('admin/staff_interview/add_generalquestion', $data);
    }

    public function deleteGeneralQuestion($id){
        check_permission(388,'delete');
        $success = $this->home_model->delete("tblstaffinterviewquestionsgeneral", array("id" => $id));
        if ($success) {
            set_alert('success', "General Question Successfully");
            if (strpos($_SERVER['HTTP_REFERER'], 'staff_interview/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('staff_interview/generalquestion_master'));
            }
        } else {
            set_alert('warning', "Somthing went worng");
            redirect(admin_url('staff_interview/generalquestion_master/' . $id));
        }
    }

    public function changegeneralquestionStatus($id){
        $chk_info = $this->db->query("SELECT `status` FROM `tblstaffinterviewquestionsgeneral` WHERE `id`='".$id."'")->row();
        if (!empty($chk_info)){
            $status = ($chk_info->status == 0) ? 1 : 0;
            $this->home_model->update('tblstaffinterviewquestionsgeneral', array("status" => $status),array('id'=>$id));
        }
        redirect(admin_url('staff_interview/generalquestion_master'));
    }
}
