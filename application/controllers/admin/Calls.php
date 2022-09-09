<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Calls extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
        //check_permission('8,115','view');
        //$where = " la.staff_id = '".get_staff_user_id()."' ";
        $where = " id > '0' ";
        $wherei = " source_type = 'B' ";
        if(!empty($_POST)){
            extract($this->input->post());
            if (!empty($section)){
                $data["section"] = $section;
            }

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $where .= " and created_at  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
                $wherei .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
                //$where .= " and l.created_at  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            if(!empty($status)){
                $data['s_status'] = $status;
                $status = ($status == 99) ? 0 : $status;
                $where .= " and status = '".$status."'";
                $wherei .= " and status = '".$status."'";
                //$where .= " and l.status = '".$status."'";
            }

        }else{
            //$where .= " and l.status = 0 and YEAR(l.created_at) = '".date('Y')."' and MONTH(l.created_at) = '".date('m')."'";
            $where .= " and status = 0 and DATE(created_at) = '".date('Y-m-d')."'";
            $wherei .= " and status = 0 and `date` > '2022-01-01'";
        }
        $data['task_list'] = $this->db->query("SELECT * from tblappleads where ".$where."  ORDER by id desc")->result();
        $data['indiamartlead_list'] = $this->db->query("SELECT * from tblindiamartclientrecord where ".$wherei."  ORDER by id desc")->result();
        //$data['task_list'] = $this->db->query("SELECT l.* from tblappleads as l LEFT JOIN tbllappeadassignstaff  as la ON l.id = la.lead_id where  ".$where."  ORDER by l.id desc")->result();
        $data["source_list"] = $this->db->query("SELECT id,exotel_number,source,source_id FROM `tblvagentnumbers` WHERE source_id > 0 and status = 1 GROUP BY exotel_number ORDER BY source ASC")->result();
        $data["agent_list"] = $this->db->query("SELECT staffid,firstname,phonenumber FROM `tblstaff` WHERE callingnumber != '' and active = 1 ORDER BY firstname ASC ")->result();

        $keys_info  = $this->db->query("SELECT `staffid`,`callingnumber` FROM tblstaff WHERE staffid = '".get_staff_user_id()."' ")->row();
        if(!empty($keys_info) && !empty($keys_info->callingnumber)){
            $data['calling_numbes'] = $this->db->query("SELECT * from tblvagentnumbers  where status = 1 and id IN (".$keys_info->callingnumber.") group by exotel_number order by id asc")->result();
        }


        $data['title'] = 'Incoming Call List';
        $this->load->view('admin/calls/view', $data);
    }

    public function outgoingcalls($id = '')
    {

        $where = " id > 0 ";
        /*if (!is_admin()) {
            $phonenumber = get_employee_info(get_staff_user_id())->phonenumber;
            $where .= " and agent_number = '".$phonenumber."'";
        }*/
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
        }else{
            $where .= " and date = '".date('Y-m-d')."' ";
        }


        $data['outgoing_list'] = $this->db->query("SELECT * from tblcalloutgoing where  ".$where." order by id desc ")->result();


        $data['title'] = 'Outgoing Call List';
        $this->load->view('admin/calls/outgoing_view', $data);
    }



    public function justdial_calls($id = '')
    {
        //check_permission('8,115','view');

        $where = " id > 0 ";

        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
        }else{
            $where .= " and date = '".date('Y-m-d')."' ";
        }


        $data['incoming_list'] = $this->db->query("SELECT * from tbljustdialclientrecord where  ".$where." order by id desc ")->result();

        $keys_info  = $this->db->query("SELECT `staffid`,`callingnumber` FROM tblstaff WHERE staffid = '".get_staff_user_id()."' ")->row();
        if(!empty($keys_info) && !empty($keys_info->callingnumber)){
            $data['calling_numbes'] = $this->db->query("SELECT * from tblvagentnumbers  where status = 1 and id IN (".$keys_info->callingnumber.") group by exotel_number order by id asc")->result();
        }


        $data['title'] = 'Justdial Call List';
        $this->load->view('admin/calls/justdial_calls', $data);
    }

    public function india_mart($id = '')
    {
        $this->load->model('Reports_model');
        $this->Reports_model->getIndiamart();

        $where = " id > 0 ";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
           }
        }else{
            $where .= " and date = '".date('Y-m-d')."' ";
        }

        $data['indiamart_list'] = $this->db->query("SELECT * FROM tblindiamartclientrecord WHERE ".$where." ORDER BY id DESC ")->result();

        $keys_info  = $this->db->query("SELECT `staffid`,`callingnumber` FROM tblstaff WHERE staffid = '".get_staff_user_id()."' ")->row();
        if(!empty($keys_info) && !empty($keys_info->callingnumber)){
            $data['calling_numbes'] = $this->db->query("SELECT * from tblvagentnumbers  where status = 1 and id IN (".$keys_info->callingnumber.") group by exotel_number order by id asc")->result();
        }

        $data['title'] = 'India Mart Call List';
        $this->load->view('admin/calls/indiamart_calls', $data);
    }

    public function getIndiaMartDetails($id){

        $details = $this->db->query("SELECT * FROM tblindiamartclientrecord WHERE id=".$id." ORDER BY id DESC ")->row();
        if ($details){

            $company_name = (!empty($details->company_name)) ? cc($details->company_name) : "--";
            $address = (!empty($details->address)) ? cc($details->address) : "--";
            $state = (!empty($details->state)) ? cc($details->state) : "--";
            $city = (!empty($details->city)) ? cc($details->city) : "--";
            $country = (!empty($details->country)) ? cc($details->country) : "--";
            $product_name = (!empty($details->product_name)) ? cc($details->product_name) : "--";
            $alternate_email = (!empty($details->alternate_email)) ? cc($details->alternate_email) : "--";
            $alternate_mobile = (!empty($details->alternate_mobile)) ? cc($details->alternate_mobile) : "--";
            $product_name = (!empty($details->product_name)) ? cc($details->product_name) : "--";
            $message = (!empty($details->message)) ? $details->message : "--";
            $call_duration = (!empty($details->call_duration)) ? $details->call_duration : "--";
            $receiver_number = (!empty($details->receiver_number)) ? $details->receiver_number : "--";
            $email = (!empty($details->email)) ? $details->email : "--";
            $mobile = (!empty($details->mobile)) ? $details->mobile : "--";
            $source_type = "--";
            if ($details->source_type == "W"){
                $source_type = "Direct";
            }elseif ($details->source_type == "B") {
                $source_type = "Consumed BuyLead";
            }elseif ($details->source_type == "P") {
                $source_type = "Call";
            }

            $html = '<div class="text-center">
                        <h3 class="text-danger">'.cc($details->customer_name).'</h3>
                    </div>
                    <hr>';
            $html .='<div class="row">
                    <div class="col-md-12">
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="text-info">DATE : </label>
                                        <div class="form-group">
                                            <samp>'.  _d($details->date).'</samp>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-info">UNIQUE ID. : </label>
                                        <div class="form-group">
                                            <samp> '.$details->unique_id.'</samp>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="text-info">EMAIL : </label>
                                            <div class="form-group">
                                                <samp>'.$email.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">MOBILE : </label>
                                            <div class="form-group">
                                                <samp>'.$mobile.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info ">COMPANY NAME : </label>
                                            <div class="form-group">
                                                <samp>'.$company_name.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">ADDRESS : </label>
                                            <div class="form-group">
                                                <samp>'.$address.'</samp>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">CITY : </label>
                                            <div class="form-group">
                                                <samp>'.$city.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">STATE : </label>
                                            <div class="form-group">
                                                <samp>'.$state.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">ALTERNATE EMAIL : </label>
                                            <div class="form-group">
                                                <samp>'.$alternate_email.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">ALTERNATE MOBILE : </label>
                                            <div class="form-group">
                                                <samp>'.$alternate_mobile.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">COUNTRY : </label>
                                            <div class="form-group">
                                                <samp>'.$details->country.'</samp>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="text-info">SOURCE TYPE : </label>
                                            <div class="form-group">
                                                <samp>'.$source_type.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">PRODUCT NAME : </label>
                                            <div class="form-group">
                                                <samp>'.$product_name.'</samp>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="text-info ">MESSAGE : </label>
                                            <div class="form-group">
                                                <samp>'.$message.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">ENQUIRY TYPE : </label>
                                            <div class="form-group">
                                                <samp>'.cc($details->enquiry_type).'</samp>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label class="text-info">CALL DURATION : </label>
                                            <div class="form-group">
                                                <samp>'.$call_duration.'</samp>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-info">RECEIVER NUMBER : </label>
                                            <div class="form-group">
                                                <samp>'.$receiver_number.'</samp>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            echo $html;
        }
    }

}
