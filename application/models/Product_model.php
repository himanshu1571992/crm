<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CRM_Model {

    private $table_name = "tblproducts";

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
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get($this->table_name)->result_array();
    }

    public function getcomponentdata($id = '') {
        if (is_numeric($id)) {
            $this->db->where('product_id', $id);
            return $this->db->get('tblproductcomponents')->result_array();
        }
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get('tblproductcomponents')->result_array();
    }

    /**
     * Add new tax
     * @param array $data tax data
     * @return boolean
     */

    public function add_log($data,$product_id) {


        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['staff_id'] = get_staff_user_id();
        $data['product_id'] = $product_id;

        $data['isOtherCharge'] = value_by_id_empty('tblproductcategory',$data['product_cat_id'],'for_service');

        $procomponnetdata = $data['componnetdata'];
        $productdrawingdata = $data['productdrawing'];
        $fielddata = $data['fielddata'];
        unset($data['productdrawing']);
        unset($data['componnetdata']);
        unset($data['fielddata']);
        $data["sub_name"] = htmlspecialchars($data["sub_name"], ENT_QUOTES);
        // echo "<pre>";
        // print_r($data);
        // exit;

        
        $this->db->insert('tblproducts_log', $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            if(!empty($fielddata)){
                foreach ($fielddata as $key => $value) {
                    $fdata['product_id'] = $insert_id;
                    $fdata['field_id'] = $key;
                    $fdata['field_value'] = $value;
                    $this->db->insert('tblproductsfield_log', $fdata);
                }
            }
            if(!empty($procomponnetdata)){
               foreach ($procomponnetdata as $singlecomponentdata) {
                    if(!empty($singlecomponentdata['componnetid'])){
                        $pcata['product_id'] = $insert_id;
                        $pcata['item_id'] = $singlecomponentdata['componnetid'];
                        $pcata['qty'] = $singlecomponentdata['compqty'];
                        $pcata['size'] = $singlecomponentdata['size'];
                        $pcata['status'] = 1;
                        $pcata['created_at'] = date("Y-m-d H:i:s");
                        $pcata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproductitems_log', $pcata);
                    }

                }
            }
            if(!empty($productdrawingdata)){
               foreach ($productdrawingdata as $key => $productdrawing) {
                    if(!empty($productdrawing['drawing_name'])){
                        $pdrawing['product_id'] = $insert_id;
                        $pdrawing['drawing_name'] = $productdrawing['drawing_name'];
                        $pdrawing['drawing_id'] = $productdrawing['drawing_id'];
                        $pdrawing['rev_no'] = $productdrawing['rev_no'];
                        $pdrawing['status'] = 1;
                        $pdrawing['created_at'] = date("Y-m-d H:i:s");
                        $pdrawing['updated_at'] = date("Y-m-d H:i:s");
                        if (isset($productdrawing['files']) && !empty($productdrawing['files'])){
                          $pdrawing['files'] = $productdrawing['files'];
                        }
                        $this->db->insert('tblproductdrawing_log', $pdrawing);
                        $insertid = $this->db->insert_id();
                        $this->product_drawing_upload($insertid, "productdrawing".$key);
                    }

                }
            }

            return $insert_id;
        }

        return false;
    }

    public function add_reject($data,$id) {

        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['staff_id'] = get_staff_user_id();
        $product_id = $data['product_id'];

        $data['isOtherCharge'] = value_by_id_empty('tblproductcategory',$data['product_cat_id'],'for_service');

        $procomponnetdata = $data['componnetdata'];
        $fielddata = $data['fielddata'];
        unset($data['componnetdata']);
        unset($data['fielddata']);
        $this->db->insert('tblproducts_log', $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            if(!empty($fielddata)){
                foreach ($fielddata as $key => $value) {
                    $fdata['product_id'] = $insert_id;
                    $fdata['field_id'] = $key;
                    $fdata['field_value'] = $value;
                    $this->db->insert('tblproductsfield_log', $fdata);
                }
            }
            if(!empty($procomponnetdata)){
               foreach ($procomponnetdata as $singlecomponentdata) {
                    if(!empty($singlecomponentdata['componnetid'])){
                        $pcata['product_id'] = $insert_id;
                        $pcata['item_id'] = $singlecomponentdata['componnetid'];
                        $pcata['qty'] = $singlecomponentdata['compqty'];
                        $pcata['status'] = 1;
                        $pcata['created_at'] = date("Y-m-d H:i:s");
                        $pcata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproductitems_log', $pcata);
                    }

                }
            }

            $approved_status = 1;

            $this->db->where('product_id', $id);
            $this->db->update('tblproductrejectsend', array('status'=>$approved_status,'updated_date'=>date('Y-m-d H:i:s')));

            return $insert_id;
        }

        return false;
    }

    public function add_product_approval($data) {
        $products = $data['row'];
        $assignstaff = $data['assignid'];
        if(!empty($assignstaff)){
            foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
            }
            $staff_id = array_unique($staff_id);
            $staff_str = implode(",",$staff_id);
        }else{
            $staff_str = '';
        }

        $main_data = array(
            'staff_id' => get_staff_user_id(),
            'remark' => $data['remark'],
            'created_date' => date("Y-m-d H:i:s"),
            'updated_date' => date("Y-m-d H:i:s"),
        );

        $this->db->insert('tblproductapprovalsend', $main_data);
        $main_id = $this->db->insert_id();

        if ($main_id) {
            if(!empty($products)){
                foreach ($products as $p_id) {
                    $fdata['main_id'] = $main_id;
                    $fdata['product_id'] = $p_id;
                    $this->db->insert('tblproductapprovalsend_products', $fdata);

                    update_approval_status_tblproducts_log($p_id,1);
                }
            }

            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 10,
                        'description' => 'Product Send to you for Approval',
                        'table_id' => $main_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'product_new/product_approval/' . $main_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Product Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }

            return $main_id;
        }

        return false;
    }

    public function product_approval($data,$id) {

        $product_info = $this->db->query("SELECT * FROM `tblproductapprovalsend_products` where main_id = '".$id."' ")->result();
        $approve_status = 2;
        if(!empty($product_info)){
            foreach ($product_info as $row1) {
                $status = $_POST['status_'.$row1->id];
                $remark = $_POST['remark_'.$row1->id];
                if($status == 1){
                    $approve_status = 1;

                    //Manage tables entries when product is approved
                    $productlog_info = $this->db->query("SELECT * FROM `tblproducts_log` where id = '".$row1->product_id."' ")->row();
                    $productfieldlog_info = $this->db->query("SELECT * FROM `tblproductsfield_log` where product_id = '".$row1->product_id."' ")->result();
                    $productitemlog_info = $this->db->query("SELECT * FROM `tblproductitems_log` where product_id = '".$row1->product_id."' ")->result();
                    $productfiles_log = $this->db->query("SELECT * FROM `tblproductfiles_log` where rel_id = '".$row1->product_id."' ")->result();
                    $productdrawings_log = $this->db->query("SELECT * FROM `tblproductdrawing_log` where `product_id` = '".$row1->product_id."' ")->result();


                    if(!empty($productlog_info)){
                        if($productlog_info->product_id == 0){
                            //Add Product
                            $add_data =  array(
                                'name' => $productlog_info->name,
                                'product_cat_id' => $productlog_info->product_cat_id,
                                'product_sub_cat_id' => $productlog_info->product_sub_cat_id,
                                'parent_category_id' => $productlog_info->parent_category_id,
                                'child_category_id' => $productlog_info->child_category_id,
                                'sub_name' => $productlog_info->sub_name,
                                'price' => $productlog_info->price,
                                'gst_id' => $productlog_info->gst_id,
                                'unit_id' => $productlog_info->unit_id,
                                'size' => $productlog_info->size,
                                'unit_1' => $productlog_info->unit_1,
                                'conversion_1' => $productlog_info->conversion_1,
                                'unit_2' => $productlog_info->unit_2,
                                'conversion_2' => $productlog_info->conversion_2,
                                'photo' => $productlog_info->photo,
                                'faq' => $productlog_info->faq,
                                'merging_remark' => $productlog_info->merging_remark,
                                'isOtherCharge' => $productlog_info->isOtherCharge,
                                'is_varified' => $productlog_info->is_varified,
                                'master_id' => $productlog_info->master_id,
                                'status' => $productlog_info->status,
                                'productmaterial_id' => $productlog_info->productmaterial_id,
                                'width' => $productlog_info->width,
                                'width_mm' => $productlog_info->width_mm,
                                'diameter' => $productlog_info->diameter,
                                'edge_width_small' => $productlog_info->edge_width_small,
                                'edge_width' => $productlog_info->edge_width,
                                'edge_length' => $productlog_info->edge_length,
                                'max_qty' => $productlog_info->max_qty,
                                'min_qty' => $productlog_info->min_qty,
                                'temperoryproduct_id' => $productlog_info->temperoryproduct_id,
                                'division_id' => $productlog_info->division_id,
                                'sub_division_id' => $productlog_info->sub_division_id,
                                'print_thickness' => $productlog_info->print_thickness,
                                'print_diameter' => $productlog_info->print_diameter,
                                'print_width' => $productlog_info->print_width,
                                'print_height' => $productlog_info->print_height,
                                'print_length' => $productlog_info->print_length,
                                'print_range' => $productlog_info->print_range,
                                'print_capacity' => $productlog_info->print_capacity,
                                'is_approved' => 1,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblproducts', $add_data);
                            $product_id = $this->db->insert_id();

                            /* this code use for update product id in product log */
                            $this->home_model->update('tblproducts_log', array('product_id' => $product_id), array("id" => $row1->product_id));

                            //Add Product fields
                            if(!empty($productfieldlog_info)){
                                foreach ($productfieldlog_info as $row2) {
                                    $add_field =  array(
                                        'product_id' => $product_id,
                                        'field_id' => $row2->field_id,
                                        'field_value' => $row2->field_value,
                                    );
                                    $this->db->insert('tblproductsfield', $add_field);
                                }
                            }

                            //Add Product Items
                            if(!empty($productitemlog_info)){
                                foreach ($productitemlog_info as $row3) {
                                    if($row3->item_id > 0){
                                        $add_items =  array(
                                            'product_id' => $product_id,
                                            'item_id' => $row3->item_id,
                                            'size' => $row3->size,
                                            'qty' => $row3->qty,
                                            'status' => $row3->status,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s')
                                        );
                                        $this->db->insert('tblproductitems', $add_items);
                                    }
                                }
                            }

                            //Add Product Images
                            if(!empty($productfiles_log)){
                                foreach ($productfiles_log as $row4) {
                                        $add_items =  array(
                                            'rel_id' => $product_id,
                                            'rel_type' => $row4->rel_type,
                                            'file_name' => $row4->file_name
                                        );
                                        $this->db->insert('tblproductfiles', $add_items);
                                }
                            }

                            //Add Product drawing
                            if(!empty($productdrawings_log)){
                                foreach ($productdrawings_log as $row5) {
                                    if(!empty($row5->files) && $row5->files != ""){
                                        $add_drawing =  array(
                                            'product_id' => $product_id,
                                            'drawing_name' => $row5->drawing_name,
                                            'drawing_id' => $row5->drawing_id,
                                            'rev_no' => $row5->rev_no,
                                            'files' => $row5->files,
                                            'status' => $row5->status,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s')
                                        );
                                        $this->db->insert('tblproductdrawing', $add_drawing);
                                    }
                                }
                            }

                            /* this is for update temporary product id */
                            if ($productlog_info->temperoryproduct_id > 0){

                                $qouteupdate["pro_id"] = $product_id;
                                $qouteupdate["temp_product"] = 0;
                                $qouteupdate["description"] = $productlog_info->name;

                                /* this code use for update */
                                $qwhere = array('pro_id' => $productlog_info->temperoryproduct_id, 'rel_type' => 'proposal', 'temp_product' => 1);
                                $this->home_model->update('tblitems_in', $qouteupdate, $qwhere);

                                /* this code use for update */
                                $piwhere = array('pro_id' => $productlog_info->temperoryproduct_id, 'rel_type' => 'estimate', 'temp_product' => 1);
                                $this->home_model->update('tblitems_in', $qouteupdate, $piwhere);
                                
                            }
                        }else{
                            //Update Product
                            $update_data =  array(
                                'name' => $productlog_info->name,
                                'product_cat_id' => $productlog_info->product_cat_id,
                                'product_sub_cat_id' => $productlog_info->product_sub_cat_id,
                                'parent_category_id' => $productlog_info->parent_category_id,
                                'child_category_id' => $productlog_info->child_category_id,
                                'sub_name' => $productlog_info->sub_name,
                                'price' => $productlog_info->price,
                                'gst_id' => $productlog_info->gst_id,
                                'unit_id' => $productlog_info->unit_id,
                                'size' => $productlog_info->size,
                                'unit_1' => $productlog_info->unit_1,
                                'conversion_1' => $productlog_info->conversion_1,
                                'unit_2' => $productlog_info->unit_2,
                                'conversion_2' => $productlog_info->conversion_2,
                                'photo' => $productlog_info->photo,
                                'faq' => $productlog_info->faq,
                                'merging_remark' => $productlog_info->merging_remark,
                                'isOtherCharge' => $productlog_info->isOtherCharge,
                                'is_varified' => $productlog_info->is_varified,
                                'master_id' => $productlog_info->master_id,
                                'status' => $productlog_info->status,
                                'productmaterial_id' => $productlog_info->productmaterial_id,
                                'width' => $productlog_info->width,
                                'width_mm' => $productlog_info->width_mm,
                                'diameter' => $productlog_info->diameter,
                                'edge_width_small' => $productlog_info->edge_width_small,
                                'edge_width' => $productlog_info->edge_width,
                                'edge_length' => $productlog_info->edge_length,
                                'max_qty' => $productlog_info->max_qty,
                                'min_qty' => $productlog_info->min_qty,
                                'temperoryproduct_id' => $productlog_info->temperoryproduct_id,
                                'division_id' => $productlog_info->division_id,
                                'sub_division_id' => $productlog_info->sub_division_id,
                                'print_thickness' => $productlog_info->print_thickness,
                                'print_diameter' => $productlog_info->print_diameter,
                                'print_width' => $productlog_info->print_width,
                                'print_height' => $productlog_info->print_height,
                                'print_length' => $productlog_info->print_length,
                                'print_range' => $productlog_info->print_range,
                                'print_capacity' => $productlog_info->print_capacity,
                                'is_approved' => 1,
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->where('id', $productlog_info->product_id);
                            $this->db->update('tblproducts', $update_data);


                            //Storing the last custome fields of product
                            $last_productfields = $this->db->query("SELECT * FROM `tblproductsfield` where product_id = '".$productlog_info->product_id."' ")->result();
                            if(!empty($last_productfields)){
                                foreach ($last_productfields as $last_fields) {
                                        $add_lastfields =  array(
                                            'product_id' => $last_fields->product_id,
                                            'field_id' => $last_fields->field_id,
                                            'field_value' => $last_fields->field_value,
                                            'created_at' => date('Y-m-d H:i:s')
                                        );
                                        $this->db->insert('tblproductfiles_lastrecords', $add_lastfields);
                                }
                            }

                            //Deleteing Fields
                            $this->db->where('product_id', $productlog_info->product_id);
                            $this->db->delete('tblproductsfield');

                            //Deleteing Items
                            $this->db->where('product_id', $productlog_info->product_id);
                            $this->db->delete('tblproductitems');

                            //Deleteing Files
                            $this->db->where('rel_id', $productlog_info->product_id);
                            $this->db->delete('tblproductfiles');

                            //Deleteing products drawing
                            $this->db->where('product_id', $productlog_info->product_id);
                            $this->db->delete('tblproductdrawing');


                            //Add Product fields
                            if(!empty($productfieldlog_info)){
                                foreach ($productfieldlog_info as $row2) {
                                    $add_field =  array(
                                        'product_id' => $productlog_info->product_id,
                                        'field_id' => $row2->field_id,
                                        'field_value' => $row2->field_value,
                                    );
                                    $this->db->insert('tblproductsfield', $add_field);
                                }
                            }

                            //Add Product Items
                            if(!empty($productitemlog_info)){
                                foreach ($productitemlog_info as $row3) {
                                    if($row3->item_id > 0){
                                        $add_items =  array(
                                            'product_id' => $productlog_info->product_id,
                                            'item_id' => $row3->item_id,
                                            'qty' => $row3->qty,
                                            'size' => $row3->size,
                                            'status' => $row3->status,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s')
                                        );
                                        $this->db->insert('tblproductitems', $add_items);
                                    }

                                }
                            }

                            //Add Product Fiels
                            if(!empty($productfiles_log)){
                                foreach ($productfiles_log as $row4) {
                                    $add_items =  array(
                                        'rel_id' => $productlog_info->product_id,
                                        'rel_type' => $row4->rel_type,
                                        'file_name' => $row4->file_name
                                    );
                                    $this->db->insert('tblproductfiles', $add_items);
                                }
                            }

                            //Add Product drawing
                            if(!empty($productdrawings_log)){
                                foreach ($productdrawings_log as $row5) {
                                    if(!empty($row5->files) && $row5->files != ""){
                                        $add_drawing =  array(
                                            'product_id' => $productlog_info->product_id,
                                            'drawing_name' => $row5->drawing_name,
                                            'drawing_id' => $row5->drawing_id,
                                            'rev_no' => $row5->rev_no,
                                            'files' => $row5->files,
                                            'status' => $row5->status,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s')
                                        );
                                        $this->db->insert('tblproductdrawing', $add_drawing);
                                    }
                                }
                            }

                        }
                    }



                }else{
					$staff_info = $this->db->query("SELECT * FROM `tblproductapprovalsend` where id = '".$id."' ")->row();

                    $main_data = array(
						'staff_id' => $staff_info->staff_id,
						'main_id' => $id,
						'product_id' => $row1->product_id,
						'reject_remark' => $remark,
						'created_date' => date("Y-m-d H:i:s"),
						'updated_date' => date("Y-m-d H:i:s")
					);
                    $this->db->insert('tblproductrejectsend', $main_data);

				}

                $this->db->where('id', $row1->product_id);
                $this->db->update('tblproducts_log', array('approval_status'=>$status));

                $this->db->where('id', $row1->id);
                $this->db->update('tblproductapprovalsend_products', array('approval_status'=>$status));

				//By Safiya
                /*if($status == 1)
                {
                    $approved_status = 1;

                    $this->db->where('id', $id);
                    $this->db->update('tblproductapprovalsend', array('approval_remark'=>$data['approval_remark'],'approval_status'=>$approved_status,'updated_date'=>date('Y-m-d H:i:s')));
                }
                else
                {
                    $approved_status = 1;

                    $where = array('id ' => $row1->product_id , 'approval_status ' => '2');
                    $this->db->where($where);
                    $this->db->update('tblproducts_log ', $data);

                    $this->db->where('id', $id);
                    $this->db->update('tblproductapprovalsend', array('approval_remark'=>$data['approval_remark'],'approval_status'=>$approved_status,'updated_date'=>date('Y-m-d H:i:s')));
                }*/


            }
        }

        update_masterapproval_single(get_staff_user_id(),10,$id,$approve_status);
        update_masterapproval_all(10,$id,$approve_status);

        $this->db->where('id', $id);
        $this->db->update('tblproductapprovalsend', array('approval_remark'=>$data['approval_remark'],'approval_status'=>$approve_status,'updated_date'=>date('Y-m-d H:i:s')));




        return $id;
    }




    public function add($data) {

        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $procomponnetdata = $data['componnetdata'];
        unset($data['componnetdata']);
        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            foreach ($procomponnetdata as $singlecomponentdata) {
                $pcata['product_id'] = $insert_id;
                $pcata['item_id'] = $singlecomponentdata['componnetid'];
                $pcata['qty'] = $singlecomponentdata['compqty'];
                $pcata['status'] = 1;
                $pcata['created_at'] = date("Y-m-d H:i:s");
                $pcata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblproductitems', $pcata);
            }
            logActivity('New Product Master Added [ID: ' . $insert_id . ', ' . $data['name'] . ']');
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
        $procomponnetdata = $data['componnetdata'];
        unset($data['componnetdata']);
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        $this->db->where('product_id', $id);
        $this->db->delete('tblproductitems');
        array_filter($procomponnetdata);
        foreach ($procomponnetdata as $singlecomponentdata) {
            $pcata['product_id'] = $id;
            $pcata['item_id'] = $singlecomponentdata['componnetid'];
            $pcata['qty'] = $singlecomponentdata['compqty'];
            $pcata['status'] = 1;
            $pcata['created_at'] = date("Y-m-d H:i:s");
            $pcata['updated_at'] = date("Y-m-d H:i:s");
            $this->db->insert('tblproductitems', $pcata);
        }

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

        // product component delete
        $this->db->where('product_id', $id);
        $this->db->delete('tblproductitems');
        if ($this->db->affected_rows() > 0) {
            logActivity('Product Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    public function delete_new($id) {

        $this->db->where('id', $id);
        $this->db->delete('tblproducts');

        // product component delete
        $this->db->where('product_id', $id);
        $this->db->delete('tblproductitems');
        if ($this->db->affected_rows() > 0) {
            logActivity('Product Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    public function imagedelete($id) {

        $data['photo'] = '';
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Product Images Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }



    //BY safiya //edit product
    public function edit_log($data,$product_id) {
          $this->load->model('home_model');
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['staff_id'] = get_staff_user_id();
        $data['product_id'] = $product_id;

        $data['isOtherCharge'] = value_by_id_empty('tblproductcategory',$data['product_cat_id'],'for_service');

        $procomponnetdata = $data['componnetdata'];
        $fielddata = $data['fielddata'];
        unset($data['componnetdata']);
        unset($data['fielddata']);

        $this->db->where('id', $product_id);
        $update = $this->db->update('tblproducts_log', $data);


        if ($update) {
            if(!empty($fielddata)){
                $this->home_model->delete('tblproductsfield_log',array('product_id'=>$product_id));
                foreach ($fielddata as $key => $value) {
                    $fdata['product_id'] = $product_id;
                    $fdata['field_id'] = $key;
                    $fdata['field_value'] = $value;
                    $this->db->insert('tblproductsfield_log', $fdata);
                }
            }
            if(!empty($procomponnetdata)){
                $this->home_model->delete('tblproductitems_log',array('product_id'=>$product_id));
               foreach ($procomponnetdata as $singlecomponentdata) {
                    if(!empty($singlecomponentdata['componnetid'])){
                        $pcata['product_id'] = $product_id;
                        $pcata['item_id'] = $singlecomponentdata['componnetid'];
                        $pcata['size'] = $singlecomponentdata['size'];
                        $pcata['qty'] = $singlecomponentdata['compqty'];
                        $pcata['status'] = 1;
                        $pcata['created_at'] = date("Y-m-d H:i:s");
                        $pcata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproductitems_log', $pcata);
                    }

                }
            }

            return $product_id;
        }

        return false;
    }

    public function get_product_length($product_id) {
        $product_info = $this->db->query("SELECT * FROM `tblproducts` where `id`= '".$product_id."' ")->row();

        if($product_info->unit_id == 7){
            $length_mm = $product_info->size;
        }elseif($product_info->unit_1 == 7){
            $length_mm = $product_info->conversion_1;
        }elseif($product_info->unit_2 == 7){
            $length_mm = $product_info->conversion_2;
        }

        if(!empty($length_mm)){
            return ($length_mm/1000);
        }else{
            $length_m = 0;
            if($product_info->unit_id == 13){
                $length_m = $product_info->size;
            }elseif($product_info->unit_1 == 13){
                $length_m = $product_info->conversion_1;
            }elseif($product_info->unit_2 == 13){
                $length_m = $product_info->conversion_2;
            }
            return $length_m;
        }
    }

    public function get_product_weight($product_id) {
        $product_info = $this->db->query("SELECT * FROM `tblproducts` where `id`= '".$product_id."' ")->row();

        if($product_info->unit_id == 8){
            $weight = $product_info->size;
        }elseif($product_info->unit_1 == 8){
            $weight = $product_info->conversion_1;
        }elseif($product_info->unit_2 == 8){
            $weight = $product_info->conversion_2;
        }

        if(!empty($weight)){
            return $weight;
        }else{
            return 0;
        }
    }

    public function get_product_weight_and_price($product_id,$thickness,$pipe_type,$size) {
        $product_info = $this->db->query("SELECT * FROM `tblproducts` where `id`= '".$product_id."' ")->row();
        if($size > 0){
            $length = ($size/1000);
        }else{
            $length = $this->get_product_length($product_id);
        }

        $width = $product_info->width;
        $diameter = $product_info->diameter;
        $edge_width_small = $product_info->edge_width_small;
        $edge_width = $product_info->edge_width;
        $edge_length = $product_info->edge_length;

        $material_info = $this->db->query("SELECT * FROM `tblproductmaterial` where `id`= '".$product_info->productmaterial_id."' ")->row();
        $material_price = 0;
        if(!empty($material_info)){
            if($pipe_type == 1){
               $material_price = $material_info->coilPipePrice;
            }else{
               $material_price = $material_info->nonCoilPipePrice;
            }
        }

        if(!empty($product_info->productmaterial_id)){

            if($product_info->productmaterial_id == 1){
                //Steel Plate
                   $width  =  ($width/1000);
                   $weight =  ($length*$width*$thickness*7.85);
            }elseif($product_info->productmaterial_id == 2){
                //Steel Tube
                   $weight = (($diameter-$thickness)*$thickness*$length*0.02466);
            }elseif($product_info->productmaterial_id == 3){
                //Steel Rod
                   $weight = ($diameter*$diameter*$length*0.00617);
            }elseif($product_info->productmaterial_id == 4){
                //Square Steel
                   $weight = ($edge_width*$edge_width*$length*0.00785);
            }elseif($product_info->productmaterial_id == 5){
                //Flat Steel
                   $weight = ($width*$thickness*$length*0.00785);
            }elseif($product_info->productmaterial_id == 6){
                //Flat Steel Tube
                   $weight = (($edge_length+$edge_width)*2*$thickness*$length*0.00785);
            }elseif($product_info->productmaterial_id == 7){
                //Rectangular Steel Tube
                   $weight = ($edge_width*4*$thickness*$length*0.00785);
            }elseif($product_info->productmaterial_id == 8){
                //Aluminum Embossed Sheet
                   $weight = ($length*$width*$thickness*0.00296);
            }elseif($product_info->productmaterial_id == 9){
                //Unequal-leg Angle Steel
                   $weight = (($edge_width+$edge_width_small-$thickness)*$thickness*$length*0.0076);
            }elseif($product_info->productmaterial_id == 10){
                //Equal-leg Angle Steel
                   $weight = (($edge_width*2-$thickness)*$thickness*$length*0.00785);
            }elseif($product_info->productmaterial_id == 11){
                //Standard Product
                   $weight = $this->get_product_weight($product_id);;
            }

        }

        if(!empty($weight)){
            if($product_info->productmaterial_id == 11){
                $price = $product_info->price;
            }else{
                $price =  ($weight*$material_price);
            }
        }else{
            $price = 0;
            $weight = 0;
        }

        $return_data = array(
            'weight' => number_format($weight, 2, '.', ''),
            'price' => number_format($price, 2, '.', ''),
        );

        return $return_data;
    }

    public function product_drawing_upload($id, $filename) {

        if (isset($_FILES[$filename]['name']) && $_FILES[$filename]['name'] != '') {
            $CI = & get_instance();
            $CI->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            $path = get_upload_path_by_type('product_drawing') . '/';
            $cpt = count($_FILES[$filename]['name']);
            for($i=0; $i<$cpt; $i++)
            {
                $_FILES[$filename]['name']= $files[$filename]['name'][$i];
                $_FILES[$filename]['type']= $files[$filename]['type'][$i];
                $_FILES[$filename]['tmp_name']= $files[$filename]['tmp_name'][$i];
                $_FILES[$filename]['error']= $files[$filename]['error'][$i];
                $_FILES[$filename]['size']= $files[$filename]['size'][$i];

                $config = array();
                $config['upload_path'] =    $path;
                $config['allowed_types'] = '*';
                $config['max_size']      = '0';
                $config['encrypt_name']     = TRUE;

                $CI->upload->initialize($config);
                $CI->upload->do_upload($filename);

                $upload_data = $CI->upload->data();
                if (!empty($upload_data['file_name'])){
                    $dataInfo[] = $upload_data['file_name'];
                }
            }

            if (!empty($dataInfo)){
                $drawingfiles = json_encode($dataInfo);
                $this->home_model->update("tblproductdrawing_log", array("files" => $drawingfiles), array("id" => $id));
            }else{
                $this->home_model->delete("tblproductdrawing_log", array("id" => $id));
            }
        }
    }

    /* this function use for product count */
    public function get_product_count($where)
    {
        return $this->db->query("SELECT count(id) as `ttl_count` from `tblproducts` where ".$where."  ")->row()->ttl_count;
    }
    /* this function use for products data */
    public function get_product($where,$start_from,$limit)
    {
        return $this->db->query("SELECT `id`,`photo`,`is_varified`,`status`,`name`,`unit_2`,`product_cat_id`,`created_at` from `tblproducts` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result_array();
    }
    public function get_lead_search_details($where,$status_where)
    {

        $qualified_count = $this->db->query("SELECT COALESCE(count(id),0) as ttl_count from `tblleads` where ".$status_where." and status = 1 ")->row()->ttl_count;
        $unqualified_count = $this->db->query("SELECT COALESCE(count(id),0) as ttl_count from `tblleads` where ".$status_where." and status = 2 ")->row()->ttl_count;

        $ttl_amount = 0;
        $lead_info = $this->db->query("SELECT `id` from `tblleads` where ".$where." ")->result();
        if(!empty($lead_info)){
            foreach ($lead_info as $lead) {
                $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$lead->id."' order by id desc  ")->row();
                if(!empty($quotation_info)){
                    $ttl_amount += $quotation_info->total;
                }

            }
        }

        $resutnData = array(
            'qualified_count' => $qualified_count,
            'unqualified_count' => $unqualified_count,
            'ttl_amount' => $ttl_amount,
        );
        return $resutnData;
    }
}
