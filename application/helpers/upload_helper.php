<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Handles uploads error with translation texts
 * @param  mixed $error type of error
 * @return mixed
 */
function _perfex_upload_error($error) {
    $phpFileUploadErrors = [
        0 => _l('file_uploaded_success'),
        1 => _l('file_exceeds_max_filesize'),
        2 => _l('file_exceeds_maxfile_size_in_form'),
        3 => _l('file_uploaded_partially'),
        4 => _l('file_not_uploaded'),
        6 => _l('file_missing_temporary_folder'),
        7 => _l('file_failed_to_write_to_disk'),
        8 => _l('file_php_extension_blocked'),
    ];

    if (isset($phpFileUploadErrors[$error]) && $error != 0) {
        return $phpFileUploadErrors[$error];
    }

    return false;
}

/**
 * Newsfeed post attachments
 * @param  mixed $postid Post ID to add attachments
 * @return array  - Result values
 */
function handle_newsfeed_post_attachments($postid) {
    if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    $path = get_upload_path_by_type('newsfeed') . $postid . '/';
    $CI = & get_instance();
    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_newsfeed_attachment', $postid);
        $uploaded_files = false;
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $file_uploaded = true;
                $attachment = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype' => $_FILES['file']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($postid, 'newsfeed_post', $attachment);
            }
        }
        if ($file_uploaded == true) {
            echo json_encode([
                'success' => true,
                'postid' => $postid,
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'postid' => $postid,
            ]);
        }
    }
}

/**
 * Handles upload for project files
 * @param  mixed $project_id project id
 * @return boolean
 */
function handle_project_file_uploads($project_id) {
    $filesIDS = [];
    $errors = [];

    if (isset($_FILES['file']['name']) && ($_FILES['file']['name'] != '' || is_array($_FILES['file']['name']) && count($_FILES['file']['name']) > 0)) {
        do_action('before_upload_project_attachment', $project_id);

        if (!is_array($_FILES['file']['name'])) {
            $_FILES['file']['name'] = [$_FILES['file']['name']];
            $_FILES['file']['type'] = [$_FILES['file']['type']];
            $_FILES['file']['tmp_name'] = [$_FILES['file']['tmp_name']];
            $_FILES['file']['error'] = [$_FILES['file']['error']];
            $_FILES['file']['size'] = [$_FILES['file']['size']];
        }

        $path = get_upload_path_by_type('project') . $project_id . '/';

        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            if (_perfex_upload_error($_FILES['file']['error'][$i])) {
                $errors[$_FILES['file']['name'][$i]] = _perfex_upload_error($_FILES['file']['error'][$i]);

                continue;
            }

            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            // Make sure we have a filepath
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = unique_filename($path, $_FILES['file']['name'][$i]);
                $newFilePath = $path . $filename;
                // Upload the file into the company uploads dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $CI = & get_instance();
                    if (is_client_logged_in()) {
                        $contact_id = get_contact_user_id();
                        $staffid = 0;
                    } else {
                        $staffid = get_staff_user_id();
                        $contact_id = 0;
                    }
                    $data = [
                        'project_id' => $project_id,
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$i],
                        'dateadded' => date('Y-m-d H:i:s'),
                        'staffid' => $staffid,
                        'contact_id' => $contact_id,
                        'subject' => $filename,
                    ];
                    if (is_client_logged_in()) {
                        $data['visible_to_customer'] = 1;
                    } else {
                        $data['visible_to_customer'] = ($CI->input->post('visible_to_customer') == 'true' ? 1 : 0);
                    }
                    $CI->db->insert('tblprojectfiles', $data);

                    $insert_id = $CI->db->insert_id();
                    if ($insert_id) {
                        if (is_image($newFilePath)) {
                            create_img_thumb($path, $filename);
                        }
                        array_push($filesIDS, $insert_id);
                    } else {
                        unlink($newFilePath);

                        return false;
                    }
                }
            }
        }
    }

    if (count($filesIDS) > 0) {
        $CI->load->model('projects_model');
        end($filesIDS);
        $lastFileID = key($filesIDS);
        $CI->projects_model->new_project_file_notification($filesIDS[$lastFileID], $project_id);
    }

    if (count($errors) > 0) {
        $message = '';
        foreach ($errors as $filename => $error_message) {
            $message .= $filename . ' - ' . $error_message . '<br />';
        }
        header('HTTP/1.0 400 Bad error');
        echo $message;
        die;
    }

    if (count($filesIDS) > 0) {
        return true;
    }

    return false;
}

/**
 * Handle contract attachments if any
 * @param  mixed $contractid
 * @return boolean
 */
function handle_contract_attachment($id) {
    if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        do_action('before_upload_contract_attachment', $id);
        $path = get_upload_path_by_type('contract') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $attachment = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype' => $_FILES['file']['type'],
                ];
                $CI->misc_model->add_attachment_to_database($id, 'contract', $attachment);

                return true;
            }
        }
    }

    return false;
}

/**
 * Handle lead attachments if any
 * @param  mixed $leadid
 * @return boolean
 */
