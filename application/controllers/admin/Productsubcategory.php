<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productsubcategory extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Product_sub_category_model');
        $this->load->model('home_model');
    }

    /* List all Product category Master */

    public function index() {
        check_permission('75,246','view');

        $data['category_info']  = $this->db->query("SELECT * FROM tblproductsubcategory order by id DESC ")->result();

        $this->load->view('admin/product_sub_category/manage_root_category', $data);
    }

    public function productsubcategory($id = '', $type = '') {
        check_permission('75,246','create');
        if ($this->input->post()) {
            $category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Product_sub_category_model->add($category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Product Root Category'));
                    redirect(admin_url('productsubcategory'));
                }
            } else {
                check_permission('75,246','edit');
                $success = $this->Product_sub_category_model->edit($category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Product Root Category'));
                }
                $redirect = ($type == "categorytree") ? 'productsubcategory/product_category_tree' : 'productsubcategory';
                redirect(admin_url($redirect));
            }
        }

        if ($id == '') {
            $title = 'Add New Root Category';
        } else {
            $data['product_sub_category_data'] = (array) $this->Product_sub_category_model->get($id);
            $title = _l('edit', _l('product_sub_category_lowercase'));
        }

        $data['title'] = $title;

        $this->load->model('Product_category_model');
        $data['pro_category_data'] = $this->Product_category_model->get();
        $this->load->view('admin/product_sub_category/product_root_category', $data);
    }


    public function delete($id) {
        check_permission('75,246','delete');

       // $products_log = $this->db->query("SELECT * FROM `tblproducts_log` Where product_sub_cat_id = '".$id."' ")->row();
        $pro_parent_category = $this->db->query("SELECT * FROM `tblproductparentcategory` Where root_category_id = '".$id."' ")->row();
        $enquirycall = $this->db->query("SELECT * FROM `tblenquirycall` Where sub_category_id = '".$id."' ")->row();
        $products = $this->db->query("SELECT * FROM `tblproducts` Where product_sub_cat_id = '".$id."' ")->row();
        $chk_pro_cust_fields = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` Where product_sub_cat_id = '".$id."' ")->row();

        if (!empty($pro_parent_category) OR !empty($enquirycall) OR !empty($products) OR !empty($chk_pro_cust_fields)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $success = $this->Product_sub_category_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('product_sub_category')));
            if (strpos($_SERVER['HTTP_REFERER'], 'productsubcategory/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('productsubcategory'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('product_sub_category_lowercase')));
            redirect(admin_url('productsubcategory/productsubcategory/' . $id));
        }
    }

    /* Change Unit status / active / inactive */

    public function change_Product_sub_category_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $category_data = array(
                'status' => $status
            );

            $this->Product_sub_category_model->edit($category_data, $id);
        }
    }



    public function manage_parentcategory() {
        check_permission('76,247','view');

        $data['category_info']  = $this->db->query("SELECT * FROM tblproductparentcategory order by id DESC ")->result();

        $this->load->view('admin/product_sub_category/manage_parentcategory', $data);
    }

    public function parentcategory($id = '', $type = '') {
        check_permission('76,247','create');
        if ($this->input->post()) {
            $category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Product_sub_category_model->add_parent($category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Product Root Category'));
                    redirect(admin_url('productsubcategory/manage_parentcategory'));
                }
            } else {
                check_permission('76,247','edit');
                $success = $this->Product_sub_category_model->edit_parent($category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Product Parent Category'));
                }
                $redirect = ($type == "categorytree") ? 'productsubcategory/product_category_tree' : 'productsubcategory/manage_parentcategory';
                redirect(admin_url($redirect));
            }
        }

        if ($id == '') {
            $title = 'Add New Parent Category';
        } else {
            $data['product_sub_category_data'] = $this->db->query("SELECT * FROM tblproductparentcategory where id = '".$id."' ")->row_array();
            $title = _l('edit', _l('product_sub_category_lowercase'));
        }

        $data['title'] = $title;

        $data['pro_category_data'] = $this->db->query("SELECT * FROM tblproductsubcategory where status = 1 order by name asc ")->result_array();
        $this->load->view('admin/product_sub_category/parentcategory', $data);
    }

    public function change_parent_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $category_data = array(
                'status' => $status
            );

            $this->home_model->update('tblproductparentcategory',$category_data,array('id'=>$id));
        }
    }


    public function delete_parent($id) {
        check_permission('76,247','delete');

        $products_log = $this->db->query("SELECT * FROM `tblproducts_log` Where parent_category_id = '".$id."' ")->row();
        $products = $this->db->query("SELECT * FROM `tblproducts` Where parent_category_id = '".$id."' ")->row();
        $chk_pro_cust_fields = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` Where parent_category_id = '".$id."' ")->row();
        $chk_pro_child = $this->db->query("SELECT * FROM `tblproductchildcategory` Where parent_category_id = '".$id."' ")->row();

        if (!empty($chk_pro_child) OR !empty($products_log) OR !empty($products) OR !empty($chk_pro_cust_fields)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $success = $this->home_model->delete('tblproductparentcategory',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'Product parent category'));
            redirect($_SERVER['HTTP_REFERER']);

        }
    }



     public function manage_childcategory() {
        check_permission('77,248','view');

        $data['category_info']  = $this->db->query("SELECT * FROM tblproductchildcategory order by id DESC ")->result();

        $this->load->view('admin/product_sub_category/manage_childcategory', $data);
    }

    public function childcategory($id = '', $type = '') {
        check_permission('77,248','create');
        if ($this->input->post()) {
            $category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Product_sub_category_model->add_child($category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Product Child Category'));
                    redirect(admin_url('productsubcategory/manage_childcategory'));
                }
            } else {
                check_permission('77,248','edit');
                $success = $this->Product_sub_category_model->edit_child($category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Product Child Category'));
                }
                $redirect = ($type == "categorytree") ? 'productsubcategory/product_category_tree' : 'productsubcategory/manage_childcategory';
                redirect(admin_url($redirect));
            }
        }

        if ($id == '') {
            $title = 'Add New Child Category';
        } else {
            $data['product_sub_category_data'] = $this->db->query("SELECT * FROM tblproductchildcategory where id = '".$id."' ")->row_array();
            $title = _l('edit', _l('product_sub_category_lowercase'));
        }

        $data['title'] = $title;

        $data['pro_category_data'] = $this->db->query("SELECT * FROM tblproductparentcategory where status = 1 order by name asc ")->result_array();
        $this->load->view('admin/product_sub_category/childcategory', $data);
    }

    public function change_child_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $category_data = array(
                'status' => $status
            );

            $this->home_model->update('tblproductchildcategory',$category_data,array('id'=>$id));
        }
    }


    public function delete_child($id) {
        check_permission('77,248','delete');

        $products_log = $this->db->query("SELECT * FROM `tblproducts_log` Where child_category_id = '".$id."' ")->row();
        $products = $this->db->query("SELECT * FROM `tblproducts` Where child_category_id = '".$id."' ")->row();
        $chk_pro_cust_fields = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` Where child_category_id = '".$id."' ")->row();

        if (!empty($products_log) OR !empty($products) OR !empty($chk_pro_cust_fields)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $success = $this->home_model->delete('tblproductchildcategory',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'Product parent category'));
            redirect($_SERVER['HTTP_REFERER']);

        }
    }

    /* this function use for get product category tee */
    public function product_category_tree() {
        $data['title'] = 'Product Category Tree';
        $data['category_list'] = get_product_category_list("category");
        $this->load->view('admin/product_sub_category/product_category_tree', $data);
    }
}
