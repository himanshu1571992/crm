<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productcategory extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Product_category_model');
        $this->load->model('home_model');
    }

    /* List all Product category Master */

    public function index() {
        check_permission('74,245','view');

        $data['unit_data'] = $this->Product_category_model->get();

        $this->load->view('admin/product_category/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('productcategory');
    }

    public function productcategory($id = '', $type = '') {
        check_permission('74,245','create');
        if ($this->input->post()) {
            $category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Product_category_model->add($category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('product_category')));
                    redirect(admin_url('productcategory'));
                }
            } else {
                check_permission('74,245','edit');
                $success = $this->Product_category_model->edit($category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('product_category')));
                }
                $redirect = ($type == "categorytree") ? 'productsubcategory/product_category_tree' : 'productcategory';
                redirect(admin_url($redirect));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('product_category_lowercase'));
        } else {
            $data['product_category_data'] = (array) $this->Product_category_model->get($id);
            $title = _l('edit', _l('product_category_lowercase'));
        }

        $data['title'] = $title;
		$this->load->model('Multiselect_model');
		$data['multiselect_data'] = $this->Multiselect_model->get();
        $this->load->view('admin/product_category/product_category', $data);
    }

    public function delete($id) {
        check_permission('74,245','delete');
        
       // $products_log = $this->db->query("SELECT * FROM `tblproducts_log` Where product_cat_id = '".$id."' ")->row();
        $products = $this->db->query("SELECT * FROM `tblproducts` Where product_cat_id = '".$id."' ")->row();
        $temp_product = $this->db->query("SELECT * FROM `tbltemperoryproduct` Where category_id = '".$id."' ")->row();
        $proquestions = $this->db->query("SELECT * FROM `tblproductquestions` Where product_category_id = '".$id."' ")->row();
        $chk_tempbillofmaterial = $this->db->query("SELECT * FROM `tbltempbillofmaterial` Where category_id = '".$id."' ")->row();
        $chk_multiselect = $this->db->query("SELECT * FROM `tblcategorymultiselect` Where category_id = '".$id."' ")->row();
        $chk_pro_sub_category = $this->db->query("SELECT * FROM `tblproductsubcategory` Where category_id = '".$id."' ")->row();
        $chk_pro_cust_fields = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` Where product_cat_id = '".$id."' ")->row();
        
        if (!empty($chk_pro_sub_category) OR !empty($chk_pro_cust_fields) OR !empty($products) OR !empty($temp_product) OR !empty($proquestions) OR !empty($chk_tempbillofmaterial) OR !empty($chk_multiselect)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $success = $this->Product_category_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('product_category')));
            if (strpos($_SERVER['HTTP_REFERER'], 'productcategory/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('productcategory'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('product_category_lowercase')));
            redirect(admin_url('productcategory/productcategory/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_product_category_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $category_data = array(
                'status' => $status
            );
            
            $this->Product_category_model->edit($category_data, $id);
        }
    }

    /* this is for materialgradelist */
    public function materialgradelist(){
        $data["title"] = "Material Grade List";
        check_permission(357,'view');
        $data['materialgradelist']  = $this->db->query("SELECT * FROM tblmaterialgrade order by id desc")->result();
        $this->load->view('admin/product_category/material_grade', $data);
    }
    
    /* this function use for add / edit material grade */
    public function addmaterialgrade($id = ""){
        if ($this->input->post()) {
            extract($this->input->post());
            
            $insert_data["title"] = $title;
            $insert_data["thickness"] = $thickness;
            $insert_data["remark"] = $remark;
            $insert_data["updated_at"] = date("Y-m-d H:i:s");
            if ($id == '') {
                
                $insert_data["added_by"] = get_staff_user_id();
                $insert_data["status"] = 1;
                $insert_data["created_at"] = date("Y-m-d H:i:s");
                $insert_id = $this->home_model->insert("tblmaterialgrade", $insert_data);
                if ($insert_id) {
                    set_alert('success', "Add Material Grade Successfully");
                }else{
                    set_alert('warning', "Somthing went wrong");
                }
                redirect(admin_url('productcategory/materialgradelist'));
            } else {
                $update = $this->home_model->update("tblmaterialgrade", $insert_data, array("id" => $id));
                if ($update) {
                    set_alert('success', "Update Material Grade Successfully");
                    redirect(admin_url('productcategory/materialgradelist'));
                }
            }
        }

        if ($id == '') {
            check_permission(357,'create');
            $title = "Add Material Grade";
        } else {
            check_permission(357,'edit');
            $data['material_data'] = $this->db->query("SELECT * FROM tblmaterialgrade WHERE id = '".$id."'")->row();
            $title = "Edit Material Grade";
        }

        $data['title'] = $title;
        $this->load->view('admin/product_category/material_grade_add', $data);
        
    }
    
    /* this function use for delete materialgrade */
    public function materialgrade_delete($id){
        check_permission(357,'delete');
        $response = $this->home_model->delete("tblmaterialgrade", array("id" => $id));
        if ($response) {
            set_alert('success', "Material grade deleted successfully");
        } else {
            set_alert('warning', "Somthing went wrong");
        }
        redirect(admin_url('productcategory/materialgradelist'));
    }               
    
    /* Change material grade status / active / inactive */

    public function change_materialgrade_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $data = array(
                'status' => $status
            );
            
            $this->home_model->update("tblmaterialgrade", $data, array("id" => $id));
        }
    }
    
    /* this is for product material */
    public function product_material(){
        check_permission(356,'view');
        $data["title"] = "Product Material List";
        
        $data['productmaterial_list']  = $this->db->query("SELECT * FROM tblproductmaterial order by id desc")->result();
        $this->load->view('admin/product_category/productmaterial_list', $data);
    }
    
    /* this function use for add / edit product material */
    public function addProductMaterial($id = ""){
        if ($this->input->post()) {
            extract($this->input->post());

            $insert_data["name"] = $name;
            $insert_data["coilPipePrice"] = $coilPipePrice;
            $insert_data["nonCoilPipePrice"] = $nonCoilPipePrice;
            $insert_data["remark"] = $remark;
            $insert_data["update_date"] = date("Y-m-d");
            if(!empty($product_fields)){
                $insert_data["product_fields"] = implode(",", $product_fields);
            }
            if ($id == '') {
                
                $insert_data["status"] = 1;
                $insert_data["created_at"] = date("Y-m-d H:i:s");
                $insert_id = $this->home_model->insert("tblproductmaterial", $insert_data);
                if ($insert_id) {
                    set_alert('success', "Add Product Material Successfully");
                }else{
                    set_alert('warning', "Somthing went wrong");
                }
                redirect(admin_url('productcategory/product_material'));
            } else {
                $update = $this->home_model->update("tblproductmaterial", $insert_data, array("id" => $id));
                if ($update) {
                    set_alert('success', "Update Product Material Successfully");
                    redirect(admin_url('productcategory/product_material'));
                }
            }
        }

        if ($id == '') {
            check_permission(356,'create');
            $title = "Add Product Material";
            $section = "add";
        } else {
            check_permission(356,'edit');
            $data['material_data'] = $this->db->query("SELECT * FROM tblproductmaterial WHERE id = '".$id."'")->row();
            $title = "Edit Product Material";
            $section = "edit";
        }

        $data['title'] = $title;
        $data['section'] = $section;
        $this->load->view('admin/product_category/productmaterial_add', $data);
    }
    
    /* this function use for delete product material */
    public function deleteProductMaterial($id){
        check_permission(356,'delete');
        $response = $this->home_model->delete("tblproductmaterial", array("id" => $id));
        if ($response) {
            set_alert('success', "Product Material deleted successfully");
        } else {
            set_alert('warning', "Somthing went wrong");
        }
        redirect(admin_url('productcategory/product_material'));
    }            
    
    /* this function use for row material rate list*/
    public function raw_material_ratelist(){
        $data["title"] = "Raw Material Rate List";
        check_permission(358,'view');
        if(!empty($_POST)){

            extract($this->input->post());
            $data = $this->input->post();
            foreach ($data["rate"] as $category_id => $value) {
                $isChanges = "No";
                $info = $this->db->query("SELECT `coilPipePrice`,`nonCoilPipePrice` FROM tblproductmaterial WHERE id = '".$category_id."'")->row();
                if ($info){
                    if((!empty($value["coilpipe"]) && ($info->coilPipePrice != $value["coilpipe"])) OR (!empty($value["noncoilpipe"]) && $info->nonCoilPipePrice != $value["noncoilpipe"])){
                        $isChanges = "Yes";
                    }
                }
                
                if ($isChanges == "Yes"){
                    $updatedata["coilPipePrice"] = $value["coilpipe"];
                    $updatedata["nonCoilPipePrice"] = $value["noncoilpipe"];
                    $updatedata["update_date"] = date("Y-m-d");
                    $this->home_model->update("tblproductmaterial", $updatedata, array("id" => $category_id));
                }
            }
            set_alert('success', "Row material rate update Successfully");
            redirect(admin_url('productcategory/raw_material_ratelist'));
        }
        $data['category_info'] = $this->db->query("SELECT * FROM tblproductmaterial WHERE status = 1 and is_standard = 0 ORDER BY id ASC")->result();
        $this->load->view('admin/product_category/material_ratelist', $data);
    }
    
    /* Change Product Material status / active / inactive */

    public function change_productmaterial_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $data = array(
                'status' => $status
            );
            
            $this->home_model->update("tblproductmaterial", $data, array("id" => $id));
        }
    }
}
