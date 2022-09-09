<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Site_manager extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Site_manager_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission(81,'view');

        $this->load->view('admin/site_manager/manage');
    }

    public function table() {
        $this->app->get_table_data('site_manager');
    }

    public function site_manager($id = '') {
    	check_permission(81,'create');
        if ($this->input->post()) {
            $site_manager_data = $this->input->post();
            
			
			
            if ($id == '') {

            	$exist_site = $this->db->query("SELECT `id` from `tblsitemanager` where name = '".$site_manager_data['name']."' and state_id = '".$site_manager_data['state_id']."' and city_id = '".$site_manager_data['city_id']."' and pincode = '".$site_manager_data['pincode']."' ")->row();
            	if(!empty($exist_site)){
            		 set_alert('warning', 'This site is already exist!');
            		 redirect(admin_url('site_manager'));
            		 die;

            	}

				if($this->input->post('newsitemanager')=='1')
				{
					unset($site_manager_data['newsitemanager']);
					$id = $this->Site_manager_model->add($site_manager_data);
					$sitemanager=(array) $this->Site_manager_model->get();
					echo json_encode($sitemanager);exit;
				}
                $id = $this->Site_manager_model->add($site_manager_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('site_manager')));
                    
                    redirect(admin_url('site_manager'));
                }
            } else {
            	check_permission(81,'edit');
                $success = $this->Site_manager_model->edit($site_manager_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('site_manager')));
                }

                redirect(admin_url('site_manager'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('site_lowercase'));
        } else {
            $data['site_manager'] = (array) $this->Site_manager_model->get($id);
            $title = _l('edit', _l('site_lowercase'));
        }

        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['city_data'] = array();
        if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
        
        $data['title'] = $title;
        
        $this->load->view('admin/site_manager/site_manager', $data);
    }

    public function addcomp() {
		$cdata['company']=$this->input->post('comp_name');
		$cdata['registration_confirmed']=1;
		//$cdata['created_at'] = date("Y-m-d H:i:s");
		//$cdata['updated_at'] = date("Y-m-d H:i:s");
		$this->db->insert('tblclients',$cdata);
		$insert_id = $this->db->insert_id();
		echo'<option value="'.$insert_id.'" selected=selected>'.$this->input->post('comp_name').'</option>';
	}
	
    public function addcompbranch() {
		$cdata['client_branch_name']=$this->input->post('comp_branch_name');
		$cdata['client_id']=$this->input->post('company');
		$cdata['registration_confirmed']=1;
		//$cdata['created_at'] = date("Y-m-d H:i:s");
		//$cdata['updated_at'] = date("Y-m-d H:i:s");
		$this->db->insert('tblclientbranch',$cdata);
		$insert_id = $this->db->insert_id();
		echo'<option value="'.$insert_id.'" selected=selected>'.$this->input->post('comp_branch_name').'</option>';
	}
	
	public function delete($id) {
		check_permission(81,'delete');
        $success = $this->Site_manager_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('site_manager')));
            if (strpos($_SERVER['HTTP_REFERER'], 'site_manager/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('site_manager'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('site_lowercase')));
            redirect(admin_url('site_manager/site_manager/' . $id));
        }
    }

    /* Change Site Manager status / active / inactive */

    public function change_site_manager_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $site_manager_data = array(
                'status' => $status
            );

            $this->Site_manager_model->edit($site_manager_data, $id);
        }
    }
    
	 
	
    public function get_cities_by_state_id($state_id) {
        $cityArr = $this->Site_manager_model->get_cities_by_state_id($state_id);
        
        if(count($cityArr) == 0) {
            echo "";
            exit;
        }
        
        echo json_encode($cityArr);
        exit;
    }
	
	
	public function get_subcat_by_cat_id($state_id) {
        $cityArr = $this->Site_manager_model->get_subcat_by_cat_id($state_id);
        
        if(count($cityArr) == 0) {
            echo "";
            exit;
        }
        
        echo json_encode($cityArr);
        exit;
    }
	
	public function get_product_by_cat_id($state_id) {
		
		
        $cityArr = $this->Site_manager_model->get_product_by_cat_id($state_id);
        
        if(count($cityArr) == 0) {
            echo "";
            exit;
        }
        
        echo json_encode($cityArr);
        exit;
    }
	
	public function getsitedetails() {
		$site_id=$this->input->post('site_id');
		$this->db->where('id', $site_id);
	    $sitedata= $this->db->get('tblsitemanager')->row();
		$sitedata= (array) $sitedata;
		$get_state_details=$this->db->query("SELECT * FROM `tblstates` WHERE `id`='".$sitedata['state_id']."'")->row_array();
		$get_city_details=$this->db->query("SELECT * FROM `tblcities` WHERE `id`='".$sitedata['city_id']."'")->row_array();
		echo json_encode(array('name'=>$sitedata['name'],'location'=>$sitedata['location'],'address'=>$sitedata['address'],'description'=>$sitedata['description'],'state_id'=>$sitedata['state_id'],'state_name'=>$get_state_details['name'],'city_name'=>$get_city_details['name'],'city_id'=>$sitedata['city_id'],'landmark'=>$sitedata['landmark'],'pincode'=>$sitedata['pincode']));
    }


    public function getclientdtails() {
		$client_id=$this->input->post('client_id');
		$this->db->where('userid', $client_id);
	    $clientdata= $this->db->get('tblclientbranch')->row();
		$clientdata= (array) $clientdata;
		$get_state_details=$this->db->query("SELECT * FROM `tblstates` WHERE `id`='".$clientdata['state']."'")->row_array();
		$get_city_details=$this->db->query("SELECT * FROM `tblcities` WHERE `id`='".$clientdata['city']."'")->row_array();
		echo json_encode(array('name'=>$clientdata['client_branch_name'],'location'=>$clientdata['location'],'address'=>$clientdata['address'],'state_id'=>$clientdata['state'],'state_name'=>$get_state_details['name'],'city_name'=>$get_city_details['name'],'city_id'=>$clientdata['city'],'landmark'=>$clientdata['landmark'],'pincode'=>$clientdata['zip']));
    }
	
	public function getproddetails() {
		$prodid=$this->input->post('prodid');
                $is_temp_product=$this->input->post('is_temp_product');
		$check_gst=$this->input->post('check_gst');
		$rent_company_category=$this->input->post('rent_company_category');
		
		if($rent_company_category==''){
			$rent_company_category=1;
		}
                
                if ($is_temp_product == 0){
                    $this->db->where('id', $prodid);
                    $proddata= $this->db->get('tblproducts')->row();
                        $proddata= (array) $proddata;
						
                        // $rentprolist = array($proddata['rental_price_cat_a'], $proddata['rental_price_cat_b'], $proddata['rental_price_cat_c'], $proddata['rental_price_cat_d']);
                        if ($rent_company_category == 1)
                        {
                            $proprice = $proddata['rental_price_cat_a'];
                        } 
                        else if ($rent_company_category == 2) 
                        {
                            $proprice = $proddata['rental_price_cat_b'];
                        } 
                        else if ($rent_company_category == 3) 
                        {
                            $proprice = $proddata['rental_price_cat_c'];
                        } 
                        else if ($rent_company_category == 4) 
                        {
                            $proprice = $proddata['rental_price_cat_d'];
                        }
						// $min_rentprice = $proddata['purchase_price'];
						$min_rentprice = $proddata['price'];
                        $gstamt=(($min_rentprice*18)/100);
                        //$min_rentprice = min($rentprolist);
                        

                        $tax_rate = product_tax_rate($prodid);
                        $product_unit = get_product_unit($prodid);
						$hsn_code = '';
                        $hsn_info = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row();
						if (!empty($hsn_info)){
							$hsn_code = $hsn_info->field_value;
						}
						$sac_code = '';
						$sac_info = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row();
						if (!empty($sac_info)){
							$sac_code = $sac_info->field_value;
						}
                        echo json_encode(array('name'=>$proddata['sub_name'],'product_unit' => $product_unit,'product_remarks'=>$proddata['merging_remark'],'proprice'=>$min_rentprice,'gstamt'=>$gstamt,'pro_id'=>'PRO-ID'.$prodid,'hsn_code'=>$hsn_code,'min_rentprice'=>$min_rentprice,'tax_rate'=>$tax_rate,'sac_code'=>$sac_code,'tax'=>getProductTax($prodid)));
                }else{
                    $temp_product_info = $this->db->query("SELECT * from tbltemperoryproduct where id = '".$prodid."' ")->row(); 
                    $proddata= (array) $temp_product_info;
                    $product_unit = get_product_unit($prodid, 1);
                    $isVendorProduct = 1;
                
                    echo json_encode(array('name'=>$proddata['product_name'], 'product_unit' => $product_unit, 'product_remarks'=>$proddata['product_desc'],'proprice'=>$proddata['price'],'gstamt'=> 0.00,'pro_id'=>'TEMP-PRO-ID'.$prodid,'hsn_code'=>$proddata['hsn'],'sac_code'=>$proddata['sac'],'min_rentprice'=>0.00,'tax_rate'=>18.00,'tax'=>getProductTax($prodid), 'isVendorProduct'=>$isVendorProduct));
                }
		
		

    }
	
	public function getsaleproddetails() {
		$prodid=$this->input->post('prodid');
		$check_gst=$this->input->post('check_gst');
		$rent_company_category=$this->input->post('rent_company_category');
                $is_temp_product=$this->input->post('is_temp_product');
		if($rent_company_category==''){$rent_company_category=1;}
                
                if ($is_temp_product == 0){
                    $this->db->where('id', $prodid);
                    $proddata= $this->db->get('tblproducts')->row();
                    $proddata= (array) $proddata;
                    // $rentprolist = array($proddata['sale_price_cat_a'], $proddata['sale_price_cat_b'], $proddata['sale_price_cat_c'], $proddata['sale_price_cat_d']);
                    // if ($rent_company_category == 1)
                    // {
                    //         $proprice = $proddata['sale_price_cat_a'];
                    // } 
                    // else if ($rent_company_category == 2) 
                    // {
                    //         $proprice = $proddata['sale_price_cat_b'];
                    // } 
                    // else if ($rent_company_category == 3) 
                    // {
                    //         $proprice = $proddata['sale_price_cat_c'];
                    // } 
                    // else if ($rent_company_category == 4) 
                    // {
                    //         $proprice = $proddata['sale_price_cat_d'];
                    // }
                    // $gstamt=(($proprice*18)/100);
                    $gstamt=(($proddata['price']*18)/100);
                    //$min_rentprice = min($rentprolist);
                    // $min_rentprice = $proddata['purchase_price'];
                    $min_rentprice = $proddata['price'];

                    $tax_rate = product_tax_rate($prodid);
                    $product_unit = get_product_unit($prodid);
                    $unit_id = value_by_id_empty('tblproducts',$prodid,'unit_2');
                    
                    // $hsn_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row()->field_value;
                    // $sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row()->field_value;
                    $hsn_code = '';
					$hsn_info = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row();
					if (!empty($hsn_info)){
						$hsn_code = $hsn_info->field_value;
					}
					$sac_code = '';
					$sac_info = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row();
					if (!empty($sac_info)){
						$sac_code = $sac_info->field_value;
					}
                    echo json_encode(array('name'=>$proddata['sub_name'], 'product_unit_id' => $unit_id, 'product_unit' => $product_unit,'product_remarks'=>$proddata['merging_remark'],'proprice'=>$proddata['price'],'gstamt'=>$gstamt,'pro_id'=>'PRO-ID'.$prodid,'hsn_code'=>$hsn_code,'min_rentprice'=>$min_rentprice,'tax_rate'=>$tax_rate,'tax'=>getProductTax($prodid)));
                    
                }else{
                    $temp_product_info = $this->db->query("SELECT * from tbltemperoryproduct where id = '".$prodid."' ")->row(); 
                    $proddata= (array) $temp_product_info;
                    $product_unit = get_product_unit($prodid, 1);
                    $isVendorProduct = 1;
                    $unit_id = value_by_id_empty('tbltemperoryproduct',$prodid,'unit');
                    
                    echo json_encode(array('name'=>$proddata['product_name'], 'product_unit_id' => $unit_id, 'product_unit' => $product_unit, 'product_remarks'=>$proddata['product_desc'],'proprice'=>$proddata['price'],'gstamt'=> 0.00,'pro_id'=>'TEMP-PRO-ID'.$prodid,'hsn_code'=>$proddata['hsn'],'sac_code'=>$proddata['sac'],'min_rentprice'=>0.00,'tax_rate'=>18.00,'tax'=>getProductTax($prodid), 'isVendorProduct'=>$isVendorProduct));
                }
		
    }


    public function getPruchaseorderProductDetails() {
		$prodid=$this->input->post('prodid');
		$is_temp_product=$this->input->post('is_temp_product');
		$vendor_id=$this->input->post('vendor_id');
		$check_gst=$this->input->post('check_gst');
		$rent_company_category=$this->input->post('rent_company_category');
		if($rent_company_category==''){$rent_company_category=1;}
                
                if ($is_temp_product == 0){
                    $this->db->where('id', $prodid);
                    $proddata= $this->db->get('tblproducts')->row();
                        $proddata= (array) $proddata;
                        $proprice = $proddata['price'];
//                        $rentprolist = array($proddata['sale_price_cat_a'], $proddata['sale_price_cat_b'], $proddata['sale_price_cat_c'], $proddata['sale_price_cat_d']);
//                        if ($rent_company_category == 1)
//                        {
//                                
//                                $proprice = $proddata['sale_price_cat_a'];
//                        } 
//                        else if ($rent_company_category == 2) 
//                        {
//                                $proprice = $proddata['sale_price_cat_b'];
//                        } 
//                        else if ($rent_company_category == 3) 
//                        {
//                                $proprice = $proddata['sale_price_cat_c'];
//                        } 
//                        else if ($rent_company_category == 4) 
//                        {
//                                $proprice = $proddata['sale_price_cat_d'];
//                        }
                        $gstamt=(($proprice*18)/100);
                        //$min_rentprice = min($rentprolist);
//                        $min_rentprice = $proddata['purchase_price'];
                        $min_rentprice = $proprice;

                        $tax_rate = product_tax_rate($prodid);
                        $isVendorProduct = 0;
                        $vendorProductInfo = $this->db->query("SELECT product_name FROM `tblvendorproductsname` where vendor_id = '".$vendor_id."' and product_id = '".$prodid."' and status = 1 ")->row();
                        if(!empty($vendorProductInfo)){
                                $isVendorProduct = 1;
                        }
                        $product_unit = get_product_unit($prodid);
                        $unit_id = value_by_id_empty('tblproducts',$prodid,'unit_2');
                        
                        // $hsn_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row()->field_value;
                        // $sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row()->field_value;
						$hsn_code = '';
						$hsn_info = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row();
						if (!empty($hsn_info)){
							$hsn_code = $hsn_info->field_value;
						}
						$sac_code = '';
						$sac_info = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$prodid."' ")->row();
						if (!empty($sac_info)){
							$sac_code = $sac_info->field_value;
						}
                        echo json_encode(array('name'=>$proddata['sub_name'], 'product_unit_id' => $unit_id, 'product_unit' => $product_unit, 'product_remarks'=>$proddata['merging_remark'],'proprice'=>$proprice,'gstamt'=>$gstamt,'pro_id'=>'PRO-ID'.$prodid,'hsn_code'=>$hsn_code,'min_rentprice'=> $min_rentprice,'tax_rate'=>$tax_rate,'tax'=>getProductTax($prodid), 'isVendorProduct'=>$isVendorProduct));
                }else{
                    $temp_product_info = $this->db->query("SELECT * from tbltemperoryproduct where id = '".$prodid."' ")->row(); 
                    $proddata= (array) $temp_product_info;
                    $product_unit = get_product_unit($prodid, 1);
                    $isVendorProduct = 1;
                    $unit_id = value_by_id_empty('tbltemperoryproduct',$prodid,'unit');
                
                    echo json_encode(array('name'=>$proddata['product_name'], 'product_unit_id' => $unit_id, 'product_unit' => $product_unit, 'product_remarks'=>$proddata['product_desc'],'proprice'=>$proddata['price'],'gstamt'=> 0.00,'pro_id'=>'TEMP-PRO-ID'.$prodid,'hsn_code'=>$proddata['hsn'],'min_rentprice'=>0.00,'tax_rate'=>18.00,'tax'=>getProductTax($prodid), 'isVendorProduct'=>$isVendorProduct));
                }
    }
	
	public function getclientbranchdetails() {
		$client_branch_id=$this->input->post('client_branch_id');

		$branch_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$client_branch_id."'")->row();



		$this->db->where('userid', $client_branch_id);
	    $clientbranchdata= $this->db->get('tblclientbranch')->row();
		$clientbranchdata= (array) $clientbranchdata;
		echo json_encode(array('client_person_name'=>$clientbranchdata['client_person_name'],'website'=>$clientbranchdata['website'],'client_cat_id'=>$clientbranchdata['client_cat_id'],'vat'=>$clientbranchdata['vat'],'city'=>$clientbranchdata['city'],'state'=>$clientbranchdata['state'],'cin_no'=>$clientbranchdata['cin_no'],'email_id'=>$clientbranchdata['email_id'],'phone_no_1'=>$clientbranchdata['phone_no_1'],'phone_no_2'=>$clientbranchdata['phone_no_2'],'address'=>$clientbranchdata['address'],'location'=>$clientbranchdata['location'],'landmark'=>$clientbranchdata['landmark'],'zip'=>$clientbranchdata['zip'],'pan_no'=>$clientbranchdata['pan_no']));
    }
	
	public function getcontpersondetails() {
		$contactid=$this->input->post('contactid');
		$this->db->where('id', $contactid);
	    $contactdata= $this->db->get('tblcontacts')->row();
		$contactdata= (array) $contactdata;
		echo json_encode(array('phonenumber'=>$contactdata['phonenumber'],'email'=>$contactdata['email'],'designation_id'=>$contactdata['designation_id']));
    }
	
	public function checkmail() {
		$clientmail=$this->input->post('clientmail');
		$this->db->where('email', $clientmail);
	    $contactdata= $this->db->get('tblcontacts')->row();
		$contactdata= (array) $contactdata;
		echo json_encode(array('totalcontact'=>count($contactdata)));
    }
	
	public function checkcontno() {
		$clientno=$this->input->post('clientno');
		$this->db->where('phonenumber', $clientno);
	    $contactdata= $this->db->get('tblcontacts')->row();
		$contactdata= (array) $contactdata;
		echo json_encode(array('totalcontact'=>count($contactdata)));
    }
	
	public function getcontactdata() {
		$client_branch_id=$this->input->post('client_branch_id');
		$this->db->where('userid', $client_branch_id);
	    $contactdata= $this->db->get('tblcontacts')->result_array();
		echo json_encode($contactdata);
    }
    
	public function getprostock() {
		$proid=$this->input->post('proid');
		$warehouseid=$this->input->post('warehouseid');
		$service_type=$this->input->post('service_type');
		$checkwarehousedet = $this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE store = 1 and department_id = 0 and stock_type = 1 and staff_id = 0 and `pro_id`='".$proid."' AND `service_type`='".$service_type."' AND (`warehouse_id`='".$warehouseid ."')")->row_array();
	//	echo $this->db->last_query();
		if($checkwarehousedet['totalqty']!='')
		{
		echo $checkwarehousedet['totalqty'];
		}
		else
		{
			echo'0';
		}
	}
	
	public function approvchalan() {
		$chalan_id=$this->input->post('chalan_id');
		$approval=$this->input->post('approval');
		$approval_desc=$this->input->post('approval_desc');
		if($approval==1)
		{
			$apdata['approve_status']=$approval;
			$apdata['approvereason']=$approval_desc;
			$apdata['updated_at']=date('Y-m-d h:i:s');
			$this->db->where('challan_id', $chalan_id);
			$this->db->where('staff_id', get_staff_user_id());
			$this->db->update('tblchallanapproval', $apdata);
			
			$getchalandata=$this->db->query("SELECT addedfrom,chalanno,warehouse_id,service_type,original_chalan_id FROM `tblcreatedchalanmst` WHERE `id`='".$chalan_id."'")->row_array();
			$getchalandetails=$this->db->query("SELECT * FROM `tblcreatedchalandetailsmst` WHERE `chalan_id`='".$chalan_id."'")->result_array();
			foreach($getchalandetails as $singlechalandetails)
			{
				$component_id=$singlechalandetails['component_id'];
				$deleverable_qty=$singlechalandetails['deleverable_qty'];
				$warehouse_id=$getchalandata['warehouse_id'];
				$service_type=$getchalandata['service_type'];
				$challanid=$getchalandata['original_chalan_id'];
				$getcchalandet=$this->db->query("SELECT * FROM `tblchalandetailsmst` WHERE `component_id`='".$component_id."' and `chalan_id`='".$challanid."'")->row_array();
				$required_qty=$getcchalandet['required_qty']-$deleverable_qty;
				
				$cddata['required_qty']=$required_qty;
				$this->db->where('component_id', $component_id);
				$this->db->where('chalan_id', $challanid);
				$this->db->update('tblchalandetailsmst', $cddata);
				$getcompstock=$this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$component_id."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."'")->row_array();
				$qty=$getcompstock['qty']-$deleverable_qty;
				$stkdata['qty']=$qty;
				$this->db->where('pro_id', $component_id);
				$this->db->where('warehouse_id', $warehouse_id);
				$this->db->where('service_type', $service_type);
				$this->db->update('tblprostock', $stkdata);
			}
			$staffid=$getchalandata['addedfrom'];
			$notified = add_notification([
						'description' => 'Challan '.$getchalandata['chalanno'].' Approved Successfully ',
						'touserid' => $staffid,
						'fromuserid' => get_staff_user_id(),
						'link' => 'chalan/pdf/'.$chalan_id,
						'additional_data' => serialize([
								//$proposal->subject,
						]),
					]);
					if ($notified) {
						pusher_trigger_notification([$staffid]);
					}
		}
	}
	
	
