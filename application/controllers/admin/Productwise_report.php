<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Productwise_report extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function lead_report()
    {
        check_permission('71,225','view');
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($product_id) || !empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($service_type) || !empty($f_date) || !empty($t_date)){

                $where = "l.id > 0";

                if(!empty($product_id)){
                    $where .= " and lp.product_id = '".$product_id."' ";
                    $data['product_id'] = $product_id;
                }else{
                   if(!empty($category_id)){
                        $where .= " and p.product_cat_id = '".$category_id."' ";
                        $data['category_id'] = $category_id;
                    }

                    if(!empty($sub_category_id)){
                        $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                        $data['sub_category_id'] = $sub_category_id;
                    }

                    if(!empty($parent_category_id)){
                        $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                        $data['parent_category_id'] = $parent_category_id;
                    }

                    if(!empty($child_category_id)){
                        $where .= " and p.child_category_id = '".$child_category_id."' ";
                        $data['child_category_id'] = $child_category_id;
                    }

                }

                if(!empty($service_type)){
                    $where .= " and lp.enquiry_for_id = '".$service_type."' ";
                    $data['service_type'] = $service_type;
                }

                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                if(!empty($lead_source)){
                    $where .= " and l.source = '".$lead_source."' ";
                    $data['lead_source'] = $lead_source;
                }

                $data['lead_list'] = $this->db->query("SELECT l.* FROM tblleads as l LEFT JOIN tblproductinquiry as lp ON l.id = lp.enquiry_id LEFT JOIN tblproducts as p ON lp.product_id = p.id where ".$where." GROUP by lp.enquiry_id ")->result();
            }
        }

        $ttl_amount = 0;
        if(!empty($data['lead_list'])){
            foreach ($data['lead_list'] as $lead) {
                $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$lead->id."' order by id desc  ")->row();
                if(!empty($quotation_info)){
                    $ttl_amount += $quotation_info->total;
                }
            }
        }

        $data['ttl_amount'] = $ttl_amount;
        $data['ttl_count'] = (isset($data['lead_list'])) ? count($data['lead_list']) : 0;
        $data['product_list'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ")->result();
        $data['servicetype_list'] = $this->db->query("SELECT * from `tblenquiryformaster` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC")->result();
        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ORDER BY name ASC")->result();

        $data['title'] = 'Product Wise (Lead Report)';
        $this->load->view('admin/Productwise_report/lead_report', $data);

    }


    public function quotation_report()
    {
        check_permission('71,225','view');
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($product_id) || !empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($service_type) || !empty($f_date) || !empty($t_date)){

                $where = "i.rel_type = 'proposal'";

                if(!empty($product_id)){
                    $where .= " and i.pro_id = '".$product_id."' ";
                    $data['product_id'] = $product_id;
                }else{
                    if(!empty($category_id)){
                        $where .= " and p.product_cat_id = '".$category_id."' ";
                        $data['category_id'] = $category_id;
                    }

                    if(!empty($sub_category_id)){
                        $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                        $data['sub_category_id'] = $sub_category_id;
                    }

                    if(!empty($parent_category_id)){
                        $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                        $data['parent_category_id'] = $parent_category_id;
                    }

                    if(!empty($child_category_id)){
                        $where .= " and p.child_category_id = '".$child_category_id."' ";
                        $data['child_category_id'] = $child_category_id;
                    }
                }


                if(!empty($service_type)){
                    if($service_type != 3){
                        $where .= " and q.service_type = '".$service_type."' ";
                    }

                    $data['service_type'] = $service_type;
                }

                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and q.date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                $data['quotation_list'] = $this->db->query("SELECT q.* FROM tblproposals as q LEFT JOIN tblitems_in as i ON q.id = i.rel_id LEFT JOIN tblproducts as p ON i.pro_id = p.id where ".$where." GROUP by i.rel_id ")->result();
            }
        }

        $data['product_list'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC")->result();
        $data['servicetype_list'] = $this->db->query("SELECT * from `tblenquiryformaster` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();

        $data['title'] = 'Product Wise (Quotation Report)';
        $this->load->view('admin/Productwise_report/quotation_report', $data);

    }

    public function perfomainvoice_report()
    {
        check_permission('71,225','view');
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($product_id) || !empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($service_type) || !empty($f_date) || !empty($t_date)){

                $where = "i.rel_type = 'estimate'";

                if(!empty($product_id)){
                    $where .= " and i.pro_id = '".$product_id."' ";
                    $data['product_id'] = $product_id;
                }else{
                    if(!empty($category_id)){
                        $where .= " and p.product_cat_id = '".$category_id."' ";
                        $data['category_id'] = $category_id;
                    }

                    if(!empty($sub_category_id)){
                        $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                        $data['sub_category_id'] = $sub_category_id;
                    }

                    if(!empty($parent_category_id)){
                        $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                        $data['parent_category_id'] = $parent_category_id;
                    }

                    if(!empty($child_category_id)){
                        $where .= " and p.child_category_id = '".$child_category_id."' ";
                        $data['child_category_id'] = $child_category_id;
                    }
                }

                if(!empty($service_type)){
                    if($service_type != 3){
                        $where .= " and e.service_type = '".$service_type."' ";
                    }

                    $data['service_type'] = $service_type;
                }

                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and e.date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                $data['invoice_list'] = $this->db->query("SELECT e.* FROM tblestimates as e LEFT JOIN tblitems_in as i ON e.id = i.rel_id LEFT JOIN tblproducts as p ON i.pro_id = p.id where ".$where." GROUP by i.rel_id ")->result();
            }
        }

        $data['product_list'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC")->result();
        $data['servicetype_list'] = $this->db->query("SELECT * from `tblenquiryformaster` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();

        $data['title'] = 'Product Wise (Profoma Invoice Report)';
        $this->load->view('admin/Productwise_report/perfomainvoice_report', $data);

    }

    public function invoice_report()
    {
        check_permission('71,225','view');
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($product_id) || !empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($service_type) || !empty($f_date) || !empty($t_date)){

                $where = "i.rel_type = 'invoice'";

                if(!empty($product_id)){
                    $where .= " and i.pro_id = '".$product_id."' ";
                    $data['product_id'] = $product_id;
                }else{
                    if(!empty($category_id)){
                        $where .= " and p.product_cat_id = '".$category_id."' ";
                        $data['category_id'] = $category_id;
                    }

                    if(!empty($sub_category_id)){
                        $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                        $data['sub_category_id'] = $sub_category_id;
                    }

                    if(!empty($parent_category_id)){
                        $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                        $data['parent_category_id'] = $parent_category_id;
                    }

                    if(!empty($child_category_id)){
                        $where .= " and p.child_category_id = '".$child_category_id."' ";
                        $data['child_category_id'] = $child_category_id;
                    }
                }

                if(!empty($service_type)){
                    if($service_type != 3){
                        $where .= " and iv.service_type = '".$service_type."' ";
                    }

                    $data['service_type'] = $service_type;
                }

                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and iv.invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                $data['invoice_list'] = $this->db->query("SELECT iv.* FROM tblinvoices as iv LEFT JOIN tblitems_in as i ON iv.id = i.rel_id LEFT JOIN tblproducts as p ON i.pro_id = p.id where ".$where." GROUP by i.rel_id ")->result();
            }
        }

        $data['product_list'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC")->result();
        $data['servicetype_list'] = $this->db->query("SELECT * from `tblenquiryformaster` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();

        $data['title'] = 'Product Wise (Invoice Report)';
        $this->load->view('admin/Productwise_report/invoice_report', $data);

    }

    public function lead_sale_report()
    {
        check_permission('9,216','view');

        $staff_id = get_staff_user_id();
        $where = "r.staff_id = '".$staff_id."' and r.report_type = 1";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($f_date) || !empty($t_date) || !empty($lead_source)){


                if(!empty($f_date) && !empty($t_date) && !empty($lead_source)){

                    $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>1));
                    $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
                    foreach ($product_list as $pro) {

                        $rent_qty = $this->db->query("SELECT COALESCE(SUM(lp.qty),0) as ttl_qty from tblproductinquiry as lp LEFT JOIN tblleads as l ON l.id = lp.enquiry_id where l.source = '".$lead_source."' and l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' and lp.product_id = '".$pro->id."' and ( lp.enquiry_for_id = 1 || lp.enquiry_for_id = 3 )   ")->row()->ttl_qty;
                        $sale_qty = $this->db->query("SELECT COALESCE(SUM(lp.qty),0) as ttl_qty from tblproductinquiry as lp LEFT JOIN tblleads as l ON l.id = lp.enquiry_id where l.source = '".$lead_source."' and l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' and lp.product_id = '".$pro->id."' and ( lp.enquiry_for_id = 2 || lp.enquiry_for_id = 3 )   ")->row()->ttl_qty;

                        if($rent_qty > 0 || $sale_qty > 0){
                            $ad_data = array(
                                'staff_id' => $staff_id,
                                'report_type' => 1,
                                'product_id' => $pro->id,
                                'rent_qty' => $rent_qty,
                                'sale_qty' => $sale_qty,
                            );
                            $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                        }
                    }

                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                    $data['lead_source'] = $lead_source;

                }elseif(!empty($f_date) && !empty($t_date)){

                    $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>1));
                    $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
                    foreach ($product_list as $pro) {

                        $rent_qty = $this->db->query("SELECT COALESCE(SUM(lp.qty),0) as ttl_qty from tblproductinquiry as lp LEFT JOIN tblleads as l ON l.id = lp.enquiry_id where l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' and lp.product_id = '".$pro->id."' and ( lp.enquiry_for_id = 1 || lp.enquiry_for_id = 3 )   ")->row()->ttl_qty;
                        $sale_qty = $this->db->query("SELECT COALESCE(SUM(lp.qty),0) as ttl_qty from tblproductinquiry as lp LEFT JOIN tblleads as l ON l.id = lp.enquiry_id where l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' and lp.product_id = '".$pro->id."' and ( lp.enquiry_for_id = 2 || lp.enquiry_for_id = 3 )   ")->row()->ttl_qty;

                        if($rent_qty > 0 || $sale_qty > 0){
                            $ad_data = array(
                                'staff_id' => $staff_id,
                                'report_type' => 1,
                                'product_id' => $pro->id,
                                'rent_qty' => $rent_qty,
                                'sale_qty' => $sale_qty,
                            );
                            $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                        }
                    }

                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                }elseif(!empty($lead_source)){

                    $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>1));
                    $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
                    foreach ($product_list as $pro) {

                        $rent_qty = $this->db->query("SELECT COALESCE(SUM(lp.qty),0) as ttl_qty from tblproductinquiry as lp LEFT JOIN tblleads as l ON l.id = lp.enquiry_id where l.source = '".$lead_source."' and lp.product_id = '".$pro->id."' and ( lp.enquiry_for_id = 1 || lp.enquiry_for_id = 3 )   ")->row()->ttl_qty;
                        $sale_qty = $this->db->query("SELECT COALESCE(SUM(lp.qty),0) as ttl_qty from tblproductinquiry as lp LEFT JOIN tblleads as l ON l.id = lp.enquiry_id where l.source = '".$lead_source."' and lp.product_id = '".$pro->id."' and ( lp.enquiry_for_id = 2 || lp.enquiry_for_id = 3 )   ")->row()->ttl_qty;

                        if($rent_qty > 0 || $sale_qty > 0){
                            $ad_data = array(
                                'staff_id' => $staff_id,
                                'report_type' => 1,
                                'product_id' => $pro->id,
                                'rent_qty' => $rent_qty,
                                'sale_qty' => $sale_qty,
                            );
                            $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                        }
                    }

                    $data['lead_source'] = $lead_source;
                }

                if(!empty($category_id)){
                    $where .= " and p.product_cat_id = '".$category_id."' ";
                    $data['category_id'] = $category_id;
                }

                if(!empty($sub_category_id)){
                    $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                    $data['sub_category_id'] = $sub_category_id;
                }

                if(!empty($parent_category_id)){
                    $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                    $data['parent_category_id'] = $parent_category_id;
                }

                if(!empty($child_category_id)){
                    $where .= " and p.child_category_id = '".$child_category_id."' ";
                    $data['child_category_id'] = $child_category_id;
                }


            }
        }else{
            $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>1));
            $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
            foreach ($product_list as $pro) {

                $rent_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblproductinquiry where product_id = '".$pro->id."' and (enquiry_for_id = 1 || enquiry_for_id = 3)   ")->row()->ttl_qty;
                $sale_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblproductinquiry where product_id = '".$pro->id."' and (enquiry_for_id = 2 || enquiry_for_id = 3)   ")->row()->ttl_qty;

                if($rent_qty > 0 || $sale_qty > 0){
                    $ad_data = array(
                        'staff_id' => $staff_id,
                        'report_type' => 1,
                        'product_id' => $pro->id,
                        'rent_qty' => $rent_qty,
                        'sale_qty' => $sale_qty,
                    );
                    $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                }

            }

        }

        $data['lead_list'] = $this->db->query("SELECT r.* FROM tbltemp_salereport as r LEFT JOIN tblproducts as p ON r.product_id = p.id where ".$where." order by r.rent_qty desc ")->result();


        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ORDER BY name ASC ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC")->result();

        $data['title'] = 'Product Sale (Lead Report)';
        $this->load->view('admin/Productwise_report/lead_sale_report', $data);

    }

    public function quotation_sale_report()
    {
        check_permission('9,216','view');

        $staff_id = get_staff_user_id();
        $where = "r.staff_id = '".$staff_id."' and r.report_type = 2";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($f_date) || !empty($t_date)){


                if(!empty($f_date) && !empty($t_date)){

                    $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>2));
                    $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
                    foreach ($product_list as $pro) {

                        $rent_qty = $this->db->query("SELECT COALESCE(SUM(i.qty),0) as ttl_qty from tblitems_in as i LEFT JOIN tblproposals as m ON m.id = i.rel_id where m.date between '".db_date($f_date)."' and '".db_date($t_date)."' and i.pro_id = '".$pro->id."' and  i.is_sale = 0 and  i.rel_type = 'proposal'   ")->row()->ttl_qty;

                        $sale_qty = $this->db->query("SELECT COALESCE(SUM(i.qty),0) as ttl_qty from tblitems_in as i LEFT JOIN tblproposals as m ON m.id = i.rel_id where m.date between '".db_date($f_date)."' and '".db_date($t_date)."' and i.pro_id = '".$pro->id."' and  i.is_sale = 1 and  i.rel_type = 'proposal'   ")->row()->ttl_qty;

                        if($rent_qty > 0 || $sale_qty > 0){
                            $ad_data = array(
                                'staff_id' => $staff_id,
                                'report_type' => 2,
                                'product_id' => $pro->id,
                                'rent_qty' => $rent_qty,
                                'sale_qty' => $sale_qty,
                            );
                            $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                        }
                    }

                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                if(!empty($category_id)){
                    $where .= " and p.product_cat_id = '".$category_id."' ";
                    $data['category_id'] = $category_id;
                }

                if(!empty($sub_category_id)){
                    $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                    $data['sub_category_id'] = $sub_category_id;
                }

                if(!empty($parent_category_id)){
                    $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                    $data['parent_category_id'] = $parent_category_id;
                }

                if(!empty($child_category_id)){
                    $where .= " and p.child_category_id = '".$child_category_id."' ";
                    $data['child_category_id'] = $child_category_id;
                }


            }
        }else{
            $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>2));
            $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
            foreach ($product_list as $pro) {

                $rent_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblitems_in where pro_id = '".$pro->id."' and is_sale = 0 and rel_type = 'proposal'  ")->row()->ttl_qty;
                $sale_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblitems_in where pro_id = '".$pro->id."' and is_sale = 1 and rel_type = 'proposal'  ")->row()->ttl_qty;

                if($rent_qty > 0 || $sale_qty > 0){
                    $ad_data = array(
                        'staff_id' => $staff_id,
                        'report_type' => 2,
                        'product_id' => $pro->id,
                        'rent_qty' => $rent_qty,
                        'sale_qty' => $sale_qty,
                    );
                    $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                }
            }

        }

        $data['lead_list'] = $this->db->query("SELECT r.* FROM tbltemp_salereport as r LEFT JOIN tblproducts as p ON r.product_id = p.id where ".$where." order by r.rent_qty desc ")->result();


        $data['sources_info'] = $this->db->query("SELECT * from `tblleadssources` ORDER BY name ASC ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();

        $data['title'] = 'Product Sale (Quotation Report)';
        $this->load->view('admin/Productwise_report/quotation_sale_report', $data);

    }

    public function perfomainvoice_sale_report()
    {
        check_permission('9,216','view');

        $staff_id = get_staff_user_id();
        $where = "r.staff_id = '".$staff_id."' and r.report_type = 3";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($f_date) || !empty($t_date)){


                if(!empty($f_date) && !empty($t_date)){

                    $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>3));
                    $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
                    foreach ($product_list as $pro) {

                        $rent_qty = $this->db->query("SELECT COALESCE(SUM(i.qty),0) as ttl_qty from tblitems_in as i LEFT JOIN tblestimates as m ON m.id = i.rel_id where m.date between '".db_date($f_date)."' and '".db_date($t_date)."' and i.pro_id = '".$pro->id."' and  i.is_sale = 0 and  i.rel_type = 'estimate'   ")->row()->ttl_qty;

                        $sale_qty = $this->db->query("SELECT COALESCE(SUM(i.qty),0) as ttl_qty from tblitems_in as i LEFT JOIN tblestimates as m ON m.id = i.rel_id where m.date between '".db_date($f_date)."' and '".db_date($t_date)."' and i.pro_id = '".$pro->id."' and  i.is_sale = 1 and  i.rel_type = 'estimate'   ")->row()->ttl_qty;

                        if($rent_qty > 0 || $sale_qty > 0){
                            $ad_data = array(
                                'staff_id' => $staff_id,
                                'report_type' => 3,
                                'product_id' => $pro->id,
                                'rent_qty' => $rent_qty,
                                'sale_qty' => $sale_qty,
                            );
                            $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                        }
                    }

                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                if(!empty($category_id)){
                    $where .= " and p.product_cat_id = '".$category_id."' ";
                    $data['category_id'] = $category_id;
                }

                if(!empty($sub_category_id)){
                    $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                    $data['sub_category_id'] = $sub_category_id;
                }

                if(!empty($parent_category_id)){
                    $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                    $data['parent_category_id'] = $parent_category_id;
                }

                if(!empty($child_category_id)){
                    $where .= " and p.child_category_id = '".$child_category_id."' ";
                    $data['child_category_id'] = $child_category_id;
                }


            }
        }else{
            $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>3));
            $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
            foreach ($product_list as $pro) {

                $rent_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblitems_in where pro_id = '".$pro->id."' and is_sale = 0 and rel_type = 'estimate'  ")->row()->ttl_qty;
                $sale_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblitems_in where pro_id = '".$pro->id."' and is_sale = 1 and rel_type = 'estimate' ")->row()->ttl_qty;

                if($rent_qty > 0 || $sale_qty > 0){
                    $ad_data = array(
                        'staff_id' => $staff_id,
                        'report_type' => 3,
                        'product_id' => $pro->id,
                        'rent_qty' => $rent_qty,
                        'sale_qty' => $sale_qty,
                    );
                    $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                }
            }

        }

        $data['lead_list'] = $this->db->query("SELECT r.* FROM tbltemp_salereport as r LEFT JOIN tblproducts as p ON r.product_id = p.id where ".$where." order by r.rent_qty desc ")->result();


        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC")->result();

        $data['title'] = 'Product Sale (Proforma Invoice Report)';
        $this->load->view('admin/Productwise_report/perfomainvoice_sale_report', $data);

    }


    public function invoice_sale_report()
    {
        check_permission('9,216','view');

        $staff_id = get_staff_user_id();
        $where = "r.staff_id = '".$staff_id."' and r.report_type = 4";
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($f_date) || !empty($t_date)){


                if(!empty($f_date) && !empty($t_date)){

                    $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>4));
                    $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
                    foreach ($product_list as $pro) {

                        $rent_qty = $this->db->query("SELECT COALESCE(SUM(i.qty),0) as ttl_qty from tblitems_in as i LEFT JOIN tblinvoices as m ON m.id = i.rel_id where m.invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' and i.pro_id = '".$pro->id."' and  i.is_sale = 0 and  i.rel_type = 'invoice'   ")->row()->ttl_qty;

                        $sale_qty = $this->db->query("SELECT COALESCE(SUM(i.qty),0) as ttl_qty from tblitems_in as i LEFT JOIN tblinvoices as m ON m.id = i.rel_id where m.invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' and i.pro_id = '".$pro->id."' and  i.is_sale = 1 and  i.rel_type = 'invoice'   ")->row()->ttl_qty;

                        if($rent_qty > 0 || $sale_qty > 0){
                            $ad_data = array(
                                'staff_id' => $staff_id,
                                'report_type' => 4,
                                'product_id' => $pro->id,
                                'rent_qty' => $rent_qty,
                                'sale_qty' => $sale_qty,
                            );
                            $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                        }
                    }

                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                if(!empty($category_id)){
                    $where .= " and p.product_cat_id = '".$category_id."' ";
                    $data['category_id'] = $category_id;
                }

                if(!empty($sub_category_id)){
                    $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                    $data['sub_category_id'] = $sub_category_id;
                }

                if(!empty($parent_category_id)){
                    $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                    $data['parent_category_id'] = $parent_category_id;
                }

                if(!empty($child_category_id)){
                    $where .= " and p.child_category_id = '".$child_category_id."' ";
                    $data['child_category_id'] = $child_category_id;
                }


            }
        }else{
            $this->home_model->delete('tbltemp_salereport', array('staff_id'=>$staff_id,'report_type'=>4));
            $product_list = $this->db->query("SELECT `id` from `tblproducts` where status = 1 and isOtherCharge = 0 ")->result();
            foreach ($product_list as $pro) {

                $rent_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblitems_in where pro_id = '".$pro->id."' and is_sale = 0 and rel_type = 'invoice'  ")->row()->ttl_qty;
                $sale_qty = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty from tblitems_in where pro_id = '".$pro->id."' and is_sale = 1 and rel_type = 'invoice' ")->row()->ttl_qty;

                if($rent_qty > 0 || $sale_qty > 0){
                    $ad_data = array(
                        'staff_id' => $staff_id,
                        'report_type' => 4,
                        'product_id' => $pro->id,
                        'rent_qty' => $rent_qty,
                        'sale_qty' => $sale_qty,
                    );
                    $insert = $this->home_model->insert('tbltemp_salereport', $ad_data);
                }
            }

        }

        $data['lead_list'] = $this->db->query("SELECT r.* FROM tbltemp_salereport as r LEFT JOIN tblproducts as p ON r.product_id = p.id where ".$where." order by r.rent_qty desc ")->result();


        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC")->result();

        $data['title'] = 'Product Sale (Invoice Report)';
        $this->load->view('admin/Productwise_report/invoice_sale_report', $data);

    }


    public function purchaseorder_report()
    {
        check_permission('71,225','view');
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($product_id) || !empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($status) || !empty($f_date) || !empty($t_date)){

                $where = "po.show_list  = '1' ";

                if(!empty($product_id)){
                    $where .= " and pp.product_id = '".$product_id."' ";
                    $data['product_id'] = $product_id;
                }else{
                   if(!empty($category_id)){
                        $where .= " and p.product_cat_id = '".$category_id."' ";
                        $data['category_id'] = $category_id;
                    }

                    if(!empty($sub_category_id)){
                        $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                        $data['sub_category_id'] = $sub_category_id;
                    }

                    if(!empty($parent_category_id)){
                        $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                        $data['parent_category_id'] = $parent_category_id;
                    }

                    if(!empty($child_category_id)){
                        $where .= " and p.child_category_id = '".$child_category_id."' ";
                        $data['child_category_id'] = $child_category_id;
                    }

                }


                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and po.date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                if($status != ''){
                    $data['s_status'] = $status;
                    if($status == 3){
                        $where .= " and po.cancel = 1";
                    }else{
                        $where .= " and po.status = '".$status."' and po.cancel = 0";
                    }

                }

                $data['purchaseorder_list'] = $this->db->query("SELECT po.* FROM tblpurchaseorder as po LEFT JOIN tblpurchaseorderproduct as pp ON po.id = pp.po_id LEFT JOIN tblproducts as p ON pp.product_id = p.id where ".$where." GROUP by pp.po_id ")->result();
            }
        }


        $data['product_list'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC")->result();
        $data['servicetype_list'] = $this->db->query("SELECT * from `tblenquiryformaster` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();

        $data['title'] = 'Product Wise (Purchase Order)';
        $this->load->view('admin/Productwise_report/purchaseorder_report', $data);

    }

    /* this function use for list of quatation */
    public function quotation_list($id = ""){

        $data["title"] = "Proposal List";
        $salesreport = $this->db->query("SELECT `product_id` from `tbltemp_salereport` where `id` = ".$id."")->row();
        if (empty($salesreport)){
            redirect(admin_url("productwise_report/quotation_sale_report"));
        }

        extract($this->input->get());

        $where = "i.pro_id = '".$salesreport->product_id."' and i.rel_type = 'proposal' and i.is_sale = '".$is_sale."'";
        if(!empty($f_date) && !empty($t_date)){
            $where .= " and m.date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
        }


        $data["proposal_list"] = $this->db->query("SELECT m.* from tblitems_in as i LEFT JOIN tblproposals as m ON m.id = i.rel_id where ".$where."")->result();

        $this->load->view('admin/Productwise_report/quatation_list', $data);
    }

    /* this function use for challan product report */
    public function challan_product_report()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($product_id) || !empty($category_id) || !empty($sub_category_id) || !empty($parent_category_id) || !empty($child_category_id) || !empty($service_type) || !empty($f_date) || !empty($t_date) || !empty($type)){


                if(!empty($type) && $type == 1){
                    $where = "iv.approve_status = 1 and p.id > 0";
                }  else {
                   $where = "iv.approve_status = 1 and i.component_id > 0";
                }
                if(!empty($product_id)){
                    if(!empty($type) && $type == 1){
                       $where .= " and p.id = '".$product_id."' ";
                    }  else {
                       $where .= " and i.component_id = '".$product_id."' ";
                    }

                    $data['product_id'] = $product_id;
                }else{
                    if(!empty($category_id)){
                        $where .= " and p.product_cat_id = '".$category_id."' ";
                        $data['category_id'] = $category_id;
                    }

                    if(!empty($sub_category_id)){
                        $where .= " and p.product_sub_cat_id = '".$sub_category_id."' ";
                        $data['sub_category_id'] = $sub_category_id;
                    }

                    if(!empty($parent_category_id)){
                        $where .= " and p.parent_category_id = '".$parent_category_id."' ";
                        $data['parent_category_id'] = $parent_category_id;
                    }

                    if(!empty($child_category_id)){
                        $where .= " and p.child_category_id = '".$child_category_id."' ";
                        $data['child_category_id'] = $child_category_id;
                    }
                }

                if(!empty($service_type)){
                    if($service_type != 3){
                        $where .= " and iv.service_type = '".$service_type."' ";
                    }

                    $data['service_type'] = $service_type;
                }

                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and iv.challandate between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;
                }

                if(!empty($type)){
                    if ($type == 1){
//                        $data['challan_product_list'] = $this->db->query("SELECT p.id as component_id, CONCAT(p.name, if(c2.name IS NULL,'',', '), ifnull(c2.name,'')) as product_name FROM tblchalanmst as iv LEFT JOIN tblproducts as c2 ON (replace(substring(substring_index(iv.product_ids, ',', 2), length(substring_index(iv.product_ids, ',', 2 - 1)) + 1), ',', '') = c2.id) INNER JOIN tblproducts as p ON (replace(substring(substring_index(iv.product_ids, ',', 1), length(substring_index(iv.product_ids, ',', 1- 1)) + 1), ',', '') = p.id) where ".$where." GROUP by p.id ")->result();
                        $data['challan_product_list'] = $this->db->query("SELECT GROUP_CONCAT(`iv`.`id`) as challan_ids, `p`.`id` as component_id, `p`.`name` as product_name FROM `tblchalanmst` AS `iv` , `tblproducts` AS `p` WHERE FIND_IN_SET( `p`.`id` , `iv`.`pro_id` ) !=0 AND ".$where." GROUP BY `p`.`id`")->result();
                    }else{
                        $data['challan_product_list'] = $this->db->query("SELECT GROUP_CONCAT(iv.id) as challan_ids, i.component_id, SUM(i.deleverable_qty) as qty, p.name as product_name FROM tblchalanmst as iv LEFT JOIN tblchalandetailsmst as i ON iv.id = i.chalan_id LEFT JOIN tblproducts as p ON i.component_id = p.id where ".$where." GROUP by i.component_id ")->result();
                    }
                    $data['type'] = $type;
                }

            }
        }

        $data['product_list'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ")->result();
        $data['servicetype_list'] = $this->db->query("SELECT * from `tblenquiryformaster` where status = 1 ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ")->result();

        $data['title'] = 'Challan Product Report';
        $this->load->view('admin/Productwise_report/challan_product_report', $data);

    }

    public function get_product_challan(){
        $product_id = $_GET["product_id"];
        $challan_ids = $_GET["challan_id"];
        $type = $_GET["type"];

        if (!empty($type) && $type == 1){
            $data["product_id"] = $product_id;
            $data["product_challan_list"] = $this->db->query("SELECT * FROM tblchalanmst WHERE id IN (".$challan_ids.") ORDER BY id DESC")->result();
        }else{
            $data["product_id"] = $product_id;
            $data["product_challan_list"] = $this->db->query("SELECT iv.*, i.deleverable_qty FROM tblchalanmst as iv LEFT JOIN tblchalandetailsmst as i ON iv.id = i.chalan_id WHERE iv.id IN (".$challan_ids.") AND i.component_id = ".$product_id." ORDER BY iv.id DESC")->result();
        }


        $data['title'] = 'Challan List';
        $this->load->view('admin/Productwise_report/product_challan', $data);
    }


    public function challan_productids_update(){
        $getchallan =  $this->db->query("SELECT * FROM `tblchalanmst` WHERE `product_json` != '' ORDER BY `id` ASC")->result();
        if (!empty($getchallan)){
            foreach ($getchallan as $key => $value) {

                $product_ids = array();
                $product_json = json_decode($value->product_json, TRUE);
                if (!empty($product_json)){
                    foreach ($product_json as $k => $val) {
                        $product_ids[] = $val["product_id"];
                    }
                }

                if (!empty($product_ids)){
                    $up_data["pro_id"] = implode(',', $product_ids);
                    $this->home_model->update("tblchalanmst", $up_data, array("id" => $value->id));
                }
            }
        }
        echo "Done";
    }
}
