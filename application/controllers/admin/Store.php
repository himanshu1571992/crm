<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function main_store_issue_list(){

        check_permission(419,'view');
        $data["title"] = "Main Store Issue List";

        $where = "`issue_store_from` = '1' AND `status` = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(created_at) BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }else{
            $from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
            $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');
            $where .= " and DATE(created_at) BETWEEN '".$from_date_year."' AND '".$to_date_year."' ";
            $data['f_date'] = _d($from_date_year);
            $data['t_date'] = _d($to_date_year);
        }     
        $data['store_issue_list'] = $this->db->query("SELECT * FROM `tblstore_issue` WHERE $where ORDER BY id DESC")->result();
        $this->load->view('admin/store/main_store_issue_list', $data); 
    }   

    /* this function use for get product log details */
    public function get_productlog_details($store_id, $ref_type="store_issue", $cutting_type=0){
        $mainstoredata = $this->db->query("SELECT * FROM `tblproduct_store_log` where ref_id = '".$store_id."' and ref_type = '".$ref_type."' ")->result();
        if (!empty($mainstoredata)){
            foreach ($mainstoredata as $key => $value) {
                $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                $url = admin_url('product_new/view/'.$value->pro_id);
                if ($cutting_type == 2){
                    echo "<tr>
                            <td>".++$key."</td>
                            <td><a href='".$url."' target='_blank'>".cc($product_name)."</a></td>
                            <td> PRO-ID".$value->pro_id."</td>
                            <td>".$value->total_qty."</td>
                            <td>".$value->width."</td>
                            <td>".$value->size."</td>
                        </tr>";
                }else{
                    echo "<tr>
                            <td>".++$key."</td>
                            <td><a href='".$url."' target='_blank'>".cc($product_name)."</a></td>
                            <td> PRO-ID".$value->pro_id."</td>
                            <td>".$value->total_qty."</td>
                            <td>".$value->size."</td>
                        </tr>";
                }    
            }
            
        }
    }
    
    public function main_store_issue()
    {
        check_permission(419,'create');

        if(!empty($_POST)){
            extract($this->input->post());
            
            $remark = (!empty($remark)) ? $remark : "";
            $operator_id = (!empty($operator_id)) ? $operator_id : "0";
            $issue_date = (!empty($date)) ? db_date($date) : date("Y-m-d");
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'issue_store_from' => 1,
                'issue_store_to' => $issue_store,
                'warehouse_id' => $warehouse_id,
                'operator_id' => $operator_id,
                'remark' => $remark,
                'created_at' => date('Y-m-d H:i:s')
            );
            $insert_id = $this->home_model->insert('tblstore_issue', $sdata);
            if ($insert_id){
                if (isset($storedata) && !empty($storedata)){
                    foreach ($storedata as $value) {

                        if (isset($value["action"]) && $value["action"] == "on"){
                            $pro_id = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'pro_id');
                            $size = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'size');
                            $prowidth = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'width');
                            $shop_floor_store = ($issue_store == 2) ? 1 : 0;
                            $finish_goods_store = ($issue_store == 3) ? 1 : 0;
                            $consumable_store = ($issue_store == 4) ? 1 : 0;
                            $final_qty = $value['available_qty'] - $value['issue_qty'];

                            $pdata['parent_id'] = $value['parent_id'];
                            $pdata['pro_id'] = $pro_id;
                            $pdata['warehouse_id'] = $warehouse_id;
                            $pdata['service_type'] = 2;
                            $pdata['total_qty'] = $value['issue_qty'];
                            $pdata['qty'] = $value['issue_qty'];
                            $pdata['size'] = $size;
                            $pdata['width'] = $prowidth;
                            $pdata['main_store'] = 1;
                            $pdata['consumable_store'] = $consumable_store;
                            $pdata['shop_floor_store'] = $shop_floor_store;
                            $pdata['finish_goods_store'] = $finish_goods_store;
                            $pdata['material_status'] = 0;
                            $pdata['ref_type'] = "store_issue";
                            $pdata['ref_id'] = $insert_id;
                            $pdata['date'] = $issue_date;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            $this->home_model->update("tblproduct_store_log", array("qty" => $final_qty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $value['parent_id']));

                            /* START PRODUCTION INSPECTION CODE */
                            $product_inspection = value_by_id("tblproducts", $pro_id, "inspection_required");
                            if ($issue_store == 3 && $product_inspection == 1){
                                $inspectionData['warehouse_id'] = $warehouse_id;
                                $inspectionData['product_id'] = $pro_id;
                                $inspectionData['type'] = 2;
                                $inspectionData['quantity'] = $value['issue_qty'];
                                $inspectionData['rel_type'] = "store_issue";
                                $inspectionData['rel_id'] = $insert_id;
                                $inspectionData['created_at'] = date("Y-m-d H:i:s");
                                $inspectionData['status'] = 0;
                                $inspectionData['added_by'] = get_staff_user_id();
                                $this->home_model->insert("tblproductinspection", $inspectionData);
                            }
                            /* END PRODUCTION INSPECTION CODE */
                        }
                    }
                }
                set_alert('success', 'Store Issue added succesfully');
                redirect(admin_url('store/main_store_issue_list'));
            }
        }    
        $data['title'] = 'Main Store Issue';

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $data['stafflist'] = $this->db->query("SELECT * FROM `tblstaff`  WHERE `designation_id` IN (11,13,14,16,17,20,21) and approval_status = 1 ORDER BY firstname ASC")->result();
        $this->load->view('admin/store/main_store_issue', $data); 
    }

    public function getMainStoredata(){
        if(!empty($_POST)){
            extract($this->input->post());

            $mainstoredata = $this->db->query("SELECT * FROM `tblproduct_store_log` where warehouse_id = '".$warehouse_id."' and qty > 0 and main_store = 1 and consumable_store = 0 and shop_floor_store = 0 and finish_goods_store = 0 and material_status = 1")->result();
            if (!empty($mainstoredata)){
                foreach ($mainstoredata as $key => $value) {
                    $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                    $url = admin_url('product_new/view/'.$value->pro_id);
                    echo "<tr>
                            <td>".++$key."</td>
                            <td>".cc($product_name)."</td>
                            <td><a href='".$url."' target='_blank'>PRO-ID".$value->pro_id."</a></td>
                            <td>".$value->qty."</td>
                            <td>
                                <input type='hidden' class='form-control' name='storedata[".$key."][parent_id]' value='".$value->id."'>
                                <input type='hidden' class='form-control' id='aqty_".$key."' name='storedata[".$key."][available_qty]' value='".$value->qty."'>
                                <input type='number' class='form-control' onkeyup='checkfinalqty(".$key.");' id='qty_".$key."' name='storedata[".$key."][issue_qty]' min='1'>
                            </td>
                            <td><input class='form-control action-box' id='action_".$key."' data-rid='".$key."' data-name='".cc($product_name)."' type='checkbox' name='storedata[".$key."][action]'></td>
                        </tr>";
                }
            }
        }
    }

    public function getshopfloordata(){
        if(!empty($_POST)){
            extract($this->input->post());

            $shopdata = $this->db->query("SELECT * FROM `tblproduct_store_log` where warehouse_id = '".$warehouse_id."' and qty > 0 and shop_floor_store = 1 and finish_goods_store = 0 and material_status = 0")->result();
            if (!empty($shopdata)){
                foreach ($shopdata as $key => $value) {
                    $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                    $url = admin_url('product_new/view/'.$value->pro_id);
                    echo "<tr>
                            <td>".++$key."</td>
                            <td><a href='".$url."' target='_blank'>".cc($product_name)."</a></td>
                            <td>".$value->qty."</td>
                            <td>
                                <input type='hidden' class='form-control' name='storedata[".$key."][parent_id]' value='".$value->id."'>
                                <input type='hidden' class='form-control' id='aqty_".$key."' name='storedata[".$key."][available_qty]' value='".$value->qty."'>
                                <input type='number' class='form-control' id='qty_".$key."' name='storedata[".$key."][ok_qty]' min='0'>
                            </td>
                            <td><input type='number' class='form-control' id='notokqty_".$key."' name='storedata[".$key."][notok_qty]' min='0'></td>
                            <td><input type='number' class='form-control' id='repairqty_".$key."' name='storedata[".$key."][repair_qty]' min='0'></td>
                            <td><input class='form-control action-box' data-rid='".$key."' data-name='".cc($product_name)."' type='checkbox' name='storedata[".$key."][action]'></td>
                        </tr>";
                }
            }
        }
    }

    public function floorstore_varify(){
        check_permission(421,'view');
        if(!empty($_POST)){
            extract($this->input->post());
            
            $issue_date = (!empty($date)) ? db_date($date) : date("Y-m-d");
            if (isset($storedata) && !empty($storedata)){
                foreach ($storedata as $value) {

                    if (isset($value["action"]) && $value["action"] == "on"){
                        $pro_id = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'pro_id');
                        $service_type = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'service_type');
                        $size = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'size');
                        $prowidth = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'width');

                        if (!empty($value['ok_qty']) && $value['ok_qty'] > 0){
                            $pdata['parent_id'] = $value['parent_id'];
                            $pdata['pro_id'] = $pro_id;
                            $pdata['warehouse_id'] = $warehouse_id;
                            $pdata['service_type'] = $service_type;
                            $pdata['total_qty'] = $value['ok_qty'];
                            $pdata['qty'] = $value['ok_qty'];
                            $pdata['size'] = $size;
                            $pdata['width'] = $prowidth;
                            $pdata['main_store'] = 1;
                            $pdata['shop_floor_store'] = 1;
                            $pdata['material_status'] = 1;
                            $pdata['ref_type'] = "shop_floor_verify";
                            $pdata['date'] = $issue_date;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);
                        }
                        if (!empty($value['notok_qty']) && $value['notok_qty'] > 0){
                            $pdata1['parent_id'] = $value['parent_id'];
                            $pdata1['pro_id'] = $pro_id;
                            $pdata1['warehouse_id'] = $warehouse_id;
                            $pdata1['service_type'] = $service_type;
                            $pdata1['total_qty'] = $value['notok_qty'];
                            $pdata1['qty'] = $value['notok_qty'];
                            $pdata1['size'] = $size;
                            $pdata1['width'] = $prowidth;
                            $pdata1['main_store'] = 1;
                            $pdata1['shop_floor_store'] = 1;
                            $pdata1['material_status'] = 2;
                            $pdata1['scrap_store'] = 1;
                            $pdata1['ref_type'] = "shop_floor_verify";
                            $pdata1['date'] = $issue_date;
                            $pdata1['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata1);
                        }
                        if (!empty($value['repair_qty']) && $value['repair_qty'] > 0){
                            $pdata2['parent_id'] = $value['parent_id'];
                            $pdata2['pro_id'] = $pro_id;
                            $pdata2['warehouse_id'] = $warehouse_id;
                            $pdata2['service_type'] = $service_type;
                            $pdata2['total_qty'] = $value['repair_qty'];
                            $pdata2['qty'] = $value['repair_qty'];
                            $pdata2['size'] = $size;
                            $pdata2['width'] = $prowidth;
                            $pdata2['main_store'] = 1;
                            $pdata2['shop_floor_store'] = 1;
                            $pdata2['material_status'] = 3;
                            $pdata2['ref_type'] = "shop_floor_verify";
                            $pdata2['date'] = $issue_date;
                            $pdata2['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata2);
                        }
                        
                        $this->home_model->update("tblproduct_store_log", array("qty" => 0, "updated_at" => date("Y-m-d H:i:s")), array('id' => $value['parent_id']));
                    }
                }
                set_alert('success', 'Floor store verify added succesfully');
                redirect(admin_url('store/floorstore_varify'));
            }else{
                if (!empty($warehouse_id)){
                    $data['warehouse_id'] = $warehouse_id;
                    $data["shopdata"] = $this->db->query("SELECT * FROM `tblproduct_store_log` where warehouse_id = '".$warehouse_id."' and qty > 0 and shop_floor_store = 1 and finish_goods_store = 0 and material_status = 0")->result();
                }
            }
            
        }    
        $data['title'] = 'Shop Floor Store Varify';

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store/floorstore_varify', $data); 
    }

    public function shopfloor_store_issue_list(){
        check_permission(420,'view');
        $data["title"] = "Shop Floor Store Issue List";

        $where = "`issue_store_from` = '2' AND `status` = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(created_at) between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }     
        $data['store_issue_list'] = $this->db->query("SELECT * FROM `tblstore_issue` WHERE $where ORDER BY id DESC")->result();
        $this->load->view('admin/store/shopfloor_store_issue_list', $data); 
    }   

    /* this function use for shop floor store issue */
    public function shopfloor_store_issue()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            
            $remark = (!empty($remark)) ? $remark : "";
            $issue_date = (!empty($date)) ? db_date($date) : date("Y-m-d");
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'issue_store_from' => 2, // shop floor
                'issue_store_to' => 3, // finished goods 
                'warehouse_id' => $warehouse_id,
                'remark' => $remark,
                'created_at' => date('Y-m-d H:i:s')
            );
            $insert_id = $this->home_model->insert('tblstore_issue', $sdata);
            if ($insert_id){
                if (isset($storedata) && !empty($storedata)){
                    foreach ($storedata as $value) {

                        if (isset($value["action"]) && $value["action"] == "on"){
                            $pro_id = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'pro_id');
                            $size = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'size');
                            $prowidth = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'width');
                            $final_qty = $value['available_qty'] - $value['issue_qty'];

                            $pdata['parent_id'] = $value['parent_id'];
                            $pdata['pro_id'] = $pro_id;
                            $pdata['warehouse_id'] = $warehouse_id;
                            $pdata['service_type'] = 2;
                            $pdata['total_qty'] = $value['issue_qty'];
                            $pdata['qty'] = $value['issue_qty'];
                            $pdata['size'] = $size;
                            $pdata['width'] = $prowidth;
                            $pdata['main_store'] = 0;
                            $pdata['shop_floor_store'] = 1;
                            $pdata['finish_goods_store'] = 1;
                            $pdata['material_status'] = 0;
                            $pdata['ref_type'] = "store_issue";
                            $pdata['ref_id'] = $insert_id;
                            $pdata['date'] = $issue_date;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            $this->home_model->update("tblproduct_store_log", array("qty" => $final_qty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $value['parent_id']));

                            /* START PRODUCTION INSPECTION CODE */
                            $chk_inspection_required = value_by_id("tblproducts", $pro_id, "inspection_required");
                            if ($chk_inspection_required == 1){
                                $inspectionData['warehouse_id'] = $warehouse_id;
                                $inspectionData['product_id'] = $pro_id;
                                $inspectionData['type'] = 2;
                                $inspectionData['quantity'] = $value['issue_qty'];
                                $inspectionData['rel_type'] = "store_issue";
                                $inspectionData['rel_id'] = $insert_id;
                                $inspectionData['created_at'] = date("Y-m-d H:i:s");
                                $inspectionData['status'] = 0;
                                $inspectionData['added_by'] = get_staff_user_id();
                                $this->home_model->insert("tblproductinspection", $inspectionData);
                            }
                            /* END PRODUCTION INSPECTION CODE */
                        }
                    }
                }
                set_alert('success', 'Finished Goods Store Issue added succesfully');
                redirect(admin_url('store/shopfloor_store_issue_list'));
            }
        }    
        $data['title'] = 'Shop Floor Store Issue';

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store/shopfloor_store_issue', $data); 
    }

    public function getShopfloorStoredata(){
        if(!empty($_POST)){
            extract($this->input->post());

            $mainstoredata = $this->db->query("SELECT * FROM `tblproduct_store_log` where warehouse_id = '".$warehouse_id."' and qty > 0 and shop_floor_store = 1 and finish_goods_store = 0 and material_status = 1")->result();
            if (!empty($mainstoredata)){
                foreach ($mainstoredata as $key => $value) {
                    $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                    $url = admin_url('product_new/view/'.$value->pro_id);
                    echo "<tr>
                            <td>".++$key."</td>
                            <td>".cc($product_name)."</td>
                            <td><a href='".$url."' target='_blank'>PRO-ID".$value->pro_id."</a></td>
                            <td>".$value->qty."</td>
                            <td>
                                <input type='hidden' class='form-control' name='storedata[".$key."][parent_id]' value='".$value->id."'>
                                <input type='hidden' class='form-control' id='aqty_".$key."' name='storedata[".$key."][available_qty]' value='".$value->qty."'>
                                <input type='number' class='form-control' id='qty_".$key."' onkeyup='checkfinalqty(".$key.");' name='storedata[".$key."][issue_qty]' min='1'>
                            </td>
                            <td><input class='form-control action-box' id='action_".$key."' data-rid='".$key."' data-name='".cc($product_name)."' type='checkbox' name='storedata[".$key."][action]'></td>
                        </tr>";
                }
            }
        }
    }

    /* this function use for finished goods store verify */
    public function finished_goods_store_verify(){
        check_permission(422,'create');
        if(!empty($_POST)){
            extract($this->input->post());
            
            $issue_date = (!empty($date)) ? db_date($date) : date("Y-m-d");
            if (isset($storedata) && !empty($storedata)){
                foreach ($storedata as $value) {

                    if (isset($value["action"]) && $value["action"] == "on"){
                        $pro_id = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'pro_id');
                        $service_type = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'service_type');
                        $size = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'size');
                        $prowidth = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'width');
                        $main_store = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'main_store');
                        $shop_floor_store = value_by_id_empty('tblproduct_store_log', $value['parent_id'], 'shop_floor_store');

                        if (!empty($value['ok_qty']) && $value['ok_qty'] > 0){
                            $pdata['parent_id'] = $value['parent_id'];
                            $pdata['pro_id'] = $pro_id;
                            $pdata['warehouse_id'] = $warehouse_id;
                            $pdata['service_type'] = $service_type;
                            $pdata['total_qty'] = $value['ok_qty'];
                            $pdata['qty'] = $value['ok_qty'];
                            $pdata['size'] = $size;
                            $pdata['width'] = $prowidth;
                            $pdata['main_store'] = $main_store;
                            $pdata['shop_floor_store'] = $shop_floor_store;
                            $pdata['finish_goods_store'] = 1;
                            $pdata['material_status'] = 1;
                            $pdata['ref_type'] = "finished_goods_verify";
                            $pdata['date'] = $issue_date;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            /* store and update product qty in pro stock table */
                            $chkstock = $this->db->query('SELECT * FROM tblprostock WHERE `pro_id` = "'.$pro_id.'" AND `warehouse_id`= "'.$warehouse_id.'" AND `service_type`= "'.$service_type.'" AND `department_id` = 0 AND `stock_type` = 1 AND `status` = 1 AND `staff_id` = 0')->row();
                            if (!empty($chkstock)){
                                $stockqty = $chkstock->qty + $value['ok_qty'];
                                $this->home_model->update("tblprostock", array("qty" => $stockqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $chkstock->id));
                            }else{
                                $pro_data['pro_id'] = $pro_id;
                                $pro_data['warehouse_id'] = $warehouse_id;
                                $pro_data['service_type'] = $service_type;
                                $pro_data['store'] = 1;
                                $pro_data['department_id'] = 0;
                                $pro_data['is_pro'] = 1;
                                $pro_data['qty'] = $value['ok_qty'];
                                $pro_data['stock_type'] = 1;
                                $pro_data['status'] = 1;
                                $pro_data['staff_id'] = 0;
                                $pro_data['created_at'] = date('Y-m-d H:i:s');
                                $pro_data['updated_at'] = date('Y-m-d H:i:s');
                                $this->home_model->insert('tblprostock', $pro_data);
                            }
                            
                        }
                        if (!empty($value['notok_qty']) && $value['notok_qty'] > 0){
                            $pdata1['parent_id'] = $value['parent_id'];
                            $pdata1['pro_id'] = $pro_id;
                            $pdata1['warehouse_id'] = $warehouse_id;
                            $pdata1['service_type'] = $service_type;
                            $pdata1['total_qty'] = $value['notok_qty'];
                            $pdata1['qty'] = $value['notok_qty'];
                            $pdata1['size'] = $size;
                            $pdata1['width'] = $prowidth;
                            $pdata1['main_store'] = $main_store;
                            $pdata1['shop_floor_store'] = $shop_floor_store;
                            $pdata1['finish_goods_store'] = 1;
                            $pdata1['material_status'] = 2;
                            $pdata1['scrap_store'] = 1;
                            $pdata1['ref_type'] = "finished_goods_verify";
                            $pdata1['date'] = $issue_date;
                            $pdata1['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata1);
                        }
                        if (!empty($value['repair_qty']) && $value['repair_qty'] > 0){
                            $pdata2['parent_id'] = $value['parent_id'];
                            $pdata2['pro_id'] = $pro_id;
                            $pdata2['warehouse_id'] = $warehouse_id;
                            $pdata2['service_type'] = $service_type;
                            $pdata2['total_qty'] = $value['repair_qty'];
                            $pdata2['qty'] = $value['repair_qty'];
                            $pdata2['size'] = $size;
                            $pdata2['width'] = $prowidth;
                            $pdata2['main_store'] = $main_store;
                            $pdata2['shop_floor_store'] = $shop_floor_store;
                            $pdata2['finish_goods_store'] = 1;
                            $pdata2['material_status'] = 3;
                            $pdata2['ref_type'] = "finished_goods_verify";
                            $pdata2['date'] = $issue_date;
                            $pdata2['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata2);
                        }
                        
                        $this->home_model->update("tblproduct_store_log", array("qty" => 0, "updated_at" => date("Y-m-d H:i:s")), array('id' => $value['parent_id']));
                    }
                }
                    
                set_alert('success', 'Finished goods store verify added succesfully');
                redirect(admin_url('store/finished_goods_store_verify'));
            }else{
                if (!empty($warehouse_id)){
                    $data["warehouse_id"] = $warehouse_id;
                    $data["finished_goods_data"] = $this->db->query("SELECT * FROM `tblproduct_store_log` where warehouse_id = '".$warehouse_id."' and qty > 0 and finish_goods_store = 1 and material_status = 0")->result();
                }
            }
        }    
        $data['title'] = 'Finished Goods Store Varify';

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store/finished_goods_store_verify', $data); 
    }

    public function getfinisedgoodsdata(){
        if(!empty($_POST)){
            extract($this->input->post());

            $shopdata = $this->db->query("SELECT * FROM `tblproduct_store_log` where warehouse_id = '".$warehouse_id."' and qty > 0 and finish_goods_store = 1 and material_status = 0")->result();
            if (!empty($shopdata)){
                foreach ($shopdata as $key => $value) {
                    $product_name = value_by_id("tblproducts", $value->pro_id, "sub_name");
                    $url = admin_url('product_new/view/'.$value->pro_id);
                    echo "<tr>
                            <td>".++$key."</td>
                            <td><a href='".$url."' target='_blank'>".cc($product_name)."</a></td>
                            <td>".$value->qty."</td>
                            <td>
                                <input type='hidden' class='form-control' name='storedata[".$key."][parent_id]' value='".$value->id."'>
                                <input type='hidden' class='form-control' id='aqty_".$key."' name='storedata[".$key."][available_qty]' value='".$value->qty."'>
                                <input type='number' class='form-control' id='qty_".$key."' name='storedata[".$key."][ok_qty]' min='0'>
                            </td>
                            <td><input type='number' class='form-control' id='notokqty_".$key."' name='storedata[".$key."][notok_qty]' min='0'></td>
                            <td><input type='number' class='form-control' id='repairqty_".$key."' name='storedata[".$key."][repair_qty]' min='0'></td>
                            <td><input class='form-control action-box' data-rid='".$key."' data-name='".cc($product_name)."' type='checkbox' name='storedata[".$key."][action]'></td>
                        </tr>";
                }
            }
        }
    }

    /* this function use for store cutting list */
    public function store_cutting_list(){
        check_permission(427,'view');
        $data["title"] = "Store Cutting List";

        $where = "`status` = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(date) between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }

            if (!empty($cutting_type)){
                $data['cutting_type'] = $cutting_type;
                $where .= " and cutting_type ='".$cutting_type."'";
            }
        }     
        $data['store_cutting_list'] = $this->db->query("SELECT * FROM `tblstore_cutting` WHERE $where ORDER BY id DESC")->result();
        $this->load->view('admin/store/store_cutting_list', $data); 
    }

    /* this function use for add store cutting */
    public function store_cutting(){
        check_permission(427,'create');
        if(!empty($_POST)){
            extract($this->input->post());
            
            $remark = (!empty($remark)) ? $remark : "";
            $issuedate = (!empty($date)) ? db_date($date) : date("Y-m-d");
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'warehouse_id' => $warehouse_id,
                'product_store_log_id' => $product_store_log_id,
                'qty' => $qty,
                'remark' => $remark,
                'date' => $issuedate
            );

            $insert_id = $this->home_model->insert('tblstore_cutting', $sdata);
            if ($insert_id){

                /* update parent product qty */
                $parentloginfo = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `id` = '".$product_store_log_id."' ")->row();
                $final_qty = $parentloginfo->qty - $qty;
                $this->home_model->update("tblproduct_store_log", array("qty" => $final_qty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $product_store_log_id));


                if (isset($logdata) && !empty($logdata)){
                    foreach ($logdata as $value) {

                        if (isset($value["qty"]) && $value["qty"] > 0){
                            
                            $pdata['parent_id'] = $product_store_log_id;
                            $pdata['pro_id'] = $value["pro_id"];
                            $pdata['warehouse_id'] = $parentloginfo->warehouse_id;
                            $pdata['service_type'] = $parentloginfo->service_type;
                            $pdata['total_qty'] = $value['qty'];
                            $pdata['qty'] = $value['qty'];
                            $pdata['size'] = $value['size'];
                            $pdata['main_store'] = 0;
                            $pdata['shop_floor_store'] = 1;
                            $pdata['material_status'] = 1;
                            $pdata['ref_type'] = "store_cutting";
                            $pdata['ref_id'] = $insert_id;
                            $pdata['date'] = $issuedate;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            /* this is for production component demand */
                            if (!empty($page_type) && $page_type == 'demand'){
                                $chkproduct = $this->db->query("SELECT * FROM `tblproduction_component_demand` WHERE `product_id` = '".$value["pro_id"]."'")->row();
                                if (!empty($chkproduct)){
                                    $finalqty = $chkproduct->demand_qty - $value['qty'];
                                    $up_data = array('demand_qty' => $finalqty);
                                    if ($finalqty <= 0) {
                                        $up_data['status'] = 1;
                                    }
                                    $this->home_model->update('tblproduction_component_demand', $up_data, array("id" => $chkproduct->id));
                                }
                            }
                            
                        }
                    }
                }
                set_alert('success', 'Store Cutting added succesfully');
                redirect(admin_url('store/store_cutting_list'));
            }
        }    
        $data['title'] = 'Add Pipe Cutting';

        $data['product_log_list'] = $this->db->query("SELECT * FROM `tblproduct_store_log` where shop_floor_store = 1 and material_status = 1 and finish_goods_store = 0 and qty > 0 and size > 0")->result();
        $data['product_list'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1")->result();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store/store_cutting', $data); 
    }

    /* this function use for add sheet cutting */
    public function sheet_cutting(){
        check_permission(427,'create');
        if(!empty($_POST)){
            extract($this->input->post());
            
            $remark = (!empty($remark)) ? $remark : "";
            $issuedate = (!empty($date)) ? db_date($date) : date("Y-m-d");
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'cutting_type' => 2,
                'warehouse_id' => $warehouse_id,
                'product_store_log_id' => $product_store_log_id,
                'qty' => $qty,
                'remark' => $remark,
                'date' => $issuedate
            );
            
            $insert_id = $this->home_model->insert('tblstore_cutting', $sdata);
            if ($insert_id){

                /* update parent product qty */
                $parentloginfo = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `id` = '".$product_store_log_id."' ")->row();
                $final_qty = $parentloginfo->qty - $qty;
                $this->home_model->update("tblproduct_store_log", array("qty" => $final_qty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $product_store_log_id));


                if (isset($logdata) && !empty($logdata)){
                    foreach ($logdata as $value) {

                        if (isset($value["qty"]) && $value["qty"] > 0){
                            
                            $pdata['parent_id'] = $product_store_log_id;
                            $pdata['pro_id'] = $value["pro_id"];
                            $pdata['warehouse_id'] = $parentloginfo->warehouse_id;
                            $pdata['service_type'] = $parentloginfo->service_type;
                            $pdata['total_qty'] = $value['qty'];
                            $pdata['qty'] = $value['qty'];
                            $pdata['size'] = $value['size'];
                            $pdata['width'] = $value['width'];
                            $pdata['main_store'] = 0;
                            $pdata['shop_floor_store'] = 1;
                            $pdata['material_status'] = 1;
                            $pdata['ref_type'] = "store_cutting";
                            $pdata['ref_id'] = $insert_id;
                            $pdata['date'] = $issuedate;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            /* this is for production component demand */
                            if (!empty($page_type) && $page_type == 'demand'){
                                $chkproduct = $this->db->query("SELECT * FROM `tblproduction_component_demand` WHERE `product_id` = '".$value["pro_id"]."'")->row();
                                if (!empty($chkproduct)){
                                    $finalqty = $chkproduct->demand_qty - $value['qty'];
                                    $up_data = array('demand_qty' => $finalqty);
                                    if ($finalqty <= 0) {
                                        $up_data['status'] = 1;
                                    }
                                    $this->home_model->update('tblproduction_component_demand', $up_data, array("id" => $chkproduct->id));
                                }
                            }
                        }
                    }
                }
                set_alert('success', 'Sheet Cutting added succesfully');
                redirect(admin_url('store/store_cutting_list'));
            }
        }    
        $data['title'] = 'Add Sheet Cutting';

        $data['product_log_list'] = $this->db->query("SELECT * FROM `tblproduct_store_log` where shop_floor_store = 1 and material_status = 1 and finish_goods_store = 0 and qty > 0 and size > 0 and width > 0")->result();
        $data['product_list'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1")->result();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store/sheet_cutting', $data); 
    }

    public function getProductlogQtySize($plog_id){
        $response = array("qty" => 0, "size"=> 0, "width" => 0);
        $logdata = $this->db->query("SELECT qty,size,width,pro_id FROM tblproduct_store_log WHERE id='".$plog_id."' ")->row();
        if (!empty($logdata)){
            $url = admin_url('product_new/view/'.$logdata->pro_id);
            $response = array("qty" => $logdata->qty, "size"=> $logdata->size, "width"=> $logdata->width, "pro_id"=> '<a href="'.$url.'" target="_blank">PRO-ID'.$logdata->pro_id.'</a>');
        }
        echo json_encode($response);
    }

    public function getCuttingProductlog($warehouse_id){
        echo '<option value=""></option>';
        $product_log_list = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE warehouse_id = '".$warehouse_id."' and shop_floor_store = 1 and material_status = 1 and finish_goods_store = 0 and qty > 0 and size > 0")->result();
        if (!empty($product_log_list)){
            if (isset($product_log_list) && count($product_log_list) > 0) {
                foreach ($product_log_list as $product_log) {
                    $product_name = value_by_id("tblproducts", $product_log->pro_id, "sub_name");
            ?>
                    <option value="<?php echo $product_log->id; ?>"><?php echo cc($product_name)." | ( PRO-ID".$product_log->pro_id." ) | ( ".$product_log->qty." Qty ) | ( ".$product_log->size." MM )"; ?></option>
            <?php
                }
            }
        }
    }
    public function getsheetCuttingProductlog($warehouse_id){
        echo '<option value=""></option>';
        $product_log_list = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE warehouse_id = '".$warehouse_id."' and shop_floor_store = 1 and material_status = 1 and finish_goods_store = 0 and qty > 0 and size > 0 and width > 0")->result();
        if (!empty($product_log_list)){
            if (isset($product_log_list) && count($product_log_list) > 0) {
                foreach ($product_log_list as $product_log) {
                    $product_name = value_by_id("tblproducts", $product_log->pro_id, "sub_name");
            ?>
                    <option value="<?php echo $product_log->id; ?>"><?php echo cc($product_name)." | ( PRO-ID".$product_log->pro_id." ) | ( ".$product_log->qty." Qty ) | ( ".$product_log->width." MM * ".$product_log->size." MM)"; ?></option>
            <?php
                }
            }
        }
    }
    /* this function use for store transfer list */
    public function store_transfer_list(){
        check_permission(426,'view');
        $data["title"] = "Store Transfer List";

        $where = "`status` = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(date) between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }     
        $data['store_transfer_list'] = $this->db->query("SELECT * FROM `tblstore_transfer` WHERE $where ORDER BY id DESC")->result();
        $this->load->view('admin/store/store_transfer_list', $data); 
    }

    /* this function use for add store transfer */
    public function store_transfer(){
        check_permission(426,'create');

        if(!empty($_POST)){
            extract($this->input->post());
            // echo '<pre>';
            // print_r($_POST);
            // die();
            $issue_date = (!empty($date)) ? db_date($date) : date("Y-m-d");
            $remark = (!empty($remark)) ? $remark : "";
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'from_warehouse' => $from_warehouse,
                'to_warehouse' => $to_warehouse,
                'store_id' => $issue_store,
                'remark' => $remark,
                'date' => $issue_date
            );
            $insert_id = $this->home_model->insert('tblstore_transfer', $sdata);
            if ($insert_id){

                if (isset($logdata) && !empty($logdata)){
                    foreach ($logdata as $value) {

                        if (isset($value["qty"]) && $value["qty"] > 0){
                            
                            $parentloginfo = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `id` = '".$value['pro_log_id']."' ")->row();
                            $final_qty = $parentloginfo->qty - $value["qty"];

                            $pdata['parent_id'] = $value['pro_log_id'];
                            $pdata['pro_id'] = $parentloginfo->pro_id;
                            $pdata['warehouse_id'] = $to_warehouse;
                            $pdata['service_type'] = $parentloginfo->service_type;
                            $pdata['total_qty'] = $value['qty'];
                            $pdata['qty'] = $value['qty'];
                            $pdata['size'] = $parentloginfo->size;
                            $pdata['width'] = $parentloginfo->width;
                            $pdata['main_store'] = 1;
                            $pdata['material_status'] = 1;
                            $pdata['ref_type'] = "store_transfer";
                            $pdata['ref_id'] = $insert_id;
                            $pdata['date'] = $issue_date;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            /* this is for update product store log */
                            $this->home_model->update("tblproduct_store_log", array("qty" => $final_qty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $value['pro_log_id']));
                        }
                    }
                }
                set_alert('success', 'Store Transfer succesfully');
                redirect(admin_url('store/store_transfer_list'));
            }
        }    
        $data['title'] = 'Add Store Transfer';

        $data['product_log_list'] = $this->db->query("SELECT * FROM `tblproduct_store_log` where shop_floor_store = 1 and material_status = 1 and finish_goods_store = 0 and qty > 0 and size > 0")->result();
        $data['product_list'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1")->result();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store/store_transfer', $data); 
    }

    public function gettransferproducts(){
        if(!empty($_POST)){
            extract($this->input->post());
            $where = "warehouse_id = '".$warehouse_id."' and material_status = 1 and qty > 0";
            if ($issue_store == '1'){
                $where .= ' and main_store = 1 and consumable_store = 0 and shop_floor_store = 0 and finish_goods_store = 0 ';
            }else if ($issue_store == '2'){
                $where .= ' and shop_floor_store = 1 and finish_goods_store = 0 ';
            }else if ($issue_store == '3'){
                $where .= ' and finish_goods_store = 1';
            }
            echo '<option value=""></option>';
            $product_log_list = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE $where ")->result();
            if (!empty($product_log_list)){
                if (isset($product_log_list) && count($product_log_list) > 0) {
                    foreach ($product_log_list as $product_log) {
                        $product_name = value_by_id("tblproducts", $product_log->pro_id, "sub_name");
                ?>
                        <option value="<?php echo $product_log->id; ?>"><?php echo cc($product_name)." | ( PRO-ID".$product_log->pro_id." ) | ( ".$product_log->qty." Qty )"; ?></option>
                <?php
                    }
                }
            }
        }    
        
    }

    /* this function use for store conversion list */
    public function product_conversion_list(){
        check_permission(428,'view');
        $data["title"] = "Product Conversion List";

        $where = "`status` = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(date) between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }     
        $data['product_conversion_list'] = $this->db->query("SELECT * FROM `tblstore_conversion` WHERE $where ORDER BY id DESC")->result();
        $this->load->view('admin/store/product_conversion_list', $data); 
    }

    /* this function use for product conversion */
    public function product_conversion(){
        check_permission(428,'create');
        if ($this->input->post()) {
            extract($this->input->post());

            $remark = (!empty($remark)) ? $remark : "";
            $issue_date = (!empty($date)) ? db_date($date) : date("Y-m-d"); 
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'warehouse_id' => $warehouse_id,
                'remark' => $remark,
                'date' => $issue_date
            );
            $insert_id = $this->home_model->insert('tblstore_conversion', $sdata);
            if ($insert_id){

                if (isset($logdata) && !empty($logdata)){
                    foreach ($logdata as $value) {

                        if (isset($value["qty"]) && $value["qty"] > 0){

                            $prod_info = $this->db->query("SELECT `unit_id`,`unit_1`,`unit_2`,`size`,`conversion_1`,`conversion_2`,`width_mm` FROM `tblproducts` where `id`= '".$value["pro_id"]."' ")->row();
                            $product_size = 0;
                            if($prod_info->unit_id == 7){
                                $product_size = $prod_info->size;
                            }elseif($prod_info->unit_1 == 7){
                                $product_size = $prod_info->conversion_1;
                            }elseif($prod_info->unit_2 == 7){
                                $product_size = $prod_info->conversion_2;
                            }
							if(!empty($product_stay)){
								$pdata['finish_goods_store'] = 0;
								$pdata['material_status'] = 1;
                            }else{   
                                /* START PRODUCTION INSPECTION CODE */
                                $chk_inspection_required = value_by_id("tblproducts", $value["pro_id"], "inspection_required");
                                if ($chk_inspection_required == 1){
                                    $inspectionData['warehouse_id'] = $warehouse_id;
                                    $inspectionData['product_id'] = $value["pro_id"];
                                    $inspectionData['type'] = 2;
                                    $inspectionData['quantity'] = $value['qty'];
                                    $inspectionData['rel_type'] = "conversion";
                                    $inspectionData['rel_id'] = $insert_id;
                                    $inspectionData['created_at'] = date("Y-m-d H:i:s");
                                    $inspectionData['status'] = 0;
                                    $inspectionData['added_by'] = get_staff_user_id();
                                    $this->home_model->insert("tblproductinspection", $inspectionData);
                                }
                                /* END PRODUCTION INSPECTION CODE */

								$pdata['finish_goods_store'] = 1;
                            }
							
                            $pdata['parent_id'] = 0;
                            $pdata['pro_id'] = $value["pro_id"];
                            $pdata['warehouse_id'] = $warehouse_id;
                            $pdata['service_type'] = 2;
                            $pdata['total_qty'] = $value['qty'];
                            $pdata['qty'] = $value['qty'];
                            $pdata['size'] = $product_size;
                            $pdata['width'] = $prod_info->width_mm;
                            $pdata['shop_floor_store'] = 1;
                            $pdata['ref_type'] = "conversion"; 
                            $pdata['ref_id'] = $insert_id;
                            $pdata['date'] = $issue_date;
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);

                            /* store and update product qty in pro stock table */
                            $chkstock = $this->db->query('SELECT * FROM tblprostock WHERE `pro_id` = "'.$value["pro_id"].'" AND `warehouse_id`= "'.$warehouse_id.'" AND `service_type`= "2" AND `department_id` = 0 AND `stock_type` = 1 AND `status` = 1 AND `staff_id` = 0')->row();
                            if (!empty($chkstock)){
                                $stockqty = $chkstock->qty + $value['qty'];
                                $this->home_model->update("tblprostock", array("qty" => $stockqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $chkstock->id));
                            }else{
                                $pro_data['pro_id'] = $value["pro_id"];
                                $pro_data['warehouse_id'] = $warehouse_id;
                                $pro_data['service_type'] = 2;
                                $pro_data['store'] = 1;
                                $pro_data['department_id'] = 0;
                                $pro_data['is_pro'] = 1;
                                $pro_data['qty'] = $value['qty'];
                                $pro_data['stock_type'] = 1;
                                $pro_data['status'] = 1;
                                $pro_data['staff_id'] = 0;
                                $pro_data['created_at'] = date('Y-m-d H:i:s');
                                $pro_data['updated_at'] = date('Y-m-d H:i:s');
                                $this->home_model->insert('tblprostock', $pro_data);
                            }
                        }
                    }
                }

                /* this is for conponent data */
                if (isset($componentdata) && !empty($componentdata)){
                    foreach ($componentdata as $cval) {
                        
                        $reqqty = $cval['requiredqty'];
                        $prodata = $this->db->query("SELECT `id`,`qty` FROM `tblproduct_store_log` WHERE qty > 0 and shop_floor_store = 1 and finish_goods_store = 0 and material_status = 1 and warehouse_id = '".$warehouse_id."' and pro_id = '".$cval['componentid']."' ORDER BY qty ASC")->result();
                        if (!empty($prodata)){
                            foreach ($prodata as $pval) {
                                
                                if ($reqqty > 0){
                                    
                                    $consumed_qty = $reqqty;
                                    //$finalqty = number_format($reqqty, 2) - number_format($pval->qty, 2);
                                    $finalqty = $reqqty - $pval->qty;
                                    $reqqty = ($finalqty > 0) ? $finalqty : 0;
                                    $itemqty = ($finalqty < 0) ? abs($finalqty) : 0;
    
                                    /* Start Code for store conversion consumed log */
                                    $consumned_log["conversion_id"] = $insert_id;
                                    $consumned_log["product_store_log_id"] = $pval->id;
                                    $consumned_log["consumed_qty"] = $consumed_qty;
                                    $this->home_model->insert('tblstore_conversion_consumed_log', $consumned_log);
    
                                    /* this is for update item qty after consumed */
                                    $this->home_model->update("tblproduct_store_log", array("qty" => $itemqty, "used_in_conversion" => 1,"updated_at" => date("Y-m-d H:i:s")), array('id' => $pval->id));
                                }
                            }
                        }
                    }
                }
                set_alert('success', 'Store Conversion Succesfully');
                redirect(admin_url('store/product_conversion_list'));
            }
        }    

        $data['title'] = "Product Conversion";
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $data['product_list'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1")->result();
        $this->load->view('admin/store/product_conversion', $data); 
    }

    /* this function use for get product items */
    public function getProductItems($product_id){

        echo '<div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">  
                        <table class="table" id="newtable">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Item Name</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>';
                                $itemslist = $this->db->query("SELECT * FROM `tblproductitems` where `status`='1' and `item_id` > 0 and `product_id` = '".$product_id."'")->result();
                                if (!empty($itemslist)){
                                    foreach ($itemslist as $key => $value) {
                                        $product_name = value_by_id("tblproducts", $value->item_id, "sub_name");
                                        echo "<tr>
                                                <td>".++$key."</td>
                                                <td>".$product_name."</td>
                                                <td>".$value->qty."</td>
                                            </tr>";
                                    }
                                }
                                else{
                                    echo '<tr><td colspan="3" align="center">Record Not Found</td><tr>';
                                }
                    echo "</tbody>
                        </table>
                    </div>
                </div>
            </div>";
    }

    public function get_components() {
        if ($this->input->post()) {
            extract($this->input->post());
            // echo "<pre>";
            // print_r($this->input->post());
            // exit;
            $component_data = array();
            $i = 0;
            $arrayh = array();
            foreach ($logdata as $singleproductdata) {
                $pro_id[] = $singleproductdata['pro_id'];
                
                $getallrequriedcomponent = $this->db->query("SELECT tc.`name`,tc.`sub_name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id` ='" . $singleproductdata['pro_id'] . "'")->result_array();
                foreach ($getallrequriedcomponent as $singlerequriedcomponent) {

                    $requiredqty = $singleproductdata['qty'] * $singlerequriedcomponent['qty'];
                    $name = $singlerequriedcomponent['sub_name'];

                    if (!in_array($name, $arrayh)) {
                        $component_data[$i]['componentid'] = $singlerequriedcomponent['id'];
                        $component_data[$i]['name'] = $singlerequriedcomponent['sub_name'];
                        $component_data[$i]['requiredqty'] = $requiredqty;
                        $arrayh[] = $name;
                    } else {
                        $table = array_column($component_data, 'name');
                        $tt = array_search($name, $table);
                        $component_data[$i]['componentid'] = $singlerequriedcomponent['id'];
                        $component_data[$i]['name'] = $singlerequriedcomponent['sub_name'];
                        $component_data[$i]['requiredqty'] = $component_data[$tt]['requiredqty'] + $requiredqty;
                    }
                    $i++;
                }
            }
            foreach($component_data as $element) {
                $hash = $element['componentid'];
                $unique_array[$hash] = $element;
            }

            ?>
            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="15%">Item Name</th>
                        <th width="15%">Product ID</th>
                        <th width="15%">Available Qty</th>
                        <th width="15%">Required Qty</th>
                    </tr>
                </thead>
                <tbody class="ui-sortable" style="font-size:15px;">
                    <?php
                        $k = 0;
                        $showbtn = 1;
                        if(!empty($unique_array)){
                            foreach ($unique_array as $singlerequriedcomponent) {

                                $requiredqty = $singlerequriedcomponent['requiredqty'];
                                $availableqty = $this->db->query("SELECT COALESCE(SUM(qty),0) AS ttl_qty FROM `tblproduct_store_log` WHERE qty > 0 and shop_floor_store = 1 and finish_goods_store = 0 and material_status = 1 and warehouse_id = ".$warehouse_id." and pro_id = ".$singlerequriedcomponent['componentid']." ")->row()->ttl_qty;

                                if($availableqty < $requiredqty){
                                     $showbtn = 0;
                                }
                                //$showbtn = ($requiredqty > $availableqty) ? 0 : 1;
                    ?>
                            <tr class="main " <?php echo ($requiredqty > $availableqty) ? 'style="background-color: #F63E3E;color:#fff;"' : ''; ?> id="tr<?php echo $k; ?>">
                                <td width="1%"><?php echo $k+1; ?></td>
                                <td width="15%" align="left">
                                    <div class="form-group"><input type="hidden" name="componentdata[<?php echo $k; ?>][componentid]" value="<?php echo $singlerequriedcomponent['componentid']; ?>"><?php echo value_by_id('tblproducts',$singlerequriedcomponent['componentid'],'sub_name'); ?></div>
                                </td>
                                <td><a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('product_new/view/'.$singlerequriedcomponent['componentid']);?>">PRO-ID<?php echo $singlerequriedcomponent['componentid']; ?></a></td>
                                <td width="15%"><input type="hidden" class="form-control available_qty" id="available_qty<?php echo $k; ?>"  type="text" name="componentdata[<?php echo $k; ?>][available_qty]" value="<?php echo $availableqty; ?>"><?php echo $availableqty; ?></td>
                                <td width="15%"><input type="hidden" id="reqqty<?php echo $k; ?>" name="componentdata[<?php echo $k; ?>][requiredqty]" value="<?php echo $requiredqty; ?>"><?php echo $requiredqty; ?></td>
                            </tr>
                    <?php
                            $k++;
                            }
                        }else{
                            $showbtn = 0;
                    ?>
                        <tr class="main" id="tr0">
                            <td colspan="5" align="center">Components are not available</td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <input type="hidden" name="avaibility" value="<?php echo $showbtn; ?>" class="avaibilityofqty">
            </table>
            <?php

        }
    }

    /* this function use for delete store cutting record */
    public function store_cutting_delete($store_cutting_id){
        $chk_store_log = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `ref_type`= 'store_cutting' AND `ref_id` = '".$store_cutting_id."'")->result();
        if (!empty($chk_store_log)){
            $storecount = 0;
            foreach ($chk_store_log as $value) {
                if (number_format($value->total_qty, 2) != number_format($value->qty, 2)){
                    $storecount += 1;
                }
            }

            if ($storecount == 0){
                /* this is for update qty */
                $storelog = $this->db->query("SELECT * FROM `tblstore_cutting` WHERE `id` = '".$store_cutting_id."'")->row();
                
                if (!empty($storelog)){
                    $parentqty = value_by_id('tblproduct_store_log', $storelog->product_store_log_id, 'qty');
                    $finalqty = $storelog->qty + $parentqty;
                    $this->home_model->update("tblproduct_store_log", array('qty' => $finalqty), array('id' => $storelog->product_store_log_id));
                }
                $this->home_model->delete('tblproduct_store_log', array('ref_type'=> 'store_cutting', 'ref_id' => $store_cutting_id));
                $this->home_model->delete('tblstore_cutting', array('id' => $store_cutting_id));

                set_alert('success', "Store cutting delete successfully.");
                redirect(admin_url('store/store_cutting_list'));
            }else{
                set_alert('danger', "Can't be deleted, this store qty must be used in another log");
                redirect(admin_url('store/store_cutting_list'));
            }
        }
    }

    public function issue_details_list(){

        $data["title"] = "Issue Details List";

        $where = "`s`.`issue_store_from` = '1' AND `s`.`status` = 1";
        $data['f_date'] = date('d/m/Y');
        $data['t_date'] = date('d/m/Y');
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(created_at) between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }else{
                $where .= " and DATE(created_at) between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
        }else{
            $where .= " and DATE(created_at) between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }     
        $data['details_list'] = $this->db->query("SELECT s.id,s.added_by,s.operator_id,s.created_at,p.pro_id,p.total_qty  FROM `tblstore_issue` as s RIGHT JOIN tblproduct_store_log as p ON s.id = p.ref_id AND p.`ref_type` = 'store_issue' WHERE $where ORDER BY created_at DESC")->result();
        $this->load->view('admin/store/issue_details_list', $data); 
    }   


    public function conversion_details_list(){

        $data["title"] = "Conversion Details List";

        $where = " `ref_type` = 'conversion' ";
        $data['f_date'] = date('d/m/Y');
        $data['t_date'] = date('d/m/Y');
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }else{
                $where .= " and date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
        }else{
            $where .= " and date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }
        $data['details_list'] = $this->db->query("SELECT * FROM `tblproduct_store_log` where $where ORDER BY date DESC ")->result();
        $this->load->view('admin/store/conversion_details_list', $data); 
    }

    /* this function use for store conversion list */
    public function convert_to_waste($id){
        if(!empty($id)){
            $this->home_model->update("tblproduct_store_log", array("material_status" => 2, "scrap_store" => 1), array('id' => $id));
            set_alert('success', 'Moved to Scrap Store Succesfully');
        }
        redirect(admin_url('store_report/floor_store_stock_report'));
    }

    /* create a master for cutting products master */
    public function cutting_products_master(){
        $data["title"] = "Cutting Product Master";
        $data["cutting_products_list"] = $this->db->query("SELECT * FROM `tblcuttingproducts_master` WHERE `status`='1' ORDER BY id DESC")->result();
        $this->load->view("admin/store/cutting_product_master_list", $data);
    }

    /* This function use for add cutting products */
    public function add_cutting_products($id =''){

        if(!empty($_POST)){
            extract($this->input->post());
            
            $sub_products_ids = implode(",", $sub_products_ids);
            $insertdata = array(
                'added_by' => get_staff_user_id(),
                'product_id' => $product_id,
                'sub_products_ids' => $sub_products_ids,
                'status' => 1,
                'created_date' => date("Y-m-d H:i:s")
            );
            if ($id != ''){
                unset($insertdata["added_by"]);
                unset($insertdata["created_date"]);
                $response = $this->home_model->update("tblcuttingproducts_master", $insertdata, array('id' => $id));
            }else{
                $response = $this->home_model->insert("tblcuttingproducts_master", $insertdata);
            }
            if (!empty($response)){
                $message = ($id != '') ? "Cutting product update successfully." : "Cutting product added successfully.";
                set_alert('success', $message);
                redirect(admin_url('store/cutting_products_master'));
            }else{
                set_alert('danger', "Somthing went wrong");
                redirect(admin_url('store/cutting_products_master'));
            }
        }

        if ($id != ''){
            $data["title"] = "Edit Cutting Product";
            $data["cuttingproducts_info"] = $this->db->query("SELECT * FROM `tblcuttingproducts_master` WHERE `id`='".$id."'")->row();
        }else{
            $data["title"] = "Add Cutting Product";
        }
        $data["product_list"] = $this->db->query("SELECT * FROM `tblproducts` WHERE `status`='1' ORDER BY `sub_name` ASC")->result();
        $this->load->view("admin/store/add_cutting_product", $data);
    }

    /* get Sub product list */
    public function getSubProductList($log_id){
        $product_id = value_by_id("tblproduct_store_log", $log_id, "pro_id");
        $subproduct = $this->db->query("SELECT `sub_products_ids` FROM `tblcuttingproducts_master` WHERE `product_id`='".$product_id."'")->row();
        echo '<option value=""></option>';
        if (!empty($subproduct) && !empty($subproduct->sub_products_ids)){
            $sub_products  = $this->db->query("SELECT `id`,`sub_name` FROM `tblproducts` WHERE id IN (".$subproduct->sub_products_ids.") ")->result();
            if (!empty($sub_products)){
                foreach ($sub_products as $val) {
                    echo '<option value="'.$val->id.'">'.cc($val->sub_name).product_code($val->id).'</option>';
                }
            }
        }
        $extra_products  = $this->db->query("SELECT `id`,`sub_name` FROM `tblproducts` WHERE `product_cat_id` = '13' ")->result();
        if (!empty($extra_products)){
            foreach ($extra_products as $val) {
                echo '<option value="'.$val->id.'">'.cc($val->sub_name).product_code($val->id).'</option>';
            }
        }

    }

    /* this function use for delete cutting product */
    public function deleteCuttingProducts($id){
        $response = $this->home_model->delete("tblcuttingproducts_master", array("id" => $id));
        if (!empty($response)){
            set_alert('success', "Cutting product remove successfully.");
        }
        redirect(admin_url('store/cutting_products_master'));
    }
}