public function approvstocktransfer() {
		$stocktransfer_id=$this->input->post('stock_transfer_id');
		$approval=$this->input->post('approval');
		$approval_desc=$this->input->post('approval_desc');

		//Update master approval
        update_masterapproval_single(get_staff_user_id(),2,$stocktransfer_id,$approval);
        update_masterapproval_all(2,$stocktransfer_id,$approval);
		if($approval==1)
		{
			$apdata['approve_status']=$approval;
			$apdata['approvereason']=$approval_desc;
			$apdata['updated_at']=date('Y-m-d h:i:s');
			$this->db->where('stocktransfer_id', $stocktransfer_id);
			$this->db->where('staffid', get_staff_user_id());
			$this->db->update('tbltransferstockapproval', $apdata);
			
			$getchalandata=$this->db->query("SELECT * FROM `tblstocktransfer` WHERE `id`='".$stocktransfer_id."'")->row_array();
			$getchalandetails=$this->db->query("SELECT * FROM `tblprotransferstock` WHERE `stocktransfer_id`='".$stocktransfer_id."'")->result_array();
			foreach($getchalandetails as $singlechalandetails)
			{
				$component_id=$singlechalandetails['product_id'];
				$deleverable_qty=$singlechalandetails['transfer_qty'];
				$warehouse_id=$getchalandata['warehouse_id'];
				$to_warehouse_id=$getchalandata['to_warehouse_id'];
				$service_type=$getchalandata['service_type'];
				
				
				/*$getcompstock=$this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$component_id."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."' and `stock_type` = 1 and `status` = 1 ")->row_array();
				$qty=$getcompstock['qty']-$deleverable_qty;
				$stkdata['qty']=$qty;
				$this->db->where('pro_id', $component_id);
				$this->db->where('warehouse_id', $warehouse_id);
				$this->db->where('service_type', $service_type);
				$this->db->update('tblprostock', $stkdata);*/



				//Less stock from warehouse
				$formwarehouse_info=$this->db->query("SELECT * FROM `tblprostock` WHERE stock_type = 1 and store = 1 and department_id = 0 and staff_id = 0 and `warehouse_id`='".$warehouse_id."' AND `service_type`='".$service_type."' AND `pro_id`='".$component_id."'")->row_array();
				if(!empty($formwarehouse_info)){
					$lessqty=$formwarehouse_info['qty']-$deleverable_qty;
					$lessdata['qty']=$lessqty;
					$this->db->where('id', $formwarehouse_info['id']);
					$this->db->update('tblprostock', $lessdata);
				}
				


				//Add stock from warehouse
				if($service_type==1)
				{
					$servicetype=2;
				}
				else if($service_type==2)
				{
					$servicetype=1;
				}
				$gettocompstock=$this->db->query("SELECT * FROM `tblprostock` WHERE stock_type = 1 and store = 1 and department_id = 0 and staff_id = 0 and `pro_id`='".$component_id."' and `warehouse_id`='".$to_warehouse_id."' and `service_type`='".$servicetype."'")->row_array();
				$toqty=$gettocompstock['qty']+$deleverable_qty;
				$tostkdata['qty']=$toqty;
				
				$checkprostock=$this->db->query("SELECT * FROM `tblprostock` WHERE stock_type = 1 and store = 1 and department_id = 0 and staff_id = 0 and `warehouse_id`='".$to_warehouse_id."' AND `service_type`='".$servicetype."' AND `pro_id`='".$component_id."'")->result_array();
				if(count($checkprostock)==0)
				{
					$sdta['pro_id']=$component_id;
					$sdta['warehouse_id']=$to_warehouse_id;
					$sdta['service_type']=$servicetype;
					$sdta['stock_type']=1;
					$sdta['store']=1;
					$sdta['is_pro']=1;
					$sdta['status']=1;
					$sdta['created_at']=date('Y-m-d h:i:s');
					$sdta['updated_at']=date('Y-m-d h:i:s');
					$sdta['qty']=$toqty;
					$this->db->insert('tblprostock', $sdta);
				}
				else
				{
					$this->db->where('pro_id', $component_id);
					$this->db->where('warehouse_id', $to_warehouse_id);
					$this->db->where('service_type', $servicetype);
					$this->db->where('stock_type', 1);
					$this->db->where('store', 1);
					$this->db->update('tblprostock', $tostkdata);
				}
				
				
				
			}


			//Getting ware House Staff and Sending them notification
			$staff_info=$this->db->query("SELECT * FROM `tblstaff` WHERE `warehouse_id` = '".$getchalandata['to_warehouse_id']."'  ")->result();
			if(!empty($staff_info)){
				foreach ($staff_info as $value) {
					$staffid=$getchalandata['addedfrom'];
					$notified = add_notification([
						'description' => 'Stock Send For Transfer  '.$getchalandata['transferstockno'].' ',
						'touserid' => $value->staffid,
						'fromuserid' => $staffid,
						'link' => 'Stock/stock_inward/'.$stocktransfer_id,
						'additional_data' => serialize([
								//$proposal->subject,
						]),
					]);
					if ($notified) {
						pusher_trigger_notification([$value->staffid]);
					}
				}
			}



			$staffid=$getchalandata['addedfrom'];
			$notified = add_notification([
				'description' => 'Stock Transfer '.$getchalandata['transferstockno'].' Approved Successfully ',
				'touserid' => $staffid,
				'fromuserid' => get_staff_user_id(),
				'link' => 'Stock/view/'.$stocktransfer_id,
				'additional_data' => serialize([
						//$proposal->subject,
				]),
			]);
			if ($notified) {
				pusher_trigger_notification([$staffid]);
			}
		}
	}
	
	public function getclientbranchdata() {
		$company=$this->input->post('company');
		$this->db->where('client_id', $company);
	    $compbranchdata= $this->db->get('tblclientbranch')->result_array();
		echo json_encode($compbranchdata);
    }



    public function getclientcategory() {
		$client_id=$this->input->post('client_id');
		$this->db->where('userid', $client_id);
	    $clientdata= $this->db->get('tblclients')->row();
		echo $clientdata->client_cat_id;
    }

    public function export()
    { 
        
        $sitemanager_list = $this->db->query("SELECT * from tblsitemanager")->result();

        // create file name
        $fileName = 'site_manager.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Site Manager');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Site Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Location');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'State');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'City'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($sitemanager_list as $val) 
        { 
        	$state = value_by_id('tblstates',$val->state_id,'name');
        	$city = value_by_id('tblcities',$val->city_id,'name');
   
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val->location);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val->address);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $state);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $city);
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName); 
         
        

    }

	public function getproductdetails(){
		$prodid = $this->input->post("prodid");
		$is_temp_product = $this->input->post("is_temp_product");
		$producttype = $this->input->post("type");
		if ($is_temp_product == 1){
			$data["protype"] = 2;
			$data["productcode"] = "TEMP-PRO-ID".$prodid;
			$data["productinfo"] = $this->db->query("SELECT `product_name` as `name`, `product_name` as `sub_name`, `category_id` as `product_cat_id`,`unit` as `unit_id` FROM `tbltemperoryproduct` WHERE id =".$prodid)->row_array();
		}else{
			$data["protype"] = 1;
			$data["productcode"] = "PRO-ID".$prodid;
			$data["productinfo"] = $this->db->query("SELECT * FROM `tblproducts` WHERE id =".$prodid)->row_array();
			
		}
		$final_category = 1;
        $final_category_id = $data['productinfo']['product_cat_id'];
        if(!empty($data['productinfo']['product_sub_cat_id'])){
            $final_category_id = $data['productinfo']['product_sub_cat_id'];
            $final_category = 2;
        }if(!empty($data['productinfo']['parent_category_id'])){
            $final_category_id = $data['productinfo']['parent_category_id'];
            $final_category = 3;
        }if(!empty($data['productinfo']['child_category_id'])){
            $final_category_id = $data['productinfo']['child_category_id'];
            $final_category = 4;
        }

        $custom_category_info = $this->db->query("SELECT * FROM `tblproductcustomfieldscategory` where `final_category`='".$final_category."' and final_category_id = '".$final_category_id."' ")->row();
        if(!empty($custom_category_info)){
            $data['field_info'] = $this->db->query("SELECT f.*,fd.name,fd.type FROM `tblproductcustomfieldscategorydata` as f LEFT JOIN tblproductcustomfields as fd ON fd.id = f.field_id where f.main_id='".$custom_category_info->id."' and fd.status = '1' order by f.field_order asc ")->result();
        }
		$this->load->model('Taxes_model');
        $data['tax_data'] = $this->Taxes_model->get();
		$this->load->view('admin/proposals/getproductdetails', $data);
	}
}
