<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Stock_model');
         $this->load->model('home_model');
    }

    /* List all Component Data */

    public function index() {
        check_permission(158,'view');
        // $this->load->view('admin/warehouse_stock/manage'); 
        $data['title'] = "Warehouse Stock List";
        $data['store_list'] = $this->db->query("SELECT *,ws.id as stockid FROM `tblwarehousestock` ws LEFT JOIN `tblwarehouse` w ON ws.`warehouse_id`=w.`id` LEFT JOIN `tblstockapproval` sap ON sap.warehousestockid=ws.id Where (ws.`addedfrom`='".get_staff_user_id()."' OR sap.`staffid`='".get_staff_user_id()."') GROUP BY ws.`id` order by ws.id DESC")->result_array();
        $this->load->view('admin/warehouse_stock/warehouse_stock_list', $data); 
    }

    public function get_approval_info() {
        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from tblstockapproval  where warehousestockid = '".$stock_id."'  ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                            <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Remark</td>
                                        <td>Action</td>
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
                                                <td><?php echo get_employee_name($value->staffid); ?></td>
                                                <td><?php echo ($value->approvereason) ? $value->approvereason : "--"; ?></td>
                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
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
	 public function alltransferstock() {
        check_permission(160,'view');

        $this->load->view('admin/warehouse_stock/managetransferstock', $data);
    }

	public function view($id = '') {

		$stock_transfer=$this->db->query("SELECT * FROM `tblstocktransfer` WHERE `id`='".$id."'")->row_array();
		$data['stock_transfer']=$this->db->query("SELECT * FROM `tblstocktransfer` WHERE `id`='".$id."'")->row_array();
		$data['stock_transfer_det']=$this->db->query("SELECT p.sub_name as name,pt.transfer_qty FROM `tblprotransferstock` pt LEFT JOIN `tblproducts` p ON p.id=pt.product_id WHERE pt.`stocktransfer_id`='".$id."'")->result_array();

		$get_from_warehousedata=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$stock_transfer['warehouse_id']."'")->row_array();
		$data['fromwarehouse']=$get_from_warehousedata['name'];
		$get_to_warehousedata=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$stock_transfer['to_warehouse_id']."'")->row_array();
		$data['towarehouse']=$get_to_warehousedata['name'];
		if($stock_transfer['service_type']==1)
		{
			$service_type='Rent to Sale';
		}
		if($stock_transfer['service_type']==2)
		{
			$service_type='Sale to Rent';
		}
		$data['service_type']=$service_type;
		$this->load->view('admin/warehouse_stock/view_transfer_stock', $data);
	}

	public function stockpdf($id) {
		$data['id']=$id;
		 if ($this->input->post())
		 {
			$stock_data = $this->input->post();
			$id = $this->Stock_model->addpdf($stock_data);
			handle_stock_pdf_upload($id);
		 }
        $this->load->view('admin/warehouse_stock/manage_pdf', $data);
    }

	public function taskforapprove()
    {
		$this->load->view('admin/warehouse_stock/taskapproval','');
	}
	public function stocktaskapproval()
    {
		$data['approvereason'] = $this->input->post('approvereason');
		$accept = $this->input->post('accept');
		$data['approve_status'] = $this->input->post('accept');
        $this->db->where('id',$this->input->post('approvalid'));
        $this->db->update('tbltaskapprovalstaff', $data);
		$approvalid=$this->input->post('approvalid');
		$get_approv_det=$this->db->query("SELECT * FROM `tbltaskapprovalstaff` WHERE `id`='".$approvalid."'")->row_array();
		$sdata['status']=$this->input->post('accept');
		$sdata['approve_by']=get_staff_user_id();
		$this->db->where('id',$get_approv_det['taskid']);
        $this->db->update('tblmanagetaskstock', $sdata);

		if($accept==1)
		{
			$singlewarehousestockdet=$this->db->query("SELECT * FROM `tblmanagetaskstock` WHERE `id`='".$get_approv_det['taskid']."'")->row_array();
			$get_task_detail=$this->db->query("SELECT * FROM `tblstafftasks` WHERE `id`='".$singlewarehousestockdet['task_id']."'")->row_array();
			$checkprostock=$this->db->query("SELECT * FROM `tblprostock` WHERE  `pro_id`='".$singlewarehousestockdet['component_id']."' AND `service_type`='".$get_task_detail['service_type']."' AND `warehouse_id`='".$get_task_detail['warehouse_id']."'")->row_array();
			if(count($checkprostock)==0)
			{
				$this->db->insert('tblprostock', $psdata);
			}
			else
			{
				$wpsdata['qty']=$checkprostock['qty']+$singlewarehousestockdet['qty'];
				$this->db->where('pro_id', $singlewarehousestockdet['component_id']);
				$this->db->where('service_type', $get_task_detail['service_type']);
				$this->db->where('warehouse_id', $get_task_detail['warehouse_id']);
				$this->db->update('tblprostock', $wpsdata);
			}
		}
	}

	public function converttask()
    {
		$data  = $this->input->post();
		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
		$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
		$i=0;
		foreach($Staffgroup as $singlestaff)
		{
			$i++;
			$stafff[$i]['id']=$singlestaff['id'];
			$stafff[$i]['name']=$singlestaff['name'];
			$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
			$stafff[$i]['staffs']=$query;
		}
		$this->load->model('Staff_model');
		$data['allStaff'] = $this->Staff_model->get();
		$data['allStaffdata'] = $stafff;
		/*$compbranchid=$this->session->userdata('staff_user_id');//exit;
		$compnybranch_warehouse=$this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='".$compbranchid."'")->row_array();
		$warehouseid=explode(',',$compnybranch_warehouse['warehouse_id']);
		foreach($warehouseid as $singlewarehouseid)
		{
			$warehousedata[]=$this->db->query("SELECT * FROM `tblwarehouse` where id='".$singlewarehouseid."'")->row_array();
		}*/
		$data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();
		$this->load->model('Enquiryfor_model');
        $data['service_type'] = $this->Enquiryfor_model->get();
		$this->load->view('admin/warehouse_stock/task', $data);
	}
	public function updatestockqty()
    {
		$data=$this->input->post();
		$usdata['component_id']=$this->input->post('componentid');
		$taskid=$this->input->post('taskid');
		$usdata['task_id']=$this->input->post('taskid');
		$usdata['qty']=$this->input->post('stockqty');
		$usdata['starttime']=$this->input->post('starttime');
		$usdata['endtime']=$this->input->post('endtime');
		$usdata['userid']=get_staff_user_id();
		$usdata['create_at']=date("Y-m-d H:i:s");
		$assignstaff=$data['assign']['assignid'];
		$proenqdata=$data['proenqdata'];
		foreach($assignstaff as $single_staff)
		{
			if (strpos($single_staff, 'staff') !== false)
			{
				$staff_id[]=str_replace("staff","",$single_staff);
			}
			if (strpos($single_staff, 'group') !== false)
			{
				$single_staff=str_replace("group","",$single_staff);
				$staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
				foreach($staffgroup as $singlestaff)
				{
					$staff_id[]=$singlestaff['staff_id'];
				}
			}
		}
		$staff_id=array_unique($staff_id);
		$this->db->insert('tblmanagetaskstock', $usdata);
		$insert_id = $this->db->insert_id();
		foreach($staff_id as $staffid)
		{
			$sdata['staff_id']=$staffid;
			$sdata['taskid']=$insert_id;
			$sdata['status'] = '1';
			$sdata['created_at'] = date("Y-m-d H:i:s");
			$sdata['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert('tbltaskapprovalstaff', $sdata);
			$notification_data = [
					'description' => ($cronOrIntegration == false ? 'not_task_approval_to_you' : 'new_task_approval_non_user'),
                    'touserid'    => $staffid,
                    //'link'        => '#taskid=' . $insert_id,
                    'link'        => 'Stock/taskforapprove',
                ];

                $notification_data['additional_data'] = serialize([
                    '',
                ]);

                if ($cronOrIntegration) {
                    $notification_data['fromcompany'] = 1;
                }

                if ($clientRequest) {
                    $notification_data['fromclientid'] = get_contact_user_id();
                }

                if (add_notification($notification_data)) {
                    pusher_trigger_notification([$staffid]);
                }

		}
	}
	public function viewtask($taskid, $return = false)
    {



		$tasks_where = [];

        if (!has_permission('tasks', '', 'view')) {
            $tasks_where = get_tasks_where_string(false);
        }

        $task = $this->tasks_model->get($taskid, $tasks_where);

        if (!$task) {
            header('HTTP/1.0 404 Not Found');
            echo 'Task not found';
            die();
        }

        $data['checklistTemplates'] = $this->tasks_model->get_checklist_templates();
        $data['task']               = $task;
        $data['id']                 = $task->id;
        $data['staff']              = $this->staff_model->get('', ['active'=>1]);
        $data['task_is_billed']     = $this->tasks_model->is_task_billed($taskid);
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
		$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Lead'")->result_array();
		$i=0;
		foreach($Staffgroup as $singlestaff)
		{
			$i++;
			$stafff[$i]['id']=$singlestaff['id'];
			$stafff[$i]['name']=$singlestaff['name'];
			$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
			$stafff[$i]['staffs']=$query;
		}
		$this->load->model('Staff_model');
		$data['allStaff'] = $this->Staff_model->get();
		$data['allStaffdata'] = $stafff;
        if ($return == false) {
            $this->load->view('admin/warehouse_stock/view_task_template', $data);
        } else {
            return $this->load->view('admin/warehouse_stock/view_task_template', $data, true);
        }
	}



	public function task()
    {
		 $this->load->view('admin/warehouse_stock/manage');exit;
		//print_r($this->input->post());exit;
		if($this->input->post('availablestockarray'))
		{
			//$data = [];
			//echo'dd';exit;
			//$data['availablestockarray']=$this->input->post();
			$this->load->view('admin/warehouse_stock/stock_availibility');
			exit;
		}
        if (!has_permission('tasks', '', 'edit') && !has_permission('tasks', '', 'create')) {
            access_denied('Tasks');
        }

        $data = [];
        // FOr new task add directly from the projects milestones
        if ($this->input->get('milestone_id')) {
            $this->db->where('id', $this->input->get('milestone_id'));
            $milestone = $this->db->get('tblmilestones')->row();
            if ($milestone) {
                $data['_milestone_selected_data'] = [
                    'id'       => $milestone->id,
                    'due_date' => _d($milestone->due_date),
                ];
            }
        }
        if ($this->input->get('start_date')) {
            $data['start_date'] = $this->input->get('start_date');
        }
		if ($this->input->get('description')) {
            $data['description'] = $this->input->get('description');
        }
        if ($this->input->post()) {
            $data                = $this->input->post();
            $data['description'] = $this->input->post('description', false);
            if ($id == '') {
                if (!has_permission('tasks', '', 'create')) {
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode([
                        'success' => false,
                        'message' => _l('access_denied'),
                    ]);
                    die;
                }
                $id      = $this->tasks_model->add($data);
                $_id     = false;
                $success = false;
                $message = '';
                if ($id) {
                    $success       = true;
                    $_id           = $id;
                    $message       = _l('added_successfully', _l('task'));
                    $uploadedFiles = handle_task_attachments_array($id);
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'task', [$file]);
                        }
                    }
                }
                echo json_encode([
                    'success' => $success,
                    'id'      => $_id,
                    'message' => $message,
                ]);
            } else {
                if (!has_permission('tasks', '', 'edit')) {
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode([
                        'success' => false,
                        'message' => _l('access_denied'),
                    ]);
                    die;
                }
                $success = $this->tasks_model->update($data, $id);
                $message = '';
                if ($success) {
                    $message = _l('updated_successfully', _l('task'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                    'id'      => $id,
                ]);
            }
            die;
        }

        $data['milestones']         = [];
        $data['checklistTemplates'] = $this->tasks_model->get_checklist_templates();
        if ($id == '') {
            $title = _l('add_new', _l('task_lowercase'));
        } else {
            $data['task'] = $this->tasks_model->get($id);
            if ($data['task']->rel_type == 'project') {
                $data['milestones'] = $this->projects_model->get_milestones($data['task']->rel_id);
            }
            $title = _l('edit', _l('task_lowercase')) . ' ' . $data['task']->name;
        }
        $data['project_end_date_attrs'] = [];
        if ($this->input->get('rel_type') == 'project' && $this->input->get('rel_id')) {
            $project = $this->projects_model->get($this->input->get('rel_id'));
            if ($project->deadline) {
                $data['project_end_date_attrs'] = [
                    'data-date-end-date' => $project->deadline,
                ];
            }
        }
        $data['id']    = $id;
        $data['title'] = $title;
        $this->load->view('admin/warehouse_stock/task', $data);
    }

	public function warehousestock() {

		//echo $_GET['id'];exit;
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }
		$data['id']=$_GET['id'];
        $this->load->view('admin/warehouse_stock/warehouselist', $data);
    }

    public function table() {
        $this->app->get_table_data('site_manager');
    }

 public function addstock($id = '') {
        check_permission(157,'create');
        if ($this->input->post()) {
            $stock_data = $this->input->post();
            
            if ($id == '') {
                $id = $this->Stock_model->add($stock_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('new_stock')));

                    redirect(admin_url('Stock'));
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
            $title = _l('add_new', _l('new_stock_lowercase'));
        } else {
            $data['stockdata'] = (array) $this->Stock_model->get($id);
            $data['prostockdata'] = $this->db->query("SELECT * FROM `tblprowarehousestock` WHERE `warehousestockid`='".$id."' ORDER BY id ASC")->result_array();
            $title = _l('edit', _l('new_stock_lowercase'));
        }

		$data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1 ORDER BY name ASC")->result_array();

        $data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' order by name asc ")->result_array();

		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
		$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
		$i=0;
		foreach($Staffgroup as $singlestaff)
		{
			$i++;
			$stafff[$i]['id']=$singlestaff['id'];
			$stafff[$i]['name']=$singlestaff['name'];
			$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' order by s.firstname asc")->result_array();
			$stafff[$i]['staffs']=$query;
		}
		$data['allStaffdata'] = $stafff;
        $data['title'] = $title;
        $data['procategory']=$this->db->query("SELECT pc.* FROM `tblproductcategory` pc LEFT JOIN `tblcategorymultiselect` cm ON pc.`id`=cm.`category_id` LEFT JOIN `tblmultiselectmaster` ms ON ms.id=cm.multiselect_id WHERE ms.multiselect='Stock' GROUP BY pc.`id` order by pc.name asc")->result_array();
        $this->load->view('admin/warehouse_stock/stock', $data);
    }


   public function transferstock($id = '') {
       check_permission(159,'create');

   		$data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC ")->result_array();

        if ($this->input->post()) {
            $stock_data = $this->input->post();
            if ($id == '') {
                $id = $this->Stock_model->addtransferstock($stock_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('transfer_stock')));

                    redirect(admin_url('Stock/alltransferstock'));
                }
            } else {
                $success = $this->Stock_model->edit($stock_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('transfer_stock')));
                }
                redirect(admin_url('Stock/alltransferstock'));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('new_stock_lowercase'));
        } else {
            $data['stockdata'] = (array) $this->Stock_model->get($id);
            $data['prostockdata'] = $this->db->query("SELECT * FROM `tblprowarehousestock` WHERE `warehousestockid`='".$id."'")->result_array();
            $title = _l('edit', _l('new_stock_lowercase'));
        }

        $this->load->model('Enquiryfor_model');
        $data['service_type'] = $this->Enquiryfor_model->get();

		/*$compbranchid=$this->session->userdata('staff_user_id');//exit;
		$compnybranch_warehouse=$this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='".$compbranchid."'")->row_array();
		$warehouseid=explode(',',$compnybranch_warehouse['warehouse_id']);
		foreach($warehouseid as $singlewarehouseid)
		{
			$warehousedata[]=$this->db->query("SELECT * FROM `tblwarehouse` where id='".$singlewarehouseid."'")->row_array();
		}*/

		$data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status='1' ORDER BY name ASC ")->result_array();
        $this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();
		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
		$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
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
        $data['procategory']=$this->db->query("SELECT pc.* FROM `tblproductcategory` pc LEFT JOIN `tblcategorymultiselect` cm ON pc.`id`=cm.`category_id` LEFT JOIN `tblmultiselectmaster` ms ON ms.id=cm.multiselect_id WHERE ms.multiselect='Stock' GROUP BY pc.`id`")->result_array();
        $this->load->view('admin/warehouse_stock/transfer_stock', $data);
    }

	 public function checkavailability($id = '') {
        check_permission(163,'view');

	 	$data['item_data'] = $this->db->query("SELECT `id`,`name`,`product_cat_id` FROM `tblproducts` where `status`='1' ORDER BY name ASC ")->result_array();

        if ($this->input->post()) {
            $stock_data = $this->input->post();
            if ($id == '') {
                $id = $this->Stock_model->add($stock_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('new_stock')));

                    redirect(admin_url('Stock'));
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
            //$title = _l('add_new', _l('new_stock_lowercase'));
            $title = 'Check Stock Availibility';
        } else {
            $data['stockdata'] = (array) $this->Stock_model->get($id);
            $data['prostockdata'] = $this->db->query("SELECT * FROM `tblprowarehousestock` WHERE `warehousestockid`='".$id."'")->result_array();
            $title = _l('edit', _l('new_stock_lowercase'));
        }

        $this->load->model('Enquiryfor_model');
        $data['service_type'] = $this->Enquiryfor_model->get();

		/*$compbranchid=$this->session->userdata('staff_user_id');//exit;
		$compnybranch_warehouse=$this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='".$compbranchid."'")->row_array();
		$warehouseid=explode(',',$compnybranch_warehouse['warehouse_id']);
		foreach($warehouseid as $singlewarehouseid)
		{
			$warehousedata[]=$this->db->query("SELECT * FROM `tblwarehouse` where id='".$singlewarehouseid."'")->row_array();
		}*/
		$data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1 ORDER BY name ASC")->result_array();
        $this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();
		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
		$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
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
        $data['procategory']=$this->db->query("SELECT pc.* FROM `tblproductcategory` pc LEFT JOIN `tblcategorymultiselect` cm ON pc.`id`=cm.`category_id` LEFT JOIN `tblmultiselectmaster` ms ON ms.id=cm.multiselect_id WHERE ms.multiselect='Stock' GROUP BY pc.`id`")->result_array();
        $this->load->view('admin/warehouse_stock/stock_availibility', $data);
    }
	public function getstockavailability() {
		$getavailability=array();
		$warehouse_id=$this->input->post("warehouse_id");
		foreach($warehouse_id as $singleid)
		{
			$warehouseid[]=$singleid['warehouse_id'];
			$getwarehouse=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$singleid['warehouse_id']."'")->row_array();
			$warehouse[]=$getwarehouse['name'];
		}
		$allwarehouse=implode(',',$warehouse);
		$yy=implode(' OR `warehouse_id`=',$warehouse_id);
		$service_type=$this->input->post('service_type');
		$this->load->model('Enquiryfor_model');
        $servicedata = (array) $this->Enquiryfor_model->get($service_type);
		$name=$servicedata['name'];
		if($service_type==1)
		{
			$productdata=$this->input->post('rentproposal');
		}
		else if($service_type==2)
		{
			$productdata=$this->input->post('saleproposal');
		}
		$productid = array_column($productdata, 'product_id');
		$getavailability['service_type']=$name;
		$getavailability['selected_warehouse']=$allwarehouse;
		$j=0;
		foreach($productdata as $singleproductdata)
		{
			$i=0;
			$prodetails=$this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='".$singleproductdata['product_id']."'")->row_array();
			$getavailability['table'][$j]['productname']=$prodetails['pro_name'];
			$getavailability['table'][$j]['productqty']=$singleproductdata['qty'];
			$getavailability['table'][$j]['productcatname']=$prodetails['pro_cat_name'];
			$getallrequriedcomponent=$this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductcomponents` tpc LEFT JOIN `tblcomponents` tc ON tpc.`component_id`=tc.id where tpc.`product_id`='".$singleproductdata['product_id']."'")->result_array();
			foreach($getallrequriedcomponent as $singlerequriedcomponent)
			{
				$checkwarehousedet=$this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='".$singlerequriedcomponent['id']."' AND `service_type`='".$service_type."' AND (`warehouse_id`=".$yy.")")->row_array();
				$requiredqty=$singleproductdata['qty']*$singlerequriedcomponent['qty'];
				if($checkwarehousedet['totalqty']>0){$availableqty=$checkwarehousedet['totalqty'];}else{$availableqty=0;}
				$remainingqty=$availableqty-$requiredqty;
				$name=$singlerequriedcomponent['name'];
				/*if(in_array($name,$compid))
				{
					$table=array_column($getavailability['table'],'component_name');
					$tt= array_search($name,$table);
					$getavailability['table'][$i]['component_name']=$singlerequriedcomponent['name'];
					$getavailability['table'][$i]['requiredqty']=$getavailability['table'][$tt]['requiredqty']+$requiredqty;
					$getavailability['table'][$i]['availableqty']=$getavailability['table'][$tt]['availableqty']+$availableqty;
					$getavailability['table'][$i]['remainingqty']=$getavailability['table'][$tt]['remainingqty']+$remainingqty;
					unset($getavailability['table'][$tt]);
				}
				else
				{
					$compid[]=$singlerequriedcomponent['name'];
					$getavailability['table'][$i]['component_name']=$singlerequriedcomponent['name'];
					$getavailability['table'][$i]['requiredqty']=$requiredqty;
					$getavailability['table'][$i]['availableqty']=$availableqty;
					$getavailability['table'][$i]['remainingqty']=$remainingqty;
				}*/
				$compid[]=$singlerequriedcomponent['name'];
				$getavailability['table'][$j]['component'][$i]['component_id']=$singlerequriedcomponent['id'];
				$getavailability['table'][$j]['component'][$i]['component_name']=$singlerequriedcomponent['name'];
				$getavailability['table'][$j]['component'][$i]['requiredqty']=$requiredqty;
				$getavailability['table'][$j]['component'][$i]['availableqty']=$availableqty;
				$getavailability['table'][$j]['component'][$i]['remainingqty']=$remainingqty;
				$i++;
			}
			$j++;
		}
//echo"<pre>";print_r($getavailability);exit;
	$html='
		<div style="padding:7px;margin-bottom:5%;">
			<h4 class="modal-title pull-left">Requirement For '.$getavailability['service_type'].'</h4>
			<h4 class="modal-title pull-right">Warehouse Selected :- '.$getavailability['selected_warehouse'].'</h4>
		</div>';
	foreach($getavailability['table'] as $singleav)
	{
		if($singleav['productcatname']!='')
		{
	$html .='

		<div style="padding:7px;margin-bottom:5%;">
			<h5 class="modal-title pull-left">Product Category :- '.$singleav['productcatname'].'</h5>
			<h5 class="modal-title pull-right">Product Name :- '.$singleav['productname'].'<br/>Product Qty :- '.$singleav['productqty'].'</h5>
		</div>
		<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
				<thead>
					<tr>
						<th width="25%" align="center">Component Name</th>
						<th width="25%" align="center">Required Qty</th>
						<th width="25%" class="qty" align="center">Available Qty</th>
						<th width="25%" align="center">Remaining Qty</th>
					</tr>
				</thead>
				<tbody class="ui-sortable" style="font-size:15px;">';
	foreach($singleav['component'] as $singleavailabity)
	{
		if($singleavailabity['remainingqty']<0){$class='style="background:red;color:#fff"';}else{$class='style="background:green;color:#fff"';}
		$html .='<tr class="main" id="tr0">
					<td width="25%" align="left">
						<div class="form-group">'.$singleavailabity['component_name'].'</div>
					</td>
					<td width="25%" align="center">'.$singleavailabity['requiredqty'].'</td>
					<td width="25%" align="center">'.$singleavailabity['availableqty'].'</td>
					<td width="25%" align="center" '.$class.' >'.$singleavailabity['remainingqty'].'</td>
				</tr>';
	}
$html .='</tbody>
		</table>';

	}
	}
	//echo $html;
	//print_r(json_encode($productdata));exit;
	// echo json_encode(array('html'=>$html,'productdata'=>json_encode($getavailability)));
	 echo json_encode(array('html'=>$html,'productdata'=>json_encode($getavailability),'warehouse_id'=>($warehouse_id)));
	 //print_r($oo);
	}
	public function getavailability() {

		$getavailability=array();
		$warehouse_id=$this->input->post("warehouse_id");
		foreach($warehouse_id as $singleid)
		{
			$warehouseid[]=$singleid['warehouse_id'];
			$getwarehouse=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$singleid['warehouse_id']."'")->row_array();
			$warehouse[]=$getwarehouse['name'];
		}
		$allwarehouse=implode(',',$warehouse);
		$yy=implode(' OR `warehouse_id`=',$warehouse_id);
		$service_type=$this->input->post('service_type');
		$this->load->model('Enquiryfor_model');
        $servicedata = (array) $this->Enquiryfor_model->get($service_type);
		$name=$servicedata['name'];
		$productdata=$this->input->post('productdata');
		$productid = array_column($productdata, 'productid');
		$getavailability['service_type']=$name;
		$getavailability['selected_warehouse']=$allwarehouse;
		$j=0;
		foreach($productdata as $singleproductdata)
		{
			$i=0;
			$prodetails=$this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='".$singleproductdata['productid']."'")->row_array();
			$getavailability['table'][$j]['productname']=$prodetails['pro_name'];
			$getavailability['table'][$j]['productqty']=$singleproductdata['qty'];
			$getavailability['table'][$j]['productcatname']=$prodetails['pro_cat_name'];
			$getallrequriedcomponent=$this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id`='".$singleproductdata['productid']."'")->result_array();

			foreach($getallrequriedcomponent as $singlerequriedcomponent)
			{
				$checkwarehousedet=$this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='".$singlerequriedcomponent['id']."' AND `service_type`='".$service_type."' AND (`warehouse_id`=".$yy.")")->row_array();
				$requiredqty=$singleproductdata['qty']*$singlerequriedcomponent['qty'];
				if($checkwarehousedet['totalqty']>0){$availableqty=$checkwarehousedet['totalqty'];}else{$availableqty=0;}
				$remainingqty=$availableqty-$requiredqty;
				$name=$singlerequriedcomponent['name'];

				$compid[]=$singlerequriedcomponent['name'];
				$getavailability['table'][$j]['component'][$i]['component_id']=$singlerequriedcomponent['id'];
				$getavailability['table'][$j]['component'][$i]['component_name']=$singlerequriedcomponent['name'];
				$getavailability['table'][$j]['component'][$i]['requiredqty']=$requiredqty;
				$getavailability['table'][$j]['component'][$i]['availableqty']=$availableqty;
				$getavailability['table'][$j]['component'][$i]['remainingqty']=$remainingqty;
				$i++;
			}
			$j++;
		}
