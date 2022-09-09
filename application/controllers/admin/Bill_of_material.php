<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Bill_of_material extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index()
    {

        check_permission(164,'view');
        //Getting Warehouse
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status='1' ORDER BY name ASC ")->result_array();

        //Getting services
        $this->load->model('Enquiryfor_model');
        $data['service_type'] = $this->Enquiryfor_model->get();

        //Getting Product
        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC ")->result_array();

        $data['title'] = 'Bill of Material';

        $this->load->view('admin/bill_of_material/view', $data);

    }

    public function item_tree()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $pro_data = array();
            foreach ($productdata as $key => $value) {
                $pro_data[] = array(
                                'product_qty' => $value['productid'].':'.$value['qty']
                            );
            }

            $data['pro_data'] = $pro_data;
            $data['warehouse_id'] = $warehouse_id[0];
            $data['service_type'] = $service_type[0];
           /* echo '<pre/>';
            print_r($pro_data);
            die;*/


            $data['product_data'] = $productdata;

            $data['title'] = 'Material Tree';
            $this->load->view('admin/bill_of_material/item_tree', $data);

        }



    }


    public function availability()
    {
        if(!empty($_POST)){
            extract($this->input->post());

             /*echo '<pre/>';
            print_r($_POST);
            die;*/

            $product_data = array();
            if(!empty($product_info)){
                foreach ($product_info as $key => $value) {
                    $val_arr = explode(':', $value);
                    $product_data[] = array(
                            'pro_id' => $val_arr[0],
                            'qty' =>  $val_arr[1]
                    );
                }
            }




            if(!empty($product_data)){
                $p_arr = array();
                foreach ($product_data as $key => $value) {
                    //For Item Array
                    global $nid_arr;
                    $a = createTreeArray($value['pro_id'],$nid_arr,0);
                    $a = ltrim($a,' - ');

                    $n_arr = explode(' - ', $a);
                    $f_arr = array();
                    if(!empty($n_arr)){
                        foreach ($n_arr as $key => $row) {
                            $val_arr = explode(':', $row);

                            if($val_arr[0] != $value['pro_id']){

                                 $f_arr[] = array('p_id'=>$val_arr[0],'qty'=>$val_arr[1]);
                            }


                        }
                    }
                    $p_arr[$value['pro_id']] = $f_arr;
                }





                $procomponentdata = array();
                foreach ($product_data as $key => $value) {
                    $itemsdata = array();
                     $i = 0;
                    $id_arr = array();
                    $pro_items_arr = $p_arr[$value['pro_id']];


                    foreach ($pro_items_arr as $key => $row) {

                       $item_id = $row['p_id'];
                       $req_qty = ($row['qty'] * $value['qty']);

                       if(!in_array($item_id, $id_arr)) {

                            $itemsdata[$i]['item_id'] = $item_id;
                            $itemsdata[$i]['req_qty'] = $req_qty;

                         $id_arr[] = $item_id;
                       }else{
                         $table = array_column($itemsdata, 'item_id');
                         //$tt = array_search($item_id, $table);
                         $tt = custom_array_column($item_id, $table);

                            $itemsdata[$i]['item_id'] = $item_id;
                            $itemsdata[$i]['req_qty'] = $itemsdata[$tt]['req_qty'] + $req_qty;

                       }
                       $i++;


                    }

                    $procomponentdata[] = super_unique($itemsdata);

                }

                $newprocomponentdata = array();
                foreach ($procomponentdata as $r) {
                    foreach ($r as $r1) {
                         $newprocomponentdata[] = $r1;
                    }

                }


                $componentdata = array();
                $j = 0;
                $item_arr = array();
                foreach ($newprocomponentdata as $r2) {
                    $item_id = $r2['item_id'];
                    $req_qty = $r2['req_qty'];

                    if(!in_array($item_id, $item_arr)) {
                        $componentdata[$j]['item_id'] = $item_id;
                        $componentdata[$j]['req_qty'] = $req_qty;

                        $item_arr[] = $item_id;
                    }else{
                        $table = array_column($componentdata, 'item_id');
                        $tt = custom_array_column($item_id, $table);

                        $componentdata[$j]['item_id'] = $item_id;
                        $componentdata[$j]['req_qty'] = $componentdata[$tt]['req_qty'] + $req_qty;
                    }
                    $j++;

                }



                $uniquecomponentdata = super_unique($componentdata);

                /*echo '<pre/>';
                print_r($uniquecomponentdata);
                die;*/

                //Adding record to the temp table
                $this->home_model->delete('tbltempbillofmaterial', array('user_id'=>get_staff_user_id()));

                foreach($uniquecomponentdata as $key => $r3) {
                    $pro_id = $r3['item_id'];
                    $req_qty = $r3['req_qty'];
                    $category_id = value_by_id('tblproducts',$pro_id,'product_cat_id');

                    if($service_type != 3){
                        $avail_qty  = $this->db->query("SELECT COALESCE(SUM(qty),0) AS ttl from tblprostock where `store` = 1  AND `department_id` = 0  AND `staff_id` = 0 and stock_type = 1  and  pro_id = '".$pro_id."' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and staff_id = 0 and status = 1 ")->row()->ttl;
                        $booked_qty  = $this->db->query("SELECT COALESCE(SUM(qty),0) AS ttl from tblprostock where `store` = 1  AND `department_id` = 0  AND `staff_id` = 0 and stock_type = 1  and  pro_id = '".$pro_id."' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and staff_id > 0 and status = 1 ")->row()->ttl;
                    }else{
                        $avail_qty  = $this->db->query("SELECT COALESCE(SUM(qty),0) AS ttl from tblprostock where `store` = 1  AND `department_id` = 0  AND `staff_id` = 0 and stock_type = 1  and  pro_id = '".$pro_id."' and warehouse_id = '".$warehouse_id."' and staff_id = 0 and status = 1 ")->row()->ttl;
                        $booked_qty  = $this->db->query("SELECT COALESCE(SUM(qty),0) AS ttl from tblprostock where `store` = 1  AND `department_id` = 0  AND `staff_id` = 0 and stock_type = 1  and  pro_id = '".$pro_id."' and warehouse_id = '".$warehouse_id."' and staff_id > 0 and status = 1 ")->row()->ttl;
                    }

                    $ad_data = array(
                                    'user_id' => get_staff_user_id(),
                                    'pro_id' => $pro_id,
                                    'warehouse_id' => $warehouse_id,
                                    'service_type' => $service_type,
                                    'category_id' => $category_id,
                                    'req_qty' => $req_qty,
                                    'avail_qty' => $avail_qty,
                                    'booked_qty' => $booked_qty,
                                    'created_at' => date('Y-m-d H:i:s')
                                );


                    $insert = $this->home_model->insert('tbltempbillofmaterial', $ad_data);
                }

                redirect(admin_url('bill_of_material/bom_items'));

            }

        }

    }


    public function bom_items()
    {
        $data['category_info'] = $this->db->query("SELECT * FROM `tblproductcategory` where status= '1' ")->result();


        if(!empty($_POST)){
            extract($this->input->post());
            $data['s_category'] = $category_id;
            $data['item_list'] = $this->db->query("SELECT * FROM `tbltempbillofmaterial` where user_id= '".get_staff_user_id()."' and category_id = '".$category_id."' ")->result();
        }else{
            $data['item_list'] = $this->db->query("SELECT * FROM `tbltempbillofmaterial` where user_id= '".get_staff_user_id()."' ")->result();
        }

        $data['title'] = 'Bill of Material Items';

        $this->load->view('admin/bill_of_material/bom_items', $data);

    }

    public function download_pdf()
    {
        require_once APPPATH.'third_party/pdfcrowd.php';


        $item_row = $this->db->query("SELECT * FROM `tbltempbillofmaterial` where user_id= '".get_staff_user_id()."' ")->row();
        $warehouse_id = $item_row->warehouse_id;
        $service_type = $item_row->service_type;
        $item_list = $this->db->query("SELECT * FROM `tbltempbillofmaterial` where user_id= '".get_staff_user_id()."' ")->result();


        $file_name = 'Requirement';

        /*echo $html = location_pdf($from_date,$to_date,$staff_id);
        die;*/

        $warehouse = value_by_id('tblwarehouse',$warehouse_id,'name');
        if($service_type == 1){
            $service_type = 'Rent';
        }elseif($service_type == 2){
            $service_type = 'Sale';
        }else{
            $service_type = 'Both Rent & Sale';
        }

        $html = requirement_pdf($item_list,$warehouse,$service_type);
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

    public function add_requirement()
    {
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($product_id)){
                foreach ($product_id as  $p_id) {
                    $req_qty = $_POST['req_qty'.$p_id];

                    $exist_info = $this->db->query("SELECT * FROM `tblcuttingrequirement` where product_id= '".$p_id."' and is_complete = 0 ")->row();

                    if(!empty($exist_info)){
                        $n_qty = ($exist_info->quantity+$req_qty);

                        $insert = $this->home_model->update('tblcuttingrequirement', array('quantity'=>$n_qty,'added_by'=>get_staff_user_id()), array('id'=>$exist_info->id));
                    }else{
                       $ad_data = array(
                            'added_by' => get_staff_user_id(),
                            'product_id' => $p_id,
                            'quantity' => $req_qty,
                            'is_complete' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        $insert = $this->home_model->insert('tblcuttingrequirement', $ad_data);
                    }
                }
                set_alert('success', 'Cutting Requirement Added Successfully');

            }else{
              set_alert('danger', 'Please select product for cutting !');
            }
            redirect(admin_url('bill_of_material/bom_items'));
        }

    }

    public function get_booked_items()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            if($service_type != 3){
                $booked_info  = $this->db->query("SELECT * from tblprostock where stock_type = 1  and  pro_id = '".$product_id."' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and staff_id > 0 and status = 1 ")->result();
            }else{
                $booked_info  = $this->db->query("SELECT * from tblprostock where stock_type = 1  and  pro_id = '".$product_id."' and warehouse_id = '".$warehouse_id."' and staff_id > 0 and status = 1 ")->result();
            }


            ?>
             <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Employee Name</th>
                        <th>Booked Qty</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(!empty($booked_info)){
                        $z=1;
                        foreach($booked_info as $row){


                            ?>

                            <tr>
                                <td><?php echo $z++;?></td>
                                <td><?php echo value_by_id('tblproducts',$row->pro_id,'name'); ?></td>
                                <td><?php echo get_employee_name($row->staff_id); ?></td>
                                <td><?php echo $row->qty; ?></td>



                            <?php
                        }
                    }else{
                        echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
                    }
                    ?>


                    </tbody>
                  </table>
            </div>



            <?php

        }

    }


}
