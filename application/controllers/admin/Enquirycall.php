<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enquirycall extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("home_model");
    }

    /* List all  */
    public function index()
    {
        check_permission(323,'view');
        $data['title'] = "Enquiry Register (SEPL/SLS02)";

        $where1 = "status = 1 and lead_type = 1";
        $where2 = "status = 1 and lead_type = 2";
        if (!is_admin()) {
            $where1 .= " and staff_id = '".get_staff_user_id()."'";
            $where2 .= " and staff_id = '".get_staff_user_id()."'";
        }
        $data['section'] = 1;
        if(!empty($_POST)){
            extract($this->input->post());
            $data['section'] = $section;
            if ($section == 1){
                if (isset($status) && strlen($status) > 0){
                    $data['status'] = $status;
                    $where1 .= " and is_converted = '".$status."'";
                }
                if (!empty($source)){
                    $data['source'] = $source;
                    $where1 .= " and source_id = '".$source."'";
                }
                if (!empty($added_by)){
                    $data['added_by'] = $added_by;
                    $where1 .= " and staff_id = '".$added_by."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = date("Y-m-d",strtotime(str_replace("/","-",$f_date)));
                    $t_date = date("Y-m-d",strtotime(str_replace("/","-",$t_date)));

                    $where1 .= " and DATE(created_at) between '".$f_date."' and '".$t_date."' ";
                }
            }elseif ($section == 2) {
                if (isset($status) && strlen($status) > 0){
                    $data['status'] = $status;
                    $where2 .= " and is_converted = '".$status."'";
                }
                if (!empty($source)){
                    $data['source'] = $source;
                    $where2 .= " and source_id = '".$source."'";
                }
                if (!empty($added_by)){
                    $data['added_by'] = $added_by;
                    $where2 .= " and staff_id = '".$added_by."'";
                }
                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = date("Y-m-d",strtotime(str_replace("/","-",$f_date)));
                    $t_date = date("Y-m-d",strtotime(str_replace("/","-",$t_date)));

                    $where2 .= " and DATE(created_at) between '".$f_date."' and '".$t_date."' ";
                }
            }
        }else{
            $from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
            $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');

            $where1 .= " and DATE(created_at) between '".$from_date_year."' and '".$to_date_year."' ";
        }
