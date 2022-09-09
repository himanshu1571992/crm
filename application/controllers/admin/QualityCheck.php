<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class QualityCheck extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
    }

    /* List all inspection product report */
    public function inspectionProduct() {

        $data['warehouse_id'] = 1;
        $whare = "`warehouse_id` = '1'";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($warehouse_id)){
                $data['warehouse_id'] = $warehouse_id;
                $whare = "`warehouse_id` = '".$warehouse_id."'";
            }
            if (strlen($status) > 0){
                $data['status'] = $status;
                $whare .= " AND `status` = '".$status."'";
            }
            if (strlen($approve_status) > 0){
                $data['approve_status'] = $approve_status;
                $whare .= " AND `approve_status` = '".$approve_status."'";
            }
        }     
        $data["inwardinglist"] = $this->db->query("SELECT * FROM `tblproductinspection` WHERE $whare AND `type`='1' ORDER BY id DESC")->result();
        $data["outwardinglist"] = $this->db->query("SELECT * FROM `tblproductinspection` WHERE $whare AND `type`='2' ORDER BY id DESC")->result();
        $data["title"] = "QUALITY INSPECTION REQUEST LIST";
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse`  WHERE status = 1")->result();
        $this->load->view('admin/quality_check/inspectionReport', $data);
    }

    /* this function use for quality inspection */
    public function qualityinspection($request_id){

        if(!empty($_POST)){
            extract($this->input->post());

            // echo "<pre>";
            // print_r($_POST);
            // exit;
            $assignstaff = $assignid;
            $updata["total_accepted_qty"] = $total_accepted_qty;
            $updata["total_rejected_qty"] = $total_rejected_qty;
            $updata["remark"] = $remark;
            $updata["inspection_date"] = db_date($inspection_date);
            $updata["inspection_by"] = get_staff_user_id();
            $updata["status"] = '1';
            $updata["approve_status"] = '0';
            $response = $this->home_model->update('tblproductinspection', $updata, array('id' => $inspection_id));
            if ($response){

                if (!empty($_FILES['quality_report']['name'][0])){
                            
                    /* this is for upload file on server against */
                    $files_info = $this->db->query("SELECT * FROM tblfiles WHERE `rel_type`='quality_report' AND `rel_id`=".$inspection_id." ")->result();
                    if (!empty($files_info)){
                        foreach ($files_info as $value) {
                            $path = get_upload_path_by_type('quality_report') . $inspection_id . '/'.$value->file_name;
                            unlink($path);
                            $this->home_model->delete('tblfiles',array("id" => $value->id));
                        }
                    }
                    handle_quality_attachments($inspection_id,'quality_report');
                }

                if (!empty($_FILES['test_certificate']['name'][0])){

                    /* this is for upload file on server against */
                    $certificatefiles_info = $this->db->query("SELECT * FROM tblfiles WHERE `rel_type`='test_certificate' AND `rel_id`=".$inspection_id." ")->result();
                    if (!empty($certificatefiles_info)){
                        foreach ($certificatefiles_info as $value) {
                            $path = get_upload_path_by_type('test_certificate') . $inspection_id . '/'.$value->file_name;
                            unlink($path);
                            $this->home_model->delete('tblfiles',array("id" => $value->id));
                        }
                    }
                    handle_quality_attachments($inspection_id,'test_certificate');
                }

                if (!empty($inspectiondata)){
                    $this->home_model->delete('tblproductinspection_details', array("insp_id" => $inspection_id));

                    foreach ($inspectiondata as $value) {
                        $insertdata["insp_id"] = $inspection_id;
                        $insertdata["insp_mst_id"] = $value['inspection_mst_id'];
                        $insertdata["parameter"] = $value['parameter'];
                        $insertdata["specification"] = $value['specification'];
                        $insertdata["tolerance_min"] = $value['tolerance_min'];
                        $insertdata["tolerance_max"] = $value['tolerance_max'];
                        $insertdata["measuring_instrument"] = $value['measuring_instrument'];
                        $insertdata["observed_reading_1"] = $value['observed_reading_1'];
                        $insertdata["observed_reading_2"] = $value['observed_reading_2'];
                        $insertdata["observed_reading_3"] = $value['observed_reading_3'];
                        $insertdata["observed_reading_4"] = $value['observed_reading_4'];
                        $insertdata["observed_reading_5"] = $value['observed_reading_5'];
                        $insertdata["remark"] = $value['remark'];
                        $this->home_model->insert('tblproductinspection_details',$insertdata);
                    }
                }
                /* THIS CODE FOR ASSIGN STAFF FOR TAKE APPROVAL */
                $staff_id = array();
                if(!empty($assignstaff)){
                    foreach ($assignstaff as $single_staff) {
                    if (strpos($single_staff, 'staff') !== false) {
                            $staff_id[] = str_replace("staff", "", $single_staff);
                        }
                    }
                    $staff_id = array_unique($staff_id);
                }

                if(!empty($staff_id)){

                    $this->db->delete('tblproductinspectionapproval',array('insp_id'=>$inspection_id));
                    $this->db->delete('tblmasterapproval',array('table_id'=>$inspection_id,'module_id'=>56));
                    foreach ($staff_id as $staffid) {
                        $sdata['staff_id'] = $staffid;
                        $sdata['insp_id'] = $inspection_id;
                        $sdata['approve_status'] = '0';
                        $sdata['created_at'] = date("Y-m-d H:i:s");
                        $sdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproductinspectionapproval', $sdata);
    
                        //adding on master log
                        $adata = array(
                            'staff_id' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'module_id' => 56,
                            'description' => 'Product Quality Inspection Send to you for Approval',
                            'table_id' => $inspection_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'link' => 'qualityCheck/quality_check_approval/' . $inspection_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);
    
                        //Sending Mobile Intimation
                        $token = get_staff_token($staffid);
                        $message = 'Inspection Quality Check Send to you for Approval';
                        $title = 'Schach';
                        sendFCM($message, $title, $token, $page = 2);
                    }
                }
                set_alert('success', 'Inspection Quality Check Successfully');
                redirect(admin_url('qualityCheck/inspectionProduct'));
            }
        }     
        $data["request_info"] = $this->db->query("SELECT * FROM `tblproductinspection` WHERE `id`='".$request_id."' ")->row();
        if ($data["request_info"]->type == '1'){
            $data["title"] = "IN-WARDING INSPECTION REPORT";
        }else{
            $data["title"] = "FINAL INSPECTION REPORT";
        }
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $this->load->view('admin/quality_check/quality_inspection', $data);
    }

    /* this is for download pdf */
    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('QualityCheck/inspectionProduct'));
        }

        $inspection_data = $this->db->query("SELECT * FROM `tblproductinspection` where id =  '".$id."' ")->row();

        $file_name = "INSP-".str_pad($id, 4, '0', STR_PAD_LEFT);

        $html = quality_inspection_pdf($inspection_data);
        // echo $html;
        // exit;
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

    /* this is function use for delete inspection */
    public function delete_inspection($id){
        $response = $this->home_model->delete('tblproductinspection', array('id'=>$id));
        if ($response == true) {
            $this->home_model->delete('tblproductinspection_details', array('insp_id'=>$id));
            $this->db->delete('tblproductinspectionapproval',array('insp_id'=>$id));
            $this->db->delete('tblmasterapproval',array('table_id'=>$id,'module_id'=>56));

            set_alert('success', 'Quality Inspection Deleted Successfully');
        } else {
            set_alert('warning', 'problem_deleting');
        }
        redirect(admin_url('QualityCheck/inspectionProduct'));
    }

    /* this function use for quality check approval */
    public function quality_check_approval($request_id){

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
                'approve_status' => $action,
                'remark' => $approval_remark,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = $this->home_model->update('tblproductinspectionapproval', $ad_data,array('insp_id'=>$request_id,'staff_id'=>get_staff_user_id()));
            if ($update){
                update_masterapproval_single(get_staff_user_id(),56,$request_id,$action);
                update_masterapproval_all(56,$request_id,$action);
                $this->home_model->update('tblproductinspection', array("approve_status" => $action),array('id'=>$request_id));

                set_alert('success', 'Product Quality Inspection updated succesfully');
                redirect(admin_url('approval/notifications'));
            }
        }
            
        $data["title"] = "Product Quality Inspection Approval";
        $data["request_info"] = $this->db->query("SELECT * FROM `tblproductinspection` WHERE `id`='".$request_id."' ")->row();
        if (!empty($data["request_info"]) && $data["request_info"]->approve_status == '1'){
            set_alert('danger', 'Action already taken');
            redirect(admin_url('approval/notifications'));
        }
        $this->load->view('admin/quality_check/quality_inspection_approval', $data);
    }

    public function get_approval_info() {

    	if(!empty($_POST)){
       		extract($this->input->post());

            $inspection_status = value_by_id("tblproductinspection", $id, "status");
       		$assign_info = $this->db->query("SELECT * FROM `tblproductinspectionapproval` WHERE `insp_id` = '".$id."'  ")->result();
       		?>
       		<div class="row">
                <?php if ($inspection_status == '1'){ ?>
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
                                            }elseif($value->approve_status == 4){
                                                $status = 'Reconciliation';
                                                $color = 'brown';
                                            }elseif($value->approve_status == 5){
                                                $status = 'On Hold';
                                                $color = '#e8bb0b;';
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
                <?php }else{ ?>
                    <div class="col-md-12">
                        <h3 class="no-mtop mrg3 text-center text-danger">Inspection is Pending</h3>
                    </div>
                <?php } ?>
            </div>
       		<?php
       	}
    }
}
