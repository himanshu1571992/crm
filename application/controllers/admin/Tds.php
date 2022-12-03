<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Tds extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Tds_model');
        $this->load->model('home_model');
    }

    public function update_amount()
    {

        $approved_info = $this->db->query("SELECT * FROM `tbltds_amountapproval` where status = 2  ")->result();

        if(!empty($approved_info)){
            foreach ($approved_info as $value) {
                 $pay_id = $value->pay_id;
                 $amount = $value->amount;
                 $this->home_model->update('tblinvoicepaymentrecords', array('paid_tds_amt'=>$amount),array('id'=>$pay_id));
            }
        }
    }

    public function index()
    {

        check_permission(62,'view');
        $data['s_client_id'] = 0;
        $where = "p.tds > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());
            $data['s_client_id'] = $client_id;
            $where .= " and cp.client_id = '".$client_id."'";
        }


        $data['tds_info'] = $this->db->query("SELECT cp.client_id,a.*,p.debitnote_no,p.paymentmethod,p.invoiceid,p.tds,p.tds_amt FROM tbltds_amountapproval as a LEFT JOIN tblinvoicepaymentrecords as p ON a.pay_id = p.id LEFT JOIN tblclientpayment as cp ON cp.id = p.pay_id  where ".$where." ")->result();


        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch`  ")->result();

        $data['title'] = 'TDS Reconciliation List';
        $this->load->view('admin/tds/manage', $data);

    }

    public function reconcilition_done()
    {

        check_permission(63,'view');
        $data['s_client_id'] = 0;
        $where = "p.paid_tds_amt > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());
            $data['s_client_id'] = $client_id;
            $where .= " and cp.client_id = '".$client_id."'";
        }


         $data['tds_info'] = $this->db->query("SELECT cp.client_id, p.* FROM tblinvoicepaymentrecords as p LEFT JOIN tblclientpayment as cp ON cp.id = p.pay_id where ".$where." ")->result();


        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch`  ")->result();

        $data['title'] = 'TDS Reconciliation Done List';
        $this->load->view('admin/tds/reconcilition_done', $data);

    }

    public function add($id="")
    {

        check_permission(62,'create');

        if(!empty($_POST)){
            extract($this->input->post());
            $tds_data = $this->input->post();

            $id = $this->Tds_model->add($tds_data);

            if ($id) {
                set_alert('success', 'TDS Reconciliation Send for Approval Successfully');
                redirect(admin_url('tds'));
            }
        }

        $data['title'] = 'TDS Reconciliation';

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

        $data['tds_info'] = $this->db->query("SELECT cp.client_id, p.* FROM tblinvoicepaymentrecords as p LEFT JOIN tblclientpayment as cp ON cp.id = p.pay_id where p.tds > 0 and p.showInReconciliation = 1 ")->result();


        $this->load->view('admin/tds/add', $data);

    }

    public function get_approval_info() {


        if(!empty($_POST)){
            extract($this->input->post());
            //$main_id = $this->db->query("SELECT `id` FROM `tbltds_reconciliation` WHERE FIND_IN_SET('".$id."', pay_id)  ")->row()->id;
            $assign_info = $this->db->query("SELECT * from tbltdsapproval  where main_id = '".$id."'  ")->result();


            ?>
            <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Action</td>
                                                <td>Remark</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                    <td><?php echo ($value->remark != '') ?  $value->remark : '--';  ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>

            <?php

        }


    }


    public function approval($id) {

        if(!empty($_POST)){
            extract($this->input->post());

            $tds_info = $this->db->query("SELECT * from tbltds_reconciliation where id = '".$id."' ")->row();

            $ad_data = array(
                    'approve_status' => $submit,
                    'remark' => $remark,
                    'updated_at' => date('Y-m-d H:i:s')
                );

            $update = $this->home_model->update('tbltdsapproval', $ad_data,array('main_id'=>$id,'staff_id'=>get_staff_user_id()));

            //Update master approval
             update_masterapproval_single(get_staff_user_id(),6,$id,$submit);

            //Getting Reject Info
            $approve_status = 0;
            $reject_info = $this->db->query("SELECT * FROM `tbltdsapproval` where main_id='".$id."' and approve_status = 2 ")->row_array();
            if(!empty($reject_info)){
                $approve_status = 2;
                $this->home_model->update('tbltds_amountapproval', array('status'=>3),array('main_id'=>$id));
                $this->home_model->update('tbltds_reconciliation', array('status'=>2),array('id'=>$id));
                $this->db->query("UPDATE tblinvoicepaymentrecords set showInReconciliation = 1 where id IN (".$tds_info->pay_id.") ");
            }else{
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tbltdsapproval` where main_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 2){
                    $approve_status = 1;

                    $this->home_model->update('tbltds_amountapproval', array('status'=>2),array('main_id'=>$id));
                    $this->home_model->update('tbltds_reconciliation', array('status'=>1),array('id'=>$id));

                    $details_info = $this->db->query("SELECT * FROM `tbltds_amountapproval` where main_id='".$id."' ")->result();
                    if(!empty($details_info)){
                        foreach ($details_info as $r) {
                            $amt  = $r->amount;
                            $pay_id = $r->pay_id;

                            $pay_info = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where id='".$pay_id."' ")->row();
                            if(!empty($pay_info)){

                                $finalPaidAmount = ($amt+$pay_info->paid_tds_amt);

                                if($finalPaidAmount >= $pay_info->tds_amt){
                                    $showInReconciliation = 0;
                                }else{
                                    $showInReconciliation = 1;
                                }

                                $this->home_model->update('tblinvoicepaymentrecords', array('showInReconciliation'=>$showInReconciliation,'paid_tds_amt'=>$finalPaidAmount),array('id'=>$pay_id));
                            }
                        }
                    }

                   //$this->db->query("UPDATE tblinvoicepaymentrecords set tds_status = 2 where id IN (".$tds_info->pay_id.") ");
                }
            }



            $approval_info = $this->db->query("SELECT * FROM `tbltdsapproval` where main_id='".$id."' and ( approve_status = 0 || approve_status = 2 ) ")->row_array();
            if(empty($approval_info)){
                $approve_status = 1;
                $this->home_model->update('tbltds_amountapproval', array('status'=>2),array('main_id'=>$id));
                $this->home_model->update('tbltds_reconciliation', array('status'=>1),array('id'=>$id));

                $details_info = $this->db->query("SELECT * FROM `tbltds_amountapproval` where main_id='".$id."' ")->result();
                if(!empty($details_info)){
                    foreach ($details_info as $r) {
                        $amt  = $r->amount;
                        $pay_id = $r->pay_id;

                        $pay_info = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where id='".$pay_id."' ")->row();
                        if(!empty($pay_info)){

                            $finalPaidAmount = ($amt+$pay_info->paid_tds_amt);

                            if($finalPaidAmount >= $pay_info->tds_amt){
                                $showInReconciliation = 0;
                            }else{
                                $showInReconciliation = 1;
                            }

                            $this->home_model->update('tblinvoicepaymentrecords', array('showInReconciliation'=>$showInReconciliation,'paid_tds_amt'=>$finalPaidAmount),array('id'=>$pay_id));
                        }
                    }
                }
            }


            update_masterapproval_all(6,$id,$approve_status);

            if($update){
                 set_alert('success', 'Action Taken succesfully');
                 redirect(admin_url('approval'));
            }
        }

        $data['id'] = $id;

        $data['tds_info'] = $this->db->query("SELECT * from tbltds_reconciliation where id = '".$id."' ")->row();
        $data['item_list'] = $this->db->query("SELECT cp.client_id,a.*,p.debitnote_no,p.paymentmethod,p.invoiceid,p.tds,p.tds_amt FROM tbltds_amountapproval as a LEFT JOIN tblinvoicepaymentrecords as p ON a.pay_id = p.id LEFT JOIN tblclientpayment as cp ON cp.id = p.pay_id  where a.main_id = '".$id."' ")->result();

        $data['appvoal_info'] = $this->db->query("SELECT * from tbltdsapproval where main_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();


        $data['title'] = 'TDS Reconciliation Approval';
        $this->load->view('admin/tds/approval', $data);

    }

    /* this use for tds deduction report */
    public function tds_deduction_report(){
        $where = "status > 0";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }

            if (strlen($type) > 0){
                $data['type'] = $type;

                $where .= " and rel_type = '".$type."' ";
            }
        }else{
            $from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
            $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');
            $where .= " and date BETWEEN '".$from_date_year."' AND '".$to_date_year."' ";
            $data['f_date'] = _d($from_date_year);
            $data['t_date'] = _d($to_date_year);
        }
        $data['tds_report'] = $this->db->query("SELECT * FROM tbltdsdeduction WHERE $where ORDER BY id DESC ")->result();
        $data['tds_section_list'] = $this->db->query("SELECT * FROM tbltdssections WHERE status = 1 ORDER BY id ASC ")->result();
        $data['title'] = 'TDS Deduction Report';
        $this->load->view('admin/tds/tds_deduction_report', $data);
    }

    /* this use for add tds deduction */
    public function add_tds_deduction($id=''){
        if(!empty($_POST)){
            extract($this->input->post());

            $tds_date = (!empty($tds_date)) ? db_date($tds_date) : date('Y-m-d');
            $sdata = array(
                'addedby' => get_staff_user_id(),
                'party_name' => $party_name,
                'taxable_amount' => $taxable_amount,
                'paid_amount' => $paid_amount,
                'booking_date' => db_date($booking_date),
                'tds_amount' => $tds_amount,
                'pan_no' => $pan_no,
                'date' => $tds_date,
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($id != ''){
                unset($sdata['addedby']);
                unset($sdata['created_at']);
                $insert_id = $this->home_model->update('tbltdsdeduction', $sdata, array('id' => $id));
                if ($insert_id){
                    set_alert('success', 'TDS Deduction update succesfully');
                    redirect(admin_url('tds/tds_deduction_report'));
                }
            }else{
                $insert_id = $this->home_model->insert('tbltdsdeduction', $sdata);
                if ($insert_id){
                    set_alert('success', 'TDS Deduction added succesfully');
                    redirect(admin_url('tds/tds_deduction_report'));
                }
            }
        }

        if ($id != ''){
            $data['title'] = 'Edit TDS Deduction';
            $data['tds_deduction_info'] = $this->db->query("SELECT * FROM `tbltdsdeduction` WHERE `id` = ".$id." ")->row();
        }else{
            $data['title'] = 'Add TDS Deduction';
        }
        
        $this->load->view('admin/tds/add_tds_deduction', $data);
    }

    /* this function use for add pan card number */
    public function addPanCardNumber(){
        if(!empty($_POST)){
            extract($this->input->post());

            $response = $this->home_model->update("tbltdsdeduction", array("pan_no" => $pan_no), array("id" => $tds_id));
            if ($response){
                set_alert('success', 'Pan number add succesfully');
                redirect(admin_url('tds/tds_deduction_report'));
            }
        }    
    }
    public function addTdsSection(){
        if(!empty($_POST)){
            extract($this->input->post());

            $response = $this->home_model->update("tbltdsdeduction", array("section_id" => $section_id), array("id" => $tds_id));
            if ($response){
                set_alert('success', 'TDS Section add succesfully');
                redirect(admin_url('tds/tds_deduction_report'));
            }
        }    
    }

    /* this function use for tds challan report */
    public function tds_challan_list(){
        $where = "status > 0";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }
        }else{
            $from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
            $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');
            $where .= " and date BETWEEN '".$from_date_year."' AND '".$to_date_year."' ";
            $data['f_date'] = _d($from_date_year);
            $data['t_date'] = _d($to_date_year);
        }

        $data['tds_challan_list'] = $this->db->query("SELECT * FROM tbltdschallans WHERE $where ORDER BY id DESC ")->result();
        $data['title'] = 'TDS Challan List';
        $this->load->view('admin/tds/tds_challan_list', $data);
    }

    public function add_tds_challan($id = ''){
        if(!empty($_POST)){
            extract($this->input->post());
           
            $late_fees_payment = (!empty($late_fees_payment) && $late_fees_payment == 'on') ? 1 : 0;
            $sdata = array(
                'added_by' => get_staff_user_id(),
                'challan_no' => $challan_no,
                'date' => db_date($challan_date),
                'amount' => $amount,
                'bsr_code' => $bsr_code,
                'section_of_tds' => $section_of_tds,
                'tax_applicable' => $tax_applicable,
                'type_of_payment' => $type_of_payment,
                'Interested_late_fees_payment' => $late_fees_payment,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            if ($id != ''){
                unset($sdata["added_by"]);
                unset($sdata["created_at"]);
                $updateid = $this->home_model->update('tbltdschallans', $sdata, array('id' => $id));
                if ($updateid){
                    set_alert('success', 'TDS Challan update succesfully');
                    redirect(admin_url('tds/tds_challan_list'));
                }
            }else{
                $insert_id = $this->home_model->insert('tbltdschallans', $sdata);
                if ($insert_id){
                    set_alert('success', 'TDS Challan added succesfully');
                    redirect(admin_url('tds/tds_challan_list'));
                }
            }
        }

        if ($id != ''){
            $data["tds_challan_info"] = $this->db->query("SELECT * FROM tbltdschallans WHERE id = '".$id."' ")->row();
            $data['title'] = 'Edit TDS Challan';
        }else{
            $data['title'] = 'Add TDS Challan';
        }
        
        $data['tds_section_list'] = $this->db->query("SELECT * FROM tbltdssections WHERE status = 1 ORDER BY id ASC ")->result();
        $this->load->view('admin/tds/add_tds_challan', $data);
    }

    public function view_tds_challan($id){

        $tds_challan_info = $this->db->query("SELECT * FROM tbltdschallans WHERE id = '".$id."' ")->row();
        $data["tds_deduction_list"] = $this->db->query("SELECT * FROM tbltdsdeduction WHERE tds_challan_id = '".$tds_challan_info->id."' ORDER BY id DESC ")->result();
        $data['tds_challan_info'] = $tds_challan_info;
        $data['title'] = 'View TDS Challan';
        $this->load->view('admin/tds/view_tds_challan', $data);
    }

    public function get_tds_sections(){
        if(!empty($_POST)){
            extract($this->input->post());
            $tds_section_list = $this->db->query("SELECT * FROM tbltdssections WHERE status = 1 ORDER BY id ASC ")->result();
            echo "<option value=''></option>";
            if (!empty($tds_section_list)){
                foreach ($tds_section_list as $value) {
                    $selectedcls = ($sectionid == $value->id) ? 'selected=""' : '';
                    echo "<option value='".$value->id."' ".$selectedcls.">".$value->code.' - '.cc($value->name)."</option>";
                }
            }
        }    
    }
    public function get_tds_challan(){
        if(!empty($_POST)){
            extract($this->input->post());
            $tds_challan_list = $this->db->query("SELECT `tc`.`id`,`tc`.`challan_no`,`tc`.`date`,`tc`.`amount` FROM tbltdschallans as tc LEFT JOIN tbltdsdeduction as td ON tc.section_of_tds = td.section_id WHERE td.id = '".$tds_id."' and tc.Interested_late_fees_payment = 0 ORDER BY tc.id ASC ")->result();
            echo "<option value=''></option>";
            if (!empty($tds_challan_list)){
                foreach ($tds_challan_list as $value) {
                    $selectedcls = ($tdschallan_id == $value->id) ? 'selected=""' : '';
                    echo "<option value='".$value->id."' ".$selectedcls.">".cc($value->challan_no).' ('.$value->amount.') ('._d($value->date).')'."</option>";
                }
            }
        }    
    }

    public function addTdsChallan(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $response = $this->home_model->update("tbltdsdeduction", array("tds_challan_id" => $tds_challan_id), array("id" => $tds_id));
            if ($response){
                set_alert('success', 'TDS challan linked succesfully');
                redirect(admin_url('tds/tds_deduction_report'));
            }
        }    
    }

    public function delete_tds_challan($id){
        $response = $this->home_model->delete("tbltdschallans", array("id" => $id));
        if ($response){
            $this->home_model->update("tbltdsdeduction", array("tds_challan_id" => 0), array("tds_challan_id" => $id));
            set_alert('success', 'TDS challan deleted succesfully');
            redirect(admin_url('tds/tds_challan_list'));
        }
    }
    public function delete_tds_deduction($id){
        $response = $this->home_model->delete("tbltdsdeduction", array("id" => $id));
        if ($response){
            set_alert('success', 'TDS Deduction deleted succesfully');
            redirect(admin_url('tds/tds_deduction_report'));
        }
    }

    public function get_tds_deduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            // $tdschallan_id;
            $section_id = value_by_id("tbltdschallans", $tdschallan_id, "section_of_tds");
            $getDeduction = $this->db->query("SELECT * FROM tbltdsdeduction WHERE section_id = '".$section_id."'")->result();
            echo "<option value=''></option>";
            if (!empty($getDeduction)){
                foreach ($getDeduction as $value) {
                    if ($tds_id == '0'){
                        if ($value->tds_challan_id == '0'){
                            echo "<option value='".$value->id."'>".cc($value->party_name).' - '.$value->taxable_amount.' - '.' ('._d($value->date).')'."</option>";
                        }
                    }else{
                        if ($value->tds_challan_id == $tdschallan_id || $value->tds_challan_id == '0'){
                            $tdsarr = explode(',', $tds_id);
                            $selectedcls = (in_array($value->id, $tdsarr)) ? 'selected=""' : '';
                            echo "<option value='".$value->id."' ".$selectedcls.">".cc($value->party_name).' - '.$value->taxable_amount.' - '.' ('._d($value->date).')'."</option>";
                        }
                    }
                }
            }
        }    
    }

    /* this function use for tds deduction link */
    public function linkChallanDeduction(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $this->home_model->update("tbltdsdeduction", array("tds_challan_id" => 0), array("tds_challan_id" => $tdschallan_id));
            if (!empty($tds_deduction_id)){
                foreach($tds_deduction_id as $deduction_id){
                    $this->home_model->update("tbltdsdeduction", array("tds_challan_id" => $tdschallan_id), array("id" => $deduction_id));
                }
            }
            set_alert('success', 'TDS Deduction linked succesfully');
            redirect(admin_url('tds/tds_challan_list'));
        }    
    }

    /* this function use for update taxable amount in tds deduction */
    public function addTaxableAmount(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $this->home_model->update("tbltdsdeduction", array("taxable_amount" => $taxable_amount), array("id" => $tds_id));
            set_alert('success', 'Taxable Amount added succesfully');
            redirect(admin_url('tds/tds_deduction_report'));
        }   
    }
    /* this function use for update booking Date in tds deduction */
    public function addBookingdate(){
        if(!empty($_POST)){
            extract($this->input->post());
            
            $this->home_model->update("tbltdsdeduction", array("booking_date" => db_date($booking_date)), array("id" => $tds_id));
            set_alert('success', 'Booking Date added succesfully');
            redirect(admin_url('tds/tds_deduction_report'));
        }   
    }

    public function update_tds_deduction_report(){
        $tds_report = $this->db->query("SELECT * FROM tbltdsdeduction WHERE `rel_type` IN (1,3) ORDER BY id DESC ")->result();
        if (!empty($tds_report)){
            foreach ($tds_report as $value) {
                if ($value->rel_type == 1){
                    $chk_payment = $this->db->query("SELECT `po_id` FROM `tblpurchaseorderpayments` WHERE `id` ='".$value->rel_id."' ")->row();
                    if (!empty($chk_payment)){
                        $po_product = $this->db->query("SELECT SUM(ttl_price) as ttl_price FROM `tblpurchaseorderproduct` WHERE `po_id` ='".$chk_payment->po_id."' ")->row();
                        if (!empty($po_product) && !empty($po_product->ttl_price)){
                            $up_data["taxable_amount"] = $po_product->ttl_price;
                            $this->home_model->update("tbltdsdeduction", $up_data, array("id" => $value->id));
                        }
                    }
                }else if ($value->rel_type == 3){
                    $chk_log = $this->db->query("SELECT `month`,`year`,`gross_salary` FROM `tblsalarypaidlog` WHERE `id` ='".$value->rel_id."' ")->row();
                    if (!empty($chk_log)){
                        $booking_date = date('Y-m-d', strtotime("01/".$chk_log->month."/".$chk_log->year));
                        $tds_data["taxable_amount"] = $chk_log->gross_salary;
                        $tds_data["booking_date"] = $booking_date;
                        $this->home_model->update("tbltdsdeduction", $tds_data, array("id" => $value->id));
                    }
                }
            }
        }
        echo "TDS Record update successfully";
    }
}