function handle_lead_attachments($leadid, $index_name = 'file', $form_activity = false) {
    if (isset($_FILES[$index_name]) && empty($_FILES[$index_name]['name']) && $form_activity) {
        return;
    }

    if (isset($_FILES[$index_name]) && _perfex_upload_error($_FILES[$index_name]['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES[$index_name]['error']);
        die;
    }

    $CI = & get_instance();
    if (isset($_FILES[$index_name]['name']) && $_FILES[$index_name]['name'] != '') {
        do_action('before_upload_lead_attachment', $leadid);
        $path = get_upload_path_by_type('lead') . $leadid . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES[$index_name]['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            if (!_upload_extension_allowed($_FILES[$index_name]['name'])) {
                return false;
            }

            _maybe_create_upload_path($path);

            $filename = unique_filename($path, $_FILES[$index_name]['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $CI->load->model('leads_model');
                $data = [];
                $data[] = [
                    'file_name' => $filename,
                    'filetype' => $_FILES[$index_name]['type'],
                ];
                $CI->leads_model->add_attachment_to_database($leadid, $data, false, $form_activity);

                return true;
            }
        }
    }

    return false;
}

/**
 * Task attachments upload array
 * Multiple task attachments can be upload if input type is array or dropzone plugin is used
 * @param  mixed $taskid     task id
 * @param  string $index_name attachments index, in different forms different index name is used
 * @return mixed
 */
function handle_task_attachments_array($taskid, $index_name = 'attachments') {
    $uploaded_files = [];
    $path = get_upload_path_by_type('task') . $taskid . '/';
    $CI = &get_instance();

    if (isset($_FILES[$index_name]['name']) && ($_FILES[$index_name]['name'] != '' || is_array($_FILES[$index_name]['name']) && count($_FILES[$index_name]['name']) > 0)) {
        if (!is_array($_FILES[$index_name]['name'])) {
            $_FILES[$index_name]['name'] = [$_FILES[$index_name]['name']];
            $_FILES[$index_name]['type'] = [$_FILES[$index_name]['type']];
            $_FILES[$index_name]['tmp_name'] = [$_FILES[$index_name]['tmp_name']];
            $_FILES[$index_name]['error'] = [$_FILES[$index_name]['error']];
            $_FILES[$index_name]['size'] = [$_FILES[$index_name]['size']];
        }

        _file_attachments_index_fix($index_name);
        for ($i = 0; $i < count($_FILES[$index_name]['name']); $i++) {
            // Get the temp file path
            $tmpFilePath = $_FILES[$index_name]['tmp_name'][$i];

            // Make sure we have a filepath
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                if (_perfex_upload_error($_FILES[$index_name]['error'][$i]) || !_upload_extension_allowed($_FILES[$index_name]['name'][$i])) {
                    continue;
                }

                _maybe_create_upload_path($path);
                $filename = unique_filename($path, $_FILES[$index_name]['name'][$i]);
                $newFilePath = $path . $filename;

                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    array_push($uploaded_files, [
                        'file_name' => $filename,
                        'filetype' => $_FILES[$index_name]['type'][$i],
                    ]);
                    if (is_image($newFilePath)) {
                        create_img_thumb($path, $filename);
                    }
                }
            }
        }
    }

    if (count($uploaded_files) > 0) {
        return $uploaded_files;
    }

    return false;
}

/**
 * Invoice attachments
 * @param  mixed $invoiceid invoice ID to add attachments
 * @return array  - Result values
 */
function handle_sales_attachments($rel_id, $rel_type) {
    if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }

    $path = get_upload_path_by_type($rel_type) . $rel_id . '/';

    $CI = & get_instance();
    if (isset($_FILES['file']['name'])) {
        $uploaded_files = false;
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $type = $_FILES['file']['type'];
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $file_uploaded = true;
                $attachment = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype' => $type,
                ];
                $insert_id = $CI->misc_model->add_attachment_to_database($rel_id, $rel_type, $attachment);
                // Get the key so we can return to ajax request and show download link
                $CI->db->where('id', $insert_id);
                $_attachment = $CI->db->get('tblfiles')->row();
                $key = $_attachment->attachment_key;

                if ($rel_type == 'invoice') {
                    $CI->load->model('invoices_model');
                    $CI->invoices_model->log_invoice_activity($rel_id, 'invoice_activity_added_attachment');
                } elseif ($rel_type == 'estimate') {
                    $CI->load->model('estimates_model');
                    $CI->estimates_model->log_estimate_activity($rel_id, 'estimate_activity_added_attachment');
                }
            }
        }
        if ($file_uploaded == true) {
            echo json_encode([
                'success' => true,
                'attachment_id' => $insert_id,
                'filetype' => $type,
                'rel_id' => $rel_id,
                'file_name' => $filename,
                'key' => $key,
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'rel_id' => $rel_id,
                'file_name' => $filename,
            ]);
        }
    }
}

/**
 * Client attachments
 * @param  mixed $clientid Client ID to add attachments
 * @return array  - Result values
 */
function handle_client_attachments_upload($id, $customer_upload = false) {
    $path = get_upload_path_by_type('customer') . $id . '/';
    $CI = & get_instance();
    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_client_attachment', $id);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $attachment = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype' => $_FILES['file']['type'],
                ];
                if (is_image($newFilePath)) {
                    create_img_thumb($newFilePath, $filename);
                }

                if ($customer_upload == true) {
                    $attachment[0]['staffid'] = 0;
                    $attachment[0]['contact_id'] = get_contact_user_id();
                    $attachment['visible_to_customer'] = 1;
                }

                $CI->misc_model->add_attachment_to_database($id, 'customer', $attachment);
            }
        }
    }
}

/**
 * Handles upload for expenses receipt
 * @param  mixed $id expense id
 * @return void
 */
function handle_expense_attachments($id) {
    if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    $path = get_upload_path_by_type('expense') . $id . '/';
    $CI = & get_instance();

    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_expense_attachment', $id);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename = $_FILES['file']['name'];
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $attachment = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype' => $_FILES['file']['type'],
                ];

                $CI->misc_model->add_attachment_to_database($id, 'expense', $attachment);
            }
        }
    }
}
/*function handle_multi_task_attachments($id,$type,$data)
{
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['file']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                        'staffid'=>$data['staffid'],
                        'task_comment_id'=>$data['task_comment_id']
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
                }
            }
        }
    }
    return $result;
}*/


/*function handle_multi_expense_attachments($id,$type) {
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['file']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
                }
            }
        }
    }
    return $result;
}*/


function handle_multi_expense_attachments($id,$type) {
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);

                $filename = $_FILES['file']['name'][$key];
                 $newFilePath = $path . $filename;
                
                $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];
                

                // Compress Image
                compressImage($tmpFilePath,$newFilePath,15);
                array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
            }
        }
    }
    return $result;
}


function handle_multi_task_attachments($id,$type) {
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);

                $filename = $_FILES['file']['name'][$key];
                 $newFilePath = $path . $filename;
                
                $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];
                

                // Compress Image
                compressImage($tmpFilePath,$newFilePath,15);
                array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
            }
        }
    }
    return $result;
}

function handle_multi_handover_attachments($id,$type) {
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);

                $filename = $_FILES['file']['name'][$key];
                 $newFilePath = $path . $filename;
                
                $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];
                

                // Compress Image
                compressImage($tmpFilePath,$newFilePath,15);
                array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));

            }
        }
    }
    return $result;
}

