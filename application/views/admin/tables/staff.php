<?php

defined('BASEPATH') or exit('No direct script access allowed');

$has_permission_delete = has_permission('staff', '', 'delete');

$custom_fields = get_custom_fields('staff', [
    'show_on_table' => 1,
    ]);
$aColumns = [
    'firstname',
    'email',
    'phonenumber',
    'added_by',
    'last_login',
    'active',
    'approval_status',
    'token_id',
    ];
$sIndexColumn = 'staffid';
$sTable       = 'tblstaff';
$join         = [];
$i            = 0;
foreach ($custom_fields as $field) {
    $select_as = 'cvalue_' . $i;
    if ($field['type'] == 'date_picker' || $field['type'] == 'date_picker_time') {
        $select_as = 'date_picker_cvalue_' . $i;
    }
    array_push($aColumns, 'ctable_' . $i . '.value as ' . $select_as);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $i . ' ON tblstaff.staffid = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);
    $i++;
}
            // Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}

$where = do_action('staff_table_sql_where', []);

array_push($where, 'AND tblstaff.active = 1');

/* this condition will be check designation of login person */
$staffdesignation_id = get_staff_info(get_staff_user_id())->designation_id;
if (is_admin() == 0 && (!in_array($staffdesignation_id, [4]))){
    array_push($where, 'AND tblstaff.added_by ='.get_staff_user_id());
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
    'profile_image',
    'lastname',
    'staffid',
    'admin',
    ]);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    for ($i = 0; $i < count($aColumns); $i++) {
        if (strpos($aColumns[$i], 'as') !== false && !isset($aRow[$aColumns[$i]])) {
            $_data = $aRow[strafter($aColumns[$i], 'as ')];
        } else {
            $_data = $aRow[$aColumns[$i]];
        }
        if ($aColumns[$i] == 'last_login') {
            if ($_data != null) {
                $_data = '<span class="text-has-action" data-toggle="tooltip" data-title="' . _dt($_data) . '">' . time_ago($_data) . '</span>';
            } else {
                $_data = 'Never';
            }
        } elseif ($aColumns[$i] == 'active') {
            $checked = '';
            if ($aRow['active'] == 1) {
                $checked = 'checked';
            }

            $_data = '<div class="onoffswitch">
                <input type="checkbox" ' . ($aRow['staffid'] == get_staff_user_id() ? 'disabled' : '') . ' data-switch-url="' . admin_url() . 'staff/change_staff_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['staffid'] . '" data-id="' . $aRow['staffid'] . '" ' . $checked . '>
                <label class="onoffswitch-label" for="c_' . $aRow['staffid'] . '"></label>
            </div>';

            // For exporting
            $_data .= '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
        } elseif ($aColumns[$i] == 'firstname') {
            $_data = '<a href="' . admin_url('staff/profile/' . $aRow['staffid']) . '">' . staff_profile_image($aRow['staffid'], [
                'staff-profile-image-small',
                ]) . '</a>';

            $employee_id = $this->ci->db->query("SELECT employee_id FROM `tblstaff` where staffid = '".$aRow['staffid']."' ")->row()->employee_id;

            $_data .= ' <a href="' . admin_url('staff/member/' . $aRow['staffid']) . '">' . $aRow['firstname'] . ' ' . $aRow['lastname'] . '</a>';
             $_data .= ' - '.$employee_id;

            $_data .= '<div class="row-options">';
            $_data .= '<a href="' . admin_url('staff/member/' . $aRow['staffid']) . '">' . _l('view') . '</a>';

//            if (($has_permission_delete && ($has_permission_delete && !is_admin($aRow['staffid']))) || is_admin()) {
//                if ($has_permission_delete && $output['iTotalRecords'] > 1 && $aRow['staffid'] != get_staff_user_id()) {
//                    $_data .= ' | <a href="#" onclick="delete_staff_member(' . $aRow['staffid'] . '); return false;" class="text-danger">' . _l('delete') . '</a>';
//                }
//            }
			
//             $_data .= ' | <a href="' . admin_url('staff/email_setting/' . $aRow['staffid']) . '">Email Setting</a>';
//			 $_data .= ' | <a href="' . admin_url('requests/staff_loan_details/' . $aRow['staffid']) . '">Loan Details</a>';
             //$_data .= ' | <a href="' . admin_url('staff_iteams/allot_iteams/' . $aRow['staffid']) . '" target="_blank">Allot Iteams</a>';

            $_data .= '</div>';
        } elseif ($aColumns[$i] == 'email') {
            $_data = '<a href="mailto:' . $_data . '">' . $_data . '</a>';
        } elseif ($aColumns[$i] == 'approval_status') {
                if  ($aRow["approval_status"] == 0) {
                    $status = 'Pending';
                    $cls = 'btn-warning btn-xs';
                } elseif ($aRow["approval_status"] == 1) {
                    $status = 'Approved';
                    $cls = 'btn-success btn-xs';
                } elseif ($aRow["approval_status"] == 2) {
                    $status = 'Rejected';
                    $cls = 'btn-danger btn-xs';
                }
            $staff_log_id = $this->ci->db->query("SELECT id FROM tblstafflog WHERE `staffid` = '".$aRow['staffid']."' ORDER BY id desc")->row();    
            $log_id = (!empty($staff_log_id)) ? $staff_log_id->id : 0;
            $_data = '<button type="button" class="btn ' . $cls . ' btn-sm" onclick="get_changes_status(' . $log_id . '); return false;" data-toggle="modal" data-target="#approvestatusModal">' . $status . '</button>';
        } elseif ($aColumns[$i] == 'token_id') {
            $_data = '<a target="_blank" href="'.admin_url('menu_master/assign/' . $aRow['staffid']).'">Set Permission</a>';
        }elseif ($aColumns[$i] == 'added_by') {
            $added_by_name = '--';
            if($aRow['added_by'] > 0){
                $added_by_name = get_employee_name($aRow['added_by']);
            }
            $_data = '<a target="_blank" href="'.admin_url('staff/member/' . $aRow['added_by']).'">'.$added_by_name.'</a>';
        }else {
            if (strpos($aColumns[$i], 'date_picker_') !== false) {
                $_data = (strpos($_data, ' ') !== false ? _dt($_data) : _d($_data));
            }
        }
        $row[] = $_data;
    }

    $row['DT_RowClass'] = 'has-row-options';
    $output['aaData'][] = $row;
}
