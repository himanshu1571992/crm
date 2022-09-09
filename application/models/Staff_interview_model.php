<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff_interview_model extends CRM_Model {

    private $table_name = "tblstaffinterviewdetails";
    private $second_table_name = "tblstaffinterviewquestions";

    public function __construct() {
        parent::__construct();
    }

    /**
     * Add new staff Interview details
     * @param array $data tax data
     * @return boolean
     */
    public function add($data) {

        $parent_id = (!empty($data["parent_id"])) ? $data["parent_id"] : 0;
        $old_round_id = (!empty($data["old_round_id"])) ? $data["old_round_id"] : 0;

        $resume ="";
        if ($parent_id > 0){
            $oldresume = value_by_id_empty($this->table_name, $old_round_id, "resume");
            if(!empty($oldresume)){
                $resume = $oldresume;
            }else{
                $resume = value_by_id_empty($this->table_name, $parent_id, "resume");
            }
        }
        $adata["parent_id"] = $parent_id;
        $adata["branch_id"] = get_login_branch();
        $adata["designation_id"] = $data["designation_id"];
        $adata["interview_round"] = $data["interview_round"];
        $adata["interview_type"] = $data["interview_type"];
        $adata["candidate_name"] = $data["candidate_name"];
        $adata["date"] = db_date($data["date"]);
        $adata["interviewer_name"] = $data["interviewer_name"];
        $adata["resume"] = $resume;
        $adata["interviewer_remark"] = $data["interviewer_remark"];
        $adata["relevance"] = $data["relevance"];
        $adata["willingnesstojoin"] = $data["willingnesstojoin"];
        $adata["cost_competence"] = $data["cost_competence"];
        $adata["relevance_remark"] = (!empty($data["relevance_remark"])) ? $data["relevance_remark"] : null;
        $adata["willingnesstojoin_remark"] = (!empty($data["willingnesstojoin_remark"])) ? $data["willingnesstojoin_remark"] : null;
        $adata["cost_competence_remark"] = (!empty($data["cost_competence_remark"])) ? $data["cost_competence_remark"] : null;
        $adata["show_list"] = 1;
        $adata["added_by"] = get_staff_user_id();
        $adata['created_at'] = date("Y-m-d H:i:s");
        $adata['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table_name, $adata);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

            /* this is use for hide record from list */
            if ($old_round_id > 0){
                $updata = array(
                    "show_list" => 0
                );
                $this->home_model->update($this->table_name, $updata, array("id" => $old_round_id));
            }

            if($data["interview"]){
                foreach ($data["interview"] as $k => $value) {
                    $is_general_question = (isset($value["is_general_question"])) ? $value["is_general_question"] : 0;
                    $is_custom_question = (isset($value["is_custom_question"])) ? $value["is_custom_question"] : 0;
                    $aval["staffinterview_id"] = $insert_id;
                    $aval["question"] = $value["question"];
                    $aval["answer"] = $value["answer"];
                    $aval["comment"] = $value["comment"];
                    $aval["rating"] = $value["rating"];
                    $aval["is_custom_question"] = $is_custom_question;
                    $aval["is_general_question"] = $is_general_question;
                    $this->db->insert($this->second_table_name, $aval);
                }
            }

            if(isset($data["skillsquantities"])){
                foreach ($data["skillsquantities"] as $k => $value) {
                    $sval["staffinterview_id"] = $insert_id;
                    $sval["skill"] = $value["skill"];
                    $sval["rating"] = $value["rating"];
                    $this->db->insert("tblstaffinterviewskills", $sval);
                }
            }
            return $insert_id;
        }

        return false;
    }

     /**
     * Edit staff Interview details
     * @param array $data tax data
     * @return boolean
     */
    public function edit($data, $id) {

        $adata["designation_id"] = $data["designation_id"];
        $adata["interview_round"] = $data["interview_round"];
        $adata["interview_type"] = $data["interview_type"];
        $adata["candidate_name"] = $data["candidate_name"];
        $adata["date"] = db_date($data["date"]);
        $adata["interviewer_name"] = $data["interviewer_name"];
        $adata["interviewer_remark"] = $data["interviewer_remark"];
        $adata["relevance"] = $data["relevance"];
        $adata["willingnesstojoin"] = $data["willingnesstojoin"];
        $adata["cost_competence"] = $data["cost_competence"];
        $adata["relevance_remark"] = (!empty($data["relevance_remark"])) ? $data["relevance_remark"] : null;
        $adata["willingnesstojoin_remark"] = (!empty($data["willingnesstojoin_remark"])) ? $data["willingnesstojoin_remark"] : null;
        $adata["cost_competence_remark"] = (!empty($data["cost_competence_remark"])) ? $data["cost_competence_remark"] : null;
        $adata['updated_at'] = date("Y-m-d H:i:s");
        $update = $this->home_model->update($this->table_name, $adata, array("id" => $id));
        if ($update) {

            $this->home_model->delete($this->second_table_name, array("staffinterview_id" => $id));
            $this->home_model->delete("tblstaffinterviewskills", array("staffinterview_id" => $id));
            if($data["interview"]){
                foreach ($data["interview"] as $k => $value) {
                    $is_general_question = (isset($value["is_general_question"])) ? $value["is_general_question"] : 0;
                    $is_custom_question = (isset($value["is_custom_question"])) ? $value["is_custom_question"] : 0;
                    $aval["staffinterview_id"] = $id;
                    $aval["question"] = $value["question"];
                    $aval["answer"] = $value["answer"];
                    $aval["comment"] = $value["comment"];
                    $aval["rating"] = $value["rating"];
                    $aval["is_custom_question"] = $is_custom_question;
                    $aval["is_general_question"] = $is_general_question;
                    $this->db->insert($this->second_table_name, $aval);
                }
            }

            if(isset($data["skillsquantities"])){
                foreach ($data["skillsquantities"] as $k => $value) {
                    $sval["staffinterview_id"] = $id;
                    $sval["skill"] = $value["skill"];
                    $sval["rating"] = $value["rating"];
                    $this->db->insert("tblstaffinterviewskills", $sval);
                }
            }
            return true;
        }

        return false;
    }

    /**
     * Add new staff requirement details
     * @param array $data tax data
     * @return boolean
     */
    public function add_requirement($data) {

        $designation_id = (!empty($data["designation_id"])) ? $data["designation_id"] : 0;
        $department_id = (!empty($data["department_id"])) ? $data["department_id"] : 0;

        $assignstaff = $data['assignid'];
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $adata["department_id"] = $department_id;
        $adata["designation_id"] = $designation_id;
        $adata["location"] = $data["location"];
        $adata["candidate_number"] = $data["candidate_number"];
        $adata["deadline_date"] = db_date($data["deadline_date"]);
        $adata["branch_id"] = $data["branch_id"];
        $adata["experience"] = $data["experience"];
        $adata["job_description"] = $data["job_description"];
        $adata["status"] = 0;
        $adata["added_by"] = get_staff_user_id();
        $adata['created_on'] = date("Y-m-d H:i:s");
        $adata['updated_on'] = date("Y-m-d H:i:s");
        $this->db->insert("tblcandidaterequirement", $adata);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

            if (!empty($staff_id)){

                foreach ($staff_id as $single) {
                    $addmasterata = array(
                        'staff_id' => $single,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 38,
                        'description' => 'Candidate Requirement send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'staff_interview/requirementapprovalStatus/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('tblmasterapproval', $addmasterata);


                    $addapprovalata = array(
                        'staff_id' => $single,
                        'requirement_id' => $insert_id,
                        'approve_status' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('tblcandidaterequirementapproval', $addapprovalata);
                }
            }

            return $insert_id;
        }

        return false;
    }

     /**
     * Edit staff requirement details
     * @param array $data tax data
     * @return boolean
     */
    public function edit_requirement($data, $id) {

        $designation_id = (!empty($data["designation_id"])) ? $data["designation_id"] : 0;
        $department_id = (!empty($data["department_id"])) ? $data["department_id"] : 0;

        $assignstaff = $data['assignid'];
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $adata["department_id"] = $department_id;
        $adata["designation_id"] = $designation_id;
        $adata["location"] = $data["location"];
        $adata["candidate_number"] = $data["candidate_number"];
        $adata["deadline_date"] = db_date($data["deadline_date"]);
        $adata["branch_id"] = $data["branch_id"];
        $adata["experience"] = $data["experience"];
        $adata["job_description"] = $data["job_description"];
        $adata["status"] = 0;
        $adata["added_by"] = get_staff_user_id();
        $adata['created_on'] = date("Y-m-d H:i:s");
        $adata['updated_on'] = date("Y-m-d H:i:s");
        $this->db->where("id", $id);
        $update = $this->db->update("tblcandidaterequirement", $adata);
        if ($update) {

            if (!empty($staff_id)){

                $this->home_model->delete("tblmasterapproval", array("table_id" => $id, "module_id"=> 38));
                $this->home_model->delete("tblcandidaterequirementapproval", array("requirement_id" => $id));

                foreach ($staff_id as $single) {
                    $addmasterata = array(
                        'staff_id' => $single,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 38,
                        'description' => 'Candidate Requirement send to you for Approval',
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'staff_interview/requirementapprovalStatus/' . $id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('tblmasterapproval', $addmasterata);


                    $addapprovalata = array(
                        'staff_id' => $single,
                        'requirement_id' => $id,
                        'approve_status' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('tblcandidaterequirementapproval', $addapprovalata);
                }
            }

            return $insert_id;
        }

        return false;
    }
}