function handle_multi_challan_attachments($id,$type) {
    $result =array();
    
    if(!empty($_FILES['file'])){
        foreach ($_FILES['file']['error'] as $key=>$error )
        {
            if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
                header('HTTP/1.0 400 Bad error');
                return _perfex_upload_error($_FILES['file']['error'][$key]);
                //die;
            }
           
            $path = get_upload_path_by_type($type) . $id . '/';
            $CI = & get_instance();

            if (isset($_FILES['file']['name'][$key])) {
                
               

                do_action('before_upload_expense_attachment', $id);
                // Get the temp file path
                $tmpFilePath = $_FILES['file']['tmp_name'][$key];
                // Make sure we have a filepath
                
                if (!empty($tmpFilePath) && $tmpFilePath != '') {
                    _maybe_create_upload_path($path);

                    $filename = $_FILES['file']['name'][$key];
                     $newFilePath = $path . $filename;
                    
                    $attachment = [];
                        $attachment[] = [
                            'file_name' => $filename,
                            'filetype' => $_FILES['file']['type'][$key],
                        ];
                    

                    // Compress Image
                    compressImage($tmpFilePath,$newFilePath,15);
                    array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
                }
            }
        }
    }
    return $result;
}

function handle_multi_payment_attachments($id,$type) {
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);

                $filename = $_FILES['file']['name'][$key];
                 $newFilePath = $path . $filename;
                
                $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];
                

                // Compress Image
                compressImage($tmpFilePath,$newFilePath,15);
                array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
            }
        }
    }
    return $result;
}


function handle_multi_document_attachments($id,$type) {
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);

                $filename = $_FILES['file']['name'][$key];
                 $newFilePath = $path . $filename;
                
                $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];
                

                // Compress Image
                compressImage($tmpFilePath,$newFilePath,60);
                array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
            }
        }
    }
    return $result;
}


function compressImage($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);

  elseif ($info['mime'] == 'image/jpg') 
    $image = imagecreatefromjpeg($source);  

  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);

}



/**
 * Check for ticket attachment after inserting ticket to database
 * @param  mixed $ticketid
 * @return mixed           false if no attachment || array uploaded attachments
 */
function handle_ticket_attachments($ticketid, $index_name = 'attachments') {
    $path = get_upload_path_by_type('ticket') . $ticketid . '/';
    $uploaded_files = [];

    if (isset($_FILES[$index_name])) {
        _file_attachments_index_fix($index_name);

        for ($i = 0; $i < count($_FILES[$index_name]['name']); $i++) {
            do_action('before_upload_ticket_attachment', $ticketid);
            if ($i <= get_option('maximum_allowed_ticket_attachments')) {
                // Get the temp file path
                $tmpFilePath = $_FILES[$index_name]['tmp_name'][$i];
                // Make sure we have a filepath
                if (!empty($tmpFilePath) && $tmpFilePath != '') {
                    // Getting file extension
                    $path_parts = pathinfo($_FILES[$index_name]['name'][$i]);
                    $extension = $path_parts['extension'];

                    $extension = strtolower($extension);
                    $allowed_extensions = explode(',', get_option('ticket_attachments_file_extensions'));
                    $allowed_extensions = array_map('trim', $allowed_extensions);
                    // Check for all cases if this extension is allowed
                    if (!in_array('.' . $extension, $allowed_extensions)) {
                        continue;
                    }
                    _maybe_create_upload_path($path);
                    $filename = unique_filename($path, $_FILES[$index_name]['name'][$i]);
                    $newFilePath = $path . $filename;
                    // Upload the file into the temp dir
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        array_push($uploaded_files, [
                            'file_name' => $filename,
                            'filetype' => $_FILES[$index_name]['type'][$i],
                        ]);
                    }
                }
            }
        }
    }
    if (count($uploaded_files) > 0) {
        return $uploaded_files;
    }

    return false;
}

/**
 * Check for company logo upload
 * @return boolean
 */
function handle_company_logo_upload() {
    $logoIndex = ['logo', 'logo_dark'];
    $success = false;
    foreach ($logoIndex as $logo) {
        $index = 'company_' . $logo;

        if (isset($_FILES[$index]) && _perfex_upload_error($_FILES[$index]['error'])) {
            set_alert('warning', _perfex_upload_error($_FILES[$index]['error']));

            return false;
        }
        if (isset($_FILES[$index]['name']) && $_FILES[$index]['name'] != '') {
            do_action('before_upload_company_logo_attachment');
            $path = get_upload_path_by_type('company');
            // Get the temp file path
            $tmpFilePath = $_FILES[$index]['tmp_name'];
            // Make sure we have a filepath
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                // Getting file extension
                $path_parts = pathinfo($_FILES[$index]['name']);
                $extension = $path_parts['extension'];
                $extension = strtolower($extension);
                $allowed_extensions = [
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                ];

                if (!in_array($extension, $allowed_extensions)) {
                    set_alert('warning', 'Image extension not allowed.');

                    continue;
                }

                // Setup our new file path
                $filename = $logo . '.' . $extension;
                $newFilePath = $path . $filename;
                _maybe_create_upload_path($path);
                // Upload the file into the company uploads dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    update_option($index, $filename);
                    $success = true;
                }
            }
        }
    }


    return $success;
}

/**
 * Check for company logo upload
 * @return boolean
 */
function handle_company_signature_upload() {
    if (isset($_FILES['signature_image']) && _perfex_upload_error($_FILES['signature_image']['error'])) {
        set_alert('warning', _perfex_upload_error($_FILES['signature_image']['error']));

        return false;
    }
    if (isset($_FILES['signature_image']['name']) && $_FILES['signature_image']['name'] != '') {
        do_action('before_upload_signature_image_attachment');
        $path = get_upload_path_by_type('company');
        // Get the temp file path
        $tmpFilePath = $_FILES['signature_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['signature_image']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);

            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', 'Image extension not allowed.');

                return false;
            }
            // Setup our new file path
            $filename = 'signature' . '.' . $extension;
            $newFilePath = $path . $filename;
            _maybe_create_upload_path($path);
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                update_option('signature_image', $filename);

                return true;
            }
        }
    }

    return false;
}

/**
 * Handle company favicon upload
 * @return boolean
 */
function handle_favicon_upload() {
    if (isset($_FILES['favicon']['name']) && $_FILES['favicon']['name'] != '') {
        do_action('before_upload_favicon_attachment');
        $path = get_upload_path_by_type('company');
        // Get the temp file path
        $tmpFilePath = $_FILES['favicon']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['favicon']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            // Setup our new file path
            $filename = 'favicon' . '.' . $extension;
            $newFilePath = $path . $filename;
            _maybe_create_upload_path($path);
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                update_option('favicon', $filename);

                return true;
            }
        }
    }

    return false;
}

