<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Temp_report extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }
	  
    public function po_products()
    {
        $data['title'] = 'Purchase Order Products Report';


        $data['product_list'] = $this->db->query("SELECT product_id FROM `tblpurchaseorderproduct` GROUP by product_id ORDER by po_id desc  ")->result();
        $this->load->view('admin/temp_report/po_products', $data);
    }

	public function invoice_products()
    {
    	$data['title'] = 'Invoice Products Report';


        $data['product_list'] = $this->db->query("SELECT pro_id FROM `tblitems_in` WHERE rel_type = 'invoice' GROUP by pro_id order by rel_id desc")->result();
		$this->load->view('admin/temp_report/invoice_products', $data);
	}

    public function challan_products()
    {
        $data['title'] = 'Challan Products Report';


        $data['product_list'] = $this->db->query("SELECT product_id FROM `tblchalanproducts` GROUP by product_id ORDER by chalan_id DESC ")->result();
        
        $this->load->view('admin/temp_report/challan_products', $data);
    }

    public function challan_components_products()
    {
        $data['title'] = 'Challan Components Report';


        $data['product_list'] = $this->db->query("SELECT component_id FROM `tblchalandetailsmst` where component_id > 0 GROUP by component_id ORDER BY chalan_id DESC ")->result();
        $this->load->view('admin/temp_report/challan_components_products', $data);
    }


}