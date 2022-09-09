<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stock_consumption extends Admin_controller {
    
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
        $this->load->model('stock_consumption_model');
    }
    
    public function index()
    {
        check_permission(328,'view');
        $data['title'] = 'Stock Consumption List';
        $where = "id > 0";
        if ($_POST){
            extract($this->input->post());
            
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and DATE(created_at) between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
            
            if(!empty($warehouse_id)){
                $data['warehouse_id'] = $warehouse_id;
                $where .= " and warehouse_id = '".$warehouse_id."'";
            }
            if(!empty($service_type)){
                $data['service_type'] = $service_type;
                $where .= " and service_type = '".$service_type."'";
            }
            if(!empty($stock_type)){
                $data['stock_type'] = $stock_type;
                $where .= " and type = '".$stock_type."'";
            }
            if(strlen($status) > 0){
                $data['status'] = $status;
                $where .= " and status = '".$status."'";
            }
        }
        $staff_warehouse_id = get_employee_info(get_staff_user_id())->warehouse_id;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  where id in (".$staff_warehouse_id.") and status = 1")->result();
        $data['stock_list'] = $this->db->query("SELECT * FROM tblstockconsumption WHERE ".$where." ORDER BY `id` DESC")->result();
        $data['vendor_list'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ")->result();
        
        $this->load->view('admin/stock_consumption/list', $data);
    }
    
    /* this function use for add stock consumption */
    public function add(){
        check_permission(328,'create');
        $data["title"] = "Stock Consumption";
        
        if ($this->input->post()){
            $data = $this->input->post();
            $insert_id = $this->stock_consumption_model->add($data);
            if ($insert_id){
                set_alert('success', 'Stock Add Successfully');
                redirect(admin_url('stock_consumption')); 
            }else{
                set_alert('danger', 'Something went wrong');
                redirect(admin_url('stock_consumption')); 
            }
        }
        
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='20'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;
        
        $staff_warehouse_id = get_employee_info(get_staff_user_id())->warehouse_id;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  where id in (".$staff_warehouse_id.") and status = 1")->result();
        $data['vendor_list'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ")->result();
        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = 1 and is_approved = 1")->result();
        
        $this->load->view('admin/stock_consumption/add', $data);
    }
    
    /* this is for get product details */
    public function get_prodcut_details(){
        extract($this->input->post());
        $prostock = $this->db->query("SELECT * FROM `tblprostock`  where pro_id = '".$product_id."' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and status = 1 and stock_type = 1 and staff_id = 0")->row();

        $availableqty = (!empty($prostock)) ? $prostock->qty : 0;
        echo json_encode(array("pro_id" => "PRO-".$product_id, "availableqty" => $availableqty));
    }
    
    public function view($id, $action = "") {
        check_permission(328,'view');
        $info = $this->db->query("SELECT * FROM tblstockconsumption WHERE id = '" . $id . "'")->row();
        if (empty($info)) {
            redirect(admin_url('stock_consumption'));
        }
        
        if (!empty($action)) {
            if ($info->status > 0) {
                set_alert('warning', 'Action Alreadt Taken!');
                redirect(admin_url('stock_consumption'));
            }

            $data['title'] = 'Stock Consumption Approval';
            $data['action'] = 1;
        } else {
            $data['title'] = 'Stock Consumption Details';
        }

        $staff_warehouse_id = get_employee_info(get_staff_user_id())->warehouse_id;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  where id in (".$staff_warehouse_id.") and status = 1")->result();
        $data['vendor_list'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ")->result();
        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = 1 and is_approved = 1")->result();
        $data['stock_details'] = $this->db->query("SELECT * FROM tblstockconsumptionproductsdetails WHERE stockconsumption_id = '" . $id . "'")->result();
        $data['stock_info'] = $info;
        $data['id'] = $id;

        $this->load->view('admin/stock_consumption/view', $data);
    }

    /* this function use for update stock approval */
    public function stock_approval()
    {
        if(!empty($_POST)){
            $data = $this->input->post();
            $main_id = $this->stock_consumption_model->stock_update_status($data["id"], $data);
            if ($main_id){
                
                $des =  'Stock Rejected Successfully';
                if($data["action"] == 1){
                    $des =  'Stock Approved Successfully';
                }
                set_alert('success', $des);
                redirect(admin_url('stock_consumption')); 
            }
            else{
                set_alert('danger', 'Something went wrong');
                redirect(admin_url('stock_consumption')); 
            }
        }
    }
    
    public function get_assign_status($id) {
        $getapprovel = $this->db->query("SELECT * FROM `tblmasterapproval`  where table_id = '" . $id . "' and module_id = 17")->result();
        echo '<div class="form-group">
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Action</td>
                                                <td>Read At</td>
                                            </tr>
                                        </thead>
                                        <tbody>';
        $status_arr = array('<p class="text-warning">Pending</p>' => '0', '<p class="text-success">Approved</p>' => '1', '<p class="text-danger">Rejected</p>' => '2');
        if (!empty($getapprovel)){
            foreach ($getapprovel as $key => $value) {
                $readdate = ($value->isread == 1) ? _d($value->readdate) : "--";
                echo '<tr>
                        <td>'.++$key.'</td>
                        <td>'.get_employee_fullname($value->staff_id).'</td>
                        <td>'.array_search($value->approve_status, $status_arr).'</td>   
                        <td>'.$readdate.'</td>                                                       
                     </tr>';
            }
        }
        echo'</tbody></table></div>';
    }
    
    /* this functiom use stock_issue */
    public function stock_issue(){
        check_permission(363,'view');
        $data['title'] = 'Stock Issue List';
        $where = "id > 0";
        if ($_POST){
            extract($this->input->post());
            
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
            
            if(!empty($warehouse_id)){
                $data['warehouse_id'] = $warehouse_id;
                $where .= " and warehouse_id = '".$warehouse_id."'";
            }
            if(!empty($service_type)){
                $data['service_type'] = $service_type;
                $where .= " and service_type = '".$service_type."'";
            }
        }
        $staff_warehouse_id = get_employee_info(get_staff_user_id())->warehouse_id;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  where id in (".$staff_warehouse_id.") and status = 1")->result();
        $data['stock_list'] = $this->db->query("SELECT * FROM tblissue WHERE ".$where." ORDER BY `id` DESC")->result();
        
        $this->load->view('admin/stock_consumption/stock_issue_list', $data);
    }
    
    /* this function use for add stock issue */
    public function stock_issue_add(){
        check_permission(363,'create');
        $data["title"] = "Add Stock Issue";
        
        if ($this->input->post()){
           
            $data = $this->input->post();
            $insert_id = $this->stock_consumption_model->stock_issue_add($data);
            if ($insert_id){
                set_alert('success', 'Stock Issue Successfully');
                redirect(admin_url('stock_consumption/stock_issue')); 
            }else{
                set_alert('danger', 'Something went wrong');
                redirect(admin_url('stock_consumption/stock_issue')); 
            }
        }
        
        $staff_warehouse_id = get_employee_info(get_staff_user_id())->warehouse_id;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  where id in (".$staff_warehouse_id.") and status = 1")->result();
        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = 1 and is_approved = 1")->result();
        
        $this->load->view('admin/stock_consumption/stock_issue_add', $data);
    }
    
    /* this function use for delete stock issue */
    public function stock_issue_delete($id){
        check_permission(363,'delete');
        $success = $this->stock_consumption_model->stock_issue_delete($id);
        if ($success) {
            set_alert('success', "Stock Issue Deleted");
            redirect(admin_url('stock_consumption/stock_issue')); 
        } else {
            set_alert('danger', 'Something went wrong');
            redirect(admin_url('stock_consumption/stock_issue')); 
        }
    }
    
    /* this function use for stock issue view*/
    public function stock_issue_view($id){
        check_permission(363,'view');
        $data["title"] = "Stock Issue View";
        
        $data['stock_info'] = $this->db->query("SELECT * FROM `tblissue`  where id = ".$id." and status = 1")->row();
        $data['stock_details'] = $this->db->query("SELECT * FROM `tblissueproduct` WHERE stockissue_id = '" . $id . "'")->result();

        $this->load->view('admin/stock_consumption/stock_issue_view', $data);
    }
    
    /* this function use for generate report of stock shortage */
    public function stock_shortage()
    {
        check_permission(364,'view');
        $data['title'] = 'Stock Shortage Report';
        if ($_POST){
            extract($this->input->post());
            
            if(!empty($warehouse_id) && !empty($service_type)){
                $data['warehouse_id'] = $warehouse_id;
                $data['service_type'] = $service_type;
                $where = " ps.warehouse_id = '".$warehouse_id."' and ps.service_type = '".$service_type."' and ps.qty < p.min_qty and p.min_qty != 0.00";
                $data['product_stock_list'] = $this->db->query("SELECT p.*, ps.qty as available_qty FROM `tblprostock` as ps RIGHT JOIN `tblproducts` as p ON `ps`.`pro_id` = `p`.`id`  WHERE ".$where." ")->result();
            }
        }
        
        
        $staff_warehouse_id = get_employee_info(get_staff_user_id())->warehouse_id;
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  where id in (".$staff_warehouse_id.") and status = 1")->result();
        
        $this->load->view('admin/stock_consumption/stock_shortage_report', $data);
    }
}
