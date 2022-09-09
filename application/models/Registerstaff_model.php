<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Registerstaff_model extends CRM_Model {
    
  public function __construct() {
        parent::__construct();
  }


  public function add($data) {

//    echo '<pre>';
//    print_r($data);
//    exit;
      
      if(isset($data["candidate_id"]) && !empty($data["candidate_id"])){
          $ad_data['designation_id'] = value_by_id("tblstaffinterviewdetails", $data["candidate_id"], "designation_id");
      }
    
    $ad_data['employee_name'] = $data['employee_name'];

    $ad_data['email'] = $data['email'];

    $ad_data['contact_no'] = $data['contact_no'];

    $birth_date = $data['birth_date'];

    $ad_data['birth_date']=db_date($birth_date);

    $ad_data['gender'] = $data['gender'];

    $ad_data['pan_card_no'] = $data['pan_card_no'];

    $ad_data['adhar_no'] = $data['adhar_no'];

    $ad_data['branch_id'] = $data['branch_id'];

    $ad_data['residential_pincode'] = $data['residential_pincode'];

    $ad_data['residential_address'] = $data['residential_address'];

    $ad_data['residential_state'] = $data['residential_state'];

    $ad_data['residential_city'] = $data['residential_city'];

    $ad_data['permenent_address'] = $data['permenent_address'];

    $ad_data['permenent_pincode'] = $data['permenent_pincode'];

    $ad_data['permenent_state'] = $data['permenent_state'];

    $ad_data['permenent_city'] = $data['permenent_city'];

    $ad_data['bank_name'] = $data['bank_name'];
    
    $ad_data['account_no'] = $data['account_no'];

    $ad_data['ifc_code'] = $data['ifc_code'];

    $ad_data['epf_no'] = $data['epf_no'];

    $ad_data['esic_no'] = $data['esic_no'];
    $ad_data['approval_status'] = 0;

    $ad_data['created_at'] = date('Y-m-d');

    $ad_data['updated_at'] = date('Y-m-d H:i:s');

    $this->db->insert('tblregisteredstaff',$ad_data);

    $insert_id = $this->db->insert_id();

      if($insert_id) {
         $persondata = $data['persondata'];
            
            /* this is code for update registration id in db */
            if(isset($data["candidate_id"]) && !empty($data["candidate_id"])){
                $updata = array(
                    "staffregistration_id" => $insert_id
                );
                $this->db->where("id", $data["candidate_id"]);
                $this->db->update('tblstaffinterviewdetails', $updata);
            }
            
          if(!empty($persondata)){
            foreach ($persondata as $singlepersondata){  
              $perdata['staff_id'] = $insert_id;

              $perdata['contact_no'] = $singlepersondata['contact_no'];

              $perdata['adhar_no'] = $singlepersondata['adhar_no'];

              $date_of_birth = $singlepersondata['date_of_birth'];

              $perdata['date_of_birth']= db_date($date_of_birth);

              $perdata['created_at'] = date('Y-m-d H:i:s');

              $perdata['full_name'] = $singlepersondata['full_name'];

              $perdata['relationship_id'] = $singlepersondata['relationship_id'];

              $this->db->insert('tblregistrationstafffamily', $perdata);

            }

          }

            return $insert_id;
      }

       return false;
  }

  public function getstaffrelationship($id = '') {
    if (is_numeric($id)) {
        $this->db->where('id', $id);

        return $this->db->get($this->table_name_one)->row();

    }
        $this->db->order_by('relationship_order', '');
       
        return $this->db->get('tblregistrationstaffrelationshiptype')->result_array();
  }

}    