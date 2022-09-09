<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Settings_model extends CRM_Model
{
    private $encrypted_fields = ['smtp_password'];

    public function __construct()
    {
        parent::__construct();
        $payment_gateways = $this->payment_modes_model->get_online_payment_modes(true);
        foreach ($payment_gateways as $gateway) {
            $class_name = $gateway['id'] . '_gateway';
            $settings   = $this->$class_name->get_settings();
            foreach ($settings as $option) {
                if (isset($option['encrypted']) && $option['encrypted'] == true) {
                    array_push($this->encrypted_fields, $option['name']);
                }
            }
        }
    }
	
    /**
     * Update all settings
     * @param  array $data all settings
     * @return integer
     */
    public function update($data)
    {
		if(isset($data['warehouse']))
		{
			if(isset($data['warehouseid']) & $data['warehouseid']!='')
			{
				$this->db->where('id', $data['warehouseid']);
				$this->db->update('tblwarehouse', $data['warehouse']);
				$this->db->where('warehouse_id', $data['warehouseid']);
				$this->db->delete('tblwarehouseperson');
				$insert_id =$data['warehouseid'];
			}
			else
			{
				$this->db->insert('tblwarehouse', $data['warehouse']);
				$insert_id = $this->db->insert_id();
			}
			$staffdata = $data['staffdata'];
			foreach ($staffdata as $singlestaffdata) {
                $wpata['warehouse_id'] = $insert_id;
                $wpata['staffid'] = $singlestaffdata['staff_id'];
                $wpata['email'] = $singlestaffdata['email'];
                $wpata['number'] = $singlestaffdata['contno'];
                $wpata['designation'] = $singlestaffdata['designation'];
                $wpata['status'] = 1;
                $wpata['created_at'] = date("Y-m-d H:i:s");
                $wpata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblwarehouseperson', $wpata);
            }
			set_alert('success', _l('added_successfully', _l('warehouse')));
			redirect(admin_url('settings?group=warehouselist'));
		}
		
		
		if(isset($data['companybranch']))
		{
			$warehouse_id= implode(',',$data['warehouse_id']);
			$data['companybranch']['warehouse_id']=$warehouse_id;
			$data['companybranch']['staff_id']=get_staff_user_id();
			if(isset($data['compbranchid']) & $data['compbranchid']!='')
			{
				$this->db->where('id', $data['compbranchid']);
				$this->db->update('tblcompanybranch', $data['companybranch']);
				$this->db->where('comp_branch_id', $data['compbranchid']);
				$this->db->delete('tblcompanybranchperson');
				$insert_id =$data['compbranchid'];
			}
			else
			{
				$this->db->insert('tblcompanybranch', $data['companybranch']);
				$insert_id = $this->db->insert_id();
			}
			$companystaffdata = $data['companystaff'];
			foreach ($companystaffdata as $singlecompanystaffdata) {
                $cspata['comp_branch_id'] = $insert_id;
                $cspata['staffid'] = $singlecompanystaffdata['staff_id'];
                $cspata['email'] = $singlecompanystaffdata['email'];
                $cspata['number'] = $singlecompanystaffdata['contno'];
                $cspata['designation'] = $singlecompanystaffdata['designation'];
                $cspata['status'] = 1;
                $cspata['created_at'] = date("Y-m-d H:i:s");
                $cspata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblcompanybranchperson', $cspata);
            }
			set_alert('success', _l('added_successfully', _l('company_branch_lowercase')));
			redirect(admin_url('settings?group=branchlist'));
		}
		
		if(isset($data['bank']))
		{
			if(isset($data['bankid']) & $data['bankid']!='')
			{
				$this->db->where('id', $data['bankid']);
				$this->db->update('tblbankmaster', $data['bank']);
				$this->db->where('id', $data['bankid']);
			}
			else
			{
				$data['bank']['created_at'] = date("Y-m-d H:i:s");
                $data['bank']['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblbankmaster', $data['bank']);
			}
			set_alert('success', _l('added_successfully', _l('bank')));
			redirect(admin_url('settings?group=banklist'));
		}
		if(isset($data['paytype']))
		{
			if(isset($data['paymenttypeid']) & $data['paymenttypeid']!='')
			{
				$this->db->where('id', $data['paymenttypeid']);
				$this->db->update('tblpaymenttypes', $data['paytype']);
				$this->db->where('id', $data['paymenttypeid']);
			}
			else
			{
				$data['paytype']['created_at'] = date("Y-m-d H:i:s");
                $data['paytype']['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblpaymenttypes', $data['paytype']);
			}
			set_alert('success', "Payment Type Added Successfully");
			redirect(admin_url('settings?group=paymenttypelist'));
		}
		
        if(isset($data['receipt']))
        {
            if(isset($data['receiptid']) & $data['receiptid']!='')
            {
                $this->db->where('id', $data['receiptid']);
                $this->db->update('tblreceiptmaster', $data['receipt']);
                $this->db->where('id', $data['receiptid']);
            }
            else
            {
                $this->db->insert('tblreceiptmaster', $data['receipt']);
            }
            set_alert('success', _l('added_successfully', _l('receipt')));
            redirect(admin_url('settings?group=receiptlist'));
        }

        if(isset($data['Payment']))
        {
            if(isset($data['id']) & $data['id']!='')
            {
                $this->db->where('id', $data['id']);
                $this->db->update('tblpaymentmethod', $data['Payment']);
                $this->db->where('id', $data['id']);

                set_alert('success', 'Updated', 'Payment Method');
            redirect(admin_url('settings?group=payment_method_list'));
            }
            else
            {
                $this->db->insert('tblpaymentmethod', $data['Payment']);
                set_alert('success', _l('added_successfully', 'Payment Method'));
            redirect(admin_url('settings?group=payment_method_list'));
            }
            
        }
        if(isset($data['master_password']))
        {
            if (!empty($data['master_password'])){
                $this->load->helper('phpass');
                $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                $password = $hasher->HashPassword($data['master_password']);
                $chk_pass = $this->db->query("SELECT `value` FROM `tbloptions` WHERE `name` = 'employee_master_login'")->row();
                if (!empty($chk_pass)){

                    $passdata['value'] = $password;
                    $this->db->where('name', 'employee_master_login');
                    $this->db->update('tbloptions', $passdata);

                    set_alert('success', 'Master Password Update Successfully');
                    redirect(admin_url('settings?group=employee_master_password'));
                }else{
                    $passdata['name'] = "employee_master_login";
                    $passdata['value'] = $password;
                    $passdata['autoload'] = 0;
                    $this->db->insert('tbloptions', $passdata);

                    set_alert('success', _l('added_successfully', 'Employee Master Password'));
                    redirect(admin_url('settings?group=employee_master_password'));
                }
            }else{
                set_alert('warning', "Password can't be blank");
                redirect(admin_url('settings?group=employee_master_password'));
            }  
        }
		
		
        $original_encrypted_fields = [];
        foreach ($this->encrypted_fields as $ef) {
            $original_encrypted_fields[$ef] = get_option($ef);
        }
        $affectedRows = 0;
        $data         = do_action('before_settings_updated', $data);
        if (isset($data['tags'])) {
            foreach ($data['tags'] as $id => $name) {
                $this->db->where('id', $id);
                $this->db->update('tbltags', ['name' => $name]);
                $affectedRows += $this->db->affected_rows();
            }
        } else {
            if (!isset($data['settings']['default_tax']) && isset($data['finance_settings'])) {
                $data['settings']['default_tax'] = [];
            }
            $all_settings_looped = [];
            foreach ($data['settings'] as $name => $val) {

                // Do not trim thousand separator option
                // There is an option of white space there and if will be trimmed wont work as configured
                if (is_string($val) && $name != 'thousand_separator') {
                    $val = trim($val);
                }



                array_push($all_settings_looped, $name);

                $hook_data['name']  = $name;
                $hook_data['value'] = $val;
                $hook_data          = do_action('before_single_setting_updated_in_loop', $hook_data);
                $name               = $hook_data['name'];
                $val                = $hook_data['value'];

                // Check if the option exists
                $this->db->where('name', $name);
                $exists = $this->db->count_all_results('tbloptions');
                if ($exists == 0) {
                    continue;
                }

                if ($name == 'default_contact_permissions') {
                    $val = serialize($val);
                } elseif ($name == 'visible_customer_profile_tabs') {
                    if ($val == '') {
                        $val = 'all';
                    } else {
                        $val = serialize($val);
                    }
                } elseif ($name == 'email_signature') {
                    $val = nl2br_save_html($val);
                } elseif ($name == 'default_tax') {
                    $val = array_filter($val, function ($value) {
                        return $value !== '';
                    });
                    $val = serialize($val);
                } elseif ($name == 'company_info_format' || $name == 'customer_info_format' || $name == 'proposal_info_format' || strpos($name, 'sms_trigger_') !== false) {
                    $val = strip_tags($val);
                    $val = nl2br($val);
                } elseif (in_array($name, $this->encrypted_fields)) {
                    // Check if not empty $val password
                    // Get original
                    // Decrypt original
                    // Compare with $val password
                    // If equal unset
                    // If not encrypt and save
                    if (!empty($val)) {
                        $or_decrypted = $this->encryption->decrypt($original_encrypted_fields[$name]);
                        if ($or_decrypted == $val) {
                            continue;
                        }
                        $val = $this->encryption->encrypt($val);
                    }
                }

                $this->db->where('name', $name);
                $this->db->update('tbloptions', [
                    'value' => $val,
                ]);

                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                    if($name == 'save_last_order_for_tables') {
                        $this->db->query('DELETE FROM tblusermeta where meta_key like "%-table-last-order"');
                    }
                }
            }

            // Contact permission default none
            if (!in_array('default_contact_permissions', $all_settings_looped)
                && in_array('customer_settings', $all_settings_looped)) {
                $this->db->where('name', 'default_contact_permissions');
                $this->db->update('tbloptions', [
                'value' => serialize([]),
            ]);
                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            } elseif (!in_array('visible_customer_profile_tabs', $all_settings_looped)
                && in_array('customer_settings', $all_settings_looped)) {
                $this->db->where('name', 'visible_customer_profile_tabs');
                $this->db->update('tbloptions', [
                'value' => 'all',
            ]);
                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            }

            if (isset($data['custom_fields'])) {
                if (handle_custom_fields_post(0, $data['custom_fields'])) {
                    $affectedRows++;
                }
            }
        }


        return $affectedRows;
    }

    public function add_new_company_pdf_field($data)
    {
        $field = 'custom_company_field_' . trim($data['field']);
        $field = preg_replace('/\s+/', '_', $field);
        if (add_option($field, $data['value'])) {
            return true;
        }

        return false;
    }
	
	public function delete($id) {
		
        $this->db->where('id', $id);
        $this->db->delete('tblwarehouse');  

		// Warehouse Person delete
        $this->db->where('warehouse_id', $id);
        $this->db->delete('tblwarehouseperson');		
        if ($this->db->affected_rows() > 0) {
            logActivity('Warehouse Deleted [ID: ' . $id . ']');
            return true;
        }
        return false;
    }
	
	public function deletecompbranch($id) {
		
        $this->db->where('id', $id);
        $this->db->delete('tblcompanybranch');  

		// Warehouse Person delete
        $this->db->where('comp_branch_id', $id);
        $this->db->delete('tblcompanybranchperson');		
        if ($this->db->affected_rows() > 0) {
            logActivity('Company branch Deleted [ID: ' . $id . ']');
            return true;
        }
        return false;
    }
	
	public function deletebank($id) {
		
        $this->db->where('id', $id);
        $this->db->delete('tblbankmaster');  

        if ($this->db->affected_rows() > 0) {
            logActivity('Bank Deleted [ID: ' . $id . ']');
            return true;
        }
        return false;
    }
	public function deletepaymenttype($id) {
		
        $this->db->where('id', $id);
        $this->db->delete('tblpaymenttypes');  

        if ($this->db->affected_rows() > 0) {
            logActivity('Payment Type Deleted [ID: ' . $id . ']');
            return true;
        }
        return false;
    }
	


}