//        $data['source_list'] = $this->db->query("SELECT * from `tblleadssources`")->result();
        //$data["source_list"] = $this->db->query("SELECT `id`,`exotel_number`,`source`,`source_id` FROM `tblvagentnumbers` WHERE `source_id` > 0 and `status` = 1 GROUP BY exotel_number ORDER BY source ASC")->result();
        $data["source_list"] = $this->db->query("SELECT * FROM `tblleadssources` WHERE `status` = 1 ORDER BY name ASC ")->result();
        $data["staff_list"] = get_staff_list();
        $data['verifiedcall_list'] = $this->db->query("SELECT * from `tblenquirycall` WHERE ".$where1." ORDER BY `id` DESC")->result();
        $data['unverifiedcall_list'] = $this->db->query("SELECT * from `tblenquirycall` WHERE ".$where2." ORDER BY `id` DESC")->result();

        $this->load->view('admin/enquirycall/list', $data);
    }

    /* Add enquiry call details */
    public function add($id = '', $call_type= ""){
        check_permission(323,'create');
        $data["source_id"] = 0;
        $data["call_id"] = 0;
        if ($call_type != ""){
            $data["call_type"] = $call_type;
            $data["call_id"] = $id;

            if($call_type == 1){
                $vagent_number = value_by_id('tblcallincoming',$data["call_id"],'vagent_number');
                $numbers_info = $this->db->query("SELECT `source_id` from `tblvagentnumbers` where `source_id` > 0 and `exotel_number` = '".$vagent_number."'  ")->row();
                if(!empty($numbers_info)){
                    $data['source_id'] = $numbers_info->source_id;
                }
            }
        }

        if ($this->input->post()) {
            $this->load->model("Enquirycall_model");

            $unit_data = $this->input->post();
            if ($id != '' && $call_type == "") {
                $update_id = $this->Enquirycall_model->update($id, $unit_data);
                if ($update_id) {
                    set_alert('success', "Call enquiry details update successfully");
                    redirect(admin_url('enquirycall'));
                }

            }else{
                $insert_id = $this->Enquirycall_model->add($unit_data);
                if ($insert_id) {
                    set_alert('success', "Call enquiry details added successfully");
                    $rurl = "enquirycall";
                    if ($call_type != ""){
                        $rurl = ($call_type == 2) ? "calls/outgoingcalls" : "calls";
                    }
                    redirect(admin_url($rurl));
                }
            }
        }
        $data['title'] = "Add Call Enquiry Details";
        if ($id !== '' && $call_type == "") {
            check_permission(323,'edit');
            $data['title'] = "Edit Call Enquiry Details";
            $data["enquirycall_info"] = $this->home_model->get_row("tblenquirycall", array("id" => $id), array("*"));
            if ($data["enquirycall_info"]){
                $state_id = $data["enquirycall_info"]->state_id;
                $data['cities_list'] = $this->home_model->get_result("tblcities", array("state_id" => $state_id,"status" => 1), array("id", "name"));

                /* get product details list */
                $sub_category_id = $data["enquirycall_info"]->sub_category_id;
                $sub_category_id = rtrim($sub_category_id,",");
                $show_temp_product = 0;
                $sub_category_arr = explode(',', $sub_category_id);
                if (in_array('Temp1', $sub_category_arr)){
                    $show_temp_product = 1;
                    $sub_category_arr = array_diff($sub_category_arr, array('Temp1'));
                }
                $sub_category_ids = implode(',', $sub_category_arr);
                $data['product_data'] = array();
                if (!empty($sub_category_arr)){
                    $product_data = $this->db->query("SELECT `id`, `sub_name` FROM `tblproducts` WHERE `product_sub_cat_id` IN (".$sub_category_ids.") AND `status` = 1 AND `is_approved` = 1 ORDER BY `name` ASC")->result();
    //                $product_data = $this->home_model->get_result("tblproducts", array("product_sub_cat_id" => $sub_category_id, "is_approved" => 1,"status" => 1), array("id", "name"));
                    // $temp_product_data = $this->home_model->get_result("tbltemperoryproduct", array("status" => 1), array("id", "product_name"));
                    
                    if(!empty($product_data)){
                        foreach ($product_data as $p) {
                            $data['product_data'][] = array('id'=> $p->id.'-0', 'name'=> "<div class='col-md-9'>".cc($p->sub_name)."</div><div class='col-md-3'>".product_code($p->id)."</div>");
                        }
                    }
                }

                $temp_product_data = $this->db->query("SELECT `id`, `product_name` FROM `tbltemperoryproduct` WHERE status=1 ORDER BY `product_name` ASC")->result();
                if(!empty($temp_product_data) && $show_temp_product == 1){
                    foreach ($temp_product_data as $temp) {
                        $data['product_data'][] = array('id'=> $temp->id.'-1', 'name'=> "<div class='col-md-9'>".$temp->product_name."</div><div class='col-md-3'>".temp_product_code($temp->id)."</div>");
                    }
                }
            }
            $data['sub_category'] = $this->home_model->get_result("tblenquirycall_assignproduction", array("enquirycall_id" => $id), array("staff_id"));
            $data['approveby'] = $this->db->query("SELECT GROUP_CONCAT(staff_id) as assignids FROM `tblenquirycall_assignproduction` WHERE `enquirycall_id` = '".$id."'")->row();
        }

        if ($call_type == "3"){
            $data['applead_info'] = $this->db->query("SELECT * FROM tblappleads WHERE id = '".$id."'")->row();
        }
        if ($call_type == "4"){
            $data['indiamart_info'] = $this->db->query("SELECT * FROM tblindiamartclientrecord WHERE id = '".$id."'")->row();
        }
        $data['sub_category'] = $this->home_model->get_result("tblproductsubcategory", array("status" => 1), array("id", "name"),array("name", "ASC"));
        $data['states_list'] = $this->home_model->get_result("tblstates", array("status" => 1), array("id", "name"),array("name", "ASC"));
        $data['question_list'] = $this->home_model->get_result("tblquestionmaster", array("status" => 1), array("*"), array("question_order", "ASC"));
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='12'")->result_array();
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

        $data['client_branch_data'] = $this->db->query("SELECT `userid`,`client_branch_name`,`email_id`, `city` FROM `tblclientbranch` WHERE `active` = 1 and `client_branch_name` != '' ORDER BY `client_branch_name` ASC")->result();
        $lead_companies = $this->db->query("SELECT `company` FROM `tblleads` where client_branch_id = 0 GROUP by company order by company ASC; ")->result();
        $leadcompanies = array();
        if (!empty($lead_companies)){
            foreach ($lead_companies as $value) {
                $leadcompanies[] = "'".$value->company."'";
            }
        }
        $data['lead_companies'] = implode(",", $leadcompanies);
        //$data["source_list"] = $this->db->query("SELECT `id`,`exotel_number`,`source`,`source_id` FROM `tblvagentnumbers` WHERE `source_id` > 0 and `status` = 1 GROUP BY exotel_number ORDER BY id ASC")->result();
        //$data["source_list"] = $this->db->query("SELECT `id`,`exotel_number`,`source`,`source_id` FROM `tblvagentnumbers` WHERE `source_id` > 0 and `status` = 1 ORDER BY source ASC ")->result();
        $data["source_list"] = $this->db->query("SELECT * FROM `tblleadssources` WHERE `status` = 1 ORDER BY name ASC ")->result();
        $data['unverifed_status_list'] = $this->db->query("SELECT * FROM `tblunverifedleadmaster` ORDER BY title ASC")->result();
        $data['lead_category_list'] = $this->db->query("SELECT * FROM `tblleadcategorymaster` WHERE status = 1 ORDER BY title ASC")->result();
        $this->load->view('admin/enquirycall/add', $data);
    }

    /* this function use for get cities by state id */
    public function getcities($state_id){
        $cities = $this->home_model->get_result("tblcities", array("state_id" => $state_id,"status" => 1), array("id", "name"), array("name", "ASC"));
        echo '<option value=""></option>';
        if ($cities){
            foreach($cities as $city){
                echo '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
        }
    }
    /* this function use for get product list by sub category id */
    public function get_products_list(){

        if(!empty($_POST)){

            extract($this->input->post());
            
            $show_temp_product = 0;
            if (in_array('Temp1', $sub_category_id)){
                $show_temp_product = 1;
                $sub_category_id = array_diff($sub_category_id, array('Temp1'));
            }

            /* THIS CODE FOR GETTING PRODUCTS */
            echo '<option value=""></option>';
            if (!empty($sub_category_id)){
                $sub_cat_id = implode(",", $sub_category_id);
                $product_data = $this->db->query("SELECT `id`, `sub_name` FROM `tblproducts` WHERE `product_sub_cat_id` IN (".$sub_cat_id.") AND `status` = 1 AND `is_approved` = 1 ORDER BY `name` ASC")->result();
                // $temp_product_data = $this->home_model->get_result("tbltemperoryproduct", array("status" => 1), array("id", "product_name"));
                
                if(!empty($product_data)){
                    foreach ($product_data as $p) {
                ?>        
                        <option data-content="<span class='col-md-9'><?php echo cc($p->sub_name); ?></span><span class='col-md-3'><?php echo product_code($p->id); ?></span>" value="<?php echo $p->id.'-0'; ?>"><?php echo cc($p->sub_name).' '.product_code($p->id); ?></option>
                <?php        
                    }
                }
            }

            /* THIS CODE FOR GETTING TEMPERORY PRODUCTS */
            $temp_product_data = $this->db->query("SELECT `id`, `product_name` FROM `tbltemperoryproduct` WHERE status=1 ORDER BY `product_name` ASC")->result();
            if(!empty($temp_product_data) && $show_temp_product == 1){
                foreach ($temp_product_data as $temp) {
            ?>        
                    <option data-content="<span class='col-md-9'><?php echo cc($temp->product_name); ?></span><span class='col-md-3'><?php echo temp_product_code($temp->id); ?></span>" value="<?php echo $temp->id.'-1'; ?>"><?php echo $temp->product_name.temp_product_code($temp->id); ?></option>
            <?php         
                }
            }
        }
    }

    /* this function use of send client form */
    public function cilent_enquiry_form($id){
        $data["title"] = "Client Enquiry From";

        $enquiry_temp = $this->db->query("SELECT `id`, `email_message` FROM tblemailmoduletemplate WHERE `module_id` = 11 AND `status` = 1")->row();
        $enquirycall_info = $this->home_model->get_row("tblenquirycall", array("id" => $id), array("*"));
        if (empty($enquirycall_info)){
            redirect(admin_url('enquirycall'));
        }

        if ($this->input->post()) {
            $this->load->model(array("Enquirycall_model", "emails_model"));

            $unit_data = $this->input->post();
            $insert_id = $this->Enquirycall_model->add_client_fields($id, $unit_data);
            if ($insert_id) {
                $response = $this->emails_model->send_mail($id, "client_enquiry_form", $enquiry_temp->id, $enquirycall_info, $enquirycall_info->email, $enquiry_temp->email_message);
                if ($response == TRUE){
                    set_alert('success', "Enquiry form send to client successfully");
                }
                else{
                    set_alert('danger', "Something went wrong.");
                }
                redirect(admin_url('enquirycall'));
            }
        }


        if ($enquirycall_info){
            $state_id = $enquirycall_info->state_id;
            $data['cities_list'] = $this->home_model->get_result("tblcities", array("state_id" => $state_id,"status" => 1), array("id", "name"), array("name", "ASC"));
        }

        $data["enquirycall_info"] = $enquirycall_info;
        $data["check_mail"] = $enquiry_temp;
        $data['states_list'] = $this->home_model->get_result("tblstates", array("status" => 1), array("id", "name"), array("name", "ASC"));
        $data['question_list'] = $this->home_model->get_result("tblquestionmaster", array("status" => 1), array("*"), array("question_order", "ASC"));
        $this->load->view('admin/enquirycall/cilent_enquiry_form', $data);
    }

    /* this function use for convert to lead */
    public function convert_to_lead($id){
        $data["title"] = "Leads";
        $data["section_type"] = "add";

        $this->load->model('Client_category_model');
        $data['client_category_data'] = $this->Client_category_model->get();

        $data["state_data"] = $this->db->query("SELECT * FROM tblstates WHERE `status` = 1 ORDER BY name ASC")->result_array();
        $data["enquiry_data"] = $this->home_model->get_row("tblenquirycall", array("id" => $id), array("*"));
        if (!empty($data["enquiry_data"])){
            $data["city_data"] = $this->db->query("SELECT * FROM tblcities WHERE `state_id` = ".$data["enquiry_data"]->state_id." AND `status` = 1 ORDER BY name ASC")->result_array();
        }
        $data["all_city_data"] = $this->db->query("SELECT * FROM tblcities WHERE `status` = 1 ORDER BY name ASC")->result_array();

        $this->load->model('Enquirytype_model');
        $data['enquiry_type'] = $this->Enquirytype_model->get();

        $data['client_branch_data'] =$this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `client_branch_name` != '' and `active`=1 ORDER BY client_branch_name ASC ")->result();

        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();

        /* get product details list */
        $data['product_data'] = array();
        $product_data = $this->home_model->get_result("tblproducts", array("is_approved" => 1,"status" => 1), array("id", "sub_name"), array("name", "ASC"));
        $temp_product_data = $this->home_model->get_result("tbltemperoryproduct", array("status" => 1), array("id", "product_name"), array("product_name", "ASC"));
        if(!empty($product_data)){
            foreach ($product_data as $p) {
                $data['product_data'][] = array('id'=> $p->id, 'name'=> cc($p->sub_name), 'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $temp) {
                $data['product_data'][] = array('id'=> $temp->id, 'name'=> cc($temp->product_name), 'is_temp'=>1);
            }
        }
        /*echo '<pre/>';
        echo print_r($data['product_data']);
        die;*/

        $this->load->model('Enquiryfor_model');
        $data['enquiry_for'] = $this->Enquiryfor_model->get();

        $this->load->model('Leads_model');
        $data['all_source'] = $this->Leads_model->get_source();
        $data['group_info'] = $this->db->query("SELECT * FROM `tblleadstaffgroup` where status = 1 ")->result_array();

        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();

        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();

        $data['lead_category_list'] = $this->db->query("SELECT * FROM `tblmainenquirytypemaster` WHERE status = 1 ORDER BY name ASC")->result_array();
        $this->load->view('admin/enquiry/lead', $data);
    }

    /* this function use for view enquiry call */
    public function view($id){
        $data["title"] = "View Call Enquiry Details";

        $enquirycall_info = $this->home_model->get_row("tblenquirycall", array("id" => $id), array("*"));
        if (empty($enquirycall_info)){
            redirect(admin_url('enquirycall'));
        }
        $data["enquirycall_info"] = $enquirycall_info;
        $this->load->view('admin/enquirycall/view', $data);
    }

    public function enquirycall_actionassign($id){
        $data['title'] = "Enquiry call assign production";
        $data["enquirycall_info"] = $this->home_model->get_row("tblenquirycall", array("id" => $id), array("*"));
        if ($this->input->post()){
            $data = $this->input->post();

            $ad_data = array(
                'approvereason' => $data["remark"],
                'approve_status' => $data["submit"],
                'created_at' => date('Y-m-d H:i:s')
            );

            $response = $this->home_model->update('tblenquirycall_assignproduction', $ad_data,array('enquirycall_id'=>$id,'staff_id'=>get_staff_user_id()));

            if ($response){

                update_masterapproval_single(get_staff_user_id(),23,$id,$data["submit"]);
                update_masterapproval_all(23,$id,$data["submit"]);
                handle_enquirycall_drawing_upload($id);

                $product_json = "";
                if (isset($data["proenqdata"])){
                    $product_data = [];
                    foreach ($data["proenqdata"] as $pro) {
                        $pdata = explode("-", $pro["product_id"]);
                        $product_data[] = array("product_id" => $pdata[0], "is_temp" => $pdata[1], "qty" => $pro["qty"]);
                    }
                    $product_json = json_encode($product_data);
                }

                $this->home_model->update('tblenquirycall', array('is_converted'=>0, "product_json"=>$product_json), array("id"=>$id));
                if ($data["submit"] == 1){
                    set_alert('success', "Enquirycall approvad successfully");
                }else{
                    set_alert('danger', "Enquirycall rejected successfully");
                }
                redirect(admin_url('enquirycall/action_assign_list'));
            }
        }
        /* get product details list */
        $sub_category_id = $data["enquirycall_info"]->sub_category_id;
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT `id`, `name`  FROM `tblproducts` WHERE `product_sub_cat_id` IN (".$sub_category_id.") AND `status` = 1 AND `is_approved` = 1 ORDER BY `name` ASC")->result();
        $temp_product_data = $this->home_model->get_result("tbltemperoryproduct", array("status" => 1), array("id", "product_name"), array("product_name", "ASC"));
        if(!empty($product_data)){
            foreach ($product_data as $p) {
                $data['product_data'][] = array('id'=> $p->id.'-0', 'name'=> $p->name.product_code($p->id));
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $temp) {
                $data['product_data'][] = array('id'=> $temp->id.'-1', 'name'=> $temp->product_name.temp_product_code($temp->id));
            }
        }
        $data["info"] = $this->db->query("SELECT * FROM tblenquirycall_assignproduction WHERE `enquirycall_id` = '".$id."' AND `staff_id` = '".get_staff_user_id()."'")->row();
        $data["check_approval"] = $this->db->query("SELECT COUNT(id) as count FROM tblenquirycall_assignproduction WHERE `enquirycall_id` = '".$id."' AND `approve_status` = 1")->row();
        $this->load->view('admin/enquirycall/enquirycall_production_approval', $data);
    }

    public function action_assign_list(){
        $data['title'] = "Enquiry Call Action Assign List";
        check_permission(345,'view');
        $where = "status = 1";
        $search = 1;
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
                $search = 0;

                $f_date = date("Y-m-d",strtotime(str_replace("/","-",$f_date)));
                $t_date = date("Y-m-d",strtotime(str_replace("/","-",$t_date)));

                $where .= " and DATE(created_at) between '".$f_date."' and '".$t_date."' ";
            }
        }

        $getenquirycall_list = $this->db->query("SELECT GROUP_CONCAT(enquirycall_id) as enquiryids FROM `tblenquirycall_assignproduction` WHERE `staff_id` = '".get_staff_user_id()."' ")->row();
        if (!empty($getenquirycall_list) && !empty($getenquirycall_list->enquiryids)){
            $where .= " and id IN (".$getenquirycall_list->enquiryids.")";
            if ($search == 1){
                $where .= " and is_converted = 2";
            }
            $data['enquirycall_list'] = $this->db->query("SELECT * from `tblenquirycall` WHERE ".$where." ORDER BY `id` DESC")->result();
        }

        $this->load->view('admin/enquirycall/action_assign_list', $data);
    }

    public function  enquirycall_contacts($id = ""){

        $data["title"] = "Enquiry Call Details";
        $enquiry_data = $this->db->query("SELECT * from `tblenquirycall` WHERE id = '".$id."'")->row();

        $data["enquirycall_info"] = array();
        if (!empty($enquiry_data)){
            if ($enquiry_data->call_type == 1){
                $call_info = $this->db->query("SELECT `customer_number` from `tblcallincoming` WHERE id = '".$enquiry_data->call_id."'")->row();
            }else{
                $call_info = $this->db->query("SELECT `customer_number` from `tblcalloutgoing` WHERE id = '".$enquiry_data->call_id."'")->row();
            }
            if ($call_info){
                $customer_number = $call_info->customer_number;

                $enquirycall_details = array();
                $incomming_data = $this->db->query("SELECT * from `tblcallincoming` WHERE customer_number = '".$customer_number."' order by created_at DESC")->result();
                if ($incomming_data){
                    foreach ($incomming_data as $value) {
                        $enquirycall_details[] = array(
                            "recording_url" => $value->recording_url,
                            "created_at" => $value->created_at,
                            "type" => "Incomming",
                        );
                    }
                }
                $outcomming_data = $this->db->query("SELECT * from `tblcalloutgoing` WHERE customer_number = '".$customer_number."' order by created_at DESC")->result();
                if ($outcomming_data){
                    foreach ($outcomming_data as $value) {
                        $enquirycall_details[] = array(
                            "recording_url" => $value->recording_url,
                            "created_at" => $value->created_at,
                             "type" => "Outgoing",
                        );
                    }
                }
                $data["enquirycall_info"] = array("customer_number" => $customer_number, "enquirycall_details" => $enquirycall_details);
            }
        }
        $keys_info  = $this->db->query("SELECT `staffid`,`callingnumber` FROM tblstaff WHERE staffid = '".get_staff_user_id()."' ")->row();
        if(!empty($keys_info) && !empty($keys_info->callingnumber)){
            $data['calling_numbes'] = $this->db->query("SELECT * from tblvagentnumbers  where status = 1 and id IN (".$keys_info->callingnumber.") group by exotel_number order by id asc")->result();
        }
        $this->load->view('admin/enquirycall/enquirycall_contact', $data);
    }

    /* this is for enquiry call activity */
    public function enquirycall_activity($enquirycall_id, $from_user_id = ""){
        $data['title'] = 'Enquirycall Activities';

        if(!empty($_POST)){
            extract($this->input->post());

            /* this is for check notification uodate */
            // $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$enquirycall_id."' and staff_id = '".get_staff_user_id()."' and module_id = 18")->result();
            // if (!empty($chk_notification)){
            //     foreach ($chk_notification as $value) {
            //         $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
            //     }
            // }

            /* this code use for check tagging information */
            send_activity_replied(18, $enquirycall_id, $from_user_id, get_staff_user_id());

            if(!empty($important_search)){
                 $data['activity_log'] = $this->db->query("SELECT * FROM `tblenquirycall_activity` where enquirycall_id = '".$enquirycall_id."' and priority = '1' and parent_id = '0' order by id asc")->result();
            }else{

                $message = (!empty($suggestion)) ? $suggestion : $description;
                $parent_id = (!empty($parent_id)) ? $parent_id : 0;
                if ($parent_id > 0){
                    $message = $activity_reply[$parent_id];
                }

                if(empty($message)){
                    set_alert('danger', 'Activity cannot be empty!');
                    redirect($_SERVER['HTTP_REFERER']);
                    die;
                }

                 $ad_data = array(
                            'enquirycall_id' => $enquirycall_id,
                            'parent_id' => $parent_id,
                            'message' => $message,
                            'staffid' => get_staff_user_id(),
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

                $insert_id = $this->home_model->insert('tblenquirycall_activity',$ad_data);

                if (!empty($tag_staff_ids)){
                   $staff_ids = explode(",", $tag_staff_ids);
                   foreach ($staff_ids as $staff_id) {

                        $tag_notification_arr = array(
                            'activity_id' => $insert_id,
                            'module_id' => 18,
                            'table_id' => $enquirycall_id,
                            'fromuserid' => get_staff_user_id(),
                            'touserid' => $staff_id,
                            'description' => 'You taged in enquirycall activity',
                            'link'  => "enquirycall/enquirycall_activity/".$enquirycall_id
                        );
                        send_activitytag_notification($tag_notification_arr);

                   }
                }

                set_alert('success', 'Activity Added successfully');
                redirect(admin_url('enquirycall/enquirycall_activity/' . $enquirycall_id));
            }


        }else{
            $data['activity_log'] = $this->db->query("SELECT * FROM `tblenquirycall_activity` where enquirycall_id = '".$enquirycall_id."' and parent_id = '0' order by id desc LIMIT 10")->result();
        }
        $data['enquirycall_id'] = $enquirycall_id;
        $data['suggestion_info'] = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result();
        krsort($data['activity_log']);
        $this->load->view('admin/enquirycall/enquirycall_activity', $data);
    }

    public function cut_enquirycall_conversation($id) {

        $success = $this->home_model->update('tblenquirycall_activity',array('status' => 2),array('id'=>$id));
        if ($success) {
            set_alert('success', 'Enquirycall Conversation Removed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_enquirycall_conversation($id) {

        $success = $this->home_model->delete('tblenquirycall_activity ',array('id'=>$id));
        if ($success) {
            set_alert('success', _l('deleted', 'conversation'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function udpate_enquirycall_priority() {
        if (!empty($_POST)) {
            extract($this->input->post());

            $pri = ($priority == 1) ? 0 : 1;
            $this->home_model->update('tblenquirycall_activity', array('priority' => $pri), array('id' => $id));
        }
    }
    public function linked_call() {
        if (!empty($_POST)) {
            extract($this->input->post());

            $success = $this->home_model->update('tblenquirycall', array('call_id' => $call_id), array('id' => $enquirycallid));
            if ($success) {
                set_alert('success', "Linked call successfully");
                redirect(admin_url('enquirycall'));
            }
        }
    }

    public function get_last_enquirycall_conversion(){
        if (!empty($_POST)) {
               extract($this->input->post());

               $activity_log = $this->db->query("SELECT * FROM `tblenquirycall_activity` where id < '" . $id . "' and enquirycall_id = '" . $enquirycall_id . "' and `parent_id` = '0' order by id desc LIMIT 10")->result();

               krsort($activity_log);

               $html = '';
               if (!empty($activity_log)) {
                   $i = 0;
                   foreach ($activity_log as $key => $log) {

                        if ($i == 0) {
                            $last_id = $log->id;
                        }

                        $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblenquirycall_activity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                        $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';

                        $cut = ($log->status == 2) ? 'line-throught' : '';
                        $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                            $html .= '<div class="feed-item">
                                        <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                        <div class="text ' . $cut . '">
                                            <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                            if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                                $html .= ' <a href="' . admin_url('enquirycall/cut_enquirycall_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                            }
                                            if (is_admin() == 1 && $ttl_reply == 0) {
                                                $html .= ' <a href="' . admin_url('enquirycall/delete_enquirycall_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                                            }

                                            if ($log->staffid != 0) {
                                                $html .= '<a href="' . admin_url('profile/' . $log->staffid) . '">' . staff_profile_image($log->staffid, array('staff-profile-xs-image pull-left mright5')) . '</a>';
                                                $html .= get_employee_name($log->staffid) . ' - ' . _l($log->message, '', false);
                                                $html .=' <a href="#" class="reply_comment" val="'.$log->id.'" title="Reply on activity"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>';
                                                if ($ttl_reply > 0){
                                                    $html .=' |<a href="javascript:void(0);" class="view_reply" val="'.$log->id.'" data-type="1" data-last_id="0" > '.$ttl_reply.' Replies</a>';
                                                }
                                            }
                            $html .='</div></div>
                                        <div class="col-md-12 reply-div reply-box'.$log->id.'" style="display: none;"><div class="form-group mtop15" app-field-wrapper="description"><input type="text" name="activity_reply['.$log->id.']" val="'.$log->id.'" id="description'.$log->id.'" class="form-control description_box"></div>
                                           <div class="text-right">
                                                <a href="javascript:void(0);" id="tag_employee_btn" value="'.$log->id.'" class="btn btn-success tag_employee_btn">@ Tag Someone</a>
                                                <button class="btn btn-info">Reply</button>
                                                <a href="javascript:void(0);" onclick="close_reply_activity();" class="btn btn-danger">Close</a>
                                           </div><br>
                                        </div><div class="reply-view'.$log->id.'"></div>';        
                       $html .= '</div>';  
                       $i++;
                   }
               }

               if (!empty($html) && !empty($last_id)) {
                   $json_arr = array("html" => $html, "last_id" => $last_id);

                   echo json_encode($json_arr);
               }
           }
    }

    public function getclientdata($clientid){

        $client_data = client_info($clientid);
        $json_arr = array("client_person_name" => $client_data->client_person_name, "email_id" => $client_data->email_id, "phone_no_1" => $client_data->phone_no_1,"address"=>$client_data->address,"state_id"=>$client_data->state,"city_id"=>$client_data->city);
        echo json_encode($json_arr);
    }

}
