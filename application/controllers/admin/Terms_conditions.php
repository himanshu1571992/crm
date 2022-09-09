<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Terms_conditions extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {

        check_permission('14,33,242','view');

        $data['termscondition_info']  = $this->db->query("SELECT * FROM tbltermsandconditions  order by id asc ")->result();

        $data['title'] = 'Terms Conditions List';
        $this->load->view('admin/terms_conditions/manage', $data);

    }

    public function update($id="")
    {

        check_permission('14,33,242','create');

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
                // 'terms_conditions' => $terms_conditions,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $update = $this->home_model->update('tbltermsandconditions', $ad_data, array('id'=>$id));
            if (isset($termscondition)){
               $this->home_model->delete('tbltermsandconditionspointers', array('terms_condition_id' => $id));

               foreach ($termscondition as $terms) {
                 if (!empty($terms['condition'])){
                     $insertdata['terms_condition_id'] = $id;
                     $insertdata['condition'] = $terms['condition'];
                     $this->home_model->insert('tbltermsandconditionspointers', $insertdata);
                 }
               }
            }

            set_alert('success', 'Terms Conditions updated Successfully');
            redirect(admin_url('terms_conditions'));
        }

        if(!empty($id)){
            $data['termscondition_info']  = $this->db->query("SELECT * FROM tbltermsandconditions where  id = '".$id."' ")->row();
            $data['termsconditionpointers']  = $this->db->query("SELECT * FROM tbltermsandconditionspointers where  terms_condition_id = '".$id."' ")->result();
        }

        $data['title'] = 'Update Terms and Conditions';
        $this->load->view('admin/terms_conditions/update', $data);

    }




    public function get_termsandcondition_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            echo get_terms_conditions($slug,$for,$type);

        }
    }
    public function getTermsConditionsData(){
        if(!empty($_POST)){
            extract($this->input->post());
            if (isset($rel_id)){
               $data['condition_list'] = $this->db->query("SELECT * FROM `tbltermsandconditionsales` WHERE `rel_id`='".$rel_id."' AND `rel_type`='".$slug."' AND `condition_type`=2")->result();
            }else{
                $for = (isset($for)) ? $for : "";
                $type = (isset($type)) ? $type : "";
                $data['condition_list'] = getTermsConditions($slug,$for,$type);
            }
            
            $this->load->view('admin/terms_conditions/termsconditionpointers', $data);
        }
    }

}