//echo"<pre>";print_r($getavailability);
	$html='
		<div style="padding:7px;margin-bottom:5%;">
			<h4 class="modal-title pull-left">Requirement For '.$getavailability['service_type'].'</h4>
			<h4 class="modal-title pull-right">Warehouse Selected :- '.$getavailability['selected_warehouse'].'</h4>
		</div>';
	foreach($getavailability['table'] as $singleav)
	{
	$html .='

		<div style="padding:7px;margin-bottom:5%;">
			<h5 class="modal-title pull-left">Product Category :- '.$singleav['productcatname'].'</h5>
			<h5 class="modal-title pull-right">Product Name :- '.$singleav['productname'].'<br/>Product Qty :- '.$singleav['productqty'].'</h5>
		</div>
		<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
				<thead>
					<tr>
						<th width="25%" align="center">Component Name</th>
						<th width="25%" align="center">Required Qty</th>
						<th width="25%" class="qty" align="center">Available Qty</th>
						<th width="25%" align="center">Remaining Qty</th>
					</tr>
				</thead>
				<tbody class="ui-sortable" style="font-size:15px;">';
	foreach($singleav['component'] as $singleavailabity)
	{
		if($singleavailabity['remainingqty']<0){$class='style="background:red;color:#fff"';}else{$class='style="background:green;color:#fff"';}
		$html .='<tr class="main" id="tr0">
					<td width="25%" align="left">
						<div class="form-group">'.$singleavailabity['component_name'].'</div>
					</td>
					<td width="25%" align="center">'.$singleavailabity['requiredqty'].'</td>
					<td width="25%" align="center">'.$singleavailabity['availableqty'].'</td>
					<td width="25%" align="center" '.$class.' >'.$singleavailabity['remainingqty'].'</td>
				</tr>';
	}
$html .='</tbody>
		</table>';

	}
	//echo $html;
	//print_r(json_encode($productdata));exit;
	// echo json_encode(array('html'=>$html,'productdata'=>json_encode($getavailability)));

    print_r($getavailability);
    print_r($warehouse_id);
    die;

	 echo json_encode(array('html'=>$html,'productdata'=>json_encode($getavailability),'warehouse_id'=>($warehouse_id)));
	 //print_r($oo);
}