/**
 * Maybe upload staff profile image
 * @param  string $staff_id staff_id or current logged in staff id will be used if not passed
 * @return boolean
 */
 
 
 function handle_staff_profile_image_upload($id = '') {
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('staff') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['profile_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['profile_image']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['profile_image']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('staffid', $id);
                $CI->db->update('tblstaff', [
                    'profile_image' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}
 
 
 function handle_staff_document_upload($id = '') {
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['staff_document']['name']) && $_FILES['staff_document']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('staff_document') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['staff_document']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['staff_document']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
                'png',
                'doc',
                'dot',
                'wbk',
                'docm',
                'dotx',
                'dotm',
                'docb',
                'xls',
                'ppt',
                'pdf',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['staff_document']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('staffid', $id);
                $CI->db->update('tblstaff', [
                    'staff_document' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}






/**
 * Maybe upload contact profile image
 * @param  string $contact_id contact_id or current logged in contact id will be used if not passed
 * @return boolean
 */
function handle_contact_profile_image_upload($contact_id = '') {
    if (isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
        do_action('before_upload_contact_profile_image');
        if ($contact_id == '') {
            $contact_id = get_contact_user_id();
        }
        $path = get_upload_path_by_type('contact_profile_images') . $contact_id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['profile_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['profile_image']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['profile_image']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();

                $CI->db->where('id', $contact_id);
                $CI->db->update('tblcontacts', [
                    'profile_image' => $filename,
                ]);
                // Remove original image
                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}

/**
 * Handle upload for project discussions comment
 * Function for jquery-comment plugin
 * @param  mixed $discussion_id discussion id
 * @param  mixed $post_data     additional post data from the comment
 * @param  array $insert_data   insert data to be parsed if needed
 * @return arrray
 */
function handle_project_discussion_comment_attachments($discussion_id, $post_data, $insert_data) {
    if (isset($_FILES['file']['name']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo json_encode(['message' => _perfex_upload_error($_FILES['file']['error'])]);
        die;
    }

    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_project_discussion_comment_attachment');
        $path = PROJECT_DISCUSSION_ATTACHMENT_FOLDER . $discussion_id . '/';
        // Check for all cases if this extension is allowed
        if (!_upload_extension_allowed($_FILES['file']['name'])) {
            header('HTTP/1.0 400 Bad error');
            echo json_encode(['message' => _l('file_php_extension_blocked')]);
            die;
        }

        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $insert_data['file_name'] = $filename;

                if (isset($_FILES['file']['type'])) {
                    $insert_data['file_mime_type'] = $_FILES['file']['type'];
                } else {
                    $insert_data['file_mime_type'] = get_mime_by_extension($filename);
                }
            }
        }
    }

    return $insert_data;
}

/**
 * Create thumbnail from image
 * @param  string  $path     imat path
 * @param  string  $filename filename to store
 * @param  integer $width    width of thumb
 * @param  integer $height   height of thumb
 * @return null
 */
function create_img_thumb($path, $filename, $width = 300, $height = 300) {
    $CI = &get_instance();

    $source_path = rtrim($path, '/') . '/' . $filename;
    $target_path = $path;
    $config_manip = [
        'image_library' => 'gd2',
        'source_image' => $source_path,
        'new_image' => $target_path,
        'maintain_ratio' => true,
        'create_thumb' => true,
        'thumb_marker' => '_thumb',
        'width' => $width,
        'height' => $height,
    ];

    $CI->image_lib->initialize($config_manip);
    $CI->image_lib->resize();
    $CI->image_lib->clear();
}

/**
 * Check if extension is allowed for upload
 * @param  string $filename filename
 * @return boolean
 */
function _upload_extension_allowed($filename) {
    $path_parts = pathinfo($filename);
    $extension = $path_parts['extension'];
    $extension = strtolower($extension);
    $allowed_extensions = explode(',', get_option('allowed_files'));
    $allowed_extensions = array_map('trim', $allowed_extensions);
    // Check for all cases if this extension is allowed
    if (!in_array('.' . $extension, $allowed_extensions)) {
        return false;
    }

    return true;
}

/**
 * Performs fixes when $_FILES is array and the index is messed up
 * Eq user click on + then remove the file and then added new file
 * In this case the indexes will be 0,2 - 1 is missing because it's removed but they should be 0,1
 * @param  string $index_name $_FILES index name
 * @return null
 */
function _file_attachments_index_fix($index_name) {
    if (isset($_FILES[$index_name]['name']) && is_array($_FILES[$index_name]['name'])) {
        $_FILES[$index_name]['name'] = array_values($_FILES[$index_name]['name']);
    }

    if (isset($_FILES[$index_name]['type']) && is_array($_FILES[$index_name]['type'])) {
        $_FILES[$index_name]['type'] = array_values($_FILES[$index_name]['type']);
    }

    if (isset($_FILES[$index_name]['tmp_name']) && is_array($_FILES[$index_name]['tmp_name'])) {
        $_FILES[$index_name]['tmp_name'] = array_values($_FILES[$index_name]['tmp_name']);
    }

    if (isset($_FILES[$index_name]['error']) && is_array($_FILES[$index_name]['error'])) {
        $_FILES[$index_name]['error'] = array_values($_FILES[$index_name]['error']);
    }

    if (isset($_FILES[$index_name]['size']) && is_array($_FILES[$index_name]['size'])) {
        $_FILES[$index_name]['size'] = array_values($_FILES[$index_name]['size']);
    }
}

/**
 * Check if path exists if not exists will create one
 * This is used when uploading files
 * @param  string $path path to check
 * @return null
 */
function _maybe_create_upload_path($path) {
    if (!file_exists($path)) {
        mkdir($path);
        fopen(rtrim($path, '/') . '/' . 'index.html', 'w');
    }
}

function handle_product_image_upload($id = '') {
	
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('product') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['photo']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['photo']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['photo']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('id', $id);
                $CI->db->update('tblproducts', [
                    'photo' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}

function handle_product_multiple_image_upload($id = '') {
    if (isset($_FILES['photo_multiple']['name']) && $_FILES['photo_multiple']['name'] != '') {
        $CI = & get_instance();
        $CI->load->library('upload');
        $dataInfo = array();
        $files = $_FILES;
        $path = get_upload_path_by_type('product_multiple') . '/';
        $cpt = count($_FILES['photo_multiple']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['photo_multiple']['name']= $files['photo_multiple']['name'][$i];
            $_FILES['photo_multiple']['type']= $files['photo_multiple']['type'][$i];
            $_FILES['photo_multiple']['tmp_name']= $files['photo_multiple']['tmp_name'][$i];
            $_FILES['photo_multiple']['error']= $files['photo_multiple']['error'][$i];
            $_FILES['photo_multiple']['size']= $files['photo_multiple']['size'][$i];    

            $config = array();
            $config['upload_path'] =    $path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = '0';
            $config['encrypt_name']     = TRUE;

            $CI->upload->initialize($config);
            $CI->upload->do_upload('photo_multiple');
            //$dataInfo[] = $CI->upload->data();

            $upload_data = $CI->upload->data(); 
            $filename = $upload_data['file_name'];

            $data = array(
                'rel_id' => $id,
                'rel_type' => 'mutliple_image',
                'file_name' => $filename
            );
            $CI->db->insert('tblproductfiles_log',$data);
        }

    }
}

function handle_product_drawing_upload($id = '') {
    if (isset($_FILES['drawing']['name']) && $_FILES['drawing']['name'] != '') {
        $CI = & get_instance();
        $CI->load->library('upload');
        $dataInfo = array();
        $files = $_FILES;
        $path = get_upload_path_by_type('product_drawing') . '/';
        $cpt = count($_FILES['drawing']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['drawing']['name']= $files['drawing']['name'][$i];
            $_FILES['drawing']['type']= $files['drawing']['type'][$i];
            $_FILES['drawing']['tmp_name']= $files['drawing']['tmp_name'][$i];
            $_FILES['drawing']['error']= $files['drawing']['error'][$i];
            $_FILES['drawing']['size']= $files['drawing']['size'][$i];    

            $config = array();
            $config['upload_path'] =    $path;
            $config['allowed_types'] = '*';
            $config['max_size']      = '0';
            $config['encrypt_name']     = TRUE;

            $CI->upload->initialize($config);
            $CI->upload->do_upload('drawing');
            //$dataInfo[] = $CI->upload->data();

            $upload_data = $CI->upload->data(); 
            $filename = $upload_data['file_name'];

            $data = array(
                'rel_id' => $id,
                'rel_type' => 'drawing',
                'file_name' => $filename
            );
            $CI->db->insert('tblproductfiles_log',$data);
        }

    }
}

function handle_product_image_upload_new($id = '') {
    if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {

        $path = get_upload_path_by_type('product') . '/';

        $config['upload_path']          = $path;
        $config['allowed_types']        = 'jpg|jpeg|png|gif';
        $config['encrypt_name']         = TRUE;
        $CI = & get_instance();
        $CI->load->library('upload', $config);

        if ($CI->upload->do_upload('photo'))
        {
            $upload_data = $CI->upload->data(); 
            $filename = $upload_data['file_name'];
            $CI->db->where('id', $id);
            $CI->db->update('tblproducts_log', [
                'photo' => $filename,
            ]);
        }

    }
}

function handle_stock_pdf_upload($id = '') {
	
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('stockpdf') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['photo']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['photo']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'pdf',
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['photo']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('id', $id);
                $CI->db->update('tblwarehousestockpdf', [
                    'pdf' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}

function handle_pancard_upload($id = '') {
	
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['pancard']['name']) && $_FILES['pancard']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('pancard') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['pancard']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['pancard']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['pancard']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('id', $id);
                $CI->db->update('tblvendordocument', [
                    'pancard' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}

function handle_gst_upload($id = '') {
	
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['gstregdoc']['name']) && $_FILES['gstregdoc']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('gst_reg_doc') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['gstregdoc']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['gstregdoc']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['gstregdoc']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('id', $id);
                $CI->db->update('tblvendordocument', [
                    'gst_reg_doc' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}

function handle_cancel_cheque_upload($id = '') {
	
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['cancelcheque']['name']) && $_FILES['cancelcheque']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('cancel_cheque') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['cancelcheque']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['cancelcheque']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['cancelcheque']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('id', $id);
                $CI->db->update('tblvendordocument', [
                    'cancel_cheque' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}

function handle_component_image_upload($id = '') {
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
        do_action('before_component_staff_photo');
        $path = get_upload_path_by_type('component') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['photo']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts = pathinfo($_FILES['photo']['name']);
            $extension = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
            ];
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));

                return false;
            }
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['photo']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $config = [];
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'thumb_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 160;
                $config['height'] = 160;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $newFilePath;
                $config['new_image'] = 'small_' . $filename;
                $config['maintain_ratio'] = true;
                $config['width'] = 32;
                $config['height'] = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('id', $id);
                $CI->db->update('tblcomponents', [
                    'photo' => $filename,
                ]);
                // Remove original image
//                unlink($newFilePath);

                return true;
            }
        }
    }

    return false;
}

function handle_document_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('office_document') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['file']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'office_document', $attachment));
                }
            }
        }
    }
    return $result;
}

