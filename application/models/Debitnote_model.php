<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Debitnote_model extends CRM_Model {

    private $statuses;
    private $shipping_fields = ['shipping_street', 'shipping_city', 'shipping_city', 'shipping_state', 'shipping_zip', 'shipping_country'];

    public function __construct() {
        parent::__construct();
        $this->statuses = do_action('before_set_estimate_statuses', [
            1,
            2,
            5,
            3,
            4,
        ]);
    }

    public function add($data) {
                   
        $othercharges = $data['othercharges'];
        $clientdata= (!empty($data['clientdata'])) ? $data['clientdata'] : [];
        $dabit_note_date = str_replace("/","-",$data['dabit_note_date']);
        $dabit_note_date = date("Y-m-d",strtotime($dabit_note_date));

        $delivery_pickup_date = str_replace("/","-",$data['delivery_pickup_date']);
        $delivery_pickup_date = date("Y-m-d",strtotime($delivery_pickup_date));

        $dn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $dn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $dn_number = $number_arr[0];
            }
        }

        if(empty($data['challan_id'])){
            $data['challan_id'] = 0;
        }

        if(empty($data['invoice_id'])){
            $data['invoice_id'] = 0;
        }

        if(empty($data['challan_number'])){
            $data['challan_number'] = '';
        }

        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'clientid' => $data['clientid'],
                'site_id' => $data['site_id'],
                'challan_id' => $data['challan_id'],
                'challan_number' => $data['challan_number'],
                'invoice_id' => $data['invoice_id'],
                'billing_street' => $data['billing_street'],
                'billing_city' => $data['billing_city'],
                'billing_state' => $data['billing_state'],
                'billing_zip' => $data['billing_zip'],
                'shipping_street' => $data['shipping_street'],
                'shipping_city' => $data['shipping_city'],
                'shipping_state' => $data['shipping_state'],
                'shipping_zip' => $data['shipping_zip'],
                'dabit_note_date' => $dabit_note_date,
                'delivery_pickup_date' => $delivery_pickup_date,
                'debit_note_for' => $data['debit_note_for'],
                'debit_note_type' => $data['debit_note_type'],
                'qty_hours' => $data['qty_hours'],
                'number' => $data['number'],
                'sac_hsn' => $data['sac_hsn'],
                'dn_number' => $dn_number,
                'year_id' => financial_year(),
                'other_charges_tax' => $data['other_charges_tax'],
                'adminnote' => $data['adminnote'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'note' => $data['note'],
                'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
                'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
                'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
                'totalamount' => $data['saleproposal']['totalamount'],
                'tax_type' => $data['tax_type'],
                'status' => 1,
                'created_date' => date('Y-m-d'),
          );

        $this->db->insert('tbldebitnote', $ad_data);
        $insert_id = $this->db->insert_id();
         
        if ($insert_id) {
           
            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            foreach ($data['saleproposal'] as $singlesalepro) {

                if($data['debit_note_type'] == '2'){

                    $saleitemdata['debitnote_id'] = $insert_id;
                    $saleitemdata['product_id'] = 0;
                    $saleitemdata['product_name'] = $singlesalepro['product_name'];
                    $saleitemdata['pro_id'] = 0;
                    $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                    $saleitemdata['qty'] = 1;
                    $saleitemdata['price'] = $singlesalepro['price'];
                    $saleitemdata['ttl_price'] = $singlesalepro['price'];
                    $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                    $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                    $saleitemdata['status'] = 0;
                    $saleitemdata['other'] = 0;
                    $this->db->insert('tbldebitnoteproduct', $saleitemdata);                
                    $saleitemid = $this->db->insert_id();
                }else{
                    $other = 0;
                    if(!empty($singlesalepro['other'])){
                        $other = 1;
                    }
                    if (!empty($singlesalepro['product_id'])){
                        $saleitemdata['debitnote_id'] = $insert_id;
                        $saleitemdata['product_id'] = $singlesalepro['product_id'];
                        $saleitemdata['product_name'] = $singlesalepro['product_name'];
                        $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                        $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                        $saleitemdata['qty'] = $singlesalepro['qty'];
                        $saleitemdata['price'] = $singlesalepro['price'];
                        $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                        $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                        $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                        $saleitemdata['status'] = $singlesalepro['status'];
                        $saleitemdata['other'] = $other;
                        $this->db->insert('tbldebitnoteproduct', $saleitemdata);                
                        $saleitemid = $this->db->insert_id();
                    }
                }
            }

            if(!empty($othercharges)){
               foreach ($othercharges as $odata) {
                    if (!isset($odata['igst'])) {
                        $totaltax = $odata['gst'] + $odata['sgst'];
                        $odata['isgst'] = 1;
                    } else {
                        $totaltax = $odata['igst'];
                        $odata['isgst'] = 0;
                    }
                    $odata['proposalid'] = $insert_id;
                    $odata['is_sale'] = 0;
                    $odata['created_at'] = date("Y-m-d H:i:s");
                    $odata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbldebitnoteothercharges', $odata);
                } 
            }

            foreach($clientdata as $singleclient)
            {
                if (!empty($singleclient['firstname'])){
                    $singleclient['userid']=$data['clientid'];
                    $this->db->insert('tblcontacts', $singleclient);
                    $cont_id = $this->db->insert_id();
                    $datace['invoice_id']=$insert_id;
                    $datace['contact_id']=$cont_id;
                    $datace['type']='debitnote';
                    $this->db->insert('tblinvoiceclientperson', $datace);
                } 
            }

            if(!empty($data['productfields'])){
                foreach ($data['productfields'] as $fieldname) {
                   $pro_field['proposalid'] = $insert_id;
                   $pro_field['field_id'] = $fieldname;
                   $pro_field['created_at'] = date('Y-m-d H:i:s');
                   $pro_field['updated_at'] = date('Y-m-d H:i:s');
                   $this->db->insert('tbldebitnoteproductfields', $pro_field);
                }
            }
            return $insert_id;
        }
        return false;
    }

    public function update($data,$id) {
                   
        $othercharges = $data['othercharges'];
        $clientdata = (!empty($data['clientdata'])) ? $data['clientdata'] : [];
        $client_data = (!empty($data['client_data'])) ? $data['client_data'] : [];
        $dabit_note_date = str_replace("/","-",$data['dabit_note_date']);
        $dabit_note_date = date("Y-m-d",strtotime($dabit_note_date));

        $delivery_pickup_date = str_replace("/","-",$data['delivery_pickup_date']);
        $delivery_pickup_date = date("Y-m-d",strtotime($delivery_pickup_date));

        $dn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $dn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $dn_number = $number_arr[0];
            }
        }

        if(empty($data['invoice_id'])){
            $data['invoice_id'] = 0;
        }

        $challan_id = (!empty($data['challan_id'])) ? $data['challan_id'] : 0;
        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'clientid' => $data['clientid'],
                'site_id' => $data['site_id'],
                'challan_id' => $challan_id,
                'challan_number' => $data['challan_number'],
                'invoice_id' => $data['invoice_id'],
                'billing_street' => $data['billing_street'],
                'billing_city' => $data['billing_city'],
                'billing_state' => $data['billing_state'],
                'billing_zip' => $data['billing_zip'],
                'shipping_street' => $data['shipping_street'],
                'shipping_city' => $data['shipping_city'],
                'shipping_state' => $data['shipping_state'],
                'shipping_zip' => $data['shipping_zip'],
                'dabit_note_date' => $dabit_note_date,
                'delivery_pickup_date' => $delivery_pickup_date,
                'debit_note_for' => $data['debit_note_for'],
                'debit_note_type' => $data['debit_note_type'],
                'qty_hours' => $data['qty_hours'],
                'number' => $data['number'],
                'sac_hsn' => $data['sac_hsn'],
                'dn_number' => $dn_number,
                'year_id' => financial_year(),
                'other_charges_tax' => $data['other_charges_tax'],
                'adminnote' => $data['adminnote'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'note' => $data['note'],
                'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
                'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
                'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
                'totalamount' => $data['saleproposal']['totalamount'],
                'status' => 1,
                'tax_type' => $data['tax_type']
          );
       
        $this->db->where('id', $id);
        $this->db->update('tbldebitnote', $ad_data);
                 
        if ($id) {
           
            //deleting last records
            $this->db->where('debitnote_id', $id);
            $this->db->delete('tbldebitnoteproduct');

            $this->db->where('proposalid', $id);
            $this->db->delete('tbldebitnoteothercharges');

            $this->db->where('proposalid', $id);
            $this->db->delete('tbldebitnoteproductfields');

            $this->db->where('type','debitnote');
            $this->db->where('invoice_id',$id);
            $this->db->delete('tblinvoiceclientperson');

            foreach($client_data as $single_client_data)
            {
                $this->db->where('id',$single_client_data['clientid']);
                $this->db->delete('tblcontacts');
            }  

            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            foreach ($data['saleproposal'] as $singlesalepro) {

                if($data['debit_note_type'] == '2'){

                    $saleitemdata['debitnote_id'] = $id;
                    $saleitemdata['product_id'] = 0;
                    $saleitemdata['product_name'] = $singlesalepro['product_name'];
                    $saleitemdata['pro_id'] = 0;
                    $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                    $saleitemdata['qty'] = 1;
                    $saleitemdata['price'] = $singlesalepro['price'];
                    $saleitemdata['ttl_price'] = $singlesalepro['price'];
                    $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                    $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                    $saleitemdata['status'] = 0;
                    $saleitemdata['other'] = 0;
                    $this->db->insert('tbldebitnoteproduct', $saleitemdata);                
                    $saleitemid = $this->db->insert_id();
                }else{
                    $other = (!empty($singlesalepro['other'])) ? 1 : 0;
                    
                    if (!empty($singlesalepro['product_id'])){
                        $saleitemdata['debitnote_id'] = $id;
                        $saleitemdata['product_id'] = $singlesalepro['product_id'];
                        $saleitemdata['product_name'] = $singlesalepro['product_name'];
                        $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                        $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                        $saleitemdata['qty'] = $singlesalepro['qty'];
                        $saleitemdata['price'] = $singlesalepro['price'];
                        $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                        $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                        $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                        $saleitemdata['status'] = $singlesalepro['status'];
                        $saleitemdata['other'] = $other;
                        $this->db->insert('tbldebitnoteproduct', $saleitemdata);
                        $saleitemid = $this->db->insert_id();
                    }
                }
            }

            foreach($clientdata as $singleclient)
            {
                $singleclient['userid']=$data['clientid'];;
                $this->db->insert('tblcontacts', $singleclient);
                $cont_id = $this->db->insert_id();
                $datace['invoice_id']=$id;
                $datace['contact_id']=$cont_id;
                $datace['type']='debitnote';
                $this->db->insert('tblinvoiceclientperson', $datace);
            }

             if(!empty($data['productfields'])){
                foreach ($data['productfields'] as $fieldname) {
                    $pro_field['proposalid'] = $id;
                    $pro_field['field_id'] = $fieldname;
                    $pro_field['created_at'] = date('Y-m-d H:i:s');
                    $pro_field['updated_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('tbldebitnoteproductfields', $pro_field);
                }
            }

            if(!empty($othercharges)){
               foreach ($othercharges as $odata) {
                    if (!isset($odata['igst'])) {
                        $totaltax = $odata['gst'] + $odata['sgst'];
                        $odata['isgst'] = 1;
                    } else {
                        $totaltax = $odata['igst'];
                        $odata['isgst'] = 0;
                    }
                    $odata['proposalid'] = $id;
                    $odata['is_sale'] = 0;
                    $odata['created_at'] = date("Y-m-d H:i:s");
                    $odata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbldebitnoteothercharges', $odata);
                } 
            }
            return $id;
        }
        return false;
    }

    public function add_paymentnote($data) {
                   
       
       $clientdata=$data['clientdata'];
       $invoicedata=$data['data'];
       $debitnotedata=$data['data_dn'];


        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $dn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $dn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $dn_number = $number_arr[0];
            }
        }

        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'clientid' => $data['clientid'],
                'number' => $data['number'],             
                'dn_number' => $dn_number,             
                'year_id' => financial_year(),             
                'date' => $date,
                'sac_code' => $data['sac_code'],
                'sac_hsn' => $data['sac_hsn'],
                'intrest_percent' => $data['intrest_percent'],
                'note' => $data['note'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'status' => 1,
                'tax_type' => $data['tax_type'],
                'created_date' => date('Y-m-d H:i:s')
          );
    
       

        $this->db->insert('tbldebitnotepayment', $ad_data);
        $insert_id = $this->db->insert_id();
         
        if ($insert_id) {

            $ttl_amount = 0;

            if(!empty($invoicedata)){
                foreach ($invoicedata as  $r) {

                    $due_date = str_replace("/","-",$r['due_date']);
                    $due_date = date("Y-m-d",strtotime($due_date));


                    $ad_data = array(           
                        'debitnote_id' => $insert_id,
                        'invoice_id' => $r['invoice_id'],
                        'due_date' => $due_date,
                        'invoice_amount' => $r['invoice_amount'],
                        'delay_days' => $r['delay_days'],
                        'amount' => $r['amount'],
                        'tax' => $r['tax'],
                        'final_amount' => $r['final_amount'],
                        'type' => 1,
                        'status' => 1
                    );

                    $ttl_amount += $r['final_amount'];

                    $this->db->insert('tbldebitnotepaymentitems', $ad_data);

                }
                
            }

            if(!empty($debitnotedata)){
                foreach ($debitnotedata as  $r) {

                    $due_date = str_replace("/","-",$r['due_date']);
                    $due_date = date("Y-m-d",strtotime($due_date));


                    $ad_data = array(           
                        'debitnote_id' => $insert_id,
                        'invoice_id' => $r['invoice_id'],
                        'due_date' => $due_date,
                        'invoice_amount' => $r['invoice_amount'],
                        'delay_days' => $r['delay_days'],
                        'amount' => $r['amount'],
                        'tax' => $r['tax'],
                        'final_amount' => $r['final_amount'],
                        'type' => 2,
                        'status' => 1
                    );

                    $ttl_amount += $r['final_amount'];

                    $this->db->insert('tbldebitnotepaymentitems', $ad_data);

                }
                
            }

            $this->db->update('tbldebitnotepayment', array('amount'=>$ttl_amount), array('id'=>$insert_id));
           
            foreach($clientdata as $singleclient)
            {
                $singleclient['userid']=$data['clientid'];;
                $this->db->insert('tblcontacts', $singleclient);
                $cont_id = $this->db->insert_id();
                $datace['invoice_id']=$insert_id;
                $datace['contact_id']=$cont_id;
                $datace['type']='debitnotepayment';
                $this->db->insert('tblinvoiceclientperson', $datace);
            }
            

            return $insert_id;
        }

        return false;
    }



    public function update_paymentnote($data,$id) {
                   
        $clientdata=$data['clientdata'];
        $client_data=$data['client_data'];
        $invoicedata=$data['data'];
        $debitnotedata=$data['data_dn'];


        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $dn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $dn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $dn_number = $number_arr[0];
            }
        }

        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'clientid' => $data['clientid'],
                'number' => $data['number'],             
                'dn_number' => $dn_number,             
                'year_id' => financial_year(),             
                'date' => $date,
                'sac_code' => $data['sac_code'],
                'sac_hsn' => $data['sac_hsn'],
                'intrest_percent' => $data['intrest_percent'],
                'note' => $data['note'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'status' => 1,
                'tax_type' => $data['tax_type'],
                'created_date' => date('Y-m-d H:i:s')
        );
      
       
        $this->db->where('id', $id);
        $this->db->update('tbldebitnotepayment', $ad_data);
                 
        if ($id) {
           
            $this->db->where('type','debitnotepayment');
            $this->db->where('invoice_id',$id);
            $this->db->delete('tblinvoiceclientperson');

            foreach($client_data as $single_client_data)
            {
                $this->db->where('id',$single_client_data['clientid']);
                $this->db->delete('tblcontacts');
            }  


            

            foreach($clientdata as $singleclient)
             {
                $singleclient['userid']=$data['clientid'];;
                $this->db->insert('tblcontacts', $singleclient);
                $cont_id = $this->db->insert_id();
                $datace['invoice_id']=$id;
                $datace['contact_id']=$cont_id;
                $datace['type']='debitnotepayment';
                $this->db->insert('tblinvoiceclientperson', $datace);
             }



            $this->db->where('debitnote_id',$id);
            $this->db->delete('tbldebitnotepaymentitems');

            $ttl_amount = 0;

            if(!empty($invoicedata)){
                foreach ($invoicedata as  $r) {

                    $due_date = str_replace("/","-",$r['due_date']);
                    $due_date = date("Y-m-d",strtotime($due_date));


                    $ad_data = array(           
                        'debitnote_id' => $id,
                        'invoice_id' => $r['invoice_id'],
                        'due_date' => $due_date,
                        'invoice_amount' => $r['invoice_amount'],
                        'delay_days' => $r['delay_days'],
                        'amount' => $r['amount'],
                        'tax' => $r['tax'],
                        'final_amount' => $r['final_amount'],
                        'type' => 1,
                        'status' => 1
                    );

                    $ttl_amount += $r['final_amount'];

                    $this->db->insert('tbldebitnotepaymentitems', $ad_data);

                }
            }


            if(!empty($debitnotedata)){
                foreach ($debitnotedata as  $r) {

                    $due_date = str_replace("/","-",$r['due_date']);
                    $due_date = date("Y-m-d",strtotime($due_date));


                    $ad_data = array(           
                        'debitnote_id' => $id,
                        'invoice_id' => $r['invoice_id'],
                        'due_date' => $due_date,
                        'invoice_amount' => $r['invoice_amount'],
                        'delay_days' => $r['delay_days'],
                        'amount' => $r['amount'],
                        'tax' => $r['tax'],
                        'final_amount' => $r['final_amount'],
                        'type' => 2,
                        'status' => 1
                    );

                    $ttl_amount += $r['final_amount'];

                    $this->db->insert('tbldebitnotepaymentitems', $ad_data);

                }
                
            }

            $this->db->update('tbldebitnotepayment', array('amount'=>$ttl_amount), array('id'=>$id));


            return $id;
        }

        return false;
    }

}
