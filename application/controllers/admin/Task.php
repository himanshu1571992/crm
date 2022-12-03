<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Task extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }


    public function add($id = '')
    {

    	check_permission(113,'view');
    	if(!empty($id)){
    		$data['task_info'] = $this->home_model->get_row('tbltasks', array('id'=>$id), '');
    	}


    	$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '', array("comp_branch_name", "asc"));

    	$data['task_for'] = $this->home_model->get_result('tbltaskfor', array('status'=>1), '');

    	$data['days_info'] = $this->home_model->get_result('tbldays', '', '');

    	$data['employee_info'] = get_staff_list();

    	if ($this->input->post()) {
			extract($this->input->post());

//			echo '<pre/>';
//			print_r($_POST);
//			die;

			$start_date = str_replace("/","-",$start_date);
			$start_date = date("Y-m-d",strtotime($start_date));

			$due_date = str_replace("/","-",$due_date);
			$due_date = date("Y-m-d",strtotime($due_date));


			if(!empty($from_date)){
				$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
			}else{
				$from_date = '0000-00-00';
			}


			if(!empty($to_date)){
				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			}else{
				$to_date = '0000-00-00';
			}

			if($task_for == 2){
				$staff_id_str = implode(',', $staff_id);
			}else{
				$staff_id_str = '';
			}


			if($related_to == 1 && !empty($ids)){
				$clients = implode(',', $ids);
			}else{
				$clients = '';
			}


			if($related_to == 2 || $related_to == 8 || $related_to == 9){
				$challans = (!empty($ids)) ? implode(',', $ids) : '';
			}else{
				$challans = '';
			}

			if($related_to == 3){
				$expenses = (!empty($ids)) ? implode(',', $ids) : '';
			}else{
				$expenses = '';
			}

			if($related_to == 4){
				$invoices = (!empty($ids)) ? implode(',', $ids) : '';
			}else{
				$invoices = '';
			}

			if($related_to == 5){
				$leads = (!empty($ids)) ? implode(',', $ids) : '';
			}else{
				$leads = '';
			}

			if($related_to == 6){
				$perfoma_invoices = (!empty($ids)) ? implode(',', $ids) : '';
			}else{
				$perfoma_invoices = '';
			}

			if($related_to == 10){
				$quotation = (!empty($ids)) ? implode(',', $ids) : '';
			}else{
				$quotation = '';
			}

			if($related_to == 7){
				$prod_array = array();
				foreach ($p_ids as $p_id) {
					$p_qty = $_POST['productqty_'.$p_id];

					$prod_array[] = array(
						'p_id' => $p_id,
						'p_qty' => $p_qty,
					);
				}

				$product_data = json_encode($prod_array);
			}else{
				$product_data = '';
			}


//			if(!empty($repeat)){
////				$repeat_every = implode(',', $repeat_every);
//
//				$start_date = '0000-00-00';
//				$due_date = '0000-00-00';
//			}

                        $is_repeat = 0;
                        if (isset($repeat_type) && !empty($repeat_type)){
                            $is_repeat = 1;
                        }

			if(!empty($user_ids)){
				$user_id_str = implode(',', $user_ids);
			}else{
				$user_id_str = '';
			}

			//For Other Delivery And Pickup
			if(empty($client_name)){
				$client_name = '';
			}
			if(empty($client_id)){
				$client_id = 0;
			}
			if(empty($service_type)){
				$service_type = 0;
			}
			if(empty($product_details)){
				$product_details = '';
			}
			if(empty($other_date)){
				$other_date = '0000-00-00';
			}
			if(empty($state_id)){
				$state_id = 0;
			}
			if(empty($city_id)){
				$city_id = 0;
			}

			$add_data = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => $start_date,
                    'due_date' => $due_date,
                    'is_repeat' => $is_repeat,
                    'repeat_type' => $repeat_type,
                    'repeat_every' => $repeat_every,
                    'task_for' => $task_for,
                    'assigned_to' => $staff_id_str,
                    'user_ids' => $user_id_str,
                    'related_to' => $related_to,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'clients' => $clients,
                    'challans' => $challans,
                    'expenses' => $expenses,
                    'invoices' => $invoices,
                    'leads' => $leads,
                    'perfoma_invoices' => $perfoma_invoices,
                    'quotation' => $quotation,
                    'product_data' => $product_data,
                    'priority' => $priority,
                    'client_name' => $client_name,
                    'client_id' => $client_id,
                    'service_type' => $service_type,
                    'product_details' => $product_details,
                    'other_date' => db_date($other_date),
                    'state_id' => $state_id,
                    'city_id' => $city_id,
                    'added_by' => get_staff_user_id(),
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );


            $insert = $this->home_model->insert('tbltasks', $add_data);

            if($insert){


            	$task_id = $this->db->insert_id();

            	$result_file=handle_multi_task_attachments($task_id,'task');


            	if(!empty($user_ids)){
            		foreach ($user_ids as $s_id) {

            			$add_data_2 = array(
		                    'task_id' => $task_id,
		                    'staff_id' => $s_id
		                );

		                $insert_2 = $this->home_model->insert('tbltaskusers', $add_data_2);
            		}
            	}

            	if($task_for == 1){

            		$add_data_1 = array(
		                    'task_id' => $task_id,
		                    'staff_id' => get_staff_user_id(),
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

		            $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1);


		            /*$notified = add_notification([
							'description'     => 'New Task Alloted to you',
							'touserid'        => get_staff_user_id(),
							'type'            => 0,
							'module_id'       => 4,
							'table_id'        => $task_id,
							'category_id'     => 0,
							'fromuserid'      => get_staff_user_id(),
							'link'            => 'Task/task_details/' . $task_id.'',

						]);
					if ($notified) {
						pusher_trigger_notification([get_staff_user_id()]);
					}*/

					//adding on master log
                    $adata = array(
                        'staff_id' => get_staff_user_id(),
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 25,
                        'description' => 'New Task Alloted to you',
                        'table_id' => $task_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'Task/task_details/' . $task_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token(get_staff_user_id());
                    $message = 'New Task Alloted to you';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);


            	}

            	//Sending Notification
            	if(!empty($staff_id)){
            		foreach ($staff_id as $s_id) {

            			$add_data_1 = array(
		                    'task_id' => $task_id,
		                    'staff_id' => $s_id,
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

		                $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1);


            			/*$notified = add_notification([
							'description'     => 'New Task Alloted to you',
							'touserid'        => $s_id,
							'type'            => 0,
							'module_id'       => 4,
							'table_id'        => $task_id,
							'category_id'     => 0,
							'fromuserid'      => get_staff_user_id(),
							'link'            => 'Task/task_details/' . $task_id.'',

						]);
						if ($notified) {
							pusher_trigger_notification([$s_id]);
						}*/



						//adding on master log
	                    $adata = array(
	                        'staff_id' => $s_id,
	                        'fromuserid' => get_staff_user_id(),
	                        'module_id' => 25,
	                        'description' => 'New Task Alloted to you',
	                        'table_id' => $task_id,
	                        'approve_status' => 0,
	                        'status' => 0,
	                        'link' => 'Task/task_details/' . $task_id,
	                        'date' => date('Y-m-d'),
	                        'date_time' => date('Y-m-d H:i:s'),
	                        'updated_at' => date('Y-m-d H:i:s')
	                    );
	                    $this->db->insert('tblmasterapproval', $adata);

	                    //Sending Mobile Intimation
	                    $token = get_staff_token($s_id);
	                    $message = 'New Task Alloted to you';
	                    $title = 'Schach';
	                    $send_intimation = sendFCM($message, $title, $token, $page = 2);

            		}
            	}

                /* this function use for get task date */
                if (!empty($repeat_type)){
                    $this->get_task_date($task_id, $start_date, $repeat_type, $repeat_every);
                }


            	 set_alert('success', 'New Task Add Successfully');
            	 redirect(admin_url('Task/added_by_me/'));
            }


		}

		$this->load->view('admin/task/add', $data);
    }


    public function edit($id = '')
    {

    	if(!empty($id)){
    		$data['task_info'] = $this->home_model->get_row('tbltasks', array('id'=>$id), '');
    	}


    	$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '', array("comp_branch_name", "asc"));

    	$data['employee_info'] = get_staff_list();

    	if ($this->input->post()) {
			extract($this->input->post());


			/*echo '<pre/>';
			print_r($_POST);
			die;*/

			$start_date = str_replace("/","-",$start_date);
			$start_date = date("Y-m-d",strtotime($start_date));

			$due_date = str_replace("/","-",$due_date);
			$due_date = date("Y-m-d",strtotime($due_date));


			if(!empty($from_date)){
				$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
			}else{
				$from_date = '00:00:00';
			}


			if(!empty($to_date)){
				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			}else{
				$to_date = '00:00:00';
			}

			if($task_for == 2){
				$staff_id_str = implode(',', $staff_id);
			}else{
				$staff_id_str = '';
			}


			if($related_to == 1){
				$clients = implode(',', $ids);
			}else{
				$clients = '';
			}


			if($related_to == 2 || $related_to == 8 || $related_to == 9){
				$challans = implode(',', $ids);
			}else{
				$challans = '';
			}

			if($related_to == 3){
				$expenses = implode(',', $ids);
			}else{
				$expenses = '';
			}

			if($related_to == 4){
				$invoices = implode(',', $ids);
			}else{
				$invoices = '';
			}

			if($related_to == 5){
				$leads = implode(',', $ids);
			}else{
				$leads = '';
			}

			if($related_to == 6){
				$perfoma_invoices = implode(',', $ids);
			}else{
				$perfoma_invoices = '';
			}

			if($related_to == 10){
				$quotation = implode(',', $ids);
			}else{
				$quotation = '';
			}

			if($related_to == 7){
				$prod_array = array();
				foreach ($p_ids as $p_id) {
					$p_qty = $_POST['productqty_'.$p_id];

					$prod_array[] = array(
						'p_id' => $p_id,
						'p_qty' => $p_qty,
					);
				}

				$product_data = json_encode($prod_array);
			}else{
				$product_data = '';
			}


//			if(!empty($repeat)){
//				$repeat_every = implode(',', $repeat_every);
//				$is_repeat = 1;
//				$start_date = '0000-00-00';
//				$due_date = '0000-00-00';
//			}

                        $is_repeat = 0;
                        if (isset($repeat_type) && !empty($repeat_type)){
                            $is_repeat = 1;
                        }


			if(!empty($user_ids)){
				$user_id_str = implode(',', $user_ids);
			}else{
				$user_id_str = '';
			}

			//For Other Delivery And Pickup
			if(empty($client_name)){
				$client_name = '';
			}
			if(empty($client_id)){
				$client_id = 0;
			}
			if(empty($service_type)){
				$service_type = 0;
			}
			if(empty($product_details)){
				$product_details = '';
			}
			if(empty($other_date)){
				$other_date = '0000-00-00';
			}
			if(empty($state_id)){
				$state_id = 0;
			}
			if(empty($city_id)){
				$city_id = 0;
			}


			$add_data = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => $start_date,
                    'due_date' => $due_date,
                    'is_repeat' => $is_repeat,
                    'repeat_type' => $repeat_type,
                    'repeat_every' => $repeat_every,
                    'task_for' => $task_for,
                    'assigned_to' => $staff_id_str,
                    'user_ids' => $user_id_str,
                    'related_to' => $related_to,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'clients' => $clients,
                    'challans' => $challans,
                    'expenses' => $expenses,
                    'invoices' => $invoices,
                    'leads' => $leads,
                    'perfoma_invoices' => $perfoma_invoices,
                    'quotation' => $quotation,
                    'product_data' => $product_data,
                    'priority' => $priority,
                    'client_name' => $client_name,
                    'client_id' => $client_id,
                    'service_type' => $service_type,
                    'product_details' => $product_details,
                    'other_date' => db_date($other_date),
                    'state_id' => $state_id,
                    'city_id' => $city_id,
                    'added_by' => get_staff_user_id(),
                    'status' => 1,
                );


			if(!empty($_FILES['task_file'])){
				if(!empty($_FILES['task_file']['name'])){
					$param['upload_path'] = TASKS_ATTACHMENTS_FOLDER;
					$param['allowed_types'] = '*';
					$param['encrypt_name'] =TRUE;
					$param['max_size'] = '2048570';

					$this->load->library('upload',$param);
					$this->upload->initialize($param);

					if(!$this->upload->do_upload('task_file')){
						echo  $errors = $this->upload->display_errors();
						die;

					}else{
						$file_name = $this->upload->data('file_name');
						$add_data['task_file'] = $file_name;

					}

				}
			}

            $insert = $this->home_model->update('tbltasks', $add_data, array('id'=>$id));

            if($insert){

            	$this->home_model->delete('tbltaskassignees', array('task_id'=>$id));
            	$this->home_model->delete('tbltaskusers', array('task_id'=>$id));
            	$this->home_model->delete('tbltaskrepeat', array('task_id'=>$id));
            	$this->home_model->delete('tblnotifications', array('module_id'=>4,'table_id'=>$id));
            	$this->home_model->delete('tblmasterapproval', array('module_id'=>25,'table_id'=>$id));

            	if(!empty($user_ids)){
            		foreach ($user_ids as $s_id) {

            			$add_data_2 = array(
		                    'task_id' => $id,
		                    'staff_id' => $s_id
		                );

		                $insert_2 = $this->home_model->insert('tbltaskusers', $add_data_2);
            		}
            	}


            	if($task_for == 1){

            		$add_data_1 = array(
		                    'task_id' => $id,
		                    'staff_id' => get_staff_user_id(),
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

		            $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1);


		            $notified = add_notification([
							'description'     => 'New Task Alloted to you',
							'touserid'        => get_staff_user_id(),
							'type'            => 0,
							'module_id'       => 4,
							'table_id'        => $id,
							'category_id'     => 0,
							'fromuserid'      => get_staff_user_id(),
							'link'            => 'Task/task_details/' . $id.'',

						]);
					if ($notified) {
						pusher_trigger_notification([get_staff_user_id()]);
					}


					//adding on master log
                    $adata = array(
                        'staff_id' => get_staff_user_id(),
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 25,
                        'description' => 'New Task Alloted to you',
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'Task/task_details/' . $id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token(get_staff_user_id());
                    $message = 'New Task Alloted to you';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
            	}

            	//Sending Notification
            	if(!empty($staff_id)){
            		foreach ($staff_id as $s_id) {

            			$add_data_1 = array(
		                    'task_id' => $id,
		                    'staff_id' => $s_id,
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

		                $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1);


            			$notified = add_notification([
							'description'     => 'New Task Alloted to you',
							'touserid'        => $s_id,
							'type'            => 0,
							'module_id'       => 4,
							'table_id'        => $id,
							'category_id'     => 0,
							'fromuserid'      => get_staff_user_id(),
							'link'            => 'Task/task_details/' . $id.'',

						]);
						if ($notified) {
							pusher_trigger_notification([$s_id]);
						}


						//adding on master log
	                    $adata = array(
	                        'staff_id' => $s_id,
	                        'fromuserid' => get_staff_user_id(),
	                        'module_id' => 25,
	                        'description' => 'New Task Alloted to you',
	                        'table_id' => $id,
	                        'approve_status' => 0,
	                        'status' => 0,
	                        'link' => 'Task/task_details/' . $id,
	                        'date' => date('Y-m-d'),
	                        'date_time' => date('Y-m-d H:i:s'),
	                        'updated_at' => date('Y-m-d H:i:s')
	                    );
	                    $this->db->insert('tblmasterapproval', $adata);

	                    //Sending Mobile Intimation
	                    $token = get_staff_token($s_id);
	                    $message = 'New Task Alloted to you';
	                    $title = 'Schach';
	                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
            		}
            	}

                /* this function use for get task date */
                if (!empty($repeat_type)){
                    $this->get_task_date($id, $start_date, $repeat_type, $repeat_every);
                }

                set_alert('success', 'Task Updated Successfully');
                redirect(admin_url('Task/added_by_me/'));
            }


		}

		$this->load->view('admin/task/added_by_me', $data);
    }

    public function getOtherDeliveryPickupData()
    {
    	$client_info = $this->home_model->get_result('tblclients', array('active'=>1), '');
    	$state_info = $this->home_model->get_result('tblstates', array('status'=>1), '');
    	?>


    	<div class=" col-md-12">

	    	<div class="form-group col-md-6" id="client_name_div">
				<label for="client_name" class="control-label">Client Name</label>
				<input type="text" id="client_name" name="client_name" class="form-control" value="" >
			</div>


	    	<div class="form-group col-md-6" id="client_id_div" hidden="">
	            <label for="ids" class="control-label">Clients</label>
	            <select class="form-control selectpicker" data-live-search="true" id="client_id" name="client_id">
	                <option value=""></option>
	                <?php
	                   if(!empty($client_info)){
	                       	foreach ($client_info as $value) {
	                       		?>
	                       		<option value="<?php echo $value->userid; ?>"><?php echo $value->company; ?></option>
	                       		<?php
	                       	}
	                   }
	                ?>
	            </select>
	        </div>

	        <div class="form-group col-md-6" app-field-wrapper="existing_client">
	            <label for="existing_client" class="control-label">Existing Client </label>
	            <input type="checkbox" name="existing_client" id="existing_client">
	        </div>

        </div>

        <div class="col-md-12">

	        <div class="form-group col-md-3" >
	            <label for="ids" class="control-label">Service Type</label>
	            <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">
	                <option value=""></option>
	                <option value="1">Rent</option>
	                <option value="2">Sales</option>
	            </select>
	        </div>

	        <div class="form-group col-md-9">
				<label for="product_details" class="control-label">Product Details</label>
				<input type="text" id="product_details" name="product_details" class="form-control" value="" >
			</div>

		</div>

		<div class="col-md-12">

			<div class="form-group col-md-4" app-field-wrapper="date">
				<label for="start_date" class="control-label">Date</label>
				<div class="input-group date">
					<input id="other_date" name="other_date" class="form-control task_date" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
				</div>
			</div>

			<div class="form-group col-md-4">
	            <label class="control-label">Select State</label>
	            <select class="form-control selectpicker" data-live-search="true" id="state_id" name="state_id">
	                <option value=""></option>
	                <?php
	                   if(!empty($state_info)){
	                       	foreach ($state_info as $value) {
	                       		?>
	                       		<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
	                       		<?php
	                       	}
	                   }
	                ?>
	            </select>
	        </div>

	        <div class="form-group col-md-4">
	            <label class="control-label">Select City</label>
	            <select class="form-control selectpicker" data-live-search="true" id="city_id" name="city_id">
	                <option value=""></option>

	            </select>
	        </div>
	    </div>
    	<?php

    }

    public function get_clients()
    {
    	$client_info = $this->home_model->get_result('tblclients', array('active'=>1), '', array('company', 'asc'));
    	?>
    	<div class="form-group col-md-6">
            <label for="ids" class="control-label">Clients</label>
            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
                <option value=""></option>
                <?php
                   if(!empty($client_info)){
                       	foreach ($client_info as $value) {
                       		?>
                       		<option value="<?php echo $value->userid; ?>"><?php echo $value->company; ?></option>
                       		<?php
                       	}
                   }
                ?>
            </select>
        </div>
    	<?php

    }


    public function get_data()
    {
    	if ($this->input->post()) {
			extract($this->input->post());

			if($related_to == 2 || $related_to == 8 || $related_to == 9){

				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));
				$f_date = $from_date.' 00:00:00';

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';


				$challan_info = $this->db->query("SELECT * FROM tblchalanmst WHERE datecreated >= '".$f_date."' and datecreated <= '".$to_date."' and status = '1'")->result();

				?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Challan</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($challan_info)){
			                       	foreach ($challan_info as $value) {

			                       		$client_info = $this->db->query("SELECT company FROM `tblclients`  where userid = '".$value->clientid."'")->row();

			                       		?>
			                       			<option value="<?php echo $value->id; ?>"><?php echo $value->chalanno.' - '.$client_info->company; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
			        <?php
			        if($related_to == 8 || $related_to == 9){
			        	echo '<div class="form-group col-md-3">
					        	<button type="button" id="get_address" class="btn btn-info">Show Address</button>
					        </div>';
			        }
			        ?>

				<?php

			}elseif($related_to == 3){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));

				$expense_info = $this->db->query("SELECT e.id,c.name as category_name FROM tblexpenses as e INNER JOIN tblexpensescategories as c ON e.category = c.id  WHERE e.date between '".$from_date."' and '".$to_date."' and e.status = '1' and e.approved_status = 1")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Expense</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($expense_info)){
			                       	foreach ($expense_info as $value) {

			                       		$exp = 'EXP-'.get_short($value->category_name).'-'.number_series($value->id);

			                       		?>
			                       			<option value="<?php echo $value->id; ?>"><?php echo $exp; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($related_to == 4){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));

				$invoice_info = $this->db->query("SELECT * FROM tblinvoices  WHERE date between '".$from_date."' and '".$to_date."' ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Invoice</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($invoice_info)){
			                       	foreach ($invoice_info as $value) {


			                       		$client_info = $this->db->query("SELECT company FROM `tblclients`  where userid = '".$value->clientid."'")->row();

			                       		$invoice = format_invoice_number($value->id);

			                       		?>
			                       			<option value="<?php echo $value->id; ?>"><?php echo $invoice.' - '.$client_info->company; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($related_to == 5){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));

				$lead_info = $this->db->query("SELECT * FROM tblleads  WHERE enquiry_date between '".$from_date."' and '".$to_date."' ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Leads</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($lead_info)){
			                       	foreach ($lead_info as $value) {

			                       		?>
			                       			<option value="<?php echo $value->id; ?>"><?php echo $value->leadno; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($related_to == 6){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));

				$estimates_info = $this->db->query("SELECT * FROM tblestimates  WHERE date between '".$from_date."' and '".$to_date."' ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Perfoma Invoice</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($estimates_info)){
			                       	foreach ($estimates_info as $value) {
			                       			$estimate = format_estimate_number($value->id);
			                       		?>
			                       			<option value="<?php echo $value->id; ?>"><?php echo $estimate; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($related_to == 7){


				$product_info = $this->db->query("SELECT * FROM tblproducts  WHERE status = 1 ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="p_ids" class="control-label">Select Products</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="p_ids" name="p_ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($product_info)){
			                       	foreach ($product_info as $value) {
			                       		?>
			                       			<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>

			        <div class="form-group col-md-3">
			        	<button type="button" id="add_qty" class="btn btn-info">Add Qty</button>
			        </div>
				<?php

			}elseif($related_to == 10){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));

				$proposals_info = $this->db->query("SELECT * FROM tblproposals  WHERE date between '".$from_date."' and '".$to_date."' ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Quotation</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($proposals_info)){
			                       	foreach ($proposals_info as $value) {
			                       			$estimate = format_proposal_number($value->id);
			                       		?>
			                       			<option value="<?php echo $value->id; ?>"><?php echo $estimate; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}


		}

    }


    public function get_product_table()
    {
    	if(!empty($_POST)){
    		extract($this->input->post());
    		?>
    		<div class="table-responsive s_table proddv" style="margin-top:19%;" >
                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
                    <thead>
                        <tr>
                            <th align="left">S.No.</th>
                            <th align="left">Product Name</th>
                            <th align="left">View</th>
                            <th align="left">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <?php
                        if(!empty($p_ids)){
                        	$i = 1;
                        	foreach ($p_ids as $p_id) {
                        		?>
                        		<tr class="main" id="tr0">
	                                <td><?php echo $i++; ?></td>
									<td><?php echo value_by_id('tblproducts',$p_id,'name'); ?></td>
									<td><a target="_blank" href="<?php echo base_url('admin/product/view/'.$p_id);?>">View</a></td>
	                                <td>
	                                    <div class="form-group">
	                                        <input type="number" id="qty" name="productqty_<?php echo $p_id; ?>" class="form-control" >
	                                    </div>
	                                </td>
	                            </tr>
                        		<?php
                        	}
                        }

                        ?>


                    </tbody>
                </table>

            </div>
    		<?php


    	}
    }



    public function added_by_me($id = '')
    {

    	check_permission(114,'view');

    	$data['task_for'] = $this->home_model->get_result('tbltaskfor', array('status'=>1), '');
    	$data['employee_info'] = $this->home_model->get_result('tblstaff', array('active'=>1), '');

    	$data['s_related_to'] = '';
    	$data['s_staff_id'] = '';

    	$where = "t.added_by = '".get_staff_user_id()."' ";

    	if(!empty($_POST)){
    		extract($this->input->post());

    		$data['s_from_date'] = $from_date;
    		$data['s_to_date'] = $to_date;
    		$data['s_related_to'] = $related_to;


    		$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			$from_date = $from_date.' 00:00:00';


			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));
			$to_date = $to_date.' 23:59:59';

			$where .= " and DATE(t.created_at) between '".$from_date."' and '".$to_date."' ";

			if(!empty($related_to)){
				$where .= " and t.related_to = '".$related_to."'";
			}

			if(!empty($staff_id)){
				$data['s_staff_id'] = $staff_id;
				$where .= " and ta.staff_id = '".$staff_id."'";
			}
    	}else{
    		//$where .= " and MONTH(t.created_at) = '".date('m')."' and YEAR(t.created_at) = '".date('Y')."'";
			$from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
            $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');
            $where .= " and DATE(t.created_at) BETWEEN '".$from_date_year."' AND '".$to_date_year."' ";
            $data['s_from_date'] = _d($from_date_year);
            $data['s_to_date'] = _d($to_date_year);
    	}


    	$data['task_info'] = $this->db->query("SELECT t.*  FROM tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id WHERE  ".$where."  GROUP by t.id order by t.id desc")->result();

    	$this->load->view('admin/task/added_by_me', $data);

    }



    public function activity_log($id = '', $from_user_id = "")
    {
    	$data['id'] = $id;
    	$data['activity_log'] = $this->home_model->get_result('tbltask_activity_log', array('task_id'=>$id), '');
    	if(!empty($_POST)){
    		extract($this->input->post());

    		$this->home_model->delete("tblmasterapproval", array("module_id" => 58, "table_id" => $id, "staff_id" => get_staff_user_id()));

			/* this is for check notification update */
            // $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$id."' and staff_id = '".get_staff_user_id()."' and module_id = 60")->result();
            // if (!empty($chk_notification)){
            //     foreach ($chk_notification as $value) {
            //         $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
            //     }
            // }
				
			/* this code use for check tagging information */
            send_activity_replied(60, $id, $from_user_id, get_staff_user_id());

			if(empty($description)){
				set_alert('danger', 'Activity cannot be empty!');
				redirect($_SERVER['HTTP_REFERER']);
				die;
			}

    		$add_data_1 = array(
		                    'task_id' => $id,
		                    'staff_id' => get_staff_user_id(),
		                    'description' => $description,
		                    'created_at' => date('Y-m-d H:i:s')
		                );

		    $insert_1 = $this->home_model->insert('tbltask_activity_log', $add_data_1);
			if($insert_1){

				if (!empty($tag_staff_ids)){
					$staff_ids = array_unique(explode(",", $tag_staff_ids));
					foreach ($staff_ids as $staff_id) {
						$tag_notification_arr = array(
                            'activity_id' => $insert_1,
                            'module_id' => 60,
                            'table_id' => $id,
                            'fromuserid' => get_staff_user_id(),
                            'touserid' => $staff_id,
                            'description' => 'You taged in Task activity Log',
							'readonly' => 0,
                            'link'  => "task/activity_log/".$id
                        );
                        send_activitytag_notification($tag_notification_arr);
					}
				}

				/* this is for tag read activity staff */
                if (!empty($tag_viewstaff_ids)){
                    $staff_ids = array_unique(explode(",", $tag_viewstaff_ids));
                    foreach ($staff_ids as $staff_id) {

                        /*send single notification to tag person */
                        $tag_notification_arr = array(
                            'activity_id' => $insert_1,
                            'module_id' => 60,
                            'table_id' => $id,
                            'fromuserid' => get_staff_user_id(),
                            'touserid' => $staff_id,
                            'description' => 'You taged in Task activity Log',
							'readonly' => 1,
                            'link'  => "task/activity_log/".$id
                        );
                        send_activitytag_notification($tag_notification_arr);
                    }
                }
				set_alert('success', 'New Activity Add Successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
    	}
		$data["title"] = value_by_id("tbltasks", $id, "title");
    	$this->load->view('admin/task/activity_log', $data);
    }


    public function added_for_me($id = '')
    {
    	check_permission(115,'view');

    	$data['s_status'] = 0;


    	$data['task_for'] = $this->home_model->get_result('tbltaskfor', array('status'=>1), '');
    	$data['s_related_to'] = '';

    	if(!empty($_POST)){
    		extract($this->input->post());

    		$data['s_status'] = $status;

    		if(!empty($from_date) && !empty($to_date)){
    			$data['s_from_date'] = $from_date;

	    		$data['s_to_date'] = $to_date;

	    		$data['s_related_to'] = $related_to;


	    		$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
				$from_date = $from_date.' 00:00:00';


				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';


				$where = "and t.created_at between '".$from_date."' and '".$to_date."' ";

				if(!empty($related_to)){
					$where .= " and t.related_to = '".$related_to."'";
				}

	    		$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = '".$status."' ".$where." ")->result();
    		}else{
    			$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = '".$status."'  ")->result();
    		}




    	}else{
    		$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = 0 ")->result();

    	}


    	$this->load->view('admin/task/added_for_me', $data);

    }


    public function task_list($id = '')
    {
    	check_permission(52,'view');
    	$data['s_status'] = 0;


    	$data['task_for'] = $this->home_model->get_result('tbltaskfor', array('status'=>1), '');
    	$data['s_related_to'] = '';

    	if(!empty($_POST)){
    		extract($this->input->post());

    		if(!empty($from_date) && !empty($to_date)){
    			$data['s_from_date'] = $from_date;

	    		$data['s_to_date'] = $to_date;

	    		$data['s_related_to'] = $related_to;


	    		$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
				$from_date = $from_date.' 00:00:00';


				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';


				$where = "and t.created_at between '".$from_date."' and '".$to_date."' ";

				if(!empty($related_to)){
					$where .= " and t.related_to = '".$related_to."'";
				}

	    		$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id from tbltasks as t LEFT JOIN tbltaskusers as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."'  ".$where." ")->result();
    		}else{
    			$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id from tbltasks as t LEFT JOIN tbltaskusers as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."'  ")->result();
    		}




    	}else{
    		$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id from tbltasks as t LEFT JOIN tbltaskusers as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' ")->result();

    	}


    	$this->load->view('admin/task/task_list', $data);

    }


    public function task_info($id = '')
    {
    	$data['id'] = $id;

    	$data['task_info'] = $this->home_model->get_row('tbltasks', array('id'=>$id), '');
    	$data['status_info'] = $this->home_model->get_row('tbltaskassignees', array('task_id'=>$id,'staff_id'=>get_staff_user_id()), '');


    	$this->load->view('admin/task/task_info', $data);
    }

/*
    public function added_for_me($id = '')
    {
    	$data['s_status'] = 0;


    	$data['task_for'] = $this->home_model->get_result('tbltaskfor', array('status'=>1), '');
    	$data['s_related_to'] = '';

    	if(!empty($_POST)){
    		extract($this->input->post());

    		$data['s_status'] = $status;

    		if(!empty($from_date) && !empty($to_date)){
    			$data['s_from_date'] = $from_date;

	    		$data['s_to_date'] = $to_date;

	    		$data['s_related_to'] = $related_to;


	    		$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
				$from_date = $from_date.' 00:00:00';


				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';


				$where = "and t.created_at between '".$from_date."' and '".$to_date."' ";

				if(!empty($related_to)){
					$where .= " and t.related_to = '".$related_to."'";
				}

	    		$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = '".$status."' ".$where." ")->result();
    		}else{
    			$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = '".$status."'  ")->result();
    		}




    	}else{
    		$data['task_info'] = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".get_staff_user_id()."' and ta.task_status = 0 ")->result();

    	}


    	$this->load->view('admin/task/added_for_me', $data);

    }*/


    public function task_details($id = '')
    {
    	$data['id'] = $id;

    	$data['task_info'] = $this->home_model->get_row('tbltasks', array('id'=>$id), '');
    	$data['status_info'] = $this->home_model->get_row('tbltaskassignees', array('task_id'=>$id,'staff_id'=>get_staff_user_id()), '');


    	if(!empty($_POST)){
    		extract($this->input->post());
    		/*echo '<pre/>';
    		print_r($_POST);
    		die;*/

			$this->home_model->delete("tblmasterapproval", array("module_id" => 58, "table_id" => $id));
    		if(!empty($due_date)){
    			//For Person who have assinged the task
    			$this->home_model->update('tbltasks', array('due_date'=>db_date($due_date)), array('id'=>$id));

    			set_alert('success', 'Task updated Successfully');
		        redirect(admin_url('Task/added_by_me'));
    		}else{
    			//For Task Assigned person
    			$where_arr = array(
	                'task_id' => $id,
	                'staff_id' => get_staff_user_id()
	            );
	            $udpate = $this->home_model->update('tbltaskassignees',array('task_status'=>$status),$where_arr);
	            if($udpate){
			   		update_masterapproval_single(get_staff_user_id(),25,$id,$status);

				   	set_alert('success', 'Task updated Successfully');
		            redirect(admin_url('Task/added_for_me'));
			   }

    		}
    	}

    	$this->load->view('admin/task/task_details', $data);
    }


    public function get_repeat_every($id = '')
    {
    	$data['id'] = $id;

    	$days_info = $this->home_model->get_result('tbldays', '', '');


    	if(!empty($_POST)){
    		extract($this->input->post());

    		$html = '';
    		if($repeat_type == 1){
    			if(!empty($days_info)){
    				foreach ($days_info as $key => $value) {
    					$html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
    				}
    			}
    		}else{
    			for ($i=1; $i <= 31 ; $i++) {
    				$html .= '<option value="'.$i.'">'.$i.'</option>';
    			}
    		}


    		echo $html;

    	}

    }


    public function get_address()
    {


    	if(!empty($_POST)){
    		extract($this->input->post());

			echo get_challan_address($ids);

    	}
    }

    public function get_assignee_list()
    {


    	if(!empty($_POST)){
    		extract($this->input->post());

    		$task_info = $this->home_model->get_row('tbltasks', array('id'=>$id), '');

    		$assignee_info = $this->db->query("SELECT * from `tbltaskassignees` where task_id = '".$id."' ")->result();

			?>
			 <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('Task/task_reassign'); ?>">

			<div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Purchase Order Products</h4>
                </div>

				<hr/>
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" id="docAttachDivVideo" >
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Action Date</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>

                                	<!-- <tr>
                                    <td>1</td>
                                    <td>Test</td>
                                    <td>AAA</td>
                                    <td><input class="form-control" type="text" ></td>
                                </tr>
 -->
                                <?php
                                if(!empty($assignee_info)){
                                	$i = 1;
                                	foreach ($assignee_info as $key => $value) {


                                		?>
                                		<tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo get_employee_name($value->staff_id);?></td>
                                            <td><?php echo ($value->updated_at > 0) ? date('d/m/Y h:i a') : '--'; ?></td>
                                            <td>
                                            	<input type="hidden" value="<?php echo $value->id ;?>" name="row[]">
                                            	<div class="form-group">
						                            <select class="form-control" name="<?php echo 'status_'.$value->id; ?>" required="">
						                              <option value="" disabled="" selected="">--Select One-</option>
						                              <option value="0" <?php if($value->task_status == 0){ echo 'selected'; } ?> >Pending</option>
						                              <option value="1" <?php if($value->task_status == 1){ echo 'selected'; } ?> >Completed</option>
						                              <option value="2" <?php if($value->task_status == 2){ echo 'selected'; } ?> >Rejected</option>
						                            </select>
					                        	</div>

					                    	</td>
                                        </tr>
                                		<?php
                                	}
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <input type="hidden" value="<?php echo $id; ?>" name="task_id">
              <div class="col-md-12">
                <?php
                if($task_info->is_repeat == 0){
                  ?>
                    <div class="text-right">
                      <button class="btn btn-info">Change Status</button>
                    </div>
                  <?php
                }
                ?>
              </div>
              <div class="clearfix"></div>
                </div>
            </div>
        	</form>
			<?php

    	}
    }


    public function task_reassign()
    {
    	if(!empty($_POST)){
    		extract($this->input->post());
    		/*echo '<pre/>';
    		print_r($_POST);
    		die;*/
    		if(!empty($row)){
    			foreach ($row as $id) {

    				$assignees_info = $this->home_model->get_row('tbltaskassignees', array('id'=>$id), '');
    				$status = $_POST['status_'.$id];

    				if($assignees_info->task_status != $status){

    					$add_data = array(
		                    'task_status' => $status,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

    					$this->home_model->update('tbltaskassignees', $add_data, array('id'=>$id));

    					$task_info = $this->home_model->get_row('tbltasks', array('id'=>$task_id), '');

    					if($status == 1 || $status == 2){

    						//For Complete and Reject


					    	$assignee_count = $this->db->query("SELECT COUNT(id) as ttl_assignees from `tbltaskassignees` where task_id = '".$task_id."' ")->row();
					    	$compeleted_count = $this->db->query("SELECT COUNT(id) as ttl_compeleted from `tbltaskassignees` where task_id = '".$task_id."' and task_status = 1 ")->row();

							//getting comeleted percent
					    	$compeleted_percent = (100/$assignee_count->ttl_assignees)*$compeleted_count->ttl_compeleted;

					    	if($status == 1){
					    		$description = 'Task is Compeleted. Completed '.round($compeleted_percent).' %';
					    		$message = 'Task is Compeleted';
					    	}elseif($status == 2){
					    		$description = 'Task is Rejected. Completed '.round($compeleted_percent).' %';
					    		$message = 'Task is Rejected';
					    	}

					    	//Sending Mobile Intimation
							$token = get_staff_token($task_info->added_by);

							$title = 'SSAFE';
							$send_intimation = sendFCM($message, $title, $token);

							$this->home_model->delete('tblnotifications', array('module_id'=>4,'table_id'=>$task_id,'task_completion'=>1));

					    	$add_data_2 = array(
				                    'description' => $description,
				                    'touserid' => $task_info->added_by,
				                    'fromuserid' => get_staff_user_id(),
				                    'table_id' => $task_id,
				                    'type' => 0,
				                    'isread' => 0,
				                    'isread_inline' => 0,
				                    'module_id' => 4,
				                    'category_id' => 0,
				                    'task_completion' => 1,
				                    'link'            => '--',
				                    'date' => date('Y-m-d H:i:s')
				                );

				            $insert_1 = $this->home_model->insert('tblnotifications', $add_data_2);

    					}elseif($status == 0){

    						//Sending Mobile Intimation
							$token = get_staff_token($assignees_info->staff_id);
							$message = 'Task Reassigned';
							$title = 'Schach';
							$send_intimation = sendFCM($message, $title, $token);

							$add_data_2 = array(
				                    'description' => 'Task Realloted to you',
				                    'touserid' => $assignees_info->staff_id,
				                    'fromuserid' => $task_info->added_by,
				                    'table_id' => $task_id,
				                    'type' => 0,
				                    'isread' => 0,
				                    'isread_inline' => 0,
				                    'module_id' => 4,
				                    'category_id' => 0,
				                    'link'            => 'Task/task_details/' . $task_id.'',
				                    'date' => date('Y-m-d H:i:s')
				                );

				            $insert_1 = $this->home_model->insert('tblnotifications', $add_data_2);

    					}



    					//Updateting Masterapproval Status
    					$where_arr = array(
		                    'module_id'=> 25,
    						'table_id'=> $task_id,
    						'staff_id'=> $assignees_info->staff_id
		                );
					    $this->home_model->update('tblmasterapproval',array('approve_status'=>$status),$where_arr);


    				}

    			}
    		}


    		redirect(admin_url('Task/added_by_me/'));

    	}

    }


    public function get_city()
    {


    	if(!empty($_POST)){
    		extract($this->input->post());

			$city_info = $this->db->query("SELECT * from `tblcities` where state_id = '".$state_id."' and status = 1 ")->result();

			$html = '<option value="" ></option>';
			if(!empty($city_info)){
				foreach ($city_info as $value) {
					$html .= '<option value="'.$value->id.'" >'.$value->name.'</option>';
				}
			}
		   echo $html;
    	}
    }

    /* this function use for get task date */
    public function get_task_date($task_id, $start_date, $repeat_type, $repeat_count, $start = 0){
        if($start < $repeat_count){
            switch ($repeat_type) {
                case 1:
                    $repeat_priod = "+7 days";
                    break;
                case 2:
                    $repeat_priod = "+1 month";
                    break;
                case 3:
                    $repeat_priod = "+2 month";
                    break;
                case 4:
                    $repeat_priod = "+3 month";
                    break;
                case 5:
                    $repeat_priod = "+6 month";
                    break;
                case 6:
                    $repeat_priod = "+12 month";
                    break;
                default:
                    $repeat_priod = "";
                    break;
            }

            $next_date = date( "Y-m-d", strtotime($start_date." ".$repeat_priod) );
            $insert_data["task_id"] = $task_id;
            $insert_data["date"] = $next_date;
            $this->home_model->insert('tbltaskrepeat', $insert_data);
            $this->get_task_date($task_id, $next_date, $repeat_type, $repeat_count, $start+1);
        }
    }


}
