<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Survey extends Clients_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id, $hash)
    {
        $this->load->model('surveys_model');
        $survey = $this->surveys_model->get($id);

        // Last statement is for
        if (!$survey
            || ($survey->hash != $hash)
            || (!$hash || !$id)
            // Users with permission manage surveys to preview the survey even if is not active
            || ($survey->active == 0 && !has_permission('surveys', '', 'view'))
             // Check if survey is only for logged in participants / staff / clients
            || ($survey->onlyforloggedin == 1 && !is_logged_in())
        ) {
            show_404();
        }

        // Ip Restrict Check
        if ($survey->iprestrict == 1) {
            $this->db->where('surveyid', $id);
            $this->db->where('ip', $this->input->ip_address());
            $total = $this->db->count_all_results('tblsurveyresultsets');
            if ($total > 0) {
                show_404();
            }
        }
        if ($this->input->post()) {
            $success = $this->surveys_model->add_survey_result($id, $this->input->post());
            if ($success) {
                $survey = $this->surveys_model->get($id);
                if ($survey->redirect_url !== '') {
                    redirect($survey->redirect_url);
                }
                // Message is by default in English because there is no easy way to know the customer language
                set_alert('success', do_action('survey_success_message', 'Thank you for participating in this survey. Your answers are very important to us.'));

                redirect(do_action('survey_default_redirect', site_url('survey/' . $id . '/' . $hash . '?participated=yes')));
            }
        }

        $this->use_navigation = false;
        $this->use_submenu    = false;
        $data['survey']       = $survey;
        $data['title']        = $data['survey']->subject;
        $this->data           = $data;
        no_index_customers_area();
        $this->view = 'survey_view';
        $this->layout();
    }
    
    public function survey_form($encode_code = ""){
        $data["title"] = "Customer satisfaction survey form";
        
        if ($encode_code != ""){
            $data["challan_id"] = ci_dec($encode_code);
            if(!empty($data["challan_id"])){
                $challan_id = $data["challan_id"];
                $data["challan_data"] = $this->db->query("SELECT * FROM tblchalanmst WHERE id = '".$challan_id."'")->row();
                if(empty($data["challan_data"])){
                    echo '<div style="background-color:#f8d7da;padding:1%;border-radius: 48px;" role="alert">
                            <p style="text-align:center;">This link has expired, kindly generate the link.</p>
                          </div>';
                    exit;
                }
                $chk_feedback = $this->db->query("SELECT * FROM tblcustomersatificationdetails WHERE challan_id = '".$challan_id."'")->row();
                if(!empty($chk_feedback)){
                    echo '<div style="background-color:#f8d7da;padding:1%;border-radius: 48px;" role="alert">
                            <p style="text-align:center;">This link has expired, kindly generate the link.</p>
                          </div>';
                    exit;
                }
            }
        }
        
        if ($this->input->post()) {
            
            $post_data = $this->input->post();
            
            $insert_data["challan_id"] = $post_data["challan_id"];
            $insert_data["parson_name"] = $post_data["parson_name"];
            $insert_data["parson_position"] = $post_data["parson_position"];
            if (!empty($post_data["question"])){
                $i = 1;
                foreach ($post_data["question"] as $value) {

                    $insert_data["question".$i] = $value;
                    $insert_data["remark".$i] = $post_data["questionremark".$i];
                    $i++;
                }
            }
            $insert_data["remark"] = $post_data["remark"];
            $insert_data['created_at'] = date("Y-m-d H:i:s");
            $this->db->insert("tblcustomersatificationdetails", $insert_data);
            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                set_alert('success', "Customer Satisfaction Details Add Successfully");
                redirect(site_url('survey/customer_satisfaction/'.$insert_id));
            }else{
                set_alert('danger', "Oops, something went wrong");
            }
              
        }
        $this->load->view('staff/surveys_form', $data);
    }
    
    public function customer_satisfaction($id)
    {   
        $data['id'] = $id;
        $data['title'] = 'Customer Satisfaction';
        $this->load->view('staff/customer_satisfaction_page', $data);

    }
}
