<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Designation_model extends CRM_Model {

    private $table_name = "tbldesignation";

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get tax by id
     * @param  mixed $id tax id
     * @return mixed     if id passed return object else array
     */
    public function get($id = '') {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get($this->table_name)->row();
        }
        $this->db->order_by('designation', 'ASC');

        return $this->db->get($this->table_name)->result_array();
    }

    /**
     * Add new tax
     * @param array $data tax data
     * @return boolean
     */
    public function add($data) {

        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Client Designation Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
            return $insert_id;
        }

        return false;
    }

    /**
     * Edit tax
     * @param  array $data tax data
     * @return boolean
     */
    public function edit($data, $id) {

        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Delete tax from database
     * @param  mixed $id tax id
     * @return boolean
     */
    public function delete($id) {

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        if ($this->db->affected_rows() > 0) {
            logActivity('Client category Deleted [ID: ' . $id . ']');
            $this->home_model->delete('tblmenuassigned', array('designation_id'=>$id));
            return true;
        }

        return false;
    }

    /**
     * Add new designation question
     * @param array $data tax data
     * @return boolean
     */
    public function designationquestion_add($data) {


        $adata['staff_id'] = get_staff_user_id();
        $adata['designation_ids'] = implode(",", $data["designation_id"]);
        $adata['interview_round'] = implode(",", $data["interview_round"]);
        $adata['date'] = date("Y-m-d");
        $adata['remark'] = $data["remark"];
        $adata['status'] = 1;
        $adata['created_at'] = date("Y-m-d H:i:s");
        $adata['updated_at'] = date("Y-m-d H:i:s");

        $this->db->insert("tbldesignationquestion", $adata);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

            if(!empty($data['question'])){
                foreach($data['question'] as $ques) {

                    $addata['designationquestion_id'] = $insert_id;
                    $addata['question'] = $ques;
                    $this->db->insert("tbldesignationwisequestion", $addata);
                }
            }

            return $insert_id;
        }

        return false;
    }

    /**
     * Edit new designation question
     * @param array $data tax data
     * @return boolean
     */
    public function designationquestion_edit($data, $id) {


        $udata['designation_ids'] = implode(",", $data["designation_id"]);
        $udata['interview_round'] = implode(",", $data["interview_round"]);
        $udata['remark'] = $data["remark"];
        $this->db->where('id', $id);
        $update = $this->db->update("tbldesignationquestion", $udata);
        if ($update) {

            /* this is for delete old record */
            $this->db->where('designationquestion_id', $id);
            $this->db->delete("tbldesignationwisequestion");

            if(!empty($data['question'])){
                foreach($data['question'] as $ques) {

                    $addata['designationquestion_id'] = $id;
                    $addata['question'] = $ques;

                    $this->db->insert("tbldesignationwisequestion", $addata);
                }
            }
            return true;
        }

        return false;
    }

    public function designationquestion_delete($id) {

        $this->db->where('id', $id);
        $this->db->delete("tbldesignationquestion");
        if ($this->db->affected_rows() > 0) {

            $this->db->where('designationquestion_id', $id);
            $this->db->delete("tbldesignationwisequestion");
            return true;
        }

        return false;
    }

    /**
     * Add new designation skills
     * @param array $data tax data
     * @return boolean
     */
    public function designationskill_add($data) {

        $adata['staff_id'] = get_staff_user_id();
        $adata['designation_ids'] = implode(",", $data["designation_id"]);
        $adata['date'] = date("Y-m-d");
        $adata['remark'] = $data["remark"];
        $adata['status'] = 1;
        $adata['created_at'] = date("Y-m-d H:i:s");
        $adata['updated_at'] = date("Y-m-d H:i:s");

        $this->db->insert("tbldesignationskills", $adata);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

            if(!empty($data['skill'])){
                foreach($data['skill'] as $skills) {

                    $addata['designationskills_id'] = $insert_id;
                    $addata['skills'] = $skills;
                    $this->db->insert("tbldesignationskillsdetails", $addata);
                }
            }

            return $insert_id;
        }

        return false;
    }

    /**
     * Edit new designation skill
     * @param array $data tax data
     * @return boolean
     */
    public function designationskill_edit($data, $id) {


        $udata['designation_ids'] = implode(",", $data["designation_id"]);
        $udata['remark'] = $data["remark"];
        $this->db->where('id', $id);
        $update = $this->db->update("tbldesignationskills", $udata);
        if ($update) {

            /* this is for delete old record */
            $this->db->where('designationskills_id', $id);
            $this->db->delete("tbldesignationskillsdetails");

            if(!empty($data['skill'])){
                foreach($data['skill'] as $skill) {

                    $addata['designationskills_id'] = $id;
                    $addata['skills'] = $skill;

                    $this->db->insert("tbldesignationskillsdetails", $addata);
                }
            }
            return true;
        }

        return false;
    }

    public function designationskills_delete($id) {

        $this->db->where('id', $id);
        $this->db->delete("tbldesignationskills");
        if ($this->db->affected_rows() > 0) {

            $this->db->where('designationskills_id', $id);
            $this->db->delete("tbldesignationskillsdetails");
            return true;
        }
        return false;
    }
}
