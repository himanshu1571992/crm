<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enquirytype extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Enquirytype_model');
        $this->load->model('Home_model');
    }

    /* List all Enquiry type Master */

    public function index() {
        check_permission('11,239','view');

        $data['unit_data'] = $this->Enquirytype_model->get();
        $data['main_enquiry_type_list'] = $this->db->query("SELECT * FROM `tblmainenquirytypemaster` WHERE `status` = 1")->result();
        $this->load->view('admin/enquiry_type_master/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('enquirytype');
    }

    public function enquirytype($id = '') {
        check_permission('11,239','create');
        if ($this->input->post()) {
            $enquirytype_data = $this->input->post();
            if ($id == '') {

                $id = $this->Enquirytype_model->add($enquirytype_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('enquiry_type')));
                    redirect(admin_url('enquirytype'));
                }
            } else {
                check_permission('11,239','edit');
                $success = $this->Enquirytype_model->edit($enquirytype_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('enquiry_type')));
                }

                redirect(admin_url('enquirytype'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('enquiry_type_lowercase'));
        } else {
            $data['enquirytype'] = (array) $this->Enquirytype_model->get($id);
            $title = _l('edit', _l('enquiry_type_lowercase'));
        }

        $data['main_enquiry_type_list'] = $this->db->query("SELECT * FROM `tblmainenquirytypemaster` WHERE `status` = 1 ORDER BY name ASC")->result();
        $data['title'] = $title;
        $this->load->view('admin/enquiry_type_master/enquirytype', $data);
    }

    public function delete($id) {
        check_permission('11,239','delete');

        $query = $this->db->query("SELECT * FROM `tblleads` Where enquiry_type_id = '".$id."' ");
        if($query)
        {
           set_alert('warning', 'Already exist');
           redirect($_SERVER['HTTP_REFERER']); die;
        }

        $query1 = $this->db->query("SELECT * FROM `tblestimates` Where proforma_type = '".$id."' ");
        if($query1)
        {
           set_alert('warning', 'Already exist');
           redirect($_SERVER['HTTP_REFERER']); die;
        }

        $success = $this->Enquirytype_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('enquiry_type')));
            if (strpos($_SERVER['HTTP_REFERER'], 'enquirytype/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('enquirytype'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('enquiry_type_lowercase')));
            redirect(admin_url('enquirytype/enquirytype/' . $id));
        }
    }

    /* Change enquiry type status / active / inactive */

    public function change_enquirytype_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );

            $this->Enquirytype_model->edit($unit_data, $id);
        }
    }

    public function main_lead_status() {
        // check_permission('11,239','view');

        $data['unit_data'] = $this->Enquirytype_model->get();

        $this->load->view('admin/enquiry_type_master/manage_lead_status', $data);
    }

    public function main_lead_table() {
        $this->app->get_table_data('main_lead_list');
    }

    public function addmainleadstatus($id = '') {
        // check_permission('11,239','create');
        if ($this->input->post()) {
            $enquirytype_data = $this->input->post();
            if ($id == '') {

                $id = $this->Enquirytype_model->addmainleadstatus($enquirytype_data);
                if ($id) {
                    set_alert('success', "New Lead Status Add Successfully");
                    redirect(admin_url('enquirytype/main_lead_status'));
                }
            } else {
                // check_permission('11,239','edit');
                $success = $this->Enquirytype_model->editmainleadstatus($enquirytype_data, $id);
                if ($success) {
                    set_alert('success', "Lead Status Update Successfully");
                }

                redirect(admin_url('enquirytype/main_lead_status'));
            }
        }

        if ($id == '') {
            $title = "Add New Lead Status";
        } else {
            $data['enquirytype'] = (array) $this->Enquirytype_model->get($id);
            $title = "Edit Lead Status";
        }

        $data['title'] = $title;
        $this->load->view('admin/enquiry_type_master/mainleadstatus', $data);
    }

    public function deletemainleadstatus($id) {
        // check_permission('11,239','delete');

        $query = $this->db->query("SELECT * FROM `tblleads` Where enquiry_type_main_id = '".$id."' ")->row();
        if($query)
        {
           set_alert('warning', 'Already exist');
           redirect($_SERVER['HTTP_REFERER']); die;
        }
        $chk_table2 = $this->db->query("SELECT * FROM `tblenquirytypemaster` Where enquiry_type_main_id = '".$id."' ")->row();
        if($chk_table2)
        {
           set_alert('warning', 'Already exist');
           redirect($_SERVER['HTTP_REFERER']); die;
        }

        $success = $this->Enquirytype_model->deletemainleadstatus($id);
        if ($success) {
            set_alert('success', "Lead Status Deleted Successfully");
            if (strpos($_SERVER['HTTP_REFERER'], 'enquirytype/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('enquirytype/main_lead_status'));
            }
        } else {
            set_alert('warning', "Somthing went worng");
            redirect(admin_url('enquirytype/main_lead_status/' . $id));
        }
    }

    public function setmaincategory(){
        if (!empty($_POST)){
            $enquiry_type_id = $_POST["enquiry_type_id"];
            $enquiry_type_main_id = $_POST["enquiry_type_main_id"];

            $this->db->where('id', $enquiry_type_id);
            $this->db->update("tblenquirytypemaster", array("enquiry_type_main_id" => $enquiry_type_main_id));

            if ($this->db->affected_rows() > 0) {
                set_alert('success', "Set Main Category Successfully");
            }else{
                set_alert('warning', "Somthing went worng");
            }
            redirect(admin_url('enquirytype'));
        }
    }

    public function unverified_lead(){
        check_permission(380,'view');
        $data['unverified_lead_list'] = $this->db->query("SELECT * FROM tblunverifedleadmaster ORDER BY id DESC ")->result();

        $data['title'] = 'Unverified Lead Status';
        $this->load->view('admin/enquiry_type_master/unverified_lead', $data);
    }

    public function addunverifiedlead($id = ''){
        
        if ($this->input->post()) {
            $post_data = $this->input->post();
            $data["title"] = $post_data["title"];
            $data["status"] = $post_data["status"];
            $data["description"] = $post_data["description"];
            $data["created_at"] = date("Y-m-d H:i:s");
            $data["updated_at"] = date("Y-m-d H:i:s");
            if ($id == '') {

                $id = $this->Home_model->insert("tblunverifedleadmaster", $data);
                if ($id) {
                    set_alert('success', "Unverified Lead Add Successfully");
                    redirect(admin_url('enquirytype/unverified_lead'));
                }
            } else {
                $success = $this->Home_model->update("tblunverifedleadmaster", $data, array("id" => $id));
                if ($success) {
                    set_alert('success', "Unverified Lead Update Successfully");
                }

                redirect(admin_url('enquirytype/unverified_lead'));
            }
        }

        if ($id == '') {
            check_permission(380,'create');
            $title = "Add Unverified Lead Status";
        } else {
            check_permission(380,'edit');
            $data['unverified_leadinfo'] = $this->db->query("SELECT * FROM `tblunverifedleadmaster` WHERE id = ".$id." ")->row();
            $title = "Edit Unverified Lead Status";
        }

        $data['title'] = $title;
        $this->load->view('admin/enquiry_type_master/addunverifiedlead', $data);
    }

    /* Change unverified lead status / active / inactive */

    public function change_unverifiedlead_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );
            $this->Home_model->update("tblunverifedleadmaster", $unit_data, array("id" => $id));
        }
    }

    public function deleteunverifiedlead($id) {
        check_permission(380,'delete');
        $chk_query = $this->db->query("SELECT * FROM tblenquirycall WHERE unverified_status_id = '".$id."' ")->row();
        if (!empty($chk_query)){
            set_alert('warning', "Can't be deleted, this is used somewhere.");
            redirect(admin_url('enquirytype/lead_category'));
        }
        $success = $this->Home_model->delete("tblunverifedleadmaster", array("id" => $id));
        if ($success) {
            set_alert('success', "Unverified Lead Deleted Successfully");
            if (strpos($_SERVER['HTTP_REFERER'], 'enquirytype/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('enquirytype/unverified_lead'));
            }
        } else {
            set_alert('warning', "Somthing went worng");
            redirect(admin_url('enquirytype/unverified_lead/' . $id));
        }
    }

    /* this function use for lead category master */
    public function lead_category(){
        check_permission(383,'view');
        $data['lead_category_list'] = $this->db->query("SELECT * FROM tblleadcategorymaster ORDER BY id DESC ")->result();

        $data['title'] = 'Lead Category List';
        $this->load->view('admin/enquiry_type_master/lead_category_list', $data);
    }

    public function addleadcategory($id = ''){
        
        if ($this->input->post()) {
            $post_data = $this->input->post();
            $data["title"] = $post_data["title"];
            $data["status"] = $post_data["status"];
            $data["description"] = $post_data["description"];
            $data["created_at"] = date("Y-m-d H:i:s");
            $data["updated_at"] = date("Y-m-d H:i:s");
            if ($id == '') {

                $id = $this->Home_model->insert("tblleadcategorymaster", $data);
                if ($id) {
                    set_alert('success', "Lead Category Add Successfully");
                    redirect(admin_url('enquirytype/lead_category'));
                }
            } else {
                $success = $this->Home_model->update("tblleadcategorymaster", $data, array("id" => $id));
                if ($success) {
                    set_alert('success', "Lead Category Update Successfully");
                }

                redirect(admin_url('enquirytype/lead_category'));
            }
        }

        if ($id == '') {
            check_permission(383,'create');
            $title = "Add Lead Category";
        } else {
            check_permission(383,'edit');
            $data['lead_cateory_info'] = $this->db->query("SELECT * FROM `tblleadcategorymaster` WHERE id = ".$id." ")->row();
            $title = "Edit Lead Category";
        }

        $data['title'] = $title;
        $this->load->view('admin/enquiry_type_master/addleadcategory', $data);
    }

    public function deleteleadcategory($id) {
        check_permission(383,'delete');
        $chk_query = $this->db->query("SELECT * FROM tblenquirycall WHERE lead_category_id = '".$id."' ")->row();
        if (!empty($chk_query)){
            set_alert('warning', "Can't be deleted, this is used somewhere.");
            redirect(admin_url('enquirytype/lead_category'));
        }

        $success = $this->Home_model->delete("tblleadcategorymaster", array("id" => $id));
        if ($success) {
            set_alert('success', "Lead Category Deleted Successfully");
            if (strpos($_SERVER['HTTP_REFERER'], 'enquirytype/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('enquirytype/lead_category'));
            }
        } else {
            set_alert('warning', "Somthing went worng");
            redirect(admin_url('enquirytype/lead_category/' . $id));
        }
    }
}
