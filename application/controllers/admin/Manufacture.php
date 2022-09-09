<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Manufacture extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('manufacture_model');
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
        check_permission(168,'view');

        $where = " id > '0' ";

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/

            if($status != ''){
                $data['s_status'] = $status;

                $where .= " and status = '".$status."'";
            }



            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }

        }


        $data['menufacture_list'] = $this->db->query("SELECT * from tblmanufacture where  ".$where." order by id desc ")->result();


        $data['title'] = 'Manufacture List';
        $this->load->view('admin/manufacture/view', $data);
    }


	public function add_stock($id = '') {
	 	check_permission(168,'create');
        if ($this->input->post()) {
			$post_data = $this->input->post();

            /*echo '<pre/>';
            print_r($post_data);
            die;*/
            if ($id == '') {

                $id = $this->manufacture_model->add_manufacture($post_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', 'Manufacture stock'));
                    redirect(admin_url('manufacture'));
                }
            } else {
            	/*check_permission(168,'edit');
                $success = $this->manufacture_model->update_event($event_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Event'));
                }

                redirect(admin_url('manufacture'));*/
            }
        }

        if ($id == '') {
            $title = 'Add Stock';
        } else {
            $data['event'] = (array) $this->attendance_model->get_event($id);
            $title = 'Edit Stock';
        }

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;

        $data['mr_list'] = $this->db->query("SELECT * from tblmaterialreceipt where extrusion = 1  and extrusion_status = 0 ")->result_array();

        $data['title'] = $title;
        $this->load->view('admin/manufacture/add_stock', $data);
    }


    public function details($id) {

        if(!empty($id)){
            $data['manufacture_info'] = $this->db->query("SELECT * from tblmanufacture where id = '".$id."'")->row();
            $data['product_info'] = $this->db->query("SELECT * from tblmanufactureproducts where m_id = '".$id."'")->result();


            $data['title'] = 'Manfacture Details';
            $this->load->view('admin/manufacture/details', $data);
        }

    }

    public function stock_approval($id) {

        if(!empty($id)){
            $data['manufacture_info'] = $this->db->query("SELECT * from tblmanufacture where id = '".$id."'")->row();
            $data['product_info'] = $this->db->query("SELECT * from tblmanufactureproducts where m_id = '".$id."'")->result();
            $data['id'] = $id;
        }

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            $status = 0;
            $ad_data = array(
                'approve_status' => $submit,
                'remark' => $remark,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $update = $this->home_model->update('tblmanufactureapproval', $ad_data,array('m_id'=>$id,'staff_id'=>get_staff_user_id()));

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),5,$id,$submit);

            //Getting Reject Info
            $reject_info = $this->db->query("SELECT * FROM `tblmanufactureapproval` where m_id='".$id."' and approve_status = 2 ")->row_array();
            if(!empty($reject_info)){
                $status = 2;
                $this->home_model->update('tblmanufacture', array('status'=>2),array('id'=>$id));
            }else{
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblmanufactureapproval` where m_id='".$id."' and approve_status = 1 ")->row()->ttl_count;
                if($approval_count >= 2){
                    $status = 1;
                    $this->home_model->update('tblmanufacture', array('status'=>1,'date'=>date('Y-m-d')),array('id'=>$id));
                }
            }

            $approval_info = $this->db->query("SELECT * FROM `tblmanufactureapproval` where m_id='".$id."' and ( approve_status = 0 || approve_status = 2 ) ")->row_array();
            if(empty($approval_info)){
                $status = 1;
                $this->home_model->update('tblmanufacture', array('status'=>1,'date'=>date('Y-m-d')),array('id'=>$id));
            }

            //Update master approval
            update_masterapproval_all(5,$id,$status);
            if($update){

                //Add Stock for manufacturing
                if($status == 1){
                    $product_info = $this->db->query("SELECT * from tblmanufactureproducts where m_id = '".$id."'")->result();
                    if(!empty($product_info)){
                        foreach ($product_info as $row) {
                            $bundle_info = $this->db->query("SELECT * from tblmanufactureproductbundles where mp_id = '".$row->id."'")->result();

                            if(!empty($bundle_info)){
                                foreach ($bundle_info as $value) {

                                    $size = value_by_id('tblproducts',$row->product_id,'size');
                                    $mr_info = $this->db->query("SELECT * from tblmaterialreceipt where id = '".$id."'")->row();
                                   $stock_data = array(
                                        'parent_id' => 0,
                                        'm_id' => $id,
                                        'warehouse_id' => $mr_info->warehouse_id,
                                        'service_type' => $mr_info->service_type,
                                        'product_id' => $row->product_id,
                                        'bundle_no' => $value->bundle_no,
                                        'qty' => $value->qty,
                                        'size' => $size,
                                        'weight_per_psc' => $value->weight_per_psc,
                                        'bundle_weight' => $value->bundle_weight,
                                        'waste' => 0,
                                        'status' => 1
                                    );

                                    $insert = $this->home_model->insert('tblmanufacturestock', $stock_data);
                                }
                            }

                        }
                    }
                }

                set_alert('success', 'Status updated succesfully');
                redirect(admin_url('manufacture/pending_stock_approval'));
            }

        }

        $data['appvoal_info'] = $this->db->query("SELECT * from tblmanufactureapproval where m_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();

        $data['title'] = 'Manfacture Stock Approval';
        $this->load->view('admin/manufacture/stock_approval', $data);

    }


    public function pending_stock_approval() {
        check_permission(169,'view');
        $where = " pa.staff_id = '".get_staff_user_id()."' and pa.approve_status = 0 ";

        if(!empty($_POST)){
            extract($this->input->post());

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

                $where .= " and p.date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
        }

        $data['menufacture_list'] = $this->db->query("SELECT p.* from tblmanufacture as p LEFT JOIN tblmanufactureapproval as pa ON p.id = pa.m_id where ".$where." group by p.id ORDER BY p.id desc  ")->result();


        $data['title'] = 'Pending Stock Approval';
        $this->load->view('admin/manufacture/pending_stock_approval', $data);
    }

    public function get_product_table() {
    	extract($this->input->post());


		$product_info=$this->db->query("SELECT * FROM `tblmaterialreceiptproduct` WHERE `mr_id`='".$mr_id."' and qty > 0")->result();

		/*echo '<pre/>';
		print_r($product_info);
		die;*/
    	?>
    	 <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">MR Product List </h4>
                        </div>
						<hr/>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                        <thead>
                                            <tr>
                                                <td style="width:10%">S.No</td>
                                                <td style="width:40%">Pro Name</td>
                                                <td style="width:10%">Pro ID</td>
                                                <td style="width:10%">Qty</td>
                                                <td style="width:10%">Unit</td>
                                                <td style="width:20%">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($product_info)){
                                        	$i = 1;
                                        	foreach ($product_info as $value) {
                                        		$unit_id =  value_by_id('tblproducts',$value->product_id,'unit_id');
                                        		?>
                                        		<tr>
	                                                <td><?php echo $i++;?></td>
	                                                <td><?php echo value_by_id('tblproducts',$value->product_id,'sub_name');?></td>
	                                                <td><?php echo 'PRO-ID'.$value->product_id;?></td>
	                                                <td><?php echo $value->qty;?></td>
	                                                <td><?php echo value_by_id('tblunitmaster',$unit_id,'name');?></td>

	                                                <td>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#fieldmodel_<?php echo $value->product_id; ?>">Add Bundles</button>
                                                    </div>

                                                    <div id="fieldmodel_<?php echo $value->product_id; ?>" class="modal fade" role="dialog">
                                                      <div class="modal-dialog modal-lg">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Add Bundles</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                                 <button type="button" class="addmore_model btn btn-info pull-right" style="margin-bottom: 15px;" val="<?php echo $value->product_id; ?>" value="0">Add More <i class="fa fa-plus"></i></button>

                                                                    <table class="table ui-table" id="table_<?php echo $value->product_id; ?>">
                                                                        <thead>
                                                                          <tr>
                                                                            <th style="width:10%">S No.</th>
                                                                            <th style="width:20%">Bundle No.</th>
                                                                            <th style="width:20%">Qty</th>
                                                                            <th style="width:20%">Wt/ PC (Kg)</th>
                                                                            <th style="width:25%">Wt of Bdl (Kg)</th>
                                                                            <!-- <th style="width:5%">Action</th> -->
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <tr id="trcf_<?php echo $value->product_id; ?>_0">
                                                                            	<td>1</td>
                                                                                <td><input class="form-control" name="customdata[bundle_no_<?php echo $value->product_id; ?>][0]" type="text" ></td>

                                                                                <td><input class="form-control qty" id="bundle_qty_<?php echo $value->product_id; ?>_0" name="customdata[bundle_qty_<?php echo $value->product_id; ?>][0]" onkeyup="get_total(<?php echo $value->product_id; ?>);" type="text"></td>

                                                                                <td><input class="form-control" id="weight_per_psc_<?php echo $value->product_id; ?>_0" name="customdata[weight_per_psc_<?php echo $value->product_id; ?>][0]" type="text" onkeyup="get_bundle_weight(<?php echo $value->product_id; ?>,'0');"></td>

                                                                                <td><input class="form-control" id="bundle_weight_<?php echo $value->product_id; ?>_0" name="customdata[bundle_weight_<?php echo $value->product_id; ?>][0]" type="text" ></td>

                                                                                <!-- <td><button type="button" value="0" class="btn pull-right btn-danger" onclick="removeprofield(<?php echo $value->product_id; ?>,0);"><i class="fa fa-remove"></i></button></td> -->
                                                                            </tr>

                                                                        </tbody>

                                                                      </table>
                                                                        <hr>
                                                                      <div class="row">

                                                                          <div class="col-md-12">
                                                                            <div class="col-md-3">
                                                                            <label>Rate as on date &nbsp;&nbsp;&nbsp; <button type="button" class="btn-sm btn-success calculate" val="<?php echo $value->product_id; ?>">Calculate</button></label><input class="form-control rate" val="<?php echo $value->product_id; ?>" name="rate_<?php echo $value->product_id; ?>" id="rate_<?php echo $value->product_id; ?>" type="text" >
                                                                           </div>

                                                                           <div class="col-md-3">
                                                                           <label>Total Qty</label><input class="form-control" id="ttl_qty_<?php echo $value->product_id; ?>" name="ttl_qty_<?php echo $value->product_id; ?>" readonly type="text" >
                                                                           </div>

                                                                           <div class="col-md-3">
                                                                            <label>Total Weight</label><input class="form-control" id="ttl_bundlewt_<?php echo $value->product_id; ?>" name="ttl_bundlewt_<?php echo $value->product_id; ?>" readonly type="text" >
                                                                           </div>

                                                                           <div class="col-md-3">
                                                                            <label>Rate Per Pcs</label><input class="form-control" id="rate_per_pcs<?php echo $value->product_id; ?>" name="rate_per_pcs<?php echo $value->product_id; ?>" readonly type="text" >
                                                                           </div>
                                                                          </div>
                                                                          <br>

                                                                          <input type="hidden" value="<?php echo $value->qty; ?>" name="product_qty<?php echo $value->product_id; ?>">

                                                                      </div>



                                                          </div>
                                                          <div class="modal-footer">

                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          </div>
                                                        </div>

                                                      </div>
                                                    </div>
                                                </td>
	                                            </tr>

                                                <input type="hidden" name="product[]" value="<?php echo $value->product_id; ?>">
                                        		<?php
                                        	}
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    	<?php

	}


    public function get_status() {


        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblmanufactureapproval  where m_id = '".$id."'  ")->result();
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
                                                <td>Action</td>
                                                <td>Remark</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                    <td><?php echo ($value->remark != '') ?  $value->remark : '--';  ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
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


    public function get_product_details() {
    	extract($this->input->post());
    	$product_info = $this->db->query("SELECT * from tblproducts where  id = '".$id."' ")->row_array();
    	echo json_encode($product_info);
    }




}
