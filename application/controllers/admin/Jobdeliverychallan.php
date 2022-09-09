<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Jobdeliverychallan extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('Jobdeliverychallan_model');
    }

    public function index()
    {
        $where = "id > 0  ";
        check_permission(372,'view');
        if(!empty($_POST)){

            extract($this->input->post());
            if(!empty($vendor_id) || !empty($f_date) || !empty($t_date) || isset($approve_status)){

                if(!empty($vendor_id)){
                    $data['vendor_id'] = $vendor_id;
                    $where .= " and vendor_id = '".$vendor_id."'";
                }

                if(!empty($service_type)){
                    $data['service_type'] = $service_type;
                    $where .= " and service_type = '".$service_type."'";
                }
                if(isset($approve_status) && strlen($approve_status) > 0){
                    $data['approve_status'] = $approve_status;
                    $where .= " and status = '".$approve_status."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $where .= " and `date` >= '".db_date($f_date)."' and `date` <= '".db_date($t_date)."' ";
                }
            }
        }else{
            $where = " year_id = '".financial_year()."' ";
        }

        // Get records
        $data['delivarychallan_list'] = $this->db->query("SELECT * from `tbljobdelivarychallan` where ".$where." ORDER BY id desc ")->result();
        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ORDER BY name ASC ")->result();
        $data['branch_info'] = $this->db->query("SELECT `id`,`comp_branch_name` from `tblcompanybranch` where status = 1 ORDER BY comp_branch_name ASC ")->result();

        $data['title'] = 'Job Work Challan List';
        $this->load->view('admin/jobdeliverychallan/list', $data);
    }

    public function add($id = '') {
        
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            if ($id == '') {
                $id = $this->Jobdeliverychallan_model->add($proposal_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Job delivery challan'));
                    redirect(admin_url('Jobdeliverychallan/'));
                }
            } else {
                $success = $this->Jobdeliverychallan_model->update($proposal_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Job delivery challan'));
                    redirect(admin_url('Jobdeliverychallan/'));
                }
            }
        }

        if ($id == '') {
            check_permission(372,'create');
            $title = 'Add Job Delivery Challan';
        } else {
            check_permission(372,'edit');
            $title = 'Edit Job Delivery Challan';
            $data['purchase_info'] = $this->db->query("SELECT * from tbljobdelivarychallan where id = '".$id."' ")->row_array();
            $data['product_info'] = $this->db->query("SELECT * from tbljobdelivarychallanproduct where delivarychallan_id = '".$id."' ")->result_array();

            $data['staffassigndata'] = explode(',', $data['purchase_info']['assignid']);

        }

        // Getting Main products and Temp Products In Single Array
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 order by name asc")->result_array();

        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 order by name asc ")->result_array();
        $data['billing_branches'] = $this->db->query("SELECT * from tblcompanybranch where status = '1' order by comp_branch_name asc ")->result();
        $data['unit_list'] = $this->db->query("SELECT * from tblunitmaster where status = '1' order by name asc ")->result();
        $data['title'] = $title;

        $this->load->view('admin/jobdeliverychallan/add', $data);
    }

    public function getProductDetails() {
        $prodid=$this->input->post('prodid');
        $store_type=$this->input->post('store_type');
        $warehouse_id=$this->input->post('warehouse_id');

        $this->db->where('id', $prodid);
        $proddata= $this->db->get('tblproducts')->row();
        $proddata= (array) $proddata;

        $product_unit = get_product_unit($prodid);
        $unit_id = value_by_id_empty('tblproducts',$prodid,'unit_2');

        // $where = "pro_id = '" . $prodid . "' and service_type = '" . $service_type . "' and stock_type = 1 and status = 1 and staff_id = 0";
        // $getprostock = $this->db->query("SELECT `id`,`qty` FROM tblprostock WHERE " . $where . " ORDER BY id DESC")->row();
        // $aqty = (!empty($getprostock)) ? $getprostock->qty : 0;

        $ttl_qty = 0;
        if (!empty($store_type) && !empty($warehouse_id)){
            if ($store_type == 1){
                $ttl_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE `pro_id` = '".$prodid."' and qty > 0 and warehouse_id = '".$warehouse_id."' and service_type = 2  and material_status = 1 and main_store = 1 and shop_floor_store = 0 and finish_goods_store = 0")->row()->ttl_qty;
            }else{
                $ttl_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE `pro_id` = '".$prodid."' and qty > 0 and warehouse_id = '".$warehouse_id."' and service_type = 2 and material_status = 1 and shop_floor_store = 1 and finish_goods_store = 0")->row()->ttl_qty;
            }
        }
        
        echo json_encode(array('name'=>$proddata['name'], 'product_unit_id' => $unit_id, 'product_unit' => $product_unit, 'product_remarks'=> "", 'pro_id'=>'PRO-ID'.$prodid, 'available_qty'=> $ttl_qty));
    }

    public function get_assign_status($id) {
        $getapprovel = $this->db->query("SELECT * FROM `tblmasterapproval`  where table_id = '" . $id . "' and module_id = 32")->result();
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
        $status_arr = array('<p class="text-warning">Pending</p>' => '0', '<p class="text-success">Approved</p>' => '1', '<p class="text-danger">Rejected</p>' => '2', '<p class="text-danger" style="color: #9d0b1a;">Reconciliation</p>' => '4', '<p class="text-danger" style="color: #f9d306;">ON Hold</p>' => '5');
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

    public function get_return_assign_status($id) {
        $getapprovel = $this->db->query("SELECT * FROM `tblmasterapproval`  where table_id = '" . $id . "' and module_id = 33")->result();
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

    public function jobdeliverychallan_approval($id){
        $info = $this->db->query("SELECT * FROM tbljobdelivarychallan WHERE id = '".$id."' AND status > 0 ")->row();
        if(!empty($info) && $info->status != 5){
            set_alert('warning', 'Action already taken!');
             redirect(admin_url('approval/notifications'));
        }

        if(!empty($_POST)){
            extract($this->input->post());

            $msg = 'Jobdelivery challan taken reject succesfully';
            if($submit == 1)
            {
                $productinfo = $this->db->query("SELECT * FROM tbljobdelivarychallanproduct WHERE delivarychallan_id = '".$id."'")->result();
                if (!empty($productinfo)){
                    $dinfo = $this->db->query("SELECT * FROM tbljobdelivarychallan WHERE id = '".$id."'")->row();
                    foreach ($productinfo as $value) {
                        
                            /* this is for update available qty */
                            $reqqty = $value->qty;
                            if ($dinfo->store_type == 1){
                                $prodata = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `pro_id` = '".$value->product_id."' and qty > 0 and warehouse_id = '".$dinfo->warehouse_id."' and service_type = 2 and material_status = 1 and main_store = 1 and shop_floor_store = 0 and finish_goods_store = 0 ORDER BY qty ASC")->result();
                            }else{
                                $prodata = $this->db->query("SELECT * FROM `tblproduct_store_log` WHERE `pro_id` = '".$value->product_id."' and qty > 0 and warehouse_id = '".$dinfo->warehouse_id."' and service_type = 2 and material_status = 1 and shop_floor_store = 1 and finish_goods_store = 0 ORDER BY qty ASC")->result();
                            }
                            if (!empty($prodata)){
                                foreach ($prodata as $pval) {
                                    
                                    if ($reqqty > 0){
                                        
                                        $finalqty = number_format($reqqty, 2) - number_format($pval->qty, 2);
                                        $reqqty = ($finalqty > 0) ? $finalqty : 0;
                                        $itemqty = ($finalqty < 0) ? abs($finalqty) : 0;
        
                                        /* this is for update item qty after consumed */
                                        $this->home_model->update("tblproduct_store_log", array("qty" => $itemqty,"updated_at" => date("Y-m-d H:i:s")), array('id' => $pval->id));
                                    }
                                }
                            }

                            $prod_info = $this->db->query("SELECT `unit_id`,`unit_1`,`unit_2`,`size`,`conversion_1`,`conversion_2`,`width_mm` FROM `tblproducts` where `id`= '".$value->product_id."' ")->row();
                            $product_size = 0;
                            if($prod_info->unit_id == 7){
                                $product_size = $prod_info->size;
                            }elseif($prod_info->unit_1 == 7){
                                $product_size = $prod_info->conversion_1;
                            }elseif($prod_info->unit_2 == 7){
                                $product_size = $prod_info->conversion_2;
                            }
                            $main_store = 0;
                            $shop_floor_store = 1;
                            if ($dinfo->store_type == 1){
                                $main_store = 1;
                                $shop_floor_store = 0;
                            }
                            $pdata['parent_id'] = 0;
                            $pdata['pro_id'] = $value->product_id;
                            $pdata['warehouse_id'] = $dinfo->warehouse_id;
                            $pdata['service_type'] = $dinfo->service_type;
                            $pdata['total_qty'] = $value->qty;
                            $pdata['qty'] = 0;
                            $pdata['size'] = $product_size;
                            $pdata['width'] = $prod_info->width_mm;
                            $pdata['main_store'] = $main_store;
                            $pdata['shop_floor_store'] = $shop_floor_store;
                            $pdata['job_work_store'] = 1;
                            $pdata['material_status'] = 1;
                            $pdata['ref_type'] = "job_work";
                            $pdata['ref_id'] = $id;
                            $pdata['date'] = date("Y-m-d");
                            $pdata['updated_at'] = date("Y-m-d H:i:s");

                            $this->home_model->insert('tblproduct_store_log', $pdata);
                    }
                }

                $msg = 'Jobdelivery challan taken approval succesfully';
            }else if ($submit == 4){
                $msg = 'Jobdelivery challan taken Reconciliation succesfully';
            }else if ($submit == 5){
                $msg = 'Jobdelivery challan taken hold succesfully';
            }
            //Update master approval
            update_masterapproval_single(get_staff_user_id(),32,$id,$submit);
            update_masterapproval_all(32,$id,$submit);

            $ad_data = array('approve_status' => $submit, 'remark' => $remark);
            $update = $this->home_model->update('tbljobdelivarychallanapproval', $ad_data,array('delivarychallan_id'=>$id,'staff_id'=>get_staff_user_id()));
            $this->home_model->update('tbljobdelivarychallan', array("status" => $submit, "approval_date" => date("Y-m-d")),array('id'=>$id));

            if($update){
                 set_alert('success', $msg);
                 redirect(admin_url('approval/notifications'));
            }
        }

        $data['info'] = $this->db->query("SELECT * FROM tbljobdelivarychallan WHERE id = '".$id."' ")->row();
        $data['product_info'] = $this->db->query("SELECT * FROM tbljobdelivarychallanproduct WHERE delivarychallan_id = '".$id."' ")->result_array();
        $data['appvoal_info'] = $this->db->query("SELECT * FROM tbljobdelivarychallanapproval WHERE delivarychallan_id = '".$id."' and approve_status != 0 ")->row();

        $data['unit_list'] = $this->db->query("SELECT * from tblunitmaster where status = '1' ")->result();

        $data['title'] = 'Job delivery challan Approval';
        $this->load->view('admin/jobdeliverychallan/jobdeliverychallan_approval', $data);
    }

    public function cancel_challan($id){
        $this->home_model->update('tbljobdelivarychallan', array("status" => 3),array('id'=>$id));

        /* this is for update product stock */
        $productinfo = $this->db->query("SELECT * FROM tbljobdelivarychallanproduct WHERE delivarychallan_id = '".$id."'")->result();
        if (!empty($productinfo)){
            $dinfo = $this->db->query("SELECT * FROM tbljobdelivarychallan WHERE id = '".$id."'")->row();
            foreach ($productinfo as $value) {
                $where = "pro_id = '" . $value->product_id . "' and service_type = '" . $dinfo->service_type . "' and stock_type = 1 and status = 1 and staff_id = 0";
                $getprostock = $this->db->query("SELECT `id`,`qty` FROM tblprostock WHERE " . $where . " ORDER BY id DESC")->row();

                if (!empty($getprostock)){
                    $curr_qty = $getprostock->qty + $value->qty;

                    $ad_data["qty"] = $curr_qty;
                    $this->home_model->update('tblprostock', $ad_data,array('id'=>$getprostock->id));
                }
            }
        }
        set_alert('success', 'Jobdelivery challan cancel succesfully');
        redirect(admin_url('Jobdeliverychallan'));
    }

    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('Jobdeliverychallan'));
        }

        $file_name = 'JDC-' . str_pad($id, 4, '0', STR_PAD_LEFT);
        $html = jobdeliverychallan_pdf($id);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
        $size       = 8;
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );

        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
    }


    public function delete($id){
        check_permission(372,'delete');
        $dinfo = $this->db->query("SELECT * FROM tbljobdelivarychallan WHERE id = '".$id."'")->row();
        if(empty($dinfo)){
            set_alert('warning', 'Record not found');
            redirect(admin_url('Jobdeliverychallan'));
        }

        $response = $this->home_model->delete("tbljobdelivarychallan", array("id" => $id));
        if ($response){
            $this->home_model->delete("tbljobdelivarychallanproduct", array("delivarychallan_id" => $id));
            $this->home_model->delete("tbljobdelivarychallanapproval", array("delivarychallan_id" => $id));
            $this->home_model->delete("tblmasterapproval", array("module_id" => 32, "table_id" => $id));

            set_alert('success', 'Job Delivery Challan delete successfully');
            redirect(admin_url('Jobdeliverychallan'));
        }else{
            set_alert('warning', 'somthing went wrong');
            redirect(admin_url('Jobdeliverychallan'));
        }
    }

    public function get_handover_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $process_info = $this->db->query("SELECT * from tblchallanprocess where `type`=3 and `job_work_id` = '".$job_work_id."' and `for` = '".$type."' and complete = 1 ")->row();

            if(!empty($process_info)){
                $handoverlog_info = $this->db->query("SELECT * from tblhandoverlog where handover_id = '".$process_info->handover_id."' order by id asc ")->result();
                $handover_info = $this->db->query("SELECT * from tblhandover where id = '".$process_info->handover_id."' ")->row();
            }
            if(!empty($handover_info) && ($handover_info->final_receive == 1)){
                echo '<h5 class="text-success">Document Reached to Final Receiver ('.get_employee_name($handover_info->receiver_id).')</h5>';
            }
            ?>
            <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Sender Remark</th>
                        <th>Receiver Remark</th>
                        <th>Status</th>
                        <th>Receive Date</th>
                        <th>Attachments</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($handoverlog_info)){
                        foreach ($handoverlog_info as $key => $value) {
                            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'handover' and rel_id = '".$value->id."' ")->result();
                            ?>

                         <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><?php echo get_employee_name($value->sender_staff_id);?></td>
                            <td><?php echo get_employee_name($value->receiver_id);?></td>
                            <td><?php echo (!empty($value->sender_remark)) ? $value->sender_remark : '--'; ?></td>
                            <td><?php echo (!empty($value->receiver_remark)) ? $value->receiver_remark : '--'; ?></td>
                            <td><?php echo ($value->received_status == 1) ? 'Received' : 'Not Received'; ?></td>
                            <td><?php echo ($value->receive_date > 0) ? _d($value->receive_date) : '--'; ?></td>
                            <td><?php
                                if(!empty($file_info)){
                                    foreach ($file_info as $file) {
                                        ?>
                                        <a target="_blank" href="<?php echo base_url('uploads/handover/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
                                        <?php
                                    }
                                }else{
                                    echo '--';
                                }
                                ?>
                            </td>

                         </tr>

                         <?php
                        }
                    }else{
                        echo '<tr><td colspan="8" class="text-center">Record Not Found!</td></tr>';
                    }
                    ?>
                     </tbody>
                </table>
            </div>
            <?php

        }
      }

      public function make_complete($id) {
          $update = $this->home_model->update('tblchallanprocess', array('final_complete'=>1), array('id'=>$id));

          set_alert('success', 'Challan completed successfully');
          redirect(admin_url('jobdeliverychallan'));
      }

      public function make_delivery() {
            if(!empty($_POST)){
                extract($this->input->post());

                $challan_manage_id = $this->db->query("SELECT `challan_manage_id` FROM `tblcompanybranch` WHERE `id` = '".$branch_id."' ")->row()->challan_manage_id;
                if(empty($challan_manage_id)){
                    set_alert('warning', 'Responsible person is not allotted to handle this request!');
                    redirect(admin_url('jobdeliverychallan'));
                    die;
                }

                $delivery_date = str_replace("/","-",$delivery_date);
                $delivery_date = date("Y-m-d",strtotime($delivery_date));

                if($for == 1){
                    $text_status = 'Delivery challan assign';
                }else{
                    $text_status = 'Pickup challan assign';
                }
                $insert_data = array(
                            'staff_id' => get_staff_user_id(),
                            'job_work_id' => $job_work_id,
                            'type' => 3,
                            'for' => $for,
                            'priority' => $priority,
                            'date' => $delivery_date,
                            'description' => $description,
                            'status' => 1,
                            'status_id' => 1,
                            'text_status' => $text_status,
                            'created_at' => date('Y-m-d')
                        );

                $insert = $this->home_model->insert('tblchallanprocess', $insert_data);

                if($insert == true){

                    $challanprocess_id = $this->db->insert_id();

                    $this->home_model->update('tbljobdelivarychallan', array('process'=>$for,'under_process'=>1), array('id'=>$job_work_id));

                    /*if(!empty($staff_info)){
                        foreach($staff_info as $row)
                        {*/
                            $staffid = $challan_manage_id;

                            $prdata['staff_id']=$staffid;
                            $prdata['challanprocess_id']=$challanprocess_id;
                            $prdata['status']=1;
                            $this->db->insert('tblchallanallotperson',$prdata);

                            if($for == 1){
                                $message = 'Delivery challan allotted to you assign';
                            }else{
                                $message = 'Pickup challan allotted to you assign';
                            }

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'SSAFE';
                            $send_intimation = sendFCM($message, $title, $token);

                            $notified = add_notification([
                                        'description'     => $message,
                                        'touserid'        => $staffid,
                                        'fromuserid'      => get_staff_user_id(),
                                        'module_id'        => 10,
                                        'type'            => 0,
                                        'table_id'        => $challanprocess_id,
                                        'category_id'        => $for,
                                        'link'            => '#',

                                    ]);
                                    if ($notified) {
                                        pusher_trigger_notification([$staffid]);
                                    }
                        /*}
                    }*/
                    set_alert('success', 'Challan allotted successfully to manager');
                    redirect(admin_url('jobdeliverychallan'));
                }
            }
        }
}
