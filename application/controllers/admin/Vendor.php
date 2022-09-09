<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Vendor extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Vendor_model');
        $this->load->model('home_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission(91,'view');

        $this->load->view('admin/vendor/manage');
    }

    public function table() {
        $this->app->get_table_data('vendor');
    }

    public function vendor($id = '') {
        check_permission(91,'create');
        
        if ($this->input->post()) {
            $vendor_data = $this->input->post();

            if ($id == '') {

                $id = $this->Vendor_model->add($vendor_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('vendor')));
                    if (isset($vendor_data['req_id']) && !empty($vendor_data['req_id'])){
                        redirect(admin_url('requirement/requirement_details/'.$vendor_data['req_id']));
                    }else{
                        redirect(admin_url('vendor'));
                    }
                    
                }
            } else {
                check_permission(91,'edit');
                $success = $this->Vendor_model->edit($vendor_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('vendor')));
                }

                redirect(admin_url('vendor'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('vendor_lowercase'));
        } else {
            $data['vendor'] = (array) $this->Vendor_model->get($id);
            $title = _l('edit', _l('vendor_lowercase'));
        }

        $data['business_type_data'] = $this->Vendor_model->get_business_type();
        $data['state_data'] = $this->Vendor_model->get_state();
        $data['city_data'] = array();
        if(isset($data['vendor']['state_id']) && $data['vendor']['state_id'] != "") {
            $data['city_data'] = $this->Vendor_model->get_cities_by_state_id($data['vendor']['state_id']);
        }

        $data['title'] = $title;

        $this->load->view('admin/vendor/vendor', $data);
    }

    public function delete($id) {
        check_permission(91,'delete');
        $success = $this->Vendor_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('vendor')));
            if (strpos($_SERVER['HTTP_REFERER'], 'vendor/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('vendor'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('vendor_lowercase')));
            redirect(admin_url('vendor/vendor/' . $id));
        }
    }

    /* Change Site Manager status / active / inactive */

    public function change_vendor_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $vendor_data = array(
                'status' => $status
            );

            $this->Vendor_model->edit($vendor_data, $id);
        }
    }

    public function get_cities_by_state_id($state_id) {
        $cityArr = $this->Vendor_model->get_cities_by_state_id($state_id);

        if(count($cityArr) == 0) {
            echo "";
            exit;
        }

        echo json_encode($cityArr);
        exit;
    }


	public function get_subcat_by_cat_id($state_id) {
        $cityArr = $this->Vendor_model->get_subcat_by_cat_id($state_id);

        if(count($cityArr) == 0) {
            echo "";
            exit;
        }

        echo json_encode($cityArr);
        exit;
    }



    public function vendor_profile($id) {

        if ($this->input->post()) {
            $vendor_data = $this->input->post();

            $success = $this->Vendor_model->edit($vendor_data, $id);
            if ($success) {
                set_alert('success', _l('updated_successfully', _l('vendor')));
            }

           redirect($_SERVER['HTTP_REFERER']);
        }

        $data['vendor'] = (array) $this->Vendor_model->get($id);
        $data['business_type_data'] = $this->Vendor_model->get_business_type();
        $data['state_data'] = $this->Vendor_model->get_state();
        $data['city_data'] = array();
        if(isset($data['vendor']['state_id']) && $data['vendor']['state_id'] != "") {
            $data['city_data'] = $this->Vendor_model->get_cities_by_state_id($data['vendor']['state_id']);
        }


        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' ( VEND-'.str_pad($id, 6, '0', STR_PAD_LEFT).' )';
        $this->load->view('admin/vendor/vendor_profile', $data);
    }

    public function vendor_purchaseorder($id)
    {

        $where = "vendor_id = '".$id."' and show_list  = '1'";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            if($range != ''){
            $where .= " and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
            }

            if($status != ''){
                $data['s_status'] = $status;
                if($status == 3){
                    $where .= " and cancel = 1";
                }else{
                    $where .= " and status = '".$status."' and cancel = 0";
                }

            }
        }

        $data['purchaseorder_list'] = $this->db->query("SELECT * from `tblpurchaseorder` where ".$where." ORDER BY id desc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Purchase Order)';
        $this->load->view('admin/vendor/purchaseorder_report', $data);

    }

    public function vendor_mr($id)
    {
        $where = "vendor_id = '".$id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $where .= " and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
        }

        $data['materialreceipt_list'] = $this->db->query("SELECT * from `tblmaterialreceipt` where ".$where." ORDER BY id desc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Purchase Order)';
        $this->load->view('admin/vendor/mr_report', $data);

    }

    Public function vendor_payment($id)
    {
        $where = "vendor_id = '".$id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $where = " date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
        }

        $data['payment_list'] = $this->db->query("SELECT * from `tblvendorpayment` where ".$where." ORDER BY id desc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Payments)';
        $this->load->view('admin/vendor/paymentdone_report', $data);

    }

    Public function vendor_invoice($id)
    {
        $where = "vendor_id = '".$id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);

            $where = " and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblpurchaseinvoice` where ".$where." ORDER BY id desc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Invoice)';
        $this->load->view('admin/vendor/vendor_invoice', $data);

    }

    public function vendor_products($id)
    {

        $where = "vendor_id = '".$id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
        }

        $data['product_list'] = $this->db->query("SELECT * from `tblvendorproductsname` where ".$where." ORDER BY id desc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Venodr Product)';
        $this->load->view('admin/vendor/vendor_products', $data);

    }

    public function vendor_documents($id)
    {

        $where = "vendor_id = '".$id."' ";
        if(!empty($_POST)){
            extract($this->input->post());
        }

        $data['product_list'] = $this->db->query("SELECT * from `tblvendordocuments` where ".$where." ORDER BY id desc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();

        if ($this->input->get('parent_id')) {
            //$data['parent_id'] = $this->input->get('parent_id');
            $parent_id = $this->input->get('parent_id');
        }
        else{
            $parent_id = 0;
        }

        $data['document_info']  = $this->db->query("SELECT * FROM tblvendordocuments WHERE parent_id = '".$parent_id."' and vendor_id = '".$id."' and status = '1'  order by type ASC")->result();

        $data['parent_id'] = $parent_id;

        $data['title'] = $data['vendor_info']->name.' (Vendor Document)';
        $this->load->view('admin/vendor/vendor_document', $data);

    }

    public function create_folder()
    {

        if(!empty($_POST)){
            $vendor_document = $this->input->post();

            $vendorid = $vendor_document['vendor_id'];
            $parent_id = $vendor_document['parent_id'];
            $folder_name = $vendor_document['folder_name'];

                $ad_data = array(
                    'vendor_id' => $vendorid,
                    'parent_id' => $parent_id,
                    'name' => $folder_name,
                    'type' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $this->load->model('home_model');
                $insert = $this->home_model->insert('tblvendordocuments', $ad_data);

          set_alert('success', 'Folder Created Successfully');


            if($parent_id > 0){
                redirect(admin_url('vendor/vendor_documents/'.$vendorid.'?parent_id='.$parent_id));
            }else{
                redirect(admin_url('vendor/vendor_documents/'.$vendorid));
            }


        }

    }

    public function edit_folder()
    {

        if(!empty($_POST)){
            $vendor_document = $this->input->post();

            $id = $vendor_document['id'];
            $vendorid = $vendor_document['vendor_id'];
            $parent_id = $vendor_document['parent_id'];
            $folder_name = $vendor_document['folder_name'];

                 $ad_data = array(
                            'vendor_id' => $vendorid,
                            'name' => $folder_name,
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                $this->load->model('home_model');
                $update = $this->home_model->update('tblvendordocuments', $ad_data,array('id'=>$id));


            set_alert('success', 'Folder Updated Successfully');


            if($parent_id > 0){
                redirect(admin_url('vendor/vendor_documents/'.$vendorid.'?parent_id='.$parent_id));
            }else{
                redirect(admin_url('vendor/vendor_documents/'.$vendorid));
            }


        }

    }

    public function get_editdata()
    {

         if(!empty($_POST)){
            extract($this->input->post());

            $folder_info  = $this->db->query("SELECT * FROM tblvendordocuments WHERE id =  '".$id."'  ")->row();


            ?>
            <div  class="col-md-12">
                <div class="form-group">
                    <label for="title" class="control-label">Folder Name *</label>
                    <input type="text" id="folder_name" name="folder_name" class="form-control" required="" value="<?php echo $folder_info->name; ?>">
                </div>

                <input type="hidden" value="<?php echo $id; ?>" name="id">


            </div>

            <?php
        }

    }

    public function upload_file()
    {

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
                'vendor_id' => $vendor_id,
                'parent_id' => $parent_id,
                'type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1
            );
            $this->load->model('home_model');
            $insert = $this->home_model->insert('tblvendordocuments', $ad_data);

            $doc_id = $this->db->insert_id();
            $ff =  vendor_document_attachments($doc_id);


            set_alert('success', 'File Uploaded Successfully');

            if($parent_id > 0){
                redirect(admin_url('vendor/vendor_documents/'.$vendor_id.'?parent_id='.$parent_id));
            }else{
                redirect(admin_url('vendor/vendor_documents/'.$vendor_id));
            }


        }

    }

    public function delete_file($id,$parent_id="",$vendor_id="")
    {

        $this->load->model('home_model');
        $response = $this->home_model->delete('tblfiles', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'document'));
        } else {
            set_alert('warning', _l('problem_deleting', 'document'));
        }
        if($parent_id > 0){
            redirect(admin_url('vendor/vendor_documents/'.$vendor_id.'?parent_id='.$parent_id));
        }else{
            redirect(admin_url('vendor/vendor_documents/'.$vendor_id));
        }
    }

    public function vendor_addproducts($id)
    {
        if(!empty($_POST)){
            extract($this->input->post());

        $return= $this->Vendor_model->check_vendor_product($product_id,$id);
           if($return==1)
          {
             set_alert('warning', 'Vendor Product Already Exist');
              redirect(admin_url('vendor/vendor_addproducts/'.$id));
         }
        else
        {
 $ad_data = array(
                'vendor_id' => $id,
                'product_id' => $product_id,
                'product_name' => $product_name,
                'remark' => $remark,
                'status' => 1
            );


            $insert = $this->home_model->insert('tblvendorproductsname', $ad_data);

            if($insert){
                set_alert('success', 'Vendor Product added Successfully');
                redirect(admin_url('vendor/vendor_products/'.$id));
            }
        }
        }

        $data['product_info'] = $this->db->query("SELECT * from `tblproducts` where status = 1 and is_approved = 1 ORDER BY name asc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Vendor Product)';
        $this->load->view('admin/vendor/vendor_addproducts', $data);

    }

    //Edit vendor product
public function vendor_editproducts($id,$vendor_id)
    {

        if(!empty($_POST)){
            extract($this->input->post());
	      $ad_data = array(
	                'id' => $pid,
	                'vendor_id' => $vendor_id,
	                'product_id' => $product_id,
	                'product_name' => $product_name,
	                'remark' => $remark,
	                'status' => 1
	            );

            $this->db->update('tblvendorproductsname',$ad_data,array('id'=>$id));
           set_alert('success', 'Vendor Product Update Successfully');
               redirect(admin_url('vendor/vendor_products/'.$vendor_id));
       }

       $data['product_info'] = $this->db->query("SELECT * from `tblproducts` where status = 1 ORDER BY name asc ")->result();

        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$vendor_id."' ")->row();

        $data['vendor_edit_info'] = $this->db->query("SELECT * FROM `tblvendorproductsname` where id =  '".$id."' ")->row();

        $data['title'] = $data['vendor_info']->name.' (Vendor Product)';
        $this->load->view('admin/vendor/vendor_editproducts', $data);

    }

    public function vendor_ledger_reco($id)
    {
        $where = "vendor_id = '".$id."' ";

        $data['ledger_reco_data'] = $this->db->query("SELECT * from `tblclient_vendor_givenledger` where ".$where." ORDER BY id desc ")->result();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Ledger Reco)';
        $this->load->view('admin/vendor/vendor_ledger_reco', $data);

    }

    /* this function use for add client ledger reco */
    public function add_client_ledger_reco($id, $edit_id = ''){
        if(!empty($_POST)){
            extract($this->input->post());
            $this->load->model('home_model');

            $insertdata['added_by'] = get_staff_user_id();
            $insertdata['vendor_id'] = $id;
            $insertdata['from_date'] = db_date($from_date);
            $insertdata['to_date'] = db_date($to_date);
            $insertdata['created_at'] = date('Y-m-d H:i:s');
            if ($edit_id != ''){
                unset($insertdata['created_at']);
                $response = $this->home_model->update('tblclient_vendor_givenledger', $insertdata, array('id' => $edit_id));
                if ($response){
                    /* THIS CODE USE FOR DELETE OLD FILE IF UPLOAD NEW FILES */
                    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                        $getoldfile = value_by_id_empty('tblclient_vendor_givenledger', $edit_id, 'file');
                        if (!empty($getoldfile)){
                            $path = get_upload_path_by_type('ledger_reco') . $id . '/'.$getoldfile;
                            unlink($path);
                        }
                    }
                }
                upload_ledger_reco($edit_id);
                set_alert('success', 'Vendor Ledger Reco added successfully');
            }else{
                $insert_id = $this->home_model->insert('tblclient_vendor_givenledger', $insertdata);
                if ($insert_id){
                    upload_ledger_reco($insert_id);
                    set_alert('success', 'Vendor Ledger Reco updated successfully');
                }
            }
            redirect(admin_url('vendor/vendor_ledger_reco/'.$id));    
        }
        if ($edit_id != ''){
            $data['head_title'] = "Edit Ladger Reco";
            $data['ledger_reco_info'] = $this->db->query("SELECT * FROM `tblclient_vendor_givenledger` WHERE `status`= '1' AND `id`=".$edit_id." ORDER BY id DESC ")->row();
        }else{
            $data['head_title'] = "Add Ladger Reco";
        }
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Ledger Reco)';
        $this->load->view('admin/vendor/add_vendor_ledger_reco', $data);
    }

    public function delete_ledger_reco($id, $vendor_id) {
        $this->load->model('home_model');
        $getoldfile = value_by_id_empty('tblclient_vendor_givenledger', $id, 'file');
        if($this->home_model->delete("tblclient_vendor_givenledger", array("id" => $id))){

            /* THIS CODE USE FOR DELETE UPLOADED FILES */
            if (!empty($getoldfile)){
                $dirpath = get_upload_path_by_type('ledger_reco') . $id;
                remove_all_uploaded_files($dirpath);
            }                
            set_alert('success', 'Ledger Reco Deleted succesfully');
        }
        redirect(admin_url('vendor/vendor_ledger_reco/'.$vendor_id));
    }

    public function delete_product($id,$vendor_id)
    {
        //check_permission(111,'delete');

        $response = $this->home_model->delete('tblvendorproductsname', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'product'));
        }
        redirect(admin_url('vendor/vendor_products/'.$vendor_id));
    }
