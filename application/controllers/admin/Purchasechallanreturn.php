<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Purchasechallanreturn extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }


    /* this function is index function */
    public function index()
    {
        check_permission(350,'create');
        $where = " id > 0";

    	if(!empty($_POST)){
       	    extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            if(!empty($vendor_id)){
                $data['vendor_id'] = $vendor_id;

                $where .= " and vendor_id ='".$vendor_id."'";
            }
        }else{
            $where .= " and year_id ='".financial_year()."'";
        }
        $data['challanreturn_list']  = $this->db->query("SELECT * FROM tblpurchasechallanreturn WHERE ".$where." ORDER BY id DESC ")->result();
        $data['vendors_info'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ORDER BY name ASC")->result();

        $data['title'] = 'Purchase Challan Return List';
        $this->load->view('admin/purchase/purchasechallanreturn_list', $data);

    }

    /* This function use for upload file of purchase challan return */
    public function file_upload() {
        if(!empty($_POST)){
            extract($this->input->post());

            handle_multi_attachments($pcreturn_id,'purchallan_return');

            set_alert('success', 'File Uploaded successfully');
            redirect(admin_url('purchasechallanreturn'));
        }

    }

    public function get_uploads_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'purchallan_return' and rel_id = '".$id."' ")->result();

            echo '<h4>No. : PCR-'.str_pad($id, 4, '0', STR_PAD_LEFT).' </h4>';
            if(!empty($file_info)){
            ?>


            <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Uploads File</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($file_info as $key => $file) {
                        ?>
                         <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><?php echo _d($file->dateadded); ?></td>
                            <td><a target="_blank" href="<?php echo base_url('uploads/purchallan_return/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></td>
                         </tr>

                    <?php
                    }
                    ?>
                     </tbody>
                </table>
            </div>
            <?php
            }

        }
    }

    /* this function use for delete purchase challan return */
    public function delete($id) {
       check_permission(350,'delete');

        $delete = $this->home_model->delete('tblpurchasechallanreturn',array('id'=>$id));

        if($delete == true){
            set_alert('success', 'Purchase challan return deleted successfully');
            redirect(admin_url('purchasechallanreturn'));
        }
    }


    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('purchasechallanreturn'));
        }

        $purchasechallan_info = $this->db->query("SELECT * FROM `tblpurchasechallanreturn` where id =  '".$id."' ")->row();
        $file_name = 'Purchase Challan Return - '.$id;

        $html = purchase_challan_return_pdf($purchasechallan_info);
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


    /* this function use for convert to debitnote */
    public function convert_todebitnote($id){
        check_permission(351,'create');
        $data["title"] = "Add Purchase Debit Note";
        $data["section"] = "convert";
        $purchase_challaninfo = $this->db->query("SELECT * FROM tblpurchasechallanreturn WHERE id = ".$id."")->row();
        if (!empty($_POST)){

            extract($this->input->post());
            $date = db_date($date);
            $challan_no = (!empty($challan_no)) ? $challan_no : "";

            $totaltax = 0.00;
            if(!empty($saleproposal)){
                foreach ($saleproposal as $value) {
                    $totaltax += $value["tax_amt"];
                }
            }
            $ad_data = array(
                "parchasechallanreturn_id" => $id,
                'staff_id' => get_staff_user_id(),
                'vender_id' => $purchase_challaninfo->vendor_id,
                'mr_id' => $purchase_challaninfo->mr_id,
                'po_id' => $purchase_challaninfo->po_id,
                'branch_id' => $purchase_challaninfo->branch_id,
                'challan_number' => $challan_no,
                'date' => $date,
                'year_id' => financial_year(),
                'finalsubtotalamount' => $saleproposal["finalsubtotalamount"],
                'finaldiscountpercentage' => $saleproposal["finaldiscountpercentage"],
                'finaldiscountamount' => $saleproposal["finaldiscountamount"],
                'total_tax' => $totaltax,
                'totalamount' => $saleproposal["totalamount"],
                'tax_type' => $tax_type,
                'status' => 1,
                'note' => $note,
                'terms_and_conditions' => $terms_and_conditions,
                'created_date' => date("Y-m-d H:i:s"),

          );
            $insert_id = $this->home_model->insert("tblpurchasedabitnote", $ad_data);
            if ($insert_id) {

                /* this function use for isconverted debit note */
                $this->home_model->update("tblpurchasechallanreturn", array("is_convertDN" => 1), array("id" => $id));

                unset($saleproposal['finalsubtotalamount']);
                unset($saleproposal['finaldiscountpercentage']);
                unset($saleproposal['finaldiscountamount']);
                unset($saleproposal['totalamount']);

                foreach ($saleproposal as $singlesalepro) {
                    $saleitemdata['purchasedebitnote_id'] = $insert_id;
                    $saleitemdata['product_id'] = $singlesalepro['product_id'];
                    $saleitemdata['product_name'] = $singlesalepro['product_name'];
                    $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                    $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                    $saleitemdata['qty'] = $singlesalepro['qty'];
                    $saleitemdata['price'] = $singlesalepro['price'];
                    $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                    $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                    $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                    $saleitemdata['is_temp'] = $singlesalepro['is_temp'];
                    $this->db->insert('tblpurchasedabitnoteproducts', $saleitemdata);
                }

                set_alert('success', 'Successfully! purchase debit note converted');
                redirect(admin_url('Purchasechallanreturn/purchase_debitnote'));
            }
            else{
                set_alert('warning', 'Somthing went worng');
                redirect(admin_url('purchasechallanreturn'));
            }
        }
        $data['purchase_challaninfo']  = $purchase_challaninfo;
        $data['vendors_info'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 order by name asc")->result_array();
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 order by name asc")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 order by product_name asc ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=>$r['name'],'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }
        $this->load->view('admin/purchase/purchase_debitnote_add', $data);
    }

    /* this function is purchase debitnote function */
    public function purchase_debitnote()
    {
        $where = " id > 0";
        check_permission(351,'view');
    	if(!empty($_POST)){
       	    extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            if(!empty($vendor_id)){
                $data['vendor_id'] = $vendor_id;

                $where .= " and vender_id ='".$vendor_id."'";
            }
    	}else{
            $where .= " and year_id = '".financial_year()."'";
        }
        $data['purchase_debitnote_list']  = $this->db->query("SELECT * FROM tblpurchasedabitnote WHERE ".$where." ORDER BY id DESC ")->result();
        $data['vendors_info'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ORDER BY name ASC")->result();

        $data['title'] = 'Purchase Debit Note List';
        $this->load->view('admin/purchase/purchase_dabitnote_list', $data);
    }

    /* this function use for download_debitnotepdf */
    public function download_debitnotepdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('purchase_debitnote'));
        }

        $purchase_debitnote_info = $this->db->query("SELECT * FROM `tblpurchasedabitnote` where id =  '".$id."' ")->row();
        $file_name = 'Purchase Debit Note - '.$id;

        $html = purchase_debitnote_pdf($purchase_debitnote_info);
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

    /* this function use for purchasedebitnote edit*/
    public function purchasedebitnote_edit($id){
        $data["title"] = "Edit Purchase Debit Note";

        $debitnoteinfo = $this->db->query("SELECT * FROM tblpurchasedabitnote WHERE id = ".$id."")->row();
        if (empty($debitnoteinfo)){
            redirect(admin_url('purchasechallanreturn/purchase_debitnote'));
        }

        if (!empty($_POST)){

            extract($this->input->post());
            $date = db_date($date);
            $challan_no = (!empty($challan_no)) ? $challan_no : "";

            $totaltax = 0.00;
            if(!empty($saleproposal)){
                foreach ($saleproposal as $value) {
                    $totaltax += $value["tax_amt"];
                }
            }
            $ad_data = array(
                'date' => $date,
                'finalsubtotalamount' => $saleproposal["finalsubtotalamount"],
                'finaldiscountpercentage' => $saleproposal["finaldiscountpercentage"],
                'finaldiscountamount' => $saleproposal["finaldiscountamount"],
                'total_tax' => $totaltax,
                'totalamount' => $saleproposal["totalamount"],
                'tax_type' => $tax_type,
                'note' => $note,
                'terms_and_conditions' => $terms_and_conditions,
                'created_date' => date("Y-m-d H:i:s"),

          );
            if (isset($credit_note_no)){
                $ad_data["credit_note_no"] = $credit_note_no;
            }
            $update = $this->home_model->update("tblpurchasedabitnote", $ad_data, array("id" => $id));
            if ($update) {

                unset($saleproposal['finalsubtotalamount']);
                unset($saleproposal['finaldiscountpercentage']);
                unset($saleproposal['finaldiscountamount']);
                unset($saleproposal['totalamount']);

                $this->home_model->delete('tblpurchasedabitnoteproducts', array("purchasedebitnote_id" => $id));

                foreach ($saleproposal as $singlesalepro) {
                    $saleitemdata['purchasedebitnote_id'] = $id;
                    $saleitemdata['product_id'] = $singlesalepro['product_id'];
                    $saleitemdata['product_name'] = $singlesalepro['product_name'];
                    $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                    $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                    $saleitemdata['qty'] = $singlesalepro['qty'];
                    $saleitemdata['price'] = $singlesalepro['price'];
                    $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                    $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                    $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                    $saleitemdata['is_temp'] = $singlesalepro['is_temp'];
                    $this->db->insert('tblpurchasedabitnoteproducts', $saleitemdata);
                }

                set_alert('success', 'Successfully! purchase debit note updated');
                redirect(admin_url('purchasechallanreturn/purchase_debitnote'));
            }
            else{
                set_alert('warning', 'Somthing went worng');
                redirect(admin_url('purchasechallanreturn/purchase_debitnote'));
            }
        }
        $data['debitnoteinfo']  = $debitnoteinfo;
        $data['vendors_info'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 order by name asc")->result_array();
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 order by name asc")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 order by product_name asc ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=>$r['name'],'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }
        $this->load->view('admin/purchase/purchase_debitnote_edit', $data);
    }

    public function purchasedebitnote_add(){
        $data["title"] = "Add Purchase Debit Note";
        $data["section"] = "create";
        if (!empty($_POST)){
            extract($this->input->post());

            $date = db_date($date);
            $challan_no = (!empty($challan_no)) ? $challan_no : "";

            $totaltax = 0.00;
            if(!empty($saleproposal)){
                foreach ($saleproposal as $value) {
                    $totaltax += $value["tax_amt"];
                }
            }
            $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'vender_id' => $vendor_id,
                'po_id' => $po_id,
                'branch_id' => get_login_branch(),
                'credit_note_no' => $credit_note_no,
                'date' => $date,
                'year_id' => financial_year(),
                'finalsubtotalamount' => $saleproposal["finalsubtotalamount"],
                'finaldiscountpercentage' => $saleproposal["finaldiscountpercentage"],
                'finaldiscountamount' => $saleproposal["finaldiscountamount"],
                'total_tax' => $totaltax,
                'totalamount' => $saleproposal["totalamount"],
                'tax_type' => $tax_type,
                'status' => 1,
                'note' => $note,
                'is_direct'=> 1,
                'terms_and_conditions' => $terms_and_conditions,
                'created_date' => date("Y-m-d H:i:s"),

          );
            $insert_id = $this->home_model->insert("tblpurchasedabitnote", $ad_data);
            if ($insert_id) {

                /* this function use for isconverted debit note */
                $this->home_model->update("tblpurchasechallanreturn", array("is_convertDN" => 1), array("id" => $id));

                unset($saleproposal['finalsubtotalamount']);
                unset($saleproposal['finaldiscountpercentage']);
                unset($saleproposal['finaldiscountamount']);
                unset($saleproposal['totalamount']);

                foreach ($saleproposal as $singlesalepro) {
                    $saleitemdata['purchasedebitnote_id'] = $insert_id;
                    $saleitemdata['product_id'] = $singlesalepro['product_id'];
                    $saleitemdata['product_name'] = $singlesalepro['product_name'];
                    $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                    $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                    $saleitemdata['qty'] = $singlesalepro['qty'];
                    $saleitemdata['price'] = $singlesalepro['price'];
                    $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                    $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                    $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                    $saleitemdata['is_temp'] = $singlesalepro['is_temp'];
                    $this->db->insert('tblpurchasedabitnoteproducts', $saleitemdata);
                }

                set_alert('success', 'Successfully! purchase debit note converted');
                redirect(admin_url('Purchasechallanreturn/purchase_debitnote'));
            }
            else{
                set_alert('warning', 'Somthing went worng');
                redirect(admin_url('purchasechallanreturn'));
            }
        }

        $data['vendors_info'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 order by name asc")->result_array();
        $data['product_data'] = array();
        $product_data = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 order by name asc")->result_array();
        $temp_product_data = $this->db->query("SELECT * FROM `tbltemperoryproduct` where status = 1 order by product_name asc ")->result_array();
        if(!empty($product_data)){
            foreach ($product_data as $r) {
                $data['product_data'][] = array('id'=>$r['id'],'name'=>$r['name'],'is_temp'=>0);
            }
        }
        if(!empty($temp_product_data)){
            foreach ($temp_product_data as $r1) {
                $data['product_data'][] = array('id'=>$r1['id'],'name'=>$r1['product_name'],'is_temp'=>1);
            }
        }
        $this->load->view('admin/purchase/purchase_debitnote_add', $data);
    }
}
