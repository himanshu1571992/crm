<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store_report extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    /* this function use for main store stock report */
    public function main_store_stock_report(){
        check_permission(423,'view');
        $data["title"] = "Main Store Stock Report";
        $where = "`id`> 0";
        if(!empty($_POST)){
            extract($this->input->post());
            if (!empty($material_status)){
                $data['material_status'] = $material_status;
                $where .= " and `material_status` = '".$material_status."'";
            }
            if (!empty($service_type)){
                $data['service_type'] = $service_type;
                $where .= " and `service_type` = '".$service_type."'";
            }
            if (!empty($from_date) && !empty($to_date)){
                $data['from_date'] = $from_date;
                $data['to_date'] = $to_date;
                $where .= " and `date` between '".db_date($from_date)."' and '".db_date($to_date)."'";
            }
            if(!empty($warehouse_id)){
                $data['warehouse_id'] = $warehouse_id;

                $data["main_stock_report"] = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE $where and main_store = 1 and consumable_store = 0 and shop_floor_store = 0 and finish_goods_store = 0 and qty > 0 and material_status > 0 and scrap_store = 0 and warehouse_id = '".$warehouse_id."' ORDER BY id DESC")->result();
            }
        }     

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store_report/main_store_stock_report', $data); 
    }

    /* this function use for floor store stock report */
    public function floor_store_stock_report(){
        check_permission(424,'view');
        $data["title"] = "Floor Store Stock Report";

        $where = "`id`> 0";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($material_status)){
                $data['material_status'] = $material_status;
                $where .= " and `material_status` = '".$material_status."'";
            }

            if (!empty($from_date) && !empty($to_date)){
                $data['from_date'] = $from_date;
                $data['to_date'] = $to_date;
                $where .= " and `date` between '".db_date($from_date)."' and '".db_date($to_date)."'";
            }

            if(!empty($warehouse_id)){
                $data['warehouse_id'] = $warehouse_id;

                $data['floor_stock_report'] = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE $where and shop_floor_store = 1 and finish_goods_store = 0 and qty > 0 and material_status > 0 and scrap_store = 0 and warehouse_id = '".$warehouse_id."' ORDER BY id DESC")->result();
            }
        }     

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store_report/floor_store_stock_report', $data); 
    }

    /* this function use for finished goods stock report */
    public function finished_goods_stock_report(){
        check_permission(425,'view');
        $data["title"] = "Finished Goods Stock Report";

        $where = "`id` > 0";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($material_status)){
                $data['material_status'] = $material_status;
                $where .= " and `material_status` = '".$material_status."'";
            }

            if (!empty($service_type)){
                $data['service_type'] = $service_type;
                $where .= " and `service_type` = '".$service_type."'";
            }

            if (!empty($from_date) && !empty($to_date)){
                $data['from_date'] = $from_date;
                $data['to_date'] = $to_date;
                $where .= " and `date` between '".db_date($from_date)."' and '".db_date($to_date)."'";
            }

            if(!empty($warehouse_id)){
                $data['warehouse_id'] = $warehouse_id;

                $data['finished_goods_report'] = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE $where and `finish_goods_store` = 1 and `qty` > 0 and `material_status` > 0 and scrap_store = 0 and `warehouse_id` = '".$warehouse_id."' ORDER BY id DESC")->result();
            }
        }     

        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store_report/finished_goods_stock_report', $data); 
    }

    public function repairupdate($log_id, $ref_type){
        if(!empty($_POST)){
            extract($this->input->post());

            if ($ref_type == "floorstock"){
                $redirect_url = "store_report/floor_store_stock_report";
                $reftype = "shopfloor_repairs_update";
            }else if ($ref_type == "finised_stock"){
                $redirect_url = "store_report/finished_goods_stock_report";
                $reftype = "finishedgoods_repairs_update";
            }else{
                $redirect_url = "store_report/main_store_stock_report";
                $reftype = "mainstore_repairs_update";
            }
            // $redirect_url = ($ref_type == "floorstock") ? "store_report/floor_store_stock_report" : "store_report/finished_goods_stock_report";
            if (isset($storedata) && !empty($storedata)){
                foreach ($storedata as $value) {
                    $totalqty = 0;

                    // $ref_type = ($ref_type == "floorstock") ? "shopfloor_repairs_update" : "finishedgoods_repairs_update";
                    $parentloginfo = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `id` = '".$value['parent_id']."' ")->row();
                    $pdata['parent_id'] = $value['parent_id'];
                    $pdata['pro_id'] = $parentloginfo->pro_id;
                    $pdata['warehouse_id'] = $parentloginfo->warehouse_id;
                    $pdata['service_type'] = $parentloginfo->service_type;
                    $pdata['size'] = $parentloginfo->size;
                    $pdata['ref_type'] = $reftype;
                    $pdata['date'] = date("Y-m-d");
                    
                    if (!empty($value['ok_qty']) && $value['ok_qty'] > 0){
                        $totalqty += $value['ok_qty'];
                        
                        $pdata['total_qty'] = $value['ok_qty'];
                        $pdata['qty'] = $value['ok_qty'];
                        $pdata['main_store'] = $parentloginfo->main_store;
                        $pdata['shop_floor_store'] = $parentloginfo->shop_floor_store;
                        $pdata['finish_goods_store'] = $parentloginfo->finish_goods_store;
                        $pdata['material_status'] = 1;
                        $pdata['scrap_store'] = 0;
                        $pdata['updated_at'] = date("Y-m-d H:i:s");

                        $this->home_model->insert('tblproduct_store_log', $pdata);
                    }
                    if (!empty($value['notok_qty']) && $value['notok_qty'] > 0){
                        $totalqty += $value['notok_qty'];

                        $pdata['total_qty'] = $value['notok_qty'];
                        $pdata['qty'] = $value['notok_qty'];
                        $pdata['main_store'] = $parentloginfo->main_store;
                        $pdata['shop_floor_store'] = $parentloginfo->shop_floor_store;
                        $pdata['finish_goods_store'] = $parentloginfo->finish_goods_store;
                        $pdata['material_status'] = 2;
                        $pdata['scrap_store'] = 1;
                        $pdata['updated_at'] = date("Y-m-d H:i:s");

                        $this->home_model->insert('tblproduct_store_log', $pdata);
                    }
                    if (!empty($value['repair_qty']) && $value['repair_qty'] > 0){
                        $totalqty += $value['repair_qty'];

                        $pdata['total_qty'] = $value['repair_qty'];
                        $pdata['qty'] = $value['repair_qty'];
                        $pdata['main_store'] = $parentloginfo->main_store;
                        $pdata['shop_floor_store'] = $parentloginfo->shop_floor_store;
                        $pdata['finish_goods_store'] = $parentloginfo->finish_goods_store;
                        $pdata['material_status'] = 3;
                        $pdata['scrap_store'] = 0;
                        $pdata['updated_at'] = date("Y-m-d H:i:s");

                        $this->home_model->insert('tblproduct_store_log', $pdata);
                    }
                    
                    if ($totalqty > 0){
                        $this->home_model->update("tblproduct_store_log", array("qty" => 0, "updated_at" => date("Y-m-d H:i:s")), array('id' => $value['parent_id']));
                    }
                }
            }
            
            set_alert('success', 'Store Repair Update Successfully');
            redirect(admin_url($redirect_url));
        }    

        $logdata = $this->db->query("SELECT * FROM `tblproduct_store_log` where id = '".$log_id."' ")->row();
        if (!empty($logdata)){
            $product_name = value_by_id("tblproducts", $logdata->pro_id, "sub_name");
            
            if ($ref_type == "floorstock"){
                $title = "Floor Store Repair Update";
            }else if ($ref_type == "finised_stock"){
                $title = "Finish Goods Store Repair Update";
            }else{
                $title = "Main Store Repair Update";
            }
            $url = admin_url('store_report/repairupdate/'.$log_id.'/'.$ref_type);                    
            echo '<div class="modal-content">
                        <form action="'.$url.'" id="repairupdateform" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">'.$title.'</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label for="productname" style="font-size:15px;" class="control-label"><u>Product Name</u></label>
                                            <div class="form-group">
                                                <span class="text-danger">'.cc($product_name).'</span>
                                            </div>                         
                                        </div>
                                        <div class="col-md-6">
                                            <label for="productname" style="font-size:15px;" class="control-label"><u>Total Qty</u></label>
                                            <div class="form-group">
                                                <span class="text-danger">'.$logdata->qty.'</span>
                                            </div>                         
                                        </div>                             
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">  
                                            <table class="table" id="newtable">
                                                <thead>
                                                    <tr>
                                                        <th>Ok Qty</th>
                                                        <th>Not Ok Qty</th>
                                                        <th>Repair Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td>
                                                        <input type="hidden" class="form-control" name="storedata[0][parent_id]" value="'.$logdata->id.'">
                                                        <input type="hidden" class="form-control" id="aqty_0" name="storedata[0][available_qty]" value="'.$logdata->qty.'">
                                                        <input type="number" class="form-control" required="" id="qty_0" name="storedata[0][ok_qty]" min="0">
                                                    </td>
                                                    <td><input type="number" class="form-control" required="" id="notokqty_0" name="storedata[0][notok_qty]" min="0"></td>
                                                    <td><input type="number" class="form-control" required="" id="repairqty_0" name="storedata[0][repair_qty]" min="0"></td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info final-btn" type="submit" onclick="return checkForTheCondition();">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>';
        }
    }

    /* this function use for scrap store report */
    public function scrap_store_report(){
        check_permission(430,'view');
        $data["title"] = "Scrap Store Report";

        $where = "`qty` > 0 and material_status = 2 and scrap_store = 1";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($from_date) && !empty($to_date)){
                $data['from_date'] = $from_date;
                $data['to_date'] = $to_date;
                $where .= " and `date` between '".db_date($from_date)."' and '".db_date($to_date)."'";
            }
            if (!empty($store_issue) && !empty($warehouse_id)){

                $data['store_issue'] = $store_issue;
                $data['warehouse_id'] = $warehouse_id;
                if ($store_issue == "SFI"){
                    $where .= " and `warehouse_id` = '".$warehouse_id."' and `shop_floor_store` = 1 and `finish_goods_store` = 0";
                }
                if ($store_issue == "FGI"){
                    $where .= " and `warehouse_id` = '".$warehouse_id."' and `finish_goods_store` = 1";
                }
                if ($store_issue == "MSI"){
                    $where .= " and `warehouse_id` = '".$warehouse_id."' and `main_store` = 1 and `shop_floor_store` = 0 and `finish_goods_store` = 0";
                }
                $data['scrap_store_report'] = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE $where  ORDER BY id DESC")->result();
            }
        }     
        
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/store_report/scrap_store_report', $data); 
    }

    /* this function use for convert product */
    public function convertproduct(){
        if(!empty($_POST)){
            extract($this->input->post());

            $parentloginfo = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `id` = '".$pro_log_id."' ")->row();
            if (!empty($parentloginfo)){

                /* this is for update parent product log */
                $ttlqty = $parentloginfo->qty - $qty;
                $ttlqty = ($ttlqty > 0) ? $ttlqty : 0; 
                $response = $this->home_model->update("tblproduct_store_log", array("qty" => $ttlqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $pro_log_id));
                if ($response){

                    $ref_type = ($parentloginfo->service_type == 1) ? "convert_to_sales" : "convert_to_rent";
                    $pdata['parent_id'] = $pro_log_id;
                    $pdata['pro_id'] = $parentloginfo->pro_id;
                    $pdata['warehouse_id'] = $parentloginfo->warehouse_id;
                    $pdata['service_type'] = $service_type;
                    $pdata['total_qty'] = $qty;
                    $pdata['qty'] = $qty;
                    $pdata['size'] = $parentloginfo->size;
                    $pdata['main_store'] = $parentloginfo->main_store;
                    $pdata['shop_floor_store'] = $parentloginfo->shop_floor_store;
                    $pdata['finish_goods_store'] = $parentloginfo->finish_goods_store;
                    $pdata['scrap_store'] = $parentloginfo->scrap_store;
                    $pdata['material_status'] = $parentloginfo->material_status;
                    $pdata['ref_type'] = $ref_type;
                    $pdata['ref_id'] = 0;
                    $pdata['date'] = date("Y-m-d");
                    $pdata['updated_at'] = date("Y-m-d H:i:s");

                    $this->home_model->insert('tblproduct_store_log', $pdata);

                    /* store and update parent product qty in pro stock table */
                    $pro_stock_data = array('pro_id' => $parentloginfo->pro_id, 'warehouse_id' => $parentloginfo->warehouse_id,
                        'store' => 1, 'department_id' => 0, 'is_pro' => 1, 'stock_type' => 1, 'status' => 1, 'staff_id' => 0
                    );
                    $chkstock = $this->db->query('SELECT * FROM tblprostock WHERE `pro_id` = "'.$parentloginfo->pro_id.'" AND `warehouse_id`= "'.$parentloginfo->warehouse_id.'" AND `service_type`= "'.$parentloginfo->service_type.'" AND `department_id` = 0 AND `stock_type` = 1 AND `status` = 1 AND `staff_id` = 0')->row();
                    if (!empty($chkstock)){
                        $stockqty = $chkstock->qty - $qty;
                        $stockqty = ($stockqty > 0) ? $stockqty : 0;
                        $this->home_model->update("tblprostock", array("qty" => $stockqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $chkstock->id));
                    }else{
                        if ($ttlqty > 0){
                            
                            $pro_stock_data['service_type'] = $parentloginfo->service_type;
                            $pro_stock_data['qty'] = $ttlqty;
                            $pro_stock_data['created_at'] = date('Y-m-d H:i:s');
                            $pro_stock_data['updated_at'] = date('Y-m-d H:i:s');
                            $this->home_model->insert('tblprostock', $pro_stock_data);
                        }
                    }

                    /* store and update new product qty in pro stock table */
                    $chkstock = $this->db->query('SELECT * FROM tblprostock WHERE `pro_id` = "'.$parentloginfo->pro_id.'" AND `warehouse_id`= "'.$parentloginfo->warehouse_id.'" AND `service_type`= "'.$service_type.'" AND `department_id` = 0 AND `stock_type` = 1 AND `status` = 1 AND `staff_id` = 0')->row();
                    if (!empty($chkstock)){
                        $stockqty = $chkstock->qty + $qty;
                        $this->home_model->update("tblprostock", array("qty" => $stockqty, "updated_at" => date("Y-m-d H:i:s")), array('id' => $chkstock->id));
                    }else{
                        if ($qty > 0){
                            $pro_stock_data['service_type'] = $service_type;
                            $pro_stock_data['qty'] = $qty;
                            $pro_stock_data['created_at'] = date('Y-m-d H:i:s');
                            $pro_stock_data['updated_at'] = date('Y-m-d H:i:s');
                            $this->home_model->insert('tblprostock', $pro_stock_data);
                        }
                    }
                    set_alert('success', 'Product converted succesfully');
                }
                else{
                    set_alert('danger', 'Somthing went wrong');
                }
            }
            else{
                set_alert('danger', 'Somthing went wrong');
            }
            
            redirect(admin_url('store_report/finished_goods_stock_report'));
        }    
    }

    /* this is for main store bin card */
    public function main_store_bin_card(){
        check_permission(431,'view');

        $this->load->model("store_model");
        $data['f_date'] = date('d/m/Y',strtotime("first day of this month"));
        $data['t_date'] = date('d/m/Y');
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($warehouse_id) && !empty($product_id) && !empty($f_date) && !empty($t_date)){
                $data['warehouse_id'] = $warehouse_id;
                $data['product_id'] = $product_id;
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $data["bin_card_report"] = getDatesFromRange(db_date($data['f_date']), db_date($data['t_date']));
            }    
        } 
        
        $data["title"] = "Main Store Bin Card Report";   
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        // $data['product_list'] = $this->db->query("SELECT p.name, p.id FROM `tblproducts` as p LEFT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id WHERE p.status = 1 and l.main_store = 1 and l.warehouse_id = 1 GROUP by l.pro_id")->result();
        $data['product_list'] = $this->db->query("SELECT p.name,p.sub_name, p.id FROM `tblproducts` as p LEFT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id WHERE p.status = 1 and l.main_store = 1 GROUP by l.pro_id")->result();
        $this->load->view('admin/store_report/main_store_bin_card_report', $data); 
    }

    /* this is for live stock report */
    public function live_stock_report(){
        check_permission(432,'view');

        $this->load->model("store_model");
        $data['service_type'] = 2;
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($warehouse_id) && !empty($service_type)){
                $data['warehouse_id'] = $warehouse_id;
                $data['service_type'] = $service_type;

                if (!empty($from_date) && !empty($to_date) && empty($pro_category_id) && empty($short_by) && empty($division_id)){
                    $data['from_date'] = $from_date;
                    $data['to_date'] = $to_date;
                    $logwhere = "p.status = 1 and l.warehouse_id = '".$warehouse_id."' and l.service_type = '".$service_type."' and l.date between '".db_date($from_date)."' and '".db_date($to_date)."'";
                    $data['product_list'] = $this->db->query("SELECT p.id, p.name,p.sub_name,p.photo,p.unit_id FROM `tblproducts` as p RIGHT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id where $logwhere GROUP by l.pro_id")->result(); 
                }else{
                    if(!empty($pro_category_id) || !empty($short_by) || !empty($division_id)){

                        $where = 'status = 1 ';
                        if(!empty($pro_category_id)){
                            $where .= " and product_cat_id = '".$pro_category_id."' ";
                            $data['pro_category_id'] = $pro_category_id;
                        }

                        if(!empty($division_id)){
                            $where .= " and division_id = '".$division_id."' ";
                            $data['division_id'] = $division_id;
                        }
                        
                        if (!empty($from_date) && !empty($to_date)){
                            $data['from_date'] = $from_date;
                            $data['to_date'] = $to_date;
                        }
    
                        if(!empty($short_by)){
                            if($short_by == 1){
                                $where .= " and min_qty > 0 ";
                            }else{
                                $where .= " and max_qty > 0 ";
                            }
                            $data['short_by'] = $short_by;
                        }
                        $data['product_list'] = $this->db->query("SELECT id, name,sub_name,photo,unit_id FROM `tblproducts` where ".$where." ")->result();
                    }else{
                        $data['product_list'] = $this->db->query("SELECT p.id, p.name,p.sub_name,p.photo,p.unit_id FROM `tblproducts` as p RIGHT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id where p.status = 1 and l.warehouse_id = '".$warehouse_id."' and l.service_type = '".$service_type."' GROUP by l.pro_id")->result(); 
                    }
                } 
            }    
        } 
        
        $data["title"] = "Live Stock Report";   
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $data['product_category_list'] = $this->db->query("SELECT * FROM `tblproductcategory`  WHERE status = 1")->result();
        $data['division_list'] = $this->db->query("SELECT `id`,`title` FROM `tbldivisionmaster` where `status`='1' order by title asc")->result();

        $this->load->view('admin/store_report/live_stock_report', $data); 
    }

    /* this is for sales bin card report */
    public function sales_bin_card_report(){
        // check_permission(431,'view');

        $this->load->model("store_model");
        $data['f_date'] = date('d/m/Y',strtotime("first day of this month"));
        $data['t_date'] = date('d/m/Y');
        $service_type = 2;
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($warehouse_id) && !empty($product_id) && !empty($f_date) && !empty($t_date)){
                $data['warehouse_id'] = $warehouse_id;
                $data['product_id'] = $product_id;
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $data["sales_card_report"] = getDatesFromRange(db_date($data['f_date']), db_date($data['t_date']));
            }    
        } 
        
        $data["title"] = "Sales Bin Card Report";  
        $data["service_type"] = $service_type; 
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        // $data['product_list'] = $this->db->query("SELECT p.name, p.id FROM `tblproducts` as p LEFT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id WHERE p.status = 1 and l.main_store = 1 and l.warehouse_id = 1 GROUP by l.pro_id")->result();
        $data['product_list'] = $this->db->query("SELECT p.name, p.sub_name, p.id FROM `tblproducts` as p LEFT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id WHERE p.status = 1 and l.main_store = 1 and service_type = '".$service_type."' GROUP by l.pro_id")->result();
        $this->load->view('admin/store_report/sales_bin_card_report', $data); 
    }

    /* this is for rent bin card report */
    public function rent_bin_card_report(){
        // check_permission(431,'view');

        $this->load->model("store_model");
        $data['f_date'] = date('d/m/Y',strtotime("first day of this month"));
        $data['t_date'] = date('d/m/Y');
        $service_type = 1;
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($warehouse_id) && !empty($product_id) && !empty($f_date) && !empty($t_date)){
                $data['warehouse_id'] = $warehouse_id;
                $data['product_id'] = $product_id;
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $data["rent_bin_card_report"] = getDatesFromRange(db_date($data['f_date']), db_date($data['t_date']));
            }    
        } 
        
        $data["title"] = "Rent Bin Card Report";  
        $data["service_type"] = $service_type; 
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        // $data['product_list'] = $this->db->query("SELECT p.name, p.id FROM `tblproducts` as p LEFT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id WHERE p.status = 1 and l.main_store = 1 and l.warehouse_id = 1 GROUP by l.pro_id")->result();
        $data['product_list'] = $this->db->query("SELECT p.name, p.sub_name, p.id FROM `tblproducts` as p LEFT JOIN `tblproduct_store_log` as l ON p.id = l.pro_id WHERE p.status = 1 and l.main_store = 1 and service_type = '".$service_type."' GROUP by l.pro_id")->result();
        $this->load->view('admin/store_report/rent_bin_card_report', $data); 
    }

    /* this function use for finished goods production report */
    public function finished_goods_production_report(){
        
        $data["title"] = "Finished Goods Production Report";
        $data["search_data"] = '';
        $where = "`id` > 0";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $data["search_data"] = '?f_date='.$f_date.'&t_date='.$t_date;
                $where .= " and `date` between '".db_date($f_date)."' and '".db_date($t_date)."'";
                $data['production_report'] = $this->db->query("SELECT * FROM `tblfinishedgoodproductionsubmission` WHERE $where and `parent_id` = 0 and `status` = 1 ORDER BY id DESC")->result();
            }
        }     

        $this->load->view('admin/store_report/finished_goods_production_report', $data); 
    }

    /* this function use for production details */
    public function get_production_details($store_id){
        $productiondetails = $this->db->query("SELECT * FROM `tblfinishedgoodproductionsubmission` where (parent_id = '".$store_id."' OR id = '".$store_id."') and `status` = 1")->result();
        if (!empty($productiondetails)){
            foreach ($productiondetails as $key => $value) {
                $product_name = value_by_id("tblproducts", $value->product_id, "sub_name");
                $url = admin_url('product_new/view/'.$value->product_id);
                $division_name = value_by_id("tbldivisionmaster", $value->department_id, "title");
                echo "<tr>
                        <td>".++$key."</td>
                        <td><a href='".$url."' target='_blank'>".cc($product_name)."</a></td>
                        <td>".$division_name."</td>
                        <td>".$value->produced_qty."</td>
                        <td>".$value->rejection_qty."</td>
                        <td>".cc($value->remark)."</td>
                    </tr>";  
            }
            
        }
    }

    /* this function use for detailed report */
    public function finished_goods_production_detailed(){
        
        $data["title"] = "Finished Goods Production Detailed Report";
        $where = "`id` > 0";
        if (!empty($_GET["f_date"]) && !empty($_GET["t_date"])){
            $data['f_date'] = $_GET["f_date"];
            $data['t_date'] = $_GET["t_date"];
            $where .= " and `date` between '".db_date($_GET["f_date"])."' and '".db_date($_GET["t_date"])."'";
            $data['production_report'] = $this->db->query("SELECT * FROM `tblfinishedgoodproductionsubmission` WHERE $where and `status` = 1 ORDER BY id DESC")->result();
        }
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $where .= " and `date` between '".db_date($f_date)."' and '".db_date($t_date)."'";
                $data['production_report'] = $this->db->query("SELECT * FROM `tblfinishedgoodproductionsubmission` WHERE $where and `status` = 1 ORDER BY id DESC")->result();
            }
        }

        $this->load->view('admin/store_report/finished_goods_production_details', $data); 
    }
}
