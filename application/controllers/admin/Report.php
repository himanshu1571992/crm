<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Report extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }


	public function product_sales()
    {
    	  check_permission('30,218,395','view');
    	  $data['title'] = 'Product Detailed Report';
        $data['used_for'] = 'invoice';
    		if(!empty($_POST)){
               /* echo '<pre/>';
                print_r($_POST);
                die;*/
        			extract($this->input->post());
        			$data['f_date'] = $f_date;
              $data['t_date'] = $t_date;
        			$data['service_type'] = $service_type;
        			$data['used_for'] = $used_for;

              $where_pro = "status = '1' ";
              if(!empty($product_id)){
                  $ids = implode(',', $product_id);
                  $where_pro .= " and id IN (".$ids.")";
                  $data['product_id'] = $product_id;
              }
              if(!empty($category_id)){
                  $where_pro .= " and product_cat_id = '".$category_id."' ";
                  $data['category_id'] = $category_id;
              }

              if(!empty($sub_category_id)){
                  $where_pro .= " and product_sub_cat_id = '".$sub_category_id."' ";
                  $data['sub_category_id'] = $sub_category_id;
              }

              if(!empty($parent_category_id)){
                  $where_pro .= " and parent_category_id = '".$parent_category_id."' ";
                  $data['parent_category_id'] = $parent_category_id;
              }

              if(!empty($child_category_id)){
                  $where_pro .= " and child_category_id = '".$child_category_id."' ";
                  $data['child_category_id'] = $child_category_id;
              }
        			$data['product_info'] = $this->db->query("SELECT name,id from `tblproducts` where  ".$where_pro." ")->result();
    		}

        $data['product_list'] = $this->db->query("SELECT name,id from `tblproducts` where  status = '1' ORDER BY name ASC")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();
		    $this->load->view('admin/report/product_sales', $data);
	}

    public function product_sales_details()
    {
        check_permission('30,218','view');

        $data['title'] = 'Product Sales Client Details';

        $used_for = 'invoice';
        if(!empty($_GET)){
            /*echo '<pre/>';
            print_r($_GET);
            die;*/
            extract($this->input->get());
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
            $data['service_type'] = $service_type;
            $data['product_id'] = $product_id;
            $data['used_for'] = $used_for;

        }

        if($service_type == '3'){
            if ($used_for == 'estimate') {
                $data['client_list'] = $this->db->query("SELECT i.clientid from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.clientid ")->result();
            }else if($used_for == 'proposal'){
                $data['client_list'] = $this->db->query("SELECT i.proposal_to from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.proposal_to ")->result();
            }else if($used_for == 'invoice'){
                $data['client_list'] = $this->db->query("SELECT i.clientid from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.clientid ")->result();
            }else if($used_for == 'material_receipt'){
                $data['client_list'] = $this->db->query("SELECT i.vendor_id from tblmaterialreceiptproduct as p LEFT JOIN tblmaterialreceipt as i ON p.mr_id = i.id where p.product_id = '".$product_id."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.vendor_id ")->result();
            }
        }else{
            if ($used_for == 'estimate') {
                $data['client_list'] = $this->db->query("SELECT i.clientid from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."'  and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.clientid ")->result();
            }else if($used_for == 'proposal'){
                $data['client_list'] = $this->db->query("SELECT i.proposal_to from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."'  and (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.proposal_to ")->result();
            }else if($used_for == 'invoice'){
                $data['client_list'] = $this->db->query("SELECT i.clientid from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."'  and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.clientid ")->result();
            }else if($used_for == 'material_receipt'){
                $data['client_list'] = $this->db->query("SELECT i.vendor_id from tblmaterialreceiptproduct as p LEFT JOIN tblmaterialreceipt as i ON p.mr_id = i.id where  p.product_id = '".$product_id."' and i.service_type = '".$service_type."'  and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') GROUP by i.vendor_id ")->result();
            }
        }

        $this->load->view('admin/report/product_sales_details', $data);
    }

    public function product_rate_modal()
    {
         extract($this->input->post());
         $client_info = $this->db->query("SELECT `client_branch_name` FROM `tblclientbranch` where `userid`='".$client_id."' ")->row();
         if($service_type == 1){
            $service_type_name = 'Rent';
        }elseif($service_type == 2){
            $service_type_name = 'Sale';
        }elseif($service_type == 3){
            $service_type_name = 'Rent & Sale Both';
        }
        $used_for = (isset($used_for)) ? $used_for : 'invoice';
        if($service_type == '3'){
            $client_name = (!empty($client_info)) ? $client_info->client_branch_name : '--';
            if ($used_for == 'estimate') {
              $rate_info = $this->db->query("SELECT p.rel_id,p.rate,p.qty from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."')  ")->result();
            }else if($used_for == 'proposal'){
              $client_name = (!empty($client_info)) ? $client_info->client_branch_name : $client_id;;
              $rate_info = $this->db->query("SELECT p.rel_id,p.rate,p.qty,i.state,i.city from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.proposal_to = '".$client_id."'  and (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') ")->result();
            }else if($used_for == 'invoice'){
              $rate_info = $this->db->query("SELECT p.rel_id,p.rate,p.qty from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."')  ")->result();
            }else if($used_for == 'material_receipt'){
              $rate_info = $this->db->query("SELECT p.mr_id as rel_id,p.price as rate,p.qty from tblmaterialreceiptproduct as p LEFT JOIN tblmaterialreceipt as i ON p.mr_id = i.id where p.product_id = '".$product_id."' and i.vendor_id = '".$client_id."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."')  ")->result();
            }
        }else{
            $client_name = (!empty($client_info)) ? $client_info->client_branch_name : '--';
            if ($used_for == 'estimate') {
              $rate_info = $this->db->query("SELECT p.rel_id,p.rate,p.qty from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."')  ")->result();
            }else if($used_for == 'proposal'){
              $client_name = $client_id;
              $rate_info = $this->db->query("SELECT p.rel_id,p.rate,p.qty,i.state,i.city from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.proposal_to = '".$client_id."'  and i.service_type = '".$service_type."' and (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."') ")->result();
            }else if($used_for == 'invoice'){
              $rate_info = $this->db->query("SELECT p.rel_id,p.rate,p.qty from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."')  ")->result();
            }else if($used_for == 'material_receipt'){
              $rate_info = $this->db->query("SELECT p.mr_id as rel_id,p.price as rate,p.qty from tblmaterialreceiptproduct as p LEFT JOIN tblmaterialreceipt as i ON p.mr_id = i.id where p.product_id = '".$product_id."' and i.vendor_id = '".$client_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."')  ")->result();
            }
        }

         ?>
        <div class="row">
             <div class="col-md-12">
                <div class="lead-view" id="leadViewWrapper">
                 <div class="col-md-4 col-xs-12 lead-information-col">
                    <div class="lead-info-heading">
                       <h4 class="no-margin font-medium-xs bold">Client Name</h4>
                    </div>
                    <p class="bold font-medium-xs lead-name"><?php echo $client_name; ?></p>
                 </div>
                <div class="col-md-4 col-xs-12 lead-information-col">
                    <div class="lead-info-heading">
                       <h4 class="no-margin font-medium-xs bold">Product Name</h4>
                    </div>
                    <p class="bold font-medium-xs lead-name"><?php echo value_by_id('tblproducts',$product_id,'name'); ?></p>

                 </div>
                 <div class="col-md-4 col-xs-12 lead-information-col">
                    <div class="lead-info-heading">
                       <h4 class="no-margin font-medium-xs bold">Service Type</h4>
                    </div>
                    <p class="bold font-medium-xs lead-name"><?php echo $service_type_name; ?></p>

                 </div>

              </div>
        <hr>
        <br>
        <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Rate</th>
                        <th>Qty</th>
                        <th>
                          <?php if ($used_for == 'estimate'){
                                  echo "PI";
                                }else if($used_for == "invoice"){
                                  echo "Invoice";
                                }else if($used_for == "material_receipt"){
                                  echo "Material Receipt";
                                }else{
                                  echo "Quote";
                                }
                          ?>
                        </th>
                        <th>Date</th>
                        <th>Site</th>
                        <th>Location</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($rate_info)){
                        $z=1;
                        foreach($rate_info as $row){
                            if ($used_for == 'estimate') {
                                $site_id = value_by_id('tblestimates',$row->rel_id,'site_id');
                                $number = '<a href="'.admin_url('estimates/download_pdf/'.$row->rel_id ).'" target="_blank">' .format_estimate_number($row->rel_id). '</a>';
                                $tdate = '<a href="'.admin_url('estimates/download_pdf/'.$row->rel_id ).'" target="_blank">' ._d(value_by_id('tblestimates',$row->rel_id,'date')). '</a>';
                                $shipto_info = get_ship_to_array($site_id);
                                $location = (!empty($shipto_info)) ? $shipto_info['state'].', '.$shipto_info['city'].', '.$shipto_info['landmark'] : '--';
                            }else if($used_for == 'proposal'){
                                $site_id = '--';
                                $number = '<a href="'.admin_url('proposals/download_pdf/'.$row->rel_id ).'" target="_blank">' .format_proposal_number($row->rel_id). '</a>';
                                $tdate = '<a href="'.admin_url('proposals/download_pdf/'.$row->rel_id ).'" target="_blank">' ._d(value_by_id('tblproposals',$row->rel_id,'date')). '</a>';
                                $state_name = value_by_id_empty('tblstates',$row->state, "name");
                                $city_name = value_by_id_empty('tblcities',$row->city, "name");
                                $location = $state_name.', '.$city_name;
                            }else if($used_for == 'invoice'){
                                $site_id = value_by_id('tblinvoices',$row->rel_id,'site_id');
                                $number = '<a href="'.admin_url('invoices/download_pdf/'.$row->rel_id ).'" target="_blank">' .format_invoice_number($row->rel_id). '</a>';
                                $tdate = '<a href="'.admin_url('invoices/download_pdf/'.$row->rel_id ).'" target="_blank">' ._d(value_by_id('tblinvoices',$row->rel_id,'date')). '</a>';
                                $shipto_info = get_ship_to_array($site_id);
                                $location = (!empty($shipto_info)) ? $shipto_info['state'].', '.$shipto_info['city'].', '.$shipto_info['landmark'] : '--';
                            }else if($used_for == 'material_receipt'){
                                $mr_number = value_by_id('tblmaterialreceipt',$row->rel_id,'numer');
                                $mr_number = (!empty($mr_number)) ? $mr_number : 'MR-' . $row->rel_id;
                                $number = '<a href="'.admin_url('purchase/mr_details/'.$row->rel_id ).'" target="_blank">' .$mr_number. '</a>';
                                $tdate = '<a href="'.admin_url('purchase/mr_details/'.$row->rel_id ).'" target="_blank">' ._d(value_by_id('tblmaterialreceipt',$row->rel_id,'date')). '</a>';
                                $shipto_info = '';
                                $location =  '--';
                            }
                            ?>
                            <tr>
                                <td><?php echo $z++;?></td>
                                <td><?php echo number_format($row->rate, 2, '.', ''); ?></td>
                                <td><?php echo number_format($row->qty, 2, '.', ''); ?></td>
                                <td><?php echo $number; ?></td>
                                <td><?php echo $tdate; ?></td>
                                <td><?php echo (!empty($shipto_info['name'])) ? $shipto_info['name'] : '--'; ?></td>
                                <td><?php echo $location; ?></td>
                             </tr>

                            <?php
                        }
                    }else{
                        echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
                    }
                    ?>


                    </tbody>
                  </table>
          </div>
            </div>
            </div>
         <?php

    }



    public function product_sales_pdf()
    {

    	if(!empty($_GET)){
        extract($this->input->get());
        require_once APPPATH.'third_party/pdfcrowd.php';

        $item_list = $this->db->query("SELECT sub_name,id from `tblproducts` where  status = '1' ")->result();


        $file_name = 'product_sales';

        /*echo $html = location_pdf($from_date,$to_date,$staff_id);
        die;*/


        $html = product_sales_pdf($item_list,$year_id,$service_type);
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
    }

    public function rental_product()
    {
        check_permission('31,219','view');

        $data['title'] = 'Rental Products Report';


        if(financial_year() == 1){
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        }else{
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".financial_year()."' ";
        }

        $client_ids = 0;
        $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
        if(!empty($invoice_client)){
            foreach ($invoice_client as $key => $value) {
                if($key == 0){
                    $client_ids = $value->clientid;
                }else{
                    $client_ids .= ','.$value->clientid;
                }
            }
        }

        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($client_id)){
                $data['s_client_id'] = $client_id;
                $client_id = implode(',', $client_id);
                $where .= " and clientid IN (".$client_id.") ";
            }

            if(!empty($f_date) && !empty($t_date)){
                $where .= " and invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
            }

            /*if(!empty($month) && !empty($year)){
                $data['s_month'] = $month;
                $data['sr_year'] = $year;

                $where .= " and MONTH(`invoice_date`) = '".$month."' and YEAR(`invoice_date`) = '".$year."' ";
            }*/

        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();


        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ORDER BY client_branch_name ASC ")->result();
        //$data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` where active = 1 ")->result();
        /*echo '<pre/>';
        print_r($data['client_data']);
        die;*/
        //$data['month_info'] = $this->db->query("SELECT * from `tblmonths`  ")->result();


        $this->load->view('admin/report/rental_product', $data);
    }


    public function client_payment_report()
    {
        check_permission('66,84,222,296,297','view');

        $data['service_type'] = 2;
        $data['type'] = 1;
        $data['min_balance'] = '';
        $data['max_balance'] = '';

        $data['s_fdate'] = date('d/m/Y',strtotime('first day of this month'));
        $data['s_tdate'] = date('d/m/Y',strtotime('last day of this month'));

        $data['f_date'] = date('Y-m-d',strtotime('first day of this month'));
        $data['t_date'] = date('Y-m-d',strtotime('last day of this month'));

         if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($client_branch)){
                $data['client_id'] = $client_id;
                $data['s_client_branch'] = $client_branch;
                $client_branch = implode(',', $client_branch);
                $data['client_list'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where userid IN (".$client_branch.") ")->result();
            }else{
            	$data['client_list'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
            }

            if(!empty($service_type)){
            	$data['service_type'] = $service_type;
            }

            if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

               $data['f_date'] = db_date($f_date);
               $data['t_date'] = db_date($t_date);
            }

            $data['min_balance'] = $min_balance;
            $data['max_balance'] = $max_balance;

        }else{
        	 $data['client_list'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
        }

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ORDER BY client_branch_name ASC ")->result();
        $data['client_info'] = $this->db->query("SELECT * FROM tblclients ORDER BY company ASC ")->result();

        $data['title'] = 'Sales Report';
        $this->load->view('admin/report/client_payment_report', $data);

    }


    public function main_report()
    {
        //check_permission('66,84,222','view');

        $data['service_type'] = 1;
        $data['type'] = 1;
        $data['min_balance'] = '';
        $data['max_balance'] = '';

         if(!empty($_POST)){
            extract($this->input->post());



            if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

               $data['f_date'] = db_date($f_date);
               $data['t_date'] = db_date($t_date);
            }


        }else{
             $data['client_list'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
        }

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
        $data['client_info'] = $this->db->query("SELECT * FROM tblclients ")->result();

        $data['title'] = 'Main Report';
        $this->load->view('admin/report/main_report', $data);

    }


    public function sub_report($service_type)
    {
        //check_permission('66,84,222','view');

        $data['service_type'] = $service_type;
        if(!empty($_GET)){
             extract($this->input->get());
             if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

               $data['f_date'] = db_date($f_date);
               $data['t_date'] = db_date($t_date);
            }
        }

         if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($client_branch)){
                $data['client_id'] = $client_id;
                $data['s_client_branch'] = $client_branch;
                $client_branch = implode(',', $client_branch);
                $data['client_list'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where userid IN (".$client_branch.") ")->result();
            }else{
                $data['client_list'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
            }

            if(!empty($service_type)){
                $data['service_type'] = $service_type;
            }

            if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

               $data['f_date'] = db_date($f_date);
               $data['t_date'] = db_date($t_date);
            }

        }else{
             $data['client_list'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
        }

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`client_id` from `tblclientbranch` where active = 1 ")->result();
        $data['client_info'] = $this->db->query("SELECT * FROM tblclients ")->result();

        $data['title'] = 'Sub Report';
        $this->load->view('admin/report/sub_report', $data);

    }

    public function get_group_persons() {

        if(!empty($_POST)){
            extract($this->input->post());
            $client_info = $this->db->query("SELECT * from tblclientbranch  where userid = '".$client_id."'  ")->row();
            $group_arr = explode(',', $client_info->staff_group);
            ?>
            <div class="row">

                <?php
                if(!empty($group_arr)){
                    foreach ($group_arr as $group_id) {
                        $staff_ids = value_by_id('tblstaffgroup',$group_id,'staff_id');
                        $staff_arr = explode(',', $staff_ids);
                        ?>
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3"><?php echo value_by_id('tblstaffgroup',$group_id,'name'); ?></h4>
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
                                    if(!empty($staff_arr)){
                                        $i = 1;
                                        foreach ($staff_arr as $staff_id) {

                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo get_employee_name($staff_id); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <?php
                    }
                }
                ?>




            </div>

            <?php

        }

    }


    public function running_clinets()
    {
        //check_permission('66,84,222','view');

        if(financial_year() == 1){
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        }else{
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".financial_year()."' ";
        }

        $client_ids = 0;
        $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
        if(!empty($invoice_client)){
            foreach ($invoice_client as $key => $value) {
                if($key == 0){
                    $client_ids = $value->clientid;
                }else{
                    $client_ids .= ','.$value->clientid;
                }
            }
        }


        $assigned_clients = get_staff_clients(get_staff_user_id());


        //Getting clients which are assigned to the users
        if(is_admin() == 0){
            $client_arr = explode(',', $client_ids);
            $client_ids = 0;
            $j = 0;
            if(!empty($client_arr)){
                foreach ($client_arr as $c_id_1) {

                    if(!empty($assigned_clients)){
                        foreach ($assigned_clients as $c_id_2) {
                            if($c_id_1 == $c_id_2){
                                $j++;
                                if($j == 0){
                                    $client_ids = $c_id_2;
                                }else{
                                    $client_ids .= ','.$c_id_2;
                                }
                            }
                        }
                    }

                }
            }


        }

        /*$where_status_1 = '';
        $where_status_2 = '';*/
        $where_status_1 = ' and other_collection = 0';
        $where_status_2 = ' and other_collection = 0';
        if(!empty($_POST)){
            extract($this->input->post());
            $data['from_page'] = $from_page;
            if($from_page == 1){
                if(!empty($status)){
                    $data['status_1'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_1 .= " and client_status IN (".$status_str.") ";
                }
            }elseif($from_page == 2){
                if(!empty($status)){
                    $data['status_2'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_2 .= " and client_status IN (".$status_str.") ";
                }
            }
        }

        $data['running_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$where_status_1." ")->result();
        $data['running_clinets_2'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$where_status_2." ")->result();

        $data['clinet_status'] = $this->db->query("SELECT * from `tblclientstatus` where status = 1 ORDER BY name ASC ")->result();
        $data['title'] = 'Running Clients List';
        $this->load->view('admin/report/running_clinets', $data);

    }

    public function underlimit_clients()
    {

        $where_status_1 = ' and other_collection = 0';
        $where_status_2 = ' and other_collection = 0';
        $where_status_3 = ' and other_collection = 0';

        //check_permission('66,84,222','view');

        if(financial_year() == 1){
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        }else{
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".financial_year()."' ";
        }

        $client_ids = 0;
        $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
        if(!empty($invoice_client)){
            foreach ($invoice_client as $key => $value) {
                if($key == 0){
                    $client_ids = $value->clientid;
                }else{
                    $client_ids .= ','.$value->clientid;
                }
            }
        }

        $sales_client_ids = 0;
        $sales_invoice = $this->db->query("SELECT clientid from `tblinvoices` where service_type = 2 and status != '5' group by clientid")->result();
        if(!empty($sales_invoice)){
            foreach ($sales_invoice as $key => $value) {
                if($key == 0){
                    $sales_client_ids = $value->clientid;
                }else{
                    $sales_client_ids .= ','.$value->clientid;
                }
            }
        }

        $assigned_clients = get_staff_clients(get_staff_user_id());


        //Getting clients which are assigned to the users
        if(is_admin() == 0){
            $client_arr = explode(',', $client_ids);
            $client_ids = 0;
            $j = 0;
            if(!empty($client_arr)){
                foreach ($client_arr as $c_id_1) {

                    if(!empty($assigned_clients)){
                        foreach ($assigned_clients as $c_id_2) {
                            if($c_id_1 == $c_id_2){
                                $j++;
                                if($j == 0){
                                    $client_ids = $c_id_2;
                                }else{
                                    $client_ids .= ','.$c_id_2;
                                }
                            }
                        }
                    }

                }
            }

            $client2_arr = explode(',', $sales_client_ids);
            $sales_client_ids = 0;
            $k = 0;
            if(!empty($client2_arr)){
                foreach ($client2_arr as $c_id_3) {

                     if(!empty($assigned_clients)){
                        foreach ($assigned_clients as $c_id_4) {
                            if($c_id_3 == $c_id_4){
                                $k++;
                                if($k == 0){
                                    $sales_client_ids = $c_id_4;
                                }else{
                                    $sales_client_ids .= ','.$c_id_4;
                                }
                            }
                        }

                    }
                }

            }


            $where_status_2 .= " and staff_group != '' ";

        }


        if(!empty($_POST)){
            extract($this->input->post());
            $data['from_page'] = $from_page;
            if($from_page == 1){
                if(!empty($status)){
                    $data['status_1'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_1 .= " and client_status IN (".$status_str.") ";
                }
            }elseif($from_page == 2){
                if(!empty($status)){
                    $data['status_2'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_2 .= " and client_status IN (".$status_str.") ";
                }
            }elseif($from_page == 3){
                if(!empty($status)){
                    $data['status_3'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_3 .= " and client_status IN (".$status_str.") ";
                }
            }
        }


        $data['running_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$where_status_1." ")->result();
        $data['closed_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid NOT IN (".$client_ids.") ".$where_status_2." ")->result();
        $data['sales_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$sales_client_ids.") ".$where_status_3." ")->result();

        $data['client_ids'] = $client_ids;
        $data['sales_client_ids'] = $sales_client_ids;

        $data['clinet_status'] = $this->db->query("SELECT * from `tblclientstatus` where status = 1 ORDER BY name ASC ")->result();
        $data['clientothercollection_data'] = $this->db->query("SELECT * from `tblclientothercollectionmaster` where status = 1 order by id desc  ")->result_array();

        /*echo $bal_amt = client_balance_amt(162,2);

        if(0.00 == 0 || $bal_amt <= 0.00 ){

            echo "in";
        }else{
            echo "out";
        }
        die;*/

        $data['title'] = 'Under Limit Clients';
        $this->load->view('admin/report/underlimit_clients', $data);

    }

    public function overlimit_clients()
    {
        //check_permission('66,84,222','view');

        if(financial_year() == 1){
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        }else{
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".financial_year()."' ";
        }

        $client_ids = 0;
        $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where." group by clientid")->result();
        if(!empty($invoice_client)){
            foreach ($invoice_client as $key => $value) {
                if($key == 0){
                    $client_ids = $value->clientid;
                }else{
                    $client_ids .= ','.$value->clientid;
                }
            }
        }

        $sales_client_ids = 0;
        $sales_invoice = $this->db->query("SELECT clientid from `tblinvoices` where service_type = 2 and status != '5' group by clientid")->result();
        if(!empty($sales_invoice)){
            foreach ($sales_invoice as $key => $value) {
                if($key == 0){
                    $sales_client_ids = $value->clientid;
                }else{
                    $sales_client_ids .= ','.$value->clientid;
                }
            }
        }

        //Getting clients which are assigned to the users
        if(is_admin() == 0){
            $client_arr = explode(',', $client_ids);
            $client_ids = 0;
            $j = 0;
            if(!empty($client_arr)){
                foreach ($client_arr as $c_id_1) {

                    if(!empty($assigned_clients)){
                        foreach ($assigned_clients as $c_id_2) {
                            if($c_id_1 == $c_id_2){
                                $j++;
                                if($j == 0){
                                    $client_ids = $c_id_2;
                                }else{
                                    $client_ids .= ','.$c_id_2;
                                }
                            }
                        }
                    }

                }
            }

            $client2_arr = explode(',', $sales_client_ids);
            $sales_client_ids = 0;
            $k = 0;
            if(!empty($client2_arr)){
                foreach ($client2_arr as $c_id_3) {

                     if(!empty($assigned_clients)){
                        foreach ($assigned_clients as $c_id_4) {
                            if($c_id_3 == $c_id_4){
                                $k++;
                                if($k == 0){
                                    $sales_client_ids = $c_id_4;
                                }else{
                                    $sales_client_ids .= ','.$c_id_4;
                                }
                            }
                        }

                    }
                }

            }

        }

        $data['running_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.")  ")->result();
        $data['closed_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid NOT IN (".$client_ids.")  ")->result();
        $data['sales_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$sales_client_ids.")  ")->result();

        $where_status_1 = '';
        $where_status_2 = '';
        $where_status_3 = '';
        if(!empty($_POST)){
            extract($this->input->post());
            $data['from_page'] = $from_page;
            if($from_page == 1){
                if(!empty($status)){
                    $data['status_1'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_1 .= " and client_status IN (".$status_str.") ";
                }
            }elseif($from_page == 2){
                if(!empty($status)){
                    $data['status_2'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_2 .= " and client_status IN (".$status_str.") ";
                }
            }elseif($from_page == 3){
                if(!empty($status)){
                    $data['status_3'] = $status;
                    $status_str = implode(',', $status);
                    $where_status_3 .= " and client_status IN (".$status_str.") ";
                }
            }
        }


        $data['running_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") ".$where_status_1." ")->result();
        $data['closed_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid NOT IN (".$client_ids.") ".$where_status_2." ")->result();
        $data['sales_clinets'] = $this->db->query("SELECT `client_status`,`staff_group`,`credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where userid IN (".$sales_client_ids.") ".$where_status_3." ")->result();

        $data['clinet_status'] = $this->db->query("SELECT * from `tblclientstatus` where status = 1  ")->result();
        $data['title'] = 'Over Limit Clients';
        $this->load->view('admin/report/overlimit_clients', $data);

    }

    public function collection_report()
    {
        check_permission('305','view');

        $data['service_type'] = 1;
        $data['type'] = 1;

        $where = 'status IN (0,1) ';
        $stype = ["CR", "CD", "SR"];
         if(!empty($_POST)){
            extract($this->input->post());


            if(!empty($f_date) && !empty($t_date)){
               $data['s_fdate'] = $f_date;
               $data['s_tdate'] = $t_date;

               $where .= " and date BETWEEN '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }

            if(!empty($bank_id) ){
                $data['bank_id'] = $bank_id;
                $where .= " and bank_id = '".$bank_id."' ";
            }
            if(!empty($type) ){
                $data['type'] = $type;
                if ($type == "SR"){
                    $where .= " and is_suspense_account = 1";
                }else if($type == "CR"){
                    $where .= " and is_suspense_account = 0";
                }
                $stype = [$type];
            }
            if(isset($status) ){
                $data['status'] = $status;
                $where .= " and status = '".$status."' ";
            }

        }else{
            $where .= " and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ";
        }
        if (in_array("CR", $stype) OR in_array("SR", $stype)){
            $data['collection_list'] = $this->db->query("SELECT * from `tblclientpayment` where ".$where." order by date desc ")->result();
        }
        if (in_array("CD", $stype)){
            $data['clientdeposit_list'] = $this->db->query("SELECT * from `tblclientdeposits` where ".$where." order by date desc ")->result();
        }


       // $data['collection_amount'] = $this->db->query("SELECT COALESCE(SUM(ttl_amt),0) as amt from `tblclientpayment` where ".$where." ")->row()->amt;
        $collection_amount = 0;
        $row_count = 0;
        if (in_array("CR", $stype) OR in_array("SR", $stype)){
            $collection_amount_info = $this->db->query("SELECT * from `tblclientpayment` where ".$where." ")->result();
            if(!empty($collection_amount_info)){
                foreach ($collection_amount_info as $r) {
                    $to_see = ($r->payment_mode == 1 && $r->chaque_status != 1) ? '0' : '1';
                    if($to_see == 1){
                        $collection_amount += $r->ttl_amt;
                        $row_count++;
                    }
                }
            }
        }

        if (in_array("CD", $stype)){
            $collection_amount_data = $this->db->query("SELECT * from `tblclientdeposits` where ".$where." ")->result();
            if(!empty($collection_amount_data)){
                foreach ($collection_amount_data as $r1) {
                    $collection_amount += $r1->ttl_amt;
                    $row_count++;
                }
            }
        }

        $data['collection_amount'] = $collection_amount;
        $data['row_count'] = $row_count;

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' ")->result();

        $data['title'] = 'Collection Report';
        $this->load->view('admin/report/collection_report', $data);
    }


    public function client_credit_limit()
    {
        check_permission(306,'view');
        if(!empty($_POST)){
            extract($this->input->post());
            if ($this->home_model->update('tblclientbranch',array('credit_limit'=>$credit_limit),array('userid'=>$client_id))) {

                set_alert('success', 'Credit Limit set successfully');
                redirect(admin_url('report/client_credit_limit'));
            }
        }

        $data['clientLimitNotSet'] = $this->db->query("SELECT `credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where credit_limit = 0  ")->result();
        $data['clientLimitSet'] = $this->db->query("SELECT `credit_limit`,`client_branch_name`,`userid` from `tblclientbranch` where credit_limit > 0  ")->result();


        $data['title'] = 'Clients Limit';
        $this->load->view('admin/report/client_credit_limit', $data);

    }

    public function update_bank_id()
    {
        $client_payment = $this->db->query("SELECT * from `tblclientpayment` where status = 1  ")->result();
        if(!empty($client_payment)){
            foreach ($client_payment as $row) {

                $bank_info = $this->db->query("SELECT `bank_id` from `tblinvoicepaymentrecords` where pay_id = '".$row->id."' and bank_id > 0 ")->row();

                if(!empty($bank_info)){
                    $bank_id = $bank_info->bank_id;
                    $this->home_model->update('tblclientpayment',array('bank_id'=>$bank_id),array('id'=>$row->id));
                }

            }
        }

    }

    public function change_running_client_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());

            $last_status_name = value_by_id('tblclientstatus',$last_status,'name');
            $new_status_name = value_by_id('tblclientstatus',$status,'name');

            $message = 'Client status changed from '.$last_status_name.' to '.$new_status_name.' dated on '.date('d/m/Y H:i A');
            $ad_data = array(
                'client_id' => $id,
                'message' => $message,
                'staffid' => get_staff_user_id(),
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'priority' => 0,
                'status' => 1
            );

            $this->home_model->insert('tblfollowupclientactivity',$ad_data);

            $this->home_model->update('tblclientbranch',array('client_status'=>$status),array('userid'=>$id));

        }
    }

    public function change_closed_client_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());

            $last_status_name = value_by_id('tblclientstatus',$last_status,'name');
            $new_status_name = value_by_id('tblclientstatus',$status,'name');

            $message = 'Client status changed from '.$last_status_name.' to '.$new_status_name.' dated on '.date('d/m/Y H:i A');
            $ad_data = array(
                'client_id' => $id,
                'message' => $message,
                'staffid' => get_staff_user_id(),
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'priority' => 0,
                'status' => 1
            );

            $this->home_model->insert('tblfollowupclientactivity',$ad_data);

            $this->home_model->update('tblclientbranch',array('client_status'=>$status),array('userid'=>$id));


        }
    }

    public function change_sales_client_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());

            $last_status_name = value_by_id('tblclientstatus',$last_status,'name');
            $new_status_name = value_by_id('tblclientstatus',$status,'name');

            $message = 'Client status changed from '.$last_status_name.' to '.$new_status_name.' dated on '.date('d/m/Y H:i A');
            $ad_data = array(
                'client_id' => $id,
                'message' => $message,
                'staffid' => get_staff_user_id(),
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'priority' => 0,
                'status' => 1
            );

            $this->home_model->insert('tblfollowupclientactivity',$ad_data);

            $this->home_model->update('tblclientbranch',array('client_status'=>$status),array('userid'=>$id));


        }
    }

    public function change_othercollection_status($id,$status)
    {
        if(!empty($id)){
        	 $this->home_model->update('tblclientbranch',array('other_collection'=>$status, 'other_collection_added_by'=> get_staff_user_id(), 'other_collection_added_date'=>date("Y-m-d H:i:s")),array('userid'=>$id));
        	 set_alert('success', 'Client status changed successfully');
             redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function other_collection_clients()
    {
        check_permission(314,'view');
        if(!empty($_POST)){
            extract($this->input->post());
            if ($this->home_model->update('tblclientbranch',array('credit_limit'=>$credit_limit),array('userid'=>$client_id))) {

                set_alert('success', 'Credit Limit set successfully');
                redirect(admin_url('report/client_credit_limit'));
            }
        }

        $data['client_list'] = $this->db->query("SELECT * from `tblclientbranch` where other_collection > 0 and active = 1 ")->result();
        $data['clinet_status'] = $this->db->query("SELECT * from `tblclientstatus` where status = 1  ")->result();

        $data['title'] = 'Other Collection Client Report';
        $this->load->view('admin/report/other_collection_clients', $data);

    }

    public function clientothercollection_view() {
        check_permission(314,'view');
        $data['othercollection_data'] = $this->db->query("SELECT * FROM `tblclientothercollectionmaster` order by id desc ")->result();

        $data['title'] = 'Client Other Collection Master';
        $this->load->view('admin/report/clientothercollection_view', $data);
    }

    public function client_othercollection($id = '') {
        if ($this->input->post()) {
            extract($this->input->post());
            if ($id == '') {

                $ad_data = array(
                    'added_by' => get_staff_user_id(),
                    'name' => $name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => $status
                );

                $id = $this->home_model->insert('tblclientothercollectionmaster', $ad_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Client Other Collection'));
                    redirect(admin_url('report/clientothercollection_view'));
                }
            } else {
                $ad_data = array(
                            'name' => $name,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'status' => $status
                        );

                $update = $this->home_model->update('tblclientothercollectionmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', _l('updated_successfully', 'Client Other Collection'));
                }

                redirect(admin_url('report/clientothercollection_view'));
            }
        }

        if ($id == '') {
            check_permission(314,'create');
            $title = 'Add Client Other Collection Master';
        } else {
            check_permission(314,'edit');
            $data['other_collection'] = $this->db->query("SELECT * FROM `tblclientothercollectionmaster` Where id = '".$id."' ")->row_array();
            $title = 'Edit Client Other Collection Master';
        }

        $data['title'] = $title;
        $this->load->view('admin/report/client_othercollection', $data);
    }

    public function delete_client_othercollection($id) {
        check_permission(314,'delete');
        $query = $this->db->query("SELECT * FROM `tblclientbranch` Where other_collection = '".$id."' ");
        if($query)
        {
            set_alert('warning', 'This Collection Name In Used');
            redirect(admin_url('report/clientothercollection_view'));
        }
        else
        {
            $response = $this->home_model->delete('tblclientothercollectionmaster', array('id'=>$id));
            if ($response == true) {
                set_alert('success', 'Client Other Collection Deleted Successfully');
                redirect(admin_url('report/clientothercollection_view'));
            } else {
                set_alert('warning', 'problem_deleting');
                redirect(admin_url('report/clientothercollection_view'));
            }
        }

    }

    public function update_other_collection()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            if ($this->home_model->update('tblclientbranch',array('other_collection'=>$clientothercollection_id, 'other_collection_added_by'=> get_staff_user_id(), 'other_collection_added_date'=>date("Y-m-d H:i:s")),array('userid'=>$collection_id))) {

                set_alert('success', 'Client Other Collection set successfully');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

    public function get_collection_modal() {

        if(!empty($_POST)){
            extract($this->input->post());
            $client_info = $this->db->query("SELECT * from tblclientbranch  where userid = '".$Id."'  ")->row();
            $clientothercollection_data = $this->db->query("SELECT * from `tblclientothercollectionmaster` where status = 1 order by id desc  ")->result_array();
            ?>

            <div class="row">
            <form action="<?php echo admin_url('report/update_other_collection'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-6">
                <label class="control-label">Client Other Collection</label>
                <select class="form-control" id="clientothercollection_id" name="clientothercollection_id" data-live-search="true">
                    <option value="0"> --Remove from Other Collection-- </option>
                    <?php
                    if (isset($clientothercollection_data) && count($clientothercollection_data) > 0) {
                        foreach ($clientothercollection_data as $client_key => $client_value) {
                            ?>
                            <option value="<?php echo $client_value['id'] ?>" <?php if(!empty($client_info->other_collection) && $client_info->other_collection == $client_value['id']){ echo 'selected';} ?>><?php echo cc($client_value['name']); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" id="collection_id" value="<?php echo $Id; ?>" name="collection_id">

            <div style="float: right;" class="col-md-6">
                <button style="margin-top: 27px;" type="submit" class="btn btn-info">Submit</button>
            </div>
            </form>
        </div>

            <?php

        }

    }

     /* this function use for get approval status */
    public function get_status() {

        if(!empty($_POST)){
            extract($this->input->post());

            if($type == "CR"){
                $assign_info = $this->db->query("SELECT * from tblclientreceiptapproval  where clientpayment_id = '".$id."' ")->result();
            }else{
                $assign_info = $this->db->query("SELECT * from tblclientdepositsapproval  where clientdeposits_id = '".$id."' ")->result();
            }


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

    /* this function use for client tax report */
    public function clienttax_report(){
        check_permission(28,'view');
        $data["title"] = "Client Tax Report";
        $types = ["RI", "SI", "DN", "DNP", "CN"];
        $where = $iwhere = $dwhere = $dpwhere = "in.id > 0";
        if (!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){
               $data['fdate'] = $f_date;
               $data['tdate'] = $t_date;

               $where .= " and in.date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
               $iwhere .= " and in.invoice_date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
               $dwhere .= " and in.dabit_note_date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
               $dpwhere .= " and in.date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            if(!empty($type)){
                $data['type'] = $type;
                $types = $type;
            }

            if (!empty($branch_state)){
                $data['branch_state'] = $branch_state;
                $where .= " and cb.state IN (".implode(',', $branch_state).") ";
                $iwhere .= " and cb.state IN (".implode(',', $branch_state).") ";
                $dwhere .= " and cb.state IN (".implode(',', $branch_state).") ";
                $dpwhere .= " and cb.state IN (".implode(',', $branch_state).") ";
            }

            if (!empty($client)){
                $data['clientid'] = $client;
                $where .= " and in.clientid IN (".implode(',', $client).") ";
                $iwhere .= " and in.clientid IN (".implode(',', $client).") ";
                $dwhere .= " and in.clientid IN (".implode(',', $client).") ";
                $dpwhere .= " and in.clientid IN (".implode(',', $client).") ";
            }

            if (!empty($gstr1_month) && (!empty($year))){
                $data["gstr1_month"] = $gstr1_month;
                $data["year"] = $year;
            }
            if (!empty($gstr3b_month) && (!empty($year))){
                $data["gstr3b_month"] = $gstr3b_month;
                $data["year"] = $year;
            }
            if (!empty($tally_month) && (!empty($year))){
                $data["tally_month"] = $tally_month;
                $data["year"] = $year;
            }

        }
        else{
            $where .= " and YEAR(date) = '".date('Y')."' AND MONTH(date) = '".date('m')."' ";
            $dpwhere .= " and YEAR(date) = '".date('Y')."' AND MONTH(date) = '".date('m')."' ";
            $iwhere .= " and YEAR(in.invoice_date) = '".date('Y')."' AND MONTH(in.invoice_date) = '".date('m')."' ";
            $dwhere .= " and YEAR(dabit_note_date) = '".date('Y')."' AND MONTH(dabit_note_date) = '".date('m')."' ";
        }

        $data['clienttax_report'] = array();

        $data["total_taxable_value"] = $data["totalsgst"] = $data["totalcgst"] = $data["totaligst"] = $data["total_amt"] = 0;
        /* this is for get invoice data */
        $invoice_data = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblinvoices` as `in` LEFT JOIN `tblcompanybranch` as `cb` ON `in`.`billing_branch_id` = `cb`.`id` WHERE ".$iwhere." and in.status != 5 ORDER BY in.id DESC ")->result();
        if (!empty($invoice_data)){
            foreach ($invoice_data as $value) {
                $type = ($value->service_type == 2) ? "Sales Invoice" : "Rent Invoice";
                $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
                $taxable_value = ($value->total-$value->total_tax);

                $tax = ($value->total_tax/2);
                $sgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst = ($value->tax_type == 1) ? 0.00 : $value->total_tax;

                $tally = $gstr1 = $gstr3b = "--";
                $vtally = $vgstr1 = $vgstr3b = "--";
                $clienttaxstatus = $this->db->query("SELECT `year`,`month`,`gst_typ`,`approve_status` FROM `tblclienttaxstatus` as ct JOIN `tblclienttaxstatusdetails` as ctd ON `ct`.`id` = `ctd`.`main_id` WHERE `tabel_type` = 1 AND `document_id` = ".$value->id."")->result();
                if (!empty($clienttaxstatus)){
                    foreach ($clienttaxstatus as $val) {

                        $status = ($val->approve_status == 1) ? "text-success" : "text-warning";
                        $gsttyp_arr = explode(",", $val->gst_typ);
                        if (in_array(3, $gsttyp_arr)){
                            $vtally = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $tally = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(1, $gsttyp_arr)){
                            $vgstr1 = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr1 = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(2, $gsttyp_arr)){
                            $vgstr3b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr3b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                    }
                }

                $clienttax_report = array(
                    "id" => $value->id,
                    "branch_state_id" => $value->branch_state,
                    "branch_gst_no" => $value->branch_gst_no,
                    "type" => $type,
                    "rtype" => 1,
                    "client_id" => $value->clientid,
                    "client_name" => $client_info->client_branch_name,
                    "client_gst_number" => $client_info->vat,
                    "invoice_number" => format_invoice_number($value->id),
                    "invoice_date" => _d($value->invoice_date),
                    "total_invoice_value" => $value->total,
                    "total_taxable_value" => $taxable_value,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "igst" => $igst,
                    "crm" => date("M-Y", strtotime($value->invoice_date)),
                    "gstr1" => $gstr1,
                    "gstr3b" => $gstr3b,
                    "tally" => $tally,
                );


                $see = "No";
                if (in_array("RI", $types) && $value->service_type == 1){
                    $see = "Yes";
                }else if(in_array("SI", $types) && $value->service_type == 2){
                    $see = "Yes";
                }

                /* this function use for filter record according to gst */
                $view = $this->gstReportFilter($see, $vgstr1, $vgstr3b, $vtally);
                if ($view === "Yes"){
                    $data["total_taxable_value"] += $taxable_value;
                    $data["totalsgst"] += $sgst;
                    $data["totalcgst"] += $cgst;
                    $data["totaligst"] += $igst;
                    $data["total_amt"] += $value->total;
                    $data['clienttax_report'][] = $clienttax_report;
                }
            }
        }

        /* this is for get debitnote data */
        $debitnote_data = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tbldebitnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE ".$dwhere." and in.status = 1  ORDER BY in.id DESC ")->result();
        if (!empty($debitnote_data)){
            foreach ($debitnote_data as $value) {
                $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
                $taxable_value = ($value->totalamount-$value->total_tax);
                //$tax_type = get_client_gst_type($value->clientid);

                $tax = ($value->total_tax/2);
                $sgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst = ($value->tax_type == 1) ? 0.00 : $value->total_tax;

                $tally = $gstr1 = $gstr3b = "--";
                $vtally = $vgstr1 = $vgstr3b = "--";
                $clienttaxstatus = $this->db->query("SELECT `year`,`month`,`gst_typ`,`approve_status` FROM `tblclienttaxstatus` as ct JOIN `tblclienttaxstatusdetails` as ctd ON `ct`.`id` = `ctd`.`main_id` WHERE `tabel_type` = 2 AND `document_id` = ".$value->id."")->result();

                if (!empty($clienttaxstatus)){
                    foreach ($clienttaxstatus as $val) {
                        $status = ($val->approve_status == 1) ? "text-success" : "text-warning";
                        $gsttyp_arr = explode(",", $val->gst_typ);
                        if (in_array(3, $gsttyp_arr)){
                            $vtally = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $tally = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(1, $gsttyp_arr)){
                            $vgstr1 = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr1 = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(2, $gsttyp_arr)){
                            $vgstr3b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr3b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                    }
                }

                $clienttax_report = array(
                    "id" => $value->id,
                    "branch_state_id" => $value->branch_state,
                    "branch_gst_no" => $value->branch_gst_no,
                    "type" => "DN (Damage)",
                    "rtype" => 2,
                    "client_id" => $value->clientid,
                    "client_name" => $client_info->client_branch_name,
                    "client_gst_number" => $client_info->vat,
                    "invoice_number" => $value->number,
                    "invoice_date" => _d($value->dabit_note_date),
                    "total_invoice_value" => $value->totalamount,
                    "total_taxable_value" => $taxable_value,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "igst" => $igst,
                    "crm" => date("M-Y", strtotime($value->dabit_note_date)),
                    "gstr1" => $gstr1,
                    "gstr3b" => $gstr3b,
                    "tally" => $tally,
                );

                $see = (in_array("DN", $types)) ? "Yes": "No";

                /* this function use for filter record according to gst */
                $view = $this->gstReportFilter($see, $vgstr1, $vgstr3b, $vtally);
                if ($view == "Yes"){
                    $data["total_taxable_value"] += $taxable_value;
                    $data["totalsgst"] += $sgst;
                    $data["totalcgst"] += $cgst;
                    $data["totaligst"] += $igst;
                    $data["total_amt"] += $value->totalamount;
                    $data['clienttax_report'][] = $clienttax_report;
                }
            }
        }

        /* this is for get debitnote payment data */
        $debitpayment_data = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tbldebitnotepayment` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE ".$dpwhere." ORDER BY in.id DESC ")->result();
        if (!empty($debitpayment_data)){
            foreach ($debitpayment_data as $value) {
                $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
                $taxable_value = ($value->amount-$value->total_tax);
//                $tax_type = get_client_gst_type($value->clientid);

                $tax = ($value->total_tax/2);
                $sgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst = ($value->tax_type == 1) ? 0.00 : $value->total_tax;

                $tally = $gstr1 = $gstr3b = "--";
                $vtally = $vgstr1 = $vgstr3b = "--";
                $clienttaxstatus = $this->db->query("SELECT `year`,`month`,`gst_typ`,`approve_status` FROM `tblclienttaxstatus` as ct JOIN `tblclienttaxstatusdetails` as ctd ON `ct`.`id` = `ctd`.`main_id` WHERE `tabel_type` = 3 AND `document_id` = ".$value->id."")->result();

                if (!empty($clienttaxstatus)){
                    foreach ($clienttaxstatus as $val) {
                        $status = ($val->approve_status == 1) ? "text-success" : "text-warning";
                        $gsttyp_arr = explode(",", $val->gst_typ);
                        if (in_array(3, $gsttyp_arr)){
                            $vtally = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $tally = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(1, $gsttyp_arr)){
                            $vgstr1 = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr1 = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(2, $gsttyp_arr)){
                            $vgstr3b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr3b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                    }
                }

                $clienttax_report = array(
                    "id" => $value->id,
                    "branch_state_id" => $value->branch_state,
                    "branch_gst_no" => $value->branch_gst_no,
                    "type" => "DN (Delay In Payment)",
                    "rtype" => 3,
                    "client_id" => $value->clientid,
                    "client_name" => $client_info->client_branch_name,
                    "client_gst_number" => $client_info->vat,
                    "invoice_number" => $value->number,
                    "invoice_date" => _d($value->date),
                    "total_invoice_value" => $value->amount,
                    "total_taxable_value" => $taxable_value,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "igst" => $igst,
                    "crm" => date("M-Y", strtotime($value->date)),
                    "gstr1" => $gstr1,
                    "gstr3b" => $gstr3b,
                    "tally" => $tally,
                );

                $see = (in_array("DNP", $types)) ? "Yes": "No";
                /* this function use for filter record according to gst */
                $view = $this->gstReportFilter($see, $vgstr1, $vgstr3b, $vtally);

                if ($view == "Yes"){
                    $data["total_taxable_value"] += $taxable_value;
                    $data["totalsgst"] += $sgst;
                    $data["totalcgst"] += $cgst;
                    $data["totaligst"] += $igst;
                    $data["total_amt"] += $value->amount;
                    $data['clienttax_report'][] = $clienttax_report;
                }
            }
        }

        /* this is for get creditnote data */
        $creditnote_data = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblcreditnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE ".$where." ORDER BY in.id DESC ")->result();
        if (!empty($creditnote_data)){
            foreach ($creditnote_data as $value) {
                $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
                $taxable_value = ($value->totalamount-$value->total_tax);
                //$tax_type = get_client_gst_type($value->clientid);

                $tax = ($value->total_tax/2);
                $sgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst = ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst = ($value->tax_type == 1) ? 0.00 : $value->total_tax;

                $tally = $gstr1 = $gstr3b = "--";
                $vtally = $vgstr1 = $vgstr3b = "--";
                $clienttaxstatus = $this->db->query("SELECT `year`,`month`,`gst_typ`,`approve_status` FROM `tblclienttaxstatus` as ct JOIN `tblclienttaxstatusdetails` as ctd ON `ct`.`id` = `ctd`.`main_id` WHERE `tabel_type` = 4 AND `document_id` = ".$value->id."")->result();

                if (!empty($clienttaxstatus)){
                    foreach ($clienttaxstatus as $val) {
                        $status = ($val->approve_status == 1) ? "text-success" : "text-warning";
                        $gsttyp_arr = explode(",", $val->gst_typ);
                        if (in_array(3, $gsttyp_arr)){
                            $vtally = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $tally = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(1, $gsttyp_arr)){
                            $vgstr1 = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr1 = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                        if (in_array(2, $gsttyp_arr)){
                            $vgstr3b = date("M-Y", strtotime($val->year."-".$val->month."-01"));
                            $gstr3b = "<p class='".$status."'>".date("M-Y", strtotime($val->year."-".$val->month."-01"))."</p>";
                        }
                    }
                }

                $clienttax_report = array(
                    "id" => $value->id,
                    "branch_state_id" => $value->branch_state,
                    "branch_gst_no" => $value->branch_gst_no,
                    "type" => "CN",
                    "rtype" => 4,
                    "client_id" => $value->clientid,
                    "client_name" => $client_info->client_branch_name,
                    "client_gst_number" => $client_info->vat,
                    "invoice_number" => $value->number,
                    "invoice_date" => _d($value->date),
                    "total_invoice_value" => $value->totalamount,
                    "total_taxable_value" => $taxable_value,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "igst" => $igst,
                    "crm" => date("M-Y", strtotime($value->date)),
                    "gstr1" => $gstr1,
                    "gstr3b" => $gstr3b,
                    "tally" => $tally,
                );

                $see = (in_array("CN", $types)) ? "Yes": "No";
                /* this function use for filter record according to gst */
                $view = $this->gstReportFilter($see, $vgstr1, $vgstr3b, $vtally);

                if ($view == "Yes"){
                    $data["total_taxable_value"] -= $taxable_value;
                    $data["totalsgst"] -= $sgst;
                    $data["totalcgst"] -= $cgst;
                    $data["totaligst"] -= $igst;
                    $data["total_amt"] -= $value->totalamount;
                    $data['clienttax_report'][] = $clienttax_report;
                }
            }
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
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

        $state_data = $this->db->query("SELECT GROUP_CONCAT(state) as stateids FROM  tblcompanybranch WHERE status = 1")->row();
        $state_ids = (!empty($state_data) && !empty($state_data->stateids)) ? $state_data->stateids : 0;
        $data["state_list"] = $this->db->query("SELECT * FROM tblstates WHERE id IN (".$state_ids.") and status = 1 ORDER BY id DESC")->result();
        $data["client_list"] = $this->home_model->get_result('tblclientbranch', array('active'=>1,'client_branch_name!='=> ''), '', array('client_branch_name', 'asc'));
        $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        $this->load->view('admin/report/clienttax_report', $data);
    }

    public function gstReportFilter($see, $vgstr1, $vgstr3b, $vtally){
        extract($this->input->post());
        $view = $see;
        $gstr1_date = $gstr3b_date = $tally_date = array();
        if ($see == "Yes" && (!empty($year)) && (!empty($gstr1_month) OR !empty($gstr3b_month) OR !empty($tally_month))){

            if (!empty($gstr1_month)){
                foreach ($gstr1_month as $gstr1d) {
                    $dmonth = date("M-Y", strtotime($year."-".$gstr1d."-01"));
                    array_push($gstr1_date, $dmonth);
                }
            }
            if (!empty($gstr3b_month)){
                foreach ($gstr3b_month as $gstr3bd) {
                    $dmonth = date("M-Y", strtotime($year."-".$gstr3bd."-01"));
                    array_push($gstr3b_date, $dmonth);
                }
            }
            if (!empty($tally_month)){
                foreach ($tally_month as $tallyd) {
                    $dmonth = date("M-Y", strtotime($year."-".$tallyd."-01"));
                    array_push($tally_date, $dmonth);
                }
            }

            if (!empty($gstr1_month) && !empty($gstr3b_month) && !empty($tally_month)){
                if(in_array("notset", $gstr1_month) && in_array("notset", $gstr3b_month) && in_array("notset", $tally_month)){
                    $view = ($vgstr1 == "--" && $vgstr3b == "--" && $vtally == "--") ? "Yes" : "No";
                }elseif (!empty($gstr1_month) && !empty($gstr3b_month) && !empty($tally_month)) {
                    if ($vgstr1 != "--" && $vgstr3b != "--" && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr1, $gstr1_date) && in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }elseif ($vgstr1 != "--" && in_array("notset", $gstr3b_month) && $vtally != "--"){
                        $view = (in_array($vgstr1, $gstr1_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr1_month) && $vgstr3b != "--" && $vtally != "--"){
                        $view = (in_array($vgstr3b, $gstr3b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr1_month) && $vgstr3b != "--" && $vtally != "--"){
                        $view = (in_array($vgstr3b, $gstr3b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif($vgstr1 != "--" && in_array("notset", $gstr3b_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr1, $gstr1_date) && $vgstr3b == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif($vgstr3b != "--" && in_array("notset", $gstr1_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr3b, $gstr3b_date) && $vgstr1 == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif(in_array("notset", $gstr1_month) && in_array("notset", $gstr3b_month) && $vtally != "--"){
                        $view = (in_array($vtally, $tally_date) && $vgstr1 == "--" && $vgstr3b == "--") ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }
            }else{
                if (!empty($gstr1_month) && empty($gstr3b_month) && empty($tally_month)) {
                    if (in_array("notset", $gstr1_month)){
                        $view = ($vgstr1 == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr1_month) && $vgstr1 != "--"){
                        $view = (in_array($vgstr1, $gstr1_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (!empty($gstr3b_month) && empty($gstr1_month) && empty($tally_month)) {
                    if (in_array("notset", $gstr3b_month)){
                        $view = ($vgstr3b == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr3b_month) && $vgstr3b != "--"){
                        $view = (in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (empty($gstr3b_month) && empty($gstr1_month) && !empty($tally_month)) {
                    if (in_array("notset", $tally_month)){
                        $view = ($vtally == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $tally_month) && $vtally != "--"){
                        $view = (in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (!empty($gstr1_month) && !empty($gstr3b_month) && empty($tally_month)) {
                    if (in_array("notset", $gstr1_month) && in_array("notset", $gstr3b_month)){
                        $view = ($vgstr1 == "--" && $vgstr3b == "--") ? "Yes" : "No";
                    }elseif (!empty($gstr1_month) && in_array("notset", $gstr3b_month)){
                        $view = (in_array($vgstr1, $gstr1_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr1_month) && !empty($gstr3b_month)){
                        $view = (in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr1_month) && in_array("notset", $gstr3b_month)){
                        $view = ($vgstr1 == "--" && $vgstr3b == "--") ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr1_month) && !in_array("notset", $gstr3b_month)){
                        $view = (in_array($vgstr1, $gstr1_date) && in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (!empty($gstr1_month) && empty($gstr3b_month) && !empty($tally_month)) {
                    if (in_array("notset", $gstr1_month) && in_array("notset", $tally_month)){
                        $view = ($vgstr1 == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif (!empty($gstr1_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr1, $gstr1_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr1_month) && !empty($tally_month)){
                        $view = (in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr1_month) && !in_array("notset", $tally_month)){
                        $view = (in_array($vgstr1, $gstr1_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }elseif (empty($gstr1_month) && !empty($gstr3b_month) && !empty($tally_month)) {
                    if (in_array("notset", $gstr3b_month) && in_array("notset", $tally_month)){
                        $view = ($vgstr3b == "--" && $vtally == "--") ? "Yes" : "No";
                    }elseif (!empty($gstr3b_month) && in_array("notset", $tally_month)){
                        $view = (in_array($vgstr3b, $gstr3b_date)) ? "Yes" : "No";
                    }elseif (in_array("notset", $gstr3b_month) && !empty($tally_month)){
                        $view = (in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }elseif(!in_array("notset", $gstr3b_month) && !in_array("notset", $tally_month)){
                        $view = (in_array($vgstr3b, $gstr3b_date) && in_array($vtally, $tally_date)) ? "Yes" : "No";
                    }else{
                        $view = "No";
                    }
                }
            }
        }
        return $view;
    }

    public function addclienttax(){
        if (!empty($_POST)){

            extract($this->input->post());
            $document_ids = explode(",", $document_id);
            $document_types = explode(",", $document_type);
            if (!empty($document_ids)){
                foreach ($gsttype as $gsttype_id) {
                    foreach ($document_ids as $key => $doc_id) {
                        $dtype = $document_types[$key];
                        $cdetails = $this->db->query("SELECT cd.main_id, ct.id, ct.gst_typ FROM `tblclienttaxstatusdetails` as cd LEFT JOIN `tblclienttaxstatus` as ct ON cd.main_id = ct.id WHERE ct.gst_typ IN (" . $gsttype_id . ") AND cd.tabel_type = '" . $dtype . "' AND cd.document_id = " . $doc_id . "")->row();

                        if (!empty($cdetails)) {
                            $gst_arr = explode(",", $cdetails->gst_typ);
                            if (count($gst_arr) == 1){
                                $this->home_model->delete("tblclienttaxstatusdetails", array("main_id" => $cdetails->main_id));
                                $this->home_model->delete("tblclienttaxstatusapproval", array("clienttax_id" => $cdetails->main_id));
                                $this->home_model->delete("tblmasterapproval", array("module_id" => 27, "table_id" => $cdetails->main_id));
//                                $this->home_model->delete("tblclienttaxstatus", array("id" => $cdetails->main_id, "gst_typ IN" => "(".$gsttype_id.")"));
                                $this->db->where_in("gst_typ", array($gsttype_id));
                                $this->db->delete("tblclienttaxstatus");
                            }else{
                                $gsttype_val = array_values(array_diff($gst_arr, array($gsttype_id)));
                                $this->home_model->update("tblclienttaxstatus", array("gst_typ" => implode(",", $gsttype_val)), array("id" => $cdetails->main_id));
                            }

                        }
                    }
                }

            }

            $staff_id = array();
            foreach ($assignid as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
                if (strpos($single_staff, 'group') !== false) {
                    $single_staff = str_replace("group", "", $single_staff);
                    $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                    foreach ($staffgroup as $singlestaff) {
                        $staff_id[] = $singlestaff['staff_id'];
                    }
                }
            }
            $staff_id = array_unique($staff_id);
            $gsttype = implode(",", $gsttype);

            $insertdata["gst_typ"] = $gsttype;
            $insertdata["year"] = $year;
            $insertdata["month"] = $month;
            $insertdata["approve_status"] = 0;
            $insertdata["created_at"] = date("Y-m-d H:i:s");

            $insert_id = $this->home_model->insert("tblclienttaxstatus", $insertdata);
            if ($insert_id){
                $document_ids = explode(",", $document_id);
                $document_types = explode(",", $document_type);
                if (!empty($document_ids)){
                    foreach ($document_ids as $key => $doc_id) {
                        $dtype = $document_types[$key];

                        $details = array(
                            "main_id" => $insert_id,
                            "tabel_type" => $dtype,
                            "document_id" => $doc_id,
                        );

                        $this->home_model->insert("tblclienttaxstatusdetails", $details);
                    }
                }

                if(!empty($staff_id)){

                    foreach ($staff_id as $staffid) {
                        $sdata['staffid'] = $staffid;
                        $sdata['clienttax_id'] = $insert_id;
                        $sdata['status'] = '1';
                        $sdata['created_at'] = date("Y-m-d H:i:s");
                        $sdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblclienttaxstatusapproval', $sdata);

                        $adata = array(
                            'staff_id' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'module_id' => 27,
                            'table_id' => $insert_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description' => 'Client Tax Status approval assign you',
                            'link' => 'report/clienttaxstatus_approval/'.$insert_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);
                    }
                }

                set_alert('success', 'Client tax status add successfully');
                redirect(admin_url('report/clienttax_report'));
            }else{
                set_alert('warning', 'Somthing went wrong');
                redirect(admin_url('report/clienttax_report'));
            }
        }
    }

    /* this function use for clienttaxstatus approval */
    public function clienttaxstatus_approval($id){

        if (!empty($_POST)){
            extract($this->input->post());

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),27,$id,1);
            update_masterapproval_all(27,$id,1);

            $ad_data = array(
                'approvereason' => $approval_remark,
                'approve_status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $update = $this->home_model->update('tblclienttaxstatusapproval', $ad_data,array('clienttax_id'=>$id,'staffid'=>get_staff_user_id()));
            if($update){

                $udata = array(
                    'approve_status' => 1,
                );
                $this->home_model->update('tblclienttaxstatus', $udata,array('id'=>$id));

                /* this is for delete old data */
                $this->home_model->delete("tblclienttaxstatusdetails", array("main_id" => $id));
                if ($details) {
                    foreach ($details as $value) {
                        if (isset($value["checked"])) {
                            $details = array(
                                "main_id" => $id,
                                "tabel_type" => $value['document_type'],
                                "document_id" => $value['document_id'],
                            );

                            $this->home_model->insert("tblclienttaxstatusdetails", $details);
                        }
                    }
                }
                set_alert('success', 'Client tax status approved succcessfully');
                redirect(admin_url('approval/notifications'));
            }else{
                set_alert('warning', 'Somthing went wrong');
                redirect(admin_url('approval/notifications'));
            }
        }
        $data["title"] = "Client Tax Status Approval";
        $data["clienttax_info"] = $this->db->query("SELECT * FROM `tblclienttaxstatus` WHERE `id` = ".$id."")->row();
        $data["clienttax_details"] = $this->db->query("SELECT * FROM `tblclienttaxstatusdetails` WHERE `main_id` = ".$id."")->result();
        $this->load->view('admin/report/clienttax_approval', $data);
    }

    /* this function use for GST Output Reconciliation */
    public function gst_output_reconciliation(){
        check_permission(348,'view');
        $data["title"] = "GST Output Reconciliation";

        if ($_POST){
            extract($this->input->post());
            $data["from"] = $from;
            $data["to"] = $to;
        }
        $data["gst_output"] = array();
        $month_arr = array(4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3);
        foreach ($month_arr as $key => $month) {
            $year_id = financial_year();
            $from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
            $year = ($month < 4) ? date("Y", strtotime($from_date))+1 : date("Y", strtotime($from_date));

            $gstr1 = $this->gatClientTax(1, $year_id, $year, $month);
            $gstr3b = $this->gatClientTax(2, $year_id, $year, $month);
            $tally = $this->gatClientTax(3, $year_id, $year, $month);
            $crm = $this->getCRMTax($year_id, $year, $month);
            $data["gst_output"][] = array(
                "month" => $year."-".$month,
                "gstr1" => $gstr1,
                "gstr3b" => $gstr3b,
                "tally" => $tally,
                "crm" => $crm
            );
        }

        $this->load->view('admin/report/gstoutput_report', $data);
    }

    public function gatClientTax($gst_type, $year_id, $year, $month){
        $cgst = $igst = $sgst = 0.00;
        $clienttax = $this->db->query("SELECT `id` FROM `tblclienttaxstatus` WHERE `type` = 1 AND `gst_typ` = ".$gst_type." AND `year` = ".$year." AND month = ".$month." AND `approve_status` = 1")->result();
        if (!empty($clienttax)){
            foreach ($clienttax as $val) {
                $clienttaxdetails = $this->db->query("SELECT `document_id`,`tabel_type` FROM `tblclienttaxstatusdetails` WHERE `main_id` = ".$val->id."")->result();

                if(!empty($clienttaxdetails)){
                    foreach ($clienttaxdetails as $cval) {
                        switch ($cval->tabel_type) {
                            case 1:
                                $invoice = $this->getInvoicetax($cval->document_id, $year_id, $year, $month);
                                $cgst += $invoice["cgst"];
                                $igst += $invoice["igst"];
                                $sgst += $invoice["sgst"];
                                break;
                            case 2:
                                $dnote = $this->getDebitNotetax($cval->document_id, $year_id, $year, $month);
                                $cgst += $dnote["cgst"];
                                $igst += $dnote["igst"];
                                $sgst += $dnote["sgst"];
                                break;
                            case 3:
                                $dnotepay = $this->getDebitNotePaytax($cval->document_id, $year_id, $year, $month);
                                $cgst += $dnotepay["cgst"];
                                $igst += $dnotepay["igst"];
                                $sgst += $dnotepay["sgst"];
                                break;
                            case 4:
                                $cnote = $this->getCreditNotetax($cval->document_id, $year_id, $year, $month);
                                $cgst -= $cnote["cgst"];
                                $igst -= $cnote["igst"];
                                $sgst -= $cnote["sgst"];
                        }
                    }
                }
            }
        }
        return array("cgst" => number_format(round($cgst), 2, '.', ''), "igst" => number_format(round($igst), 2, '.', ''), "sgst" => number_format(round($sgst), 2, '.', ''));
    }

    public function getCRMTax($year_id, $year, $month){
        $cgst = $igst = $sgst = 0.00;
        $invoice = $this->db->query("SELECT * FROM `tblinvoices` WHERE `year_id`=" . $year_id . " AND YEAR(invoice_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(invoice_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
        if($invoice){
            foreach ($invoice as $value) {
                $tax_type = get_client_gst_type($value->clientid);

                $tax = ($value->total_tax/2);
                $sgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst += ($tax_type == 1) ? 0.00 : $value->total_tax;

            }
        }

        $debitnote = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `year_id`=" . $year_id . " AND YEAR(dabit_note_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(dabit_note_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
        if($debitnote){
            foreach ($debitnote as $value) {
                $tax_type = get_client_gst_type($value->clientid);

                $tax = ($value->total_tax/2);
                $sgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst += ($tax_type == 1) ? 0.00 : $value->total_tax;

            }
        }
        $debitnote = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE `year_id`=" . $year_id . " AND YEAR(date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
        if($debitnote){
            foreach ($debitnote as $value) {
                $tax_type = get_client_gst_type($value->clientid);

                $tax = ($value->total_tax/2);
                $sgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst += ($tax_type == 1) ? 0.00 : $value->total_tax;

            }
        }
        $crditnote = $this->db->query("SELECT * FROM `tblcreditnote` WHERE `year_id`=" . $year_id . " AND YEAR(date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
        if($crditnote){
            foreach ($crditnote as $value) {
                $tax_type = get_client_gst_type($value->clientid);

                $tax = ($value->total_tax/2);
                $sgst -= ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $cgst -= ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                $igst -= ($tax_type == 1) ? 0.00 : $value->total_tax;

            }
        }
        return array("cgst" => number_format(round($cgst), 2, '.', ''), "igst" => number_format(round($igst), 2, '.', ''), "sgst" => number_format(round($sgst), 2, '.', ''));
    }

    public function getCreditNotetax($document_id, $year_id, $year, $month){
        $result = $this->db->query("SELECT * FROM `tblcreditnote` WHERE `id`=" . $document_id . " ")->row();
        if ($result){
            $tax_type = get_client_gst_type($result->clientid);

            $tax = ($result->total_tax/2);
            $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $igst = ($tax_type == 1) ? 0.00 : $result->total_tax;
            return array("cgst" => $cgst, "igst" => $igst, "sgst" => $sgst);
        }
    }

    public function getDebitNotePaytax($document_id, $year_id, $year, $month){
        $result = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE `id`=" . $document_id . " ")->row();
        if ($result){
            $tax_type = get_client_gst_type($result->clientid);

            $tax = ($result->total_tax/2);
            $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $igst = ($tax_type == 1) ? 0.00 : $result->total_tax;
            return array("cgst" => $cgst, "igst" => $igst, "sgst" => $sgst);
        }
    }

    public function getDebitNotetax($document_id, $year_id, $year, $month){
        $result = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `id`=" . $document_id . " ")->row();
        if ($result){
            $tax_type = get_client_gst_type($result->clientid);

            $tax = ($result->total_tax/2);
            $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $igst = ($tax_type == 1) ? 0.00 : $result->total_tax;
            return array("cgst" => $cgst, "igst" => $igst, "sgst" => $sgst);
        }
    }

    public function getInvoicetax($document_id, $year_id, $year, $month){
        $result = $this->db->query("SELECT * FROM `tblinvoices` WHERE `id`=" . $document_id . " ")->row();
        if ($result){
            $tax_type = get_client_gst_type($result->clientid);

            $tax = ($result->total_tax/2);
            $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
            $igst = ($tax_type == 1) ? 0.00 : $result->total_tax;
            return array("cgst" => $cgst, "igst" => $igst, "sgst" => $sgst);
        }
    }

    /* this function use for get tax details */
    public function gsttaxdetails(){

        $data["title"] = "GST Tax Details";
        $data["invoice_data"] = $data['debitnote_data'] = $data['debitnotepayment_data'] = $data['creditnote_data'] = array();
        if (!empty($_GET)){
            extract($this->input->get());

            if($gsttype !="" && $month != ""){
                $month_year = explode("-", $month);
                $year = $month_year[0];
                $month = $month_year[1];

                if ($gsttype != 4){
                    $clienttax = $this->db->query("SELECT `id` FROM `tblclienttaxstatus` WHERE `type` = 1 AND `gst_typ` = ".$gsttype." AND `year` = ".$year." AND month = ".$month." AND `approve_status` = 1")->result();
                    if ($clienttax){
                        foreach ($clienttax as $val) {
                            $clienttaxdetails = $this->db->query("SELECT `document_id`,`tabel_type` FROM `tblclienttaxstatusdetails` WHERE `main_id` = ".$val->id."")->result();
                            if (!empty($clienttaxdetails)){
                                foreach ($clienttaxdetails as $details){
                                    switch ($details->tabel_type) {
                                        case 1:
                                            $data['invoice_data'][] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblinvoices` as `in` LEFT JOIN `tblcompanybranch` as `cb` ON `in`.`billing_branch_id` = `cb`.`id` WHERE in.id = ".$details->document_id." ORDER BY in.id DESC ")->row();
//                                            $data['invoice_data'][] = $this->db->query("SELECT * FROM `tblinvoices` WHERE `id`=" . $details->document_id . " ")->row();
                                            break;
                                        case 2:
                                            $data['debitnote_data'][] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tbldebitnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE in.id = ".$details->document_id." ORDER BY in.id DESC ")->row();
//                                            $data['debitnote_data'][] = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `id`=" . $details->document_id . "")->row();
                                            break;
                                        case 3:
                                            $data['debitnotepayment_data'][] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tbldebitnotepayment` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE in.id = ".$details->document_id." ORDER BY in.id DESC ")->row();
//                                            $data['debitnotepayment_data'][] = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE `id`=" . $details->document_id . " AND YEAR(date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->row();
//                                            $data['debitnotepayment_data'][] = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE `id`=" . $details->document_id . " ")->row();
                                            break;
                                        case 4:
                                            $data['creditnote_data'][] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblcreditnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE in.id = ".$details->document_id." ORDER BY in.id DESC ")->row();
//                                            $data['creditnote_data'][] = $this->db->query("SELECT * FROM `tblcreditnote` WHERE `id`=" . $details->document_id . " ")->row();
                                    }
                                }
                            }
                        }
                    }
                }else{
//                    $data['invoice_data'] = $this->db->query("SELECT * FROM `tblinvoices` WHERE YEAR(invoice_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(invoice_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
                    $data['invoice_data'] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblinvoices` as `in` LEFT JOIN `tblcompanybranch` as `cb` ON `in`.`billing_branch_id` = `cb`.`id` WHERE  YEAR(in.invoice_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(in.invoice_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "' ORDER BY in.id DESC ")->result();
//                    $data['debitnote_data'] = $this->db->query("SELECT * FROM `tbldebitnote` WHERE YEAR(dabit_note_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(dabit_note_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
                    $data['debitnote_data'] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tbldebitnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE YEAR(in.dabit_note_date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(in.dabit_note_date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "' ORDER BY in.id DESC ")->result();
                    $data['debitnotepayment_data'] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tbldebitnotepayment` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE YEAR(in.date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(in.date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "' ORDER BY in.id DESC ")->result();
//                    $data['debitnotepayment_data'] = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE YEAR(date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
//                    $data['creditnote_data'] = $this->db->query("SELECT * FROM `tblcreditnote` WHERE YEAR(date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "'")->result();
                    $data['creditnote_data'] = $this->db->query("SELECT `in`.*,`cb`.`state` as `branch_state`,`cb`.`gst_no` as `branch_gst_no` FROM `tblcreditnote` as `in` JOIN `tblcompanybranch` as `cb` ON `in`.`branch_id` = `cb`.`id` WHERE YEAR(in.date) = '".date('Y', strtotime($year . '-' . $month . '-01'))."' AND MONTH(in.date) = '" . date('m', strtotime($year . '-' . $month . '-01')) . "' ORDER BY in.id DESC ")->result();
                }

            }
        }

        $this->load->view('admin/report/gsttax_details', $data);

    }


    /* this function use for purchase product */
    public function purchase_product(){
        check_permission(369,'view');
        $data['title'] = 'Purchase Product Report';
        // $year_id = financial_year();
        $type = 1;
        $where = "pop.po_id > 0 AND pop.qty > 0 AND po.show_list = 1";
        if(!empty($_POST)){

            extract($this->input->post());
            if(!empty($type)){
                if ($type == 2){
                    $where = "pop.invoice_id > 0 AND pop.qty > 0";
                }
            }

            if(!empty($f_date) && !empty($t_date)){
                $where .= " and po.date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
            }else{
              $where .= " and po.year_id = '".financial_year()."'";
            }

            if(!empty($product_id)){
                $product_arr = implode(",", $product_id);
                $where .= " and pop.product_id IN (".$product_arr.") ";
                $data['product_id'] = $product_id;
            }

            if(!empty($vendor_id)){
                $where .= " and po.vendor_id = '".$vendor_id."' ";
                $data['vendor_id'] = $vendor_id;
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

            if ($type == 2){
                $data['purchase_product_list'] = $this->db->query("SELECT  count(pop.id) as ttlproductrow, SUM(pop.qty) as total_qty, SUM(pop.price) as ttl_price, p.sub_name as product_name, pop.product_id, p.unit_id, p.division_id, p.sub_division_id,p.product_cat_id,p.min_qty,p.max_qty FROM tblpurchaseinvoiceproduct as pop RIGHT JOIN tblpurchaseinvoice as po ON po.id = pop.invoice_id RIGHT JOIN tblproducts as p ON pop.product_id = p.id WHERE ".$where." GROUP BY pop.product_id ORDER BY total_qty DESC ")->result();
            }else{
                $data['purchase_product_list'] = $this->db->query("SELECT count(pop.id) as ttlproductrow, SUM(pop.qty) as total_qty, SUM(pop.price) as ttl_price, p.sub_name as product_name, pop.product_id, pop.unit_id, pop.is_temp,p.division_id, p.sub_division_id,p.product_cat_id,p.min_qty,p.max_qty FROM tblpurchaseorderproduct as pop RIGHT JOIN tblpurchaseorder as po ON po.id = pop.po_id RIGHT JOIN tblproducts as p ON pop.product_id = p.id WHERE ".$where." GROUP BY pop.product_id ORDER BY total_qty DESC ")->result();
            }
            
        }

        
        $data['product_list'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ORDER BY name ASC")->result();
        $data['vendor_list'] = $this->db->query("SELECT * from `tblvendor` where status = 1 ORDER BY name ASC ")->result();
        $data['category_list'] = $this->db->query("SELECT * from `tblproductcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['sub_category_list'] = $this->db->query("SELECT * from `tblproductsubcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['parent_category_list'] = $this->db->query("SELECT * from `tblproductparentcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['child_category_list'] = $this->db->query("SELECT * from `tblproductchildcategory` where status = 1 ORDER BY name ASC ")->result();
        $data['type'] = $type;
        $this->load->view('admin/report/purchase_product_report', $data);
    }

    /* this function use for get purchase order list */
    public function get_purchaseorder_list(){

        if(!empty($_REQUEST)){
            extract($this->input->get());
            extract($this->input->post());
            $data['title'] = 'Purchase Order List';

            $where = "pop.po_id > 0 AND pop.qty > 0 AND po.show_list = 1";
            if(!empty($type) && $type == 2){
                $data['title'] = 'Purchase Invoice List';
                $where = "pop.invoice_id > 0 AND pop.qty > 0";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data["f_date"] = $f_date;
                $data["t_date"] = $t_date;
                $where .= " and po.date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }

            if(!empty($product_id)){
                $where .= " and pop.product_id = '".$product_id."' ";
            }
            if(!empty($vendor_id)){
                $where .= " and po.vendor_id = '".$vendor_id."' ";
            }

            $data["product_id"] = $product_id;
            if ($type == 2){
                $data["purchaseorder_list"] = $this->db->query("SELECT po.po_id, po.vendor_id, po.date, pop.* FROM tblpurchaseinvoiceproduct as pop RIGHT JOIN tblpurchaseinvoice as po ON po.id = pop.invoice_id WHERE ".$where." ORDER BY po.date DESC")->result();
            }else{
                $data["purchaseorder_list"] = $this->db->query("SELECT po.id as po_id ,po.vendor_id, po.date, pop.*, po.number as po_number FROM tblpurchaseorderproduct as pop RIGHT JOIN tblpurchaseorder as po ON po.id = pop.po_id WHERE ".$where." ORDER BY po.date DESC")->result();
            }

            $data["type"] = $type;
            $this->load->view('admin/report/product_purchase_list', $data);
        }else{
            redirect(admin_url('report/purchase_product'));
        }

    }

    /* this function use for get advance salary request report */
    public function advance_salary_report(){

        $where = "category = 1 and cancel = 0 and is_taken = 0 and MONTH(`date`) = '".date("m")."' and YEAR(`date`) = '".date("Y")."'";
        $data["month"] = date("m");
        $data["year_id"] = date("Y");
        if(!empty($_POST)){
            extract($this->input->post());
            
            if(!empty($month) && !empty($year_id)){
                $data["month"] = $month;
                $data["year_id"] = $year_id;
                $where = "category = 1 and cancel = 0 and is_taken = 0 and MONTH(`date`) = '".$month."' and YEAR(`date`) = '".$year_id."'";
            }
        }

        /* this code use for update salary details of staff */
        file_get_contents(base_url()."Salary_cron/generate_salary?month=".$data["month"]."&year=".$data["year_id"]);

        $data['title'] = 'Advance Salary Report';
        
        $data["advance_salary_list"] = $this->db->query("SELECT Max(id) as id FROM `tblrequests` WHERE ".$where."  GROUP BY addedfrom")->result();
        
        // $data["advance_salary_list"] = $this->db->query("SELECT * FROM `tblrequests` WHERE ".$where." ORDER BY id DESC")->result();
        $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        $this->load->view("admin/reports/advance_salary_report", $data);
    }

    /* This function use for vendor payment report */
    public function vendor_payment_report(){
        $where = "pop.acceptance = 1 AND pop.status = 1 AND pop.payfile_done = 1";
        $pwhere = "pay.transport_against = 2 and pay.acceptance = 1 and pay.approved_status = 1 and pay.payfile_done = 1";
        if(!empty($_POST)){
            extract($this->input->post());

            if (!empty($vendor_id)){

                $data['vendor_id'] = $vendor_id;
                $where .= " and p.vendor_id = ".$vendor_id;
                // $pwhere .= " and p.vendor_id = ".$vendor_id; 
            }
            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;
                $data['payment_type'] = $payment_type;

                $where .= " and b.date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
                $pwhere .= " and b.date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";

                if ($payment_type == 1){
                    $select = "p.id as po_id, p.number, p.date as po_date, p.vendor_id, p.totalamount,b.date as payment_date,b.amount as cleared_amount,b.utr_no,b.utr_date";
                    $data['vendorpayments'] = $this->db->query("SELECT ".$select." FROM `tblbankpaymentdetails` as b RIGHT JOIN `tblpurchaseorderpayments` as pop ON b.pay_type = 'po_payment' AND b.pay_type_id = pop.id
                    RIGHT JOIN `tblpurchaseorder` as p ON p.id = pop.po_id WHERE ".$where." ")->result();
                }else{
                    // $select = "p.id as po_id, p.number, p.date as po_date, p.vendor_id, p.totalamount,b.date as payment_date,b.amount as cleared_amount,b.utr_no,b.utr_date";
                    // $data['vendorpayments'] = $this->db->query("SELECT ".$select." FROM `tblbankpaymentdetails` as b RIGHT JOIN `tblpaymentrequest` as pay ON b.pay_type = 'pay_request' AND b.pay_type_id = pay.id
                    // RIGHT JOIN `tblpurchaseorder` as p ON FIND_IN_SET(p.id, pay.document_id) WHERE ".$pwhere." ")->result();
                    $select = "b.date as payment_date,b.amount as cleared_amount,b.utr_no,b.utr_date,pay.document_id";
                    $data['vendorpayments'] = $this->db->query("SELECT ".$select." FROM `tblbankpaymentdetails` as b RIGHT JOIN `tblpaymentrequest` as pay ON b.pay_type = 'pay_request' AND b.pay_type_id = pay.id
                    WHERE ".$pwhere." ")->result();
                }
                
            }
        }
        // echo $this->db->last_query();
        // exit;
        $data['title'] = 'Vendor Payments';
        $data['vendor_list'] = $this->db->query("SELECT * from `tblvendor` where status = 1 ORDER BY name ASC ")->result();
        $this->load->view("admin/report/vendor_payments_report", $data);
    }
}