function client_document_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('client_document') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['file']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'client_document', $attachment));
                }
            }
        }
    }
    return $result;
}

function vendor_document_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('vendor_document') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['file']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'vendor_document', $attachment));
                }
            }
        }
    }
    return $result;
}

/*function handle_document_attachments($id) {
    if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])) {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    $path = get_upload_path_by_type('office_document') . $id . '/';
    $CI = & get_instance();

    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_expense_attachment', $id);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            _maybe_create_upload_path($path);
            $filename = $_FILES['file']['name'];
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $attachment = [];
                $attachment[] = [
                    'file_name' => $filename,
                    'filetype' => $_FILES['file']['type'],
                ];

                $CI->misc_model->add_attachment_to_database($id, 'office_document', $attachment);
            }
        }
    }
}*/



function handle_vehicle_rc_upload($id = '') {
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['vehicle_rc']['name']) && $_FILES['vehicle_rc']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('vehicle_rc') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['vehicle_rc']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['vehicle_rc']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'vehicle_rc' => $filename,
                ];
                $CI->db->update('tblnoncompanyvehicle',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function handle_driving_licence_upload($id = '') {
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['driving_licence']['name']) && $_FILES['driving_licence']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('driving_licence') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['driving_licence']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['driving_licence']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'driving_licence' => $filename,
                ];
                $CI->db->update('tblnoncompanyvehicle',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function handle_insurance_upload($id = '') {
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['insurance']['name']) && $_FILES['insurance']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('insurance') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['insurance']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['insurance']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'insurance' => $filename,
                ];
                $CI->db->update('tblnoncompanyvehicle',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function handle_vehicle_pic_upload($id = '') {
    if (!is_numeric($id) || $id == "") {
        return false;
    }
    
    if (isset($_FILES['vehicle_pic']['name']) && $_FILES['vehicle_pic']['name'] != '') {
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('vehicle_pic') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['vehicle_pic']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['vehicle_pic']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'vehicle_pic' => $filename,
                ];
                $CI->db->update('tblnoncompanyvehicle',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function handle_staff_relive_multi_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['docs']['error'] as $key=>$error )
    {
        if (isset($_FILES['docs']) && _perfex_upload_error($_FILES['docs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['docs']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('relive_document') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['docs']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['docs']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['docs']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['docs']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'relive_document', $attachment));
                }
            }
        }
    }
    return $result;
}


function handle_multi_attachments($id,$type)
{
    $result =array();
   
    foreach ($_FILES['file']['error'] as $key=>$error )
    {
        if (isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['file']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['file']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
                }
            }
        }
    }
    return $result;
}

