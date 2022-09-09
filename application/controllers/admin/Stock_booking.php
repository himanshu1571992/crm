<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stock_booking extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Stock_model');
         $this->load->model('home_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission(162,'view');

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC ")->result_array();
        $data['staff_list'] = get_staff_list();

        $data['s_staff_id'] = '';
        $data['s_item_id'] = '';

        if(!empty($_POST)){
            extract($this->input->post());

            $where = " b.status = 1 ";

            if(!empty($staff_id)){
                $where .= " and b.staff_id = '".$staff_id."' ";
                $data['s_staff_id'] = $staff_id;
            }

            if(!empty($item_id)){
                $where .= " and bd.product_id = '".$item_id."' ";
                $data['s_item_id'] = $item_id;
            }


            if(!empty($from_date) && !empty($to_date)){

                $data['s_from_date'] = $from_date;
                $data['s_to_date'] = $to_date;

                $from_date = str_replace("/","-",$from_date);
                $from_date = date("Y-m-d",strtotime($from_date));

                $to_date = str_replace("/","-",$to_date);
                $to_date = date("Y-m-d",strtotime($to_date));


                $where .= " and b.date BETWEEN '".$from_date."' and '".$to_date."' ";
            }

            $data['booking_info'] = $this->db->query("SELECT b.* FROM `tblstockbooking` as b INNER JOIN tblstockbookingproducts as bd ON b.id = bd.booking_id where $where GROUP BY bd.booking_id  ")->result();


        }else{
            $data['booking_info'] = $this->db->query("SELECT b.* FROM `tblstockbooking` as b INNER JOIN tblstockbookingproducts as bd ON b.id = bd.booking_id where b.staff_id = '".get_staff_user_id()."' and b.status = 1  GROUP BY bd.booking_id ")->result();
        }

        $data['title'] = 'Stock Booking Report';
        $this->load->view('admin/stock_booking/view', $data);
    }


     public function add($id = '') {

        check_permission(161,'create');

        if ($this->input->post()) {
                extract($this->input->post());
               /* echo '<pre/>';
                print_r($_POST);
                die;*/
            if ($id == '') {
                $ad_data = array(
                            'staff_id' => get_staff_user_id(),
                            'service_type' => $service_type,
                            'warehouse_id' => $warehouse_id,
                            'remark' => $remarks,
                            'status' => 1,
                            'date' => date('Y-m-d')
                        );


                    $insert = $this->home_model->insert('tblstockbooking', $ad_data);

                if($insert == true){
                    $booking_id = $this->db->insert_id();

                    if(!empty($componnetdata)){
                        foreach ($componnetdata as $value) {
                            $ad_data = array(
                                'booking_id' => $booking_id,
                                'product_id' => $value['product_id'],
                                'quantity' => $value['qty'],
                                'balanced_qty' => $value['qty'],
                                'remark' => $value['remarks']
                            );

                            $this->home_model->insert('tblstockbookingproducts', $ad_data);

                            //Update stock
                            $stock_info = $this->home_model->get_row('tblprostock', array('pro_id'=>$value['product_id'],'warehouse_id'=>$warehouse_id,'service_type'=>$service_type,'stock_type'=>1,'status'=>1),'');
                            if(!empty($stock_info)){

                                $balanced_qty = ($stock_info->qty - $value['qty']);

                                $this->home_model->update('tblprostock', array('qty'=>$balanced_qty) ,array('id'=>$stock_info->id));


                            }
                        }
                    }

                    set_alert('success', 'Stock booked successfully');
                    redirect(admin_url('stock_booking/add'));
                }
            } else {
                $success = $this->Stock_model->edit($stock_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('new_stock')));
                }
                redirect(admin_url('Stock'));
            }
        }
        if ($id == '') {
            $title = 'Stock Booking';
        } else {
            $data['stockdata'] = (array) $this->Stock_model->get($id);
            $data['prostockdata'] = $this->db->query("SELECT * FROM `tblprowarehousestock` WHERE `warehousestockid`='".$id."'")->result_array();
            $title = 'Edit Booking Stock';
        }

        $this->load->model('Enquiryfor_model');
        $data['service_type'] = $this->Enquiryfor_model->get();

        $compbranchid=$this->session->userdata('staff_user_id');//exit;
        $compnybranch_warehouse=$this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='".$compbranchid."' order by comp_branch_name asc")->row_array();
        $warehouseid=explode(',',$compnybranch_warehouse['warehouse_id']);
        foreach($warehouseid as $singlewarehouseid)
        {
            $warehousedata[]=$this->db->query("SELECT * FROM `tblwarehouse` where id='".$singlewarehouseid."' order by name asc")->row_array();
        }
        $data['all_warehouse'] = $warehousedata;

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC")->result_array();

        $this->load->model('Staffgroup_model');
        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock' order by name asc")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock' order by name asc")->result_array();
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
        $data['title'] = $title;
        $data['procategory']=$this->db->query("SELECT pc.* FROM `tblproductcategory` pc LEFT JOIN `tblcategorymultiselect` cm ON pc.`id`=cm.`category_id` LEFT JOIN `tblmultiselectmaster` ms ON ms.id=cm.multiselect_id WHERE ms.multiselect='Stock' GROUP BY pc.`id` order by name asc")->result_array();

        $this->load->view('admin/stock_booking/add', $data);
    }


    public function items($id) {

        $data['items_info'] = $this->db->query("SELECT * FROM `tblstockbookingproducts` where `booking_id`='".$id."' ")->result();


        $data['booking_info']  = $this->db->query("SELECT * FROM `tblstockbooking`  where id = '".$id."'  ")->row();

        if(get_staff_user_id() == $data['booking_info']->staff_id){
            $data['release'] = 1;
        }else{
            $data['release'] = 0;
        }
        $this->load->view('admin/stock_booking/items', $data);
    }

    public function release($id) {

        if ($this->input->post()) {
                extract($this->input->post());
                /*echo '<pre/>';
                print_r($_POST);
                die;*/

                if(!empty($row)){
                    foreach ($row as  $id) {

                        $available_qty = $_POST['avail_'.$id];
                        $release_qty = $_POST['qty_'.$id];
                        $booking_item = $this->db->query("SELECT * FROM `tblstockbookingproducts`  where id = '".$id."'  ")->row();

                        $booking_info = $this->db->query("SELECT * FROM `tblstockbooking`  where id = '".$booking_id."'  ")->row();

                        if($release_qty > 0){
                            $balanced_qty = ($available_qty - $release_qty);
                            $f_release_qty = ($release_qty + $booking_item->released_qty);


                            //Updating
                            $this->home_model->update('tblstockbookingproducts', array('released_qty'=>$f_release_qty, 'balanced_qty'=>$balanced_qty) ,array('id'=>$id));


                            //For Main Stock manage
                            if($release_for == 1){
                                $stock_info = $this->db->query("SELECT * FROM `tblprostock`  where pro_id = '".$booking_item->product_id."' and warehouse_id = '".$booking_info->warehouse_id."' and service_type = '".$booking_info->service_type."' and stock_type = 1 and status = 1")->row();

                                if(!empty($stock_info)){
                                    $f_qty = ($stock_info->qty + $release_qty);

                                    //updating stock
                                    $update = $this->home_model->update('tblprostock', array('qty'=>$f_qty) ,array('id'=>$stock_info->id));
                                }

                            }else{

                                 if($release_for == 2){
                                    $staff_id = get_staff_user_id();
                                 }

                                 $stock_info = $this->db->query("SELECT * FROM `tblprostock`  where pro_id = '".$booking_item->product_id."' and warehouse_id = '".$booking_info->warehouse_id."' and service_type = '".$booking_info->service_type."' and staff_id = '".$staff_id."' and stock_type = 1 and status = 1")->row();

                                if(!empty($stock_info)){
                                    $f_qty = ($stock_info->qty + $release_qty);

                                    //updating stock
                                    $update =  $this->home_model->update('tblprostock', array('qty'=>$f_qty) ,array('id'=>$stock_info->id));
                                }else{
                                   $ad_data = array(

                                            'pro_id' => $booking_item->product_id,
                                            'service_type' => $booking_info->service_type,
                                            'warehouse_id' => $booking_info->warehouse_id,
                                            'qty' => $release_qty,
                                            'stock_type' => 1,
                                            'is_pro' => 0,
                                            'staff_id' => $staff_id,
                                            'status' => 1,
                                            'created_at' => date('Y-m-d H:i:s'),
                                            'updated_at' => date('Y-m-d H:i:s'),
                                        );


                                    $update = $this->home_model->insert('tblprostock', $ad_data);
                                }
                            }


                        }

                    }

                    if ($update) {
                        set_alert('success', 'Stock Release successfully');
                    }
                    redirect(admin_url('stock_booking'));

                }
                die;

        }

        $data['items_info'] = $this->db->query("SELECT * FROM `tblstockbookingproducts` where `booking_id`='".$id."' ")->result();
        $data['booking_info'] = $this->db->query("SELECT * FROM `tblstockbooking`  where id = '".$id."'  ")->row();
        $data['staff_list'] = get_staff_list();




        $data['title'] = 'Booking Release';
        $this->load->view('admin/stock_booking/release', $data);
    }


     public function get_avail_stock() {
        if ($this->input->post()) {
            extract($this->input->post());
             $stock_info = $this->home_model->get_row('tblprostock', array('pro_id'=>$product_id,'warehouse_id'=>$warehouse_id,'service_type'=>$service_type,'stock_type'=>1,'status'=>1),'');


             if(!empty($stock_info)){
                echo $stock_info->qty;
             }else{
                echo 0;
             }
        }
    }
}