//delete email whatsapp message

    public function delete_email_whatsapplist($id)
    {
        //check_permission(111,'delete');

        $response = $this->home_model->delete('tblvendorregistrationtracking', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'message'));
        }
        redirect(admin_url('vendor/vendor_email_whatsapplist'));
    }

    public function registered_vendorlist()
    {

        $data['vendor_list'] = $this->db->query("SELECT * from `tblregisteredvendor` order by id desc ")->result();

        $data['title'] = 'Vendor Registration List (SEPL/PUR/02)';
        $this->load->view('admin/vendor/registered_vendorlist', $data);

    }

    public function vendor_view($id = '')
    {
    if ($id == '')
        {
            $title = _l('add_new', _l('vendor_registration'));
        }
    else
    {
        $data['registeredvendor'] = $this->db->query("SELECT * FROM `tblregisteredvendor` where id = '".$id."' ")->result_array();

        $data['vendorcontact'] = $this->db->query("SELECT * FROM `tblregisteredvendorcontact` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorcustomer'] = $this->db->query("SELECT * FROM `tblregisteredvendorcustomer` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorfinancial'] = $this->db->query("SELECT * FROM `tblregisteredvendorfinancials` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorproduct'] = $this->db->query("SELECT * FROM `tblregisteredvendorproduct` where registeredvendor_id = '".$id."' ")->result_array();
    }

        $this->load->model('Designation_model');
        $this->load->model('Site_manager_model');
        $this->load->model('Vendor_model');

        $data['business_type_data'] = $this->Vendor_model->get_business_type();
        $data['designation_data'] = $this->Designation_model->get();
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
         if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
                $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
            }

    $data['title'] = 'Vendor Registration Form';
    $this->load->view('admin/vendor/vendor_view', $data);

  }

  public function registeredvender_edit($id = '')
  {
            if ($this->input->post()) {
            $vendoredit_data = $this->input->post();

            if ($id == '')
       {

       }
       else
       {
        $this->load->model('Registeredvendor_model');
            $success = $this->Registeredvendor_model->registeredvendors_edit($vendoredit_data, $id);

            if($success){
                set_alert('success', _l('updated_successfully', _l('Registered_Vendor')));
                redirect(admin_url('vendor/list'));
       }
       }

        }
        $data['registeredvendor'] = $this->db->query("SELECT * FROM `tblregisteredvendor` where id = '".$id."' ")->result_array();

        $data['vendorcontact'] = $this->db->query("SELECT * FROM `tblregisteredvendorcontact` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorcustomer'] = $this->db->query("SELECT * FROM `tblregisteredvendorcustomer` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorfinancial'] = $this->db->query("SELECT * FROM `tblregisteredvendorfinancials` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorproduct'] = $this->db->query("SELECT * FROM `tblregisteredvendorproduct` where registeredvendor_id = '".$id."' ")->result_array();


        $this->load->model('Designation_model');
        $this->load->model('Site_manager_model');
        $this->load->model('Vendor_model');

        $data['business_type_data'] = $this->Vendor_model->get_business_type();
        $data['designation_data'] = $this->Designation_model->get();
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
         if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
                $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
            }

    $data['title'] = 'Vendor Registration Form';
    $this->load->view('admin/vendor/registeredvendor_edit', $data);

  }

  public function get_city()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $city_info = $this->db->query("SELECT * FROM `tblcities` where state_id = '".$state_id."'")->result();
            $html = '<option value="">--Select One-</option>';
            if(!empty($city_info)){
                foreach ($city_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }

            echo $html;
        }
    }

  public function residential_city()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $city_info = $this->db->query("SELECT * FROM `tblcities` where id = '".$permenent_city."'")->result();
            /*$html = '<option value="">--Select One-</option>';*/
            if(!empty($city_info)){
                foreach ($city_info as $key => $value) {
                    $html = '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }

            echo $html;
        }
    }


    public function registration_email()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $this->load->model('emails_model');

            $link = site_url('vendor/vendor_form');
            $message = str_replace("#link#",$link,$message);


            $message .= get_company_signature();
            $sent = $this->emails_model->send_simple_email($email, $subject, $message);
            if ($sent) {
                set_alert('success', 'Email send successfully');
              $ad_data = array(
                    'vendor_email' => $email,
                    'subject' => $subject,
                    'created_date'=>date("Y-m-d H:i:s"),
                    'type' => 1
                );


            $insert = $this->home_model->insert('tblvendorregistrationtracking', $ad_data);

            }else{
                set_alert('warning', 'Email not sent!');
            }
            redirect(admin_url('vendor/vendor_email_whatsapplist'));
        }

    }

    //send message via whatsapp
    public function registered_whatsapp()
    {
            if ($this->input->post()) {
                extract($this->input->post());
                $this->load->model('emails_model');
                $link = site_url('vendor/vendor_form');
                $message = str_replace("#link#",$link,$message);
                $phone=$this->input->post('phone');
                $message1=$this->input->post('message');
                $message=$message1.$link;
                $ad_data = array(
                    'vendor_mobile' => $phone,
                    'created_date'=>date("d-m-Y H:i:s"),
                    'type' => 2
                );

                 $insert = $this->home_model->insert('tblvendorregistrationtracking', $ad_data);
                  header("location:https://api.whatsapp.com/send?phone=$phone&text=$message");
             }
    }
    //List  whatsapp and email for vendor

    public function vendor_email_whatsapplist()
    {

        $data['vendor_list'] = $this->db->query("SELECT * from `tblvendorregistrationtracking` order by id desc ")->result();

        $data['title'] = 'Vendor whatsapp & Email List';
        $this->load->view('admin/vendor/vendor_whatsemainList', $data);

    }

    public function make_vedor()
    {
        if ($this->input->post()) {
            extract($this->input->post());

            $vendor_info = $this->db->query("SELECT * from `tblregisteredvendor` where id = '".$vendor_id."' ")->row();

            if(!empty($vendor_info)){
                $add_data = array(
                    'reg_id' => $vendor_id,
                    'description' => $remark,
                    'name' => $vendor_info->vendor_name,
                    'contact_number' => $vendor_info->contact_no,
                    'email' => $vendor_info->email_id,
                    'business_type_id' => $vendor_info->business_type,
                    'gst_no' => $vendor_info->gst_no,
                    'pan_no' => $vendor_info->pan_no,
                    'cin_no' => $vendor_info->cin_no,
                    'address' => $vendor_info->office_address,
                    'state_id' => $vendor_info->office_state,
                    'city_id' => $vendor_info->office_city,
                    'account_no' => $vendor_info->account_no,
                    'ifsc' => $vendor_info->ifc_code,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }

            if ($this->home_model->insert('tblvendor',$add_data)) {

                $this->home_model->update('tblregisteredvendor', array('status'=>1),array('id'=>$vendor_id));

                set_alert('success', 'Vendor converted successfully');
            }else{
                set_alert('warning', 'Some error occurred!');
            }
            redirect(admin_url('vendor/registered_vendorlist'));
        }

    }

    public function product_term_condition($id) {

        if ($this->input->post()) {
            $vendor_data = $this->input->post();

            $success = $this->Vendor_model->add_product_term_condition($vendor_data, $id);
            if ($success) {
                set_alert('success', "Vendor product term and condition");
            }

           redirect($_SERVER['HTTP_REFERER']);
        }

        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$id."' ")->row();
        $data['title'] = $data['vendor_info']->name.' (Product Term And Condition)';
        $this->load->view('admin/vendor/vendor_product_term_condition', $data);
    }

    /* this function use for ledger */
    public function ledger(){
        $data['title'] = 'Vendor Ledger';
        check_permission(352,'view');
        if ($this->input->post()) {
            extract($this->input->post());

            $where = "vendor_id = 0";
            if(!empty($vendor_id)){
                $data['vendor_id'] = $vendor_id;

                $where = "vendor_id ='".$vendor_id."' and po_id > 0";
            }

            if(!empty($f_date) && !empty($t_date)){

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            $data['invoicelist'] = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE ".$where." ORDER BY id DESC ")->result();
        }

        $data['vendors_info'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 order by name asc")->result();
        $this->load->view('admin/vendor/ledger', $data);
    }

    /* this function use for ledger_pdf */
    public function ledger_pdf(){
        require_once APPPATH.'third_party/pdfcrowd.php';

        $data = $this->input->post();
//        echo '<pre/>';
//        print_r($data);
//        die;

        $file_name = 'Vendor Ledger PDF -'.date('d_m_y');

        $html = vendor_ledger_pdf($data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($file_name, array("Attachment" => false));
    }

    /* this function use for vendor po activity */
    public function vendor_po_activity($vendor_id)
    {
        $activity_log = array();
        $where = "po.vendor_id = '".$vendor_id."' and po.show_list  = '1'";
        $activitylog = $this->db->query("SELECT poa.po_id FROM `tblpurchaseorderactivity` as poa LEFT JOIN `tblpurchaseorder` as po ON po.id = poa.po_id WHERE ".$where." GROUP BY po.id ORDER BY po.id DESC  ")->result();
        if (!empty($activitylog)){
            foreach ($activitylog as $value) {
                $po_activity = $this->db->query("SELECT * FROM `tblpurchaseorderactivity` WHERE po_id = '".$value->po_id."' ORDER BY id DESC LIMIT 5")->result();
                if(!empty($po_activity)){
//                    krsort($po_activity);
                    $activity_log[$value->po_id] = $po_activity;
                }
            }
        }

        $data['activity_log'] = $activity_log;

        $data["vendor_id"] = $vendor_id;
        $vendor_name = value_by_id("tblvendor", $vendor_id, "name");
        $data['title'] = $vendor_name.' (Purchase Order Activities)';
        $this->load->view('admin/vendor/purchaseorder_activity', $data);
    }

    public function get_last_po_conversion()
    {
       if(!empty($_POST)){
            extract($this->input->post());

            $activity_log = $this->db->query("SELECT * FROM `tblpurchaseorderactivity` WHERE id < '".$id."' AND po_id = '".$po_id."'  ORDER BY id DESC LIMIT 5")->result();

            $html = '';
            if(!empty($activity_log)){
                $i = 0;
                foreach ($activity_log as $key => $log) {

//                    if($i == 0){
                        $last_id = $log->id;
//                    }

                    $class = ($log->priority == 1) ? 'fa-star' : 'fa-star-o';

                    $cut = ($log->status == 2) ? 'line-throught' : '';

                    $ttl_reply = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblpurchaseorderactivity` WHERE `parent_id`= '".$log->id."'")->row()->ttl_count;
                    $html .= '<div class="col-md-12 replyboxdiv'.$log->id.'">';
                        $html .= '<div class="feed-item">
                                    <div class="date"><span class="text-has-action" data-toggle="tooltip">' . _dt($log->datetime) . '</span></div>
                                    <div class="text ' . $cut . '">
                                        <a href="#" val="'.$log->id.'" pri="'.$log->priority.'" onclick="return false;" class="priority" ><i class="fa ' . $class . '" aria-hidden="true"></i></a>';
                                        if ((get_staff_user_id() == $log->staffid) && ($log->status == 1)) {
                                            $html .= ' <a href="' . admin_url('follow_up/cut_po_conversation/' . $log->id) . '" ><i class="fa fa-ban" aria-hidden="true"></i></a>';
                                        }
                                        if (is_admin() == 1) {
                                            $html .= ' <a href="' . admin_url('follow_up/delete_po_conversation/' . $log->id) . '" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
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

            if(!empty($html) && !empty($last_id)){
                $json_arr = array( "html" => $html, "last_id" => $last_id);

                echo json_encode( $json_arr );
            }

       }
    }

    /* this function use for vendorbalancesheet */
    public function vendorbalancesheet(){
        check_permission(378,'view');
        $data['title'] = 'Vendor Tally Type Report';

        if ($this->input->post()) {
            extract($this->input->post());

            $where = "vendor_id = 0";
            if(!empty($vendor_id)){
                $data['vendor_id'] = $vendor_id;

                $where = "vendor_id ='".$vendor_id."' and po_id > 0";
            }

            if(!empty($f_date) && !empty($t_date)){

                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $where .= " and date  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }

            $invoice_data = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE ".$where." ORDER BY id DESC ")->result();

            $data['invoicelist'] = getvendorbalancesheet($invoice_data);
        }

        $data['vendors_info'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 order by name asc")->result();
        $this->load->view('admin/vendor/vendor_balance_sheet', $data);
    }

    public function update_audit_status($vendor_id=0){
       if ($this->input->post()) {
           extract($this->input->post());

           $updata["audit_status"] = $audit_status;
           $updata["audit_remark"] = $audit_remark;
           $updata["audit_by"] = get_staff_user_id();
           $updata["audit_datetime"] = date('Y-m-d H:i:s');
           $update = $this->home_model->update("tblvendor", $updata, array("id" => $vendor_id));

           if ($update){
               if ($audit_status == 1){
                  $this->home_model->update("tblpurchaseorder", array("audit_status"=> $audit_status), array("vendor_id" => $vendor_id, "status" => 1));
               }
               set_alert('success', "Update Audit Status Successfully");
           }
           else{
             set_alert('danger', "Somthing went wrong");
           }
           redirect(admin_url('vendor'));
       }
       $vendor_info = $this->db->query("SELECT `audit_status`,`audit_remark`,`audit_by`,`audit_datetime` FROM `tblvendor` WHERE `id` =".$vendor_id." ")->row();
       if (!empty($vendor_info)){
         echo '<div class="col-md-12">';
         if ($vendor_info->audit_by > 0){
    ?>
          <div class="col-md-6">
            <div class="card label-info">
                <div class="card-body ">
                    <h4 class="card-title">Old Audit Person :</h4>
                    <p class="card-text">
                      <div class="form-group" style="font-size: 15px;color:#000"><?php echo get_employee_fullname($vendor_info->audit_by); ?></div>
                    </p>
                </div>
            </div>
          </div>
        <?php } if (!empty($vendor_info->audit_datetime) && $vendor_info->audit_datetime != '0000-00-00 00:00:00'){ ?>
          <div class="col-md-6">
              <div class="card label-info">
                  <div class="card-body ">
                      <h4 class="card-title">Last Audit On :</h4>
                      <p class="card-text">
                        <div class="form-group" style="font-size: 15px;color:#000"><?php echo _d($vendor_info->audit_datetime); ?></div>
                      </p>
                  </div>
              </div>
          </div>
    <?php
          }
          echo '</div>'
          ?>
          <div class="col-md-12">
            <br>
              <div class="form-group">
                  <label for="" class="control-label">Audit Status</label>
                  <select class="form-control selectpicker" required id="audit_status" name="audit_status" data-live-search="true">
                      <option value=""></option>
                      <option value="1" <?php echo (!empty($vendor_info) && $vendor_info->audit_status == "1") ? "selected":"";?>>Yes</option>
                      <option value="2" <?php echo (!empty($vendor_info) && $vendor_info->audit_status == "2") ? "selected":"";?>>No</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="" class="control-label">Audit Remark</label>
                  <textarea class="form-control" required id="audit_remark" name="audit_remark"><?php echo (!empty($vendor_info->audit_remark)) ? $vendor_info->audit_remark : ""; ?></textarea>
              </div>
              <input type="hidden" name="vendor_id" value="<?php echo $vendor_id; ?>">
          </div>
          <?php
       }

    }

    /* this function use for get audit information */
    public function get_audit_info($vendor_id){
        $vendor_info = $this->db->query("SELECT `audit_status`,`audit_remark`,`audit_by`,`audit_datetime` FROM `tblvendor` WHERE `id` =".$vendor_id." ")->row();
        if (!empty($vendor_info)){
            $audit_status = ($vendor_info->audit_status == 1) ? "Yes" : "No";
            $audit_remark = (!empty($vendor_info->audit_remark)) ? $vendor_info->audit_remark : "--";
            $audit_date = (!empty($vendor_info->audit_datetime) && $vendor_info->audit_datetime != '0000-00-00 00:00:00') ? _d($vendor_info->audit_datetime) : "--";
            $audit_by = ($vendor_info->audit_by > 0) ? get_employee_fullname($vendor_info->audit_by) : "--";
            echo '<div class="col-md-12">
                    <div class="col-md-6">
                      <div class="card label-info">
                          <div class="card-body ">
                              <h4 class="card-title">Old Audit Person :</h4>
                              <p class="card-text">
                                <div class="form-group" style="font-size: 15px;color:#000">'. $audit_by.'</div>
                              </p>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card label-info">
                            <div class="card-body ">
                                <h4 class="card-title">Last Audit On :</h4>
                                <p class="card-text">
                                  <div class="form-group" style="font-size: 15px;color:#000">'.$audit_date.'</div>
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="card label-info">
                            <div class="card-body ">
                                <h4 class="card-title">Audit Status :</h4>
                                <p class="card-text">
                                  <div class="form-group" style="font-size: 15px;color:#000">'.$audit_status.'</div>
                                </p>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="card label-info">
                            <div class="card-body ">
                                <h4 class="card-title">Audit Remark :</h4>
                                <p class="card-text">
                                  <div class="form-group" style="font-size: 15px;color:#000">'.$audit_remark.'</div>
                                </p>
                            </div>
                        </div>
                      </div>
                </div>';
        }
    }

    public function vendor_contact($vendor_id){
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$vendor_id."' ")->row();
        $data['vendor_contacts'] = $this->db->query("SELECT * FROM `tblcontactsmaster` where `ref_table`='tblvendor' and ref_id =  '".$vendor_id."' ")->result();
        $data["title"] = "Vendor Contact List";
        $data["vendor_id"] = $vendor_id;
        $this->load->view("admin/vendor/vendor_contact", $data);
    }

    public function add_vendor_contact($vendor_id){

        if ($this->input->post()) {
            extract($this->input->post());

            if (!empty($vendordata)){
                foreach ($vendordata as $value) {
                    $contactdata["ref_table"] = 'tblvendor';
                    $contactdata["ref_id"] = $vendor_id;
                    $contactdata["name"] = cc($value["name"]);
                    $contactdata["email"] = $value["email"];
                    $contactdata["phonenumber"] = $value["phonenumber"];
                    $contactdata["designation_id"] = $value["designation_id"];
                    // $contactdata["contact_type"] = $value["contact_type"];
                    $this->home_model->insert("tblcontactsmaster", $contactdata);
                }
                set_alert('success', "Contacts added successfully");
            }
            redirect(admin_url('vendor/vendor_contact/'.$vendor_id));
        }
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();

        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $data['vendor_info'] = $this->db->query("SELECT * FROM `tblvendor` where id =  '".$vendor_id."' ")->row();
        $data["title"] = "Vendor Contact List";
        $this->load->view("admin/vendor/vendor_addcontact", $data);
    }

    public function checkmail() {
		$vendormail=$this->input->post('vendormail');
		$this->db->where('email', $vendormail);
	    $contactdata= $this->db->get('tblcontactsmaster')->row();
		$contactdata= (array) $contactdata;
		echo json_encode(array('totalcontact'=>count($contactdata)));
    }
	
	public function checkcontno() {
		$venderno=$this->input->post('venderno');
		$this->db->where('phonenumber', $venderno);
	    $contactdata= $this->db->get('tblcontactsmaster')->row();
		$contactdata= (array) $contactdata;
		echo json_encode(array('totalcontact'=>count($contactdata)));
    }

    public function vendor_deletecontact($id){
        $response = $this->home_model->delete("tblcontactsmaster", array("id" => $id));
        if ($response){
            set_alert('success', "Contacts delete successfully");
        }
        redirect($_SERVER['HTTP_REFERER']); die;
    }
}