//gopal1
function registered_staff_photo_attachments($id)
{
    $result =array();
 
    foreach ($_FILES['photo_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['photo_attach']) && _perfex_upload_error($_FILES['photo_attach']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['photo_attach']['error'][$key]);
            //die;
        }
       $path = get_upload_path_by_type('photo_attach') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['photo_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['photo_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['photo_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['photo_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_staff_attachment_to_database($id, 'photo_doc', $attachment));
                }
            }
        }
    }
    return $result;
}
//2
function registered_staff_pan_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['pan_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['pan_attach']) && _perfex_upload_error($_FILES['pan_attach']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['pan_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('pan_attach') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['pan_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['pan_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['pan_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['pan_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_staff_attachment_to_database($id, 'pan_attach', $attachment));
                }
            }
        }
    }
    return $result;
}
//3
function registered_staff_adhar_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['adhar_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['adhar_attach']) && _perfex_upload_error($_FILES['adhar_attach']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['adhar_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('adhar_attach') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['adhar_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['adhar_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['adhar_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['adhar_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_staff_attachment_to_database($id, 'adhar_attach', $attachment));
                }
            }
        }
    }
    return $result;
}
//4
function registered_staff_qualification_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['qualification_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['qualification_attach']) && _perfex_upload_error($_FILES['qualification_attach']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['qualification_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('qualification_attach') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['qualification_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['qualification_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['qualification_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['qualification_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_staff_attachment_to_database($id, 'qualification_attach', $attachment));
                }
            }
        }
    }
    return $result;
}
//5
function registered_staff_rel_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['relieving_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['relieving_attach']) && _perfex_upload_error($_FILES['relieving_attach']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['relieving_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('relieving_attach') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['relieving_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['relieving_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['relieving_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['relieving_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_staff_attachment_to_database($id, 'relieving_attach', $attachment));
                }
            }
        }
    }
    return $result;
}
//6
function registered_staff_sal_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['sal_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['photo_attach']) && _perfex_upload_error($_FILES['sal_attach']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['sal_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('sal_attach') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['sal_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['sal_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['sal_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['sal_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_staff_attachment_to_database($id, 'sal_attach', $attachment));
                }
            }
        }
    }
    return $result;
}

function registered_vendor_pan_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['pan_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['pan_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['pan_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('pan_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['pan_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['pan_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['pan_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['pan_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'pan_doc', $attachment));
                }
            }
        }
    }
    return $result;
}

function registered_vendor_gst_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['gst_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['gst_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['gst_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('gst_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['gst_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['gst_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['gst_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['gst_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'gst_doc', $attachment));
                }
            }
        }
    }
    return $result;
}

function registered_vendor_msme_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['msme_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['msme_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['msme_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('msme_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['msme_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['msme_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['msme_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['msme_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'msme_doc', $attachment));
                }
            }
        }
    }
    return $result;
}

function registered_vendor_iec_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['iec_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['iec_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['iec_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('iec_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['iec_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['iec_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['iec_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['iec_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'iec_doc', $attachment));
                }
            }
        }
    }
    return $result;
}

function registered_vendor_cin_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['cin_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['cin_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['cin_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('cin_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['cin_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['cin_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['cin_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['cin_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'cin_doc', $attachment));
                }
            }
        }
    }
    return $result;
}

function registered_vendor_financial_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['financial_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['financial_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['financial_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('financial_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['financial_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['financial_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['financial_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['financial_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'financial_doc', $attachment));
                }
            }
        }
    }
    return $result;
}

function registered_vendor_bank_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['bank_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['bank_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['bank_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('bank_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['bank_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['bank_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['bank_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['bank_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'bank_doc', $attachment));
                }
            }
        }
    }
    return $result;
}

function staff_allot_attachments($id)
{ 
    $result =array();
   
    foreach ($_FILES['staff_attach']['error'] as $key=>$error )
    {
        if (isset($_FILES['staff_attach']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['staff_attach']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('staff_doc') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['staff_attach']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['staff_attach']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {

                $path_parts = pathinfo($_FILES['staff_attach']['name'][$key]);
                $extension = $path_parts['extension'];
                $extension = strtolower($extension);
                $allowed_extensions = [
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                ];

                if (!in_array($extension, $allowed_extensions)) {
                    set_alert('warning', 'Image extension not allowed.');

                    continue;
                }
                _maybe_create_upload_path($path);
                $filename = $_FILES['staff_attach']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['staff_attach']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'staff_doc', $attachment));
                }
            }
        }
    }
    return $result;
}


