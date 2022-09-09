<?php





public function check_bundles_entry() {
        extract($this->input->post());

        if($waste != 0){
            $waste = $waste;
        }else{
            $waste = 0;
        }

        $final_size = ($product_size+$waste);
        $p_qty = $product_qty;

        if(!empty($itemdata)){
            foreach ($itemdata as $key => $value) {
                $size = $value['size'];
                $qty = $value['qty'];

                for($i=1; $i<=$qty; $i++) { 
                    $n_size = $size;
                    for($j=0; $j <= 9; $j++) { 
                        if($n_size >= $final_size){
                             $n_size = ($n_size - $final_size);
                             $p_qty--;
                             
                        }
                    }    

                }

            }
        }
        echo $p_qty; 
    }




function handle_multi_task_attachments($id,$type,$data)
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

?>

<tr id="trcf_'+row+'_'+newaddmore+'"><td><input class="form-control" name="customdata[bundle_no_'+row+']['+newaddmore+']" type="text" ></td><td><input class="form-control" id="bundle_qty_'+row+'_'+newaddmore+'" name="customdata[bundle_qty_'+row+']['+newaddmore+']" type="text" onclick="get_bundle_weight('+row+','+newaddmore+');"></td><td><input class="form-control" id="weight_per_psc_'+row+'_'+newaddmore+'" name="customdata[weight_per_psc_'+row+']['+newaddmore+']" type="text" onclick="get_bundle_weight('+row+','+newaddmore+');"></td><td><input class="form-control" id="bundle_weight_'+row+'_'+newaddmore+'" name="customdata[bundle_weight_'+row+']['+newaddmore+']" type="text" ></td><td><button type="button" value="0" class="btn pull-right btn-danger" onclick="removeprofield('+row+','+newaddmore+');"><i class="fa fa-remove"></i></button></td></tr>