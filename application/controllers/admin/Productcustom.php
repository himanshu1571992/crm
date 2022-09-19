<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productcustom extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('home_model');
    }

    /* List all Product category Master */

    public function index() {
        check_permission(290,'view');

        $data['fields_info']  = $this->db->query("SELECT * FROM tblproductcustomfields order by id DESC ")->result();


        $data['title'] = 'Custom Field List'; 
        $this->load->view('admin/product_custom/manage_customfields', $data);
    }

    public function customfield($id = '') {
        check_permission(290,'create');
        if ($this->input->post()) {
            extract($this->input->post());
            if(empty($field_for)){
                $field_for = 0;
            }
            if ($id == '') {

                $ad_data = array(          
                    'added_by' => get_staff_user_id(),                  
                    'name' => $name,
                    'field_for' => $field_for,
                    'type' => $type,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );  
                $insert = $this->home_model->insert('tblproductcustomfields', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'New Field added successfully'));
                    redirect(admin_url('productcustom'));
                }
            } else {
                check_permission(290,'edit');
                $ad_data = array(                            
                    'name' => $name,
                    'field_for' => $field_for,
                    'type' => $type
                );  
                $update = $this->home_model->update('tblproductcustomfields', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Product Field updated successfully');
                }
                redirect(admin_url('productcustom'));
            }
        }

        if ($id == '') {
            $title = 'Add Product Custom Field';
        } else {
            $data['field_info'] = $this->db->query("SELECT * FROM tblproductcustomfields where id = '".$id."' ")->row();
            $title = 'Edit Product Custom Field';
        }

        $data['title'] = $title;
        
        $this->load->view('admin/product_custom/customfield', $data);
    }


    public function manage_assignfields() {
        check_permission(292,'view');

        $where = "id > 0 ";
        if($this->input->post()) {
            extract($this->input->post());
            if(!empty($category_type)){
                $where .= "and final_category = '".$category_type."'";
                $data['category_type'] = $category_type;
            }

            if(!empty($product_cat_id)){
                $where .= "and product_cat_id = '".$product_cat_id."'";
                $data['product_cat_id'] = $product_cat_id;
            }

            if(!empty($product_sub_cat_id)){
                $where .= "and product_sub_cat_id = '".$product_sub_cat_id."'";
                $data['product_sub_cat_id'] = $product_sub_cat_id;
                $data['parent_category_info'] = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$product_sub_cat_id."' ")->result_array();
            }

            if(!empty($parent_category_id)){
                $where .= "and parent_category_id = '".$parent_category_id."'";
                $data['parent_category_id'] = $parent_category_id;
                $data['child_category_info'] = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$parent_category_id."' ")->result_array();
            }

            if(!empty($child_category_id)){
                $where .= "and child_category_id = '".$child_category_id."'";
                $data['child_category_id'] = $child_category_id;
            }
        }
        $data['fields_info']  = $this->db->query("SELECT * FROM tblproductcustomfieldscategory where ".$where." order by id DESC ")->result();

        $this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->get();
        
        $this->load->model('Product_sub_category_model');
        $data['pro_sub_cat_data'] = $this->Product_sub_category_model->get();

        $data['title'] = 'Custom Field Assigned List'; 
        $this->load->view('admin/product_custom/manage_assignfields', $data);
    }

    public function assignfields($id = '') {
        check_permission(292,'create');
        if ($this->input->post()) {
            extract($this->input->post());
            if ($id == '') {
                /*echo '<pre/>';
                print_r($_POST);
                die;*/
                $final_category = 1;
                $final_category_id = $product_cat_id;
                if(!empty($product_sub_cat_id)){
                    $final_category_id = $product_sub_cat_id;
                    $final_category = 2;
                }if(!empty($parent_category_id)){
                    $final_category_id = $parent_category_id;
                    $final_category = 3;
                }if(!empty($child_category_id)){
                    $final_category_id = $child_category_id;
                    $final_category = 4;
                }

                $ad_data = array(    
                    'added_by' => get_staff_user_id(),                        
                    'product_cat_id' => $product_cat_id,
                    'product_sub_cat_id' => $product_sub_cat_id,
                    'parent_category_id' => $parent_category_id,
                    'child_category_id' => $child_category_id,
                    'final_category_id' => $final_category_id,
                    'final_category' => $final_category,
                    'created_date' => date('Y-m-d H:i:s')
                );  
                $insert = $this->home_model->insert('tblproductcustomfieldscategory', $ad_data);
                if ($insert) {
                    $main_id = $this->db->insert_id();
                    if(!empty($field_data)){
                        foreach ($field_data as $key => $value) {
                            
                            if(!empty($value['field_id'])){
                                $size = 4;
                                $required = 0;
                                if(!empty($value['size'])){
                                    $size = $value['size'];
                                }
                                if(!empty($value['required'])){
                                    $required = $value['required'];
                                }
                                $ad_data = array(                            
                                    'main_id' => $main_id,
                                    'field_id' => $value['field_id'],
                                    'size' => $size,
                                    'field_order' => $value['field_order'],
                                    'required' => $required
                                );  
                                $insert = $this->home_model->insert('tblproductcustomfieldscategorydata', $ad_data);   
                            }
                        }
                    }
                    set_alert('success', _l('added_successfully', 'Field assigned successfully'));
                    redirect(admin_url('productcustom/assignfields'));
                }
            } else {
                check_permission(292,'edit');
                $final_category = 1;
                $final_category_id = $product_cat_id;
                if(!empty($product_sub_cat_id)){
                    $final_category_id = $product_sub_cat_id;
                    $final_category = 2;
                }if(!empty($parent_category_id)){
                    $final_category_id = $parent_category_id;
                    $final_category = 3;
                    
                }if(!empty($child_category_id)){
                    $final_category_id = $child_category_id;
                    $final_category = 4;
                }
                
                $ad_data = array(                            
                    'product_cat_id' => $product_cat_id,
                    'product_sub_cat_id' => $product_sub_cat_id,
                    'parent_category_id' => $parent_category_id,
                    'child_category_id' => $child_category_id,
                    'final_category' => $final_category,
                    'final_category_id' => $final_category_id
                );  
                $update = $this->home_model->update('tblproductcustomfieldscategory', $ad_data, array('id'=>$id));
                if ($update) {
                    if(!empty($field_data)){
                        $this->home_model->delete('tblproductcustomfieldscategorydata',array('main_id'=>$id));
                        foreach ($field_data as $key => $value) {
                            
                            if(!empty($value['field_id'])){
                                $size = 4;
                                $required = 0;
                                if(!empty($value['size'])){
                                    $size = $value['size'];
                                }
                                if(!empty($value['required'])){
                                    $required = $value['required'];
                                }
                                $ad_data = array(                            
                                    'main_id' => $id,
                                    'field_id' => $value['field_id'],
                                    'size' => $size,
                                    'field_order' => $value['field_order'],
                                    'required' => $required
                                );  
                                $insert = $this->home_model->insert('tblproductcustomfieldscategorydata', $ad_data);   
                            }
                        }
                    }
                    set_alert('success', 'Product Field updated successfully');
                }
                redirect(admin_url('productcustom'));
            }
        }

        if ($id == '') {
            $title = 'Add Product Category Field';
        } else {
            $data['edit_info'] = $this->db->query("SELECT * FROM tblproductcustomfieldscategory where id = '".$id."' ")->row_array();
            $data['parent_category_info'] = $this->db->query("SELECT * FROM `tblproductparentcategory` where `status`='1' and root_category_id = '".$data['edit_info']['product_sub_cat_id']."' ")->result_array();
            $data['child_category_info'] = $this->db->query("SELECT * FROM `tblproductchildcategory` where `status`='1' and parent_category_id = '".$data['edit_info']['parent_category_id']."' ")->result_array();
            $title = 'Edit Product Category Field';
        }

        $this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->get();
        
        $this->load->model('Product_sub_category_model');
        $data['pro_sub_cat_data'] = $this->Product_sub_category_model->get();

        $data['fields_info'] = $this->db->query("SELECT * FROM tblproductcustomfields where status = '1' ")->result();
        $data['title'] = $title;
        
        $this->load->view('admin/product_custom/assignfields', $data);
    }

    public function change_field_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $data = array(
                'status' => $status
            );
            
            $this->home_model->update('tblproductcustomfields',$data,array('id'=>$id));
        }
    }

    /*public function delete_child($id) {
        check_permission(290,'delete');
        $success = $this->home_model->delete('tblproductchildcategory',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'Product parent category'));
            redirect($_SERVER['HTTP_REFERER']);
            
        }
    }*/

}