function client_security_cheque_image_upload($id = '') {
    
    if (isset($_FILES['cheque_image']['name']) && $_FILES['cheque_image']['name'] != '') { 
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('client_security_cheque') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['cheque_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['cheque_image']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'cheque_image' => $filename,
                ];
                $CI->db->update('tblclientsecuritycheque',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function courier_return_image_upload($id = '') {
    
    if (isset($_FILES['return_image']['name']) && $_FILES['return_image']['name'] != '') { 
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('courier_return') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['return_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['return_image']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'return_image' => $filename,
                ];
                $CI->db->update('tblclientsecuritycheque',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function temperory_product_image_upload($id = '') {
    
    if (isset($_FILES['product_image']['name']) && $_FILES['product_image']['name'] != '') { 
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('temperory_product') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['product_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES['product_image']['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'file_name' => $filename,
                ];
                $CI->db->update('tbltemperoryproduct',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}


function email_template_master_attachments($id)
{
    $result =array();
   
    foreach ($_FILES['email_file']['error'] as $key=>$error )
    {
        if (isset($_FILES['email_file']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['email_file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('email_template') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['email_file']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['email_file']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['email_file']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['email_file']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'email_template', $attachment));
                }
            }
        }
    }
    return $result;
}

function complain_actionplan_attachments($id)
{
    $result =array();
    
    foreach ($_FILES['files']['error'] as $key=>$error )
    {
        if (isset($_FILES['email_file']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['email_file']['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type('complaints') . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES['files']['name'][$key])) {
            
           

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['files']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['files']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['files']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'complaints', $attachment));
                }
            }
        }
    }
    return $result;
}

function handle_enquirycall_drawing_upload($id) {
    
    $result =array();
    $path = get_upload_path_by_type('enquirycall_drawing') . $id . '/';
    $CI = & get_instance();
    $response = $CI->db->query("SELECT * FROM `tblfiles` where rel_id = '".$id."' AND `rel_type` = 'enquirycall_drawing'")->result();
    if ($response){
        foreach ($response as $value) {
           $CI->home_model->delete('tblfiles', array("id" => $value->id)); 
           if (file_exists($path.$value->file_name)){
                unlink($path.$value->file_name);
           }
        }
    }
    
    foreach ($_FILES['drawing']['error'] as $key=>$error )
    {
        if (isset($_FILES['email_file']) && _perfex_upload_error($_FILES['dopan_attachcs']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['email_file']['error'][$key]);
            //die;
        }
       
        if (isset($_FILES['drawing']['name'][$key])) {

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES['drawing']['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES['drawing']['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES['drawing']['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, 'enquirycall_drawing', $attachment));
                }
            }
        }
    }
    return $result;
}


/* this function use for upload quality inspection files */
function handle_quality_attachments($id,$type)
{
    $result =array();
   
    foreach ($_FILES[$type]['error'] as $key=>$error )
    {
        if (isset($_FILES[$type]) && _perfex_upload_error($_FILES[$type]['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES[$type]['error'][$key]);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES[$type]['name'][$key])) {
            
            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES[$type]['tmp_name'][$key];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);
                $filename = $_FILES[$type]['name'][$key];
                $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES[$type]['type'][$key],
                    ];

                    array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
                }
            }
        }
    }
    return $result;
}


function software_task_image_upload($id = '', $field_name = 'image') {
    
    if (isset($_FILES[$field_name]['name']) && $_FILES[$field_name]['name'] != '') { 
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('software_task') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES[$field_name]['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES[$field_name]['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'image' => $filename,
                ];
                $CI->db->update('tblsoftwaretask',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function employee_complains_image_upload($id = '', $field_name = 'image') {
    
    if (isset($_FILES[$field_name]['name']) && $_FILES[$field_name]['name'] != '') { 
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('employee_complains') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES[$field_name]['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES[$field_name]['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'file' => $filename,
                ];
                $CI->db->update('tblemployee_complains',$data,array('id' => $id));

                return true;
            }
        }
    }

    return false;
}

function upload_ledger_reco($id = '', $field_name = 'file') {
    
    if (isset($_FILES[$field_name]['name']) && $_FILES[$field_name]['name'] != '') { 
        do_action('before_product_staff_photo');
        $path = get_upload_path_by_type('ledger_reco') . $id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES[$field_name]['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
           
            
            _maybe_create_upload_path($path);
            $filename = unique_filename($path, $_FILES[$field_name]['name']);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI = & get_instance();
                $data = [
                    'file' => $filename,
                ];
                $CI->db->update('tblclient_vendor_givenledger',$data,array('id' => $id));
                return true;
            }
        }
    }

    return false;
}

function handle_multi_activty_attachments($data) {
    $result =array();
    foreach ($_FILES['activityfile']['error'] as $key => $error) {
        
        if (isset($_FILES['activityfile']) && _perfex_upload_error($_FILES['activityfile']['error'][$key])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES['activityfile']['error'][$key]);
            //die;
        }
        $path = get_upload_path_by_type('activity_attachments') .$data["module_id"]. '-'. $data["activity_id"] . '/';
        $CI = & get_instance();
        if (isset($_FILES['activityfile']['name'][$key])) {

            // do_action('before_upload_expense_attachment', $data["id"]);
            // Get the temp file path
            $tmpFilePath = $_FILES['activityfile']['tmp_name'][$key];
            $filename = $_FILES['activityfile']['name'][$key];
            $newFilePath = $path . $filename;
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);

                // Upload the file into the company uploads dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $CI = & get_instance();
                    $attachment = [
                        'module_id' => $data["module_id"],
                        'table_id' => $data["table_id"],
                        'activity_id' => $data["activity_id"],
                        'file' => $filename,
                    ];
                    $CI->db->insert('tblactivityfiles', $attachment);
                }
            }
        }
    }
    return $result;
}

/**
 * Function that return full path for upload based on passed type
 * @param  string $type
 * @return string
 */