public function getavailabilitynew() {

    if(!empty($_POST)){
        extract($this->input->post());

        /*  print_r($_POST);
        die;*/

        foreach($warehouse_id as $singleid)
        {
             $warehouseid[]=$singleid;

            $getwarehouse=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$singleid."'")->row_array();
            $warehouse[]=$getwarehouse['name'];
        }
       $allwarehouse=implode(',',$warehouse);
       $allwarehouseid=implode(',',$warehouseid);

        foreach($service_type as $singleid)
        {
            $servicetype_id[]=$singleid;
            $getservice=$this->db->query("SELECT * FROM `tblenquiryformaster` WHERE `id`='".$singleid."'")->row_array();
            $servicetype[]=$getservice['name'];
        }
        $allservice=implode(',',$servicetype);
        $allserviceid=implode(',',$servicetype_id);

        $i = 0;
        $arrayh = array();

        foreach ($productdata as $singleproductdata) {


            $service_type = $allserviceid;
            $pro_id[] = $singleproductdata['productid'];


            $prodetails = $this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='" . $singleproductdata['productid'] . "'")->row_array();
           // $getallrequriedcomponent = $this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductcomponents` tpc LEFT JOIN `tblcomponents` tc ON tpc.`component_id`=tc.id where tpc.`product_id`='" . $singleproductdata['pro_id'] . "'")->result_array();

            $getallrequriedcomponent = $this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id` ='" . $singleproductdata['productid'] . "'")->result_array();
            $proname[] = $prodetails['pro_name'];
            foreach ($getallrequriedcomponent as $singlerequriedcomponent) {

                $checkwarehousedet = $this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='" . $singlerequriedcomponent['id'] . "' AND `service_type` IN (" . $service_type . ")  AND `store` = 1  AND `department_id` = 0  AND `staff_id` = 0  AND `stock_type` = 1 AND  `warehouse_id` IN (" . $allwarehouseid . ") ")->row_array();
                $requiredqty = $singleproductdata['qty'] * $singlerequriedcomponent['qty'];
                if ($checkwarehousedet['totalqty'] > 0) {
                    $availableqty = $checkwarehousedet['totalqty'];
                } else {
                    $availableqty = 0;
                }
                $remainingqty = $availableqty - $requiredqty;
                $name = $singlerequriedcomponent['name'];

                if (!in_array($name, $arrayh)) {
                    $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                    $componentdata[$i]['name'] = $singlerequriedcomponent['name'];
                    //$componentdata[$i]['qty']=$singlerequriedcomponent['qty'];
                    $componentdata[$i]['requiredqty'] = $requiredqty;
                    $componentdata[$i]['availableqty'] = $availableqty;
                    $componentdata[$i]['remainingqty'] = $remainingqty;
                    $arrayh[] = $name;
                } else {
                    $table = array_column($componentdata, 'name');
                    $tt = array_search($name, $table);
                    $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                    $componentdata[$i]['name'] = $singlerequriedcomponent['name'];
                    //$componentdata[$i]['qty']=$componentdata[$tt]['qty']+$singlerequriedcomponent['qty'];
                    $componentdata[$i]['requiredqty'] = $componentdata[$tt]['requiredqty'] + $requiredqty;
                    //$componentdata[$i]['availableqty'] = $componentdata[$tt]['availableqty'] + $availableqty;
                    $componentdata[$i]['availableqty'] = $componentdata[$tt]['availableqty'] ;
                    $componentdata[$i]['remainingqty'] = $componentdata[$tt]['remainingqty'] + $remainingqty;

                    //unset($componentdata[$tt]);
                }

                /*$yy = $allwarehouseid;
                $checkwarehousedet = $this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='" . $singlerequriedcomponent['id'] . "' AND `service_type`='2' AND  `warehouse_id` IN (" . $warehouse_id . ")")->row_array();
                $requiredqty = $singleproductdata['qty'] * $singlerequriedcomponent['qty'];
                if ($checkwarehousedet['totalqty'] > 0) {
                    $availableqty = $checkwarehousedet['totalqty'];
                } else {
                    $availableqty = 0;
                }
                $remainingqty = $availableqty - $requiredqty;
                $name = $singlerequriedcomponent['name'];*/

                $i++;
            }
        }


        //New Logic
        if(!empty($componentdata)){
            foreach($componentdata as $element) {
                $hash = $element['componentid'];
                $unique_array[$hash] = $element;
            }
        }

                $pro_name=implode(',',$pro_id);



        $html='
        <div style="padding:7px;margin-bottom:5%;">
            <h4 class="modal-title pull-left">Requirement For ('.$allservice.')</h4>
            <h4 class="modal-title pull-right">Warehouse Selected :- '.$allwarehouse.'</h4>
        </div>';

        $html .= '<div style="padding:7px;">';
            if(!empty($productdata)){
                foreach ($productdata as $k => $p_data) {
                    $p_id = $p_data['productid'];
                    $p_qty = $p_data['qty'];
                    $html .= '<h5 class="modal-title">'.++$k.') '.value_by_id('tblproducts',$p_id,'name').' - ('.$p_qty.')</h5>';
                }
            }

        $html .= '</div>';


        $html .= '<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
                <thead>
                    <tr>
                        <th width="25%" align="center">Component Name</th>
                        <th width="25%" class="qty" align="center">Available Qty</th>
                        <th width="25%" align="center">Required Qty</th>
                        <th width="25%" align="center">Remaining Qty</th>
                    </tr>
                </thead>
                <tbody class="ui-sortable" style="font-size:15px;">';

    $p_data = array();
    if(!empty($unique_array)){
        foreach($unique_array as $singleavailabity)
        {

            $remainingqty = ($singleavailabity['availableqty'] - $singleavailabity['requiredqty']);

            $p_data[] = array(
                        'name' => $singleavailabity['name'],
                        'availableqty' => $singleavailabity['availableqty'],
                        'requiredqty'  => $singleavailabity['requiredqty'],
                        'remainingqty' => $remainingqty,
                    );

            if($remainingqty<0){$class='style="background:red;color:#fff"';}else{$class='style="background:green;color:#fff"';}
            $html .='<tr class="main" id="tr0">
                        <td width="25%" align="left">
                            <div class="form-group">'.$singleavailabity['name'].product_code($singleavailabity['componentid']).'</div>
                        </td>
                        <td width="25%" align="center">'.$singleavailabity['availableqty'].'</td>
                        <td width="25%" align="center">'.$singleavailabity['requiredqty'].'</td>
                        <td width="25%" align="center" '.$class.' >'.$remainingqty.'</td>
                    </tr>';
        }
    }else{
         $html .='<tr class="main" id="tr0">
                        <td colspan="4" align="center" style="background:red;color:#fff" >Stock Not Available!</td>
                    </tr>';
    }

    $html .='</tbody>
        </table>';

    if(!empty($p_data)){
        $html .='<form action="'.base_url("admin/Stock/availablepdf").'" method="POST" target="_blank">
            <textarea rows="4" name="p_data" cols="50" hidden >'.json_encode($p_data).'</textarea>
            <input type="hidden" value="'.$allserviceid.'" name="servicetype">
            <input type="hidden" value="'.$allwarehouse.'" name="warehouse">
        <button type="submit" class="btn btn-info">Download PDF</button></form>';
    }



    $getavailability=array();
    $j=0;
    foreach($productdata as $singleproductdata)
    {
        $i=0;
        $prodetails=$this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='".$singleproductdata['productid']."'")->row_array();
        $getavailability['table'][$j]['productname']=$prodetails['pro_name'];
        $getavailability['table'][$j]['productqty']=$singleproductdata['qty'];
        $getavailability['table'][$j]['productcatname']=$prodetails['pro_cat_name'];
        $getallrequriedcomponent=$this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id`='".$singleproductdata['productid']."'")->result_array();

        foreach($getallrequriedcomponent as $singlerequriedcomponent)
        {
            $checkwarehousedet=$this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='".$singlerequriedcomponent['id']."'  AND `service_type` IN (" . $service_type . ")  AND `stock_type` = 1 AND  `warehouse_id` IN (" . $allwarehouseid . ") ")->row_array();
            $requiredqty=$singleproductdata['qty']*$singlerequriedcomponent['qty'];
            if($checkwarehousedet['totalqty']>0){$availableqty=$checkwarehousedet['totalqty'];}else{$availableqty=0;}
            $remainingqty=$availableqty-$requiredqty;
            $name=$singlerequriedcomponent['name'];

            $compid[]=$singlerequriedcomponent['name'];
            $getavailability['table'][$j]['component'][$i]['component_id']=$singlerequriedcomponent['id'];
            $getavailability['table'][$j]['component'][$i]['component_name']=$singlerequriedcomponent['name'];
            $getavailability['table'][$j]['component'][$i]['requiredqty']=$requiredqty;
            $getavailability['table'][$j]['component'][$i]['availableqty']=$availableqty;
            $getavailability['table'][$j]['component'][$i]['remainingqty']=$remainingqty;
            $i++;
        }
        $j++;
    }



         echo json_encode(array('html'=>$html,'productdata'=>json_encode($getavailability),'warehouse_id'=>($warehouse_id)));

    }

}


	public function getavailabilityy() {
		$getavailability=array();
		$warehouse_id=$this->input->post("warehouse_id");
		foreach($warehouse_id as $singleid)
		{
			$warehouseid[]=$singleid['warehouse_id'];
			$getwarehouse=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$singleid['warehouse_id']."'")->row_array();
			$warehouse[]=$getwarehouse['name'];
		}
		$allwarehouse=implode(',',$warehouse);
		$yy=implode(' OR `warehouse_id`=',$warehouse_id);
		$service_type=$this->input->post('service_type');
		$this->load->model('Enquiryfor_model');
        $servicedata = (array) $this->Enquiryfor_model->get($service_type);
		$name=$servicedata['name'];
		$productdata=$this->input->post('productdata');
		$productid = array_column($productdata, 'productid');
		$getavailability['service_type']=$name;
		$getavailability['selected_warehouse']=$allwarehouse;
		$i=0;

		foreach($productdata as $singleproductdata)
		{
			$getallrequriedcomponent=$this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductcomponents` tpc LEFT JOIN `tblcomponents` tc ON tpc.`component_id`=tc.id where tpc.`product_id`='".$singleproductdata['productid']."'")->result_array();
			foreach($getallrequriedcomponent as $singlerequriedcomponent)
			{
				$checkwarehousedet=$this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='".$singlerequriedcomponent['id']."' AND `is_pro`=0 AND `service_type`='".$service_type."' AND (`warehouse_id`=".$yy.")")->row_array();
				$requiredqty=$singleproductdata['qty']*$singlerequriedcomponent['qty'];
				if($checkwarehousedet['totalqty']>0){$availableqty=$checkwarehousedet['totalqty'];}else{$availableqty=0;}
				$remainingqty=$availableqty-$requiredqty;
				$name=$singlerequriedcomponent['name'];
				if(in_array($name,$compid))
				{
					$table=array_column($getavailability['table'],'component_name');
					$tt= array_search($name,$table);
					$getavailability['table'][$i]['component_name']=$singlerequriedcomponent['name'];
					$getavailability['table'][$i]['requiredqty']=$getavailability['table'][$tt]['requiredqty']+$requiredqty;
					$getavailability['table'][$i]['availableqty']=$getavailability['table'][$tt]['availableqty']+$availableqty;
					$getavailability['table'][$i]['remainingqty']=$getavailability['table'][$tt]['remainingqty']+$remainingqty;
					unset($getavailability['table'][$tt]);
				}
				else
				{
					$compid[]=$singlerequriedcomponent['name'];
					$getavailability['table'][$i]['component_name']=$singlerequriedcomponent['name'];
					$getavailability['table'][$i]['requiredqty']=$requiredqty;
					$getavailability['table'][$i]['availableqty']=$availableqty;
					$getavailability['table'][$i]['remainingqty']=$remainingqty;
				}
				$i++;
			}
		}

	$html='
		<div style="padding:10px;margin-bottom:5%;"><h4 class="modal-title pull-left">Requirement For '.$getavailability['service_type'].'</h4>
		<h4 class="modal-title pull-right">Warehouse Selected :- '.$getavailability['selected_warehouse'].'</h4></div>
		<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
				<thead>
					<tr>
						<th width="25%" align="center">Component Name</th>
						<th width="25%" align="center">Required Qty</th>
						<th width="25%" class="qty" align="center">Available Qty</th>
						<th width="25%" align="center">Remaining Qty</th>
					</tr>
				</thead>
				<tbody class="ui-sortable" style="font-size:15px;">';
	foreach($getavailability['table'] as $singleavailabity)
	{
		if($singleavailabity['remainingqty']<0){$class='style="background:red;color:#fff"';}else{$class='style="background:green;color:#fff"';}
		$html .='<tr class="main" id="tr0">
					<td width="25%" align="left">
						<div class="form-group">'.$singleavailabity['component_name'].'</div>
					</td>
					<td width="25%" align="center">'.$singleavailabity['requiredqty'].'</td>
					<td width="25%" align="center">'.$singleavailabity['availableqty'].'</td>
					<td width="25%" align="center" '.$class.' >'.$singleavailabity['remainingqty'].'</td>
				</tr>';
	}
$html .='</tbody>
		</table>';
		echo $html;
	}

	public function approvestock($id = '') {
       
        if(!empty($_POST)){
            $data = $this->input->post();

            $ad_data = array(
                'approvereason' => $data["approve_remark"],
                'approve_status' => $data["status"],
                'created_at' => date('Y-m-d H:i:s')
            );
            $response = $this->home_model->update('tblstockapproval', $ad_data,array('warehousestockid'=>$id,'staffid'=>get_staff_user_id()));
            if ($response){

                update_masterapproval_single(get_staff_user_id(),1,$id,$data["status"]);
                update_masterapproval_all(1,$id,$data["status"]);
                
                $this->home_model->update('tblwarehousestock', array("is_approved" => $data["status"]),array('id'=>$id));

                if ($data["status"] == 1){
                    $warehousestockdet=$this->db->query("SELECT pws.*, ws.warehouse_id as warehouse_id, ws.service_type as service_type FROM `tblprowarehousestock` pws LEFT JOIN `tblwarehousestock` ws ON pws.`warehousestockid`=ws.`id` WHERE ws.`id`='".$id."'")->result_array();
                    foreach($warehousestockdet as $singlewarehousestockdet)
                    {

                        $prod_info = $this->db->query("SELECT * FROM `tblproducts` where `id`= '".$singlewarehousestockdet['product_id']."' ")->row();
                        $length_mm = 0;
                        if($prod_info->unit_id == 7){
                            $length_mm = $prod_info->size;
                        }elseif($prod_info->unit_1 == 7){
                            $length_mm = $prod_info->conversion_1;
                        }elseif($prod_info->unit_2 == 7){
                            $length_mm = $prod_info->conversion_2;
                        }
                        $productlog = array(
                            "parent_id" => 0,
                            "pro_id" => $singlewarehousestockdet['product_id'],
                            "warehouse_id" => $singlewarehousestockdet['warehouse_id'],
                            "service_type" => $singlewarehousestockdet['service_type'],
                            "total_qty" => $singlewarehousestockdet['qty'],
                            "qty" => $singlewarehousestockdet['qty'],
                            "size" => $length_mm,
                            "width" => $prod_info->width_mm,
                            "main_store" => 1,
                            "ref_type" => "add_stock",
                            "ref_id" => $id,
                            "material_status" => 1,
                            "date" => date("Y-m-d"),
                            "updated_at" => date("Y-m-d H:i:s")
                        );
                        $this->home_model->insert("tblproduct_store_log", $productlog);

                        /* this is for update live stock requirement added in stock */
				        $this->home_model->update("tblrequirement_products", array("is_stock_added" => 1), array("product_id" => $singlewarehousestockdet['product_id']));
                    }
                }
                
                set_alert('success', "Warehouse stock status update successfully");
                redirect(admin_url('approval/notifications'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('new_stock_lowercase'));
        } else {
            $data['stockdata'] = (array) $this->Stock_model->get($id);
            $data['prostockdata'] = $this->db->query("SELECT * FROM `tblprowarehousestock` WHERE `warehousestockid`='".$id."'")->result_array();
            $title = _l('edit', _l('new_stock_lowercase'));
        }

        $this->load->model('Enquiryfor_model');
        $data['service_type'] = $this->Enquiryfor_model->get();

		/*$compbranchid=$this->session->userdata('staff_user_id');//exit;
		$compnybranch_warehouse=$this->db->query("SELECT `warehouse_id` FROM `tblcompanybranch` WHERE `id`='".$compbranchid."'")->row_array();
		$warehouseid=explode(',',$compnybranch_warehouse['warehouse_id']);
		foreach($warehouseid as $singlewarehouseid)
		{
			$warehousedata[]=$this->db->query("SELECT * FROM `tblwarehouse` where id='".$singlewarehouseid."'")->row_array();
		}*/
		$data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status='1'")->result_array();
        $this->load->model('Component_model');
        $data['component_data'] = $this->Component_model->get();
		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
		$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
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
        $data['procategory']=$this->db->query("SELECT pc.* FROM `tblproductcategory` pc LEFT JOIN `tblcategorymultiselect` cm ON pc.`id`=cm.`category_id` LEFT JOIN `tblmultiselectmaster` ms ON ms.id=cm.multiselect_id WHERE ms.multiselect='Stock' GROUP BY pc.`id`")->result_array();
        $this->load->view('admin/warehouse_stock/approvalstock', $data);
    }
	public function transferpdf($id) {
        //$this->load->model('Estimates_model');
        /*$canView = user_can_view_chalan($id);
        if (!$canView) {
            access_denied('Estimates');
        } else {
            if (!has_permission('estimates', '', 'view') && !has_permission('estimates', '', 'view_own') && $canView == false) {
                access_denied('Estimates');
            }
        }*/
        if (!$id) {
            redirect(admin_url('Stock/alltransferstock'));
        }
		$stock_transfer=$this->db->query("SELECT * FROM `tblstocktransfer` WHERE `id`='".$id."'")->row_array();
		$data['stock_transfer']=$this->db->query("SELECT * FROM `tblstocktransfer` WHERE `id`='".$id."'")->row_array();
		$data['stock_transfer_det']=$this->db->query("SELECT c.name,pt.transfer_qty FROM `tblprotransferstock` pt LEFT JOIN `tblcomponents` c ON c.id=pt.product_id WHERE pt.`stocktransfer_id`='".$id."'")->result_array();
		$get_from_warehousedata=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$stock_transfer['warehouse_id']."'")->row_array();
		$data['fromwarehouse']=$get_from_warehousedata['name'];
		$get_to_warehousedata=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$stock_transfer['to_warehouse_id']."'")->row_array();
		$data['towarehouse']=$get_to_warehousedata['name'];
		if($stock_transfer['service_type']==1)
		{
			$service_type='Rent to Sale';
		}
		if($stock_transfer['service_type']==2)
		{
			$service_type='Sale to Rent';
		}
		$data['service_type']=$service_type;

		$estimate=$data;
        //$estimate = $this->estimates_model->getcreatedchalan($id);
        //$estimate_number = format_estimate_number($estimate->id);
        $estimate_number = $estimate['stock_transfer']['transferstockno'];

        try {
            $pdf = stock_transfer_pdf($estimate);
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';

        if ($this->input->get('output_type')) {
            $type = $this->input->get('output_type');
        }

        if ($this->input->get('print')) {
            $type = 'I';
        }

        $pdf->Output(mb_strtoupper(slug_it($estimate_number)) . '.pdf', $type);
    }


	public function pdf($id) {
        if (!$id) {
            redirect(admin_url('Stock'));
        }

        $canView = user_can_view_proposal($id);
        
        if (!$canView) {
            access_denied('Stock');
        } else {
            if (!has_permission('Stock', '', 'view') && !has_permission('Stock', '', 'view_own') && $canView == false) {
                access_denied('Stock');
            }
        }

        $warehousestock = $this->Stock_model->get($id);
        try {
            $pdf = stock_pdf($warehousestock,'',$this->input->get('type'));

        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';

        if ($this->input->get('output_type')) {
            $type = $this->input->get('output_type');
        }

        if ($this->input->get('print')) {
            $type = 'I';
        }

        $proposal_number = format_proposal_number($id);
        $pdf->Output($proposal_number . '.pdf', $type);
    }

    public function availablepdf() {

        $p_data = $_POST['p_data'];
        $warehouse = $_POST['warehouse'];
        $servicetype = $_POST['servicetype'];
        if($servicetype == 1){
            $servicetype = 'Rent';
        }else{
            $servicetype = 'Sale';
        }
        $pdf_data = array(
                        'p_data' => $p_data,
                        'warehouse' => $warehouse,
                        'servicetype' => $servicetype
                     );

        try {
            $pdf = stock_availability_pdf($pdf_data,'');
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';

        if ($this->input->get('output_type')) {
            $type = $this->input->get('output_type');
        }

        if ($this->input->get('print')) {
            $type = 'I';
        }

        //$proposal_number = format_proposal_number($id);
        $pdf->Output('stock_availibility.pdf', $type);
    }

	public function tablewarehouse() {
		 if (!is_staff_member()) {
            ajax_access_denied();
        }
        $this->app->get_table_data('warehouselist');
    }

	public function tabletransferstock() {
		 if (!is_staff_member()) {
            ajax_access_denied();
        }
        $this->app->get_table_data('transferstock');
    }

    /* this function not use its used in old section */
	public function approvalaccept()
    {
		$approve_status=$this->input->post('approve_status');
		$warehousestockid=$this->input->post('warehousestockid');
		$approvereason=$this->input->post('approvereason');
		$warehousestockcreatorid=$this->input->post('warehousestockcreatorid');
		$wsdata['approve_status']=$approve_status;
		$wsdata['approvereason']=$approvereason;

		$this->db->where('staffid', get_staff_user_id());
		$this->db->where('warehousestockid', $warehousestockid);
		$this->db->update('tblstockapproval', $wsdata);
		//echo $this->db->last_query();exit;
		//print_r($wsdata);exit;

        //Update master approval
        update_masterapproval_single(get_staff_user_id(),1,$warehousestockid,$approve_status);
        update_masterapproval_all(1,$warehousestockid,$approve_status);
		if($approve_status==1)
		{
		  $notified = add_notification([
                        'description'     => 'Stock approve Successfully',
                        'touserid'        => $warehousestockcreatorid,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'Stock',
                        'additional_data' => serialize([
                            'Stock Accepted',
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$warehousestockcreatorid]);
                    }
		}
		else
		{
			 $notified = add_notification([
                        'description'     => 'Proposal Decline Successfully',
                        'touserid'        => $leadcreatorid,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'proposals/index/' . $leadid,
                        'additional_data' => serialize([
                            'Stock Decline',
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$warehousestockcreatorid]);
                    }
		}
		$wdata['is_approved']=$approve_status;
		$this->db->where('id', $warehousestockid);
		$this->db->update('tblwarehousestock', $wdata);
		$getwarehousedata=$this->db->query("SELECT * FROM `tblwarehousestock` WHERE `id`='".$warehousestockid."'")->row_array();
		if($approve_status==1)
		{
			$warehousestockdet=$this->db->query("SELECT * FROM `tblprowarehousestock` pws LEFT JOIN `tblwarehousestock` ws ON pws.`warehousestockid`=ws.`id` WHERE ws.`id`='".$warehousestockid."'")->result_array();
			foreach($warehousestockdet as $singlewarehousestockdet)
			{
				$psdata['pro_id']=$singlewarehousestockdet['product_id'];
				$psdata['warehouse_id']=$getwarehousedata['warehouse_id'];
				$psdata['service_type']=$singlewarehousestockdet['service_type'];
				$psdata['is_pro']=$singlewarehousestockdet['is_product'];
				$psdata['qty']=$singlewarehousestockdet['qty'];
				$psdata['store']=1;
                $psdata['status']=1;
				$psdata['stock_type']=1;
				$psdata['created_at'] = date("Y-m-d H:i:s");
				$psdata['updated_at'] = date("Y-m-d H:i:s");
				$checkprostock=$this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$singlewarehousestockdet['product_id']."' AND `service_type`='".$singlewarehousestockdet['service_type']."' AND `warehouse_id`='".$getwarehousedata['warehouse_id']."' AND `store` = 1 AND `staff_id` = 0 AND `department_id` = 0 AND `stock_type` = 1")->row_array();

				if(count($checkprostock)==0)
				{
					$this->db->insert('tblprostock', $psdata);
					//echo $this->db->last_query();
				}
				else
				{
					$wpsdata['qty']=$checkprostock['qty']+$singlewarehousestockdet['qty'];
					$this->db->where('pro_id', $singlewarehousestockdet['product_id']);
					$this->db->where('service_type', $singlewarehousestockdet['service_type']);
					$this->db->where('warehouse_id', $singlewarehousestockdet['warehouse_id']);
                    $this->db->where('store', 1);
                    $this->db->where('department_id', 0);
					$this->db->update('tblprostock', $wpsdata);
				}
			}
		}
		exit;
	}
	public function tablewarehousestock($id) {
		$data['id']=$id;
        $this->app->get_table_data('warehousestock',$data);
    }
	public function tableuploadedstock($id) {
		$data['id']=$id;
        $this->app->get_table_data('uploadedstock',$data);
    }
    public function addcomp() {
		$cdata['company']=$this->input->post('comp_name');
		$cdata['registration_confirmed']=1;
		$this->db->insert('tblclients',$cdata);
		$insert_id = $this->db->insert_id();
		echo'<option value="'.$insert_id.'" selected=selected>'.$this->input->post('comp_name').'</option>';
	}

    public function addcompbranch() {
		$cdata['client_branch_name']=$this->input->post('comp_branch_name');
		$cdata['client_id']=$this->input->post('company');
		$cdata['registration_confirmed']=1;
		$this->db->insert('tblclientbranch',$cdata);
		$insert_id = $this->db->insert_id();
		echo'<option value="'.$insert_id.'" selected=selected>'.$this->input->post('comp_branch_name').'</option>';
	}


	public function deletepdf($warehousestockid,$id) {

        $success = $this->Stock_model->deletepdf($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('stock_pdf')));
            if (strpos($_SERVER['HTTP_REFERER'], 'warehouse_stock/Stock') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('Stock/stockpdf/'.$warehousestockid));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('new_stock_lowercase')));
            redirect(admin_url('Stock/addstock' . $id));
        }
    }

	public function delete($id) {

        $success = $this->Stock_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('new_stock')));
            if (strpos($_SERVER['HTTP_REFERER'], 'warehouse_stock/Stock') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('Stock'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('new_stock_lowercase')));
            redirect(admin_url('Stock/addstock' . $id));
        }
    }

	public function deletetransferstock($id) {

        $success = $this->Stock_model->delete_transferstock($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('transfer_stock')));
            if (strpos($_SERVER['HTTP_REFERER'], 'warehouse_stock/Stock') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('Stock/alltransferstock'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('transfer_stock')));
            redirect(admin_url('Stock/alltransferstock'));
        }
    }

    public function stock_inward($id = '') {


        if(!empty($_POST)){
            extract($this->input->post());

            /*echo '<pre/>';
            print_r($_POST);
            die;*/
             $stock_transfer = $this->db->query("SELECT * FROM `tblstocktransfer` WHERE `id`='".$id."'")->row();
             $transfer_product = $this->db->query("SELECT * FROM `tblprotransferstock` WHERE `stocktransfer_id`='".$id."'")->result();


                if($stock_transfer->service_type==1)
                {
                     $servicetype=2;
                }
                elseif($stock_transfer->service_type==2)
                {
                     $servicetype=1;
                }

             if(!empty($transfer_product)){
                foreach ($transfer_product as $value) {
                    $ttl = $_POST['ttl_'.$value->id];
                    $ok_qty = $_POST['ok_'.$value->id];
                    $nr_qty = $_POST['nr_'.$value->id];
                    $r_qty = $_POST['r_'.$value->id];
                    $lost_qty = $_POST['lost_'.$value->id];

                    if(!empty($ok_qty)){
                        $stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->product_id."' and `warehouse_id`='".$stock_transfer->to_warehouse_id."' and `service_type`='".$servicetype."' and status = 1 and stock_type = 1 ")->row();

                        if(!empty($stock_info)){
                            $n_qty = ($stock_info->qty + $ok_qty);
                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                        }else{

                            $ad_data = array(
                                    'pro_id' => $value->product_id,
                                    'warehouse_id' => $stock_transfer->to_warehouse_id,
                                    'service_type' => $servicetype,
                                    'qty' => $ok_qty,
                                    'is_pro' => '1',
                                    'stock_type' => '1',
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                );

                            $update = $this->home_model->insert('tblprostock', $ad_data);

                        }

                    }

                    if(!empty($nr_qty)){
                        $stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->product_id."' and `warehouse_id`='".$stock_transfer->to_warehouse_id."' and `service_type`='".$servicetype."' and status = 1 and stock_type = 2 ")->row();

                        if(!empty($stock_info)){
                            $n_qty = ($stock_info->qty + $nr_qty);
                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                        }else{

                            $ad_data = array(
                                    'pro_id' => $value->product_id,
                                    'warehouse_id' => $stock_transfer->to_warehouse_id,
                                    'service_type' => $servicetype,
                                    'qty' => $nr_qty,
                                    'is_pro' => '1',
                                    'stock_type' => '2',
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                );

                            $update = $this->home_model->insert('tblprostock', $ad_data);

                        }

                    }

                    if(!empty($r_qty)){
                        $stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->product_id."' and `warehouse_id`='".$stock_transfer->to_warehouse_id."' and `service_type`='".$servicetype."' and status = 1 and stock_type = 3 ")->row();

                        if(!empty($stock_info)){
                            $n_qty = ($stock_info->qty + $r_qty);
                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                        }else{

                            $ad_data = array(
                                    'pro_id' => $value->product_id,
                                    'warehouse_id' => $stock_transfer->to_warehouse_id,
                                    'service_type' => $servicetype,
                                    'qty' => $r_qty,
                                    'is_pro' => '1',
                                    'stock_type' => '3',
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                );

                            $update = $this->home_model->insert('tblprostock', $ad_data);

                        }

                    }

                     if(!empty($lost_qty)){
                        $stock_info = $this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$value->product_id."' and `warehouse_id`='".$stock_transfer->to_warehouse_id."' and `service_type`='".$servicetype."' and status = 1 and stock_type = 4 ")->row();

                        if(!empty($stock_info)){
                            $n_qty = ($stock_info->qty + $lost_qty);
                            $update = $this->home_model->update('tblprostock', array('qty'=>$n_qty), array('id'=>$stock_info->id));
                        }else{

                            $ad_data = array(
                                    'pro_id' => $value->product_id,
                                    'warehouse_id' => $stock_transfer->to_warehouse_id,
                                    'service_type' => $servicetype,
                                    'qty' => $lost_qty,
                                    'is_pro' => '1',
                                    'stock_type' => '4',
                                    'status' => '1',
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                );

                            $update = $this->home_model->insert('tblprostock', $ad_data);

                        }

                    }
                }

				if($update){
					$udpate_transper = $this->home_model->update('tblstocktransfer', array('is_taken'=>1), array('id'=>$id));
					set_alert('success', 'Stock Update Successfully');
					redirect(admin_url('Stock/alltransferstock'));
				}
             }
        }


        if(!empty($id)){

            $stock_transfer=$this->db->query("SELECT * FROM `tblstocktransfer` WHERE `id`='".$id."'")->row();

            if(!empty($stock_transfer) && $stock_transfer->is_taken == 0){
                $data['title'] = 'Stock Inward';

                $data['transfer_product']=$this->db->query("SELECT ts.*,p.name,p.product_cat_id from tblprotransferstock as ts LEFT JOIN tblproducts as p ON p.id = ts.product_id where ts.stocktransfer_id = '".$id."' and ts.status = 1")->result();

                $data['stock_transfer']=$stock_transfer;
                $this->load->view('admin/warehouse_stock/stock_inward', $data);

            }else{
                 set_alert('warning', 'Process Already Done');
                redirect(admin_url('Stock/alltransferstock'));
            }
        }else{
             redirect(admin_url());
        }


    }


    /*public function stock_list()
    {
        check_permission(161,'view');

        $where = "staff_id = 0 ";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('store_where');
                $this->session->unset_userdata('store_search');
                $where .= " and store = '1' and department_id = 0 ";
            }else{
                if(!empty($product_id) || !empty($warehouse_id) || !empty($department_id) || !empty($service_type) || !empty($stock_type)){
                    $this->session->unset_userdata('store_where');
                    $this->session->unset_userdata('store_search');
                    $sreach_arr = array();
                    if(!empty($product_id)){
                        $sreach_arr['product_id'] = $product_id;
                        $where .= " and pro_id = '".$product_id."'";
                    }

                    if(!empty($warehouse_id)){
                        $sreach_arr['warehouse_id'] = $warehouse_id;
                        $where .= " and warehouse_id = '".$warehouse_id."'";
                    }

                    if(!empty($department_id)){

                        $sreach_arr['department_id'] = $department_id;
                        $department_ids=implode(',',$department_id);
                        $where .= " and department_id IN (".$department_ids.") ";
                    }else{
                        $where .= " and store = '1' and department_id = 0 ";
                    }

                    if(!empty($service_type)){
                        $sreach_arr['service_type'] = $service_type;
                        $where .= " and service_type = '".$service_type."'";
                    }

                    if(!empty($stock_type)){
                        $sreach_arr['stock_type'] = $stock_type;
                        $where .= " and stock_type = '".$stock_type."'";
                    }



                    $this->session->set_userdata('store_where',$where);
                    $this->session->set_userdata('store_search',$sreach_arr);

                }

            }
        }else{
            if(!empty($this->session->userdata('store_where'))){
                $where = $this->session->userdata('store_where');
            }else{
                $where .= " and store = '1' and department_id = 0 ";
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 25;




        // Get record count
        $totalRec = $this->Stock_model->get_stock_count($where);

        // Pagination configuration
        $config['base_url']    = admin_url().'stock/stock_list/';
        $config['uri_segment'] = $uriSegment;
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $perPage;

        // For pagination link
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        // Initialize pagination library
        $this->pagination->initialize($config);

        // Define offset
        $page = $this->uri->segment($uriSegment);
        $offset = !$page?0:$page;

        // Get records
        $data['store_list'] = $this->Stock_model->get_stock($where,$offset,$perPage);



        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ")->result_array();
        $data['department_info'] = $this->db->query("SELECT * FROM `tblproduction_department` where status = 1 and id != 1 ")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1")->result_array();


        $data['title'] = 'Stock List';
        $this->load->view('admin/warehouse_stock/stock_list_old', $data);

    }*/

    public function stock_list()
    {
        check_permission(165,'view');

        $where = "staff_id = 0 ";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($product_id) || !empty($warehouse_id) || !empty($department_id) || !empty($service_type) || !empty($stock_type)){

                if(!empty($product_id)){
                    $data['product_id'] = $product_id;
                    $where .= " and pro_id = '".$product_id."'";
                }

                if(!empty($warehouse_id)){
                    $data['warehouse_id'] = $warehouse_id;
                    $where .= " and warehouse_id = '".$warehouse_id."'";
                }

                if(!empty($department_id)){

                    $data['department_id'] = $department_id;
                    $department_ids=implode(',',$department_id);
                    $where .= " and department_id IN (".$department_ids.") ";
                }else{
                    $where .= " and store = '1' and department_id = 0 ";
                }

                if(!empty($service_type)){
                    $data['service_type'] = $service_type;
                    $where .= " and service_type = '".$service_type."'";
                }

                /*if(!empty($stock_type)){
                    $data['stock_type'] = $stock_type;
                    $where .= " and stock_type = '".$stock_type."'";
                }*/
            }
        }else{
            $where .= " and store = '1' and department_id = 0 ";
        }

        // Get records
        $data['store_list'] = $this->db->query("SELECT * FROM `tblprostock`  where ".$where." ORDER BY id desc ")->result();



        $data['product_info'] = $this->db->query("SELECT * FROM `tblproducts`  where status = '1' ORDER BY name ASC ")->result_array();
        $data['department_info'] = $this->db->query("SELECT * FROM `tblproduction_department` where status = 1 and id != 1 ORDER BY name ASC")->result_array();
        $data['all_warehouse'] = $this->db->query("SELECT * FROM `tblwarehouse` where status = 1 ORDER BY name ASC")->result_array();


        $data['title'] = 'Stock List';
        $this->load->view('admin/warehouse_stock/stock_list', $data);

    }
}
