<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Complains extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('complains_model');
    }

    public function index($id = '')
    {   
        check_permission(340,'view');
        $where = " id > 0";
        if(is_admin() != 1){
            $where = " staff_id ='".get_staff_user_id()."'";
        }

        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $where .= " and complain_date  BETWEEN  '".  db_date($f_date)."' and  '".db_date($t_date)."' ";
            }
            if (isset($approve_status)){
                $data['approve_status'] = $approve_status;

                $where .= " and approve_status = ". $approve_status."";
            }
        }

        $data['complains_list'] = $this->db->query("SELECT * from tblcomplains where  ".$where." order by id desc ")->result();


        $data['title'] = 'Product Complains List (SEPL/SLS/07)';
        $this->load->view('admin/complains/list', $data);
    }

    public function add($id = "") {

        if ($this->input->post()) {
            $data = $this->input->post();
            if ($id == ""){
                $insertid = $this->complains_model->add($data);
                if ($insertid) {
                    set_alert('success', "Complains add successfully");
                    redirect(admin_url('complains'));
                }
            }else{
                $response = $this->complains_model->update($data, $id);
                if ($response) {
                    set_alert('success', "Complains updated successfully");
                    redirect(admin_url('complains'));
                }
            }
        }

        if ($id == ""){
            check_permission(340,'create');
            $data['title'] = 'Add Complains';
        }else{
            check_permission(340,'edit');
            $data['title'] = 'Edit Complains';
            $data['complain_info'] = $this->db->query("SELECT * FROM `tblcomplains` where id = '".$id."'")->row();
            $data['complain_products'] = $this->db->query("SELECT * FROM `tblcomplainsproducts` where complains_id = '".$id."'")->result();
            $data['complain_approval_list'] = $this->db->query("SELECT GROUP_CONCAT(staff_id) as assingid FROM `tblcomplains_approval` where complains_id = '".$id."'")->row();
            if (!empty($data['complain_approval_list'])){
                $data["staffassigndata"] = explode(",", $data['complain_approval_list']->assingid);
            }
        }
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;
        $data['client_data'] = $this->db->query("SELECT * FROM `tblclients` where active = 1 order by company asc")->result();
        $data['complain_type_data'] = $this->db->query("SELECT * FROM `tblcomplainstypes` where status = 1 ORDER BY title ASC")->result();

        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 ORDER BY product_name ASC ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=> cc($r['sub_name']),'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }
        $this->load->view('admin/complains/add', $data);
    }

    /* this function use for delete complains */
    public function delete($id){
        check_permission(340,'delete');
        $response = $this->home_model->delete('tblcomplains', array('id'=>$id));
        if ($response == true) {

            $this->home_model->delete('tblcomplainsproducts', array('complains_id'=>$id));
            $this->home_model->delete('tblcomplains_approval', array('complains_id'=>$id));
            $this->home_model->delete('tblmasterapproval', array('module_id'=>21, 'table_id'=>$id));
            set_alert('success', "Complain Deleted Successfully.");
        } else {
            set_alert('warning', _l('problem_deleting', 'complains'));
        }
        redirect(admin_url('complains'));
    }

    /* this function use for get approval status */
    public function get_status() {

        if(!empty($_POST)){
            extract($this->input->post());

            $assign_info = $this->db->query("SELECT * from tblcomplains_approval  where complains_id = '".$id."' ")->result();
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
                                        <td>Status</td>
                                        <td>Remark</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($assign_info)) {
                                        $i = 1;
                                        foreach ($assign_info as $key => $value) {

                                            if ($value->approve_status == 0) {
                                                $status = 'Pending';
                                                $color = 'Darkorange';
                                            } elseif ($value->approve_status == 1) {
                                                $status = 'Approved';
                                                $color = 'green';
                                            } elseif ($value->approve_status == 2) {
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
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                <td><?php echo $value->approve_remark; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
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

    /* this function use for get actionplan status */
    public function get_actionplan() {

        if(!empty($_POST)){
            extract($this->input->post());

            $actionplan_list = $this->db->query("SELECT * from tblfiles  where `rel_type` = 'complaints' and `rel_id` = '".$complain_id."' ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Action Plan List</h4>
                    <?php
                        $complain_info = $this->db->query("SELECT `action_planner_id` from tblcomplains  where `id` = '".$complain_id."' ")->row();
                        if(!empty($complain_info)){
                            echo "<p>Action Planner Name : <span class='text-danger'>".get_employee_name($complain_info->action_planner_id)."</span></p>";
                            echo "<p>Complain Number : <span class='text-danger'>Comp-".$complain_id."</span></p>";
                            echo '<input type="hidden" name="action_planner_id" class="action_planner_id" value="'.$complain_info->action_planner_id.'">';
                        }
                    ?>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($actionplan_list)) {
                                        $i = 1;
                                        foreach ($actionplan_list as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><a download="" href="<?php echo base_url('uploads/complaints/'.$complain_id.'/'.$value->file_name);?>"><?php echo $value->file_name; ?></a></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td class="text-center" colspan="2"><h5>Record Not Found!</h5></td></tr>';
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

    /* this is for view complain */
    public function view($id) {
        check_permission(340,'view');
        $data["title"] = "View Complain details";
        $data["page"] = "view";
        $data['complain_info'] = $this->db->query("SELECT * FROM `tblcomplains` where id = '".$id."'")->row();
        $data['complain_products'] = $this->db->query("SELECT * FROM `tblcomplainsproducts` where complains_id = '".$id."'")->result();

        $this->load->view('admin/complains/view_details', $data);
    }

    /* this is for complain approval */
    public function complains_approval($id) {

        if(!empty($_POST)){
            $post_data = $this->input->post();
            $response = $this->complains_model->complains_approval($post_data, $id);
            if ($response){
                set_alert('success', "Complains approved successfully");
                redirect(admin_url('approval/notifications'));
            }
        }
        $data["title"] = "Complain details";
        $data["page"] = "approval";
        $data['complain_info'] = $this->db->query("SELECT * FROM `tblcomplains` where id = '".$id."'")->row();
        $data['complain_products'] = $this->db->query("SELECT * FROM `tblcomplainsproducts` where complains_id = '".$id."'")->result();
        $data['approval_info'] = $this->db->query("SELECT * FROM `tblcomplains_approval` where complains_id = '".$id."' and approve_status !=0")->row();

        $this->load->view('admin/complains/view_details', $data);
    }

    public function manage_complains()
    {
        check_permission(341,'view');
        $where = " approve_status = 1";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $where .= " and complain_date  BETWEEN  '".  db_date($f_date)."' and  '".db_date($t_date)."' ";
            }
            if (isset($status)){
                $data['status'] = $status;

                $where .= " and status = ". $status."";
            }
            if (!empty($complain_type)){
                $data['complain_type'] = $complain_type;

                $where .= " and complain_type_id = ". $complain_type."";
            }
        }

        $data['complains_list'] = $this->db->query("SELECT * from tblcomplains where  ".$where." order by id desc ")->result();
        $data['complain_type_data'] = $this->db->query("SELECT * FROM `tblcomplainstypes` where status = 1")->result();

        $data['title'] = 'Customers Complain List (SEPL/SLS/07)';
        $this->load->view('admin/complains/manage_complain_list', $data);
    }

    public function add_assign_planner()
    {
        if(!empty($_POST)){
            $post_data = $this->input->post();
            $response = $this->complains_model->assign_planner($post_data);
            if ($response){
                set_alert('success', "Assign plan successfully");
                redirect(admin_url('complains/manage_complains'));
            }
        }
    }

    public function upload_action_plan($id)
    {
        $data["title"] = "Upload Action Plan";
        $data["page"] = "upload_action_plan";
        $data['complain_info'] = $this->db->query("SELECT * FROM `tblcomplains` where id = '".$id."'")->row();
        $data['complain_products'] = $this->db->query("SELECT * FROM `tblcomplainsproducts` where complains_id = '".$id."'")->result();

        if(!empty($_FILES)){
            $update = $this->home_model->update('tblcomplains', array('action_plan_status'=> 1),array('id'=> $id));
            if(!empty($update)){
                $actionplan_list = $this->db->query("SELECT * from tblfiles  where `rel_type` = 'complaints' and `rel_id` = '".$id."' ")->result();
                if ($actionplan_list){
                    foreach ($actionplan_list as $value) {
                        $this->home_model->delete('tblfiles', array("id" => $value->id));
                        $path = get_upload_path_by_type("complaints").$value->id."/".$value->file_name;
                        unlink($path);
                    }
                }
                /* upload files of action plan */
                complain_actionplan_attachments($id);

                update_masterapproval_single(get_staff_user_id(),22,$id,1);
                update_masterapproval_all(22,$id,1);

                set_alert('success', "Upload action plan successfully");
                redirect(admin_url('approval/notifications'));
            }
        }
        $this->load->view('admin/complains/view_details', $data);
    }

    public function actionplan()
    {
        if(!empty($_POST)){
            $post_data = $this->input->post();
            $response = $this->complains_model->actionplan($post_data);
            if ($response){
                if ($post_data["action"] == 1){
                    set_alert('success', "Assign plan successfully");
                }else{
                    set_alert('success', "Action plan Close successfully");
                }

                redirect(admin_url('complains/manage_complains'));
            }
        }
    }

}