function get_upload_path_by_type($type) {
    switch ($type) {
        case 'lead':
            return LEAD_ATTACHMENTS_FOLDER;

            break;
        case 'expense':
            return EXPENSE_ATTACHMENTS_FOLDER;


            //gopal folder start
            break;
        case 'photo_attach':
            return REGISTERED_STAFF_FOLDER;
            break;

            break;
        case 'pan_attach':
            return REGISTERED_PAN_FOLDER;
            break;

            break;
        case 'adhar_attach':
            return REGISTERED_ADHAR_FOLDER;
            break;

            break;
        case 'qualification_attach':
            return REGISTERED_QUALIFICATION_FOLDER;
            break;

            break;
        case 'relieving_attach':
            return REGISTERED_RELIEVING_FOLDER;
            break;

             break;
        case 'sal_attach':
            return REGISTERED_SAL_FOLDER;
            break;

            //gopal end folder

            break;
        case 'project':
            return PROJECT_ATTACHMENTS_FOLDER;

            break;
        case 'proposal':
            return PROPOSAL_ATTACHMENTS_FOLDER;

            break;
        case 'estimate':
            return ESTIMATE_ATTACHMENTS_FOLDER;

            break;
        case 'invoice':
            return INVOICE_ATTACHMENTS_FOLDER;

            break;
        case 'credit_note':
            return CREDIT_NOTES_ATTACHMENTS_FOLDER;

            break;
        case 'task':
            return TASKS_ATTACHMENTS_FOLDER;

            break;
        case 'contract':
            return CONTRACTS_UPLOADS_FOLDER;

            break;
        case 'customer':
            return CLIENT_ATTACHMENTS_FOLDER;

            break;
        case 'staff':
            return STAFF_PROFILE_IMAGES_FOLDER;
			
			break;
        case 'staff_document':
            return STAFF_DOCUMENT_FOLDER;

            break;
        case 'company':
            return COMPANY_FILES_FOLDER;

            break;
        case 'ticket':
            return TICKET_ATTACHMENTS_FOLDER;

            break;
        case 'contact_profile_images':
            return CONTACT_PROFILE_IMAGES_FOLDER;

            break;
        case 'newsfeed':
            return NEWSFEED_FOLDER;

            break;
        case 'component':
            return COMPONENT_ATTACHMENTS_FOLDER;
			
			 break;
       
	   case 'product':
            return PRODUCT_ATTACHMENTS_FOLDER;

            break;

        case 'product_multiple':
            return PRODUCT_MULTIPLE_ATTACHMENTS_FOLDER;

            break;

        case 'product_drawing':
            return PRODUCT_DRAWING_ATTACHMENTS_FOLDER;

            break;

			case 'stockpdf':
            return STOCK_ATTACHMENTS_FOLDER;

            break;

			case 'pancard':
            return PANCARD_ATTACHMENTS_FOLDER;

            break;

			case 'cancel_cheque':
            return CANCEL_CHEQUE_ATTACHMENTS_FOLDER;

            break;

			case 'gst_reg_doc':
            return GST_REGESTRATION_DOCUMENT_ATTACHMENTS_FOLDER;

            break;

            case 'leave':
            return LEAVE_ATTACHMENTS_FOLDER;
            break;

            case 'request':
            return REQUEST_ATTACHMENTS_FOLDER;
            break;


            case 'payment':
            return PAYMENT_ATTACHMENTS_FOLDER;
            break;

            case 'purchase_payment':
            return PURCHASE_PAYMENT_ATTACHMENTS_FOLDER;
            break;

            case 'office_document':
            return DOCUMENT_ATTACHMENTS_FOLDER;
            break;

            case 'app_leads':
            return APPLEAD_ATTACHMENTS_FOLDER;
            break;

            case 'vehicle_rc':
            return DELIVERY_RC_ATTACHMENTS_FOLDER;
            break;
			
            case 'driving_licence':
            return DELIVERY_DL_ATTACHMENTS_FOLDER;
            break;

            case 'insurance':
            return DELIVERY_INSURANCE_ATTACHMENTS_FOLDER;
            break;

            case 'vehicle_pic':
            return DELIVERY_VEHICLE_PIC_ATTACHMENTS_FOLDER;
            break;

            case 'challan':
            return CHALLAN_ATTACHMENTS_FOLDER;
            break;

            case 'handover':
            return HANDOVER_ATTACHMENTS_FOLDER;
            break;

            case 'handover_master':
            return HANDOVER_MASTER_ATTACHMENTS_FOLDER;
            break;

            case 'challan_final':
            return CHALLAN_FINAL_ATTACHMENTS_FOLDER;
            break;

            case 'purchase_order':
            return PURCHASE_ORDER_ATTACHMENTS_FOLDER;
            break;
            
            case 'poproforma_invoice':
            return POPROFORMA_INVOICE_ATTACHMENTS_FOLDER;
            break;

            case 'material_receipt':
            return MATERIAL_RECEIPT_ATTACHMENTS_FOLDER;
            break;

            case 'tempo':
            return TEMPO_ATTACHMENTS_FOLDER;
            break;

            case 'purchase_invoice':
            return PURCHASE_INVOICE_ATTACHMENTS_FOLDER;
            break;

            case 'relive_document':
            return STAFF_RELIVE_ATTACHMENTS_FOLDER;
            break;

            case 'reminder':
            return REMINDER_IMAGES_FOLDER;
            break;

            case 'pan_doc':
            return REGISTERED_VENDOR_PAN_FOLDER;
            break;

            case 'gst_doc':
            return REGISTERED_VENDOR_GST_FOLDER;
            break;

            case 'msme_doc':
            return REGISTERED_VENDOR_MSME_FOLDER;
            break;

			case 'iec_doc':
            return REGISTERED_VENDOR_IEC_FOLDER;
            break;

            case 'cin_doc':
            return REGISTERED_VENDOR_CIN_FOLDER;
            break;

            case 'financial_doc':
            return REGISTERED_VENDOR_FINANCIAL_FOLDER;
            break;

            case 'bank_doc':
            return REGISTERED_VENDOR_BANK_FOLDER;
            break;

            case 'client_document':
            return CLIENT_DOCUMENT_FOLDER;
            break;

            case 'vendor_document':
            return VENDOR_DOCUMENT_FOLDER;
            break;

            case 'staff_doc':
            return STAFF_ALLOT_DOCUMENT_FOLDER;
            break;

            case 'client_security_cheque':
            return CLIENT_SECURITY_CHEQUE_FOLDER;
            break;

            case 'courier_return':
            return COURIER_RETURN_FOLDER;
            break;

            case 'temperory_product':
            return TEMPERORY_PRODUCT;
            break;
            
            case 'sales_report':
            return STAFF_SALES_REPORT_FOLDER;
            break;

            case 'email_template':
            return EMAIL_TEMPLATE_MASTER_FOLDER;
            break;
        
            case 'client_deposit':
            return CLIENT_DEPOSIT_FOLDER;
            break;
        
            case 'complaints':
            return COMPLAIN_ACTION_PLAN_FOLDER;
            break;
            
            case 'enquirycall_drawing':
            return ENQUIRYCALL_PRODUCTION_FOLDER;
            break;
        
            case 'purchallan_return':
            return PURCHASE_CHALLAN_RETURN_FOLDER;
            break;

            case 'eway_upload':
            return CHALLAN_FINAL_ATTACHMENTS_FOLDER;
            break;

            case 'design_requisition':
            return DESIGN_REQUISITION_ATTACHMENTS_FOLDER;
            break;

            case 'trip_reading':
            return TRIP_READING_FOLDER;
            break;
            case 'courier_files':
            return COURIER_FILE_FOLDER;
            break;
            case 'payment_request':
            return PAYMENT_REQUEST_FOLDER;
            break;
            case 'software_task':
            return SOFTWARE_TASK_FOLDER;
            break;
            case 'quality_report':
            return QUALITY_REQUEST_FOLDER;
            break;
            case 'test_certificate':
                return TEST_CERTIFICATE_REQUEST_FOLDER;
            break;
            case 'estimate_po':
                return ESTIMATE_PURCHASE_ORDER_FOLDER;
            break;
            case 'ledger_reco':
                return LEDGER_RECO_FOLDER;
            break;
            case 'employee_complains':
                return EMPLOYEE_COMPLAIN_FOLDER;
            break;
            case 'activity_attachments':
                return ACTIVITY_ATTACHMENTS_FOLDER;
            break;
        default:
            return false;
    }
}

/* THIS FUNCTION USE FOR DELETE ALL FILES AND ITS DIRECTORY */
function remove_all_uploaded_files($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file)){
            remove_all_uploaded_files($file);
        }else{
            unlink($file);
        }    
    }
    rmdir($dir);
}
